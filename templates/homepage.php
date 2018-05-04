<?php get_header(); ?>

    <?php 
    wpsst_section(array(
        'template'  => 'sections/slider.php',
        'query'     => array(
            'post_type'         => 'project',
            'posts_per_page'    => 4,
            'meta_query'        => array(
                array(
                    'key'   => 'featured',
                    'value' => '1'
                )
            )
        ),
        'title' => '<h2 class="slogan align-center">' . get_field('homepage_slogan') . '</h2>',
        'wrapper'   => array(
            'title'     => true,
            'attr'      => array(
                'id'    => 'features-slider',
                'class' => 'ss-slider',
            )
        )
    ));
    ?>

    <?php
    wpsst_section(array(
        'template'  => 'sections/carousel.php',
        'query'     => array(
            'post_type'         => 'project',
            'posts_per_page'    => 8,
        ),
        'title' => '<h6 class="section-title">' . get_field('homepage_project_title') . '</h6>',
        'wrapper'   => array(
            'title'     => true,
            'element'   => 'ul',
            'attr'      => array(
                'class' => 'projects-carousel clearfix',
            )
        )
    ));
    ?>
    
    <?php
    wpsst_section(array(
        'template'  => 'sections/carousel-alt.php',
        'query'     => array(
            'post_type'         => 'post',
            'posts_per_page'    => 4,
        ),
        'title' => '<h6 class="section-title">' . get_field('homepage_post_title') . '</h6>',
        'wrapper'   => array(
            'title'     => true,
            'element'   => 'ul',
            'attr'      => array(
                'class' => 'post-carousel',
            )
        )
    ));
    ?>

<?php get_footer(); ?>