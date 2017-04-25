<?php
	/*
	*
	*	Swift Framework Overrides
	*	------------------------------------------------
	*	Uplift specific functionality
	* 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
	*
	*/


	/* HEAD FILTERS
	================================================== */
	function uplift_viewport_content() {
		return "width=device-width, initial-scale=1.0, maximum-scale=1";
	}
	add_filter('sf_viewport_content', 'uplift_viewport_content');

	function uplift_naked_default_header() {
		return "header-3";
	}
	add_filter('sf_naked_default_header', 'uplift_naked_default_header');


	/* PAGE TITLE FILTERS
	================================================== */
	function uplift_page_title_style($page_title_style) {
		
		if ( $page_title_style == "fancy-tabbed" ) {
			return "fancy";
		} else {
			return $page_title_style;
		}
		
	}
	add_filter('sf_page_title_style', 'uplift_page_title_style');
	
	
	/* SVG ICON FILTERS
	================================================== */
	// Post icon
	function uplift_post_svg_icon() {
		return '<i><svg version="1.1" class="sf-hover-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
		<path fill="none" stroke="#444444" stroke-width="2" stroke-miterlimit="10" d="M2,12h20 M15,19l7-7l-7-7"/>
		</svg></i>';
	}
	add_filter('sf_port_post_svg_icon', 'uplift_post_svg_icon');
	add_filter('sf_post_standard_svg_icon', 'uplift_post_svg_icon');
	add_filter('sf_gallery_page_svg_icon', 'uplift_post_svg_icon');
	add_filter('sf_link_icon_svg', 'uplift_post_svg_icon');
	
	// External URL icon
	function uplift_url_svg_icon() {
		return '<i><svg version="1.1" class="sf-hover-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
		<path fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M9,15l6-6"/>
		<path fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M11,6l2.5-2.5
			c1.9-1.9,5.1-1.9,7,0l0,0c1.9,1.9,1.9,5.1,0,7L18,13"/>
		<path fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M13,18l-2.5,2.5
			c-1.9,1.9-5.1,1.9-7,0l0,0c-1.9-1.9-1.9-5.1,0-7L6,11"/>
		</svg></i>';
	}
	add_filter('sf_port_url_svg_icon', 'uplift_url_svg_icon');
	add_filter('sf_post_link_svg_icon', 'uplift_url_svg_icon');
	
	// Lightbox icon
	function uplift_lightbox_svg_icon() {
		return '<i><svg version="1.1" class="sf-hover-svg svg-lightbox" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
		<path fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M22,22l-3-3"/>
		<path fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M10,7v6"/>
		<path fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M13,10H7"/>
		<path fill="none" stroke="#444444" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M16.419,16.309
			C14.786,17.97,12.514,19,10,19c-4.971,0-9-4.029-9-9s4.029-9,9-9s9,4.029,9,9c0,2.39-0.931,4.562-2.451,6.174"/>
		</svg></i>';
	}
	add_filter('sf_port_lightbox_svg_icon', 'uplift_lightbox_svg_icon');
	add_filter('sf_post_lightbox_svg_icon', 'uplift_lightbox_svg_icon');
	add_filter('sf_gallery_lightbox_svg_icon', 'uplift_lightbox_svg_icon');
	add_filter('sf_view_icon_svg', 'uplift_lightbox_svg_icon');
	
	// Video icon
	function uplift_video_svg_icon() {
		return '<i><svg version="1.1" class="sf-hover-svg svg-video" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
		<path fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M16,16.219V22H1V10h15
			v6.094"/>
		<path fill="none" stroke="#444444" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M13.357,6.468
			C13.001,6.798,12.524,7,12,7c-1.104,0-2-0.896-2-2s0.896-2,2-2s2,0.896,2,2c0,0.544-0.217,1.038-0.57,1.398"/>
		<path fill="none" stroke="#444444" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M6.033,6.206
			C5.499,6.699,4.785,7,4,7C2.343,7,1,5.657,1,4s1.343-3,3-3s3,1.343,3,3c0,0.824-0.333,1.571-0.871,2.113"/>
		<path fill="none" stroke="#444444" stroke-width="2" stroke-miterlimit="10" d="M16,14l7-3v10l-7-3"/>
		</svg></i>';
	}
	add_filter('sf_port_video_svg_icon', 'uplift_video_svg_icon');
	add_filter('sf_post_video_svg_icon', 'uplift_video_svg_icon');
	
	// Team icon
	function uplift_team_hover_svg_icon() {
		return '<i><svg version="1.1" class="sf-hover-svg svg-team" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
		<path class="delay-1" fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M1,12h13"/>
		<path fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M1,5h22"/>
		<path class="delay-2" fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M1,19h22"/>
		</svg></i>';
	}
	add_filter('sf_team_hover_svg_icon', 'uplift_team_hover_svg_icon');
		
	
	/* ICON FILTERS
	================================================== */
	
	// Pagination Next
	function uplift_pagination_next_text() {
		return '<i class="sf-icon-right-chevron"></i>';
	}
	add_filter('sf_pagination_next_text', 'uplift_pagination_next_text');
	
	// Pagination Prev
	function uplift_pagination_prev_text() {
		return '<i class="sf-icon-left-chevron"></i>';
	}
	add_filter('sf_pagination_prev_text', 'uplift_pagination_prev_text');
	
	// Header cart icon
	function uplift_header_cart_icon() {
		return '<i class="sf-icon-cart"></i>';
	}
	add_filter('sf_header_cart_icon', 'uplift_header_cart_icon');
	add_filter('sf_mobile_cart_icon', 'uplift_header_cart_icon');

	// Header search icon
	function uplift_header_search_icon() {
		return '<i class="sf-icon-search"></i>';
	}
	add_filter('sf_header_search_icon', 'uplift_header_search_icon');

	// Header SuperSearch icon
	function uplift_header_superssearch_icon() {
		return '<i class="sf-icon-supersearch"></i>';
	}
	add_filter('sf_header_supersearch_icon', 'uplift_header_superssearch_icon');

	// Header contact icon
	function uplift_header_contact_icon() {
		return '<i class="sf-icon-email"></i>';
	}
	add_filter('sf_header_contact_icon', 'uplift_header_contact_icon');

	// Header view cart icon
	function uplift_view_cart_icon() {
		return '<i class="sf-icon-quickview"></i>';
	}
	add_filter('sf_view_cart_icon', 'uplift_view_cart_icon');

	// Header checkout icon
	function uplift_checkout_icon() {
		return '<i class="fa-long-arrow-right"></i>';
	}
	add_filter('sf_checkout_icon', 'uplift_checkout_icon');

	// Header go to shop icon
	function uplift_go_to_shop_icon() {
		return '<i class="sf-icon-cart"></i>';
	}
	add_filter('sf_go_to_shop_icon', 'uplift_go_to_shop_icon');

	// Header wishlist icon
	function uplift_wishlist_icon() {
		return '<i class="sf-icon-wishlist"></i>';
	}
	add_filter('sf_wishlist_icon', 'uplift_wishlist_icon');

	// Post icon
	function uplift_port_post_icon() {
		return "sf-icon-right-arrow";
	}
	add_filter('sf_post_standard_icon', 'uplift_port_post_icon');
	add_filter('sf_port_post_icon', 'uplift_port_post_icon');

	// Post Link icon
	function uplift_post_link_icon() {
		return "fa-link";
	}
	add_filter('sf_post_link_icon', "uplift_post_link_icon");

	// Post Lightbox icon
	function uplift_post_lightbox_icon() {
		return "sf-icon-search";
	}
	add_filter('sf_post_lightbox_icon', "uplift_post_lightbox_icon");

	// Post Video icon
	function uplift_post_video_icon() {
		return "fa-youtube-play";
	}
	add_filter('sf_post_video_icon', "uplift_post_video_icon");

	function uplift_gallery_lightbox_icon() {
		return 'sf-icon-search';
	}
	add_filter('sf_gallery_lightbox_icon', 'uplift_gallery_lightbox_icon');

	function uplift_gallery_page_icon() {
		return 'sf-icon-right-arrow';
	}
	add_filter('sf_gallery_page_icon', 'uplift_gallery_page_icon');

	// Add to cart icon
	function uplift_add_to_cart_icon() {
		return '<i class="sf-icon-cart"></i>';
	}
	add_filter('add_to_cart_icon', 'uplift_add_to_cart_icon');
	add_filter('sf_add_to_cart_icon', 'uplift_add_to_cart_icon');
	
	function uplift_add_to_cart_icon_class() {
		return 'sf-icon-cart';
	}
	add_filter('sf_add_to_cart_icon_class', 'uplift_add_to_cart_icon_class');

	// Add to wishlist icon
	function uplift_add_to_wishlist_icon() {
		return '<i class="sf-icon-wishlist"></i>';
	}
	add_filter('sf_add_to_wishlist_icon', 'uplift_add_to_wishlist_icon');

	// View wishlist icon
	function uplift_view_wishlist_icon() {
		return '<i class="sf-icon-quickview"></i>';
	}
	add_filter('sf_view_wishlist_icon', 'uplift_view_wishlist_icon');

	// Wishlist icon
	function uplift_wishlist_menu_icon() {
		return '<i class="sf-icon-wishlist"></i>';
	}
	add_filter('sf_wishlist_menu_icon', 'uplift_wishlist_menu_icon');

	// Added to Wishlist icon
	function uplift_added_to_wishlist_icon() {
		return '<i class="sf-icon-tick"></i>';
	}
	add_filter('sf_added_to_wishlist_icon', 'uplift_added_to_wishlist_icon');

	// Search icon
	function uplift_search_icon() {
		return '<i class="sf-icon-search"></i>';
	}
	add_filter('sf_search_icon', 'uplift_search_icon');

	// FS video play icon
	function uplift_play_icon() {
		return '<i class="sf-icon-video-player-fill"></i>';
	}
	add_filter('sf_fs_video_icon', 'uplift_play_icon');

	function uplift_play_icon_alt() {
		return '<i class="fa-play"></i>';
	}
	add_filter('sf_fs_video_icon_alt', 'uplift_play_icon_alt');

	function uplift_play_icon_alt3() {
		return '<i class="sf-icon-video-player-fill"></i>';
	}
	add_filter('sf_fs_video_icon_alt3', 'uplift_play_icon_alt3');

	function uplift_fullscreen_close_icon() {
		return '<i class="sf-icon-remove"></i>';
	}
	add_filter('sf_fullscreen_close_icon', 'uplift_fullscreen_close_icon');

	function uplift_back_to_top_icon() {
		$icon = '<i class="sf-icon-up-chevron"></i>';
		return $icon;
	}
	add_filter('sf_back_to_top_icon', 'uplift_back_to_top_icon');

	function uplift_default_heart_icon() {
		return '<i class="sf-icon-heart"></i>';
	}
	add_filter('sf_default_heart_icon', 'uplift_default_heart_icon');

	function uplift_prev_icon() {
		return '<i class="sf-icon-left-arrow-big"></i>';
	}
	add_filter('sf_prev_icon', 'uplift_prev_icon');

	function uplift_next_icon() {
		return '<i class="sf-icon-right-arrow-big"></i>';
	}
	add_filter('sf_next_icon', 'uplift_next_icon');
	
	function uplift_carousel_prev_icon() {
		return '<i class="sf-icon-left-chevron"></i>';
	}
	add_filter('sf_carousel_prev_icon', 'uplift_carousel_prev_icon');

	function uplift_carousel_next_icon() {
		return '<i class="sf-icon-right-chevron"></i>';
	}
	add_filter('sf_carouselnext_icon', 'uplift_carousel_next_icon');

	function uplift_close_icon() {
		return '<i class="sf-icon-remove"></i>';
	}
	add_filter('sf_close_icon', 'uplift_close_icon');

	function uplift_up_icon() {
		return '<i class="sf-icon-up-chevron"></i>';
	}
	add_filter('sf_up_icon', 'uplift_up_icon');

	function uplift_view_icon() {
		return '<i class="sf-icon-search"></i>';
	}
	add_filter('sf_view_icon', 'uplift_view_icon');

	function uplift_view_all_icon() {
		return '<i class="sf-icon-portfolio"></i>';
	}
	add_filter('sf_view_all_icon', 'uplift_view_all_icon');

	function uplift_video_icon() {
		return '<i class="fa-youtube-play"></i>';
	}
	add_filter('sf_video_icon', 'uplift_video_icon');

	function uplift_audio_icon() {
		return '<i class="fa-music"></i>';
	}
	add_filter('sf_audio_icon', 'uplift_audio_icon');

	function uplift_picture_icon() {
		return '<i class="fa-picture-o"></i>';
	}
	add_filter('sf_picture_icon', 'uplift_picture_icon');

	function uplift_post_icon() {
		return '<i class="fa-file-text-o"></i>';
	}
	add_filter('sf_post_icon', 'uplift_post_icon');

	function uplift_comments_icon() {
		return '<svg version="1.1" class="comments-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="30px" height="30px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
		<path fill="none" class="stroke" stroke="#252525" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="
			M13.958,24H2.021C1.458,24,1,23.541,1,22.975V2.025C1,1.459,1.458,1,2.021,1h25.957C28.542,1,29,1.459,29,2.025v20.949
			C29,23.541,28.542,24,27.979,24H21v5L13.958,24z"/>
		</svg>';
	}
	add_filter('sf_comments_icon', 'uplift_comments_icon');

	function uplift_loved_icon() {
		return '<svg version="1.1" class="loveit-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="30px" height="30px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
		<g>
			<path fill="none" class="stroke" stroke="#252525" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="
				M5.631,24H2.021C1.459,24,1,23.541,1,22.975V2.025C1,1.459,1.459,1,2.021,1h25.957C28.543,1,29,1.459,29,2.025v20.949
				C29,23.541,28.543,24,27.979,24h-3.316"/>
			<path fill="#252525" class="fill" d="M19.994,22.895c-0.053-0.888-0.436-1.71-1.043-2.214C18.438,20.253,17.756,20,17.074,20
				c-1.035,0-1.684,0.45-2.068,1.009C14.611,20.45,13.961,20,12.926,20c-0.682,0-1.363,0.253-1.875,0.681
				c-0.609,0.504-0.992,1.326-1.045,2.214c-0.043,0.757,0.139,1.908,1.248,3.082c1.875,2.007,3.367,3.618,3.389,3.629L15.006,30
				l0.361-0.395c0.012-0.011,1.504-1.622,3.381-3.629C19.857,24.803,20.037,23.651,19.994,22.895z"/>
		</g>
		</svg>';
	}
	add_filter('sf_loved_icon', 'uplift_loved_icon');

	function sf_uplift_link_icon() {
		return '<i class="sf-icon-port-hover-external-link"></i>';
	}
	add_filter('sf_link_icon', 'sf_uplift_link_icon');

	function uplift_sticky_icon() {
		return '<i class="fa-bookmark"></i>';
	}
	add_filter('sf_sticky_icon', 'uplift_sticky_icon');

	function uplift_quote_icon() {
		return '<i class="sf-icon-quotation-mark-start"></i>';
	}
	add_filter('sf_quote_icon', 'uplift_quote_icon');

	function uplift_mail_icon() {
		return '<i class="fa-envelope-o"></i>';
	}
	add_filter('sf_mail_icon', 'uplift_mail_icon');

	function uplift_phone_icon() {
		return '<i class="fa-phone"></i>';
	}
	add_filter('sf_phone_icon', 'uplift_phone_icon');

	function uplift_rows_icon() {
		return '<i class="fa-bars"></i>';
	}
	add_filter('sf_rows_icon', 'uplift_rows_icon');
	
	
	/* SWIFT SLIDER FILTERS
	================================================== */
	function uplift_swift_slider_prev_icon() {
		return '<svg version="1.1" class="svg-swift-slider-prev" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="48px" height="48px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xml:space="preserve">
		<path fill="none" stroke="#222222" stroke-width="3" stroke-linecap="square" stroke-linejoin="round" stroke-miterlimit="10" d="
			M14,24L34,4L14,24z"/>
		<path fill="none" stroke="#222222" stroke-width="3" stroke-linecap="square" stroke-linejoin="round" stroke-miterlimit="10" d="
			M14,24l20,20L14,24z"/>
		</svg>';
	}
	add_filter('swift_slider_prev_icon', 'uplift_swift_slider_prev_icon');

	function uplift_swift_slider_next_icon() {
		return '<svg version="1.1" class="svg-swift-slider-next" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="48px" height="48px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xml:space="preserve">
		<path fill="none" stroke="#222222" stroke-width="3" stroke-linecap="square" stroke-linejoin="round" stroke-miterlimit="10" d="
			M34,24L14,44L34,24z"/>
		<path fill="none" stroke="#222222" stroke-width="3" stroke-linecap="square" stroke-linejoin="round" stroke-miterlimit="10" d="
			M34,24L14,4L34,24z"/>
		</svg>';
	}
	add_filter('swift_slider_next_icon', 'uplift_swift_slider_next_icon');

	function uplift_swift_slider_continue_icon() {
		return '<svg version="1.1" class="svg-swift-slider-continue" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="48px" height="48px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xml:space="preserve">
		<path fill="none" stroke="#222222" stroke-width="3" stroke-linecap="square" stroke-linejoin="round" stroke-miterlimit="10" d="
			M23.998,33.999l-20-20L23.998,33.999z"/>
		<path fill="none" stroke="#222222" stroke-width="3" stroke-linecap="square" stroke-linejoin="round" stroke-miterlimit="10" d="
			M23.998,33.999l20-20L23.998,33.999z"/>
		</svg>';
	}
	add_filter('swift_slider_continue_icon', 'uplift_swift_slider_continue_icon');

	