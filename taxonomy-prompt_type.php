<?php
/**
 * Taxonomy Archive: prompt_type
 *
 * Same layout as prompts archive (hero + AJAX filter + search + grid). Used for URLs like /prompts/type-slug/
 *
 * @package Linkawy
 */

get_header();

$is_tax = is_tax('prompt_type');
$current_term = $is_tax ? get_queried_object() : null;
$current_slug = $current_term && !is_wp_error($current_term) ? $current_term->slug : '';
$prompt_types = get_terms(array(
    'taxonomy'   => 'prompt_type',
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
));
$prompt_tags = get_terms(array(
    'taxonomy'   => 'prompt_tag',
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
));
$current_tag_slug = isset($_GET['prompt_tag']) ? sanitize_text_field(wp_unslash($_GET['prompt_tag'])) : '';
$term_subtitle = '';
if ($current_term && !is_wp_error($current_term)) {
    $term_subtitle = term_description($current_term->term_id, 'prompt_type');
}
?>

<section class="service-hero resource-hero-saas prompt-hero-no-media prompts-resource-hero">
    <div class="resource-hero-bg-deco" aria-hidden="true"></div>
    <div class="container service-hero-inner">
        <div class="service-hero-content">
            <?php linkawy_breadcrumbs(); ?>
            <h1 class="service-hero-title"><?php echo $current_term && !is_wp_error($current_term) ? esc_html($current_term->name) : esc_html__('أوامر الذكاء الاصطناعى لـ التسويق بالمحتوى والـ SEO', 'linkawy'); ?></h1>
            <?php if ($current_term && !is_wp_error($current_term)) : ?>
                <span class="resource-type-badge resource-type-badge-capsule">
                    <span class="resource-type-badge-text"><?php esc_html_e('نوع البرومبت', 'linkawy'); ?></span>
                </span>
            <?php endif; ?>
            <p class="service-hero-subtitle"><?php echo $term_subtitle !== '' ? wp_kses_post($term_subtitle) : esc_html(__('مكتبة قوالب مطالبات الذكاء الاصطناعي الجهازة (AI Prompts) لتسريع إنتاجيتك وإبداعك. اكتشف أوامر الذكاء الاصطناعي الجاهزة لكتابة المحتوى وتحسين محركات البحث والمزيد.', 'linkawy')); ?></p>
            <form id="prompts-search-form" class="prompt-search-bar prompt-archive-hero-search" role="search" aria-label="<?php esc_attr_e('بحث في البرومبتات', 'linkawy'); ?>" autocomplete="off">
                <label for="prompts-search-input" class="screen-reader-text"><?php _e('ابحث عن برومبت', 'linkawy'); ?></label>
                <input type="search" id="prompts-search-input" name="s" class="prompt-search-input" placeholder="<?php esc_attr_e('ابحث عن أمر (مثل: افكار، كتابة، تحليل...)', 'linkawy'); ?>" value="<?php echo get_search_query() ? esc_attr(get_search_query()) : ''; ?>" autocomplete="off" inputmode="search">
            </form>
            <?php if (!is_wp_error($prompt_tags) && !empty($prompt_tags)) : ?>
                <div class="prompt-tag-capsules-wrap" id="prompts-tag-filters" aria-label="<?php esc_attr_e('فلترة بالوسوم', 'linkawy'); ?>">
                    <div class="prompt-tag-capsules">
                        <button type="button" class="prompt-tag-capsule<?php echo $current_tag_slug === '' ? ' active' : ''; ?>" data-prompt-tag=""><?php esc_html_e('كل الأوامر', 'linkawy'); ?></button>
                        <?php foreach ($prompt_tags as $pt) : ?>
                            <button type="button" class="prompt-tag-capsule<?php echo $current_tag_slug === $pt->slug ? ' active' : ''; ?>" data-prompt-tag="<?php echo esc_attr($pt->slug); ?>" data-prompt-tag-id="<?php echo (int) $pt->term_id; ?>"><?php echo esc_html($pt->name); ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="page-content-section prompt-archive-wrap blog-grid-section prompt-archive-grid-section">
    <div class="container">
        <div id="prompts-grid-wrap" class="prompts-grid-wrap">
            <div class="prompts-loading" id="prompts-loading" aria-hidden="true"></div>
            <div id="prompts-grid" class="blog-grid">
                <?php if (have_posts()) : ?>
                    <?php
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/content', 'prompt');
                    endwhile;
                    ?>
                <?php else : ?>
                    <p class="no-posts"><?php _e('لا توجد برومبتات في هذا النوع.', 'linkawy'); ?></p>
                <?php endif; ?>
            </div>
            <div id="prompts-pagination" class="prompts-pagination-wrap">
                <?php if (have_posts()) { linkawy_pagination(); } ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
