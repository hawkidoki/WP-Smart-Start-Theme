</section><!-- end #content -->

<footer id="footer" class="clearfix">

	<div class="container">

		<div class="three-fourth">

			<nav id="footer-nav" class="clearfix">
            
                <?php
                wp_nav_menu(array(
                    'theme_location'    => 'menu-footer',
                    'container'         => false,
                    'fallback_cb'       => false,
                ));
                ?>
				
			</nav><!-- end #footer-nav -->
            <?php if($information = get_query_var('wpsst_informations')){ ?>
                <ul class="contact-info">
                    <li class="address">
                        <?php if($information['address']){ ?>
                            <?php echo $information['address']; ?> 
                        <?php } ?>
                        <?php if($information['city']){ ?>
                            <?php echo $information['city']; ?>
                        <?php } ?>
                        <?php if($information['postal_code']){ ?>
                            , <?php echo $information['postal_code']; ?> 
                        <?php } ?>
                        <?php if($information['country']){ ?>
                            <?php echo $information['country']; ?>
                        <?php } ?>
                    </li>
                    <?php if($information['phone']){ ?>
                        <li class="phone"><?php echo $information['phone']; ?></li>
                    <?php } ?>
                    <?php if($information['email']){ ?>
                        <li class="email"><a href="mailto:<?php echo $information['email']; ?>"><?php echo $information['email']; ?></a></li>
                    <?php } ?>
                </ul><!-- end .contact-info -->
            <?php } ?>
			
		</div><!-- end .three-fourth -->

		<div class="one-fourth last">
            
            <?php if($social_medias = get_query_var('wpsst_social_medias')){ ?>
                <span class="title"><?php _e('Stay connected', 'wpsst'); ?></span>
                
                <ul class="social-links">
                    <?php foreach($social_medias as $social_media){ ?>
                        <li class="<?php echo $social_media['type']; ?>">
                            <a href="<?php echo $social_media['url'] ?>" <?php echo (isset($social_media['target'])) ? 'target="' . $social_media['target'] . '"' : ''; ?>><?php echo (isset($social_media['title'])) ? $social_media['title'] : ''; ?></a>
                        </li>
                    <?php } ?>
                </ul><!-- end .social-links -->
            <?php } ?>

		</div><!-- end .one-fourth.last -->
		
	</div><!-- end .container -->

</footer><!-- end #footer -->

<footer id="footer-bottom" class="clearfix">

	<div class="container">
    
        <?php
        wp_nav_menu(array(
            'theme_location'    => 'menu-sub-footer',
            'container'         => false,
            'fallback_cb'       => false,
            'items_wrap'        => '<ul id="%1$s" class="%2$s"><li>' . get_bloginfo('name') . ' &copy; ' . date('Y') . '</li>%3$s</ul>'
        ));
        ?>

	</div><!-- end .container -->

</footer><!-- end #footer-bottom -->

<?php wp_footer(); ?>
</body>
</html>