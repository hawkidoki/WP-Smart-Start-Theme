<?php get_header(); ?>
    
    <?php if(have_archive_page()): ?>
        <?php while(have_archive_page()): the_archive_page(); ?>
            <header class="page-header">

                <h1 class="page-title align-left"><?php the_field('team_slogan'); ?></h1>

                <hr />

                <h2 class="page-subdescription"><?php the_content(); ?></h2>
                
            </header><!-- end .page-header -->
            
        <?php endwhile; wp_reset_postdata(); ?>
    <?php endif; ?>
    
    <?php
    wpsst_section(array(
        'template'  => 'sections/cards-team.php',
        'wrapper'   => array(
            'element' => false
        )
    ));
    ?>

<?php get_footer(); ?>