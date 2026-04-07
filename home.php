<?php
/**
 * Blog Archive Template (home.php)
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
            <div class="blog-categories">
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="category-filter active"><?php _e('الكل', 'linkawy'); ?></a>
                <?php
                $categories = get_categories(array(
                    'orderby' => 'count',
                    'order'   => 'DESC',
                    'number'  => 5,
                ));
                foreach ($categories as $category) :
                ?>
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="category-filter"><?php echo esc_html($category->name); ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Latest Posts Grid -->
    <section class="blog-grid-section">
        <div class="container">
            <?php if (have_posts()) : ?>
                
                <?php
                // Featured Post (first post)
                $post_count = 0;
                while (have_posts()) : the_post();
                    $post_count++;
                    
                    if ($post_count === 1) :
                ?>
                    <!-- Featured Post -->
                    <article class="featured-post">
                        <div class="featured-image" style="background: linear-gradient(135deg, #D4F58D 0%, #a8e063 100%);">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('linkawy-featured'); ?>
                            <?php endif; ?>
                        </div>
                        <div class="featured-content">
                            <span class="featured-badge"><i class="fas fa-star"></i> <?php _e('مقال مميز', 'linkawy'); ?></span>
                            <h2 class="featured-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p class="featured-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 35); ?></p>
                            <div class="featured-meta">
                                <span><i class="far fa-clock"></i> <?php echo linkawy_reading_time(); ?></span>
                                <span><i class="far fa-user"></i> <?php the_author(); ?></span>
                                <span><i class="far fa-calendar"></i> <?php echo get_the_date('j F Y'); ?></span>
                            </div>
                        </div>
                    </article>

                    <div class="blog-grid">
                <?php
                    else :
                        get_template_part('template-parts/content', 'post');
                    endif;
                endwhile;
                ?>
                    </div>

                <?php linkawy_pagination(); ?>

            <?php else : ?>
                <p class="no-posts"><?php _e('لا توجد مقالات حتى الآن.', 'linkawy'); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Subscription Box -->
    <?php get_template_part('template-parts/newsletter'); ?>

    <!-- Editors' Choice -->
    <?php
    $editors_picks = new WP_Query(array(
        'post_type'      => 'post',
        'posts_per_page' => 4,
        'meta_key'       => '_is_editors_pick',
        'meta_value'     => '1',
    ));
    
    // Fallback to recent posts if no editors picks
    if (!$editors_picks->have_posts()) {
        $editors_picks = new WP_Query(array(
            'post_type'      => 'post',
            'posts_per_page' => 4,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'offset'         => 7, // Skip first 7 posts (1 featured + 6 in grid)
        ));
    }
    
    if ($editors_picks->have_posts()) :
    ?>
    <section class="editors-choice">
        <div class="container">
            <h2 class="section-title-sm"><?php _e('اختيارات المحرر', 'linkawy'); ?></h2>
            <p class="section-subtitle"><?php _e('أفضل المقالات التي تم نشرها، تم اختيارها بعناية لتستمتع بقراءتها', 'linkawy'); ?></p>
            <div class="editors-grid">
                <?php while ($editors_picks->have_posts()) : $editors_picks->the_post(); ?>
                <div class="editor-card">
                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
                    <div class="editor-card-meta">
                        <?php 
                        $categories = get_the_category();
                        if ($categories) : ?>
                        <span><i class="fas fa-tag"></i> <?php echo esc_html($categories[0]->name); ?></span>
                        <?php endif; ?>
                        <span><i class="far fa-clock"></i> <?php echo linkawy_reading_time(); ?></span>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Help CTA Banner -->
    <section class="container">
        <div class="help-cta">
            <div class="help-cta-icon">
                <i class="fas fa-rocket"></i>
            </div>
            <div class="help-cta-content">
                <h3><?php _e('تحتاج مساعدة في تحسين موقعك؟', 'linkawy'); ?></h3>
                <p><?php _e('تواصل مع فريقنا من الخبراء واحصل على خطة عمل مخصصة لرفع ترتيب موقعك وزيادة مبيعاتك.', 'linkawy'); ?></p>
            </div>
            <div class="help-cta-btn">
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn-orange"><?php _e('تواصل معنا للاستشارة', 'linkawy'); ?> <i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
    </section>

    <?php
    // Get all categories with posts
    $blog_categories = get_categories(array(
        'orderby'    => 'count',
        'order'      => 'DESC',
        'number'     => 3,
        'hide_empty' => true,
    ));
    
    $is_first = true;
    foreach ($blog_categories as $blog_cat) :
        $cat_posts = new WP_Query(array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'cat'            => $blog_cat->term_id,
        ));
        
        if ($cat_posts->have_posts()) :
    ?>
    <!-- Category Section: <?php echo esc_html($blog_cat->name); ?> -->
    <section class="blog-grid-section category-section" style="background: #fff;<?php echo !$is_first ? ' padding-top: 0;' : ''; ?>">
        <div class="container">
            <div class="section-header-row">
                <h2 class="section-title-sm"><?php echo esc_html($blog_cat->name); ?></h2>
                <a href="<?php echo esc_url(get_category_link($blog_cat->term_id)); ?>" class="view-all"><?php _e('عرض الكل', 'linkawy'); ?> <i class="fas fa-arrow-left"></i></a>
            </div>
            <div class="blog-grid">
                <?php 
                while ($cat_posts->have_posts()) : $cat_posts->the_post();
                    get_template_part('template-parts/content', 'post');
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
    <?php 
        $is_first = false;
        endif;
    endforeach;
    ?>

    <!-- CTA Banner -->
    <?php get_template_part('template-parts/cta-banner'); ?>

<?php
get_footer();
