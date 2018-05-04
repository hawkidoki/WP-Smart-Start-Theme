<?php
/**
 * Callback Comments
 */
function wpsst_comments_callback($comment, $args, $depth){
    if($comment->comment_type == 'pingback' || $comment->comment_type == 'trackback')
        return;
    ?>

    <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
        <article id="div-comment-<?php comment_ID(); ?>">
        
            <?php 
            if($args['avatar_size'] != 0) 
                echo get_avatar($comment, $args['avatar_size']);
            ?>
            <div class="comment-meta">
                <h5 class="author">
                    <?php echo get_comment_author_link(); ?>
                    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'before' => ' - '))); ?>
                </h5>

                <p class="date"><?php comment_time('j F, Y'); ?><?php edit_comment_link(__('Edit', 'wpsst'), ' - '); ?></p>
            </div><!-- end .comment-meta -->
            
            <div class="comment-body">

                <?php comment_text(); ?>
                
            </div><!-- end .comment-body -->
        </article>

    <?php
}