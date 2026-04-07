<?php
/**
 * Template part for displaying a prompt card in archive and related prompts
 *
 * @package Linkawy
 */

$post_id   = get_the_ID();
$meta      = function_exists('linkawy_get_prompt_meta') ? linkawy_get_prompt_meta($post_id) : array();
$prompt_text = isset($meta['prompt_text']) ? $meta['prompt_text'] : '';
$normalized_prompt_text = trim(preg_replace('/\s+/u', ' ', wp_strip_all_tags((string) $prompt_text)));
$preview_max_chars = 900;
$preview = $normalized_prompt_text;
if (function_exists('mb_strlen') && function_exists('mb_substr')) {
    if (mb_strlen($normalized_prompt_text, 'UTF-8') > $preview_max_chars) {
        $preview = mb_substr($normalized_prompt_text, 0, $preview_max_chars, 'UTF-8') . '...';
    }
} elseif (strlen($normalized_prompt_text) > $preview_max_chars) {
    $preview = substr($normalized_prompt_text, 0, $preview_max_chars) . '...';
}
$platform  = isset($meta['platform']) ? $meta['platform'] : '';
$types     = get_the_terms($post_id, 'prompt_type');
$type_slug = '';
if ($types && !is_wp_error($types)) {
    $type_slug = $types[0]->slug;
}
$platform_class = $platform !== '' ? ' prompt-platform-' . sanitize_html_class(strtolower($platform)) : '';
?>

<article
    id="prompt-<?php the_ID(); ?>"
    <?php post_class('blog-card prompt-card prompt-card-clickable' . $platform_class); ?>
    data-prompt-type="<?php echo esc_attr($type_slug); ?>"
    data-permalink="<?php echo esc_url(get_permalink()); ?>"
    role="link"
    tabindex="0"
>
    <div class="blog-card-content">
        <h3 class="blog-card-title"><?php the_title(); ?></h3>
        <p class="blog-card-excerpt prompt-card-preview"><?php echo esc_html($preview); ?></p>
        <button
            type="button"
            class="prompt-copy-btn prompt-card-copy-btn"
            data-prompt-text="<?php echo esc_attr($prompt_text); ?>"
            data-copy-label="<?php esc_attr_e('نسخ', 'linkawy'); ?>"
            data-copied-label="<?php esc_attr_e('تم النسخ', 'linkawy'); ?>"
            aria-label="<?php esc_attr_e('نسخ', 'linkawy'); ?>"
        >
            <i class="far fa-copy" aria-hidden="true"></i>
            <span class="prompt-copy-btn-text"><?php esc_html_e('نسخ', 'linkawy'); ?></span>
        </button>
    </div>
</article>
