<?php if (!defined('ABSPATH')) exit; ?>

<footer class="site-footer">
  <div class="container footer-inner">
    <div class="footer-brand">
      <div class="brand-line">
        <span class="brand-mark" aria-hidden="true"></span>
        <span class="brand-text" data-i18n="common.brand">EOT Online</span>
      </div>
      <p class="muted" data-i18n="footer.note">
        Caring psychological support for Russian-speakers abroad.
      </p>
    </div>
    <div class="footer-links">
      <a href="<?php echo esc_url(home_url('/about/')); ?>" data-i18n="nav.about">About</a>
      <a href="<?php echo esc_url(home_url('/services/')); ?>" data-i18n="nav.services">Services</a>
      <a href="<?php echo esc_url(home_url('/contacts/#booking')); ?>" data-i18n="nav.contacts">Contacts</a>
    </div>
    <div class="footer-meta">
      <p class="small" data-i18n="footer.disclaimer">
        The information on this website is for informational purposes only and does not replace medical care.
      </p>
      <p class="small">&copy; <span data-year><?php echo esc_html(date('Y')); ?></span> <span data-i18n="common.brand">EOT Online</span></p>
    </div>
  </div>
</footer>

<script type="application/ld+json" id="schema-json"></script>
<?php wp_footer(); ?>
</body>
</html>
