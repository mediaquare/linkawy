<?php
/**
 * Template part for displaying glossary terms in archive pages
 *
 * @package Linkawy
 */
?>

<div class="glossary-item-card" data-title="<?php echo esc_attr(strtolower(get_the_title())); ?>">
    <h2 class="item-title">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>
    <p class="item-desc"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
</div>
