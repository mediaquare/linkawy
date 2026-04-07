<?php
/**
 * Single Resource Template
 *
 * Hero (breadcrumbs, resource type badge, title, subtitle, CTA) + content.
 * Reuses service-hero layout; no hero media column when no featured image.
 *
 * @package Linkawy
 */

get_header();

while (have_posts()) :
    the_post();
    $post_id    = get_the_ID();
    $hero_title = get_post_meta($post_id, '_resource_hero_title', true);
    $hero_subtitle = get_post_meta($post_id, '_resource_hero_subtitle', true);
    $display_title = $hero_title !== '' ? $hero_title : get_the_title();
    $has_thumbnail = has_post_thumbnail();
    $cta = linkawy_get_resource_cta($post_id);

    $resource_types = get_the_terms($post_id, 'resource_type');
    $type_name = '';
    $type_image_id = 0;
    if ($resource_types && !is_wp_error($resource_types)) {
        $first_type = $resource_types[0];
        $type_name = $first_type->name;
        $type_image_id = (int) get_term_meta($first_type->term_id, 'resource_type_image', true);
    }

    $cta_icon_html = '';
    if ($cta['url'] !== '' && $cta['icon'] !== '') {
        if ($cta['icon'] === 'arrow-left') {
            $cta_icon_html = '<svg class="service-hero-btn-arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M19 12H5m7 7l-7-7 7-7"/></svg>';
        } elseif ($cta['icon'] === 'download') {
            $cta_icon_html = '<i class="fa-solid fa-download" aria-hidden="true"></i>';
        } elseif ($cta['icon'] === 'external-link') {
            $cta_icon_html = '<i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>';
        } elseif ($cta['icon'] === 'code') {
            $cta_icon_html = '<i class="fa-solid fa-code" aria-hidden="true"></i>';
        }
    }
    ?>
    <section class="service-hero resource-hero-saas">
        <div class="resource-hero-bg-deco" aria-hidden="true"></div>
        <div class="container service-hero-inner">
            <div class="service-hero-content">
                <?php linkawy_breadcrumbs(); ?>
                <h1 class="service-hero-title"><?php echo esc_html($display_title); ?></h1>
                <?php if ($type_name !== '') : ?>
                    <span class="resource-type-badge resource-type-badge-capsule">
                        <?php if ($type_image_id > 0) : ?>
                            <?php echo wp_get_attachment_image($type_image_id, 'thumbnail', false, array('class' => 'resource-type-badge-img')); ?>
                        <?php endif; ?>
                        <?php echo esc_html($type_name); ?>
                    </span>
                <?php endif; ?>
                <?php if ($hero_subtitle !== '') : ?>
                    <p class="service-hero-subtitle"><?php echo nl2br(esc_html($hero_subtitle)); ?></p>
                <?php endif; ?>
                <div class="service-hero-buttons">
                    <?php if ($cta['url'] !== '') : ?>
                        <a href="<?php echo esc_url($cta['url']); ?>" class="service-hero-btn service-hero-btn-primary">
                            <span class="service-hero-btn-text"><?php echo esc_html($cta['text']); ?></span>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/arrow-up-left.svg' ); ?>" class="service-hero-btn-arrow-up-left" width="16" height="16" alt="" aria-hidden="true" />
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($has_thumbnail) : ?>
            <div class="service-hero-media">
                <div class="resource-hero-media-wrap">
                    <span class="resource-hero-media-glow" aria-hidden="true"></span>
                    <?php the_post_thumbnail('large', array('class' => 'service-hero-image', 'loading' => 'eager', 'decoding' => 'async')); ?>
                </div>
            </div>
            <?php endif; ?>
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
endwhile;

get_footer();
