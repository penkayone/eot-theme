const DEFAULT_LANG = (window.eotThemeData && window.eotThemeData.lang) || "ru";

const state = {
  lang: DEFAULT_LANG,
  dictionary: (window.eotThemeData && window.eotThemeData.i18n) || {},
  lightbox: null,
  gallery: null,
  galleryIndex: 0,
};

const getNestedValue = (obj, key) =>
  String(key)
    .split(".")
    .reduce((acc, part) => (acc && acc[part] !== undefined ? acc[part] : null), obj);

const t = (key, fallback = "") => getNestedValue(state.dictionary, key) ?? fallback;

const fetchPartial = async (selector, path) => {
  const container = document.querySelector(selector);
  if (!container || container.children.length > 0) return;
  const response = await fetch(path);
  container.innerHTML = await response.text();
};

const setActiveNav = () => {
  const currentPage = document.body.dataset.page;
  document.querySelectorAll(".nav-list a").forEach((link) => {
    const nav = link.getAttribute("data-nav");
    if (nav && nav === currentPage) {
      link.classList.add("active");
    }
  });
};

const initNavToggle = () => {
  const nav = document.querySelector(".main-nav");
  const toggle = document.querySelector(".nav-toggle");
  if (!nav || !toggle) return;
  toggle.addEventListener("click", () => {
    const isOpen = nav.classList.toggle("open");
    toggle.setAttribute("aria-expanded", String(isOpen));
  });
  nav.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
      nav.classList.remove("open");
      toggle.setAttribute("aria-expanded", "false");
    });
  });
};

const updateLangButtons = () => {
  document.querySelectorAll(".lang-btn").forEach((btn) => {
    btn.setAttribute("aria-pressed", btn.dataset.lang === state.lang ? "true" : "false");
  });
};

const initLanguageSwitcher = () => {
  updateLangButtons();
};

const buildSchema = (dictionary) => {
  const base = {
    "@context": "https://schema.org",
    "@type": "ProfessionalService",
    name: getNestedValue(dictionary, "schema.name"),
    description: getNestedValue(dictionary, "schema.description"),
    areaServed: getNestedValue(dictionary, "schema.areaServed"),
    availableLanguage: getNestedValue(dictionary, "schema.availableLanguage"),
    url: getNestedValue(dictionary, "schema.url"),
    image: getNestedValue(dictionary, "schema.image"),
    serviceType: getNestedValue(dictionary, "schema.serviceType"),
  };

  if (document.body.dataset.page === "services") {
    const offers = getNestedValue(dictionary, "schema.offers");
    if (Array.isArray(offers)) {
      base.hasOfferCatalog = {
        "@type": "OfferCatalog",
        name: getNestedValue(dictionary, "schema.offerCatalogName"),
        itemListElement: offers.map((offer) => ({
          "@type": "Offer",
          itemOffered: {
            "@type": "Service",
            name: offer.name,
            description: offer.description,
          },
          price: offer.price,
          priceCurrency: offer.currency,
        })),
      };
    }
  }

  const script = document.getElementById("schema-json");
  if (script) {
    script.textContent = JSON.stringify(base, null, 2);
  }
};

const initReveal = () => {
  const items = document.querySelectorAll("[data-reveal]");
  if (!items.length) return;

  const isSmallViewport =
    typeof window.matchMedia === "function" && window.matchMedia("(max-width: 768px)").matches;
  const prefersReducedMotion =
    typeof window.matchMedia === "function" &&
    window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  if (isSmallViewport || prefersReducedMotion) {
    return;
  }

  items.forEach((item) => item.classList.add("reveal"));
  if (!("IntersectionObserver" in window)) {
    items.forEach((item) => item.classList.add("visible"));
    return;
  }
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.15 }
  );
  items.forEach((item) => observer.observe(item));
};

const createLightbox = () => {
  const overlay = document.createElement("div");
  overlay.className = "lightbox";
  overlay.innerHTML = `
    <div class="lightbox-content" role="dialog" aria-modal="true">
      <div class="lightbox-controls">
        <button class="lightbox-nav" type="button" data-dir="prev" aria-label="${t("common.lightboxPrev", "Previous")}">←</button>
        <button class="lightbox-close" type="button" aria-label="${t("common.lightboxClose", "Close")}">✕</button>
        <button class="lightbox-nav" type="button" data-dir="next" aria-label="${t("common.lightboxNext", "Next")}">→</button>
      </div>
      <img src="" alt="" />
    </div>
  `;
  document.body.appendChild(overlay);
  return overlay;
};

const openLightbox = (items, index) => {
  if (!state.lightbox) {
    state.lightbox = createLightbox();
  }
  state.gallery = items;
  state.galleryIndex = index;
  updateLightbox();
  state.lightbox.classList.add("open");
  document.body.classList.add("no-scroll");
};

const closeLightbox = () => {
  if (!state.lightbox) return;
  state.lightbox.classList.remove("open");
  document.body.classList.remove("no-scroll");
};

const updateLightbox = () => {
  if (!state.lightbox || !state.gallery) return;
  const data = state.gallery[state.galleryIndex];
  const img = state.lightbox.querySelector("img");
  img.src = data.src;
  img.alt = data.alt || "";
};

const shiftLightbox = (delta) => {
  if (!state.gallery) return;
  state.galleryIndex = (state.galleryIndex + delta + state.gallery.length) % state.gallery.length;
  updateLightbox();
};

const initCertificatesLayout = () => {
  const certItems = document.querySelectorAll(".cert-gallery .cert-item");
  if (!certItems.length) return;

  certItems.forEach((item) => {
    const img = item.querySelector("img");
    if (!img) return;

    const applyOrientation = () => {
      const { naturalWidth, naturalHeight } = img;
      if (!naturalWidth || !naturalHeight) return;

      item.classList.remove("landscape", "portrait", "square");
      const ratio = naturalWidth / naturalHeight;

      if (ratio > 1.12) {
        item.classList.add("landscape");
      } else if (ratio < 0.9) {
        item.classList.add("portrait");
      } else {
        item.classList.add("square");
      }
    };

    if (img.complete) {
      applyOrientation();
      return;
    }

    img.addEventListener("load", applyOrientation, { once: true });
  });
};

const initLightbox = () => {
  const galleries = document.querySelectorAll(".gallery");
  if (!galleries.length) return;

  galleries.forEach((gallery) => {
    const items = Array.from(gallery.querySelectorAll(".gallery-item"));
    items.forEach((btn, index) => {
      btn.addEventListener("click", () => {
        const images = items.map((item) => {
          const img = item.querySelector("img");
          return {
            src: item.dataset.full || img.src,
            alt: img.alt,
          };
        });
        openLightbox(images, index);
      });
    });
  });

  document.addEventListener("click", (event) => {
    if (!state.lightbox || !state.lightbox.classList.contains("open")) return;
    if (event.target === state.lightbox) {
      closeLightbox();
    }
  });

  document.addEventListener("keydown", (event) => {
    if (!state.lightbox || !state.lightbox.classList.contains("open")) return;
    if (event.key === "Escape") closeLightbox();
    if (event.key === "ArrowLeft") shiftLightbox(-1);
    if (event.key === "ArrowRight") shiftLightbox(1);
  });

  document.addEventListener("click", (event) => {
    if (!state.lightbox) return;
    const closeBtn = event.target.closest(".lightbox-close");
    const navBtn = event.target.closest(".lightbox-nav");
    if (closeBtn) closeLightbox();
    if (navBtn) shiftLightbox(navBtn.dataset.dir === "next" ? 1 : -1);
  });
};

const init = async () => {
  await fetchPartial("#site-header", "partials/header.html");
  await fetchPartial("#site-footer", "partials/footer.html");

  document.documentElement.lang = state.lang;
  window.__I18N__ = state.dictionary;

  updateLangButtons();
  buildSchema(state.dictionary);
  document.dispatchEvent(new CustomEvent("languageChanged", { detail: { lang: state.lang } }));

  setActiveNav();
  initNavToggle();
  initLanguageSwitcher();
  initReveal();
  initCertificatesLayout();
  initLightbox();
  initHeroSlider();

  document.querySelectorAll("[data-year]").forEach((node) => {
    node.textContent = new Date().getFullYear();
  });
};

document.addEventListener("DOMContentLoaded", init);

const initHeroSlider = () => {
  const slider = document.querySelector("[data-slider]");
  if (!slider) return;
  const slides = Array.from(slider.querySelectorAll(".hero-slide"));
  const dots = Array.from(slider.querySelectorAll(".hero-dot"));
  const prevBtn = slider.querySelector(".hero-arrow-prev");
  const nextBtn = slider.querySelector(".hero-arrow-next");
  if (!slides.length) return;

  let index = 0;
  const setSlide = (next) => {
    slides.forEach((slide) => slide.classList.remove("active"));
    dots.forEach((dot) => dot.classList.remove("active"));
    slides[next].classList.add("active");
    dots[next].classList.add("active");
    index = next;
  };

  dots.forEach((dot, i) => {
    dot.addEventListener("click", () => setSlide(i));
  });

  if (prevBtn && nextBtn) {
    prevBtn.addEventListener("click", () => {
      const next = (index - 1 + slides.length) % slides.length;
      setSlide(next);
    });
    nextBtn.addEventListener("click", () => {
      const next = (index + 1) % slides.length;
      setSlide(next);
    });
  }

  let touchStartX = 0;
  let touchEndX = 0;
  slider.addEventListener("touchstart", (event) => {
    touchStartX = event.changedTouches[0].clientX;
  });
  slider.addEventListener("touchend", (event) => {
    touchEndX = event.changedTouches[0].clientX;
    const delta = touchEndX - touchStartX;
    if (Math.abs(delta) < 30) return;
    if (delta < 0) {
      setSlide((index + 1) % slides.length);
    } else {
      setSlide((index - 1 + slides.length) % slides.length);
    }
  });

  setInterval(() => {
    const next = (index + 1) % slides.length;
    setSlide(next);
  }, 5000);
};
