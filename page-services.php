<?php
/**
 * Template Name: Services
 */
get_header(); ?>

<main>
  <section class="section">
    <div class="container">
      <h1><?php echo esc_html__('Услуги', 'eot-theme'); ?></h1>
      <p class="lead"><?php echo esc_html__('Форматы работы под ваш запрос и график, без медицинских обещаний.', 'eot-theme'); ?></p>
      <div class="grid cards-3">
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge"><?php echo esc_html__('30 минут', 'eot-theme'); ?></span>
          </div>
          <h2><?php echo esc_html__('Вводная встреча', 'eot-theme'); ?></h2>
          <p><?php echo esc_html__('Короткое знакомство и уточнение запроса.', 'eot-theme'); ?></p>
          <p class="price"><?php echo esc_html__('€0', 'eot-theme'); ?></p>
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(add_query_arg('service', 'intro', eot_localized_url('contacts')) . '#booking'); ?>"><?php echo esc_html__('Записаться', 'eot-theme'); ?></a>
        </article>
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge"><?php echo esc_html__('60–90 минут', 'eot-theme'); ?></span>
          </div>
          <h2><?php echo esc_html__('Индивидуальная сессия', 'eot-theme'); ?></h2>
          <p><?php echo esc_html__('Разбор одного запроса с опорой на ЭОТ.', 'eot-theme'); ?></p>
          <p class="price"><?php echo esc_html__('€60', 'eot-theme'); ?></p>
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(add_query_arg('service', 'individual', eot_localized_url('contacts')) . '#booking'); ?>"><?php echo esc_html__('Записаться', 'eot-theme'); ?></a>
        </article>
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge"><?php echo esc_html__('4 часа', 'eot-theme'); ?></span>
          </div>
          <h2><?php echo esc_html__('Семинар возрождения внутренней силы', 'eot-theme'); ?></h2>
          <p><?php echo esc_html__('Тренировка практических навыков саморегуляции и снятия психоблоков. Индивидуальная и групповая работа в течение месяца. Две личных встречи. Три групповых сессии. Теоретические лекции в записи.', 'eot-theme'); ?></p>
          <p class="price"><?php echo esc_html__('€300', 'eot-theme'); ?></p>
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(add_query_arg('service', 'package', eot_localized_url('contacts')) . '#booking'); ?>"><?php echo esc_html__('Записаться', 'eot-theme'); ?></a>
        </article>
      </div>
      <p class="disclaimer"><?php echo esc_html__('Психологическая помощь не является медицинской услугой.', 'eot-theme'); ?></p>
    </div>
  </section>
</main>

<?php get_footer(); ?>
