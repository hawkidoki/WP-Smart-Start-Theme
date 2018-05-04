<?php
/**
 * Arguments
 */
add_filter('register_taxonomy_args', 'wpsst_taxonomy_category_args', 0, 3);
function wpsst_taxonomy_category_args($args, $name, $taxonomy){
    if($name != 'category')
        return $args;
    
    $args['wpsst_template'] = 'templates/category/taxonomy.php';
    
    return $args;
}