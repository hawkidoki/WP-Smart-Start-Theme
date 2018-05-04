<?php get_header(); ?>

    <?php 
    wpsst_section(array(
        'comments'  => true,
        'options'   => array(
            'type' => 'single'
        ),
        'wrapper'   => array(
            'attr' => array(
                'id' => 'main',
            )
        )
    ));
    ?>
    
    <?php get_sidebar(); ?>

<?php get_footer(); ?>