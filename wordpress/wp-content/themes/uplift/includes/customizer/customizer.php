<?php

    /*
    *
    *   Customizer Configuration
    *   ------------------------------------------------
    *   Swift Framework
    *   Copyright Swift Ideas 2015 - http://www.swiftideas.com
    *   @since v1.0.0
    *   
    *
    *   sf_custom_styles_output()
    *
    *
    */


    /* CUSTOMIZER ADMIN BAR MENU ITEM
	================================================== */
	if ( !function_exists('sf_customizer_admin_bar_menu_item') ) {
		function sf_customizer_admin_bar_menu_item() {

			global $wp_admin_bar;

			if ( current_user_can( 'manage_options' ) && is_admin() ) {

				$theme_customizer = array(
					'id' => '1',
					'title' => __('Customizer', 'uplift'),
					'href' => admin_url('/customize.php'),
					'meta' => array('target' => 'blank')
				);

				$wp_admin_bar->add_menu($theme_customizer);

			}

		}
		add_action( 'admin_bar_menu', 'sf_customizer_admin_bar_menu_item', 99 );
	}



	/**
	 * Include the required files for customizer usage
	 */
	$customizer_path = get_template_directory() . '/includes/customizer/';
	require_once( $customizer_path . '/sanitization.php' );
	require_once( $customizer_path . '/custom_css.php' );
	require_once( $customizer_path . '/output.php' );


	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function sf_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
	add_action( 'customize_register', 'sf_customize_register' );


	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
	function sf_customize_preview_js() {
		wp_enqueue_script( 'sf-customizer-js', get_template_directory_uri() . '/js/sf-customizer.js', array( 'customize-preview' ), NULL, true );
	}
	add_action( 'customize_preview_init', 'sf_customize_preview_js' );


	/**
	 * Setup the Customizer
	 */
	function sf_customizer( $wp_customize ) {

		/**
		 * Remove Default Sections
		 */
		$wp_customize->remove_section('colors');
		$wp_customize->remove_section('background_image');


		/**
		 * Add Custom Slider Control
		 */
		class SF_Customize_Slider_Control extends WP_Customize_Control {
			
			public $type = 'slider';
			
			public function enqueue() {
				wp_enqueue_script( 'jquery-ui-core' );
				wp_enqueue_script( 'jquery-ui-slider' );
			}

			public function render_content() { ?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<input type="text" id="input_<?php echo $this->id; ?>" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?>/>
				</label>
				<div id="slider_<?php echo $this->id; ?>" class="ui-slider"></div>
				<script>
					jQuery(document).ready(function($) {
						$( "#slider_<?php echo $this->id; ?>" ).slider({
						    value : <?php echo $this->value(); ?>,
						    min   : <?php echo $this->choices['min']; ?>,
						    max   : <?php echo $this->choices['max']; ?>,
						    step  : <?php echo $this->choices['step']; ?>,
						    slide : function( event, ui ) {
						    			$( "#input_<?php echo $this->id; ?>" ).val( ui.value ).keyup();
									}
						});
						$( "#input_<?php echo $this->id; ?>" ).val( $( "#slider_<?php echo $this->id; ?>" ).slider( "value" ) );
					});
				</script>
			<?php }
		}
		

		/**
		 * Sections
		 *
		 * $sf_customizer['section'][] = array( 'id', 'label', 'priority' );
		 */

		$sf_customizer['section'][] = array( 'sf_customizer_general', __( 'Color - General', 'uplift' ), '', 30 );
		$sf_customizer['section'][] = array( 'sf_customizer_top_bar', __( 'Color - Top Bar', 'uplift' ), '', 32 );
		$sf_customizer['section'][] = array( 'sf_customizer_header', __( 'Color - Header', 'uplift' ), '', 33 );
		$sf_customizer['section'][] = array( 'sf_customizer_navigation', __( 'Color - Navigation', 'uplift' ), '', 34 );
		$sf_customizer['section'][] = array( 'sf_customizer_fullscreen', __( 'Color - Fullscreen Overlays', 'uplift' ), __( 'These colours are used for various fullscreen overlays within the theme, and also the Push Navigation.', 'uplift' ), 35 );
		$sf_customizer['section'][] = array( 'sf_customizer_slideout_menu', __( 'Color - Slideout Menu', 'uplift' ), '', 36 );
		$sf_customizer['section'][] = array( 'sf_customizer_mobile_menu', __( 'Color - Mobile Menu', 'uplift' ), '', 37 );
		$sf_customizer['section'][] = array( 'sf_customizer_header_banner', __( 'Color - Header Banner', 'uplift' ), '', 38 );
		$sf_customizer['section'][] = array( 'sf_customizer_page_heading', __( 'Color - Page Heading', 'uplift' ), '', 39 );
		$sf_customizer['section'][] = array( 'sf_customizer_breadcrumbs', __( 'Color - Breadcrumbs', 'uplift' ), '', 39 );
		$sf_customizer['section'][] = array( 'sf_customizer_newsletter_bar', __( 'Color - Newsletter Bar', 'uplift' ), '', 40 );
		$sf_customizer['section'][] = array( 'sf_customizer_footer', __( 'Color - Footer', 'uplift' ), '', 41 );
		$sf_customizer['section'][] = array( 'sf_customizer_ui_elements', __( 'Color - UI Elements', 'uplift' ), '', 42 );
		$sf_customizer['section'][] = array( 'sf_customizer_content_sliders', __( 'Color - Content Sliders', 'uplift' ), '', 43 );
		$sf_customizer['section'][] = array( 'sf_customizer_shortcodes', __( 'Color - Shortcodes', 'uplift' ), '', 44 );


		/**
		 * Settings
		 *
		 * $sf_customizer['setting'][] = array( 'id', 'default', 'transport', 'sanitize_callback' );
		 * $sf_customizer['control'][] = array( 'id', 'type', 'label', 'choices', 'section' );
		 */


		/*
		 * Color - General
		 */
		$sf_customizer['setting'][] = array( 'sf_customizer[page_bg_color]', '#fff', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[page_bg_color]', 'color', __( 'Outer Page / Loading Background Color', 'uplift' ), '', 'sf_customizer_general' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[inner_page_bg_color]', '#fff', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[inner_page_bg_color]', 'color', __( 'Inner Page Background Color', 'uplift' ), '', 'sf_customizer_general' );

		$sf_customizer['setting'][] = array( 'sf_customizer[section_divide_color]', '#eaeaea', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[section_divide_color]', 'color', __( 'Section Divide Color', 'uplift' ), '', 'sf_customizer_general' );
						
		$sf_customizer['setting'][] = array( 'sf_customizer[accent_color]', '#7eced5', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[accent_color]', 'color', __( 'Accent Color', 'uplift' ), '', 'sf_customizer_general' );

		$sf_customizer['setting'][] = array( 'sf_customizer[body_color]', '#222', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[body_color]', 'color', __( 'Body Color', 'uplift' ), '', 'sf_customizer_general' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[body_alt_color]', '#222', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[body_alt_color]', 'color', __( 'Body Alt Color', 'uplift' ), '', 'sf_customizer_general' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[link_color]', '#999', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[link_color]', 'color', __( 'Link Color', 'uplift' ), '', 'sf_customizer_general' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[link_hover_color]', '#7eced5', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[link_hover_color]', 'color', __( 'Link Hover Color', 'uplift' ), '', 'sf_customizer_general' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[h1_color]', '#222', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[h1_color]', 'color', __( 'H1 Color', 'uplift' ), '', 'sf_customizer_general' );

		$sf_customizer['setting'][] = array( 'sf_customizer[h2_color]', '#222', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[h2_color]', 'color', __( 'H2 Color', 'uplift' ), '', 'sf_customizer_general' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[h3_color]', '#333', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[h3_color]', 'color', __( 'H3 Color', 'uplift' ), '', 'sf_customizer_general' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[h4_color]', '#222', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[h4_color]', 'color', __( 'H4 Color', 'uplift' ), '', 'sf_customizer_general' );

		$sf_customizer['setting'][] = array( 'sf_customizer[h5_color]', '#222', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[h5_color]', 'color', __( 'H5 Color', 'uplift' ), '', 'sf_customizer_general' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[h6_color]', '#222', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[h6_color]', 'color', __( 'H6 Color', 'uplift' ), '', 'sf_customizer_general' );
								
		
		/*
		 * Top Bar
		 */
		$sf_customizer['setting'][] = array( 'sf_customizer[topbar_bg_color]', '#fff', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[topbar_bg_color]', 'color', __( 'Top Bar Background Color', 'uplift' ), '', 'sf_customizer_top_bar' );

		$sf_customizer['setting'][] = array( 'sf_customizer[topbar_text_color]', '#444', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[topbar_text_color]', 'color', __( 'Top Bar Text Color', 'uplift' ), '', 'sf_customizer_top_bar' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[topbar_link_color]', '#999', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[topbar_link_color]', 'color', __( 'Top Bar Link Color', 'uplift' ), '', 'sf_customizer_top_bar' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[topbar_link_hover_color]', '#7eced5', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[topbar_link_hover_color]', 'color', __( 'Top Bar Link Hover Color', 'uplift' ), '', 'sf_customizer_top_bar' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[topbar_divider_color]', '#eaeaea', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[topbar_divider_color]', 'color', __( 'Top Bar Divider Color', 'uplift' ), '', 'sf_customizer_top_bar' );
		 
		
		/*
		 * Header
		 */
		$sf_customizer['setting'][] = array( 'sf_customizer[header_bg_color]', '#fff', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[header_bg_color]', 'color', __( 'Header Background Color', 'uplift' ), '', 'sf_customizer_header' );

		$sf_customizer['setting'][] = array( 'sf_customizer[header_border_color]', '#eaeaea', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[header_border_color]', 'color', __( 'Header Border Color', 'uplift' ), '', 'sf_customizer_header' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[header_text_color]', '#222', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[header_text_color]', 'color', __( 'Header Text Color', 'uplift' ), '', 'sf_customizer_header' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[header_link_color]', '#222', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[header_link_color]', 'color', __( 'Header Link Color', 'uplift' ), '', 'sf_customizer_header' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[header_link_hover_color]', '#7eced5', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[header_link_hover_color]', 'color', __( 'Header Link Hover Color', 'uplift' ), '', 'sf_customizer_header' );
		

		/*
		 * Navigation
		 */
		$sf_customizer['setting'][] = array( 'sf_customizer[nav_bg_color]', '#fff', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[nav_bg_color]', 'color', __( 'Nav Background Color', 'uplift' ), '', 'sf_customizer_navigation' );

		$sf_customizer['setting'][] = array( 'sf_customizer[nav_text_color]', '#414141', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[nav_text_color]', 'color', __( 'Menu Item Text Color', 'uplift' ), '', 'sf_customizer_navigation' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[nav_text_hover_color]', '#7eced5', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[nav_text_hover_color]', 'color', __( 'Menu Item Text Hover Color', 'uplift' ), '', 'sf_customizer_navigation' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[nav_selected_text_color]', '#303030', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[nav_selected_text_color]', 'color', __( 'Menu Item Active Text Color', 'uplift' ), '', 'sf_customizer_navigation' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[nav_sm_bg_color]', '#f9f9f9', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[nav_sm_bg_color]', 'color', __( 'Sub Menu Background Color', 'uplift' ), '', 'sf_customizer_navigation' );

		$sf_customizer['setting'][] = array( 'sf_customizer[nav_sm_text_color]', '#999', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[nav_sm_text_color]', 'color', __( 'Sub Menu Text Color', 'uplift' ), '', 'sf_customizer_navigation' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[nav_sm_text_hover_color]', '#7eced5', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[nav_sm_text_hover_color]', 'color', __( 'Sub Menu Text Hover Color', 'uplift' ), '', 'sf_customizer_navigation' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[nav_sm_selected_text_color]', '#333333', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[nav_sm_selected_text_color]', 'color', __( 'Sub Menu Active Text Color', 'uplift' ), '', 'sf_customizer_navigation' );

		$sf_customizer['setting'][] = array( 'sf_customizer[nav_divider_color]', '#f0f0f0', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[nav_divider_color]', 'color', __( 'Nav Divider Color', 'uplift' ), '', 'sf_customizer_navigation' );
							
		
		/*
		 * Fullscreen Overlays
		 */
		$sf_customizer['setting'][] = array( 'sf_customizer[overlay_menu_bg_color]', '#7eced5', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[overlay_menu_bg_color]', 'color', __( 'Overlay Menu Background Color', 'uplift' ), '', 'sf_customizer_fullscreen' );

		$sf_customizer['setting'][] = array( 'sf_customizer[overlay_menu_text_color]', '#c5e7eb', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[overlay_menu_text_color]', 'color', __( 'Overlay Menu Text Color', 'uplift' ), '', 'sf_customizer_fullscreen' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[overlay_menu_link_color]', '#d9f0f2', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[overlay_menu_link_color]', 'color', __( 'Overlay Menu Link Color', 'uplift' ), '', 'sf_customizer_fullscreen' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[overlay_menu_link_hover_color]', '#ffffff', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[overlay_menu_link_hover_color]', 'color', __( 'Overlay Menu Link Hover Color', 'uplift' ), '', 'sf_customizer_fullscreen' );
			
		
		/*
		 * Side Slideout Menu
		 */		 
		$sf_customizer['setting'][] = array( 'sf_customizer[slideout_menu_bg_color]', '#222', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[slideout_menu_bg_color]', 'color', __( 'Slideout Background Color', 'uplift' ), '', 'sf_customizer_slideout_menu' );

		$sf_customizer['setting'][] = array( 'sf_customizer[slideout_menu_bg_image]', '', 'refresh', 'esc_url_raw' );
		$sf_customizer['control'][] = array( 'sf_customizer[slideout_menu_bg_image]', 'image', __( 'Slideout Background Image', 'uplift' ), '', 'sf_customizer_slideout_menu' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[slideout_menu_link_color]', '#fff', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[slideout_menu_link_color]', 'color', __( 'Slideout Link Color', 'uplift' ), '', 'sf_customizer_slideout_menu' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[slideout_menu_link_hover_color]', '#7eced5', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[slideout_menu_link_hover_color]', 'color', __( 'Slideout Link Hover Color', 'uplift' ), '', 'sf_customizer_slideout_menu' );
						
		$sf_customizer['setting'][] = array( 'sf_customizer[slideout_menu_divider_color]', '#ccc', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[slideout_menu_divider_color]', 'color', __( 'Slideout Divider Color', 'uplift' ), '', 'sf_customizer_slideout_menu' );
		
		
		/*
		 * Mobile Menu
		 */		 
		$sf_customizer['setting'][] = array( 'sf_customizer[mobile_menu_bg_color]', '#fff', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[mobile_menu_bg_color]', 'color', __( 'Mobile Menu Background Color', 'uplift' ), '', 'sf_customizer_mobile_menu' );

		$sf_customizer['setting'][] = array( 'sf_customizer[mobile_menu_text_color]', '#222', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[mobile_menu_text_color]', 'color', __( 'Mobile Menu Text Color', 'uplift' ), '', 'sf_customizer_mobile_menu' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[mobile_menu_link_color]', '#222', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[mobile_menu_link_color]', 'color', __( 'Mobile Menu Link Color', 'uplift' ), '', 'sf_customizer_mobile_menu' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[mobile_menu_link_hover_color]', '#7eced5', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[mobile_menu_link_hover_color]', 'color', __( 'Mobile Menu Link Hover Color', 'uplift' ), '', 'sf_customizer_mobile_menu' );
						
		$sf_customizer['setting'][] = array( 'sf_customizer[mobile_menu_divider_color]', '#eee', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[mobile_menu_divider_color]', 'color', __( 'Mobile Menu Divider Color', 'uplift' ), '', 'sf_customizer_mobile_menu' );
		
		
		/*
		 * Header Banner
		 */		 
		$sf_customizer['setting'][] = array( 'sf_customizer[header_banner_bg_color]', '#fff', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[header_banner_bg_color]', 'color', __( 'Header Banner Background Color', 'uplift' ), '', 'sf_customizer_header_banner' );

		$sf_customizer['setting'][] = array( 'sf_customizer[header_banner_text_color]', '#222', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[header_banner_text_color]', 'color', __( 'Header Banner Text Color', 'uplift' ), '', 'sf_customizer_header_banner' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[header_banner_link_color]', '#333', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[header_banner_link_color]', 'color', __( 'Header Banner Link Color', 'uplift' ), '', 'sf_customizer_header_banner' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[header_banner_link_hover_color]', '#7eced5', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[header_banner_link_hover_color]', 'color', __( 'Header Banner Link Hover Color', 'uplift' ), '', 'sf_customizer_header_banner' );
						
		$sf_customizer['setting'][] = array( 'sf_customizer[header_banner_border_color]', '#e3e3e3', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[header_banner_border_color]', 'color', __( 'Header Banner Divider Color', 'uplift' ), '', 'sf_customizer_header_banner' );
		
		
		/*
		 * Page Heading
		 */		 
		$sf_customizer['setting'][] = array( 'sf_customizer[page_heading_bg_color]', '#f7f7f7', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[page_heading_bg_color]', 'color', __( 'Page Heading Background Color', 'uplift' ), '', 'sf_customizer_page_heading' );

		$sf_customizer['setting'][] = array( 'sf_customizer[page_heading_text_color]', '#333', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[page_heading_text_color]', 'color', __( 'Page Heading Text Color', 'uplift' ), '', 'sf_customizer_page_heading' );
						
		
		/*
		 * Breadcrumbs
		 */		 
		$sf_customizer['setting'][] = array( 'sf_customizer[breadcrumb_text_color]', '#777', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[breadcrumb_text_color]', 'color', __( 'Breadcrumb Text Color', 'uplift' ), '', 'sf_customizer_breadcrumbs' );

		$sf_customizer['setting'][] = array( 'sf_customizer[breadcrumb_link_color]', '#aaa', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[breadcrumb_link_color]', 'color', __( 'Breadcrumb Link Color', 'uplift' ), '', 'sf_customizer_breadcrumbs' );
			
		
		
		/*
		 * Newsletter Bar
		 */		 
		$sf_customizer['setting'][] = array( 'sf_customizer[newsletter_bar_bg_color]', '#222', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[newsletter_bar_bg_color]', 'color', __( 'Newsletter Bar Background Color', 'uplift' ), '', 'sf_customizer_newsletter_bar' );

		$sf_customizer['setting'][] = array( 'sf_customizer[newsletter_bar_text_color]', '#ccc', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[newsletter_bar_text_color]', 'color', __( 'Newsletter Bar Text', 'uplift' ), '', 'sf_customizer_newsletter_bar' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[newsletter_bar_link_hover_color]', '#fff', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[newsletter_bar_link_hover_color]', 'color', __( 'Newsletter Bar Link Hover Color', 'uplift' ), '', 'sf_customizer_newsletter_bar' );
						
				
		/*
		 * Footer
		 */
		$sf_customizer['setting'][] = array( 'sf_customizer[footer_bg_color]', '#f9f9f9', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[footer_bg_color]', 'color', __( 'Footer Background Color', 'uplift' ), '', 'sf_customizer_footer' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[footer_text_color]', '#999', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[footer_text_color]', 'color', __( 'Footer Text Color', 'uplift' ), '', 'sf_customizer_footer' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[footer_link_color]', '#666', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[footer_link_color]', 'color', __( 'Footer Link Color', 'uplift' ), '', 'sf_customizer_footer' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[footer_link_hover_color]', '#444', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[footer_link_hover_color]', 'color', __( 'Footer Link Hover Color', 'uplift' ), '', 'sf_customizer_footer' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[footer_border_color]', '#eee', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[footer_border_color]', 'color', __( 'Footer Border Color', 'uplift' ), '', 'sf_customizer_footer' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[copyright_bg_color]', '#f7f7f7', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[copyright_bg_color]', 'color', __( 'Copyright Background Color', 'uplift' ), '', 'sf_customizer_footer' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[copyright_text_color]', '#999', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[copyright_text_color]', 'color', __( 'Copyright Text Color', 'uplift' ), '', 'sf_customizer_footer' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[copyright_link_color]', '#666', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[copyright_link_color]', 'color', __( 'Copyright Link Color', 'uplift' ), '', 'sf_customizer_footer' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[copyright_link_hover_color]', '#444', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[copyright_link_hover_color]', 'color', __( 'Copyright Link Hover Color', 'uplift' ), '', 'sf_customizer_footer' );
		
		
		/*
		 * UI Elements
		 */		 
		$sf_customizer['setting'][] = array( 'sf_customizer[input_bg_color]', '#fff', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[input_bg_color]', 'color', __( 'Input/Textarea Background Color', 'uplift' ), '', 'sf_customizer_ui_elements' );

		$sf_customizer['setting'][] = array( 'sf_customizer[input_text_color]', '#999', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[input_text_color]', 'color', __( 'Input/Textarea Text Color', 'uplift' ), '', 'sf_customizer_ui_elements' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[overlay_bg_color]', '#7eced5', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[overlay_bg_color]', 'color', __( 'Thumb Hover Overlay Background Color', 'uplift' ), '', 'sf_customizer_ui_elements' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[overlay_text_color]', '#fff', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[overlay_text_color]', 'color', __( 'Thumb Hover Overlay Text Color', 'uplift' ), '', 'sf_customizer_ui_elements' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[preview_slider_bg_color]', '#f7f7f7', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[preview_slider_bg_color]', 'color', __( 'Product Preview Slider Background Color', 'uplift' ), '', 'sf_customizer_ui_elements' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[sale_tag_color]', '#ff8a80', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[sale_tag_color]', 'color', __( 'Sale Tag Color', 'uplift' ), '', 'sf_customizer_ui_elements' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[new_tag_color]', '#7eced5', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[new_tag_color]', 'color', __( 'New Tag Color', 'uplift' ), '', 'sf_customizer_ui_elements' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[oos_tag_color]', '#ccc', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[oos_tag_color]', 'color', __( 'Out of Stock Tag Color', 'uplift' ), '', 'sf_customizer_ui_elements' );
		
				
		/*
		 * Content Sliders
		 */		 
		$sf_customizer['setting'][] = array( 'sf_customizer[tweet_slider_bg]', '#1dc6df', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[tweet_slider_bg]', 'color', __( 'Tweet Slider Background Color', 'uplift' ), '', 'sf_customizer_content_sliders' );

		$sf_customizer['setting'][] = array( 'sf_customizer[tweet_slider_text]', '#fff', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[tweet_slider_text]', 'color', __( 'Tweet Slider Text Color', 'uplift' ), '', 'sf_customizer_content_sliders' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[tweet_slider_link]', '#222', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[tweet_slider_link]', 'color', __( 'Tweet Slider Link Color', 'uplift' ), '', 'sf_customizer_content_sliders' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[tweet_slider_link_hover]', '#fb3c2d', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[tweet_slider_link_hover]', 'color', __( 'Tweet Slider Link Hover Color', 'uplift' ), '', 'sf_customizer_content_sliders' );
			
		$sf_customizer['setting'][] = array( 'sf_customizer[testimonial_slider_bg]', '#7eced5', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[testimonial_slider_bg]', 'color', __( 'Testimonial Slider Background Color', 'uplift' ), '', 'sf_customizer_content_sliders' );

		$sf_customizer['setting'][] = array( 'sf_customizer[testimonial_slider_text]', '#fff', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[testimonial_slider_text]', 'color', __( 'Testimonial Slider Text Color', 'uplift' ), '', 'sf_customizer_content_sliders' );
			
		
		/*
		 * Shortcodes
		 */		 
		$sf_customizer['setting'][] = array( 'sf_customizer[promo_bar_bg_color]', '#e4e4e4', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[promo_bar_bg_color]', 'color', __( 'Promo Bar Background Color', 'uplift' ), '', 'sf_customizer_shortcodes' );

		$sf_customizer['setting'][] = array( 'sf_customizer[promo_bar_text_color]', '#222', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[promo_bar_text_color]', 'color', __( 'Promo Bar Text Color', 'uplift' ), '', 'sf_customizer_shortcodes' );

		$sf_customizer['setting'][] = array( 'sf_customizer[icon_container_border_color]', '#eaeaea', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[icon_container_border_color]', 'color', __( 'Icon Container Border Color', 'uplift' ), '', 'sf_customizer_shortcodes' );
		
		$sf_customizer['setting'][] = array( 'sf_customizer[icon_container_hover_border_color]', '#7eced5', 'postMessage', 'sanitize_hex_color' );
		$sf_customizer['control'][] = array( 'sf_customizer[icon_container_hover_border_color]', 'color', __( 'Icon Container Hover Border Color', 'uplift' ), '', 'sf_customizer_shortcodes' );

		
		//
		// LOOP - Add Section
		//

		foreach ( $sf_customizer['section'] as $customizer_section ) {
			$wp_customize->add_section( $customizer_section[0], array(
			  'title'    	=> $customizer_section[1],
			  'description' => $customizer_section[2],
			  'priority' 	=> $customizer_section[3],
			) );
		}


		//
		// Loop - Add Setting
		//

		foreach ( $sf_customizer['setting'] as $customizer_setting ) {
			$wp_customize->add_setting( $customizer_setting[0], array(
			  'type'      => 'option',
			  'default'   => $customizer_setting[1],
			  'transport' => $customizer_setting[2],
			  'sanitize_callback' => $customizer_setting[3]
			));
		}


		//
		// Loop - Add Control
		//

		foreach ( $sf_customizer['control'] as $customizer_control ) {

			static $i = 1;

			if ( $customizer_control[1] == 'text' ) {

				$wp_customize->add_control( $customizer_control[0], array(
					'type'     => $customizer_control[1],
					'label'    => $customizer_control[2],
					'section'  => $customizer_control[4],
					'priority' => $i
				));

			} elseif ( $customizer_control[1] == 'select' ) {

				$wp_customize->add_control( $customizer_control[0], array(
					'type'     => $customizer_control[1],
					'label'    => $customizer_control[2],
					'section'  => $customizer_control[4],
					'priority' => $i,
					'choices'  => $customizer_control[3]
				));

			} else if ( $customizer_control[1] == 'image' ) {

				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $customizer_control[0], array(
					  'label'    => $customizer_control[2],
					  'section'  => $customizer_control[4],
					  'settings' => $customizer_control[0],
					  'priority' => $i
					))
				);

			} else if ( $customizer_control[1] == 'radio' ) {

				$wp_customize->add_control( $customizer_control[0], array(
					'type'     => $customizer_control[1],
					'label'    => $customizer_control[2],
					'section'  => $customizer_control[4],
					'priority' => $i,
					'choices'  => $customizer_control[3]
				));

			} else if ( $customizer_control[1] == 'checkbox' ) {

				$wp_customize->add_control( $customizer_control[0], array(
					'type'     => $customizer_control[1],
					'label'    => $customizer_control[2],
					'section'  => $customizer_control[3],
					'priority' => $i
				));

			} else if ( $customizer_control[1] == 'color' ) {

				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $customizer_control[0], array(
					'type'     => $customizer_control[1],
					'label'    => $customizer_control[2],
					'section'  => $customizer_control[4],
					'settings' => $customizer_control[0],
					'priority' => $i
					))
				);

			} else if ( $customizer_control[1] == 'slider' ) {

				$wp_customize->add_control( new SF_Customize_Slider_Control( $wp_customize, $customizer_control[0], array(
					'type'     => $customizer_control[1],
					'label'    => $customizer_control[2],
					'section'  => $customizer_control[4],
					'priority' => $i,
					'choices'  => $customizer_control[3]
					))
				);

			}

			$i++;

		}
	}
	add_action( 'customize_register', 'sf_customizer' );
	