<?php
/**
 * Pre Get Posts Dynamique
 */
add_action('pre_get_posts', 'wpsst_post_types_query');
function wpsst_post_types_query($query){
    if(is_admin() || !$query->is_main_query())
        return;
    
    // Post Types
    if($query->is_post_type_archive()){
        foreach(get_post_types(array('publicly_queryable' => true), 'objects') as $post_type){
            if($query->get('post_type') != $post_type->name || !$post_type->has_archive || !$query->is_post_type_archive($post_type->name) || !isset($post_type->wpsst_posts_per_page))
                continue;
            
            $posts_per_page = (int) $post_type->wpsst_posts_per_page;
            $query->set('posts_per_page', $posts_per_page);
        }
    }
    
    // Taxonomies
    elseif($query->is_tax() || $query->is_category() || $query->is_tag()){
        foreach(get_taxonomies(array('public' => true), 'objects') as $taxonomy){
            if(!isset(get_queried_object()->taxonomy) || get_queried_object()->taxonomy != $taxonomy->name || !isset($taxonomy->wpsst_posts_per_page))
                continue;
            
            $posts_per_page = (int) $taxonomy->wpsst_posts_per_page;
            $query->set('posts_per_page', $posts_per_page);
        }
    }
}