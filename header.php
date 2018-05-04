<!DOCTYPE html>
<html class="not-ie no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<?php wp_head(); ?>
</head>
<body>

<header id="header" class="container clearfix">

    <?php wpsst_the_logo(); ?>

    <nav id="main-nav">
        <?php
        wp_nav_menu(array(
            'theme_location'    => 'menu-header',
            'container'         => false,
            'fallback_cb'       => false,
        ));
        ?>
    </nav>
    <!-- end #main-nav -->
	
</header><!-- end #header -->

<section id="content" class="container clearfix">