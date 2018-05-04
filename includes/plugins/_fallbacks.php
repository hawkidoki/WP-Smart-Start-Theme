<?php
/**
 * Plugins Fallbacks
 */
add_action('wp', 'wpsst_plugins_loadedd', 0);
function wpsst_plugins_loadedd(){
    if(!wpsst_has_plugin('acf')){
        function get_field(){
            return false;
        }

        function the_field(){
            return false;
        }
    }
    if(!wpsst_has_plugin('pagenavi')){
        function wp_pagenavi(){
            return false;
        }
    }
}