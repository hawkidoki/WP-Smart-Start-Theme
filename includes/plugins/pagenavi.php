<?php
/**
 * WP PageNavi Previous
 */
add_filter('wp_pagenavi_class_previouspostslink', 'wpsst_plugins_wp_pagenavi_class_previous');
function wpsst_plugins_wp_pagenavi_class_previous(){
    return 'prev';
}

/**
 * WP PageNavi Next
 */
add_filter('wp_pagenavi_class_nextpostslink', 'wpsst_plugins_wp_pagenavi_class_next');
function wpsst_plugins_wp_pagenavi_class_next(){
    return 'next';
}

/**
 * WP PageNavi Parser
 */
add_filter('wp_pagenavi', 'wpsst_plugins_wp_pagenavi_filter');
function wpsst_plugins_wp_pagenavi_filter($out){
    $out = str_replace('<a class="next"', '<li class="next"><a', $out);
    $out = str_replace('<a class="prev"', '<li class="prev"><a', $out);
    
    $out = str_replace('<a class', '<li><a class', $out);
    
    $out = str_replace('</a>', '</a></li>', $out);
    
    $out = str_replace('<span class=\'current\'', '<li class="current"><span', $out);
    $out = str_replace('<span class=\'pages\'', '<li><span', $out);
    $out = str_replace('<span class=\'extend\'', '<li class="extend"><span', $out);
    
    $out = str_replace('</span>', '</span></li>', $out);
    
    return $out;
}