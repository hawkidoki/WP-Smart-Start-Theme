<?php get_header(); ?>
    
    <?php if(have_archive_page()): ?>
        <?php while(have_archive_page()): the_archive_page(); ?>
        
            <header class="page-header">
            
                <h1 class="page-title"><?php the_field('blog_slogan'); ?></h1>
                
            </header><!-- end .page-header -->

        <?php endwhile; wp_reset_postdata(); ?>
    <?php endif; ?>
    
    <?php
    wpsst_section(array(
        'pagination'    => true,
        'wrapper'       => array(
            'attr' => array(
                'id' => 'main',
            )
        )
    ));
    ?>
    <!-- end #main -->
    
    <?php get_sidebar(); ?>

<?php get_footer(); ?>