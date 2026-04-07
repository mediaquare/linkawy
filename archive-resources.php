<?php
/**
 * Archive Template for Resources CPT
 *
 * Hero with title "قوالب وأدوات مجانية", filter links by resource_type, grid of resource cards.
 *
 * @package Linkawy
 */

get_header();

$is_tax = is_tax('resource_type');
$current_term = $is_tax ? get_queried_object() : null;
?>

    <section class="blog-hero">
        <div class="container">
            <h1><?php _e('قوالب وأدوات مجانية', 'linkawy'); ?></h1>
            <p class="blog-hero-description">
                <?php _e('قوالب جاهزة، أدوات، وإضافات مجانية لمساعدتك في العمل والتحليل.', 'linkawy'); ?>
            </p>
            <div class="blog-categories">
                <a href="<?php echo esc_url(get_post_type_archive_link('resources')); ?>" class="category-filter<?php echo !$is_tax ? ' active' : ''; ?>"><?php _e('الكل', 'linkawy'); ?></a>
                <?php
                $resource_types = get_terms(array(
                    'taxonomy'   => 'resource_type',
                    'hide_empty' => true,
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                ));
                if (!is_wp_error($resource_types)) :
                    foreach ($resource_types as $term) :
                        $is_active = $is_tax && $current_term && (int) $current_term->term_id === (int) $term->term_id;
                ?>
                    <a href="<?php echo esc_url(get_term_link($term)); ?>" class="category-filter<?php echo $is_active ? ' active' : ''; ?>"><?php echo esc_html($term->name); ?></a>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>

    <section class="blog-grid-section">
        <div class="container">
            <?php if (have_posts()) : ?>
                <div class="blog-grid">
                    <?php
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/content', 'resource');
                    endwhile;
                    ?>
                </div>
                <?php linkawy_pagination(); ?>
            <?php else : ?>
                <p class="no-posts"><?php _e('لا توجد موارد حتى الآن.', 'linkawy'); ?></p>
            <?php endif; ?>
        </div>
    </section>

<?php
get_footer();
