<?php
/**
 * Theme Customizer Settings
 * 
 * Adds customization options for header elements, colors, and more
 * accessible via Appearance > Customize
 *
 * @package Linkawy
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Custom Control: Reset Colors Button
 */
if (class_exists('WP_Customize_Control')) {
    class Linkawy_Reset_Colors_Control extends WP_Customize_Control {
        public $type = 'reset_colors';
        
        public function render_content() {
            ?>
            <div class="linkawy-reset-colors-control">
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php if (!empty($this->description)) : ?>
                    <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                <?php endif; ?>
                <div class="linkawy-reset-buttons">
                    <button type="button" class="button linkawy-reset-colors-btn" id="linkawy-reset-colors">
                        <span class="dashicons dashicons-image-rotate" style="margin-left: 5px; margin-top: 3px;"></span>
                        <?php esc_html_e('إعادة تعيين الألوان', 'linkawy'); ?>
                    </button>
                </div>
            </div>
            <style>
                .linkawy-reset-colors-control {
                    padding: 12px 0;
                    border-top: 1px solid #ddd;
                    margin-top: 15px;
                }
                .linkawy-reset-buttons {
                    margin-top: 10px;
                }
                .linkawy-reset-colors-btn {
                    width: 100%;
                    display: flex !important;
                    align-items: center;
                    justify-content: center;
                    padding: 8px 16px !important;
                    background: #f0f0f1 !important;
                    border-color: #c3c4c7 !important;
                    color: #50575e !important;
                    transition: all 0.2s ease !important;
                }
                .linkawy-reset-colors-btn:hover {
                    background: #fff !important;
                    border-color: #2271b1 !important;
                    color: #2271b1 !important;
                }
                .linkawy-reset-colors-btn:focus {
                    border-color: #2271b1 !important;
                    box-shadow: 0 0 0 1px #2271b1 !important;
                    outline: none !important;
                }
                .linkawy-reset-colors-btn.resetting {
                    opacity: 0.7;
                    pointer-events: none;
                }
                .linkawy-reset-success {
                    color: #00a32a;
                    font-size: 12px;
                    margin-top: 8px;
                    display: none;
                    text-align: center;
                }
                .linkawy-reset-success.show {
                    display: block;
                    animation: fadeInOut 2s ease;
                }
                @keyframes fadeInOut {
                    0% { opacity: 0; }
                    20% { opacity: 1; }
                    80% { opacity: 1; }
                    100% { opacity: 0; }
                }
            </style>
            <div class="linkawy-reset-success" id="linkawy-reset-success">
                <span class="dashicons dashicons-yes-alt"></span>
                <?php esc_html_e('تم إعادة التعيين بنجاح!', 'linkawy'); ?>
            </div>
            <?php
        }
    }
}

/**
 * Register customizer settings and controls
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function linkawy_customize_register($wp_customize) {
    
    // =====================================================
    // Colors Section
    // =====================================================
    $wp_customize->add_section('linkawy_colors_section', array(
        'title'       => __('إعدادات الألوان', 'linkawy'),
        'description' => __('تخصيص ألوان الموقع الأساسية', 'linkawy'),
        'priority'    => 25,
    ));
    
    // ----- Color Preset Selector -----
    $wp_customize->add_setting('linkawy_color_preset', array(
        'default'           => 'default',
        'sanitize_callback' => 'linkawy_sanitize_color_preset',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('linkawy_color_preset', array(
        'label'       => __('قالب الألوان', 'linkawy'),
        'description' => __('اختر قالب ألوان جاهز أو خصص الألوان يدوياً', 'linkawy'),
        'section'     => 'linkawy_colors_section',
        'type'        => 'select',
        'choices'     => array(
            'default' => __('البرتقالي الافتراضي', 'linkawy'),
            'blue'    => __('أزرق احترافي', 'linkawy'),
            'green'   => __('أخضر طبيعي', 'linkawy'),
            'purple'  => __('بنفسجي إبداعي', 'linkawy'),
            'red'     => __('أحمر قوي', 'linkawy'),
            'custom'  => __('ألوان مخصصة', 'linkawy'),
        ),
    ));
    
    // ----- Primary Color -----
    $wp_customize->add_setting('linkawy_primary_color', array(
        'default'           => '#ff6b00',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'linkawy_primary_color', array(
        'label'           => __('اللون الأساسي', 'linkawy'),
        'description'     => __('اللون الرئيسي للأزرار والروابط والعناصر المميزة', 'linkawy'),
        'section'         => 'linkawy_colors_section',
        'active_callback' => 'linkawy_is_custom_preset',
    )));
    
    // ----- Secondary Color -----
    $wp_customize->add_setting('linkawy_secondary_color', array(
        'default'           => '#1a1a2e',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'linkawy_secondary_color', array(
        'label'           => __('اللون الثانوي', 'linkawy'),
        'description'     => __('لون داعم للعناصر الثانوية', 'linkawy'),
        'section'         => 'linkawy_colors_section',
        'active_callback' => 'linkawy_is_custom_preset',
    )));
    
    // ----- Accent Color -----
    $wp_customize->add_setting('linkawy_accent_color', array(
        'default'           => '#ff8533',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'linkawy_accent_color', array(
        'label'           => __('لون التمييز', 'linkawy'),
        'description'     => __('لون للتمييز والإبراز', 'linkawy'),
        'section'         => 'linkawy_colors_section',
        'active_callback' => 'linkawy_is_custom_preset',
    )));
    
    // ----- Text Primary Color -----
    $wp_customize->add_setting('linkawy_text_primary', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'linkawy_text_primary', array(
        'label'           => __('لون النص الأساسي', 'linkawy'),
        'description'     => __('لون النصوص الرئيسية', 'linkawy'),
        'section'         => 'linkawy_colors_section',
        'active_callback' => 'linkawy_is_custom_preset',
    )));
    
    // ----- Text Secondary Color -----
    $wp_customize->add_setting('linkawy_text_secondary', array(
        'default'           => '#666666',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'linkawy_text_secondary', array(
        'label'           => __('لون النص الثانوي', 'linkawy'),
        'description'     => __('لون النصوص الفرعية والوصف', 'linkawy'),
        'section'         => 'linkawy_colors_section',
        'active_callback' => 'linkawy_is_custom_preset',
    )));
    
    // ----- Background Light Color -----
    $wp_customize->add_setting('linkawy_bg_light', array(
        'default'           => '#f4f4f4',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'linkawy_bg_light', array(
        'label'           => __('لون الخلفية الفاتحة', 'linkawy'),
        'description'     => __('لون خلفية الأقسام الفاتحة', 'linkawy'),
        'section'         => 'linkawy_colors_section',
        'active_callback' => 'linkawy_is_custom_preset',
    )));
    
    // ----- Background Dark Color -----
    $wp_customize->add_setting('linkawy_bg_dark', array(
        'default'           => '#1a1a1a',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'linkawy_bg_dark', array(
        'label'           => __('لون الخلفية الداكنة', 'linkawy'),
        'description'     => __('لون خلفية الأقسام الداكنة والفوتر', 'linkawy'),
        'section'         => 'linkawy_colors_section',
        'active_callback' => 'linkawy_is_custom_preset',
    )));
    
    // ----- Link Color -----
    $wp_customize->add_setting('linkawy_link_color', array(
        'default'           => '#ff6b00',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'linkawy_link_color', array(
        'label'           => __('لون الروابط', 'linkawy'),
        'description'     => __('لون الروابط في المحتوى', 'linkawy'),
        'section'         => 'linkawy_colors_section',
        'active_callback' => 'linkawy_is_custom_preset',
    )));
    
    // ----- Button Background Color -----
    $wp_customize->add_setting('linkawy_button_bg', array(
        'default'           => '#ff6b00',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'linkawy_button_bg', array(
        'label'           => __('لون خلفية الأزرار', 'linkawy'),
        'description'     => __('لون خلفية الأزرار الرئيسية', 'linkawy'),
        'section'         => 'linkawy_colors_section',
        'active_callback' => 'linkawy_is_custom_preset',
    )));
    
    // ----- Reset Colors Button -----
    $wp_customize->add_setting('linkawy_reset_colors', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control(new Linkawy_Reset_Colors_Control($wp_customize, 'linkawy_reset_colors', array(
        'label'       => __('إعادة التعيين', 'linkawy'),
        'description' => __('إرجاع جميع الألوان إلى القيم الافتراضية', 'linkawy'),
        'section'     => 'linkawy_colors_section',
    )));
    
    // =====================================================
    // Header Section
    // =====================================================
    $wp_customize->add_section('linkawy_header_section', array(
        'title'       => __('إعدادات الهيدر', 'linkawy'),
        'description' => __('تخصيص عناصر الهيدر وزر CTA', 'linkawy'),
        'priority'    => 30,
    ));
    
    // ----- CTA Button Settings -----
    
    // Show/Hide CTA Button
    $wp_customize->add_setting('linkawy_header_cta_show', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('linkawy_header_cta_show', array(
        'label'       => __('إظهار زر CTA', 'linkawy'),
        'description' => __('إظهار أو إخفاء زر "تواصل معنا" في الهيدر', 'linkawy'),
        'section'     => 'linkawy_header_section',
        'type'        => 'checkbox',
    ));
    
    // CTA Button Text
    $wp_customize->add_setting('linkawy_header_cta_text', array(
        'default'           => __('تواصل معنا', 'linkawy'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('linkawy_header_cta_text', array(
        'label'       => __('نص الزر', 'linkawy'),
        'description' => __('النص الذي يظهر على زر CTA', 'linkawy'),
        'section'     => 'linkawy_header_section',
        'type'        => 'text',
    ));
    
    // CTA Button URL
    $wp_customize->add_setting('linkawy_header_cta_url', array(
        'default'           => '/contact/',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('linkawy_header_cta_url', array(
        'label'       => __('رابط الزر', 'linkawy'),
        'description' => __('الرابط الذي يفتح عند الضغط على الزر (مثال: /contact/ أو https://example.com)', 'linkawy'),
        'section'     => 'linkawy_header_section',
        'type'        => 'url',
    ));
    
    // ----- Mobile CTA Button Settings -----
    
    // Mobile CTA Button Text
    $wp_customize->add_setting('linkawy_mobile_cta_text', array(
        'default'           => __('اطلب عرض سعر', 'linkawy'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('linkawy_mobile_cta_text', array(
        'label'       => __('نص زر الجوال', 'linkawy'),
        'description' => __('النص الذي يظهر على زر CTA في قائمة الجوال', 'linkawy'),
        'section'     => 'linkawy_header_section',
        'type'        => 'text',
    ));
    
    // Mobile CTA Button URL
    $wp_customize->add_setting('linkawy_mobile_cta_url', array(
        'default'           => '/contact',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('linkawy_mobile_cta_url', array(
        'label'       => __('رابط زر الجوال', 'linkawy'),
        'description' => __('الرابط الذي يفتح عند الضغط على زر الجوال', 'linkawy'),
        'section'     => 'linkawy_header_section',
        'type'        => 'url',
    ));
    
    // =====================================================
    // Social Media Section
    // =====================================================
    $wp_customize->add_section('linkawy_social_section', array(
        'title'       => __('روابط التواصل الاجتماعي', 'linkawy'),
        'description' => __('روابط حسابات التواصل الاجتماعي (اتركها فارغة لإخفاء الأيقونة)', 'linkawy'),
        'priority'    => 35,
    ));
    
    // Instagram
    $wp_customize->add_setting('linkawy_social_instagram', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('linkawy_social_instagram', array(
        'label'   => __('Instagram', 'linkawy'),
        'section' => 'linkawy_social_section',
        'type'    => 'url',
    ));
    
    // LinkedIn
    $wp_customize->add_setting('linkawy_social_linkedin', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('linkawy_social_linkedin', array(
        'label'   => __('LinkedIn', 'linkawy'),
        'section' => 'linkawy_social_section',
        'type'    => 'url',
    ));
    
    // Facebook
    $wp_customize->add_setting('linkawy_social_facebook', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('linkawy_social_facebook', array(
        'label'   => __('Facebook', 'linkawy'),
        'section' => 'linkawy_social_section',
        'type'    => 'url',
    ));
    
    // Twitter/X
    $wp_customize->add_setting('linkawy_social_twitter', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('linkawy_social_twitter', array(
        'label'   => __('Twitter / X', 'linkawy'),
        'section' => 'linkawy_social_section',
        'type'    => 'url',
    ));
    
    // YouTube
    $wp_customize->add_setting('linkawy_social_youtube', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('linkawy_social_youtube', array(
        'label'   => __('YouTube', 'linkawy'),
        'section' => 'linkawy_social_section',
        'type'    => 'url',
    ));
    
    // TikTok
    $wp_customize->add_setting('linkawy_social_tiktok', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('linkawy_social_tiktok', array(
        'label'   => __('TikTok', 'linkawy'),
        'section' => 'linkawy_social_section',
        'type'    => 'url',
    ));
    
    // =====================================================
    // Integrations Section
    // =====================================================
    $wp_customize->add_section('linkawy_integrations_section', array(
        'title'       => __('الربط والتكامل', 'linkawy'),
        'description' => __('إعدادات الربط مع الخدمات الخارجية', 'linkawy'),
        'priority'    => 38,
    ));
    
    // Google Sheets Webhook URL
    $wp_customize->add_setting('linkawy_google_sheets_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('linkawy_google_sheets_url', array(
        'label'       => __('رابط Google Sheets Webhook', 'linkawy'),
        'description' => __('رابط Apps Script لإرسال بيانات نموذج التواصل إلى Google Sheets. اتركه فارغاً لتعطيل هذه الميزة.', 'linkawy'),
        'section'     => 'linkawy_integrations_section',
        'type'        => 'url',
    ));
    
    // ----- Google reCAPTCHA v3 Settings -----
    
    // reCAPTCHA Site Key
    $wp_customize->add_setting('linkawy_recaptcha_site_key', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('linkawy_recaptcha_site_key', array(
        'label'       => __('reCAPTCHA Site Key', 'linkawy'),
        'description' => __('مفتاح الموقع من Google reCAPTCHA v3. احصل عليه من: google.com/recaptcha/admin', 'linkawy'),
        'section'     => 'linkawy_integrations_section',
        'type'        => 'text',
    ));
    
    // reCAPTCHA Secret Key
    $wp_customize->add_setting('linkawy_recaptcha_secret_key', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('linkawy_recaptcha_secret_key', array(
        'label'       => __('reCAPTCHA Secret Key', 'linkawy'),
        'description' => __('المفتاح السري من Google reCAPTCHA v3. اتركه فارغاً لتعطيل reCAPTCHA.', 'linkawy'),
        'section'     => 'linkawy_integrations_section',
        'type'        => 'password',
    ));
    
    // =====================================================
    // Footer Section
    // =====================================================
    $wp_customize->add_section('linkawy_footer_section', array(
        'title'       => __('إعدادات الفوتر', 'linkawy'),
        'description' => __('تخصيص محتوى الفوتر ومعلومات التواصل', 'linkawy'),
        'priority'    => 40,
    ));
    
    // Footer Description
    $wp_customize->add_setting('linkawy_footer_description', array(
        'default'           => __('شريكك الاستراتيجي في النمو الرقمي. نقدم حلول سيو وتصميم مواقع مبتكرة لضمان تصدرك النتائج.', 'linkawy'),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('linkawy_footer_description', array(
        'label'       => __('نص الوصف', 'linkawy'),
        'description' => __('النص الذي يظهر أسفل اللوجو في الفوتر', 'linkawy'),
        'section'     => 'linkawy_footer_section',
        'type'        => 'textarea',
    ));
    
    // Footer Address
    $wp_customize->add_setting('linkawy_footer_address', array(
        'default'           => __('دبي، الإمارات العربية المتحدة', 'linkawy'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('linkawy_footer_address', array(
        'label'       => __('العنوان', 'linkawy'),
        'description' => __('عنوان الشركة أو الموقع', 'linkawy'),
        'section'     => 'linkawy_footer_section',
        'type'        => 'text',
    ));
    
    // Footer Email
    $wp_customize->add_setting('linkawy_footer_email', array(
        'default'           => 'info@linkawy.io',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('linkawy_footer_email', array(
        'label'       => __('البريد الإلكتروني', 'linkawy'),
        'description' => __('البريد الإلكتروني للتواصل', 'linkawy'),
        'section'     => 'linkawy_footer_section',
        'type'        => 'email',
    ));
    
    // Footer Phone (Optional)
    $wp_customize->add_setting('linkawy_footer_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('linkawy_footer_phone', array(
        'label'       => __('رقم الهاتف (اختياري)', 'linkawy'),
        'description' => __('رقم الهاتف للتواصل - اتركه فارغاً لإخفائه', 'linkawy'),
        'section'     => 'linkawy_footer_section',
        'type'        => 'tel',
    ));
    
    // Footer Copyright
    $wp_customize->add_setting('linkawy_footer_copyright', array(
        'default'           => __('جميع الحقوق محفوظة.', 'linkawy'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('linkawy_footer_copyright', array(
        'label'       => __('نص حقوق النشر', 'linkawy'),
        'description' => __('النص الذي يظهر في أسفل الفوتر (السنة واسم الموقع يضافان تلقائياً)', 'linkawy'),
        'section'     => 'linkawy_footer_section',
        'type'        => 'text',
    ));
}
add_action('customize_register', 'linkawy_customize_register');

/**
 * Helper function to get header CTA settings
 *
 * @return array CTA settings array
 */
function linkawy_get_header_cta() {
    return array(
        'show' => get_theme_mod('linkawy_header_cta_show', true),
        'text' => get_theme_mod('linkawy_header_cta_text', __('تواصل معنا', 'linkawy')),
        'url'  => get_theme_mod('linkawy_header_cta_url', '/contact/'),
    );
}

/**
 * Helper function to get mobile CTA settings
 *
 * @return array Mobile CTA settings array
 */
function linkawy_get_mobile_cta() {
    return array(
        'text' => get_theme_mod('linkawy_mobile_cta_text', __('اطلب عرض سعر', 'linkawy')),
        'url'  => get_theme_mod('linkawy_mobile_cta_url', '/contact'),
    );
}

/**
 * Helper function to get social media links
 *
 * @return array Social links array (only non-empty links)
 */
function linkawy_get_social_links() {
    $links = array();
    
    $instagram = get_theme_mod('linkawy_social_instagram', '');
    if (!empty($instagram)) {
        $links['instagram'] = $instagram;
    }
    
    $linkedin = get_theme_mod('linkawy_social_linkedin', 'https://www.linkedin.com/in/aliatwa/');
    if (!empty($linkedin)) {
        $links['linkedin'] = $linkedin;
    }
    
    $facebook = get_theme_mod('linkawy_social_facebook', 'https://www.facebook.com/linkawy1');
    if (!empty($facebook)) {
        $links['facebook'] = $facebook;
    }
    
    $twitter = get_theme_mod('linkawy_social_twitter', 'https://x.com/linkawyseo');
    if (!empty($twitter)) {
        $links['twitter'] = $twitter;
    }
    
    $youtube = get_theme_mod('linkawy_social_youtube', 'https://www.youtube.com/@linkawy?sub_confirmation=1');
    if (!empty($youtube)) {
        $links['youtube'] = $youtube;
    }
    
    $tiktok = get_theme_mod('linkawy_social_tiktok', 'https://www.tiktok.com/@linkawy');
    if (!empty($tiktok)) {
        $links['tiktok'] = $tiktok;
    }
    
    return $links;
}

/**
 * Helper function to get footer settings
 *
 * @return array Footer settings array
 */
function linkawy_get_footer_settings() {
    return array(
        'description' => get_theme_mod('linkawy_footer_description', __('شريكك الاستراتيجي في النمو الرقمي. نقدم حلول سيو وتصميم مواقع مبتكرة لضمان تصدرك النتائج.', 'linkawy')),
        'address'     => get_theme_mod('linkawy_footer_address', __('دبي، الإمارات العربية المتحدة', 'linkawy')),
        'email'       => get_theme_mod('linkawy_footer_email', 'info@linkawy.io'),
        'phone'       => get_theme_mod('linkawy_footer_phone', ''),
        'copyright'   => get_theme_mod('linkawy_footer_copyright', __('جميع الحقوق محفوظة.', 'linkawy')),
    );
}

// =====================================================
// Color System Helper Functions
// =====================================================

/**
 * Sanitize color preset selection
 *
 * @param string $input The preset value
 * @return string Sanitized preset value
 */
function linkawy_sanitize_color_preset($input) {
    $valid = array('default', 'blue', 'green', 'purple', 'red', 'custom');
    return in_array($input, $valid) ? $input : 'default';
}

/**
 * Active callback for custom preset
 * Shows color pickers only when custom preset is selected
 *
 * @return bool Whether custom preset is selected
 */
function linkawy_is_custom_preset() {
    return get_theme_mod('linkawy_color_preset', 'default') === 'custom';
}

/**
 * Get color presets
 *
 * @param string $preset Preset name
 * @return array Color values array
 */
function linkawy_get_preset_colors($preset) {
    $presets = array(
        'default' => array(
            'primary'        => '#ff6b00',
            'secondary'      => '#1a1a2e',
            'accent'         => '#ff8533',
            'text_primary'   => '#333333',
            'text_secondary' => '#666666',
            'bg_light'       => '#f4f4f4',
            'bg_dark'        => '#1a1a1a',
            'link'           => '#ff6b00',
            'button_bg'      => '#ff6b00',
        ),
        'blue' => array(
            'primary'        => '#2563eb',
            'secondary'      => '#1e40af',
            'accent'         => '#60a5fa',
            'text_primary'   => '#1e293b',
            'text_secondary' => '#64748b',
            'bg_light'       => '#f1f5f9',
            'bg_dark'        => '#0f172a',
            'link'           => '#2563eb',
            'button_bg'      => '#2563eb',
        ),
        'green' => array(
            'primary'        => '#059669',
            'secondary'      => '#047857',
            'accent'         => '#34d399',
            'text_primary'   => '#1f2937',
            'text_secondary' => '#6b7280',
            'bg_light'       => '#f0fdf4',
            'bg_dark'        => '#14532d',
            'link'           => '#059669',
            'button_bg'      => '#059669',
        ),
        'purple' => array(
            'primary'        => '#7c3aed',
            'secondary'      => '#6d28d9',
            'accent'         => '#a78bfa',
            'text_primary'   => '#1f2937',
            'text_secondary' => '#6b7280',
            'bg_light'       => '#faf5ff',
            'bg_dark'        => '#2e1065',
            'link'           => '#7c3aed',
            'button_bg'      => '#7c3aed',
        ),
        'red' => array(
            'primary'        => '#dc2626',
            'secondary'      => '#b91c1c',
            'accent'         => '#f87171',
            'text_primary'   => '#1f2937',
            'text_secondary' => '#6b7280',
            'bg_light'       => '#fef2f2',
            'bg_dark'        => '#450a0a',
            'link'           => '#dc2626',
            'button_bg'      => '#dc2626',
        ),
    );
    
    return isset($presets[$preset]) ? $presets[$preset] : $presets['default'];
}

/**
 * Get custom colors from theme mods
 *
 * @return array Custom color values
 */
function linkawy_get_custom_colors() {
    return array(
        'primary'        => get_theme_mod('linkawy_primary_color', '#ff6b00'),
        'secondary'      => get_theme_mod('linkawy_secondary_color', '#1a1a2e'),
        'accent'         => get_theme_mod('linkawy_accent_color', '#ff8533'),
        'text_primary'   => get_theme_mod('linkawy_text_primary', '#333333'),
        'text_secondary' => get_theme_mod('linkawy_text_secondary', '#666666'),
        'bg_light'       => get_theme_mod('linkawy_bg_light', '#f4f4f4'),
        'bg_dark'        => get_theme_mod('linkawy_bg_dark', '#1a1a1a'),
        'link'           => get_theme_mod('linkawy_link_color', '#ff6b00'),
        'button_bg'      => get_theme_mod('linkawy_button_bg', '#ff6b00'),
    );
}

/**
 * Convert HEX color to RGB values
 *
 * @param string $hex HEX color code
 * @return array RGB values array
 */
function linkawy_hex_to_rgb($hex) {
    $hex = str_replace('#', '', $hex);
    
    if (strlen($hex) === 3) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }
    
    return array(
        'r' => hexdec(substr($hex, 0, 2)),
        'g' => hexdec(substr($hex, 2, 2)),
        'b' => hexdec(substr($hex, 4, 2)),
    );
}

/**
 * Convert RGB to HSL
 *
 * @param int $r Red value (0-255)
 * @param int $g Green value (0-255)
 * @param int $b Blue value (0-255)
 * @return array HSL values
 */
function linkawy_rgb_to_hsl($r, $g, $b) {
    $r /= 255;
    $g /= 255;
    $b /= 255;
    
    $max = max($r, $g, $b);
    $min = min($r, $g, $b);
    $l = ($max + $min) / 2;
    
    if ($max === $min) {
        $h = $s = 0;
    } else {
        $d = $max - $min;
        $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);
        
        switch ($max) {
            case $r:
                $h = (($g - $b) / $d + ($g < $b ? 6 : 0)) / 6;
                break;
            case $g:
                $h = (($b - $r) / $d + 2) / 6;
                break;
            case $b:
                $h = (($r - $g) / $d + 4) / 6;
                break;
        }
    }
    
    return array('h' => $h * 360, 's' => $s * 100, 'l' => $l * 100);
}

/**
 * Convert HSL to RGB
 *
 * @param float $h Hue (0-360)
 * @param float $s Saturation (0-100)
 * @param float $l Lightness (0-100)
 * @return array RGB values
 */
function linkawy_hsl_to_rgb($h, $s, $l) {
    $h /= 360;
    $s /= 100;
    $l /= 100;
    
    if ($s === 0) {
        $r = $g = $b = $l;
    } else {
        $q = $l < 0.5 ? $l * (1 + $s) : $l + $s - $l * $s;
        $p = 2 * $l - $q;
        
        $r = linkawy_hue_to_rgb($p, $q, $h + 1/3);
        $g = linkawy_hue_to_rgb($p, $q, $h);
        $b = linkawy_hue_to_rgb($p, $q, $h - 1/3);
    }
    
    return array(
        'r' => round($r * 255),
        'g' => round($g * 255),
        'b' => round($b * 255),
    );
}

/**
 * Helper function for HSL to RGB conversion
 */
function linkawy_hue_to_rgb($p, $q, $t) {
    if ($t < 0) $t += 1;
    if ($t > 1) $t -= 1;
    if ($t < 1/6) return $p + ($q - $p) * 6 * $t;
    if ($t < 1/2) return $q;
    if ($t < 2/3) return $p + ($q - $p) * (2/3 - $t) * 6;
    return $p;
}

/**
 * Convert RGB to HEX
 *
 * @param int $r Red value
 * @param int $g Green value
 * @param int $b Blue value
 * @return string HEX color code
 */
function linkawy_rgb_to_hex($r, $g, $b) {
    return '#' . sprintf('%02x%02x%02x', $r, $g, $b);
}

/**
 * Generate color variations (dark, light, lighter)
 *
 * @param string $hex_color HEX color code
 * @return array Color variations
 */
function linkawy_get_color_variations($hex_color) {
    $rgb = linkawy_hex_to_rgb($hex_color);
    $hsl = linkawy_rgb_to_hsl($rgb['r'], $rgb['g'], $rgb['b']);
    
    // Calculate variations
    $dark_hsl = array('h' => $hsl['h'], 's' => $hsl['s'], 'l' => max(0, $hsl['l'] - 15));
    $light_hsl = array('h' => $hsl['h'], 's' => $hsl['s'], 'l' => min(100, $hsl['l'] + 15));
    $lighter_hsl = array('h' => $hsl['h'], 's' => max(0, $hsl['s'] - 20), 'l' => min(100, $hsl['l'] + 30));
    $bg_hsl = array('h' => $hsl['h'], 's' => max(0, $hsl['s'] - 40), 'l' => min(100, 97));
    
    // Convert back to HEX
    $dark_rgb = linkawy_hsl_to_rgb($dark_hsl['h'], $dark_hsl['s'], $dark_hsl['l']);
    $light_rgb = linkawy_hsl_to_rgb($light_hsl['h'], $light_hsl['s'], $light_hsl['l']);
    $lighter_rgb = linkawy_hsl_to_rgb($lighter_hsl['h'], $lighter_hsl['s'], $lighter_hsl['l']);
    $bg_rgb = linkawy_hsl_to_rgb($bg_hsl['h'], $bg_hsl['s'], $bg_hsl['l']);
    
    return array(
        'dark'    => linkawy_rgb_to_hex($dark_rgb['r'], $dark_rgb['g'], $dark_rgb['b']),
        'light'   => linkawy_rgb_to_hex($light_rgb['r'], $light_rgb['g'], $light_rgb['b']),
        'lighter' => linkawy_rgb_to_hex($lighter_rgb['r'], $lighter_rgb['g'], $lighter_rgb['b']),
        'bg'      => linkawy_rgb_to_hex($bg_rgb['r'], $bg_rgb['g'], $bg_rgb['b']),
        'rgb'     => $rgb['r'] . ', ' . $rgb['g'] . ', ' . $rgb['b'],
    );
}

/**
 * Output customizer CSS variables
 */
function linkawy_customizer_css() {
    $preset = get_theme_mod('linkawy_color_preset', 'default');
    
    // Get colors based on preset
    if ($preset === 'custom') {
        $colors = linkawy_get_custom_colors();
    } else {
        $colors = linkawy_get_preset_colors($preset);
    }
    
    // Calculate primary color variations
    $primary_variations = linkawy_get_color_variations($colors['primary']);
    
    // Build CSS output
    $css = '<style type="text/css" id="linkawy-custom-colors">';
    $css .= ':root {';
    
    // Primary colors
    $css .= '--primary-color: ' . esc_attr($colors['primary']) . ';';
    $css .= '--primary-color-dark: ' . esc_attr($primary_variations['dark']) . ';';
    $css .= '--primary-color-light: ' . esc_attr($primary_variations['light']) . ';';
    $css .= '--primary-color-lighter: ' . esc_attr($primary_variations['lighter']) . ';';
    $css .= '--primary-color-bg: ' . esc_attr($primary_variations['bg']) . ';';
    $css .= '--primary-color-rgb: ' . esc_attr($primary_variations['rgb']) . ';';
    
    // Secondary & Accent
    $css .= '--secondary-color: ' . esc_attr($colors['secondary']) . ';';
    $css .= '--accent-color: ' . esc_attr($colors['accent']) . ';';
    
    // Text colors
    $css .= '--text-color: ' . esc_attr($colors['text_primary']) . ';';
    $css .= '--text-main: ' . esc_attr($colors['text_primary']) . ';';
    $css .= '--text-primary: ' . esc_attr($colors['text_primary']) . ';';
    $css .= '--text-secondary: ' . esc_attr($colors['text_secondary']) . ';';
    $css .= '--text-gray: ' . esc_attr($colors['text_secondary']) . ';';
    
    // Background colors
    $css .= '--bg-light: ' . esc_attr($colors['bg_light']) . ';';
    $css .= '--light-bg: ' . esc_attr($colors['bg_light']) . ';';
    $css .= '--bg-dark: ' . esc_attr($colors['bg_dark']) . ';';
    $css .= '--dark-bg: ' . esc_attr($colors['bg_dark']) . ';';
    
    // Link & Button colors
    $css .= '--link-color: ' . esc_attr($colors['link']) . ';';
    $css .= '--link-hover-color: ' . esc_attr($primary_variations['dark']) . ';';
    $css .= '--button-bg: ' . esc_attr($colors['button_bg']) . ';';
    $css .= '--button-hover-bg: ' . esc_attr($primary_variations['dark']) . ';';
    
    $css .= '}';
    $css .= '</style>';
    
    echo $css;
}
add_action('wp_head', 'linkawy_customizer_css', 100);

/**
 * Enqueue customizer preview script
 */
function linkawy_customizer_preview_scripts() {
    wp_enqueue_script(
        'linkawy-customizer-preview',
        get_template_directory_uri() . '/assets/js/customizer-preview.js',
        array('jquery', 'customize-preview'),
        '1.0.0',
        true
    );
    
    // Pass preset colors to JavaScript
    wp_localize_script('linkawy-customizer-preview', 'linkawayPresets', array(
        'default' => linkawy_get_preset_colors('default'),
        'blue'    => linkawy_get_preset_colors('blue'),
        'green'   => linkawy_get_preset_colors('green'),
        'purple'  => linkawy_get_preset_colors('purple'),
        'red'     => linkawy_get_preset_colors('red'),
    ));
}
add_action('customize_preview_init', 'linkawy_customizer_preview_scripts');

/**
 * Enqueue customizer controls script (for control panel interactions)
 */
function linkawy_customizer_controls_scripts() {
    wp_enqueue_script(
        'linkawy-customizer-controls',
        get_template_directory_uri() . '/assets/js/customizer-controls.js',
        array('jquery', 'customize-controls'),
        '1.0.0',
        true
    );
    
    // Pass preset colors to controls JavaScript
    wp_localize_script('linkawy-customizer-controls', 'linkawayPresets', array(
        'default' => linkawy_get_preset_colors('default'),
        'blue'    => linkawy_get_preset_colors('blue'),
        'green'   => linkawy_get_preset_colors('green'),
        'purple'  => linkawy_get_preset_colors('purple'),
        'red'     => linkawy_get_preset_colors('red'),
    ));
    
    // Pass localized strings
    wp_localize_script('linkawy-customizer-controls', 'linkawayControlsL10n', array(
        'confirmReset' => __('هل أنت متأكد من إعادة تعيين جميع الألوان إلى القيم الافتراضية؟', 'linkawy'),
    ));
}
add_action('customize_controls_enqueue_scripts', 'linkawy_customizer_controls_scripts');
