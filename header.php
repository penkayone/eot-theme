<?php
if (!defined('ABSPATH')) exit;

$eot_page = eot_page_key_from_context();
$eot_lang = eot_get_current_lang();
$eot_current_url = eot_localized_current_url();
$eot_ru_url = eot_localized_current_url('ru', true);
$eot_sk_url = eot_localized_current_url('sk', true);
$eot_meta_description = eot_get_meta_value('description', $eot_lang, $eot_page);
$eot_meta_og_title = eot_get_meta_value('ogTitle', $eot_lang, $eot_page);
$eot_meta_og_description = eot_get_meta_value('ogDescription', $eot_lang, $eot_page);
$eot_meta_twitter_title = eot_get_meta_value('twitterTitle', $eot_lang, $eot_page);
$eot_meta_twitter_description = eot_get_meta_value('twitterDescription', $eot_lang, $eot_page);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="<?php echo esc_attr((string) $eot_meta_description); ?>" />
  <meta property="og:title" content="<?php echo esc_attr((string) $eot_meta_og_title); ?>" />
  <meta property="og:description" content="<?php echo esc_attr((string) $eot_meta_og_description); ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="<?php echo esc_url($eot_current_url); ?>" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?php echo esc_attr((string) $eot_meta_twitter_title); ?>" />
  <meta name="twitter:description" content="<?php echo esc_attr((string) $eot_meta_twitter_description); ?>" />
  <?php eot_print_canonical_tag(); ?>
  <?php eot_print_hreflang_tags(); ?>
  <?php wp_head(); ?>
</head>
<body data-page="<?php echo esc_attr($eot_page); ?>" <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
  <div class="container header-inner">
    <a class="brand" href="<?php echo esc_url(eot_localized_url('', $eot_lang)); ?>" aria-label="<?php echo esc_attr(eot_t('common.brandAria')); ?>">
      <span class="brand-mark" aria-hidden="true"></span>
      <span class="brand-text"><?php echo esc_html(eot_t('common.brand')); ?></span>
    </a>
    <nav class="main-nav" aria-label="<?php echo esc_attr(eot_t('common.navAria')); ?>">
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="nav-list">
        <span class="sr-only"><?php echo esc_html(eot_t('common.menu')); ?></span>
        <span class="nav-toggle-line" aria-hidden="true"></span>
        <span class="nav-toggle-line" aria-hidden="true"></span>
        <span class="nav-toggle-line" aria-hidden="true"></span>
      </button>
      <ul class="nav-list" id="nav-list">
        <li><a href="<?php echo esc_url(eot_localized_url('', $eot_lang)); ?>" data-nav="index"><?php echo esc_html(eot_t('nav.home')); ?></a></li>
        <li><a href="<?php echo esc_url(eot_localized_url('about', $eot_lang)); ?>" data-nav="about"><?php echo esc_html(eot_t('nav.about')); ?></a></li>
        <li><a href="<?php echo esc_url(eot_localized_url('services', $eot_lang)); ?>" data-nav="services"><?php echo esc_html(eot_t('nav.services')); ?></a></li>
        <li><a href="<?php echo esc_url(eot_localized_url('contacts', $eot_lang)); ?>" data-nav="contacts"><?php echo esc_html(eot_t('nav.contacts')); ?></a></li>
      </ul>
    </nav>
    <div class="lang-switch" role="group" aria-label="<?php echo esc_attr(eot_t('common.langAria')); ?>">
      <a class="lang-btn" href="<?php echo esc_url($eot_ru_url); ?>" data-lang="ru" aria-pressed="<?php echo $eot_lang === 'ru' ? 'true' : 'false'; ?>">RU</a>
      <a class="lang-btn" href="<?php echo esc_url($eot_sk_url); ?>" data-lang="sk" aria-pressed="<?php echo $eot_lang === 'sk' ? 'true' : 'false'; ?>">SK</a>
    </div>
  </div>
</header>
