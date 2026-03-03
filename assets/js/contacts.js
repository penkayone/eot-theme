(function () {
  const YEARS_AHEAD = 4;
  const BOOKED_SLOTS_KEY = "bookedSlots";
  const SELECTED_SERVICE_KEY = "selectedService";
  const API_BOOK_URL = (window.eotThemeData && window.eotThemeData.apiBookUrl) || "backend/api/book.php";

  const SERVICE_CONFIG = {
    individual: { titleKey: "services.items.1.title", durationKey: "services.items.1.duration", durationMin: 60 },
    package: { titleKey: "services.items.2.title", durationKey: "services.items.2.duration", durationMin: 60 },
    intro: { titleKey: "services.items.3.title", durationKey: "services.items.3.duration", durationMin: 15 },
  };

  const state = {
    year: 0,
    month: 0,
    day: 1,
    selectedDate: "",
    selectedTime: null,
    selectedService: null,
    packageSelections: [],
  };
  const qs = (id) => document.getElementById(id);

  const getNested = (obj, key) =>
    String(key)
      .split(".")
      .reduce((acc, part) => (acc && acc[part] !== undefined ? acc[part] : null), obj);

  const t = (key, fallback) => getNested(window.__I18N__ || {}, key) ?? fallback;

  const formatIso = (date) => {
    const y = String(date.getFullYear());
    const m = String(date.getMonth() + 1).padStart(2, "0");
    const d = String(date.getDate()).padStart(2, "0");
    return `${y}-${m}-${d}`;
  };

  const monthLabel = (monthIndex) => {
    const locale = document.documentElement.lang === "sk" ? "sk-SK" : "ru-RU";
    return new Intl.DateTimeFormat(locale, { month: "long" }).format(new Date(2026, monthIndex, 1));
  };

  const getDaysInMonth = (year, month) => new Date(year, month + 1, 0).getDate();

  const addMinutes = (time, minutesToAdd) => {
    const [h, m] = time.split(":").map(Number);
    const total = h * 60 + m + minutesToAdd;
    const hh = String(Math.floor(total / 60)).padStart(2, "0");
    const mm = String(total % 60).padStart(2, "0");
    return `${hh}:${mm}`;
  };

  const buildRangeSlots = (startTimes, durationMin) => startTimes.map((start) => `${start}-${addMinutes(start, durationMin)}`);

  const buildServiceSlots = (serviceId) => {
    if (!serviceId || !SERVICE_CONFIG[serviceId]) return [];
    if (serviceId === "intro") {
      const starts = ["11:00", "11:30", "13:00", "13:30", "17:00", "17:30", "18:00", "18:30"];
      return buildRangeSlots(starts, 15);
    }
    return buildRangeSlots(["11:00", "13:00", "17:00"], 90);
  };

  const syncSelectedDate = () => {
    const max = getDaysInMonth(state.year, state.month);
    state.day = Math.min(Math.max(state.day, 1), max);
    state.selectedDate = formatIso(new Date(state.year, state.month, state.day));
  };

  const isBusyDemo = (isoDate, time) => {
    const booked = (() => {
      try {
        const raw = localStorage.getItem(BOOKED_SLOTS_KEY);
        const list = raw ? JSON.parse(raw) : [];
        return new Set(Array.isArray(list) ? list : []);
      } catch {
        return new Set();
      }
    })();

    const key = `${isoDate}|${time}`;
    if (booked.has(key)) return true;
    const [y, m, d] = isoDate.split("-").map(Number);
    const marker = Number(time.slice(0, 2)) * 100 + Number(time.slice(3, 5));
    return (y + m * 3 + d * 5 + marker) % 11 === 0;
  };

  const closeMenus = () => {
    ["service", "year", "month"].forEach((name) => {
      const menu = qs(`${name}-menu`);
      const trigger = qs(`${name}-trigger`);
      const wrap = trigger ? trigger.closest(".booking-v2-select-wrap") : null;
      if (menu) menu.hidden = true;
      if (trigger) trigger.setAttribute("aria-expanded", "false");
      if (wrap) wrap.classList.remove("is-open");
    });
  };

  const serviceTitle = (serviceId) => (serviceId && SERVICE_CONFIG[serviceId] ? t(SERVICE_CONFIG[serviceId].titleKey, serviceId) : "");

  const serviceDurationLabel = (serviceId) =>
    serviceId && SERVICE_CONFIG[serviceId] ? t(SERVICE_CONFIG[serviceId].durationKey, `${SERVICE_CONFIG[serviceId].durationMin} мин`) : "";

  const isPackageService = () => state.selectedService === "package";

  const getPackageTimeForDate = (isoDate) => {
    const entry = state.packageSelections.find((item) => item.date === isoDate);
    return entry ? entry.time : null;
  };

  const upsertPackageSelection = (isoDate, time) => {
    const idx = state.packageSelections.findIndex((item) => item.date === isoDate);
    if (idx >= 0) {
      state.packageSelections[idx] = { date: isoDate, time };
      return { ok: true, updated: true };
    }
    if (state.packageSelections.length >= 4) {
      return { ok: false };
    }
    state.packageSelections.push({ date: isoDate, time });
    return { ok: true, updated: false };
  };

  const renderMenus = () => {
    const serviceMenu = qs("service-menu");
    const yearMenu = qs("year-menu");
    const monthMenu = qs("month-menu");
    const serviceTrigger = qs("service-trigger");
    const yearTrigger = qs("year-trigger");
    const monthTrigger = qs("month-trigger");
    if (!serviceMenu || !yearMenu || !monthMenu || !serviceTrigger || !yearTrigger || !monthTrigger) return;

    serviceMenu.innerHTML = "";
    Object.keys(SERVICE_CONFIG).forEach((id) => {
      const li = document.createElement("li");
      const btn = document.createElement("button");
      btn.type = "button";
      btn.className = "booking-v2-option";
      if (id === state.selectedService) btn.classList.add("selected");
      btn.textContent = `${serviceTitle(id)} (${serviceDurationLabel(id)})`;
      btn.addEventListener("click", (event) => {
        event.stopPropagation();
        state.selectedService = id;
        state.selectedTime = null;
        if (id !== "package") state.packageSelections = [];
        localStorage.setItem(SELECTED_SERVICE_KEY, id);
        renderAll();
        closeMenus();
      });
      li.appendChild(btn);
      serviceMenu.appendChild(li);
    });

    yearMenu.innerHTML = "";
    const currentYear = new Date().getFullYear();
    for (let y = currentYear; y <= currentYear + YEARS_AHEAD; y += 1) {
      const li = document.createElement("li");
      const btn = document.createElement("button");
      btn.type = "button";
      btn.className = "booking-v2-option";
      if (y === state.year) btn.classList.add("selected");
      btn.textContent = String(y);
      btn.addEventListener("click", (event) => {
        event.stopPropagation();
        state.year = y;
        state.selectedTime = null;
        syncSelectedDate();
        renderAll();
        closeMenus();
      });
      li.appendChild(btn);
      yearMenu.appendChild(li);
    }

    monthMenu.innerHTML = "";
    for (let m = 0; m < 12; m += 1) {
      const li = document.createElement("li");
      const btn = document.createElement("button");
      btn.type = "button";
      btn.className = "booking-v2-option";
      if (m === state.month) btn.classList.add("selected");
      btn.textContent = monthLabel(m);
      btn.addEventListener("click", (event) => {
        event.stopPropagation();
        state.month = m;
        state.selectedTime = null;
        syncSelectedDate();
        renderAll();
        closeMenus();
      });
      li.appendChild(btn);
      monthMenu.appendChild(li);
    }

    serviceTrigger.textContent = state.selectedService ? serviceTitle(state.selectedService) : t("booking.servicePlaceholder", "Выберите услугу");
    yearTrigger.textContent = String(state.year);
    monthTrigger.textContent = monthLabel(state.month);
  };

  const renderDays = () => {
    const grid = qs("days-grid");
    if (!grid) return;
    grid.innerHTML = "";

    const locale = document.documentElement.lang === "sk" ? "sk-SK" : "ru-RU";
    const total = getDaysInMonth(state.year, state.month);

    for (let day = 1; day <= total; day += 1) {
      const date = new Date(state.year, state.month, day);
      const btn = document.createElement("button");
      btn.type = "button";
      btn.className = "booking-v2-day";
      if (day === state.day) btn.classList.add("selected");
      btn.innerHTML = `
        <span>${new Intl.DateTimeFormat(locale, { weekday: "short" }).format(date)}</span>
        <strong>${String(day).padStart(2, "0")}</strong>
        <small>${new Intl.DateTimeFormat(locale, { month: "short" }).format(date)}</small>
      `;
      btn.addEventListener("click", () => {
        state.day = day;
        state.selectedTime = null;
        syncSelectedDate();
        renderAll();
      });
      grid.appendChild(btn);
    }
  };

  const renderSlots = () => {
    const grid = qs("slots-grid");
    if (!grid) return;
    grid.innerHTML = "";
    const slots = buildServiceSlots(state.selectedService);

    slots.forEach((time) => {
      const busy = isBusyDemo(state.selectedDate, time);
      const btn = document.createElement("button");
      btn.type = "button";
      btn.className = `booking-v2-slot ${busy ? "busy" : "free"}`;
      const selectedForDate = isPackageService() ? getPackageTimeForDate(state.selectedDate) : state.selectedTime;
      if (!busy && selectedForDate === time) btn.classList.add("selected");
      btn.disabled = busy;
      btn.textContent = time;
      btn.setAttribute("aria-label", busy ? `${time}, ${t("booking.unavailableLabel", "Занято")}` : `${time}, ${t("booking.availableLabel", "Свободно")}`);
      btn.addEventListener("click", () => {
        if (busy) return;
        const feedback = qs("booking-feedback");
        if (isPackageService()) {
          const result = upsertPackageSelection(state.selectedDate, time);
          if (!result.ok) {
            if (feedback) feedback.textContent = t("booking.errors.packageLimit", "Для пакета выберите ровно 4 даты. Чтобы изменить, нажмите дату и выберите время заново.");
            renderSelectedInfo();
            return;
          }
          if (feedback) feedback.textContent = "";
        } else {
          state.selectedTime = time;
        }
        renderSlots();
        renderSelectedInfo();
      });
      grid.appendChild(btn);
    });
  };

  const renderSelectedInfo = () => {
    const node = qs("booking-selected");
    if (!node) return;
    if (!state.selectedService) {
      node.textContent = t("booking.chooseService", "Сначала выберите услугу.");
      return;
    }
    if (isPackageService()) {
      const selected = [...state.packageSelections].sort((a, b) => (a.date > b.date ? 1 : -1));
      if (!selected.length) {
        node.textContent = t("booking.packageHint", "Для пакета выберите 4 даты и к каждой дате время.");
        return;
      }
      const chunks = selected.map((item, index) => `${index + 1}) ${item.date} ${item.time}`);
      node.textContent = `${t("booking.packageCounter", "Выбрано встреч")}: ${selected.length}/4 | ${chunks.join(" | ")}`;
      return;
    }
    if (!state.selectedTime) {
      node.textContent = t("booking.chooseSlot", "Выберите слот для записи");
      return;
    }
    node.textContent = `${t("booking.selectedPrefix", "Вы выбрали")}: ${state.selectedDate} ${state.selectedTime}`;
  };

  const renderAll = () => {
    syncSelectedDate();
    renderMenus();
    renderDays();
    renderSlots();
    renderSelectedInfo();
  };

  const bookLocal = (payload) => {
    try {
      const raw = localStorage.getItem(BOOKED_SLOTS_KEY);
      const list = raw ? JSON.parse(raw) : [];
      const set = new Set(Array.isArray(list) ? list : []);
      const selections = Array.isArray(payload.appointments) && payload.appointments.length
        ? payload.appointments
        : [{ date: payload.date, time: payload.time }];
      const keys = selections.map((item) => `${item.date}|${item.time}`);
      if (keys.some((key) => set.has(key))) return { ok: false, conflict: true };
      keys.forEach((key) => set.add(key));
      localStorage.setItem(BOOKED_SLOTS_KEY, JSON.stringify(Array.from(set)));
      return { ok: true };
    } catch {
      return { ok: false };
    }
  };

  const submitBooking = async (payload) => {
    try {
      const response = await fetch(API_BOOK_URL, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload),
      });
      if (response.status === 409) return { ok: false, conflict: true };
      if (!response.ok) return { ok: false };
      return { ok: true };
    } catch {
      return bookLocal(payload);
    }
  };

  const isValidName = (name) => /^[A-Za-zА-Яа-яЁёІіЇїЄєҐґ][A-Za-zА-Яа-яЁёІіЇїЄєҐґ\s'-]{1,59}$/.test(name);
  const isValidEmail = (email) => /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/.test(email);
  const isValidPhone = (phone) => /^\+?\d{7,15}$/.test(phone);

  const initFieldGuards = () => {
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
  };

  const initForm = () => {
    const form = qs("booking-form");
    const feedback = qs("booking-feedback");
    if (!form || !feedback) return;

    form.addEventListener("submit", async (event) => {
      event.preventDefault();
      feedback.textContent = "";

      const name = String(qs("booking-name")?.value || "").trim();
      const email = String(qs("booking-email")?.value || "").trim();
      const phone = String(qs("booking-phone")?.value || "").trim();
      const message = String(qs("booking-message")?.value || "").trim();

      if (!state.selectedService) {
        feedback.textContent = t("booking.errors.service", "Сначала выберите услугу.");
        return;
      }
      if (!isPackageService() && !state.selectedTime) {
        feedback.textContent = t("booking.errors.time", "Сначала выберите время.");
        return;
      }
      if (isPackageService() && state.packageSelections.length !== 4) {
        feedback.textContent = t("booking.errors.packageExact", "Для пакета 4 встречи нужно выбрать ровно 4 даты и 4 времени.");
        return;
      }
      if (!isValidName(name)) {
        feedback.textContent = t("booking.errors.name", "Укажите корректное имя.");
        return;
      }
      if (!isValidEmail(email)) {
        feedback.textContent = t("booking.errors.email", "Введите корректный email.");
        return;
      }
      if (!isValidPhone(phone)) {
        feedback.textContent = t("booking.errors.phone", "Телефон: только цифры и +, 7-15.");
        return;
      }
      if (!message || message.length < 3) {
        feedback.textContent = t("booking.errors.message", "Кратко опишите запрос.");
        return;
      }

      const appointments = isPackageService()
        ? [...state.packageSelections].sort((a, b) => (a.date > b.date ? 1 : -1))
        : [{ date: state.selectedDate, time: state.selectedTime }];

      const payload = {
        date: appointments[0].date,
        time: appointments[0].time,
        appointments,
        serviceId: state.selectedService,
        serviceTitle: serviceTitle(state.selectedService),
        serviceDuration: serviceDurationLabel(state.selectedService),
        name,
        email,
        phone,
        message,
      };

      const result = await submitBooking(payload);
      if (!result.ok && result.conflict) {
        feedback.textContent = t("booking.errors.conflict", "Этот слот уже занят. Выберите другой.");
        renderAll();
        return;
      }
      if (!result.ok) {
        feedback.textContent = t("booking.errors.server", "Не удалось отправить запись. Попробуйте позже.");
        return;
      }

      feedback.textContent = t("booking.success", "Запись успешно отправлена.");
      form.reset();
      state.selectedTime = null;
      state.packageSelections = [];
      renderAll();
    });
  };

  const toggleMenu = (name) => {
    const menu = qs(`${name}-menu`);
    const trigger = qs(`${name}-trigger`);
    if (!menu || !trigger) return;
    const willOpen = menu.hidden;
    closeMenus();
    menu.hidden = !willOpen;
    trigger.setAttribute("aria-expanded", String(willOpen));
    const wrap = trigger.closest(".booking-v2-select-wrap");
    if (wrap && willOpen) wrap.classList.add("is-open");
  };

  const initEvents = () => {
    const serviceTrigger = qs("service-trigger");
    const yearTrigger = qs("year-trigger");
    const monthTrigger = qs("month-trigger");
    if (!serviceTrigger || !yearTrigger || !monthTrigger) return;

    serviceTrigger.addEventListener("click", (event) => {
      event.stopPropagation();
      toggleMenu("service");
    });
    yearTrigger.addEventListener("click", (event) => {
      event.stopPropagation();
      toggleMenu("year");
    });
    monthTrigger.addEventListener("click", (event) => {
      event.stopPropagation();
      toggleMenu("month");
    });

    document.addEventListener("click", () => closeMenus());
  };

  const getPresetService = () => {
    const fromUrl = new URLSearchParams(window.location.search).get("service");
    if (fromUrl && SERVICE_CONFIG[fromUrl]) return fromUrl;
    const fromStorage = localStorage.getItem(SELECTED_SERVICE_KEY);
    if (fromStorage && SERVICE_CONFIG[fromStorage]) return fromStorage;
    return null;
  };

  const initBooking = () => {
    const serviceTrigger = qs("service-trigger");
    const yearTrigger = qs("year-trigger");
    const monthTrigger = qs("month-trigger");
    const daysGrid = qs("days-grid");
    const slotsGrid = qs("slots-grid");
    if (!serviceTrigger || !yearTrigger || !monthTrigger || !daysGrid || !slotsGrid) return;

    const now = new Date();
    state.year = now.getFullYear();
    state.month = now.getMonth();
    state.day = now.getDate();
    state.selectedTime = null;
    state.selectedService = getPresetService();
    syncSelectedDate();

    renderAll();
    initEvents();
    initFieldGuards();
    initForm();
  };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initBooking);
  } else {
    initBooking();
  }

  document.addEventListener("languageChanged", renderAll);
})();
