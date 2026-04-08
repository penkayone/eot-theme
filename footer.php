<?php if (!defined('ABSPATH')) exit; ?>

<footer class="site-footer">
  <div class="container footer-inner">
    <div class="footer-brand">
      <div class="brand-line">
        <span class="brand-mark" aria-hidden="true"></span>
        <span class="brand-text"><?php echo esc_html__('ЭОТ Онлайн', 'eot-theme'); ?></span>
      </div>
      <p class="muted"><?php echo esc_html__('Бережная психологическая поддержка для русскоязычных за границей.', 'eot-theme'); ?></p>
    </div>
    <div class="footer-links">
      <a href="<?php echo esc_url(eot_localized_url('about')); ?>"><?php echo esc_html__('Обо мне', 'eot-theme'); ?></a>
      <a href="<?php echo esc_url(eot_localized_url('services')); ?>"><?php echo esc_html__('Услуги', 'eot-theme'); ?></a>
      <a href="<?php echo esc_url(eot_localized_url('contacts') . '#booking'); ?>"><?php echo esc_html__('Запись', 'eot-theme'); ?></a>
    </div>
    <div class="footer-meta">
      <p class="small"><?php echo esc_html__('Информация на сайте носит ознакомительный характер и не заменяет медицинскую помощь.', 'eot-theme'); ?></p>
      <p class="small">&copy; <span data-year><?php echo esc_html(date('Y')); ?></span> <span><?php echo esc_html__('ЭОТ Онлайн', 'eot-theme'); ?></span></p>
    </div>
  </div>
</footer>

<script type="application/ld+json" id="schema-json"></script>
<?php wp_footer(); ?>
</body>
</html>
