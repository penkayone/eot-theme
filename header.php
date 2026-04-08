<?php
if (!defined('ABSPATH')) exit;

$eot_page = eot_page_key_from_context();
$eot_lang = eot_get_current_lang();
$eot_current_url = eot_localized_current_url();
$eot_languages = eot_get_language_switcher_items();
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
    <a class="brand" href="<?php echo esc_url(eot_localized_url('', $eot_lang)); ?>" aria-label="<?php echo esc_attr__('ЭОТ психолог', 'eot-theme'); ?>">
      <span class="brand-mark" aria-hidden="true"></span>
      <span class="brand-text"><?php echo esc_html__('ЭОТ Онлайн', 'eot-theme'); ?></span>
    </a>
    <nav class="main-nav" aria-label="<?php echo esc_attr__('Основное меню', 'eot-theme'); ?>">
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="nav-list">
        <span class="sr-only"><?php echo esc_html__('Меню', 'eot-theme'); ?></span>
        <span class="nav-toggle-line" aria-hidden="true"></span>
        <span class="nav-toggle-line" aria-hidden="true"></span>
        <span class="nav-toggle-line" aria-hidden="true"></span>
      </button>
      <ul class="nav-list" id="nav-list">
        <li><a href="<?php echo esc_url(eot_localized_url('', $eot_lang)); ?>" data-nav="index"><?php echo esc_html__('Главная', 'eot-theme'); ?></a></li>
        <li><a href="<?php echo esc_url(eot_localized_url('about', $eot_lang)); ?>" data-nav="about"><?php echo esc_html__('Обо мне', 'eot-theme'); ?></a></li>
        <li><a href="<?php echo esc_url(eot_localized_url('services', $eot_lang)); ?>" data-nav="services"><?php echo esc_html__('Услуги', 'eot-theme'); ?></a></li>
        <li><a href="<?php echo esc_url(eot_localized_url('contacts', $eot_lang)); ?>" data-nav="contacts"><?php echo esc_html__('Запись', 'eot-theme'); ?></a></li>
      </ul>
    </nav>
    <div class="lang-switch" role="group" aria-label="<?php echo esc_attr__('Выбор языка', 'eot-theme'); ?>">
      <?php foreach (eot_get_supported_languages() as $language_slug) :
        $language = $eot_languages[$language_slug] ?? [
          'slug' => $language_slug,
          'name' => strtoupper($language_slug),
          'url' => eot_localized_current_url($language_slug, true),
          'current' => $language_slug === $eot_lang,
        ];
        ?>
        <a class="lang-btn" href="<?php echo esc_url($language['url']); ?>" data-lang="<?php echo esc_attr($language_slug); ?>" aria-pressed="<?php echo !empty($language['current']) ? 'true' : 'false'; ?>">
          <?php echo esc_html($language['name']); ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</header>
