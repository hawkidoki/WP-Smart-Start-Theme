<?php
if(!$section = get_query_var('wpsst_section'))
    return;

if($section['result']->have_posts()): ?>

    <?php if($section['title'] && !$section['wrapper']['title']){ ?>
        <?php echo $section['title']; ?>
    <?php } ?>
    
    <?php while($section['result']->have_posts()): $section['result']->the_post(); ?>
        <li>

            <a href="<?php the_permalink(); ?>">
                <img src="<?php wpsst_the_post_thumbnail_url('220x140'); ?>" alt="<?php wpsst_the_post_thumbnail_alt(); ?>" class="entry-image">
            </a>

            <div class="entry-meta">

                <a href="<?php the_permalink(); ?>">
                    <span class="post-format">Permalink</span>
                </a>

                <span class="date"><?php the_time('M j Y'); ?></span>

            </div><!-- end .entry-meta -->

            <div class="entry-body">

                <a href="<?php the_permalink(); ?>">
                    <h5 class="title"><?php the_title(); ?></h5>
                </a>

                <?php wpsst_the_excerpt(null, 20); ?>
                
            </div><!-- end .entry-body -->

        </li>
    <?php endwhile; wp_reset_postdata(); ?>
<?php endif; ?>