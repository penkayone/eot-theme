<?php
/**
 * Template Name: Services
 */
get_header(); ?>

<main>
  <section class="section">
    <div class="container">
      <h1><?php echo esc_html(eot_translate('Услуги')); ?></h1>
      <p class="lead"><?php echo esc_html(eot_translate('Форматы работы под ваш запрос и график, без медицинских обещаний.')); ?></p>
      <div class="grid cards-3">
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge"><?php echo esc_html(eot_translate('30 минут')); ?></span>
          </div>
          <h2><?php echo esc_html(eot_translate('Вводная встреча')); ?></h2>
          <p><?php echo esc_html(eot_translate('Короткое знакомство и уточнение запроса.')); ?></p>
          <p class="price"><?php echo esc_html(eot_translate('€0')); ?></p>
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(add_query_arg('service', 'intro', eot_localized_url('contacts')) . '#booking'); ?>"><?php echo esc_html(eot_translate('Записаться')); ?></a>
        </article>
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge"><?php echo esc_html(eot_translate('60–90 минут')); ?></span>
          </div>
          <h2><?php echo esc_html(eot_translate('Индивидуальная сессия')); ?></h2>
          <p><?php echo esc_html(eot_translate('Разбор одного запроса с опорой на ЭОТ.')); ?></p>
          <p class="price"><?php echo esc_html(eot_translate('€60')); ?></p>
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(add_query_arg('service', 'individual', eot_localized_url('contacts')) . '#booking'); ?>"><?php echo esc_html(eot_translate('Записаться')); ?></a>
        </article>
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge"><?php echo esc_html(eot_translate('4 часа')); ?></span>
          </div>
          <h2><?php echo esc_html(eot_translate('Семинар возрождения внутренней силы')); ?></h2>
          <p><?php echo esc_html(eot_translate('Тренировка практических навыков саморегуляции и снятия психоблоков. Индивидуальная и групповая работа в течение месяца. Две личных встречи. Три групповых сессии. Теоретические лекции в записи.')); ?></p>
          <p class="price"><?php echo esc_html(eot_translate('€300')); ?></p>
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(add_query_arg('service', 'package', eot_localized_url('contacts')) . '#booking'); ?>"><?php echo esc_html(eot_translate('Записаться')); ?></a>
        </article>
      </div>
      <p class="disclaimer"><?php echo esc_html(eot_translate('Психологическая помощь не является медицинской услугой.')); ?></p>
    </div>
  </section>
</main>

<?php get_footer(); ?>
