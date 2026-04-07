<?php
/**
 * Single Prompt Template
 *
 * Hero (same as resources: breadcrumbs, title, badge, subtitle, CTA) + prompt box, meta card, related.
 *
 * @package Linkawy
 */

get_header();

while (have_posts()) :
    the_post();
    $post_id = get_the_ID();
    $meta    = linkawy_get_prompt_meta($post_id);
    $prompt_content_locked = !empty($meta['content_lock']) && !linkawy_is_prompt_content_unlocked($post_id);
    $types       = get_the_terms($post_id, 'prompt_type');
    $type_name   = ($types && !is_wp_error($types)) ? $types[0]->name : '';
    $author_name = function_exists('linkawy_get_original_author_name') ? linkawy_get_original_author_name($post_id) : get_the_author();
    $description = !empty($meta['use_case']) ? $meta['use_case'] : get_the_excerpt();
    $tested_models = array();
    if ($types && !is_wp_error($types)) {
        foreach ($types as $type_term) {
            $icon_id = (int) get_term_meta($type_term->term_id, 'prompt_type_image', true);
            $icon_url = $icon_id ? wp_get_attachment_image_url($icon_id, 'thumbnail') : '';
            if (!$icon_url && $icon_id) {
                $icon_url = wp_get_attachment_url($icon_id);
            }
            $tested_models[] = array(
                'name' => $type_term->name,
                'icon' => $icon_url,
            );
        }
    }
    ?>
    <section class="service-hero resource-hero-saas prompt-hero-no-media prompts-resource-hero">
        <div class="resource-hero-bg-deco" aria-hidden="true"></div>
        <div class="container service-hero-inner">
            <div class="service-hero-content">
                <?php linkawy_breadcrumbs(); ?>
                <h1 class="service-hero-title"><?php the_title(); ?></h1>
                <?php if ($description !== '') : ?>
                    <p class="prompt-hero-subtitle"><?php echo nl2br(esc_html($description)); ?></p>
                <?php endif; ?>
                <?php if (!empty($tested_models)) : ?>
                    <div class="prompt-preview-tested-icons" aria-label="<?php esc_attr_e('تمت تجربته مع:', 'linkawy'); ?>">
                        <?php foreach ($tested_models as $model) : ?>
                            <?php if (!empty($model['icon'])) : ?>
                                <div class="prompt-tested-icon">
                                    <img src="<?php echo esc_url($model['icon']); ?>" alt="<?php echo esc_attr($model['name']); ?>" width="35" height="35" loading="lazy">
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="page-content-section prompt-single-wrap">
        <div class="container">
    <section class="prompt-single-main prompt-single-saas">
        <div class="prompt-single-layout">
            <aside class="prompt-single-sidebar">
                <div class="prompt-preview-card">
                    <div class="prompt-preview-icon" aria-hidden="true"><span>&lt;/&gt;</span></div>
                    <h2 class="prompt-page-title"><?php the_title(); ?></h2>
                    <p class="prompt-preview-meta">
                        <?php printf(/* translators: author name */ __('بواسطة %s', 'linkawy'), '<span class="prompt-preview-author">' . esc_html($author_name) . '</span>'); ?>
                        <span class="prompt-preview-sep">·</span>
                        <?php printf(/* translators: date */ __('آخر تحديث %s', 'linkawy'), '<time datetime="' . esc_attr(get_the_modified_date('c')) . '">' . esc_html(get_the_modified_date('F Y')) . '</time>'); ?>
                    </p>
                    <?php if (!empty($tested_models)) : ?>
                        <p class="prompt-preview-tested-label"><?php _e('تمت تجربته مع:', 'linkawy'); ?></p>
                        <div class="prompt-preview-tested-icons">
                            <?php foreach ($tested_models as $model) : ?>
                                <div class="prompt-tested-icon prompt-tested-pill">
                                    <?php if (!empty($model['icon'])) : ?>
                                        <img src="<?php echo esc_url($model['icon']); ?>" alt="<?php echo esc_attr($model['name']); ?>" width="35" height="35" loading="lazy">
                                    <?php endif; ?>
                                    <span class="prompt-tested-model"><?php echo esc_html($model['name']); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($meta['platform'])) : ?>
                        <span class="prompt-platform-badge"><?php echo esc_html($meta['platform']); ?></span>
                    <?php endif; ?>
                </div>
            </aside>

            <div class="prompt-single-content">
                <div class="prompt-box<?php echo $prompt_content_locked ? ' prompt-box--content-locked' : ''; ?>">
                    <span class="prompt-box-label"><?php _e('PROMPT', 'linkawy'); ?></span>
                    <div class="prompt-box-content-wrap">
                        <div class="prompt-box-content<?php echo $prompt_content_locked ? ' prompt-box-content--locked' : ''; ?>" id="prompt-copy-source">
                            <?php echo nl2br(esc_html($meta['prompt_text'])); ?>
                        </div>
                        <?php if ($prompt_content_locked) : ?>
                            <div class="prompt-content-lock" role="dialog" aria-modal="true" aria-labelledby="prompt-content-lock-heading" aria-describedby="prompt-content-lock-desc">
                                <div class="prompt-content-lock-panel">
                                    <p class="prompt-content-lock-lead" id="prompt-content-lock-heading"><?php esc_html_e('مخصص لمشتركي النشرة البريدية', 'linkawy'); ?></p>
                                    <div class="prompt-content-lock-desc" id="prompt-content-lock-desc">
                                        <p class="prompt-content-lock-desc-line"><?php esc_html_e('أدخل بريدك لفتح البرومبت، واكتشف استراتيجيات SEO عملية لا يراها أغلب المنافسين — مبنية على تجارب حقيقية، تصلك حصريًا عبر نشرتنا البريدية.', 'linkawy'); ?></p>
                                    </div>
                                    <form id="prompt-content-lock-form" class="prompt-content-lock-form js-prompt-content-lock-form" action="#" method="post" novalidate>
                                        <label class="screen-reader-text" for="prompt-content-lock-email"><?php esc_html_e('البريد الإلكتروني', 'linkawy'); ?></label>
                                        <input type="email" id="prompt-content-lock-email" name="email" class="prompt-content-lock-input" placeholder="<?php esc_attr_e('بريدك الإلكتروني', 'linkawy'); ?>" required autocomplete="email" inputmode="email" data-lpignore="true" data-1p-ignore="true" data-form-type="other">
                                        <input type="hidden" name="source" value="single-prompt">
                                        <input type="hidden" name="source_kind" value="prompt">
                                        <input type="hidden" name="source_post_id" value="<?php echo esc_attr((string) $post_id); ?>">
                                        <input type="hidden" name="unlock_prompt_id" value="<?php echo esc_attr((string) $post_id); ?>">
                                        <input type="hidden" name="nonce" value="<?php echo esc_attr(wp_create_nonce('linkawy_newsletter_form')); ?>">
                                        <input type="text" name="hp_field" value="" tabindex="-1" autocomplete="off" class="prompt-content-lock-hp" aria-hidden="true">
                                        <button type="submit" class="prompt-content-lock-submit"><?php esc_html_e('فتح البرومت', 'linkawy'); ?></button>
                                    </form>
                                    <p class="prompt-content-lock-feedback" role="status" aria-live="polite"></p>
                                    <p class="prompt-content-lock-trust"><?php esc_html_e('يمكنك إلغاء الاشتراك في أي وقت. لا نرسل رسائل مزعجة.', 'linkawy'); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="prompt-box-actions">
                        <div class="prompt-copy-btn-wrap">
                            <button type="button" class="prompt-copy-btn<?php echo $prompt_content_locked ? ' prompt-copy-btn--locked' : ''; ?>" aria-live="polite"<?php echo $prompt_content_locked ? ' disabled aria-disabled="true"' : ''; ?> <?php echo $prompt_content_locked ? ' title="' . esc_attr__('أدخل بريدك وافتح المحتوى لتفعيل النسخ', 'linkawy') . '"' : ''; ?> <?php echo $prompt_content_locked ? ' aria-label="' . esc_attr__('نسخ النص — مقفل حتى فتح المحتوى', 'linkawy') . '"' : ''; ?> <?php echo $prompt_content_locked ? ' aria-describedby="prompt-copy-locked-hint"' : ''; ?>>
                                <?php if ($prompt_content_locked) : ?>
                                    <i class="fas fa-lock prompt-copy-btn-icon" aria-hidden="true"></i>
                                <?php else : ?>
                                    <i class="far fa-copy prompt-copy-btn-icon" aria-hidden="true"></i>
                                <?php endif; ?>
                                <span class="prompt-copy-btn-text"><?php _e('نسخ النص', 'linkawy'); ?></span>
                            </button>
                            <?php if ($prompt_content_locked) : ?>
                                <p id="prompt-copy-locked-hint" class="prompt-copy-locked-hint"><?php esc_html_e('لإتاحة النسخ يرجى أدخال بريدك الإلكتروني أعلاه', 'linkawy'); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($meta['try_url'])) : ?>
                            <a href="<?php echo esc_url($meta['try_url']); ?>" class="prompt-try-btn" target="_blank" rel="noopener noreferrer">
                                <?php _e('Try this', 'linkawy'); ?> <i class="fas fa-sparkles" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    $related = new WP_Query(array(
        'post_type'      => 'prompts',
        'post_status'    => 'publish',
        'posts_per_page' => 3,
        'post__not_in'   => array($post_id),
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));
    if ($related->have_posts()) :
        ?>
        <section class="related-prompts-section">
            <h2 class="related-prompts-title"><?php _e('أوامر مشابهه قد تهمك', 'linkawy'); ?></h2>
            <div class="blog-grid">
                <?php
                while ($related->have_posts()) {
                    $related->the_post();
                    get_template_part('template-parts/content', 'prompt');
                }
                wp_reset_postdata();
                ?>
            </div>
        </section>
    <?php endif; ?>

    <?php
    if (empty($meta['content_lock'])) :
        global $linkawy_newsletter_inline_args;
        $linkawy_newsletter_inline_args = array(
            'source'                => 'single-prompt',
            'source_kind'           => 'prompt',
            'source_post_id'        => (int) $post_id,
            'source_title_for_ajax' => get_the_title($post_id),
        );
        get_template_part('template-parts/newsletter');
        $linkawy_newsletter_inline_args = null;
    endif;
    ?>
        </div>
    </section>
    <?php
endwhile;
?>
<script>
(function(){
 function syncPreviewHeight(){
  var mq = window.matchMedia('(min-width: 992px)');
  var card = document.querySelector('.prompt-preview-card');
  var box = document.querySelector('.prompt-box');
  if(!mq.matches || !card || !box) { if(card) card.style.height = ''; return; }
  card.style.height = box.offsetHeight + 'px';
 }

 if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',syncPreviewHeight); else syncPreviewHeight();
 window.addEventListener('resize',syncPreviewHeight);
 window.syncPromptPreviewHeight = syncPreviewHeight;
})();
</script>
<?php
get_footer();
