<?php
/**
 * Resource Hero & CTA Meta Box
 *
 * Custom fields for the resource single template (hero title, subtitle, CTA button).
 * Default CTA text: "احصل على المورد" when left empty.
 *
 * @package Linkawy
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Resource Hero Meta Box
 */
function linkawy_register_resource_meta_boxes() {
    add_meta_box(
        'linkawy_resource_hero',
        __('محتوى هيرو المورد', 'linkawy'),
        'linkawy_resource_hero_meta_box_html',
        'resources',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'linkawy_register_resource_meta_boxes');

/**
 * Resource Hero Meta Box HTML
 */
function linkawy_resource_hero_meta_box_html($post) {
    wp_nonce_field('linkawy_resource_hero_nonce', 'linkawy_resource_hero_nonce');

    $title    = get_post_meta($post->ID, '_resource_hero_title', true);
    $subtitle = get_post_meta($post->ID, '_resource_hero_subtitle', true);
    $cta_text = get_post_meta($post->ID, '_resource_cta_text', true);
    $cta_url  = get_post_meta($post->ID, '_resource_cta_url', true);
    $cta_icon = get_post_meta($post->ID, '_resource_cta_icon', true);

    $icon_options = array(
        ''              => __('بدون أيقونة', 'linkawy'),
        'arrow-left'    => __('سهم', 'linkawy'),
        'download'      => __('تحميل', 'linkawy'),
        'external-link' => __('رابط خارجي', 'linkawy'),
        'code'          => __('كود', 'linkawy'),
    );
    ?>
    <div class="linkawy-resource-hero-fields">
        <p>
            <label for="resource_hero_title" style="display:block; margin-bottom:4px; font-weight:600;"><?php _e('عنوان الهيرو', 'linkawy'); ?></label>
            <input type="text" id="resource_hero_title" name="resource_hero_title" value="<?php echo esc_attr($title); ?>" class="widefat" placeholder="<?php esc_attr_e('اتركه فارغاً لاستخدام عنوان المورد', 'linkawy'); ?>">
        </p>
        <p>
            <label for="resource_hero_subtitle" style="display:block; margin-bottom:4px; font-weight:600;"><?php _e('وصف الهيرو', 'linkawy'); ?></label>
            <textarea id="resource_hero_subtitle" name="resource_hero_subtitle" class="widefat" rows="3" placeholder="<?php esc_attr_e('نص وصفي يظهر تحت العنوان', 'linkawy'); ?>"><?php echo esc_textarea($subtitle); ?></textarea>
        </p>
        <p>
            <label style="display:block; margin-bottom:4px; font-weight:600;"><?php _e('زر CTA', 'linkawy'); ?></label>
            <input type="text" name="resource_cta_text" value="<?php echo esc_attr($cta_text); ?>" class="widefat" placeholder="<?php esc_attr_e('احصل على المورد (افتراضي)', 'linkawy'); ?>" style="margin-bottom:6px;">
            <input type="url" name="resource_cta_url" value="<?php echo esc_attr($cta_url); ?>" class="widefat" placeholder="<?php esc_attr_e('رابط الزر', 'linkawy'); ?>" style="margin-bottom:6px;">
            <label for="resource_cta_icon" style="display:block; margin-top:6px; margin-bottom:4px; font-weight:600;"><?php _e('أيقونة الزر (اختياري)', 'linkawy'); ?></label>
            <select name="resource_cta_icon" id="resource_cta_icon" class="widefat">
                <?php foreach ($icon_options as $value => $label) : ?>
                    <option value="<?php echo esc_attr($value); ?>" <?php selected($cta_icon, $value); ?>><?php echo esc_html($label); ?></option>
                <?php endforeach; ?>
            </select>
        </p>
    </div>
    <?php
}

/**
 * Get resource CTA text, URL and icon (with defaults).
 *
 * @param int $post_id Resource post ID.
 * @return array{text: string, url: string, icon: string} CTA data; url empty means do not show button.
 */
function linkawy_get_resource_cta($post_id) {
    $text = get_post_meta($post_id, '_resource_cta_text', true);
    $url  = get_post_meta($post_id, '_resource_cta_url', true);
    $icon = get_post_meta($post_id, '_resource_cta_icon', true);

    if ($text === '') {
        $text = __('احصل على المورد', 'linkawy');
    }

    return array(
        'text' => $text,
        'url'  => $url,
        'icon' => $icon,
    );
}

/**
 * Save Resource Hero Meta
 */
function linkawy_save_resource_hero_meta($post_id) {
    if (!isset($_POST['linkawy_resource_hero_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['linkawy_resource_hero_nonce'], 'linkawy_resource_hero_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (get_post_type($post_id) !== 'resources') {
        return;
    }

    $fields = array(
        'resource_hero_title'  => '_resource_hero_title',
        'resource_hero_subtitle' => '_resource_hero_subtitle',
        'resource_cta_text'    => '_resource_cta_text',
        'resource_cta_url'     => '_resource_cta_url',
        'resource_cta_icon'    => '_resource_cta_icon',
    );

    foreach ($fields as $post_key => $meta_key) {
        if (!isset($_POST[$post_key])) {
            continue;
        }
        if ($meta_key === '_resource_cta_url') {
            $value = esc_url_raw($_POST[$post_key]);
        } elseif ($meta_key === '_resource_hero_subtitle') {
            $value = sanitize_textarea_field($_POST[$post_key]);
        } else {
            $value = sanitize_text_field($_POST[$post_key]);
        }
        update_post_meta($post_id, $meta_key, $value);
    }
}
add_action('save_post_resources', 'linkawy_save_resource_hero_meta');
