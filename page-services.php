<?php
/**
 * Template Name: Services
 */
get_header(); ?>

<main>
  <section class="section">
    <div class="container">
      <h1 data-i18n="services.title">Услуги</h1>
      <p class="lead" data-i18n="services.subtitle">
        Форматы работы под ваш запрос и график, без медицинских обещаний.
      </p>
      <div class="grid cards-3">
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge" data-i18n="services.items.3.duration">10–15 минут</span>
          </div>
          <h2 data-i18n="services.items.3.title">Вводная встреча</h2>
          <p data-i18n="services.items.3.text">Короткое знакомство и уточнение запроса.</p>
          <p class="price" data-i18n="services.items.3.price">&euro;0</p>
          <a class="btn btn-primary" href="<?php echo esc_url(home_url('/contacts/?service=intro#booking')); ?>" data-i18n="services.cta">Записаться</a>
        </article>
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge" data-i18n="services.items.1.duration">60 минут</span>
          </div>
          <h2 data-i18n="services.items.1.title">Индивидуальная сессия</h2>
          <p data-i18n="services.items.1.text">Разбор одного запроса с опорой на ЭОТ.</p>
          <p class="price" data-i18n="services.items.1.price">&euro;60</p>
          <a class="btn btn-primary" href="<?php echo esc_url(home_url('/contacts/?service=individual#booking')); ?>" data-i18n="services.cta">Записаться</a>
        </article>
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge" data-i18n="services.items.2.duration">4 часа</span>
          </div>
          <h2 data-i18n="services.items.2.title">Семинар возрождения внутренней силы</h2>
          <p data-i18n="services.items.2.text">Последовательная поддержка на месяц.</p>
          <p class="price" data-i18n="services.items.2.price">&euro;220</p>
          <a class="btn btn-primary" href="<?php echo esc_url(home_url('/contacts/?service=package#booking')); ?>" data-i18n="services.cta">Записаться</a>
        </article>
      </div>
      <p class="disclaimer" data-i18n="services.disclaimer">
        Психологическая помощь не является медицинской услугой.
      </p>
    </div>
  </section>
</main>

<?php get_footer(); ?>
