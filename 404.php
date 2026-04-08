<?php get_header(); ?>

<main>
  <section class="section">
    <div class="container" style="text-align: center;">
      <h1>404</h1>
      <p><?php echo esc_html__('Страница не найдена.', 'eot-theme'); ?></p>
      <a class="btn btn-primary" href="<?php echo esc_url(eot_localized_url('')); ?>"><?php echo esc_html__('На главную', 'eot-theme'); ?></a>
    </div>
  </section>
</main>

<?php get_footer(); ?>
