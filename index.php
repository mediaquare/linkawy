<?php
/**
 * Main Index Template (Fallback)
 *
 * @package Linkawy
 */

get_header();
?>

    <!-- Blog Hero -->
    <section class="blog-hero">
        <div class="container">
            <h1><?php _e('المدونة', 'linkawy'); ?></h1>
            <p class="blog-hero-description">
                <?php _e('استراتيجيات SEO مُجربة، أدوات عملية، وأحدث أخبار التسويق الرقمي لمساعدتك في تصدر نتائج البحث.', 'linkawy'); ?>
            </p>
        </div>
    </section>

    <!-- Posts Grid -->
    <section class="blog-grid-section">
        <div class="container">
            <?php if (have_posts()) : ?>
                <div class="blog-grid">
                    <?php
                    while (have_posts()) : the_post();
                        get_template_part('template-parts/content', 'post', array(
                            'title_heading_tag' => 'h2',
                        ));
                    endwhile;
                    ?>
                </div>

                <?php linkawy_pagination(); ?>

            <?php else : ?>
                <p class="no-posts"><?php _e('لا توجد مقالات حتى الآن.', 'linkawy'); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Newsletter -->
    <?php get_template_part('template-parts/newsletter'); ?>

    <!-- CTA Banner -->
    <?php get_template_part('template-parts/cta-banner'); ?>

<?php
get_footer();
