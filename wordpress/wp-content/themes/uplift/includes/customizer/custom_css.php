<?php

    /*
    *
    *   Customizer Custom CSS Generation
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

    
    /**
    * Output the page specfiic custom styles to the site's frontend
    *
    */
    function sf_page_specific_custom_styles() {
		
		/* Get Variables
		================================================== */
		$customizer_path = get_template_directory() . '/includes/customizer/';
		require( $customizer_path . '/variables.php' );
		$custom_styles = '';

		
		/* App Style Header
		================================================== */
		if ( isset( $fancy_title_image_url ) && $fancy_title_image_url != "" ) {
			$custom_styles .= '.app-header .header-wrap #header, .app-header .header-wrap[class*="page-header-naked"] #header-section #header, .app-header .header-wrap[class*="page-header-naked"] #header-section.header-5 #header {background-image: url(' . $fancy_title_image_url . ');}';
			if ( isset ( $bg_color_title ) && $bg_color_title != "" ) {
				$custom_styles .= '.app-header .header-wrap #header::before {background-color:' . $bg_color_title . ';}';
			}
			if ( isset ( $bg_opacity_title ) && $bg_opacity_title != "" ) {
				$bg_opacity_title = ($bg_opacity_title < 100 ? '0.' . $bg_opacity_title : '1.0');
				$custom_styles .= '.app-header .header-wrap #header::before {opacity: ' . $bg_opacity_title . ';}';
			}
		}
		
		/* Inner Background Color
		================================================== */
		if ( isset( $inner_background_color ) && $inner_background_color != "" ) {
			$custom_styles .= '.tabbed-heading-wrap .heading-text {background-color: ' . $inner_background_color . ';}';
		    $custom_styles .= '.inner-container-wrap, #main-container .inner-container-wrap, .timeline-item-format-icon-bg, .sf-mobile-shop-filters-link.filters-open::after {background-color: ' . $inner_background_color . '!important;}';
		    $custom_styles .= '.boxed-inner-page .inner-page-wrap {background-color: ' . $inner_background_color . ';}';
		    $custom_styles .= '.single-product.page-heading-fancy .product-main {background-color: ' . $inner_background_color . ';}';
		    $custom_styles .= 'body.product-fw-split div.product div.images, body.product-fw-split div.product div.summary {background-color: ' . $inner_background_color . ';}';
		    $custom_styles .= '.spb-row-container[data-top-style="slant-ltr"]:before, .spb-row-container[data-top-style="slant-rtl"]:before, .spb-row-container[data-bottom-style="slant-ltr"]:after, .spb-row-container[data-bottom-style="slant-rtr"]:after {background-color: ' . $inner_background_color . ';}';
			$custom_styles .= '.progress-bar-wrap .progress .bar:after {border-color: ' . $inner_background_color . ';}';
			$custom_styles .= '.blog-aux-options li.selected a::after {background:'.$inner_background_color.';}';
		}
		
        /* Page background styling output
        ================================================== */
        if ( isset( $bg_image_url ) && $bg_image_url != "" ) {
        	$custom_styles .= '.boxed-inner-page #container {background: transparent;}';
            if ( $background_image_size == "cover" ) {
                $custom_styles .= 'body { background: transparent url("' . $bg_image_url . '") no-repeat center top fixed; background-size: cover; }';
            } else {
                $custom_styles .= 'body { background: transparent url("' . $bg_image_url . '") repeat center top fixed; background-size: auto; }';
            }
        }


        /* Inner page background styles
        ================================================== */
        if ( isset( $inner_bg_image_url ) && $inner_bg_image_url != "" ) {
            if ( $inner_background_image_size == "cover" ) {
                $custom_styles .= '.inner-container-wrap, #main-container .inner-container-wrap { background: transparent url("' . $inner_bg_image_url . '") no-repeat center top; background-size: cover;background-attachment: fixed; }';
            } else {
                $custom_styles .= '.inner-container-wrap, #main-container .inner-container-wrap { background: transparent url("' . $inner_bg_image_url . '") repeat center top; background-size: auto;}';
            }
            $custom_styles .= '.timeline-items .standard-post-content, .blog-aux-options li a, .blog-aux-options li form input, .masonry-items .blog-item .masonry-item-wrap, .wp-tag-cloud li a, .masonry-items .portfolio-item-details {background: ' . $inner_page_bg_color . ';}';
            $custom_styles .= '.timeline-items .format-quote .standard-post-content:before, .timeline-items .standard-post-content.no-thumb:before {border-left-color: ' . $inner_page_bg_color . ';}';
        }
        
        echo '<style>'.$custom_styles.'</style>';
		    
    }
	add_action( 'wp_head', 'sf_page_specific_custom_styles', 9999 );
 
	/**
	* Output the customizer styles to the site's frontend
	*
	*/
	function sf_custom_styles_output() {
	
		/* Get Customizer Variables
		================================================== */
		$customizer_path = get_template_directory() . '/includes/customizer/';
		require( $customizer_path . '/variables.php' );
		
		
		/* Default variables
		================================================== */
		$custom_styles = '';
		
		
		/* Layout styling output
		================================================== */
        if ( $site_maxwidth != "1170" ) {
            $site_contwidth  = intval( $site_maxwidth, 10 ) - 30;
            $site_boxedwidth = intval( $site_maxwidth, 10 ) + 30;
            $custom_styles .= '@media only screen and (min-width: ' . $site_boxedwidth . 'px) {
				.layout-boxed #container, .boxed-inner-page #main-container, .single-product.page-heading-fancy .product-main, .layout-boxed #sf-newsletter-bar > .container {
					width: ' . $site_boxedwidth . 'px;
				}
				.container {
					width: ' . $site_maxwidth . 'px;
				}
				li.menu-item.sf-mega-menu > ul.sub-menu {
					width: ' . $site_contwidth . 'px;
				}
				.mm-custom-theme #mega-menu-wrap-main_navigation #mega-menu-main_navigation > li.mega-menu-megamenu > ul.mega-sub-menu {
					min-width: ' . $site_contwidth . 'px;
				}
			}';
        }
        
        if ( $site_width_format == "percent" ) {
        	$custom_styles .= '.container {
        		width: ' . $site_maxwidth_percent . '%;
        		max-width: ' . $site_maxwidth . 'px;
        	}';
        }
	
	
        /* Non Responsive Styling
        ================================================== */
        if ( ! $enable_responsive ) {
            $site_contwidth  = intval( $site_maxwidth, 10 );
            $site_boxedwidth = intval( $site_maxwidth, 10 ) + 50;
            $custom_styles .= '
				html {
					min-width: ' . $site_maxwidth . 'px;
				}
				.container,
				.navbar-static-top .container,
				.navbar-fixed-top .container,
				.navbar-fixed-bottom .container {
				  width: ' . $site_contwidth . 'px!important;
				  max-width: none!important;
				}
				#header .is-sticky .sticky-header {
				 width: 100%!important;
				 max-width: none!important;
				}
				.col-sm-1,
				.col-sm-2,
				.col-sm-3,
				.col-sm-4,
				.col-sm-5,
				.col-sm-6,
				.col-sm-7,
				.col-sm-8,
				.col-sm-9,
				.col-sm-10,
				.col-sm-11 {
				  float: left;
				}
				.col-sm-12 {
				  width: 100%;
				}
				.col-sm-11 {
				  width: 91.66666666666666%;
				}
				.col-sm-10 {
				  width: 83.33333333333334%;
				}
				.col-sm-9 {
				  width: 75%;
				}
				.col-sm-8 {
				  width: 66.66666666666666%;
				}
				.col-sm-7 {
				  width: 58.333333333333336%;
				}
				.col-sm-6 {
				  width: 50%;
				}
				.col-sm-5 {
				  width: 41.66666666666667%;
				}
				.col-sm-4 {
				  width: 33.33333333333333%;
				}
				.col-sm-3 {
				  width: 25%;
				}
				.col-sm-2 {
				  width: 16.666666666666664%;
				}
				.col-sm-1 {
				  width: 8.333333333333332%;
				}
				.col-sm-pull-12 {
				  right: 100%;
				}
				.col-sm-pull-11 {
				  right: 91.66666666666666%;
				}
				.col-sm-pull-10 {
				  right: 83.33333333333334%;
				}
				.col-sm-pull-9 {
				  right: 75%;
				}
				.col-sm-pull-8 {
				  right: 66.66666666666666%;
				}
				.col-sm-pull-7 {
				  right: 58.333333333333336%;
				}
				.col-sm-pull-6 {
				  right: 50%;
				}
				.col-sm-pull-5 {
				  right: 41.66666666666667%;
				}
				.col-sm-pull-4 {
				  right: 33.33333333333333%;
				}
				.col-sm-pull-3 {
				  right: 25%;
				}
				.col-sm-pull-2 {
				  right: 16.666666666666664%;
				}
				.col-sm-pull-1 {
				  right: 8.333333333333332%;
				}
				.col-sm-push-12 {
				  left: 100%;
				}
				.col-sm-push-11 {
				  left: 91.66666666666666%;
				}
				.col-sm-push-10 {
				  left: 83.33333333333334%;
				}
				.col-sm-push-9 {
				  left: 75%;
				}
				.col-sm-push-8 {
				  left: 66.66666666666666%;
				}
				.col-sm-push-7 {
				  left: 58.333333333333336%;
				}
				.col-sm-push-6 {
				  left: 50%;
				}
				.col-sm-push-5 {
				  left: 41.66666666666667%;
				}
				.col-sm-push-4 {
				  left: 33.33333333333333%;
				}
				.col-sm-push-3 {
				  left: 25%;
				}
				.col-sm-push-2 {
				  left: 16.666666666666664%;
				}
				.col-sm-push-1 {
				  left: 8.333333333333332%;
				}
				.col-sm-offset-12 {
				  margin-left: 100%;
				}
				.col-sm-offset-11 {
				  margin-left: 91.66666666666666%;
				}
				.col-sm-offset-10 {
				  margin-left: 83.33333333333334%;
				}
				.col-sm-offset-9 {
				  margin-left: 75%;
				}
				.col-sm-offset-8 {
				  margin-left: 66.66666666666666%;
				}
				.col-sm-offset-7 {
				  margin-left: 58.333333333333336%;
				}
				.col-sm-offset-6 {
				  margin-left: 50%;
				}
				.col-sm-offset-5 {
				  margin-left: 41.66666666666667%;
				}
				.col-sm-offset-4 {
				  margin-left: 33.33333333333333%;
				}
				.col-sm-offset-3 {
				  margin-left: 25%;
				}
				.col-sm-offset-2 {
				  margin-left: 16.666666666666664%;
				}
				.col-sm-offset-1 {
				  margin-left: 8.333333333333332%;
				}
				#container.boxed-layout, .boxed-layout #header-section .is-sticky #main-nav.sticky-header, .boxed-layout #header-section.header-6 .is-sticky #header.sticky-header {
					width: ' . $site_boxedwidth . 'px;
				}
				#swift-slider {
					min-width: ' . $site_contwidth . 'px;
				}
				.visible-xs, .visible-sm, .visible-xs.visible-sm {
					display:none!important;
				}
				' . "\n";
        }
        
        /* General styling output
        ================================================== */
		$custom_styles .= '.sf-elem-bf, .sf-elem-bt, .sf-elem-br, .sf-elem-bb, .sf-elem-bl {border-color: ' . $section_divide_color . ';}';
		
		
        /* Accent styling output
        ================================================== */
        //$custom_styles .= '::selection {background-color: ' . $accent_color . '; color: #fff;}';
        $custom_styles .= '.sf-accent-bg, .funded-bar .bar {background-color:' . $accent_color . ';}';
        $custom_styles .= '.sf-accent {color:' . $accent_color . ';}';
        $custom_styles .= '.sf-accent-border {border-color:' . $accent_color . ';}';
        $custom_styles .= '.sf-accent-hover:hover {color:' . $accent_color . ';}';
        
        $custom_styles .= '.loved-item:hover .loved-count, .flickr-widget li, .portfolio-grid li, figcaption .product-added, .woocommerce .widget_layered_nav ul li.chosen > *, .woocommerce .widget_layered_nav ul li.chosen small.count, .woocommerce .widget_layered_nav_filters ul li a {background-color: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
        $custom_styles .= 'a:hover, a:focus, #sidebar a:hover, .pagination-wrap a:hover, .carousel-nav a:hover, .portfolio-pagination div:hover > i, #footer a:hover, .beam-me-up a:hover span, .portfolio-item .portfolio-item-permalink, .read-more-link, .blog-item .read-more, .blog-item-details a:hover, .author-link, span.dropcap2, .spb_divider.go_to_top a, .item-link:hover, #header-translation p a, #breadcrumbs a:hover, .ui-widget-content a:hover, #product-img-slider li a.zoom:hover, .article-body-wrap .share-links a:hover, ul.member-contact li a:hover, .bag-product a.remove:hover, .bag-product-title a:hover, #back-to-top:hover,  ul.member-contact li a:hover, .fw-video-link-image:hover i, .ajax-search-results .all-results:hover, .search-result h5 a:hover .ui-state-default a:hover, .fw-video-link-icon:hover, .fw-video-close:hover {color: ' . $accent_color . ';}';
        $custom_styles .= '.carousel-wrap > a:hover {color: ' . $accent_color . '!important;}';
        $custom_styles .= '.read-more i:before, .read-more em:before {color: ' . $accent_color . ';}';
        $custom_styles .= 'span.dropcap4 {color: ' . $accent_color . '; border-color: ' . $accent_color . ';}';
        $custom_styles .= 'span.highlighted {background-color: rgba(' . $accent_color_rgb["red"] . ',' . $accent_color_rgb["green"] . ',' . $accent_color_rgb["blue"] . ', 0.5);}';
        $custom_styles .= 'textarea:focus, input:focus, input[type="text"]:focus, input[type="email"]:focus, textarea:focus, .bypostauthor .comment-wrap .comment-avatar,.search-form input:focus, .wpcf7 input:focus, .wpcf7 textarea:focus, .ginput_container input:focus, .ginput_container textarea:focus, .mymail-form input:focus, .mymail-form textarea:focus, input[type="tel"]:focus, input[type="number"]:focus {border-color: ' . $accent_color . '!important;}';
        $custom_styles .= 'nav .menu ul li:first-child:after,.navigation a:hover > .nav-text, .returning-customer a:hover {border-bottom-color: ' . $accent_color . ';}';
        $custom_styles .= 'nav .menu ul ul li:first-child:after {border-right-color: ' . $accent_color . ';}';
        $custom_styles .= '.spb_impact_text .spb_call_text, pre[class*="language-"] {border-left-color: ' . $accent_color . ';}';
        $custom_styles .= '.spb_impact_text .spb_button span {color: #fff;}';
        $custom_styles .= 'a[rel="tooltip"], ul.member-contact li a, a.text-link, .tags-wrap .tags a, .logged-in-as a, .comment-meta-actions .edit-link, .comment-meta-actions .comment-reply {border-color: ' . $link_text_color . ';}';
        $custom_styles .= '.super-search-go {border-color: ' . $accent_color . '!important;}';
        $custom_styles .= '.super-search-go:hover {background: ' . $accent_color . '!important;border-color: ' . $accent_color . '!important;}';        
        
        /* One page nav / Sidebar progress menu styling output
        ================================================== */
        $custom_styles .= '#one-page-nav li a:hover > i {background: ' . $accent_color . ';}';
        $custom_styles .= '#one-page-nav li.selected a:hover > i {border-color: ' . $accent_color . ';}';
        $custom_styles .= '#one-page-nav li .hover-caption {background: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
        $custom_styles .= '#one-page-nav li .hover-caption:after {border-left-color: ' . $accent_color . ';}';
        $custom_styles .= '#sidebar-progress-menu ul li {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '#sidebar-progress-menu ul li a {color: ' . $body_text_color . ';}'; 
        $custom_styles .= '#sidebar-progress-menu ul li.read a {color: ' . $link_text_color . ';}'; 
        $custom_styles .= '#sidebar-progress-menu ul li.reading a {color: ' . $accent_color . ';}'; 
        $custom_styles .= '#sidebar-progress-menu ul li.read .progress {background-color: ' . $section_divide_color . ';}'; 
        $custom_styles .= '#sidebar-progress-menu ul li.reading .progress {background-color: ' . $accent_color . ';}'; 
        
        
        /* General styling output
        ================================================== */
        $custom_styles .= 'body {color: ' . $body_text_color . ';}';
        $custom_styles .= 'h1, h1 a, h3.countdown-subject {color: ' . $h1_text_color . ';}';
        $custom_styles .= 'h2, h2 a {color: ' . $h2_text_color . ';}';
        $custom_styles .= 'h3, h3 a {color: ' . $h3_text_color . ';}';
        $custom_styles .= 'h4, h4 a, .carousel-wrap > a {color: ' . $h4_text_color . ';}';
        $custom_styles .= 'h5, h5 a {color: ' . $h5_text_color . ';}';
        $custom_styles .= 'h6, h6 a {color: ' . $h6_text_color . ';}';
        $custom_styles .= 'table {border-bottom-color: ' . $section_divide_color . ';}';
        $custom_styles .= 'table td {border-top-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.read-more-button {color: ' . $accent_color . ';}';
        $custom_styles .= '.sf-hover-svg path {stroke: ' . $accent_color . ';}';
        $custom_styles .= '.player-video .player-controls {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.player-controls button {color: ' . $link_text_color . ';}';
        $custom_styles .= '.player-controls button.tab-focus, .player-controls button:hover, .player-progress-played[value] {color: ' . $accent_color . ';}';
		$custom_styles .= '.sf-headline.loading-bar .sf-words-wrapper::after, .sf-headline.clip .sf-words-wrapper::after, .sf-headline.type .sf-words-wrapper::after, .sf-headline.type .sf-words-wrapper.selected {background: ' . $accent_color . ';}';
		$custom_styles .= '.sf-headline.type .sf-words-wrapper.selected b {color: ' . $accent_alt_color . ';}';
        $custom_styles .= '#sf-home-preloader, #site-loading {background-color: ' . $inner_page_bg_color . ';}';
        $custom_styles .= '.loading-bar-transition .pace .pace-progress {background-color: ' . $accent_color . ';}';
        if ( $body_bg_use_image ) {
            if ( is_array($body_upload_bg) && $body_upload_bg['url'] != "" ) {
                $custom_styles .= 'body, .layout-fullwidth #container {background: ' . $page_bg_color . ' url(' . $body_upload_bg['url'] . ') repeat center top fixed;}';
            } else if ( $body_preset_bg ) {
                $custom_styles .= 'body, .layout-fullwidth #container {background: ' . $page_bg_color . ' url(' . $body_preset_bg . ') repeat center top fixed;}';
            }
            if ( $page_bg_color != "" ) {
                $custom_styles .= 'body, .layout-fullwidth #container {background-color: ' . $page_bg_color . ';background-size: ' . $bg_size . ';}';
            }
        } else if ( $page_bg_color != "" ) {
            $custom_styles .= 'body, .layout-fullwidth #container {background-color: ' . $page_bg_color . ';}';
        }
        $custom_styles .= '.inner-container-wrap, #main-container .inner-container-wrap, .tm-toggle-button-wrap a {background-color: ' . $inner_page_bg_color . ';}';
		$custom_styles .= '.single-product.page-heading-fancy .product-main {background-color: ' . $inner_page_bg_color . ';}';
		$custom_styles .= '.spb-row-container[data-top-style="slant-ltr"]:before, .spb-row-container[data-top-style="slant-rtl"]:before, .spb-row-container[data-bottom-style="slant-ltr"]:after, .spb-row-container[data-bottom-style="slant-rtr"]:after {background-color: ' . $inner_page_bg_color . ';}';
					
        $custom_styles .= 'a, .ui-widget-content a {color: ' . $link_text_color . ';}';
        $custom_styles .= 'a:hover, a:focus {color: ' . $link_hover_color . ';}';
        $custom_styles .= 'ul.bar-styling li:not(.selected) > a:hover, ul.bar-styling li > .comments-likes:hover {color: ' . $accent_alt_color . ';background: ' . $accent_color . ';border-color: ' . $accent_color . ';}';
        $custom_styles .= 'ul.bar-styling li > .comments-likes:hover * {color: ' . $accent_alt_color . '!important;}';
        $custom_styles .= 'ul.bar-styling li > a, ul.bar-styling li > div, ul.page-numbers li > a, ul.page-numbers li > span, .curved-bar-styling, ul.bar-styling li > form input, .spb_directory_filter_below {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= 'ul.bar-styling li > a, ul.bar-styling li > span, ul.bar-styling li > div, ul.bar-styling li > form input {background-color: ' . $inner_page_bg_color . ';}';
        $custom_styles .= '.pagination-wrap ul li a {border-color: ' . $section_divide_color . '!important;background-color: ' . $alt_bg_color . '!important;color: ' . $body_alt_text_color . '!important;}';
        $custom_styles .= 'ul.page-numbers li > a:hover, ul.page-numbers li > span.current, .pagination-wrap ul li > a:hover, .pagination-wrap ul li span {border-color: ' . $section_divide_color . '!important;background-color: ' . $inner_page_bg_color . '!important;color: ' . $body_alt_text_color . '!important;}';
        $custom_styles .= 'input[type="text"], input[type="email"], input[type="password"], textarea, select, .wpcf7 input[type="text"], .wpcf7 input[type="email"], .wpcf7 textarea, .wpcf7 select, .ginput_container input[type="text"], .ginput_container input[type="email"], .ginput_container textarea, .ginput_container select, .mymail-form input[type="text"], .mymail-form input[type="email"], .mymail-form textarea, .mymail-form select, input[type="date"], input[type="tel"], input.input-text, input[type="number"], .select2-container .select2-choice {border-color: ' . $section_divide_color . ';background-color: ' . $input_bg_color . ';color:' . $input_text_color . ';}';
        $custom_styles .= '.select2-container .select2-choice>.select2-chosen {color:' . $input_text_color . '!important;}';
        $custom_styles .= '#commentform p[class^="comment-form-"]:before, span.wpcf7-form-control-wrap.name:before, span.wpcf7-form-control-wrap.email:before, span.wpcf7-form-control-wrap.subject:before, span.wpcf7-form-control-wrap.message:before {color:' . $input_text_color . ';}';
        $custom_styles .= '::-webkit-input-placeholder {color:' . $input_text_color . '!important;}';
        $custom_styles .= ':-moz-placeholder {color:' . $input_text_color . '!important;}';
        $custom_styles .= '::-moz-placeholder {color:' . $input_text_color . '!important;}';
        $custom_styles .= ':-ms-input-placeholder {color:' . $input_text_color . '!important;}';
        $custom_styles .= 'input[type=submit], button[type=submit], input[type="file"], .wpcf7 input.wpcf7-submit[type=submit] {background: ' . $accent_color . ';color: ' . $accent_alt_color . ';}';
        $custom_styles .= 'input[type=submit]:hover, button[type=submit]:hover, .wpcf7 input.wpcf7-submit[type=submit]:hover, .gform_wrapper input[type=submit]:hover, .mymail-form input[type=submit]:hover {background: ' . $secondary_accent_color . ';color: ' . $secondary_accent_alt_color . ';}';
        $custom_styles .= '.modal-header {background: ' . $alt_bg_color . ';}';
        $custom_styles .= '.modal-content {background: ' . $inner_page_bg_color . ';}';
        $custom_styles .= '.modal-header h3, .modal-header .close {color: '. $body_text_color.';}';
        $custom_styles .= '.modal-header .close:hover {color: '. $accent_color.';}';
        $custom_styles .= '#account-modal .nav-tabs li.active span {border-bottom-color: '. $accent_color.';}';
        $custom_styles .= '.recent-post .post-details, .portfolio-item h5.portfolio-subtitle, .search-item-content time, .search-item-content span, .portfolio-details-wrap .date {color: ' . $body_alt_text_color . ';}';
		$custom_styles .= '.select2-drop, .select2-drop-active {border-color: ' . $section_divide_color . ';}';
		$custom_styles .= '.owl-pagination .owl-page span {background-color: ' . $body_text_color . ';}';
		$custom_styles .= '.owl-pagination .read-more i::before {color: ' . $body_text_color . ';}';
		$custom_styles .= '.owl-pagination .read-more:hover i::before {color: ' . $accent_color . ';}';
		$custom_styles .= '.owl-pagination .owl-page:hover span, .owl-pagination .owl-page.active a {background-color: ' . $secondary_accent_color . ';}';
		
     	
     	/* Top Bar styling output
     	================================================== */
        $custom_styles .= '#top-bar {background: ' . $topbar_bg_color . '; border-bottom-color: '.$topbar_divider_color.';}';
        $custom_styles .= '#top-bar .tb-text {color: ' . $topbar_text_color . ';}';
        $custom_styles .= '#top-bar .tb-text > a, #top-bar nav .menu > li > a {color: ' . $topbar_link_color . ';}';
        $custom_styles .= '#top-bar .menu li {border-left-color: ' . $topbar_divider_color . '; border-right-color: ' . $topbar_divider_color . ';}';
        $custom_styles .= '#top-bar .menu > li > a, #top-bar .menu > li.parent:after {color: ' . $topbar_link_color . ';}';
        $custom_styles .= '#top-bar .menu > li > a:hover, #top-bar a:hover {color: ' . $topbar_link_hover_color . ';}';

        
        /* Header styling output
        ================================================== */
        if ( $header_bg_transparent == "transparent" ) {
            $custom_styles .= '.header-wrap, .vertical-header .header-wrap #header-section {background-color:transparent;}';
            $custom_styles .= '.vertical-header #container .header-wrap {-moz-box-shadow: none;-webkit-box-shadow: none;box-shadow: none;}';
        } else {
            $custom_styles .= '.header-wrap #header, .header-standard-overlay #header, .vertical-header .header-wrap #header-section, #header-section .is-sticky #header.sticky-header {background-color:' . $header_bg_color . ';}';
            $custom_styles .= '.fs-search-open .header-wrap #header, .fs-search-open .header-standard-overlay #header, .fs-search-open .vertical-header .header-wrap #header-section, .fs-search-open #header-section .is-sticky #header.sticky-header {background-color: ' . $overlay_menu_bg_color . ';}';
            $custom_styles .= '.fs-supersearch-open .header-wrap #header, .fs-supersearch-open .header-standard-overlay #header, .fs-supersearch-open .vertical-header .header-wrap #header-section, .fs-supersearch-open #header-section .is-sticky #header.sticky-header {background-color: ' . $overlay_menu_bg_color . ';border-bottom-color:transparent;}';
            $custom_styles .= '.overlay-menu-open .header-wrap #header, .overlay-menu-open .header-standard-overlay #header, .overlay-menu-open .vertical-header .header-wrap #header-section, .overlay-menu-open #header-section .is-sticky #header.sticky-header {background-color: ' . $overlay_menu_bg_color . ';border-bottom-color: transparent;}';
            
        }
        $custom_styles .= '#sf-header-banner {background-color:' . $header_banner_bg_color . ';border-bottom: 2px solid' . $header_banner_border_color . ';}';
        $custom_styles .= '#sf-header-banner {color:' . $header_banner_text_color . ';}';
        $custom_styles .= '#sf-header-banner a {color:' . $header_banner_link_color . ';}';
        $custom_styles .= '#sf-header-banner a:hover {color:' . $header_banner_link_hover_color . ';}';
        $custom_styles .= '.header-left, .header-right, .vertical-menu-bottom .copyright {color: ' . $header_text_color . ';}';
        $custom_styles .= '.header-left a, .header-right a, .vertical-menu-bottom .copyright a, .header-left ul.menu > li > a.header-search-link-alt, .header-left ul.menu > li > a.header-search-link, .header-right ul.menu > li > a.header-search-link, .header-right ul.menu > li > a.header-search-link-alt {color: ' . $header_link_color . ';}';
        $custom_styles .= '.aux-item nav .menu > li.menu-item > a, .aux-item nav.std-menu .menu > li > a, .aux-item nav.std-menu .menu > li > span {color: ' . $header_link_color . ';}';
        
        $custom_styles .= '.header-left a:hover, .header-right a:hover, .vertical-menu-bottom .copyright a:hover {color: ' . $header_link_hover_color . ';}';
        $custom_styles .= '.header-left ul.menu > li:hover > a.header-search-link-alt, .header-right ul.menu > li:hover > a.header-search-link-alt {color: ' . $header_link_hover_color . '!important;}';
        $custom_styles .= '#header-search a:hover, .super-search-close:hover {color: ' . $accent_color . ';}';
        $custom_styles .= '.sf-super-search {background-color: ' . $secondary_accent_color . ';}';
        $custom_styles .= '.sf-super-search .search-options .ss-dropdown ul {background-color: ' . $accent_color . ';}';
        $custom_styles .= '.sf-super-search .search-options .ss-dropdown ul li a {color: ' . $accent_alt_color . ';}';
        $custom_styles .= '.sf-super-search .search-options .ss-dropdown ul li a:hover {color: ' . $secondary_accent_color . ';}';
        $custom_styles .= '.sf-super-search .search-options .ss-dropdown > span, .sf-super-search .search-options input {color: ' . $accent_color . '; border-bottom-color: ' . $accent_color . ';}';
        $custom_styles .= '.sf-super-search .search-options .ss-dropdown ul li .fa-check {color: ' . $secondary_accent_color . ';}';
        $custom_styles .= '.sf-super-search-go:hover, .sf-super-search-close:hover { background-color: ' . $accent_color . '; border-color: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
        $custom_styles .= '.header-languages .current-language {color: ' . $nav_sm_selected_text_color . ';}';
        if ( $header_bg_color != "#ffffff" ) {
            $custom_styles .= '.search-item-content time {color: ' . $nav_divider_color . ';}';
        }
    	$custom_styles .= '.header-left .aux-item, .header-right .aux-item {padding-left: 5px;padding-right: 5px;}';
    	$custom_styles .= '.aux-item .std-menu.cart-wishlist {margin-left: 0; margin-right: 0;}';
        $custom_styles .= '#header-section header, .header-wrap #header-section .is-sticky #header.sticky-header, #main-nav {border-bottom-color: ' . $header_border_color . ';}';
        //$custom_styles .= '.header-left .aux-item, .header-right .aux-item {border-color: ' . $header_border_color . '!important;}';
		$custom_styles .= '#contact-slideout {background: ' . $inner_page_bg_color . ';}';
		
		
		/* Mega Menu styling output
		================================================== */
		if ( class_exists( 'Mega_Menu' ) ) {
			$custom_styles .= '#mega-menu-wrap-main_navigation #mega-menu-main_navigation {text-align: center;}';
			$custom_styles .= 'nav > .mega-menu-wrap {background: transparent;}';
			$custom_styles .= 'nav > .mega-menu-wrap ul.mega-menu > li.mega-menu-item.mega-toggle-on > a, nav > .mega-menu-wrap ul.mega-menu > li:hover > a:not(.sf-button), nav > .mega-menu-wrap ul.mega-menu > li.mega-menu-item > a.mega-menu-link:focus {color: ' . $nav_text_hover_color . '!important;}';
			$custom_styles .= 'nav > .mega-menu-wrap ul.mega-menu > li.mega-menu-megamenu > ul.mega-sub-menu, nav > .mega-menu-wrap ul.mega-menu > li.mega-menu-flyout ul.mega-sub-menu, nav > .mega-menu-wrap ul.mega-menu > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link {background: '.$nav_sm_bg_color.'!important;}';
			$custom_styles .= 'nav > .mega-menu-wrap ul.mega-menu > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link {background: transparent;color: ' . $nav_sm_text_color . ';}';
			$custom_styles .= 'nav.std-menu ul.sub-menu > li, nav.std-menu ul.mega-sub-menu li.mega-menu-item a.mega-menu-link {border-color: '.$nav_divider_color.';}';
			$custom_styles .= '.full-center nav#main-navigation {width: 80%;}';
			$custom_styles .= 'nav .mega-menu ul.mega-sub-menu li.mega-menu-item > a, nav .mega-menu ul.mega-sub-menu li > span, nav.std-menu ul.mega-sub-menu {white-space: normal; color: ' . $nav_sm_text_color . ';}';
			$custom_styles .= 'nav > .mega-menu-wrap ul.mega-menu > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item:hover > a.mega-menu-link {color: ' . $nav_text_hover_color . ';}';
			$custom_styles .= 'li.mega-menu-megamenu > ul.mega-sub-menu li.mega-menu-item li.mega-menu-item > a.mega-menu-link, nav.std-menu .mega-menu-wrap li.mega-menu-megamenu ul.mega-sub-menu li.mega-menu-item-has-children > ul.mega-sub-menu {color: ' . $nav_sm_text_color . ';}';
			$custom_styles .= 'nav.std-menu .mega-menu-wrap li.mega-menu-megamenu ul.mega-sub-menu li.mega-menu-item-has-children > ul.mega-sub-menu a:hover, nav.std-menu .mega-menu-wrap li.mega-menu-megamenu ul.mega-sub-menu li.mega-menu-item-has-children > ul.mega-sub-menu a.mega-menu-link:hover {color: ' . $nav_sm_text_hover_color . ';}';
		}
		
		
        /* Mobile Header styling output
        ================================================== */
        $custom_styles .= '#mobile-top-text, #mobile-header {background-color: ' . $header_bg_color . ';border-bottom-color:' . $header_border_color . ';}';
        $custom_styles .= '#mobile-top-text, #mobile-logo h1 {color: ' . $header_text_color . ';}';
        $custom_styles .= '#mobile-top-text a, #mobile-header a {color: ' . $header_link_color . ';}';
        $custom_styles .= '#mobile-header a {color: ' . $header_link_color . ';}';
        $custom_styles .= '#mobile-header .hamburger-inner, #mobile-header .hamburger-inner::before, #mobile-header .hamburger-inner::after {background-color: ' . $header_link_color . ';}';
        $custom_styles .= '#mobile-header .mobile-menu-link:hover .hamburger-inner, #mobile-header .mobile-menu-link:hover .hamburger-inner::before, #mobile-header .mobile-menu-link:hover .hamburger-inner::after {background-color: ' . $header_link_hover_color . ';}';
        $custom_styles .= '#mobile-header a.mobile-menu-link span.menu-bars, #mobile-header a.mobile-menu-link span.menu-bars:before, #mobile-header a.mobile-menu-link span.menu-bars:after {background-color: ' . $header_link_color . ';}';
        $custom_styles .= '#mobile-header a.mobile-menu-link:hover span.menu-bars, #mobile-header a.mobile-menu-link:hover span.menu-bars:before, #mobile-header a.mobile-menu-link:hover span.menu-bars:after {background-color: ' . $header_link_hover_color . ';}';
        $custom_styles .= '#mobile-menu-wrap, #mobile-cart-wrap {background-color: ' . $mobile_menu_bg_color . ';color: ' . $mobile_menu_text_color . ';}';
        $custom_styles .= '.mh-overlay #mobile-menu-wrap, .mh-overlay #mobile-cart-wrap {background-color: transparent;}';
        $custom_styles .= '.mh-menu-show #mobile-menu-wrap, .mh-cart-show #mobile-cart-wrap, .mobile-menu-aux {background-color: ' . $mobile_menu_bg_color . ';}';
        $custom_styles .= '.mobile-search-form input[type="text"] {color: ' . $mobile_menu_text_color . ';background-color: ' . $mobile_menu_divider_color . ';}';
        $custom_styles .= '.mobile-search-form ::-webkit-input-placeholder {color: ' . $mobile_menu_text_color . '!important;}';
		$custom_styles .= '.mobile-search-form :-moz-placeholder {color: ' . $mobile_menu_text_color . '!important;}';
		$custom_styles .= '.mobile-search-form ::-moz-placeholder {color: ' . $mobile_menu_text_color . '!important;}';
		$custom_styles .= '.mobile-search-form :-ms-input-placeholder {color: ' . $mobile_menu_text_color . '!important;}';
        $custom_styles .= '#mobile-menu-wrap a, #mobile-cart-wrap a:not(.sf-button) {color: ' . $mobile_menu_text_color . ';}';
        $custom_styles .= '#mobile-menu-wrap .shopping-bag-item a > span.num-items {background-color: ' . $mobile_menu_text_color . ';color: ' . $mobile_menu_bg_color . ';}';
        $custom_styles .= '#mobile-menu-wrap a:not(.sf-button):hover, #mobile-cart-wrap a:not(.sf-button):hover, #mobile-menu ul li.menu-item > a:hover, #mobile-menu ul.alt-mobile-menu > li > a:hover {color: ' . $mobile_menu_link_hover_color . '!important;}';
        $custom_styles .= '#mobile-menu-wrap .bag-buttons a.wishlist-button {color: ' . $mobile_menu_link_color . ';}';
		$custom_styles .= '#mobile-menu ul li.parent > a:after {color: ' . $mobile_menu_text_color . ';}';
        $custom_styles .= '#mobile-cart-wrap .shopping-bag-item > a.cart-contents, #mobile-cart-wrap .bag-product, #mobile-cart-wrap .bag-empty {border-bottom-color: ' . $mobile_menu_divider_color . ';}';
        $custom_styles .= '#mobile-menu ul li, .mobile-cart-menu li, .mobile-cart-menu .bag-header, .mobile-cart-menu .bag-product, .mobile-cart-menu .bag-empty {border-color: ' . $mobile_menu_divider_color . ';}';
        $custom_styles .= 'a.mobile-menu-link span, a.mobile-menu-link span:before, a.mobile-menu-link span:after {background: ' . $mobile_menu_link_color . ';}';
        $custom_styles .= 'a.mobile-menu-link:hover span, a.mobile-menu-link:hover span:before, a.mobile-menu-link:hover span:after {background: ' . $mobile_menu_link_hover_color . ';}';
        $custom_styles .= '#mobile-cart-wrap .bag-buttons > a.bag-button {color: '.$mobile_menu_link_color.'!important;border-color: '.$mobile_menu_link_color.';}';
		$custom_styles .= '#mobile-cart-wrap .bag-product a.remove {color: '.$mobile_menu_link_color.'!important;}';
		$custom_styles .= '#mobile-cart-wrap .bag-product a.remove:hover {color: '.$mobile_menu_link_hover_color.'!important;}';

        
        /* Logo styling output
        ================================================== */
		if ( $logo_height != "" ) {
		    $custom_styles .= '#logo.has-img, .header-left, .header-right {height:' . $header_height . ';}';
		    $custom_styles .= '#mobile-logo {max-height:' . $logo_height . 'px;}';
		    $custom_styles .= '#mobile-logo.has-img img {max-height:' . $logo_height . 'px;}';
		    $custom_styles .= '.full-center #logo.has-img a > img {max-height: '.$header_height.';}';
		}
		if ($logo_width != "") {
			$custom_styles .= '.browser-ie #logo {width:' . $logo_width . 'px;}';
		}
		if ( $retina_logo_width != "" ) {
		    $custom_styles .= '#logo img.retina, #mobile-logo img.retina {width:' . $retina_logo_width . 'px;}';
		}
		if ( $logo_padding != "" ) {
		    $custom_styles .= '#logo.has-img a {padding: ' . $logo_padding . 'px 0;}';
		    $custom_styles .= '.header-2 #logo.has-img img {max-height:' . $logo_height . 'px;}';
		}
		if ( $logo_maxheight != "" && $logo_maxheight != 0 ) {
			$custom_styles .= '#logo.has-img img {max-height:' . $logo_maxheight . 'px;}';
			if ( $logo_height == "" ) {
			$custom_styles .= '#mobile-logo.has-img img {max-height:' . $logo_maxheight . 'px;}';
			}
			$header_height_num = str_replace( $header_height, 'px', '' );
			if ( $header_height_num != "" && $logo_maxheight > $header_height_num) {
				$logo_maxheight = $header_height_num;
			}
			$custom_styles .= '.full-center #logo.has-img a > img {max-height: '.$logo_maxheight.'px;padding: 0;}';
		}
        if ( $header_height != "" ) {
        	$custom_styles .= '#logo.has-img a {height:' . $header_height . ';}';
            $custom_styles .= '.full-center #main-navigation ul.menu > li > a, .full-center nav.float-alt-menu ul.menu > li > a, .full-center nav > .mega-menu-wrap ul.mega-menu > li.mega-menu-item, .split-menu nav > .mega-menu-wrap ul.mega-menu > li.mega-menu-item, .split-menu ul.menu > li, .header-1 .split-menu .no-menu, #sf-full-header-search, .float-menu nav > .mega-menu-wrap ul.mega-menu > li.mega-menu-item, #mega-menu-wrap-main_navigation #mega-menu-main_navigation > li.mega-menu-item, #mega-menu-wrap-main_navigation #mega-menu-main_navigation > li.mega-menu-item > a.mega-menu-link {height:' . $header_height . ';line-height:' . $header_height . ';}';
            $custom_styles .= '#main-nav #mega-menu-wrap-main_navigation #mega-menu-main_navigation > li.mega-menu-item,
            #main-nav #mega-menu-wrap-main_navigation #mega-menu-main_navigation > li.mega-menu-item > a.mega-menu-link {
            height: auto;
            line-height: inherit;
            }';
            $custom_styles .= '.full-center #header, .full-center .float-menu, .full-center #logo.no-img, .header-split .float-menu, .header-1 .split-menu, .header-4 .header-right {height:' . $header_height . ';}';
            $custom_styles .= '.full-center nav li.menu-item.sf-mega-menu > ul.sub-menu, .full-center .ajax-search-wrap {top:' . $header_height . '!important;}';
            $custom_styles .= '.browser-ff #logo a {height:' . $header_height . ';}';
        	$custom_styles .= '.full-center #logo {max-height:' . $header_height . ';}';
        	$custom_styles .= '#header-sticky-wrapper {height:' . $header_height . '!important;}';
        	$custom_styles .= '.header-6 #header .header-left, .header-6 #header .header-right, .header-6 #logo {height:' . $header_height . ';line-height:' . $header_height . ';}';
        	$custom_styles .= '.header-6 #logo.has-img a > img {padding: 0;}';
        }
        if ( $resize_header_height != "" && $enable_mini_header_resize ) {
        	$custom_styles .= '#logo.has-img a > img {padding: 0 10px;}';
        	$custom_styles .= '.full-center.resized-header #main-navigation ul.menu > li > a, .full-center.resized-header nav.float-alt-menu ul.menu > li > a, .full-center.resized-header .header-right div.text, .full-header-stick.resized-header #header, .full-header-stick.resized-header #logo, .full-header-stick.resized-header .header-left, .full-header-stick.resized-header .header-right, .full-center.resized-header  #header .aux-item ul.social-icons li, nav > .mega-menu-wrap ul.mega-menu > li.mega-menu-item, .full-center.resized-header .float-menu nav > .mega-menu-wrap ul.mega-menu > li.mega-menu-item, .resized-header .header-1 .split-menu, .resized-header .split-menu ul.menu > li, .resized-header .split-menu nav > .mega-menu-wrap ul.mega-menu > li.mega-menu-item {height:' . $resize_header_height . ';line-height:' . $resize_header_height . ';}';
        	$custom_styles .= '.full-center.resized-header #logo, .full-center.resized-header #logo.no-img a {height:' . $resize_header_height . ';}';
        	$custom_styles .= '.full-center.resized-header #header, .full-center.resized-header .float-menu, .header-split.resized-header .float-menu {height:' . $resize_header_height . ';}';
        	$custom_styles .= '.full-center.resized-header nav ul.menu > li.menu-item > ul.sub-menu, .full-center.resized-header nav li.menu-item.sf-mega-menu > ul.sub-menu, .full-center.resized-header nav li.menu-item.sf-mega-menu-alt > ul.sub-menu, .full-center.resized-header .ajax-search-wrap {top:' . $resize_header_height . '!important;}';
        	$custom_styles .= '.browser-ff .resized-header #logo a {height:' . $resize_header_height . ';}';
        	$custom_styles .= '.resized-header .sticky-wrapper {height:' . $resize_header_height . '!important;}';
        	$custom_styles .= '.resized-header #logo.has-img a {height:' . $resize_header_height . ';}';
        	if ( $resize_logo_padding != "" ) {
        		$custom_styles .= '.resized-header #logo.has-img a {padding:' . $resize_logo_padding . 'px 0;}';
        	}
        	$custom_styles .= '.full-center.resized-header nav.float-alt-menu ul.menu > li > ul.sub-menu {top:' . $resize_header_height . '!important;}';
        }

        
        /* Navigation styling output
        ================================================== */
        $custom_styles .= '#main-nav, .header-wrap[class*="page-header-naked"] #header-section .is-sticky #main-nav {background-color: ' . $nav_bg_color . '; border-bottom-color: ' . $header_border_color . ';}';
        $custom_styles .= '.header-divide {background-color: ' . $nav_divider_color . ';}';
        $custom_styles .= '.show-menu {background-color: ' . $secondary_accent_color . ';color: ' . $secondary_accent_alt_color . ';}';
        $custom_styles .= 'nav .menu .sub-menu .parent > a:after {border-left-color: ' . $nav_pointer_color . ';}';
        $custom_styles .= 'nav .menu ul.sub-menu, nav .menu ul.mega-sub-menu, li.menu-item.sf-mega-menu > ul.sub-menu > div {background-color: ' . $nav_sm_bg_color . ';}';
        $custom_styles .= 'nav.std-menu ul.sub-menu:before {border-bottom-color: ' . $nav_sm_bg_color . ';}';
        $custom_styles .= 'nav .menu ul.sub-menu li.menu-item, nav .menu ul.mega-sub-menu li.mega-menu-item {border-top-color: ' . $nav_divider_color . ';border-top-style: ' . $nav_divider . ';}';
        if ( $nav_divider == "none" ) {
            $custom_styles .= '#main-nav {border-width: 0;}';
        }
        $custom_styles .= 'nav .menu > li.menu-item > a, nav.std-menu .menu > li > a, nav .mega-menu li.mega-menu-item > a:not(.sf-button), nav.std-menu .menu > li > span {color: ' . $nav_text_color . ';}';
        $custom_styles .= '#main-nav ul.menu > li, #main-nav ul.menu > li:first-child, #main-nav ul.menu > li:first-child, .full-center nav#main-navigation ul.menu > li, .full-center nav#main-navigation ul.menu > li:first-child, .full-center #header nav.float-alt-menu ul.menu > li {border-color: ' . $nav_divider_color . ';}';
        $custom_styles .= '#main-nav ul.menu > li, .full-center nav#main-navigation ul.menu > li, .full-center nav.float-alt-menu ul.menu > li, .full-center #header nav.float-alt-menu ul.menu > li {border-width: 0!important;}';
        $custom_styles .= '.full-center nav#main-navigation ul.menu > li:first-child {border-width: 0;margin-left: -15px;}';
        $custom_styles .= 'nav .menu > li.menu-item:hover > a, nav.std-menu .menu > li:hover > a {color: ' . $nav_text_hover_color . ';}';
        $custom_styles .= 'nav .menu > li.current-menu-ancestor > a, nav .menu > li.current-menu-item > a, nav .menu > li.current-scroll-item > a, #mega-menu-wrap-main_navigation #mega-menu-main_navigation > li.mega-menu-item.current-scroll-item > a.mega-menu-link, #mobile-menu .menu ul li.current-menu-item > a, nav .mega-menu > li.mega-current-menu-item > a:not(.sf-button), nav .mega-menu > li.mega-current_page_item > a:not(.sf-button) {color: ' . $nav_selected_text_color . ';}';
		$custom_styles .= '.aux-currency .wcml_currency_switcher.sub-menu li.wcml-active-currency {color: ' . $nav_selected_text_color . '!important;}';
        $custom_styles .= '.shopping-bag-item a > span.num-items {background-color: '.$accent_color.';color: '.$accent_alt_color.';}';
        $custom_styles .= '.header-left ul.sub-menu > li > a:hover, .header-right ul.sub-menu > li > a:hover, .aux-currency .wcml_currency_switcher.sub-menu li:hover  {color: '.$nav_sm_text_hover_color.';}';
        $custom_styles .= '.shopping-bag-item a > span.num-items:after {border-color: '.$nav_text_hover_color.';}';
		$custom_styles .= '.page-header-naked-light .sticky-wrapper:not(.is-sticky) .shopping-bag-item:hover a > span.num-items, .page-header-naked-dark .sticky-wrapper:not(.is-sticky) .shopping-bag-item:hover a > span.num-items {color: '.$header_bg_color.'}';
		$custom_styles .= '.page-header-naked-light .sticky-wrapper:not(.is-sticky) .shopping-bag-item:hover a > span.num-items:after, .page-header-naked-dark .sticky-wrapper:not(.is-sticky) .shopping-bag-item:hover a > span.num-items:after {border-color: '.$nav_text_hover_color.';}';
        $custom_styles .= 'nav .menu ul.sub-menu li.menu-item > a, nav .menu ul.sub-menu li > span, nav.std-menu ul.sub-menu {color: ' . $nav_sm_text_color . ';}';
        $custom_styles .= '.bag-buttons a.bag-button, .bag-buttons a.wishlist-button {color: ' . $nav_sm_text_color . '!important;}';
        $custom_styles .= '.bag-product a.remove, .woocommerce .bag-product a.remove {color: ' . $nav_sm_text_color . '!important;}';
        $custom_styles .= '.bag-product a.remove:hover, .woocommerce .bag-product a.remove:hover {color: ' . $accent_color . '!important;}';
        $custom_styles .= 'nav .menu ul.sub-menu li.menu-item:hover > a, nav .menu ul.mega-sub-menu li.mega-menu-item:hover > a, .bag-product a.remove:hover {color: ' . $nav_sm_text_hover_color . '!important;}';
        $custom_styles .= 'nav .menu li.parent > a:after, nav .menu li.parent > a:after:hover, .ajax-search-wrap:after {color: ' . $nav_text_color . ';}';
        $custom_styles .= 'nav .menu ul.sub-menu li.current-menu-ancestor > a, nav .menu ul.sub-menu li.current-menu-item > a {color: ' . $nav_sm_selected_text_color . '!important;}';
        $custom_styles .= '#main-nav .header-right ul.menu > li, .wishlist-item {border-left-color: ' . $nav_divider_color . ';}';
        $custom_styles .= '.bag-header, .bag-product, .bag-empty, .wishlist-empty {border-color: ' . $nav_divider_color . ';}';
        $custom_styles .= '.bag-buttons a.checkout-button, .bag-buttons a.create-account-button, .woocommerce input.button.alt, .woocommerce .alt-button, .woocommerce button.button.alt, #jckqv .cart .add_to_cart_button, #jckqv .button, #jckqv .cart .button, .woocommerce .single_add_to_cart_button.button.alt, .woocommerce button.single_add_to_cart_button.button.alt {background: ' . $accent_color . '; color: ' . $accent_button_text_color . ';}';
        $custom_styles .= '.woocommerce .button.update-cart-button:hover {background: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
        $custom_styles .= '.woocommerce input.button.alt:hover, .woocommerce .alt-button:hover, .woocommerce button.button.alt:hover, #jckqv .cart .add_to_cart_button:hover, #jckqv .cart .button:hover {background: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
        $custom_styles .= '.shopping-bag:before, nav .menu ul.sub-menu li:first-child:before {border-bottom-color: ' . $nav_pointer_color . ';}';
		$custom_styles .= '.page-header-naked-light .sticky-wrapper:not(.is-sticky) a.menu-bars-link:hover span, .page-header-naked-light .sticky-wrapper:not(.is-sticky) a.menu-bars-link:hover span:before, .page-header-naked-light .sticky-wrapper:not(.is-sticky) a.menu-bars-link:hover span:after, .page-header-naked-dark .sticky-wrapper:not(.is-sticky) a.menu-bars-link:hover span, .page-header-naked-dark .sticky-wrapper:not(.is-sticky) a.menu-bars-link:hover span:before, .page-header-naked-dark .sticky-wrapper:not(.is-sticky) a.menu-bars-link:hover span:after {background: '.$accent_color.';}';
		$custom_styles .= 'nav.std-menu ul.sub-menu, ul.mega-sub-menu {font-size: ' . $menu_font_size . '!important;}';
			
	       
	    /* Fullscreen overlay styling output
	    ================================================== */
        $custom_styles .= 'a.menu-bars-link span, a.menu-bars-link span:before, a.menu-bars-link span:after {background: ' . $header_link_color . ';}';
        $custom_styles .= 'a.menu-bars-link:hover span, a.menu-bars-link:hover span:before, a.menu-bars-link:hover span:after {background: ' . $header_link_hover_color . '!important;}';
        $custom_styles .= '.overlay-menu-open .header-wrap {background-color: '.$header_bg_color.';}';
        $custom_styles .= '.overlay-menu-open .header-wrap #header {background-color: transparent!important;}';
        $custom_styles .= '.overlay-menu-open #logo h1, .overlay-menu-open .header-left, .overlay-menu-open .header-right, .overlay-menu-open .header-left a, .overlay-menu-open .header-right a {color: ' . $overlay_menu_link_color . '!important;}';
        $custom_styles .= '#overlay-menu nav li.menu-item > a, .overlay-menu-open a.menu-bars-link, #overlay-menu .fs-overlay-close, .sf-pushnav-menu nav li.menu-item > a, .sf-pushnav-menu nav ul.sub-menu li.menu-item > a, .sf-pushnav a {color: ' . $overlay_menu_link_color . ';}';
        $custom_styles .= '.overlay-menu-open a.menu-bars-link span:before, .overlay-menu-open a.menu-bars-link span:after {background: ' . $overlay_menu_link_color . '!important;}';
        $custom_styles .= '.fs-supersearch-open .fs-supersearch-link, .fs-search-open .fs-header-search-link {color: ' . $overlay_menu_link_color . '!important;}';
        $custom_styles .= '#overlay-menu, .sf-pushnav {background-color: ' . $overlay_menu_bg_color . ';}';
        $custom_styles .= '#overlay-menu, .sf-pushnav #fullscreen-search, #fullscreen-supersearch {background-color: rgba(' . $overlay_menu_bg_color_rgb["red"] . ',' . $overlay_menu_bg_color_rgb["green"] . ',' . $overlay_menu_bg_color_rgb["blue"] . ', 0.95);}';
        $custom_styles .= '#overlay-menu nav li.menu-item:hover > a, .sf-pushnav-menu nav li.menu-item:hover > a, .sf-pushnav-menu nav ul.sub-menu li.menu-item:hover > a, .sf-pushnav a:hover {color: ' . $overlay_menu_link_hover_color . '!important;}';
        $custom_styles .= '#fullscreen-supersearch .sf-super-search {color: ' . $overlay_menu_text_color . '!important;}';
		$custom_styles .= '#fullscreen-supersearch .sf-super-search .search-options .ss-dropdown > span, #fullscreen-supersearch .sf-super-search .search-options input {color: ' . $overlay_menu_link_color . '!important;}';
		$custom_styles .= '#fullscreen-supersearch .sf-super-search .search-options .ss-dropdown > span:hover, #fullscreen-supersearch .sf-super-search .search-options input:hover {color: ' . $overlay_menu_link_hover_color . '!important;}';
		$custom_styles .= '#fullscreen-supersearch .sf-super-search .search-go a.sf-button {background-color: '.$accent_color.'!important;}';
		$custom_styles .= '#fullscreen-supersearch .sf-super-search .search-go a.sf-button:hover {background-color: '.$secondary_accent_color.'!important;border-color: '.$secondary_accent_color.'!important;color: '.$secondary_accent_alt_color.'!important;}';
		$custom_styles .= '#fullscreen-search .fs-overlay-close, #fullscreen-search .search-wrap .title, .fs-search-bar, .fs-search-bar input#fs-search-input, #fullscreen-search .search-result-pt h3 {color: ' . $overlay_menu_text_color . ';}';
		$custom_styles .= '#fullscreen-search ::-webkit-input-placeholder {color: ' . $overlay_menu_text_color . '!important;}';
		$custom_styles .= '#fullscreen-search :-moz-placeholder {color: ' . $overlay_menu_text_color . '!important;}';
		$custom_styles .= '#fullscreen-search ::-moz-placeholder {color: ' . $overlay_menu_text_color . '!important;}';
		$custom_styles .= '#fullscreen-search :-ms-input-placeholder {color: ' . $overlay_menu_text_color . '!important;}';
		$custom_styles .= '#fullscreen-search .container1 > div, #fullscreen-search .container2 > div, #fullscreen-search .container3 > div {background-color: ' . $overlay_menu_text_color . ';}';
		$custom_styles .= 'li.sf-menu-item-new-badge:before {background-color: '.$new_tag_color.';}';
		$custom_styles .= 'li.sf-menu-item-new-badge:after, li.mega-menu-item > a.mega-menu-link sup.new-badge {background-color: '.$new_tag_color.';color: ' . $header_bg_color . ' ;}';
		$custom_styles .= 'li.mega-menu-item > a.mega-menu-link sup.new-badge:before {border-top-color: '.$new_tag_color.';}';
		$custom_styles .= '#sf-pushnav-close path {stroke: ' . $overlay_menu_link_color . '}';
		
		
		/* Slideout Menu styling output
		================================================== */
        $custom_styles .= '.sf-side-slideout {background-color: ' . $slideout_menu_bg_color . ';}';
		if ( $slideout_menu_bg_image != "" ) {
			$custom_styles .= '.sf-side-slideout {background-image: url(' . $slideout_menu_bg_image . ');}';
		}
		$custom_styles .= '.sf-side-slideout .vertical-menu nav .menu li > a, .sf-side-slideout .vertical-menu nav .menu li.parent > a:after, .sf-side-slideout .vertical-menu nav .menu > li ul.sub-menu > li > a {color: ' . $slideout_menu_link_color . ';}';
		$custom_styles .= '.sf-side-slideout .vertical-menu nav .menu li.menu-item {border-color: ' . $slideout_menu_divider_color . ';}';
		$custom_styles .= '.sf-side-slideout .vertical-menu nav .menu li:hover > a, .sf-side-slideout .vertical-menu nav .menu li.parent:hover > a:after, .sf-side-slideout .vertical-menu nav .menu > li ul.sub-menu > li:hover > a {color: ' . $slideout_menu_link_hover_color . '!important;}';

        
        /* Contact slideout styling output
        ================================================== */
        $custom_styles .= '.contact-menu-link.slide-open {color: ' . $header_link_hover_color . ';}';


        /* Breadcrumbs styling output
        ================================================== */
        $custom_styles .= '.woocommerce .woocommerce-breadcrumb, #breadcrumbs {color:' . $breadcrumb_text_color . ';}';
        $custom_styles .= '#breadcrumbs a, #breadcrumbs i {color:' . $breadcrumb_link_color . ';}';
        $custom_styles .= '.woocommerce .woocommerce-breadcrumb a, .woocommerce-breadcrumb span {color:' . $breadcrumb_link_color . ';}';
		
		
        /* Page heading styling output
        ================================================== */
        $custom_styles .= '.page-heading {background-color: ' . $page_heading_bg_color . ';border-bottom-color: '.$section_divide_color.';}';
        $custom_styles .= '.page-heading h1, .page-heading h3 {color: ' . $page_heading_text_color . ';}';
        $custom_styles .= '.page-heading .heading-text, .fancy-heading .heading-text {text-align: ' . $page_heading_text_align . ';}';


        /* Thumb hover styling output
        ================================================== */
        $custom_styles .= 'figure.animated-overlay.thumb-media-audio {border-color: ' . $section_divide_color . ';background-color: '.$inner_page_bg_color.';}';
        $custom_styles .= 'figure.animated-overlay figcaption {background-color: ' . $overlay_bg_color . ';}';
        if ( $overlay_opacity_top < 100 || $overlay_opacity_bottom < 100 ) {
        	$overlay_opacity_top = ($overlay_opacity_top < 100 ? '0.' . $overlay_opacity_top : '1.0');
        	$overlay_opacity_bottom = ($overlay_opacity_bottom < 100 ? '0.' . $overlay_opacity_bottom : '1.0');
            $custom_styles .= 'figure.animated-overlay figcaption {
            	background: -webkit-gradient(linear,left top,left bottom,color-stop(25%,rgba(' . $hover_overlay_rgb["red"] . ',' . $hover_overlay_rgb["green"] . ',' . $hover_overlay_rgb["blue"] . ', ' . $overlay_opacity_top .')),to(rgba(' . $hover_overlay_rgb["red"] . ',' . $hover_overlay_rgb["green"] . ',' . $hover_overlay_rgb["blue"] . ', ' . $overlay_opacity_bottom . ')));
            	background: -webkit-linear-gradient(top, rgba(' . $hover_overlay_rgb["red"] . ',' . $hover_overlay_rgb["green"] . ',' . $hover_overlay_rgb["blue"] . ', ' . $overlay_opacity_top .') 25%,rgba(' . $hover_overlay_rgb["red"] . ',' . $hover_overlay_rgb["green"] . ',' . $hover_overlay_rgb["blue"] . ', ' . $overlay_opacity_bottom . ') 100%);
            	background: linear-gradient(to bottom, rgba(' . $hover_overlay_rgb["red"] . ',' . $hover_overlay_rgb["green"] . ',' . $hover_overlay_rgb["blue"] . ', ' . $overlay_opacity_top .') 25%, rgba(' . $hover_overlay_rgb["red"] . ',' . $hover_overlay_rgb["green"] . ',' . $hover_overlay_rgb["blue"] . ', ' . $overlay_opacity_bottom . ') 100%);
            }';
        }
        $custom_styles .= 'figure.animated-overlay figcaption * {color: ' . $overlay_text_color . ';}';
        $custom_styles .= 'figcaption .thumb-info-alt > i, .gallery-item figcaption .thumb-info > i, .gallery-hover figcaption .thumb-info > i {background-color: ' . $overlay_text_color . '; color: ' . $overlay_bg_color . ';}';
        $custom_styles .= 'figcaption .thumb-info .name-divide {background-color: ' . $overlay_text_color . ';}';
		
        // POST STYLES
        $custom_styles .= '.article-divider {background: ' . $section_divide_color . ';}';
        $custom_styles .= '.post-pagination-wrap {background-color:' . $article_np_bg_color . ';}';
        $custom_styles .= '.post-pagination-wrap .next-article > *, .post-pagination-wrap .next-article a, .post-pagination-wrap .prev-article > *, .post-pagination-wrap .prev-article a {color:' . $article_np_text_color . ';}';
        $custom_styles .= '.post-pagination-wrap .next-article a:hover, .post-pagination-wrap .prev-article a:hover, .author-bio a.author-more-link {color: ' . $accent_color . ';}';
        $custom_styles .= '.article-extras {background-color:' . $article_extras_bg_color . ';}';
        $custom_styles .= '.review-bar {background-color:' . $article_review_bar_alt_color . ';}';
        $custom_styles .= '.review-bar .bar, .review-overview-wrap .overview-circle {background-color:' . $article_review_bar_color . ';color:' . $article_review_bar_text_color . ';}';
		$custom_styles .= '.article-extras, .post-info .post-details-wrap {border-color:' . $section_divide_color . ';}';
		$custom_styles .= '.comment-meta .comment-date {color: ' . $link_text_color . ';}';
		$custom_styles .= '.comment-meta-actions a {color: ' . $accent_color . ';}';
		
        
        /* Sidebar styling output
        ================================================== */
        $custom_styles .= '.widget ul li, .widget.widget_lip_most_loved_widget li {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.widget.widget_lip_most_loved_widget li {background: ' . $inner_page_bg_color . '; border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.widget_lip_most_loved_widget .loved-item > span {color: ' . $body_alt_text_color . ';}';
        $custom_styles .= 'ul.wp-tag-cloud li > a {border-color: ' . $section_divide_color . ';color: ' . $link_text_color . ';}';
        $custom_styles .= '.widget .tagcloud a:hover, #footer .widget .tagcloud a:hover, ul.wp-tag-cloud li:hover > a, ul.wp-tag-cloud li:hover:before {background-color: ' . $accent_color . '; border-color: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
        $custom_styles .= 'ul.wp-tag-cloud li:hover:after {border-color: ' . $accent_color . '; background-color: ' . $accent_alt_color . ';}';
        $custom_styles .= '.loved-item .loved-count > i {color: ' . $body_text_color . ';background: ' . $section_divide_color . ';}';
        $custom_styles .= '.subscribers-list li > a.social-circle {color: ' . $secondary_accent_alt_color . ';background: ' . $secondary_accent_color . ';}';
        $custom_styles .= '.subscribers-list li:hover > a.social-circle {color: #fbfbfb;background: ' . $accent_color . ';}';
        $custom_styles .= '.sidebar .widget_categories ul > li a, .sidebar .widget_archive ul > li a, .sidebar .widget_nav_menu ul > li a, .sidebar .widget_meta ul > li a, .sidebar .widget_recent_entries ul > li, .widget_product_categories ul > li a, .widget_layered_nav ul > li a, .widget_display_replies ul > li a, .widget_display_forums ul > li a, .widget_display_topics ul > li a {color: ' . $link_text_color . ';}';
        $custom_styles .= '.sidebar .widget_categories ul > li a:hover, .sidebar .widget_archive ul > li a:hover, .sidebar .widget_nav_menu ul > li a:hover, .widget_nav_menu ul > li.current-menu-item a, .sidebar .widget_meta ul > li a:hover, .sidebar .widget_recent_entries ul > li a:hover, .widget_product_categories ul > li a:hover, .widget_layered_nav ul > li a:hover, .widget_edd_categories_tags_widget ul li a:hover, .widget_display_replies ul li, .widget_display_forums ul > li a:hover, .widget_display_topics ul > li a:hover {color: ' . $link_hover_color . ';}';
        $custom_styles .= '#calendar_wrap caption {border-bottom-color: ' . $secondary_accent_color . ';}';
        $custom_styles .= '.sidebar .widget_calendar tbody tr > td a {color: ' . $secondary_accent_alt_color . ';background-color: ' . $secondary_accent_color . ';}';
        $custom_styles .= '.sidebar .widget_calendar tbody tr > td a:hover {background-color: ' . $accent_color . ';}';
        $custom_styles .= '.sidebar .widget_calendar tfoot a {color: ' . $secondary_accent_color . ';}';
        $custom_styles .= '.sidebar .widget_calendar tfoot a:hover {color: ' . $accent_color . ';}';
        $custom_styles .= '.widget_calendar #calendar_wrap, .widget_calendar th, .widget_calendar tbody tr > td, .widget_calendar tbody tr > td.pad {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.sidebar .widget hr {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.widget ul.flickr_images li a:after, .portfolio-grid li a:after {color: ' . $accent_alt_color . ';}';
		$custom_styles .= '.loved-item:hover .loved-count > svg .stroke {stroke: '.$accent_alt_color.';}';
		$custom_styles .= '.loved-item:hover .loved-count > svg .fill {fill: '.$accent_alt_color.';}';
		$custom_styles .= '.recent-posts-list li {border-color: ' . $section_divide_color . ';}';
		$custom_styles .= '.recent-posts-list li .recent-post-title {color: ' . $body_text_color . ';}';
		$custom_styles .= '.recent-posts-list li .recent-post-title:hover {color: ' . $accent_color . ';}';
        
        /* Portfolio styling output
        ================================================== */
        $custom_styles .= '.fw-row .spb_portfolio_widget .title-wrap {border-bottom-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.masonry-items .portfolio-item-details {background: ' . $alt_bg_color . ';}';
        $custom_styles .= '.masonry-items .blog-item .blog-details-wrap:before {background-color: ' . $alt_bg_color . ';}';
        $custom_styles .= '.share-links > a:hover {color: ' . $accent_color . ';}';
        $custom_styles .= '.portfolio-item.masonry-item .portfolio-item-details {background: ' . $inner_page_bg_color . ';border-color: ' . $section_divide_color . ';}';
		$custom_styles .= '.portfolio-categories, .portfolio-categories li a {border-color: ' . $section_divide_color . ';color:'.$body_text_color.';}';
		$custom_styles .= '.portfolio-categories li:hover a {border-color: ' . $accent_color . ';color:'.$accent_color.';}';
		$custom_styles .= '.item-details time, .item-details .client, .client, .item-details .project {border-color: ' . $section_divide_color . ';}';
		
        /* Blog styling output
        ================================================== */
        $custom_styles .= '#infscr-loading .spinner > div {background: ' . $section_divide_color . ';}';
        $custom_styles .= '.blog-aux-options, .blog-aux-options li a {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.blog-aux-options li a {color:'.$body_text_color.';}';
        $custom_styles .= '.blog-filter-wrap ul.wp-tag-cloud li > a {color: ' . $link_text_color . ';}';
        $custom_styles .= '.blog-aux-options li.selected a {color: ' . $accent_color . ';}';
        $custom_styles .= '.blog-aux-options li.selected a::after {background:'.$inner_page_bg_color.';border-left-color: ' . $section_divide_color . ';border-bottom-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.blog-filter-wrap .aux-list li a {border-color:  ' . $section_divide_color . ';}';
        $custom_styles .= '.blog-filter-wrap .aux-list li:hover a {border-color: ' . $accent_color . ';}';
        $custom_styles .= '.mini-items .blog-details-wrap, .blog-item .blog-item-aux, .mini-items .mini-alt-wrap, .mini-items .mini-alt-wrap .quote-excerpt, .mini-items .mini-alt-wrap .link-excerpt, .masonry-items .blog-item .quote-excerpt, .masonry-items .blog-item .link-excerpt, .timeline-items .standard-post-content .quote-excerpt, .timeline-items .standard-post-content .link-excerpt, .post-info, .author-info-wrap, .body-text .link-pages, .page-content .link-pages, .posts-type-list .recent-post, .standard-items .blog-item .standard-post-content {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.standard-post-date, .timeline {background: ' . $section_divide_color . ';}';
        $custom_styles .= '.timeline-item-content-wrap .blog-details-wrap {background: ' . $inner_page_bg_color . ';border-color: '.$section_divide_color.';}';
        $custom_styles .= '.timeline-item-format-icon-bg {background: ' . $inner_page_bg_color . ';}';
        $custom_styles .= '.timeline-items .format-quote .standard-post-content:before, .timeline-items .standard-post-content.no-thumb:before {border-left-color: ' . $alt_bg_color . ';}';
        $custom_styles .= '.search-item-img .img-holder {background: ' . $alt_bg_color . ';border-color:' . $section_divide_color . ';}';
        $custom_styles .= '.masonry-items .blog-item .masonry-item-wrap {background: ' . $alt_bg_color . ';}';
        $custom_styles .= '.single .pagination-wrap, ul.post-filter-tabs li a {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.mini-item-details, .blog-item-details, .blog-item-details a {color: ' . $link_text_color . ';}';
        $custom_styles .= '.related-item figure {background-color: ' . $secondary_accent_color . '; color: ' . $secondary_accent_alt_color . '}';
        $custom_styles .= '.required {color: #ee3c59;}';
        $custom_styles .= '.post-item-details .comments-likes a i, .post-item-details .comments-likes a span {color: ' . $body_text_color . ';}';
        $custom_styles .= '.posts-type-list .recent-post:hover h4 {color: ' . $link_hover_color . '}';
        $custom_styles .= '.masonry-items .blog-item .details-wrap {border-color: ' . $section_divide_color . ';background-color: ' . $inner_page_bg_color . ';}';
        $custom_styles .= '.instagram-item .inst-overlay .date:before {color: '.$accent_color.';}';;
        $custom_styles .= '.blog-grid-items .blog-item.tweet-item .grid-no-image {border-color: '.$section_divide_color.';background-color: ' . $inner_page_bg_color . ';}';
		$custom_styles .= '.blog-item .side-details .comments-wrapper {border-color: ' . $section_divide_color . ';}';
		$custom_styles .= '.standard-items.alt-styling .blog-item .standard-post-content {background: ' . $inner_page_bg_color . ';}';
		$custom_styles .= '.standard-items.alt-styling .blog-item.quote .standard-post-content, .mini-items .blog-item.quote .mini-alt-wrap {background: ' . $body_text_color . ';color: ' . $inner_page_bg_color . ';}';
		$custom_styles .= '#respond .form-submit input[type=submit] {background-color: '.$accent_color.';color: '.$accent_alt_color.';}';
		$custom_styles .= '#respond .form-submit input[type=submit]:hover {background-color: '.$secondary_accent_color.';color: '.$secondary_accent_alt_color.';}';
		$custom_styles .= '.post-details-wrap .tags-wrap, .post-details-wrap .comments-likes {border-color: ' . $section_divide_color . ';}';
		$custom_styles .= '.sticky-post-icon {color: '.$accent_color.';}';
		$custom_styles .= '.timeline-items::before {background: '.$section_divide_color.';}';
		$custom_styles .= '.timeline-item-format-icon, .timeline-item-format-icon::before {border-color: '.$section_divide_color.';}';
		$custom_styles .= '.load-more-btn, .blog-load-more-pagination #infscr-loading, .products-load-more-pagination #infscr-loading, .portfolio-load-more-pagination #infscr-loading {background: '.$alt_bg_color.';}';
		$custom_styles .= '.blog-item .author a.tweet-link, .blog-item-aux .date:before {color: '.$accent_color.';}';
		$custom_styles .= '#comments-list li .comment-wrap {border-color: ' . $section_divide_color . ';}';
		$custom_styles .= '.side-post-info .post-share .share-link {color: '.$accent_color.';}';
        
        /* Shortcode styling output
        ================================================== */
        $custom_styles .= '.sf-button.accent {color: ' . $accent_alt_color . '; background-color: ' . $accent_color . ';border-color: ' . $accent_color . ';}';
        $custom_styles .= '.sf-button.sf-icon-reveal.accent {color: ' . $accent_alt_color . '!important; background-color: ' . $accent_color . '!important;}';
        $custom_styles .= 'a.sf-button.stroke-to-fill {color: ' . $link_text_color . ';}';
        $custom_styles .= '.sf-button.accent.bordered .sf-button-border {border-color: ' . $accent_color . ';}';
        $custom_styles .= 'a.sf-button.bordered.accent {color: ' . $accent_color . ';border-color: ' . $accent_color . ';}';
        $custom_styles .= 'a.sf-button.bordered.accent:hover {color: ' . $accent_alt_color . ';}';
        $custom_styles .= 'a.sf-button.rotate-3d span.text:before {color: ' . $accent_alt_color . '; background-color: ' . $accent_color . ';}';
        $custom_styles .= '.sf-button.accent:hover, .sf-button.bordered.accent:hover {background-color: ' . $secondary_accent_color . ';border-color: ' . $secondary_accent_color . ';color: ' . $secondary_accent_alt_color . ';}';
        $custom_styles .= 'a.sf-button, a.sf-button:hover, #footer a.sf-button:hover {background-image: none;color: #fff;}';
        $custom_styles .= 'a.sf-button.white:hover {color: #222!important;}';
        $custom_styles .= 'a.sf-button.transparent-dark {color: ' . $body_text_color . '!important;}';
        $custom_styles .= 'a.sf-button.transparent-light:hover, a.sf-button.transparent-dark:hover {color: ' . $accent_color . '!important;}';
        $custom_styles .= '.title-wrap a.sf-button:hover {color: ' . $accent_color . '!important;}';
        $custom_styles .= '.carousel-wrap a.carousel-prev, .carousel-wrap a.carousel-next {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.sf-icon-cont {border-color: ' . $icon_container_border_color . ';}';
        $custom_styles .= '.sf-icon-cont:hover {border-color: ' . $icon_container_hover_border_color . ';}';
        $custom_styles .= '.sf-icon-box-animated-alt.animated-stroke-style {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.sf-icon-box-animated .front {background: ' . $alt_bg_color . ';}';
        $custom_styles .= '.sf-icon-box-animated .front h3 {color: ' . $body_text_color . ';}';
        $custom_styles .= '.sf-icon-box-animated .back {background: ' . $accent_color . ';}';
        $custom_styles .= '.sf-icon-box-animated .back, .sf-icon-box-animated .back h3 {color: ' . $accent_alt_color . ';}';
       	$custom_styles .= '.spb_icon_box_grid .spb_icon_box .divider-line {background-color: '.$accent_color.';}';
        $custom_styles .= '.spb_icon_box_grid .spb_icon_box:hover h3, .spb_icon_box_grid .spb_icon_box:hover .grid-icon-wrap i.sf-icon {color: ' . $accent_color . ';}';
        $custom_styles .= '.spb_icon_box_grid .spb_icon_box:hover .outline-svg svg path {stroke: '.$accent_color.';}';
        $custom_styles .= '.borderframe img {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= 'span.dropcap3 {background: #000;color: #fff;}';
        $custom_styles .= '.spb_divider, .spb_divider.go_to_top_icon1, .spb_divider.go_to_top_icon2, .testimonials > li, .tm-toggle-button-wrap, .tm-toggle-button-wrap a, .portfolio-details-wrap, .spb_divider.go_to_top a, .widget_search form input {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.spb_divider.go_to_top_icon1 a, .spb_divider.go_to_top_icon2 a {background: ' . $inner_page_bg_color . ';}';
        $custom_styles .= '.divider-wrap h3.divider-heading:before, .divider-wrap h3.divider-heading:after {background: ' . $section_divide_color . ';}';
        $custom_styles .= '.spb_tabs .ui-tabs .ui-tabs-panel, .spb_content_element .ui-tabs .ui-tabs-nav, .ui-tabs .ui-tabs-nav li {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.spb_tabs .ui-tabs .ui-tabs-panel, .ui-tabs .ui-tabs-nav li.ui-tabs-active a {background: ' . $inner_page_bg_color . '!important;}';
        $custom_styles .= '.spb_tabs .tab-content {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.tabs-type-dynamic .nav-tabs li.active a, .tabs-type-dynamic .nav-tabs li a:hover {background:' . $accent_color . ';border-color:' . $accent_color . '!important;color: ' . $accent_color . ';}';
        $custom_styles .= '.spb_tabs .nav-tabs li a, .spb_tour .nav-tabs li a {background-color: '.$alt_bg_color.';border-color: '.$section_divide_color.'!important;}';
        $custom_styles .= '.spb_tabs .nav-tabs li:hover a, .spb_tour .nav-tabs li:hover a, .spb_tabs .nav-tabs li.active a, .spb_tour .nav-tabs li.active a {background: '.$inner_page_bg_color.';border-color: '.$section_divide_color.'!important;color: ' . $body_text_color . '!important;}';
        $custom_styles .= '.spb_tabs .nav-tabs li.active a span:after {background-color: ' . $accent_color . ';}';
        $custom_styles .= '.spb_tabs .nav-tabs li.active a {border-bottom-color: ' . $inner_page_bg_color . '!important;}';
        $custom_styles .= '.spb_tour .nav-tabs li.active a {border-right-color: ' . $inner_page_bg_color . '!important;}';
        $custom_styles .= '@media only screen and (max-width: 479px) {.spb_tour .nav-tabs li.active a {border-right-color: '.$section_divide_color.'!important;}}';
        $custom_styles .= '.spb_tour .tab-content {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.spb_accordion .spb_accordion_section, .spb_accordion .ui-accordion .ui-accordion-content {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.spb_accordion .spb_accordion_section > h4.ui-state-active a, .toggle-wrap .spb_toggle.spb_toggle_title_active {color: '.$body_text_color.'!important;}';
        $custom_styles .= '.spb_accordion .spb_accordion_section > h4.ui-state-default {background-color: '.$alt_bg_color.';}';
        $custom_styles .= '.spb_accordion .spb_accordion_section > h4.ui-state-active, .spb_accordion .spb_accordion_section > h4.ui-state-hover {background-color: '.$inner_page_bg_color.';}';
        $custom_styles .= '.spb_accordion_section > h4:hover .ui-icon:before {border-color: ' . $accent_color . ';}';
        $custom_styles .= '.spb_accordion .spb_accordion_section > h4.ui-state-active a:after {color: ' . $accent_color . ';}';
        $custom_styles .= '.toggle-wrap .spb_toggle, .spb_toggle_content {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.toggle-wrap .spb_toggle {background-color: '.$alt_bg_color.';}';
        $custom_styles .= '.toggle-wrap .spb_toggle_title_active {border-color: ' . $section_divide_color . '!important;background-color: '.$inner_page_bg_color.';}';
        $custom_styles .= '.toggle-wrap .spb_toggle:hover {color: ' . $accent_color . ';}';
        $custom_styles .= '.ui-accordion h4.ui-accordion-header .ui-icon {color: ' . $body_text_color . ';}';
        $custom_styles .= '.standard-browser .ui-accordion h4.ui-accordion-header.ui-state-active:hover a, .standard-browser .ui-accordion h4.ui-accordion-header:hover .ui-icon {color: ' . $accent_color . ';}';
        $custom_styles .= 'blockquote.pullquote {border-color: ' . $accent_color . ';}';
        $custom_styles .= '.borderframe img {border-color: #eeeeee;}';
        $custom_styles .= '.spb_box_content .spb-bg-color-wrap.whitestroke {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= 'ul.member-contact li a:hover {color: ' . $link_hover_color . ';}';
        $custom_styles .= '.testimonials.carousel-items li .testimonial-text {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.testimonials.carousel-items li .testimonial-text:after {border-top-color: ' . $alt_bg_color . ';}';
        $custom_styles .= '.horizontal-break {background-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.horizontal-break.bold {background-color: ' . $body_text_color . ';}';
        $custom_styles .= '.progress .bar {background-color: ' . $accent_color . ';}';
        $custom_styles .= '.progress.standard .bar {background: ' . $accent_color . ';}';
        $custom_styles .= '.progress-bar-wrap .progress-value {color: ' . $accent_color . ';}';
        $custom_styles .= '.sf-share-counts {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.sf-share-counts > a {border-color: ' . $section_divide_color . ';}';
        $custom_styles .= '.sf-share-counts .share-text h2, .sf-share-counts .share-text span {color: ' . $accent_color . ';}';
        $custom_styles .= '.mejs-controls .mejs-time-rail .mejs-time-current {background: ' . $accent_color . '!important;}';
        $custom_styles .= '.mejs-controls .mejs-time-rail .mejs-time-loaded {background: ' . $accent_alt_color . '!important;}';
        $custom_styles .= '.pt-banner h6 {color: ' . $accent_alt_color . ';}';
        $custom_styles .= '.pinmarker-container a.pin-button:hover {background: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
        $custom_styles .= '.directory-item-details .item-meta {color: ' . $body_alt_text_color . ';}';
        $custom_styles .= '.team-member-item-wrap {background: ' . $inner_page_bg_color . ';}';
		$custom_styles .= '.team-member-details-wrap {border-color: ' . $section_divide_color . ';}';
		$custom_styles .= '.team-member-divider {background: ' . $accent_color . ';}';
		$custom_styles .= '.team-member-details-wrap .team-member-position {color: '.$link_text_color.';}';
		$custom_styles .= '.testimonials.carousel-items li .testimonial-text, .recent-post figure {background-color: ' . $alt_bg_color . ';}';
		$custom_styles .= '.masonry-items li.testimonial .testimonial-text {background-color: ' . $accent_color . ';}';
		$custom_styles .= '.masonry-items li.testimonial.has-cite .testimonial-text::after {border-top-color: ' . $accent_color . ';}';
		$custom_styles .= '.product-reviews.masonry-items li.testimonial .testimonial-text {background-color: ' . $section_divide_color . ';}';
		$custom_styles .= '.product-reviews.masonry-items li.testimonial.has-cite .testimonial-text::after {border-top-color: ' . $section_divide_color . ';}';
		$custom_styles .= '.spb_pricing_table .sf-pricing-column {border-color: ' . $section_divide_color . ';}';
		$custom_styles .= '.spb_pricing_table .sf-pricing-column.highlight {border-color: ' . $accent_color . ';}';
		$custom_styles .= '.sf-pricing-column .sf-pricing-name .divide {background-color: ' . $accent_color . ';}';
		$custom_styles .= '.sf-pricing-column.highlight .sf-pricing-name h6, .sf-pricing-column.highlight .sf-pricing-name .sf-pricing-price {color: ' . $accent_color . ';}';
		$custom_styles .= '.sf-pricing-column .sf-pricing-tag::before {background-color: ' . $accent_color . ';color: ' . $accent_alt_color . ';}';
		$custom_styles .= '.faq-item, .faq-item h5 {border-color: ' . $section_divide_color . ';}';
		
        /* Content slider styling output
        ================================================== */
        $custom_styles .= '.spb_row_container .spb_tweets_slider_widget .spb-bg-color-wrap, .spb_tweets_slider_widget .spb-bg-color-wrap {background: ' . $tweet_slider_bg . ';}';
        $custom_styles .= '.spb_tweets_slider_widget .tweet-text, .spb_tweets_slider_widget .twitter_intents a {color: ' . $tweet_slider_text . ';}';
        $custom_styles .= '.spb_tweets_slider_widget .twitter_intents a:hover {color: ' . $link_hover_color . ';}';
        $custom_styles .= '.spb_tweets_slider_widget .tweet-text a {color: ' . $tweet_slider_link . ';}';
        $custom_styles .= '.spb_tweets_slider_widget .tweet-text a:hover, .spb_tweets_slider_widget .twitter_intents a:hover {color: ' . $tweet_slider_link_hover . ';}';
       	$custom_styles .= '.spb_tweets_slider_widget .lSSlideOuter .lSPager.lSpg > li a {background-color: ' . $tweet_slider_text . ';}';
        $custom_styles .= '.spb_testimonial_slider_widget .spb-bg-color-wrap {background: ' . $testimonial_slider_bg . ';}';
        $custom_styles .= '.spb_testimonial_slider_widget .heading-wrap h3.spb-center-heading, .spb_testimonial_slider_widget .testimonial-text, .spb_testimonial_slider_widget cite, .spb_testimonial_slider_widget .testimonial-icon {color: ' . $testimonial_slider_text . ';}';
        $custom_styles .= '.spb_testimonial_slider_widget .heading-wrap h3.spb-center-heading {border-bottom-color: ' . $testimonial_slider_text . ';}';
		$custom_styles .= '.content-slider .flex-direction-nav .flex-next:before, .content-slider .flex-direction-nav .flex-prev:before {background-color: ' . $section_divide_color . ';color: '.$body_text_color.';}';
		$custom_styles .= '.spb_tweets_slider_widget .heading-wrap h3.spb-center-heading {color: ' . $tweet_slider_text . ';border-bottom-color: ' . $tweet_slider_text . ';}';
		$custom_styles .= '.spb_tweets_slider_widget .tweet-icon i {background: ' . $accent_color . ';}';
		$custom_styles .= '.spb_testimonial_carousel_widget .carousel-wrap > a {border-color: ' . $section_divide_color . ' ;}'; 
		
		
        /* Footer styling output
        ================================================== */
        $custom_styles .= '#footer {background: ' . $footer_bg_color . ';}';
        $custom_styles .= '#footer.footer-divider {border-top-color: ' . $footer_border_color . ';}';
        $custom_styles .= '#footer, #footer p, #footer h3.spb-heading {color: ' . $footer_text_color . ';}';
        $custom_styles .= '#footer h3.spb-heading span {border-bottom-color: ' . $footer_text_color . ';}';
        $custom_styles .= '#footer a {color: ' . $footer_link_color . ';}';
        $custom_styles .= '#footer a:hover {color: ' . $footer_link_hover_color . ';}';
        $custom_styles .= '#footer ul.wp-tag-cloud li > a {border-color: ' . $footer_border_color . ';}';
        $custom_styles .= '#footer .widget ul li, #footer .widget_categories ul, #footer .widget_archive ul, #footer .widget_nav_menu ul, #footer .widget_recent_comments ul, #footer .widget_meta ul, #footer .widget_recent_entries ul, #footer .widget_product_categories ul {border-color: ' . $footer_border_color . ';}';
        $custom_styles .= '#copyright {background-color: ' . $copyright_bg_color . ';border-top-color: ' . $footer_border_color . ';}';
        $custom_styles .= '#copyright p, #copyright .text-left, #copyright .text-right {color: ' . $copyright_text_color . ';}';
        $custom_styles .= '#copyright a {color: ' . $copyright_link_color . ';}';
        $custom_styles .= '#copyright a:hover, #copyright nav .menu li a:hover {color: ' . $copyright_link_hover_color . ';}';
        $custom_styles .= '#copyright nav .menu li {border-left-color: ' . $footer_border_color . ';}';
        $custom_styles .= '#footer .widget_calendar #calendar_wrap, #footer .widget_calendar th, #footer .widget_calendar tbody tr > td, #footer .widget_calendar tbody tr > td.pad {border-color: ' . $footer_border_color . ';}';
        $custom_styles .= '.widget input[type="email"] {background: #f7f7f7; color: #999}';
        $custom_styles .= '#footer .widget hr {border-color: ' . $footer_border_color . ';}';
        
        
        /* Newsletter bar styling output
        ================================================== */
        $custom_styles .= '#sf-newsletter-bar, .layout-boxed #sf-newsletter-bar > .container {background-color: ' . $newsletter_bar_bg_color . ';}';
		$custom_styles .= '#sf-newsletter-bar h3.sub-text {color: ' . $newsletter_bar_text_color . ';}';
		$custom_styles .= '#sf-newsletter-bar .sub-code > form input[type=submit], #sf-newsletter-bar .sub-code > form input[type="text"], #sf-newsletter-bar .sub-code > form input[type="email"] {border-color: '.$newsletter_bar_text_color.';color: '.$newsletter_bar_text_color.';}';
		$custom_styles .= '#sf-newsletter-bar .sub-code > form input[type=submit]:hover {border-color: '.$newsletter_bar_link_hover_color.';color: '.$newsletter_bar_link_hover_color.';}';
		$custom_styles .= '#sf-newsletter-bar .sub-close {color: '.$newsletter_bar_text_color.';}';
		$custom_styles .= '#sf-newsletter-bar .sub-close:hover {color: '.$newsletter_bar_link_hover_color.';}';
		$custom_styles .= '#sf-newsletter-bar ::-webkit-input-placeholder {color:' . $newsletter_bar_text_color . '!important;}';
        $custom_styles .= '#sf-newsletter-bar :-moz-placeholder {color:' . $newsletter_bar_text_color . '!important;}';
        $custom_styles .= '#sf-newsletter-bar ::-moz-placeholder {color:' . $newsletter_bar_text_color . '!important;}';
        $custom_styles .= '#sf-newsletter-bar :-ms-input-placeholder {color:' . $newsletter_bar_text_color . '!important;}';


        /* WooCommerce styling output
        ================================================== */
        if ( sf_woocommerce_activated() ) {
        
            // Badges
			$custom_styles .= '.woocommerce .wc-new-badge {background-color:'.$new_tag_color.';}';
			$custom_styles .= '.woocommerce .free-badge, .woocommerce span.onsale {background-color:'.$sale_tag_color.';}';
			$custom_styles .= '.woocommerce .out-of-stock-badge {background-color:'.$oos_tag_color.';}';
			
			// Product Hover Overlay
			if ( is_array($hover_overlay_rgb) ) {
			$custom_styles .= '.product figure .cart-overlay .add-to-cart-wrap, .product figure .cart-overlay .jckqvBtn {background: rgba(' . $hover_overlay_rgb["red"] . ',' . $hover_overlay_rgb["green"] . ',' . $hover_overlay_rgb["blue"] . ', 0.9)}';
			}
			$custom_styles .= '.cart-overlay .add-to-cart-wrap > a, .product figure .cart-overlay .jckqvBtn {color: ' . $cart_overlay_text_color . ';}';
			$custom_styles .= '.cart-overlay .add-to-cart-wrap > a:hover, .product figure .cart-overlay .jckqvBtn:hover {color: ' . $cart_overlay_text_hover_color . ';}';
			$custom_styles .= '.cart-overlay .yith-wcwl-add-to-wishlist a:hover {color:'.$accent_color.';}';
			
			// Other
			$custom_styles .= '.sf-mobile-shop-filters-link {color:'.$body_text_color.';}';
			$custom_styles .= '.woocommerce div.product .stock {color:'.$accent_color.';}';
            $custom_styles .= '.price ins {color:'.$sale_tag_color.';}';
            $custom_styles .= '.woocommerce div.product p.stock.out-of-stock {color:'.$oos_tag_color.';}';
            $custom_styles .= '.woocommerce form .form-row .required {color:'.$accent_color.';}';
            $custom_styles .= '.woocommerce form .form-row.woocommerce-invalid .select2-container, .woocommerce form .form-row.woocommerce-invalid input.input-text, .woocommerce form .form-row.woocommerce-invalid select, .woocommerce .woocommerce-info, .woocommerce-page .woocommerce-info {border-color:'.$accent_color.';}';
            $custom_styles .= '.woocommerce .woocommerce-info, .woocommerce-page .woocommerce-info, .woocommerce .woocommerce-message, .woocommerce-page .woocommerce-message, .woocommerce .woocommerce-error, .woocommerce-page .woocommerce-error {color: ' . $body_text_color . ';}';
            $custom_styles .= '.woocommerce .woocommerce-message a.button {color: '.$link_text_color.';}';
            $custom_styles .= '.woocommerce .woocommerce-message a.button:hover {color: '.$link_hover_color.';}';
            $custom_styles .= '.woocommerce .woocommerce-info a:hover, .woocommerce-page .woocommerce-info a:hover {color: '.$accent_color.';}';
            $custom_styles .= '.woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a {color: '.$body_alt_text_color.'}';
            $custom_styles .= '.woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li:hover a {color: '.$section_divide_color.'}';
            $custom_styles .= '.woocommerce .help-bar, .woo-aux-options, .woocommerce nav.woocommerce-pagination ul li span.current, .modal-body .comment-form-rating, ul.checkout-process, #billing .proceed, ul.my-account-nav > li, .woocommerce #payment, .woocommerce-checkout p.thank-you, .woocommerce .order_details, .woocommerce-page .order_details, #product-accordion .panel, .woocommerce form .form-row input.input-text, .woocommerce .coupon input.input-text, .woocommerce table.shop_table, .woocommerce-page table.shop_table, .mini-list li, .woocommerce div.product .woocommerce-tabs .panel, .woocommerce a.button.wc-backward, #yith-wcwl-form .product-add-to-cart > .button, .woocommerce .coupon input.input-text, .woocommerce-cart table.cart td.actions .coupon .input-text, .woocommerce table.shop_table tbody th, .woocommerce table.shop_table tfoot td, .woocommerce table.shop_table tfoot th { border-color: ' . $section_divide_color . ' ;}';
            $custom_styles .= '.bag-buttons a.sf-button.bag-button, .bag-buttons a.sf-button.wishlist-button {border-color: '.$section_divide_color.';}';
            $custom_styles .= '.fw-summary-extras, .summary-top {border-color:' . $section_divide_color . ';}';
            $custom_styles .= '.woocommerce-account p.myaccount_address, .woocommerce-account .page-content h2, p.no-items, #order_review table.shop_table, #payment_heading, .returning-customer a, .woocommerce #payment ul.payment_methods, .woocommerce-page #payment ul.payment_methods, .woocommerce .coupon {border-bottom-color: ' . $section_divide_color . ';}';
            $custom_styles .= 'p.no-items, .woocommerce-page .cart-collaterals, .woocommerce .cart_totals table tr.cart-subtotal, .woocommerce .cart_totals table tr.order-total, .woocommerce table.shop_table td, .woocommerce-page table.shop_table td, .woocommerce #payment div.form-row, .woocommerce-page #payment div.form-row {border-top-color: ' . $section_divide_color . ';}';
            $custom_styles .= '.product figcaption a.product-added {color: ' . $accent_alt_color . ';}';
            $custom_styles .= 'ul.products li.product a.quick-view-button, .woocommerce .quantity, .woocommerce-page .quantity, .woocommerce .cart .yith-wcwl-add-to-wishlist a, .my-account-login-wrap .login-wrap form.login p.form-row input[type=submit], .products .product.buy-btn-visible > .product-actions .add-to-cart-wrap > a {border-color: ' . $section_divide_color . ';}';
            $custom_styles .= '.shop-actions > a:hover .addtocart-svg .stroke, .shop-actions a:hover .wishlist-svg .stroke {stroke: ' . $accent_color . ';}';
            $custom_styles .= '.shop-actions a:hover .wishlist-svg .fill {fill: ' . $accent_color . ';}';
            $custom_styles .= '.woocommerce p.cart a.add_to_cart_button:hover, .woocommerce .single_add_to_cart_button.button.alt:hover, .woocommerce button.single_add_to_cart_button.button.alt:hover {background: ' . $secondary_accent_color . '; color: ' . $accent_color . ' ;}';
            $custom_styles .= '.woocommerce .coupon-input:before {color:' . $input_text_color . ';}';
            $custom_styles .= '.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce .coupon input.apply-coupon:hover, .woocommerce .shipping-calculator-form .update-totals-button button:hover, .woocommerce .quantity .plus:hover, .woocommerce .quantity .minus:hover, .add_review a:hover, .lost_reset_password p.form-row input[type=submit]:hover, .track_order p.form-row input[type=submit]:hover, .woocommerce.widget .buttons a:hover, .woocommerce .wishlist_table tr td.product-add-to-cart a:hover, .woocommerce input[name="apply_coupon"]:hover, #wew-submit-email-to-notify:hover, .woocommerce input[name="save_account_details"]:hover, .woocommerce-checkout .login input[type=submit]:hover, .woocommerce input[name="apply_coupon"]:hover, .woocommerce a.button.wc-backward:hover, #yith-wcwl-form .product-add-to-cart > .button:hover, .my-account-login-wrap .login-wrap form.login p.form-row input[type=submit]:hover {background-color: '.$accent_color.'; color: '.$accent_alt_color.';}';
            $custom_styles .= '.woocommerce .cart button.add_to_cart_button.product-added, .woocommerce .single_add_to_cart_button:disabled[disabled] {background-color: '.$accent_color.'!important; color: '.$accent_alt_color.'!important;}';
            $custom_styles .= '.woocommerce table.shop_table.cart td.product-name a, .woocommerce table.shop_table tr td.product-remove .remove {color: '.$body_text_color.';}';
            $custom_styles .= '.woocommerce table.shop_table.cart td.product-name a:hover, .wishlist_table tr td.product-stock-status span.wishlist-in-stock {color: '.$accent_color.';}';
            $custom_styles .= '.woocommerce table.shop_table tr td.product-remove a.remove {color: '.$body_text_color.'!important;}';
            $custom_styles .= '.woocommerce table.shop_table tr td.product-remove a.remove:hover {color: '.$accent_color.'!important;}';
            $custom_styles .= '.woocommerce .wishlist_table tr td.product-add-to-cart a {border-color: '.$accent_color.';color: '.$accent_color.';}';
            $custom_styles .= '.woocommerce #account_details .login, .woocommerce #account_details .login h4.lined-heading span, .my-account-login-wrap .login-wrap, .my-account-login-wrap .login-wrap h4.lined-heading span, .woocommerce div.product .cart table div.quantity {background: ' . $alt_bg_color . ';}';
            $custom_styles .= '.woocommerce .address .edit-address:hover, .my_account_orders td.order-number a:hover, .product_meta a.inline:hover { border-bottom-color: ' . $accent_color . ';}';
            $custom_styles .= '.woocommerce .order-info, .woocommerce .order-info mark, .woocommerce a.button.checkout-button {background: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
            $custom_styles .= '.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content {background: ' . $alt_bg_color . ';}';
            $custom_styles .= '.woocommerce .widget_price_filter .ui-slider-horizontal .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle {background: ' . $h3_text_color . ';}';
            $custom_styles .= '.woocommerce .widget_price_filter .price_slider_amount .button {color: ' . $accent_color . ';}';
            $custom_styles .= '.inner-page-wrap.full-width-shop .sidebar[class*="col-sm"] {background-color:' . $inner_page_bg_color . ';}';
            $custom_styles .= '.woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price {color: ' . $body_text_color . ';}';
            $custom_styles .= '.preview-slider-item-wrapper .product-details span.price del::after {background-color: ' . $body_text_color . ';}';
            $custom_styles .= '.woocommerce div.product .cart .variations td.label label {color: ' . $body_text_color . ';}';
            $custom_styles .= '.woocommerce div.product .woocommerce-tabs ul.tabs li {background-color:' . $section_divide_color . ';}';
            $custom_styles .= '.woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce div.product .woocommerce-tabs ul.tabs li.active::after {background-color: ' . $inner_page_bg_color . ';}';
            $custom_styles .= '.woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce div.product .woocommerce-tabs ul.tabs li.active {border-color:' . $section_divide_color . ';}';
            $custom_styles .= '.woocommerce #reviews #comments ol.commentlist li .comment-details .date {color: ' . $link_text_color . ';}';
			$custom_styles .= '.woocommerce #review_form #respond .form-submit input {background-color:' . $accent_color . ';color: ' . $accent_button_text_color . ';}';
			$custom_styles .= ' .woocommerce #review_form #respond .form-submit input:hover {color: ' . $accent_alt_color . ';}';
			$custom_styles .= '.woocommerce .quantity .minus, .woocommerce .quantity input.qty, .woocommerce .quantity .plus, .woocommerce div.product .cart .variations select, .woocommerce .quantity .qty-plus, .woocommerce .quantity .qty-minus, .woocommerce .quantity .qty-adjust {border-color:' . $section_divide_color . ';}';
			$custom_styles .= '.woocommerce .quantity .qty-plus::before, #jckqv_summary .quantity .qty-plus::before {border-bottom-color:' . $section_divide_color . ';}';
			$custom_styles .= '.woocommerce .quantity .qty-plus:hover::before, #jckqv_summary .quantity .qty-plus:hover::before {border-bottom-color:' . $accent_color . ';}';
			$custom_styles .= '.woocommerce .quantity .qty-minus::before, #jckqv_summary .quantity .qty-minus::before {border-top-color:' . $section_divide_color . ';}';
			$custom_styles .= '.woocommerce .quantity .qty-minus:hover::before, #jckqv_summary .quantity .qty-minus:hover::before {border-top-color:' . $accent_color . ';}';
			$custom_styles .= '.woocommerce .cart .yith-wcwl-divide {background-color:' . $section_divide_color . ';}';
			$custom_styles .= '.woocommerce table.cart thead th {border-color:' . $section_divide_color . ';}';
			$custom_styles .= '.woocommerce .shipping-calculator-form #calc_shipping_country_field:before {border-top-color:' . $section_divide_color . ';}';
			$custom_styles .= '.woocommerce button[type="submit"], .woocommerce input.button, .woocommerce a.button, .woocommerce-cart table.cart input.button {background:'.$accent_color.';color:'.$accent_alt_color.';}';
			$custom_styles .= '.woocommerce button[type="submit"]:hover, .woocommerce input.button:hover, .woocommerce a.button:hover, .woocommerce-cart table.cart input.button:hover {background-color:'.$secondary_accent_color.';color:'.$accent_alt_color.';}';				
			$custom_styles .= '.woocommerce table.shop_attributes th, .woocommerce table.shop_attributes td {border-color:' . $section_divide_color . ';}';
			$custom_styles .= '.summary .product_meta {border-color:' . $section_divide_color . ';}';
			$custom_styles .= '.woocommerce .button.checkout-button:hover, .review-order-wrap #payment #place_order {background: '.$secondary_accent_color.'; color: '.$secondary_accent_alt_color.';}';
			$custom_styles .= '.review-order-wrap #payment #place_order {background-color:' . $accent_color . '; color: ' . $accent_button_text_color . ';}';
			$custom_styles .= '.review-order-wrap #payment #place_order:hover {color: ' . $accent_alt_color . ';}';
			$custom_styles .= '.woocommerce #payment div.payment_box {background: ' . $section_divide_color . '; color: ' . $body_text_color . ';}';
			$custom_styles .= '.woocommerce-checkout #payment div.payment_box:before {border-bottom-color:' . $section_divide_color . ';}';
			$custom_styles .= '.woocommerce .checkout #ship-to-different-address {border-color:' . $section_divide_color . ';}';
			$custom_styles .= '#jckqv_summary > h1 {border-bottom-color: '.$section_divide_color.';}';
			$custom_styles .= '#jckqv .quantity .qty {border-color: '.$section_divide_color.';}';
			$custom_styles .= '.woocommerce .widget_layered_nav_filters ul li a:before {color: '.$accent_alt_color.';}';
			$custom_styles .= '.woo-thankyou-details .payment-wrap, .woo-thankyou-main .order_details {border-color: '.$section_divide_color.';}';
			$custom_styles .= '.woocommerce table.my_account_orders thead th {border-color: '.$section_divide_color.';}';
			$custom_styles .= '.woocommerce-MyAccount-navigation li {border-color: '.$section_divide_color.';}';
			$custom_styles .= '.woocommerce-MyAccount-navigation li.is-active a, .woocommerce-MyAccount-navigation li a:hover {color: '.$body_text_color.';}';
			$custom_styles .= '.woocommerce table.my_account_orders .order-actions .view, .woocommerce table.woocommerce-MyAccount-downloads .download-actions a.button {background-color: transparent; color: '.$link_text_color.';}';
			$custom_styles .= '.my-address-wrap > h4, .customer-orders-wrap > h4, .myaccount_user h4 {border-color: '.$section_divide_color.';}';
			$custom_styles .= '.product-fw-split div.product div.summary, .product-fw-split .fw-summary-extras {border-color: '.$section_divide_color.';}';
			$custom_styles .= '.product-cat-info a.shop-now-link {color: '.$accent_color.';}';
			$custom_styles .= '.product-cat-info a.shop-now-link:hover {color: '.$link_hover_color.';}';
			$custom_styles .= '.product-fw-split div.product div.images, .product-fw-split div.product div.summary {background-color:' . $alt_bg_color . '; }';
			$custom_styles .= '.woocommerce-cart table.cart input[name="apply_coupon"], .woocommerce .shipping-calculator-form button[type="submit"], .woocommerce .cart input.button[name="update_cart"] { background-color: transparent;border-color: '.$accent_color.';color: '.$accent_color.';}';
			$custom_styles .= '.woocommerce-cart table.cart input[name="apply_coupon"]:hover, .woocommerce .shipping-calculator-form button[type="submit"]:hover, .woocommerce .cart input.button[name="update_cart"]:hover {background-color: '.$accent_color.';color: '.$accent_alt_color.';}';
			$custom_styles .= '.woocommerce #customer_login.col2-set .col-1 {border-color: '.$section_divide_color.';}';
			
			$custom_styles .= '.sf-share-counts a.sf-share-email:hover {background-color: '.$accent_color.'; border-color: '.$accent_color.'; color: '.$accent_alt_color.';}';

			if ( $product_imagewidth_override ) {
				$product_imagewidth = $sf_options['productdetail_imagewidth'];
				$product_fw_imagewidth = $product_imagewidth - 2;
				$product_summary_width = 98 - $product_imagewidth;
				
				$custom_styles .= '@media only screen and (min-width: 768px) {';
				$custom_styles .= '.woocommerce div.product div.images {width: '.$product_imagewidth.'%;}';
				$custom_styles .= '.woocommerce.product-fw-split div.product div.images {width: '.$product_fw_imagewidth.'%;}';
				$custom_styles .= '.woocommerce div.product div.summary {width: '.$product_summary_width.'%;}';
				$custom_styles .= '}';
			}
			
			if ( $product_filter == 1 ) {
				$custom_styles .= '.sf-mobile-shop-filters-link {display: block;}';
			} else if ( $product_filter != "mobile-only" ) {
				$custom_styles .= '.sf-mobile-shop-filters-link {display: none!important;}';
				$custom_styles .= '.woo-aux-options .woocommerce-count-wrap {border-left-width: 0; padding-left: 0; margin-left: 0;}';
			}
			
			$custom_styles .= '.preview-slider-item-wrapper {border-color: '.$section_divide_color.';}';
			$custom_styles .= '.woocommerce .products .preview-slider-item-wrapper > figure {background-color: '.$preview_slider_bg_color.';}';
			$custom_styles .- '.sf-mobile-shop-filters-link.filters-open::after {background-color: '.$inner_page_bg_color.';border-color: '.$section_divide_color.';}';
		}
		
		if ( class_exists( 'Iconic_Woo_Attribute_Swatches' ) ) {
			$custom_styles .= '.variations_form tr td.value::after {display: none;}';
		}
		
		/* WooCommerce Quickview overrides output
		================================================== */
		$custom_styles .= '.woocommerce .jckqvBtn {
			display: inline-block;
			float: none;
		}
		.woocommerce .price + .jckqvBtn {
			width: 80%;
			display: block;
			margin: 0 10% 10px;
		}
		#jckqv {
			overflow: hidden;
			font-family: inherit;
			padding: 0;
			border-radius: 4px;
		}
		#jckqv .added_to_cart.wc-forward {
			display: none!important;
		}
		#jckqv #addingToCart {
			display: none!important;
		}
		#jckqv h1, #jckqv p {
			font-family: inherit;
			line-height: inherit;
		}
		#jckqv_images_wrap {
			width: 50%;
			margin: 0;
		}
		#jckqv #jckqv_thumbs {
			display: none!important;
		}
		#jckqv .slick-list {
			border-radius: 4px 0 0 4px;
		}
		#jckqv_summary {
			width: 50%;
			padding: 15px 30px 30px;
			background: transparent;
			position: relative;
		}
		#jckqv_summary > h1 {
			font-size: 24px!important;
			border-bottom: 1px solid #e3e3e3;
			padding-bottom: 20px;
			margin-bottom: 20px;
			padding-right: 50px;
		}
		.woocommerce #jckqv .woocommerce-product-rating {
			display: block;
			float: right;
			margin: 0;
		}
		#jckqv .woocommerce-product-rating .star-rating {
			margin: 3px 5px 3px 0;
			font-size: 16px;
		}
		#jckqv .woocommerce-product-rating .star-rating span:before {
			color: #f5c55e;
		}
		#jckqv .woocommerce-product-rating .text-rating {
			margin-left: 4px;
		}
		#jckqv .price del, #jckqv .price ins, #jckqv span.price del, #jckqv span.price ins {
			font-size: inherit;
			font-weight: normal;
		}
		#jckqv .single_variation_wrap {
			margin: 10px 0 0;
		}
		#jckqv .single_variation_wrap .single_variation {
			margin-bottom: 10px;
		}
		#jckqv .onsale {
			right: auto!important;
			left: -10px;
			top: 10px!important;
			-webkit-transform: translateX(-100%);
			-moz-transform: translateX(-100%);
			transform: translateX(-100%);
		}
		#jckqv .quantity {
			margin-right: 10px!important;
			background: transparent!important;
		}
		#jckqv .jckqv-qty-spinners {
			display: none;
		}
		#jckqv .quantity .qty {
			border-radius: 0;
			height: 50px;
			width: 46px;
			float: left;
			margin-right: 0;
			text-align: center;
			border: 1px solid #e3e3e3;
		}
		#jckqv .price {
			font-weight: normal;
			line-height: 22px;
		}
		#jckqv table.variations {
			margin: 0;
		}
		#jckqv table.variations td.label {
			display: none;
		}
		#jckqv .variations_form tr:last-child td.value select {
			margin-bottom: 0;
		}
		#jckqv .product_meta {
			background: transparent;
			clear: both;
			margin-bottom: 0;
			display: none;
		}
		#jckqv .product_meta > span {
			margin-bottom: 0;
			padding: 0;
			border: 0;
			font-size: 14px;
		}
		#jckqv .product_meta > .meta-row {
			display: block;
			padding: 8px 10px;
			border-bottom: 2px solid #eeeeee;
			margin-bottom: 0;
		}
		#jckqv table.variations {
			background: none!important;
		}
		#jckqv table.variations td {
			border: 0;
		}
		#jckqv .mfp-close {
			font-size: 0;
		    padding: 22px 25px 0 0;
		    width: 45px;
		    height: 45px;
		    line-height: 26px;
		}
		#jckqv .mfp-close:before {
			content: "\e932";
			font-family: "nucleo-interface";
			font-size: 16px;
		}
		.mfp-ajax-cur {
		    cursor: default!important;
		}
		#jckqv .jckqv-images__arr--next, #jckqv .jckqv-images__arr--prev {
			width: 32px;
		}
		#jckqv .jckqv-images__arr--next {
			right: 30px;
		}
		#jckqv .jckqv-images__arr--prev {
			left: 30px;
		}
		#jckqv .jckqv-images__arr--next i, #jckqv .jckqv-images__arr--prev i {
			color: #222;
			background: #fff;
			text-align: center;
			letter-spacing: -3px;
			line-height: 34px;
			font-size: 16px;
			width: 32px;
			height: 32px;
			border-radius: 30px;
		}
		#jckqv .jckqv-images__arr--prev i {
			letter-spacing: 0; 	
		}
		#jckqv .jckqv-images__arr--next i:before {
			font-family: "nucleo-interface";
			content: "\e907";
		}
		#jckqv .jckqv-images__arr--prev i:before {
			font-family: "nucleo-interface";
			content: "\e906";
		}
		.mfp-arrow:before {
			font-family: "nucleo-interface";
			content: "\e906";
			font-size: 32px;
			border: 0;
			width: 40px;
			height: 40px;
			color: #fff;
		}
		.mfp-arrow.mfp-arrow-right:before {
			content: "\e907";
			margin-left: 0;
			margin-right: 30px;
		}
		.mfp-arrow:after {
			display: none!important;
		}
		#jckqv .cart .button {
			border-radius: 0;
			box-shadow: none;
			height: 50px;
			padding: 0 20px;
			float: left;
			outline: 0!important;
			margin: 0 10px 0 0;
			text-shadow: none;
			font-size: 14px;
			text-transform: uppercase;
			font-weight: bold!important;
			text-align: left;
			line-height: 20px;
			min-width: 180px;
		}
		#jckqv #jckqv_summary .yith-wcwl-divide {
			display: none;
		}
		#jckqv .cart .yith-wcwl-add-to-wishlist {
			margin-left: 0!important;
			min-height: 50px;
		}
		#jckqv .slick-initialized .slick-slide {
			outline: 0!important;
		}';
				
		
		/* Promo bar styling output
		================================================== */
		$custom_styles .= '#base-promo, .sf-promo-bar {background-color: ' . $promo_bar_bg_color . ';}';
		$custom_styles .= '#base-promo > p, #base-promo.footer-promo-text > a, #base-promo.footer-promo-arrow > a, .sf-promo-bar > p, .sf-promo-bar.promo-text > a, .sf-promo-bar.promo-arrow > a {color: ' . $promo_bar_text_color . ';}';
		$custom_styles .= '#base-promo.footer-promo-arrow:hover, #base-promo.footer-promo-text:hover, .sf-promo-bar.promo-arrow:hover, .sf-promo-bar.promo-text:hover {background-color: ' . $accent_color . '!important;color: ' . $accent_alt_color . '!important;}';
		$custom_styles .= '#base-promo.footer-promo-arrow:hover > *, #base-promo.footer-promo-text:hover > *, .sf-promo-bar.promo-arrow:hover > *, .sf-promo-bar.promo-text:hover > * {color: ' . $accent_alt_color . '!important;}';
		

        /* Buddypress styling output
        ================================================== */
        if ( function_exists('bp_is_active') ) {
	        $custom_styles .= '#buddypress .activity-meta a, #buddypress .acomment-options a, #buddypress #member-group-links li a, .widget_bp_groups_widget #groups-list li, .activity-list li.bbp_topic_create .activity-content .activity-inner, .activity-list li.bbp_reply_create .activity-content .activity-inner {border-color: ' . $section_divide_color . ';}';
	        $custom_styles .= '#buddypress .activity-meta a:hover, #buddypress .acomment-options a:hover, #buddypress #member-group-links li a:hover {border-color: ' . $accent_color . ';}';
	        $custom_styles .= '#buddypress .activity-header a, #buddypress .activity-read-more a {border-color: ' . $accent_color . ';}';
	        $custom_styles .= '#buddypress #members-list .item-meta .activity, #buddypress .activity-header p {color: ' . $body_alt_text_color . ';}';
	        $custom_styles .= '#buddypress .pagination-links span, #buddypress .load-more.loading a {background-color: ' . $accent_color . ';color: ' . $accent_alt_color . ';border-color: ' . $accent_color . ';}';
	        $custom_styles .= '#buddypress div.dir-search input[type=submit], #buddypress #whats-new-submit input[type=submit] {background: ' . $alt_bg_color . '; color: ' . $secondary_accent_color . '}';
        }


        /* BBPress styling output
        ================================================== */
        if ( class_exists('bbPress') ) {
		    $custom_styles .= 'span.bbp-admin-links a, li.bbp-forum-info .bbp-forum-content {color: ' . $body_alt_text_color . ';}';
		    $custom_styles .= 'span.bbp-admin-links a:hover {color: ' . $accent_color . ';}';
		    $custom_styles .= '.bbp-topic-action #favorite-toggle a, .bbp-topic-action #subscription-toggle a, .bbp-single-topic-meta a, .bbp-topic-tags a, #bbpress-forums li.bbp-body ul.forum, #bbpress-forums li.bbp-body ul.topic, #bbpress-forums li.bbp-header, #bbpress-forums li.bbp-footer, #bbp-user-navigation ul li a, .bbp-pagination-links a, #bbp-your-profile fieldset input, #bbp-your-profile fieldset textarea, #bbp-your-profile, #bbp-your-profile fieldset {border-color: ' . $section_divide_color . ';}';
		    $custom_styles .= '.bbp-topic-action #favorite-toggle a:hover, .bbp-topic-action #subscription-toggle a:hover, .bbp-single-topic-meta a:hover, .bbp-topic-tags a:hover, #bbp-user-navigation ul li a:hover, .bbp-pagination-links a:hover {border-color: ' . $accent_color . ';}';
		    $custom_styles .= '#bbp-user-navigation ul li.current a, .bbp-pagination-links span.current {border-color: ' . $accent_color . ';background: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
		    $custom_styles .= '#bbpress-forums fieldset.bbp-form button[type=submit], #bbp_user_edit_submit, .widget_display_search #bbp_search_submit {background: ' . $alt_bg_color . '; color: ' . $secondary_accent_color . '}';
		    $custom_styles .= '#bbpress-forums fieldset.bbp-form button[type=submit]:hover, #bbp_user_edit_submit:hover {background: ' . $accent_color . '; color: ' . $accent_alt_color . ';}';
		    $custom_styles .= '#bbpress-forums li.bbp-header {border-top-color: ' . $accent_color . ';}';
		}
		
	    
	    /* Events Calender styling output
	    ================================================== */
        if ( class_exists( 'Tribe__Events__Main' ) ) {
			$custom_styles .= '.tribe-events-list-separator-month span {background-color:' . $inner_page_bg_color . ';}';
			$custom_styles .= '#tribe-bar-form, .tribe-events-list .tribe-events-event-cost span, #tribe-events-content .tribe-events-calendar td {background-color:' . $alt_bg_color . ';}';
			$custom_styles .= '.tribe-events-loop .tribe-events-event-meta, .tribe-events-list .tribe-events-venue-details {border-color: ' . $section_divide_color . ';}';
        }
        
		
		/* Disable Mobile Animations
		================================================== */
        if ( $disable_mobile_animations ) {
            $custom_styles .= 'html.no-js .sf-animation, .mobile-browser .sf-animation, .apple-mobile-browser .sf-animation, .sf-animation[data-animation="none"] {
			opacity: 1!important;left: auto!important;right: auto!important;bottom: auto!important;-webkit-transform: scale(1)!important;-o-transform: scale(1)!important;-moz-transform: scale(1)!important;transform: scale(1)!important;}';
            $custom_styles .= 'html.no-js .sf-animation.image-banner-content, .mobile-browser .sf-animation.image-banner-content, .apple-mobile-browser .sf-animation.image-banner-content, .sf-animation[data-animation="none"].image-banner-content {
			bottom: 50%!important;}';
			$custom_styles .= '.mobile-browser .product-grid .product {opacity: 1!important;}';
        }
        

        /* User Custom CSS
        ================================================== */
        if ( $custom_css ) {
            $custom_styles .= "\n" . '/*========== User Custom CSS Styles ==========*/' . "\n";
            $custom_styles .= $custom_css;
        }
		
		
		/* Output Processing
		================================================== */
		// Remove comments
		$custom_styles = preg_replace( '#/\*.*?\*/#s', '', $custom_styles );	
		// Remove whitespace
		$custom_styles = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $custom_styles );
		
		
		/* Final Output
		================================================== */
		return $custom_styles;
		
	}
 