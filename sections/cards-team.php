<?php
if(!$section = get_query_var('wpsst_section'))
    return;

if($section['result']->have_posts()): ?>
    
    <?php if($section['title'] && !$section['wrapper']['title']){ ?>
        <?php echo $section['title']; ?>
    <?php } ?>
    
    <?php $i=0; while($section['result']->have_posts()): $section['result']->the_post(); $i++; ?>
        <div class="team-member one-fourth <?php echo ($i%4 == 0) ? 'last': ''; ?>">

            <img src="<?php wpsst_the_post_thumbnail_url('220x140'); ?>" alt="<?php wpsst_the_post_thumbnail_alt(); ?>" class="photo">

            <div class="content">

                <h4 class="name"><?php the_title(); ?></h4>
                
                <?php if($job_title = $post->wpsst_team_meta['job_title']){ ?>
                    <span class="job-title"><?php echo $job_title; ?></span>
                <?php } ?>

                <?php the_excerpt(); ?>
                
            </div><!-- end .content -->
            
            <?php if($social = $post->wpsst_team_meta['social']){ ?>
                <ul class="social-links">
                    <?php foreach($social as $meta){ ?>
                        <li class="<?php echo $meta['slug']; ?>"><a href="<?php echo $meta['link']; ?>"><?php echo $meta['title']; ?></a></li>
                    <?php } ?>
                </ul><!-- end .social-links -->
            <?php } ?>
            
        </div><!-- end .team-member.one-fourth -->
    <?php endwhile; wp_reset_postdata(); ?>
<?php endif; ?>