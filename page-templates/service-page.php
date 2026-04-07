<?php
/**
 * Template Name: صفحة الخدمة
 *
 * Service page with hero (two columns: content + featured image or simplified form),
 * page content, and optional full contact form above footer when featured image is set.
 *
 * @package Linkawy
 */

// Elementor preview: minimal template
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

get_header();

while (have_posts()) :
    the_post();
    $hero_title = get_post_meta(get_the_ID(), '_service_hero_title', true);
    $hero_subtitle = get_post_meta(get_the_ID(), '_service_hero_subtitle', true);
    $primary_btn_text = get_post_meta(get_the_ID(), '_service_hero_primary_btn_text', true);
    $primary_btn_url = get_post_meta(get_the_ID(), '_service_hero_primary_btn_url', true);
    $primary_btn_icon = get_post_meta(get_the_ID(), '_service_hero_primary_btn_icon', true);
    $display_title = $hero_title !== '' ? $hero_title : get_the_title();
    $has_thumbnail = has_post_thumbnail();
    ?>
    <section class="service-hero">
        <div class="container service-hero-inner">
            <div class="service-hero-content">
                <?php linkawy_breadcrumbs(); ?>
                <h1 class="service-hero-title"><?php echo esc_html($display_title); ?></h1>
                <?php if ($hero_subtitle !== '') : ?>
                    <p class="service-hero-subtitle"><?php echo nl2br(esc_html($hero_subtitle)); ?></p>
                <?php endif; ?>
                <div class="service-hero-buttons">
                    <?php
                    if ($primary_btn_text !== '' && $primary_btn_url !== '') :
                        $icon_html = '';
                        if ($primary_btn_icon === 'whatsapp') {
                            $icon_html = '<i class="fa-brands fa-whatsapp" aria-hidden="true"></i>';
                        } elseif ($primary_btn_icon === 'phone') {
                            $icon_html = '<i class="fa-solid fa-phone" aria-hidden="true"></i>';
                        } elseif ($primary_btn_icon === 'search') {
                            $icon_html = '<i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>';
                        } elseif ($primary_btn_icon === 'send') {
                            $icon_html = '<i class="fa-solid fa-paper-plane" aria-hidden="true"></i>';
                        } elseif ($primary_btn_icon === 'arrow-left') {
                            $icon_html = '<svg class="service-hero-btn-arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M19 12H5m7 7l-7-7 7-7"/></svg>';
                        }
                        ?>
                        <a href="<?php echo esc_url($primary_btn_url); ?>" class="service-hero-btn service-hero-btn-primary">
                            <span class="service-hero-btn-text"><?php echo esc_html($primary_btn_text); ?></span>
                            <?php if ($icon_html) : ?>
                                <span class="service-hero-btn-icon" aria-hidden="true"><?php echo $icon_html; ?></span>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="service-hero-media">
                <?php if ($has_thumbnail) : ?>
                    <?php the_post_thumbnail('large', array('class' => 'service-hero-image', 'loading' => 'eager', 'decoding' => 'async')); ?>
                <?php else : ?>
                    <?php get_template_part('template-parts/service-hero-form'); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="page-content-section">
        <div class="container">
            <div class="page-content linkawy-content">
                <?php the_content(); ?>
            </div>
        </div>
    </section>

    <?php
    if ($has_thumbnail) {
        get_template_part('template-parts/contact-form-section');
    }
endwhile;

get_footer();
