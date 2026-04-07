<?php
/**
 * Template part for displaying posts in archive/blog pages
 *
 * Optional args (via get_template_part third parameter; read from $args — WP 6.1+ does not extract these into locals):
 * - title_heading_tag: 'h2' | 'h3' — use h2 when listing under page H1 only (e.g. category archive); default h3 under section H2 (blog home).
 *
 * @package Linkawy
 */

$linkawy_post_card_args = (isset($args) && is_array($args)) ? $args : array();
if (isset($linkawy_post_card_args['title_heading_tag']) && in_array($linkawy_post_card_args['title_heading_tag'], array('h2', 'h3'), true)) {
    $title_heading_tag = $linkawy_post_card_args['title_heading_tag'];
} elseif (isset($title_heading_tag) && in_array($title_heading_tag, array('h2', 'h3'), true)) {
    // Unchanged (e.g. legacy extract); normally use $args in WP 6.1+.
} else {
    $title_heading_tag = 'h3';
}

// Get card gradient color (default: orange)
$card_color_key = get_post_meta(get_the_ID(), '_card_color', true);
if (empty($card_color_key)) {
    $card_color_key = 'orange';
}

$all_gradients = linkawy_get_card_gradients();

// Get gradient value
if (isset($all_gradients[$card_color_key]) && !empty($all_gradients[$card_color_key]['value'])) {
    $card_gradient = $all_gradients[$card_color_key]['value'];
} else {
    // Fallback to orange
    $card_gradient = 'linear-gradient(135deg, #FF8552 0%, #ff6b3d 100%)';
}

// Category badge: only on blog index (mixed categories); hidden on category/tag/search/404 archives.
$category_name = '';
if (is_home()) {
    $categories = get_the_category();
    $category_name = $categories ? $categories[0]->name : '';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?>>
    <div class="blog-card-image" style="background: <?php echo esc_attr($card_gradient); ?>;">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('linkawy-card'); ?>
        <?php endif; ?>
        <?php if ($category_name !== '') : ?>
            <span class="blog-category-badge"><?php echo esc_html($category_name); ?></span>
        <?php endif; ?>
    </div>
    <div class="blog-card-content">
        <div class="blog-card-meta">
            <span><i class="far fa-clock"></i> <?php echo linkawy_reading_time(); ?></span>
            <span><i class="far fa-user"></i> <?php the_author(); ?></span>
        </div>
        <<?php echo esc_attr($title_heading_tag); ?> class="blog-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </<?php echo esc_attr($title_heading_tag); ?>>
        <p class="blog-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
        <div class="blog-card-footer">
            <span><i class="far fa-calendar-alt"></i> <?php echo get_the_date('j F Y'); ?></span>
            <a href="<?php the_permalink(); ?>"><?php _e('اقرأ المزيد', 'linkawy'); ?> <i class="fas fa-arrow-left"></i></a>
        </div>
    </div>
</article>
