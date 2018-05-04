<?php
/**
 * Theme Setup
 */
add_action('after_setup_theme', 'wpsst_theme_setup');
function wpsst_theme_setup(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    
    add_theme_support('html5', array(
        'comment-list', 
        'comment-form', 
        'search-form', 
        'gallery', 
        'caption'
    ));
    
    add_theme_support('custom-logo', array(
		'width'           	=> 139,
		'height'          	=> 86,
        'flex-width'    	=> false,
        'flex-height'    	=> false,
		'header-text'     	=> false
	));

	add_image_size('220x140', 220, 140, true);
    add_image_size('300x190', 300, 190, true);
    add_image_size('680x235', 680, 235, true);
    add_image_size('680x600', 680, 600, true);
    add_image_size('940x380', 940, 380, true);
}