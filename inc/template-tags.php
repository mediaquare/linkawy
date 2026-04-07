<?php
/**
 * Template Tags
 *
 * @package Linkawy
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Display breadcrumbs
 */
function linkawy_breadcrumbs() {
    $separator = '<span class="breadcrumb-separator"><i class="fas fa-chevron-left"></i></span>';
    
    echo '<nav class="breadcrumbs">';
    echo '<a href="' . esc_url(home_url('/')) . '">' . __('الرئيسية', 'linkawy') . '</a>';

    if (is_singular('post')) {
        echo $separator;
        echo '<a href="' . esc_url(get_permalink(get_option('page_for_posts'))) . '">' . __('المدونة', 'linkawy') . '</a>';
        echo $separator;
        $categories = get_the_category();
        if ($categories) {
            echo '<span class="breadcrumb-current">' . esc_html($categories[0]->name) . '</span>';
        }
    } elseif (is_singular('glossary')) {
        echo $separator;
        echo '<a href="' . esc_url(get_post_type_archive_link('glossary')) . '">' . __('المصطلحات', 'linkawy') . '</a>';
    } elseif (is_post_type_archive('glossary')) {
        echo $separator;
        echo '<span class="breadcrumb-current">' . __('قاموس المصطلحات', 'linkawy') . '</span>';
    } elseif (is_singular('resources')) {
        echo $separator;
        echo '<a href="' . esc_url(get_post_type_archive_link('resources')) . '">' . __('الموارد', 'linkawy') . '</a>';
        echo $separator;
        $types = get_the_terms(get_the_ID(), 'resource_type');
        if ($types && !is_wp_error($types)) {
            $term_link = get_term_link($types[0]);
            if (!is_wp_error($term_link)) {
                echo '<a href="' . esc_url($term_link) . '">' . esc_html($types[0]->name) . '</a>';
            } else {
                echo '<span class="breadcrumb-current">' . esc_html($types[0]->name) . '</span>';
            }
        }
    } elseif (is_post_type_archive('resources')) {
        echo $separator;
        echo '<span class="breadcrumb-current">' . __('الموارد', 'linkawy') . '</span>';
    } elseif (is_tax('resource_type')) {
        echo $separator;
        echo '<a href="' . esc_url(get_post_type_archive_link('resources')) . '">' . __('الموارد', 'linkawy') . '</a>';
        echo $separator;
        echo '<span class="breadcrumb-current">' . esc_html(get_queried_object()->name) . '</span>';
    } elseif (is_singular('prompts')) {
        echo $separator;
        echo '<a href="' . esc_url(get_post_type_archive_link('prompts')) . '">' . __('أوامر الذكاء الاصطناعي', 'linkawy') . '</a>';
    } elseif (is_post_type_archive('prompts')) {
        echo $separator;
        echo '<span class="breadcrumb-current">' . __('أوامر الذكاء الاصطناعي', 'linkawy') . '</span>';
    } elseif (is_tax('prompt_type')) {
        echo $separator;
        echo '<a href="' . esc_url(get_post_type_archive_link('prompts')) . '">' . __('أوامر الذكاء الاصطناعي', 'linkawy') . '</a>';
        echo $separator;
        echo '<span class="breadcrumb-current">' . esc_html(get_queried_object()->name) . '</span>';
    } elseif (is_tax('prompt_tag')) {
        echo $separator;
        echo '<a href="' . esc_url(get_post_type_archive_link('prompts')) . '">' . __('أوامر الذكاء الاصطناعي', 'linkawy') . '</a>';
        echo $separator;
        echo '<span class="breadcrumb-current">' . esc_html(get_queried_object()->name) . '</span>';
    } elseif (is_home()) {
        echo $separator;
        echo '<span class="breadcrumb-current">' . __('المدونة', 'linkawy') . '</span>';
    } elseif (is_category()) {
        echo $separator;
        echo '<a href="' . esc_url(get_permalink(get_option('page_for_posts'))) . '">' . __('المدونة', 'linkawy') . '</a>';
        echo $separator;
        echo '<span class="breadcrumb-current">' . single_cat_title('', false) . '</span>';
    } elseif (is_tag()) {
        echo $separator;
        echo '<a href="' . esc_url(get_permalink(get_option('page_for_posts'))) . '">' . __('المدونة', 'linkawy') . '</a>';
        echo $separator;
        echo '<span class="breadcrumb-current">' . single_tag_title('', false) . '</span>';
    } elseif (is_search()) {
        echo $separator;
        echo '<span class="breadcrumb-current">' . __('نتائج البحث', 'linkawy') . '</span>';
    } elseif (is_404()) {
        echo $separator;
        echo '<span class="breadcrumb-current">' . __('صفحة غير موجودة', 'linkawy') . '</span>';
    } elseif (is_page()) {
        echo $separator;
        echo '<span class="breadcrumb-current">' . get_the_title() . '</span>';
    }

    echo '</nav>';
}

/**
 * Count words accurately for Arabic/Unicode text
 * 
 * @param string $content The content to count words in
 * @return int Word count
 */
function linkawy_count_words_ar($content) {
    // Remove shortcodes first [gallery], [contact-form], etc.
    $text = strip_shortcodes($content);
    
    // Remove HTML tags properly for WordPress content
    $text = wp_strip_all_tags($text, true);
    
    // Decode HTML entities (e.g., &amp; → &)
    $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    
    // Normalize whitespace
    $text = preg_replace('/\s+/u', ' ', trim($text));
    
    if (empty($text)) {
        return 0;
    }
    
    // Count words using Unicode pattern (supports Arabic, English, numbers)
    // \p{L} = any letter in any language
    // \p{N} = any numeric character
    preg_match_all('/[\p{L}\p{N}]+/u', $text, $matches);
    
    return count($matches[0]);
}

/**
 * Calculate reading time
 * 
 * Uses Unicode-aware word counting for accurate Arabic text measurement.
 * Reading speed is filterable via 'linkawy_reading_wpm' filter.
 * 
 * @param int|null $post_id Post ID (optional, defaults to current post)
 * @return string Formatted reading time string
 */
function linkawy_reading_time($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $content = get_post_field('post_content', $post_id);
    
    // Use Unicode-aware word counting for Arabic
    $word_count = linkawy_count_words_ar($content);
    
    // Reading speed: 180 WPM for SEO/technical Arabic content (filterable)
    $wpm = apply_filters('linkawy_reading_wpm', 180);
    
    // Calculate minutes (minimum 1 minute)
    $reading_time = (int) ceil(max(1, $word_count) / $wpm);
    if ($reading_time < 1) {
        $reading_time = 1;
    }

    // Arabic grammar rules for reading time
    if ($reading_time === 1) {
        return 'دقيقة واحدة قراءة';
    } elseif ($reading_time === 2) {
        return 'دقيقتين قراءة';
    } elseif ($reading_time <= 10) {
        return sprintf('%d دقائق قراءة', $reading_time);
    } else {
        return sprintf('%d دقيقة قراءة', $reading_time);
    }
}

/**
 * Get author ID for a post (uses WordPress default author)
 */
function linkawy_get_original_author_id($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    return absint(get_post_field('post_author', $post_id));
}

/**
 * Get author name for a post (uses WordPress default author)
 */
function linkawy_get_original_author_name($post_id = null) {
    $author_id = linkawy_get_original_author_id($post_id);
    $author = get_userdata($author_id);
    
    if ($author) {
        return $author->display_name;
    }
    
    return '';
}

/**
 * Display post meta
 */
function linkawy_post_meta() {
    // Get original author
    $author_id = linkawy_get_original_author_id();
    $original_author_name = linkawy_get_original_author_name();
    
    // Get reviewer - first try ID, then fallback to name
    $reviewer_id = get_post_meta(get_the_ID(), '_post_reviewer_id', true);
    $reviewer_name = '';
    
    if ($reviewer_id) {
        $reviewer_user = get_userdata($reviewer_id);
        if ($reviewer_user) {
            $reviewer_name = $reviewer_user->display_name;
        }
    }
    
    // Fallback to old meta field
    if (empty($reviewer_name)) {
        $reviewer_name = get_post_meta(get_the_ID(), '_post_reviewer', true);
    }
    ?>
    <div class="article-meta">
        <!-- Author Row -->
        <div class="meta-author-row">
            <?php echo linkawy_get_author_avatar_img($author_id, 40, 'meta-author-avatar'); ?>
            <span class="meta-author-info">
                <span class="meta-author-name"><?php echo esc_html($original_author_name); ?></span>
                <?php if ($reviewer_name) : ?>
                    <span class="meta-separator">|</span>
                    <span class="meta-reviewer"><?php _e('مراجعة', 'linkawy'); ?> <?php echo esc_html($reviewer_name); ?></span>
                <?php endif; ?>
            </span>
        </div>
        
        <!-- Info Row -->
        <div class="meta-info-row">
            <span class="meta-date">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                <?php echo get_the_modified_date('j F Y'); ?>
            </span>
            <span class="meta-reading-time">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                <?php echo linkawy_reading_time(); ?>
            </span>
        </div>
    </div>
    <?php
}

/**
 * Get author avatar with fallback
 * @deprecated Use linkawy_get_author_avatar_img() instead for responsive images
 */
function linkawy_get_author_avatar($size = 80, $author_id = null) {
    // Use the new responsive function
    return linkawy_get_author_avatar_img($author_id, $size, 'author-avatar');
}

/**
 * Check if user has a real gravatar
 */
function linkawy_validate_gravatar($user_id) {
    $email = get_the_author_meta('user_email', $user_id);
    $hash = md5(strtolower(trim($email)));
    $uri = 'https://www.gravatar.com/avatar/' . $hash . '?d=404';
    
    $response = wp_cache_get('gravatar_' . $hash);
    
    if ($response === false) {
        $headers = @get_headers($uri);
        $response = is_array($headers) && preg_match("|200|", $headers[0]) ? 'yes' : 'no';
        wp_cache_set('gravatar_' . $hash, $response, '', 3600);
    }
    
    return $response === 'yes';
}

/**
 * Display blog card meta
 */
function linkawy_card_meta() {
    ?>
    <div class="blog-card-meta">
        <span><i class="far fa-clock"></i> <?php echo linkawy_reading_time(); ?></span>
        <span><i class="far fa-user"></i> <?php the_author(); ?></span>
    </div>
    <?php
}

/**
 * Get glossary synonyms
 */
function linkawy_get_glossary_synonyms($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    return get_post_meta($post_id, '_glossary_synonyms', true);
}

/**
 * Get glossary reviewer info (uses post author)
 */
function linkawy_get_glossary_reviewer($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $author_id = get_post_field('post_author', $post_id);
    $author_data = get_userdata($author_id);
    
    if (!$author_data) {
        return array(
            'name'      => '',
            'avatar'    => '',
            'author_id' => 0,
        );
    }

    return array(
        'name'      => $author_data->display_name,
        'avatar'    => linkawy_get_author_avatar_url($author_id, 32),
        'author_id' => $author_id,
    );
}

/**
 * Display glossary reviewer
 */
function linkawy_glossary_reviewer() {
    $reviewer = linkawy_get_glossary_reviewer();
    
    if (empty($reviewer['name'])) {
        return;
    }

    ?>
    <div class="glossary-reviewer">
        <span class="reviewer-label"><?php _e('مراجعة وتدقيق:', 'linkawy'); ?></span>
        <?php echo linkawy_get_author_avatar_img($reviewer['author_id'], 32, 'reviewer-avatar'); ?>
        <span class="reviewer-name"><?php echo esc_html($reviewer['name']); ?></span>
    </div>
    <?php
}

/**
 * Get related posts
 */
function linkawy_get_related_posts($post_id = null, $count = 4) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $categories = get_the_category($post_id);
    $category_ids = array();
    
    if ($categories) {
        foreach ($categories as $category) {
            $category_ids[] = $category->term_id;
        }
    }

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $count,
        'post__not_in'   => array($post_id),
        'category__in'   => $category_ids,
        'orderby'        => 'rand',
    );

    return new WP_Query($args);
}

/**
 * Get related glossary terms
 */
function linkawy_get_related_glossary($post_id = null, $count = 4) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $args = array(
        'post_type'      => 'glossary',
        'posts_per_page' => $count,
        'post__not_in'   => array($post_id),
        'orderby'        => 'rand',
    );

    return new WP_Query($args);
}

/**
 * Get adjacent glossary terms (prev/next)
 */
function linkawy_get_adjacent_glossary($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $prev = get_adjacent_post(false, '', true);
    $next = get_adjacent_post(false, '', false);

    return array(
        'prev' => $prev,
        'next' => $next,
    );
}

/**
 * Display share buttons
 */
function linkawy_share_buttons() {
    $url = urlencode(get_permalink());
    $title = urlencode(get_the_title());
    ?>
    <div class="share-buttons">
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $title; ?>" 
           class="share-btn linkedin" aria-label="LinkedIn" target="_blank" rel="noopener">
            <i class="fab fa-linkedin-in"></i>
        </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" 
           class="share-btn facebook" aria-label="Facebook" target="_blank" rel="noopener">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title; ?>" 
           class="share-btn x" aria-label="X" target="_blank" rel="noopener">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
            </svg>
        </a>
        <a href="mailto:?subject=<?php echo $title; ?>&body=<?php echo $url; ?>" 
           class="share-btn email" aria-label="Email">
            <i class="fas fa-envelope"></i>
        </a>
    </div>
    <?php
}

/**
 * Get logo URL
 */
function linkawy_get_logo_url() {
    if (has_custom_logo()) {
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        return $logo[0];
    }
    return LINKAWY_URI . '/assets/images/logo.svg';
}

/**
 * Display pagination
 */
function linkawy_pagination() {
    global $wp_query;

    if ($wp_query->max_num_pages <= 1) {
        return;
    }

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);

    echo '<div class="pagination">';

    // Previous page link
    if ($paged > 1) {
        echo '<a href="' . get_pagenum_link($paged - 1) . '" class="page-link"><i class="fas fa-chevron-right"></i></a>';
    }

    // Page numbers
    for ($i = 1; $i <= $max; $i++) {
        if ($i == $paged) {
            echo '<span class="page-link active">' . $i . '</span>';
        } else {
            echo '<a href="' . get_pagenum_link($i) . '" class="page-link">' . $i . '</a>';
        }
    }

    // Next page link
    if ($paged < $max) {
        echo '<a href="' . get_pagenum_link($paged + 1) . '" class="page-link"><i class="fas fa-chevron-left"></i></a>';
    }

    echo '</div>';
}

/**
 * =====================================================
 * Server-Side Table of Contents (TOC) Functions
 * Better for SEO - generates HTML on server
 * =====================================================
 */

/**
 * Convert heading text to URL-friendly slug (supports Arabic)
 */
function linkawy_heading_to_slug($text) {
    // Trim whitespace
    $slug = trim($text);
    
    // Remove Arabic and English punctuation (؟ ? ! ؛ : etc.)
    $slug = preg_replace('/[؟?!؛;:،,\.\'\""\'\(\)\[\]«»]/u', '', $slug);
    
    // Replace spaces and special whitespace with hyphens
    $slug = preg_replace('/[\s\x{00A0}]+/u', '-', $slug);
    
    // Keep only Arabic letters, Latin letters, numbers, and hyphens
    $slug = preg_replace('/[^\p{Arabic}a-zA-Z0-9\-]/u', '', $slug);
    
    // Remove multiple consecutive hyphens
    $slug = preg_replace('/-+/', '-', $slug);
    
    // Remove leading/trailing hyphens
    $slug = trim($slug, '-');
    
    return $slug;
}

/**
 * Extract H2 headings from content and add IDs
 * Returns array with modified content and headings list
 */
function linkawy_process_content_for_toc($content) {
    // Return early if no content
    if (empty($content)) {
        return array(
            'content' => $content,
            'headings' => array(),
        );
    }
    
    // Use DOMDocument to parse HTML
    $dom = new DOMDocument('1.0', 'UTF-8');
    
    // Suppress warnings for HTML5 tags and preserve encoding
    libxml_use_internal_errors(true);
    
    // Wrap content with proper UTF-8 declaration (without converting to HTML-ENTITIES to preserve Arabic text)
    $wrapped_content = '<?xml encoding="UTF-8"><html><head><meta charset="UTF-8"></head><body>' . $content . '</body></html>';
    $dom->loadHTML($wrapped_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    
    libxml_clear_errors();
    
    // Find all H2 elements
    $headings = array();
    $h2_elements = $dom->getElementsByTagName('h2');
    $used_ids = array(); // Track used IDs to avoid duplicates
    
    $index = 1;
    foreach ($h2_elements as $h2) {
        // Skip FAQ questions (they have class 'faq-question')
        // Skip References title (they have class 'references-title')
        $class = $h2->getAttribute('class');
        if (strpos($class, 'faq-question') !== false || strpos($class, 'references-title') !== false) {
            continue;
        }
        
        // Get the text content
        $text = trim($h2->textContent);
        
        // Skip empty headings
        if (empty($text)) {
            continue;
        }
        
        // Generate slug-based ID from heading text (SEO-friendly Arabic URLs)
        $id = linkawy_heading_to_slug($text);
        
        // Fallback to section-X if slug is empty
        if (empty($id)) {
            $id = 'section-' . $index;
        }
        
        // Ensure unique IDs
        $original_id = $id;
        $suffix = 2;
        while (isset($used_ids[$id])) {
            $id = $original_id . '-' . $suffix;
            $suffix++;
        }
        $used_ids[$id] = true;
        
        // Set the ID attribute on the heading
        $h2->setAttribute('id', $id);
        
        // Store heading info
        $headings[] = array(
            'id' => $id,
            'text' => $text,
        );
        
        $index++;
    }
    
    // Get the modified content (body innerHTML only)
    $body = $dom->getElementsByTagName('body')->item(0);
    $modified_content = '';
    
    if ($body) {
        foreach ($body->childNodes as $child) {
            $modified_content .= $dom->saveHTML($child);
        }
    }
    
    // Decode HTML numeric entities to preserve Arabic text in JSON-LD schema
    $modified_content = preg_replace_callback(
        '/&#(\d+);/',
        function($m) {
            return mb_chr((int)$m[1], 'UTF-8');
        },
        $modified_content
    );
    
    return array(
        'content' => $modified_content,
        'headings' => $headings,
    );
}

/**
 * Generate desktop TOC HTML
 */
function linkawy_generate_toc_html($headings) {
    if (empty($headings)) {
        return '';
    }
    
    $html = '';
    foreach ($headings as $index => $heading) {
        // First 3 items get 'visible' class
        $visible_class = ($index < 3) ? ' class="visible"' : '';
        $active_class = ($index === 0) ? ' class="active"' : '';
        
        $html .= '<li' . $visible_class . '>';
        $html .= '<a href="#' . esc_attr($heading['id']) . '"' . $active_class . '>' . esc_html($heading['text']) . '</a>';
        $html .= '</li>';
    }
    
    return $html;
}

/**
 * Generate mobile TOC HTML
 */
function linkawy_generate_mobile_toc_html($headings) {
    if (empty($headings)) {
        return '';
    }
    
    $html = '';
    foreach ($headings as $index => $heading) {
        $active_class = ($index === 0) ? ' class="active"' : '';
        
        $html .= '<li class="mobile-toc__item">';
        $html .= '<a href="#' . esc_attr($heading['id']) . '"' . $active_class . '>' . esc_html($heading['text']) . '</a>';
        $html .= '</li>';
    }
    
    return $html;
}

/**
 * Get TOC data for the current post
 * Call this once at the beginning of single.php
 */
function linkawy_get_toc_data() {
    global $linkawy_toc_data;
    
    // Return cached data if already processed
    if (isset($linkawy_toc_data)) {
        return $linkawy_toc_data;
    }
    
    // Get the raw post content
    $content = get_the_content();
    
    // Apply content filters (shortcodes, blocks, etc.) but not the_content filter
    $content = apply_filters('the_content', $content);
    
    // Process content for TOC
    $result = linkawy_process_content_for_toc($content);
    
    // Cache the data
    $linkawy_toc_data = array(
        'content' => $result['content'],
        'headings' => $result['headings'],
        'desktop_toc' => linkawy_generate_toc_html($result['headings']),
        'mobile_toc' => linkawy_generate_mobile_toc_html($result['headings']),
        'has_toc' => !empty($result['headings']),
        'count' => count($result['headings']),
    );
    
    return $linkawy_toc_data;
}

/**
 * Display the processed content with TOC IDs
 */
function linkawy_the_content_with_toc() {
    $toc_data = linkawy_get_toc_data();
    echo $toc_data['content'];
}

/**
 * Display the desktop TOC list items
 */
function linkawy_the_toc() {
    $toc_data = linkawy_get_toc_data();
    echo $toc_data['desktop_toc'];
}

/**
 * Display the mobile TOC list items
 */
function linkawy_the_mobile_toc() {
    $toc_data = linkawy_get_toc_data();
    echo $toc_data['mobile_toc'];
}

/**
 * Check if post has TOC headings
 */
function linkawy_has_toc() {
    $toc_data = linkawy_get_toc_data();
    return $toc_data['has_toc'];
}

/**
 * Get TOC headings count
 */
function linkawy_toc_count() {
    $toc_data = linkawy_get_toc_data();
    return $toc_data['count'];
}

/**
 * =====================================================
 * Shortcodes
 * =====================================================
 */

/**
 * CTA Box Shortcode
 * 
 * Usage: [cta_box title="العنوان" text="النص" button="نص الزر" link="الرابط" color="orange|dark|purple|teal|blue"]
 * 
 * Colors:
 * - orange (default): Orange gradient
 * - dark: Dark/Black gradient
 * - purple: Purple gradient
 * - teal: Teal/Mint gradient
 * - blue: Blue/Indigo gradient
 * 
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function linkawy_cta_box_shortcode($atts) {
    $atts = shortcode_atts(array(
        'title'  => __('هل تحتاج مساعدة في تحسين موقعك؟', 'linkawy'),
        'text'   => __('فريقنا من خبراء السيو جاهز لمساعدتك في تحقيق أهدافك.', 'linkawy'),
        'button' => __('احجز استشارة مجانية', 'linkawy'),
        'link'   => '#',
        'color'  => 'orange',
    ), $atts, 'cta_box');
    
    // Determine color class
    $color_class = '';
    $valid_colors = array('orange', 'dark', 'purple', 'teal', 'blue');
    if (in_array($atts['color'], $valid_colors) && $atts['color'] !== 'orange') {
        $color_class = ' cta-' . $atts['color'];
    }
    
    $output = '<div class="article-cta-box' . $color_class . '">';
    $output .= '<span class="article-cta-title">' . esc_html($atts['title']) . '</span>';
    $output .= '<p>' . esc_html($atts['text']) . '</p>';
    $output .= '<a href="' . esc_url($atts['link']) . '" class="article-cta-btn">' . esc_html($atts['button']) . ' <i class="fas fa-arrow-left"></i></a>';
    $output .= '</div>';
    
    return $output;
}
add_shortcode('cta_box', 'linkawy_cta_box_shortcode');

/**
 * AI Prompt Shortcode
 * 
 * Usage: [prompt]Your AI prompt text here...[/prompt]
 * 
 * @param array $atts Shortcode attributes
 * @param string $content The prompt content
 * @return string HTML output
 */
function linkawy_prompt_shortcode($atts, $content = null) {
    if (empty($content)) {
        return '';
    }
    
    $output = '<div class="ai-prompt-box">';
    $output .= '<div class="ai-prompt-header">';
    $output .= '<span class="ai-prompt-label"><i class="fas fa-sparkles"></i> AI Prompt</span>';
    $output .= '<button type="button" class="ai-prompt-copy" title="' . esc_attr__('نسخ', 'linkawy') . '"><i class="far fa-copy"></i></button>';
    $output .= '</div>';
    $output .= '<div class="ai-prompt-content">' . wp_kses_post(wpautop($content)) . '</div>';
    $output .= '</div>';
    
    return $output;
}
add_shortcode('prompt', 'linkawy_prompt_shortcode');

/**
 * References Section Shortcode
 * Usage: [references]
 * 1. Reference text here
 * 2. Another reference
 * [/references]
 */
function linkawy_references_shortcode($atts, $content = null) {
    if (empty($content)) {
        return '';
    }
    
    $atts = shortcode_atts(array(
        'title' => __('المراجع', 'linkawy'),
        'collapsed' => 'false'
    ), $atts);
    
    $collapsed_class = ($atts['collapsed'] === 'true') ? ' collapsed' : '';
    $toggle_text = ($atts['collapsed'] === 'true') ? '[+]' : '[-]';
    
    // Process the content - convert numbered lines to list items
    $lines = explode("\n", trim($content));
    $list_items = '';
    
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line)) continue;
        
        // Remove leading numbers like "1." or "1-" or "1)"
        $line = preg_replace('/^\d+[\.\-\)]\s*/', '', $line);
        
        if (!empty($line)) {
            $list_items .= '<li>' . wp_kses_post($line) . '</li>';
        }
    }
    
    if (empty($list_items)) {
        return '';
    }
    
    $output = '<div class="references-section" id="references">';
    $output .= '<div class="references-header" onclick="this.parentElement.querySelector(\'.references-content\').classList.toggle(\'collapsed\'); this.querySelector(\'.references-toggle\').textContent = this.querySelector(\'.references-toggle\').textContent === \'[-]\' ? \'[+]\' : \'[-]\';">';
    $output .= '<h2 class="references-title">' . esc_html($atts['title']) . '</h2>';
    $output .= '<button type="button" class="references-toggle" aria-label="' . esc_attr__('طي/توسيع المراجع', 'linkawy') . '">' . $toggle_text . '</button>';
    $output .= '</div>';
    $output .= '<div class="references-content' . $collapsed_class . '">';
    $output .= '<ol class="references-list">' . $list_items . '</ol>';
    $output .= '</div>';
    $output .= '</div>';
    
    return $output;
}
add_shortcode('references', 'linkawy_references_shortcode');
add_shortcode('مراجع', 'linkawy_references_shortcode');

/**
 * =================================================================
 * SCHEMA.ORG STRUCTURED DATA
 * =================================================================
 */

/**
 * Generate Article Schema for single posts
 * Enhanced for E-E-A-T and AI Search / SGE
 * 
 * @param int $post_id Post ID (optional, defaults to current post)
 * @return array Article schema data
 */
function linkawy_get_article_schema($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $post = get_post($post_id);
    if (!$post) {
        return array();
    }
    
    // Get author info
    $author_id = linkawy_get_original_author_id();
    // Use nickname for Schema (e.g., "Ali Atwa") instead of display_name
    $author_name = get_the_author_meta('nickname', $author_id);
    if (empty($author_name)) {
        $author_name = linkawy_get_original_author_name(); // Fallback to display_name
    }
    $author_url = get_author_posts_url($author_id);
    $author_avatar = linkawy_get_author_avatar_url($author_id, 200);
    $author_bio = get_the_author_meta('description', $author_id);
    
    // Get author social links for sameAs
    $author_social = linkawy_get_author_social_links($author_id);
    $same_as = array();
    if (!empty($author_social['linkedin'])) {
        $same_as[] = $author_social['linkedin'];
    }
    if (!empty($author_social['twitter'])) {
        $same_as[] = $author_social['twitter'];
    }
    if (!empty($author_social['facebook'])) {
        $same_as[] = $author_social['facebook'];
    }
    if (!empty($author_social['instagram'])) {
        $same_as[] = $author_social['instagram'];
    }
    
    // Get featured image
    $thumbnail_id = get_post_thumbnail_id($post_id);
    $thumbnail_url = '';
    $thumbnail_width = 1200;
    $thumbnail_height = 675;
    
    if ($thumbnail_id) {
        $thumbnail_data = wp_get_attachment_image_src($thumbnail_id, 'linkawy-featured');
        if ($thumbnail_data) {
            $thumbnail_url = $thumbnail_data[0];
            $thumbnail_width = $thumbnail_data[1];
            $thumbnail_height = $thumbnail_data[2];
        }
    }
    
    // Fallback image if no featured image
    if (!$thumbnail_url) {
        $thumbnail_url = LINKAWY_URI . '/assets/images/default-og.jpg';
    }
    
    // Get categories
    $categories = get_the_category($post_id);
    $category_names = array();
    $primary_category = null;
    if ($categories) {
        foreach ($categories as $cat) {
            $category_names[] = $cat->name;
        }
        $primary_category = $categories[0];
    }
    
    // Calculate word count using Arabic-aware function (same as frontend)
    $word_count = linkawy_count_words_ar($post->post_content);
    
    // Reading speed: 180 WPM (same as linkawy_reading_time function)
    $wpm = apply_filters('linkawy_reading_wpm', 180);
    $reading_time_minutes = max(1, (int) ceil($word_count / $wpm));
    
    // ISO 8601 duration format for Schema
    $time_required = 'PT' . $reading_time_minutes . 'M';
    
    // Build enhanced Author schema (Person) for E-E-A-T
    $author_schema = array(
        '@type' => 'Person',
        'name' => $author_name,
        'url' => $author_url,
        'image' => array(
            '@type' => 'ImageObject',
            'url' => $author_avatar,
            'width' => 200,
            'height' => 200,
        ),
    );
    
    // Add author bio/description if available
    if (!empty($author_bio)) {
        $author_schema['description'] = wp_strip_all_tags($author_bio);
    }
    
    // Add author job title
    $author_schema['jobTitle'] = __('متخصص SEO وتسويق رقمي', 'linkawy');
    
    // Add sameAs (social profiles) for author - important for E-E-A-T
    if (!empty($same_as)) {
        $author_schema['sameAs'] = $same_as;
    }
    
    // Add author's affiliation with the organization
    $author_schema['worksFor'] = array(
        '@type' => 'Organization',
        'name' => 'Linkawy',
        'url' => home_url('/'),
    );
    
    // Build Publisher/Organization schema
    $publisher_schema = array(
        '@type' => 'Organization',
        'name' => 'لينكاوي',
        'alternateName' => 'Linkawy',
        'url' => home_url('/'),
        'logo' => array(
            '@type' => 'ImageObject',
            'url' => linkawy_get_logo_url(),
            'width' => 300,
            'height' => 60,
        ),
        'sameAs' => array(
            'https://www.linkedin.com/company/linkawy',
            'https://www.facebook.com/linkawy',
            'https://twitter.com/linkawy',
        ),
    );
    
    $permalink = get_permalink($post_id);
    
    // Build main schema
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        '@id' => $permalink . '#article', // ID for linking with WebPage
        'headline' => get_the_title($post_id),
        'description' => wp_strip_all_tags(get_the_excerpt($post_id)),
        'image' => array(
            '@type' => 'ImageObject',
            '@id' => $permalink . '#primaryimage',
            'url' => $thumbnail_url,
            'width' => $thumbnail_width,
            'height' => $thumbnail_height,
        ),
        'datePublished' => get_the_date('c', $post_id),
        'dateModified' => get_the_modified_date('c', $post_id),
        'author' => $author_schema,
        'publisher' => $publisher_schema,
        'mainEntityOfPage' => array(
            '@type' => 'WebPage',
            '@id' => $permalink . '#webpage',
        ),
        'wordCount' => $word_count,
        'timeRequired' => $time_required, // ISO 8601 duration for AI Search
        'inLanguage' => 'ar',
    );
    
    // Add articleSection (category)
    if (!empty($category_names)) {
        $schema['articleSection'] = $category_names[0];
        $schema['keywords'] = implode(', ', $category_names);
    }
    
    // Add "about" - links article to broader topic context (important for AI/SGE)
    if ($primary_category) {
        $schema['about'] = array(
            '@type' => 'Thing',
            'name' => $primary_category->name,
            'url' => get_category_link($primary_category->term_id),
        );
    }
    
    // Add "mentions" from post tags (important for semantic understanding)
    $tags = get_the_tags($post_id);
    if ($tags && !is_wp_error($tags)) {
        $mentions = array();
        foreach ($tags as $tag) {
            $mentions[] = array(
                '@type' => 'Thing',
                'name' => $tag->name,
                'url' => get_tag_link($tag->term_id),
            );
        }
        if (!empty($mentions)) {
            $schema['mentions'] = $mentions;
        }
    }
    
    // Add "hasPart" - auto-extract sections from H2 headings (useful for AI/SGE)
    $content = $post->post_content;
    if (preg_match_all('/<h2[^>]*>(.*?)<\/h2>/iu', $content, $h2_matches)) {
        $has_part = array();
        foreach ($h2_matches[1] as $heading) {
            $clean_heading = wp_strip_all_tags($heading);
            // Skip empty headings
            if (!empty(trim($clean_heading))) {
                // Generate anchor slug from heading (Arabic-friendly)
                $slug = sanitize_title($clean_heading);
                // If sanitize_title fails for Arabic, use URL-encoded version
                if (empty($slug)) {
                    $slug = urlencode($clean_heading);
                }
                
                $has_part[] = array(
                    '@type' => 'WebPageElement',
                    '@id' => $permalink . '#' . $slug,
                    'name' => $clean_heading,
                );
            }
        }
        if (!empty($has_part)) {
            $schema['hasPart'] = $has_part;
        }
    }
    
    // Add Speakable specification (for AI assistants & voice search)
    $schema['speakable'] = array(
        '@type' => 'SpeakableSpecification',
        'cssSelector' => array(
            '.article-title',                      // H1 - العنوان الرئيسي
            '.article-content > p:first-of-type',  // أول فقرة بعد H1
        ),
    );
    
    // Add isAccessibleForFree for content accessibility
    $schema['isAccessibleForFree'] = true;
    
    return $schema;
}

/**
 * Generate BreadcrumbList Schema
 * 
 * @return array BreadcrumbList schema data
 */
function linkawy_get_breadcrumb_schema() {
    $items = array();
    $position = 1;
    
    // Home
    $items[] = array(
        '@type' => 'ListItem',
        'position' => $position++,
        'name' => __('الرئيسية', 'linkawy'),
        'item' => home_url('/'),
    );
    
    if (is_singular('post')) {
        // Blog page
        $blog_page_id = get_option('page_for_posts');
        $blog_url = $blog_page_id ? get_permalink($blog_page_id) : home_url('/blog/');
        
        $items[] = array(
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => __('المدونة', 'linkawy'),
            'item' => $blog_url,
        );
        
        // Category
        $categories = get_the_category();
        if ($categories) {
            $items[] = array(
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $categories[0]->name,
                'item' => get_category_link($categories[0]->term_id),
            );
        }
        
        // Current post (without item URL as per Google guidelines)
        $items[] = array(
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => get_the_title(),
        );
        
    } elseif (is_singular('glossary')) {
        // Glossary archive
        $items[] = array(
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => __('المصطلحات', 'linkawy'),
            'item' => get_post_type_archive_link('glossary'),
        );
        
        // Current term
        $items[] = array(
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => get_the_title(),
        );
    }
    
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        '@id' => get_permalink() . '#breadcrumb', // ID for linking with WebPage
        'itemListElement' => $items,
    );
    
    return $schema;
}

/**
 * Generate WebPage Schema
 * Links the page to the Article as mainEntity
 * 
 * @return array WebPage schema data
 */
function linkawy_get_webpage_schema() {
    $post_id = get_the_ID();
    $permalink = get_permalink($post_id);
    
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        '@id' => $permalink . '#webpage',
        'url' => $permalink,
        'name' => get_the_title($post_id),
        'description' => wp_strip_all_tags(get_the_excerpt($post_id)),
        'isPartOf' => array(
            '@type' => 'WebSite',
            '@id' => home_url('/') . '#website',
            'name' => 'لينكاوي',
            'alternateName' => 'Linkawy',
            'url' => home_url('/'),
        ),
        'inLanguage' => 'ar',
        'datePublished' => get_the_date('c', $post_id),
        'dateModified' => get_the_modified_date('c', $post_id),
        // Link to Article as mainEntity (important for semantic understanding)
        'mainEntity' => array(
            '@type' => 'Article',
            '@id' => $permalink . '#article',
        ),
        // Primary image
        'primaryImageOfPage' => array(
            '@type' => 'ImageObject',
            '@id' => $permalink . '#primaryimage',
        ),
    );
    
    // Add breadcrumb reference
    $schema['breadcrumb'] = array(
        '@type' => 'BreadcrumbList',
        '@id' => $permalink . '#breadcrumb',
    );
    
    return $schema;
}

/**
 * Output all schemas for single post pages
 * Call this function in single.php before get_header() or in wp_head
 * 
 * Schema hierarchy:
 * - WebPage (contains the page)
 *   - mainEntity -> Article
 *   - breadcrumb -> BreadcrumbList
 * - Article (the content)
 *   - mainEntityOfPage -> WebPage
 *   - about -> Category (Thing)
 *   - mentions -> Tags (Things)
 * - BreadcrumbList (navigation)
 */
function linkawy_output_article_schemas() {
    if (!is_singular('post')) {
        return;
    }
    
    $schemas = array();
    
    // WebPage Schema (links everything together)
    $webpage_schema = linkawy_get_webpage_schema();
    if (!empty($webpage_schema)) {
        $schemas[] = $webpage_schema;
    }
    
    // Article Schema (main content)
    $article_schema = linkawy_get_article_schema();
    if (!empty($article_schema)) {
        $schemas[] = $article_schema;
    }
    
    // Breadcrumb Schema (navigation)
    $breadcrumb_schema = linkawy_get_breadcrumb_schema();
    if (!empty($breadcrumb_schema)) {
        $schemas[] = $breadcrumb_schema;
    }
    
    // Output schemas
    foreach ($schemas as $schema) {
        echo '<script type="application/ld+json">';
        echo wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        echo '</script>' . "\n";
    }
}

/**
 * Output schemas for glossary pages
 */
function linkawy_output_glossary_schemas() {
    if (!is_singular('glossary')) {
        return;
    }
    
    $post_id = get_the_ID();
    $post = get_post($post_id);
    
    // DefinedTerm Schema for glossary
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'DefinedTerm',
        'name' => get_the_title($post_id),
        'description' => wp_strip_all_tags(get_the_excerpt($post_id)),
        'url' => get_permalink($post_id),
        'inDefinedTermSet' => array(
            '@type' => 'DefinedTermSet',
            'name' => __('قاموس المصطلحات التقنية', 'linkawy'),
            'url' => get_post_type_archive_link('glossary'),
        ),
    );
    
    // Get synonyms if available
    $synonyms = get_post_meta($post_id, '_glossary_synonyms', true);
    if ($synonyms) {
        $schema['termCode'] = $synonyms;
    }
    
    echo '<script type="application/ld+json">';
    echo wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    echo '</script>' . "\n";
    
    // Breadcrumb Schema
    $breadcrumb_schema = linkawy_get_breadcrumb_schema();
    if (!empty($breadcrumb_schema)) {
        echo '<script type="application/ld+json">';
        echo wp_json_encode($breadcrumb_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        echo '</script>' . "\n";
    }
}

/**
 * Auto-output schemas in wp_head
 */
function linkawy_auto_output_schemas() {
    if (is_singular('post')) {
        linkawy_output_article_schemas();
    } elseif (is_singular('glossary')) {
        linkawy_output_glossary_schemas();
    }
}
add_action('wp_head', 'linkawy_auto_output_schemas', 5);
