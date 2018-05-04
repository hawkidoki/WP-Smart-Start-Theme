<?php
/**
 * Arguments
 */
add_filter('register_post_type_args', 'wpsst_post_type_post_args', 0, 2);
function wpsst_post_type_post_args($args, $post_type){
    if($post_type != 'post')
        return $args;
    
    $args['wpsst_template_archive'] = 'templates/post/archive.php';
    $args['wpsst_template_single'] = 'templates/post/single.php';
    
    return $args;
}

/**
 * WP_Post Object Extend
 */
add_filter('posts_results', 'wpsst_post_type_post_posts_results', 10, 2);
function wpsst_post_type_post_posts_results($posts, $query){
    if(empty($posts))
        return $posts;
    
    foreach($posts as $post){
        if(get_post_type($post) != 'post')
            continue;
        
        // Category
        $post->wpsst_category = false;
        if($terms = get_the_terms($post->ID, 'category'))
            $post->wpsst_category = $terms;
        
        // Post_tag
        $post->wpsst_post_tag = false;
        if($terms = get_the_terms($post->ID, 'post_tag'))
            $post->wpsst_post_tag = $terms;
        
    }

    return $posts;
}