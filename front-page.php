<?php get_header(); ?>

<main>
  <section class="hero section">
    <div class="container hero-grid">
      <div class="hero-content">
        <h1 class="hero-title"><?php echo esc_html(eot_t('index.hero.title')); ?></h1>
        <p class="hero-subtitle"><?php echo esc_html(eot_t('index.hero.subtitle')); ?></p>
        <ul class="hero-list">
          <li><?php echo esc_html(eot_t('index.hero.line1')); ?></li>
          <li><?php echo esc_html(eot_t('index.hero.line2')); ?></li>
          <li><?php echo esc_html(eot_t('index.hero.line3')); ?></li>
        </ul>
        <p class="hero-text"><?php echo esc_html(eot_t('index.hero.note')); ?></p>
        <div class="badges">
          <span class="badge"><?php echo esc_html(eot_t('index.hero.badge1')); ?></span>
          <span class="badge"><?php echo esc_html(eot_t('index.hero.badge2')); ?></span>
          <span class="badge"><?php echo esc_html(eot_t('index.hero.badge3')); ?></span>
        </div>
        <div class="button-row">
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(eot_localized_url('contacts') . '#booking'); ?>"><?php echo esc_html(eot_t('index.hero.ctaPrimary')); ?></a>
          <a class="btn btn-outline" href="https://t.me/larysamotz"><?php echo esc_html(eot_t('index.hero.ctaSecondary')); ?></a>
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
            <img src="<?php echo eot_image_url('hero-1.jpg'); ?>" alt="<?php echo esc_attr(eot_t('index.hero.imageAlt')); ?>" />
          </div>
          <div class="hero-slide">
            <img src="<?php echo eot_image_url('hero-2.jpg'); ?>" alt="<?php echo esc_attr(eot_t('index.hero.imageAlt')); ?>" />
          </div>
          <div class="hero-slide">
            <img src="<?php echo eot_image_url('hero-3.jpg'); ?>" alt="<?php echo esc_attr(eot_t('index.hero.imageAlt')); ?>" />
          </div>
          <div class="hero-slide">
            <img src="<?php echo eot_image_url('hero-4.jpg'); ?>" alt="<?php echo esc_attr(eot_t('index.hero.imageAlt')); ?>" />
          </div>
          <div class="hero-slide">
            <img src="<?php echo eot_image_url('hero-5.jpg'); ?>" alt="<?php echo esc_attr(eot_t('index.hero.imageAlt')); ?>" />
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
      <h2><?php echo esc_html(eot_t('index.requests.title')); ?></h2>
      <div class="grid cards-3">
        <article class="card">
          <h3><?php echo esc_html(eot_t('index.requests.items.1.title')); ?></h3>
          <p><?php echo esc_html(eot_t('index.requests.items.1.text')); ?></p>
        </article>
        <article class="card">
          <h3><?php echo esc_html(eot_t('index.requests.items.2.title')); ?></h3>
          <p><?php echo esc_html(eot_t('index.requests.items.2.text')); ?></p>
        </article>
        <article class="card">
          <h3><?php echo esc_html(eot_t('index.requests.items.3.title')); ?></h3>
          <p><?php echo esc_html(eot_t('index.requests.items.3.text')); ?></p>
        </article>
        <article class="card">
          <h3><?php echo esc_html(eot_t('index.requests.items.4.title')); ?></h3>
          <p><?php echo esc_html(eot_t('index.requests.items.4.text')); ?></p>
        </article>
        <article class="card">
          <h3><?php echo esc_html(eot_t('index.requests.items.5.title')); ?></h3>
          <p><?php echo esc_html(eot_t('index.requests.items.5.text')); ?></p>
        </article>
        <article class="card">
          <h3><?php echo esc_html(eot_t('index.requests.items.6.title')); ?></h3>
          <p><?php echo esc_html(eot_t('index.requests.items.6.text')); ?></p>
        </article>
      </div>
    </div>
  </section>

  <section class="section" data-reveal>
    <div class="container">
      <h2><?php echo esc_html(eot_t('index.eot.title')); ?></h2>
      <div class="grid cards-3 eot-cards">
        <article class="card step-card">
          <p><?php echo esc_html(eot_t('index.eot.steps.1.text')); ?></p>
        </article>
        <article class="card step-card">
          <p><?php echo esc_html(eot_t('index.eot.steps.2.text')); ?></p>
        </article>
        <article class="card step-card">
          <p><?php echo esc_html(eot_t('index.eot.steps.3.text')); ?></p>
        </article>
      </div>
    </div>
  </section>

  <section class="section soft" data-reveal>
    <div class="container">
      <h2><?php echo esc_html(eot_t('index.process.title')); ?></h2>
      <div class="grid cards-4">
        <article class="card step-card">
          <span class="step-number">01</span>
          <h3><?php echo esc_html(eot_t('index.process.steps.1.title')); ?></h3>
          <p><?php echo esc_html(eot_t('index.process.steps.1.text')); ?></p>
        </article>
        <article class="card step-card">
          <span class="step-number">02</span>
          <h3><?php echo esc_html(eot_t('index.process.steps.2.title')); ?></h3>
          <p><?php echo esc_html(eot_t('index.process.steps.2.text')); ?></p>
        </article>
        <article class="card step-card">
          <span class="step-number">03</span>
          <h3><?php echo esc_html(eot_t('index.process.steps.3.title')); ?></h3>
          <p><?php echo esc_html(eot_t('index.process.steps.3.text')); ?></p>
        </article>
        <article class="card step-card">
          <span class="step-number">04</span>
          <h3><?php echo esc_html(eot_t('index.process.steps.4.title')); ?></h3>
          <p><?php echo wp_kses_post(eot_t('index.process.steps.4.text')); ?></p>
        </article>
      </div>
    </div>
  </section>

  <section class="section soft" data-reveal>
    <div class="container">
      <div class="section-head between">
        <div>
          <h2><?php echo esc_html(eot_t('index.servicesPreview.title')); ?></h2>
          <p class="muted"><?php echo esc_html(eot_t('index.servicesPreview.subtitle')); ?></p>
        </div>
      </div>
      <div class="grid cards-3">
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge"><?php echo esc_html(eot_t('services.items.3.duration')); ?></span>
          </div>
          <h3><?php echo esc_html(eot_t('services.items.3.title')); ?></h3>
          <p><?php echo esc_html(eot_t('services.items.3.text')); ?></p>
          <p class="price"><?php echo esc_html(eot_t('services.items.3.price')); ?></p>
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(add_query_arg('service', 'intro', eot_localized_url('contacts')) . '#booking'); ?>"><?php echo esc_html(eot_t('services.cta')); ?></a>
        </article>
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge"><?php echo esc_html(eot_t('services.items.1.duration')); ?></span>
          </div>
          <h3><?php echo esc_html(eot_t('services.items.1.title')); ?></h3>
          <p><?php echo esc_html(eot_t('services.items.1.text')); ?></p>
          <p class="price"><?php echo esc_html(eot_t('services.items.1.price')); ?></p>
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(add_query_arg('service', 'individual', eot_localized_url('contacts')) . '#booking'); ?>"><?php echo esc_html(eot_t('services.cta')); ?></a>
        </article>
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge"><?php echo esc_html(eot_t('services.items.2.duration')); ?></span>
          </div>
          <h3><?php echo esc_html(eot_t('services.items.2.title')); ?></h3>
          <p><?php echo esc_html(eot_t('services.items.2.text')); ?></p>
          <p class="price"><?php echo esc_html(eot_t('services.items.2.price')); ?></p>
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(add_query_arg('service', 'package', eot_localized_url('contacts')) . '#booking'); ?>"><?php echo esc_html(eot_t('services.cta')); ?></a>
        </article>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
