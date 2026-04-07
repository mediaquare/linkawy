<?php
/**
 * Theme Setup
 *
 * @package Linkawy
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function linkawy_setup() {
    // Make theme available for translation
    load_theme_textdomain('linkawy', LINKAWY_DIR . '/languages');

    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Set default thumbnail size
    set_post_thumbnail_size(800, 450, true);

    // Add custom image sizes (false = no crop, keeps full image)
    add_image_size('linkawy-featured', 1200, 675, false);
    add_image_size('linkawy-card', 400, 0, false);
    
    // Avatar sizes for responsive images (optimized for Lighthouse)
    add_image_size('linkawy-avatar-sm', 60, 60, true);       // Sidebar author card (1x)
    add_image_size('linkawy-avatar-sm-2x', 120, 120, true);  // Sidebar author card (2x retina)
    add_image_size('linkawy-avatar-md', 80, 80, true);       // Author box (1x)
    add_image_size('linkawy-avatar-md-2x', 160, 160, true);  // Author box (2x retina)
    add_image_size('linkawy-author', 100, 100, true);        // General author size

    // Register navigation menus
    register_nav_menus(array(
        'primary-menu'  => __('القائمة الرئيسية', 'linkawy'),
        'footer-menu'   => __('قائمة الفوتر', 'linkawy'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Add support for wide alignment
    add_theme_support('align-wide');

    // Gutenberg: optional block style variations (core blocks)
    add_theme_support('wp-block-styles');

    // Match editor canvas to theme tokens (see assets/css/editor-style.css)
    add_editor_style('assets/css/editor-style.css');
}
add_action('after_setup_theme', 'linkawy_setup');

/**
 * Set the content width based on the theme's design.
 */
function linkawy_content_width() {
    $GLOBALS['content_width'] = apply_filters('linkawy_content_width', 800);
}
add_action('after_setup_theme', 'linkawy_content_width', 0);

/**
 * Register widget areas.
 */
function linkawy_widgets_init() {
    // Article Sidebar
    register_sidebar(array(
        'name'          => __('سايدبار المقالات', 'linkawy'),
        'id'            => 'sidebar-article',
        'description'   => __('الودجات التي تظهر في صفحات المقالات', 'linkawy'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Footer Widget Areas
    register_sidebar(array(
        'name'          => __('فوتر - خدماتنا', 'linkawy'),
        'id'            => 'footer-services',
        'description'   => __('روابط الخدمات في الفوتر', 'linkawy'),
        'before_widget' => '<div id="%1$s" class="footer-links %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="footer-title">',
        'after_title'   => '</span>',
    ));

    register_sidebar(array(
        'name'          => __('فوتر - المصادر', 'linkawy'),
        'id'            => 'footer-resources',
        'description'   => __('روابط المصادر في الفوتر', 'linkawy'),
        'before_widget' => '<div id="%1$s" class="footer-links %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="footer-title">',
        'after_title'   => '</span>',
    ));

    register_sidebar(array(
        'name'          => __('فوتر - الشركة', 'linkawy'),
        'id'            => 'footer-company',
        'description'   => __('روابط الشركة في الفوتر', 'linkawy'),
        'before_widget' => '<div id="%1$s" class="footer-links %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="footer-title">',
        'after_title'   => '</span>',
    ));

    register_sidebar(array(
        'name'          => __('فوتر - اتصل بنا', 'linkawy'),
        'id'            => 'footer-contact',
        'description'   => __('معلومات التواصل في الفوتر', 'linkawy'),
        'before_widget' => '<div id="%1$s" class="footer-contact-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="footer-title">',
        'after_title'   => '</span>',
    ));
}
add_action('widgets_init', 'linkawy_widgets_init');

/**
 * Add custom classes to body
 */
function linkawy_body_classes($classes) {
    // Add RTL class
    if (is_rtl()) {
        $classes[] = 'rtl';
    }

    // Add page type classes
    if (is_singular('glossary')) {
        $classes[] = 'single-glossary-page';
    }

    if (is_post_type_archive('glossary')) {
        $classes[] = 'archive-glossary-page';
    }

    if (is_page_template('page-templates/service-page.php')) {
        $classes[] = 'linkawy-service-page';
    }

    if (is_page_template('page-templates/landing-page.php')) {
        $classes[] = 'linkawy-landing-page';
    }

    return $classes;
}
add_filter('body_class', 'linkawy_body_classes');

/**
 * Modify excerpt length
 */
function linkawy_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'linkawy_excerpt_length');

/**
 * Modify excerpt more
 */
function linkawy_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'linkawy_excerpt_more');
