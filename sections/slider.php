<?php
if(!$section = get_query_var('wpsst_section'))
    return;

if($section['result']->have_posts()): ?>
    
    <?php if($section['title'] && !$section['wrapper']['title']){ ?>
        <?php echo $section['title']; ?>
    <?php } ?>
    
    <?php $i=0; while($section['result']->have_posts()): $section['result']->the_post(); $i++; ?>
        <article class="slide">

            <img src="<?php wpsst_the_post_thumbnail_url('940x380'); ?>" alt="<?php wpsst_the_post_thumbnail_alt(); ?>" class="slide-bg-image" />
            
            <div class="slide-button">
                <span class="dropcap"><?php echo $i; ?></span>
                <h5><?php the_title(); ?></h5>
            </div>

            <div class="slide-content">
                <h2><?php the_title(); ?></h2>
                <?php wpsst_the_excerpt(null, 30); ?>
                <p><a class="button" href="<?php the_permalink(); ?>"><?php _e('Read More', 'wpsst'); ?></a></p>
            </div>
            
        </article><!-- end .slide -->
    <?php endwhile; wp_reset_postdata(); ?>
<?php endif; ?>