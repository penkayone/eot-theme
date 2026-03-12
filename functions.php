<?php

if (!defined('ABSPATH')) {
    exit;
}

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
            'isLoggedIn' => is_user_logged_in(),
            'loginUrl' => wp_login_url(is_singular() ? get_permalink() : home_url('/')),
        ]);
    }

    wp_localize_script('eot-main', 'eotThemeData', [
        'i18nPath'    => get_theme_file_uri('assets/i18n/'),
        'i18nVersion' => $i18n_version,
        'assetsPath'  => get_theme_file_uri('assets/images/'),
        'apiBookUrl'  => home_url('/backend/api/book.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'eot_enqueue_assets');

function eot_image_url($filename) {
    return esc_url(get_theme_file_uri('assets/images/' . $filename));
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
