<?php

if (!defined('ABSPATH')) {
    exit;
}

function eot_get_supported_languages() {
    return ['ru', 'sk'];
}

function eot_get_default_language() {
    return 'ru';
}

function eot_is_supported_language($lang) {
    return in_array($lang, eot_get_supported_languages(), true);
}

function eot_normalize_language($lang) {
    $lang = strtolower((string) $lang);

    return eot_is_supported_language($lang) ? $lang : eot_get_default_language();
}

function eot_get_current_lang() {
    $lang = get_query_var('eot_lang');

    if (!$lang && isset($_GET['lang'])) {
        $lang = sanitize_key(wp_unslash($_GET['lang']));
    }

    return eot_normalize_language($lang);
}

function eot_is_sk_request() {
    return eot_get_current_lang() === 'sk';
}

function eot_get_current_relative_path() {
    global $wp;

    $path = isset($wp->request) ? (string) $wp->request : '';
    $path = trim($path, '/');

    if (strpos($path, 'sk/') === 0) {
        $path = substr($path, 3);
    } elseif ($path === 'sk') {
        $path = '';
    }

    return $path;
}

function eot_localized_url($path = '', $lang = null) {
    $lang = eot_normalize_language($lang ?: eot_get_current_lang());
    $path = trim((string) $path, '/');
    $url_path = $path === '' ? '/' : '/' . $path . '/';

    if ($lang === 'sk') {
        $url_path = $path === '' ? '/sk/' : '/sk/' . $path . '/';
    }

    return home_url($url_path);
}

function eot_localized_current_url($lang = null, $include_query = false) {
    $lang = eot_normalize_language($lang ?: eot_get_current_lang());
    $url = eot_localized_url(eot_get_current_relative_path(), $lang);

    if ($include_query && !empty($_GET)) {
        $url = add_query_arg(wp_unslash($_GET), $url);
    }

    return $url;
}

function eot_get_hreflang_map() {
    return [
        'ru' => eot_localized_current_url('ru'),
        'sk' => eot_localized_current_url('sk'),
        'x-default' => eot_localized_current_url('ru'),
    ];
}

function eot_page_key_from_context() {
    if (is_front_page() || get_query_var('eot_front_page')) {
        return 'index';
    }

    if (is_page()) {
        $slug = get_post_field('post_name', get_post());
        $map = ['about' => 'about', 'services' => 'services', 'contacts' => 'contacts'];

        if (isset($map[$slug])) {
            return $map[$slug];
        }
    }

    if (is_404()) {
        return '404';
    }

    return 'index';
}

function eot_get_i18n_dictionary($lang = null) {
    static $cache = [];

    $lang = eot_normalize_language($lang ?: eot_get_current_lang());

    if (isset($cache[$lang])) {
        return $cache[$lang];
    }

    $path = get_theme_file_path('assets/i18n/' . $lang . '.json');

    if (!file_exists($path)) {
        $cache[$lang] = [];

        return $cache[$lang];
    }

    $content = file_get_contents($path);
    $data = json_decode((string) $content, true);
    $cache[$lang] = is_array($data) ? $data : [];

    return $cache[$lang];
}

function eot_get_nested_value($array, $key, $default = null) {
    $value = $array;

    foreach (explode('.', (string) $key) as $segment) {
        if (!is_array($value) || !array_key_exists($segment, $value)) {
            return $default;
        }

        $value = $value[$segment];
    }

    return $value;
}

function eot_get_meta_value($field, $lang = null, $page = null) {
    $dictionary = eot_get_i18n_dictionary($lang);
    $page = $page ?: eot_page_key_from_context();

    return eot_get_nested_value($dictionary, 'meta.' . $page . '.' . $field);
}

function eot_get_global_meta_value($field, $lang = null) {
    $dictionary = eot_get_i18n_dictionary($lang);

    return eot_get_nested_value($dictionary, 'meta.' . $field);
}

function eot_t($key, $default = '', $lang = null) {
    $value = eot_get_nested_value(eot_get_i18n_dictionary($lang), $key);

    if ($value === null || is_array($value)) {
        return (string) $default;
    }

    return (string) $value;
}

function eot_add_language_rewrite_tags() {
    add_rewrite_tag('%eot_lang%', '([a-z]{2})');
    add_rewrite_tag('%eot_front_page%', '([0-1])');
}
add_action('init', 'eot_add_language_rewrite_tags');

function eot_add_language_rewrite_rules() {
    add_rewrite_rule('^sk/?$', 'index.php?eot_lang=sk&eot_front_page=1', 'top');
    add_rewrite_rule('^sk/about/?$', 'index.php?pagename=about&eot_lang=sk', 'top');
    add_rewrite_rule('^sk/services/?$', 'index.php?pagename=services&eot_lang=sk', 'top');
    add_rewrite_rule('^sk/contacts/?$', 'index.php?pagename=contacts&eot_lang=sk', 'top');
}
add_action('init', 'eot_add_language_rewrite_rules');

function eot_register_query_vars($vars) {
    $vars[] = 'eot_lang';
    $vars[] = 'eot_front_page';

    return $vars;
}
add_filter('query_vars', 'eot_register_query_vars');

function eot_filter_language_attributes($output) {
    $lang = eot_get_current_lang();
    $attrs = sprintf('lang="%s"', esc_attr($lang));

    if (is_rtl()) {
        $attrs .= ' dir="rtl"';
    }

    return $attrs;
}
add_filter('language_attributes', 'eot_filter_language_attributes');

function eot_front_page_template_for_sk($template) {
    if (get_query_var('eot_front_page')) {
        $front_template = locate_template('front-page.php');

        if ($front_template) {
            return $front_template;
        }
    }

    return $template;
}
add_filter('template_include', 'eot_front_page_template_for_sk');

function eot_print_hreflang_tags() {
    if (is_404()) {
        return;
    }

    foreach (eot_get_hreflang_map() as $hreflang => $url) {
        printf(
            '<link rel="alternate" hreflang="%1$s" href="%2$s" />' . "\n",
            esc_attr($hreflang),
            esc_url($url)
        );
    }
}

function eot_print_canonical_tag() {
    if (is_404()) {
        return;
    }

    printf(
        '<link rel="canonical" href="%s" />' . "\n",
        esc_url(eot_localized_current_url())
    );
}

function eot_flush_rewrite_rules_on_theme_switch() {
    eot_add_language_rewrite_tags();
    eot_add_language_rewrite_rules();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'eot_flush_rewrite_rules_on_theme_switch');

function eot_filter_document_title($title) {
    $meta_title = eot_get_meta_value('title');

    return is_string($meta_title) && $meta_title !== '' ? $meta_title : $title;
}
add_filter('pre_get_document_title', 'eot_filter_document_title');

function eot_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    add_theme_support('post-thumbnails');

    register_nav_menus([
        'primary' => 'Primary Navigation',
    ]);
}
add_action('after_setup_theme', 'eot_theme_setup');

function eot_enqueue_assets() {
    $theme_version = wp_get_theme()->get('Version');
    $style_ver = file_exists(get_theme_file_path('style.css')) ? (string) filemtime(get_theme_file_path('style.css')) : $theme_version;
    $main_js_ver = file_exists(get_theme_file_path('assets/js/main.js')) ? (string) filemtime(get_theme_file_path('assets/js/main.js')) : $theme_version;
    $contacts_js_ver = file_exists(get_theme_file_path('assets/js/contacts.js')) ? (string) filemtime(get_theme_file_path('assets/js/contacts.js')) : $theme_version;
    $i18n_ru_ver = file_exists(get_theme_file_path('assets/i18n/ru.json')) ? (int) filemtime(get_theme_file_path('assets/i18n/ru.json')) : 0;
    $i18n_sk_ver = file_exists(get_theme_file_path('assets/i18n/sk.json')) ? (int) filemtime(get_theme_file_path('assets/i18n/sk.json')) : 0;
    $i18n_version = (string) max((int) $theme_version, $i18n_ru_ver, $i18n_sk_ver);

    wp_enqueue_style('eot-style', get_stylesheet_uri(), [], $style_ver);

    wp_enqueue_script('eot-main', get_theme_file_uri('assets/js/main.js'), [], $main_js_ver, true);

    // Booking UI может быть выведен не только на slug=contacts, поэтому подключаем на всех singular.
    if (is_singular()) {
        wp_enqueue_script('eot-contacts', get_theme_file_uri('assets/js/contacts.js'), ['eot-main'], $contacts_js_ver, true);

        wp_localize_script('eot-contacts', 'eotBookingData', [
            'restUrl' => esc_url_raw(rest_url('bc/v1')),
            'nonce' => wp_create_nonce('wp_rest'),
        ]);
    }

    wp_localize_script('eot-main', 'eotThemeData', [
        'lang'        => eot_get_current_lang(),
        'i18n'        => eot_get_i18n_dictionary(),
        'i18nPath'    => get_theme_file_uri('assets/i18n/'),
        'i18nVersion' => $i18n_version,
        'assetsPath'  => get_theme_file_uri('assets/images/'),
        'apiBookUrl'  => home_url('/backend/api/book.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'eot_enqueue_assets');

function eot_image_url($filename) {
    $relative_path = 'assets/images/' . ltrim((string) $filename, '/');
    $uri = get_theme_file_uri($relative_path);
    $file_path = get_theme_file_path($relative_path);

    if (file_exists($file_path)) {
        $uri = add_query_arg('ver', (string) filemtime($file_path), $uri);
    }

    return esc_url($uri);
}

function eot_disable_emoji() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
}
add_action('init', 'eot_disable_emoji');

function eot_hide_admin_sections() {
    remove_menu_page('edit.php');
    remove_menu_page('upload.php');
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'eot_hide_admin_sections', 999);
