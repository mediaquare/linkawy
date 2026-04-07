<?php
/**
 * Google Maps embed shortcode (works where oEmbed fails, e.g. maps.app.goo.gl).
 *
 * Usage examples:
 *   [linkawy_google_map src="https://www.google.com/maps/embed?pb=..."]
 *   [linkawy_google_map url="https://maps.app.goo.gl/xxxx"]
 *   [linkawy_google_map url="https://www.google.com/maps/place/.../@24.7,46.6,17z"]
 *   [linkawy_google_map lat="24.7136" lng="46.6753"]
 *   [linkawy_google_map q="الرياض"]
 *
 * @package Linkawy
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * @param string $url
 * @return bool
 */
function linkawy_google_map_is_trusted_src($url) {
    $url = esc_url_raw($url, array('https'));
    if ($url === '') {
        return false;
    }
    $parts = wp_parse_url($url);
    if (empty($parts['host']) || ($parts['scheme'] ?? '') !== 'https') {
        return false;
    }
    $h = strtolower($parts['host']);
    if ($h === 'maps.app.goo.gl') {
        return true;
    }
    if (preg_match('/^((www|maps)\.)?google\.(com|[a-z]{2,3}(\.[a-z]{2})?)$/i', $h)) {
        $path = isset($parts['path']) ? $parts['path'] : '';
        return (strpos($path, '/maps') === 0);
    }
    return false;
}

/**
 * @param array $atts
 * @return string iframe src URL or empty
 */
function linkawy_google_map_resolve_src($atts) {
    $src = isset($atts['src']) ? trim((string) $atts['src']) : '';
    if ($src !== '' && linkawy_google_map_is_trusted_src($src)) {
        return esc_url_raw($src, array('https'));
    }

    $lat = isset($atts['lat']) ? trim((string) $atts['lat']) : '';
    $lng = isset($atts['lng']) ? trim((string) $atts['lng']) : '';
    if ($lat !== '' && $lng !== '' && is_numeric($lat) && is_numeric($lng)) {
        return 'https://www.google.com/maps?q=' . rawurlencode($lat . ',' . $lng) . '&z=16&output=embed&hl=ar';
    }

    $q = isset($atts['q']) ? trim((string) $atts['q']) : '';
    if ($q !== '') {
        return 'https://www.google.com/maps?q=' . rawurlencode($q) . '&output=embed&hl=ar';
    }

    $url = isset($atts['url']) ? trim((string) $atts['url']) : '';
    if ($url === '') {
        return '';
    }
    $url = esc_url_raw($url, array('https', 'http'));
    if ($url === '') {
        return '';
    }
    if (strpos($url, 'http://') === 0) {
        $url = preg_replace('#^http://#i', 'https://', $url);
    }

    if (strpos($url, '/maps/embed') !== false && linkawy_google_map_is_trusted_src($url)) {
        return esc_url_raw($url, array('https'));
    }

    if (preg_match('/@(-?\d+\.?\d*),(-?\d+\.?\d+)/', $url, $m)) {
        return 'https://www.google.com/maps?q=' . rawurlencode($m[1] . ',' . $m[2]) . '&z=16&output=embed&hl=ar';
    }

    if (linkawy_google_map_is_trusted_src($url)) {
        return esc_url_raw($url, array('https'));
    }

    return '';
}

/**
 * @param array|string $atts
 * @return string
 */
function linkawy_google_map_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'src'     => '',
            'url'     => '',
            'q'       => '',
            'lat'     => '',
            'lng'     => '',
            'height'  => '400',
            'width'   => '100%',
            'class'   => '',
            'title'   => '',
        ),
        $atts,
        'linkawy_google_map'
    );

    $iframe_src = linkawy_google_map_resolve_src($atts);
    if ($iframe_src === '') {
        return '';
    }

    $height = trim((string) $atts['height']);
    if ($height === '' || !preg_match('/^(\d+)(px|vh|%)?$/', $height, $hm)) {
        $height = '400px';
    } else {
        $height = $hm[1] . (isset($hm[2]) && $hm[2] !== '' ? $hm[2] : 'px');
    }

    $width = preg_replace('/\s+/', '', trim((string) $atts['width']));
    if ($width === '' || !preg_match('/^(100%|\d{1,4}px)$/i', $width)) {
        $width = '100%';
    }

    $title = $atts['title'] !== '' ? sanitize_text_field($atts['title']) : __('خريطة Google', 'linkawy');

    $classes = array('linkawy-google-map');
    $extra_class = trim((string) $atts['class']);
    if ($extra_class !== '') {
        foreach (preg_split('/\s+/', $extra_class, -1, PREG_SPLIT_NO_EMPTY) as $c) {
            $san = sanitize_html_class($c);
            if ($san !== '') {
                $classes[] = $san;
            }
        }
    }
    $class = implode(' ', array_unique($classes));

    return sprintf(
        '<div class="%s" style="margin-top:2.75rem;max-width:%s;width:%s;height:%s;overflow:hidden;border-radius:12px;line-height:0;box-shadow:0 4px 24px rgba(0,0,0,0.08);">' .
        '<iframe src="%s" title="%s" width="100%%" height="100%%" style="display:block;width:100%%;height:100%%;min-height:240px;border:0;" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe></div>',
        esc_attr($class),
        esc_attr($width),
        esc_attr($width),
        esc_attr($height),
        esc_url($iframe_src),
        esc_attr($title)
    );
}
add_shortcode('linkawy_google_map', 'linkawy_google_map_shortcode');
