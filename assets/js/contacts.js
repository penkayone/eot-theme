(function () {
  const SELECTED_SERVICE_KEY = "selectedServiceId";

  const config = window.eotBookingData || {};
  const wpApiRoot = window.wpApiSettings && window.wpApiSettings.root ? String(window.wpApiSettings.root) : "";
  const restBase = config.restUrl || (wpApiRoot ? `${wpApiRoot.replace(/\/$/, "")}/bc/v1` : "");
  const restUrl = String(restBase).replace(/\/$/, "");

  const state = {
    services: [],
    serviceId: null,
    calendarDays: [],
    selectedDate: "",
    slots: [],
    selectedSlot: null,
  };
  let daySelectionToastTimer = null;

  const qs = (id) => document.getElementById(id);
  const safeStorage = {
    get(key) {
      try {
        return window.localStorage ? window.localStorage.getItem(key) : null;
      } catch (_) {
        return null;
      }
    },
    set(key, value) {
      try {
        if (window.localStorage) window.localStorage.setItem(key, value);
      } catch (_) {
        // ignore storage errors (private mode / restricted storage)
      }
    },
  };

  const getNested = (obj, key) =>
    String(key)
      .split(".")
      .reduce((acc, part) => (acc && acc[part] !== undefined ? acc[part] : null), obj);

  const t = (key, fallback) => getNested(window.__I18N__ || {}, key) ?? fallback;

  const getLocale = () => (document.documentElement.lang === "sk" ? "sk-SK" : "ru-RU");
  const WEEKDAY_LONG_RU = ["воскресенье", "понедельник", "вторник", "среда", "четверг", "пятница", "суббота"];
  const WEEKDAY_LONG_SK = ["nedeľa", "pondelok", "utorok", "streda", "štvrtok", "piatok", "sobota"];
  const WEEKDAY_SHORT_RU = ["вс", "пн", "вт", "ср", "чт", "пт", "сб"];
  const WEEKDAY_SHORT_SK = ["ne", "po", "ut", "st", "št", "pi", "so"];

  function getWeekdayLongLabel(date) {
    const dayIndex = date.getDay();
    const locale = getLocale();
    const dictionary = locale === "sk-SK" ? WEEKDAY_LONG_SK : WEEKDAY_LONG_RU;
    const dictionaryLabel = dictionary[dayIndex];
    if (dictionaryLabel) return dictionaryLabel;
    return new Intl.DateTimeFormat(locale, { weekday: "long" }).format(date);
  }

  function getWeekdayShortLabel(date) {
    const dayIndex = date.getDay();
    const locale = getLocale();
    const dictionary = locale === "sk-SK" ? WEEKDAY_SHORT_SK : WEEKDAY_SHORT_RU;
    const dictionaryLabel = dictionary[dayIndex];
    if (dictionaryLabel) return dictionaryLabel;
    return new Intl.DateTimeFormat(locale, { weekday: "short" }).format(date);
  }

  function formatSelectedDate(dateString) {
    if (!dateString) return "";
    const date = new Date(`${dateString}T00:00:00`);
    if (Number.isNaN(date.getTime())) return dateString;
    return new Intl.DateTimeFormat(getLocale(), {
      day: "numeric",
      month: "long",
      year: "numeric",
    }).format(date);
  }

  function showSelectionToast(message) {
    if (!document.body) return;

    let toast = qs("booking-day-toast");
    if (!toast) {
      toast = document.createElement("div");
      toast.id = "booking-day-toast";
      toast.className = "booking-v2-toast";
      toast.setAttribute("role", "status");
      toast.setAttribute("aria-live", "polite");
      document.body.appendChild(toast);
    }

    toast.textContent = message;

    toast.classList.remove("is-visible");
    window.requestAnimationFrame(() => {
      window.requestAnimationFrame(() => {
        toast.classList.add("is-visible");
      });
    });

    if (daySelectionToastTimer) {
      clearTimeout(daySelectionToastTimer);
    }
    daySelectionToastTimer = window.setTimeout(() => {
      toast.classList.remove("is-visible");
    }, 2000);
  }

  function showDaySelectionToast(dateString) {
    const messageTemplate = t(
      "booking.dateSelectedToast",
      "Вы выбрали дату {date}, теперь выберите время."
    );
    showSelectionToast(messageTemplate.replace("{date}", formatSelectedDate(dateString)));
  }

  function showTimeSelectionToast(timeLabel) {
    const messageTemplate = t(
      "booking.timeSelectedToast",
      "Вы выбрали время {time}, теперь заполните форму."
    );
    showSelectionToast(messageTemplate.replace("{time}", timeLabel || ""));
  }

  const isValidName = (name) => /^[A-Za-zА-Яа-яЁёІіЇїЄєҐґ][A-Za-zА-Яа-яЁёІіЇїЄєҐґ\s'-]{1,59}$/.test(name);
  const isValidEmail = (email) => /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/.test(email);
  const isValidPhone = (phone) => /^\+?\d{7,15}$/.test(phone);

  function setFeedback(text, isError = false) {
    const feedback = qs("booking-feedback");
    if (!feedback) return;
    feedback.textContent = text || "";
    feedback.classList.toggle("is-error", !!isError);
  }

  function selectedService() {
    return state.services.find((s) => String(s.id) === String(state.serviceId)) || null;
  }

  function normalize(value) {
    return String(value || "")
      .trim()
      .toLowerCase();
  }

  function detectServiceAlias(service, index = -1) {
    const candidates = [service?.slug, service?.code, service?.key, service?.name, service?.title].map(normalize);
    if (candidates.some((value) => value.includes("intro") || value.includes("ввод") || value.includes("uvod"))) {
      return "intro";
    }
    if (candidates.some((value) => value.includes("individual") || value.includes("индив") || value.includes("individu"))) {
      return "individual";
    }
    if (candidates.some((value) => value.includes("package") || value.includes("seminar") || value.includes("пакет"))) {
      return "package";
    }

    if (index === 0) return "intro";
    if (index === 1) return "individual";
    if (index === 2) return "package";
    return "";
  }

  function getLocalizedServiceTitle(service, index = -1) {
    const alias = detectServiceAlias(service, index);
    const keyByAlias = {
      intro: "services.items.3.title",
      individual: "services.items.1.title",
      package: "services.items.2.title",
    };
    const key = keyByAlias[alias];
    const localized = key ? t(key, "") : "";
    if (localized) return localized;
    return String(service?.title || service?.name || "").trim();
  }

  function resolveServiceIdFromQuery(rawValue) {
    const value = normalize(rawValue);
    if (!value || !state.services.length) return null;

    // Accept direct numeric id or exact id-as-string first.
    const direct = state.services.find((s) => String(s.id) === value);
    if (direct) return String(direct.id);

    // Try semantic fields from API (if present) and title substring.
    const byField = state.services.find((s) => {
      const candidates = [s.slug, s.code, s.key, s.name, s.title];
      return candidates.some((candidate) => {
        const normalizedCandidate = normalize(candidate);
        return normalizedCandidate && (normalizedCandidate === value || normalizedCandidate.includes(value));
      });
    });
    if (byField) return String(byField.id);

    // Fallback to known website aliases and current card order.
    const aliasIndexMap = { intro: 0, individual: 1, package: 2 };
    if (aliasIndexMap[value] !== undefined && state.services[aliasIndexMap[value]]) {
      return String(state.services[aliasIndexMap[value]].id);
    }

    return null;
  }

  function api(path, options = {}) {
    if (!restUrl) {
      return Promise.reject(new Error("REST URL не настроен"));
    }

    const headers = { ...(options.headers || {}), "Content-Type": "application/json" };
    if (config.nonce) headers["X-WP-Nonce"] = config.nonce;

    return fetch(`${restUrl}${path}`, { ...options, headers }).then(async (response) => {
      const data = await response.json().catch(() => ({}));
      if (!response.ok) {
        throw new Error(data?.message || "Ошибка запроса");
      }
      return data;
    });
  }

  function closeMenus() {
    ["service"].forEach((name) => {
      const menu = qs(`${name}-menu`);
      const trigger = qs(`${name}-trigger`);
      const wrap = trigger ? trigger.closest(".booking-v2-select-wrap") : null;
      if (menu) menu.hidden = true;
      if (trigger) trigger.setAttribute("aria-expanded", "false");
      if (wrap) wrap.classList.remove("is-open");
    });
  }

  function renderMenus() {
    const serviceMenu = qs("service-menu");
    const serviceTrigger = qs("service-trigger");
    if (!serviceMenu || !serviceTrigger) return;

    serviceMenu.innerHTML = "";
    state.services.forEach((service, index) => {
      const li = document.createElement("li");
      const btn = document.createElement("button");
      btn.type = "button";
      btn.className = "booking-v2-option";
      if (String(service.id) === String(state.serviceId)) btn.classList.add("selected");
      btn.textContent = getLocalizedServiceTitle(service, index);

      btn.addEventListener("click", async (event) => {
        event.stopPropagation();
        state.serviceId = String(service.id);
        safeStorage.set(SELECTED_SERVICE_KEY, state.serviceId);
        state.selectedSlot = null;
        state.selectedDate = "";
        setFeedback("");
        closeMenus();
        await loadCalendar();
      });

      li.appendChild(btn);
      serviceMenu.appendChild(li);
    });

    const currentService = selectedService();
    const currentIndex = currentService ? state.services.findIndex((s) => String(s.id) === String(currentService.id)) : -1;
    serviceTrigger.textContent = currentService
      ? getLocalizedServiceTitle(currentService, currentIndex)
      : t("booking.serviceLabel", "Выберите услугу");
  }

  function renderDays() {
    const grid = qs("days-grid");
    if (!grid) return;

    grid.innerHTML = "";
    const days = [...state.calendarDays].sort((a, b) => (a.date > b.date ? 1 : -1));

    if (!days.length) {
      const empty = document.createElement("p");
      empty.className = "booking-v2-empty";
      empty.textContent = t("booking.noDates", "Нет доступных дат");
      grid.appendChild(empty);
      return;
    }

    days.forEach((d) => {
      const date = new Date(`${d.date}T00:00:00`);
      const weekdayLong = getWeekdayLongLabel(date);
      const weekdayShort = getWeekdayShortLabel(date);
      const btn = document.createElement("button");
      btn.type = "button";
      btn.className = "booking-v2-day";
      if (!d.has_slots) btn.disabled = true;
      if (d.date === state.selectedDate) btn.classList.add("selected");
      if (weekdayLong.length > 8) btn.classList.add("weekday-long");

      btn.innerHTML = `
        <span class="weekday-label weekday-label-long">${weekdayLong}</span>
        <span class="weekday-label weekday-label-short">${weekdayShort}</span>
        <strong>${String(date.getDate()).padStart(2, "0")}</strong>
        <small>${new Intl.DateTimeFormat(getLocale(), { month: "short" }).format(date)}</small>
      `;

      btn.addEventListener("click", async () => {
        if (!d.has_slots) return;
        state.selectedDate = d.date;
        state.selectedSlot = null;
        showDaySelectionToast(d.date);
        await loadSlots();
        renderAll();
      });

      grid.appendChild(btn);
    });
  }

  function renderSlots() {
    const grid = qs("slots-grid");
    if (!grid) return;

    grid.innerHTML = "";

    if (!state.selectedDate) {
      const empty = document.createElement("p");
      empty.className = "booking-v2-empty";
      empty.textContent = t("booking.chooseDay", "Выберите дату");
      grid.appendChild(empty);
      return;
    }

    if (!state.slots.length) {
      const empty = document.createElement("p");
      empty.className = "booking-v2-empty";
      empty.textContent = t("booking.noSlots", "Нет доступных слотов");
      grid.appendChild(empty);
      return;
    }

    state.slots.forEach((slot) => {
      const btn = document.createElement("button");
      btn.type = "button";
      btn.className = "booking-v2-slot free";
      btn.textContent = slot.label || "";
      if (state.selectedSlot && state.selectedSlot.starts_at === slot.starts_at) {
        btn.classList.add("selected");
      }

      btn.addEventListener("click", () => {
        state.selectedSlot = slot;
        showTimeSelectionToast(slot.label || "");
        renderSelectedInfo();
        renderSlots();
      });

      grid.appendChild(btn);
    });
  }

  function renderSelectedInfo() {
    const node = qs("booking-selected");
    if (!node) return;

    if (!state.serviceId) {
      node.textContent = t("booking.chooseService", "Сначала выберите услугу.");
      return;
    }

    if (!state.selectedDate || !state.selectedSlot) {
      node.textContent = t("booking.chooseSlot", "Выберите слот для записи");
      return;
    }

    node.textContent = `${t("booking.selectedPrefix", "Вы выбрали")}: ${formatSelectedDate(state.selectedDate)} ${state.selectedSlot.label}`;
  }

  function renderAll() {
    renderMenus();
    renderDays();
    renderSlots();
    renderSelectedInfo();
  }

  async function loadServices() {
    const data = await api("/services");
    state.services = Array.isArray(data.services) ? data.services : [];

    if (!state.services.length) {
      state.serviceId = null;
      return;
    }

    const params = new URLSearchParams(window.location.search);
    const fromUrlServiceId = params.get("service_id");
    const fromUrlService = params.get("service");
    const fromStorage = safeStorage.get(SELECTED_SERVICE_KEY);
    const fromUrlResolved =
      resolveServiceIdFromQuery(fromUrlServiceId) || resolveServiceIdFromQuery(fromUrlService);

    if (fromUrlResolved) {
      state.serviceId = String(fromUrlResolved);
    } else if (fromStorage && state.services.some((s) => String(s.id) === String(fromStorage))) {
      state.serviceId = String(fromStorage);
    } else {
      state.serviceId = String(state.services[0].id);
    }

    safeStorage.set(SELECTED_SERVICE_KEY, state.serviceId);
  }

  async function loadCalendar() {
    if (!state.serviceId) {
      state.calendarDays = [];
      state.selectedDate = "";
      state.slots = [];
      state.selectedSlot = null;
      renderAll();
      return;
    }

    const data = await api(`/calendar?service_id=${encodeURIComponent(state.serviceId)}`);
    state.calendarDays = Array.isArray(data.days) ? data.days : [];
    const first = state.calendarDays.find((d) => d.has_slots);
    state.selectedDate = first ? first.date : "";

    state.selectedSlot = null;
    await loadSlots();
    renderAll();
  }

  async function loadSlots() {
    if (!state.serviceId || !state.selectedDate) {
      state.slots = [];
      state.selectedSlot = null;
      return;
    }

    const data = await api(
      `/slots?service_id=${encodeURIComponent(state.serviceId)}&date=${encodeURIComponent(state.selectedDate)}`
    );

    state.slots = Array.isArray(data.slots) ? data.slots : [];

    if (!state.slots.some((s) => state.selectedSlot && s.starts_at === state.selectedSlot.starts_at)) {
      state.selectedSlot = null;
    }
  }

  async function submitBooking(payload) {
    return api("/book", {
      method: "POST",
      body: JSON.stringify(payload),
    });
  }

  function initFieldGuards() {
    const email = qs("booking-email");
    const phone = qs("booking-phone");

    if (email) {
      email.addEventListener("input", () => {
        email.value = email.value.replace(/[А-Яа-яЁё]/g, "");
      });
    }

    if (phone) {
      phone.addEventListener("input", () => {
        let value = phone.value.replace(/[^\d+]/g, "");
        value = value.replace(/(?!^)\+/g, "");
        phone.value = value;
      });
    }
  }

  function initForm() {
    const form = qs("booking-form");
    if (!form) return;

    form.addEventListener("submit", async (event) => {
      event.preventDefault();
      setFeedback("");

      const name = String(qs("booking-name")?.value || "").trim();
      const email = String(qs("booking-email")?.value || "").trim();
      const phone = String(qs("booking-phone")?.value || "").trim();
      const message = String(qs("booking-message")?.value || "").trim();

      if (!state.serviceId) {
        setFeedback(t("booking.errors.service", "Сначала выберите услугу."), true);
        return;
      }
      if (!state.selectedSlot) {
        setFeedback(t("booking.errors.time", "Сначала выберите время."), true);
        return;
      }
      if (!isValidName(name)) {
        setFeedback(t("booking.errors.name", "Укажите корректное имя."), true);
        return;
      }
      if (!isValidEmail(email)) {
        setFeedback(t("booking.errors.email", "Введите корректный email."), true);
        return;
      }
      if (!isValidPhone(phone)) {
        setFeedback(t("booking.errors.phone", "Телефон: только цифры и +, 7-15."), true);
        return;
      }
      if (!message || message.length < 3) {
        setFeedback(t("booking.errors.message", "Кратко опишите запрос."), true);
        return;
      }

      if (!config.isLoggedIn) {
        const loginUrl = config.loginUrl || "/wp-login.php";
        setFeedback(`Для записи нужно войти: ${loginUrl}`, true);
        return;
      }

      const payload = {
        service_id: parseInt(state.serviceId, 10),
        starts_at: state.selectedSlot.starts_at,
        ends_at: state.selectedSlot.ends_at,
        customer_name: name,
        customer_email: email,
        customer_phone: phone,
        notes: message,
      };

      const submitBtn = form.querySelector('[type="submit"]');
      if (submitBtn) submitBtn.disabled = true;
      setFeedback(t("booking.saving", "Сохраняю..."));

      try {
        await submitBooking(payload);
        setFeedback(t("booking.success", "Запись подтверждена. Я свяжусь с вами через email."));
        form.reset();
        state.selectedSlot = null;
        await loadCalendar();
      } catch (error) {
        setFeedback(error?.message || t("booking.errors.server", "Не удалось отправить запись. Попробуйте позже."), true);
      } finally {
        if (submitBtn) submitBtn.disabled = false;
      }
    });
  }

  function toggleMenu(name) {
    const menu = qs(`${name}-menu`);
    const trigger = qs(`${name}-trigger`);
    if (!menu || !trigger) return;

    const willOpen = menu.hidden;
    closeMenus();
    menu.hidden = !willOpen;
    trigger.setAttribute("aria-expanded", String(willOpen));

    const wrap = trigger.closest(".booking-v2-select-wrap");
    if (wrap && willOpen) wrap.classList.add("is-open");
  }

  function initEvents() {
    const serviceTrigger = qs("service-trigger");
    if (!serviceTrigger) return;

    serviceTrigger.addEventListener("click", (event) => {
      event.stopPropagation();
      toggleMenu("service");
    });

    document.addEventListener("click", () => closeMenus());
  }

  async function initBooking() {
    const serviceTrigger = qs("service-trigger");
    const daysGrid = qs("days-grid");
    const slotsGrid = qs("slots-grid");
    if (!serviceTrigger || !daysGrid || !slotsGrid) return;

    if (!restUrl) {
      setFeedback("Booking API не подключен.", true);
      return;
    }

    initEvents();
    initFieldGuards();
    initForm();

    try {
      await loadServices();
      await loadCalendar();
    } catch (error) {
      const msg = error?.message || "Ошибка загрузки данных бронирования.";
      setFeedback(`Booking API: ${msg}`, true);
    }
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initBooking);
  } else {
    initBooking();
  }

  document.addEventListener("languageChanged", renderAll);
})();
