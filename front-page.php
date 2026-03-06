<?php get_header(); ?>

<main>
  <section class="hero section">
    <div class="container hero-grid">
      <div class="hero-content">
        <h1 class="hero-title" data-i18n="index.hero.title">Русскоговорящий психолог, коуч за рубежом</h1>
        <p class="hero-subtitle" data-i18n="index.hero.subtitle">
          Провокативное, психологическое консультирование и коучинг.
        </p>
        <ul class="hero-list">
          <li data-i18n="index.hero.line1">Эмоционально-образная терапия.</li>
          <li data-i18n="index.hero.line2">Гипнокоучинг.</li>
          <li data-i18n="index.hero.line3">Аромопсихология, ольфактотерапия.</li>
        </ul>
        <p class="hero-text" data-i18n="index.hero.note">
          Работаю с тревогой, самооценкой, страхом проявленности, бессонницей, фобиями, психоблоками,
          эмоциональными травмами и другими запросами.
        </p>
        <div class="badges">
          <span class="badge" data-i18n="index.hero.badge1">Конфиденциально</span>
          <span class="badge" data-i18n="index.hero.badge2">Онлайн</span>
          <span class="badge" data-i18n="index.hero.badge3">Часовые пояса</span>
        </div>
        <div class="button-row">
          <a class="btn btn-primary" href="<?php echo esc_url(home_url('/contacts/#booking')); ?>" data-i18n="index.hero.ctaPrimary">Записаться</a>
          <a class="btn btn-outline" href="https://t.me/larysamotz" data-i18n="index.hero.ctaSecondary">Отзывы</a>
        </div>
        <div class="hero-social-row">
          <a class="btn btn-social social-telegram" href="https://t.me/LaraLorein" target="_blank" rel="noopener noreferrer">
            <img class="social-icon" src="<?php echo eot_image_url('icon-telegram.svg'); ?>" alt="" aria-hidden="true" />
            <span>Telegram</span>
          </a>
          <a class="btn btn-social social-instagram" href="https://www.instagram.com/larisamomotova?utm_source=qr&igsh=ajR4dWpsMDJ2cHFw" target="_blank" rel="noopener noreferrer">
            <img class="social-icon" src="<?php echo eot_image_url('icon-instagram.svg'); ?>" alt="" aria-hidden="true" />
            <span>Instagram</span>
          </a>
          <a class="btn btn-social social-youtube" href="https://youtube.com/@larysamomotova?si=Czm1zGo4rbFc5QG-" target="_blank" rel="noopener noreferrer">
            <img class="social-icon" src="<?php echo eot_image_url('icon-youtube.svg'); ?>" alt="" aria-hidden="true" />
            <span>YouTube</span>
          </a>
          <a class="btn btn-social social-facebook" href="https://www.facebook.com/share/17xxhgL4zL/" target="_blank" rel="noopener noreferrer">
            <img class="social-icon" src="<?php echo eot_image_url('icon-facebook.svg'); ?>" alt="" aria-hidden="true" />
            <span>Facebook</span>
          </a>
        </div>
      </div>
      <div class="hero-media">
        <div class="hero-slider" data-slider>
          <div class="hero-slide active">
            <img src="<?php echo eot_image_url('hero-1.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="index.hero.imageAlt" />
          </div>
          <div class="hero-slide">
            <img src="<?php echo eot_image_url('hero-2.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="index.hero.imageAlt" />
          </div>
          <div class="hero-slide">
            <img src="<?php echo eot_image_url('hero-3.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="index.hero.imageAlt" />
          </div>
          <div class="hero-slide">
            <img src="<?php echo eot_image_url('hero-4.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="index.hero.imageAlt" />
          </div>
          <div class="hero-slide">
            <img src="<?php echo eot_image_url('hero-5.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="index.hero.imageAlt" />
          </div>
          <button class="hero-arrow hero-arrow-prev" type="button" aria-label="Назад">&#8249;</button>
          <button class="hero-arrow hero-arrow-next" type="button" aria-label="Вперёд">&#8250;</button>
          <div class="hero-dots" role="tablist" aria-label="Слайдер">
            <button class="hero-dot active" type="button" data-slide="0"></button>
            <button class="hero-dot" type="button" data-slide="1"></button>
            <button class="hero-dot" type="button" data-slide="2"></button>
            <button class="hero-dot" type="button" data-slide="3"></button>
            <button class="hero-dot" type="button" data-slide="4"></button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section soft" data-reveal>
    <div class="container">
      <h2 data-i18n="index.requests.title">С какими запросами можно прийти</h2>
      <div class="grid cards-3">
        <article class="card">
          <h3 data-i18n="index.requests.items.1.title">Тревога</h3>
          <p data-i18n="index.requests.items.1.text">Снижение внутреннего напряжения, восстановление опоры.</p>
        </article>
        <article class="card">
          <h3 data-i18n="index.requests.items.2.title">Самооценка</h3>
          <p data-i18n="index.requests.items.2.text">Укрепление самоценности и уверенности в себе.</p>
        </article>
        <article class="card">
          <h3 data-i18n="index.requests.items.3.title">Страх проявленности</h3>
          <p data-i18n="index.requests.items.3.text">Преодоление внутренних барьеров, обретение смелости заявлять о себе и своих талантах.</p>
        </article>
        <article class="card">
          <h3 data-i18n="index.requests.items.4.title">Бессонница</h3>
          <p data-i18n="index.requests.items.4.text">Работа с причинами нарушения сна, нормализация режима и обретение ночного спокойствия.</p>
        </article>
        <article class="card">
          <h3 data-i18n="index.requests.items.5.title">Психоблоки</h3>
          <p data-i18n="index.requests.items.5.text">Выявление скрытых барьеров и устранение внутренних препятствий на пути к вашим целям.</p>
        </article>
        <article class="card">
          <h3 data-i18n="index.requests.items.6.title">Эмоциональные травмы</h3>
          <p data-i18n="index.requests.items.6.text">Бережная проработка болезненного опыта и возвращение психологической целостности.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="section" data-reveal>
    <div class="container">
      <div class="section-head">
        <h2 data-i18n="index.eot.title">Что такое эмоционально-образная терапия?</h2>
        <p class="eot-description" data-i18n="index.eot.description">
          Эмоционально-образная терапия - современный и эффективный метод психологической помощи.
        </p>
      </div>
      <p class="disclaimer" data-i18n="index.eot.disclaimer">
        Эмоционально-образная терапия не является медицинской услугой и не заменяет помощь врача.
      </p>
    </div>
  </section>

  <section class="section soft" data-reveal>
    <div class="container">
      <h2 data-i18n="index.process.title">Как проходит консультация</h2>
      <div class="grid cards-4">
        <article class="card step-card">
          <span class="step-number">01</span>
          <h3 data-i18n="index.process.steps.1.title">Заявка</h3>
          <p data-i18n="index.process.steps.1.text">Вы оставляете сообщение удобным способом.</p>
        </article>
        <article class="card step-card">
          <span class="step-number">02</span>
          <h3 data-i18n="index.process.steps.2.title">Знакомство</h3>
          <p data-i18n="index.process.steps.2.text">Уточняем запрос и формат работы.</p>
        </article>
        <article class="card step-card">
          <span class="step-number">03</span>
          <h3 data-i18n="index.process.steps.3.title">Сессия</h3>
          <p data-i18n="index.process.steps.3.text">Проводим бережную онлайн-встречу.</p>
        </article>
        <article class="card step-card">
          <span class="step-number">04</span>
          <h3 data-i18n="index.process.steps.4.title">Поддержка</h3>
          <p data-i18n="index.process.steps.4.text">Даем рекомендации и план следующих шагов.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="section soft" data-reveal>
    <div class="container">
      <div class="section-head between">
        <div>
          <h2 data-i18n="index.servicesPreview.title">Услуги</h2>
          <p class="muted" data-i18n="index.servicesPreview.subtitle">
            Подберите формат, который подходит вашему запросу.
          </p>
        </div>
      </div>
      <div class="grid cards-3">
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge" data-i18n="services.items.3.duration">10–15 минут</span>
          </div>
          <h3 data-i18n="services.items.3.title">Вводная встреча</h3>
          <p data-i18n="services.items.3.text">Короткое знакомство и уточнение запроса.</p>
          <p class="price" data-i18n="services.items.3.price">&euro;0</p>
          <a class="btn btn-primary" href="<?php echo esc_url(home_url('/contacts/?service=intro#booking')); ?>" data-i18n="services.cta">Записаться</a>
        </article>
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge" data-i18n="services.items.1.duration">60 минут</span>
          </div>
          <h3 data-i18n="services.items.1.title">Индивидуальная сессия</h3>
          <p data-i18n="services.items.1.text">Разбор одного запроса с опорой на ЭОТ.</p>
          <p class="price" data-i18n="services.items.1.price">&euro;60</p>
          <a class="btn btn-primary" href="<?php echo esc_url(home_url('/contacts/?service=individual#booking')); ?>" data-i18n="services.cta">Записаться</a>
        </article>
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge" data-i18n="services.items.2.duration">4 часа</span>
          </div>
          <h3 data-i18n="services.items.2.title">Семинар возрождения внутренней силы</h3>
          <p data-i18n="services.items.2.text">Последовательная поддержка на месяц.</p>
          <p class="price" data-i18n="services.items.2.price">&euro;220</p>
          <a class="btn btn-primary" href="<?php echo esc_url(home_url('/contacts/?service=package#booking')); ?>" data-i18n="services.cta">Записаться</a>
        </article>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
