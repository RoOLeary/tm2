<?php

	/*
	*
	*	Swift Framework Theme Functions
	*	------------------------------------------------
	*	Swift Framework v3.0
	* 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
	*
	*	sf_run_migration()
	*	sf_theme_opts_name()
	*	sf_theme_activation()
	*	sf_html5_ie_scripts()
	*	sf_add_portfolio_category_meta()
	*	sf_edit_portfolio_category_meta()
	*	sf_save_portfolio_category_meta()
	*	sf_nextprev_navigation()
	*	sf_register_category_color_meta()
	*	sf_post_poster_bar()
	*	sf_port_poster_bar()
	*
	*
	*	OVERRIDES
	*	sf_get_thumb_type
	*	sf_header_wrap
	*	sf_top_bar
	*	sf_main_menu
	*	sf_get_search
	*	sf_header_aux
	*	sf_ajaxsearch
	*	sf_overlay_menu
	*	sf_mobile_menu
	*	sf_get_post_details
	*	sf_product_meta
	*	sf_product_share
	*	sf_woo_help_bar
	*	sf_custom_comments
	*
	*/
	
	/* CUSTOM JS OUTPUT
	================================================== */
	function sf_custom_script() {
	    $sf_options = sf_get_theme_opts();
	    $custom_js = $sf_options['custom_js'];
	
	    if ( $custom_js ) {
	        echo '<script type="text/javascript">';
	        echo $custom_js;
	        echo '</script>';
	    }
	}
	add_action( 'wp_footer', 'sf_custom_script' );
	
	
	/* CUSTOMIZER COLOUR MIGRATION
	================================================== */
    function sf_run_migration() {
        $GLOBALS['sf_customizer']['page_bg_color'] = get_option('page_bg_color', '#fff');
        $GLOBALS['sf_customizer']['inner_page_bg_color'] = get_option('inner_page_bg_color', '#fff');
        $GLOBALS['sf_customizer']['section_divide_color'] = get_option('section_divide_color', '#eaeaea');
        $GLOBALS['sf_customizer']['accent_color'] = get_option('accent_color', '#7eced5');
        $GLOBALS['sf_customizer']['body_color'] = get_option('body_color', '#222');
        $GLOBALS['sf_customizer']['body_alt_color'] = get_option('body_alt_color', '#222');
        $GLOBALS['sf_customizer']['link_color'] = get_option('link_color', '#999');
        $GLOBALS['sf_customizer']['link_hover_color'] = get_option('link_hover_color', '#7eced5');
        $GLOBALS['sf_customizer']['h1_color'] = get_option('h1_color', '#222');
        $GLOBALS['sf_customizer']['h2_color'] = get_option('h2_color', '#222');
        $GLOBALS['sf_customizer']['h3_color'] = get_option('h3_color', '#333');
        $GLOBALS['sf_customizer']['h4_color'] = get_option('h4_color', '#222');
        $GLOBALS['sf_customizer']['h5_color'] = get_option('h5_color', '#222');
        $GLOBALS['sf_customizer']['h6_color'] = get_option('h6_color', '#222');
        
        $GLOBALS['sf_customizer']['topbar_bg_color'] = get_option('topbar_bg_color', '#fff');
        $GLOBALS['sf_customizer']['topbar_text_color'] = get_option('topbar_text_color', '#444');
        $GLOBALS['sf_customizer']['topbar_link_color'] = get_option('topbar_link_color', '#999');
        $GLOBALS['sf_customizer']['topbar_link_hover_color'] = get_option('topbar_link_hover_color', '#7eced5');
        $GLOBALS['sf_customizer']['topbar_divider_color'] = get_option('topbar_divider_color', '#eaeaea');
        
        $GLOBALS['sf_customizer']['header_bg_color'] = get_option('header_bg_color', '#fff');
        $GLOBALS['sf_customizer']['header_border_color'] = get_option('header_border_color', '#eaeaea');
        $GLOBALS['sf_customizer']['header_text_color'] = get_option('header_text_color', '#222');
        $GLOBALS['sf_customizer']['header_link_color'] = get_option('header_link_color', '#222');
        $GLOBALS['sf_customizer']['header_link_hover_color'] = get_option('header_link_hover_color', '#7eced5');
        
        $GLOBALS['sf_customizer']['nav_bg_color'] = get_option('nav_bg_color', '#fff');
        $GLOBALS['sf_customizer']['nav_text_color'] = get_option('nav_text_color', '#414141');
        $GLOBALS['sf_customizer']['nav_text_hover_color'] = get_option('nav_text_hover_color', '#7eced5');
        $GLOBALS['sf_customizer']['nav_selected_text_color'] = get_option('nav_selected_text_color', '#303030');
        $GLOBALS['sf_customizer']['nav_sm_bg_color'] = get_option('nav_sm_bg_color', '#f9f9f9');
        $GLOBALS['sf_customizer']['nav_sm_text_color'] = get_option('nav_sm_text_color', '#999');
        $GLOBALS['sf_customizer']['nav_sm_text_hover_color'] = get_option('nav_sm_text_hover_color', '#7eced5');
        $GLOBALS['sf_customizer']['nav_sm_selected_text_color'] = get_option('nav_sm_selected_text_color', '#333');
        $GLOBALS['sf_customizer']['nav_divider_color'] = get_option('nav_divider_color', '#f0f0f0');
        
        $GLOBALS['sf_customizer']['overlay_menu_bg_color'] = get_option('overlay_menu_bg_color', '#7eced5');
        $GLOBALS['sf_customizer']['overlay_menu_text_color'] = get_option('overlay_menu_text_color', '#c5e7eb');
        $GLOBALS['sf_customizer']['overlay_menu_link_color'] = get_option('overlay_menu_link_color', '#d9f0f2');
        $GLOBALS['sf_customizer']['overlay_menu_link_hover_color'] = get_option('overlay_menu_link_hover_color', '#fff');
        
        $GLOBALS['sf_customizer']['slideout_menu_bg_color'] = get_option('slideout_menu_bg_color', '#f7f7f7');
        $GLOBALS['sf_customizer']['slideout_menu_link_color'] = get_option('slideout_menu_link_color', '#fff');
        $GLOBALS['sf_customizer']['slideout_menu_link_hover_color'] = get_option('slideout_menu_link_hover_color', '#7eced5');
        $GLOBALS['sf_customizer']['slideout_menu_divider_color'] = get_option('slideout_menu_divider_color', '#ccc');
        
        $GLOBALS['sf_customizer']['mobile_menu_bg_color'] = get_option('mobile_menu_bg_color', '#fff');
        $GLOBALS['sf_customizer']['mobile_menu_text_color'] = get_option('mobile_menu_text_color', '#222');
        $GLOBALS['sf_customizer']['mobile_menu_link_color'] = get_option('mobile_menu_link_color', '#222');
        $GLOBALS['sf_customizer']['mobile_menu_link_hover_color'] = get_option('mobile_menu_link_hover_color', '#7eced5');
        $GLOBALS['sf_customizer']['mobile_menu_divider_color'] = get_option('mobile_menu_divider_color', '#eee');
        
        $GLOBALS['sf_customizer']['header_banner_bg_color'] = get_option('header_banner_bg_color', '#fff');
        $GLOBALS['sf_customizer']['header_banner_text_color'] = get_option('header_banner_text_color', '#222');
        $GLOBALS['sf_customizer']['header_banner_link_color'] = get_option('header_banner_link_color', '#333');
        $GLOBALS['sf_customizer']['header_banner_link_hover_color'] = get_option('header_banner_link_hover_color', '#7eced5');
        $GLOBALS['sf_customizer']['header_banner_border_color'] = get_option('header_banner_border_color', '#e3e3e3');
        
        $GLOBALS['sf_customizer']['page_heading_bg_color'] = get_option('page_heading_bg_color', '#f7f7f7');
        $GLOBALS['sf_customizer']['page_heading_text_color'] = get_option('page_heading_text_color', '#333');
        
        $GLOBALS['sf_customizer']['breadcrumb_text_color'] = get_option('breadcrumb_text_color', '#777');
        $GLOBALS['sf_customizer']['breadcrumb_link_color'] = get_option('breadcrumb_link_color', '#aaa');
        
        $GLOBALS['sf_customizer']['newsletter_bar_bg_color'] = get_option('newsletter_bar_bg_color', '#222');
        $GLOBALS['sf_customizer']['newsletter_bar_text_color'] = get_option('newsletter_bar_text_color', '#ccc');
        $GLOBALS['sf_customizer']['newsletter_bar_link_hover_color'] = get_option('newsletter_bar_link_hover_color', '#fff');
        
        $GLOBALS['sf_customizer']['footer_bg_color'] = get_option('footer_bg_color', '#f9f9f9');
        $GLOBALS['sf_customizer']['footer_text_color'] = get_option('footer_text_color', '#999');
        $GLOBALS['sf_customizer']['footer_link_color'] = get_option('footer_link_color', '#666');
        $GLOBALS['sf_customizer']['footer_link_hover_color'] = get_option('footer_link_hover_color', '#444');
        $GLOBALS['sf_customizer']['footer_border_color'] = get_option('footer_border_color', '#eee');
        $GLOBALS['sf_customizer']['copyright_bg_color'] = get_option('copyright_bg_color', '#f7f7f7');
        $GLOBALS['sf_customizer']['copyright_text_color'] = get_option('copyright_text_color', '#999');
        $GLOBALS['sf_customizer']['copyright_link_color'] = get_option('copyright_link_color', '#666');
        $GLOBALS['sf_customizer']['copyright_link_hover_color'] = get_option('copyright_link_hover_color', '#444');
        
        $GLOBALS['sf_customizer']['input_bg_color'] = get_option('input_bg_color', '#fff');
        $GLOBALS['sf_customizer']['input_text_color'] = get_option('input_text_color', '#999');
        $GLOBALS['sf_customizer']['overlay_bg_color'] = get_option('overlay_bg_color', '#7eced5');
        $GLOBALS['sf_customizer']['overlay_text_color'] = get_option('overlay_text_color', '#fff');
        $GLOBALS['sf_customizer']['preview_slider_bg_color'] = get_option('preview_slider_bg_color', '#f7f7f7');
        $GLOBALS['sf_customizer']['sale_tag_color'] = get_option('sale_tag_color', '#ff8a80');
        $GLOBALS['sf_customizer']['new_tag_color'] = get_option('new_tag_color', '#7eced5');
        $GLOBALS['sf_customizer']['oos_tag_color'] = get_option('oos_tag_color', '#ccc');
        
        $GLOBALS['sf_customizer']['tweet_slider_bg'] = get_option('tweet_slider_bg', '#7eced5');
        $GLOBALS['sf_customizer']['tweet_slider_text'] = get_option('tweet_slider_text', '#fff');
        $GLOBALS['sf_customizer']['tweet_slider_link'] = get_option('tweet_slider_link', '#222');
        $GLOBALS['sf_customizer']['tweet_slider_link_hover'] = get_option('tweet_slider_link_hover', '#fb3c2d');
        $GLOBALS['sf_customizer']['testimonial_slider_bg'] = get_option('testimonial_slider_bg', '#7eced5');
        $GLOBALS['sf_customizer']['testimonial_slider_text'] = get_option('testimonial_slider_text', '#fff');
        
        $GLOBALS['sf_customizer']['promo_bar_bg_color'] = get_option('promo_bar_bg_color', '#e4e4e4');
        $GLOBALS['sf_customizer']['promo_bar_text_color'] = get_option('promo_bar_text_color', '#222');
        $GLOBALS['sf_customizer']['icon_container_border_color'] = get_option('icon_container_border_color', '#eaeaea');
        $GLOBALS['sf_customizer']['icon_container_hover_border_color'] = get_option('icon_container_hover_border_color', '#7eced5');
        
        update_option( 'sf_customizer', $GLOBALS['sf_customizer']);
    }

    if (!isset($GLOBALS['sf_customizer'])) {
        $GLOBALS['sf_customizer'] = get_option('sf_customizer', array());
        if (empty($GLOBALS['sf_customizer'])) {
            sf_run_migration();
        }
    }
    //add_action( 'customize_save_after', 'sf_run_migration' );
    //add_action( 'after_switch_theme', 'sf_run_migration' );
    //add_action( 'delete_site_transient_update_themes', 'sf_run_migration' );
	

	/* THEME OPTIONS NAME
	================================================== */
	if (!function_exists('sf_theme_opts_name')) {
		function sf_theme_opts_name() {
			return 'sf_uplift_options';
		}
	}
	

	/* THEME ACTIVATION
	================================================== */
	if (!function_exists('sf_theme_activation')) {
		function sf_theme_activation() {
			global $pagenow;
			if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
				// Update sf_theme option for framework plugin
				update_option( "sf_theme", "uplift" );

				// provide hook so themes can execute theme specific functions on activation
				do_action('sf_theme_activation');

				// flush rewrite rules
				flush_rewrite_rules();

				// redirect to options page
				//header( 'Location: '.admin_url().'admin.php?page=_sf_options&sf_welcome=true' ) ;
				header( 'Location: '.admin_url().'themes.php?page=install-required-plugins' ) ;
			}
		}
		add_action('after_switch_theme', 'sf_theme_activation');
	}


	/* THEME DEACTIVATION
	================================================== */
	if (!function_exists('sf_theme_deactivation')) {
		function sf_theme_deactivation() {
			// Delete sf_theme_option
			delete_option( 'sf_theme' );
		}
		add_action('switch_theme', 'sf_theme_deactivation');
	}


	/* REQUIRED IE8 COMPATIBILITY SCRIPTS
	================================================== */
	if (!function_exists('sf_html5_ie_scripts')) {
	    function sf_html5_ie_scripts() {
	        $theme_url = get_template_directory_uri();
	        $ie_scripts = '';

	        $ie_scripts .= '<!--[if lt IE 9]>';
	        $ie_scripts .= '<script data-cfasync="false" src="'.$theme_url.'/js/respond.js"></script>';
	        $ie_scripts .= '<script data-cfasync="false" src="'.$theme_url.'/js/html5shiv.js"></script>';
	        $ie_scripts .= '<![endif]-->';
	        echo $ie_scripts;
	    }
	    add_action('wp_head', 'sf_html5_ie_scripts');
	}

	
	/* PORTFOLIO CATEGORY META
	================================================== */
	function sf_add_portfolio_category_meta() {
		?>
		<div class="form-field">
			<label for="term_meta[icon]"><?php _e( 'Category Icon', 'uplift' ); ?></label>
			<input type="text" name="term_meta[icon]" id="term_meta[icon]" value="">
			<p class="description"><?php _e( 'Enter a Font Awesome or Gizmo class name to display an icon next to the category in the portfolio filter.','uplift' ); ?></p>
		</div>
	<?php
	}
	add_action( 'portfolio-category_add_form_fields', 'sf_add_portfolio_category_meta', 10, 2 );

	// Edit term page
	function sf_edit_portfolio_category_meta($term) {
		$t_id = $term->term_id;
		$term_meta = get_option( "portfolio-category_$t_id" );
		?>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="term_meta[icon]"><?php _e( 'Category Icon', 'uplift' ); ?></label></th>
			<td>
				<input type="text" name="term_meta[icon]" id="term_meta[icon]" value="<?php echo esc_attr( $term_meta['icon'] ) ? esc_attr( $term_meta['icon'] ) : ''; ?>">
				<p class="description"><?php _e( 'Enter a Font Awesome or Gizmo class name to display an icon next to the category in the portfolio filter.','uplift' ); ?></p>
			</td>
		</tr>
	<?php
	}
	add_action( 'portfolio-category_edit_form_fields', 'sf_edit_portfolio_category_meta', 10, 2 );

	// Save extra taxonomy fields callback function.
	function sf_save_portfolio_category_meta( $term_id ) {
		if ( isset( $_POST['term_meta'] ) ) {
			$t_id = $term_id;
			$term_meta = get_option( "portfolio-category_$t_id" );
			$cat_keys = array_keys( $_POST['term_meta'] );
			foreach ( $cat_keys as $key ) {
				if ( isset ( $_POST['term_meta'][$key] ) ) {
					$term_meta[$key] = $_POST['term_meta'][$key];
				}
			}
			// Save the option array.
			update_option( "portfolio-category_$t_id", $term_meta );
		}
	}
	add_action( 'edited_portfolio-category', 'sf_save_portfolio_category_meta', 10, 2 );
	add_action( 'create_portfolio-category', 'sf_save_portfolio_category_meta', 10, 2 );


	/* ANIMATIONS LIST
	================================================== */
	if ( ! function_exists( 'sf_get_animations_list' ) ) {
		function sf_get_animations_list($return_array = false) {
		    $anim_array = array(
		        __( "None", 'uplift' )              	=> "none",
		        __( "Bounce", 'uplift' )            	=> "bounce",
		        __( "Flash", 'uplift' )             	=> "flash",
		        __( "Pulse", 'uplift' )             	=> "pulse",
		        __( "Rubberband", 'uplift' )        	=> "rubberBand",
		        __( "Shake", 'uplift' )             	=> "shake",
		        __( "Swing", 'uplift' )             	=> "swing",
		        __( "TaDa", 'uplift' )              	=> "tada",
		        __( "Wobble", 'uplift' )            	=> "wobble",
		        __( "Bounce In", 'uplift' )         	=> "bounceIn",
		        __( "Bounce In Down", 'uplift' )     => "bounceInDown",
		        __( "Bounce In Left", 'uplift' )     => "bounceInLeft",
		        __( "Bounce In Right", 'uplift' )    => "bounceInRight",
		        __( "Bounce In Up", 'uplift' )       => "bounceInUp",
		        __( "Fade In", 'uplift' )            => "fadeIn",
		        __( "Fade In Down", 'uplift' )       => "fadeInDown",
		        __( "Fade In Down Big", 'uplift' )   => "fadeInDownBig",
		        __( "Fade In Left", 'uplift' )       => "fadeInLeft",
		        __( "Fade In Left Big", 'uplift' )   => "fadeInLeftBig",
		        __( "Fade In Right", 'uplift' )      => "fadeInRight",
		        __( "Fade In Right Big", 'uplift' )  => "fadeInRightBig",
		        __( "Fade In Up", 'uplift' )         => "fadeInUp",
		        __( "Fade In Up Big", 'uplift' )     => "fadeInUpBig",
		        __( "Flip", 'uplift' )             	=> "flip",
		        __( "Flip In X", 'uplift' )          => "flipInX",
		        __( "Flip In Y", 'uplift' )          => "flipInY",
		        __( "Lightspeed In", 'uplift' )      => "lightSpeedIn",
		        __( "Rotate In", 'uplift' )          => "rotateIn",
		        __( "Rotate In Down Left", 'uplift' ) => "rotateInDownLeft",
		        __( "Rotate In Down Right", 'uplift' ) => "rotateInDownRight",
		        __( "Rotate In Up Left", 'uplift' )  => "rotateInUpLeft",
		        __( "Rotate In Up Right", 'uplift' ) => "rotateInUpRight",
		        __( "Roll In", 'uplift' )            => "rollIn",
		        __( "Zoom In", 'uplift' )            => "zoomIn",
		        __( "Zoom In Down", 'uplift' )       => "zoomInDown",
		        __( "Zoom In Left", 'uplift' )       => "zoomInLeft",
		        __( "Zoom In Right", 'uplift' )      => "zoomInRight",
		        __( "Zoom In Up", 'uplift' )         => "zoomInUp",
		        __( "Slide In Down", 'uplift' )      => "slideInDown",
		        __( "Slide In Left", 'uplift' )      => "slideInLeft",
		        __( "Slide In Right", 'uplift' )     => "slideInRight",
		        __( "Slide In Up", 'uplift' )        => "slideInUp",
		    );

		    if ( $return_array ) {
		    	return $anim_array;
		    } else {
		        $anim_opts = "";

		        foreach ($anim_array as $anim_name => $anim_class) {
		        	$anim_opts .= '<option value="'.$anim_class.'">'.$anim_name.'</option>';
		        }

		        return $anim_opts;
		    }

		}
	}


	/* HOME PRELOADER
	================================================== */
	if (!function_exists('sf_home_preloader')) {
		function sf_home_preloader() {

			$sf_options = sf_get_theme_opts();
			$home_preloader = false;
			if (isset($sf_options['home_preloader'])) {
			$home_preloader = $sf_options['home_preloader'];
			}

			if (!$home_preloader || is_paged() || !(is_home() || is_front_page())) {
				return;
			}

			$logo = $retina_logo = $alt_logo = array();
//			if (isset($sf_options['logo_upload'])) {
//			$logo = $sf_options['logo_upload'];
//			}
//			$logo_alt = get_bloginfo( 'name' );
			{ ?>

				<div id="sf-home-preloader">

					<?php if (isset($logo['url']) && $logo['url'] != "") { ?>
						<div id="preload-logo">
							<img class="standard" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo_alt); ?>" height="<?php echo esc_attr($logo['height']); ?>" width="<?php echo esc_attr($logo['width']); ?>" />
						</div>
					<?php } ?>

					<?php echo sf_get_preloader_svg(true); ?>

				</div>

			<?php }
		}
		add_action('sf_before_page_container', 'sf_home_preloader', 4);
	}
	

	/* LOADING ANIMATION
    ================================================== */
    if ( ! function_exists( 'sf_loading_animation' ) ) {
        function sf_loading_animation( $id = '', $el_class = "" ) {

            $sf_options = sf_get_theme_opts();
            $style = $sf_options['page_transition'];

            if ( $el_class == "preloader" && $style == "loading-bar" ) {
                $style = "circle-bar";
            }

            if ( $style == "loading-bar" ) {
            	return;
            }

            $animation = "";

            if ( $id != "" ) {
                $animation .= '<div id="' . $id . '" class="' . $style . '">';
            } else {
                $animation .= '<div class="' . $style . '">';
            }

            $animation .= sf_get_preloader_svg(true);
            $animation .= '</div>';

            return $animation;

        }
    }
    

	/* PRELOADER SVG
	================================================== */
	if (!function_exists('sf_get_preloader_svg')) {
		function sf_get_preloader_svg( $return = false ) {
		
			$sf_options = sf_get_theme_opts();
			$preloader = $sf_options['page_transition'];
			$svg_url = get_template_directory_uri().'/images/loader-svgs';
			$svg_html = "";
			
			if ( $preloader == "" ) {
				$svg_html = '<div class="sf-svg-loader"><object data="'.$svg_url.'/loader-32px-glyph_circle-04.svg" type="image/svg+xml"></object></div>';
			} else if ( $preloader == "circle" ) {
				$svg_html = '<div class="sf-svg-loader"><object data="'.$svg_url.'/loader-32px-glyph_x-circle-08.svg" type="image/svg+xml"></object></div>';
			} else if ( $preloader == "circle-gap" ) {
				$svg_html = '<div class="sf-svg-loader"><object data="'.$svg_url.'/loader-32px-glyph_circle-04.svg" type="image/svg+xml"></object></div>';
			} else if ( $preloader == "circle-swing" ) {
				$svg_html = '<div class="sf-svg-loader"><object data="'.$svg_url.'/loader-32px-glyph_circle-03.svg" type="image/svg+xml"></object></div>';
			} else if ( $preloader == "circle-bars" ) {
				$svg_html = '<div class="sf-svg-loader"><object data="'.$svg_url.'/loader-32px-glyph_bars-rotate.svg" type="image/svg+xml"></object></div>';
			} else if ( $preloader == "squares" ) {
				$svg_html = '<div class="sf-svg-loader"><object data="'.$svg_url.'/loader-32px-glyph_squares.svg" type="image/svg+xml"></object></div>';
			} else if ( $preloader == "ripples" ) {
				$svg_html = '<div class="sf-svg-loader"><object data="'.$svg_url.'/loader-32px-glyph_ripples.svg" type="image/svg+xml"></object></div>';
			} else if ( $preloader == "mouse" ) {
				$svg_html = '<div class="sf-svg-loader"><object data="'.$svg_url.'/loader-32px-glyph_mouse.svg" type="image/svg+xml"></object></div>';
			} else if ( $preloader == "dots" ) {
				$svg_html = '<div class="sf-svg-loader"><object data="'.$svg_url.'/loader-32px-glyph_dots-07.svg" type="image/svg+xml"></object></div>';
			} else if ( $preloader == "dots-circle" ) {
				$svg_html = '<div class="sf-svg-loader"><object data="'.$svg_url.'/loader-32px-glyph_dots-06.svg" type="image/svg+xml"></object></div>';
			} else if ( $preloader == "dots-wave" ) {
				$svg_html = '<div class="sf-svg-loader"><object data="'.$svg_url.'/loader-32px-glyph_dots-05.svg" type="image/svg+xml"></object></div>';
			} else if ( $preloader == "bars" ) {
				$svg_html = '<div class="sf-svg-loader"><object data="'.$svg_url.'/loader-32px-glyph_bars.svg" type="image/svg+xml"></object></div>';
			} else {
				$svg_html = '<div class="sf-svg-loader"><object data="'.$svg_url.'/loader-32px-glyph_circle-04.svg" type="image/svg+xml"></object></div>';
			}
			
			if ( $return ) {
				return $svg_html;
			} else {
				echo $svg_html;
			}
		}
		add_action( 'sf_after_page_container', 'sf_get_preloader_svg', 70 );
	}
	
	
	/* SPLIT HEADER MENU
	================================================== */
	if ( !function_exists('sf_split_header_menu')) {
		function sf_split_header_menu( $side = "left" ) {
			
			$theme_location = $side == "left" ? 'split_nav_left' : 'split_nav_right';
			
			// Menu options
			$menu_args = array(
				'echo'            => false,
				'theme_location' => $theme_location,
				'walker' => new sf_mega_menu_walker,
				'fallback_cb' => '',
			);
			
			// MENU OUTPUT
			$menu_output = '<nav class="std-menu clearfix">'. "\n";
			if ( function_exists( 'wp_nav_menu' ) ) {
				if ( has_nav_menu( $theme_location ) ) {
					$menu_output .= wp_nav_menu( $menu_args );
				}
			}
			$menu_output .= '</nav>'. "\n";
			
			return $menu_output;
			
		}		
	}
	

	/* SIDE SLIDEOUT CONFIG
	================================================== */
	if (!function_exists('sf_sideslideout_config')) {
		function sf_sideslideout_config() {

			$sf_options = sf_get_theme_opts();

			$header_left_config = $sf_options['header_left_config'];
			$header_right_config = $sf_options['header_right_config'];

			// Side Slideout Left
			if (isset($header_left_config) && array_key_exists('side-slideout', $header_left_config['enabled'])) {
				echo sf_sideslideout('left');
			}

			// Side Slideout Right
			if (isset($header_right_config) && array_key_exists('side-slideout', $header_right_config['enabled'])) {
				echo sf_sideslideout('right');
			}

		}
		add_action( 'sf_before_page_container', 'sf_sideslideout_config', 40 );
	}

	/* SIDE SLIDEOUT
	================================================== */
	if (!function_exists('sf_sideslideout')) {
		function sf_sideslideout($side = 'left') {

			$sf_options = sf_get_theme_opts();
			$slideout_output = $page_menu = $menu_output = "";

			if ( !class_exists( 'sf_mega_menu_walker' ) ) {
				return 'Please enable the SwiftFramework plugin';
			}

			$slideout_menu_args = array(
				'echo'           => false,
				'theme_location' => 'slideout_menu',
				'walker'         => new sf_alt_menu_walker,
				'fallback_cb' 	 => '',
			);


			// MENU OUTPUT
			$menu_output .= '<nav class="std-menu clearfix">'. "\n";

			if (function_exists('wp_nav_menu')) {
				if (has_nav_menu('slideout_menu')) {
					$menu_output .= wp_nav_menu( $slideout_menu_args );
				}
			}
			$menu_output .= '</nav>'. "\n";


			// SLIDEOUT OUTPUT

			$slideout_output .= '<div id="side-slideout-'.$side.'-wrap" class="sf-side-slideout">';
			$slideout_output .= '<div class="vertical-menu">';
			$slideout_output .= $menu_output;
			$slideout_output .= '</div>';
			$slideout_output .= '</div>';

			return $slideout_output;
		}
	}
	
	
	/* PUSHNAV CONFIG
	================================================== */
	if (!function_exists('sf_pushnav_config')) {
		function sf_pushnav_config() {
	
			$sf_options = sf_get_theme_opts();
	
			$header_left_config = $sf_options['header_left_config'];
			$header_right_config = $sf_options['header_right_config'];
	
			// Push Nav Left
			if (isset($header_left_config) && array_key_exists('push-nav', $header_left_config['enabled'])) {
				echo sf_pushnav('left');
			}
	
			// Push Nav Right
			if (isset($header_right_config) && array_key_exists('push-nav', $header_right_config['enabled'])) {
				echo sf_pushnav('right');
			}
	
		}
		add_action( 'sf_before_page_container', 'sf_pushnav_config', 50 );
	}

	
	/* PUSH NAV
	================================================== */
	if (!function_exists('sf_pushnav')) {
		function sf_pushnav($side = 'left') {

			$sf_options = sf_get_theme_opts();
			$pushnav_output = $page_menu = $menu_output = $extra_class = "";
			
			$pushnav_size = $sf_options['pushnav_size'];
			$pushnav_text = $sf_options['pushnav_text'];
			
			if ( $pushnav_size == "fullscreen" ) {
				$extra_class = 'full-size';
			}
			if ( $pushnav_size == "quarter" ) {
				$extra_class = 'quarter-size';
			}
			if ( $pushnav_size == "mini" ) {
				$extra_class .= 'quarter-size mini-size';
			}
			
			
			if ( !class_exists( 'sf_mega_menu_walker' ) ) {
				return 'Please enable the SwiftFramework plugin';
			}

			$pushnav_menu_args = array(
				'echo'           => false,
				'theme_location' => 'pushnav_menu',
				'walker'         => new sf_alt_menu_walker,
				'fallback_cb' 	 => '',
			);


			// MENU OUTPUT
			$menu_output .= '<nav class="clearfix">'. "\n";

			if ( function_exists( 'wp_nav_menu' ) ) {
				if ( has_nav_menu( 'pushnav_menu' ) ) {
					$menu_output .= wp_nav_menu( $pushnav_menu_args );
				}
			}
			$menu_output .= '</nav>'. "\n";
	
			// AUX OUTPUT
			$pushnav_aux = $pushnav_text;

			// SLIDEOUT OUTPUT
			$pushnav_output .= '<div class="sf-pushnav ' . $extra_class . '">';
			$pushnav_output .= '<div class="sf-pushnav-wrapper container">';
			$pushnav_output .= '<a href="#" class="sf-pushnav-trigger sf-pushnav-close"><svg version="1.1" id="sf-pushnav-close" class="sf-hover-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 width="48px" height="48px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xml:space="preserve"><path fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="
				M24,2c12.15,0,22,9.85,22,22s-9.85,22-22,22S2,36.15,2,24C2,11.902,11.766,2.084,23.844,2"/><path class="cross" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M16,32l16-16 M32,32L16,16
				 M16,32l16-16"/></svg></a>';
			$pushnav_output .= '<div class="sf-pushnav-menu col-sm-6 col-sm-offset-1">';
			$pushnav_output .= $menu_output;
			$pushnav_output .= '</div>';
			$pushnav_output .= '<div class="sf-pushnav-aux col-sm-3 col-sm-offset-1">';
			$pushnav_output .= do_shortcode( $pushnav_aux );
			$pushnav_output .= '</div>';
			$pushnav_output .= '</div>';
			$pushnav_output .= '</div>';

			return $pushnav_output;
		}
	}
		
		
	/* FULLSCREEN SEARCH
	================================================== */
	if (!function_exists('sf_fullscreen_supersearch')) {
		function sf_fullscreen_supersearch() {
			$fs_close_icon = apply_filters( 'sf_fullscreen_close_icon', '<i class="ss-delete"></i>' );
		?>

			<div id="fullscreen-supersearch">

				<a href="#" class="fs-overlay-close">
					<?php echo $fs_close_icon; ?>
				</a>

				<div class="supersearch-wrap">
					<?php if ( function_exists('sf_super_search') ) {
						echo sf_super_search();
					} ?>
				</div>

			</div>

		<?php }
	}
	

	/* NEXT/PREV NAVIGATION
	================================================== */
	if (!function_exists('sf_nextprev_navigation')) {
		function sf_nextprev_navigation() {

			$sf_options = sf_get_theme_opts();

			// Pagiantion style
			$pagination_style = "standard";
			if ( isset( $sf_options['pagination_style'] ) ) {
			    $pagination_style = $sf_options['pagination_style'];
			}

			// Category navigation
			$enable_category_navigation = $sf_options['enable_category_navigation'];

			if (!(is_singular('post') || is_singular('portfolio') || is_singular('product')) || $pagination_style != "fs-arrow" || !sf_theme_supports( 'fullscreen-pagination' ) ) {
				return;
			}

			$taxonomy = "category";

			if ( is_singular('portfolio') ) {
				$taxonomy = "portfolio-category";
			} else if ( is_singular('product') ) {
				$taxonomy = "product_cat";
			}

			// Get next/prev post
			$prev_post = get_next_post($enable_category_navigation, '', $taxonomy);
			$next_post = get_previous_post($enable_category_navigation, '', $taxonomy);

			$sf_prev_icon = apply_filters( 'sf_prev_icon', '<i class="ss-navigateleft"></i>' );
			$sf_next_icon = apply_filters( 'sf_next_icon', '<i class="ss-navigateright"></i>' );

			if (!empty( $prev_post )) {

				$postID = $prev_post->ID;
				$prev_permalink = get_permalink($postID);
				$item_subtitle = sf_get_post_meta($postID, 'sf_portfolio_subtitle', true);
				$use_thumb_content = sf_get_post_meta($postID, 'sf_thumbnail_content_main_detail', true);

				$image = $media_image_url = $image_id = "";

				if ($use_thumb_content) {
				$media_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full', $postID);
				} else {
				$media_image = rwmb_meta('sf_detail_image', 'type=image&size=full', $postID);
				}

				foreach ($media_image as $detail_image) {
					$image_id = $detail_image['ID'];
					$media_image_url = $detail_image['url'];
					break;
				}

				if (!$media_image) {
					$media_image = get_post_thumbnail_id($postID);
					$image_id = $media_image;
					$media_image_url = wp_get_attachment_url( $media_image, 'full' );
				}

				$detail_image = sf_aq_resize($media_image_url, 80, 80, true, false);
				$image_alt = sf_get_post_meta($image_id, '_wp_attachment_image_alt', true);

				if ($detail_image) {
					$image = '<img itemprop="image" src="'.$detail_image[0].'" width="'.$detail_image[1].'" height="'.$detail_image[2].'" alt="'.$image_alt.'" />';
				}

				?>

				<?php if ($image != "") { ?>
				<div id="prev-article-pagination" class="window-arrow-nav prev-item has-img">
				<?php } else { ?>
				<div id="prev-article-pagination" class="window-arrow-nav prev-item">
				<?php } ?>

					<a href="<?php echo esc_url($prev_permalink); ?>">
						<div class="nav-transition">
							<div class="overlay-wrap">
								<?php echo esc_html($sf_prev_icon); ?>
								<?php if ($image != "") { ?>
								<figure class="pagination-article-image">
									<?php echo esc_html($image); ?>
								</figure>
								<?php } ?>
							</div>
						</div>

						<?php if ($item_subtitle != "") { ?>
						<div class="pagination-article-details has-subtitle">
							<h5><?php echo esc_attr($prev_post->post_title); ?></h5>
							<p><?php echo esc_attr($item_subtitle); ?></p>
						<?php } else { ?>
						<div class="pagination-article-details no-subtitle">
							<h5><?php echo esc_attr($prev_post->post_title); ?></h5>
						<?php } ?>
						</div>
					</a>
				</div>
			<?php }

		 	if (!empty( $next_post )) {

		 		$postID = $next_post->ID;
		 		$next_permalink = get_permalink($postID);
		 		$item_subtitle = sf_get_post_meta($postID, 'sf_portfolio_subtitle', true);
		 		$use_thumb_content = sf_get_post_meta($postID, 'sf_thumbnail_content_main_detail', true);

		 		$image = $media_image_url = $image_id = "";

		 		if ($use_thumb_content) {
		 		$media_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full', $postID);
		 		} else {
		 		$media_image = rwmb_meta('sf_detail_image', 'type=image&size=full', $postID);
		 		}

		 		foreach ($media_image as $detail_image) {
		 			$image_id = $detail_image['ID'];
		 			$media_image_url = $detail_image['url'];
		 			break;
		 		}

		 		if (!$media_image) {
		 			$media_image = get_post_thumbnail_id($postID);
		 			$image_id = $media_image;
		 			$media_image_url = wp_get_attachment_url( $media_image, 'full' );
		 		}

		 		$detail_image = sf_aq_resize($media_image_url, 80, 80, true, false);
		 		$image_alt = sf_get_post_meta($image_id, '_wp_attachment_image_alt', true);

		 		if ($detail_image) {
		 			$image = '<img itemprop="image" src="'.$detail_image[0].'" width="'.$detail_image[1].'" height="'.$detail_image[2].'" alt="'.$image_alt.'" />';
		 		}

		 		?>

		 		<?php if ($image != "") { ?>
		 		<div id="next-article-pagination" class="window-arrow-nav next-item has-img">
		 		<?php } else { ?>
		 		<div id="next-article-pagination" class="window-arrow-nav next-item">
		 		<?php } ?>

					<a href="<?php echo esc_url($next_permalink); ?>">

						<div class="nav-transition">
							<div class="overlay-wrap">
								<?php echo esc_html($sf_next_icon); ?>
								<?php if ($image != "") { ?>
								<figure class="pagination-article-image">
								<?php echo esc_html($image); ?>
								</figure>
								<?php } ?>
							</div>
						</div>

						<?php if ($item_subtitle != "") { ?>
						<div class="pagination-article-details has-subtitle">
							<h5><?php echo esc_attr($next_post->post_title); ?></h5>
							<p><?php echo esc_attr($item_subtitle); ?></p>
						<?php } else { ?>
						<div class="pagination-article-details no-subtitle">
							<h5><?php echo esc_attr($next_post->post_title); ?></h5>
						<?php } ?>
						</div>
					</a>
				</div>
		 	<?php }
		}
		add_action('sf_main_container_start', 'sf_nextprev_navigation', 50);
	}
	
	
	/* BLOG POSTER BAR
	================================================== */
	if (!function_exists('sf_post_poster_bar')) {
		function sf_post_poster_bar() {
			
			global $post;
			$sf_options = sf_get_theme_opts();
			$fw_media_display     = sf_get_post_meta( $post->ID, 'sf_fw_media_display', true );
			$remove_breadcrumbs = apply_filters( 'sf_port_poster_bar_removebreadcrumbs', 0 );
			$next_icon = apply_filters( 'sf_next_icon', '<i class="sf-icon-right-arrow"></i>' );
			$prev_icon = apply_filters( 'sf_prev_icon', '<i class="sf-icon-left-arrow"></i>' );
			$index_icon = apply_filters( 'sf_index_icon', '<i class="sf-icon-portfolio"></i>' );
			$enable_category_navigation = $sf_options['enable_category_navigation'];
			$portfolio_page = $sf_options['blog_page'];
			
			if ( $fw_media_display != "fw-media-title" ) {
				return;
			}
				
			?>
			
			<div class="post-poster-bar">
				<div class="container">
					
					<div class="post-nav">
						<?php if ( isset($blog_page) ) { ?>
						<div class="view-all"><a href="<?php echo get_permalink($blog_page); ?>"><?php echo $index_icon; ?></a></div>
						<div class="divide"></div>
						<?php } ?>
						<div class="prev-item"><?php next_post_link( '%link', $prev_icon, $enable_category_navigation, '', 'category' ); ?></div>
						<div class="next-item"><?php previous_post_link( '%link', $next_icon, $enable_category_navigation, '', 'category' ); ?></div>		
					</div>
								
					<?php if ( !$remove_breadcrumbs ) {
						echo sf_breadcrumbs( true );
					} ?>
			
				</div>
			</div>
		<?php }
		//add_action( 'sf_post_article_start', 'sf_post_poster_bar', 0 );
	}
	
	/* BLOG DETAIL MEDIA BREADCRUMBS
	================================================== */
	if (!function_exists('sf_post_detail_media_breadcrumbs')) {
		function sf_post_detail_media_breadcrumbs() {
		
			global $post;
			$remove_breadcrumbs = sf_get_post_meta( $post->ID, 'sf_no_breadcrumbs', true );
			$details_overlay_styling = "";
			$details_overlay_color   = sf_get_post_meta( $post->ID, 'sf_title_overlay_text_color', true );
			if ( $details_overlay_color != "" ) {
			    $details_overlay_styling = 'style="color: ' . $details_overlay_color . '"';
			}
			
			if ( !$remove_breadcrumbs ) {
				echo '<div class="breadcrumbs-wrap" '.$details_overlay_styling.'>';
				echo sf_breadcrumbs( true );
				echo '</div>';
			}
			
		}
		add_action( 'sf_post_detail_media_details_after', 'sf_post_detail_media_breadcrumbs', 0 );
	}
	
	
	/* PORT POSTER BAR
	================================================== */
	if (!function_exists('sf_port_poster_bar')) {
		function sf_port_poster_bar() {
			
			global $post;
			$sf_options 				= sf_get_theme_opts();
			$fw_media_display     		= sf_get_post_meta( $post->ID, 'sf_fw_media_display', true );
			$remove_breadcrumbs 		= apply_filters( 'sf_port_poster_bar_removebreadcrumbs', 0 );
			$next_icon 					= apply_filters( 'sf_next_icon', '<i class="sf-icon-right-arrow"></i>' );
			$prev_icon 					= apply_filters( 'sf_prev_icon', '<i class="sf-icon-left-arrow"></i>' );
			$index_icon 				= apply_filters( 'sf_index_icon', '<i class="sf-icon-portfolio"></i>' );
			$enable_category_navigation = $sf_options['enable_category_navigation'];
			$portfolio_page 			= $sf_options['portfolio_page'];
			
			if ( $fw_media_display != "poster" ) {
				return;
			}
				
			?>
			
			<div class="post-poster-bar">
				<div class="container">
					
					<div class="post-nav">
						<?php if ( isset($portfolio_page) ) { ?>
						<div class="view-all"><a href="<?php echo get_permalink($portfolio_page); ?>"><?php echo $index_icon; ?></a></div>
						<div class="divide"></div>
						<?php } ?>
						<div class="prev-item"><?php next_post_link( '%link', $prev_icon, $enable_category_navigation, '', 'portfolio-category' ); ?></div>
						<div class="next-item"><?php previous_post_link( '%link', $next_icon, $enable_category_navigation, '', 'portfolio-category' ); ?></div>		
					</div>
								
					<?php if ( !$remove_breadcrumbs ) {
						echo sf_breadcrumbs( true );
					} ?>
			
				</div>
			</div>
		<?php }
		add_action( 'sf_portfolio_article_figure_inner', 'sf_port_poster_bar', 10 );
	}
	
	
	/* SIDE PROGRESS MENU
	================================================== */
	if ( !function_exists('sf_side_progress_menu') ) {
		function sf_side_progress_menu() {
			echo '<div id="sidebar-progress-menu"></div>';
		}
	}
	

	/* GET THUMB TYPE
	================================================== */
	if (!function_exists('sf_get_thumb_type')) {
		function sf_get_thumb_type() {
			return 'thumbnail-default';
		}
	}
	
	
	/* POST DETAIL MEDIA CATEGORIES
	================================================== */
	if (!function_exists('uplift_detail_media_categories')) {
		function uplift_detail_media_categories() {			
			global $post;
			$post_categories = sf_get_custom_post_cat_list($post->ID);
			echo '<div class="post-cats">'.$post_categories.'</div>';	
		}
		add_action( 'sf_post_detail_media_details_before', 'uplift_detail_media_categories', 10 );
	}
    

	/*
	*	PRODUCT META OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/sf-woocommerce.php
	*
	================================================== */
	if ( ! function_exists( 'sf_product_meta' ) ) {
		function sf_product_meta() {
			return;
		}
	}


	/*
	*	PRODUCT SHARE OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/sf-woocommerce.php
	*
	================================================== */
    if ( ! function_exists( 'sf_product_share' ) ) {
        function sf_product_share() {
            ?>
            <?php echo do_shortcode('[sf_social_share]'); ?>
        <?php
        }

        add_action( 'woocommerce_single_product_summary', 'sf_product_share', 45 );
    }


    /*
	*	WOO HELP BAR OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/sf-woocommerce.php
	*
	================================================== */
    if ( ! function_exists( 'sf_woo_help_bar' ) ) {
        function sf_woo_help_bar() {
            $sf_options = sf_get_theme_opts();
            
            $disable_help_bar = false;
            
            if ( isset( $sf_options['disable_help_bar'] ) ) {
			$disable_help_bar = $sf_options['disable_help_bar'];
			}
            $help_bar_text  = $sf_options['help_bar_text'];
            $email_modal_title    = $sf_options['email_modal_title'];
            $email_modal    = $sf_options['email_modal'];
            $shipping_modal_title = $sf_options['shipping_modal_title'];
            $shipping_modal = $sf_options['shipping_modal'];
            $returns_modal_title  = $sf_options['returns_modal_title'];
            $returns_modal  = $sf_options['returns_modal'];
            $faqs_modal_title     = $sf_options['faqs_modal_title'];
            $faqs_modal     = $sf_options['faqs_modal'];

            $modal_delete_icon = apply_filters( 'sf_close_icon', '<i class="ss-delete"></i>' );
            ?>
            <?php if ( !$disable_help_bar ) { ?>
	            <div class="help-bar clearfix">
	                <span><?php echo do_shortcode( $help_bar_text ); ?></span>
	                <ul>
	                    <?php if ( $email_modal_title != "" ) { ?>
	                        <li><a href="#email-form" class="inline"
	                               data-toggle="modal"><?php echo esc_attr($email_modal_title); ?></a></li>
	                    <?php } ?>
	                    <?php if ( $shipping_modal_title != "" ) { ?>
	                        <li><a href="#shipping-information" class="inline"
	                               data-toggle="modal"><?php echo esc_attr($shipping_modal_title); ?></a></li>
	                    <?php } ?>
	                    <?php if ( $returns_modal_title != "" ) { ?>
	                        <li><a href="#returns-exchange" class="inline"
	                               data-toggle="modal"><?php echo esc_attr($returns_modal_title); ?></a></li>
	                    <?php } ?>
	                    <?php if ( $faqs_modal_title != "" ) { ?>
	                        <li><a href="#faqs" class="inline"
	                               data-toggle="modal"><?php echo esc_attr($faqs_modal_title); ?></a></li>
	                    <?php } ?>
	                </ul>
	            </div>

	            <?php if ( $email_modal_title != "" ) { ?>
	                <div id="email-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="email-form-modal"
	                     aria-hidden="true">
	                    <div class="modal-dialog">
	                        <div class="modal-content">
	                            <div class="modal-header">
	                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo $modal_delete_icon; ?></button>
	                                <h3 id="email-form-modal"><?php echo esc_attr($email_modal_title); ?></h3>
	                            </div>
	                            <div class="modal-body">
	                                <?php echo do_shortcode( $email_modal ); ?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            <?php } ?>

	            <?php if ( $shipping_modal_title != "" ) { ?>
	                <div id="shipping-information" class="modal fade" tabindex="-1" role="dialog"
	                     aria-labelledby="shipping-modal" aria-hidden="true">
	                    <div class="modal-dialog">
	                        <div class="modal-content">
	                            <div class="modal-header">
	                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo $modal_delete_icon; ?></button>
	                                <h3 id="shipping-modal"><?php echo esc_attr($shipping_modal_title); ?></h3>
	                            </div>
	                            <div class="modal-body">
	                                <?php echo do_shortcode( $shipping_modal ); ?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            <?php } ?>

	            <?php if ( $returns_modal_title != "" ) { ?>
	                <div id="returns-exchange" class="modal fade" tabindex="-1" role="dialog"
	                     aria-labelledby="returns-modal" aria-hidden="true">
	                    <div class="modal-dialog">
	                        <div class="modal-content">
	                            <div class="modal-header">
	                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo $modal_delete_icon; ?></button>
	                                <h3 id="returns-modal"><?php echo esc_attr($returns_modal_title); ?></h3>
	                            </div>
	                            <div class="modal-body">
	                                <?php echo do_shortcode( $returns_modal ); ?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            <?php } ?>

	            <?php if ( $faqs_modal_title != "" ) { ?>
	                <div id="faqs" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="faqs-modal"
	                     aria-hidden="true">
	                    <div class="modal-dialog">
	                        <div class="modal-content">
	                            <div class="modal-header">
	                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo $modal_delete_icon; ?></button>
	                                <h3 id="faqs-modal"><?php echo esc_attr($faqs_modal_title); ?></h3>
	                            </div>
	                            <div class="modal-body">
	                                <?php echo do_shortcode( $faqs_modal ); ?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            <?php } ?>
			<?php } ?>
        <?php
        }
        add_action( 'woocommerce_before_account_navigation', 'sf_woo_help_bar' );
    }
	
	
	/*
	*	GET TWEETS OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/core/sf-functions.php
	*
	================================================== */
    if ( ! function_exists( 'sf_get_tweets' ) ) {
        function sf_get_tweets( $twitterID, $count, $type = "", $item_class = "col-sm-4" ) {

            $sf_options = sf_get_theme_opts();
            $enable_twitter_rts = false;
            if ( isset( $sf_options['enable_twitter_rts'] ) ) {
                $enable_twitter_rts = $sf_options['enable_twitter_rts'];
            }

            $content         = "";
            $blog_grid_count = 0;

            if ( function_exists( 'getTweets' ) ) {

                $options = array(
                    'trim_user'       => true,
                    'exclude_replies' => false,
                    'include_rts'     => $enable_twitter_rts
                );

                $tweets = getTweets( $twitterID, $count, $options );

                if ( is_array( $tweets ) ) {

                    if ( isset( $tweets["error"] ) && $tweets["error"] != "" ) {

                        return '<li>' . $tweets["error"] . '</li>';

                    } else {

                        foreach ( $tweets as $tweet ) {

                            if ( $type == "blog-grid" ) {

                                $content .= '<li class="blog-item '.$item_class.' tweet-item" data-date="' . strtotime( $tweet['created_at'] ) . '" data-sortid="' . $blog_grid_count . '">';
                                $content .= '<a class="grid-link" href="https://twitter.com/' . $twitterID . '/status/' . $tweet['id_str'] . '" target="_blank"></a>';
                                $content .= '<div class="grid-no-image">';
                                $content .= '<div class="details-inner">';

                                $blog_grid_count = $blog_grid_count + 2;

                            } else if ( $type == "blog" ) {

                                $content .= '<li class="blog-item tweet-item ' . $item_class . '" data-date="' . strtotime( $tweet['created_at'] ) . '">';
                               	$content .= '<div class="details-wrap clearfix">';
                               	$content .= '<div class="details-inner">';

                            } else if ( $type == "blog-fw" ) {

                                $content .= '<li class="blog-item tweet-item ' . $item_class . '" data-date="' . strtotime( $tweet['created_at'] ) . '">';
                                $content .= '<div class="details-wrap clearfix">';
                               	$content .= '<div class="details-inner">';

                            } else {

                                $content .= '<li>';

                            }

                            if ( isset( $tweet['text'] ) && $tweet['text'] ) {
                            	
                                // 3. Tweet Actions
                                //    Reply, Retweet, and Favorite action icons must always be visible for the user to interact with the Tweet. These actions must be implemented using Web Intents or with the authenticated Twitter API.
                                //    No other social or 3rd party actions similar to Follow, Reply, Retweet and Favorite may be attached to a Tweet.
                                // 4. Tweet Timestamp
                                //    The Tweet timestamp must always be visible and include the time and date. e.g., "3:00 PM - 31 May 12".
                                // 5. Tweet Permalink
                                //    The Tweet timestamp must always be linked to the Tweet permalink.

                                $content .= '<div class="twitter_intents clearfix">' . "\n";
                                $content .= '<a class="reply" href="https://twitter.com/intent/tweet?in_reply_to=' . $tweet['id_str'] . '"><i class="fa-reply"></i></a>' . "\n";
                                $content .= '<a class="retweet" href="https://twitter.com/intent/retweet?tweet_id=' . $tweet['id_str'] . '"><i class="fa-retweet"></i></a>' . "\n";
                                $content .= '<a class="favorite" href="https://twitter.com/intent/favorite?tweet_id=' . $tweet['id_str'] . '"><i class="fa-star"></i></a>' . "\n";

                                $date     = strtotime( $tweet['created_at'] ); // retrives the tweets date and time in Unix Epoch terms
                                $blogtime = current_time( 'U' ); // retrives the current browser client date and time in Unix Epoch terms
                                $dago     = human_time_diff( $date, $blogtime ) . ' ' . sprintf( __( 'ago', 'uplift' ) ); // calculates and outputs the time past in human readable format
                                $content .= '<h3><a class="twitter-id" href="http://twitter.com/' . $twitterID . '" target="_blank">@' . $twitterID . '</a></h3>';
                                $content .= '<a class="timestamp" href="https://twitter.com/' . $twitterID . '/status/' . $tweet['id_str'] . '" target="_blank">' . $dago . '</a>' . "\n";
                                $content .= '</div>' . "\n";

                                if ( $type == "blog" || $type == "blog-grid" || $type == "blog-fw" ) {
                                    $content .= '<h3 class="tweet-text">';
                                } else {
                                    $content .= '<div class="tweet-text slide-content-wrap">';
                                }

                                $the_tweet = apply_filters( 'sf_tweet_text', $tweet['text'] );

                                /*
                                Twitter Developer Display Requirements
                                https://dev.twitter.com/terms/display-requirements

                                2.b. Tweet Entities within the Tweet text must be properly linked to their appropriate home on Twitter. For example:
                                  i. User_mentions must link to the mentioned user's profile.
                                 ii. Hashtags must link to a twitter.com search with the hashtag as the query.
                                iii. Links in Tweet text must be displayed using the display_url
                                     field in the URL entities API response, and link to the original t.co url field.
                                */

                                // i. User_mentions must link to the mentioned user's profile.
                                if ( isset( $tweet['entities']['user_mentions'] ) && is_array( $tweet['entities']['user_mentions'] ) ) {
                                    foreach ( $tweet['entities']['user_mentions'] as $key => $user_mention ) {
                                        $the_tweet = preg_replace(
                                            '/@' . $user_mention['screen_name'] . '/i',
                                            '<a href="http://www.twitter.com/' . $user_mention['screen_name'] . '" target="_blank">@' . $user_mention['screen_name'] . '</a>',
                                            $the_tweet );
                                    }
                                }

                                // ii. Hashtags must link to a twitter.com search with the hashtag as the query.
                                if ( isset( $tweet['entities']['hashtags'] ) && is_array( $tweet['entities']['hashtags'] ) ) {
                                    foreach ( $tweet['entities']['hashtags'] as $key => $hashtag ) {
                                        $the_tweet = preg_replace(
                                            '/#' . $hashtag['text'] . '/i',
                                            '<a href="https://twitter.com/search?q=%23' . $hashtag['text'] . '&amp;src=hash" target="_blank">#' . $hashtag['text'] . '</a>',
                                            $the_tweet );
                                    }
                                }

                                // iii. Links in Tweet text must be displayed using the display_url
                                //      field in the URL entities API response, and link to the original t.co url field.
                                if ( isset( $tweet['entities']['urls'] ) && is_array( $tweet['entities']['urls'] ) ) {
                                    foreach ( $tweet['entities']['urls'] as $key => $link ) {

                                        $link_url = "";

                                        if ( isset( $link['expanded_url'] ) ) {
                                            $link_url = $link['expanded_url'];
                                        } else {
                                            $link_url = $link['url'];
                                        }

                                        $the_tweet = preg_replace(
                                            '`' . $link['url'] . '`',
                                            '<a href="' . $link_url . '" target="_blank">' . $link_url . '</a>',
                                            $the_tweet );
                                    }
                                }

                                // Custom code to link to media
                                if ( isset( $tweet['entities']['media'] ) && is_array( $tweet['entities']['media'] ) ) {
                                    foreach ( $tweet['entities']['media'] as $key => $media ) {

                                        $the_tweet = preg_replace(
                                            '`' . $media['url'] . '`',
                                            '<a href="' . $media['url'] . '" target="_blank">' . $media['url'] . '</a>',
                                            $the_tweet );
                                    }
                                }

                                $content .= $the_tweet;

                                if ( $type == "blog" || $type == "blog-grid" || $type == "blog-fw" ) {
                                    $content .= '</h3>';
                                } else {
                                    $content .= '</div>';
                                }

                            } else {
                                $content .= '<a href="http://twitter.com/' . $twitterID . '" target="_blank">@' . $twitterID . '</a>';
                            }

                            if ( $type == "blog" || $type == "blog-grid" || $type == "blog-fw" ) {
                            	
                            	$content .= '</div>';
                            	$content .= '<div class="blog-item-aux clearfix">';
                	            $content .= '<data class="date" data-date="' . $date . '" value="' . $date . '">' . $dago . '</data>';
                	            $content .= '<div class="author"><a class="tweet-link" href="https://twitter.com/' . $twitterID . '/status/' . $tweet['id_str'] . '" target="_blank"><span>@' . $twitterID . '</span></a></div>';
                                $content .= '</div>';
                                $content .= '</div>';
                            }

                            $content .= '</li>';
                        }
                    }

                    return $content;

                }
            } else {
                return '<li><div class="tweet-text">Please install the oAuth Twitter Feed Plugin and follow the theme documentation to set it up.</div></li>';
            }

        }
    }
	
