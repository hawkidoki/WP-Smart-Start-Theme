<?php
/**
 * Login Logo Style
 */
add_action('login_enqueue_scripts', 'wpsst_login_style');
function wpsst_login_style(){ ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php wpsst_the_logo_url(); ?>);
            height:80px;
            width:320px;
            background-repeat: no-repeat;
            background-size: contain;
        }
    </style>
<?php }

/**
 * Login Logo URL
 */
add_filter('login_headerurl', 'wpsst_login_url');
function wpsst_login_url() {
    return home_url();
}

/**
 * Login Logo Title
 */
add_filter('login_headertitle', 'wpsst_login_title');
function wpsst_login_title() {
    return wpsst_get_logo_alt();
}