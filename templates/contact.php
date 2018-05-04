<?php 
/**
 * Template Name: Contact
 */

get_header(); ?>

    <div class="container clearfix">

		<header class="page-header">
		
			<h1 class="page-title"><?php the_field('contact_slogan'); ?></h1>
			
		</header><!-- end .page-header -->

	</div><!-- end .container -->

	<section id="map">
		<p class="container"><?php _e('Something went wrong... Try to enable your JavaScript!', 'wpsst'); ?></p>
	</section><!-- end #map -->

	<div class="container clearfix">
		
		<div class="one-fourth">
        
            <?php if($information = get_query_var('wpsst_informations')){ ?>
            
                <?php if($contact_title = get_field('contact_title')){ ?>
                    <h3><?php echo $contact_title; ?></h3>
                <?php } ?>
                
                <?php if($information['address'] || $information['city'] || $information['postal_code'] || $information['country']){ ?>
                    <p>
                        <?php if($information['address']){ ?>
                            <?php echo $information['address']; ?><br/>
                        <?php } ?>
                        <?php if($information['city']){ ?>
                            <?php echo $information['city']; ?>
                        <?php } ?>
                        <?php if($information['postal_code']){ ?>
                            , <?php echo $information['postal_code']; ?>
                        <?php } ?>
                        <?php if($information['country']){ ?>
                            <br/><?php echo $information['country']; ?>
                        <?php } ?>
                    </p>
                <?php } ?>
                
                <?php if($information['phone'] || $information['fax'] || $information['email'] || $information['website']){ ?>
                    <p>
                        <?php if($information['phone']){ ?>
                            <?php _e('Phone', 'wpsst'); ?>: <?php echo $information['phone']; ?><br/>
                        <?php } ?>
                        <?php if($information['fax']){ ?>
                            <?php _e('Fax', 'wpsst'); ?>: <?php echo $information['fax']; ?><br/>
                        <?php } ?>
                        <?php if($information['email']){ ?>
                            <?php _e('Email', 'wpsst'); ?>: <?php echo $information['email']; ?><br/>
                        <?php } ?>
                        <?php if($information['website']){ ?>
                            <?php _e('Web', 'wpsst'); ?>: <?php echo $information['website']; ?>
                        <?php } ?>
                    </p>
                <?php } ?>
            <?php } ?>
			
		</div><!-- end .one-fourth -->
        
        <?php if($contact_form_id = get_field('contact_form_id')){ ?>
            <div class="three-fourth last">
                
                <?php if($contact_form_slogan = get_field('contact_form_slogan')){ ?>
                    <h3><?php echo $contact_form_slogan; ?></h3>
                <?php } ?>
                
                <?php echo do_shortcode('[contact-form-7 id="' . $contact_form_id[0] . '" html_class="contact-form"]'); ?>

            </div><!-- end .three-fourth.last -->
        <?php } ?>

	</div><!-- end .container -->

<?php get_footer(); ?>