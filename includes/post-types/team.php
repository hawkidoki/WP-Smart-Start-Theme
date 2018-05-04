<?php
/**
 * Register
 */
add_action('init', 'wpsst_post_type_team_register', 0);
function wpsst_post_type_team_register(){
	register_post_type('team', array(
		'label'                     => 'team',
		'description'               => __('Team', 'wpsst'),
		'labels'                    => array(
            'name'              => __('Team', 'wpsst'),
            'singular_name'     => __('Team', 'wpsst'),
            'menu_name'         => __('Team', 'wpsst'),
            'parent_item_colon' => __('Parent Team:', 'wpsst'),
            'all_items'         => __('All Members', 'wpsst'),
            'view_item'         => __('View Member', 'wpsst'),
            'add_new_item'      => __('Add Member', 'wpsst'),
            'add_new'           => __('Add Member', 'wpsst'),
            'edit_item'         => __('Edit Member', 'wpsst'),
            'update_item'       => __('Update Member', 'wpsst'),
            'search_items'      => __('Search Member', 'wpsst'),
        ),
		'supports'                  => array('title', 'excerpt', 'thumbnail', 'custom-fields'),
		'public'                    => false,
		'show_ui'                   => true,
		'show_in_menu'              => true,
		'show_in_nav_menus'         => true,
		'show_in_admin_bar'         => true,
		'menu_position'             => 5,
		'menu_icon'                 => 'dashicons-groups',
		'can_export'                => true,
		'has_archive'               => 'team',
		'rewrite'                   => true,
		'exclude_from_search'       => true,
		'publicly_queryable'        => true,
		'capability_type'           => 'page',
        
        'wpsst_posts_per_page'      => -1,
        'wpsst_template_archive'    => 'templates/team/archive.php'
	));
}

/**
 * Row Actions
 */
add_filter('post_row_actions', 'wpsst_post_type_team_row_actions', 10, 2);
function wpsst_post_type_team_row_actions($actions, $post){
    if(!isset($post->post_type) || $post->post_type != 'team')
        return $actions;
    
    unset($actions['view']);
    return $actions;
}

/**
 * Rewrite Rules
 */
add_filter('team_rewrite_rules', '__return_empty_array');

/**
 * WP_Post Object Extend
 */
add_filter('posts_results', 'wpsst_post_type_team_posts_results', 10, 2);
function wpsst_post_type_team_posts_results($posts, $query){
    if(empty($posts) || !$query->is_main_query())
        return $posts;
    
    foreach($posts as $post){
        if(get_post_type($post) != 'team')
            continue;
        
        $meta = array();
    
        if($job_title = get_field('member_job', $post->ID))
            $meta['job_title'] = $job_title;
            
        if($link = get_field('member_twitter', $post->ID))
            $meta['social'][] = array(
                'slug'  => 'twitter',
                'title' => 'Twitter',
                'link'  => $link,
            );
            
        if($link = get_field('member_facebook', $post->ID))
            $meta['social'][] = array(
                'slug'  => 'facebook',
                'title' => 'Facebook',
                'link'  => $link,
            );
            
        if($link = get_field('member_skype', $post->ID))
            $meta['social'][] = array(
                'slug'  => 'skype',
                'title' => 'Skype',
                'link'  => $link,
            );
            
        if($link = get_field('member_linkedin', $post->ID))
            $meta['social'][] = array(
                'slug'  => 'linkedin',
                'title' => 'LinkedIn',
                'link'  => $link,
            );
            
        if($link = get_field('member_googleplus', $post->ID))
            $meta['social'][] = array(
                'slug'  => 'googleplus',
                'title' => 'Google+',
                'link'  => $link,
            );
            
        if($link = get_field('member_email', $post->ID))
            $meta['social'][] = array(
                'slug'  => 'email',
                'title' => 'Email',
                'link'  => $link,
            );
            
        $post->wpsst_team_meta = false;
        if(!empty($meta))
            $post->wpsst_team_meta = $meta;
    }

    return $posts;
}