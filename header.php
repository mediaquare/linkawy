<!DOCTYPE html>
<html <?php language_attributes(); ?><?php if (is_page() && !is_front_page()) { echo ' class="linkawy-page-template"'; } ?> dir="rtl">

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
    $critical_css_path = get_theme_file_path('/assets/css/critical.css');
    if (file_exists($critical_css_path)) {
        $critical_css = file_get_contents($critical_css_path);
        echo str_replace('{{THEME_URI}}', get_theme_file_uri(), $critical_css);
    }
    ?>
    </style>
    <?php endif; ?>
    
    <?php wp_head(); ?>
    <!-- Ensure glass header styles override minified CSS -->
    <style id="header-glass-override">
        /* Glass effect via ::before pseudo-element.
           This avoids the "backdrop root" issue where backdrop-filter
           on a parent prevents children (mega menu) from having their
           own visible backdrop-filter effect. */
        header {
            background: transparent !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
            border-bottom: none !important;
            box-shadow: none !important;
        }
        header::before {
            content: '';
            position: absolute;
            inset: 0;
            z-index: -1;
            background: rgba(255,255,255,.75);
            backdrop-filter: blur(14px) saturate(180%);
            -webkit-backdrop-filter: blur(14px) saturate(180%);
            border-bottom: 1px solid rgba(0,0,0,.06);
            box-shadow: 0 8px 24px rgba(0,0,0,.06);
            pointer-events: none;
        }
        /* Homepage: header is part of the hero scene – fully transparent */
        .home header,
        .front-page header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
        }
        .home header::before,
        .front-page header::before {
            background: transparent !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
            border-bottom: 1px solid transparent !important;
            box-shadow: none !important;
            transition: background 0.45s cubic-bezier(0.4, 0, 0.2, 1),
                        backdrop-filter 0.45s cubic-bezier(0.4, 0, 0.2, 1),
                        -webkit-backdrop-filter 0.45s cubic-bezier(0.4, 0, 0.2, 1),
                        border-color 0.45s cubic-bezier(0.4, 0, 0.2, 1),
                        box-shadow 0.45s cubic-bezier(0.4, 0, 0.2, 1);
        }
        /* Homepage: glassmorphism kicks in on scroll */
        .home header.scrolled::before,
        .front-page header.scrolled::before {
            background-color: rgba(10, 10, 10, 0.72) !important;
            backdrop-filter: blur(20px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.15) !important;
        }
        /* Ensure main content has no extra padding on homepage */
        .home main#main-content,
        .front-page main#main-content {
            padding-top: 0;
        }
    </style>
    
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
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo esc_url(linkawy_get_logo_url()); ?>" alt="<?php bloginfo('name'); ?>" width="180" height="52">
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
                        <a href="https://www.linkedin.com/in/aliatwa/" aria-label="LinkedIn" target="_blank" rel="noopener"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a>
                        <a href="https://www.facebook.com/linkawy1" aria-label="Facebook" target="_blank" rel="noopener"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                        <a href="https://wa.me/201063676963" aria-label="WhatsApp" target="_blank" rel="noopener"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                    </div>
                </div>
            </nav>
            <?php 
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
