<?php
/**
 * Register
 */
add_action('init', 'wpsst_taxonomy_skill_register', 0);
function wpsst_taxonomy_skill_register() {
    register_taxonomy('skill', array('project'), array(
        'labels'            => array(
            'name'                       => __('Skills', 'wpsst'),
            'singular_name'              => __('Skill', 'wpsst'),
            'menu_name'                  => __('Skills', 'wpsst'),
            'all_items'                  => __('All Skills', 'wpsst'),
            'parent_item'                => __('Parent Skill', 'wpsst'),
            'parent_item_colon'          => __('Parent Skill:', 'wpsst'),
            'new_item_name'              => __('New Skill', 'wpsst'),
            'add_new_item'               => __('Add Skill', 'wpsst'),
            'edit_item'                  => __('Edit Skill', 'wpsst'),
            'update_item'                => __('Update Skill', 'wpsst'),
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