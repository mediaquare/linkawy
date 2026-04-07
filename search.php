<?php
/**
 * Search Results Template
 *
 * @package Linkawy
 */

get_header();
?>

    <!-- Search Hero -->
    <section class="blog-hero">
        <div class="container">
            <h1><?php printf(__('نتائج البحث عن: %s', 'linkawy'), '<span>' . get_search_query() . '</span>'); ?></h1>
            <p class="blog-hero-description">
                <?php
                global $wp_query;
                printf(
                    _n('تم العثور على %d نتيجة', 'تم العثور على %d نتيجة', $wp_query->found_posts, 'linkawy'),
                    $wp_query->found_posts
                );
                ?>
            </p>
            
            <!-- Search Form -->
            <div class="search-form-hero">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <input type="search" class="search-field" placeholder="<?php esc_attr_e('ابحث مجدداً...', 'linkawy'); ?>" value="<?php echo get_search_query(); ?>" name="s">
                    <button type="submit" class="search-submit">
                        <i class="fas fa-search"></i> <?php _e('بحث', 'linkawy'); ?>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Search Results Grid -->
    <section class="blog-grid-section">
        <div class="container">
            <?php if (have_posts()) : ?>
                <div class="blog-grid">
                    <?php
                    while (have_posts()) : the_post();
                        if (get_post_type() === 'glossary') :
                            get_template_part('template-parts/content', 'glossary');
                        else :
                            get_template_part('template-parts/content', 'post');
                        endif;
                    endwhile;
                    ?>
                </div>

                <?php linkawy_pagination(); ?>

            <?php else : ?>
                <div class="no-results">
                    <h2><?php _e('لم نعثر على نتائج', 'linkawy'); ?></h2>
                    <p><?php _e('عذراً، لم نتمكن من العثور على ما تبحث عنه. جرب كلمات بحث مختلفة.', 'linkawy'); ?></p>
                    
                    <div class="search-suggestions">
                        <h3><?php _e('اقتراحات:', 'linkawy'); ?></h3>
                        <ul>
                            <li><?php _e('تأكد من كتابة الكلمات بشكل صحيح', 'linkawy'); ?></li>
                            <li><?php _e('جرب كلمات بحث أكثر عمومية', 'linkawy'); ?></li>
                            <li><?php _e('جرب كلمات بحث مختلفة', 'linkawy'); ?></li>
                        </ul>
                    </div>
                    
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="cta-button"><?php _e('العودة للرئيسية', 'linkawy'); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTA Banner -->
    <?php get_template_part('template-parts/cta-banner'); ?>

<?php
get_footer();
