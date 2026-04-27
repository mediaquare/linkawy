<?php
/**
 * Custom Post Types
 *
 * @package Linkawy
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Glossary Custom Post Type
 */
function linkawy_register_glossary_cpt() {
    $locale = function_exists('get_user_locale') ? get_user_locale() : get_locale();
    $is_ar  = (is_string($locale) && strpos($locale, 'ar') === 0);

    $labels_ar = array(
        'name'                  => _x('مصطلحات', 'Post Type General Name', 'linkawy'),
        'singular_name'         => _x('مصطلح', 'Post Type Singular Name', 'linkawy'),
        'menu_name'             => __('مصطلحات', 'linkawy'),
        'name_admin_bar'        => __('مصطلح', 'linkawy'),
        'archives'              => __('أرشيف المصطلحات', 'linkawy'),
        'attributes'            => __('خصائص المصطلح', 'linkawy'),
        'parent_item_colon'     => __('المصطلح الأب:', 'linkawy'),
        'all_items'             => __('جميع المصطلحات', 'linkawy'),
        'add_new_item'          => __('إضافة مصطلح جديد', 'linkawy'),
        'add_new'               => __('إضافة مصطلح', 'linkawy'),
        'new_item'              => __('مصطلح جديد', 'linkawy'),
        'edit_item'             => __('تعديل المصطلح', 'linkawy'),
        'update_item'           => __('تحديث المصطلح', 'linkawy'),
        'view_item'             => __('عرض المصطلح', 'linkawy'),
        'view_items'            => __('عرض المصطلحات', 'linkawy'),
        'search_items'          => __('بحث في المصطلحات', 'linkawy'),
        'not_found'             => __('لم يتم العثور على مصطلحات', 'linkawy'),
        'not_found_in_trash'    => __('لم يتم العثور على مصطلحات في سلة المهملات', 'linkawy'),
        'featured_image'        => __('صورة المصطلح', 'linkawy'),
        'set_featured_image'    => __('تعيين صورة المصطلح', 'linkawy'),
        'remove_featured_image' => __('إزالة صورة المصطلح', 'linkawy'),
        'use_featured_image'    => __('استخدام كصورة المصطلح', 'linkawy'),
        'insert_into_item'      => __('إدراج في المصطلح', 'linkawy'),
        'uploaded_to_this_item' => __('تم الرفع لهذا المصطلح', 'linkawy'),
        'items_list'            => __('قائمة المصطلحات', 'linkawy'),
        'items_list_navigation' => __('تنقل قائمة المصطلحات', 'linkawy'),
        'filter_items_list'     => __('فلترة قائمة المصطلحات', 'linkawy'),
    );

    $labels_en = array(
        'name'                  => _x('Glossary', 'Post Type General Name', 'linkawy'),
        'singular_name'         => _x('Term', 'Post Type Singular Name', 'linkawy'),
        'menu_name'             => __('Glossary', 'linkawy'),
        'name_admin_bar'        => __('Term', 'linkawy'),
        'archives'              => __('Glossary Archives', 'linkawy'),
        'attributes'            => __('Term Attributes', 'linkawy'),
        'parent_item_colon'     => __('Parent Term:', 'linkawy'),
        'all_items'             => __('All Terms', 'linkawy'),
        'add_new_item'          => __('Add New Term', 'linkawy'),
        'add_new'               => __('Add New', 'linkawy'),
        'new_item'              => __('New Term', 'linkawy'),
        'edit_item'             => __('Edit Term', 'linkawy'),
        'update_item'           => __('Update Term', 'linkawy'),
        'view_item'             => __('View Term', 'linkawy'),
        'view_items'            => __('View Terms', 'linkawy'),
        'search_items'          => __('Search Terms', 'linkawy'),
        'not_found'             => __('No terms found', 'linkawy'),
        'not_found_in_trash'    => __('No terms found in Trash', 'linkawy'),
        'featured_image'        => __('Term Image', 'linkawy'),
        'set_featured_image'    => __('Set term image', 'linkawy'),
        'remove_featured_image' => __('Remove term image', 'linkawy'),
        'use_featured_image'    => __('Use as term image', 'linkawy'),
        'insert_into_item'      => __('Insert into term', 'linkawy'),
        'uploaded_to_this_item' => __('Uploaded to this term', 'linkawy'),
        'items_list'            => __('Terms list', 'linkawy'),
        'items_list_navigation' => __('Terms list navigation', 'linkawy'),
        'filter_items_list'     => __('Filter terms list', 'linkawy'),
    );

    $labels = $is_ar ? $labels_ar : $labels_en;

    $args = array(
        'label'               => __('مصطلح', 'linkawy'),
        'description'         => __('قاموس مصطلحات السيو والتسويق الرقمي', 'linkawy'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'author', 'custom-fields', 'revisions'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-book-alt',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => 'glossary',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'rewrite'             => array(
            'slug'       => 'glossary',
            'with_front' => false,
        ),
    );

    register_post_type('glossary', $args);
}
add_action('init', 'linkawy_register_glossary_cpt', 0);

/**
 * Glossary archive: load all terms in the main query (matches archive-glossary.php).
 * Avoids phantom pagination so plugins (e.g. Rank Math) do not output rel="next" to /glossary/page/2/.
 *
 * @param WP_Query $query WordPress query object.
 */
function linkawy_glossary_archive_pre_get_posts($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }
    if (!$query->is_post_type_archive('glossary')) {
        return;
    }
    $query->set('posts_per_page', -1);
}
add_action('pre_get_posts', 'linkawy_glossary_archive_pre_get_posts');

/**
 * Rank Math: disable rel prev/next on glossary archive (single-page index).
 *
 * @param bool $disable Whether adjacent rel links are disabled.
 * @return bool
 */
function linkawy_rank_math_disable_glossary_adjacent_rel($disable) {
    if (is_post_type_archive('glossary')) {
        return true;
    }
    return $disable;
}
add_filter('rank_math/frontend/disable_adjacent_rel_links', 'linkawy_rank_math_disable_glossary_adjacent_rel', 10, 1);

/**
 * Register Resources Custom Post Type
 */
function linkawy_register_resources_cpt() {
    $locale = function_exists('get_user_locale') ? get_user_locale() : get_locale();
    $is_ar  = (is_string($locale) && strpos($locale, 'ar') === 0);

    $labels_ar = array(
        'name'                  => _x('الموارد', 'Post Type General Name', 'linkawy'),
        'singular_name'         => _x('مورد', 'Post Type Singular Name', 'linkawy'),
        'menu_name'             => __('الموارد', 'linkawy'),
        'name_admin_bar'        => __('مورد', 'linkawy'),
        'archives'              => __('أرشيف الموارد', 'linkawy'),
        'attributes'            => __('خصائص المورد', 'linkawy'),
        'parent_item_colon'     => __('المورد الأب:', 'linkawy'),
        'all_items'             => __('جميع الموارد', 'linkawy'),
        'add_new_item'          => __('إضافة مورد جديد', 'linkawy'),
        'add_new'               => __('إضافة مورد', 'linkawy'),
        'new_item'              => __('مورد جديد', 'linkawy'),
        'edit_item'             => __('تعديل المورد', 'linkawy'),
        'update_item'           => __('تحديث المورد', 'linkawy'),
        'view_item'             => __('عرض المورد', 'linkawy'),
        'view_items'            => __('عرض الموارد', 'linkawy'),
        'search_items'          => __('بحث في الموارد', 'linkawy'),
        'not_found'             => __('لم يتم العثور على موارد', 'linkawy'),
        'not_found_in_trash'    => __('لم يتم العثور على موارد في سلة المهملات', 'linkawy'),
        'featured_image'        => __('صورة المورد', 'linkawy'),
        'set_featured_image'    => __('تعيين صورة المورد', 'linkawy'),
        'remove_featured_image' => __('إزالة صورة المورد', 'linkawy'),
        'use_featured_image'    => __('استخدام كصورة المورد', 'linkawy'),
        'insert_into_item'      => __('إدراج في المورد', 'linkawy'),
        'uploaded_to_this_item' => __('تم الرفع لهذا المورد', 'linkawy'),
        'items_list'            => __('قائمة الموارد', 'linkawy'),
        'items_list_navigation' => __('تنقل قائمة الموارد', 'linkawy'),
        'filter_items_list'     => __('فلترة قائمة الموارد', 'linkawy'),
    );

    $labels_en = array(
        'name'                  => _x('Resources', 'Post Type General Name', 'linkawy'),
        'singular_name'         => _x('Resource', 'Post Type Singular Name', 'linkawy'),
        'menu_name'             => __('Resources', 'linkawy'),
        'name_admin_bar'        => __('Resource', 'linkawy'),
        'archives'              => __('Resources Archives', 'linkawy'),
        'attributes'            => __('Resource Attributes', 'linkawy'),
        'parent_item_colon'     => __('Parent Resource:', 'linkawy'),
        'all_items'             => __('All Resources', 'linkawy'),
        'add_new_item'          => __('Add New Resource', 'linkawy'),
        'add_new'               => __('Add New', 'linkawy'),
        'new_item'              => __('New Resource', 'linkawy'),
        'edit_item'             => __('Edit Resource', 'linkawy'),
        'update_item'           => __('Update Resource', 'linkawy'),
        'view_item'             => __('View Resource', 'linkawy'),
        'view_items'            => __('View Resources', 'linkawy'),
        'search_items'          => __('Search Resources', 'linkawy'),
        'not_found'             => __('No resources found', 'linkawy'),
        'not_found_in_trash'    => __('No resources found in Trash', 'linkawy'),
        'featured_image'        => __('Resource Image', 'linkawy'),
        'set_featured_image'    => __('Set resource image', 'linkawy'),
        'remove_featured_image' => __('Remove resource image', 'linkawy'),
        'use_featured_image'    => __('Use as resource image', 'linkawy'),
        'insert_into_item'      => __('Insert into resource', 'linkawy'),
        'uploaded_to_this_item' => __('Uploaded to this resource', 'linkawy'),
        'items_list'            => __('Resources list', 'linkawy'),
        'items_list_navigation' => __('Resources list navigation', 'linkawy'),
        'filter_items_list'     => __('Filter resources list', 'linkawy'),
    );

    $labels = $is_ar ? $labels_ar : $labels_en;

    $args = array(
        'label'               => __('مورد', 'linkawy'),
        'description'         => __('قوالب وأدوات مجانية', 'linkawy'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-portfolio',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => 'resources',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'rewrite'             => array(
            'slug'       => 'resources',
            'with_front' => false,
        ),
    );

    register_post_type('resources', $args);
}
add_action('init', 'linkawy_register_resources_cpt', 0);

/**
 * Register resource_type taxonomy for Resources CPT
 */
function linkawy_register_resource_type_taxonomy() {
    $labels = array(
        'name'              => _x('أنواع الموارد', 'taxonomy general name', 'linkawy'),
        'singular_name'     => _x('نوع المورد', 'taxonomy singular name', 'linkawy'),
        'search_items'      => __('بحث في الأنواع', 'linkawy'),
        'all_items'         => __('جميع الأنواع', 'linkawy'),
        'parent_item'       => __('النوع الأب', 'linkawy'),
        'parent_item_colon' => __('النوع الأب:', 'linkawy'),
        'edit_item'         => __('تعديل النوع', 'linkawy'),
        'update_item'       => __('تحديث النوع', 'linkawy'),
        'add_new_item'      => __('إضافة نوع جديد', 'linkawy'),
        'new_item_name'     => __('اسم النوع الجديد', 'linkawy'),
        'menu_name'         => __('أنواع الموارد', 'linkawy'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column'  => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'resources', 'with_front' => false),
    );

    register_taxonomy('resource_type', array('resources'), $args);
}
add_action('init', 'linkawy_register_resource_type_taxonomy', 5);

/**
 * Resolve /resources/{slug}/: if slug is a resource_type term (not a post), serve taxonomy archive.
 * (CPT single rewrite matches first; this fixes 404 by rewriting the request to taxonomy.)
 */
function linkawy_resolve_resources_slug_to_taxonomy($request) {
    if (empty($request['resources']) || !empty($request['resource_type'])) {
        return $request;
    }
    $slug = $request['resources'];
    if (get_page_by_path($slug, OBJECT, 'resources')) {
        return $request;
    }
    $term = get_term_by('slug', $slug, 'resource_type');
    if (!$term || is_wp_error($term)) {
        return $request;
    }
    $request['resource_type'] = $slug;
    unset($request['resources']);
    unset($request['name']);
    return $request;
}
add_filter('request', 'linkawy_resolve_resources_slug_to_taxonomy', 10, 1);

/**
 * Register Prompts Custom Post Type
 */
function linkawy_register_prompts_cpt() {
    $locale = function_exists('get_user_locale') ? get_user_locale() : get_locale();
    $is_ar  = (is_string($locale) && strpos($locale, 'ar') === 0);

    $labels_ar = array(
        'name'                  => _x('أوامر AI', 'Post Type General Name', 'linkawy'),
        'singular_name'         => _x('أمر AI', 'Post Type Singular Name', 'linkawy'),
        'menu_name'             => __('أوامر AI', 'linkawy'),
        'name_admin_bar'        => __('أمر AI', 'linkawy'),
        'archives'              => __('أرشيف أوامر AI', 'linkawy'),
        'attributes'            => __('خصائص أمر AI', 'linkawy'),
        'parent_item_colon'     => __('الأمر الأب:', 'linkawy'),
        'all_items'             => __('جميع أوامر AI', 'linkawy'),
        'add_new_item'          => __('إضافة أمر AI جديد', 'linkawy'),
        'add_new'               => __('إضافة أمر AI', 'linkawy'),
        'new_item'              => __('أمر AI جديد', 'linkawy'),
        'edit_item'             => __('تعديل أمر AI', 'linkawy'),
        'update_item'           => __('تحديث أمر AI', 'linkawy'),
        'view_item'             => __('عرض أمر AI', 'linkawy'),
        'view_items'            => __('عرض أوامر AI', 'linkawy'),
        'search_items'          => __('بحث في أوامر AI', 'linkawy'),
        'not_found'             => __('لم يتم العثور على أوامر AI', 'linkawy'),
        'not_found_in_trash'    => __('لم يتم العثور على أوامر AI في سلة المهملات', 'linkawy'),
        'featured_image'        => __('صورة أمر AI', 'linkawy'),
        'set_featured_image'    => __('تعيين صورة أمر AI', 'linkawy'),
        'remove_featured_image' => __('إزالة صورة أمر AI', 'linkawy'),
        'use_featured_image'    => __('استخدام كصورة أمر AI', 'linkawy'),
        'insert_into_item'      => __('إدراج في أمر AI', 'linkawy'),
        'uploaded_to_this_item' => __('تم الرفع لهذا الأمر', 'linkawy'),
        'items_list'            => __('قائمة أوامر AI', 'linkawy'),
        'items_list_navigation' => __('تنقل قائمة أوامر AI', 'linkawy'),
        'filter_items_list'     => __('فلترة قائمة أوامر AI', 'linkawy'),
    );

    $labels_en = array(
        'name'                  => _x('Prompts', 'Post Type General Name', 'linkawy'),
        'singular_name'         => _x('Prompt', 'Post Type Singular Name', 'linkawy'),
        'menu_name'             => __('Prompts', 'linkawy'),
        'name_admin_bar'        => __('Prompt', 'linkawy'),
        'archives'              => __('Prompts Archives', 'linkawy'),
        'attributes'            => __('Prompt Attributes', 'linkawy'),
        'parent_item_colon'     => __('Parent Prompt:', 'linkawy'),
        'all_items'             => __('All Prompts', 'linkawy'),
        'add_new_item'          => __('Add New Prompt', 'linkawy'),
        'add_new'               => __('Add New', 'linkawy'),
        'new_item'              => __('New Prompt', 'linkawy'),
        'edit_item'             => __('Edit Prompt', 'linkawy'),
        'update_item'           => __('Update Prompt', 'linkawy'),
        'view_item'             => __('View Prompt', 'linkawy'),
        'view_items'            => __('View Prompts', 'linkawy'),
        'search_items'          => __('Search Prompts', 'linkawy'),
        'not_found'             => __('No prompts found', 'linkawy'),
        'not_found_in_trash'    => __('No prompts found in Trash', 'linkawy'),
        'featured_image'        => __('Prompt Image', 'linkawy'),
        'set_featured_image'    => __('Set prompt image', 'linkawy'),
        'remove_featured_image' => __('Remove prompt image', 'linkawy'),
        'use_featured_image'    => __('Use as prompt image', 'linkawy'),
        'insert_into_item'      => __('Insert into prompt', 'linkawy'),
        'uploaded_to_this_item' => __('Uploaded to this prompt', 'linkawy'),
        'items_list'            => __('Prompts list', 'linkawy'),
        'items_list_navigation' => __('Prompts list navigation', 'linkawy'),
        'filter_items_list'     => __('Filter prompts list', 'linkawy'),
    );

    $labels = $is_ar ? $labels_ar : $labels_en;

    $args = array(
        'label'               => __('أمر AI', 'linkawy'),
        'description'         => __('مكتبة أوامر الذكاء الاصطناعي', 'linkawy'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'),
        'hierarchical'       => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 7,
        'menu_icon'           => 'dashicons-format-chat',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => 'prompts',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'rewrite'             => array(
            'slug'       => 'prompts',
            'with_front' => false,
        ),
    );

    register_post_type('prompts', $args);
}
add_action('init', 'linkawy_register_prompts_cpt', 0);

/**
 * Register prompt_type taxonomy for Prompts CPT
 */
function linkawy_register_prompt_type_taxonomy() {
    $labels = array(
        'name'              => _x('أنواع المطالبات', 'taxonomy general name', 'linkawy'),
        'singular_name'     => _x('نوع المطالبة', 'taxonomy singular name', 'linkawy'),
        'search_items'      => __('بحث في الأنواع', 'linkawy'),
        'all_items'         => __('جميع الأنواع', 'linkawy'),
        'parent_item'       => __('النوع الأب', 'linkawy'),
        'parent_item_colon' => __('النوع الأب:', 'linkawy'),
        'edit_item'         => __('تعديل النوع', 'linkawy'),
        'update_item'       => __('تحديث النوع', 'linkawy'),
        'add_new_item'      => __('إضافة نوع جديد', 'linkawy'),
        'new_item_name'     => __('اسم النوع الجديد', 'linkawy'),
        'menu_name'         => __('أنواع المطالبات', 'linkawy'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'prompts', 'with_front' => false),
    );

    register_taxonomy('prompt_type', array('prompts'), $args);
}
add_action('init', 'linkawy_register_prompt_type_taxonomy', 5);

/**
 * Register prompt_tag taxonomy (non-hierarchical tags for Prompts library)
 */
function linkawy_register_prompt_tag_taxonomy() {
    $labels = array(
        'name'              => _x('وسوم المطالبات', 'taxonomy general name', 'linkawy'),
        'singular_name'     => _x('وسم مطالبة', 'taxonomy singular name', 'linkawy'),
        'search_items'      => __('بحث في الوسوم', 'linkawy'),
        'all_items'         => __('جميع الوسوم', 'linkawy'),
        'edit_item'         => __('تعديل الوسم', 'linkawy'),
        'update_item'       => __('تحديث الوسم', 'linkawy'),
        'add_new_item'      => __('إضافة وسم جديد', 'linkawy'),
        'new_item_name'     => __('اسم الوسم الجديد', 'linkawy'),
        'menu_name'         => __('وسوم المطالبات', 'linkawy'),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        // Rules added manually in linkawy_register_prompt_tag_rewrite_rules() so they win over
        // the CPT rule ^prompts/([^/]+)/$ which would treat "tags" as a single post slug → 404.
        'rewrite'           => false,
    );

    register_taxonomy('prompt_tag', array('prompts'), $args);
}
add_action('init', 'linkawy_register_prompt_tag_taxonomy', 5);

/**
 * Pretty permalinks for prompt_tag: /prompts/tags/{term-slug}/ (priority top — before single CPT).
 */
function linkawy_register_prompt_tag_rewrite_rules() {
    add_rewrite_rule(
        '^prompts/tags/([^/]+)/page/([0-9]{1,})/?$',
        'index.php?prompt_tag=$matches[1]&paged=$matches[2]',
        'top'
    );
    add_rewrite_rule(
        '^prompts/tags/([^/]+)/?$',
        'index.php?prompt_tag=$matches[1]',
        'top'
    );
}
add_action('init', 'linkawy_register_prompt_tag_rewrite_rules', 20);

/**
 * Pretty permalinks for prompt_tag terms (taxonomy has rewrite => false; rules are manual).
 *
 * @param string $termlink Term URL.
 * @param object $term     Term object.
 * @param string $taxonomy Taxonomy name.
 * @return string
 */
function linkawy_prompt_tag_term_link($termlink, $term, $taxonomy) {
    if ($taxonomy !== 'prompt_tag' || is_wp_error($term) || empty($term->slug)) {
        return $termlink;
    }
    $base = get_post_type_archive_link('prompts');
    if (!$base || is_wp_error($base)) {
        return $termlink;
    }
    $base = untrailingslashit($base);
    return trailingslashit($base . '/tags/' . $term->slug);
}
add_filter('term_link', 'linkawy_prompt_tag_term_link', 10, 3);

/**
 * Resolve /prompts/{slug}/: if slug is a prompt_type term (not a post), serve taxonomy archive.
 */
function linkawy_resolve_prompts_slug_to_taxonomy($request) {
    if (empty($request['prompts']) || !empty($request['prompt_type'])) {
        return $request;
    }
    $slug = $request['prompts'];
    // Reserved first segment for prompt_tag pretty URLs (/prompts/tags/...); never treat as post or prompt_type.
    if ($slug === 'tags') {
        return $request;
    }
    if (get_page_by_path($slug, OBJECT, 'prompts')) {
        return $request;
    }
    $term = get_term_by('slug', $slug, 'prompt_type');
    if (!$term || is_wp_error($term)) {
        return $request;
    }
    $request['prompt_type'] = $slug;
    unset($request['prompts']);
    unset($request['name']);
    return $request;
}
add_filter('request', 'linkawy_resolve_prompts_slug_to_taxonomy', 10, 1);

/**
 * Flush rewrite rules once after prompt_tag taxonomy is added
 */
function linkawy_maybe_flush_prompt_tag_rewrite() {
    if (get_option('linkawy_prompt_tag_rewrite_v2_flushed') === 'yes') {
        return;
    }
    flush_rewrite_rules(false);
    update_option('linkawy_prompt_tag_rewrite_v2_flushed', 'yes');
}
add_action('init', 'linkawy_maybe_flush_prompt_tag_rewrite', 999);

/**
 * Flush rewrite rules once after taxonomy slug change (so /resources/type/name/ → /resources/name/)
 */
function linkawy_maybe_flush_resource_type_rewrite() {
    if (get_option('linkawy_resource_type_rewrite_flushed') === 'yes') {
        return;
    }
    flush_rewrite_rules(false);
    update_option('linkawy_resource_type_rewrite_flushed', 'yes');
}
add_action('init', 'linkawy_maybe_flush_resource_type_rewrite', 999);

/**
 * Register term meta for resource_type image
 */
function linkawy_register_resource_type_term_meta() {
    register_term_meta('resource_type', 'resource_type_image', array(
        'type'              => 'integer',
        'description'       => __('صورة/أيقونة نوع المورد', 'linkawy'),
        'single'            => true,
        'sanitize_callback' => 'absint',
        'show_in_rest'      => true,
    ));
}
add_action('init', 'linkawy_register_resource_type_term_meta', 15);

/**
 * Add image field to resource_type add form
 */
function linkawy_resource_type_add_form_fields() {
    wp_nonce_field('linkawy_resource_type_image', 'linkawy_resource_type_image_nonce');
    ?>
    <div class="form-field">
        <label for="resource_type_image"><?php _e('صورة/أيقونة النوع', 'linkawy'); ?></label>
        <div class="linkawy-term-image-wrap">
            <input type="hidden" id="resource_type_image" name="resource_type_image" value="">
            <p class="linkawy-term-image-preview"></p>
            <p>
                <button type="button" class="button linkawy-upload-term-image"><?php _e('اختيار صورة', 'linkawy'); ?></button>
                <button type="button" class="button linkawy-remove-term-image" style="display:none;"><?php _e('إزالة الصورة', 'linkawy'); ?></button>
            </p>
        </div>
    </div>
    <?php
}
add_action('resource_type_add_form_fields', 'linkawy_resource_type_add_form_fields');

/**
 * Add image field to resource_type edit form
 */
function linkawy_resource_type_edit_form_fields($term) {
    wp_nonce_field('linkawy_resource_type_image', 'linkawy_resource_type_image_nonce');
    $image_id = get_term_meta($term->term_id, 'resource_type_image', true);
    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'thumbnail') : '';
    ?>
    <tr class="form-field">
        <th scope="row"><label for="resource_type_image"><?php _e('صورة/أيقونة النوع', 'linkawy'); ?></label></th>
        <td>
            <div class="linkawy-term-image-wrap">
                <input type="hidden" id="resource_type_image" name="resource_type_image" value="<?php echo esc_attr($image_id); ?>">
                <p class="linkawy-term-image-preview">
                    <?php if ($image_url) : ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="" style="max-width:100px; height:auto; display:block; margin-bottom:8px;">
                    <?php endif; ?>
                </p>
                <p>
                    <button type="button" class="button linkawy-upload-term-image"><?php _e('اختيار صورة', 'linkawy'); ?></button>
                    <button type="button" class="button linkawy-remove-term-image" <?php echo $image_id ? '' : 'style="display:none;"'; ?>><?php _e('إزالة الصورة', 'linkawy'); ?></button>
                </p>
            </div>
        </td>
    </tr>
    <?php
}
add_action('resource_type_edit_form_fields', 'linkawy_resource_type_edit_form_fields', 10, 2);

/**
 * Save resource_type image on term create
 */
function linkawy_save_resource_type_image_created($term_id) {
    if (!isset($_POST['linkawy_resource_type_image_nonce']) ||
        !wp_verify_nonce($_POST['linkawy_resource_type_image_nonce'], 'linkawy_resource_type_image')) {
        return;
    }
    if (isset($_POST['resource_type_image'])) {
        $image_id = absint($_POST['resource_type_image']);
        update_term_meta($term_id, 'resource_type_image', $image_id);
    }
}
add_action('created_resource_type', 'linkawy_save_resource_type_image_created');

/**
 * Save resource_type image on term update
 */
function linkawy_save_resource_type_image_edited($term_id) {
    if (!isset($_POST['linkawy_resource_type_image_nonce']) ||
        !wp_verify_nonce($_POST['linkawy_resource_type_image_nonce'], 'linkawy_resource_type_image')) {
        return;
    }
    if (isset($_POST['resource_type_image'])) {
        $image_id = absint($_POST['resource_type_image']);
        update_term_meta($term_id, 'resource_type_image', $image_id);
    }
}
add_action('edited_resource_type', 'linkawy_save_resource_type_image_edited');

/**
 * Enqueue media uploader for resource_type taxonomy admin
 */
function linkawy_resource_type_admin_scripts($hook) {
    if ($hook !== 'edit-tags.php' && $hook !== 'term.php') {
        return;
    }
    if (!isset($_GET['taxonomy']) || $_GET['taxonomy'] !== 'resource_type') {
        return;
    }
    wp_enqueue_media();
    wp_add_inline_script('jquery', "
        jQuery(function($) {
            var frame;
            $(document).on('click', '.linkawy-upload-term-image', function(e) {
                e.preventDefault();
                var wrap = $(this).closest('.linkawy-term-image-wrap');
                var input = wrap.find('input[name=resource_type_image]');
                if (frame) { frame.open(); return; }
                frame = wp.media({
                    title: '" . esc_js(__('اختيار صورة', 'linkawy')) . "',
                    button: { text: '" . esc_js(__('استخدام الصورة', 'linkawy')) . "' },
                    multiple: false,
                    library: { type: 'image' }
                });
                frame.on('select', function() {
                    var att = frame.state().get('selection').first().toJSON();
                    input.val(att.id);
                    wrap.find('.linkawy-term-image-preview').html('<img src=\"' + (att.sizes && att.sizes.thumbnail ? att.sizes.thumbnail.url : att.url) + '\" style=\"max-width:100px; height:auto; display:block; margin-bottom:8px;\">');
                    wrap.find('.linkawy-remove-term-image').show();
                });
                frame.open();
            });
            $(document).on('click', '.linkawy-remove-term-image', function(e) {
                e.preventDefault();
                var wrap = $(this).closest('.linkawy-term-image-wrap');
                wrap.find('input[name=resource_type_image]').val('');
                wrap.find('.linkawy-term-image-preview').empty();
                $(this).hide();
            });
        });
    ");
}
add_action('admin_enqueue_scripts', 'linkawy_resource_type_admin_scripts');

/**
 * Register term meta for prompt_type image
 */
function linkawy_register_prompt_type_term_meta() {
    register_term_meta('prompt_type', 'prompt_type_image', array(
        'type'              => 'integer',
        'description'       => __('صورة/أيقونة نوع المطالبة', 'linkawy'),
        'single'            => true,
        'sanitize_callback' => 'absint',
        'show_in_rest'      => true,
    ));
}
add_action('init', 'linkawy_register_prompt_type_term_meta', 15);

/**
 * Add image field to prompt_type add form
 */
function linkawy_prompt_type_add_form_fields() {
    wp_nonce_field('linkawy_prompt_type_image', 'linkawy_prompt_type_image_nonce');
    ?>
    <div class="form-field">
        <label for="prompt_type_image"><?php _e('صورة/أيقونة النوع', 'linkawy'); ?></label>
        <div class="linkawy-term-image-wrap">
            <input type="hidden" id="prompt_type_image" name="prompt_type_image" value="">
            <p class="linkawy-term-image-preview"></p>
            <p>
                <button type="button" class="button linkawy-upload-prompt-type-image"><?php _e('اختيار صورة', 'linkawy'); ?></button>
                <button type="button" class="button linkawy-remove-prompt-type-image" style="display:none;"><?php _e('إزالة الصورة', 'linkawy'); ?></button>
            </p>
        </div>
    </div>
    <?php
}
add_action('prompt_type_add_form_fields', 'linkawy_prompt_type_add_form_fields');

/**
 * Add image field to prompt_type edit form
 */
function linkawy_prompt_type_edit_form_fields($term) {
    wp_nonce_field('linkawy_prompt_type_image', 'linkawy_prompt_type_image_nonce');
    $image_id = get_term_meta($term->term_id, 'prompt_type_image', true);
    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'thumbnail') : '';
    if (!$image_url && $image_id) {
        $image_url = wp_get_attachment_url($image_id);
    }
    ?>
    <tr class="form-field">
        <th scope="row"><label for="prompt_type_image"><?php _e('صورة/أيقونة النوع', 'linkawy'); ?></label></th>
        <td>
            <div class="linkawy-term-image-wrap">
                <input type="hidden" id="prompt_type_image" name="prompt_type_image" value="<?php echo esc_attr($image_id); ?>">
                <p class="linkawy-term-image-preview">
                    <?php if ($image_url) : ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="" style="max-width:100px; height:auto; display:block; margin-bottom:8px;">
                    <?php endif; ?>
                </p>
                <p>
                    <button type="button" class="button linkawy-upload-prompt-type-image"><?php _e('اختيار صورة', 'linkawy'); ?></button>
                    <button type="button" class="button linkawy-remove-prompt-type-image" <?php echo $image_id ? '' : 'style="display:none;"'; ?>><?php _e('إزالة الصورة', 'linkawy'); ?></button>
                </p>
            </div>
        </td>
    </tr>
    <?php
}
add_action('prompt_type_edit_form_fields', 'linkawy_prompt_type_edit_form_fields', 10, 2);

/**
 * Save prompt_type image on term create
 */
function linkawy_save_prompt_type_image_created($term_id) {
    if (!isset($_POST['linkawy_prompt_type_image_nonce']) ||
        !wp_verify_nonce($_POST['linkawy_prompt_type_image_nonce'], 'linkawy_prompt_type_image')) {
        return;
    }
    if (isset($_POST['prompt_type_image'])) {
        $image_id = absint($_POST['prompt_type_image']);
        update_term_meta($term_id, 'prompt_type_image', $image_id);
    }
}
add_action('created_prompt_type', 'linkawy_save_prompt_type_image_created');

/**
 * Save prompt_type image on term update
 */
function linkawy_save_prompt_type_image_edited($term_id) {
    if (!isset($_POST['linkawy_prompt_type_image_nonce']) ||
        !wp_verify_nonce($_POST['linkawy_prompt_type_image_nonce'], 'linkawy_prompt_type_image')) {
        return;
    }
    if (isset($_POST['prompt_type_image'])) {
        $image_id = absint($_POST['prompt_type_image']);
        update_term_meta($term_id, 'prompt_type_image', $image_id);
    }
}
add_action('edited_prompt_type', 'linkawy_save_prompt_type_image_edited');

/**
 * Enqueue media uploader for prompt_type taxonomy admin
 */
function linkawy_prompt_type_admin_scripts($hook) {
    if ($hook !== 'edit-tags.php' && $hook !== 'term.php') {
        return;
    }
    if (!isset($_GET['taxonomy']) || $_GET['taxonomy'] !== 'prompt_type') {
        return;
    }
    wp_enqueue_media();
    wp_add_inline_script('jquery', "
        jQuery(function($) {
            var frame;
            $(document).on('click', '.linkawy-upload-prompt-type-image', function(e) {
                e.preventDefault();
                var wrap = $(this).closest('.linkawy-term-image-wrap');
                var input = wrap.find('input[name=prompt_type_image]');
                if (frame) { frame.open(); return; }
                frame = wp.media({
                    title: '" . esc_js(__('اختيار صورة', 'linkawy')) . "',
                    button: { text: '" . esc_js(__('استخدام الصورة', 'linkawy')) . "' },
                    multiple: false,
                    library: { type: 'image' }
                });
                frame.on('select', function() {
                    var att = frame.state().get('selection').first().toJSON();
                    input.val(att.id);
                    wrap.find('.linkawy-term-image-preview').html('<img src=\"' + (att.sizes && att.sizes.thumbnail ? att.sizes.thumbnail.url : att.url) + '\" style=\"max-width:100px; height:auto; display:block; margin-bottom:8px;\">');
                    wrap.find('.linkawy-remove-prompt-type-image').show();
                });
                frame.open();
            });
            $(document).on('click', '.linkawy-remove-prompt-type-image', function(e) {
                e.preventDefault();
                var wrap = $(this).closest('.linkawy-term-image-wrap');
                wrap.find('input[name=prompt_type_image]').val('');
                wrap.find('.linkawy-term-image-preview').empty();
                $(this).hide();
            });
        });
    ");
}
add_action('admin_enqueue_scripts', 'linkawy_prompt_type_admin_scripts');

/**
 * Flush rewrite rules on theme activation
 */
function linkawy_rewrite_flush() {
    linkawy_register_glossary_cpt();
    linkawy_register_resources_cpt();
    linkawy_register_resource_type_taxonomy();
    linkawy_register_prompts_cpt();
    linkawy_register_prompt_type_taxonomy();
    linkawy_register_prompt_tag_taxonomy();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'linkawy_rewrite_flush');

/**
 * Add Meta Boxes
 */
function linkawy_add_meta_boxes() {
    // Glossary Meta Box
    add_meta_box(
        'glossary_details',
        __('تفاصيل المصطلح', 'linkawy'),
        'linkawy_glossary_details_callback',
        'glossary',
        'side',
        'high'
    );
    
    // Post TOC Settings Meta Box
    add_meta_box(
        'post_toc_settings',
        __('إعدادات الفهرس', 'linkawy'),
        'linkawy_post_toc_settings_callback',
        'post',
        'side',
        'high'
    );
    
    // Post Reviewer Meta Box
    add_meta_box(
        'post_reviewer_details',
        __('معلومات المراجع', 'linkawy'),
        'linkawy_post_reviewer_callback',
        'post',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'linkawy_add_meta_boxes');

/**
 * Post TOC Settings Meta Box Callback
 */
function linkawy_post_toc_settings_callback($post) {
    wp_nonce_field('linkawy_toc_settings_nonce', 'linkawy_toc_settings_nonce_field');
    $disable_toc = get_post_meta($post->ID, '_disable_toc', true);
    ?>
    <p>
        <label>
            <input type="checkbox" name="disable_toc" value="1" <?php checked($disable_toc, '1'); ?>>
            <?php _e('إلغاء فهرس المقال', 'linkawy'); ?>
        </label>
    </p>
    <p class="description"><?php _e('عند التفعيل، لن يظهر فهرس المقال في هذه الصفحة', 'linkawy'); ?></p>
    <?php
}

/**
 * Save Post TOC Settings
 */
function linkawy_save_toc_settings($post_id) {
    // Check nonce
    if (!isset($_POST['linkawy_toc_settings_nonce_field']) || 
        !wp_verify_nonce($_POST['linkawy_toc_settings_nonce_field'], 'linkawy_toc_settings_nonce')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save TOC setting
    if (isset($_POST['disable_toc'])) {
        update_post_meta($post_id, '_disable_toc', '1');
    } else {
        delete_post_meta($post_id, '_disable_toc');
    }
}
add_action('save_post_post', 'linkawy_save_toc_settings');

/**
 * Post Reviewer Meta Box Callback
 */
function linkawy_post_reviewer_callback($post) {
    wp_nonce_field('linkawy_post_reviewer_nonce', 'linkawy_post_reviewer_nonce_field');
    
    $reviewer_id = get_post_meta($post->ID, '_post_reviewer_id', true);
    
    // Get users with admin or editor role
    $reviewers = get_users(array(
        'role__in' => array('administrator', 'editor'),
        'orderby'  => 'display_name',
        'order'    => 'ASC',
    ));
    ?>
    <p>
        <label for="post_reviewer_id"><strong><?php _e('مراجع المقال', 'linkawy'); ?></strong></label>
    </p>
    <p>
        <select id="post_reviewer_id" name="post_reviewer_id" class="widefat">
            <option value=""><?php _e('— اختر المراجع —', 'linkawy'); ?></option>
            <?php foreach ($reviewers as $reviewer) : ?>
                <option value="<?php echo esc_attr($reviewer->ID); ?>" <?php selected($reviewer_id, $reviewer->ID); ?>>
                    <?php echo esc_html($reviewer->display_name); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <p class="description"><?php _e('اختر العضو الذي راجع هذا المقال (مدير أو محرر فقط)', 'linkawy'); ?></p>
    <?php
}

/**
 * Save Post Reviewer Meta
 */
function linkawy_save_post_reviewer($post_id) {
    // Check nonce
    if (!isset($_POST['linkawy_post_reviewer_nonce_field']) || 
        !wp_verify_nonce($_POST['linkawy_post_reviewer_nonce_field'], 'linkawy_post_reviewer_nonce')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save reviewer ID
    if (isset($_POST['post_reviewer_id'])) {
        $reviewer_id = absint($_POST['post_reviewer_id']);
        if ($reviewer_id > 0) {
            update_post_meta($post_id, '_post_reviewer_id', $reviewer_id);
            // Also save the name for backwards compatibility
            $reviewer = get_userdata($reviewer_id);
            if ($reviewer) {
                update_post_meta($post_id, '_post_reviewer', $reviewer->display_name);
            }
        } else {
            delete_post_meta($post_id, '_post_reviewer_id');
            delete_post_meta($post_id, '_post_reviewer');
        }
    }
}
add_action('save_post_post', 'linkawy_save_post_reviewer');

/**
 * Glossary Meta Box Callback
 */
function linkawy_glossary_details_callback($post) {
    wp_nonce_field('linkawy_glossary_nonce', 'linkawy_glossary_nonce_field');

    $synonyms = get_post_meta($post->ID, '_glossary_synonyms', true);
    ?>
    <p>
        <label for="glossary_synonyms"><strong><?php _e('مرادفات المصطلح', 'linkawy'); ?></strong></label>
    </p>
    <p>
        <input type="text" id="glossary_synonyms" name="glossary_synonyms" 
               value="<?php echo esc_attr($synonyms); ?>" class="widefat" 
               placeholder="<?php _e('مثال: إعادة التوجيه، تحويل 301', 'linkawy'); ?>">
    </p>
    <p class="description"><?php _e('أدخل المرادفات مفصولة بفواصل', 'linkawy'); ?></p>
    <?php
}

/**
 * Save Glossary Meta Box Data
 */
function linkawy_save_glossary_meta($post_id) {
    // Check nonce
    if (!isset($_POST['linkawy_glossary_nonce_field']) || 
        !wp_verify_nonce($_POST['linkawy_glossary_nonce_field'], 'linkawy_glossary_nonce')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save synonyms
    if (isset($_POST['glossary_synonyms'])) {
        update_post_meta($post_id, '_glossary_synonyms', sanitize_text_field($_POST['glossary_synonyms']));
    }
}
add_action('save_post_glossary', 'linkawy_save_glossary_meta');

/**
 * Add custom columns to Glossary admin list
 */
function linkawy_glossary_columns($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['synonyms'] = __('المرادفات', 'linkawy');
            $new_columns['reviewer'] = __('المراجع', 'linkawy');
        }
    }
    return $new_columns;
}
add_filter('manage_glossary_posts_columns', 'linkawy_glossary_columns');

/**
 * Display custom column content
 */
function linkawy_glossary_column_content($column, $post_id) {
    switch ($column) {
        case 'synonyms':
            $synonyms = get_post_meta($post_id, '_glossary_synonyms', true);
            echo $synonyms ? esc_html($synonyms) : '—';
            break;
        case 'reviewer':
            $reviewer = linkawy_get_glossary_reviewer($post_id);
            echo !empty($reviewer['name']) ? esc_html($reviewer['name']) : '—';
            break;
    }
}
add_action('manage_glossary_posts_custom_column', 'linkawy_glossary_column_content', 10, 2);

/**
 * Register Contact Request Custom Post Type
 * 
 * Stores contact form submissions in the database.
 * Not public - only visible in admin panel.
 */
function linkawy_register_contact_request_cpt() {
    $labels = array(
        'name'                  => __('طلبات التواصل', 'linkawy'),
        'singular_name'         => __('طلب تواصل', 'linkawy'),
        'menu_name'             => __('طلبات التواصل', 'linkawy'),
        'name_admin_bar'        => __('طلب تواصل', 'linkawy'),
        'all_items'             => __('جميع الطلبات', 'linkawy'),
        'view_item'             => __('عرض الطلب', 'linkawy'),
        'search_items'          => __('بحث في الطلبات', 'linkawy'),
        'not_found'             => __('لم يتم العثور على طلبات', 'linkawy'),
        'not_found_in_trash'    => __('لم يتم العثور على طلبات في المهملات', 'linkawy'),
    );

    $args = array(
        'label'               => __('طلبات التواصل', 'linkawy'),
        'description'         => __('طلبات التواصل الواردة من نموذج الاتصال', 'linkawy'),
        'labels'              => $labels,
        'supports'            => array('title'),
        'hierarchical'        => false,
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 25,
        'menu_icon'           => 'dashicons-email-alt',
        'show_in_admin_bar'   => false,
        'show_in_nav_menus'   => false,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => false,
        'capability_type'     => 'post',
        'show_in_rest'        => false,
    );

    register_post_type('contact_request', $args);
}
add_action('init', 'linkawy_register_contact_request_cpt', 0);

/**
 * Add custom columns to Contact Request admin list
 */
function linkawy_contact_request_columns($columns) {
    $new_columns = array(
        'cb'       => $columns['cb'],
        'title'    => __('الاسم', 'linkawy'),
        'email'    => __('البريد الإلكتروني', 'linkawy'),
        'company'  => __('الشركة', 'linkawy'),
        'budget'   => __('الميزانية', 'linkawy'),
        'source'   => __('المصدر', 'linkawy'),
        'date'     => __('التاريخ', 'linkawy'),
    );
    return $new_columns;
}
add_filter('manage_contact_request_posts_columns', 'linkawy_contact_request_columns');

/**
 * Display custom column content for Contact Request
 */
function linkawy_contact_request_column_content($column, $post_id) {
    switch ($column) {
        case 'email':
            $email = get_post_meta($post_id, '_cf_email', true);
            echo $email ? '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>' : '—';
            break;
        case 'company':
            $company = get_post_meta($post_id, '_cf_company', true);
            echo $company ? esc_html($company) : '—';
            break;
        case 'budget':
            $budget = get_post_meta($post_id, '_cf_budget', true);
            $budget_labels = array(
                'below-750'   => 'أقل من 750$',
                '750-1500'    => '750$ - 1,500$',
                '1500-3000'   => '1,500$ - 3,000$',
                '3000-5000'   => '3,000$ - 5,000$',
                '5000-10000'  => '5,000$ - 10,000$',
                'above-10000' => 'أكثر من 10,000$',
            );
            echo isset($budget_labels[$budget]) ? esc_html($budget_labels[$budget]) : '—';
            break;
        case 'source':
            $source_title = get_post_meta($post_id, '_cf_source_title', true);
            $source_url = get_post_meta($post_id, '_cf_source_url', true);
            if ($source_title || $source_url) {
                // Extract page name from title or URL
                $display = $source_title ? $source_title : parse_url($source_url, PHP_URL_PATH);
                // Shorten if too long
                if (mb_strlen($display) > 30) {
                    $display = mb_substr($display, 0, 27) . '...';
                }
                echo '<span title="' . esc_attr($source_url) . '">' . esc_html($display) . '</span>';
            } else {
                echo '—';
            }
            break;
    }
}
add_action('manage_contact_request_posts_custom_column', 'linkawy_contact_request_column_content', 10, 2);

/**
 * Make columns sortable
 */
function linkawy_contact_request_sortable_columns($columns) {
    $columns['email']   = 'email';
    $columns['company'] = 'company';
    $columns['budget']  = 'budget';
    return $columns;
}
add_filter('manage_edit-contact_request_sortable_columns', 'linkawy_contact_request_sortable_columns');

/**
 * Add meta box to show all contact request details
 */
function linkawy_contact_request_meta_boxes() {
    add_meta_box(
        'contact_request_details',
        __('تفاصيل الطلب', 'linkawy'),
        'linkawy_contact_request_details_callback',
        'contact_request',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'linkawy_contact_request_meta_boxes');

/**
 * Contact Request details meta box callback
 */
function linkawy_contact_request_details_callback($post) {
    $fields = array(
        '_cf_email'        => __('البريد الإلكتروني', 'linkawy'),
        '_cf_phone'        => __('رقم الهاتف', 'linkawy'),
        '_cf_country_code' => __('كود الدولة', 'linkawy'),
        '_cf_company'      => __('اسم الشركة', 'linkawy'),
        '_cf_website'      => __('رابط الموقع', 'linkawy'),
        '_cf_budget'       => __('الميزانية', 'linkawy'),
        '_cf_goals'        => __('الأهداف والتحديات', 'linkawy'),
        '_cf_source_title' => __('مصدر الطلب', 'linkawy'),
    );

    $budget_labels = array(
        'below-750'   => 'أقل من 750$',
        '750-1500'    => '750$ - 1,500$',
        '1500-3000'   => '1,500$ - 3,000$',
        '3000-5000'   => '3,000$ - 5,000$',
        '5000-10000'  => '5,000$ - 10,000$',
        'above-10000' => 'أكثر من 10,000$',
    );

    echo '<table class="form-table">';
    foreach ($fields as $key => $label) {
        $value = get_post_meta($post->ID, $key, true);
        
        // Format budget value
        if ($key === '_cf_budget' && isset($budget_labels[$value])) {
            $value = $budget_labels[$value];
        }
        
        // Format phone with country code
        if ($key === '_cf_phone' && $value) {
            $country_code = get_post_meta($post->ID, '_cf_country_code', true);
            if ($country_code) {
                $value = $country_code . ' ' . $value;
            }
        }
        
        // Skip country code as it's shown with phone
        if ($key === '_cf_country_code') {
            continue;
        }
        
        echo '<tr>';
        echo '<th scope="row">' . esc_html($label) . '</th>';
        echo '<td>';
        if ($key === '_cf_email' && $value) {
            echo '<a href="mailto:' . esc_attr($value) . '">' . esc_html($value) . '</a>';
        } elseif ($key === '_cf_website' && $value) {
            $url = strpos($value, 'http') === 0 ? $value : 'https://' . $value;
            echo '<a href="' . esc_url($url) . '" target="_blank">' . esc_html($value) . '</a>';
        } elseif ($key === '_cf_source_title') {
            $source_url = get_post_meta($post->ID, '_cf_source_url', true);
            if ($value && $source_url) {
                echo '<a href="' . esc_url($source_url) . '" target="_blank">' . esc_html($value) . '</a>';
            } elseif ($value) {
                echo esc_html($value);
            } else {
                echo '<em style="color:#999;">—</em>';
            }
        } elseif ($key === '_cf_goals' && $value) {
            echo '<p style="margin:0;">' . nl2br(esc_html($value)) . '</p>';
        } else {
            echo $value ? esc_html($value) : '<em style="color:#999;">—</em>';
        }
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

/**
 * Get count of unread contact requests
 *
 * @return int Number of unread requests
 */
function linkawy_get_unread_contact_requests_count() {
    $count = get_transient('linkawy_unread_contacts_count');
    
    if ($count === false) {
        $args = array(
            'post_type'      => 'contact_request',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'fields'         => 'ids',
            'meta_query'     => array(
                array(
                    'key'     => '_cf_read',
                    'compare' => 'NOT EXISTS',
                ),
            ),
        );
        
        $query = new WP_Query($args);
        $count = $query->found_posts;
        
        // Cache for 5 minutes
        set_transient('linkawy_unread_contacts_count', $count, 5 * MINUTE_IN_SECONDS);
    }
    
    return (int) $count;
}

/**
 * Add unread count bubble to admin menu
 */
function linkawy_add_contact_request_menu_bubble() {
    global $menu;
    
    $count = linkawy_get_unread_contact_requests_count();
    
    if ($count > 0) {
        foreach ($menu as $key => $item) {
            if (isset($item[2]) && $item[2] === 'edit.php?post_type=contact_request') {
                $menu[$key][0] .= sprintf(
                    ' <span class="awaiting-mod count-%1$d"><span class="pending-count">%1$d</span></span>',
                    $count
                );
                break;
            }
        }
    }
}
add_action('admin_menu', 'linkawy_add_contact_request_menu_bubble', 999);

/**
 * Mark contact request as read when viewed
 */
function linkawy_mark_contact_request_as_read($post_id) {
    if (get_post_type($post_id) !== 'contact_request') {
        return;
    }
    
    // Only mark as read if not already read
    if (!get_post_meta($post_id, '_cf_read', true)) {
        update_post_meta($post_id, '_cf_read', current_time('mysql'));
        // Clear the cached count
        delete_transient('linkawy_unread_contacts_count');
    }
}
add_action('edit_form_top', 'linkawy_mark_contact_request_as_read');

/**
 * Clear unread count cache when new contact request is created
 */
function linkawy_clear_unread_count_on_new_request($post_id, $post, $update) {
    if ($post->post_type === 'contact_request' && !$update) {
        delete_transient('linkawy_unread_contacts_count');
    }
}
add_action('wp_insert_post', 'linkawy_clear_unread_count_on_new_request', 10, 3);

/**
 * Clear contact unread-count cache when request status changes or is deleted.
 *
 * @param int $post_id Post ID.
 */
function linkawy_invalidate_contact_unread_count_on_status_change($post_id) {
    if (get_post_type($post_id) === 'contact_request') {
        delete_transient('linkawy_unread_contacts_count');
    }
}
add_action('trash_post', 'linkawy_invalidate_contact_unread_count_on_status_change');
add_action('untrash_post', 'linkawy_invalidate_contact_unread_count_on_status_change');
add_action('deleted_post', 'linkawy_invalidate_contact_unread_count_on_status_change');

/**
 * Add "read" status column to contact requests list
 */
function linkawy_add_read_status_column($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        if ($key === 'title') {
            $new_columns['read_status'] = '';
        }
        $new_columns[$key] = $value;
    }
    return $new_columns;
}
add_filter('manage_contact_request_posts_columns', 'linkawy_add_read_status_column', 20);

/**
 * Display read status indicator
 */
function linkawy_display_read_status_column($column, $post_id) {
    if ($column === 'read_status') {
        $is_read = get_post_meta($post_id, '_cf_read', true);
        if (!$is_read) {
            echo '<span class="dashicons dashicons-marker" style="color:#2271b1;" title="' . esc_attr__('جديد', 'linkawy') . '"></span>';
        }
    }
}
add_action('manage_contact_request_posts_custom_column', 'linkawy_display_read_status_column', 10, 2);

/**
 * Add bulk action to mark requests as read/unread
 */
function linkawy_contact_request_bulk_actions($actions) {
    $actions['mark_as_read'] = __('تحديد كمقروء', 'linkawy');
    $actions['mark_as_unread'] = __('تحديد كغير مقروء', 'linkawy');
    return $actions;
}
add_filter('bulk_actions-edit-contact_request', 'linkawy_contact_request_bulk_actions');

/**
 * Handle bulk actions for read/unread
 */
function linkawy_handle_contact_request_bulk_actions($redirect_to, $action, $post_ids) {
    if ($action === 'mark_as_read') {
        foreach ($post_ids as $post_id) {
            update_post_meta($post_id, '_cf_read', current_time('mysql'));
        }
        delete_transient('linkawy_unread_contacts_count');
        $redirect_to = add_query_arg('marked_read', count($post_ids), $redirect_to);
    } elseif ($action === 'mark_as_unread') {
        foreach ($post_ids as $post_id) {
            delete_post_meta($post_id, '_cf_read');
        }
        delete_transient('linkawy_unread_contacts_count');
        $redirect_to = add_query_arg('marked_unread', count($post_ids), $redirect_to);
    }
    return $redirect_to;
}
add_filter('handle_bulk_actions-edit-contact_request', 'linkawy_handle_contact_request_bulk_actions', 10, 3);

/**
 * Show admin notice after bulk action
 */
function linkawy_contact_request_bulk_action_notices() {
    if (!empty($_REQUEST['marked_read'])) {
        $count = intval($_REQUEST['marked_read']);
        printf(
            '<div class="notice notice-success is-dismissible"><p>' .
            _n('تم تحديد %d طلب كمقروء.', 'تم تحديد %d طلبات كمقروءة.', $count, 'linkawy') .
            '</p></div>',
            $count
        );
    }
    if (!empty($_REQUEST['marked_unread'])) {
        $count = intval($_REQUEST['marked_unread']);
        printf(
            '<div class="notice notice-success is-dismissible"><p>' .
            _n('تم تحديد %d طلب كغير مقروء.', 'تم تحديد %d طلبات كغير مقروءة.', $count, 'linkawy') .
            '</p></div>',
            $count
        );
    }
}
add_action('admin_notices', 'linkawy_contact_request_bulk_action_notices');

/**
 * Register Newsletter Subscriber Custom Post Type
 *
 * Stores newsletter subscriptions from blog forms.
 */
function linkawy_register_linkawy_newsletter_cpt() {
    $labels = array(
        'name'               => __('النشرة البريدية', 'linkawy'),
        'singular_name'      => __('مشترك نشرة', 'linkawy'),
        'menu_name'          => __('النشرة البريدية', 'linkawy'),
        'name_admin_bar'     => __('مشترك نشرة', 'linkawy'),
        'all_items'          => __('جميع المشتركين', 'linkawy'),
        'view_item'          => __('عرض المشترك', 'linkawy'),
        'search_items'       => __('بحث في المشتركين', 'linkawy'),
        'not_found'          => __('لم يتم العثور على مشتركين', 'linkawy'),
        'not_found_in_trash' => __('لم يتم العثور على مشتركين في المهملات', 'linkawy'),
    );

    $args = array(
        'label'               => __('النشرة البريدية', 'linkawy'),
        'description'         => __('اشتراكات النشرة البريدية', 'linkawy'),
        'labels'              => $labels,
        'supports'            => array('title'),
        'hierarchical'        => false,
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 26,
        'menu_icon'           => 'dashicons-email',
        'show_in_admin_bar'   => false,
        'show_in_nav_menus'   => false,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => false,
        'capability_type'     => 'post',
        'show_in_rest'        => false,
    );

    register_post_type('linkawy_newsletter', $args);
}
add_action('init', 'linkawy_register_linkawy_newsletter_cpt', 0);

/**
 * Add custom columns to Newsletter Subscriber admin list.
 */
function linkawy_linkawy_newsletter_columns($columns) {
    return array(
        'cb'       => isset($columns['cb']) ? $columns['cb'] : '',
        'title'    => __('البريد الإلكتروني', 'linkawy'),
        'source'   => __('المصدر', 'linkawy'),
        'copy'     => __('نسخ', 'linkawy'),
        'date'     => __('التاريخ', 'linkawy'),
    );
}
add_filter('manage_linkawy_newsletter_posts_columns', 'linkawy_linkawy_newsletter_columns');

/**
 * Render custom column content for newsletter subscribers.
 */
function linkawy_linkawy_newsletter_column_content($column, $post_id) {
    switch ($column) {
        case 'read_status':
            $is_read = get_post_meta($post_id, '_newsletter_read', true);
            if (! $is_read) {
                echo '<span class="dashicons dashicons-marker" style="color:#2271b1;" title="' . esc_attr__('جديد', 'linkawy') . '"></span>';
            }
            break;
        case 'title':
            $email = get_post_meta($post_id, '_newsletter_email', true);
            if (!$email) {
                $email = get_the_title($post_id);
            }
            if ($email) {
                echo '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>';
            } else {
                echo '—';
            }
            break;
        case 'source':
            echo linkawy_newsletter_render_source_column_html($post_id);
            break;
        case 'copy':
            $copy_email = get_post_meta($post_id, '_newsletter_email', true);
            if (!$copy_email) {
                $copy_email = get_the_title($post_id);
            }
            if ($copy_email) {
                echo '<button type="button" class="button button-small linkawy-copy-email-btn" data-email="' . esc_attr($copy_email) . '">' . esc_html__('Copy', 'linkawy') . '</button>';
            } else {
                echo '—';
            }
            break;
    }
}
add_action('manage_linkawy_newsletter_posts_custom_column', 'linkawy_linkawy_newsletter_column_content', 10, 2);

/**
 * Newsletter: unread count (mirrors contact_request bubble).
 *
 * @return int
 */
function linkawy_get_unread_newsletter_subscribers_count() {
    $count = get_transient('linkawy_unread_newsletter_count');

    if ($count === false) {
        $query = new WP_Query(array(
            'post_type'      => 'linkawy_newsletter',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'fields'         => 'ids',
            'meta_query'     => array(
                array(
                    'key'     => '_newsletter_read',
                    'compare' => 'NOT EXISTS',
                ),
            ),
        ));
        $count = (int) $query->found_posts;
        set_transient('linkawy_unread_newsletter_count', $count, 5 * MINUTE_IN_SECONDS);
    }

    return (int) $count;
}

/**
 * Add unread subscriber count bubble to admin menu (like contact requests).
 */
function linkawy_add_newsletter_menu_bubble() {
    global $menu;

    $count = linkawy_get_unread_newsletter_subscribers_count();

    if ($count > 0) {
        foreach ($menu as $key => $item) {
            if (isset($item[2]) && $item[2] === 'edit.php?post_type=linkawy_newsletter') {
                $menu[ $key ][0] .= sprintf(
                    ' <span class="awaiting-mod linkawy-newsletter-menu-badge count-%1$d"><span class="pending-count">%1$d</span></span>',
                    $count
                );
                break;
            }
        }
    }
}
add_action('admin_menu', 'linkawy_add_newsletter_menu_bubble', 999);

/**
 * Distinct badge style for newsletter (not circular; different color from contact requests).
 */
function linkawy_newsletter_menu_badge_admin_css() {
    ?>
    <style id="linkawy-newsletter-menu-badge-css">
        #adminmenu .linkawy-newsletter-menu-badge {
            display: inline-block;
            min-width: 1.3em;
            padding: 0 6px;
            margin-inline-start: 4px;
            line-height: 1.6;
            vertical-align: middle;
            text-align: center;
            border-radius: 4px;
            background: #0f766e !important;
            color: #fff !important;
            box-shadow: none;
            font-weight: 600;
        }
        #adminmenu .linkawy-newsletter-menu-badge .pending-count {
            color: inherit !important;
            padding: 0;
        }
    </style>
    <?php
}
add_action('admin_head', 'linkawy_newsletter_menu_badge_admin_css');

/**
 * Mark newsletter subscriber as read when opening the edit screen.
 *
 * @param WP_Post|int $post Post object (WordPress passes WP_Post on edit_form_top).
 */
function linkawy_mark_newsletter_subscriber_as_read($post) {
    $post_id = is_object($post) && isset($post->ID) ? (int) $post->ID : (int) $post;
    if (! $post_id || get_post_type($post_id) !== 'linkawy_newsletter') {
        return;
    }

    if (! get_post_meta($post_id, '_newsletter_read', true)) {
        update_post_meta($post_id, '_newsletter_read', current_time('mysql'));
        delete_transient('linkawy_unread_newsletter_count');
    }
}
add_action('edit_form_top', 'linkawy_mark_newsletter_subscriber_as_read');

/**
 * Invalidate unread cache when a new subscriber row is inserted.
 */
function linkawy_clear_unread_newsletter_count_on_new_subscriber($post_id, $post, $update) {
    if ($post->post_type === 'linkawy_newsletter' && ! $update) {
        delete_transient('linkawy_unread_newsletter_count');
    }
}
add_action('wp_insert_post', 'linkawy_clear_unread_newsletter_count_on_new_subscriber', 10, 3);

/**
 * Clear newsletter unread-count cache when subscriber status changes or is deleted.
 *
 * @param int $post_id Post ID.
 */
function linkawy_invalidate_newsletter_unread_count_on_status_change($post_id) {
    if (get_post_type($post_id) === 'linkawy_newsletter') {
        delete_transient('linkawy_unread_newsletter_count');
    }
}
add_action('trash_post', 'linkawy_invalidate_newsletter_unread_count_on_status_change');
add_action('untrash_post', 'linkawy_invalidate_newsletter_unread_count_on_status_change');
add_action('deleted_post', 'linkawy_invalidate_newsletter_unread_count_on_status_change');

/**
 * Add read-status column (marker) before title column.
 */
function linkawy_newsletter_add_read_status_column($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        if ($key === 'title') {
            $new_columns['read_status'] = '';
        }
        $new_columns[ $key ] = $value;
    }
    return $new_columns;
}
add_filter('manage_linkawy_newsletter_posts_columns', 'linkawy_newsletter_add_read_status_column', 20);

/**
 * Bulk actions: mark newsletter rows read / unread.
 */
function linkawy_newsletter_bulk_actions($actions) {
    $actions['mark_nl_read']   = __('تحديد كمقروء', 'linkawy');
    $actions['mark_nl_unread'] = __('تحديد كغير مقروء', 'linkawy');
    return $actions;
}
add_filter('bulk_actions-edit-linkawy_newsletter', 'linkawy_newsletter_bulk_actions');

/**
 * Handle newsletter bulk read / unread.
 */
function linkawy_handle_newsletter_bulk_actions($redirect_to, $action, $post_ids) {
    if ($action === 'mark_nl_read') {
        foreach ($post_ids as $post_id) {
            update_post_meta($post_id, '_newsletter_read', current_time('mysql'));
        }
        delete_transient('linkawy_unread_newsletter_count');
        $redirect_to = add_query_arg('nl_marked_read', count($post_ids), $redirect_to);
    } elseif ($action === 'mark_nl_unread') {
        foreach ($post_ids as $post_id) {
            delete_post_meta($post_id, '_newsletter_read');
        }
        delete_transient('linkawy_unread_newsletter_count');
        $redirect_to = add_query_arg('nl_marked_unread', count($post_ids), $redirect_to);
    }
    return $redirect_to;
}
add_filter('handle_bulk_actions-edit-linkawy_newsletter', 'linkawy_handle_newsletter_bulk_actions', 10, 3);

/**
 * Admin notice after newsletter bulk read / unread.
 */
function linkawy_newsletter_bulk_action_notices() {
    if (! empty($_REQUEST['nl_marked_read'])) {
        $count = intval($_REQUEST['nl_marked_read']);
        printf(
            '<div class="notice notice-success is-dismissible"><p>' .
            _n('تم تحديد %d مشترك كمقروء.', 'تم تحديد %d مشتركين كمقروءين.', $count, 'linkawy') .
            '</p></div>',
            $count
        );
    }
    if (! empty($_REQUEST['nl_marked_unread'])) {
        $count = intval($_REQUEST['nl_marked_unread']);
        printf(
            '<div class="notice notice-success is-dismissible"><p>' .
            _n('تم تحديد %d مشترك كغير مقروء.', 'تم تحديد %d مشتركين كغير مقروءين.', $count, 'linkawy') .
            '</p></div>',
            $count
        );
    }
}
add_action('admin_notices', 'linkawy_newsletter_bulk_action_notices');

/**
 * Add CSV export button to newsletter subscribers list table.
 */
function linkawy_linkawy_newsletter_export_button($which) {
    global $typenow;
    if ($typenow !== 'linkawy_newsletter' || $which !== 'top') {
        return;
    }
    $url = wp_nonce_url(
        admin_url('admin-post.php?action=linkawy_export_newsletter_csv'),
        'linkawy_export_newsletter_csv'
    );
    echo '<a href="' . esc_url($url) . '" class="button" style="margin-inline-start:8px;">' . esc_html__('Export CSV', 'linkawy') . '</a>';
}
add_action('manage_posts_extra_tablenav', 'linkawy_linkawy_newsletter_export_button');

/**
 * Handle newsletter CSV export.
 */
function linkawy_export_newsletter_csv() {
    if (!current_user_can('manage_options')) {
        wp_die(esc_html__('You are not allowed to export this data.', 'linkawy'));
    }

    check_admin_referer('linkawy_export_newsletter_csv');

    $filename = 'newsletter-subscribers-' . gmdate('Y-m-d-H-i-s') . '.csv';
    nocache_headers();
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename);

    $output = fopen('php://output', 'w');
    if (!$output) {
        wp_die(esc_html__('Failed to prepare export.', 'linkawy'));
    }

    // UTF-8 BOM for Excel compatibility with Arabic content.
    fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));
    fputcsv($output, array('Email', 'Source', 'Subscribed At'));

    $subscribers = get_posts(array(
        'post_type'      => 'linkawy_newsletter',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'fields'         => 'ids',
    ));

    foreach ($subscribers as $subscriber_id) {
        $email = get_post_meta($subscriber_id, '_newsletter_email', true);
        if (!$email) {
            $email = get_the_title($subscriber_id);
        }
        $source_export = linkawy_newsletter_get_formatted_source_label($subscriber_id);
        $subscribed_at = get_post_meta($subscriber_id, '_newsletter_subscribed_at', true);
        if (!$subscribed_at) {
            $subscribed_at = get_the_date('Y-m-d H:i:s', $subscriber_id);
        }

        fputcsv($output, array($email, $source_export, $subscribed_at));
    }

    fclose($output);
    exit;
}
add_action('admin_post_linkawy_export_newsletter_csv', 'linkawy_export_newsletter_csv');

/**
 * Add copy-to-clipboard behavior for newsletter email buttons.
 */
function linkawy_newsletter_copy_email_script() {
    $screen = function_exists('get_current_screen') ? get_current_screen() : null;
    if (!$screen || $screen->post_type !== 'linkawy_newsletter') {
        return;
    }
    ?>
    <script>
    (function() {
        document.addEventListener('click', function(event) {
            var btn = event.target.closest('.linkawy-copy-email-btn');
            if (!btn) return;

            var email = btn.getAttribute('data-email') || '';
            if (!email) return;

            var restoreLabel = function(text) {
                btn.textContent = text;
                setTimeout(function() {
                    btn.textContent = 'Copy';
                }, 1200);
            };

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(email).then(function() {
                    restoreLabel('Copied');
                }).catch(function() {
                    restoreLabel('Error');
                });
                return;
            }

            var temp = document.createElement('input');
            temp.value = email;
            document.body.appendChild(temp);
            temp.select();
            try {
                document.execCommand('copy');
                restoreLabel('Copied');
            } catch (e) {
                restoreLabel('Error');
            }
            document.body.removeChild(temp);
        });
    })();
    </script>
    <?php
}
add_action('admin_footer-edit.php', 'linkawy_newsletter_copy_email_script');
