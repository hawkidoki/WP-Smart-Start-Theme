<section id="comments">
    
    <?php if(have_comments()): ?>
        
        <h6 class="section-title">
        <?php 
        $comments_number = get_comments_number();
        printf(_nx('Comment (%1$s)', 'Comments (%1$s)', $comments_number, 'comments title'), number_format_i18n($comments_number));
        ?>
        </h6>

        <ol class="comments-list">
            <?php
            wp_list_comments(array(
                'avatar_size'   => 50,
                'style'         => 'ol',
                'reply_text'    => __('Reply', 'wpsst'),
                'callback'      => 'wpsst_comments_callback'
            ));
            ?>
        </ol>
        
        <?php 
        the_comments_pagination(array(
			'prev_text' => '<span class="screen-reader-text">' . __('Previous', 'wpsst') . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __('Next', 'wpsst') . '</span>',
		));
        ?>
        
    <?php endif; ?>
    
</section>

<?php 
$commenter = wp_get_current_commenter();
$required = get_option('require_name_email');
$aria_required = ($required ? ' aria-required="true"' : '');

comment_form(array(
    'id_form'               => '',
    'class_form'            => 'comments-form',
    
    'id_submit'             => '',
    'class_submit'          => '',
    'label_submit'          => __('Submit', 'wpsst'),
    
    'title_reply_before'    => '<h6 class="section-title" id="reply-title">',
    'title_reply'           => __('Leave a Comment', 'wpsst'),
    'title_reply_after'     => '</h6>',
    
    'title_reply_to'        => __('Leave a Comment to %s', 'wpsst'),
    'cancel_reply_link'     => __('Cancel Comment', 'wpsst'),
    
    'comment_field'         => '<p class="textarea-block">' .
                                    '<label for="comment-message"><strong>' . __('Your Comment', 'wpsst') . '</strong> (required)</label>' .
                                    '<textarea name="comment" id="comment-message" cols="88" rows="6" required></textarea>' .
                                '</p>',
    
    'fields'                => array(
        'author' =>
        '<p class="input-block">' .
            '<label for="comment-name"><strong>' . __('Name', 'wpsst') . '</strong>' . ($required ? ' (required)' : '') . '</label>' .
            '<input type="text" name="author" value="' . esc_attr($commenter['comment_author']) . '" id="comment-name" ' . $aria_required . '>' .
        '</p>',
        
        'email' =>
        '<p class="input-block">' .
            '<label for="comment-email"><strong>' . __('Email', 'wpsst') . '</strong>' . ($required ? ' (required)' : '') . '</label>' .
            '<input type="email" name="email" value="' . esc_attr($commenter['comment_author_email']) . '" id="comment-email" ' . $aria_required . '>' .
        '</p>',
        
        'url' =>
        '<p class="input-block">' .
            '<label for="comment-url"><strong>' . __('Website', 'wpsst') . '</strong></label>' .
            '<input type="url" name="url" value="' . esc_attr($commenter['comment_author_url']) . '" id="comment-url">' .
        '</p>',
    )

));
?>