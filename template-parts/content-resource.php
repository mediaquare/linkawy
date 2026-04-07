<?php
/**
 * Template part for displaying a resource card in archive
 *
 * @package Linkawy
 */

$resource_types = get_the_terms(get_the_ID(), 'resource_type');
$type_name = '';
$type_image_id = 0;
if ($resource_types && !is_wp_error($resource_types)) {
    $first_type = $resource_types[0];
    $type_name = $first_type->name;
    $type_image_id = (int) get_term_meta($first_type->term_id, 'resource_type_image', true);
}

$card_gradient = 'linear-gradient(135deg, #FF8552 0%, #ff6b3d 100%)';
?>

<article id="resource-<?php the_ID(); ?>" <?php post_class('blog-card'); ?>>
    <div class="blog-card-image" style="background: <?php echo esc_attr($card_gradient); ?>;">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('linkawy-card'); ?>
        <?php endif; ?>
        <?php if ($type_name !== '') : ?>
            <span class="blog-category-badge">
                <?php if ($type_image_id > 0) : ?>
                    <?php echo wp_get_attachment_image($type_image_id, 'thumbnail', false, array('class' => 'resource-type-badge-img')); ?>
                <?php endif; ?>
                <?php echo esc_html($type_name); ?>
            </span>
        <?php endif; ?>
    </div>
    <div class="blog-card-content">
        <h3 class="blog-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <p class="blog-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
        <div class="blog-card-footer">
            <span><i class="far fa-calendar-alt"></i> <?php echo get_the_date('j F Y'); ?></span>
            <a href="<?php the_permalink(); ?>"><?php _e('عرض المورد', 'linkawy'); ?> <i class="fas fa-arrow-left"></i></a>
        </div>
    </div>
</article>
