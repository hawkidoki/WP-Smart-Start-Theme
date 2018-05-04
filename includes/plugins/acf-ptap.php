<?php
/**
 * ACF Post Type Archive Page
 */
add_action('acf/include_field_types', 'acf_ptap_register_field');
function acf_ptap_register_field(){
    class acf_field_ptpap_select extends acf_field{

        function __construct(){
            $this->name = 'ptpap_select';
            $this->public = false;
            parent::__construct();
        }

        function render_field($field){
            
            $field['value'] = acf_get_array($field['value'], false);

            if(empty($field['value']))
                $field['value'][''] = '';

            $atts = array(
                'id'                => $field['id'],
                'class'             => $field['class'],
                'name'              => $field['name'],
                'data-type'         => 'select',
            );

            $choices = array();
            $choices[] = array(
                'value'     => '',
                'label'     => __('None', 'wpsst')
            );

            $post_types = $this->post_types();
            foreach($post_types as $post_type){
                
                $selected = in_array($post_type['value'], $field['value']);
                
                // Post Type: post
                if($post_type['value'] == 'post' && !empty(get_option('page_for_posts')) && get_option('page_for_posts') == get_the_ID())
                    $selected = 'selected';
                
                $post_types_archives = get_option('post_types_archives', array());
                
                $disabled = false;
                if(isset($post_types_archives[$post_type['value']]) && $post_types_archives[$post_type['value']] != get_the_ID())
                    $disabled = 'disabled';
                
                if($post_type['value'] == 'post' && !empty(get_option('page_for_posts')) && get_option('page_for_posts') != get_the_ID())
                    $disabled = 'disabled';
 
                $choices[] = array(
                    'value'     => $post_type['value'],
                    'label'     => $post_type['label'],
                    'disabled'  => $disabled,
                    'selected'  => $selected
                );
            }

            echo '<select ' . acf_esc_attr($atts) . '>';
            
            foreach($choices as $choice){
                
                if(acf_extract_var($choice, 'selected'))
                    $choice['selected'] = 'selected';
                
                if(acf_extract_var($choice, 'disabled'))
                    $choice['disabled'] = 'disabled';

                echo '<option ' . acf_esc_attr($choice) . '>' . acf_extract_var($choice, 'label') . '</option>';
            }

            echo '</select>';
        }
        
        function update_value($value, $post_id, $field){
            $post_types_archives = get_option('post_types_archives', array());
            
            if(!empty($post_types_archives)){
                foreach($post_types_archives as $post_type => $pid){
                    if($post_id != $pid)
                        continue;
                    
                    if(empty($value) && $post_type == 'post')
                        update_option('page_for_posts', '');
                    
                    unset($post_types_archives[$post_type]);
                }
            }
            
            // Prepare new option
            if(!empty($value))
                $post_types_archives[$value] = $post_id;
            
            // Update native page_for_posts
            if($value == 'post')
                update_option('page_for_posts', $post_id);
            
            // Native compatibility
            if(get_option('page_for_posts') == $post_id && empty($value))
                update_option('page_for_posts', '');
            
            // Update option
            update_option('post_types_archives', $post_types_archives);
            
            // Flush Permalinks
            update_option('post_types_archives_flush', true);
            
            // Return
            return $value;
        }
        
        private function post_types(){
            $output = array();
            foreach(get_post_types(array('publicly_queryable' => true), 'objects') as $post_type){
                if($post_type->name == 'attachment' || $post_type->name == 'page')
                    continue;
                
                $output[] = array(
                    'value' => $post_type->name,
                    'label' => $post_type->label
                );
            }
            
            return $output;
        }
        
    }

    new acf_field_ptpap_select();
}

// ACF PTAP: Register
if(function_exists('acf_add_local_field_group')):
acf_add_local_field_group(array(
	'key' => 'group_ptap',
	'title' => __('Post Type Archive', 'wpsst'),
	'fields' => array(
		array(
			'key' => 'field_ptap_post_types',
			'label' => '<span style="font-weight:600">Post Type</span>',
			'name' => 'ptap_post_type',
			'type' => 'ptpap_select',
			'instructions' => '',
			'required' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			)
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'side',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));
endif;

// ACF PTAP: Update Post Types has_archive
add_filter('register_post_type_args', 'acf_ptap_register_post_type_args', 10, 2);
function acf_ptap_register_post_type_args($args, $post_type){
    $post_types_archives = get_option('post_types_archives');
    if(!$post_types_archives || $post_type == 'post' || !isset($post_types_archives[$post_type]))
        return $args;
    
    $args['has_archive'] = get_page_uri($post_types_archives[$post_type]);

    return $args;
    
}

// ACF PTAP: Flush Rewrite Rules
add_action('admin_init', 'acf_ptap_flush_rewrite_rules', 99);
function acf_ptap_flush_rewrite_rules(){
	if(!get_option('post_types_archives_flush'))
		return;

	flush_rewrite_rules();
    update_option('post_types_archives_flush', false);
}

// ACF PTAP: Page State
add_filter('display_post_states', 'acf_ptap_page_state', 10, 2);
function acf_ptap_page_state($states, $post){
	$post_types_archives = get_option('post_types_archives');
	if(!$post_types_archives || get_post_type($post->ID) != 'page')
		return $states;
    
    foreach($post_types_archives as $post_type => $post_type_archive_pid){
        if($post_type_archive_pid != $post->ID || $post_type == 'post')
            continue;
        
        $target = get_post_type_object($post_type);
        $states[] = $target->label . ' Page';
        break;
    }

    return $states;
}

// ACF PTAP: have_archive_page
if(!function_exists('have_archive_page')){
	$cptc_a_i = 0;
	function have_archive_page(){
		global $cptc_a_i;
		
		if($cptc_a_i == 0 && acf_ptap_get_post_type_archive_page_id())
			return true;
		
		$cptc_a_i = 0;
		return false;
	}
}

// ACF PTAP: the_archive_page
if(!function_exists('the_archive_page')){
	function the_archive_page(){
		global $post, $cptc_a_i;
		
		$post = get_post(acf_ptap_get_post_type_archive_page_id());
		setup_postdata($post);
		$cptc_a_i++;
	}
}

// ACF PTAP: Post Type Rules Matching Values
add_filter('acf/location/rule_values/page_type', 'acf_ptap_page_type_values');
function acf_ptap_page_type_values($choices){
    if(!$post_types_archives = get_option('post_types_archives'))
		return $choices;
    
    foreach($post_types_archives as $target_post_type => $post_type_archive_pid){
        if($target_post_type == 'post')
            continue;
        
        $post_type_object = get_post_type_object($target_post_type);
        $choices[$post_type_object->name] = $post_type_object->label . ' Page';
    }

    return $choices;
}

// ACF PTAP: Post Type Rules Matching
add_filter('acf/location/rule_match/page_type', 'acf_ptap_page_type_match', 10, 3);
function acf_ptap_page_type_match($match, $rule, $options){
    // Native ACF Page Type Rule
    if( $rule['value'] == 'posts_page' || 
        $rule['value'] == 'front_page' || 
        $rule['value'] == 'top_level' || 
        $rule['value'] == 'parent' || 
        $rule['value'] == 'child')
        return $match;
        
    if(!$post_types_archives = get_option('post_types_archives'))
		return $match;
    
    $current_post_id = get_the_ID();
    $selected_post_type = $rule['value'];
    
    foreach($post_types_archives as $target_post_type => $post_type_archive_pid){
        if($rule['operator'] == '==' && $current_post_id == $post_type_archive_pid && $selected_post_type == $target_post_type)
            return true;
        
        elseif($rule['operator'] == '!=' && $current_post_id != $post_type_archive_pid && $selected_post_type != $target_post_type)
            return true;
    }

    return $match;
}

// ACF PTAP: Get Post Type Archive Page ID
function acf_ptap_get_post_type_archive_page_id($post_type = null){
	global $wp_query;
	
	if(!$post_type)
		$post_type = get_post_type();
	
	if(!$post_type)
		$post_type = (isset($wp_query->query['post_type'])) ? $wp_query->query['post_type'] : '';
	
	if($post_type == 'page' && get_option('page_for_posts') == get_queried_object_id())
		$post_type = 'post';
    
	if(!$post_types_archives = get_option('post_types_archives'))
		return false;
    
    foreach($post_types_archives as $target_post_type => $post_type_archive_pid){
        if($target_post_type != $post_type)
            continue;
        
        return $post_type_archive_pid;
    }
	
	return false;
}

// ACF PTAP: Archive Page Submenu
add_action('admin_menu', 'cptc_archive_page_menu');
function cptc_archive_page_menu(){
	if(!$post_types_archives = get_option('post_types_archives'))
		return;
	
	global $submenu;
    foreach($post_types_archives as $target_post_type => $post_type_archive_pid){
        $page = 'edit.php?post_type=' . $target_post_type;
        if($target_post_type == 'post')
			$page = 'edit.php';
        
        $submenu[$page][] = array('Archive', 'manage_options', add_query_arg(array('post' => $post_type_archive_pid, 'action' => 'edit'), admin_url('post.php')));
    }
}

// ACF PTAP: Archive Page Submenu Parent
add_filter('parent_file', 'cptc_archive_page_menu_highlight_parent');
function cptc_archive_page_menu_highlight_parent($parent_file){
    if(!$post_types_archives = get_option('post_types_archives'))
		return $parent_file;
	
	$screen = get_current_screen();
	if(!isset($screen->base) || $screen->base != 'post')
        return $parent_file;
    
    foreach($post_types_archives as $target_post_type => $post_type_archive_pid){
        if($post_type_archive_pid != get_the_ID())
            continue;
        
        $page = 'edit.php?post_type=' . $target_post_type;
        if($target_post_type == 'post')
			$page = 'edit.php';
        
        return $page;
    }
    
	return $parent_file;
}

// ACF PTAP: Archive Page Submenu Parent Highlight
add_filter('submenu_file', 'cptc_archive_page_menu_highlight_child');
function cptc_archive_page_menu_highlight_child($submenu_file){
    if(!$post_types_archives = get_option('post_types_archives'))
		return $submenu_file;
	
	$screen = get_current_screen();
	if(!isset($screen->base) || $screen->base != 'post')
        return $submenu_file;
    
    foreach($post_types_archives as $target_post_type => $post_type_archive_pid){
        if($post_type_archive_pid != get_the_ID())
            continue;
        
        return add_query_arg(array('post' => get_the_ID(), 'action' => 'edit'), admin_url('post.php'));
    }
    
	return $submenu_file;
}

// ACF PTAP: Toolbar Edit Archive
add_action('admin_bar_menu', 'cptc_archive_page_toolbar_edit', 90);
function cptc_archive_page_toolbar_edit($wp_admin_bar){
	if(!$post_types_archives = get_option('post_types_archives'))
		return;
    
    foreach($post_types_archives as $target_post_type => $post_type_archive_pid){
        if(!is_post_type_archive($target_post_type))
            continue;
        
        $post_type_object = get_post_type_object($target_post_type);
        $wp_admin_bar->add_node(array(
            'id'    	=> 'edit',
            'title' 	=> __('Edit ' . $post_type_object->name . ' Archive'),
            'parent' 	=> false,
            'href' 		=> add_query_arg(array('post' => $post_type_archive_pid, 'action' => 'edit'), admin_url('post.php')),
            'meta'		=> array('class' => 'ab-item')
        ));
    }
}

// ACF PTAP: Archive Page WP Core Title
add_filter('post_type_archive_title', 'cptc_archive_page_core_title', 10, 2);
function cptc_archive_page_core_title($name, $post_type){
	if(!$post_types_archives = get_option('post_types_archives'))
		return $name;
    
    foreach($post_types_archives as $target_post_type => $post_type_archive_pid){
        if($target_post_type != $post_type)
            continue;
        
        return get_the_title($post_type_archive_pid);
    }
}

// ACF PTAP: Archive Page YOAST Title
add_filter('wpseo_title', 'cptc_archive_page_yoast_title');
function cptc_archive_page_yoast_title($title){
	if(!$post_types_archives = get_option('post_types_archives'))
		return $title;
    
    foreach($post_types_archives as $target_post_type => $post_type_archive_pid){
        if(!is_post_type_archive($target_post_type))
            continue;
        
        return get_post_meta($post_type_archive_pid, '_yoast_wpseo_title', true);
    }
	
	return $title;
}

// ACF PTAP: Archive Page YOAST Description
add_filter('wpseo_metadesc', 'cptc_archive_page_yoast_desc');
function cptc_archive_page_yoast_desc($desc){
	if(!$post_types_archives = get_option('post_types_archives'))
		return $desc;
    
    foreach($post_types_archives as $target_post_type => $post_type_archive_pid){
        if(!is_post_type_archive($target_post_type))
            continue;
        
        return get_post_meta($post_type_archive_pid, '_yoast_wpseo_metadesc', true);
    }
	
	return $desc;
}