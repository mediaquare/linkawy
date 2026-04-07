<?php
/**
 * Prompt Meta Box & AJAX (Copy tracking, Filter/Search)
 *
 * @package Linkawy
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Prompt Meta Box
 */
function linkawy_register_prompt_meta_boxes() {
    add_meta_box(
        'linkawy_prompt_details',
        __('تفاصيل البرومبت', 'linkawy'),
        'linkawy_prompt_meta_box_html',
        'prompts',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'linkawy_register_prompt_meta_boxes');

/**
 * Prompt Meta Box HTML
 */
function linkawy_prompt_meta_box_html($post) {
    wp_nonce_field('linkawy_prompt_nonce', 'linkawy_prompt_nonce');

    $prompt_text   = get_post_meta($post->ID, '_prompt_text', true);
    $platform      = get_post_meta($post->ID, '_prompt_platform', true);
    $use_case      = get_post_meta($post->ID, '_prompt_use_case', true);
    $example       = get_post_meta($post->ID, '_prompt_example', true);
    $copies_count  = get_post_meta($post->ID, '_prompt_copies_count', true);
    $try_url       = get_post_meta($post->ID, '_prompt_try_url', true);
    $content_lock  = get_post_meta($post->ID, '_prompt_content_lock', true);

    $platform_options = array(
        ''         => __('— اختر المنصة —', 'linkawy'),
        'ChatGPT'  => 'ChatGPT',
        'Claude'   => 'Claude',
        'Gemini'   => 'Gemini',
        'Cursor'   => 'Cursor',
    );
    ?>
    <div class="linkawy-prompt-fields">
        <p>
            <label for="prompt_text" style="display:block; margin-bottom:4px; font-weight:600;"><?php _e('نص البرومبت', 'linkawy'); ?></label>
            <textarea id="prompt_text" name="prompt_text" class="widefat" rows="14" placeholder="<?php esc_attr_e('أدخل نص البرومبت (نص عادي بدون تنسيق)', 'linkawy'); ?>"><?php echo esc_textarea($prompt_text); ?></textarea>
        </p>
        <p>
            <label for="prompt_platform" style="display:block; margin-bottom:4px; font-weight:600;"><?php _e('المنصة المستهدفة', 'linkawy'); ?></label>
            <select name="prompt_platform" id="prompt_platform" class="widefat">
                <?php foreach ($platform_options as $value => $label) : ?>
                    <option value="<?php echo esc_attr($value); ?>" <?php selected($platform, $value); ?>><?php echo esc_html($label); ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="prompt_use_case" style="display:block; margin-bottom:4px; font-weight:600;"><?php _e('وصف أو استخدام البرومبت', 'linkawy'); ?></label>
            <textarea id="prompt_use_case" name="prompt_use_case" class="widefat" rows="4" placeholder="<?php esc_attr_e('وصف مختصر أو حالة الاستخدام', 'linkawy'); ?>"><?php echo esc_textarea($use_case); ?></textarea>
        </p>
        <p>
            <label for="prompt_example" style="display:block; margin-bottom:4px; font-weight:600;"><?php _e('مثال على النتيجة', 'linkawy'); ?></label>
            <textarea id="prompt_example" name="prompt_example" class="widefat" rows="4" placeholder="<?php esc_attr_e('مثال على مخرجات البرومبت', 'linkawy'); ?>"><?php echo esc_textarea($example); ?></textarea>
        </p>
        <p>
            <label for="prompt_copies_count" style="display:block; margin-bottom:4px; font-weight:600;"><?php _e('عدد مرات النسخ', 'linkawy'); ?></label>
            <input type="number" id="prompt_copies_count" name="prompt_copies_count" value="<?php echo esc_attr($copies_count); ?>" min="0" step="1" class="small-text">
            <span class="description"><?php _e('يُحدَّث تلقائياً عند النسخ، أو يمكن تعديله يدوياً', 'linkawy'); ?></span>
        </p>
        <p>
            <label for="prompt_try_url" style="display:block; margin-bottom:4px; font-weight:600;"><?php _e('رابط زر "جرّب الآن"', 'linkawy'); ?></label>
            <input type="url" id="prompt_try_url" name="prompt_try_url" value="<?php echo esc_attr($try_url); ?>" class="widefat" placeholder="<?php esc_attr_e('https://...', 'linkawy'); ?>">
        </p>
        <p>
            <label style="display:flex; align-items:flex-start; gap:8px; font-weight:600; cursor:pointer;">
                <input type="checkbox" name="prompt_content_lock" value="1" <?php checked($content_lock, '1'); ?> style="margin-top:3px;">
                <span><?php _e('قفل محتوى البرومبت (يظهر للزائر طبقة ضبابية حتى يشترك في النشرة ويفتح المحتوى)', 'linkawy'); ?></span>
            </label>
        </p>
    </div>
    <?php
}

/**
 * Get prompt meta (all fields with defaults).
 *
 * @param int $post_id Prompt post ID.
 * @return array
 */
function linkawy_get_prompt_meta($post_id) {
    return array(
        'prompt_text'      => get_post_meta($post_id, '_prompt_text', true),
        'platform'        => get_post_meta($post_id, '_prompt_platform', true),
        'use_case'        => get_post_meta($post_id, '_prompt_use_case', true),
        'example'         => get_post_meta($post_id, '_prompt_example', true),
        'copies_count'    => (int) get_post_meta($post_id, '_prompt_copies_count', true),
        'try_url'         => get_post_meta($post_id, '_prompt_try_url', true),
        'content_lock'    => (string) get_post_meta($post_id, '_prompt_content_lock', true) === '1',
    );
}

/**
 * HMAC token for prompt content unlock cookie.
 *
 * @param int $post_id Prompt post ID.
 * @return string
 */
function linkawy_prompt_unlock_token($post_id) {
    return hash_hmac('sha256', 'prompt_unlock|' . (int) $post_id, wp_salt('auth'));
}

/**
 * Whether visitor has unlocked this prompt via newsletter cookie.
 *
 * @param int $post_id Prompt post ID.
 * @return bool
 */
function linkawy_is_prompt_content_unlocked($post_id) {
    $post_id = absint($post_id);
    if (!$post_id) {
        return false;
    }
    $name = 'linkawy_pl_' . $post_id;
    if (empty($_COOKIE[$name])) {
        return false;
    }
    return hash_equals(linkawy_prompt_unlock_token($post_id), (string) wp_unslash($_COOKIE[$name]));
}

/**
 * Set cookie so this prompt stays unlocked (after newsletter signup).
 *
 * @param int $post_id Prompt post ID.
 */
function linkawy_set_prompt_unlock_cookie($post_id) {
    $post_id = absint($post_id);
    if (!$post_id) {
        return;
    }
    $name  = 'linkawy_pl_' . $post_id;
    $val   = linkawy_prompt_unlock_token($post_id);
    $expiry = time() + (int) (365 * DAY_IN_SECONDS * 2);
    $path   = (defined('COOKIEPATH') && COOKIEPATH) ? COOKIEPATH : '/';
    $domain = '';
    if (defined('COOKIE_DOMAIN') && COOKIE_DOMAIN) {
        $domain = COOKIE_DOMAIN;
    }
    if (PHP_VERSION_ID >= 70300) {
        setcookie(
            $name,
            $val,
            array(
                'expires'  => $expiry,
                'path'     => $path,
                'domain'   => $domain,
                'secure'   => is_ssl(),
                'httponly' => true,
                'samesite' => 'Lax',
            )
        );
    } else {
        setcookie($name, $val, $expiry, $path, $domain, is_ssl(), true);
    }
    $_COOKIE[$name] = $val;
}

/**
 * After newsletter AJAX: if unlocking a locked prompt, set cookie.
 *
 * @param int $unlock_prompt_id Prompt post ID from form (0 if none).
 */
function linkawy_maybe_unlock_prompt_after_newsletter($unlock_prompt_id) {
    $unlock_prompt_id = absint($unlock_prompt_id);
    if (!$unlock_prompt_id) {
        return;
    }
    $p = get_post($unlock_prompt_id);
    if (!$p || $p->post_type !== 'prompts' || $p->post_status !== 'publish') {
        return;
    }
    if ((string) get_post_meta($unlock_prompt_id, '_prompt_content_lock', true) !== '1') {
        return;
    }
    linkawy_set_prompt_unlock_cookie($unlock_prompt_id);
}

/**
 * Save Prompt Meta
 */
function linkawy_save_prompt_meta($post_id) {
    if (!isset($_POST['linkawy_prompt_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['linkawy_prompt_nonce'], 'linkawy_prompt_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (get_post_type($post_id) !== 'prompts') {
        return;
    }

    if (isset($_POST['prompt_text'])) {
        update_post_meta($post_id, '_prompt_text', sanitize_textarea_field($_POST['prompt_text']));
    }
    if (isset($_POST['prompt_platform'])) {
        update_post_meta($post_id, '_prompt_platform', sanitize_text_field($_POST['prompt_platform']));
    }
    if (isset($_POST['prompt_use_case'])) {
        update_post_meta($post_id, '_prompt_use_case', sanitize_textarea_field($_POST['prompt_use_case']));
    }
    if (isset($_POST['prompt_example'])) {
        update_post_meta($post_id, '_prompt_example', sanitize_textarea_field($_POST['prompt_example']));
    }
    if (isset($_POST['prompt_copies_count'])) {
        update_post_meta($post_id, '_prompt_copies_count', absint($_POST['prompt_copies_count']));
    }
    if (isset($_POST['prompt_try_url'])) {
        update_post_meta($post_id, '_prompt_try_url', esc_url_raw($_POST['prompt_try_url']));
    }
    if (isset($_POST['prompt_content_lock']) && $_POST['prompt_content_lock'] === '1') {
        update_post_meta($post_id, '_prompt_content_lock', '1');
    } else {
        delete_post_meta($post_id, '_prompt_content_lock');
    }
}
add_action('save_post_prompts', 'linkawy_save_prompt_meta');

/**
 * AJAX: Track prompt copy (increment copies count)
 */
function linkawy_ajax_track_prompt_copy() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'linkawy_prompt_copy')) {
        wp_send_json_error(array('message' => 'invalid_nonce'));
    }

    $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
    if (!$post_id || get_post_type($post_id) !== 'prompts') {
        wp_send_json_error(array('message' => 'invalid_post'));
    }

    if ((string) get_post_meta($post_id, '_prompt_content_lock', true) === '1' && !linkawy_is_prompt_content_unlocked($post_id)) {
        wp_send_json_error(array('message' => 'locked'));
    }

    $count = (int) get_post_meta($post_id, '_prompt_copies_count', true);
    $count++;
    update_post_meta($post_id, '_prompt_copies_count', $count);

    wp_send_json_success(array('copies_count' => $count));
}
add_action('wp_ajax_linkawy_track_prompt_copy', 'linkawy_ajax_track_prompt_copy');
add_action('wp_ajax_nopriv_linkawy_track_prompt_copy', 'linkawy_ajax_track_prompt_copy');

/**
 * Build pagination HTML for prompts archive (base URL + paged)
 *
 * @param string $base_url Archive URL (no trailing slash).
 * @param int    $current  Current page.
 * @param int    $max      Max pages.
 * @return string
 */
function linkawy_prompts_pagination_html($base_url, $current, $max) {
    if ($max <= 1) {
        return '';
    }

    $build_page_url = static function ($url, $page) {
        $url = remove_query_arg('paged', $url);
        if ((int) $page <= 1) {
            return $url;
        }
        return trailingslashit($url) . user_trailingslashit('page/' . (int) $page, 'paged');
    };

    $out = '<div class="pagination" data-current="' . esc_attr($current) . '" data-max="' . esc_attr($max) . '">';

    if ($current > 1) {
        $prev_url = $build_page_url($base_url, $current - 1);
        $out .= '<a href="' . esc_url($prev_url) . '" class="page-link" data-page="' . ($current - 1) . '"><i class="fas fa-chevron-right"></i></a>';
    }

    for ($i = 1; $i <= $max; $i++) {
        $page_url = $build_page_url($base_url, $i);
        if ($i == $current) {
            $out .= '<span class="page-link active">' . $i . '</span>';
        } else {
            $out .= '<a href="' . esc_url($page_url) . '" class="page-link" data-page="' . $i . '">' . $i . '</a>';
        }
    }

    if ($current < $max) {
        $next_url = $build_page_url($base_url, $current + 1);
        $out .= '<a href="' . esc_url($next_url) . '" class="page-link" data-page="' . ($current + 1) . '"><i class="fas fa-chevron-left"></i></a>';
    }

    $out .= '</div>';
    return $out;
}

/**
 * AJAX: Filter/Search prompts — returns HTML grid + pagination
 */
function linkawy_ajax_filter_prompts() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'linkawy_prompt_filter')) {
        wp_send_json_error(array('message' => 'invalid_nonce'));
    }

    $prompt_type    = isset($_POST['prompt_type']) ? sanitize_text_field(wp_unslash($_POST['prompt_type'])) : '';
    $prompt_tag     = isset($_POST['prompt_tag']) ? sanitize_text_field(wp_unslash($_POST['prompt_tag'])) : '';
    $prompt_tag_id  = isset($_POST['prompt_tag_id']) ? absint($_POST['prompt_tag_id']) : 0;
    $search         = isset($_POST['search']) ? sanitize_text_field(wp_unslash($_POST['search'])) : '';
    $paged          = isset($_POST['paged']) ? max(1, absint($_POST['paged'])) : 1;
    $per_page       = 15;

    $args = array(
        'post_type'      => 'prompts',
        'post_status'    => 'publish',
        'posts_per_page' => $per_page,
        'paged'          => $paged,
    );

    $tax_blocks = array();
    if ($prompt_type !== '') {
        $tax_blocks[] = array(
            'taxonomy' => 'prompt_type',
            'field'    => 'slug',
            'terms'    => $prompt_type,
        );
    }
    if ($prompt_tag_id > 0) {
        $tag_term_obj = get_term($prompt_tag_id, 'prompt_tag');
        if ($tag_term_obj && !is_wp_error($tag_term_obj)) {
            $tax_blocks[] = array(
                'taxonomy' => 'prompt_tag',
                'field'    => 'term_id',
                'terms'    => $prompt_tag_id,
            );
            if ($prompt_tag === '') {
                $prompt_tag = $tag_term_obj->slug;
            }
        }
    } elseif ($prompt_tag !== '') {
        $tax_blocks[] = array(
            'taxonomy' => 'prompt_tag',
            'field'    => 'slug',
            'terms'    => $prompt_tag,
        );
    }
    if (count($tax_blocks) === 1) {
        $args['tax_query'] = $tax_blocks;
    } elseif (count($tax_blocks) > 1) {
        $args['tax_query'] = array_merge(
            array('relation' => 'AND'),
            $tax_blocks
        );
    }

    if ($search !== '') {
        $args['s'] = $search;
    }

    $query = new WP_Query($args);

    ob_start();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', 'prompt');
        }
    } else {
        echo '<p class="no-posts">' . esc_html__('لا توجد برومبتات تطابق البحث.', 'linkawy') . '</p>';
    }
    $html = ob_get_clean();
    wp_reset_postdata();

    $base_url = get_post_type_archive_link('prompts');
    if ($prompt_type !== '') {
        $term = get_term_by('slug', $prompt_type, 'prompt_type');
        if ($term && !is_wp_error($term)) {
            $base_url = get_term_link($term);
            if (is_wp_error($base_url)) {
                $base_url = get_post_type_archive_link('prompts');
            }
        }
    }
    $base_url = remove_query_arg('paged', $base_url);
    if ($prompt_tag !== '') {
        if ($prompt_type === '') {
            $tag_term = get_term_by('slug', $prompt_tag, 'prompt_tag');
            if ($tag_term && !is_wp_error($tag_term)) {
                $tag_link = get_term_link($tag_term);
                if (!is_wp_error($tag_link)) {
                    $base_url = $tag_link;
                }
            }
        }
    }
    $pagination_html = linkawy_prompts_pagination_html($base_url, $paged, (int) $query->max_num_pages);

    wp_send_json_success(array(
        'html'            => $html,
        'pagination_html' => $pagination_html,
        'max_pages'        => (int) $query->max_num_pages,
        'current_page'     => $paged,
    ));
}
add_action('wp_ajax_linkawy_filter_prompts', 'linkawy_ajax_filter_prompts');
add_action('wp_ajax_nopriv_linkawy_filter_prompts', 'linkawy_ajax_filter_prompts');

/**
 * Set posts per page for prompts archive and taxonomy
 */
function linkawy_prompts_archive_posts_per_page($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }
    if ($query->is_post_type_archive('prompts') || $query->is_tax('prompt_type') || $query->is_tax('prompt_tag')) {
        $query->set('posts_per_page', 15);
    }
}
add_action('pre_get_posts', 'linkawy_prompts_archive_posts_per_page');

/**
 * When ?prompt_tag=slug is present, filter main archive / prompt_type taxonomy query.
 * Runs on parse_query so taxonomy conditionals are reliable on the main query.
 */
function linkawy_prompts_archive_prompt_tag_query($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }
    if (empty($_GET['prompt_tag'])) {
        return;
    }
    $slug = sanitize_text_field(wp_unslash($_GET['prompt_tag']));
    if ($slug === '') {
        return;
    }
    if (!$query->is_post_type_archive('prompts') && !$query->is_tax('prompt_type')) {
        return;
    }

    $tag_clause = array(
        'taxonomy' => 'prompt_tag',
        'field'    => 'slug',
        'terms'    => $slug,
    );

    if ($query->is_tax('prompt_type')) {
        $obj = isset($query->queried_object) ? $query->queried_object : null;
        if (!$obj || is_wp_error($obj) || empty($obj->slug)) {
            return;
        }
        $query->set(
            'tax_query',
            array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'prompt_type',
                    'field'    => 'slug',
                    'terms'    => $obj->slug,
                ),
                $tag_clause,
            )
        );
        return;
    }

    $query->set('tax_query', array($tag_clause));
}
add_action('parse_query', 'linkawy_prompts_archive_prompt_tag_query', 10);
