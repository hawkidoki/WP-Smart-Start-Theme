<?php
if(!$section = get_query_var('wpsst_section'))
    return;

if($section['result']->have_posts()): ?>
    
    <?php if($section['title'] && !$section['wrapper']['title']){ ?>
        <?php echo $section['title']; ?>
    <?php } ?>
    
    <?php while($section['result']->have_posts()): $section['result']->the_post(); ?>
    
        <?php
        $project_categories = array();
        if($project_category = $post->wpsst_project_category){
            foreach($project_category as $term){
                $project_categories[] = strtolower($term->name);
            }
        }
        ?>
        
        <li>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php wpsst_the_post_thumbnail_url('220x140'); ?>" alt="<?php the_title(); ?>">
                <h5 class="title"><?php the_title(); ?></h5>
                <span class="categories"><?php echo ($project_categories) ? implode(' / ', $project_categories) : ''; ?></span>
            </a>
        </li>
    <?php endwhile; wp_reset_postdata(); ?>
<?php endif; ?>