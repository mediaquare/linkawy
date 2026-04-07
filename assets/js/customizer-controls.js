/**
 * Linkawy Theme Customizer Controls
 * 
 * Handles control panel interactions (not preview)
 * 
 * @package Linkawy
 */

(function($) {
    'use strict';
    
    // Default color values
    var defaultColors = {
        'linkawy_color_preset': 'default',
        'linkawy_primary_color': '#ff6b00',
        'linkawy_secondary_color': '#1a1a2e',
        'linkawy_accent_color': '#ff8533',
        'linkawy_text_primary': '#333333',
        'linkawy_text_secondary': '#666666',
        'linkawy_bg_light': '#f4f4f4',
        'linkawy_bg_dark': '#1a1a1a',
        'linkawy_link_color': '#ff6b00',
        'linkawy_button_bg': '#ff6b00'
    };
    
    /**
     * Reset all color settings to defaults
     */
    function resetColorsToDefault() {
        var $btn = $('#linkawy-reset-colors');
        var $success = $('#linkawy-reset-success');
        
        // Add loading state
        $btn.addClass('resetting');
        $btn.prop('disabled', true);
        
        // Reset each color setting
        $.each(defaultColors, function(settingId, defaultValue) {
            if (wp.customize(settingId)) {
                wp.customize(settingId).set(defaultValue);
            }
        });
        
        // Show success message after a short delay
        setTimeout(function() {
            $btn.removeClass('resetting');
            $btn.prop('disabled', false);
            
            // Show success message
            $success.addClass('show');
            
            // Hide success message after animation
            setTimeout(function() {
                $success.removeClass('show');
            }, 2000);
        }, 500);
    }
    
    /**
     * Initialize when customizer is ready
     */
    wp.customize.bind('ready', function() {
        
        // Bind reset button click
        $(document).on('click', '#linkawy-reset-colors', function(e) {
            e.preventDefault();
            
            // Confirm before resetting
            if (confirm(linkawayControlsL10n.confirmReset || 'هل أنت متأكد من إعادة تعيين جميع الألوان إلى القيم الافتراضية؟')) {
                resetColorsToDefault();
            }
        });
        
        // Update color pickers visibility when preset changes
        wp.customize('linkawy_color_preset', function(setting) {
            setting.bind(function(preset) {
                // If preset is not custom, apply preset colors
                if (preset !== 'custom' && typeof linkawayPresets !== 'undefined' && linkawayPresets[preset]) {
                    var colors = linkawayPresets[preset];
                    
                    // Map preset colors to settings
                    var colorMapping = {
                        'linkawy_primary_color': colors.primary,
                        'linkawy_secondary_color': colors.secondary,
                        'linkawy_accent_color': colors.accent,
                        'linkawy_text_primary': colors.text_primary,
                        'linkawy_text_secondary': colors.text_secondary,
                        'linkawy_bg_light': colors.bg_light,
                        'linkawy_bg_dark': colors.bg_dark,
                        'linkawy_link_color': colors.link,
                        'linkawy_button_bg': colors.button_bg
                    };
                    
                    // Update each color setting silently
                    $.each(colorMapping, function(settingId, value) {
                        if (wp.customize(settingId)) {
                            wp.customize(settingId).set(value);
                        }
                    });
                }
            });
        });
    });

})(jQuery);
