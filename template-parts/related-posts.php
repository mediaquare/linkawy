<?php
/**
 * Template part for related posts section
 *
 * @package Linkawy
 */

$related_posts = linkawy_get_related_posts(get_the_ID(), 4);

if (!$related_posts->have_posts()) {
    return;
}
?>

<section class="also-like-section">
    <div class="container container-wide">
        <div class="also-like-wrapper">
            <h2 class="also-like-title"><?php _e('قد يهمك أيضًا', 'linkawy'); ?></h2>
            <div class="also-like-grid">
                <?php
                while ($related_posts->have_posts()) : $related_posts->the_post();
                ?>
                <article class="also-like-card">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                    <div class="also-like-meta">
                        <?php
                        $categories = get_the_category();
                        if ($categories) :
                        ?>
                            <span class="also-like-category"><?php echo esc_html($categories[0]->name); ?></span>
                        <?php endif; ?>
                        <span class="also-like-time"><?php echo linkawy_reading_time(); ?></span>
                    </div>
                </article>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</section>
