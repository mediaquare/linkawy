<?php
/**
 * Linkawy Theme Functions
 *
 * @package Linkawy
 * @version 11.06
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define theme constants
define('LINKAWY_VERSION', '11.06');
define('LINKAWY_DIR', get_template_directory());
define('LINKAWY_URI', get_template_directory_uri());

/**
 * Load theme setup
 */
require_once LINKAWY_DIR . '/inc/theme-setup.php';

/**
 * Load Custom Post Types
 */
require_once LINKAWY_DIR . '/inc/custom-post-types.php';

/**
 * Load template tags and helper functions
 */
require_once LINKAWY_DIR . '/inc/template-tags.php';

/**
 * Load custom user profile fields
 */
require_once LINKAWY_DIR . '/inc/user-fields.php';

/**
 * Load post meta fields (Editor's Pick, etc.)
 */
require_once LINKAWY_DIR . '/inc/post-meta.php';

/**
 * Load service page hero meta (for page template "صفحة الخدمة")
 */
require_once LINKAWY_DIR . '/inc/service-page-meta.php';

/**
 * Load resource meta (hero + CTA for resources CPT)
 */
require_once LINKAWY_DIR . '/inc/resource-meta.php';

/**
 * Load prompt meta (prompts CPT)
 */
require_once LINKAWY_DIR . '/inc/prompt-meta.php';

/**
 * reCAPTCHA helpers (contact + newsletter AJAX)
 */
require_once LINKAWY_DIR . '/inc/recaptcha-helpers.php';

/**
 * Contact form shortcode (before enqueue: used to load assets when shortcode is in content)
 */
require_once LINKAWY_DIR . '/inc/contact-form-shortcode.php';

/**
 * Google Maps embed shortcode
 */
require_once LINKAWY_DIR . '/inc/google-map-shortcode.php';

/**
 * Load scripts and styles (after prompt-meta for helpers used in enqueue)
 */
require_once LINKAWY_DIR . '/inc/enqueue-scripts.php';

/**
 * Load Mega Menu Walker class
 */
require_once LINKAWY_DIR . '/inc/class-linkawy-mega-menu-walker.php';

/**
 * Load Mega Menu custom fields
 */
require_once LINKAWY_DIR . '/inc/mega-menu-custom-fields.php';

/**
 * Load Theme Customizer settings
 */
require_once LINKAWY_DIR . '/inc/customizer.php';

/**
 * تفعيل Yoast Duplicate Post لأنواع المقالات المخصصة (الموارد والبرومبتات)
 * Enable Yoast Duplicate Post for custom post types: resources & prompts
 */
function linkawy_duplicate_post_enabled_post_types($enabled_post_types) {
    $custom_types = array('resources', 'prompts');
    foreach ($custom_types as $post_type) {
        if (!in_array($post_type, $enabled_post_types, true)) {
            $enabled_post_types[] = $post_type;
        }
    }
    return $enabled_post_types;
}
add_filter('duplicate_post_enabled_post_types', 'linkawy_duplicate_post_enabled_post_types');

/**
 * Allow SVG, WebP, and GIF uploads
 */
function linkawy_allow_svg_upload($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    $mimes['webp'] = 'image/webp';
    $mimes['gif'] = 'image/gif';
    return $mimes;
}
add_filter('upload_mimes', 'linkawy_allow_svg_upload');

/**
 * Fix SVG, WebP, and GIF file type check
 */
function linkawy_fix_svg_mime_type($data, $file, $filename, $mimes) {
    $ext = isset($data['ext']) ? $data['ext'] : '';
    if (strlen($ext) < 1) {
        $exploded = explode('.', $filename);
        $ext = strtolower(end($exploded));
    }
    if ($ext === 'svg') {
        $data['type'] = 'image/svg+xml';
        $data['ext'] = 'svg';
    } elseif ($ext === 'svgz') {
        $data['type'] = 'image/svg+xml';
        $data['ext'] = 'svgz';
    } elseif ($ext === 'webp') {
        $data['type'] = 'image/webp';
        $data['ext'] = 'webp';
    } elseif ($ext === 'gif') {
        $data['type'] = 'image/gif';
        $data['ext'] = 'gif';
    }
    return $data;
}
add_filter('wp_check_filetype_and_ext', 'linkawy_fix_svg_mime_type', 10, 4);

/**
 * Display SVG in media library
 */
function linkawy_svg_media_thumbnails($response, $attachment, $meta) {
    if ($response['type'] === 'image' && $response['subtype'] === 'svg+xml') {
        $response['sizes'] = array(
            'full' => array(
                'url' => $response['url'],
            ),
            'medium' => array(
                'url' => $response['url'],
            ),
            'thumbnail' => array(
                'url' => $response['url'],
            ),
        );
    }
    return $response;
}
add_filter('wp_prepare_attachment_for_js', 'linkawy_svg_media_thumbnails', 10, 3);

/**
 * Add SVG support in admin
 */
function linkawy_svg_admin_css() {
    echo '<style>
        .attachment-266x266, .thumbnail img {
            width: 100% !important;
            height: auto !important;
        }
        td.media-icon img[src$=".svg"] {
            width: 60px;
            height: 60px;
        }
    </style>';
}
add_action('admin_head', 'linkawy_svg_admin_css');

/**
 * Fix FAQ Schema HTML entities for Arabic text
 * 
 * Decodes HTML numeric entities (&#1605; etc.) in JSON-LD schema
 * to proper Unicode characters for correct display in search results.
 */
function linkawy_fix_faq_schema_entities($content) {
    // Only process if content contains FAQ schema
    if (strpos($content, 'application/ld+json') === false || strpos($content, 'FAQPage') === false) {
        return $content;
    }
    
    // Find and fix JSON-LD script tags
    $content = preg_replace_callback(
        '/<script type="application\/ld\+json">(.*?)<\/script>/s',
        function($matches) {
            $json = $matches[1];
            
            // Decode HTML numeric entities (&#1234; format)
            $decoded = preg_replace_callback(
                '/&#(\d+);/',
                function($m) {
                    return mb_chr((int)$m[1], 'UTF-8');
                },
                $json
            );
            
            // Decode HTML named entities (&amp; &quot; etc.)
            $decoded = html_entity_decode($decoded, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            
            return '<script type="application/ld+json">' . $decoded . '</script>';
        },
        $content
    );
    
    return $content;
}
add_filter('the_content', 'linkawy_fix_faq_schema_entities', 999);

/**
 * Reduce Gutenberg CSS on the frontend while keeping block library
 *
 * wp-block-library is required for theme.json-driven block styles (borders, shadows,
 * spacing, colors) to render correctly. We only dequeue minimal per-block sheets and
 * the theme-companion stylesheet.
 */
function linkawy_remove_block_css() {
    // Don't remove styles in Elementor preview
    if (class_exists('\Elementor\Plugin') && \Elementor\Plugin::$instance->preview->is_preview_mode()) {
        return;
    }

    wp_dequeue_style('wp-block-heading');
    wp_dequeue_style('wp-block-paragraph');
    wp_dequeue_style('wp-block-library-theme');
}
add_action('wp_enqueue_scripts', 'linkawy_remove_block_css', 100);


/**
 * Remove orphaned tooltip/modernizr scripts from deleted plugins
 * 
 * These files may remain in cache after plugin removal.
 * This ensures they are dequeued even if re-registered.
 */
function linkawy_remove_orphan_assets() {
    // Don't remove in Elementor preview
    if (class_exists('\Elementor\Plugin') && \Elementor\Plugin::$instance->preview->is_preview_mode()) {
        return;
    }
    
    // Remove tooltip-related assets (often from cache plugins)
    wp_dequeue_style('tooltip');
    wp_dequeue_style('tooltip-min');
    wp_dequeue_style('jquery-ui-tooltip');
    wp_deregister_style('tooltip');
    wp_deregister_style('tooltip-min');
    
    wp_dequeue_script('tooltip');
    wp_dequeue_script('tooltip-min');
    wp_dequeue_script('modernizr');
    wp_dequeue_script('modernizr-min');
    wp_deregister_script('tooltip');
    wp_deregister_script('tooltip-min');
    wp_deregister_script('modernizr');
    wp_deregister_script('modernizr-min');
}
add_action('wp_enqueue_scripts', 'linkawy_remove_orphan_assets', 999);

/**
 * Remove Dashicons on frontend for non-logged-in users
 * 
 * Dashicons is only needed when admin bar is showing.
 * Removing it saves ~40KB and one render-blocking request.
 */
function linkawy_dequeue_dashicons() {
    if (!is_user_logged_in()) {
        wp_dequeue_style('dashicons');
        wp_deregister_style('dashicons');
    }
}
add_action('wp_enqueue_scripts', 'linkawy_dequeue_dashicons', 999);

/**
 * Add width/height attributes to SVG images to prevent CLS
 * 
 * WordPress doesn't store dimensions for SVG files, causing layout shift.
 * This reads the viewBox from the SVG file and adds width/height attributes.
 */
function linkawy_add_svg_dimensions($attr, $attachment, $size) {
    // Only process SVG images
    $file = get_attached_file($attachment->ID);
    if (!$file || pathinfo($file, PATHINFO_EXTENSION) !== 'svg') {
        return $attr;
    }
    
    // Skip if dimensions already set
    if (!empty($attr['width']) && !empty($attr['height'])) {
        return $attr;
    }
    
    // Try to read SVG viewBox
    if (file_exists($file)) {
        $svg_content = file_get_contents($file);
        
        // Try to get viewBox
        if (preg_match('/viewBox=["\']([^"\']+)["\']/', $svg_content, $viewbox_match)) {
            $viewbox = explode(' ', trim($viewbox_match[1]));
            if (count($viewbox) >= 4) {
                $attr['width'] = (int)$viewbox[2];
                $attr['height'] = (int)$viewbox[3];
            }
        }
        // Fallback: try to get width/height attributes from SVG tag
        elseif (preg_match('/width=["\'](\d+)/', $svg_content, $w) && 
                preg_match('/height=["\'](\d+)/', $svg_content, $h)) {
            $attr['width'] = (int)$w[1];
            $attr['height'] = (int)$h[1];
        }
        // Last fallback: set reasonable defaults
        else {
            $attr['width'] = 800;
            $attr['height'] = 450;
        }
    }
    
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'linkawy_add_svg_dimensions', 15, 3);

/**
 * Debug: List all enqueued styles and scripts
 * 
 * Uncomment the add_action line below to see all registered assets.
 * Use this to identify the source of tooltip/modernizr files.
 * IMPORTANT: Remove or comment out after debugging!
 */
function linkawy_debug_enqueued_assets() {
    if (!current_user_can('manage_options')) {
        return;
    }
    
    global $wp_styles, $wp_scripts;
    
    echo '<!-- LINKAWY DEBUG: Enqueued Styles -->';
    echo '<pre style="background:#fff;color:#000;padding:20px;position:fixed;top:50px;right:10px;z-index:99999;max-height:400px;overflow:auto;font-size:11px;border:2px solid red;">';
    echo "<strong>STYLES:</strong>\n";
    foreach ($wp_styles->queue as $handle) {
        $src = isset($wp_styles->registered[$handle]) ? $wp_styles->registered[$handle]->src : 'N/A';
        echo esc_html("[$handle] => $src\n");
    }
    echo "\n<strong>SCRIPTS:</strong>\n";
    foreach ($wp_scripts->queue as $handle) {
        $src = isset($wp_scripts->registered[$handle]) ? $wp_scripts->registered[$handle]->src : 'N/A';
        echo esc_html("[$handle] => $src\n");
    }
    echo '</pre>';
}
// Uncomment the line below to enable debug mode (admin only):
// add_action('wp_footer', 'linkawy_debug_enqueued_assets', 9999);

/**
 * AJAX: Validate email domain via MX record + disposable blocklist
 * 
 * Checks if the email domain has valid MX records and is not
 * a known disposable/temporary email provider.
 */
function linkawy_validate_email_domain() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'linkawy_email_check')) {
        wp_send_json_error(['message' => 'Invalid request.']);
    }

    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    if (empty($email) || !is_email($email)) {
        wp_send_json_error(['message' => 'invalid_email']);
    }

    $domain = strtolower(explode('@', $email)[1]);

    // Known disposable email domains (top ~80)
    $disposable = array(
        'mailinator.com','guerrillamail.com','guerrillamail.de','grr.la','guerrillamail.net',
        'tempmail.com','throwaway.email','10minutemail.com','yopmail.com','yopmail.fr',
        'sharklasers.com','guerrillamailblock.com','pokemail.net','spam4.me','trashmail.com',
        'trashmail.me','trashmail.net','dispostable.com','maildrop.cc','mailnesia.com',
        'mailtemp.info','tempr.email','discard.email','discardmail.com','fakeinbox.com',
        'mailcatch.com','tempail.com','tempmailaddress.com','throwam.com','tmail.ws',
        'tmpmail.net','tmpmail.org','mohmal.com','getnada.com','emailondeck.com',
        'temp-mail.org','temp-mail.io','tempinbox.com','burnermail.io','mailsac.com',
        'harakirimail.com','crazymailing.com','inboxbear.com','mailexpire.com','safetymail.info',
        'filzmail.com','spamgourmet.com','mytrashmail.com','trashymail.com','trashymail.net',
        'mailmoat.com','mt2015.com','thankyou2010.com','trash-mail.com','dontreg.com',
        'spamfree24.org','mailzilla.com','getairmail.com','einrot.com','jetable.org',
        'mail-temporaire.fr','courrieltemporaire.com','mintemail.com','tempmailo.com',
        'emailfake.com','cuvox.de','armyspy.com','dayrep.com','fleckens.hu','gustr.com',
        'jourrapide.com','rhyta.com','superrito.com','teleworm.us','temailgo.com',
        'emlpro.com','emltmp.com','tmpbox.net','moakt.cc','clrmail.com','20minutemail.it',
        'mytemp.email','tempemails.io','fakemail.net','mailnull.com','spamcero.com'
    );

    if (in_array($domain, $disposable, true)) {
        wp_send_json_error(['message' => 'disposable']);
    }

    // Check MX record
    if (!checkdnsrr($domain, 'MX')) {
        // Fallback: check A record (some domains don't have MX but still receive email)
        if (!checkdnsrr($domain, 'A')) {
            wp_send_json_error(['message' => 'no_mx']);
        }
    }

    wp_send_json_success(['message' => 'valid']);
}
add_action('wp_ajax_linkawy_validate_email', 'linkawy_validate_email_domain');
add_action('wp_ajax_nopriv_linkawy_validate_email', 'linkawy_validate_email_domain');

/**
 * AJAX: Submit contact form
 * 
 * Saves submission as contact_request CPT, sends email notification,
 * and optionally sends data to Google Sheets.
 */
function linkawy_submit_contact_form() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'linkawy_contact_form')) {
        wp_send_json_error(['message' => 'طلب غير صالح. يرجى تحديث الصفحة والمحاولة مرة أخرى.']);
    }

    $recaptcha_check = linkawy_verify_recaptcha_from_request();
    if (is_wp_error($recaptcha_check)) {
        wp_send_json_error(array('message' => $recaptcha_check->get_error_message()));
    }

    // Sanitize and collect form data
    $name         = isset($_POST['full_name']) ? sanitize_text_field($_POST['full_name']) : '';
    $email        = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone        = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $country_code = isset($_POST['country_code']) ? sanitize_text_field($_POST['country_code']) : '';
    $company      = isset($_POST['company']) ? sanitize_text_field($_POST['company']) : '';
    $website      = isset($_POST['website']) ? esc_url_raw($_POST['website']) : '';
    $budget       = isset($_POST['budget']) ? sanitize_text_field($_POST['budget']) : '';
    $goals        = isset($_POST['goals']) ? sanitize_textarea_field($_POST['goals']) : '';
    $source_url   = isset($_POST['source_url']) ? esc_url_raw($_POST['source_url']) : '';
    $source_title = isset($_POST['source_title']) ? sanitize_text_field($_POST['source_title']) : '';
    $form_source  = isset($_POST['form_source']) ? sanitize_text_field($_POST['form_source']) : '';

    $is_short_form = ($form_source === 'service_hero');

    // Validate required fields (full form: name, email, company, budget; short form: name, email only)
    if (empty($name) || empty($email)) {
        wp_send_json_error(['message' => 'يرجى ملء الحقول المطلوبة.']);
    }
    if (!$is_short_form && (empty($company) || empty($budget))) {
        wp_send_json_error(['message' => 'يرجى ملء جميع الحقول المطلوبة.']);
    }

    // Validate email
    if (!is_email($email)) {
        wp_send_json_error(['message' => 'البريد الإلكتروني غير صالح.']);
    }

    // Create contact_request post
    $post_data = array(
        'post_title'  => $name,
        'post_type'   => 'contact_request',
        'post_status' => 'publish',
    );

    $post_id = wp_insert_post($post_data);

    if (is_wp_error($post_id)) {
        wp_send_json_error(['message' => 'حدث خطأ أثناء حفظ الطلب. يرجى المحاولة مرة أخرى.']);
    }

    // Save meta fields
    update_post_meta($post_id, '_cf_email', $email);
    update_post_meta($post_id, '_cf_phone', $phone);
    update_post_meta($post_id, '_cf_country_code', $country_code);
    update_post_meta($post_id, '_cf_company', $company);
    update_post_meta($post_id, '_cf_website', $website);
    update_post_meta($post_id, '_cf_budget', $budget);
    update_post_meta($post_id, '_cf_goals', $goals);
    update_post_meta($post_id, '_cf_source_url', $source_url);
    update_post_meta($post_id, '_cf_source_title', $source_title);

    // Budget labels for display
    $budget_labels = array(
        'below-750'   => 'أقل من 750$',
        '750-1500'    => '750$ - 1,500$',
        '1500-3000'   => '1,500$ - 3,000$',
        '3000-5000'   => '3,000$ - 5,000$',
        '5000-10000'  => '5,000$ - 10,000$',
        'above-10000' => 'أكثر من 10,000$',
    );
    $budget_display = isset($budget_labels[$budget]) ? $budget_labels[$budget] : $budget;
    if (empty($budget_display)) {
        $budget_display = '—';
    }
    $company_display = $company ? $company : '—';

    // Send email notification
    $admin_email = get_option('admin_email');
    $subject = 'طلب تواصل جديد من ' . $name;
    
    $phone_display = $phone ? $country_code . ' ' . $phone : 'غير محدد';
    $website_display = $website ? $website : 'غير محدد';
    $goals_display = $goals ? nl2br(esc_html($goals)) : 'غير محدد';

    $message = '
    <html dir="rtl" lang="ar">
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            h2 { color: #ff6b00; border-bottom: 2px solid #ff6b00; padding-bottom: 10px; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th, td { padding: 12px; text-align: right; border-bottom: 1px solid #eee; }
            th { background: #f9f9f9; width: 30%; }
            .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; color: #666; font-size: 0.9em; }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>طلب تواصل جديد</h2>
            <p>تم استلام طلب تواصل جديد من موقع لينكاوي:</p>
            <table>
                <tr><th>الاسم</th><td>' . esc_html($name) . '</td></tr>
                <tr><th>البريد الإلكتروني</th><td><a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a></td></tr>
                <tr><th>رقم الهاتف</th><td>' . esc_html($phone_display) . '</td></tr>
                <tr><th>اسم الشركة</th><td>' . esc_html($company_display) . '</td></tr>
                <tr><th>رابط الموقع</th><td>' . esc_html($website_display) . '</td></tr>
                <tr><th>الميزانية الشهرية</th><td>' . esc_html($budget_display) . '</td></tr>
                <tr><th>الأهداف والتحديات</th><td>' . $goals_display . '</td></tr>
            </table>
            <div class="footer">
                <p>يمكنك عرض جميع الطلبات من <a href="' . admin_url('edit.php?post_type=contact_request') . '">لوحة تحكم WordPress</a></p>
            </div>
        </div>
    </body>
    </html>';

    $mail_domain = preg_replace('/^www\./i', '', parse_url(home_url(), PHP_URL_HOST));
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: Linkawy <noreply@' . $mail_domain . '>',
    );

    $mail_sent = wp_mail($admin_email, $subject, $message, $headers);
    if (!$mail_sent) {
        error_log("Linkawy: wp_mail failed for contact_request #$post_id to $admin_email");
    }

    // Send to Google Sheets (if configured)
    $sheets_url = get_theme_mod('linkawy_google_sheets_url', '');
    if (!empty($sheets_url)) {
        $sheets_data = array(
            'timestamp'    => current_time('Y-m-d H:i:s'),
            'name'         => $name,
            'email'        => $email,
            'phone'        => $phone_display,
            'company'      => $company,
            'website'      => $website_display,
            'budget'       => $budget_display,
            'goals'        => $goals,
        );

        // Fire and forget - don't wait for response
        wp_remote_post($sheets_url, array(
            'timeout'   => 5,
            'blocking'  => false,
            'body'      => json_encode($sheets_data),
            'headers'   => array('Content-Type' => 'application/json'),
        ));
    }

    wp_send_json_success(['message' => 'تم إرسال طلبك بنجاح!']);
}
add_action('wp_ajax_linkawy_submit_contact', 'linkawy_submit_contact_form');
add_action('wp_ajax_nopriv_linkawy_submit_contact', 'linkawy_submit_contact_form');

/**
 * Human-readable page title for newsletter signup (aligned with contact form source_title).
 *
 * @return string
 */
function linkawy_get_newsletter_page_source_title() {
    if (is_front_page()) {
        return __('الرئيسية', 'linkawy');
    }
    if (is_home() && !is_front_page()) {
        $page_id = (int) get_option('page_for_posts');
        return $page_id ? get_the_title($page_id) : __('المدونة', 'linkawy');
    }
    if (is_category()) {
        return (string) single_cat_title('', false);
    }
    if (is_tag()) {
        return (string) single_tag_title('', false);
    }
    if (is_tax()) {
        return (string) single_term_title('', false);
    }
    if (is_post_type_archive()) {
        return (string) post_type_archive_title('', false);
    }
    if (is_author()) {
        $author = get_queried_object();
        return ($author && isset($author->display_name)) ? $author->display_name : '';
    }
    if (is_date()) {
        return wp_strip_all_tags(get_the_archive_title());
    }
    return get_bloginfo('name');
}

/**
 * Current page “kind” for blog-home newsletter form (category, blog index, etc.).
 *
 * @return string
 */
function linkawy_get_newsletter_source_kind() {
    if (is_front_page()) {
        return 'front';
    }
    if (is_home() && !is_front_page()) {
        return 'blog';
    }
    if (is_category()) {
        return 'category';
    }
    if (is_tag()) {
        return 'tag';
    }
    if (is_tax()) {
        return 'tax';
    }
    if (is_post_type_archive()) {
        return 'post_type_archive';
    }
    if (is_author()) {
        return 'author';
    }
    if (is_date()) {
        return 'date';
    }
    if (is_page()) {
        return 'page';
    }
    return 'site';
}

/**
 * Guess source kind from subscription URL (legacy rows).
 *
 * @param string $url
 * @return string
 */
function linkawy_guess_newsletter_kind_from_url($url) {
    if ($url === '') {
        return '';
    }
    $pid = url_to_postid($url);
    if ($pid) {
        $pt = get_post_type($pid);
        if ($pt === 'post') {
            return 'post';
        }
        if ($pt === 'prompts') {
            return 'prompt';
        }
        if ($pt === 'page') {
            return 'page';
        }
    }
    $path = wp_parse_url($url, PHP_URL_PATH);
    if (!$path) {
        return '';
    }
    $parts = array_values(array_filter(explode('/', trim($path, '/'))));
    $cat_base = get_option('category_base');
    if ($cat_base === '' || $cat_base === false) {
        $cat_base = 'category';
    }
    $cat_base = trim($cat_base, '/');
    $tag_base = get_option('tag_base');
    if ($tag_base === '' || $tag_base === false) {
        $tag_base = 'tag';
    }
    $tag_base = trim($tag_base, '/');

    $idx = array_search($cat_base, $parts, true);
    if ($idx !== false && isset($parts[$idx + 1])) {
        $slug = $parts[$idx + 1];
        $term = get_term_by('slug', $slug, 'category');
        if ($term && !is_wp_error($term)) {
            return 'category';
        }
    }
    $idx = array_search($tag_base, $parts, true);
    if ($idx !== false && isset($parts[$idx + 1])) {
        $slug = $parts[$idx + 1];
        $term = get_term_by('slug', $slug, 'post_tag');
        if ($term && !is_wp_error($term)) {
            return 'tag';
        }
    }
    return '';
}

/**
 * Term name from URL when title meta is missing.
 *
 * @param string $url
 * @param string $taxonomy 'category'|'post_tag'
 * @return string
 */
function linkawy_newsletter_term_name_from_url($url, $taxonomy) {
    $path = wp_parse_url($url, PHP_URL_PATH);
    if (!$path) {
        return '';
    }
    $parts = array_values(array_filter(explode('/', trim($path, '/'))));
    if ($taxonomy === 'category') {
        $base = get_option('category_base');
        if ($base === '' || $base === false) {
            $base = 'category';
        }
        $base = trim($base, '/');
        $idx = array_search($base, $parts, true);
        if ($idx !== false && isset($parts[$idx + 1])) {
            $term = get_term_by('slug', $parts[$idx + 1], 'category');
            if ($term && !is_wp_error($term)) {
                return $term->name;
            }
        }
    }
    if ($taxonomy === 'post_tag') {
        $base = get_option('tag_base');
        if ($base === '' || $base === false) {
            $base = 'tag';
        }
        $base = trim($base, '/');
        $idx = array_search($base, $parts, true);
        if ($idx !== false && isset($parts[$idx + 1])) {
            $term = get_term_by('slug', $parts[$idx + 1], 'post_tag');
            if ($term && !is_wp_error($term)) {
                return $term->name;
            }
        }
    }
    return '';
}

/**
 * Resolve source kind for admin display (saved meta + heuristics).
 *
 * @param int $post_id Subscriber CPT ID.
 * @return string
 */
function linkawy_newsletter_resolve_source_kind($post_id) {
    $k = get_post_meta($post_id, '_newsletter_source_kind', true);
    if ($k) {
        return $k;
    }
    $ref_pid = (int) get_post_meta($post_id, '_newsletter_source_post_id', true);
    if ($ref_pid) {
        $rp = get_post($ref_pid);
        if ($rp && $rp->post_type === 'prompts') {
            return 'prompt';
        }
        return 'post';
    }
    $url = get_post_meta($post_id, '_newsletter_source_url', true);
    if ($url) {
        $g = linkawy_guess_newsletter_kind_from_url($url);
        if ($g) {
            return $g;
        }
    }
    $legacy = get_post_meta($post_id, '_newsletter_source', true);
    if ($legacy === 'single-article') {
        return 'post';
    }
    if ($legacy === 'single-prompt') {
        return 'prompt';
    }
    if ($legacy === 'blog-home') {
        return 'blog';
    }
    return 'site';
}

/**
 * Build Arabic label with prefix (قسم / صفحة / مقال / …).
 *
 * @param string $kind
 * @param string $title
 * @param string $url
 * @return string
 */
function linkawy_newsletter_label_for_kind($kind, $title, $url = '') {
    $title = trim((string) $title);
    switch ($kind) {
        case 'front':
            return __('صفحة الرئيسية', 'linkawy');
        case 'blog':
            return $title !== '' ? sprintf(__('صفحة: %s', 'linkawy'), $title) : __('المدونة', 'linkawy');
        case 'category':
            if ($title === '' && $url) {
                $title = linkawy_newsletter_term_name_from_url($url, 'category');
            }
            return $title !== '' ? sprintf(__('قسم %s', 'linkawy'), $title) : __('قسم', 'linkawy');
        case 'tag':
            if ($title === '' && $url) {
                $title = linkawy_newsletter_term_name_from_url($url, 'post_tag');
            }
            return $title !== '' ? sprintf(__('وسم %s', 'linkawy'), $title) : __('وسم', 'linkawy');
        case 'tax':
            return $title !== '' ? sprintf(__('تصنيف: %s', 'linkawy'), $title) : __('تصنيف', 'linkawy');
        case 'post_type_archive':
            return $title !== '' ? sprintf(__('أرشيف: %s', 'linkawy'), $title) : __('أرشيف', 'linkawy');
        case 'author':
            return $title !== '' ? sprintf(__('كاتب: %s', 'linkawy'), $title) : __('كاتب', 'linkawy');
        case 'date':
            return $title !== '' ? sprintf(__('أرشيف: %s', 'linkawy'), $title) : __('أرشيف', 'linkawy');
        case 'page':
            return $title !== '' ? sprintf(__('صفحة: %s', 'linkawy'), $title) : __('صفحة', 'linkawy');
        case 'post':
            return $title !== '' ? sprintf(__('مقال: %s', 'linkawy'), $title) : __('مقال', 'linkawy');
        case 'prompt':
            return $title !== '' ? sprintf(__('أمر: %s', 'linkawy'), $title) : __('أمر (برومبت)', 'linkawy');
        case 'site':
        default:
            return $title !== '' ? sprintf(__('نص: %s', 'linkawy'), $title) : '';
    }
}

/**
 * Compute display label and optional linked post ID for admin column.
 *
 * @param int $post_id Subscriber CPT ID.
 * @return array{label: string, edit_post_id: int}
 */
function linkawy_newsletter_compute_source_display($post_id) {
    $out = array(
        'label'        => '',
        'edit_post_id' => 0,
    );
    $ref = (int) get_post_meta($post_id, '_newsletter_source_post_id', true);
    if ($ref && get_post_status($ref)) {
        $rpt = get_post_type($ref);
        if ($rpt === 'prompts') {
            $out['label'] = sprintf(__('أمر: %s', 'linkawy'), get_the_title($ref));
        } else {
            $out['label'] = sprintf(__('مقال: %s', 'linkawy'), get_the_title($ref));
        }
        $out['edit_post_id'] = $ref;
        return $out;
    }

    $kind = linkawy_newsletter_resolve_source_kind($post_id);
    $title = get_post_meta($post_id, '_newsletter_source_title', true);
    $url = get_post_meta($post_id, '_newsletter_source_url', true);

    if ($title === '' && $url) {
        $from_url_id = url_to_postid($url);
        if ($from_url_id) {
            $title = get_the_title($from_url_id);
            if (in_array($kind, array('site', 'blog', ''), true)) {
                $ft = get_post_type($from_url_id);
                if ($ft === 'page') {
                    $kind = 'page';
                } elseif ($ft === 'prompts') {
                    $kind = 'prompt';
                } else {
                    $kind = 'post';
                }
            }
            if ($kind === 'post' || $kind === 'prompt') {
                $out['edit_post_id'] = $from_url_id;
            }
        }
    }

    $out['label'] = linkawy_newsletter_label_for_kind($kind, $title, $url);
    if ($out['label'] === '' && $url) {
        $path = wp_parse_url($url, PHP_URL_PATH);
        $out['label'] = ($path !== null && $path !== '') ? $path : $url;
    }
    return $out;
}

/**
 * Plain string for CSV / notifications.
 *
 * @param int $post_id Subscriber CPT ID.
 * @return string
 */
function linkawy_newsletter_get_formatted_source_label($post_id) {
    $d = linkawy_newsletter_compute_source_display($post_id);
    if ($d['label'] !== '') {
        return $d['label'];
    }
    $slug = get_post_meta($post_id, '_newsletter_source', true);
    $fallback = array(
        'blog-home'      => linkawy_newsletter_label_for_kind('blog', __('المدونة', 'linkawy'), ''),
        'single-article' => __('مقال', 'linkawy'),
        'single-prompt'  => __('أمر (برومبت)', 'linkawy'),
    );
    if (isset($fallback[$slug])) {
        return $fallback[$slug];
    }
    return $slug ? (string) $slug : '—';
}

/**
 * HTML for newsletter Source admin column.
 *
 * @param int $post_id Subscriber CPT ID.
 * @return string
 */
function linkawy_newsletter_render_source_column_html($post_id) {
    $d = linkawy_newsletter_compute_source_display($post_id);
    $label = $d['label'];
    $url = get_post_meta($post_id, '_newsletter_source_url', true);

    if ($label === '') {
        $label = linkawy_newsletter_get_formatted_source_label($post_id);
    }

    $edit_id = (int) $d['edit_post_id'];
    if ($edit_id && get_edit_post_link($edit_id) && current_user_can('edit_post', $edit_id)) {
        return '<a href="' . esc_url(get_edit_post_link($edit_id)) . '">' . esc_html($label) . '</a>';
    }

    return '<span title="' . esc_attr($url) . '">' . esc_html($label) . '</span>';
}

/**
 * AJAX: Submit newsletter subscription form.
 *
 * Uses nonce + honeypot anti-spam, stores subscriber in CPT,
 * sends admin notification and optionally forwards to Google Sheets webhook.
 */
function linkawy_submit_newsletter_form() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'linkawy_newsletter_form')) {
        wp_send_json_error(array('message' => __('طلب غير صالح. يرجى تحديث الصفحة والمحاولة مرة أخرى.', 'linkawy')));
    }

    $honeypot = isset($_POST['hp_field']) ? trim((string) wp_unslash($_POST['hp_field'])) : '';
    if ($honeypot !== '') {
        wp_send_json_error(array('message' => __('تعذر إتمام الطلب.', 'linkawy')));
    }

    $recaptcha_check = linkawy_verify_recaptcha_from_request();
    if (is_wp_error($recaptcha_check)) {
        wp_send_json_error(array('message' => $recaptcha_check->get_error_message()));
    }

    $email = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    $unlock_prompt_id = isset($_POST['unlock_prompt_id']) ? absint($_POST['unlock_prompt_id']) : 0;
    $source = isset($_POST['source']) ? sanitize_key(wp_unslash($_POST['source'])) : 'unknown';
    $allowed_sources = array('blog-home', 'single-article', 'single-prompt');
    if (!in_array($source, $allowed_sources, true)) {
        $source = 'unknown';
    }

    $source_title = isset($_POST['source_title']) ? sanitize_text_field(wp_unslash($_POST['source_title'])) : '';
    $source_url   = isset($_POST['source_url']) ? esc_url_raw(wp_unslash($_POST['source_url'])) : '';
    $source_post_id = isset($_POST['source_post_id']) ? absint($_POST['source_post_id']) : 0;

    $allowed_source_kinds = array(
        'front', 'blog', 'category', 'tag', 'tax', 'post_type_archive',
        'author', 'date', 'page', 'site', 'post', 'prompt',
    );
    $source_kind = isset($_POST['source_kind']) ? sanitize_key(wp_unslash($_POST['source_kind'])) : '';

    if (empty($email) || !is_email($email)) {
        wp_send_json_error(array('message' => __('يرجى إدخال بريد إلكتروني صحيح.', 'linkawy')));
    }

    $existing = get_posts(array(
        'post_type'      => 'linkawy_newsletter',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'fields'         => 'ids',
        'meta_query'     => array(
            array(
                'key'     => '_newsletter_email',
                'value'   => $email,
                'compare' => '=',
            ),
        ),
    ));

    if (!empty($existing)) {
        linkawy_maybe_unlock_prompt_after_newsletter($unlock_prompt_id);
        wp_send_json_success(array(
            'heading'            => __('هذا البريد مشترك بالفعل.', 'linkawy'),
            'subtitle'           => __('إذا لم تصلك رسائلنا، يُرجى التحقق من مجلد السبام أو البريد غير الهام.', 'linkawy'),
            'message'            => __('هذا البريد مشترك بالفعل.', 'linkawy'),
            'already_subscribed' => true,
            'prompt_unlocked'    => (bool) $unlock_prompt_id,
        ));
    }

    $post_id = wp_insert_post(
        array(
            'post_type'   => 'linkawy_newsletter',
            'post_status' => 'publish',
            'post_title'  => $email,
        ),
        true
    );

    if (is_wp_error($post_id) || !$post_id) {
        wp_send_json_error(array('message' => __('حدث خطأ أثناء حفظ الاشتراك. يرجى المحاولة مرة أخرى.', 'linkawy')));
    }

    update_post_meta($post_id, '_newsletter_email', $email);
    update_post_meta($post_id, '_newsletter_source', $source);
    if ($source === 'single-article') {
        $source_kind = 'post';
    } elseif ($source === 'single-prompt') {
        $source_kind = 'prompt';
    } elseif ($source === 'blog-home' && in_array($source_kind, $allowed_source_kinds, true)) {
        // ok
    } else {
        $source_kind = 'site';
    }
    if ($source === 'blog-home' && $source_url) {
        $guess_kind = linkawy_guess_newsletter_kind_from_url($source_url);
        if ($guess_kind) {
            $source_kind = $guess_kind;
        }
    }
    update_post_meta($post_id, '_newsletter_source_kind', $source_kind);

    if ($source === 'single-article' && $source_post_id) {
        $ref = get_post($source_post_id);
        if ($ref && $ref->post_type === 'post' && in_array($ref->post_status, array('publish', 'future', 'private'), true)) {
            update_post_meta($post_id, '_newsletter_source_post_id', $source_post_id);
            $source_title = get_the_title($source_post_id);
        }
    }
    if ($source === 'single-prompt' && $source_post_id) {
        $ref = get_post($source_post_id);
        if ($ref && $ref->post_type === 'prompts' && in_array($ref->post_status, array('publish', 'future', 'private'), true)) {
            update_post_meta($post_id, '_newsletter_source_post_id', $source_post_id);
            $source_title = get_the_title($source_post_id);
        }
    }
    update_post_meta($post_id, '_newsletter_source_title', $source_title);
    update_post_meta($post_id, '_newsletter_source_url', $source_url);
    update_post_meta($post_id, '_newsletter_subscribed_at', current_time('Y-m-d H:i:s'));

    $admin_email = get_option('admin_email');
    $subject = sprintf(__('اشتراك جديد في النشرة: %s', 'linkawy'), $email);
    $source_line = linkawy_newsletter_get_formatted_source_label($post_id);
    if ($source_url) {
        $source_line .= ' — ' . $source_url;
    }
    $message = sprintf(
        "تم استلام اشتراك جديد في النشرة البريدية.\n\nEmail: %s\nالمصدر: %s\nالمعرّف: %s\nDate: %s\n",
        $email,
        $source_line,
        $source,
        current_time('Y-m-d H:i:s')
    );
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
    );
    wp_mail($admin_email, $subject, $message, $headers);

    $sheets_url = get_theme_mod('linkawy_google_sheets_url', '');
    if (!empty($sheets_url)) {
        $sheets_data = array(
            'type'             => 'newsletter',
            'timestamp'        => current_time('Y-m-d H:i:s'),
            'email'            => $email,
            'source'           => $source,
            'source_kind'      => get_post_meta($post_id, '_newsletter_source_kind', true),
            'source_label'     => linkawy_newsletter_get_formatted_source_label($post_id),
            'source_title'     => $source_title,
            'source_url'       => $source_url,
            'source_post_id'    => (int) get_post_meta($post_id, '_newsletter_source_post_id', true),
            'subscribed_at'    => current_time('Y-m-d H:i:s'),
        );

        wp_remote_post($sheets_url, array(
            'timeout'  => 5,
            'blocking' => false,
            'body'     => wp_json_encode($sheets_data),
            'headers'  => array('Content-Type' => 'application/json'),
        ));
    }

    linkawy_maybe_unlock_prompt_after_newsletter($unlock_prompt_id);

    wp_send_json_success(array(
        'heading'            => __('تم التأكيد', 'linkawy'),
        'subtitle'           => __('تم الاشتراك بنجاح. شكرًا لك!', 'linkawy'),
        'message'            => __('تم الاشتراك بنجاح. شكرًا لك!', 'linkawy'),
        'already_subscribed' => false,
        'prompt_unlocked'    => (bool) $unlock_prompt_id,
    ));
}
add_action('wp_ajax_linkawy_submit_newsletter', 'linkawy_submit_newsletter_form');
add_action('wp_ajax_nopriv_linkawy_submit_newsletter', 'linkawy_submit_newsletter_form');
