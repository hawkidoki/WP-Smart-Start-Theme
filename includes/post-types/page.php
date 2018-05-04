<?php
/**
 * Re-Add Editor for Post Archive Page
 */
add_action('edit_form_after_title', 'wpsst_post_type_page_blog_editor', 0);
function wpsst_post_type_page_blog_editor($post){
    if($post->ID != get_option('page_for_posts'))
        return;

    remove_action('edit_form_after_title', '_wp_posts_page_notice');
    add_post_type_support('page', 'editor');
}

/**
 * Page Template State
 */
add_filter('display_post_states', 'wpsst_post_type_page_template_state', 10, 2);
function wpsst_post_type_page_template_state($states, $post){
    if(!$template = get_page_template_slug($post->ID))
        return $states;
    
    foreach(get_page_templates($post) as $name => $path){
        if($path != $template)
            continue;
        
        $states[] = __($name);
        break;
    }

    return $states;
}