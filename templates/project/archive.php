<?php get_header(); ?>
    
    <?php if(have_archive_page()): ?>
        <?php while(have_archive_page()): the_archive_page(); ?>
            <header class="page-header">
            
                <h1 class="page-title"><?php echo get_field('projects_slogan'); ?></h1>
                
                <?php if($all_project_category = get_query_var('wpsst_all_project_category')){ ?>
                    <ul id="portfolio-items-filter">
                        <li><?php _e('Showing', 'wpsst'); ?></li>
                        <li><a data-categories="*"><?php _e('All', 'wpsst'); ?></a></li>
                        
                        <?php foreach($all_project_category as $term){ ?>
                            <li><a data-categories="<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
                        <?php } ?>

                    </ul><!-- end #portfolio-items-filter -->
                <?php } ?>
                
            </header><!-- end .page-header -->
            
        <?php endwhile; wp_reset_postdata(); ?>
    <?php endif; ?>
    
    <?php
    wpsst_section(array(
        'template'  => 'sections/cards-project.php',
        'wrapper'   => array(
            'attr'      => array(
                'id'    => 'portfolio-items',
                'class' => 'clearfix',
            )
        )
    ));
    ?>
    <!-- end #portfolio-items -->

<?php get_footer(); ?>