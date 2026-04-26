<?php
/**
 * Enqueue Scripts and Styles
 *
 * @package Linkawy
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get asset suffix for minified files
 * Returns '.min' in production if the minified file exists, '' otherwise
 */
function linkawy_get_asset_suffix() {
    // Use non-minified in debug mode
    if (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) {
        return '';
    }
    return '.min';
}

/**
 * Get the correct asset path with fallback to non-minified
 * 
 * @param string $base_path Base path without extension (e.g., '/assets/css/style')
 * @param string $extension File extension (e.g., 'css' or 'js')
 * @return string Full path to use
 */
function linkawy_get_asset_path($base_path, $extension) {
    $suffix = linkawy_get_asset_suffix();
    $min_file = LINKAWY_DIR . $base_path . $suffix . '.' . $extension;
    
    // Check if minified file exists, fallback to non-minified
    if ($suffix === '.min' && !file_exists($min_file)) {
        return LINKAWY_URI . $base_path . '.' . $extension;
    }
    
    return LINKAWY_URI . $base_path . $suffix . '.' . $extension;
}

/**
 * Remove Elementor's old Font Awesome v4.7.0 and load v6 instead
 * 
 * Elementor loads Font Awesome v4.7.0 which doesn't support modern icons
 * like fab fa-shopify, fas fa-brain, etc. We need v6 for full icon support.
 * Priority 20 ensures it runs AFTER Elementor registers Font Awesome.
 */
function linkawy_replace_elementor_font_awesome() {
    // Remove Elementor's Font Awesome v4.7.0
    wp_dequeue_style('font-awesome');
    wp_deregister_style('font-awesome');
    
    // Register and enqueue Font Awesome v6.4.0 (will be deferred via filter)
    wp_enqueue_style(
        'font-awesome-v6',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        array(),
        '6.4.0'
    );
}
add_action('wp_enqueue_scripts', 'linkawy_replace_elementor_font_awesome', 20);

/**
 * Defer Font Awesome CSS to eliminate render-blocking
 * Icons are decorative and not critical for first paint
 * Uses media="print" onload pattern for non-blocking load
 */
function linkawy_defer_font_awesome_css($html, $handle) {
    if ($handle === 'font-awesome-v6') {
        // Replace media="all" with media="print" onload pattern
        $html = str_replace(
            "media='all'",
            "media='print' onload=\"this.media='all'\"",
            $html
        );
        // Add noscript fallback
        $noscript = '<noscript>' . str_replace(" media='print' onload=\"this.media='all'\"", '', $html) . '</noscript>';
        $html .= $noscript;
    }
    return $html;
}
add_filter('style_loader_tag', 'linkawy_defer_font_awesome_css', 10, 2);

/**
 * Enqueue styles and scripts
 */
function linkawy_scripts() {
    // Check if we're in Elementor preview mode (only on frontend)
    $is_elementor_preview = false;
    if (!is_admin() && class_exists('\Elementor\Plugin')) {
        $elementor = \Elementor\Plugin::instance();
        if (isset($elementor->preview)) {
            $is_elementor_preview = $elementor->preview->is_preview_mode();
        }
    }
    
    // In Elementor preview, skip theme styles to avoid conflicts
    if ($is_elementor_preview) {
        return; // Elementor will load its own CSS/JS
    }
    
    // Font Awesome v6 is now loaded by linkawy_replace_elementor_font_awesome()
    // No need to enqueue here as it would create duplicate registration

    // Main Style
    $style_path = linkawy_get_asset_path('/assets/css/style', 'css');
    wp_enqueue_style(
        'linkawy-style',
        $style_path,
        array(),
        LINKAWY_VERSION
    );

    // Arabic Style
    wp_enqueue_style(
        'linkawy-style-ar',
        linkawy_get_asset_path('/assets/css/style-ar', 'css'),
        array('linkawy-style'),
        LINKAWY_VERSION
    );

    // Blog/Archive styles (also on 404 page for related posts)
    if (is_home() || is_archive() || is_search() || is_404()) {
        wp_enqueue_style(
            'linkawy-blog',
            linkawy_get_asset_path('/assets/css/blog', 'css'),
            array('linkawy-style'),
            LINKAWY_VERSION
        );
    }

    // Single Post/Article styles (typography, TOC, etc.). FAQ داخل المقال: article.css؛ FAQ داخل الصفحات: content-blocks.css
    if (is_singular('post') || (is_page() && !is_front_page())) {
        wp_enqueue_style(
            'linkawy-article',
            linkawy_get_asset_path('/assets/css/article', 'css'),
            array('linkawy-style'),
            LINKAWY_VERSION
        );
    }

    // Page template styles (page.php - not front page, not posts)
    if (is_page() && !is_front_page()) {
        wp_enqueue_style(
            'linkawy-page',
            linkawy_get_asset_path('/assets/css/page', 'css'),
            array('linkawy-style'),
            LINKAWY_VERSION
        );
    }

    // Glossary styles
    if (is_singular('glossary') || is_post_type_archive('glossary')) {
        wp_enqueue_style(
            'linkawy-glossary',
            linkawy_get_asset_path('/assets/css/glossary', 'css'),
            array('linkawy-style'),
            LINKAWY_VERSION
        );
    }

    // Content blocks: shared typography and Gutenberg blocks for .linkawy-content (pages, posts, resources, prompts, glossary single)
    if ((is_page() && !is_front_page()) || is_singular('post') || is_singular('resources') || is_singular('prompts') || is_singular('glossary')) {
        wp_enqueue_style(
            'linkawy-content-blocks',
            linkawy_get_asset_path('/assets/css/content-blocks', 'css'),
            array('linkawy-style'),
            LINKAWY_VERSION
        );
    }

    // Resources CPT: single (hero) + archive (grid) — service-page + blog CSS
    if (is_singular('resources') || is_post_type_archive('resources') || is_tax('resource_type')) {
        wp_enqueue_style(
            'linkawy-service-page',
            linkawy_get_asset_path('/assets/css/service-page', 'css'),
            array('linkawy-style'),
            LINKAWY_VERSION
        );
        wp_enqueue_style(
            'linkawy-blog',
            linkawy_get_asset_path('/assets/css/blog', 'css'),
            array('linkawy-style'),
            LINKAWY_VERSION
        );
    }

    // Prompts CPT: single + archive + taxonomy — service-page + blog + prompts CSS
    if (is_singular('prompts') || is_post_type_archive('prompts') || is_tax('prompt_type') || is_tax('prompt_tag')) {
        wp_enqueue_style(
            'linkawy-service-page',
            linkawy_get_asset_path('/assets/css/service-page', 'css'),
            array('linkawy-style'),
            LINKAWY_VERSION
        );
        wp_enqueue_style(
            'linkawy-blog',
            linkawy_get_asset_path('/assets/css/blog', 'css'),
            array('linkawy-style'),
            LINKAWY_VERSION
        );
        wp_enqueue_style(
            'linkawy-prompts',
            linkawy_get_asset_path('/assets/css/prompts', 'css'),
            array('linkawy-style'),
            LINKAWY_VERSION
        );
    }

    // Front Page Hero Section styles
    if (is_front_page()) {
        // Hero Section CSS
        wp_enqueue_style(
            'linkawy-hero',
            linkawy_get_asset_path('/assets/css/hero', 'css'),
            array('linkawy-style'),
            LINKAWY_VERSION
        );
        // Front page sections (platforms, video, results, blog, FAQ)
        wp_enqueue_style(
            'linkawy-front-page',
            linkawy_get_asset_path('/assets/css/front-page', 'css'),
            array('linkawy-hero'),
            LINKAWY_VERSION
        );
        // Contact form section (extracted from front-page.css)
        wp_enqueue_style(
            'linkawy-contact-form',
            linkawy_get_asset_path('/assets/css/contact-form', 'css'),
            array('linkawy-front-page'),
            LINKAWY_VERSION
        );
    }

    // Service page template: hero + page content + optional contact form
    if (is_page_template('page-templates/service-page.php')) {
        wp_enqueue_style(
            'linkawy-service-page',
            linkawy_get_asset_path('/assets/css/service-page', 'css'),
            array('linkawy-style'),
            LINKAWY_VERSION
        );
        wp_enqueue_style(
            'linkawy-contact-form',
            linkawy_get_asset_path('/assets/css/contact-form', 'css'),
            array('linkawy-style'),
            LINKAWY_VERSION
        );
    }

    // Landing page template: blank shell, full-width Gutenberg
    if (is_page_template('page-templates/landing-page.php')) {
        wp_enqueue_style(
            'linkawy-landing-page',
            linkawy_get_asset_path('/assets/css/landing-page', 'css'),
            array('linkawy-style'),
            LINKAWY_VERSION
        );
        if (!wp_style_is('linkawy-content-blocks', 'enqueued')) {
            wp_enqueue_style(
                'linkawy-content-blocks',
                linkawy_get_asset_path('/assets/css/content-blocks', 'css'),
                array('linkawy-style'),
                LINKAWY_VERSION
            );
        }
    }

    // Contact form shortcode inside a normal page/post (not front / service template)
    if (
        function_exists('linkawy_content_includes_contact_form_shortcode') &&
        linkawy_content_includes_contact_form_shortcode() &&
        !is_front_page() &&
        !is_page_template('page-templates/service-page.php') &&
        !wp_style_is('linkawy-contact-form', 'enqueued')
    ) {
        wp_enqueue_style(
            'linkawy-contact-form',
            linkawy_get_asset_path('/assets/css/contact-form', 'css'),
            array('linkawy-style'),
            LINKAWY_VERSION
        );
    }

    // Theme stylesheet (style.css) is header-only, no actual styles
    // Removed from frontend to reduce render-blocking requests
    // WordPress still recognizes the theme via style.css header

    // reCAPTCHA v2 Invisible (shared helper: window.linkawyWithRecaptcha). Loads api.js when site key is set.
    wp_enqueue_script(
        'linkawy-recaptcha-v2',
        linkawy_get_asset_path('/assets/js/recaptcha-v2-invisible', 'js'),
        array(),
        LINKAWY_VERSION,
        true
    );
    wp_localize_script(
        'linkawy-recaptcha-v2',
        'linkawyRecaptchaV2Cfg',
        array(
            'siteKey' => trim((string) get_theme_mod('linkawy_recaptcha_site_key', '')),
        )
    );

    // Main JavaScript (no jQuery dependency - vanilla JS only)
    wp_enqueue_script(
        'linkawy-main',
        linkawy_get_asset_path('/assets/js/main-ar', 'js'),
        array('linkawy-recaptcha-v2'),
        LINKAWY_VERSION,
        true
    );

    // Pass data to JavaScript
    wp_localize_script('linkawy-main', 'linkawySiteData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'homeUrl' => home_url('/'),
        'themeUrl' => LINKAWY_URI,
        'isRTL' => is_rtl(),
    ));

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // Single prompt: copy button + AJAX copy tracking
    if (is_singular('prompts')) {
        $prompt_single_id = (int) get_queried_object_id();
        $prompt_content_locked = $prompt_single_id
            && (string) get_post_meta($prompt_single_id, '_prompt_content_lock', true) === '1'
            && ! linkawy_is_prompt_content_unlocked($prompt_single_id);

        wp_enqueue_script(
            'linkawy-prompt-copy',
            linkawy_get_asset_path('/assets/js/prompt-copy', 'js'),
            array(),
            LINKAWY_VERSION,
            true
        );
        wp_localize_script('linkawy-prompt-copy', 'linkawyPromptCopy', array(
            'ajaxUrl'       => admin_url('admin-ajax.php'),
            'nonce'         => wp_create_nonce('linkawy_prompt_copy'),
            'postId'        => $prompt_single_id,
            'copiedLabel'   => __('تم النسخ', 'linkawy'),
            'contentLocked' => $prompt_content_locked,
        ));

        if ($prompt_content_locked) {
            wp_enqueue_script(
                'linkawy-prompt-content-lock',
                linkawy_get_asset_path('/assets/js/prompt-content-lock', 'js'),
                array('linkawy-prompt-copy', 'linkawy-recaptcha-v2'),
                LINKAWY_VERSION,
                true
            );
            wp_localize_script('linkawy-prompt-content-lock', 'linkawyPromptContentLock', array(
                'ajaxUrl'     => admin_url('admin-ajax.php'),
                'postId'      => $prompt_single_id,
                'source'      => 'single-prompt',
                'sourceKind'  => 'prompt',
                'sourceUrl'   => get_permalink($prompt_single_id),
                'sourceTitle' => get_the_title($prompt_single_id),
            ));
        }
    }

    // Prompts archive/taxonomy: AJAX filter + search
    if (is_post_type_archive('prompts') || is_tax('prompt_type') || is_tax('prompt_tag')) {
        $initial_tag    = '';
        $initial_tag_id = 0;
        if (is_tax('prompt_tag')) {
            $qtag = get_queried_object();
            if ($qtag && !is_wp_error($qtag) && !empty($qtag->slug)) {
                $initial_tag = $qtag->slug;
                $initial_tag_id = (int) $qtag->term_id;
            }
        } elseif (isset($_GET['prompt_tag'])) {
            $initial_tag = sanitize_text_field(wp_unslash($_GET['prompt_tag']));
            $maybe_term  = get_term_by('slug', $initial_tag, 'prompt_tag');
            if ($maybe_term && !is_wp_error($maybe_term)) {
                $initial_tag_id = (int) $maybe_term->term_id;
            }
        }
        wp_enqueue_script(
            'linkawy-prompt-archive',
            linkawy_get_asset_path('/assets/js/prompt-archive', 'js'),
            array(),
            LINKAWY_VERSION,
            true
        );
        wp_localize_script('linkawy-prompt-archive', 'linkawyPromptArchive', array(
            'ajaxUrl'     => admin_url('admin-ajax.php'),
            'nonce'       => wp_create_nonce('linkawy_prompt_filter'),
            'initialPromptTag'   => $initial_tag,
            'initialPromptTagId' => $initial_tag_id,
        ));
    }
}
add_action('wp_enqueue_scripts', 'linkawy_scripts');

/**
 * Preload ONLY the critical Medium weight font (WOFF2)
 * 
 * Strategy: Keep critical path minimal and avoid font chaining.
 */
function linkawy_preload_somar_fonts() {
    $font_url = LINKAWY_URI . '/assets/fonts/SomarSans-Medium.woff2';
    echo '<link rel="preload" href="' . esc_url($font_url) . '" as="font" type="font/woff2" crossorigin>' . "\n";
}
add_action('wp_head', 'linkawy_preload_somar_fonts', 1);

/**
 * Add preconnect hints for external CDN domains
 * 
 * Allows the browser to start DNS+TCP+TLS handshake early,
 * before discovering resources from these domains in the HTML.
 */
function linkawy_preconnect_cdn_domains() {
    // Cloudflare CDN (Font Awesome + Swiper)
    echo '<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>' . "\n";
    // unpkg (just-validate) - front page, service page with hero image, or pages with contact shortcode
    if (is_front_page()) {
        echo '<link rel="preconnect" href="https://unpkg.com" crossorigin>' . "\n";
    } elseif (is_page_template('page-templates/service-page.php') && get_queried_object_id() && has_post_thumbnail(get_queried_object_id())) {
        echo '<link rel="preconnect" href="https://unpkg.com" crossorigin>' . "\n";
    } elseif (function_exists('linkawy_content_includes_contact_form_shortcode') && linkawy_content_includes_contact_form_shortcode()) {
        echo '<link rel="preconnect" href="https://unpkg.com" crossorigin>' . "\n";
    }
}
add_action('wp_head', 'linkawy_preconnect_cdn_domains', 0);

/**
 * Preload critical CSS files to reduce render-blocking time
 * Tells browser to fetch these immediately rather than waiting for discovery
 * Priority 1 ensures output right after preconnect hints
 */
function linkawy_preload_critical_css() {
    $suffix = linkawy_get_asset_suffix();
    $version = LINKAWY_VERSION;
    
    // Always preload base styles (used on all pages)
    echo '<link rel="preload" as="style" href="' . esc_url(LINKAWY_URI . '/assets/css/style' . $suffix . '.css?ver=' . $version) . '">' . "\n";
    echo '<link rel="preload" as="style" href="' . esc_url(LINKAWY_URI . '/assets/css/style-ar' . $suffix . '.css?ver=' . $version) . '">' . "\n";
    
    // Front page: preload hero CSS (above-fold critical)
    if (is_front_page()) {
        echo '<link rel="preload" as="style" href="' . esc_url(LINKAWY_URI . '/assets/css/hero' . $suffix . '.css?ver=' . $version) . '">' . "\n";
    }
}
add_action('wp_head', 'linkawy_preload_critical_css', 1);

/**
 * Preload LCP image for single posts to improve Largest Contentful Paint
 */
function linkawy_preload_lcp_image() {
    // Preload featured image on single posts (this is typically the LCP element)
    if (is_singular('post') && has_post_thumbnail()) {
        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
        if ($featured_img_url) {
            echo '<link rel="preload" as="image" href="' . esc_url($featured_img_url) . '" fetchpriority="high">' . "\n";
        }
    }
    
    // Preload hero image on front page (if exists)
    if (is_front_page()) {
        // Preload main hero/above-fold images
        $hero_images = array(
            LINKAWY_URI . '/assets/images/Placeholder-Image-scaled.webp',
        );
        foreach ($hero_images as $img_url) {
            echo '<link rel="preload" as="image" href="' . esc_url($img_url) . '" fetchpriority="high">' . "\n";
        }
    }
}
add_action('wp_head', 'linkawy_preload_lcp_image', 2);

/**
 * Add async/defer attributes to scripts
 */
function linkawy_script_loader_tag($tag, $handle, $src) {
    // IMPORTANT: Never modify script loading in wp-admin / Elementor editor.
    // Elementor relies on jQuery being available immediately, and WP adds inline
    // scripts like "jquery-migrate-js-after" that will break if jQuery is deferred.
    if (is_admin()) {
        return $tag;
    }

    // Only defer our own theme script on frontend pages (safe).
    // Do NOT defer jQuery or jquery-migrate.
    if ($handle === 'linkawy-main') {
        return str_replace(' src', ' defer src', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'linkawy_script_loader_tag', 10, 3);

/**
 * Make ONLY non-critical CSS load asynchronously
 * 
 * IMPORTANT: Layout-critical styles must load synchronously to prevent CLS:
 * - font-awesome-v6 (icons - critical for visual completeness)
 * - linkawy-style (base layout, header, containers)
 * - linkawy-style-ar (RTL adjustments)
 * - linkawy-article (article layout, TOC - prevents CLS on single posts)
 * - linkawy-blog (blog grid layout)
 * 
 * Note: Font Awesome v6 loads synchronously to ensure icons appear immediately.
 */
function linkawy_async_css_loading($html, $handle) {
    // DO NOT defer critical styles that affect layout or UX
    // Empty array means all styles load synchronously
    $async_styles = array();

    if (in_array($handle, $async_styles)) {
        return str_replace(
            "media='all'",
            "media='print' onload=\"this.media='all'\"",
            $html
        );
    }
    return $html;
}
add_filter('style_loader_tag', 'linkawy_async_css_loading', 10, 2);

/**
 * Preload critical Font Awesome font files to improve font-display
 */
function linkawy_preload_font_awesome_fonts() {
    // Preload the most commonly used Font Awesome font files
    $fonts = array(
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-solid-900.woff2',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-brands-400.woff2',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-regular-400.woff2',
    );
    
    foreach ($fonts as $font_url) {
        echo '<link rel="preload" href="' . esc_url($font_url) . '" as="font" type="font/woff2" crossorigin="anonymous">' . "\n";
    }
}
add_action('wp_head', 'linkawy_preload_font_awesome_fonts', 1);

/**
 * Register AI Prompt Gutenberg Block
 */
function linkawy_register_ai_prompt_block() {
    // Register block editor script
    wp_register_script(
        'linkawy-ai-prompt-block',
        LINKAWY_URI . '/assets/js/blocks/ai-prompt-block.js',
        array('wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components'),
        LINKAWY_VERSION,
        true
    );

    // Pass theme URL to JavaScript
    wp_localize_script('linkawy-ai-prompt-block', 'linkawyBlockData', array(
        'themeUrl' => LINKAWY_URI,
        'aiSparkIcon' => LINKAWY_URI . '/assets/images/ai-spark.svg',
    ));

    // Register block editor styles
    wp_register_style(
        'linkawy-ai-prompt-block-editor',
        LINKAWY_URI . '/assets/css/blocks/ai-prompt-editor.css',
        array('wp-edit-blocks'),
        LINKAWY_VERSION
    );

    // Register the block
    register_block_type('linkawy/ai-prompt', array(
        'editor_script' => 'linkawy-ai-prompt-block',
        'editor_style'  => 'linkawy-ai-prompt-block-editor',
        'render_callback' => 'linkawy_render_ai_prompt_block',
    ));
}
add_action('init', 'linkawy_register_ai_prompt_block');

/**
 * Render AI Prompt Block (Server-side)
 */
function linkawy_render_ai_prompt_block($attributes, $content) {
    $theme_url = LINKAWY_URI;
    $icon_url = $theme_url . '/assets/images/ai-spark.svg';
    
    // Fix icon path in saved content
    $content = str_replace(
        'src="/wp-content/themes/linkawy/assets/images/ai-spark.png"',
        'src="' . esc_url($icon_url) . '"',
        $content
    );
    
    // Also handle the localized variable placeholder
    $content = str_replace(
        'src="{{AI_SPARK_ICON}}"',
        'src="' . esc_url($icon_url) . '"',
        $content
    );
    
    // Fix label text (uppercase to lowercase)
    $content = str_replace('AI Prompt', 'ai prompt', $content);
    $content = str_replace(' AI Prompt', ' ai prompt', $content);
    
    return $content;
}

/**
 * Register FAQ Gutenberg Block
 */
function linkawy_register_faq_block() {
    // Register block editor script
    wp_register_script(
        'linkawy-faq-block',
        LINKAWY_URI . '/assets/js/blocks/faq-block.js',
        array('wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components'),
        LINKAWY_VERSION,
        true
    );

    // Register block editor styles
    wp_register_style(
        'linkawy-faq-block-editor',
        LINKAWY_URI . '/assets/css/blocks/faq-editor.css',
        array('wp-edit-blocks'),
        LINKAWY_VERSION
    );

    // Register the block
    register_block_type('linkawy/faq', array(
        'editor_script' => 'linkawy-faq-block',
        'editor_style'  => 'linkawy-faq-block-editor',
    ));
}
add_action('init', 'linkawy_register_faq_block');

/**
 * Register References Gutenberg Block
 */
function linkawy_register_references_block() {
    // Register block editor script
    wp_register_script(
        'linkawy-references-block',
        LINKAWY_URI . '/assets/js/blocks/references-block.js',
        array('wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components'),
        LINKAWY_VERSION,
        true
    );
    
    // Pass AJAX data to JavaScript
    wp_localize_script('linkawy-references-block', 'linkawyReferences', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('linkawy_references_nonce'),
        'strings' => array(
            'fetchError' => __('فشل في جلب البيانات', 'linkawy'),
            'fetching' => __('جاري الجلب...', 'linkawy'),
            'fetchFromUrl' => __('جلب من رابط', 'linkawy'),
            'enterUrl' => __('أدخل رابط المصدر', 'linkawy'),
            'fetch' => __('جلب', 'linkawy'),
            'cancel' => __('إلغاء', 'linkawy'),
        )
    ));

    // Register block editor styles
    wp_register_style(
        'linkawy-references-block-editor',
        LINKAWY_URI . '/assets/css/blocks/references-editor.css',
        array('wp-edit-blocks'),
        LINKAWY_VERSION
    );

    // Register the block
    register_block_type('linkawy/references', array(
        'editor_script' => 'linkawy-references-block',
        'editor_style'  => 'linkawy-references-block-editor',
    ));
}
add_action('init', 'linkawy_register_references_block');

/**
 * Fetch URL metadata for references
 * Extracts title and site name from a given URL
 */
function linkawy_fetch_url_metadata($url) {
    // Validate URL
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return new WP_Error('invalid_url', 'الرابط غير صالح');
    }
    
    // Fetch the page
    $response = wp_remote_get($url, array(
        'timeout' => 15,
        'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
        'sslverify' => false
    ));
    
    if (is_wp_error($response)) {
        return $response;
    }
    
    $status_code = wp_remote_retrieve_response_code($response);
    if ($status_code !== 200) {
        return new WP_Error('fetch_failed', 'فشل في جلب الصفحة (كود: ' . $status_code . ')');
    }
    
    $html = wp_remote_retrieve_body($response);
    
    // Convert encoding if needed
    if (preg_match('/charset=["\']?([^"\'\s>]+)/i', $html, $charset_match)) {
        $charset = strtolower($charset_match[1]);
        if ($charset !== 'utf-8' && $charset !== 'utf8') {
            $html = mb_convert_encoding($html, 'UTF-8', $charset);
        }
    }
    
    // Extract title (try multiple methods)
    $title = '';
    
    // Method 1: og:title
    if (preg_match('/<meta[^>]+property=["\']og:title["\'][^>]+content=["\']([^"\']+)["\']/i', $html, $match)) {
        $title = $match[1];
    } elseif (preg_match('/<meta[^>]+content=["\']([^"\']+)["\'][^>]+property=["\']og:title["\']/i', $html, $match)) {
        $title = $match[1];
    }
    
    // Method 2: <title> tag
    if (empty($title) && preg_match('/<title[^>]*>([^<]+)<\/title>/i', $html, $match)) {
        $title = trim($match[1]);
    }
    
    // Extract site name
    $site_name = '';
    
    // Method 1: og:site_name
    if (preg_match('/<meta[^>]+property=["\']og:site_name["\'][^>]+content=["\']([^"\']+)["\']/i', $html, $match)) {
        $site_name = $match[1];
    } elseif (preg_match('/<meta[^>]+content=["\']([^"\']+)["\'][^>]+property=["\']og:site_name["\']/i', $html, $match)) {
        $site_name = $match[1];
    }
    
    // Fallback: extract from domain
    if (empty($site_name)) {
        $parsed_url = parse_url($url);
        $domain = isset($parsed_url['host']) ? $parsed_url['host'] : '';
        $domain = preg_replace('/^www\./', '', $domain);
        // Capitalize first letter of each part
        $site_name = ucwords(str_replace('.', ' ', explode('.', $domain)[0]));
    }
    
    // Clean up title (remove site name suffix if present)
    $title = html_entity_decode($title, ENT_QUOTES, 'UTF-8');
    $title = preg_replace('/\s*[\|\-–—]\s*' . preg_quote($site_name, '/') . '\s*$/i', '', $title);
    $title = trim($title);
    
    // Clean up site name
    $site_name = html_entity_decode($site_name, ENT_QUOTES, 'UTF-8');
    
    return array(
        'title' => $title,
        'site_name' => $site_name,
        'url' => $url,
        'accessed_date' => date_i18n('j/n/Y')
    );
}

/**
 * AJAX handler for fetching URL metadata
 */
function linkawy_ajax_fetch_reference_metadata() {
    // Check nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'linkawy_references_nonce')) {
        wp_send_json_error(array('message' => 'خطأ في التحقق الأمني'));
    }
    
    // Check if user can edit posts
    if (!current_user_can('edit_posts')) {
        wp_send_json_error(array('message' => 'ليس لديك صلاحية'));
    }
    
    $url = isset($_POST['url']) ? esc_url_raw($_POST['url']) : '';
    
    if (empty($url)) {
        wp_send_json_error(array('message' => 'الرابط مطلوب'));
    }
    
    $result = linkawy_fetch_url_metadata($url);
    
    if (is_wp_error($result)) {
        wp_send_json_error(array('message' => $result->get_error_message()));
    }
    
    wp_send_json_success($result);
}
add_action('wp_ajax_linkawy_fetch_reference', 'linkawy_ajax_fetch_reference_metadata');

/**
 * Add decoding="async" to all images for performance
 */
function linkawy_add_image_attributes($attr, $attachment, $size) {
    if (!isset($attr['decoding'])) {
        $attr['decoding'] = 'async';
    }
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'linkawy_add_image_attributes', 10, 3);

/**
 * Remove WordPress 6.7+ "auto," prefix from sizes attribute
 * 
 * WordPress 6.7 introduced wp_img_tag_add_auto_sizes() which prepends "auto," 
 * to the sizes attribute for lazy-loaded images. While this is a progressive
 * enhancement, it can cause browsers to download larger srcset images than needed
 * when we've already calculated precise sizes for our grid layouts.
 * 
 * This filter removes "auto," when we've set explicit responsive sizes,
 * ensuring browsers use our calculated values for optimal image selection.
 */
function linkawy_remove_auto_sizes($attr, $attachment, $size) {
    if (isset($attr['sizes']) && strpos($attr['sizes'], 'auto,') === 0) {
        // Remove "auto, " prefix to let our explicit sizes control selection
        $attr['sizes'] = preg_replace('/^auto,\s*/', '', $attr['sizes']);
    }
    return $attr;
}
// Priority 99 to run after WordPress adds "auto,"
add_filter('wp_get_attachment_image_attributes', 'linkawy_remove_auto_sizes', 99, 3);

/**
 * Fix image sizes attribute for article content
 * 
 * Default WordPress uses sizes="(max-width: Xpx) 100vw, Xpx" which downloads
 * images much larger than needed. Article content width is ~585px on desktop.
 * 
 * This saves bandwidth and improves LCP by downloading appropriate image sizes.
 */
function linkawy_fix_content_image_sizes($sizes, $size, $image_src, $image_meta, $attachment_id) {
    // Only apply on single posts (article pages)
    if (!is_singular('post')) {
        return $sizes;
    }
    
    // Article content max width is approximately 585px on desktop
    // On mobile it's 100vw minus padding (~container 2rem + card 1rem = 3rem)
    // Breakpoint at 900px (when layout goes single column)
    $article_sizes = '(max-width: 900px) calc(100vw - 3rem), 585px';
    
    return $article_sizes;
}
add_filter('wp_calculate_image_sizes', 'linkawy_fix_content_image_sizes', 10, 5);

/**
 * Add loading="eager" and fetchpriority="high" to first content image (potential LCP)
 * 
 * WordPress 5.9+ adds loading="lazy" to all images which can delay LCP.
 * The first image in article content is often the LCP element.
 */
function linkawy_optimize_lcp_content_image($content) {
    if (!is_singular('post')) {
        return $content;
    }
    
    // Find the first <img> tag in content and add priority loading
    $content = preg_replace_callback(
        '/<img([^>]*?)class="([^"]*)"([^>]*?)>/i',
        function($matches) {
            static $first_image = true;
            
            if ($first_image) {
                $first_image = false;
                
                // Remove any existing loading attribute
                $attrs = preg_replace('/\s*loading="[^"]*"/', '', $matches[1] . $matches[3]);
                
                // Add eager loading and high priority
                return '<img' . $matches[1] . 'class="' . $matches[2] . '"' . $matches[3] . ' loading="eager" fetchpriority="high">';
            }
            
            return $matches[0];
        },
        $content,
        1 // Only replace first occurrence
    );
    
    return $content;
}
add_filter('the_content', 'linkawy_optimize_lcp_content_image', 20);
