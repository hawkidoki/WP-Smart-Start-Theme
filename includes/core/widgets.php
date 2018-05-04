<?php
/**
 * Widget Category Register
 */
add_action('widgets_init', 'wpsst_widget_categories_register');
function wpsst_widget_categories_register(){
    register_widget('WPSST_Widget_Categories');
}

/**
 * Widget Category Class
 */
Class WPSST_Widget_Categories extends WP_Widget_Categories{
    
    // WP Core: /wp-includes/widgets/class-wp-widget-categories.php:44
    function widget($args, $instance){
		static $first_dropdown = true;

		$title = ! empty( $instance['title'] ) ? $instance['title'] : __('Categories', 'wpsst');
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';

		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$cat_args = array(
			'orderby'      => 'name',
			'show_count'   => $c,
			'hierarchical' => $h,
		);

		if ( $d ) {
			echo sprintf( '<form action="%s" method="get">', esc_url( home_url() ) );
			$dropdown_id = ( $first_dropdown ) ? 'cat' : "{$this->id_base}-dropdown-{$this->number}";
			$first_dropdown = false;

			echo '<label class="screen-reader-text" for="' . esc_attr( $dropdown_id ) . '">' . $title . '</label>';

			$cat_args['show_option_none'] = __('Select Category', 'wpsst');
			$cat_args['id'] = $dropdown_id;

			wp_dropdown_categories( apply_filters( 'widget_categories_dropdown_args', $cat_args, $instance ) );

			echo '</form>';
			?>

            <script type='text/javascript'>
            /* <![CDATA[ */
            (function() {
                var dropdown = document.getElementById( "<?php echo esc_js( $dropdown_id ); ?>" );
                function onCatChange() {
                    if ( dropdown.options[ dropdown.selectedIndex ].value > 0 ) {
                        dropdown.parentNode.submit();
                    }
                }
                dropdown.onchange = onCatChange;
            })();
            /* ]]> */
            </script>

            <?php
		} else {
        
        // Add "categories" class
        ?>
		<ul class="categories">
            <?php
            $cat_args['title_li'] = '';
            wp_list_categories( apply_filters( 'widget_categories_args', $cat_args, $instance ) );
            ?>
		</ul>
        <?php
		}

		echo $args['after_widget'];
	}
    
}