<?php
/**
 * Query Vars
 */
add_action('wp', 'wpsst_post_type_page_query');
function wpsst_post_type_page_query($query){
    set_query_var('wpsst_informations', array(
        'address'           => get_field('information_address',     'options'),
        'city'              => get_field('information_city',        'options'),
        'postal_code'       => get_field('information_postal_code', 'options'),
        'country'           => get_field('information_country',     'options'),
        'phone'             => get_field('information_phone',       'options'),
        'fax'               => get_field('information_fax',         'options'),
        'email'             => get_field('information_email',       'options'),
        'website'           => get_field('information_website',     'options'),
        'api_google_maps'   => get_field('information_website',     'options'),
    ));
    
    set_query_var('wpsst_api_google_maps',  get_field('api_google_maps', 'options'));
    set_query_var('wpsst_social_medias',    get_field('social_medias',  'options'));
}