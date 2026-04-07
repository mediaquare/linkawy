<?php
/**
 * Archive Template
 *
 * @package Linkawy
 */

get_header();
?>

    <!-- Blog Hero -->
    <section class="blog-hero">
        <div class="container">
            <h1>
                <?php
                if (is_category()) {
                    single_cat_title();
                } elseif (is_tag()) {
                    single_tag_title();
                } elseif (is_author()) {
                    the_author();
                } elseif (is_date()) {
                    if (is_year()) {
                        echo get_the_date('Y');
                    } elseif (is_month()) {
                        echo get_the_date('F Y');
                    } elseif (is_day()) {
                        echo get_the_date('j F Y');
                    }
                } else {
                    _e('الأرشيف', 'linkawy');
                }
                ?>
            </h1>
            <?php if (is_category() && category_description()) : ?>
                <p class="blog-hero-description"><?php echo category_description(); ?></p>
            <?php endif; ?>
            
            <div class="blog-categories">
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="category-filter"><?php _e('الكل', 'linkawy'); ?></a>
                <?php
                $categories = get_categories(array(
                    'orderby' => 'count',
                    'order'   => 'DESC',
                    'number'  => 5,
                ));
                foreach ($categories as $category) :
                    $active_class = (is_category($category->term_id)) ? 'active' : '';
                ?>
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="category-filter <?php echo $active_class; ?>"><?php echo esc_html($category->name); ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Posts Grid -->
    <section class="blog-grid-section">
        <div class="container">
            <?php if (have_posts()) : ?>
                <div class="blog-grid">
                    <?php
                    while (have_posts()) : the_post();
                        get_template_part('template-parts/content', 'post');
                    endwhile;
                    ?>
                </div>

                <?php linkawy_pagination(); ?>

            <?php else : ?>
                <p class="no-posts"><?php _e('لا توجد مقالات في هذا التصنيف.', 'linkawy'); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Subscription Box -->
    <?php get_template_part('template-parts/newsletter'); ?>

    <!-- CTA Banner -->
    <?php get_template_part('template-parts/cta-banner'); ?>

<?php
get_footer();
