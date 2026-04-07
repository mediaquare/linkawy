<?php
/**
 * Glossary Archive Template
 *
 * @package Linkawy
 */

get_header();

// Get all glossary terms grouped by first letter
$all_terms = get_posts(array(
    'post_type'      => 'glossary',
    'posts_per_page' => -1,
    'orderby'        => 'title',
    'order'          => 'ASC',
));

// Group terms by first letter
$grouped_terms = array();
foreach ($all_terms as $term) {
    $first_char = mb_strtoupper(mb_substr($term->post_title, 0, 1, 'UTF-8'), 'UTF-8');
    // Check if it's a number or special character
    if (is_numeric($first_char) || !preg_match('/[a-zA-Z\x{0600}-\x{06FF}]/u', $first_char)) {
        $first_char = '#';
    }
    if (!isset($grouped_terms[$first_char])) {
        $grouped_terms[$first_char] = array();
    }
    $grouped_terms[$first_char][] = $term;
}

// Sort by key
ksort($grouped_terms);
?>

    <!-- Glossary Index Hero -->
    <section class="glossary-index-hero">
        <div class="container">
            <h1 class="glossary-index-title"><?php _e('قاموس السيو (SEO Glossary)', 'linkawy'); ?></h1>
            <p class="glossary-index-subtitle"><?php _e('شرح مبسط لكل مصطلح مهم في عالم تحسين محركات البحث.', 'linkawy'); ?></p>
        </div>
    </section>

    <!-- Alphabet Navigation -->
    <div class="alphabet-nav-wrapper">
        <div class="alphabet-nav">
            <a href="#char-symbol" class="<?php echo isset($grouped_terms['#']) ? 'active' : ''; ?>">#</a>
            <?php
            $alphabet = range('A', 'Z');
            foreach ($alphabet as $letter) :
                $has_terms = isset($grouped_terms[$letter]);
            ?>
                <a href="#char-<?php echo strtolower($letter); ?>" class="<?php echo !$has_terms ? 'disabled' : ''; ?>"><?php echo $letter; ?></a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Glossary Content -->
    <section class="glossary-index-content">
        <div class="container">
            <!-- Search Bar -->
            <div class="glossary-search-container">
                <div class="glossary-search">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="glossary-search-input" placeholder="<?php esc_attr_e('ابحث عن مصطلح...', 'linkawy'); ?>" aria-label="<?php esc_attr_e('ابحث في القاموس', 'linkawy'); ?>">
                </div>
            </div>

            <!-- Terms Groups -->
            <div class="glossary-groups">
                <?php foreach ($grouped_terms as $letter => $terms) : ?>
                    <div class="glossary-group" id="char-<?php echo $letter === '#' ? 'symbol' : strtolower($letter); ?>">
                        <div class="group-char"><?php echo esc_html($letter); ?></div>
                        <div class="group-items">
                            <?php foreach ($terms as $term) : ?>
                                <div class="glossary-item-card" data-title="<?php echo esc_attr(strtolower($term->post_title)); ?>">
                                    <h2 class="item-title">
                                        <a href="<?php echo get_permalink($term->ID); ?>"><?php echo esc_html($term->post_title); ?></a>
                                    </h2>
                                    <p class="item-desc"><?php echo wp_trim_words($term->post_excerpt ? $term->post_excerpt : $term->post_content, 25); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Pre-Footer CTA Section -->
    <?php get_template_part('template-parts/cta-banner'); ?>

<script>
// Glossary Search functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('glossary-search-input');
    const glossaryCards = document.querySelectorAll('.glossary-item-card');
    const glossaryGroups = document.querySelectorAll('.glossary-group');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();

            glossaryGroups.forEach(function(group) {
                let hasVisibleCards = false;
                const cards = group.querySelectorAll('.glossary-item-card');

                cards.forEach(function(card) {
                    const title = card.getAttribute('data-title');
                    const desc = card.querySelector('.item-desc').textContent.toLowerCase();

                    if (title.includes(searchTerm) || desc.includes(searchTerm)) {
                        card.style.display = '';
                        hasVisibleCards = true;
                    } else {
                        card.style.display = 'none';
                    }
                });

                group.style.display = hasVisibleCards ? '' : 'none';
            });
        });
    }

    // Smooth scroll for alphabet navigation
    const alphabetLinks = document.querySelectorAll('.alphabet-nav a:not(.disabled)');
    alphabetLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
});
</script>

<?php
get_footer();
