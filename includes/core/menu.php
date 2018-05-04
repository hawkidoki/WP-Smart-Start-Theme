<?php
/**
 * Menu
 */
add_action('init', 'wpsst_menu');
function wpsst_menu() {
    register_nav_menus(array(
        'menu-header'       => __('Menu Header', 'wpsst'),
        'menu-footer'       => __('Menu Footer', 'wpsst'),
        'menu-sub-footer'   => __('Menu Sub-Footer', 'wpsst'),
    ));
}

/**
 * GMenu Class
 */
add_filter('nav_menu_css_class', 'wpsst_menu_class', 10, 3);
function wpsst_menu_class($classes, $item, $args){
    if(in_array('current-menu-item', $classes))
        $classes[] = 'current';
    
    return $classes;
}