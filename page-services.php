<?php
/**
 * Template Name: Services
 */
get_header(); ?>

<main>
  <section class="section">
    <div class="container">
      <h1><?php echo esc_html(eot_t('services.title')); ?></h1>
      <p class="lead"><?php echo esc_html(eot_t('services.subtitle')); ?></p>
      <div class="grid cards-3">
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge"><?php echo esc_html(eot_t('services.items.3.duration')); ?></span>
          </div>
          <h2><?php echo esc_html(eot_t('services.items.3.title')); ?></h2>
          <p><?php echo esc_html(eot_t('services.items.3.text')); ?></p>
          <p class="price"><?php echo esc_html(eot_t('services.items.3.price')); ?></p>
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(add_query_arg('service', 'intro', eot_localized_url('contacts')) . '#booking'); ?>"><?php echo esc_html(eot_t('services.cta')); ?></a>
        </article>
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge"><?php echo esc_html(eot_t('services.items.1.duration')); ?></span>
          </div>
          <h2><?php echo esc_html(eot_t('services.items.1.title')); ?></h2>
          <p><?php echo esc_html(eot_t('services.items.1.text')); ?></p>
          <p class="price"><?php echo esc_html(eot_t('services.items.1.price')); ?></p>
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(add_query_arg('service', 'individual', eot_localized_url('contacts')) . '#booking'); ?>"><?php echo esc_html(eot_t('services.cta')); ?></a>
        </article>
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge"><?php echo esc_html(eot_t('services.items.2.duration')); ?></span>
          </div>
          <h2><?php echo esc_html(eot_t('services.items.2.title')); ?></h2>
          <p><?php echo esc_html(eot_t('services.items.2.text')); ?></p>
          <p class="price"><?php echo esc_html(eot_t('services.items.2.price')); ?></p>
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(add_query_arg('service', 'package', eot_localized_url('contacts')) . '#booking'); ?>"><?php echo esc_html(eot_t('services.cta')); ?></a>
        </article>
      </div>
      <p class="disclaimer"><?php echo esc_html(eot_t('services.disclaimer')); ?></p>
    </div>
  </section>
</main>

<?php get_footer(); ?>
