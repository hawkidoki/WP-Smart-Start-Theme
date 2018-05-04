<?php
/**
 * The Logo
 */
function wpsst_the_logo(){
    echo wpsst_get_logo();
}

/**
 * Get The Logo
 */
function wpsst_get_logo(){
    if(!has_custom_logo())
        return '<a href="' . esc_url(home_url('/')) . '" class="custom-logo-link" rel="home" itemprop="url"><img src="' . wpsst_get_logo_url() . '" alt="' . wpsst_get_logo_alt() . '" /></a>';
    
    return get_custom_logo();
}

/**
 * Filter Logo HTML
 */
add_filter('get_custom_logo', 'wpsst_logo_filter_html');
function wpsst_logo_filter_html($html){
    return str_replace('itemprop="url"', 'itemprop="url" id="logo"', $html);
}

/**
 * Logo URL
 */
function wpsst_the_logo_url(){
    echo wpsst_get_logo_url();
}

/**
 * Get Logo URL
 */
function wpsst_get_logo_url(){
    if(!has_custom_logo())
        return WPSST_THEME_URL . '/assets/img/logo.png';
    
    $logo = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full');
    return $logo[0];
}

/**
 * Logo ALT
 */
function wpsst_the_logo_alt(){
    echo wpsst_get_logo_alt();
}

/**
 * Get Logo ALT
 */
function wpsst_get_logo_alt(){
    if(!has_custom_logo())
        return get_bloginfo('name', 'display');
    
    $logo_id = get_theme_mod('custom_logo');
    $alt = get_post_meta($logo_id, '_wp_attachment_image_alt', true);
    if(empty($alt))
        return get_bloginfo('name', 'display');
    
    return $alt;
}