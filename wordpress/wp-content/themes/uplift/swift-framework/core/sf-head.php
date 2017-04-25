<?php
    /*
    *
    *	Head Tag Functions
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
    *
    *	sf_head_meta()
    *	sf_page_classes()
    *	sf_tracking()
    *
    */


    /* HEAD META
    ================================================== */
    if ( ! function_exists( 'sf_head_meta' ) ) {
        function sf_head_meta() {
            $sf_options = sf_get_theme_opts();
            $enable_responsive = $sf_options['enable_responsive'];
            global $is_IE;
            ?>
                        
            <?php if ( $is_IE ) { ?>
            	<!--// IE COMPATIBILITY //-->
            	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
            <?php } ?>

            <!--// SITE META //-->
            <meta charset="<?php bloginfo( 'charset' ); ?>"/>
            <?php if ( $enable_responsive ) { ?>
            	<?php $viewport_content = apply_filters( 'sf_viewport_content' , "width=device-width, initial-scale=1.0" ); ?>
                <meta name="viewport" content="<?php echo esc_attr($viewport_content); ?>"/>
            <?php } ?>
            <?php if ( isset( $sf_options['custom_ios_title'] ) && $sf_options['custom_ios_title'] != "" ) { ?>
                <meta name="apple-mobile-web-app-title"
                      content="<?php echo esc_attr( $sf_options['custom_ios_title'] ); ?>">
            <?php } ?>
            <?php if ( is_paged() ) { ?>
            	<meta name="robots" content="noindex, follow" />
            <?php } ?>

            <!--// PINGBACK & FAVICON //-->
            <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
            <?php if ( isset( $sf_options['custom_favicon']['url']) && $sf_options['custom_favicon']['url'] != "" ) { ?>
                <link rel="shortcut icon" href="<?php echo esc_url($sf_options['custom_favicon']['url']); ?>" /><?php } ?>

            <?php if ( isset( $sf_options['custom_ios_icon144']['url'] ) && $sf_options['custom_ios_icon144']['url'] != "" ) { ?>
                <link rel="apple-touch-icon-precomposed" sizes="144x144"
                      href="<?php echo esc_url($sf_options['custom_ios_icon144']['url']); ?>"/>
            <?php } ?>
            <?php if ( isset( $sf_options['custom_ios_icon114']['url'] ) && $sf_options['custom_ios_icon114']['url'] != "" ) { ?>
                <link rel="apple-touch-icon-precomposed" sizes="114x114"
                      href="<?php echo esc_url($sf_options['custom_ios_icon114']['url']); ?>"/>
            <?php } ?>
            <?php if ( isset( $sf_options['custom_ios_icon72']['url'] ) && $sf_options['custom_ios_icon72']['url'] != "" ) { ?>
                <link rel="apple-touch-icon-precomposed" sizes="72x72"
                      href="<?php echo esc_url($sf_options['custom_ios_icon72']['url']); ?>"/>
            <?php } ?>
            <?php if ( isset( $sf_options['custom_ios_icon57']['url'] ) && $sf_options['custom_ios_icon57']['url'] != "" ) { ?>
                <link rel="apple-touch-icon-precomposed" sizes="57x57"
                      href="<?php echo esc_url($sf_options['custom_ios_icon57']['url']); ?>"/>
            <?php } ?>

        <?php
        }

        add_action( 'wp_head', 'sf_head_meta', 0 );
    }


    /* SOCIAL META
    ================================================== */
    if ( ! function_exists( 'sf_social_meta' ) ) {
        function sf_social_meta() {
            global $post;
            $sf_options = sf_get_theme_opts();

            $logo = array();
            if ( isset( $sf_options['logo_upload'] ) ) {
                $logo = $sf_options['logo_upload'];
            }
            $disable_social_meta = false;
            if ( isset( $sf_options['disable_social_meta'] ) ) {
                $disable_social_meta = $sf_options['disable_social_meta'];
            }

            if ( ! $post || ! is_singular() || class_exists( 'WPSEO_Admin' ) || $disable_social_meta ) {
                return;
            }

            $title             = strip_tags( get_the_title() );
            $permalink         = get_permalink();
            $site_name         = get_bloginfo( 'name' );
            $excerpt           = get_the_excerpt();
            $content           = get_the_content();
            $twitter_author    = $sf_options['twitter_author_username'];
            $googleplus_author = $sf_options['googleplus_author'];
            if ( $excerpt != "" ) {
                $excerpt = strip_tags( trim( preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $content ) ) );
                if ( function_exists( 'mb_strimwidth' ) ) {
                    $excerpt = mb_strimwidth( $excerpt, 0, 100, '...' );
                }
            }
            if ( function_exists( 'is_product' ) && is_product() ) {
                $product_description       = sf_get_post_meta( $post->ID, 'sf_product_description', true );
                $product_short_description = sf_get_post_meta( $post->ID, 'sf_product_short_description', true );
                if ( $product_description != "" ) {
                    $excerpt = strip_tags( $product_description );
                } else if ( $product_short_description != "" ) {
                    $excerpt = strip_tags( $product_short_description );
                }
            }

            $image_url = "";
            if ( has_post_thumbnail( $post->ID ) ) {
                $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                $image_url = esc_attr( $thumbnail[0] );
            } else if ( isset( $logo['url'] ) && $logo['url'] != "" ) {
                $image_url = $logo['url'];
            }

            echo "" . "\n";
            echo '<!-- Facebook Meta -->' . "\n";
            echo '<meta property="og:title" content="' . $title . ' - ' . $site_name . '"/>' . "\n";
            echo '<meta property="og:type" content="article"/>' . "\n";
            echo '<meta property="og:url" content="' . $permalink . '"/>' . "\n";
            echo '<meta property="og:site_name" content="' . $site_name . '"/>' . "\n";
            echo '<meta property="og:description" content="' . $excerpt . '">' . "\n";
            if ( $image_url != "" ) {
                echo '<meta property="og:image" content="' . $image_url . '"/>' . "\n";
            }
            if ( function_exists( 'is_product' ) && is_product() ) {
                $product = new WC_Product( $post->ID );
                $product_price = method_exists( $product, 'get_price' ) ? $product->get_price() : $product->price;
                echo '<meta property="og:price:amount" content="' . $product_price . '" />' . "\n";
                echo '<meta property="og:price:currency" content="' . get_woocommerce_currency() . '" />' . "\n";
            }

            echo "" . "\n";
            echo '<!-- Twitter Card data -->' . "\n";
            echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
            echo '<meta name="twitter:title" content="' . $title . '">' . "\n";
            echo '<meta name="twitter:description" content="' . $excerpt . '">' . "\n";
            if ( $twitter_author != "" ) {
                echo '<meta name="twitter:site" content="@' . $twitter_author . '">' . "\n";
                echo '<meta name="twitter:creator" content="@' . $twitter_author . '">' . "\n";
            }
            if ( $image_url != "" ) {
                echo '<meta property="twitter:image:src" content="' . $image_url . '"/>' . "\n";
            }
            if ( function_exists( 'is_product' ) && is_product() ) {
                $product = new WC_Product( $post->ID );
                $product_price = method_exists( $product, 'get_price' ) ? $product->get_price() : $product->price;
                echo '<meta name="twitter:data1" content="' . $product_price . '">' . "\n";
                echo '<meta name="twitter:label1" content="Price">' . "\n";
            }
            echo "" . "\n";

            echo "" . "\n";
            if ( $googleplus_author != "" ) {
                echo '<!-- Google Authorship and Publisher Markup -->' . "\n";
                echo '<link rel="author" href="https://plus.google.com/' . $googleplus_author . '/posts"/>' . "\n";
                echo '<link rel="publisher" href="https://plus.google.com/' . $googleplus_author . '"/>' . "\n";
            }
        }

        add_action( 'wp_head', 'sf_social_meta', 5 );
    }


    /* PAGE CLASS
    ================================================== */
    if ( ! function_exists( 'sf_page_classes' ) ) {
        function sf_page_classes() {

            // Get options
            global $post;
			$sf_options = sf_get_theme_opts();
			
			$header_wrap_class = $logo_class = $page_header_type = $app_header_style = "";
            
            // Option variables
            $enable_mini_header        = $sf_options['enable_mini_header'];
            $header_search_type        = $sf_options['header_search_type'];

            // Shop page check
            $shop_page = false;
            if ( ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product_category' ) && is_product_category() ) ) {
                $shop_page = true;
            }

            // Header Layout
            $header_layout    = $sf_options['header_layout'];
            if ( isset( $_GET['header'] ) ) {
                $header_layout = $_GET['header'];
            }
            if ( $header_layout == "" ) {
            	$header_layout = "header-3";
            }
            
	        if ( $post && is_singular() && !is_search() ) {
	            $page_header_type     = sf_get_post_meta( $post->ID, 'sf_page_header_type', true );
				$app_header_style	  = sf_get_post_meta( $post->ID, 'sf_page_header_app_style', true );
	        }                    
            
            if ( $shop_page ) {
                if ( isset($sf_options['woo_page_header']) ) {
                    $page_header_type = $sf_options['woo_page_header'];
                }
            }
			
			if ( ( $page_header_type == "naked-light" || $page_header_type == "naked-dark" ) && ( $header_layout == "header-vert" || $header_layout == "header-vert-right" ) ) {
			    $header_layout = apply_filters( 'sf_naked_default_header', "header-1" );
			}            
			
            if ( $enable_mini_header && $app_header_style && ! ( $header_layout == "header-vert" || $header_layout == "header-vert-right" ) ) {
            	if ( $header_layout == "header-6" || $header_layout == "header-7" ) {
            		$header_layout = "header-3";
            	}
            }
            
            if ( $header_layout == "header-3" || $header_layout == "header-4" || $header_layout == "header-5" || $header_layout == "header-split" || $header_layout == "header-4-alt" ) {
                $header_wrap_class .= " full-center";
            }
            if ( sf_theme_opts_name() == "sf_uplift_options" ) {
            	if ( $header_layout == "header-1" || $header_layout == "header-2" || $header_layout == "header-3" || $header_layout == "header-4" || $header_layout == "header-5" || $header_layout == "header-8" ) {
            	    $header_wrap_class .= " full-header-stick";
            	}
            } else {
            	if ( $header_layout == "header-3" || $header_layout == "header-4" || $header_layout == "header-5" || $header_layout == "header-7" || $header_layout == "header-8" || $header_layout == "header-split" || $header_layout == "header-4-alt" ) {
            	    $header_wrap_class .= " full-header-stick";
            	}
            }

            // Page Layout
            $page_layout     	= $sf_options['page_layout'];
            if ( isset( $_GET['layout'] ) ) {
                $page_layout 	= $_GET['layout'];
            }

            // Return array of classes
            $class_array = array(
                "page-layout"   => $page_layout,
                "header-layout" => $header_layout,
                "header-wrap"   => apply_filters( 'sf_header_wrap_class', $header_wrap_class ),
                "logo"          => apply_filters( 'sf_logo_class', $logo_class ),
                "search-type"   => $header_search_type
            );

            return $class_array;
        }
    }
    
    if ( ! function_exists( 'sf_add_body_classes' ) ) {
    	function sf_add_body_classes( $classes ) {
    		
    		// Get options
            global $post;
			$sf_options = sf_get_theme_opts();
			
            $enable_responsive = $sf_options['enable_responsive'];
            $is_responsive     = 'responsive-fluid';
            if ( ! $enable_responsive ) {
                $is_responsive = 'responsive-fixed';
            }
            $enable_rtl   = $sf_options['enable_rtl'];
            $design_style = sf_get_option( 'design_style_type', 'minimal' );

            $page_header_type = $page_slider = $page_header_alt_logo = $page_style = $page_design_style = $app_header_style = $sticky_header_transparent = "";
            $header_layout    = $sf_options['header_layout'];
            if ( isset( $_GET['header'] ) ) {
                $header_layout = $_GET['header'];
            }
            $page_layout             = $sf_options['page_layout'];
            $enable_page_shadow      = $sf_options['enable_page_shadow'];
            $enable_page_transitions = $sf_options['enable_page_transitions'];
            $page_transition         = $sf_options['page_transition'];
            $enable_header_shadow    = false;
            $mobile_two_click        = false;
            if ( isset( $sf_options['enable_header_shadow'] ) ) {
                $enable_header_shadow = $sf_options['enable_header_shadow'];
            }
            $product_image_shadows = true;
            if ( isset( $sf_options['product_image_shadows'] ) ) {
            	$product_image_shadows 	   = $sf_options['product_image_shadows'];
            }
            if ( isset( $sf_options['enable_mobile_two_click'] ) ) {
                $mobile_two_click = $sf_options['enable_mobile_two_click'];
            }
            $enable_mini_header        = $sf_options['enable_mini_header'];
            $enable_mini_header_resize = $sf_options['enable_mini_header_resize'];
            $header_search_type        = $sf_options['header_search_type'];
            $mobile_header_layout      = $sf_options['mobile_header_layout'];
            $mobile_header_shown       = $sf_options['mobile_header_shown'];
            $mobile_header_sticky      = $sf_options['mobile_header_sticky'];
            $mobile_menu_type          = "slideout";
            $enable_sticky_header_hide = false;
            $enable_newsletter_sub_bar = $enable_newsletter_sub_bar_page = false;
            if ( isset( $sf_options['mobile_menu_type'] ) ) {
                $mobile_menu_type = $sf_options['mobile_menu_type'];
            }
            $enable_articleswipe = 0;
            if ( isset( $sf_options['enable_articleswipe'] ) ) {
                $enable_articleswipe = $sf_options['enable_articleswipe'];
            }
            $home_preloader = false;
            if ( isset( $sf_options['home_preloader'] ) ) {
                $home_preloader = $sf_options['home_preloader'];
            }
            if ( isset( $sf_options['enable_sticky_header_hide'] ) ) {
            	$enable_sticky_header_hide = $sf_options['enable_sticky_header_hide'];
            }
            if ( isset($sf_options['enable_newsletter_sub_bar']) ) {
            	$enable_newsletter_sub_bar  = $sf_options['enable_newsletter_sub_bar'];
            }

            if ( $post && is_singular() && !is_search() ) {
                $page_header_type     = sf_get_post_meta( $post->ID, 'sf_page_header_type', true );
                $page_header_alt_logo = sf_get_post_meta( $post->ID, 'sf_page_header_alt_logo', true );
                $page_slider          = sf_get_post_meta( $post->ID, 'sf_page_slider', true );
                $page_design_style 	  = sf_get_post_meta( $post->ID, 'sf_page_design_style', true );
				$enable_newsletter_sub_bar_page = sf_get_post_meta($post->ID, 'sf_enable_newsletter_bar', true);
				$app_header_style	  = sf_get_post_meta( $post->ID, 'sf_page_header_app_style', true );
				$sticky_header_transparent = sf_get_post_meta( $post->ID, 'sf_sticky_header_transparent', true );
//				if ( sf_theme_opts_name() == "sf_uplift_options" && $page_design_style == "hero-content-split" ) {
//					$page_design_style = "standard";
//				}
            }
            if ( isset($sf_options['enable_newsletter_sub_bar_globally']) ) {
            	$enable_newsletter_sub_bar_page  = $sf_options['enable_newsletter_sub_bar_globally'];
            }

            // Shop page check
            $shop_page = false;
            if ( ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product_category' ) && is_product_category() ) ) {
                $shop_page = true;
            }

            if ( $shop_page ) {
                if ( isset($sf_options['woo_page_header']) ) {
                    $page_header_type = $sf_options['woo_page_header'];
                }
            }

            if ( ( $page_header_type == "naked-light" || $page_header_type == "naked-dark" ) && ( $header_layout == "header-vert" || $header_layout == "header-vert-right" ) ) {
                $header_layout = apply_filters( 'sf_naked_default_header', "header-1" );
            }

            // Create variables
            $page_class = $header_wrap_class = $logo_class = $shop_icon_style = "";

            // Design Style
            if ( isset( $_GET['design_style'] ) ) {
                $design_style = $_GET['design_style'];
            }
            $classes[] = $design_style . '-design';

            // Header Layout
            if ( $enable_mini_header && $app_header_style && ! ( $header_layout == "header-vert" || $header_layout == "header-vert-right" ) ) {
            	$classes[] = 'app-header';
            	if ( $header_layout == "header-6" || $header_layout == "header-7" ) {
            		$header_layout = "header-3";
            	}
            }
            
            if ( $page_header_type == "standard-overlay" ) {
                $classes[] = 'header-overlay';
            }
            
            if ( $header_layout == "header-vert" ) {
                $classes[] = 'vertical-header';
            }
            if ( $header_layout == "header-vert-right" ) {
                $classes[] = 'vertical-header vertical-header-right';
            }
            if ( $header_layout == "header-3" || $header_layout == "header-4" || $header_layout == "header-5" || $header_layout == "header-split" || $header_layout == "header-4-alt" ) {
                $header_wrap_class .= " full-center";
            }
            if ( sf_theme_opts_name() == "sf_uplift_options" ) {
            	if ( $header_layout == "header-1" || $header_layout == "header-2" || $header_layout == "header-3" || $header_layout == "header-4" || $header_layout == "header-5" || $header_layout == "header-8" ) {
            	    $header_wrap_class .= " full-header-stick";
            	}
            } else {
            	if ( $header_layout == "header-3" || $header_layout == "header-4" || $header_layout == "header-5" || $header_layout == "header-7" || $header_layout == "header-8" || $header_layout == "header-split" || $header_layout == "header-4-alt" ) {
            	    $header_wrap_class .= " full-header-stick";
            	}
            }

            // Mobile Header Layout
            $classes[] = 'mobile-header-' . $mobile_header_layout;
            $classes[] = 'mhs-' . $mobile_header_shown;
            if ( $mobile_header_sticky ) {
                $classes[] = "mh-sticky ";
            }
            $classes[] = 'mh-' . $mobile_menu_type;

            // Catalog Mode
            $sf_catalog_mode = sf_get_catalog_mode();
            if ( $sf_catalog_mode ) {
                $classes[] = 'catalog-mode';
            }

            // Responsive class
            $classes[] = $is_responsive;

            // RTL class
            if ( is_rtl() || $enable_rtl || isset( $_GET['RTL'] ) ) {
                $classes[] = 'rtl';
            }

            // Mini header
            if ( $enable_mini_header && ! ( $header_layout == "header-vert" || $header_layout == "header-vert-right" ) ) {
                $classes[] = 'sticky-header-enabled';
                if ( $enable_mini_header_resize ) {
                    $classes[] = 'sh-dynamic';
                }
            	if ( $enable_sticky_header_hide ) {
            		$classes[] = 'sh-show-hide';
            	}
            } else {
            	$classes[] = 'sticky-header-disabled';
            }

            // Page Shadow
            if ( $enable_page_shadow ) {
                $classes[] = 'page-shadow';
            }

            // Mobile 2 Click
            if ( $mobile_two_click ) {
                $classes[] = 'mobile-two-click';
            }

            // Page Transtions
            if ( $enable_page_transitions ) {
                $classes[] = 'page-transitions page-transition-' .$page_transition;
                if ( $page_transition == "loading-bar" ) {
                    $classes[] = 'loading-bar-transition';
                }
            }

            // Page Style
            if ( $page_design_style != "" ) {
            	$classes[] = $page_design_style;
            }
            
            // Header Shadow
            if ( $enable_header_shadow ) {
                $classes[] = 'header-shadow';
            }

            // Product Shadow
            if ( $product_image_shadows ) {
            	$classes[] = 'product-shadows';
            }

            // Page Header Type
            if ( $page_header_type != "" ) {
                $classes[] = 'header-' . $page_header_type;
            }
            
            // Transparent sticky header
            if ( $enable_mini_header && $sticky_header_transparent && !$app_header_style && ! ( $header_layout == "header-vert" || $header_layout == "header-vert-right" ) ) {
            	$classes[] = 'sticky-header-transparent';
            }

            // Page Header Logo
            if ( $page_header_alt_logo ) {
                $classes[] = 'logo-alt-version';
            }

            if ( is_singular( 'post' ) && $post ) {
                $post_header_type = sf_get_post_meta( $post->ID, 'sf_page_header_type', true );
                $fw_media_display = sf_get_post_meta( $post->ID, 'sf_fw_media_display', true );
                $page_title_style = sf_get_post_meta( $post->ID, 'sf_page_title_style', true );
				$page_title_style = apply_filters( 'sf_page_title_style', $page_title_style );
				
                if ( $page_title_style == "fancy" || $fw_media_display == "fw-media-title" || $fw_media_display == "fw-media" ) {
                    $classes[] = 'header-' . $post_header_type;
                }
            }

            if ( function_exists( 'is_product' ) && is_product() ) {
                $product_layout = sf_get_post_meta( $post->ID, 'sf_product_layout', true );
                $classes[] = 'product-' . $product_layout;
            }

            // Layout
            if ( isset( $_GET['layout'] ) ) {
                $page_layout = $_GET['layout'];
            }
            $classes[] = 'layout-' . $page_layout;


            // Article Swipe
            if ( $enable_articleswipe ) {
                $classes[] = 'article-swipe';
            }

            if ( $home_preloader && ( is_home() || is_front_page() ) && ! is_paged() ) {
                $classes[] = 'sf-preloader';
            }

            if ( ( $enable_newsletter_sub_bar && ( is_home() || is_front_page() ) && ! is_paged() ) || $enable_newsletter_sub_bar_page ) {
            	$classes[] = 'has-newsletter-bar';
            }

            // Page Heading
            if ( $post && is_singular() ) {
                $show_page_title       = sf_get_post_meta( $post->ID, 'sf_page_title', true );
                $remove_breadcrumbs    = sf_get_post_meta( $post->ID, 'sf_no_breadcrumbs', true );
                $page_title_style      = sf_get_post_meta( $post->ID, 'sf_page_title_style', true );
                $page_title_style 	   = apply_filters( 'sf_page_title_style', $page_title_style );
                if ( function_exists( 'is_product' ) && is_product() && sf_theme_supports( 'product-inner-heading' ) && $page_title_style == "fancy-tabbed" ) {
                	$page_title_style = "fancy";
                }
            	if ( $show_page_title ) {
            		$classes[] = 'page-heading-' . $page_title_style;
            	}
            }
            
            // WooCommerce classes
            if ( sf_woocommerce_activated() ) {
            	
            	// Shop page classes
            	if ( $shop_page ) {
            		$show_page_title       = $sf_options['woo_show_page_heading'];
            		$page_title_style      = $sf_options['woo_page_heading_style'];
            		$page_title_style 	   = apply_filters( 'sf_page_title_style', $page_title_style );
            		if ( $show_page_title ) {
            			$classes[] = 'page-heading-' . $page_title_style;
            		}
            	}	
            	
            	// Shop icon style
            	if ( isset($sf_options['shop_icon_style']) ) {
            		$shop_icon_style = $sf_options['shop_icon_style'];
            	}
            	if ( $shop_icon_style != "" ) {
            		$classes[] = 'shop-icon-' . $shop_icon_style;
				}
				
				// Minimal checkout
            	if ( isset($sf_options['minimal_checkout']) ) {

	            	if ( $sf_options['minimal_checkout'] ) {
		            	$classes[] = 'minimal-checkout';
	            	}
            	}
            	
            	// Enable WooCommerce global filters
            	$global_filters = false;
            	if ( isset($sf_options['enable_woo_global_filters']) ) {
            		$global_filters = $sf_options['enable_woo_global_filters'];
            		
            		if ( $global_filters ) {
            			$classes[] = 'woo-global-filters-enabled';
            		}
            	}
            	
                // Check for Quickview
            	if ( class_exists( 'jckqv' ) ) {
            		$quickview_opts = get_option('jckqv_settings');
            		$quickview_pos = $quickview_opts['trigger_position_position'];
            		
            		if ( $quickview_pos == "afteritem" ) {
            			$classes[] = 'has-quickview-hover-btn';
            		}
            	}
            	
            }
			
			// Disable mobile animations
	        if ( $sf_options['disable_mobile_animations'] ) {
	            $classes[] = "disable-mobile-animations ";
	        }
	        
	        // Extra page class
	        if ( $post ) {
	            $extra_page_class = sf_get_post_meta( $post->ID, 'sf_extra_page_class', true );
	            if ( $extra_page_class != "" ) {
	            	$classes[] = $extra_page_class;
	            }
	        }
	        
	        if ( function_exists('mmm_get_theme_id_for_location') ) {
	            $theme = mmm_get_theme_id_for_location('main_navigation');
	        
	            if ( $theme == 'default' ) {
	            	$classes[] = 'mm-default-theme';
	            } else {
	            	$classes[] = 'mm-custom-theme';
	            }
	        }
	       
    		// Return
    		return $classes;
    	}
    	add_filter( 'body_class', 'sf_add_body_classes' );
    }
		

    /* TRACKING
    ================================================== */
    if ( ! function_exists( 'sf_tracking' ) ) {
        function sf_tracking() {
            $sf_options = sf_get_theme_opts();

            if ( $sf_options['google_analytics'] != "" ) {
                echo $sf_options['google_analytics'];
            }
        }

        add_action( 'wp_head', 'sf_tracking', 90 );
    }
?>
