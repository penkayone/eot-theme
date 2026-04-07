<?php if (!defined('ABSPATH')) exit; ?>

<footer class="site-footer">
  <div class="container footer-inner">
    <div class="footer-brand">
      <div class="brand-line">
        <span class="brand-mark" aria-hidden="true"></span>
        <span class="brand-text"><?php echo esc_html(eot_t('common.brand')); ?></span>
      </div>
      <p class="muted"><?php echo esc_html(eot_t('footer.note')); ?></p>
    </div>
    <div class="footer-links">
      <a href="<?php echo esc_url(eot_localized_url('about')); ?>"><?php echo esc_html(eot_t('nav.about')); ?></a>
      <a href="<?php echo esc_url(eot_localized_url('services')); ?>"><?php echo esc_html(eot_t('nav.services')); ?></a>
      <a href="<?php echo esc_url(eot_localized_url('contacts') . '#booking'); ?>"><?php echo esc_html(eot_t('nav.contacts')); ?></a>
    </div>
    <div class="footer-meta">
      <p class="small"><?php echo esc_html(eot_t('footer.disclaimer')); ?></p>
      <p class="small">&copy; <span data-year><?php echo esc_html(date('Y')); ?></span> <span><?php echo esc_html(eot_t('common.brand')); ?></span></p>
    </div>
  </div>
</footer>

<script type="application/ld+json" id="schema-json"></script>
<?php wp_footer(); ?>
</body>
</html>
