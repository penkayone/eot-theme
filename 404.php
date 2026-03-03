<?php get_header(); ?>

<main>
  <section class="section">
    <div class="container" style="text-align: center;">
      <h1>404</h1>
      <p data-i18n="error.notFound">Страница не найдена.</p>
      <a class="btn btn-primary" href="<?php echo esc_url(home_url('/')); ?>" data-i18n="error.backHome">На главную</a>
    </div>
  </section>
</main>

<?php get_footer(); ?>
