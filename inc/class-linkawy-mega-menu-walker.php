<?php
/**
 * Custom Walker for Mega Menu
 * 
 * Extends Walker_Nav_Menu to support mega menu functionality
 * with custom CTA sections and proper HTML structure.
 *
 * @package Linkawy
 */

if (!defined('ABSPATH')) {
    exit;
}

class Linkawy_Mega_Menu_Walker extends Walker_Nav_Menu {
    
    /**
     * Track if we're inside a mega menu
     */
    private $in_mega_menu = false;
    
    /**
     * Store the current mega menu parent item
     */
    private $mega_menu_parent = null;
    
    /**
     * Starts the list before the elements are added.
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param int      $depth  Depth of menu item.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function start_lvl(&$output, $depth = 0, $args = null) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat($t, $depth);
        
        // Check if parent has mega menu enabled
        if ($depth === 0 && $this->in_mega_menu) {
            // Start mega menu structure
            $output .= "{$n}{$indent}<div class=\"mega-menu\">{$n}";
            $output .= "{$indent}{$t}<div class=\"mega-menu-services\">{$n}";
            $output .= "{$indent}{$t}{$t}<ul>{$n}";
        } else {
            // Regular submenu
            $classes = array('sub-menu');
            $class_names = implode(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
            $output .= "{$n}{$indent}<ul{$class_names}>{$n}";
        }
    }
    
    /**
     * Ends the list of after the elements are added.
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param int      $depth  Depth of menu item.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function end_lvl(&$output, $depth = 0, $args = null) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat($t, $depth);
        
        // Check if we're closing a mega menu
        if ($depth === 0 && $this->in_mega_menu && $this->mega_menu_parent) {
            // Close the services ul
            $output .= "{$indent}{$t}{$t}</ul>{$n}";
            $output .= "{$indent}{$t}</div>{$n}"; // Close mega-menu-services
            
            // Add CTA section if data exists
            $output .= $this->get_cta_section($this->mega_menu_parent, $indent . $t);
            
            // Close mega menu
            $output .= "{$indent}</div>{$n}"; // Close mega-menu
            
            // Reset mega menu state
            $this->in_mega_menu = false;
            $this->mega_menu_parent = null;
        } else {
            $output .= "{$indent}</ul>{$n}";
        }
    }
    
    /**
     * Starts the element output.
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param WP_Post  $item   Menu item data object.
     * @param int      $depth  Depth of menu item.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     * @param int      $id     Current item ID.
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ($depth) ? str_repeat($t, $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Check if this item has mega menu enabled
        $enable_mega_menu = get_post_meta($item->ID, '_menu_item_enable_mega_menu', true);
        $has_children = in_array('menu-item-has-children', $classes);
        
        if ($depth === 0 && $enable_mega_menu && $has_children) {
            $classes[] = 'has-dropdown';
            $this->in_mega_menu = true;
            $this->mega_menu_parent = $item;
        }
        
        $class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id_attr = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id_attr = $id_attr ? ' id="' . esc_attr($id_attr) . '"' : '';
        
        $output .= $indent . '<li' . $id_attr . $class_names . '>';
        
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        if ('_blank' === $item->target && empty($item->xfn)) {
            $atts['rel'] = 'noopener';
        } else {
            $atts['rel'] = $item->xfn;
        }
        $atts['href']         = !empty($item->url) ? $item->url : '';
        $atts['aria-current'] = $item->current ? 'page' : '';
        
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (is_scalar($value) && '' !== $value && false !== $value) {
                $value       = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
        
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        
        // Add chevron icon for mega menu items
        if ($depth === 0 && $enable_mega_menu && $has_children) {
            $item_output .= ' <i class="fas fa-chevron-down"></i>';
        }
        
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    /**
     * Generate CTA section HTML
     *
     * @param WP_Post $item   Menu item data object.
     * @param string  $indent Indentation string.
     * @return string CTA section HTML.
     */
    private function get_cta_section($item, $indent) {
        $cta_title       = get_post_meta($item->ID, '_menu_item_mega_menu_cta_title', true);
        $cta_description = get_post_meta($item->ID, '_menu_item_mega_menu_cta_description', true);
        $cta_button_text = get_post_meta($item->ID, '_menu_item_mega_menu_cta_button_text', true);
        $cta_button_url  = get_post_meta($item->ID, '_menu_item_mega_menu_cta_button_url', true);
        
        // Only output CTA section if we have at least a title or button
        if (empty($cta_title) && empty($cta_button_text)) {
            return '';
        }
        
        $output = "{$indent}<div class=\"mega-menu-cta\">\n";
        
        if (!empty($cta_title)) {
            $output .= "{$indent}\t<div class=\"mega-menu-cta-title\">" . esc_html($cta_title) . "</div>\n";
        }
        
        if (!empty($cta_description)) {
            $output .= "{$indent}\t<p>" . esc_html($cta_description) . "</p>\n";
        }
        
        if (!empty($cta_button_text) && !empty($cta_button_url)) {
            $output .= "{$indent}\t<a href=\"" . esc_url($cta_button_url) . "\" class=\"mega-menu-btn\">";
            $output .= esc_html($cta_button_text);
            $output .= " <i class=\"fas fa-arrow-right\"></i></a>\n";
        }
        
        $output .= "{$indent}</div>\n";
        
        return $output;
    }
}
