<?php
/**
 * Search Form Template
 *
 * @package Linkawy
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="screen-reader-text" for="search-field"><?php _e('بحث عن:', 'linkawy'); ?></label>
    <input type="search" id="search-field" class="search-field" placeholder="<?php esc_attr_e('ابحث في الموقع...', 'linkawy'); ?>" value="<?php echo get_search_query(); ?>" name="s">
    <button type="submit" class="search-submit">
        <i class="fas fa-search"></i>
        <span class="screen-reader-text"><?php _e('بحث', 'linkawy'); ?></span>
    </button>
</form>
