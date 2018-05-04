<?php
/**
 * Enqueue
 */
add_action('wp_enqueue_scripts', 'wpsst_enqueue');
function wpsst_enqueue(){
    // Google Fonts
    wp_register_style('google-fonts', add_query_arg(array('family' => 'Open+Sans:400,600,300,800,700,400italic|PT+Serif:400,400italic'), '//fonts.googleapis.com/css'), array(), null, false);
    
    // Google Maps API
    wp_register_script('google-maps', add_query_arg(array('sensor' => 'false', 'key' => (($api_google_maps = get_query_var('wpsst_api_google_maps')) ? $api_google_maps : '')), '//maps.google.com/maps/api/js'), array(), null, true);
    
    // Styles
    wp_enqueue_style('style',               WPSST_THEME_URL . '/assets/css/style.css',                          array(),            null, 'screen');
    wp_enqueue_style('google-fonts');
    wp_enqueue_style('fancybox',            WPSST_THEME_URL . '/assets/css/lib/fancybox.min.css',               array(),            null, 'screen');
    wp_enqueue_style('video-js',            WPSST_THEME_URL . '/assets/css/lib/video-js.min.css',               array(),            null, 'screen');
    wp_enqueue_style('audioplayer',         WPSST_THEME_URL . '/assets/css/lib/audioplayerv1.min.css',          array(),            null, 'screen');
    
    // Scripts
    wp_enqueue_script('modernizr',          WPSST_THEME_URL . '/assets/js/lib/modernizr.custom.js',             array(),            null, false);
    wp_enqueue_script('video-js',           WPSST_THEME_URL . '/assets/js/lib/video.min.js',                    array(),            null, false);
    
    wp_enqueue_script('google-maps');
    wp_enqueue_script('respond',            WPSST_THEME_URL . '/assets/js/lib/respond.min.js',                  array('jquery'),    null, true);
    wp_enqueue_script('easing',             WPSST_THEME_URL . '/assets/js/lib/jquery.easing-1.3.min.js',        array('jquery'),    null, true);
    wp_enqueue_script('fancybox',           WPSST_THEME_URL . '/assets/js/lib/jquery.fancybox.pack.js',         array('jquery'),    null, true);
    wp_enqueue_script('smartSlider',        WPSST_THEME_URL . '/assets/js/lib/jquery.smartStartSlider.min.js',  array('jquery'),    null, true);
    wp_enqueue_script('jcarousel',          WPSST_THEME_URL . '/assets/js/lib/jquery.jcarousel.min.js',         array('jquery'),    null, true);
    wp_enqueue_script('cycle',              WPSST_THEME_URL . '/assets/js/lib/jquery.cycle.all.min.js',         array('jquery'),    null, true);
    wp_enqueue_script('isotope',            WPSST_THEME_URL . '/assets/js/lib/jquery.isotope.min.js',           array('jquery'),    null, true);
    wp_enqueue_script('gmap',               WPSST_THEME_URL . '/assets/js/lib/jquery.gmap.min.js',              array('jquery'),    null, true);
    wp_enqueue_script('touchSwipe',         WPSST_THEME_URL . '/assets/js/lib/jquery.touchSwipe.min.js',        array('jquery'),    null, true);
    wp_enqueue_script('custom',             WPSST_THEME_URL . '/assets/js/custom.js',                           array('jquery'),    null, true);
    
    // Vars
    wp_localize_script('video-js', '_V_', array('options' => array('flash' =>array('swf' => WPSST_THEME_URL . '/assets/js/lib/video-js.swf'))));
    
    // Google Map Var
    if(($info = get_query_var('wpsst_informations')) && !empty($info['address']) && !empty($info['postal_code']) && !empty($info['city']) && !empty($info['country']))
        wp_localize_script('google-maps', 'wpsst_marker', $info['address'] . ' ' . $info['postal_code'] . ' ' . $info['city'] . ' ' . $info['country']);
    
    // jQuery
    wp_scripts()->add_data('jquery',            'group', 1);
    wp_scripts()->add_data('jquery-core',       'group', 1);
    wp_scripts()->add_data('jquery-migrate',    'group', 1);
}