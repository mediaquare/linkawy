<?php
/**
 * Post Meta Fields
 * 
 * Adds custom meta boxes to the post editor
 *
 * @package Linkawy
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Sanitize optional HEX color for article hero background (empty = theme default).
 *
 * @param string $color Raw input (with or without #).
 * @return string Sanitized #RRGGBB or empty string if invalid / empty.
 */
function linkawy_sanitize_article_hero_hex($color) {
    $color = is_string($color) ? trim($color) : '';
    if ($color === '') {
        return '';
    }
    if ($color[0] !== '#') {
        $color = '#' . $color;
    }
    $sanitized = sanitize_hex_color($color);

    return $sanitized ? $sanitized : '';
}

/**
 * Get validated article hero background color for a post.
 *
 * @param int|null $post_id Post ID; defaults to current post in the loop.
 * @return string Empty string to use theme CSS default, or #RRGGBB.
 */
function linkawy_get_article_hero_bg_color($post_id = null) {
    if ($post_id === null) {
        $post_id = linkawy_get_current_single_post_id();
    }
    if (!$post_id) {
        return '';
    }
    $stored = get_post_meta($post_id, '_article_hero_bg_color', true);

    return linkawy_sanitize_article_hero_hex($stored);
}

/**
 * Post ID for single templates when the global post loop may not be set yet.
 *
 * @return int 0 if unavailable.
 */
function linkawy_get_current_single_post_id() {
    $id = get_the_ID();
    if ($id) {
        return (int) $id;
    }
    if (is_singular()) {
        $qid = get_queried_object_id();

        return $qid ? (int) $qid : 0;
    }

    return 0;
}

/**
 * Whether the article hero uses optional grid + mask pattern (post meta).
 *
 * @param int|null $post_id Post ID; defaults to current single view.
 * @return bool
 */
function linkawy_article_hero_pattern_enabled($post_id = null) {
    if ($post_id === null) {
        $post_id = linkawy_get_current_single_post_id();
    }
    if (!$post_id) {
        return false;
    }

    return get_post_meta($post_id, '_article_hero_pattern', true) === '1';
}

/**
 * Whether the hero should use the grid pattern (meta and/or automatic when Linko is shown).
 *
 * Pattern is on when saved in meta, or automatically when there is no featured image in the hero
 * or «إخفاء الصورة البارزة من الهيرو» is checked (Linko / empty hero image slot).
 *
 * @param int|null $post_id Post ID; defaults to current single view.
 * @return bool
 */
function linkawy_article_hero_effective_pattern_enabled($post_id = null) {
    if ($post_id === null) {
        $post_id = linkawy_get_current_single_post_id();
    }
    if (!$post_id) {
        return false;
    }
    if (linkawy_article_hero_pattern_enabled($post_id)) {
        return true;
    }
    if (!linkawy_single_hero_should_show_post_thumbnail($post_id)) {
        return true;
    }

    return false;
}

/**
 * Whether the single post hero should output the featured image (vs. Linko default).
 *
 * @param int|null $post_id Post ID; defaults to current post.
 * @return bool True when featured image should be shown in the hero.
 */
function linkawy_single_hero_should_show_post_thumbnail($post_id = null) {
    if ($post_id === null) {
        $post_id = linkawy_get_current_single_post_id();
    }
    if (!$post_id) {
        return false;
    }
    if (get_post_meta($post_id, '_hero_hide_featured_image', true) === '1') {
        return false;
    }

    return has_post_thumbnail($post_id);
}

/**
 * Available card gradient colors
 */
function linkawy_get_card_gradients() {
    return array(
        'orange' => array(
            'label' => __('🧡 برتقالي', 'linkawy'),
            'value' => 'linear-gradient(135deg, #FF8552 0%, #ff6b3d 100%)',
            'color' => '#FF8552',
        ),
        'pink' => array(
            'label' => __('🩷 وردي', 'linkawy'),
            'value' => 'linear-gradient(135deg, #FFA3B1 0%, #ff7b8a 100%)',
            'color' => '#FFA3B1',
        ),
        'orange_light' => array(
            'label' => __('🟠 برتقالي فاتح', 'linkawy'),
            'value' => 'linear-gradient(135deg, #FFB578 0%, #ffa05c 100%)',
            'color' => '#FFB578',
        ),
        'green' => array(
            'label' => __('💚 أخضر', 'linkawy'),
            'value' => 'linear-gradient(135deg, #a8e063 0%, #56ab2f 100%)',
            'color' => '#a8e063',
        ),
        'emerald' => array(
            'label' => __('🌿 أخضر زمردي', 'linkawy'),
            'value' => 'linear-gradient(135deg, #4DECAD 0%, #36d399 100%)',
            'color' => '#4DECAD',
        ),
        'purple' => array(
            'label' => __('💜 بنفسجي', 'linkawy'),
            'value' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
            'color' => '#667eea',
        ),
        'purple_light' => array(
            'label' => __('🟣 بنفسجي فاتح', 'linkawy'),
            'value' => 'linear-gradient(135deg, #C084FC 0%, #a855f7 100%)',
            'color' => '#C084FC',
        ),
        'blue' => array(
            'label' => __('💙 أزرق سماوي', 'linkawy'),
            'value' => 'linear-gradient(135deg, #72CFF9 0%, #4facfe 100%)',
            'color' => '#72CFF9',
        ),
        'lime' => array(
            'label' => __('💛 أخضر ليموني', 'linkawy'),
            'value' => 'linear-gradient(135deg, #D4F58D 0%, #a8e063 100%)',
            'color' => '#D4F58D',
        ),
    );
}

/**
 * Register Meta Boxes
 */
function linkawy_register_post_meta_boxes() {
    // Editor's Pick Meta Box
    add_meta_box(
        'linkawy_editors_pick',
        __('اختيارات المحرر', 'linkawy'),
        'linkawy_editors_pick_meta_box_html',
        'post',
        'side',
        'high'
    );
    
    // Card Color Meta Box
    add_meta_box(
        'linkawy_card_color',
        __('لون خلفية الكارت', 'linkawy'),
        'linkawy_card_color_meta_box_html',
        'post',
        'side',
        'default'
    );

    // Article hero background (single post)
    add_meta_box(
        'linkawy_article_hero_bg',
        __('خلفية هيرو المقال', 'linkawy'),
        'linkawy_article_hero_bg_meta_box_html',
        'post',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'linkawy_register_post_meta_boxes');

/**
 * Display Editor's Pick Meta Box HTML
 */
function linkawy_editors_pick_meta_box_html($post) {
    // Add nonce for security
    wp_nonce_field('linkawy_editors_pick_nonce', 'linkawy_editors_pick_nonce');
    
    // Get current value
    $is_editors_pick = get_post_meta($post->ID, '_is_editors_pick', true);
    ?>
    <div class="linkawy-meta-box">
        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 10px 0;">
            <input type="checkbox" 
                   name="linkawy_editors_pick" 
                   value="1" 
                   <?php checked($is_editors_pick, '1'); ?>
                   style="width: 18px; height: 18px;">
            <span style="font-size: 14px;">
                <?php _e('إضافة هذا المقال لاختيارات المحرر', 'linkawy'); ?>
            </span>
        </label>
        <p class="description" style="color: #666; font-size: 12px; margin-top: 8px;">
            <?php _e('المقالات المحددة ستظهر في قسم "اختيارات المحرر" في صفحة المدونة.', 'linkawy'); ?>
        </p>
    </div>
    <?php
}

/**
 * Display Card Color Meta Box HTML
 */
function linkawy_card_color_meta_box_html($post) {
    // Add nonce for security
    wp_nonce_field('linkawy_card_color_nonce', 'linkawy_card_color_nonce');
    
    // Get current value (default to orange)
    $card_color = get_post_meta($post->ID, '_card_color', true);
    if (empty($card_color)) {
        $card_color = 'orange';
    }
    $gradients = linkawy_get_card_gradients();
    ?>
    <div class="linkawy-card-color-box">
        <select name="linkawy_card_color" id="linkawy_card_color" style="width: 100%; padding: 10px; font-size: 15px;">
            <?php foreach ($gradients as $key => $gradient) : ?>
                <option value="<?php echo esc_attr($key); ?>" <?php selected($card_color, $key); ?>>
                    <?php echo esc_html($gradient['label']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <p class="description" style="color: #666; font-size: 12px; margin-top: 10px;">
            <?php _e('اختر لون خلفية الكارت في صفحة المدونة.', 'linkawy'); ?>
        </p>
    </div>
    <?php
}

/**
 * Article hero background color (HEX) — single template
 */
function linkawy_article_hero_bg_meta_box_html($post) {
    wp_nonce_field('linkawy_article_hero_bg_nonce', 'linkawy_article_hero_bg_nonce');
    $hex = get_post_meta($post->ID, '_article_hero_bg_color', true);
    $hex = linkawy_sanitize_article_hero_hex($hex);
    ?>
    <div class="linkawy-article-hero-bg-box">
        <label for="linkawy_article_hero_bg_color" style="display:block; font-weight:600; margin-bottom:6px;">
            <?php _e('لون الخلفية (HEX)', 'linkawy'); ?>
        </label>
        <input
            type="text"
            name="linkawy_article_hero_bg_color"
            id="linkawy_article_hero_bg_color"
            value="<?php echo esc_attr($hex); ?>"
            placeholder="#000000"
            maxlength="7"
            pattern="#?[0-9A-Fa-f]{3,6}"
            style="width:100%; font-family:monospace; padding:8px 10px;"
            autocomplete="off"
        />
        <p class="description" style="color:#666; font-size:12px; margin-top:8px;">
            <?php _e('اتركه فارغاً للون الافتراضي (‎#000). يعمل مع الخلفية الصلبة أو مع نمط الشبكة.', 'linkawy'); ?>
        </p>
        <hr style="margin:14px 0; border:none; border-top:1px solid #dcdcde;">
        <label style="display:flex; align-items:flex-start; gap:10px; cursor:pointer; padding:4px 0;">
            <input
                type="checkbox"
                name="linkawy_article_hero_pattern"
                value="1"
                <?php checked(get_post_meta($post->ID, '_article_hero_pattern', true), '1'); ?>
                style="width:18px; height:18px; margin-top:2px; flex-shrink:0;"
            >
            <span style="font-size:13px; line-height:1.45;">
                <?php _e('تفعيل نمط الشبكة والتلاشي (النمط السابق)', 'linkawy'); ?>
            </span>
        </label>
        <p class="description" style="color:#666; font-size:12px; margin-top:8px;">
            <?php _e('يُفعَّل النمط تلقائياً عند عدم وجود صورة بارزة أو عند تفعيل «إخفاء الصورة البارزة من الهيرو». مع صورة بارزة في الهيرو: خلفية صلبة ما لم تُفعّل الخانة يدوياً. عند التفعيل اليدوي أو التلقائي: شبكة خفيفة مع تلاشٍ شعاعي.', 'linkawy'); ?>
        </p>
        <hr style="margin:14px 0; border:none; border-top:1px solid #dcdcde;">
        <label style="display:flex; align-items:flex-start; gap:10px; cursor:pointer; padding:4px 0;">
            <input
                type="checkbox"
                name="linkawy_hero_hide_featured_image"
                value="1"
                <?php checked(get_post_meta($post->ID, '_hero_hide_featured_image', true), '1'); ?>
                style="width:18px; height:18px; margin-top:2px; flex-shrink:0;"
            >
            <span style="font-size:13px; line-height:1.45;">
                <?php _e('إخفاء الصورة البارزة من الهيرو', 'linkawy'); ?>
            </span>
        </label>
        <p class="description" style="color:#666; font-size:12px; margin-top:8px;">
            <?php _e('عند التفعيل يُتجاهل المظهر البارز في أعلى المقال ويُعرض لينكو كما لو لم تُحدَّد صورة بارزة.', 'linkawy'); ?>
        </p>
    </div>
    <?php
}

/**
 * Save Editor's Pick Meta Data
 */
function linkawy_save_editors_pick_meta($post_id) {
    // Check if nonce is set
    if (!isset($_POST['linkawy_editors_pick_nonce'])) {
        return;
    }
    
    // Verify nonce
    if (!wp_verify_nonce($_POST['linkawy_editors_pick_nonce'], 'linkawy_editors_pick_nonce')) {
        return;
    }
    
    // Check for autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save or delete the meta value
    if (isset($_POST['linkawy_editors_pick']) && $_POST['linkawy_editors_pick'] == '1') {
        update_post_meta($post_id, '_is_editors_pick', '1');
    } else {
        delete_post_meta($post_id, '_is_editors_pick');
    }
}
add_action('save_post', 'linkawy_save_editors_pick_meta');

/**
 * Save Card Color Meta Data
 */
function linkawy_save_card_color_meta($post_id) {
    // Check if nonce is set
    if (!isset($_POST['linkawy_card_color_nonce'])) {
        return;
    }
    
    // Verify nonce
    if (!wp_verify_nonce($_POST['linkawy_card_color_nonce'], 'linkawy_card_color_nonce')) {
        return;
    }
    
    // Check for autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save the card color (default: orange)
    if (isset($_POST['linkawy_card_color'])) {
        $color = sanitize_text_field($_POST['linkawy_card_color']);
        if (empty($color)) {
            $color = 'orange';
        }
        update_post_meta($post_id, '_card_color', $color);
    }
}
add_action('save_post', 'linkawy_save_card_color_meta');

/**
 * Save article hero background HEX
 */
function linkawy_save_article_hero_bg_meta($post_id) {
    if (!isset($_POST['linkawy_article_hero_bg_nonce'])) {
        return;
    }
    if (!wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['linkawy_article_hero_bg_nonce'])), 'linkawy_article_hero_bg_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $raw = isset($_POST['linkawy_article_hero_bg_color']) ? wp_unslash($_POST['linkawy_article_hero_bg_color']) : '';
    $san = linkawy_sanitize_article_hero_hex($raw);
    if ($san === '') {
        delete_post_meta($post_id, '_article_hero_bg_color');
    } else {
        update_post_meta($post_id, '_article_hero_bg_color', $san);
    }

    if (isset($_POST['linkawy_article_hero_pattern']) && $_POST['linkawy_article_hero_pattern'] === '1') {
        update_post_meta($post_id, '_article_hero_pattern', '1');
    } else {
        delete_post_meta($post_id, '_article_hero_pattern');
    }

    if (isset($_POST['linkawy_hero_hide_featured_image']) && $_POST['linkawy_hero_hide_featured_image'] === '1') {
        update_post_meta($post_id, '_hero_hide_featured_image', '1');
    } else {
        delete_post_meta($post_id, '_hero_hide_featured_image');
    }
}
add_action('save_post', 'linkawy_save_article_hero_bg_meta');

/**
 * Expose meta for the block editor / REST (optional tooling).
 */
function linkawy_register_article_hero_bg_post_meta() {
    register_post_meta(
        'post',
        '_article_hero_bg_color',
        array(
            'type'              => 'string',
            'single'            => true,
            'show_in_rest'      => true,
            'sanitize_callback' => 'linkawy_sanitize_article_hero_hex',
            'auth_callback'     => function () {
                return current_user_can('edit_posts');
            },
        )
    );
    register_post_meta(
        'post',
        '_hero_hide_featured_image',
        array(
            'type'              => 'string',
            'single'            => true,
            'show_in_rest'      => true,
            'sanitize_callback' => function ($value) {
                return ($value === '1' || $value === true || $value === 1) ? '1' : '';
            },
            'auth_callback'     => function () {
                return current_user_can('edit_posts');
            },
        )
    );
    register_post_meta(
        'post',
        '_article_hero_pattern',
        array(
            'type'              => 'string',
            'single'            => true,
            'show_in_rest'      => true,
            'sanitize_callback' => function ($value) {
                return ($value === '1' || $value === true || $value === 1) ? '1' : '';
            },
            'auth_callback'     => function () {
                return current_user_can('edit_posts');
            },
        )
    );
}
add_action('init', 'linkawy_register_article_hero_bg_post_meta');

/**
 * Add custom columns to posts list
 */
function linkawy_add_custom_columns($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['editors_pick'] = __('اختيار المحرر', 'linkawy');
            $new_columns['card_color'] = __('لون الكارت', 'linkawy');
        }
    }
    return $new_columns;
}
add_filter('manage_posts_columns', 'linkawy_add_custom_columns');

/**
 * Display custom columns content
 */
function linkawy_display_custom_columns($column, $post_id) {
    if ($column === 'editors_pick') {
        $is_editors_pick = get_post_meta($post_id, '_is_editors_pick', true);
        if ($is_editors_pick === '1') {
            echo '<span style="color: #ff6b00; font-size: 18px;" title="' . esc_attr__('اختيار المحرر', 'linkawy') . '">★</span>';
        } else {
            echo '<span style="color: #ddd; font-size: 18px;">☆</span>';
        }
    }
    
    if ($column === 'card_color') {
        $card_color = get_post_meta($post_id, '_card_color', true);
        if (empty($card_color)) {
            $card_color = 'orange';
        }
        $gradients = linkawy_get_card_gradients();
        
        if (isset($gradients[$card_color])) {
            $color = isset($gradients[$card_color]['color']) ? $gradients[$card_color]['color'] : '#FF8552';
            $label = $gradients[$card_color]['label'];
            echo '<span style="display: inline-flex; align-items: center; gap: 6px;">';
            echo '<span style="width: 20px; height: 20px; border-radius: 4px; background: ' . esc_attr($color) . '; box-shadow: 0 1px 3px rgba(0,0,0,0.2);"></span>';
            echo '<span style="font-size: 12px;">' . esc_html($label) . '</span>';
            echo '</span>';
        }
    }
}
add_action('manage_posts_custom_column', 'linkawy_display_custom_columns', 10, 2);

/**
 * Make Editor's Pick column sortable
 */
function linkawy_sortable_editors_pick_column($columns) {
    $columns['editors_pick'] = 'editors_pick';
    return $columns;
}
add_filter('manage_edit-post_sortable_columns', 'linkawy_sortable_editors_pick_column');

/**
 * Handle sorting by Editor's Pick
 */
function linkawy_editors_pick_orderby($query) {
    if (!is_admin()) {
        return;
    }
    
    $orderby = $query->get('orderby');
    
    if ('editors_pick' === $orderby) {
        $query->set('meta_key', '_is_editors_pick');
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'linkawy_editors_pick_orderby');

/**
 * Add quick edit support for Editor's Pick
 */
function linkawy_quick_edit_editors_pick($column_name, $post_type) {
    if ($column_name !== 'editors_pick' || $post_type !== 'post') {
        return;
    }
    ?>
    <fieldset class="inline-edit-col-right">
        <div class="inline-edit-col">
            <label class="alignleft">
                <input type="checkbox" name="linkawy_editors_pick" value="1">
                <span class="checkbox-title"><?php _e('اختيار المحرر', 'linkawy'); ?></span>
            </label>
        </div>
    </fieldset>
    <?php
}
add_action('quick_edit_custom_box', 'linkawy_quick_edit_editors_pick', 10, 2);

/**
 * Save quick edit Editor's Pick
 */
function linkawy_save_quick_edit_editors_pick($post_id) {
    // Skip if doing autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Check if this is a quick edit save
    if (isset($_POST['_inline_edit']) && wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce')) {
        if (isset($_POST['linkawy_editors_pick']) && $_POST['linkawy_editors_pick'] == '1') {
            update_post_meta($post_id, '_is_editors_pick', '1');
        } else {
            delete_post_meta($post_id, '_is_editors_pick');
        }
    }
}
add_action('save_post', 'linkawy_save_quick_edit_editors_pick');

/**
 * Add JavaScript for quick edit
 */
function linkawy_quick_edit_js() {
    global $current_screen;
    
    if ($current_screen->id !== 'edit-post') {
        return;
    }
    ?>
    <script type="text/javascript">
    jQuery(function($) {
        var $inlineEdit = inlineEditPost.edit;
        
        inlineEditPost.edit = function(id) {
            $inlineEdit.apply(this, arguments);
            
            var postId = 0;
            if (typeof(id) === 'object') {
                postId = parseInt(this.getId(id));
            }
            
            if (postId > 0) {
                var $row = $('#post-' + postId);
                var editorsPick = $row.find('.column-editors_pick span').text().trim() === '★';
                
                $('input[name="linkawy_editors_pick"]', '.inline-edit-row').prop('checked', editorsPick);
            }
        };
    });
    </script>
    <?php
}
add_action('admin_footer', 'linkawy_quick_edit_js');
