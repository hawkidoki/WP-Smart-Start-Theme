<?php
/**
 * Thumbnail URL
 */
function wpsst_the_post_thumbnail_url($size = '300x190'){
    if($url = wpsst_get_the_post_thumbnail_url(null, $size))
        echo esc_url($url);
}

/**
 * Get Thumbnail URL
 */
function wpsst_get_the_post_thumbnail_url($post = null, $size = '300x190'){
    if(!$post_thumbnail_id = get_post_thumbnail_id($post))
        return WPSST_THEME_URL . '/assets/img/placeholders/placeholder-' . $size . '.jpg';
    
    return wp_get_attachment_image_url($post_thumbnail_id, $size);
}

/**
 * Thumbnail ALT
 */
function wpsst_the_post_thumbnail_alt($post_id = null){
    echo wpsst_get_the_post_thumbnail_alt($post_id);
}

/**
 * Get Thumbnail URL
 */
function wpsst_get_the_post_thumbnail_alt($post_id = null){
    if(!$alt = get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true))
        return get_the_title($post_id);
    
    return $alt;
}

/**
 * Unregister Native Thumbnails sizes
 */
add_filter('intermediate_image_sizes_advanced', 'wpsst_image_sizes');
function wpsst_image_sizes($sizes){
    unset($sizes['thumbnail']);
    unset($sizes['medium']);
    unset($sizes['medium_large']);
    unset($sizes['large']);
    
    return $sizes;
}