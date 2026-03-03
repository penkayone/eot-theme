<?php
if (!defined('ABSPATH')) exit;

$eot_page = 'index';
if (is_page()) {
    $slug = get_post_field('post_name', get_post());
    $map = ['about' => 'about', 'services' => 'services', 'contacts' => 'contacts'];
    if (isset($map[$slug])) {
        $eot_page = $map[$slug];
    }
} elseif (is_front_page()) {
    $eot_page = 'index';
} elseif (is_404()) {
    $eot_page = '404';
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta
    name="description"
    content=""
    data-i18n-attr="content"
    data-i18n="meta.<?php echo esc_attr($eot_page); ?>.description"
  />
  <meta property="og:title" content="" data-i18n-attr="content" data-i18n="meta.<?php echo esc_attr($eot_page); ?>.ogTitle" />
  <meta property="og:description" content="" data-i18n-attr="content" data-i18n="meta.<?php echo esc_attr($eot_page); ?>.ogDescription" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="" data-i18n-attr="content" data-i18n="meta.<?php echo esc_attr($eot_page); ?>.ogUrl" />
  <meta property="og:image" content="" data-i18n-attr="content" data-i18n="meta.ogImage" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="" data-i18n-attr="content" data-i18n="meta.<?php echo esc_attr($eot_page); ?>.twitterTitle" />
  <meta name="twitter:description" content="" data-i18n-attr="content" data-i18n="meta.<?php echo esc_attr($eot_page); ?>.twitterDescription" />
  <meta name="twitter:image" content="" data-i18n-attr="content" data-i18n="meta.ogImage" />
  <?php wp_head(); ?>
</head>
<body data-page="<?php echo esc_attr($eot_page); ?>" <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
  <div class="container header-inner">
    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="" data-i18n-attr="aria-label" data-i18n="common.brandAria">
      <span class="brand-mark" aria-hidden="true"></span>
      <span class="brand-text" data-i18n="common.brand">EOT Online</span>
    </a>
    <nav class="main-nav" aria-label="" data-i18n-attr="aria-label" data-i18n="common.navAria">
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="nav-list">
        <span class="sr-only" data-i18n="common.menu">Menu</span>
        <span class="nav-toggle-line" aria-hidden="true"></span>
        <span class="nav-toggle-line" aria-hidden="true"></span>
        <span class="nav-toggle-line" aria-hidden="true"></span>
      </button>
      <ul class="nav-list" id="nav-list">
        <li><a href="<?php echo esc_url(home_url('/')); ?>" data-nav="index" data-i18n="nav.home">Home</a></li>
        <li><a href="<?php echo esc_url(home_url('/about/')); ?>" data-nav="about" data-i18n="nav.about">About</a></li>
        <li><a href="<?php echo esc_url(home_url('/services/')); ?>" data-nav="services" data-i18n="nav.services">Services</a></li>
        <li><a href="<?php echo esc_url(home_url('/contacts/')); ?>" data-nav="contacts" data-i18n="nav.contacts">Contacts</a></li>
      </ul>
    </nav>
    <div class="lang-switch" role="group" aria-label="" data-i18n-attr="aria-label" data-i18n="common.langAria">
      <button class="lang-btn" type="button" data-lang="ru" aria-pressed="true">RU</button>
      <button class="lang-btn" type="button" data-lang="sk" aria-pressed="false">SK</button>
    </div>
  </div>
</header>
