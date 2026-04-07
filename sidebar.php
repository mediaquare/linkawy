<?php
/**
 * Sidebar Template
 *
 * @package Linkawy
 */

if (!is_active_sidebar('sidebar-article')) {
    return;
}
?>

<aside id="secondary" class="widget-area">
    <?php dynamic_sidebar('sidebar-article'); ?>
</aside>
