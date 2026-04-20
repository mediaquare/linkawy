<?php
/**
 * Default Page Template
 *
 * @package Linkawy
 */

// Check if we're in Elementor preview mode (only on frontend)
$is_elementor_preview = false;
if (!is_admin() && class_exists('\Elementor\Plugin')) {
    $elementor = \Elementor\Plugin::instance();
    if (isset($elementor->preview)) {
        $is_elementor_preview = $elementor->preview->is_preview_mode();
    }
}

if ($is_elementor_preview) {
    // Use minimal Elementor-specific template
    get_header('elementor');
    
    while (have_posts()) : the_post();
        the_content();
    endwhile;
    
    get_footer('elementor');
} else {
    // Normal page view with full header/footer
    get_header();

    $page_hero_title    = '';
    $page_hero_subtitle = '';
    $page_id            = is_page() ? (int) get_queried_object_id() : 0;
    $page_hero_bg = '';
    if ($page_id) {
        $page_hero_title    = trim((string) get_post_meta($page_id, '_service_hero_title', true));
        $page_hero_subtitle = trim((string) get_post_meta($page_id, '_service_hero_subtitle', true));
        $page_hero_bg       = linkawy_get_page_hero_bg_color($page_id);
    }
    $page_display_title = $page_hero_title !== '' ? $page_hero_title : ($page_id ? get_the_title($page_id) : get_the_title());
    $page_hero_style    = $page_hero_bg !== '' ? ' style="' . esc_attr('background: ' . $page_hero_bg . ';') . '"' : '';
    ?>

    <!-- Page Hero -->
    <section class="page-hero"<?php echo $page_hero_style; ?>>
        <div class="container">
            <?php linkawy_breadcrumbs(); ?>
            <h1 class="page-title"><?php echo esc_html($page_display_title); ?></h1>
            <?php if ($page_hero_subtitle !== '') : ?>
                <p class="page-hero-description"><?php echo nl2br(esc_html($page_hero_subtitle)); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Page Content -->
    <section class="page-content-section">
        <div class="container">
            <div class="page-content linkawy-content">
                <?php
                while (have_posts()) : the_post();
                    the_content();
                endwhile;
                ?>
            </div>
        </div>
    </section>

    <?php
    get_footer();
}
