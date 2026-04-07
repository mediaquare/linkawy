<?php
/**
 * 404 Page Template
 *
 * @package Linkawy
 */

get_header();
?>

    <!-- 404 Section -->
    <section class="error-404-section">
        <div class="container">
            <div class="error-404-content">
                <div class="error-404-icon">
                    <i class="fas fa-compass"></i>
                </div>
                <h1 class="error-404-title">404</h1>
                <h2 class="error-404-subtitle"><?php _e('عفواً! الصفحة غير موجودة', 'linkawy'); ?></h2>
                <p class="error-404-desc"><?php _e('يبدو أن الصفحة التي تبحث عنها غير موجودة أو تم نقلها أو حذفها.', 'linkawy'); ?></p>
                
                <div class="error-404-actions">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="cta-button">
                        <i class="fas fa-home"></i>
                        <?php _e('العودة للرئيسية', 'linkawy'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php
    // Get popular posts
    $popular_posts = new WP_Query(array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));

    if ($popular_posts->have_posts()) :
    ?>
    <!-- Popular Posts -->
    <section class="blog-grid-section error-404-posts">
        <div class="container">
            <div class="error-404-posts-header">
                <h2 class="section-title-sm"><?php _e('مقالات قد تهمك', 'linkawy'); ?></h2>
                <p class="error-404-posts-desc"><?php _e('استكشف بعض المقالات المفيدة من مدونتنا', 'linkawy'); ?></p>
            </div>
            <div class="blog-grid">
                <?php
                while ($popular_posts->have_posts()) : $popular_posts->the_post();
                    get_template_part('template-parts/content', 'post');
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

<?php
get_footer();
