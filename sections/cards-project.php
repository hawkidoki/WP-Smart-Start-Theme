<?php
if(!$section = get_query_var('wpsst_section'))
    return;

if($section['result']->have_posts()): ?>
    
    <?php if($section['title'] && !$section['wrapper']['title']){ ?>
        <?php echo $section['title']; ?>
    <?php } ?>
    
    <?php $i=0; while($section['result']->have_posts()): $section['result']->the_post(); $i++; ?>
    
        <?php
        $project_categories = array();
        if($project_category = $post->wpsst_project_category){
            foreach($project_category as $term){
                $project_categories[] = strtolower($term->name);
            }
        }
        ?>
        
        <article class="one-third" data-categories="<?php echo ($project_categories) ? implode(' ', $project_categories) : ''; ?>">

            <a href="<?php wpsst_the_post_thumbnail_url('300x190'); ?>" class="single-image" title="<?php the_title(); ?>">
                <img src="<?php wpsst_the_post_thumbnail_url('300x190'); ?>" alt="<?php wpsst_the_post_thumbnail_alt(); ?>">
            </a>

            <a href="<?php the_permalink(); ?>" class="project-meta">
                <h5 class="title"><?php the_title(); ?></h5>
                <span class="categories"><?php echo ($project_categories) ? implode(' / ', $project_categories) : ''; ?></span>
            </a>
            
        </article><!-- end .one-third -->
    <?php endwhile; wp_reset_postdata(); ?>
<?php endif; ?>