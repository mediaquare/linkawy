<?php
/**
 * Template Name: صفحة هبوط (Landing)
 *
 * Blank landing page: no header, footer, or sidebar — only Gutenberg content, full-width.
 * Selectable under Page Attributes → Template.
 *
 * @package Linkawy
 */

// Elementor preview: use minimal shell (same pattern as page.php / service-page).
$is_elementor_preview = false;
if (!is_admin() && class_exists('\Elementor\Plugin')) {
    $elementor = \Elementor\Plugin::instance();
    if (isset($elementor->preview)) {
        $is_elementor_preview = $elementor->preview->is_preview_mode();
    }
}

if ($is_elementor_preview) {
    get_header('elementor');
    while (have_posts()) :
        the_post();
        the_content();
    endwhile;
    get_footer('elementor');
    return;
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<main id="main-content" role="main">
    <?php
    while (have_posts()) :
        the_post();
        the_content();
    endwhile;
    ?>
</main>

<?php wp_footer(); ?>
</body>
</html>
