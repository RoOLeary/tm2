<?php

	/*
	*
	*	Uplift Functions
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
	*
	*	VARIABLE DEFINITIONS
	*	PLUGIN INCLUDES
	*	THEME UPDATER
	*	THEME SUPPORT
	*	THUMBNAIL SIZES
	*	CONTENT WIDTH
	*	LOAD THEME LANGUAGE
	*	sf_custom_content_functions()
	*	sf_include_framework()
	*	sf_enqueue_styles()
	*	sf_enqueue_scripts()
	*	sf_load_custom_scripts()
	*	sf_admin_scripts()
	*	sf_layerslider_overrides()
	*
	*/


	/* VARIABLE DEFINITIONS
	================================================== */
	define('SF_TEMPLATE_PATH', get_template_directory());
	define('SF_INCLUDES_PATH', SF_TEMPLATE_PATH . '/includes');
	define('SF_FRAMEWORK_PATH', SF_TEMPLATE_PATH . '/swift-framework');
	define('SF_WIDGETS_PATH', SF_INCLUDES_PATH . '/widgets');
	define('SF_LOCAL_PATH', get_template_directory_uri());

	/* PLUGIN INCLUDES
	================================================== */
	require_once(SF_INCLUDES_PATH . '/plugins/aq_resizer.php');
 	include_once(SF_INCLUDES_PATH . '/plugin-includes.php');
	require_once(SF_INCLUDES_PATH . '/theme_update_check.php');
	$UpliftUpdateChecker = new ThemeUpdateChecker(
	    "uplift",
	    "https://kernl.us/api/v1/theme-updates/56e6f9e32b402cc12fbc1ae2/"
	);
	
	/* THEME SETUP
	================================================== */
	if (!function_exists('sf_uplift_setup')) {
		function sf_uplift_setup() {

			/* SF THEME OPTION CHECK
			================================================== */
			if ( get_option( 'sf_theme' ) == false ) {
				update_option( "sf_theme", "uplift" );
			}

			/* THEME SUPPORT
			================================================== */
			add_theme_support( 'structured-post-formats', array('audio', 'gallery', 'image', 'link', 'video') );
			add_theme_support( 'post-formats', array('aside', 'chat', 'quote', 'status') );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'title-tag' );
			add_theme_support( 'woocommerce' );
			add_theme_support( 'customize-selective-refresh-widgets' );
			add_theme_support( "swiftframework", array(
				'swift-smartscript'			=> true,
				'slideout-menu'				=> true,
				'pushnav-menu'				=> true,
				'split-nav-menu'			=> true,
				'page-heading-woocommerce'	=> false,
				'pagination-fullscreen'		=> false,
				'bordered-button'			=> true,
				'3drotate-button'			=> false,
				'rounded-button'			=> true,
				'product-inner-heading'		=> false,
				'product-summary-tabs'		=> false,
				'product-layout-opts'		=> true,
				'mobile-shop-filters' 		=> true,
				'mobile-logo-override'		=> true,
				'product-multi-masonry'		=> true,
				'product-preview-slider'	=> true,
				'super-search-config'		=> true,
				'advanced-row-styling'		=> true,
				'gizmo-icon-font'			=> false,
				'icon-mind-font'			=> false,
				'nucleo-general-font'		=> true,
				'nucleo-interface-font'		=> true,
				'nucleo-svg-icons'			=> true,
				'menu-new-badge'			=> true,
				'menu-button-advanced'		=> true,
				'advanced-map-styles'		=> true,
				'minimal-team-hover'		=> true,
				'posts-showcase'			=> true,
				'alt-gallery-hover'			=> true,
				'counter-hr-divide-icon'	=> true,
				'alt-recent-post-list'		=> true,
				'page-heading-woo-description' => true,
				'header-aux-modals'			=> true,
				'max-mega-menu'				=> true,
				'swift-smartsidebar'		=> true,
				'spb-team-ajax'				=> true,
				'spb-port-showcase-alt'		=> true,
				'transparent-sticky-header' => true,
				'hamburger-css' 			=> true
			) );

			/* THUMBNAIL SIZES
			================================================== */
			set_post_thumbnail_size( 220, 150, true);
			add_image_size( 'sf-thumb-image', 600, 450, true);
			add_image_size( 'sf-thumb-image-twocol', 900, 675, true);
			add_image_size( 'sf-image-onecol', 1800, 1200, true);
			add_image_size( 'sf-large-square', 1200, 1200, true);

			/* CONTENT WIDTH
			================================================== */
			if ( ! isset( $content_width ) ) $content_width = 1140;

			/* LOAD THEME LANGUAGE
			================================================== */
			load_theme_textdomain('uplift', SF_TEMPLATE_PATH.'/language');

		}
		add_action( 'after_setup_theme', 'sf_uplift_setup' );
	}


	/* INCLUDE SIDEBARS / WIDGETS / OVERRIDES
	================================================== */
	include_once( SF_FRAMEWORK_PATH . '/core/sf-sidebars.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-twitter.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-flickr.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-instagram.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-video.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-posts.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-portfolio.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-portfolio-grid.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-advertgrid.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-infocus.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-comments.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-mostloved.php' );
	require_once(SF_INCLUDES_PATH . '/overrides/sf-theme-overrides.php');
	
	
	/* LOAD META BOXES
	================================================== */
	require(SF_INCLUDES_PATH . '/meta-box/meta-box.php');
	include_once(SF_INCLUDES_PATH . '/meta-boxes.php');
	
	
	/* INCLUDE FRAMEWORK
	================================================== */
	if (!function_exists('sf_include_framework')) {
		function sf_include_framework() {
			
			// Overrides
			require_once(SF_INCLUDES_PATH . '/overrides/sf-theme-functions.php');
			require_once(SF_INCLUDES_PATH . '/overrides/sf-header-overrides.php');
			require_once(SF_INCLUDES_PATH . '/overrides/sf-blog-overrides.php');
			require_once(SF_INCLUDES_PATH . '/overrides/sf-portfolio-overrides.php');
			require_once(SF_INCLUDES_PATH . '/overrides/sf-gallery-overrides.php');
			require_once(SF_INCLUDES_PATH . '/overrides/sf-spb-overrides.php');
			
			// Base Framework
			require_once(SF_FRAMEWORK_PATH . '/swift-framework.php');	
			
			// Customizer functionality
			require_once(SF_INCLUDES_PATH . '/customizer/customizer.php');

			// Style Switcher
			include_once(SF_INCLUDES_PATH . '/sf-styleswitcher/sf-styleswitcher.php');
			
			// Category Colors
			include_once(SF_INCLUDES_PATH . '/sf-category-colors.php');
			
			// Framework overrides
			include_once(SF_INCLUDES_PATH . '/overrides/sf-framework-overrides.php');
			
			// WooCommerce
			require_once(SF_INCLUDES_PATH . '/overrides/sf-woocommerce-overrides.php');
		}
		add_action('init', 'sf_include_framework', 5);
	}
	

	/* THEME OPTIONS FRAMEWORK
	================================================== */
	require_once(SF_INCLUDES_PATH . '/sf-colour-scheme.php');
	if (!function_exists('sf_include_theme_options')) {
		function sf_include_theme_options() {
			require_once( SF_INCLUDES_PATH . '/option-extensions/loader.php' );
			require_once( SF_INCLUDES_PATH . '/sf-options.php' );
			global $sf_uplift_options, $sf_options;
			$sf_options = $sf_uplift_options;
		}
		add_action('init', 'sf_include_theme_options', 10);
	}
	
	
	/* THEME OPTIONS VAR RETRIEVAL
	================================================== */
	if (!function_exists('sf_get_theme_opts')) {
		function sf_get_theme_opts() {
			global $sf_uplift_options;
			return $sf_uplift_options;
		}
	}

	
	/* LOVE IT INCLUDE
	================================================== */
	if (!function_exists('sf_love_it_include')) {
		function sf_love_it_include() {
			$sf_options = sf_get_theme_opts();
			$disable_loveit = false;
			if (isset($sf_options['disable_loveit'])) {
			$disable_loveit = $sf_options['disable_loveit'];
			}

			if (!$disable_loveit) {
			include_once(SF_INCLUDES_PATH . '/plugins/love-it-pro/love-it-pro.php');
			}
		}
		add_action('init', 'sf_love_it_include', 20);
	}


	/* LOAD STYLESHEETS
	================================================== */
	if (!function_exists('sf_enqueue_styles')) {
		function sf_enqueue_styles() {

			global $is_IE;
			$sf_options = sf_get_theme_opts();
			//$enable_min_styles = $sf_options['enable_min_styles'];
			$enable_min_styles = false;
			$enable_responsive = $sf_options['enable_responsive'];
			$enable_rtl = $sf_options['enable_rtl'];
            $upload_dir = wp_upload_dir();

            //FONTELLO ICONS 
            if ( get_option('sf_fontello_icon_codes') && get_option('sf_fontello_icon_codes') != '' ){
				wp_register_style('sf-fontello',  $upload_dir['baseurl'] . '/redux/custom-fonts/fontello_css/fontello-embedded.css', array(), NULL, 'all');
				wp_enqueue_style('sf-fontello');
		    }

		    wp_register_style('sf-style', get_stylesheet_directory_uri() . '/style.css', array(), NULL, 'all');

		    wp_register_style('bootstrap', SF_LOCAL_PATH . '/css/bootstrap.min.css', array(), NULL, 'all');
		    wp_register_style('fontawesome', SF_LOCAL_PATH .'/css/font-awesome.min.css', array(), '4.6.3', 'all');
		    wp_register_style('sf-iconfont', SF_LOCAL_PATH . '/css/iconfont.css', array(), NULL, 'all');
		    wp_register_style('sf-main', SF_LOCAL_PATH . '/css/main.css', array(), NULL, 'all');
		    wp_register_style('uplift-megamenu', SF_LOCAL_PATH . '/css/uplift-megamenu.css', array(), NULL, 'all');
		    wp_register_style('sf-rtl', SF_LOCAL_PATH . '/rtl.css', array(), NULL, 'all');
		    wp_register_style('sf-rtl-min', SF_LOCAL_PATH . '/rtl.min.css', array(), NULL, 'all');
		    wp_register_style('sf-woocommerce', SF_LOCAL_PATH . '/css/sf-woocommerce.css', array(), NULL, 'all');
		    wp_register_style('sf-responsive', SF_LOCAL_PATH . '/css/sf-responsive.css', array(), NULL, 'all');
		    wp_register_style('sf-responsive-min', SF_LOCAL_PATH . '/css/sf-responsive.min.css', array(), NULL, 'all');
		    wp_register_style('sf-combined-min', SF_LOCAL_PATH . '/css/sf-combined.min.css', array(), NULL, 'all');

			if ( $enable_min_styles && !$is_IE ) {
				wp_enqueue_style('sf-combined-min');

				if (is_rtl() || $enable_rtl || isset($_GET['RTL'])) {
			    	wp_enqueue_style('sf-rtl-min');
			    }

			    if ($enable_responsive) {
			    	wp_enqueue_style('sf-responsive-min');
			    }
				wp_enqueue_style('sf-style');
			} else {
			    wp_enqueue_style('bootstrap');
			    wp_enqueue_style('fontawesome');
				wp_enqueue_style('sf-iconfont');
			    wp_enqueue_style('sf-main');

			    if (sf_woocommerce_activated()) {
			    	wp_enqueue_style('sf-woocommerce');
			    }

			    if (is_rtl() || $enable_rtl || isset($_GET['RTL'])) {
			    	wp_enqueue_style('sf-rtl');
			    }

			    if ($enable_responsive) {
			    	wp_enqueue_style('sf-responsive');
			    }

				wp_enqueue_style('sf-style');

			}
		}
		add_action('wp_enqueue_scripts', 'sf_enqueue_styles');
	}


	/* LOAD FRONTEND SCRIPTS
	================================================== */
	if (!function_exists('sf_enqueue_scripts')) {
		function sf_enqueue_scripts() {

			// Variables
			global $post;
			$sf_options = sf_get_theme_opts();
		    $enable_rtl = $sf_options['enable_rtl'];
		    $enable_smoothscroll = $sf_options['enable_smoothscroll'];
		    $enable_min_scripts = $sf_options['enable_min_scripts'];
			$post_type = get_query_var('post_type');
			$product_zoom = $sf_options['enable_product_zoom'];
			$header_left_config  = $sf_options['header_left_config'];
            $header_right_config = $sf_options['header_right_config'];
			$product_zoom_mobile = false;
			if ( isset($_GET['product_zoom']) ) {
				$product_zoom = true;
			}
			if ( isset ( $sf_options['enable_product_zoom_mobile'] ) ) {
				$product_zoom_mobile = true;
			}
			$gmaps_api_key = get_option('sf_gmaps_api_key');
			
			

			/*
			 * Register scripts for conditional inclusion	
			 */
			wp_register_script('lightSlider', SF_LOCAL_PATH . '/js/lib/lightslider.min.js', 'jquery', NULL, TRUE);	    		
	    	wp_register_script('isotope', SF_LOCAL_PATH . '/js/lib/isotope.pkgd.min.js', 'jquery', NULL, TRUE);	    		
	    	wp_register_script('isotope-packery', SF_LOCAL_PATH . '/js/lib/packery-mode.pkgd.min.js', 'jquery', NULL, TRUE);	   	
			wp_register_script('google-maps', '//maps.google.com/maps/api/js?key=' . $gmaps_api_key, 'jquery', NULL, TRUE);
	    	wp_register_script('owlcarousel', SF_LOCAL_PATH . '/js/lib/owl.carousel.min.js', 'jquery', NULL, TRUE);
	    	wp_register_script('jquery-ui', SF_LOCAL_PATH . '/js/lib/jquery-ui-1.11.4.custom.min.js', 'jquery', NULL, TRUE);
	    	wp_register_script('jquery-cookie', SF_LOCAL_PATH . '/js/lib/jquery-cookie.js', 'jquery', NULL, TRUE);

			/*
			 * Enqueue scripts	
			 */
			if ( !is_admin() ) {
				wp_enqueue_script('jquery-cookie');
				
				
			    if ( $enable_smoothscroll ) {
			    	wp_enqueue_script('smoothscroll', SF_LOCAL_PATH . '/js/lib/sscr.js', '', NULL, FALSE);
			    }
	
			    // Theme Scripts
			    wp_enqueue_script('modernizr', SF_LOCAL_PATH . '/js/lib/modernizr-custom.js', NULL, NULL, TRUE);
	    		wp_enqueue_script('bootstrap-js', SF_LOCAL_PATH . '/js/lib/bootstrap.min.js', 'jquery', NULL, TRUE);
	    		if ( $enable_min_scripts) {
	    			wp_enqueue_script('sf-theme-scripts-min', SF_LOCAL_PATH . '/js/lib/theme-scripts.min.js', 'jquery', NULL, TRUE);
	    		} else {
	    			wp_enqueue_script('sf-theme-scripts', SF_LOCAL_PATH . '/js/lib/theme-scripts.js', 'jquery', NULL, TRUE);
	    		}
	    		wp_enqueue_script('ilightbox', SF_LOCAL_PATH . '/js/lib/ilightbox.min.js', 'jquery', NULL, TRUE);				
				wp_enqueue_script('plyr', SF_LOCAL_PATH . '/js/lib/plyr.js', '', NULL, FALSE);	
	    		wp_enqueue_script('imagesLoaded', SF_LOCAL_PATH . '/js/lib/imagesloaded.pkgd.min.js', 'jquery', NULL, TRUE);
	    		wp_enqueue_script('infinite-scroll',  SF_LOCAL_PATH . '/js/lib/jquery.infinitescroll.min.js', 'jquery', NULL, TRUE);

	    		if ( $product_zoom ) {
	    			wp_enqueue_script('elevatezoom', SF_LOCAL_PATH . '/js/lib/jquery.elevateZoom.min.js', 'jquery', NULL, TRUE);
	    		}
	    		
	    		if ( $product_zoom_mobile ) {
	    			wp_enqueue_script('panzoom', SF_LOCAL_PATH . '/js/lib/jquery.panzoom.min.js', 'jquery', NULL, TRUE);
	    		}
	    		
	    		if ( $enable_min_scripts) {
	    			wp_enqueue_script('sf-functions-min', SF_LOCAL_PATH . '/js/functions.min.js', 'jquery', NULL, TRUE);
		    	} else {
	    			wp_enqueue_script('sf-functions', SF_LOCAL_PATH . '/js/functions.js', 'jquery', NULL, TRUE);		    	
		    	}
		    	if ( is_singular() && comments_open() && get_option('thread_comments') ) {
		    		wp_enqueue_script( 'comment-reply' );
		    	}

		    }
		}
		add_action('wp_enqueue_scripts', 'sf_enqueue_scripts');
	}

	function sf_custom_bwp_minify_remove() {

		global $is_IE;

		if ($is_IE) {
			return array('');
		}
	}
	add_filter('bwp_minify_allowed_styles', 'sf_custom_bwp_minify_remove');


	/* LOAD BACKEND SCRIPTS
	================================================== */
	function sf_admin_scripts( $hook ) {
	    wp_register_script('admin-functions', get_template_directory_uri() . '/js/sf-admin.js', 'jquery', '1.0', TRUE);
	    		
		wp_register_style('fontawesome', get_template_directory_uri() .'/css/font-awesome.min.css', array(), NULL, 'all');
		wp_register_style('sf-iconfont', get_template_directory_uri() . '/css/iconfont.css', array(), NULL, 'all');
		
		wp_enqueue_script('admin-functions');
				
		//FONTELLO ICONS 
        if ( get_option('sf_fontello_icon_codes') && get_option('sf_fontello_icon_codes') != '' ) {
        	$upload_dir = wp_upload_dir();
			wp_register_style('sf-fontello',  $upload_dir['baseurl'] . '/redux/custom-fonts/fontello_css/fontello-embedded.css', array(), NULL, 'all');
			wp_enqueue_style('sf-fontello');
		}
		
		if ( 'nav-menus.php' == $hook ) {
			wp_enqueue_style('fontawesome');
			wp_enqueue_style('sf-iconfont');
		}
			
			
	}
	add_action('admin_enqueue_scripts', 'sf_admin_scripts');


	/* WOO CHECKOUT BUTTON
	================================================== */
	if ( ! function_exists( 'sf_woocommerce_button_proceed_to_checkout' ) ) {
		function sf_woocommerce_button_proceed_to_checkout() {
			$checkout_url = WC()->cart->get_checkout_url();
			?>
			<a class="sf-button standard checkout-button accent" href="<?php echo esc_url($checkout_url); ?>">
				<span class="text"><?php _e( 'Checkout', 'uplift' ); ?></span>
			</a>
			<?php
		}
	}


	/* CHECK THEME FEATURE SUPPORT
    ================================================== */
    if ( !function_exists( 'sf_theme_supports' ) ) {
        function sf_theme_supports( $feature ) {
        	$supports = get_theme_support( "swiftframework" );
        	$supports = $supports[0];
    		if ( !isset($supports[ $feature ]) || $supports[ $feature ] == "") {
    			return false;
    		} else {
        		return isset( $supports[ $feature ] );
        	}
        }
    }


    /* GET CAROUSEL ID
	================================================== */
	if (!function_exists('sf_get_carousel_id')) {
		function sf_get_carousel_id() {
			global $sf_carouselID;
			if ($sf_carouselID == "") {
			$sf_carouselID = 1;
			} else {
			$sf_carouselID++;
			}
			return $sf_carouselID;
		}
	}


	/* GET SUPER SEARCH COUNT
	================================================== */
	if (!function_exists('sf_get_supersearch_count')) {
		function sf_get_supersearch_count() {
			global $sf_supersearch_count;
			if ($sf_supersearch_count == "") {
				$sf_supersearch_count = 1;
			} else {
				$sf_supersearch_count++;
			}
			return $sf_supersearch_count;
		}
	}

	/* GET PRODUCT DISPLAY
	================================================== */
	if (!function_exists('sf_get_product_display')) {
		function sf_get_product_display() {
			global $sf_product_multimasonry, $sf_product_display_type, $sf_product_display_layout;

			// Return array
            $product_display = array(
                "multi-masonry"   => $sf_product_multimasonry,
                "display-type" 	  => $sf_product_display_type,
                "display-layout"  => $sf_product_display_layout
            );

            return $product_display;
		}
	}
	function sf_set_product_multimasonry($bool) {
		global $sf_product_multimasonry;
		$sf_product_multimasonry = $bool;
	}


	/* GET CATALOG MODE
	================================================== */
	if (!function_exists('sf_get_catalog_mode')) {
		function sf_get_catalog_mode() {
			$sf_options = sf_get_theme_opts();
			$enable_catalog_mode = false;
			// Catalog Mode
			if ( isset( $sf_options['enable_catalog_mode'] ) ) {
				$enable_catalog_mode = $sf_options['enable_catalog_mode'];
			}
			if ( isset( $_GET['catalog_mode'] ) ) {
			    $enable_catalog_mode = $_GET['catalog_mode'];
			}

			return $enable_catalog_mode;
		}
	}
    
    
    /* HEADER ACTION
    ================================================== */
    if ( !function_exists( 'sf_head_action_adjust' ) ) {
	    function sf_head_action_adjust() {
	        global $post;
	        $sf_options = sf_get_theme_opts();
	        $page_header_type = "";
	        $page_layout      = $sf_options['page_layout'];
	        $header_layout    = $sf_options['header_layout'];
	        	        
	        if (isset($_GET['header'])) {
	        	$header_layout = $_GET['header'];
	        }
	        if ( isset( $_GET['layout'] ) ) {
	            $page_layout = $_GET['layout'];
	        }
	        if ( is_page() && $post ) {
	            $page_header_type = sf_get_post_meta( $post->ID, 'sf_page_header_type', true );
	        }
			if ( $page_header_type == "below-slider" && $page_layout == "boxed" ) {
				add_action( 'sf_before_page_container', 'sf_pageslider', 20 );
	        } else if ( $page_header_type == "below-slider" && ( $header_layout != "header-vert" || $header_layout != "header-vert-right" ) ) {
	            add_action( 'sf_container_start', 'sf_pageslider', 5 );
	        } else {
	            add_action( 'sf_container_start', 'sf_pageslider', 30 );
	        }
	
	        if ( $page_header_type == "naked-light" || $page_header_type == "naked-dark" ) {
	            remove_action( 'sf_main_container_start', 'sf_breadcrumbs', 20 );
	        }
	    }
	    add_action( 'wp_head', 'sf_head_action_adjust' );
    }
    

    /* SIDEBAR FILTERS
	================================================== */
	function uplift_sidebar_before_title() {
		return '<div class="widget-heading title-wrap clearfix"><h3 class="spb-heading"><span>';
	}
	add_filter('sf_sidebar_before_title', 'uplift_sidebar_before_title');

	function uplift_sidebar_after_title() {
		return '</span></h3></div>';
	}
	add_filter('sf_sidebar_after_title', 'uplift_sidebar_after_title');


	/* FOOTER FILTERS
	================================================== */
	function uplift_footer_before_title() {
		return '<div class="widget-heading title-wrap clearfix"><h3 class="spb-heading"><span>';
	}
	add_filter('sf_footer_before_title', 'uplift_footer_before_title');

	function uplift_footer_after_title() {
		return '</span></h3></div>';
	}
	add_filter('sf_footer_after_title', 'uplift_footer_after_title');
		