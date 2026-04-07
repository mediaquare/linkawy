<?php
/**
 * Template part for related glossary terms section
 *
 * @package Linkawy
 */

$related_terms = linkawy_get_related_glossary(get_the_ID(), 4);

if (!$related_terms->have_posts()) {
    return;
}
?>

<section class="related-terms-section">
    <div class="container">
        <h2 class="related-terms-title"><?php _e('مصطلحات ذات صلة', 'linkawy'); ?></h2>
        <div class="related-terms-grid">
            <?php
            while ($related_terms->have_posts()) : $related_terms->the_post();
            ?>
                <a href="<?php the_permalink(); ?>" class="related-term-card">
                    <span class="related-term-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                    </span>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 10); ?></p>
                </a>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>
