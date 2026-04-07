<?php get_header(); ?>

<main>
  <section class="section">
    <div class="container" style="text-align: center;">
      <h1>404</h1>
      <p><?php echo esc_html(eot_t('error.notFound')); ?></p>
      <a class="btn btn-primary" href="<?php echo esc_url(eot_localized_url('')); ?>"><?php echo esc_html(eot_t('error.backHome')); ?></a>
    </div>
  </section>
</main>

<?php get_footer(); ?>
