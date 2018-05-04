<?php
if(!$section = get_query_var('wpsst_section'))
    return;

if($section['result']->have_posts()): ?>
    
    <?php if($section['title'] && !$section['wrapper']['title']){ ?>
        <?php echo $section['title']; ?>
    <?php } ?>

    <?php while($section['result']->have_posts()): $section['result']->the_post(); ?>
        <article class="entry clearfix">

            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <img src="<?php wpsst_the_post_thumbnail_url('680x235'); ?>" alt="<?php wpsst_the_post_thumbnail_alt(); ?>" class="entry-image">
            </a>

            <div class="entry-body">

                <a href="<?php the_permalink(); ?>">
                    <h1 class="title"><?php the_title(); ?></h1>
                </a>
                
                <?php if(isset($section['options']['type']) && $section['options']['type'] == 'single'){ ?>
                
                    <!-- the_excerpt -->
                    <?php the_content(); ?>
                    
                <?php }else{ ?>
                    
                    <!-- the_content -->
                    <?php the_excerpt(); ?>
                    
                <?php } ?>
                
            </div><!-- end .entry-body -->

            <div class="entry-meta">
                <ul>
                    <li><a href="<?php the_permalink(); ?>"><span class="post-format ">Permalink</span></a></li>
                    <li><span class="title"><?php _e('Posted', 'wpsst'); ?>:</span> <a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')); ?>"><?php the_time('M j Y'); ?></a></li>
                    <?php if($tags = $post->wpsst_post_tag){ ?>
                        <li><span class="title"><?php _e('Tags', 'wpsst'); ?>:</span> 
                        <?php foreach($tags as $term){ ?>
                            <a href="<?php echo get_term_link($term->term_id, 'post_tag'); ?>"><?php echo $term->name; ?></a>
                        <?php } ?>
                        </li>
                    <?php } ?>
                    
                    <li><span class="title"><?php echo (get_comments_number() > 1) ? __('Comments', 'wpsst') : __('Comment', 'wpsst'); ?>:</span> <a href="<?php the_permalink(); ?>#comments"><?php echo get_comments_number(); ?></a></li>
                </ul>

            </div><!-- end .entry-meta -->
            
        </article><!-- end .entry -->
        
        <?php 
        if($section['comments'] && !post_password_required() && (comments_open() || get_comments_number())){
            comments_template('/sections/comments.php');
        }
        ?>
        
    <?php endwhile; ?>

    <?php 
    if($section['pagination']){
        
        wp_pagenavi(array(
            'query'         => $section['result'],
            'wrapper_tag'   => 'ul',
            'wrapper_class' => 'pagination',
            'options'       => array(
                'pages_text'    => false,
                'first_text'    => false,
                'prev_text'     => '← ' . __('Previous', 'wpsst'),
                'next_text'     => __('Next', 'wpsst') . ' →',
                'last_text'     => false,
            )
        ));
        
    } ?>
    
    <?php wp_reset_postdata(); ?>
    
<?php endif; ?>