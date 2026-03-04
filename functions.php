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
    wp_enqueue_style('eot-style', get_stylesheet_uri(), [], wp_get_theme()->get('Version'));

    wp_enqueue_script('eot-main', get_theme_file_uri('assets/js/main.js'), [], wp_get_theme()->get('Version'), true);

    if (is_page('contacts')) {
        wp_enqueue_style('eot-booking-overrides', get_theme_file_uri('assets/css/booking-plugin.css'), ['bc-booking'], wp_get_theme()->get('Version'));
    }

    wp_localize_script('eot-main', 'eotThemeData', [
        'i18nPath'    => get_theme_file_uri('assets/i18n/'),
        'assetsPath'  => get_theme_file_uri('assets/images/'),
    ]);
}
add_action('wp_enqueue_scripts', 'eot_enqueue_assets');

function eot_force_booking_assets() {
    if (!is_page('contacts')) return;

    if (!defined('BC_PLUGIN_URL') || !defined('BC_PLUGIN_VERSION')) return;

    if (!wp_style_is('bc-booking', 'enqueued')) {
        wp_enqueue_style('bc-booking', BC_PLUGIN_URL . 'assets/booking.css', [], BC_PLUGIN_VERSION);
    }

    if (!wp_script_is('bc-booking', 'enqueued')) {
        wp_enqueue_script('bc-booking', BC_PLUGIN_URL . 'assets/booking.js', ['wp-api-fetch'], BC_PLUGIN_VERSION, true);
        wp_localize_script('bc-booking', 'BC_BOOKING', [
            'restUrl'    => esc_url_raw(rest_url('bc/v1')),
            'nonce'      => wp_create_nonce('wp_rest'),
            'isLoggedIn' => is_user_logged_in(),
            'loginUrl'   => wp_login_url(get_permalink()),
        ]);
    }
}
add_action('wp_enqueue_scripts', 'eot_force_booking_assets', 20);

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
