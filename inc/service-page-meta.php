<?php
/**
 * Service Page Hero Meta Box
 *
 * Custom fields for the service page template hero (title, subtitle, buttons).
 * Subtitle also appears on the default page template (page.php) when filled.
 *
 * @package Linkawy
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Service Page Hero Meta Box
 */
function linkawy_register_service_page_meta_boxes() {
    add_meta_box(
        'linkawy_service_hero',
        __('محتوى هيرو صفحة الخدمة', 'linkawy'),
        'linkawy_service_hero_meta_box_html',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'linkawy_register_service_page_meta_boxes');

/**
 * Service Hero Meta Box HTML
 */
function linkawy_service_hero_meta_box_html($post) {
    wp_nonce_field('linkawy_service_hero_nonce', 'linkawy_service_hero_nonce');

    $title = get_post_meta($post->ID, '_service_hero_title', true);
    $subtitle = get_post_meta($post->ID, '_service_hero_subtitle', true);
    $primary_text = get_post_meta($post->ID, '_service_hero_primary_btn_text', true);
    $primary_url = get_post_meta($post->ID, '_service_hero_primary_btn_url', true);
    $primary_icon = get_post_meta($post->ID, '_service_hero_primary_btn_icon', true);
    $current_template = get_post_meta($post->ID, '_wp_page_template', true);
    $is_service_template = ($current_template === 'page-templates/service-page.php');
    $icon_options = array(
        '' => __('بدون أيقونة', 'linkawy'),
        'whatsapp' => __('واتساب', 'linkawy'),
        'phone' => __('اتصال', 'linkawy'),
        'search' => __('بحث', 'linkawy'),
        'send' => __('إرسال', 'linkawy'),
        'arrow-left' => __('سهم', 'linkawy'),
    );
    ?>
    <?php if (!$is_service_template) : ?>
    <p class="description" style="margin-bottom:12px;"><?php _e('حقول العنوان والزر تُستخدم مع قالب «صفحة الخدمة» فقط. حقل «وصف الهيرو» يظهر أيضاً في القالب الافتراضي للصفحة أسفل العنوان عند تعبئته.', 'linkawy'); ?></p>
    <?php endif; ?>
    <div id="linkawy-service-hero-meta-box" class="linkawy-service-hero-fields">
        <p>
            <label for="service_hero_title" style="display:block; margin-bottom:4px; font-weight:600;"><?php _e('عنوان الهيرو', 'linkawy'); ?></label>
            <input type="text" id="service_hero_title" name="service_hero_title" value="<?php echo esc_attr($title); ?>" class="widefat" placeholder="<?php esc_attr_e('اتركه فارغاً لاستخدام عنوان الصفحة', 'linkawy'); ?>">
        </p>
        <p>
            <label for="service_hero_subtitle" style="display:block; margin-bottom:4px; font-weight:600;"><?php _e('وصف الهيرو', 'linkawy'); ?></label>
            <textarea id="service_hero_subtitle" name="service_hero_subtitle" class="widefat" rows="3" placeholder="<?php esc_attr_e('نص وصفي يظهر تحت العنوان', 'linkawy'); ?>"><?php echo esc_textarea($subtitle); ?></textarea>
        </p>
        <p>
            <label style="display:block; margin-bottom:4px; font-weight:600;"><?php _e('الزر الأساسي', 'linkawy'); ?></label>
            <input type="text" name="service_hero_primary_btn_text" value="<?php echo esc_attr($primary_text); ?>" class="widefat" placeholder="<?php esc_attr_e('نص الزر', 'linkawy'); ?>" style="margin-bottom:6px;">
            <input type="url" name="service_hero_primary_btn_url" value="<?php echo esc_attr($primary_url); ?>" class="widefat" placeholder="<?php esc_attr_e('رابط الزر', 'linkawy'); ?>" style="margin-bottom:6px;">
            <label for="service_hero_primary_btn_icon" style="display:block; margin-top:6px; margin-bottom:4px; font-weight:600;"><?php _e('أيقونة الزر (اختياري)', 'linkawy'); ?></label>
            <select name="service_hero_primary_btn_icon" id="service_hero_primary_btn_icon" class="widefat">
                <?php foreach ($icon_options as $value => $label) : ?>
                    <option value="<?php echo esc_attr($value); ?>" <?php selected($primary_icon, $value); ?>><?php echo esc_html($label); ?></option>
                <?php endforeach; ?>
            </select>
        </p>
    </div>
    <?php
}

/**
 * Save Service Hero Meta
 */
function linkawy_save_service_hero_meta($post_id) {
    if (!isset($_POST['linkawy_service_hero_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['linkawy_service_hero_nonce'], 'linkawy_service_hero_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'service_hero_title'             => '_service_hero_title',
        'service_hero_subtitle'         => '_service_hero_subtitle',
        'service_hero_primary_btn_text'  => '_service_hero_primary_btn_text',
        'service_hero_primary_btn_url'   => '_service_hero_primary_btn_url',
        'service_hero_primary_btn_icon'  => '_service_hero_primary_btn_icon',
    );

    foreach ($fields as $post_key => $meta_key) {
        if (!isset($_POST[$post_key])) {
            continue;
        }
        if ($post_key === 'service_hero_primary_btn_url') {
            $value = esc_url_raw($_POST[$post_key]);
        } elseif ($post_key === 'service_hero_subtitle') {
            $value = sanitize_textarea_field($_POST[$post_key]);
        } else {
            $value = sanitize_text_field($_POST[$post_key]);
        }
        update_post_meta($post_id, $meta_key, $value);
    }
}
add_action('save_post', 'linkawy_save_service_hero_meta');
