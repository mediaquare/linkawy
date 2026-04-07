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

    $page_hero_subtitle = '';
    if (is_page()) {
        $page_hero_subtitle = trim((string) get_post_meta(get_queried_object_id(), '_service_hero_subtitle', true));
    }
    ?>

    <!-- Page Hero -->
    <section class="page-hero">
        <div class="container">
            <?php linkawy_breadcrumbs(); ?>
            <h1 class="page-title"><?php the_title(); ?></h1>
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
