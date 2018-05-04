<?php
/**
 * Register
 */
add_action('init', 'wpsst_taxonomy_project_category_register', 0);
function wpsst_taxonomy_project_category_register() {
    register_taxonomy('project_category', array('project'), array(
        'labels'            => array(
            'name'                       => __('Category', 'wpsst'),
            'singular_name'              => __('Category', 'wpsst'),
            'menu_name'                  => __('Categories', 'wpsst'),
            'all_items'                  => __('All Categories', 'wpsst'),
            'parent_item'                => __('Parent Category', 'wpsst'),
            'parent_item_colon'          => __('Parent Category:', 'wpsst'),
            'new_item_name'              => __('New Category', 'wpsst'),
            'add_new_item'               => __('Add Category', 'wpsst'),
            'edit_item'                  => __('Edit Category', 'wpsst'),
            'update_item'                => __('Update Category', 'wpsst'),
        ),
        'hierarchical'          => false,
        'public'                => false,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => true,
        'rewrite'               => false,
        'show_tagcloud'         => false,
    ));
}