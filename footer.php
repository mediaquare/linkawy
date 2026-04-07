    </main><!-- #main-content -->

<?php
// Check if we're in Elementor preview mode (only on frontend)
$is_elementor_preview = false;
if (!is_admin() && class_exists('\Elementor\Plugin')) {
    $elementor = \Elementor\Plugin::instance();
    if (isset($elementor->preview)) {
        $is_elementor_preview = $elementor->preview->is_preview_mode();
    }
}

// Skip footer for Elementor preview
if (!$is_elementor_preview) {
?>

    <!-- Footer -->
    <footer>
        <div class="container">
            <?php 
            $footer_settings = linkawy_get_footer_settings();
            $social_links = linkawy_get_social_links();
            ?>
            <div class="footer-grid">
                <!-- Logo & Description Section -->
                <div class="footer-logo">
                    <img src="<?php echo esc_url(linkawy_get_logo_url()); ?>" alt="<?php bloginfo('name'); ?>" width="180" height="52" loading="lazy">
                    <p style="font-size: 0.9rem; line-height: 1.8; margin-top: 1rem;">
                        <?php echo esc_html($footer_settings['description']); ?>
                    </p>
                    <div class="footer-social-icons">
                        <a href="https://www.linkedin.com/in/aliatwa/" aria-label="LinkedIn" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://www.youtube.com/@linkawy?sub_confirmation=1" aria-label="YouTube" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.tiktok.com/@linkawy" aria-label="TikTok" target="_blank" rel="noopener"><i class="fab fa-tiktok"></i></a>
                        <a href="https://www.facebook.com/linkawy1" aria-label="Facebook" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>

                <!-- Services Section -->
                <div class="footer-links footer-accordion">
                    <div class="footer-accordion-header">
                        <span><?php _e('خدماتنا', 'linkawy'); ?></span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="footer-accordion-content">
                        <?php if (is_active_sidebar('footer-services')) : ?>
                            <?php dynamic_sidebar('footer-services'); ?>
                        <?php else : ?>
                            <ul>
                                <li><a href="#"><?php _e('تحسين محركات البحث', 'linkawy'); ?></a></li>
                                <li><a href="#"><?php _e('بناء الروابط', 'linkawy'); ?></a></li>
                                <li><a href="#"><?php _e('العلاقات العامة الرقمية', 'linkawy'); ?></a></li>
                                <li><a href="#"><?php _e('كتابة المحتوى', 'linkawy'); ?></a></li>
                                <li><a href="#"><?php _e('التصميم والفيديو', 'linkawy'); ?></a></li>
                                <li><a href="#"><?php _e('سيو الذكاء الاصطناعي', 'linkawy'); ?></a></li>
                                <li><a href="#"><?php _e('نمِّ أعمالك', 'linkawy'); ?></a></li>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Resources Section -->
                <div class="footer-links footer-accordion">
                    <div class="footer-accordion-header">
                        <span><?php _e('المصادر', 'linkawy'); ?></span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="footer-accordion-content">
                        <?php if (is_active_sidebar('footer-resources')) : ?>
                            <?php dynamic_sidebar('footer-resources'); ?>
                        <?php else : ?>
                            <ul>
                                <li><a href="#"><?php _e('دليل تعلم السيو', 'linkawy'); ?></a></li>
                                <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php _e('المدونة', 'linkawy'); ?></a></li>
                                <li><a href="#"><?php _e('بودكاست', 'linkawy'); ?></a></li>
                                <li><a href="<?php echo esc_url(get_post_type_archive_link('glossary')); ?>"><?php _e('قاموس المصطلحات', 'linkawy'); ?></a></li>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Company Section -->
                <div class="footer-links footer-accordion">
                    <div class="footer-accordion-header">
                        <span><?php _e('الشركة', 'linkawy'); ?></span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="footer-accordion-content">
                        <?php if (is_active_sidebar('footer-company')) : ?>
                            <?php dynamic_sidebar('footer-company'); ?>
                        <?php else : ?>
                            <ul>
                                <li><a href="#"><?php _e('من نحن', 'linkawy'); ?></a></li>
                                <li><a href="#"><?php _e('سياسة الخصوصية', 'linkawy'); ?></a></li>
                                <li><a href="#"><?php _e('آراء العملاء', 'linkawy'); ?></a></li>
                                <li><a href="#"><?php _e('دراسات الحالة', 'linkawy'); ?></a></li>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="footer-links footer-accordion footer-contact">
                    <div class="footer-accordion-header">
                        <span><?php _e('اتصل بنا', 'linkawy'); ?></span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <ul class="footer-accordion-content">
                        <?php if (!empty($footer_settings['address'])) : ?>
                        <li><i class="fas fa-map-marker-alt"></i> <?php echo esc_html($footer_settings['address']); ?></li>
                        <?php endif; ?>
                        <?php if (!empty($footer_settings['email'])) : ?>
                        <li><a href="mailto:<?php echo esc_attr($footer_settings['email']); ?>"><i class="fas fa-envelope"></i> <?php echo esc_html($footer_settings['email']); ?></a></li>
                        <?php endif; ?>
                        <?php if (!empty($footer_settings['phone'])) : ?>
                        <li><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $footer_settings['phone'])); ?>"><i class="fas fa-phone"></i> <?php echo esc_html($footer_settings['phone']); ?></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            
            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php echo esc_html($footer_settings['copyright']); ?></p>
            </div>
        </div>
    </footer>

<?php
}
?>

    <?php wp_footer(); ?>
</body>

</html>
