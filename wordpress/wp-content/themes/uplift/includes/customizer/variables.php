<?php

    /*
    *
    *	Customizer Variables
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
    *   @since v1.0.0
    *
    *
    */


    /* Default variables
   	================================================== */
    $default_font = 'Open Sans';
	
	
	/* Get customisation variables
	================================================== */
	global $post;
	$sf_options = sf_get_theme_opts();
	
    $enable_responsive         = $sf_options['enable_responsive'];
    $disable_mobile_animations = $sf_options['disable_mobile_animations'];
    $enable_mini_header_resize = $sf_options['enable_mini_header_resize'];
    $site_width_format 		   = $sf_options['site_width_format'];
    $site_maxwidth_percent 	   = $sf_options['site_maxwidth_percent'];
    $site_maxwidth             = "1170";
    if ( isset( $sf_options['site_maxwidth'] ) ) {
        $site_maxwidth = $sf_options['site_maxwidth'];
    }
	
    // Standard Styling
    $accent_color               = sf_get_option( 'accent_color', '#7eced5' );
    $accent_color_rgb			= sf_hex2rgb( $accent_color );
    $accent_alt_color           = apply_filters( 'sf_accent_alt_color', '#ffffff' );
    $secondary_accent_color     = "rgba( " . ($accent_color_rgb['red']-30) . ", " . ($accent_color_rgb['green']-30) . ", " . ($accent_color_rgb['blue']-30) . ", 1 )";
    $secondary_accent_alt_color = apply_filters( 'sf_secondary_accent_alt_color', '#ffffff' );
    $accent_button_text_color   = apply_filters( 'sf_accent_button_text_color', 'rgba(255,255,255,0.7)');

    // Page Styling
    $page_bg_color             = sf_get_option( 'page_bg_color', '#f7f7f7' );
    $inner_page_bg_transparent = sf_get_option( 'inner_page_bg_transparent', 'color' );
    $inner_page_bg_color       = sf_get_option( 'inner_page_bg_color', '#ffffff' );
    $body_bg_use_image         = $sf_options['use_bg_image'];
    $body_upload_bg            = $body_preset_bg = "";
    if ( isset( $sf_options['custom_bg_image'] ) ) {
        $body_upload_bg = $sf_options['custom_bg_image'];
    }
    if ( isset( $sf_options['preset_bg_image'] ) ) {
        $body_preset_bg = $sf_options['preset_bg_image'];
    }

    $section_divide_color = sf_get_option( 'section_divide_color', '#e4e4e4' );
    $alt_bg_color         = sf_get_option( 'alt_bg_color', '#f7f7f7' );
    $bg_size              = $sf_options['bg_size'];

    // Top Bar Styling
    $topbar_bg_color         = sf_get_option( 'topbar_bg_color', '#ffffff' );
    $topbar_text_color       = sf_get_option( 'topbar_text_color', '#222222' );
    $topbar_link_color       = sf_get_option( 'topbar_link_color', '#666666' );
    $topbar_link_hover_color = sf_get_option( 'topbar_link_hover_color', '#fe504f' );
    $topbar_divider_color    = sf_get_option( 'topbar_divider_color', '#e3e3e3' );

    // Header Styling
    $header_bg_color         = sf_get_option( 'header_bg_color', '#ffffff' );
    $header_bg_transparent   = sf_get_option( 'header_bg_transparent', 'color' );
    $header_border_color     = sf_get_option( 'header_border_color', '#e4e4e4' );
    $header_text_color       = sf_get_option( 'header_text_color', '#222' );
    $header_link_color       = sf_get_option( 'header_link_color', '#222' );
    $header_link_hover_color = sf_get_option( 'header_link_hover_color', '#fe504f' );
    $header_layout           = $sf_options['header_layout'];
    if ( isset( $_GET['header'] ) ) {
        $header_layout = $_GET['header'];
    }
    $page_header_type = "standard";
    if (is_page() && $post) {
    	$page_header_type = sf_get_post_meta($post->ID, 'sf_page_header_type', true);
    } else if (is_singular('post') && $post) {
    	$post_header_type = sf_get_post_meta($post->ID, 'sf_page_header_type', true);
    	$fw_media_display = sf_get_post_meta($post->ID, 'sf_fw_media_display', true);
    	$page_title_style = sf_get_post_meta($post->ID, 'sf_page_title_style', true);
    	if ($page_title_style == "fancy" || $fw_media_display == "fw-media-title" || $fw_media_display == "fw-media") {
    		$page_header_type = $post_header_type;
    	}
    }
    if (($page_header_type == "naked-light" || $page_header_type == "naked-dark") && ($header_layout == "header-vert" || $header_layout == "header-vert-right")) {
    	$header_layout = "header-4";
    }

    // Mobile Menu Styling
    $mobile_menu_bg_color         = sf_get_option( 'mobile_menu_bg_color', '#222' );
    $mobile_menu_divider_color    = sf_get_option( 'mobile_menu_divider_color', '#444' );
    $mobile_menu_text_color       = sf_get_option( 'mobile_menu_text_color', '#e4e4e4' );
    $mobile_menu_link_color       = sf_get_option( 'mobile_menu_link_color', '#fff' );
    $mobile_menu_link_hover_color = sf_get_option( 'mobile_menu_link_hover_color', '#fe504f' );

    // Logo Setup
    $logo_width = $logo_height = $logo_maxheight = $header_height = $resize_header_height = $retina_logo_width = $logo_padding = $resize_logo_padding = $resize_logo_height = $custom_logo_padding = "";
    $logo = $retina_logo = array();

    $logo_maxheight = $sf_options['logo_maxheight'];

    if (isset($sf_options['logo_padding'])) {
    $custom_logo_padding = $sf_options['logo_padding'];
    }

    if ( isset( $sf_options['logo_upload'] ) ) {
        $logo = $sf_options['logo_upload'];
    }
    if ( isset( $sf_options['retina_logo_upload'] ) ) {
        $retina_logo       = $sf_options['retina_logo_upload'];
        $retina_logo_width = intval( $retina_logo['width'], 10 ) / 2;
    }
    if ( $retina_logo_width == "" && isset($logo)  && isset($logo['width']) ) {
    	$retina_logo_width = intval($logo['width'], 10);
    }
    if ( ! isset( $retina_logo['url'] ) && isset( $logo['url'] ) ) {
        $retina_logo['url'] = $logo['url'];
    }
    if ( isset( $logo['height'] ) && $logo['height'] != "" ) {
        $logo_height = $logo['height'];
        $logo_width = $logo['width'];
        $header_height = intval( $logo['height'], 10 );
    } else {
        $logo_height = $header_height = 60;
    }
    if ($logo_height < 70) {
    	$logo_height = 70;
    }

    if ( $logo_height > $logo_maxheight && $logo_maxheight != "" && $logo_maxheight != 0 ) {
        $logo_height   = $logo_maxheight;
        $header_height = $logo_maxheight;
    }

    if ( $logo_height < 80 ) {
        $logo_padding  = apply_filters( 'sf_logo_padding', 20 );
    } else {
        $logo_padding  = apply_filters( 'sf_logo_padding', 10 );
    }
    if ( isset($custom_logo_padding) && $custom_logo_padding != "") {
    	$logo_padding = $custom_logo_padding;
    }
    $resize_logo_padding = $logo_padding / 2;
    $resize_header_height = $header_height + ($resize_logo_padding * 2) . 'px';

    $header_height = $header_height + ( $logo_padding * 2 ) . 'px';

    if ( $header_height == "" ) {
        $header_height = '70px';
    }

    // Navigation Styling
    $menu_font					= $sf_options['menu_font'];
    $menu_font_size				= $menu_font['font-size'];
    $nav_hover_style            = sf_get_option( 'nav_hover_style', 'standard' );
    $nav_bg_color               = sf_get_option( 'nav_bg_color', '#fff' );
    $nav_text_color             = sf_get_option( 'nav_text_color', '#252525' );
    $nav_bg_hover_color         = sf_get_option( 'nav_bg_hover_color', '#f7f7f7' );
    $nav_text_hover_color       = sf_get_option( 'nav_text_hover_color', '#fe504f' );
    $nav_selected_bg_color      = sf_get_option( 'nav_selected_bg_color', '#e3e3e3' );
    $nav_selected_text_color    = sf_get_option( 'nav_selected_text_color', '#fe504f' );
    $nav_pointer_color          = sf_get_option( 'nav_pointer_color', '#07c1b6' );
    $nav_sm_bg_color            = sf_get_option( 'nav_sm_bg_color', '#FFFFFF' );
    $nav_sm_text_color          = sf_get_option( 'nav_sm_text_color', '#666666' );
    $nav_sm_text_hover_color    = sf_get_option( 'nav_sm_text_hover_color', '#000000' );
    $nav_sm_selected_text_color = sf_get_option( 'nav_sm_selected_text_color', '#000000' );
    $nav_divider                = sf_get_option( 'nav_divider', 'solid' );
    $nav_divider_color          = sf_get_option( 'nav_divider_color', '#f0f0f0' );
	$nav_text_hover_color_rgb = sf_hex2rgb( $nav_text_hover_color );

    // Overlay Menu Styling
    $overlay_menu_bg_color            = sf_get_option( 'overlay_menu_bg_color', '#e4e4e4' );
    $overlay_menu_text_color		  = sf_get_option( 'overlay_menu_text_color', '#666666' );
    $overlay_menu_link_color          = sf_get_option( 'overlay_menu_link_color', '#222222' );
    $overlay_menu_link_hover_color    = sf_get_option( 'overlay_menu_link_hover_color', '#1dc6df' );
    $overlay_menu_bg_color_rgb        = sf_hex2rgb( $overlay_menu_bg_color );

	// Slideout Menu Styling
	$slideout_menu_bg_color				= sf_get_option( 'slideout_menu_bg_color', '#222' );
	$slideout_menu_bg_image         	= sf_get_option( 'slideout_menu_bg_image', '' );
	$slideout_menu_link_color			= sf_get_option( 'slideout_menu_link_color', '#fff' );
	$slideout_menu_link_hover_color		= sf_get_option( 'slideout_menu_link_hover_color', '#07c1b6' );
	$slideout_menu_divider_color		= sf_get_option( 'slideout_menu_divider_color', '#ccc' );

	// Newsletter Bar Styling
	$newsletter_bar_bg_color			= sf_get_option( 'newsletter_bar_bg_color', '#222' );
	$newsletter_bar_text_color			= sf_get_option( 'newsletter_bar_text_color', '#ccc' );
	$newsletter_bar_link_hover_color	= sf_get_option( 'newsletter_bar_link_hover_color', '#fff' );

	// Header Banner Styling
	$header_banner_bg_color				= sf_get_option( 'header_banner_bg_color', '#fff' );
	$header_banner_text_color			= sf_get_option( 'header_banner_text_color', '#222' );
	$header_banner_link_color			= sf_get_option( 'header_banner_link_color', '#333' );
	$header_banner_link_hover_color		= sf_get_option( 'header_banner_link_hover_color', '#1dc6df' );
	$header_banner_border_color			= sf_get_option( 'header_banner_border_color', '#e3e3e3' );

    // Promo Bar Styling
    $promo_bar_bg_color   = sf_get_option( 'promo_bar_bg_color', '#e4e4e4' );
    $promo_bar_text_color = sf_get_option( 'promo_bar_text_color', '#222' );

    // Breadcrumbs Styling
    $breadcrumb_bg_color   = sf_get_option( 'breadcrumb_bg_color', '#e4e4e4' );
    $breadcrumb_text_color = sf_get_option( 'breadcrumb_text_color', '#666666' );
    $breadcrumb_link_color = sf_get_option( 'breadcrumb_link_color', '#999999' );

    // Page Heading Styling
    $page_heading_bg_color   = sf_get_option( 'page_heading_bg_color', '#f7f7f7' );
    $page_heading_text_color = sf_get_option( 'page_heading_text_color', '#222222' );
    $page_heading_text_align = sf_get_option( 'page_heading_text_align', 'center' );

    // General Styling
    $body_text_color     = sf_get_option( 'body_color', '#222222' );
    $body_alt_text_color = sf_get_option( 'body_alt_color', '#222222' );
    $link_text_color     = sf_get_option( 'link_color', '#444444' );
    $link_hover_color    = sf_get_option( 'link_hover_color', '#999999' );
    $h1_text_color       = sf_get_option( 'h1_color', '#333' );
    $h2_text_color       = sf_get_option( 'h2_color', '#333' );
    $h3_text_color       = sf_get_option( 'h3_color', '#333' );
    $h4_text_color       = sf_get_option( 'h4_color', '#333' );
    $h5_text_color       = sf_get_option( 'h5_color', '#333' );
    $h6_text_color       = sf_get_option( 'h6_color', '#999' );
    $overlay_bg_color    = sf_get_option( 'overlay_bg_color', '#fe504f' );
    $overlay_text_color  = sf_get_option( 'overlay_text_color', '#ffffff' );
    $overlay_opacity_top = $overlay_opacity_bottom = 100;
    $hover_overlay_rgb   = "";
    if ( isset( $sf_options['overlay_opacity_top'] ) ) {
        $overlay_opacity_top   = $sf_options['overlay_opacity_top'];
        $overlay_opacity_bottom = $sf_options['overlay_opacity_bottom'];
        $hover_overlay_rgb = sf_hex2rgb( $overlay_bg_color );
    }

    // Post Detail Styling
    $article_review_bar_alt_color  = sf_get_option( 'article_review_bar_alt_color', '#f7f7f7' );
    $article_review_bar_color      = sf_get_option( 'article_review_bar_color', '#2e2e36' );
    $article_review_bar_text_color = sf_get_option( 'article_review_bar_text_color', '#fff' );
    $article_extras_bg_color       = sf_get_option( 'article_extras_bg_color', '#f7f7f7' );
    $article_np_bg_color           = sf_get_option( 'article_np_bg_color', '#444' );
    $article_np_text_color         = sf_get_option( 'article_np_text_color', '#fff' );
    
    // WooCommerce styling
    $cart_overlay_text_color 	   = 'rgba(255,255,255,0.7)';
    $cart_overlay_text_hover_color = '#fff';
	$preview_slider_bg_color 	   = sf_get_option( 'preview_slider_bg_color', '#f7f7f7' );
	
    // UI Elements Styling
    $input_bg_color   = sf_get_option( 'input_bg_color', '#fff' );
    $input_text_color = sf_get_option( 'input_text_color', '#222222' );
    $sale_tag_color = sf_get_option( 'sale_tag_color', '#ef3f32' );
    $new_tag_color = sf_get_option( 'new_tag_color', '#fa726e' );
    $oos_tag_color = sf_get_option( 'oos_tag_color', '#999' );

    // Shortcode Styling
    $icon_container_border_color     	= sf_get_option( 'icon_container_border_color', '#e3e3e3' );
    $icon_container_hover_border_color 	= sf_get_option( 'icon_container_hover_border_color', '#1dc6df' );
			
    // Content Slider Styling
    $tweet_slider_bg         = sf_get_option( 'tweet_slider_bg', '#ffffff' );
    $tweet_slider_text       = sf_get_option( 'tweet_slider_text', '#222222' );
    $tweet_slider_link       = sf_get_option( 'tweet_slider_link', '#66cc66' );
    $tweet_slider_link_hover = sf_get_option( 'tweet_slider_link_hover', '#222222' );
    $testimonial_slider_bg   = sf_get_option( 'testimonial_slider_bg', '#222222' );
    $testimonial_slider_text = sf_get_option( 'testimonial_slider_text', '#ffffff' );

    // Footer Styling
    $footer_bg_color            = sf_get_option( 'footer_bg_color', '#222222' );
    $footer_text_color          = sf_get_option( 'footer_text_color', '#cccccc' );
    $footer_link_color          = sf_get_option( 'footer_link_color', '#ffffff' );
    $footer_link_hover_color    = sf_get_option( 'footer_link_hover_color', '#cccccc' );
    $footer_border_color        = sf_get_option( 'footer_border_color', '#333333' );
    $copyright_bg_color         = sf_get_option( 'copyright_bg_color', '#222222' );
    $copyright_text_color       = sf_get_option( 'copyright_text_color', '#999999' );
    $copyright_link_color       = sf_get_option( 'copyright_link_color', '#ffffff' );
    $copyright_link_hover_color = sf_get_option( 'copyright_link_hover_color', '#cccccc' );


    // PAGE BACKGROUND IMAGE
    $bg_image_url = $inner_bg_image_url = $inner_background_color = $inner_background_image_size = $background_image_size = "";
    $page_background_image       = rwmb_meta( 'sf_background_image', 'type=image&size=full' );
    $inner_page_background_image = rwmb_meta( 'sf_inner_background_image', 'type=image&size=full' );
    if ( is_array( $page_background_image ) ) {
        foreach ( $page_background_image as $image ) {
            $bg_image_url = $image['url'];
            break;
        }
    }
    if ( is_array( $inner_page_background_image ) ) {
        foreach ( $inner_page_background_image as $image ) {
            $inner_bg_image_url = $image['url'];
            break;
        }
    }

    $fancy_title_image = $fancy_title_image_url = $bg_color_title = $bg_opacity_title = "";
    if ( $post && is_singular() ) {
        $inner_background_image_size = sf_get_post_meta( $post->ID, 'sf_inner_background_image_size', true );
        $inner_background_color      = sf_get_post_meta( $post->ID, 'sf_inner_background_color', true );
        $background_image_size       = sf_get_post_meta( $post->ID, 'sf_background_image_size', true );
        $fancy_title_image     = rwmb_meta( 'sf_page_title_image', 'type=image&size=full' );
        $bg_color_title = sf_get_post_meta( $post->ID, 'sf_bg_color_title', true );
        $bg_opacity_title = sf_get_post_meta( $post->ID, 'sf_bg_opacity_title', true );
    }
    
    // WooCommerce Options
    $product_imagewidth_override = $sf_options['product_imagewidth_override'];
    $product_filter = $sf_options['product_filter'];
    
    // Page Header Image
    $shop_page = false;
    if ( ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product_category' ) && is_product_category() ) ) {
        $shop_page = true;
    }
    if ( $shop_page ) {
    	$fancy_title_image     = $sf_options['woo_page_heading_image'];
        if ( isset( $fancy_title_image ) && isset( $fancy_title_image['url'] ) ) {
            $fancy_title_image_url = $fancy_title_image['url'];
        }
    	if ( is_product_category() ) {
    		global $wp_query;
    		$category = $wp_query->get_queried_object();
    		$hero_id = get_woocommerce_term_meta( $category->term_id, 'hero_id', true  );
    		if ( $hero_id != "" && $hero_id != 0 ) {
    			$fancy_title_image_url = wp_get_attachment_url($hero_id, 'full');
    		}
    	}
    }
    if ( is_array( $fancy_title_image ) && $fancy_title_image_url == "" ) {
	    foreach ( $fancy_title_image as $detail_image ) {
	        if ( isset( $detail_image['url'] ) ) {
	            $fancy_title_image_url = $detail_image['url'];
	            break;
	        }
	    }
	    if ( ! $fancy_title_image ) {
	        $fancy_title_image     = get_post_thumbnail_id();
	        $fancy_title_image_url = wp_get_attachment_url( $fancy_title_image, 'full' );
	    }
	}
    

    // Custom CSS
    $custom_css = $sf_options['custom_css'];
