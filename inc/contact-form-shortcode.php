<?php
/**
 * Contact form shortcode — same markup/logic as front-page form.
 *
 * @package Linkawy
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Whether the main singular post content includes the contact form shortcode.
 */
function linkawy_content_includes_contact_form_shortcode() {
    if (!is_singular()) {
        return false;
    }
    $post = get_post();
    if (!$post || !is_string($post->post_content)) {
        return false;
    }
    return has_shortcode($post->post_content, 'linkawy_contact_form');
}

/**
 * Shortcode: [linkawy_contact_form] or [linkawy_contact_form title="..." description="..."]
 *
 * Renders the full contact form (AJAX, validation, reCAPTCHA v2 Invisible if configured).
 *
 * @param array|string $atts Shortcode attributes.
 * @return string
 */
function linkawy_shortcode_contact_form($atts) {
    global $linkawy_contact_form_suffix, $linkawy_contact_form_header_title, $linkawy_contact_form_header_desc;

    $atts = shortcode_atts(
        array(
            'title'       => '',
            'description' => '',
        ),
        $atts,
        'linkawy_contact_form'
    );

    $linkawy_contact_form_suffix = wp_unique_id('cf');
    $linkawy_contact_form_header_title = $atts['title'] !== '' ? $atts['title'] : '';
    $linkawy_contact_form_header_desc  = $atts['description'] !== '' ? $atts['description'] : '';

    ob_start();
    get_template_part('template-parts/contact-form-section');
    $html = ob_get_clean();

    $linkawy_contact_form_suffix        = null;
    $linkawy_contact_form_header_title = null;
    $linkawy_contact_form_header_desc  = null;

    return $html;
}
add_shortcode('linkawy_contact_form', 'linkawy_shortcode_contact_form');
