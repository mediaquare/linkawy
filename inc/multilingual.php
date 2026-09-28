<?php
/**
 * Multilingual (Polylang): Arabic is the default language (no URL prefix),
 * English lives under /en/.
 *
 * @package Linkawy
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * While true, every English page is noindex, left out of the sitemaps and not
 * advertised through hreflang. Flip only when the English launch is approved.
 */
if (!defined('LINKAWY_EN_NOINDEX')) {
    define('LINKAWY_EN_NOINDEX', true);
}

/**
 * Current language slug ('ar' when Polylang is inactive).
 */
function linkawy_current_lang() {
    if (function_exists('pll_current_language')) {
        $lang = pll_current_language('slug');
        if ($lang) {
            return $lang;
        }
    }
    return 'ar';
}

function linkawy_is_en() {
    return linkawy_current_lang() === 'en';
}

/*
 * noindex for English pages: Rank Math's robots meta, the core wp_robots fallback
 * and an X-Robots-Tag header.
 */
add_filter('rank_math/frontend/robots', function ($robots) {
    if (LINKAWY_EN_NOINDEX && linkawy_is_en()) {
        $robots['index']  = 'noindex';
        $robots['follow'] = 'follow';
    }
    return $robots;
});

add_filter('wp_robots', function ($robots) {
    if (LINKAWY_EN_NOINDEX && linkawy_is_en()) {
        unset($robots['index']);
        $robots['noindex'] = true;
        $robots['follow']  = true;
    }
    return $robots;
});

add_action('send_headers', function () {
    if (LINKAWY_EN_NOINDEX && linkawy_is_en() && !headers_sent()) {
        header('X-Robots-Tag: noindex, follow', true);
    }
});

/*
 * Keep English posts and terms out of Rank Math's sitemaps while noindex.
 */
add_filter('rank_math/sitemap/entry', function ($url, $type, $object) {
    if (!LINKAWY_EN_NOINDEX) {
        return $url;
    }
    if ($object instanceof WP_Post && function_exists('pll_get_post_language') && pll_get_post_language($object->ID) === 'en') {
        return false;
    }
    if ($object instanceof WP_Term && function_exists('pll_get_term_language') && pll_get_term_language($object->term_id) === 'en') {
        return false;
    }
    return $url;
}, 10, 3);

/*
 * No hreflang links to noindex English pages (the Arabic <head> stays unchanged).
 */
add_filter('pll_rel_hreflang_attributes', function ($hreflangs) {
    return LINKAWY_EN_NOINDEX ? array() : $hreflangs;
});

/**
 * Home URL of the current language (Arabic: https://www.linkawy.io/, English: /en/).
 */
function linkawy_home_url() {
    return function_exists('pll_home_url') ? pll_home_url() : home_url('/');
}

/**
 * Map an internal (Arabic) URL or path to its page in the current language.
 * Arabic pages get the value back unchanged; on English pages a translated page
 * is used when one exists, otherwise the English home page.
 */
function linkawy_lang_url($url) {
    if (!linkawy_is_en() || !function_exists('pll_get_post')) {
        return $url;
    }
    $abs = strpos($url, 'http') === 0 ? $url : home_url($url);
    if (untrailingslashit($abs) === untrailingslashit(home_url('/'))) {
        return linkawy_home_url();
    }
    $id = url_to_postid($abs);
    if ($id) {
        $tr = pll_get_post($id, 'en');
        if ($tr && get_post_status($tr) === 'publish') {
            return get_permalink($tr);
        }
    }
    return linkawy_home_url();
}

// Header / mobile CTA links follow the current language.
add_filter('theme_mod_linkawy_header_cta_url', 'linkawy_lang_url');
add_filter('theme_mod_linkawy_mobile_cta_url', 'linkawy_lang_url');

// The static FAQ block saves an Arabic title; translate it when rendering English pages
// (the stored markup stays unchanged so the block remains valid in the editor).
add_filter('render_block_linkawy/faq', function ($html) {
    if (!linkawy_is_en()) {
        return $html;
    }
    return str_replace('>الأسئلة الشائعة</div>', '>' . esc_html__('الأسئلة الشائعة', 'linkawy') . '</div>', $html);
});

/**
 * Footer widget areas: English pages use their own copies (footer-services-en, ...).
 */
add_action('widgets_init', function () {
    $areas = array(
        'footer-services'  => 'Footer (English) - Services',
        'footer-resources' => 'Footer (English) - Resources',
        'footer-company'   => 'Footer (English) - Company',
    );
    foreach ($areas as $id => $name) {
        register_sidebar(array(
            'name'          => $name,
            'id'            => $id . '-en',
            'description'   => 'Shown on English (/en/) pages instead of the Arabic footer links.',
            'before_widget' => '<div id="%1$s" class="footer-links %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<span class="footer-title">',
            'after_title'   => '</span>',
        ));
    }
}, 20);

function linkawy_sidebar_id($id) {
    return (linkawy_is_en() && is_active_sidebar($id . '-en')) ? $id . '-en' : $id;
}

/**
 * Language switcher (English pages only until the English launch): links to the
 * Arabic version of the current page, or the Arabic home page.
 */
function linkawy_language_switcher() {
    if (!linkawy_is_en() || !function_exists('pll_the_languages')) {
        return;
    }
    $langs = pll_the_languages(array('raw' => 1, 'hide_if_empty' => 0, 'force_home' => 0));
    if (empty($langs['ar'])) {
        return;
    }
    // Polylang returns the Arabic home page when this page has no Arabic translation.
    echo '<a class="lang-switch" href="' . esc_url($langs['ar']['url']) . '" hreflang="ar" lang="ar">العربية</a>';
}
