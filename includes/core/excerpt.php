<?php
/**
 * Exrcept
 */
function wpsst_the_excerpt($post = null, $length = 55){
    echo apply_filters('the_excerpt', wpsst_get_the_excerpt($post, $length));
}

/**
 * Get Exrcept
 */
function wpsst_get_the_excerpt($post = null, $length = 55){
	$post = get_post($post);
	if(empty($post))
		return '';

	if(post_password_required($post))
		return __('There is no excerpt because this is a protected post.', 'wpsst');

	return wp_trim_words(apply_filters('get_the_excerpt', $post->post_excerpt, $post), $length);
}