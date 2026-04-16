<?php
/**
 * Single Post Template
 *
 * @package Linkawy
 */

get_header();

$single_post_id = linkawy_get_current_single_post_id();

// Process content and generate TOC (Server-side for SEO)
$toc_data = linkawy_get_toc_data();
$disable_toc = get_post_meta($single_post_id, '_disable_toc', true);
$show_toc = $toc_data['has_toc'] && !$disable_toc;
$article_hero_bg = linkawy_get_article_hero_bg_color($single_post_id);
$article_hero_style = $article_hero_bg !== '' ? ' style="' . esc_attr('background-color:' . $article_hero_bg . ';') . '"' : '';
$article_hero_classes = array('article-hero');
if (linkawy_article_hero_effective_pattern_enabled($single_post_id)) {
    $article_hero_classes[] = 'article-hero--pattern';
}
?>

    <!-- Article Hero Section -->
    <section class="<?php echo esc_attr(implode(' ', $article_hero_classes)); ?>"<?php echo $article_hero_style; ?>>
        <div class="container">
            <?php linkawy_breadcrumbs(); ?>
            
            <div class="article-hero-content">
                <h1 class="article-title"><?php the_title(); ?></h1>
                
                <?php linkawy_post_meta(); ?>
            </div>
        </div>
        <?php if (linkawy_single_hero_should_show_post_thumbnail($single_post_id)) : ?>
            <?php
            echo get_the_post_thumbnail(
                $single_post_id,
                'linkawy-card',
                array(
                    'class'    => 'article-hero-character',
                    'loading'  => 'eager',
                    'decoding' => 'async',
                    'alt'      => esc_attr(get_the_title($single_post_id)),
                )
            );
            ?>
        <?php else : ?>
        <img
            src="<?php echo esc_url(LINKAWY_URI . '/assets/images/linko-character.png'); ?>"
            alt=""
            class="article-hero-character"
            width="220"
            height="220"
            loading="eager"
            decoding="async"
        />
        <?php endif; ?>
    </section>

    <!-- Article Content Section -->
    <section class="article-section">
        <div class="container">
            <div class="article-layout">
                
                <!-- Sidebar -->
                <aside class="article-sidebar">
                    <!-- 1. Author Card (Not Sticky) -->
                    <div class="author-card">
                        <div class="author-card-header">
                            <?php $author_id = linkawy_get_original_author_id(); ?>
                            <?php echo linkawy_get_author_avatar_img($author_id, 60, 'author-card-avatar'); ?>
                            <p class="author-card-name"><?php echo esc_html(linkawy_get_original_author_name()); ?></p>
                        </div>
                        <p class="author-card-bio"><?php echo esc_html(linkawy_get_author_short_bio($author_id)); ?></p>
                    </div>
                    
                    <!-- Sticky Widgets Container -->
                    <div class="sidebar-sticky">
                        <!-- 2. Share Buttons -->
                        <div class="sidebar-share">
                            <span class="share-label"><?php _e('شارك المقال', 'linkawy'); ?></span>
                            <?php linkawy_share_buttons(); ?>
                        </div>
                        
                        <!-- 3. Table of Contents (Server-Side Generated for SEO) -->
                        <?php if ($show_toc) : ?>
                        <div class="toc-card" data-toc-count="<?php echo esc_attr($toc_data['count']); ?>">
                            <h2 class="toc-title"><?php _e('فهرس المقال', 'linkawy'); ?></h2>
                            <ul class="toc-list" id="toc-list">
                                <?php echo $toc_data['desktop_toc']; ?>
                            </ul>
                            <span class="toc-show-all"><?php _e('عرض كل العناوين', 'linkawy'); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <!-- 5. OmniSEO Widget -->
                        <div class="omniseo-widget">
                            <div class="omniseo-top-icons">
                                <div class="omniseo-icon">
                                    <img src="<?php echo LINKAWY_URI; ?>/assets/images/openai.svg" alt="ChatGPT" width="36" height="36" loading="lazy">
                                </div>
                                <div class="omniseo-icon">
                                    <img src="<?php echo LINKAWY_URI; ?>/assets/images/perplexity.svg" alt="Perplexity" width="36" height="36" loading="lazy">
                                </div>
                                <div class="omniseo-icon">
                                    <img src="<?php echo LINKAWY_URI; ?>/assets/images/gemini-color.svg" alt="Gemini" width="36" height="36" loading="lazy">
                                </div>
                                <div class="omniseo-icon">
                                    <img src="<?php echo LINKAWY_URI; ?>/assets/images/google.svg" alt="Google" width="36" height="36" loading="lazy">
                                </div>
                            </div>
                            <div class="widget-cta">
                                <div class="omniseo-content">
                                    <p class="omniseo-heading"><strong><?php _e('استعد للمستقبل مع', 'linkawy'); ?> <span class="omniseo-highlight">Linkawy GEO</span></strong></p>
                                    <div class="omniseo-description">
                                        <p><?php _e('وداعاً لتحسين محركات البحث التقليدي، ومرحباً بتحسين ظهورك في كل مكان.', 'linkawy'); ?></p>
                                    </div>
                                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="omniseo-btn"><?php _e('احصل على استشارة مجانية', 'linkawy'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                
                <!-- Main Content -->
                <div class="content-inner">
                    <!-- Mobile TOC (Server-Side Generated for SEO) -->
                    <?php if ($show_toc) : ?>
                    <div class="mobile-toc-wrap">
                        <div class="mobile-toc">
                            <button type="button" class="mobile-toc__toggle" aria-expanded="false">
                                <svg class="mobile-toc__icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="-10 -226 532 468" style="transform:scaleX(-1)"><path d="M64-88c35 0 64-29 64-64s-29-64-64-64-64 29-64 64 29 64 64 64zm160-96c-18 0-32 14-32 32s14 32 32 32h256c18 0 32-14 32-32s-14-32-32-32H224zm0 160c-18 0-32 14-32 32s14 32 32 32h256c18 0 32-14 32-32s-14-32-32-32H224zm0 160c-18 0-32 14-32 32s14 32 32 32h256c18 0 32-14 32-32s-14-32-32-32H224zM40 168c0-13 11-24 24-24s24 11 24 24-11 24-24 24-24-11-24-24zm88 0c0-35-29-64-64-64S0 133 0 168s29 64 64 64 64-29 64-64zM64-16C77-16 88-5 88 8S77 32 64 32 40 21 40 8s11-24 24-24zm0 88c35 0 64-29 64-64S99-56 64-56 0-27 0 8s29 64 64 64z" fill="#1a1a2e"/></svg>
                                <span class="mobile-toc__title"><?php _e('فهرس المقال', 'linkawy'); ?></span>
                            </button>
                            <div class="mobile-toc__panel" hidden>
                                <ul class="mobile-toc__list" id="mobile-toc-list">
                                    <?php echo $toc_data['mobile_toc']; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="mobile-toc__overlay" hidden></div>
                    </div>
                    <?php endif; ?>
                    
                    <div class="article-content-wrapper">
                    <article class="article-content linkawy-content">
                        <?php echo $toc_data['content']; ?>
                    </article>
                    
                    <!-- Share Section -->
                    <div class="article-share">
                        <span><?php _e('شارك المقال', 'linkawy'); ?></span>
                        <?php linkawy_share_buttons(); ?>
                    </div>
                    </div>
                    
                    <!-- Author Box (Below Article Content) -->
                    <div class="author-box">
                        <div class="author-box-header">
                            <?php $author_id_box = linkawy_get_original_author_id(); ?>
                            <?php echo linkawy_get_author_avatar_img($author_id_box, 80, 'author-box-avatar'); ?>
                            <div class="author-box-info">
                                <p class="author-box-name"><?php echo esc_html(linkawy_get_original_author_name()); ?></p>
                                <?php linkawy_author_social_links($author_id_box); ?>
                            </div>
                        </div>
                        <p class="author-box-bio"><?php 
                            $bio_box = get_the_author_meta('description', $author_id_box);
                            echo $bio_box ? esc_html($bio_box) : __('كاتب محتوى في Linkawy، متخصص في السيو والتسويق الرقمي. يعمل على تقديم محتوى عالي الجودة يحقق نتائج ملموسة.', 'linkawy');
                        ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Newsletter Subscription (Article Style) -->
    <?php get_template_part('template-parts/newsletter-article'); ?>
    
    <!-- You May Also Like Section -->
    <?php
    $related_posts = linkawy_get_related_posts(get_the_ID(), 4);
    if ($related_posts->have_posts()) :
    ?>
    <section class="also-like-section">
        <div class="container container-wide">
            <div class="also-like-wrapper">
                <h2 class="also-like-title"><?php _e('قد يهمك أيضًا', 'linkawy'); ?></h2>
                <div class="also-like-grid">
                    <?php
                    while ($related_posts->have_posts()) : $related_posts->the_post();
                    ?>
                    <article class="also-like-card">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        <div class="also-like-meta">
                            <?php
                            $categories = get_the_category();
                            if ($categories) :
                            ?>
                                <span class="also-like-category"><?php echo esc_html($categories[0]->name); ?></span>
                            <?php endif; ?>
                            <span class="also-like-time"><?php echo linkawy_reading_time(); ?></span>
                        </div>
                    </article>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Pre-Footer CTA Section -->
    <?php get_template_part('template-parts/cta-banner'); ?>

<script>
/**
 * TOC Interactive Features
 * TOC items are generated server-side (PHP) for SEO benefits
 * This script only handles: visibility toggle, scroll spy, smooth scroll, mobile toggle
 */
document.addEventListener('DOMContentLoaded', function() {
    // ===== Code Block Copy Button =====
    document.querySelectorAll('.wp-block-code').forEach(function(block) {
        const copyBtn = document.createElement('button');
        copyBtn.className = 'code-copy-btn';
        copyBtn.innerHTML = '<i class="far fa-copy"></i>';
        copyBtn.setAttribute('title', 'نسخ الكود');
        
        copyBtn.addEventListener('click', function() {
            const code = block.querySelector('code');
            const text = code ? code.textContent : block.textContent;
            
            navigator.clipboard.writeText(text.trim()).then(function() {
                copyBtn.innerHTML = '<i class="fas fa-check"></i>';
                copyBtn.classList.add('copied');
                
                setTimeout(function() {
                    copyBtn.innerHTML = '<i class="far fa-copy"></i>';
                    copyBtn.classList.remove('copied');
                }, 2000);
            });
        });
        
        block.appendChild(copyBtn);
    });
    
    // ===== AI Prompt Copy Button =====
    document.querySelectorAll('.ai-prompt-box').forEach(function(box) {
        const copyBtn = box.querySelector('.ai-prompt-copy');
        const content = box.querySelector('.ai-prompt-content');
        
        if (copyBtn && content) {
            copyBtn.addEventListener('click', function() {
                const text = content.innerText;
                
                navigator.clipboard.writeText(text.trim()).then(function() {
                    copyBtn.innerHTML = '<i class="fas fa-check"></i>';
                    copyBtn.classList.add('copied');
                    
                    setTimeout(function() {
                        copyBtn.innerHTML = '<i class="far fa-copy"></i>';
                        copyBtn.classList.remove('copied');
                    }, 2000);
                });
            });
        }
    });
    
    // ===== FAQ Accordion =====
    const faqItems = document.querySelectorAll('.faq-item');
    if (faqItems.length > 0) {
        // Open first FAQ by default
        faqItems[0].classList.add('is-open');
        
        faqItems.forEach(function(item) {
            const question = item.querySelector('.faq-question');
            
            if (question) {
                question.addEventListener('click', function() {
                    const isOpen = item.classList.contains('is-open');
                    
                    // Close all FAQs
                    faqItems.forEach(function(otherItem) {
                        otherItem.classList.remove('is-open');
                    });
                    
                    // Open clicked FAQ (if it wasn't already open)
                    if (!isOpen) {
                        item.classList.add('is-open');
                    }
                });
            }
        });
    }
    
    // ===== References Toggle (collapsed by default) =====
    document.querySelectorAll('.references-section').forEach(function(section) {
        const header = section.querySelector('.references-header');
        const content = section.querySelector('.references-content');
        const toggleBtn = section.querySelector('.references-toggle');
        
        if (header && content && toggleBtn) {
            // Start collapsed - toggle button shows [+]
            toggleBtn.textContent = '[+]';
            
            header.addEventListener('click', function() {
                content.classList.toggle('expanded');
                toggleBtn.textContent = content.classList.contains('expanded') ? '[-]' : '[+]';
            });
        }
    });
    
    // ===== Table of Contents =====
    const tocList = document.getElementById('toc-list');
    const mobileTocList = document.getElementById('mobile-toc-list');
    const tocShowAll = document.querySelector('.toc-show-all');
    const articleContent = document.querySelector('.article-content');
    
    // Only proceed if TOC exists (generated by PHP)
    if (!tocList) return;
    
    const tocItems = tocList.querySelectorAll('li');
    const headings = articleContent ? articleContent.querySelectorAll('h2[id]') : [];
    let showAllMode = false;
    
    // Function to update visible TOC items (shows 3 at a time around active)
    function updateVisibleTocItems(activeIndex) {
        tocItems.forEach(function(item, index) {
            const link = item.querySelector('a');
            
            // Remove active class from all
            if (link) link.classList.remove('active');
            
            // Reset visibility
            item.classList.remove('visible');
            
            if (showAllMode) {
                // Show all items
                item.classList.add('visible');
            } else {
                // Show 3 items around active
                if (activeIndex <= 1) {
                    // First item active: show first 3
                    if (index < 3) {
                        item.classList.add('visible');
                    }
                } else if (activeIndex >= tocItems.length - 2) {
                    // Last items active: show last 3
                    if (index >= tocItems.length - 3) {
                        item.classList.add('visible');
                    }
                } else {
                    // Middle items: show prev, current, next
                    if (index >= activeIndex - 1 && index <= activeIndex + 1) {
                        item.classList.add('visible');
                    }
                }
            }
            
            // Set active
            if (index === activeIndex && link) {
                link.classList.add('active');
            }
        });
    }
    
    // Toggle show all
    if (tocShowAll && tocItems.length > 0) {
        tocShowAll.addEventListener('click', function() {
            showAllMode = !showAllMode;
            tocShowAll.textContent = showAllMode ? '<?php _e("عرض عناوين أقل", "linkawy"); ?>' : '<?php _e("عرض كل العناوين", "linkawy"); ?>';
            tocList.classList.toggle('show-all', showAllMode);
            
            // Re-apply visibility based on current active
            const activeLink = tocList.querySelector('a.active');
            if (activeLink) {
                const activeItem = activeLink.closest('li');
                const activeIndex = Array.from(tocItems).indexOf(activeItem);
                updateVisibleTocItems(activeIndex);
            } else {
                updateVisibleTocItems(0);
            }
        });
    }
    
    // Scroll Spy
    if (headings.length > 0) {
        const observerOptions = {
            root: null,
            rootMargin: '-100px 0px -70% 0px',
            threshold: 0
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const sectionId = entry.target.getAttribute('id');
                    let activeIndex = 0;
                    
                    tocItems.forEach(function(item, index) {
                        const link = item.querySelector('a');
                        if (link && link.getAttribute('href') === '#' + sectionId) {
                            activeIndex = index;
                        }
                    });
                    
                    // Update visible items
                    updateVisibleTocItems(activeIndex);
                    
                    // Update mobile TOC active state
                    if (mobileTocList) {
                        mobileTocList.querySelectorAll('a').forEach(function(link) {
                            link.classList.remove('active');
                            if (link.getAttribute('href') === '#' + sectionId) {
                                link.classList.add('active');
                            }
                        });
                    }
                }
            });
        }, observerOptions);
        
        headings.forEach(function(heading) {
            observer.observe(heading);
        });
    }
    
    // Smooth scroll for TOC links
    document.querySelectorAll('#toc-list a, #mobile-toc-list a').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                const headerOffset = 100;
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Mobile TOC Toggle
    const tocs = document.querySelectorAll('.mobile-toc');
    
    tocs.forEach(function(toc) {
        const wrap = toc.closest('.mobile-toc-wrap') || document;
        const toggle = toc.querySelector('.mobile-toc__toggle');
        const panel = toc.querySelector('.mobile-toc__panel');
        const overlay = wrap.querySelector('.mobile-toc__overlay');
        
        if (!toggle || !panel || !overlay) return;
        
        const closeTOC = function() {
            toc.classList.remove('is-open');
            toggle.setAttribute('aria-expanded', 'false');
            panel.hidden = true;
            overlay.hidden = true;
        };
        
        const openTOC = function() {
            toc.classList.add('is-open');
            toggle.setAttribute('aria-expanded', 'true');
            panel.hidden = false;
            overlay.hidden = false;
        };
        
        toggle.addEventListener('click', function() {
            const isOpen = toc.classList.contains('is-open');
            isOpen ? closeTOC() : openTOC();
        });
        
        overlay.addEventListener('click', closeTOC);
        
        panel.querySelectorAll('a').forEach(function(a) {
            a.addEventListener('click', closeTOC);
        });
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && toc.classList.contains('is-open')) closeTOC();
        });
        
        // Sticky behavior - optimized to reduce forced reflows
        const articleContentWrapper = document.querySelector('.article-content-wrapper');
        if (!articleContentWrapper) return;
        
        // Cache measurements that don't change frequently
        let cachedMeasurements = null;
        let ticking = false;
        
        // Measure once and cache
        const updateMeasurements = function() {
            const rect = toggle.getBoundingClientRect();
            cachedMeasurements = {
                originalY: rect.top + window.scrollY,
                contentTop: articleContentWrapper.offsetTop,
                contentHeight: articleContentWrapper.offsetHeight
            };
        };
        
        // Initial measurement
        updateMeasurements();
        
        // Recalculate on resize (throttled)
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(updateMeasurements, 150);
        }, { passive: true });
        
        // Optimized scroll handler using requestAnimationFrame
        const handleScroll = function() {
            if (!cachedMeasurements) return;
            
            const scrollY = window.scrollY;
            const contentBottom = cachedMeasurements.contentTop + cachedMeasurements.contentHeight;
            const pastOriginal = scrollY > cachedMeasurements.originalY - 80;
            const beforeEnd = scrollY < contentBottom - 150;
            
            const shouldBeSticky = pastOriginal && beforeEnd;
            
            // Only modify DOM if state changed
            const isSticky = toc.classList.contains('is-sticky');
            if (shouldBeSticky !== isSticky) {
                toc.classList.toggle('is-sticky', shouldBeSticky);
                
                if (!shouldBeSticky && toc.classList.contains('is-open')) {
                    closeTOC();
                }
            }
            
            ticking = false;
        };
        
        // Use passive listener and RAF for smooth scrolling
        window.addEventListener('scroll', function() {
            if (!ticking) {
                requestAnimationFrame(handleScroll);
                ticking = true;
            }
        }, { passive: true });
    });
});
</script>

<?php
get_footer();
