<?php
/**
 * Single Glossary Term Template
 *
 * @package Linkawy
 */

get_header();

// Get custom fields
$synonyms = linkawy_get_glossary_synonyms();
$reviewer = linkawy_get_glossary_reviewer();
$adjacent = linkawy_get_adjacent_glossary();
?>

    <!-- Glossary Hero Section -->
    <section class="glossary-hero">
        <div class="hero-glow hero-glow-top"></div>
        <div class="container">
            <?php linkawy_breadcrumbs(); ?>
            
            <div class="glossary-hero-content">
                <div class="glossary-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        <line x1="8" y1="6" x2="16" y2="6"></line>
                        <line x1="8" y1="10" x2="16" y2="10"></line>
                        <line x1="8" y1="14" x2="12" y2="14"></line>
                    </svg>
                </div>
                <h1 class="glossary-term-name"><?php the_title(); ?></h1>
                
                <?php if ($synonyms) : ?>
                    <div class="glossary-synonyms-hero">
                        <span class="synonyms-label-hero"><?php _e('مرادفات المصطلح:', 'linkawy'); ?></span>
                        <span class="synonyms-list-hero"><?php echo esc_html($synonyms); ?></span>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($reviewer['name'])) : ?>
                    <div class="glossary-reviewer">
                        <span class="reviewer-label"><?php _e('مراجعة وتدقيق:', 'linkawy'); ?></span>
                        <?php echo linkawy_get_author_avatar_img($reviewer['author_id'], 32, 'reviewer-avatar'); ?>
                        <span class="reviewer-name"><?php echo esc_html($reviewer['name']); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Glossary Content Section -->
    <section class="glossary-section">
        <div class="container">
            <div class="glossary-layout">
                
                <!-- Navigation Arrow - Previous -->
                <?php if ($adjacent['prev']) : ?>
                    <a href="<?php echo get_permalink($adjacent['prev']->ID); ?>" class="glossary-nav-arrow glossary-nav-prev">
                        <span class="nav-arrow-icon"><i class="fas fa-arrow-right"></i></span>
                        <span class="nav-arrow-text"><?php echo esc_html($adjacent['prev']->post_title); ?></span>
                    </a>
                <?php else : ?>
                    <div class="glossary-nav-arrow glossary-nav-prev disabled"></div>
                <?php endif; ?>
                
                <!-- Main Content Box -->
                <div class="glossary-content-box">
                    <div class="glossary-content linkawy-content">
                        <?php the_content(); ?>
                    </div>
                </div>
                
                <!-- Navigation Arrow - Next -->
                <?php if ($adjacent['next']) : ?>
                    <a href="<?php echo get_permalink($adjacent['next']->ID); ?>" class="glossary-nav-arrow glossary-nav-next">
                        <span class="nav-arrow-icon"><i class="fas fa-arrow-left"></i></span>
                        <span class="nav-arrow-text"><?php echo esc_html($adjacent['next']->post_title); ?></span>
                    </a>
                <?php else : ?>
                    <div class="glossary-nav-arrow glossary-nav-next disabled"></div>
                <?php endif; ?>
                
            </div>
        </div>
    </section>
    
    <!-- Related Terms Section -->
    <?php
    $related_terms = linkawy_get_related_glossary(get_the_ID(), 4);
    if ($related_terms->have_posts()) :
    ?>
    <section class="related-terms-section">
        <div class="container">
            <h2 class="related-terms-title"><?php _e('مصطلحات ذات صلة', 'linkawy'); ?></h2>
            <div class="related-terms-grid">
                <?php
                while ($related_terms->have_posts()) : $related_terms->the_post();
                ?>
                    <a href="<?php the_permalink(); ?>" class="related-term-card">
                        <span class="related-term-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            </svg>
                        </span>
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 10); ?></p>
                    </a>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Pre-Footer CTA Section -->
    <?php get_template_part('template-parts/cta-banner'); ?>

<?php
get_footer();
