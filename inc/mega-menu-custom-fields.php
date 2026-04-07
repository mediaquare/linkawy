<?php
/**
 * Custom Fields for Mega Menu Items
 * 
 * Adds custom fields to menu items in the WordPress admin
 * for configuring mega menu settings.
 *
 * @package Linkawy
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add custom fields to menu item
 *
 * @param int      $item_id Menu item ID.
 * @param WP_Post  $item    Menu item data object.
 * @param int      $depth   Depth of menu item.
 * @param stdClass $args    An object of menu item arguments.
 */
function linkawy_add_mega_menu_fields($item_id, $item, $depth, $args) {
    // Only show for top-level menu items
    if ($depth !== 0) {
        return;
    }
    
    // Get saved values
    $enable_mega_menu   = get_post_meta($item_id, '_menu_item_enable_mega_menu', true);
    $cta_title          = get_post_meta($item_id, '_menu_item_mega_menu_cta_title', true);
    $cta_description    = get_post_meta($item_id, '_menu_item_mega_menu_cta_description', true);
    $cta_button_text    = get_post_meta($item_id, '_menu_item_mega_menu_cta_button_text', true);
    $cta_button_url     = get_post_meta($item_id, '_menu_item_mega_menu_cta_button_url', true);
    ?>
    
    <div class="linkawy-mega-menu-fields" style="clear: both; padding: 10px 0; border-top: 1px dashed #ccc; margin-top: 10px;">
        <p class="field-mega-menu-enable description description-wide">
            <label for="edit-menu-item-mega-menu-<?php echo esc_attr($item_id); ?>">
                <input type="checkbox" 
                       id="edit-menu-item-mega-menu-<?php echo esc_attr($item_id); ?>" 
                       name="menu-item-mega-menu[<?php echo esc_attr($item_id); ?>]" 
                       value="1" 
                       <?php checked($enable_mega_menu, '1'); ?>>
                <?php esc_html_e('تفعيل الميجا منيو لهذا العنصر', 'linkawy'); ?>
            </label>
            <span class="description" style="display: block; margin-top: 5px; color: #666; font-size: 12px;">
                <?php esc_html_e('يتطلب وجود عناصر فرعية (sub-items) لعرض الميجا منيو', 'linkawy'); ?>
            </span>
        </p>
        
        <div class="mega-menu-cta-fields" style="margin-top: 15px; padding: 15px; background: #f9f9f9; border-radius: 4px; display: <?php echo $enable_mega_menu ? 'block' : 'none'; ?>;">
            <p style="margin: 0 0 10px; font-weight: 600; color: #1d2327;">
                <?php esc_html_e('إعدادات قسم CTA (اختياري)', 'linkawy'); ?>
            </p>
            
            <p class="field-mega-menu-cta-title description description-wide">
                <label for="edit-menu-item-cta-title-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e('عنوان CTA', 'linkawy'); ?>
                    <input type="text" 
                           id="edit-menu-item-cta-title-<?php echo esc_attr($item_id); ?>" 
                           class="widefat" 
                           name="menu-item-cta-title[<?php echo esc_attr($item_id); ?>]" 
                           value="<?php echo esc_attr($cta_title); ?>"
                           placeholder="<?php esc_attr_e('مثال: هل أنت مستعد لتصدر نتائج البحث؟', 'linkawy'); ?>">
                </label>
            </p>
            
            <p class="field-mega-menu-cta-description description description-wide">
                <label for="edit-menu-item-cta-description-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e('نص الوصف', 'linkawy'); ?>
                    <textarea id="edit-menu-item-cta-description-<?php echo esc_attr($item_id); ?>" 
                              class="widefat" 
                              rows="3" 
                              name="menu-item-cta-description[<?php echo esc_attr($item_id); ?>]"
                              placeholder="<?php esc_attr_e('مثال: دعنا نستكشف الفرص معًا...', 'linkawy'); ?>"><?php echo esc_textarea($cta_description); ?></textarea>
                </label>
            </p>
            
            <p class="field-mega-menu-cta-button-text description description-wide">
                <label for="edit-menu-item-cta-button-text-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e('نص الزر', 'linkawy'); ?>
                    <input type="text" 
                           id="edit-menu-item-cta-button-text-<?php echo esc_attr($item_id); ?>" 
                           class="widefat" 
                           name="menu-item-cta-button-text[<?php echo esc_attr($item_id); ?>]" 
                           value="<?php echo esc_attr($cta_button_text); ?>"
                           placeholder="<?php esc_attr_e('مثال: احجز استشارة مجانية', 'linkawy'); ?>">
                </label>
            </p>
            
            <p class="field-mega-menu-cta-button-url description description-wide">
                <label for="edit-menu-item-cta-button-url-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e('رابط الزر', 'linkawy'); ?>
                    <input type="url" 
                           id="edit-menu-item-cta-button-url-<?php echo esc_attr($item_id); ?>" 
                           class="widefat" 
                           name="menu-item-cta-button-url[<?php echo esc_attr($item_id); ?>]" 
                           value="<?php echo esc_url($cta_button_url); ?>"
                           placeholder="<?php esc_attr_e('مثال: /contact أو https://example.com', 'linkawy'); ?>">
                </label>
            </p>
        </div>
    </div>
    
    <?php
}
add_action('wp_nav_menu_item_custom_fields', 'linkawy_add_mega_menu_fields', 10, 4);

/**
 * Save custom fields for menu item
 *
 * @param int   $menu_id         ID of the updated menu.
 * @param int   $menu_item_db_id ID of the updated menu item.
 * @param array $args            An array of arguments used to update a menu item.
 */
function linkawy_save_mega_menu_fields($menu_id, $menu_item_db_id, $args) {
    // Enable mega menu checkbox
    if (isset($_POST['menu-item-mega-menu'][$menu_item_db_id])) {
        update_post_meta($menu_item_db_id, '_menu_item_enable_mega_menu', '1');
    } else {
        delete_post_meta($menu_item_db_id, '_menu_item_enable_mega_menu');
    }
    
    // CTA Title
    if (isset($_POST['menu-item-cta-title'][$menu_item_db_id])) {
        $cta_title = sanitize_text_field($_POST['menu-item-cta-title'][$menu_item_db_id]);
        if (!empty($cta_title)) {
            update_post_meta($menu_item_db_id, '_menu_item_mega_menu_cta_title', $cta_title);
        } else {
            delete_post_meta($menu_item_db_id, '_menu_item_mega_menu_cta_title');
        }
    }
    
    // CTA Description
    if (isset($_POST['menu-item-cta-description'][$menu_item_db_id])) {
        $cta_description = sanitize_textarea_field($_POST['menu-item-cta-description'][$menu_item_db_id]);
        if (!empty($cta_description)) {
            update_post_meta($menu_item_db_id, '_menu_item_mega_menu_cta_description', $cta_description);
        } else {
            delete_post_meta($menu_item_db_id, '_menu_item_mega_menu_cta_description');
        }
    }
    
    // CTA Button Text
    if (isset($_POST['menu-item-cta-button-text'][$menu_item_db_id])) {
        $cta_button_text = sanitize_text_field($_POST['menu-item-cta-button-text'][$menu_item_db_id]);
        if (!empty($cta_button_text)) {
            update_post_meta($menu_item_db_id, '_menu_item_mega_menu_cta_button_text', $cta_button_text);
        } else {
            delete_post_meta($menu_item_db_id, '_menu_item_mega_menu_cta_button_text');
        }
    }
    
    // CTA Button URL
    if (isset($_POST['menu-item-cta-button-url'][$menu_item_db_id])) {
        $cta_button_url = esc_url_raw($_POST['menu-item-cta-button-url'][$menu_item_db_id]);
        if (!empty($cta_button_url)) {
            update_post_meta($menu_item_db_id, '_menu_item_mega_menu_cta_button_url', $cta_button_url);
        } else {
            delete_post_meta($menu_item_db_id, '_menu_item_mega_menu_cta_button_url');
        }
    }
}
add_action('wp_update_nav_menu_item', 'linkawy_save_mega_menu_fields', 10, 3);

/**
 * Load custom fields data into menu item
 *
 * @param WP_Post $menu_item The menu item post object.
 * @return WP_Post Modified menu item.
 */
function linkawy_load_mega_menu_fields($menu_item) {
    $menu_item->enable_mega_menu      = get_post_meta($menu_item->ID, '_menu_item_enable_mega_menu', true);
    $menu_item->mega_menu_cta_title   = get_post_meta($menu_item->ID, '_menu_item_mega_menu_cta_title', true);
    $menu_item->mega_menu_cta_desc    = get_post_meta($menu_item->ID, '_menu_item_mega_menu_cta_description', true);
    $menu_item->mega_menu_cta_btn_txt = get_post_meta($menu_item->ID, '_menu_item_mega_menu_cta_button_text', true);
    $menu_item->mega_menu_cta_btn_url = get_post_meta($menu_item->ID, '_menu_item_mega_menu_cta_button_url', true);
    
    return $menu_item;
}
add_filter('wp_setup_nav_menu_item', 'linkawy_load_mega_menu_fields');

/**
 * Add admin script to toggle CTA fields visibility
 */
function linkawy_mega_menu_admin_script() {
    $screen = get_current_screen();
    if ($screen && $screen->id !== 'nav-menus') {
        return;
    }
    ?>
    <script>
    jQuery(document).ready(function($) {
        // Toggle CTA fields visibility based on checkbox
        function toggleCtaFields(checkbox) {
            var $container = $(checkbox).closest('.linkawy-mega-menu-fields');
            var $ctaFields = $container.find('.mega-menu-cta-fields');
            
            if ($(checkbox).is(':checked')) {
                $ctaFields.slideDown(200);
            } else {
                $ctaFields.slideUp(200);
            }
        }
        
        // Initial state
        $('input[name^="menu-item-mega-menu"]').each(function() {
            var $container = $(this).closest('.linkawy-mega-menu-fields');
            var $ctaFields = $container.find('.mega-menu-cta-fields');
            
            if ($(this).is(':checked')) {
                $ctaFields.show();
            } else {
                $ctaFields.hide();
            }
        });
        
        // On checkbox change
        $(document).on('change', 'input[name^="menu-item-mega-menu"]', function() {
            toggleCtaFields(this);
        });
        
        // Handle dynamically added menu items
        $(document).on('menu-item-added', function(event, menuItem) {
            var $menuItem = $(menuItem);
            $menuItem.find('input[name^="menu-item-mega-menu"]').each(function() {
                toggleCtaFields(this);
            });
        });
    });
    </script>
    <style>
    .linkawy-mega-menu-fields {
        margin-top: 10px;
    }
    .linkawy-mega-menu-fields .mega-menu-cta-fields {
        margin-top: 15px;
    }
    .linkawy-mega-menu-fields .mega-menu-cta-fields p {
        margin-bottom: 10px;
    }
    .linkawy-mega-menu-fields .mega-menu-cta-fields label {
        display: block;
        margin-bottom: 5px;
    }
    .linkawy-mega-menu-fields .mega-menu-cta-fields input,
    .linkawy-mega-menu-fields .mega-menu-cta-fields textarea {
        width: 100%;
    }
    </style>
    <?php
}
add_action('admin_footer', 'linkawy_mega_menu_admin_script');
