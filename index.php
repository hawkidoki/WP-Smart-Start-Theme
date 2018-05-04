<?php get_header(); ?>

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
    
    <?php get_sidebar(); ?>

<?php get_footer(); ?>