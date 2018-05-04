<?php
/**
 * Addmin Menu
 */
add_action('admin_menu', '_pit_post_type_page_menu', 999);
function _pit_post_type_page_menu(){
    global $menu;
	
    $menu['4.5'] = $menu[20];
    unset($menu[20]);
	
	$menu['8.5'] = array(
		'',
		'read',
		'separator8.5',
		'',
		'wp-menu-separator',
	);
}