<?php
/**
 * Templating Dynamique
 */
add_filter('template_include', 'wpsst_post_types_template', 999);
function wpsst_post_types_template($template){
    
    // User Theme Template Bypass
    if($template != get_index_template())
        return $template;
    
    global $wp_query;
    
    // Post Types
    if(is_single() || is_post_type_archive() || is_home()){
        
        foreach(get_post_types(array('publicly_queryable' => true), 'objects') as $post_type){
            if(((isset($wp_query->query['post_type']) && $wp_query->query['post_type'] != $post_type->name) && get_post_type() != $post_type->name) || (!isset($post_type->wpsst_template_archive) && !isset($post_type->wpsst_template_single)))
                continue;
            
            $rule = array();
            $rule['is_archive'] = is_post_type_archive($post_type->name);
            $rule['has_archive'] = $post_type->has_archive;
            
            // Blog Exception
            if($post_type->name == 'post'){
                $rule['is_archive'] = is_home();
                $rule['has_archive'] = true;
            }
            
            if($rule['has_archive'] && $rule['is_archive'] && isset($post_type->wpsst_template_archive) && ($find = $post_type->wpsst_template_archive) && ($locate = locate_template(array($find))))
                return $locate;
            
            elseif(is_singular($post_type->name) && isset($post_type->wpsst_template_single) && ($find = $post_type->wpsst_template_single) && ($locate = locate_template(array($find))))
                return $locate;
                
            return $template;
        }
        
        return $template;
    }
    
    // Taxonomies
    elseif(is_tax() || is_category() || is_tag()){
        foreach(get_taxonomies(array('public' => true), 'objects') as $taxonomy){
            if(!isset(get_queried_object()->taxonomy) || get_queried_object()->taxonomy != $taxonomy->name || !isset($taxonomy->wpsst_template))
                continue;
            
            if($locate = locate_template(array($taxonomy->wpsst_template)))
                return $locate;
            
            return $template;
        }
        
        return $template;
    }
    
    return $template;
}