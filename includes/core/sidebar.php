<?php
/**
 * Sidebars
 */
add_action('widgets_init', 'wpsst_sidebar');
function wpsst_sidebar() {
    register_sidebar(array(
        'id'            => 'sidebar-main',
        'name'          => __('Main Sidebar', 'wpsst'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h6 class="widget-title">',
        'after_title'   => '</h6>',
    ));
    
    register_sidebar(array(
        'id'            => 'sidebar-post',
        'name'          => __('Blog Sidebar', 'wpsst'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h6 class="widget-title">',
        'after_title'   => '</h6>',
    ));
}