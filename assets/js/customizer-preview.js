/**
 * Linkawy Theme Customizer Live Preview
 * 
 * Handles real-time color updates in the WordPress Customizer
 * 
 * @package Linkawy
 */

(function($) {
    'use strict';
    
    /**
     * Convert HEX to RGB
     * @param {string} hex - HEX color code
     * @returns {object} RGB values
     */
    function hexToRgb(hex) {
        hex = hex.replace('#', '');
        
        if (hex.length === 3) {
            hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
        }
        
        return {
            r: parseInt(hex.substring(0, 2), 16),
            g: parseInt(hex.substring(2, 4), 16),
            b: parseInt(hex.substring(4, 6), 16)
        };
    }
    
    /**
     * Convert RGB to HSL
     * @param {number} r - Red (0-255)
     * @param {number} g - Green (0-255)
     * @param {number} b - Blue (0-255)
     * @returns {object} HSL values
     */
    function rgbToHsl(r, g, b) {
        r /= 255;
        g /= 255;
        b /= 255;
        
        var max = Math.max(r, g, b);
        var min = Math.min(r, g, b);
        var h, s, l = (max + min) / 2;
        
        if (max === min) {
            h = s = 0;
        } else {
            var d = max - min;
            s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
            
            switch (max) {
                case r:
                    h = ((g - b) / d + (g < b ? 6 : 0)) / 6;
                    break;
                case g:
                    h = ((b - r) / d + 2) / 6;
                    break;
                case b:
                    h = ((r - g) / d + 4) / 6;
                    break;
            }
        }
        
        return { h: h * 360, s: s * 100, l: l * 100 };
    }
    
    /**
     * Convert HSL to RGB
     * @param {number} h - Hue (0-360)
     * @param {number} s - Saturation (0-100)
     * @param {number} l - Lightness (0-100)
     * @returns {object} RGB values
     */
    function hslToRgb(h, s, l) {
        h /= 360;
        s /= 100;
        l /= 100;
        
        var r, g, b;
        
        if (s === 0) {
            r = g = b = l;
        } else {
            var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
            var p = 2 * l - q;
            
            r = hueToRgb(p, q, h + 1/3);
            g = hueToRgb(p, q, h);
            b = hueToRgb(p, q, h - 1/3);
        }
        
        return {
            r: Math.round(r * 255),
            g: Math.round(g * 255),
            b: Math.round(b * 255)
        };
    }
    
    /**
     * Helper for HSL to RGB conversion
     */
    function hueToRgb(p, q, t) {
        if (t < 0) t += 1;
        if (t > 1) t -= 1;
        if (t < 1/6) return p + (q - p) * 6 * t;
        if (t < 1/2) return q;
        if (t < 2/3) return p + (q - p) * (2/3 - t) * 6;
        return p;
    }
    
    /**
     * Convert RGB to HEX
     * @param {number} r - Red
     * @param {number} g - Green
     * @param {number} b - Blue
     * @returns {string} HEX color code
     */
    function rgbToHex(r, g, b) {
        return '#' + [r, g, b].map(function(x) {
            var hex = x.toString(16);
            return hex.length === 1 ? '0' + hex : hex;
        }).join('');
    }
    
    /**
     * Calculate color variations from a base color
     * @param {string} hex - Base HEX color
     * @returns {object} Color variations
     */
    function calculateColorVariations(hex) {
        var rgb = hexToRgb(hex);
        var hsl = rgbToHsl(rgb.r, rgb.g, rgb.b);
        
        // Calculate variations
        var darkHsl = { h: hsl.h, s: hsl.s, l: Math.max(0, hsl.l - 15) };
        var lightHsl = { h: hsl.h, s: hsl.s, l: Math.min(100, hsl.l + 15) };
        var lighterHsl = { h: hsl.h, s: Math.max(0, hsl.s - 20), l: Math.min(100, hsl.l + 30) };
        var bgHsl = { h: hsl.h, s: Math.max(0, hsl.s - 40), l: Math.min(100, 97) };
        
        // Convert back to HEX
        var darkRgb = hslToRgb(darkHsl.h, darkHsl.s, darkHsl.l);
        var lightRgb = hslToRgb(lightHsl.h, lightHsl.s, lightHsl.l);
        var lighterRgb = hslToRgb(lighterHsl.h, lighterHsl.s, lighterHsl.l);
        var bgRgb = hslToRgb(bgHsl.h, bgHsl.s, bgHsl.l);
        
        return {
            dark: rgbToHex(darkRgb.r, darkRgb.g, darkRgb.b),
            light: rgbToHex(lightRgb.r, lightRgb.g, lightRgb.b),
            lighter: rgbToHex(lighterRgb.r, lighterRgb.g, lighterRgb.b),
            bg: rgbToHex(bgRgb.r, bgRgb.g, bgRgb.b),
            rgb: rgb.r + ', ' + rgb.g + ', ' + rgb.b
        };
    }
    
    /**
     * Update all CSS variables for a color set
     * @param {object} colors - Color values object
     */
    function updateAllColors(colors) {
        var root = document.documentElement;
        var variations = calculateColorVariations(colors.primary);
        
        // Primary colors
        root.style.setProperty('--primary-color', colors.primary);
        root.style.setProperty('--primary-color-dark', variations.dark);
        root.style.setProperty('--primary-color-light', variations.light);
        root.style.setProperty('--primary-color-lighter', variations.lighter);
        root.style.setProperty('--primary-color-bg', variations.bg);
        root.style.setProperty('--primary-color-rgb', variations.rgb);
        
        // Secondary & Accent
        root.style.setProperty('--secondary-color', colors.secondary);
        root.style.setProperty('--accent-color', colors.accent);
        
        // Text colors
        root.style.setProperty('--text-color', colors.text_primary);
        root.style.setProperty('--text-main', colors.text_primary);
        root.style.setProperty('--text-primary', colors.text_primary);
        root.style.setProperty('--text-secondary', colors.text_secondary);
        root.style.setProperty('--text-gray', colors.text_secondary);
        
        // Background colors
        root.style.setProperty('--bg-light', colors.bg_light);
        root.style.setProperty('--light-bg', colors.bg_light);
        root.style.setProperty('--bg-dark', colors.bg_dark);
        root.style.setProperty('--dark-bg', colors.bg_dark);
        
        // Link & Button colors
        root.style.setProperty('--link-color', colors.link);
        root.style.setProperty('--link-hover-color', variations.dark);
        root.style.setProperty('--button-bg', colors.button_bg);
        root.style.setProperty('--button-hover-bg', variations.dark);
    }
    
    /**
     * Load preset colors
     * @param {string} preset - Preset name
     */
    function loadPresetColors(preset) {
        if (typeof linkawayPresets !== 'undefined' && linkawayPresets[preset]) {
            updateAllColors(linkawayPresets[preset]);
        }
    }
    
    /**
     * Update primary color and its variations
     * @param {string} color - HEX color value
     */
    function updatePrimaryColor(color) {
        var root = document.documentElement;
        var variations = calculateColorVariations(color);
        
        root.style.setProperty('--primary-color', color);
        root.style.setProperty('--primary-color-dark', variations.dark);
        root.style.setProperty('--primary-color-light', variations.light);
        root.style.setProperty('--primary-color-lighter', variations.lighter);
        root.style.setProperty('--primary-color-bg', variations.bg);
        root.style.setProperty('--primary-color-rgb', variations.rgb);
        
        // Also update link and button colors if they match primary
        root.style.setProperty('--link-color', color);
        root.style.setProperty('--link-hover-color', variations.dark);
        root.style.setProperty('--button-bg', color);
        root.style.setProperty('--button-hover-bg', variations.dark);
    }
    
    // =====================================================
    // Customizer Bindings
    // =====================================================
    
    // Color Preset Change
    wp.customize('linkawy_color_preset', function(value) {
        value.bind(function(preset) {
            if (preset !== 'custom') {
                loadPresetColors(preset);
            }
        });
    });
    
    // Primary Color
    wp.customize('linkawy_primary_color', function(value) {
        value.bind(function(newval) {
            updatePrimaryColor(newval);
        });
    });
    
    // Secondary Color
    wp.customize('linkawy_secondary_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--secondary-color', newval);
        });
    });
    
    // Accent Color
    wp.customize('linkawy_accent_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--accent-color', newval);
        });
    });
    
    // Text Primary Color
    wp.customize('linkawy_text_primary', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--text-color', newval);
            document.documentElement.style.setProperty('--text-main', newval);
            document.documentElement.style.setProperty('--text-primary', newval);
        });
    });
    
    // Text Secondary Color
    wp.customize('linkawy_text_secondary', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--text-secondary', newval);
            document.documentElement.style.setProperty('--text-gray', newval);
        });
    });
    
    // Background Light Color
    wp.customize('linkawy_bg_light', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--bg-light', newval);
            document.documentElement.style.setProperty('--light-bg', newval);
        });
    });
    
    // Background Dark Color
    wp.customize('linkawy_bg_dark', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--bg-dark', newval);
            document.documentElement.style.setProperty('--dark-bg', newval);
        });
    });
    
    // Link Color
    wp.customize('linkawy_link_color', function(value) {
        value.bind(function(newval) {
            var variations = calculateColorVariations(newval);
            document.documentElement.style.setProperty('--link-color', newval);
            document.documentElement.style.setProperty('--link-hover-color', variations.dark);
        });
    });
    
    // Button Background Color
    wp.customize('linkawy_button_bg', function(value) {
        value.bind(function(newval) {
            var variations = calculateColorVariations(newval);
            document.documentElement.style.setProperty('--button-bg', newval);
            document.documentElement.style.setProperty('--button-hover-bg', variations.dark);
        });
    });

})(jQuery);
