(function () {
  const SELECTED_SERVICE_KEY = "selectedServiceId";

  const config = window.eotBookingData || {};
  const wpApiRoot = window.wpApiSettings && window.wpApiSettings.root ? String(window.wpApiSettings.root) : "";
  const restBase = config.restUrl || (wpApiRoot ? `${wpApiRoot.replace(/\/$/, "")}/bc/v1` : "");
  const restUrl = String(restBase).replace(/\/$/, "");

  const state = {
    services: [],
    serviceId: null,
    serviceLockedFromUrl: false,
    calendarDays: [],
    selectedDate: "",
    slots: [],
    // Выбранные встречи заявки. Для обычной услуги здесь максимум один слот,
    // для услуги с несколькими встречами — до meetings_count слотов.
    pickedSlots: [],
    // Сетка дат открыта, пока дата не выбрана; после выбора сворачивается.
    datePickerOpen: true,
  };
  let daySelectionToastTimer = null;

  const slotKey = (slot) => `${slot.starts_at}|${slot.ends_at}`;

  function meetingsCount() {
    const service = selectedService();
    return Math.max(1, parseInt(service?.meetings_count, 10) || 1);
  }

  function isPicked(slot) {
    return state.pickedSlots.some((picked) => slotKey(picked) === slotKey(slot));
  }

  // Слоты, которые ещё можно взять на текущую дату: свободные по расписанию
  // минус уже отложенные в эту же заявку (в БД их пока нет).
  function remainingSlots() {
    return state.slots.filter((slot) => !isPicked(slot));
  }

  function meetingsLeft() {
    return Math.max(0, meetingsCount() - state.pickedSlots.length);
  }

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

    // 1) Точное совпадение по slug — основной, стабильный ключ услуги.
    const bySlug = state.services.find((s) => {
      const slug = normalize(s.slug);
      return slug && slug === value;
    });
    if (bySlug) return String(bySlug.id);

    // 2) Прямой числовой id (поддержка ?service_id=… и ?service=<id>).
    const byId = state.services.find((s) => String(s.id) === value);
    if (byId) return String(byId.id);

    // 3) Нечёткое совпадение по прочим семантическим полям / подстроке названия.
    const byField = state.services.find((s) => {
      const candidates = [s.code, s.key, s.name, s.title];
      return candidates.some((candidate) => {
        const normalizedCandidate = normalize(candidate);
        return normalizedCandidate && (normalizedCandidate === value || normalizedCandidate.includes(value));
      });
    });
    if (byField) return String(byField.id);

    // 4) Легаси-фолбэк: позиционные алиасы по порядку карточек. Только на самый
    //    последний случай — ради обратной совместимости старых ссылок без slug.
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
    // Публичные эндпоинты бронирования (bc/v1) не требуют nonce. Заголовок X-WP-Nonce
    // намеренно НЕ отправляется: под полностраничным кэшем на странице лежит протухший
    // токен, из-за которого ядро WP отклоняло любой запрос как "Проверка куки не удалась".

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

    // Услуга уже выбрана по ссылке (?service / ?service_id) — прячем выбор услуги.
    // Inline-стиль перекрывает CSS-специфичность .booking-v2-field { display: flex }.
    const serviceField = serviceTrigger.closest(".booking-v2-field");
    if (serviceField) {
      serviceField.style.display = state.serviceLockedFromUrl ? "none" : "";
    }

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

    // Дата выбрана — сетка дат сворачивается, вместо неё остаётся компактный
    // блок с выбранной датой и ссылкой «Выбрать другую дату».
    grid.hidden = !state.datePickerOpen;

    grid.innerHTML = "";
    if (!state.datePickerOpen) return;
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

      btn.addEventListener("click", () => {
        if (!d.has_slots) return;
        selectDate(d.date);
      });

      grid.appendChild(btn);
    });
  }

  async function selectDate(date) {
    state.selectedDate = date;
    state.datePickerOpen = false;
    setSlotsNotice("");
    showDaySelectionToast(date);

    await loadSlots();
    renderAll();
  }

  function openDatePicker() {
    state.datePickerOpen = true;
    setSlotsNotice("");
    renderAll();
  }

  function renderPickedDate() {
    const node = qs("picked-date");
    const value = qs("picked-date-value");
    if (!node || !value) return;

    const visible = !state.datePickerOpen && !!state.selectedDate;
    node.hidden = !visible;
    if (!visible) return;

    value.textContent = formatSelectedDate(state.selectedDate);

    // Подписи берём из словаря, чтобы они менялись вместе с языком страницы.
    const caption = node.querySelector(".booking-v2-picked-date-caption");
    if (caption) caption.textContent = t("booking.selectedDateCaption", "Выбранная дата");

    const change = qs("change-date");
    if (change) change.textContent = t("booking.changeDate", "Выбрать другую дату");
  }

  function setSlotsNotice(text) {
    const notice = qs("slots-notice");
    if (!notice) return;

    notice.textContent = text || "";
    notice.hidden = !text;
  }

  function renderSlots() {
    const block = qs("slots-block");
    const grid = qs("slots-grid");
    if (!grid) return;

    // Время показываем только после выбора даты.
    const visible = !!state.selectedDate && !state.datePickerOpen;
    if (block) block.hidden = !visible;

    if (!visible) {
      grid.innerHTML = "";
      return;
    }

    grid.innerHTML = "";

    if (!state.slots.length) {
      const empty = document.createElement("p");
      empty.className = "booking-v2-empty";
      empty.textContent = t("booking.noSlots", "Нет доступных слотов");
      grid.appendChild(empty);
      return;
    }

    const total = meetingsCount();

    state.slots.forEach((slot) => {
      const picked = isPicked(slot);
      const btn = document.createElement("button");
      btn.type = "button";
      btn.className = picked ? "booking-v2-slot picked" : "booking-v2-slot free";
      btn.textContent = slot.label || "";
      btn.setAttribute("aria-pressed", String(picked));

      // Все встречи уже разобраны — оставшиеся слоты брать некуда.
      // У обычной услуги клик по другому времени просто меняет выбор, поэтому
      // там кнопки остаются активными.
      if (!picked && total > 1 && meetingsLeft() === 0) {
        btn.disabled = true;
      }

      btn.addEventListener("click", () => pickSlot(slot));

      grid.appendChild(btn);
    });

    setSlotsNotice(
      !remainingSlots().length && meetingsLeft() > 0
        ? t("booking.noSlotsLeft", "На этот день свободного времени больше нет, выберите другую дату.")
        : ""
    );
  }

  function pickSlot(slot) {
    if (isPicked(slot)) {
      setSlotsNotice(t("booking.alreadyPicked", "Это время вы уже выбрали, выберите другое."));
      return;
    }

    const total = meetingsCount();

    if (total === 1) {
      // Обычная услуга: повторный клик просто заменяет выбранное время.
      state.pickedSlots = [slot];
    } else {
      if (state.pickedSlots.length >= total) return;
      state.pickedSlots.push(slot);
    }

    setFeedback("");
    showTimeSelectionToast(slot.label || "");

    // Встречи ещё остались, но на этот день свободного времени больше нет —
    // сразу возвращаем сетку дат, чтобы не пришлось искать, куда нажимать.
    if (meetingsLeft() > 0 && !remainingSlots().length) {
      state.datePickerOpen = true;
      renderAll();
      setSlotsNotice(t("booking.noSlotsLeft", "На этот день свободного времени больше нет, выберите другую дату."));
      return;
    }

    renderAll();
  }

  // Подсказка для услуг с несколькими встречами: услуга, уже выбранные встречи
  // и сколько осталось. Когда выбраны все — превращается в сводку перед отправкой.
  function renderPlan() {
    const node = qs("booking-plan");
    if (!node) return;

    const total = meetingsCount();

    if (total < 2) {
      node.hidden = true;
      node.innerHTML = "";
      return;
    }

    const service = selectedService();
    const serviceIndex = service ? state.services.findIndex((s) => String(s.id) === String(service.id)) : -1;

    node.hidden = false;
    node.innerHTML = "";

    const title = document.createElement("p");
    title.className = "booking-v2-plan-title";
    title.textContent = t("booking.planTitle", "Ваша запись");
    node.appendChild(title);

    const serviceLine = document.createElement("p");
    serviceLine.className = "booking-v2-plan-service";
    serviceLine.textContent = `${t("booking.planServiceLabel", "Услуга")}: ${getLocalizedServiceTitle(service, serviceIndex)}`;
    node.appendChild(serviceLine);

    if (state.pickedSlots.length) {
      const list = document.createElement("ul");
      list.className = "booking-v2-plan-list";

      state.pickedSlots.forEach((picked, i) => {
        const item = document.createElement("li");
        item.className = "booking-v2-plan-item";

        const label = document.createElement("span");
        const meeting = t("booking.meetingLabel", "Встреча {n}").replace("{n}", String(i + 1));
        label.textContent = `${meeting}: ${formatSelectedDate(picked.starts_at.slice(0, 10))}, ${picked.label}`;
        item.appendChild(label);

        const remove = document.createElement("button");
        remove.type = "button";
        remove.className = "booking-v2-plan-remove";
        remove.textContent = t("booking.removeMeeting", "Убрать");
        remove.addEventListener("click", () => {
          state.pickedSlots.splice(i, 1);
          setFeedback("");
          renderAll();
        });
        item.appendChild(remove);

        list.appendChild(item);
      });

      node.appendChild(list);
    }

    const left = meetingsLeft();
    const status = document.createElement("p");
    status.className = "booking-v2-plan-status" + (left ? "" : " is-complete");
    status.textContent = left
      ? t("booking.meetingsLeft", "Осталось выбрать встреч: {count}").replace("{count}", String(left))
      : t("booking.planComplete", "Все встречи выбраны. Проверьте и нажмите «Забронировать».");
    node.appendChild(status);
  }

  function renderSelectedInfo() {
    const node = qs("booking-selected");
    if (!node) return;

    if (!state.serviceId) {
      node.textContent = t("booking.chooseService", "Сначала выберите услугу.");
      return;
    }

    // У мультивстреч выбранное показывает блок плана — дублировать не нужно.
    if (meetingsCount() > 1) {
      node.textContent = "";
      return;
    }

    const picked = state.pickedSlots[0];
    if (!picked) {
      node.textContent = t("booking.chooseSlot", "Выберите слот для записи");
      return;
    }

    node.textContent = `${t("booking.selectedPrefix", "Вы выбрали")}: ${formatSelectedDate(picked.starts_at.slice(0, 10))} ${picked.label}`;
  }

  function renderAll() {
    renderMenus();
    renderDays();
    renderPickedDate();
    renderSlots();
    renderPlan();
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
      state.serviceLockedFromUrl = true;
    } else if (fromStorage && state.services.some((s) => String(s.id) === String(fromStorage))) {
      state.serviceId = String(fromStorage);
      state.serviceLockedFromUrl = false;
    } else {
      state.serviceId = String(state.services[0].id);
      state.serviceLockedFromUrl = false;
    }

    safeStorage.set(SELECTED_SERVICE_KEY, state.serviceId);
  }

  function resetSelection() {
    state.selectedDate = "";
    state.slots = [];
    state.pickedSlots = [];
    state.datePickerOpen = true;
    setSlotsNotice("");
  }

  async function loadCalendar() {
    resetSelection();

    if (!state.serviceId) {
      state.calendarDays = [];
      renderAll();
      return;
    }

    const data = await api(`/calendar?service_id=${encodeURIComponent(state.serviceId)}`);
    state.calendarDays = Array.isArray(data.days) ? data.days : [];

    // Дату за клиента больше не выбираем: сетка остаётся открытой, пока он не
    // ткнёт в дату сам. Иначе календарь схлопывался бы раньше, чем его увидят.
    renderAll();
  }

  async function loadSlots() {
    if (!state.serviceId || !state.selectedDate) {
      state.slots = [];
      return;
    }

    const data = await api(
      `/slots?service_id=${encodeURIComponent(state.serviceId)}&date=${encodeURIComponent(state.selectedDate)}`
    );

    state.slots = Array.isArray(data.slots) ? data.slots : [];
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

      const total = meetingsCount();
      if (state.pickedSlots.length !== total) {
        const left = meetingsLeft();
        setFeedback(
          total > 1
            ? t("booking.errors.meetingsIncomplete", "Выберите все встречи: осталось {count}.").replace("{count}", String(left))
            : t("booking.errors.time", "Сначала выберите время."),
          true
        );
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

      const payload = {
        service_id: parseInt(state.serviceId, 10),
        slots: state.pickedSlots.map((slot) => ({ starts_at: slot.starts_at, ends_at: slot.ends_at })),
        // Дублируем первую встречу в старых полях — на случай, если на сервере
        // ещё крутится версия плагина, которая про slots[] не знает.
        starts_at: state.pickedSlots[0].starts_at,
        ends_at: state.pickedSlots[0].ends_at,
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
        // loadCalendar() сам сбрасывает выбор: дата, слоты и отложенные встречи.
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

    const changeDate = qs("change-date");
    if (changeDate) {
      changeDate.addEventListener("click", (event) => {
        event.stopPropagation();
        openDatePicker();
      });
    }

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
