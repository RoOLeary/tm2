<?php
	/*
	*
	*	Header Overrides
	*	------------------------------------------------
	*	Uplift specific functionality
	* 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
	*
	*/


	/*
	*	HEADER WRAP OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/core/sf-header.php
	*
	================================================== */
	if (!function_exists('sf_header_wrap')) {
		function sf_header_wrap($header_layout) {
			global $post;
			$sf_options = sf_get_theme_opts();

			$header_wrap_class = $logo_class = $app_header_style = "";
			if ( function_exists( 'sf_page_classes' ) ) {
				$page_classes = sf_page_classes();
				$header_layout = $page_classes['header-layout'];
				$header_wrap_class = $page_classes['header-wrap'];
				$logo_class = $page_classes['logo'];
			}
		
			$page_header_type = "standard";

			if (is_page() && $post) {
				$page_header_type = sf_get_post_meta($post->ID, 'sf_page_header_type', true);
				$app_header_style	  = sf_get_post_meta( $post->ID, 'sf_page_header_app_style', true );
			} else if (is_singular('post') && $post) {
				$post_header_type = sf_get_post_meta($post->ID, 'sf_page_header_type', true);
				$fw_media_display = sf_get_post_meta($post->ID, 'sf_fw_media_display', true);
				$page_title_style = sf_get_post_meta($post->ID, 'sf_page_title_style', true);
				if ($page_title_style == "fancy" || $fw_media_display == "fw-media-title" || $fw_media_display == "fw-media") {
					$page_header_type = $post_header_type;
				}
				$app_header_style	  = sf_get_post_meta( $post->ID, 'sf_page_header_app_style', true );
			} else if (is_singular('portfolio') && $post) {
				$port_header_type = sf_get_post_meta($post->ID, 'sf_page_header_type', true);
				$fw_media_display = sf_get_post_meta($post->ID, 'sf_fw_media_display', true);
				$page_title = sf_get_post_meta($post->ID, 'sf_page_title', true);
				$page_title_style = sf_get_post_meta($post->ID, 'sf_page_title_style', true);
				if ($page_title_style == "fancy" || !$page_title) {
					$page_header_type = $port_header_type;
				}
				$app_header_style	  = sf_get_post_meta( $post->ID, 'sf_page_header_app_style', true );
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

			$fullwidth_header = $sf_options['fullwidth_header'];
			$enable_mini_header = $sf_options['enable_mini_header'];
			$enable_tb = $sf_options['enable_tb'];
			$enable_sticky_tb = false;
			if ( isset( $sf_options['enable_sticky_topbar'] ) ) {
				$enable_sticky_tb = $sf_options['enable_sticky_topbar'];	
			}
			$header_left_config = $sf_options['header_left_config'];
			$header_right_config = $sf_options['header_right_config'];
			
			$default_header_style = "default";
			if ( $page_header_type == "naked-light" ) {
				$default_header_style = "light";
			} else if ( $page_header_type == "naked-dark" ) {
				$default_header_style = "dark";
			} 
			
			if (($page_header_type == "naked-light" || $page_header_type == "naked-dark") && ($header_layout == "header-vert" || $header_layout == "header-vert-right")) {
				$header_layout = apply_filters( 'sf_naked_header_default_header', 'header-3' );
				$header_wrap_class .= " full-center full-header-stick";
				$enable_tb = false;
			}
			
			if ( $app_header_style && ($header_layout == "header-6" || $header_layout == "header-8") ) {
				$header_layout = apply_filters( 'sf_app_header_default_header', 'header-3' );
				$header_wrap_class .= " full-center full-header-stick";
			}
		?>
			<?php if ( $enable_tb ) { ?>
				<!--// TOP BAR //-->
				<?php echo sf_top_bar( $enable_sticky_tb ); ?>
			<?php } ?>

			<!--// HEADER //-->
			<div class="header-wrap <?php echo esc_attr($header_wrap_class); ?> page-header-<?php echo esc_attr($page_header_type); ?>" data-style="<?php echo esc_attr($default_header_style); ?>" data-default-style="<?php echo esc_attr($default_header_style); ?>">

				<div id="header-section" class="<?php echo esc_attr($header_layout); ?> <?php echo esc_attr($logo_class); ?>">
					<?php if ($enable_mini_header) {
							echo sf_header($header_layout);
						} else {
							echo '<div class="sticky-wrapper">'.sf_header($header_layout).'</div>';
						}
					?>
				</div>


				<?php
					// Fullscreen Search
					if (isset($header_left_config) && array_key_exists('supersearch', $header_left_config['enabled']) || isset($header_right_config) && array_key_exists('supersearch', $header_right_config['enabled'])) {
					echo sf_fullscreen_supersearch();
					}
				?>

				<?php
					// Overlay Menu
					if (isset($header_left_config) && array_key_exists('overlay-menu', $header_left_config['enabled']) || isset($header_right_config) && array_key_exists('overlay-menu', $header_right_config['enabled'])) {
						echo sf_overlay_menu();
					}
				?>

				<?php
					// Contact Slideout
					if (isset($header_left_config) && array_key_exists('contact', $header_left_config['enabled']) || isset($header_right_config) && array_key_exists('contact', $header_right_config['enabled'])) {
						echo sf_contact_slideout();
					}
				?>

			</div>

		<?php }
		add_action('sf_container_start', 'sf_header_wrap', 20);
	}

	function sf_top_bar( $sticky = false ) {
		$sf_options = sf_get_theme_opts();
		$fullwidth_header = $sf_options['fullwidth_header'];
		$tb_left_config = $sf_options['tb_left_config'];
		$tb_right_config = $sf_options['tb_right_config'];
		$tb_left_text = $sf_options['tb_left_text'];
		$tb_right_text = $sf_options['tb_right_text'];

		$tb_left_output = $tb_right_output = "";
		if ($tb_left_config == "social") {
		$tb_left_output .= do_shortcode('[social]'). "\n";
		} else if ($tb_left_config == "account") {
		$tb_left_output .= sf_get_account(). "\n";
		} else if ($tb_left_config == "menu") {
		$tb_left_output .= sf_top_bar_menu(). "\n";
		} else if ($tb_left_config == "cart-wishlist") {
		$tb_left_output .= '<div class="aux-item aux-cart-wishlist"><nav class="std-menu cart-wishlist"><ul class="menu">'. "\n";
		$tb_left_output .= sf_get_cart();
		$tb_left_output .= sf_get_wishlist();
		$tb_left_output .= '</ul></nav></div>'. "\n";
		} else if ($tb_left_config == "currency-switcher") {
		$tb_left_output .= '<div class="aux-item aux-currency"><nav class="std-menu currency"><ul class="menu">'. "\n";
		$tb_left_output .= sf_get_currency_switcher();
		$tb_left_output .= '</ul></nav></div>'. "\n";
		} else {
		$tb_left_output .= '<div class="tb-text">'.do_shortcode($tb_left_text).'</div>'. "\n";
		}

		if ($tb_right_config == "social") {
		$tb_right_output .= do_shortcode('[social]'). "\n";
		} else if ($tb_right_config == "account") {
		$tb_right_output .= sf_get_account(). "\n";
		} else if ($tb_right_config == "menu") {
		$tb_right_output .= sf_top_bar_menu(). "\n";
		} else if ($tb_right_config == "cart-wishlist") {
		$tb_right_output .= '<div class="aux-item aux-cart-wishlist"><nav class="std-menu cart-wishlist"><ul class="menu">'. "\n";
		$tb_right_output .= sf_get_cart();
		$tb_right_output .= sf_get_wishlist();
		$tb_right_output .= '</ul></nav></div>'. "\n";
		} else if ($tb_right_config == "currency-switcher") {
		$tb_right_output .= '<div class="aux-item aux-currency"><nav class="std-menu currency"><ul class="menu">'. "\n";
		$tb_right_output .= sf_get_currency_switcher();
		$tb_right_output .= '</ul></nav></div>'. "\n";		
		} else {
		$tb_right_output .= '<div class="tb-text">'.do_shortcode($tb_right_text).'</div>'. "\n";
		}

		$top_bar_class = "";
		if ($sticky) {
			$top_bar_class = "sticky-top-bar";
		}
		?>

		<div id="top-bar" class="<?php echo esc_attr($top_bar_class); ?>">
			<?php if ($fullwidth_header) { ?>
			<div class="container fw-header">
			<?php } else { ?>
			<div class="container">
			<?php } ?>
				<div class="col-sm-6 tb-left"><?php echo $tb_left_output; ?></div>
				<div class="col-sm-6 tb-right"><?php echo $tb_right_output; ?></div>
			</div>
		</div>
		<?php
	}

	/*
	*	HEADER MENU OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/core/sf-header.php
	*
	================================================== */
	if (!function_exists('sf_main_menu')) {
		function sf_main_menu($id, $layout = "") {

			// VARIABLES
			global $post;
			$sf_options = sf_get_theme_opts();
			
			$show_cart = $show_wishlist = false;
			if ( isset($sf_options['show_cart']) ) {
			$show_cart            = $sf_options['show_cart'];
			}
			if ( isset($sf_options['show_wishlist']) ) {
			$show_wishlist            = $sf_options['show_wishlist'];
			}
			$vertical_header_text = $sf_options['vertical_header_text'];
			$page_menu = $menu_output = $menu_full_output = $menu_with_search_output = $menu_float_output = $menu_vert_output = "";

			if ($post) {
				$page_menu = sf_get_post_meta($post->ID, 'sf_page_menu', true);
			}
			
			$main_menu_args = array(
				'echo'            => false,
				'theme_location' => 'main_navigation',
				'walker' => new sf_mega_menu_walker,
				'fallback_cb' => '',
				'menu' => $page_menu
			);


			// MENU OUTPUT
			$menu_output .= '<nav id="'.$id.'" class="std-menu clearfix">'. "\n";

			if (function_exists('wp_nav_menu')) {
				if (has_nav_menu('main_navigation')) {
					$menu_output .= wp_nav_menu( $main_menu_args );
				}
			}
			$menu_output .= '</nav>'. "\n";


			// FULL WIDTH MENU OUTPUT
			if ($layout == "full") {

				$menu_full_output .= '<div class="container">'. "\n";
				$menu_full_output .= '<div class="row">'. "\n";
				$menu_full_output .= '<div class="menu-left">'. "\n";
				$menu_full_output .= $menu_output . "\n";
				$menu_full_output .= '</div>'. "\n";
				$menu_full_output .= '<div class="header-right menu-right">'. "\n";
				$menu_full_output .= sf_header_aux('right'). "\n";
				$menu_full_output .= '</div>'. "\n";
				$menu_full_output .= '</div>'. "\n";
				$menu_full_output .= '</div>'. "\n";

				$menu_output = $menu_full_output;
			
			} else if ( $layout == "right-nav-aux" ) {
				
				$menu_right_aux_output = '<div class="container">' . "\n";
				$menu_right_aux_output .= '<div class="row">' . "\n";
				$menu_right_aux_output .= '<div class="menu-left">' . "\n";
				$menu_right_aux_output .= $menu_output . "\n";
				$menu_right_aux_output .= '</div>' . "\n";
				$menu_right_aux_output .= '<div class="header-right menu-right">' . "\n";
				$menu_right_aux_output .= sf_header_aux('right', true). "\n";
				$menu_right_aux_output .= '</div>' . "\n";
				$menu_right_aux_output .= '</div>' . "\n";
				$menu_right_aux_output .= '</div>' . "\n";
				
				$menu_output = $menu_right_aux_output;	
			
			} else if ( $layout == "both-nav-aux" ) {
				
				$menu_both_aux_output = '<div class="container">' . "\n";
				$menu_both_aux_output .= '<div class="row">' . "\n";
				$menu_both_aux_output .= '<div class="header-left menu-left">' . "\n";
				$menu_both_aux_output .= sf_header_aux('left', true). "\n";
				$menu_both_aux_output .= '</div>' . "\n";
				$menu_both_aux_output .= '<div class="menu-center">' . "\n";
				$menu_both_aux_output .= $menu_output . "\n";
				$menu_both_aux_output .= '</div>' . "\n";
				$menu_both_aux_output .= '<div class="header-right menu-right">' . "\n";
				$menu_both_aux_output .= sf_header_aux('right', true). "\n";
				$menu_both_aux_output .= '</div>' . "\n";
				$menu_both_aux_output .= '</div>' . "\n";
				$menu_both_aux_output .= '</div>' . "\n";
				
				$menu_output = $menu_both_aux_output;
				
			} else if ( $layout == "float" ) {
			
				$menu_float_output .= '<div class="float-menu container">'. "\n";
				$menu_float_output .= $menu_output . "\n";
				$menu_float_output .= '</div>'. "\n";

				$menu_output = $menu_float_output;
								
			} else if ( $layout == "float-2" ) {

				$menu_float_output .= '<div class="float-menu">'. "\n";
				$menu_float_output .= $menu_output . "\n";
				$menu_float_output .= '</div>'. "\n";

				$menu_output = $menu_float_output;

			} else if ( $layout == "vertical" ) {

				$menu_vert_output .= $menu_output . "\n";
				$menu_vert_output .= '<div class="vertical-menu-bottom">'. "\n";
				$menu_vert_output .= sf_header_aux('right');
				$menu_vert_output .= '<div class="copyright">'.do_shortcode(stripslashes($vertical_header_text)).'</div>'. "\n";
				$menu_vert_output .= '</div>'. "\n";

				$menu_output = $menu_vert_output;
			}

			// MENU RETURN
			return $menu_output;
		}
	}


	/*
	*	HEADER SEARCH OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/core/sf-header.php
	*
	================================================== */
	if (!function_exists('sf_get_search')) {
		function sf_get_search($type) {
	
			if ($type == "search-off") {
				return;
			}
	
			$sf_options = sf_get_theme_opts();
			$header_search_type = $sf_options['header_search_type'];
			$header_search_pt = $sf_options['header_search_pt'];
	
			if ($type == "aux") {
				$type = $header_search_type;
			}
	
			$search_output = "";
	
			if ($type == "full-header-search") {
				$search_output .= '<li class="menu-search parent"><a href="#" class="header-search-link fs-header-search-link"><i class="sf-icon-search"></i></a></li>'. "\n";
			} else {
				$search_output .= '<li class="menu-search parent"><a href="#" class="header-search-link header-search-link-alt"><i class="sf-icon-search"></i></a>'. "\n";
				$search_output .= '<ul class="header-search-wrap sub-menu"><li><form method="get" class="header-search-form" action="'.home_url().'/">';
				if ($header_search_pt != "any") {
				$search_output .= '<input type="hidden" name="post_type" value="'.esc_attr($header_search_pt).'" />';
				}
				$search_output .= '<input type="text" placeholder="'.__("Type and hit enter to search", 'uplift').'" name="s" autocomplete="off" /></form></li></ul>'. "\n";
				$search_output .= '</li>'. "\n";
			}
	
			return $search_output;
		}
	}


	/*
	*	HEADER AUX OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/core/sf-header.php
	*
	================================================== */
	if (!function_exists('sf_header_aux')) {
		function sf_header_aux( $aux, $nav = false ) {

			$sf_options = sf_get_theme_opts();

			$config = array();
			$aux_output = $header_left_text = $header_right_text = $nav_left_text = $nav_right_text = "";
			
			if ( isset($sf_options['header_left_text']) ) {
			$header_left_text = $sf_options['header_left_text'];
			}
			if ( isset($sf_options['header_right_text']) ) {
			$header_right_text = $sf_options['header_right_text'];
			}
			if ( isset($sf_options['nav_left_text']) ) {
			$nav_left_text = $sf_options['nav_left_text'];
			}
			if ( isset($sf_options['nav_right_text']) ) {
			$nav_right_text = $sf_options['nav_right_text'];
			}
			
			$contact_icon = apply_filters('sf_header_contact_icon', '<i class="ss-mail"></i>');
			$supersearch_icon = apply_filters('sf_header_supersearch_icon', '<i class="ss-zoomin"></i>');
			$ajax_url = admin_url('admin-ajax.php');

			if ($aux == "left") {
				$config = $sf_options['header_left_config'];
			} else if ($aux == "right") {
				$config = $sf_options['header_right_config'];
			}
			
			if ( $nav ) {
				if ($aux == "left") {
					$config = $sf_options['nav_left_config'];
				} else if ($aux == "right") {
					$config = $sf_options['nav_right_config'];
				}
			}

			if (!empty($config) && isset($config['enabled'])) {

				foreach ($config['enabled'] as $item_id => $item) {

					if ($item_id == "social") {
						$aux_output .= '<div class="aux-item aux-item-social">' . do_shortcode('[social]'). '</div>'. "\n";
					} else if ($item_id == "aux-links") {
						$aux_output .= '<div class="aux-item aux-links">' . sf_aux_links('header-menu', TRUE, "header-1") . '</div>'. "\n";
					} else if ($item_id == "cart-wishlist") {
						$aux_output .= '<div class="aux-item aux-cart-wishlist"><nav class="std-menu cart-wishlist"><ul class="menu">'. "\n";
						$aux_output .= sf_get_cart();
						$aux_output .= sf_get_wishlist();
						$aux_output .= '</ul></nav></div>'. "\n";
					} else if ($item_id == "currency-switcher") {
						$aux_output .= '<div class="aux-item aux-currency"><nav class="std-menu currency"><ul class="menu">'. "\n";
						$aux_output .= sf_get_currency_switcher();
						$aux_output .= '</ul></nav></div>'. "\n";
					} else if ($item_id == "supersearch") {
						$aux_output .= '<div class="aux-item aux-supersearch"><a href="#" class="fs-supersearch-link">'.$supersearch_icon.'<span>'.__("Super Search", 'uplift').'</span></a></div>'. "\n";
					} else if ($item_id == "overlay-menu") {
						$aux_output .= '<div class="aux-item aux-overlay-menu"><a href="#" class="overlay-menu-link menu-bars-link"><span>'.__("Menu", 'uplift').'</span></a></div>'. "\n";
					} else if ($item_id == "side-slideout" && $aux == "left") {
						$aux_output .= '<div class="aux-item aux-sidemenu"><a href="#" class="side-slideout-link menu-bars-link" data-side="left"><span>'.__("Menu", 'uplift').'</span></a></div>'. "\n";
					} else if ($item_id == "side-slideout" && $aux == "right") {
						$aux_output .= '<div class="aux-item aux-sidemenu"><a href="#" class="side-slideout-link menu-bars-link" data-side="right"><span>'.__("Menu", 'uplift').'</span></a></div>'. "\n";
					} else if ($item_id == "push-nav") {
						$aux_output .= '<div class="aux-item aux-pushnav"><a href="#" class="sf-pushnav-trigger menu-bars-link" data-side="right"><span>'.__("Menu", 'uplift').'</span></a></div>'. "\n";
					} else if ($item_id == "contact") {
						$aux_output .= '<div class="aux-item aux-contact"><a href="#" class="contact-menu-link">'.$contact_icon.'</a></div>'. "\n";
					} else if ($item_id == "search") {
						$aux_output .= '<div class="aux-item aux-search"><nav class="std-menu">'. "\n";
						$aux_output .= '<ul class="menu">'. "\n";
						$aux_output .= sf_get_search('aux');
						$aux_output .= '</ul>'. "\n";
						$aux_output .= '</nav></div>'. "\n";
					} else if ($item_id == "account") {
						$aux_output .= '<div class="aux-item aux-account">'. "\n";
						$aux_output .= sf_get_account('aux');
						$aux_output .= '</div>'. "\n";
					} else if ($item_id == "account-text") {
						$aux_output .= '<div class="aux-item aux-text aux-account-text">'. "\n";
						$aux_output .= sf_get_account('aux-text');
						$aux_output .= '</div>'. "\n";
					} else if ($item_id == "language") {
						$aux_output .= '<div class="aux-item aux-language">'. "\n";
						$aux_output .= sf_get_language_aux('aux');
						$aux_output .= '</div>'. "\n";
					} else if ($item_id == "language-text") {
						$aux_output .= '<div class="aux-item aux-text aux-language-text">'. "\n";
						$aux_output .= sf_get_language_aux('aux-text');
						$aux_output .= '</div>'. "\n";
					} else if ($item_id == "text" && $aux == "left") {
						$aux_output .= '<div class="aux-item text">'.do_shortcode($header_left_text).'</div>'. "\n";
					} else if ($item_id == "text" && $aux == "right") {
						$aux_output .= '<div class="aux-item text">'.do_shortcode($header_right_text).'</div>'. "\n";
					}

				}

			}

			return $aux_output;
		}
	}


	/*
	*	OVERLAY MENU OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/core/sf-header.php
	*
	================================================== */
    if ( ! function_exists( 'sf_overlay_menu' ) ) {
        function sf_overlay_menu() {

            global $post;

            $overlayMenu = $page_menu = "";

            if ( $post && !is_search() ) {
                $page_menu = sf_get_post_meta( $post->ID, 'sf_page_menu', true );
            }

            $fs_close_icon = apply_filters( 'sf_fullscreen_close_icon', '<i class="ss-delete"></i>' );
            $overlay_menu_args = array(
                'echo'           => false,
                'theme_location' => 'overlay_menu',
                'fallback_cb'    => '',
                'menu'			 => $page_menu
            );

            $overlayMenu .= '<div id="overlay-menu">';
            $overlayMenu .= '<a href="#" class="fs-overlay-close">';
            $overlayMenu .= $fs_close_icon;
            $overlayMenu .= '</a>';
            $overlayMenu .= '<nav>';
            if ( function_exists( 'wp_nav_menu' ) ) {
                $overlayMenu .= wp_nav_menu( $overlay_menu_args );
            }
            $overlayMenu .= '</nav>';
            $overlayMenu .= '</div>';


            return $overlayMenu;
        }
    }


    /*
	*	MOBILE MENU OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/content/sf-header.php
	*
	================================================== */
    if ( ! function_exists( 'sf_mobile_menu' ) ) {
        function sf_mobile_menu() {

            global $post, $woocommerce;
            $sf_options = sf_get_theme_opts();
						
			$mobile_header_layout = $sf_options['mobile_header_layout'];
            $mobile_show_translation = $sf_options['mobile_show_translation'];
            $mobile_show_search      = $sf_options['mobile_show_search'];
            $header_search_pt = $sf_options['header_search_pt'];
            
            $mobile_menu_type        = "slideout";
            $fs_close_icon = apply_filters( 'sf_fullscreen_close_icon', '<i class="ss-delete"></i>' );
            if ( isset( $sf_options['mobile_menu_type'] ) ) {
                $mobile_menu_type = $sf_options['mobile_menu_type'];
            }
            $page_menu = "";

            if ( $post && !is_search() ) {
                $page_menu = sf_get_post_meta( $post->ID, 'sf_page_menu', true );
            }

            $mobile_show_cart    = $sf_options['mobile_show_cart'];
            $mobile_show_account = $sf_options['mobile_show_account'];
            $login_url           = wp_login_url();
            $logout_url          = wp_logout_url( home_url() );
            $my_account_link     = get_admin_url();
            $myaccount_page_id   = get_option( 'woocommerce_myaccount_page_id' );
            if ( $myaccount_page_id ) {
                $my_account_link = get_permalink( $myaccount_page_id );
                $logout_url      = wp_logout_url( get_permalink( $myaccount_page_id ) );
                $login_url       = get_permalink( $myaccount_page_id );
                if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ) {
                    $logout_url = str_replace( 'http:', 'https:', $logout_url );
                    $login_url  = str_replace( 'http:', 'https:', $login_url );
                }
            }
            $login_url        = apply_filters( 'sf_header_login_url', $login_url );
            $register_url	  = apply_filters( 'sf_header_register_url', wp_registration_url() );
            $my_account_link  = apply_filters( 'sf_header_myaccount_url', $my_account_link );

			if ( get_option( 'woocommerce_enable_myaccount_registration' ) && $myaccount_page_id ) {
				$register_url = apply_filters( 'sf_header_register_url', $my_account_link );
			}

            $mobile_menu_args = array(
                'echo'           => false,
                'theme_location' => 'mobile_menu',
                'walker'         => new sf_alt_menu_walker,
                'fallback_cb'    => '',
                'menu'			 => $page_menu
            );

            $mobile_menu_output = "";

            if ( $mobile_header_layout == "left-logo" || $mobile_header_layout == "center-logo-alt" ) {
            	$mobile_menu_output .= '<div id="mobile-menu-wrap" class="menu-is-right">' . "\n";
            } else {
            	$mobile_menu_output .= '<div id="mobile-menu-wrap" class="menu-is-left">' . "\n";
            }

            $mobile_menu_output .= '<nav id="mobile-menu" class="clearfix">' . "\n";

            if ( function_exists( 'wp_nav_menu' ) ) {
                $mobile_menu_output .= wp_nav_menu( $mobile_menu_args );
            }

			$mobile_menu_output .= '<ul class="alt-mobile-menu">' . "\n";

            if ( sf_woocommerce_activated() ) {

				if ( $mobile_show_cart ) {
					$mobile_menu_output .= sf_get_cart();
					$mobile_menu_output .= sf_get_wishlist();
				}

				if ( $mobile_show_account ) {
					if ( is_user_logged_in() ) {
                        $mobile_menu_output .= '<li><a href="' . $my_account_link . '" class="admin-link">' . __( "My Account", 'uplift' ) . '</a></li>' . "\n";
                        $mobile_menu_output .= '<li><a href="' . $logout_url . '">' . __( "Logout", 'uplift' ) . '</a></li>' . "\n";
                    } else {
                        $mobile_menu_output .= '<li><a href="' . $login_url . '">' . __( "Login", 'uplift' ) . '</a></li>' . "\n";
                        $mobile_menu_output .= '<li><a href="' . $register_url . '">' . __( "Sign Up", 'uplift' ) . '</a></li>' . "\n";
                    }
				}

	        }

			$mobile_menu_output .= '</ul>' . "\n";

            $mobile_menu_output .= '</nav>' . "\n";
            
            $mobile_menu_output .= '<div class="mobile-menu-aux">' . "\n";
            
            if ( $mobile_show_translation && ( function_exists( 'pll_the_languages' ) || function_exists( 'icl_get_languages' ) ) ) {
                $mobile_menu_output .= '<ul class="mobile-language-select">' . sf_language_flags() . '</ul>' . "\n";
            }
            if ( $mobile_show_search ) {
                $mobile_menu_output .= '<form method="get" class="mobile-search-form" action="' . esc_url( home_url() ) . '/">' . "\n";
                if ($header_search_pt != "any") {
                $mobile_menu_output .= '<input type="hidden" name="post_type" value="' . esc_attr( $header_search_pt ) . '" />' . "\n";
                }
				$mobile_menu_output .= '<input type="text" placeholder="' . esc_attr__( "Search", 'uplift' ) . '" name="s" autocomplete="off" />' . "\n";
                $mobile_menu_output .= '</form>' . "\n";
            }
            $mobile_menu_output .= '</div>' . "\n";
                        
            $mobile_menu_output .= '</div>' . "\n";

            echo $mobile_menu_output;
        }

        add_action( 'sf_container_start', 'sf_mobile_menu', 10 );
    }
    
    
    /*
    *	MOBILE CART OVERRIDE
    *	------------------------------------------------
    *	@original - /swift-framework/content/sf-header.php
    *
    ================================================== */
    if ( ! function_exists( 'sf_mobile_cart' ) ) {
        function sf_mobile_cart() {

            global $woocommerce;
            $sf_options = sf_get_theme_opts();

			$mobile_header_layout = $sf_options['mobile_header_layout'];
            $mobile_show_cart    = $sf_options['mobile_show_cart'];
            $mobile_show_account = $sf_options['mobile_show_account'];
            $login_url           = wp_login_url();
            $logout_url          = wp_logout_url( home_url() );
            $my_account_link     = get_admin_url();
            $myaccount_page_id   = get_option( 'woocommerce_myaccount_page_id' );
            if ( $myaccount_page_id ) {
                $my_account_link = get_permalink( $myaccount_page_id );
                $logout_url      = wp_logout_url( get_permalink( $myaccount_page_id ) );
                $login_url       = get_permalink( $myaccount_page_id );
                if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ) {
                    $logout_url = str_replace( 'http:', 'https:', $logout_url );
                    $login_url  = str_replace( 'http:', 'https:', $login_url );
                }
            }
            $login_url        = apply_filters( 'sf_header_login_url', $login_url );
            $my_account_link  = apply_filters( 'sf_header_myaccount_url', $my_account_link );
            $fs_close_icon    = apply_filters( 'sf_fullscreen_close_icon', '<i class="ss-delete"></i>' );
            $mobile_menu_type = "slideout";
            if ( isset( $sf_options['mobile_menu_type'] ) ) {
                $mobile_menu_type = $sf_options['mobile_menu_type'];
            }

            $mobile_cart_output = "";

            if ( $mobile_show_cart && $woocommerce ) {
	            if ( $mobile_header_layout == "left-logo" || $mobile_header_layout == "center-logo-alt" ) {
	            	$mobile_cart_output .= '<div id="mobile-cart-wrap" class="cart-is-left">' . "\n";
	            } else {
	            	$mobile_cart_output .= '<div id="mobile-cart-wrap" class="cart-is-right">' . "\n";
	            }

                $mobile_cart_output .= '<ul>' . "\n";
                $mobile_cart_output .= sf_get_cart();
                $mobile_cart_output .= '</ul>' . "\n";
                if ( $mobile_show_account ) {
                    $mobile_cart_output .= '<ul class="mobile-cart-menu">' . "\n";
                    if ( is_user_logged_in() ) {
                        $mobile_cart_output .= '<li><a href="' . $my_account_link . '" class="admin-link">' . __( "My Account", 'uplift' ) . '</a></li>' . "\n";
                        $mobile_cart_output .= '<li><a href="' . $logout_url . '">' . __( "Sign Out", 'uplift' ) . '</a></li>' . "\n";
                    } else {
                        $mobile_cart_output .= '<li><a href="' . $login_url . '">' . __( "Login", 'uplift' ) . '</a></li>' . "\n";
                    }
                    $mobile_cart_output .= '</ul>' . "\n";
                }
                $mobile_cart_output .= '</div>' . "\n";
                echo $mobile_cart_output;
            }
        }

        add_action( 'sf_container_start', 'sf_mobile_cart', 20 );
    }
    
    
    if ( ! function_exists( 'sf_mobile_slideout_backdrop' ) ) {
        function sf_mobile_slideout_backdrop() {
			echo '<div id="sf-mobile-slideout-backdrop"></div>';
		}
        add_action( 'sf_container_start', 'sf_mobile_slideout_backdrop', 30 );
    }
	
	/* MEGA MENU OVERRIDES
	================================================== */
	if ( !function_exists( 'sf_max_mega_menu_remove_scripts' ) ) {
		function sf_max_mega_menu_remove_scripts() {
			
			if ( function_exists('mmm_get_theme_id_for_location') ) {
			    $theme = mmm_get_theme_id_for_location('main_navigation');
			
			    if ( $theme == 'default' ) {
			    	wp_enqueue_style( 'uplift-megamenu' );
			        //wp_dequeue_style( 'megamenu' );
			    }
			}
			
		}
		add_action( 'wp_enqueue_scripts', 'sf_max_mega_menu_remove_scripts', 1000 );
	}
	
	function sf_disable_megamenu_css_for_header_when_default_theme_is_used( $selector, $menu_id, $location ) {
		if ( function_exists('mmm_get_theme_id_for_location') ) {
		    $theme = mmm_get_theme_id_for_location('main_navigation');
		
		    if ( $theme == 'default' && $location == 'main_navigation' ) {
		    	return $selector . "-disabed";
		    }
		}

		return $selector;
	}
	add_filter('megamenu_scss_wrap_selector', 'sf_disable_megamenu_css_for_header_when_default_theme_is_used', 10, 3);
	
	function uplift_megamenu_add_theme_uplift_1479912365($themes) {
	    $themes["uplift_1479912365"] = array(
	        'title' => 'uplift',
	        'container_background_from' => 'rgba(255, 255, 255, 0.1)',
	        'container_background_to' => 'rgba(255, 255, 255, 0.1)',
	        'menu_item_background_hover_from' => 'rgba(255, 255, 255, 0.1)',
	        'menu_item_background_hover_to' => 'rgba(255, 255, 255, 0.1)',
	        'menu_item_link_height' => '56px',
	        'menu_item_link_color' => 'rgb(34, 34, 34)',
	        'menu_item_link_color_hover' => 'rgb(75, 231, 236)',
	        'menu_item_border_color' => 'rgba(255, 255, 255, 0.1)',
	        'panel_header_margin_bottom' => '20px',
	        'panel_header_border_color' => '#555',
	        'panel_padding_left' => '10px',
	        'panel_padding_right' => '10px',
	        'panel_padding_top' => '15px',
	        'panel_padding_bottom' => '15px',
	        'panel_widget_padding_left' => '20px',
	        'panel_widget_padding_right' => '20px',
	        'panel_widget_padding_top' => '0px',
	        'panel_widget_padding_bottom' => '0px',
	        'panel_font_size' => '14px',
	        'panel_font_color' => '#666',
	        'panel_font_family' => 'inherit',
	        'panel_second_level_font_color' => '#555',
	        'panel_second_level_font_color_hover' => '#555',
	        'panel_second_level_text_transform' => 'uppercase',
	        'panel_second_level_font' => 'inherit',
	        'panel_second_level_font_size' => '16px',
	        'panel_second_level_font_weight' => 'bold',
	        'panel_second_level_font_weight_hover' => 'bold',
	        'panel_second_level_text_decoration' => 'none',
	        'panel_second_level_text_decoration_hover' => 'none',
	        'panel_second_level_border_color' => '#555',
	        'panel_third_level_font_color' => '#666',
	        'panel_third_level_font_color_hover' => '#666',
	        'panel_third_level_font' => 'inherit',
	        'panel_third_level_font_size' => '14px',
	        'flyout_link_size' => '14px',
	        'flyout_link_color' => '#666',
	        'flyout_link_color_hover' => '#666',
	        'flyout_link_family' => 'inherit',
	        'line_height' => '2',
	        'toggle_background_from' => '#222',
	        'toggle_background_to' => '#222',
	        'toggle_font_color' => 'rgb(34, 34, 34)',
	        'toggle_bar_height' => '56px',
	        'mobile_background_from' => '#222',
	        'mobile_background_to' => '#222',
	        'custom_css' => '/** Push menu onto new line **/
	#{$wrap} {
	    clear: both;
	}',
	    );
	    return $themes;
	}
	add_filter("megamenu_themes", "uplift_megamenu_add_theme_uplift_1479912365");
	
	
	function uplift_megamenu_override_default_theme( $value ) {
		// change 'primary' to your menu location ID
		if ( !isset($value['primary']['theme']) ) {
			$value['primary']['theme'] = 'uplift_1479912365'; // change my_custom_theme_key to the ID of your exported theme
		}
		return $value;
	}
	add_filter('default_option_megamenu_settings', 'uplift_megamenu_override_default_theme');
	
		
	if ( !function_exists( 'sf_max_mega_menu_css_class' ) ) {
		function sf_max_mega_menu_css_class( $classes, $item, $args ) {
			
			$hideheadings    = empty( $item->hideheadings ) ? "" : "no-headings";
			$menuitembtn     = empty( $item->menuitembtn ) ? "" : "sf-menu-item-btn";			
			$loggedinvis     = empty( $item->loggedinvis ) ? "" : "sf-menu-item-loggedin";
			$loggedoutvis    = empty( $item->loggedoutvis ) ? "" : "sf-menu-item-loggedout";
			
			$classes[] = $hideheadings;
			$classes[] = $menuitembtn;
			$classes[] = $loggedinvis;
			$classes[] = $loggedoutvis;
			
			return $classes;
			
		}
		add_filter( 'megamenu_nav_menu_css_class', 'sf_max_mega_menu_css_class', 10, 3 );
	}
	
	
	if ( !function_exists( 'sf_max_megamenu_nav_menu_link_attributes' ) ) {
		function sf_max_megamenu_nav_menu_link_attributes( $atts, $item, $args ) {
		
			$menuitembtn     = empty( $item->menuitembtn ) ? false : true;
			$buttontype	     = empty( $item->buttontype ) ? "" : $item->buttontype;
			$buttoncolour	 = empty( $item->buttoncolour ) ? "" : $item->buttoncolour;		
			
			if ( $menuitembtn ) {
				if ( $buttontype == "rounded-bordered" ) {
					$buttontype = "rounded bordered";
				}
				$atts['class'] = $atts['class'] . ' sf-button';
				$atts['class'] = $atts['class'] . ' ' . $buttontype;
				$atts['class'] = $atts['class'] . ' ' . $buttoncolour;
			}
			
			return $atts;
			
		}
		add_filter( 'megamenu_nav_menu_link_attributes', 'sf_max_megamenu_nav_menu_link_attributes', 10, 3 );
	}
	
	
	if ( !function_exists( 'sf_max_mega_menu_nav_menu_start_el' ) ) {
		function sf_max_mega_menu_nav_menu_start_el( $item_output, $item, $depth, $args ) {
			
			$newbadge = empty( $item->newbadge ) ? false : true;
			
			if ( $newbadge ) {
				$item_output = str_replace( '</a>', '<sup class="new-badge">' . __( "New", 'uplift' ) . '</sup></a>', $item_output );
			}
			
			return $item_output;
			
		}
		add_filter( 'megamenu_walker_nav_menu_start_el', 'sf_max_mega_menu_nav_menu_start_el', 10, 4 );
	}
	
	
	if ( !function_exists( 'sf_max_mega_menu_icon_tabs' ) ) {
		function sf_max_mega_menu_icon_tabs( $icon_tabs, $menu_item_id, $menu_id, $menu_item_depth, $menu_item_meta ) {
			
			$icon_tabs['dashicons']['active'] = false;
			unset($icon_tabs['genericons']);
			unset($icon_tabs['custom']);
						
			$icon_tabs['fontawesome'] = array(
				                'title' => __("Font Awesome", 'uplift'),
				                'active' => false,
				                'content' => sf_max_mega_menu_font_selector( 'font-awesome' )
			            	);
			
			$icon_tabs['nucleo-interface'] = array(
				                'title' => __("Nucleo - Interface", 'uplift'),
				                'active' => false,
				                'content' => sf_max_mega_menu_font_selector( 'nucleo-interface' )
			            	);
			
			$icon_tabs['nucleo-general'] = array(
				                'title' => __("Nucleo - General", 'uplift'),
				                'active' => true,
				                'content' => sf_max_mega_menu_font_selector( 'nucleo-general' )
			            	);
			            			            
			return $icon_tabs;
			
		}
		add_filter( 'megamenu_icon_tabs', 'sf_max_mega_menu_icon_tabs' );
	}
	
	function sf_max_mega_menu_font_selector( $font_name = "" ) {
        $return  = "<div class='disabled'><input id='disabled' class='radio' type='radio' rel='disabled' name='settings[icon]' value='disabled' />";
        $return .= "<label for='disabled'></label></div>";

		$return .= sf_get_icons_list( $font_name , 'mega-menu' );

        return $return;
    }
    
    function sf_max_mega_menu_page_menu_args( $args, $menu_id, $current_theme_location ) {
		
		$new_args = array();
				
		if ( is_singular() && isset($current_theme_location) && $current_theme_location == "main_navigation" ) {
	    	global $post;
	    	$page_menu = "";
	    	if ( $post ) {
	    		$page_menu = sf_get_post_meta($post->ID, 'sf_page_menu', true);
	    	}
	    	
	    	if ( $page_menu != "" ) {
	    		$new_args['menu'] = $page_menu;
	    		return $new_args;
	    	} else {
	    		return $args;	
	    	}
    	} else {
    		return $args;
    	}
    	
    }
    add_filter( 'megamenu_nav_menu_args', 'sf_max_mega_menu_page_menu_args', 10, 3 );
	
	
	/* FULL HEADER SEARCH
	================================================== */
	if ( !function_exists( 'sf_full_header_search' ) ) {
		function sf_full_header_search() {
			$sf_options = sf_get_theme_opts();
			$header_search_type = $sf_options['header_search_type'];
			$header_search_pt = $sf_options['header_search_pt'];
			if ( $header_search_type != "full-header-search" ) {
				return;
			}
			?>
			<div id="sf-full-header-search">
				<div class="container">
					<form method="get" class="header-search-form" action="<?php echo home_url(); ?>/">
						<?php if ($header_search_pt != "any") { ?>
						<input type="hidden" name="post_type" value="<?php echo esc_attr( $header_search_pt ); ?>" />
						<?php } ?>
						<input type="text" placeholder="<?php _e("Type and hit enter to search", 'uplift'); ?>" name="s" autocomplete="off" />
					</form>
					<a href="#" class="sf-fhs-close"><i class="sf-icon-remove-big"></i></a>
				</div>
			</div>
			<?php 
		}
		add_action( 'sf_header_start', 'sf_full_header_search' );
	}
	
	if ( !function_exists( 'sf_full_header_backdrop' ) ) {
		function sf_full_header_search_backdrop() {
			$sf_options = sf_get_theme_opts();
			$header_search_type = $sf_options['header_search_type'];
			$header_search_pt = $sf_options['header_search_pt'];
			if ( $header_search_type != "full-header-search" ) {
				return;
			}
			?>
			<div id="sf-full-header-search-backdrop"></div>
			<?php 
		}
		add_action( 'sf_main_container_end', 'sf_full_header_search_backdrop', 40 );
	}
	
	
	/* LANGUAGE FLAGS
    ================================================== */
    if ( ! function_exists( 'sf_language_flags' ) ) {
	    function sf_language_flags() {

	        $language_output = "";

	        if ( function_exists( 'pll_the_languages' ) ) {
	            $languages = pll_the_languages(array('raw' =>1 ));
	            if ( !empty( $languages ) ) {
	                foreach( $languages as $l ) {
	                    $language_output .= '<li>';
	                    if ( $l['flag'] ) {
	                        if ( !$l['current_lang'] ) {
	                        	$language_output .= '<a href="'.$l['url'].'"><img src="'.$l['flag'].'" height="12" alt="'.$l['slug'].'" width="18" /><span class="language name">'.$l['name'].'</span></a>'."\n";
	                        } else {
	                        	$language_output .= '<div class="current-language"><img src="'.$l['flag'].'" height="12" alt="'.$l['slug'].'" width="18" /><span class="language name">'.$l['name'].'</span></div>'."\n";
	                        }
	                    }
	                    $language_output .= '</li>';
	                 }
	            }
	        } else if ( function_exists( 'icl_get_languages' ) ) {
	        	global $sitepress_settings;
	            $languages = icl_get_languages( 'skip_missing=0&orderby=code' );
	            if ( ! empty( $languages ) ) {
	                foreach ( $languages as $l ) {
	                	$name = $l['translated_name'];
	                	if ( isset( $sitepress_settings['icl_lso_native_lang'] ) && $sitepress_settings['icl_lso_native_lang'] ) {
	                	    $name = $l['native_name'];
	                	}
	                    $language_output .= '<li>';
	                    if ( $l['country_flag_url'] ) {
	                        if ( ! $l['active'] ) {
	                            $language_output .= '<a href="' . $l['url'] . '"><img src="' . $l['country_flag_url'] . '" height="12" alt="' . $l['language_code'] . '" width="18" /><span class="language name">' . $name . '</span></a>' . "\n";
	                        } else {
	                            $language_output .= '<div class="current-language"><img src="' . $l['country_flag_url'] . '" height="12" alt="' . $l['language_code'] . '" width="18" /><span class="language name">' . $name . '</span></div>' . "\n";
	                        }
	                    }
	                    $language_output .= '</li>';
	                }
	            }
	        } else {
	            //echo '<li><div>No languages set.</div></li>';
	            $flags_url = get_template_directory_uri() . '/images/flags';
	            $language_output .= '<li><a href="#">DEMO - EXAMPLE PURPOSES</a></li><li><a href="#"><i class="sf-icon-flags-germany"></i><span class="language name">German</span></a></li><li><div class="current-language"><i class="sf-icon-flags-uk"></i><span class="language name">English</span></div></li><li><a href="#"><i class="sf-icon-flags-spain"></i><span class="language name">Spanish</span></a></li><li><a href="#"><i class="sf-icon-flags-france"></i><span class="language name">French</span></a></li>' . "\n";
	        }

	        return $language_output;
	    }
    }
    
    
    /* ACCOUNT
    ================================================== */
    if ( ! function_exists( 'sf_get_account' ) ) {
        function sf_get_account( $aux = "" ) {

        	// VARIABLES
            $login_url         = wp_login_url();
            $logout_url        = wp_logout_url( home_url() );
            $my_account_link   = get_admin_url();
            $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
            if ( $myaccount_page_id ) {
                $my_account_link = get_permalink( $myaccount_page_id );
                $logout_url      = wp_logout_url( get_permalink( $myaccount_page_id ) );
                $login_url       = get_permalink( $myaccount_page_id );
                if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ) {
                    $logout_url = str_replace( 'http:', 'https:', $logout_url );
                    $login_url  = str_replace( 'http:', 'https:', $login_url );
                }
            }
            $login_url       = apply_filters( 'sf_header_login_url', $login_url );
            $register_url	 = apply_filters( 'sf_header_register_url', wp_registration_url() );
            $my_account_link = apply_filters( 'sf_header_myaccount_url', $my_account_link );

			if ( get_option( 'woocommerce_enable_myaccount_registration' ) && $myaccount_page_id ) {
				$register_url = apply_filters( 'sf_header_register_url', $my_account_link );
			}

            $sf_options = sf_get_theme_opts();

            $show_sub         = $sf_options['show_sub'];
            $show_translation = false;
            if ( isset($sf_options['show_translation']) ) {
            	$show_translation = $sf_options['show_translation'];
            }
            $my_account_link_type = "modal";
            if ( isset($sf_options['my_account_link_type']) ) {
            	$my_account_link_type = $sf_options['my_account_link_type'];
            }
            $sub_code         = $sf_options['sub_code'];
            $account_output = "";
			$aux_account_modals = sf_theme_supports( 'header-aux-modals' ) && sf_woocommerce_activated() ? true : false;
			$user_logged_in = is_user_logged_in();
			
            // LINKS + SEARCH OUTPUT
            $account_output .= '<nav class="std-menu">' . "\n";
            $account_output .= '<ul class="menu">' . "\n";
            $account_output .= '<li class="parent account-item">' . "\n";
            
            if ( $user_logged_in ) {
            	
            	if ( $aux == "aux-text" ) {
            		$account_output .= '<a href="#">' . __( "My Account", 'uplift' ) . '</a>' . "\n";  
            	} else {
            		$account_output .= '<a href="#"><i class="sf-icon-account"></i></a>' . "\n";            
            	}
            	
            } else {
            	if ( $aux == "aux-text" ) {
            		if ( $my_account_link_type == "modal" ) {
	            		$account_output .= '<a href="#account-modal" data-toggle="modal">' . __( "My Account", 'uplift' ) . '</a>' . "\n";              			
            		} else {
 		           		$account_output .= '<a href="' . $my_account_link . '" class="admin-link">' . __( "My Account", 'uplift' ) . '</a>' . "\n";
            		}
            	} else {
            		if ( $my_account_link_type == "modal" ) {
            			$account_output .= '<a href="#account-modal" data-toggle="modal"><i class="sf-icon-account"></i></a>' . "\n";
            		} else {
            			$account_output .= '<a href="' . $my_account_link . '" class="admin-link"><i class="sf-icon-account"></i></a>' . "\n";  
            		}
            		          
            	}
            }
            
            if ( $user_logged_in ) {
				$account_output .= '<ul class="sub-menu">' . "\n";
                $account_output .= '<li class="menu-item"><a href="' . $my_account_link . '" class="admin-link">' . __( "My Account", 'uplift' ) . '</a></li>' . "\n";
                if ( $aux_account_modals ) {
                $account_output .= '<li class="menu-item track-order-menu-item"><a href="#track-order-modal" data-toggle="modal">' . __( "Track Order", 'uplift' ) . '</a></li>' . "\n";                
                }
                $account_output .= '<li class="menu-item"><a href="' . $logout_url . '">' . __( "Sign Out", 'uplift' ) . '</a></li>' . "\n";
                if ( $show_sub && $sub_code != "" ) {
                    $account_output .= '<li class="parent"><a href="#">' . __( "Subscribe", 'uplift' ) . '</a>' . "\n";
                    $account_output .= '<ul class="sub-menu">' . "\n";
                    $account_output .= '<li><div class="header-subscribe clearfix">' . "\n";
                    $account_output .= do_shortcode( $sub_code ) . "\n";
                    $account_output .= '</div></li>' . "\n";
                    $account_output .= '</ul>' . "\n";
                    $account_output .= '</li>' . "\n";
                }
                if ( $show_translation ) {
                    $account_output .= '<li class="parent aux-languages"><a href="#">' . __( "Language", 'uplift' ) . '</a>' . "\n";
                    $account_output .= '<ul class="header-languages sub-menu">' . "\n";
                    if ( function_exists( 'sf_language_flags' ) ) {
                        $account_output .= sf_language_flags();
                    }
                    $account_output .= '</ul>' . "\n";
                    $account_output .= '</li>' . "\n";
                }
           		$account_output .= '</ul>' . "\n";
            }
            $account_output .= '</li>' . "\n";
            $account_output .= '</ul>' . "\n";
            $account_output .= '</nav>' . "\n";
            
            if ( $aux_account_modals ) {
            	if ( $user_logged_in ) {
            		$tracking_url = "";
            		if ( isset( $sf_options['order_tracking_page'] ) ) {
            			$tracking_page    = $sf_options['order_tracking_page'];
            			if ( isset( $tracking_page ) ) {
            				$tracking_url = get_permalink( $tracking_page );
            			}
            		}
            		
            		if ( $tracking_url == "" ) {
					    $account_output .= '<div id="track-order-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="track-order-modal" aria-hidden="true" data-tracking-url="'.$tracking_url.'">
					        <div class="modal-dialog modal-alt">
					            <div class="modal-content">
					                <div class="modal-body">
					                    <p>Please select your tracking page in Theme Options > WooCommerce Options, in order for this feature to work.</p>
					                </div>
					            </div>
					        </div>
					    </div>';        		
            		} else {
		            	$account_output .= '<div id="track-order-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="track-order-modal" aria-hidden="true" data-tracking-url="'.$tracking_url.'">
			                <div class="modal-dialog modal-alt">
			                    <div class="modal-content">
			                        <div class="modal-body">
			                            <p class="impact-text">' . __( "Track your order", 'uplift' ) . '</p>
			                        	' . do_shortcode( '[woocommerce_order_tracking]' ) . '
			                        </div>
			                    </div>
			                </div>
		            </div>';
		            }
	            } else {
	            	
	            	$account_href = $my_account_link;
	            	
	            	if ( sf_woocommerce_activated() ) {
	            		$account_href = '#new-account';
	            	}
	            	
	            	$login_args = array(
	            		'echo'           => false,
	            		'label_log_in'   => __( 'Sign in', 'uplift' ),
	            	);
	            	$login_args = apply_filters('uplift_login_modal_args', $login_args);
	            	$account_output .= '<div id="account-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="account-modal" aria-hidden="true">
	            	    <div class="modal-dialog modal-alt">
	            	        <div class="modal-content">
	            	            <div class="modal-body">
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active"><a href="#sign-in" aria-controls="sign-in" role="tab" data-toggle="tab"><span>' . __( "Sign In", 'uplift' ) . '</span></a></li>
										
										<li role="presentation"><a href="' . $account_href . '" aria-controls="new-account" role="tab" data-toggle="tab"><span>' . __( "New Account", 'uplift' ) . '</span></a></li>
									</ul>	            	            	
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane active" id="sign-in">' . wp_login_form( $login_args ) . '<a class="lost-password" href="' . wp_lostpassword_url() . '">' . __( "Forgot your password?", 'uplift' ) . '</a>
										</div>
										<div role="tabpanel" class="tab-pane" id="new-account">' . sf_register_form() . '</div>
									</div>
	            	            </div>
	            	        </div>
	            	    </div>
	            	</div>';
	            }
            }

            // RETURN
            return $account_output;

        }
    }
    