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
                $post_count = 0;
                while (have_posts()) : the_post();
                    $post_count++;

                    if ($post_count === 1) :
                ?>
                    <!-- Featured Post -->
                    <article class="featured-post">
                        <div class="featured-content">
                            <h2 class="featured-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p class="featured-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 40); ?></p>
                            <div class="featured-meta">
                                <?php
                                $feat_cats = get_the_category();
                                if ($feat_cats && !empty($feat_cats[0]->name)) :
                                ?>
                                    <a href="<?php echo esc_url(get_category_link($feat_cats[0]->term_id)); ?>" class="featured-category"><?php echo esc_html($feat_cats[0]->name); ?></a>
                                    <span class="featured-meta-sep" aria-hidden="true">·</span>
                                <?php endif; ?>
                                <span class="featured-read-time"><?php echo esc_html(linkawy_reading_time()); ?></span>
                                <span class="featured-meta-sep" aria-hidden="true">·</span>
                                <time class="featured-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('j F Y')); ?></time>
                            </div>
                        </div>
                    </article>

                    <!-- 2-column row -->
                    <div class="blog-grid blog-grid--2col">
                <?php
                    else :
                        if ($post_count === 4) : ?>
                            </div>
                            <!-- 3-column row -->
                            <div class="blog-grid">
                        <?php endif;
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

    <!-- Help CTA Banner -->
    <section class="container">
        <div class="help-cta">
            <div class="help-cta-content">
                <h3><?php _e('دورة <span class="cta-highlight">Next-Gen SEO</span> المتقدمة', 'linkawy'); ?></h3>
                <p><?php _e('تعلّم استراتيجيات SEO المتقدمة التي يستخدمها المحترفون لتصدر نتائج البحث وبناء حركة مرور مستدامة لموقعك.', 'linkawy'); ?></p>
            </div>
            <div class="help-cta-btn">
                <a href="https://wa.me/201063676963?text=<?php echo rawurlencode('مرحبًا، أريد الانضمام إلى دورة Next-Gen SEO'); ?>" target="_blank" rel="noopener" class="btn-orange"><?php _e('الانضمام إلى الدورة', 'linkawy'); ?> <i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
    </section>

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
                    <h4 class="editor-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <p class="editor-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
                    <div class="editor-card-top-meta">
                        <?php
                        $categories = get_the_category();
                        if ($categories && !empty($categories[0]->name)) :
                        ?>
                            <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="blog-card-category"><?php echo esc_html($categories[0]->name); ?></a>
                        <?php endif; ?>
                        <span class="blog-card-read-time"><?php echo esc_html(linkawy_reading_time()); ?></span>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Subscription Box -->
    <?php get_template_part('template-parts/newsletter'); ?>

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
            'posts_per_page' => 6,
            'cat'            => $blog_cat->term_id,
        ));
        
        if ($cat_posts->have_posts()) :
    ?>
    <!-- Category Section: <?php echo esc_html($blog_cat->name); ?> -->
    <section class="blog-grid-section category-section<?php echo !$is_first ? ' category-section--follow' : ''; ?>">
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
