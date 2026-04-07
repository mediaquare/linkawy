<?php
/**
 * Custom User Profile Fields
 *
 * @package Linkawy
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue media uploader scripts on user profile page
 */
function linkawy_enqueue_admin_media_scripts($hook) {
    if ($hook === 'profile.php' || $hook === 'user-edit.php') {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'linkawy_enqueue_admin_media_scripts');

/**
 * Add custom fields to user profile
 */
function linkawy_add_user_profile_fields($user) {
    // Get current values
    $short_bio = get_user_meta($user->ID, '_linkawy_short_bio', true);
    $author_avatar = get_user_meta($user->ID, '_author_avatar', true);
    $linkedin = get_user_meta($user->ID, '_linkawy_linkedin', true);
    $twitter = get_user_meta($user->ID, '_linkawy_twitter', true);
    $facebook = get_user_meta($user->ID, '_linkawy_facebook', true);
    $instagram = get_user_meta($user->ID, '_linkawy_instagram', true);
    ?>
    
    <h2><?php _e('معلومات Linkawy الإضافية', 'linkawy'); ?></h2>
    
    <table class="form-table" role="presentation">
        <!-- Author Avatar -->
        <tr>
            <th><label for="author_avatar"><?php _e('صورة الكاتب', 'linkawy'); ?></label></th>
            <td>
                <?php $default_avatar = get_avatar_url($user->ID, array('size' => 200)); ?>
                <div id="author-avatar-preview" style="margin-bottom: 10px;">
                    <?php if ($author_avatar) : ?>
                        <img src="<?php echo esc_url($author_avatar); ?>" alt="" style="max-width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 3px solid #ddd;">
                    <?php else : ?>
                        <img src="<?php echo esc_url($default_avatar); ?>" alt="" style="max-width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 3px solid #ddd; opacity: 0.5;">
                    <?php endif; ?>
                </div>
                <input type="hidden" name="author_avatar" id="author_avatar" value="<?php echo esc_url($author_avatar); ?>">
                <input type="hidden" name="author_avatar_id" id="author_avatar_id" value="<?php echo esc_attr(get_user_meta($user->ID, '_author_avatar_id', true)); ?>">
                <button type="button" class="button" id="upload-author-avatar"><?php _e('اختر صورة', 'linkawy'); ?></button>
                <button type="button" class="button" id="remove-author-avatar" <?php echo empty($author_avatar) ? 'style="display:none;"' : ''; ?>><?php _e('إزالة الصورة', 'linkawy'); ?></button>
                <p class="description">
                    <?php _e('يُفضل صورة مربعة 200x200 بكسل. اتركه فارغاً لاستخدام صورة Gravatar الافتراضية.', 'linkawy'); ?>
                </p>
                
                <script>
                jQuery(document).ready(function($) {
                    var mediaUploader;
                    var defaultAvatar = '<?php echo esc_url($default_avatar); ?>';
                    
                    $('#upload-author-avatar').on('click', function(e) {
                        e.preventDefault();
                        
                        if (mediaUploader) {
                            mediaUploader.open();
                            return;
                        }
                        
                        mediaUploader = wp.media({
                            title: '<?php _e('اختر صورة الكاتب', 'linkawy'); ?>',
                            button: {
                                text: '<?php _e('استخدم هذه الصورة', 'linkawy'); ?>'
                            },
                            multiple: false,
                            library: {
                                type: 'image'
                            }
                        });
                        
                        mediaUploader.on('select', function() {
                            var attachment = mediaUploader.state().get('selection').first().toJSON();
                            $('#author_avatar').val(attachment.url);
                            $('#author_avatar_id').val(attachment.id);
                            $('#author-avatar-preview img').attr('src', attachment.url).css('opacity', '1');
                            $('#remove-author-avatar').show();
                        });
                        
                        mediaUploader.open();
                    });
                    
                    $('#remove-author-avatar').on('click', function(e) {
                        e.preventDefault();
                        $('#author_avatar').val('');
                        $('#author_avatar_id').val('');
                        $('#author-avatar-preview img').attr('src', defaultAvatar).css('opacity', '0.5');
                        $(this).hide();
                    });
                });
                </script>
            </td>
        </tr>
        
        <!-- Short Bio -->
        <tr>
            <th><label for="linkawy_short_bio"><?php _e('نبذة تعريفية قصيرة', 'linkawy'); ?></label></th>
            <td>
                <textarea name="linkawy_short_bio" id="linkawy_short_bio" rows="3" cols="30" class="regular-text"><?php echo esc_textarea($short_bio); ?></textarea>
                <p class="description">
                    <?php _e('نبذة قصيرة تظهر في بطاقة الكاتب في الشريط الجانبي (يُنصح بـ 50-100 حرف).', 'linkawy'); ?>
                </p>
            </td>
        </tr>
    </table>
    
    <h3><?php _e('حسابات السوشيال ميديا', 'linkawy'); ?></h3>
    <p class="description"><?php _e('هذه الروابط ستظهر في صندوق الكاتب أسفل المقالات.', 'linkawy'); ?></p>
    
    <table class="form-table" role="presentation">
        <!-- LinkedIn -->
        <tr>
            <th><label for="linkawy_linkedin"><?php _e('LinkedIn', 'linkawy'); ?></label></th>
            <td>
                <input type="url" name="linkawy_linkedin" id="linkawy_linkedin" 
                       value="<?php echo esc_url($linkedin); ?>" class="regular-text"
                       placeholder="https://linkedin.com/in/username">
            </td>
        </tr>
        
        <!-- Twitter/X -->
        <tr>
            <th><label for="linkawy_twitter"><?php _e('X (Twitter)', 'linkawy'); ?></label></th>
            <td>
                <input type="url" name="linkawy_twitter" id="linkawy_twitter" 
                       value="<?php echo esc_url($twitter); ?>" class="regular-text"
                       placeholder="https://x.com/username">
            </td>
        </tr>
        
        <!-- Facebook -->
        <tr>
            <th><label for="linkawy_facebook"><?php _e('Facebook', 'linkawy'); ?></label></th>
            <td>
                <input type="url" name="linkawy_facebook" id="linkawy_facebook" 
                       value="<?php echo esc_url($facebook); ?>" class="regular-text"
                       placeholder="https://facebook.com/username">
            </td>
        </tr>
        
        <!-- Instagram -->
        <tr>
            <th><label for="linkawy_instagram"><?php _e('Instagram', 'linkawy'); ?></label></th>
            <td>
                <input type="url" name="linkawy_instagram" id="linkawy_instagram" 
                       value="<?php echo esc_url($instagram); ?>" class="regular-text"
                       placeholder="https://instagram.com/username">
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'linkawy_add_user_profile_fields');
add_action('edit_user_profile', 'linkawy_add_user_profile_fields');

/**
 * Save custom user profile fields
 */
function linkawy_save_user_profile_fields($user_id) {
    // Check permissions
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    
    // Save short bio
    if (isset($_POST['linkawy_short_bio'])) {
        update_user_meta($user_id, '_linkawy_short_bio', sanitize_textarea_field($_POST['linkawy_short_bio']));
    }
    
    // Save author avatar
    if (isset($_POST['author_avatar'])) {
        update_user_meta($user_id, '_author_avatar', esc_url_raw($_POST['author_avatar']));
    }
    
    // Save author avatar attachment ID
    if (isset($_POST['author_avatar_id'])) {
        update_user_meta($user_id, '_author_avatar_id', absint($_POST['author_avatar_id']));
    }
    
    // Save social media links
    if (isset($_POST['linkawy_linkedin'])) {
        update_user_meta($user_id, '_linkawy_linkedin', esc_url_raw($_POST['linkawy_linkedin']));
    }
    
    if (isset($_POST['linkawy_twitter'])) {
        update_user_meta($user_id, '_linkawy_twitter', esc_url_raw($_POST['linkawy_twitter']));
    }
    
    if (isset($_POST['linkawy_facebook'])) {
        update_user_meta($user_id, '_linkawy_facebook', esc_url_raw($_POST['linkawy_facebook']));
    }
    
    if (isset($_POST['linkawy_instagram'])) {
        update_user_meta($user_id, '_linkawy_instagram', esc_url_raw($_POST['linkawy_instagram']));
    }
}
add_action('personal_options_update', 'linkawy_save_user_profile_fields');
add_action('edit_user_profile_update', 'linkawy_save_user_profile_fields');

/**
 * Get author short bio with fallback to main bio
 */
function linkawy_get_author_short_bio($user_id = null) {
    if (!$user_id) {
        $user_id = get_the_author_meta('ID');
    }
    
    $short_bio = get_user_meta($user_id, '_linkawy_short_bio', true);
    
    if ($short_bio) {
        return $short_bio;
    }
    
    // Fallback to main bio (truncated)
    $main_bio = get_the_author_meta('description', $user_id);
    if ($main_bio) {
        return wp_trim_words($main_bio, 20, '...');
    }
    
    return __('كاتب محتوى في Linkawy، متخصص في السيو والتسويق الرقمي.', 'linkawy');
}

/**
 * Get author social links
 */
function linkawy_get_author_social_links($user_id = null) {
    if (!$user_id) {
        $user_id = get_the_author_meta('ID');
    }
    
    return array(
        'linkedin'  => get_user_meta($user_id, '_linkawy_linkedin', true),
        'twitter'   => get_user_meta($user_id, '_linkawy_twitter', true),
        'facebook'  => get_user_meta($user_id, '_linkawy_facebook', true),
        'instagram' => get_user_meta($user_id, '_linkawy_instagram', true),
    );
}

/**
 * Display author social links
 */
function linkawy_author_social_links($user_id = null) {
    $social = linkawy_get_author_social_links($user_id);
    $has_social = false;
    
    foreach ($social as $link) {
        if (!empty($link)) {
            $has_social = true;
            break;
        }
    }
    
    if (!$has_social) {
        return;
    }
    ?>
    <div class="author-box-social">
        <?php if (!empty($social['linkedin'])) : ?>
            <a href="<?php echo esc_url($social['linkedin']); ?>" aria-label="LinkedIn" target="_blank" rel="noopener">
                <i class="fab fa-linkedin-in"></i>
            </a>
        <?php endif; ?>
        
        <?php if (!empty($social['twitter'])) : ?>
            <a href="<?php echo esc_url($social['twitter']); ?>" aria-label="X" target="_blank" rel="noopener">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                </svg>
            </a>
        <?php endif; ?>
        
        <?php if (!empty($social['facebook'])) : ?>
            <a href="<?php echo esc_url($social['facebook']); ?>" aria-label="Facebook" target="_blank" rel="noopener">
                <i class="fab fa-facebook-f"></i>
            </a>
        <?php endif; ?>
        
        <?php if (!empty($social['instagram'])) : ?>
            <a href="<?php echo esc_url($social['instagram']); ?>" aria-label="Instagram" target="_blank" rel="noopener">
                <i class="fab fa-instagram"></i>
            </a>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Get author avatar URL with fallback to WordPress default
 * 
 * @param int $user_id User ID
 * @param int $size Image size in pixels (default 200)
 * @return string Avatar URL
 */
function linkawy_get_author_avatar_url($user_id = null, $size = 200) {
    if (!$user_id) {
        $user_id = get_the_author_meta('ID');
    }
    
    // First try to get from attachment ID (optimized)
    $avatar_id = get_user_meta($user_id, '_author_avatar_id', true);
    
    if ($avatar_id) {
        $image_src = wp_get_attachment_image_src($avatar_id, array($size, $size));
        if ($image_src) {
            return $image_src[0];
        }
    }
    
    // Fallback to stored URL
    $custom_avatar = get_user_meta($user_id, '_author_avatar', true);
    
    if ($custom_avatar) {
        return $custom_avatar;
    }
    
    // Use WordPress default avatar (Gravatar)
    return get_avatar_url($user_id, array('size' => $size));
}

/**
 * Get author avatar image tag with optimized srcset for Lighthouse
 * 
 * @param int $user_id User ID
 * @param int $size Display size in pixels
 * @param string $class CSS class for the image
 * @return string Complete img tag with optimized srcset (1x and 2x only)
 */
function linkawy_get_author_avatar_img($user_id = null, $size = 80, $class = 'author-avatar') {
    if (!$user_id) {
        $user_id = get_the_author_meta('ID');
    }
    
    $alt = esc_attr(get_the_author_meta('display_name', $user_id));
    $size_2x = $size * 2;
    
    // Try to get from attachment ID for optimized responsive image
    $avatar_id = get_user_meta($user_id, '_author_avatar_id', true);
    
    if ($avatar_id) {
        // Get image URLs for 1x and 2x sizes only (optimized for Lighthouse)
        $src_1x = wp_get_attachment_image_src($avatar_id, array($size, $size));
        $src_2x = wp_get_attachment_image_src($avatar_id, array($size_2x, $size_2x));
        
        if ($src_1x) {
            $url_1x = $src_1x[0];
            $url_2x = $src_2x ? $src_2x[0] : $url_1x;
            
            // Build optimized srcset with only 1x and 2x (no extra sizes)
            $srcset = esc_url($url_1x) . ' 1x';
            if ($url_2x !== $url_1x) {
                $srcset .= ', ' . esc_url($url_2x) . ' 2x';
            }
            
            return sprintf(
                '<img src="%s" srcset="%s" width="%d" height="%d" alt="%s" class="%s" loading="lazy" decoding="async">',
                esc_url($url_1x),
                $srcset,
                $size,
                $size,
                $alt,
                esc_attr($class)
            );
        }
    }
    
    // Fallback to URL-based image
    $avatar_url = linkawy_get_author_avatar_url($user_id, $size);
    
    // For Gravatar URLs, create srcset with 1x and 2x
    if (strpos($avatar_url, 'gravatar.com') !== false) {
        $avatar_url_1x = add_query_arg('s', $size, preg_replace('/[?&]s=\d+/', '', $avatar_url));
        $avatar_url_2x = add_query_arg('s', $size_2x, preg_replace('/[?&]s=\d+/', '', $avatar_url));
        
        return sprintf(
            '<img src="%s" srcset="%s 1x, %s 2x" width="%d" height="%d" alt="%s" class="%s" loading="lazy" decoding="async">',
            esc_url($avatar_url_1x),
            esc_url($avatar_url_1x),
            esc_url($avatar_url_2x),
            $size,
            $size,
            $alt,
            esc_attr($class)
        );
    }
    
    // For other URLs, return simple img tag
    return sprintf(
        '<img src="%s" width="%d" height="%d" alt="%s" class="%s" loading="lazy" decoding="async">',
        esc_url($avatar_url),
        $size,
        $size,
        $alt,
        esc_attr($class)
    );
}

/**
 * Get editors and admins for reviewer dropdown
 */
function linkawy_get_reviewers() {
    $users = get_users(array(
        'role__in' => array('administrator', 'editor'),
        'orderby'  => 'display_name',
        'order'    => 'ASC',
    ));
    
    return $users;
}
