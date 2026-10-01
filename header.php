<!DOCTYPE html>
<html <?php language_attributes(); ?><?php if (is_page() && !is_front_page()) { echo ' class="linkawy-page-template"'; } ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php 
    // Check if we're in Elementor preview/editor mode (only on frontend)
    $is_elementor_preview = false;
    if (!is_admin() && class_exists('\Elementor\Plugin')) {
        $elementor = \Elementor\Plugin::instance();
        if (isset($elementor->preview)) {
            $is_elementor_preview = $elementor->preview->is_preview_mode();
        }
    }
    
    // Don't load critical CSS in Elementor preview
    if (!$is_elementor_preview) : 
    ?>
    <!-- Critical CSS: Inline above-the-fold styles to reduce render-blocking -->
    <style id="critical-css">
    <?php 
    $critical_css_path = get_theme_file_path(is_rtl() ? '/assets/css/critical.css' : '/assets/css/ltr/critical.css');
    if (file_exists($critical_css_path)) {
        $critical_css = file_get_contents($critical_css_path);
        echo str_replace('{{THEME_URI}}', get_theme_file_uri(), $critical_css);
    }
    ?>
    </style>
    <?php endif; ?>
    
    <?php wp_head(); ?>
    <!-- Redesign: the header is solid #0A0A0A and sticky on every page (assets/css/ds.css); the old glass override was removed. -->
    <?php if (is_front_page()) : ?>
    <!-- Skip layout/paint of below-the-fold front-page sections until they near the viewport (A/B: bad-PSI runs 13/20 -> 4/20) -->
    <style>
    .programs-section, .seo-proof-section, .lk-strategy, .partners-section, .success-stories-section,
    .process-section, .problems-section, .benefits-section, .blog-posts-section, .about-section,
    .results-section, .seo-faq-section, .contact-form-section, footer {
        content-visibility: auto;
        contain-intrinsic-size: auto 900px;
    }
    </style>
    <?php endif; ?>

    <!-- Header scroll detection script -->
    <script>
    (function() {
        function initHeaderScroll() {
            var header = document.querySelector('header');
            if (!header) return;
            var ticking = false;
            
            function getHeroThreshold() {
                /* Activate glass background as soon as user starts scrolling */
                return 10;
            }
            
            function updateHeader() {
                var scrollY = window.pageYOffset || document.documentElement.scrollTop;
                var threshold = getHeroThreshold();
                
                if (scrollY > threshold) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
                ticking = false;
            }
            
            function onScroll() {
                if (!ticking) {
                    window.requestAnimationFrame(updateHeader);
                    ticking = true;
                }
            }
            
            updateHeader();
            window.addEventListener('scroll', onScroll, { passive: true });
        }
        
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initHeaderScroll);
        } else {
            initHeaderScroll();
        }
    })();
    </script>
</head>

<body <?php body_class(); ?>>
<?php 
wp_body_open(); 

// Only show header/navigation for non-Elementor pages
if (!$is_elementor_preview) {
?>

    <!-- Skip to main content link for accessibility -->
    <a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e('تخطي إلى المحتوى', 'linkawy'); ?></a>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="logo">
                <a href="<?php echo esc_url(linkawy_home_url()); ?>">
                    <img src="<?php echo esc_url(linkawy_ds_logo_url()); ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo linkawy_is_en() ? 115 : 88; ?>" height="34">
                </a>
            </div>
            <button class="mobile-menu-toggle" aria-label="<?php esc_attr_e('قائمة التنقل', 'linkawy'); ?>">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav class="main-nav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary-menu',
                    'container'      => false,
                    'menu_class'     => '',
                    'items_wrap'     => '<ul>%3$s</ul>',
                    'walker'         => new Linkawy_Mega_Menu_Walker(),
                    'fallback_cb'    => 'linkawy_fallback_menu',
                ));
                ?>
                <div class="mobile-nav-contact">
                    <?php 
                    $mobile_cta = linkawy_get_mobile_cta();
                    $mobile_cta_url = strpos($mobile_cta['url'], 'http') === 0 ? $mobile_cta['url'] : home_url($mobile_cta['url']);
                    ?>
                    <a href="<?php echo esc_url($mobile_cta_url); ?>" class="mobile-nav-cta"><?php echo esc_html($mobile_cta['text']); ?></a>
                    <div class="mobile-nav-social">
                        <a href="https://www.linkedin.com/in/aliatwa/" aria-label="LinkedIn" target="_blank" rel="noopener"><?php echo linkawy_icon('Linkedin', 18); ?></a>
                        <a href="https://www.facebook.com/linkawy1" aria-label="Facebook" target="_blank" rel="noopener"><?php echo linkawy_icon('Facebook', 18); ?></a>
                        <a href="https://wa.me/201063676963" aria-label="WhatsApp" target="_blank" rel="noopener"><?php echo linkawy_brand_icon('whatsapp', 18); ?></a>
                    </div>
                </div>
            </nav>
            <?php
            linkawy_language_switcher();
            $header_cta = linkawy_get_header_cta();
            if ($header_cta['show']) : 
                $cta_url = strpos($header_cta['url'], 'http') === 0 ? $header_cta['url'] : home_url($header_cta['url']);
            ?>
            <div class="header-actions">
                <a href="<?php echo esc_url($cta_url); ?>" class="cta-button"><?php echo esc_html($header_cta['text']); ?></a>
            </div>
            <?php endif; ?>
        </div>
    </header>

<?php
}
?>

    <!-- Main Content -->
    <main id="main-content" role="main">

<?php
/**
 * Fallback menu if no menu assigned
 * 
 * Shows basic navigation links. To use mega menu,
 * please create a menu in Appearance > Menus
 */
function linkawy_fallback_menu() {
    ?>
    <ul>
        <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('الرئيسية', 'linkawy'); ?></a></li>
        <li><a href="#"><?php _e('الخدمات', 'linkawy'); ?></a></li>
        <li><a href="#"><?php _e('منظومة التكامل', 'linkawy'); ?></a></li>
        <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php _e('المدونة', 'linkawy'); ?></a></li>
        <li><a href="#"><?php _e('من نحن', 'linkawy'); ?></a></li>
    </ul>
    <p class="menu-notice" style="display: none;">
        <?php _e('قم بإنشاء قائمة في Appearance > Menus لتفعيل الميجا منيو', 'linkawy'); ?>
    </p>
    <?php
}
?>
