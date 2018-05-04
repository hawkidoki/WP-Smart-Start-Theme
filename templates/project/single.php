<?php get_header(); ?>
    
    <?php while(have_posts()): the_post(); ?>
    
        <article class="single-project">

            <header class="page-header">

                <h1 class="page-title align-left"><?php _e('Things we have done', 'wpsst'); ?></h1>
                
                <a href="<?php echo get_post_type_archive_link('project'); ?>" class="button no-bg medium align-right">
                    <?php _e('All Projects', 'wpsst'); ?> <img src="img/icon-grid.png" alt="" class="icon">
                </a>

                <hr />

                <h2 class="project-title"><?php the_title(); ?></h2>

                <ul class="portfolio-pagination">
                    <?php if(($previous = get_adjacent_post()) && is_a($previous, 'WP_Post')){ ?>
                        <li class="prev"><a href="<?php echo get_permalink($previous->ID); ?>" class="button medium no-bg"><span class="arrow left">&raquo;</span> <?php _e('Previous', 'wpsst'); ?></a></li>
                    <?php } ?>
                    
                    <?php if(($next = get_adjacent_post(false, '', false)) && is_a($next, 'WP_Post')){ ?>
                        <li class="next"><a href="<?php echo get_permalink($next->ID); ?>" class="button medium no-bg"><?php _e('Next', 'wpsst'); ?> <span class="arrow">&raquo;</span></a></li>
                    <?php } ?>
                </ul><!-- end .portfolio-pagination -->
                
            </header><!-- end .page-header -->

            <div id="main">
            
                <?php if(($gallery = $post->wpsst_project_gallery)): ?>
                    <div class="image-gallery-slider">
                        <ul>
                            <?php while($gallery->have_posts()): $gallery->the_post(); ?>
                                <li>
                                    <a href="<?php echo wp_get_attachment_image_src(get_the_ID(), 'full')[0]; ?>" class="single-image" title="<?php the_title(); ?>" rel="single-project">
                                        <img src="<?php echo wp_get_attachment_image_src(get_the_ID(), '680x600')[0]; ?>" alt="<?php the_title(); ?>">
                                    </a>
                                </li>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </ul>
                        
                    </div><!-- end .image-gallery-slider -->
                <?php endif; ?>
                
            </div><!-- end #main -->

            <div id="sidebar">
                
                <?php if(!empty(get_the_content())){ ?>
                    <h4><?php _e('Overview', 'wpsst'); ?></h4>
                    
                    <?php the_content(); ?>
                <?php } ?>
                
                <?php if($skill = $post->wpsst_skill){ ?>
                    <h4><?php _e('Things we did', 'wpsst'); ?></h4>

                    <ul class="check">
                        <?php foreach($skill as $term){ ?>
                            <li><?php echo $term->name; ?></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
                
                <?php if($website = $post->wpsst_project_website){ ?>
                    <p>
                        <a href="<?php echo $website; ?>" class="button" target="_blank"><?php _e('Launch website', 'wpsst'); ?></a>
                    </p>
                <?php } ?>

            </div><!-- end #sidebar -->
            
        </article><!-- end .single-project -->
        
    <?php endwhile; ?>

<?php get_footer(); ?>