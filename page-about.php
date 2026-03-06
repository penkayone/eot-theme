<?php
/**
 * Template Name: About
 */
get_header(); ?>

<main>
  <section class="section">
    <div class="container">
      <h1 data-i18n="about.title">Обо мне</h1>
      <div class="grid two-columns">
        <article class="card">
          <h2 data-i18n="about.bio.title">Био</h2>
          <p data-i18n="about.bio.text">
            Я — психолог и практик ЭОТ, работаю онлайн с русскоязычными клиентами за границей.
          </p>
        </article>
        <article class="card">
          <h2 data-i18n="about.approach.title">Подход</h2>
          <p data-i18n="about.approach.text">
            Бережный, структурированный процесс с опорой на внутренние ресурсы клиента.
          </p>
        </article>
        <article class="card">
          <h2 data-i18n="about.experience.title">Опыт</h2>
          <p data-i18n="about.experience.text">
            Регулярная практика, профессиональные супервизии и обучение.
          </p>
        </article>
        <article class="card">
          <h2 data-i18n="about.ethics.title">Этика</h2>
          <p data-i18n="about.ethics.text">
            Конфиденциальность, уважение границ и экологичное сопровождение.
          </p>
        </article>
      </div>
    </div>
  </section>

  <section class="section soft" data-reveal>
    <div class="container">
      <div class="section-head">
        <h2 data-i18n="about.certs.title">Сертификаты</h2>
        <p class="muted" data-i18n="about.certs.subtitle">Подтверждение обучения и повышения квалификации.</p>
      </div>
      <div class="cert-sections">
        <div class="cert-group">
          <div class="gallery grid cert-grid cert-gallery" data-gallery="certs-main">
            <button class="gallery-item cert-item landscape" type="button" data-full="<?php echo eot_image_url('cert-1.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-1.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.1.alt" />
            </button>
            <button class="gallery-item cert-item landscape" type="button" data-full="<?php echo eot_image_url('cert-2.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-2.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.2.alt" />
            </button>
            <button class="gallery-item cert-item landscape" type="button" data-full="<?php echo eot_image_url('cert-3.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-3.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.3.alt" />
            </button>
            <button class="gallery-item cert-item landscape" type="button" data-full="<?php echo eot_image_url('cert-4.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-4.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.4.alt" />
            </button>
            <button class="gallery-item cert-item landscape" type="button" data-full="<?php echo eot_image_url('cert-5.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-5.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.5.alt" />
            </button>
          </div>
        </div>
        <div class="cert-group">
          <div class="gallery grid cert-grid cert-gallery cert-gallery-appendix" data-gallery="certs-appendix">
            <button class="gallery-item cert-item portrait" type="button" data-full="<?php echo eot_image_url('cert-6.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-6.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.6.alt" />
            </button>
            <button class="gallery-item cert-item portrait" type="button" data-full="<?php echo eot_image_url('cert-7.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-7.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.7.alt" />
            </button>
            <button class="gallery-item cert-item portrait" type="button" data-full="<?php echo eot_image_url('cert-8.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-8.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.8.alt" />
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section" data-reveal>
    <div class="container">
      <div class="section-head">
        <h2 data-i18n="about.art.title">Картины</h2>
        <p class="muted" data-i18n="about.art.subtitle">
          Творчество помогает мне сохранять внутренний баланс и вдохновение.
        </p>
      </div>
      <div class="gallery grid cards-3" data-gallery="art">
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-1.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-1.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.art.items.1.alt" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-2.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-2.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.art.items.2.alt" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-3.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-3.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.art.items.3.alt" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-4.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-4.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.art.items.4.alt" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-5.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-5.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.art.items.5.alt" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-6.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-6.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.art.items.6.alt" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-7.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-7.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.art.items.7.alt" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-8.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-8.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.art.items.8.alt" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-9.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-9.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.art.items.9.alt" />
        </button>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
