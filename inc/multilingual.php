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
