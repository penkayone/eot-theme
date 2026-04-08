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

function eot_get_theme_textdomain() {
    return 'eot-theme';
}

function eot_is_supported_language($lang) {
    return in_array($lang, eot_get_supported_languages(), true);
}

function eot_normalize_language($lang) {
    $lang = strtolower((string) $lang);

    return eot_is_supported_language($lang) ? $lang : eot_get_default_language();
}

function eot_get_current_lang() {
    if (function_exists('pll_current_language')) {
        $lang = pll_current_language('slug');

        if ($lang) {
            return eot_normalize_language($lang);
        }
    }

    return eot_get_default_language();
}

function eot_is_polylang_active() {
    return function_exists('pll_current_language') && function_exists('pll_home_url');
}

function eot_page_key_to_default_slug($key) {
    $map = [
        'about' => 'about',
        'services' => 'services',
        'contacts' => 'contacts',
    ];

    return $map[$key] ?? '';
}

function eot_get_page_id_by_key($key) {
    if ($key === 'index') {
        return (int) get_option('page_on_front');
    }

    $slug = eot_page_key_to_default_slug($key);
    if ($slug === '') {
        return 0;
    }

    $page = get_page_by_path($slug);

    return $page instanceof WP_Post ? (int) $page->ID : 0;
}

function eot_get_translated_post_id($post_id, $lang = null) {
    $post_id = (int) $post_id;
    $lang = eot_normalize_language($lang ?: eot_get_current_lang());

    if ($post_id <= 0) {
        return 0;
    }

    if (function_exists('pll_get_post')) {
        $translated_id = pll_get_post($post_id, $lang);

        if ($translated_id) {
            return (int) $translated_id;
        }
    }

    return $post_id;
}

function eot_localized_url($path = '', $lang = null) {
    $lang = eot_normalize_language($lang ?: eot_get_current_lang());
    $path = trim((string) $path, '/');

    if ($path === '') {
        return eot_is_polylang_active() ? pll_home_url($lang) : home_url('/');
    }

    $page_id = eot_get_page_id_by_key($path);
    if ($page_id > 0) {
        $translated_id = eot_get_translated_post_id($page_id, $lang);

        return get_permalink($translated_id);
    }

    if (eot_is_polylang_active()) {
        return trailingslashit(pll_home_url($lang)) . $path . '/';
    }

    return home_url('/' . $path . '/');
}

function eot_page_key_from_context() {
    if (is_front_page()) {
        return 'index';
    }

    if (is_page_template('page-about.php')) {
        return 'about';
    }

    if (is_page_template('page-services.php')) {
        return 'services';
    }

    if (is_page_template('page-contacts.php')) {
        return 'contacts';
    }

    if (is_404()) {
        return '404';
    }

    return 'index';
}

function eot_get_meta_source_map() {
    return [
        'index' => [
            'title' => 'ЭОТ онлайн для русскоязычных за границей',
            'description' => 'Эмоционально-образная терапия онлайн: тревога, адаптация, отношения, самооценка. Бережный подход, конфиденциально.',
            'ogTitle' => 'ЭОТ онлайн для русскоязычных за границей',
            'ogDescription' => 'Поддержка в адаптации, тревоге и отношениях. Онлайн-консультации ЭОТ.',
            'twitterTitle' => 'ЭОТ онлайн для русскоязычных за границей',
            'twitterDescription' => 'Бережная психологическая поддержка и ЭОТ онлайн.',
        ],
        'about' => [
            'title' => 'Обо мне — ЭОТ психолог онлайн',
            'description' => 'Психолог, практик ЭОТ. Био, подход, опыт, этика, сертификаты и творчество.',
            'ogTitle' => 'Обо мне — ЭОТ психолог',
            'ogDescription' => 'Опыт, подход и ценности. Сертификаты и картины.',
            'twitterTitle' => 'Обо мне — ЭОТ психолог',
            'twitterDescription' => 'Био, подход, сертификаты и творчество.',
        ],
        'services' => [
            'title' => 'Услуги ЭОТ психолога онлайн',
            'description' => 'Индивидуальные сессии, пакетные встречи и вводная консультация. Форматы работы ЭОТ онлайн.',
            'ogTitle' => 'Услуги ЭОТ онлайн',
            'ogDescription' => 'Выберите формат: индивидуально, пакет, вводная встреча.',
            'twitterTitle' => 'Услуги ЭОТ онлайн',
            'twitterDescription' => 'Форматы работы и запись на консультацию.',
        ],
        'contacts' => [
            'title' => 'Запись — ЭОТ психолог онлайн',
            'description' => 'Свяжитесь удобным способом или оставьте сообщение через форму.',
            'ogTitle' => 'Запись',
            'ogDescription' => 'Telegram, WhatsApp, Facebook и форма связи.',
            'twitterTitle' => 'Запись ЭОТ психолога',
            'twitterDescription' => 'Написать сообщение или оставить заявку.',
        ],
    ];
}

function eot_get_meta_value($field, $lang = null, $page = null) {
    $page = $page ?: eot_page_key_from_context();
    $map = eot_get_meta_source_map();
    $source = $map[$page][$field] ?? '';

    return $source !== '' ? __($source, eot_get_theme_textdomain()) : '';
}

function eot_get_client_i18n_dictionary($lang = null) {
    $lang = eot_normalize_language($lang ?: eot_get_current_lang());

    return [
        'common' => [
            'lightboxPrev' => __('Предыдущая', 'eot-theme'),
            'lightboxNext' => __('Следующая', 'eot-theme'),
            'lightboxClose' => __('Закрыть', 'eot-theme'),
        ],
        'services' => [
            'items' => [
                '1' => ['title' => __('Индивидуальная сессия', 'eot-theme')],
                '2' => ['title' => __('Семинар возрождения внутренней силы', 'eot-theme')],
                '3' => ['title' => __('Вводная встреча', 'eot-theme')],
            ],
        ],
        'booking' => [
            'serviceLabel' => __('Выберите услугу', 'eot-theme'),
            'chooseService' => __('Сначала выберите услугу.', 'eot-theme'),
            'chooseDay' => __('Выберите дату', 'eot-theme'),
            'chooseSlot' => __('Выберите слот для записи', 'eot-theme'),
            'selectedPrefix' => __('Вы выбрали', 'eot-theme'),
            'dateSelectedToast' => __('Вы выбрали дату {date}, теперь выберите время.', 'eot-theme'),
            'timeSelectedToast' => __('Вы выбрали время {time}, теперь заполните форму.', 'eot-theme'),
            'noDates' => __('Нет доступных дат', 'eot-theme'),
            'noSlots' => __('Нет доступных слотов', 'eot-theme'),
            'success' => __('Запись подтверждена. Я свяжусь с вами через email.', 'eot-theme'),
            'saving' => __('Сохраняю...', 'eot-theme'),
            'errors' => [
                'service' => __('Сначала выберите услугу.', 'eot-theme'),
                'time' => __('Сначала выберите время.', 'eot-theme'),
                'name' => __('Укажите корректное имя.', 'eot-theme'),
                'email' => __('Введите корректный email.', 'eot-theme'),
                'phone' => __('Телефон: только цифры и +, 7-15.', 'eot-theme'),
                'message' => __('Кратко опишите запрос.', 'eot-theme'),
                'server' => __('Не удалось отправить запись. Попробуйте позже.', 'eot-theme'),
            ],
        ],
        'schema' => [
            'name' => __('Психолог ЭОТ онлайн', 'eot-theme'),
            'description' => __('Психологическая поддержка методом эмоционально-образной терапии для русскоязычных за границей.', 'eot-theme'),
            'areaServed' => 'Worldwide',
            'availableLanguage' => ['ru', 'sk'],
            'url' => eot_localized_url('', $lang),
            'image' => '',
            'serviceType' => __('Эмоционально-образная терапия', 'eot-theme'),
            'offerCatalogName' => __('Онлайн-услуги ЭОТ', 'eot-theme'),
            'offers' => [
                [
                    'name' => __('Индивидуальная сессия', 'eot-theme'),
                    'description' => __('60 минут онлайн-сессии по методу ЭОТ.', 'eot-theme'),
                    'price' => '60',
                    'currency' => 'EUR',
                ],
                [
                    'name' => __('Пакет 4 сессии', 'eot-theme'),
                    'description' => __('Последовательная поддержка и сопровождение.', 'eot-theme'),
                    'price' => '220',
                    'currency' => 'EUR',
                ],
                [
                    'name' => __('Вводная встреча', 'eot-theme'),
                    'description' => __('Короткое знакомство и уточнение запроса.', 'eot-theme'),
                    'price' => '0',
                    'currency' => 'EUR',
                ],
            ],
        ],
    ];
}

function eot_filter_language_attributes($output) {
    $lang = eot_get_current_lang();
    $attrs = sprintf('lang="%s"', esc_attr($lang));

    if (is_rtl()) {
        $attrs .= ' dir="rtl"';
    }

    return $attrs;
}
add_filter('language_attributes', 'eot_filter_language_attributes');

function eot_get_language_switcher_items() {
    $items = [];

    foreach (eot_get_supported_languages() as $slug) {
        if (is_front_page()) {
            $url = eot_localized_url('', $slug);
        } elseif (is_singular()) {
            $post_id = get_queried_object_id();
            $translated_id = eot_get_translated_post_id($post_id, $slug);
            $url = $translated_id ? get_permalink($translated_id) : eot_localized_url('', $slug);
        } else {
            $url = eot_localized_url('', $slug);
        }

        if (!isset($items[$slug])) {
            $items[$slug] = [
                'slug'    => $slug,
                'name'    => strtoupper($slug),
                'url'     => $url,
                'current' => $slug === eot_get_current_lang(),
            ];
        }
    }

    return $items;
}

function eot_localized_current_url($lang = null, $include_query = false) {
    $lang = eot_normalize_language($lang ?: eot_get_current_lang());

    if (is_front_page()) {
        $url = eot_localized_url('', $lang);
    } elseif (is_singular()) {
        $post_id = get_queried_object_id();
        $translated_id = eot_get_translated_post_id($post_id, $lang);
        $url = get_permalink($translated_id);
    } else {
        $url = eot_localized_url('', $lang);
    }

    if ($include_query && !empty($_GET)) {
        $url = add_query_arg(wp_unslash($_GET), $url);
    }

    return $url;
}

function eot_get_hreflang_map() {
    $map = [];

    foreach (eot_get_language_switcher_items() as $slug => $item) {
        $map[$slug] = $item['url'];
    }

    if (!isset($map['x-default'])) {
        $map['x-default'] = eot_localized_current_url(eot_get_default_language());
    }

    return $map;
}

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

function eot_filter_document_title($title) {
    $meta_title = eot_get_meta_value('title');

    return is_string($meta_title) && $meta_title !== '' ? $meta_title : $title;
}
add_filter('pre_get_document_title', 'eot_filter_document_title');

function eot_theme_setup() {
    load_theme_textdomain(eot_get_theme_textdomain(), get_theme_file_path('languages'));
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
        'i18n'        => eot_get_client_i18n_dictionary(),
        'assetsPath'  => get_theme_file_uri('assets/images/'),
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
