<?php
/**
 * Arguments
 */
add_filter('register_taxonomy_args', 'wpsst_taxonomy_post_tag_args', 0, 3);
function wpsst_taxonomy_post_tag_args($args, $name, $taxonomy){
    if($name != 'post_tag')
        return $args;
    
    $args['wpsst_template'] = 'templates/post_tag/taxonomy.php';
    
    return $args;
}