<?php
/**
 * Register
 */
add_action('init', 'wpsst_post_type_project_register', 0);
function wpsst_post_type_project_register(){
	register_post_type('project', array(
		'label'                     => 'project',
		'description'               => __('Project', 'wpsst'),
		'labels'                    => array(
            'name'              => __('Project', 'wpsst'),
            'singular_name'     => __('Project', 'wpsst'),
            'menu_name'         => __('Project', 'wpsst'),
            'parent_item_colon' => __('Parent Project:', 'wpsst'),
            'all_items'         => __('All Projects', 'wpsst'),
            'view_item'         => __('View Project', 'wpsst'),
            'add_new_item'      => __('Add Project', 'wpsst'),
            'add_new'           => __('Add Project', 'wpsst'),
            'edit_item'         => __('Edit Project', 'wpsst'),
            'update_item'       => __('Update Project', 'wpsst'),
            'search_items'      => __('Search Project', 'wpsst'),
        ),
		'supports'                  => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),
		'taxonomies'                => array('skill'),
		'hierarchical'              => false,
		'public'                    => true,
		'menu_position'             => 5,
		'menu_icon'                 => 'dashicons-media-spreadsheet',
		'can_export'                => true,
		'has_archive'               => 'projects',
		'rewrite'                   => array('slug' => 'project', 'with_front' => true),
		'capability_type'           => 'page',
        
        'wpsst_posts_per_page'      => -1,
        'wpsst_template_archive'    => 'templates/project/archive.php',
        'wpsst_template_single'     => 'templates/project/single.php',
	));
}

/**
 * Query Vars
 */
add_action('pre_get_posts', 'wpsst_post_type_project_query');
function wpsst_post_type_project_query($query){
    if(is_admin() || !$query->is_main_query() || $query->get('post_type') != 'project')
        return;
    
    // All terms
    $query->set('wpsst_all_project_category', get_terms(array(
        'taxonomy'      => 'project_category',
        'hide_empty'    => true
    )));
    
    $query->set('wpsst_all_skill', get_terms(array(
        'taxonomy'      => 'skill',
        'hide_empty'    => true
    )));
}

/**
 * WP_Post Object Extend
 */
add_filter('posts_results', 'wpsst_post_type_project_posts_results', 10, 2);
function wpsst_post_type_project_posts_results($posts, $query){
    if(empty($posts))
        return $posts;
    
    foreach($posts as $post){
        if(get_post_type($post) != 'project')
            continue;
        
        // Skill
        $post->wpsst_skill = false;
        if($terms = get_the_terms($post->ID, 'skill'))
            $post->wpsst_skill = $terms;
        
        // Project Category
        $post->wpsst_project_category = false;
        if($terms = get_the_terms($post->ID, 'project_category'))
            $post->wpsst_project_category = $terms;
        
        // Gallery
        if($query->is_single()){
            $featured_image = get_post_thumbnail_id($post->ID);
            $gallery = new WP_Query(array(
                'post_type'         => 'attachment',
                'post_mime_type'    => 'image',
                'post_status'       => 'inherit',
                'posts_per_page'    => -1,
                'post_parent'       => $post->ID,
                'post__not_in'      => (!empty($featured_image) ? array($featured_image) : array())
            ));
            
            $post->wpsst_project_gallery = false;
            if($gallery->have_posts())
                $post->wpsst_project_gallery = $gallery;
            
            // Project Website
            $post->wpsst_project_website = false;
            if($website = get_field('project_website', $post->ID))
                $post->wpsst_project_website = $website;
        }
    }

    return $posts;
}