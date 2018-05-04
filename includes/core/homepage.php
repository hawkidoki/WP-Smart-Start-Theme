<?php
/**
 * Template
 */
add_filter('template_include', 'wpsst_homepage_template', 999);
function wpsst_homepage_template($template){
	if(is_front_page() && ($locate = locate_template(array('templates/homepage.php'))))
		return $locate;
	
	return $template;
}

/**
 * Editor
 */
add_action('admin_head', 'wpsst_homepage_editor');
function wpsst_homepage_editor(){
    if(get_post_type() != 'page' || get_the_ID() != get_option('page_on_front'))
        return;
    
    remove_post_type_support('page', 'editor');
}