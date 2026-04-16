<?php
/**
 * Template part for displaying posts in archive/blog pages
 *
 * @package Linkawy
 */

$linkawy_post_card_args = (isset($args) && is_array($args)) ? $args : array();
if (isset($linkawy_post_card_args['title_heading_tag']) && in_array($linkawy_post_card_args['title_heading_tag'], array('h2', 'h3'), true)) {
    $title_heading_tag = $linkawy_post_card_args['title_heading_tag'];
} elseif (isset($title_heading_tag) && in_array($title_heading_tag, array('h2', 'h3'), true)) {
} else {
    $title_heading_tag = 'h3';
}

$categories = get_the_category();
$category_name = ($categories && !empty($categories[0]->name)) ? $categories[0]->name : '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?>>
    <div class="blog-card-content">
        <div class="blog-card-top-meta">
            <?php if ($category_name !== '') : ?>
                <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="blog-card-category"><?php echo esc_html($category_name); ?></a>
            <?php endif; ?>
            <span class="blog-card-read-time"><?php echo esc_html(linkawy_reading_time()); ?></span>
        </div>
        <<?php echo esc_attr($title_heading_tag); ?> class="blog-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </<?php echo esc_attr($title_heading_tag); ?>>
        <p class="blog-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
        <div class="blog-card-meta">
            <span class="blog-card-author"><?php echo esc_html(get_the_author()); ?></span>
            <span class="blog-card-meta-sep" aria-hidden="true">·</span>
            <span class="blog-card-date"><?php echo esc_html(get_the_date('j F Y')); ?></span>
        </div>
    </div>
</article>
