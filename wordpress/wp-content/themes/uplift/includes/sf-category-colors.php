<?php
	
	/*
	*
	*	Category Colour Meta
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
	*
	*/
	
	
	/* REGISTER META
	================================================== */
	if (!function_exists('sf_register_category_color_meta')) {
		function sf_register_category_color_meta() {
			register_meta( 'category', 'category_color', 'sf_sanitize_hex' );
			register_meta( 'category', 'category_alt_color', 'sf_sanitize_hex' );
		}
		add_action( 'init', 'sf_register_category_color_meta', 0 );
	}
	
	
	/* SANITIZE FUNCTION
	================================================== */
	if (!function_exists('sf_sanitize_hex')) {
		function sf_sanitize_hex( $color ) {
		
		    $color = ltrim( $color, '#' );
		
		    return preg_match( '/([A-Fa-f0-9]{3}){1,2}$/', $color ) ? $color : '';
		}
	}
	
	
	/* GET COLORUS HELPER FUNCTION
	================================================== */
	function sf_get_category_colors( $term_id, $hash = false ) {
	
		if ( !function_exists('get_term_meta') ) {
			return;
		}
	
	    $color = get_term_meta( $term_id, 'category_color', true );
	    $color = sf_sanitize_hex( $color );
	    $color_alt = get_term_meta( $term_id, 'category_alt_color', true );
	    $color_alt = sf_sanitize_hex( $color_alt );
		
		if ( $color == "" || $color_alt == "" ) {
			return false;
		} else {	
			$colors = array(
				'color' => $hash && $color ? "#{$color}" : $color,
				'color_alt' => $hash && $color_alt ? "#{$color_alt}" : $color_alt
			);		
		    return $colors;
	    }
	}
	
	
	/* GET POST CATEGORY LIST WITH COLOURS
	================================================== */
	if ( !function_exists( 'sf_get_custom_post_cat_list' ) ) {
		function sf_get_custom_post_cat_list( $postID , $limit = 1000 ) {
		
			$post_categories = wp_get_post_categories( $postID );
			$output = '';
			$i = 1;
							
			foreach( $post_categories as $category ) {
				$cat = get_category( $category );
				$colors = sf_get_category_colors($cat->term_id, true);
				$color = "#222";
				$text_color = "#fff";
				
				if ( is_array($colors) ) {
				$color = $colors['color'];
				$text_color = $colors['color_alt'];
				}				
				$category_link = get_category_link( $cat->cat_ID );
				$output .= '<a class="cat-item" style="background-color:'.$color.';color:'.$text_color.';" href="'.$category_link.'">'.$cat->name.'</a>';
				
				$i++;
				if ( $i > $limit ) {
					break;
				}
			}			
			
			return $output;	
		}
	}
	if ( !function_exists( 'sf_get_custom_post_cat_colour' ) ) {
		function sf_get_custom_post_cat_colour($postID) {
		
			$post_categories = wp_get_post_categories( $postID );
			$colour = '';
							
			foreach( $post_categories as $category ){
				$cat = get_category( $category );
				$colour = get_tax_meta($cat->term_id,'sf_tax_category_color');
				break;
			}			
			
			return $colour;
		}
	}
	
	
	/* CREATE CATEGORY FORM FIELDS
	================================================== */
	if (!function_exists('sf_category_colors_new_form')) {
		function sf_category_colors_new_form() {
		    wp_nonce_field( basename( __FILE__ ), 'sf_category_color_nonce' );?>
		
		    <div class="form-field sf-category-color-wrap">
		        <label for="sf-category-color"><?php _e( 'Category Color', 'uplift' ); ?></label>
		        <input type="text" name="sf_category_color" id="sf-category-color" value="" class="sf-color-field" data-default-color="#222" />
		    </div>
		    <?php wp_nonce_field( basename( __FILE__ ), 'sf_category_alt_color_nonce' ); ?>
		    <div class="form-field sf-category-alt-color-wrap">
		        <label for="sf-category-alt-color"><?php _e( 'Category Alt Color', 'uplift' ); ?></label>
		        <input type="text" name="sf_category_alt_color" id="sf-category-alt-color" value="" class="sf-color-field" data-default-color="#fff" />
		    </div>
		<?php }
		add_action( 'category_add_form_fields', 'sf_category_colors_new_form' );
	}	
	
	
	/* EDIT CATEGORY FORM FIELDS
	================================================== */
	if (!function_exists('sf_category_colors_edit_form')) {
		function sf_category_colors_edit_form( $term ) {
		
		    $default = '#222';
		    $default_alt = '#fff';
		    
		    $colors = sf_get_category_colors( $term->term_id, true );
		
		    if ( $colors ) {
		    	$color = $colors['color'];
		    	$color_alt = $colors['color_alt'];
		    } else {
		        $color = $default;
		        $color_alt = $default_alt;
		    }   
		    ?>
		
		    <tr class="form-field sf-category-color-wrap">
		        <th scope="row"><label for="sf-category-color"><?php _e( 'Category Color', 'uplift' ); ?></label></th>
		        <td>
		            <?php wp_nonce_field( basename( __FILE__ ), 'sf_category_color_nonce' ); ?>
		            <input type="text" name="sf_category_color" id="sf-category-color" value="<?php echo esc_attr( $color ); ?>" class="sf-color-field" data-default-color="<?php echo esc_attr( $default ); ?>" />
		        </td>
		    </tr>
		    <tr class="form-field sf-category-color-wrap">
		        <th scope="row"><label for="sf-category-alt-color"><?php _e( 'Category Alt Color', 'uplift' ); ?></label></th>
		        <td>
		            <?php wp_nonce_field( basename( __FILE__ ), 'sf_category_alt_color_nonce' ); ?>
		            <input type="text" name="sf_category_alt_color" id="sf-category-alt-color" value="<?php echo esc_attr( $color_alt ); ?>" class="sf-color-field" data-default-color="<?php echo esc_attr( $default_alt ); ?>" />
		        </td>
		    </tr>
		<?php }
		add_action( 'category_edit_form_fields', 'sf_category_colors_edit_form' );
	}
	
	
	/* SAVE CATEGORY COLORS
	================================================== */
	if (!function_exists('sf_category_colors_save')) {
		function sf_category_colors_save( $term_id ) {
		
		    if ( ! isset( $_POST['sf_category_color_nonce'] ) || ! wp_verify_nonce( $_POST['sf_category_color_nonce'], basename( __FILE__ ) ) )
		        return;
		
		    $old_colors = sf_get_category_colors( $term_id );
		    $new_color = isset( $_POST['sf_category_color'] ) ? sf_sanitize_hex( $_POST['sf_category_color'] ) : '';
		    $new_alt_color = isset( $_POST['sf_category_alt_color'] ) ? sf_sanitize_hex( $_POST['sf_category_alt_color'] ) : '';
		
		    if ( $old_colors['color'] && '' === $new_color ) {
		        delete_term_meta( $term_id, 'category_color' );
		    } else if ( $old_colors['color_alt'] !== $new_color ) {
		        update_term_meta( $term_id, 'category_color', $new_color );
		    }
		        
		    if ( $old_colors['color'] && '' === $new_alt_color ) {
		        delete_term_meta( $term_id, 'category_alt_color' );
		    } else if ( $old_colors['color_alt'] !== $new_alt_color ) {
		        update_term_meta( $term_id, 'category_alt_color', $new_alt_color );
			}
		}
		add_action( 'edit_category',   'sf_category_colors_save' );
		add_action( 'create_category', 'sf_category_colors_save' );
	}
	
	
	/* COLOUR PICKER
	================================================== */	
	function sf_admin_enqueue_colour_scripts( $hook_suffix ) {
	
	    if ( 'edit-tags.php' !== $hook_suffix || 'category' !== get_current_screen()->taxonomy )
	        return;
	
	    wp_enqueue_style( 'wp-color-picker' );
	    wp_enqueue_script( 'wp-color-picker' );
	
	    add_action( 'admin_head',   'sf_category_colors_print_styles' );
	    add_action( 'admin_footer', 'sf_category_colors_print_scripts' );
	    
	}
	add_action( 'admin_enqueue_scripts', 'sf_admin_enqueue_colour_scripts' );
	
	function sf_category_colors_print_styles() { ?>
	
	    <style type="text/css">
	        .column-color { width: 50px; }
	        .column-color .color-block { display: inline-block; width: 28px; height: 28px; border: 1px solid #ddd; line-height: 28px; text-align: center;
			}
	    </style>
	<?php }
	
	function sf_category_colors_print_scripts() { ?>
	
	    <script type="text/javascript">
	        jQuery( document ).ready( function( $ ) {
	            $( '.sf-color-field' ).wpColorPicker();
	        } );
	    </script>
	<?php }
	
	
	/* ADD COLOUR COLUMN
	================================================== */	
	function sf_edit_category_columns( $columns ) {
	
	    $columns['color'] = __( 'Color', 'uplift' );
	
	    return $columns;
	}
	add_filter( 'manage_edit-category_columns', 'sf_edit_category_columns' );
		
	function sf_add_category_color_column( $out, $column, $term_id ) {
	
	    if ( 'color' === $column ) {
	
	        $colors = sf_get_category_colors( $term_id, true );
			$color = $color_alt = "";
			
	        if ( ! $colors ) {
	            $color = '#ffffff';
	            $color_alt = '#222';
			} else {
				$color = $colors['color'];
				$color_alt = $colors['color_alt'];
			}
	        $out = sprintf( '<span class="color-block" style="background:%s;color:%s;">A</span>', esc_attr( $color ), esc_attr( $color_alt ) );
	    }
	
	    return $out;
	}
	add_filter( 'manage_category_custom_column', 'sf_add_category_color_column', 10, 3 );
	
	