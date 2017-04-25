<?php

/**
	ReduxFramework Sample Config File
	For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
**/

if ( !class_exists( "ReduxFramework" ) ) {
	return;
}

if ( !class_exists( "Redux_Framework_options_config" ) ) {
	class Redux_Framework_options_config {

		public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
//            if (strpos(Redux_Helpers::cleanFilePath(__FILE__), Redux_Helpers::cleanFilePath(get_stylesheet_directory())) !== false) {
//                $this->initSettings();
//            } else {
//                add_action('plugins_loaded', array($this, 'initSettings'), 10);
//            }

			// Used in theme, so we can bypass the above
			$this->initSettings();

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            //$this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }


            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);

            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }


		/**

			Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

		**/

		function change_arguments($args){
		    //$args['dev_mode'] = true;
			
			$args['google_update_weekly'] = true;
			
		    return $args;
		}


		/**

			Filter hook for filtering the default value of any given field. Very useful in development mode.

		**/

		function change_defaults($defaults){
		    $defaults['str_replace'] = "Testing filter hook!";

		    return $defaults;
		}


		// Remove the demo link and the notice of integrated demo from the redux-framework plugin
		function remove_demo() {

			// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
			if ( class_exists('ReduxFrameworkPlugin') ) {
				remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_meta_demo_mode_link'), null, 2 );
			}

			// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
			remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );

		}


		public function setSections() {

			/**
			 	Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
			 **/

			// Background Patterns Reader
			$sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
			$sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
			$template_directory = get_template_directory_uri();
			$preset_bgs = $template_directory . '/images/preset-backgrounds/';
			$sample_patterns      = array();

			if ( is_dir( $sample_patterns_path ) ) :

			  if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
			  	$sample_patterns = array();

			    while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

			      if( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
			      	$name = explode(".", $sample_patterns_file);
			      	$name = str_replace('.'.end($name), '', $sample_patterns_file);
			      	$sample_patterns[] = array( 'alt'=>$name,'img' => $sample_patterns_url . $sample_patterns_file );
			      }
			    }
			  endif;
			endif;

			ob_start();

			$ct = wp_get_theme();
			$this->theme = $ct;
			$item_name = $this->theme->get('Name');
			$tags = $this->theme->Tags;
			$screenshot = $this->theme->get_screenshot();
			$class = $screenshot ? 'has-screenshot' : '';

			$customize_title = sprintf( __( 'Customize &#8220;%s&#8221;','uplift' ), $this->theme->display('Name') );

			?>
			<div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
				<?php if ( $screenshot ) : ?>
					<?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
					<a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr( $customize_title ); ?>">
						<img src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview', 'uplift' ); ?>" />
					</a>
					<?php endif; ?>
					<img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview', 'uplift' ); ?>" />
				<?php endif; ?>

				<h4>
					<?php echo esc_attr($this->theme->display('Name')); ?>
				</h4>

				<div>
					<ul class="theme-info">
						<li><?php printf( __('By %s','uplift'), $this->theme->display('Author') ); ?></li>
						<li><?php printf( __('Version %s','uplift'), $this->theme->display('Version') ); ?></li>
						<li><?php echo '<strong>'.__('Tags', 'uplift').':</strong> '; ?><?php printf( $this->theme->display('Tags') ); ?></li>
					</ul>
					<p class="theme-description"><?php echo esc_attr($this->theme->display('Description')); ?></p>
					<?php if ( $this->theme->parent() ) {
						printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'uplift' ) . '</p>',
							__( 'http://codex.wordpress.org/Child_Themes','uplift' ),
							$this->theme->parent()->display( 'Name' ) );
					} ?>

				</div>

			</div>

			<?php
			$item_info = ob_get_contents();

			ob_end_clean();

			// ACTUAL DECLARATION OF SECTIONS

			if (isset($_GET['sf_welcome'])) {
				if($_GET['sf_welcome'] == "true") {
					$this->sections[] = array(
						'title' => __('Welcome', 'uplift'),
						'desc' => 'Welcome to Uplift.',
						'icon' => 'el-icon-star',
					    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
						'fields' => array(
							array(
							'id' => 'co_divide_1',
							'type' => 'divide'
							),
						),
					);
				}
			}

			$this->sections[] = array(
				'title' => __('General Options', 'uplift'),
				'desc' => '',
				'icon' => 'el-icon-wrench',
			    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
				'fields' => array(
					array(
						'id' => 'enable_responsive',
						'type' => 'button_set',
						'title' => __('Enable Responsive', 'uplift'),
						'subtitle' => __('Enable/Disable the responsive behaviour of the theme', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '1'
						),
					array(
						'id' => 'site_width_format',
						'type' => 'button_set',
						'title' => __('Site Max-Width px/%', 'uplift'),
						'subtitle' => __('Set the max-width format.', 'uplift'),
						'desc' => '',
						'options' => array('px' => 'px','percent' => '%'),
						'default' => 'px'
						),
					array(
					    'id' => 'site_maxwidth',
					    'type' => 'slider',
						'title' => __('Site Max-Width', 'uplift'),
						'subtitle' => __("Set the maximum width for the site, at it's largest. By default this is 1170px.", 'uplift'),
						"default" => "1170",
					    "min" => "940",
					    "step" => "10",
					    "max" => "2000",
					),
					array(
					    'id' => 'site_maxwidth_percent',
					    'type' => 'slider',
						'title' => __('Site Percentage Width', 'uplift'),
						'subtitle' => __("Set the percentage width for the site. The max-width above will be the restriction for the width.", 'uplift'),
						'required'  => array('site_width_format', '=', 'percent'),
						"default" => "80",
					    "min" => "50",
					    "step" => "2",
					    "max" => "100",
					),
					array(
						'id' => 'enable_rtl',
						'type' => 'button_set',
						'title' => __('Enable RTL mode', 'uplift'),
						'subtitle' => __('Enable this mode for right-to-left language mode', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
						'id' => 'page_layout',
						'type' => 'image_select',
						'title' => __('Page Layout', 'uplift'),
						'subtitle' => __('Select the page layout type', 'uplift'),
						'desc' => '',
						'options' => array(
										'boxed' => array('title' => 'Boxed', 'img' => $template_directory.'/images/page-bordered.png'),
										'fullwidth' => array('title' => 'Full Width', 'img' => $template_directory.'/images/page-fullwidth.png')
											),
						'default' => 'fullwidth'
						),
					array(
						'id' => 'enable_page_shadow',
						'type' => 'button_set',
						'title' => __('Page shadow', 'uplift'),
						'subtitle' => __('Enable the shadow for the boxed layout / vertical header setups.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '1'
						),
					array(
						'id' => 'enable_mobile_two_click',
						'type' => 'button_set',
						'title' => __('Mobile 2 Click', 'uplift'),
						'subtitle' => __('Enable two click/touch functionality on images with hover overlays on mobile devices. The first touch will show the hover overlay, and then the next touch will load the link.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '1'
						),
					array(
						'id' => 'enable_backtotop',
						'type' => 'button_set',
						'title' => __('Enable Back To Top', 'uplift'),
						'subtitle' => __('Enable the back to top button that appears in the bottom right corner of the screen.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '1'
						),
					array(
						'id' => 'sidebar_width',
						'type' => 'button_set',
						'title' => __('Sidebar Width', 'uplift'),
						'subtitle' => __('Enable/Disable the responsive behaviour of the theme', 'uplift'),
						'desc' => '',
						'options' => array('standard' => 'Standard (1/3)', 'reduced' => 'Reduced (1/4)'),
						'default' => 'standard'
						),
					array(
						'id' => 'enable_stickysidebars',
						'type' => 'button_set',
						'title' => __('Enable Sticky Sidebars', 'uplift'),
						'subtitle' => __('Enable the sidebars to be sticky on desktop when the sidebar is small enough to display completely while scrolling.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
						'id' => 'hero_heading_fixed_height',
						'type' => 'button_set',
						'title' => __('Disable Hero Heading Intro', 'uplift'),
						'subtitle' => __('Enable this option to disable the intro animation for the hero heading when the page loads.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
					    'id'    => 'general-divide',
					    'type'  => 'divide'
					),
					array(
						'id' => 'onepagenav_type',
						'type' => 'button_set',
						'title' => __('One Page Nav Type', 'uplift'),
						'subtitle' => __('Enable the display type to show when using the one page navigation (Page Meta Options).', 'uplift'),
						'desc' => '',
						'options' => array('standard' => 'Standard', 'arrows' => 'Count + Arrows'),
						'default' => 'arrows'
						),
					array(
						'id' => 'disable_pagecomments',
						'type' => 'button_set',
						'title' => __('Disable Page Comments', 'uplift'),
						'subtitle' => __('If you enable this option, then page comments will be disabled globally.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '1'
						),
					array(
						'id' => 'enable_twitter_rts',
						'type' => 'button_set',
						'title' => __('Enable Retweets in Twitter Assets', 'uplift'),
						'subtitle' => __('If you enable this option, then Retweets will be included in your twitter assets.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
					    'id'       => 'breadcrumb_in_heading',
					    'type'     => 'button_set',
					    'title'    => __( 'Show Breadcrumbs in Page Heading', 'uplift' ),
					    'subtitle' => __( 'If you enable this option, then breadcrumbs will show in the page heading, rather than on their own bar.', 'uplift' ),
					    'desc'     => '',
					    'options'  => array( '1' => 'On', '0' => 'Off' ),
					    'default'  => '1'
					),
					array(
						'id' => 'post_links_match_thumb',
						'type' => 'button_set',
						'title' => __('Post Title link matches thumbnail', 'uplift'),
						'subtitle' => __('Enable this option to force post title links to use the same link as the thumbnail.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
						'id' => 'general_divide_0',
						'type' => 'divide'
						),
					array(
						'id' => 'custom_favicon',
						'type' => 'media',
						'url'=> true,
						'title' => __('Custom favicon', 'uplift'),
						'subtitle' => __('Upload a 16px x 16px Png/Gif image that will represent your website favicon', 'uplift'),
						'desc' => ''
						),
					array(
						'id' => 'custom_ios_title',
						'type' => 'text',
						'title' => __('Custom iOS Bookmark Title', 'uplift'),
						'subtitle' => __('Enter a custom title for your site for when it is added as an iOS bookmark.', 'uplift'),
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'custom_ios_icon57',
						'type' => 'media',
						'url'=> true,
						'title' => __('Custom iOS 57x57', 'uplift'),
						'subtitle' => __('Upload a 57px x 57px Png image that will be your website bookmark on non-retina iOS devices.', 'uplift'),
						'desc' => ''
						),
					array(
						'id' => 'custom_ios_icon72',
						'type' => 'media',
						'url'=> true,
						'title' => __('Custom iOS 72x72', 'uplift'),
						'subtitle' => __('Upload a 72px x 72px Png image that will be your website bookmark on non-retina iOS devices.', 'uplift'),
						'desc' => ''
						),
					array(
						'id' => 'custom_ios_icon114',
						'type' => 'media',
						'url'=> true,
						'title' => __('Custom iOS 114x114', 'uplift'),
						'subtitle' => __('Upload a 114px x 114px Png image that will be your website bookmark on retina iOS devices.', 'uplift'),
						'desc' => ''
						),
					array(
						'id' => 'custom_ios_icon144',
						'type' => 'media',
						'url'=> true,
						'title' => __('Custom iOS 144x144', 'uplift'),
						'subtitle' => __('Upload a 144px x 144px Png image that will be your website bookmark on retina iOS devices.', 'uplift'),
						'desc' => ''
						),
					array(
						'id' => 'general_divide_1',
						'type' => 'divide'
						),
					array(
						'id' => 'rss_feed_url',
						'type' => 'text',
						'title' => __('RSS Feed URL', 'uplift'),
						'subtitle' => __('The rss feed URL for your blog.', 'uplift'),
						'desc' => '',
						'default' => '?feed=rss2'
						),
					array(
						'id' => 'google_analytics',
						'type' => 'textarea',
						'title' => __('Tracking code', 'uplift'),
						'subtitle' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme. NOTE: Please include the script tag.', 'uplift'),
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'custom_admin_login_logo',
						'type' => 'media',
						'url'=> true,
						'title' => __('Custom admin login logo', 'uplift'),
						'subtitle' => __('Upload a 300 x 95px image here to replace the admin login logo.', 'uplift'),
						'desc' => ''
						),
					array(
						'id' => 'disable_mobile_animations',
						'type' => 'button_set',
						'title' => __('Disable Mobile Intro Animations', 'uplift'),
						'subtitle' => __('Disables the intro animations for assets on mobile browsers.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '1'
						),
					array(
					    'id'       => 'enable_styleswitcher',
					    'type'     => 'button_set',
					    'title'    => __( 'Enable Front End Style Switcher', 'uplift' ),
					    'subtitle' => __( 'Enable/Disable the front end styleswitcher.', 'uplift' ),
					    'desc'     => '',
					    'options'  => array( '1' => 'On', '0' => 'Off' ),
					    'default'  => '0'
						),
					),
				);
				
				$this->sections[] = array(
					'title' => __('Dynamic Styles', 'uplift'),
					'desc' => '',
					'subsection' => true,
					'icon' => 'el-icon-eye-close',
				    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
					'fields' => array(
						array(
							'id' => 'dynamic_styles_output',
							'type' => 'select',
							'title' => __('Dynamic Styles Output', 'uplift'),
							'subtitle' => __("Select the output method for the theme's dynamic styles, File System is the best, but may not be supported by your hosting. <head> output will be defaulted to if any issues occur.", 'uplift'),
							'desc' => '',
							'options' => array(
								'fs' => 'File System (cached)',
								'ajax' => 'AJAX script',
								'head' => 'Head tag (source output)',
							),
							'default' => 'head'
						),
					),
				);
				
				$this->sections[] = array(
					'title' => __('Maintenance Mode', 'uplift'),
					'desc' => '',
					'subsection' => true,
					'icon' => 'el-icon-eye-close',
				    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
					'fields' => array(
						array(
							'id' => 'enable_maintenance',
							'type' => 'button_set',
							'title' => __('Enable Maintenance', 'uplift'),
							'subtitle' => __('Enable the themes maintenance mode.', 'uplift'),
							'desc' => '',
							'options' => array('2' => 'On (Custom Page)', '1' => 'On (Standard)','0' => 'Off',),
							'default' => '0'
							),
						array(
							'id' => 'maintenance_mode_page',
							'type' => 'select',
							'data' => 'pages',
							'required'  => array('enable_maintenance', '=', '2'),
							'title' => __('Custom Maintenance Mode Page', 'uplift'),
							'subtitle' => __('Select the page that is your maintenace page, if you would like to show a custom page instead of the standard WordPress message. You should use the Holding Page template for this page.', 'uplift'),
							'desc' => '',
							'default' => '',
							'args' => array()
							),
					),
				);

				$this->sections[] = array(
					'title' => __('Performance Options', 'uplift'),
					'desc' => '',
					'subsection' => true,
					'icon' => 'el-icon-fire',
				    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
					'fields' => array(
						array(
							'id' => 'enable_swift_smartscript',
							'type' => 'button_set',
							'title' => __('Enable Swift SmartScript', 'uplift'),
							'subtitle' => __('Enable this option and the theme will run our Swift SmartScript technology, reducing script loads on pages where they are not needed - saving a huge amount of bandwidth and increasing load speed. If you are experiencing any script issues, be sure to test with this option turned OFF.', 'uplift'),
							'desc' => '',
							'options' => array('1' => 'On', '0' => 'Off'),
							'default' => '1'
							),
						array(
							'id' => 'enable_min_scripts',
							'type' => 'button_set',
							'title' => __('Load pre-minified scripts', 'uplift'),
							'subtitle' => __('Enable this option to load pre-minified scripts, without the need for any plugins.', 'uplift'),
							'desc' => '',
							'options' => array('1' => 'On', '0' => 'Off'),
							'default' => '1'
							),
					),
				);

				$this->sections[] = array(
					'title' => __('Preloader/Transition Options', 'uplift'),
					'desc' => '',
					'subsection' => true,
					'icon' => 'el-icon-dashboard',
				    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
					'fields' => array(
						array(
							'id' => 'home_preloader',
							'type' => 'button_set',
							'title' => __('Home Preloader', 'uplift'),
							'subtitle' => __('Enable a preloading effect on the home page.', 'uplift'),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'default' => '0'
							),
						array(
							'id' => 'enable_page_transitions',
							'type' => 'button_set',
							'title' => __('Page Transitions', 'uplift'),
							'subtitle' => __('Enable the transition animation that occurs upon changing pages.', 'uplift'),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'default' => '0'
							),
						array(
							'id' => 'page_transition',
							'type' => 'select',
							'title' => __('Preloader', 'uplift'),
							'subtitle' => __('Select which style of preloader to show across the site, for preloading, page transitions, infinite scroll, and other loading indicators.', 'uplift'),
							'options' => array(
								'circle'  => 'Circle',
								'circle-gap'  => 'Circle (Gap)',
								'circle-swing'  => 'Circle (Swing)',
								'circle-bars'  => 'Circle (Bars)',
								'squares'  => 'Squares',
								'ripples'  => 'Ripples',
								'mouse'  => 'Mouse',
								'dots'  => 'Dots',
								'dots-circle'  => 'Dots (Circle)',
								'dots-wave'  => 'Dots (Wave)',
								'bars'  => 'Bars',								
								),
							'desc' => '',
							'default' => 'circle'
						),
					),
				);

				$this->sections[] = array(
					'title' => __('404 Page', 'uplift'),
					'desc' => '',
					'subsection' => true,
					'icon' => 'el-icon-error',
				    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
					'fields' => array(
						array(
							'id' => '404_type',
							'type' => 'button_set',
							'title' => __('404 Page / Simple', 'uplift'),
							'subtitle' => __('Choose to use a specific page that you have created, as the 404 page - or just use a simple content input below.', 'uplift'),
							'desc' => '',
							'options' => array('simple' => 'Simple','page' => 'Page'),
							'default' => 'simple'
							),
						array(
							'id' => '404_page',
							'type' => 'select',
							'data' => 'pages',
							'title' => __('404 Page', 'uplift'),
							'subtitle' => __('Select the page that is your 404 page. All 404 requests will be redirected to this selected page.', 'uplift'),
							'desc' => '',
							'default' => '',
							'required'  => array('404_type', '=', 'page'),
							'args' => array()
							),
						array(
							'id' => '404_page_content',
							'type' => 'editor',
							'title' => __('404 Page Content', 'uplift'),
							'subtitle' => 'The content that appears on the 404 page, you can use text/shortcodes/html.',
							'desc' => '',
							'required'  => array('404_type', '=', 'simple'),
							'default' => "Sorry but we couldn't find the page you are looking for. Please check to make sure you've typed the URL correctly. You may also want to search for what you are looking for."
						),
						array(
							'id' => '404_sidebar_config',
							'type' => 'select',
							'title' => __('404 Sidebar Config', 'uplift'),
							'subtitle' => "Choose the sidebar config for 404 page.",
							'options' => array(
								'no-sidebars'		=> 'No Sidebars',
								'left-sidebar'		=> 'Left Sidebar',
								'right-sidebar'		=> 'Right Sidebar',
								'both-sidebars'		=> 'Both Sidebars'
							),
							'desc' => '',
							'default' => 'right-sidebar'
							),
						array(
							'id' => '404_left_sidebar',
							'type' => 'select',
							'title' => __('404 Left Sidebar', 'uplift'),
							'subtitle' => "Choose the left sidebar for the 404 page.",
							'data'      => 'sidebars',
							'desc' => '',
							'default' => 'sidebar-1'
							),
						array(
							'id' => '404_right_sidebar',
							'type' => 'select',
							'title' => __('404 Right Sidebar', 'uplift'),
							'subtitle' => "Choose the right sidebar for the 404 page.",
							'data'      => 'sidebars',
							'desc' => '',
							'default' => 'sidebar-1'
							),
					),
				);

				$this->sections[] = array(
					'title' => __('Meta Options', 'uplift'),
					'desc' => '',
					'subsection' => true,
					'icon' => 'el-icon-puzzle',
				    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
					'fields' => array(
						array(
							'id' => 'disable_social_meta',
							'type' => 'button_set',
							'title' => __('Disable Social Meta Tags', 'uplift'),
							'subtitle' => __('Disable the social meta head tag output.', 'uplift'),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'default' => '0'
							),
						array(
							'id' => 'twitter_author_username',
							'type' => 'text',
							'title' => __('Twitter Publisher Username', 'uplift'),
							'subtitle' => "Enter your twitter username here, to be used for the Twitter Card date. Ensure that you do not include the @ symbol.",
							'desc' => '',
							'default' => ""
							),
						array(
							'id' => 'googleplus_author',
							'type' => 'text',
							'title' => __('Google+ Username', 'uplift'),
							'subtitle' => "Enter your Google+ username here, to be used for the authorship meta.",
							'desc' => '',
							'default' => ""
							),
					),
				);

				$this->sections[] = array(
					'title' => __('Plugin Options', 'uplift'),
					'desc' => '',
					'subsection' => true,
					'icon' => 'el-icon-globe',
				    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
					'fields' => array(
						array(
							'id' => 'enable_smoothscroll',
							'type' => 'button_set',
							'title' => __('Enable Smooth Scroll', 'uplift'),
							'subtitle' => __('Enable this option for smooth scroll (inertia) functionality on the site.', 'uplift'),
							'desc' => '',
							'options' => array('1' => 'Enabled','0' => 'Disabled'),
							'default' => '0'
							),
						array(
							'id' => 'plugin_divide_0',
							'type' => 'divide'
							),
						array(
							'id' => 'disable_loveit',
							'type' => 'button_set',
							'title' => __('Disable Love It', 'uplift'),
							'subtitle' => __('Enable this option to disable the love it functionality within the theme.', 'uplift'),
							'desc' => '',
							'options' => array('1' => 'Love It Disabled','0' => 'Love It Enabled'),
							'default' => '0'
							),
						array(
							'id' => 'loveit_text',
							'type' => 'text',
							'title' => __('LoveIt Text', 'uplift'),
							'subtitle' => __('Here you can set the text to appear after the love it count. This will only appear on detail pages.', 'uplift'),
							'desc' => '',
							'default' => "Likes"
							),
						array(
							'id' => 'plugin_divide_2',
							'type' => 'divide'
							),
						array(
							'id' => 'disable_sfgallery',
							'type' => 'button_set',
							'title' => __('Disable Gallery Shortcode Override', 'uplift'),
							'subtitle' => __('If you enable this option, then our WordPress gallery shortcode override will be disabled.', 'uplift'),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'default' => '0'
							),
						array(
							'id' => 'plugin_divide_3',
							'type' => 'divide'
							),
						array(
							'id' => 'lightbox_nav',
							'type' => 'button_set',
							'title' => __('Lightbox Navigation', 'uplift'),
							'subtitle' => __('Select the type of navigation you would like to use in the lightbox. The default option shows a section of the previous/next image to the left/right of the screen.', 'uplift'),
							'desc' => '',
							'options' => array('default' => 'Default','arrows' => 'Arrows'),
							'default' => 'default'
							),
						array(
							'id' => 'lightbox_thumbs',
							'type' => 'button_set',
							'title' => __('Lightbox Thumbnails', 'uplift'),
							'subtitle' => __('Select if you would like to display the gallery thumbnails in the lightbox or not.', 'uplift'),
							'desc' => '',
							'options' => array('1' => 'Enabled','0' => 'Disabled'),
							'default' => '1'
							),
						array(
							'id' => 'lightbox_skin',
							'type' => 'button_set',
							'title' => __('Lightbox Skin', 'uplift'),
							'subtitle' => __('Select the skin that you wish to use for the lightbox styling.', 'uplift'),
							'desc' => '',
							'options' => array('light' => 'Light','dark' => 'Dark'),
							'default' => 'light'
							),
						array(
							'id' => 'lightbox_sharing',
							'type' => 'button_set',
							'title' => __('Lightbox Sharing', 'uplift'),
							'subtitle' => __('Enable social sharing buttons on each lightbox image.', 'uplift'),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'default' => '1'
							),
					)
				);

				$this->sections[] = array(
					'title' => __('Carousel Options', 'uplift'),
					'desc' => '',
					'subsection' => true,
					'icon' => 'el-icon-resize-horizontal',
				    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
					'fields' => array(
						array(
						    'id' => 'carousel_paginationSpeed',
						    'type' => 'slider',
						    'title' => __('Pagination Speed (ms)', 'uplift'),
						    'desc' => __('The speed in which the pagination transitions the carousel items. Default value: 800', 'uplift'),
						    "default" => "800",
						    "min" => "0",
						    "step" => "50",
						    "max" => "5000",
						),
						array(
						    'id' => 'carousel_slideSpeed',
						    'type' => 'slider',
						    'title' => __('Slide Speed (ms)', 'uplift'),
						    'desc' => __('The speed in which the carousel rotates. Default value: 200', 'uplift'),
						    "default" => "200",
						    "min" => "0",
						    "step" => "50",
						    "max" => "3000",
						),
						array(
							'id' => 'carousel_autoplay',
							'type' => 'button_set',
							'title' => __('Auto play', 'uplift'),
							'subtitle' => __("If you enable this option, then the carousels will auto rotate after 3 seconds.", 'uplift'),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'default' => '0'
						),
						array(
							'id' => 'carousel_pagination',
							'type' => 'button_set',
							'title' => __('Show pagination', 'uplift'),
							'subtitle' => __("If you enable this option, then the carousels will display pagination dots below the carousel.", 'uplift'),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'default' => '0'
						),
					)
				);

				$this->sections[] = array(
					'title' => __('Slider Options', 'uplift'),
					'desc' => '',
					'subsection' => true,
					'icon' => 'el-icon-screen',
				    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
					'fields' => array(
						array(
						    'id' => 'slider_slideshowSpeed',
						    'type' => 'slider',
						    'title' => __('Slideshow Speed (ms)', 'uplift'),
						    'desc' => __('The speed at which the slider rotates. Default value: 7000', 'uplift'),
						    "default" => "7000",
						    "min" => "0",
						    "step" => "50",
						    "max" => "12000",
						),
						array(
						    'id' => 'slider_animationSpeed',
						    'type' => 'slider',
						    'title' => __('Slider Animation Speed (ms)', 'uplift'),
						    'desc' => __('The speed in which the transition animation takes. Default value: 600', 'uplift'),
						    "default" => "600",
						    "min" => "0",
						    "step" => "50",
						    "max" => "2000",
						),
						array(
							'id' => 'slider_autoplay',
							'type' => 'button_set',
							'title' => __('Auto play', 'uplift'),
							'subtitle' => __("If you enable this option, then the sliders will auto rotate.", 'uplift'),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'default' => '0'
						),
					)
				);


				$this->sections[] = array(
					'title' => __('Thumbnail Options', 'uplift'),
					'desc' => '',
					'subsection' => true,
					'icon' => 'el-icon-photo-alt',
				    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
					'fields' => array(
						array(
							'id' => 'overlay_opacity_top',
							'type' => 'slider',
							'title' => __('Hover Overlay Opacity (Top)', 'uplift'),
							'subtitle' => __('Select the top percentage opacity of the hover overlay.', 'uplift'),
							'desc' => '',
							'min' => '0',
							'max' => '100',
							'step' => '5',
							'unit' => '',
							'default' => '40'
							),
						array(
							'id' => 'overlay_opacity_bottom',
							'type' => 'slider',
							'title' => __('Hover Overlay Opacity (Bottom)', 'uplift'),
							'subtitle' => __('Select the bottom percentage opacity of the hover overlay.', 'uplift'),
							'desc' => '',
							'min' => '0',
							'max' => '100',
							'step' => '5',
							'unit' => '',
							'default' => '90'
							),
//						array(
//							'id' => 'thumbnail_type',
//							'type' => 'image_select',
//							'title' => __('Thumbnail Type', 'uplift'),
//							'subtitle' => __('Select the thumbnail type used for Gallery style blog/portfolio/gallery assets.', 'uplift'),
//							'desc' => '',
//							'options' => array(
//											'gallery-standard' => array('title' => 'Standard', 'img' => $template_directory.'/images/hover-std.png'),
//											'gallery-alt-one' => array('title' => 'Gallery Alt', 'img' => $template_directory.'/images/hover-alt1.png'),
//											//'gallery-alt-two' => array('title' => 'Gallery Alt 2', 'img' => $template_directory.'/images/hover-alt2.png')
//												),
//							'default' => 'std'
//							),
					)
				);
				
				$this->sections[] = array(
					'title' => __('Share Options', 'uplift'),
					'desc' => '',
					'icon' => 'el-icon-twitter',
					'subsection' => true,
				    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
					'fields' => array(
						array(
						    'id'        => 'social_share_config',
						    'type'      => 'sorter',
						    'title' => __('Social Share Config', 'uplift'),
						    'subtitle' => "Choose the config for the social share output",
						    'compiler'  => 'true',
						    'options'   => array(
						        'enabled'   => array(
						        	'twitter'		=> 'Twitter',
						        	'facebook'		=> 'Facebook',
						        	'google-plus' 	=> 'Google Plus',
						        	'pinterest'		=> 'Pinterest'
						        ),
						        'disabled'  => array(
						        	'linkedin'		=> 'LinkedIn',
						        	'whatsapp'		=> 'WhatsApp',
						        	'email'			=> 'Email',
						        ),
						    ),
//						    'limits' => array(
//						        'disabled'  => 1,
//						        'backup'    => 2,
//						    ),
						)
					),
					
				);

				$this->sections[] = array(
					'type' => 'divide',
				);

				$this->sections[] = array(
					'title' => __('Custom CSS/JS', 'uplift'),
					'desc' => '',
					'icon' => 'el-icon-brush',
				    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
					'fields' => array(
						array(
							'id' => 'custom_css',
							'type' => 'ace_editor',
							'mode' => 'css',
							'theme' => 'monokai',
							'title' => __('Custom CSS', 'uplift'),
							'subtitle' => __('Add some CSS to your theme by adding it to this textarea. Please do not include any style tags.', 'uplift'),
							'desc' => '',
							'default' => '',
							'options'  => array('minLines'=> 20, 'maxLines' => 60)
							),
						array(
							'id' => 'custom_js',
							'type' => 'ace_editor',
							'mode' => 'javascript',
							'theme' => 'chrome',
							'title' => __('Custom JS', 'uplift'),
							'subtitle' => __('Add some custom JavaScript to your theme by adding it to this textarea. Please do not include any script tags.', 'uplift'),
							'desc' => '',
							'default' => '',
							'options'  => array('minLines'=> 20, 'maxLines' => 60)
							)
					)
				);

				$this->sections[] = array(
					'title' => __('Colour Options', 'uplift'),
					'desc' => sprintf(__('To edit the colour options, please use the <a href="%s">Live Color Customizer</a>.', 'uplift'), admin_url('/customize.php')),
					'icon' => 'el-icon-adjust',
					'fields' => array(
						array(
						'id' => 'co_divide_1',
						'type' => 'divide'
						),
					)
				);

			    if (sf_is_current_color_settings_empty()) {

			    	$this->sections[] = array(
			    		'icon' => 'el-icon-eye-open',
			    		'title' => __('Colour Scheme Options', 'uplift'),
			    		'subtitle' => __('<p class="description">Create, import, and export color schemes.</p>', 'uplift'),
						'fields' => array(
							array(
								'id' => 'colour_scheme_select_scheme',
								'type' => 'select',
								'title' => __('Select an existing color scheme to preview', 'uplift'),
								'subtitle' => "",
								'options' => sf_get_color_scheme_list(),
								'desc' => '',
								'default' => sf_get_current_color_scheme_id()
								),
							array(
							    'id' => 'colour_scheme_import',
							    'type' => 'upload_scheme',
							    'title' => __('Import a Color Scheme', 'uplift'),
							    'subtitle' => __('File must be in csv format.', 'uplift')
								),
							array(
							    'id' => 'colour_scheme_export',
							    'type' => 'raw',
							    'align' => true,
							    'title' => __('Export Current Settings As Scheme', 'uplift'),
							    'subtitle' => __('Export the current live color scheme.', 'uplift'),
							    'content' => sf_export_color_scheme_html()
								),
							array(
							    'id' => 'colour_scheme_preview',
							    'type' => 'raw',
							    'align' => true,
							    'title' => __('Color Scheme Preview', 'uplift'),
							    'subtitle' => '<span id="scheme-preview-text">'.__( 'These colors are what currently exist in the WordPress theme customizer', 'uplift' ) .'</span>
							    				 <div class="scheme-buttons" id="scheme-buttons">
							    				 <input class="save-this-scheme-name" name="save-this-scheme-name" placeholder="Name This Scheme"   style="display:none;" />
							    				 <a class="save-this-scheme button-secondary"   style="display:none;">Save This Scheme</a>
							    				 <a class="delete-this-scheme button-secondary"  style="display:none;">Delete This Scheme</a>
							    				 <a class="use-this-scheme button-secondary"  style="display:none;">Use This Scheme</a>
							    				 </div>',
							    'content' => sf_get_current_color_scheme_html_preview()
								)
							)

						);

			       	} else {

			    		$this->sections[] = array(
			    			'icon' => 'el-icon-eye-open',
			    			'title' => __('Colour Scheme Options', 'uplift'),
							'subtitle' => __('<p class="description">Create, import, and export color schemes.</p>', 'uplift'),
							'fields' => array(
								array(
									'id' => 'colour_scheme_select_scheme',
									'type' => 'select',
									'title' => __('Select an existing colour scheme to preview', 'uplift'),
									'subtitle' => "",
									'options' => sf_get_color_scheme_list(),
									'desc' => '',
									'default' => sf_get_current_color_scheme_id()
									),
								array(
								    'id' => 'colour_scheme_import',
								    'type' => 'upload_scheme',
								    'title' => __('Import a Color Scheme', 'uplift'),
								    'subtitle' => __('File must be csv format.', 'uplift')
									),
								array(
								    'id' => 'colour_scheme_export',
								    'type' => 'raw',
								    'align' => true,
								    'title' => __('Export Current Settings As Scheme', 'uplift'),
								    'subtitle' => __('Export the current live color scheme.', 'uplift'),
								    'desc' => sf_export_color_scheme_html()
									),
								array(
								    'id' => 'colour_scheme_preview',
								    'type' => 'raw',
								    'align' => true,
								    'title' => __('Color Scheme Preview', 'uplift'),
								    'subtitle' => '<span id="scheme-preview-text">'.__('These colors are what currently exist in the WordPress theme customizer', 'uplift') .'</span>
								    				 <div class="scheme-buttons" id="scheme-buttons">
								    				 <input class="save-this-scheme-name" name="save-this-scheme-name" placeholder="Name This Scheme"   style="display:none;" />
								    				 <a class="save-this-scheme button-secondary"   style="display:none;">Save This Scheme</a>
								    				 <a class="delete-this-scheme button-secondary"  style="display:none;">Delete This Scheme</a>
								    				 <a class="use-this-scheme button-secondary"  style="display:none;">Use This Scheme</a>
								    				 </div>',
								    'content' => sf_get_current_color_scheme_html_preview()
									)
								)

							);

				    }

				$this->sections[] = array(
					'title' => __('Background Options', 'uplift'),
					'desc' => '',
					'icon' => 'el-icon-picture',
				    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
					'fields' => array(
						array(
							'id' => 'use_bg_image',
							'type' => 'button_set',
							'title' => __('Use Background Image', 'uplift'),
							'subtitle' => __('Check this to use an image for the body background (boxed layout only).', 'uplift'),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'default' => '0'
							),
						array(
							'id' => 'custom_bg_image',
							'type' => 'media',
							'url'=> true,
							'required'  => array('use_bg_image', '=', '1'),
							'title' => __('Upload Background Image', 'uplift'),
							'subtitle' => __('Either upload or provide a link to your own background here, or choose from the presets below.', 'uplift'),
							'desc' => ''
							),
						array(
							'id' => 'bg_size',
							'type' => 'button_set',
							'required'  => array('use_bg_image', '=', '1'),
							'title' => __('Background Size', 'uplift'),
							'subtitle' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', 'uplift'),
							'desc' => '',
							'options' => array('cover' => 'Cover','auto' => 'Auto'),
							'default' => 'auto'
							),
						array(
							'id' => 'preset_bg_image',
							'type' => 'image_select',
							'required'  => array('use_bg_image', '=', '1'),
							'title' => __('Preset body background image', 'uplift'),
							'subtitle' => __('Select a preset background image for the body background.', 'uplift'),
							'desc' => '',
							'options' => array(
											$preset_bgs . '45degree_fabric.png' => $preset_bgs . '45degree_fabric.png',
											$preset_bgs . 'argyle.png' => $preset_bgs . 'argyle.png',
											$preset_bgs . 'beige_paper.png' => $preset_bgs . 'beige_paper.png',
											$preset_bgs . 'bgnoise_lg.png' => $preset_bgs . 'bgnoise_lg.png',
											$preset_bgs . 'black_denim.png' => $preset_bgs . 'black_denim.png',
											$preset_bgs . 'black_linen_v2.png' => $preset_bgs . 'black_linen_v2.png',
											$preset_bgs . 'black_paper.png' => $preset_bgs . 'black_paper.png',
											$preset_bgs . 'black-Linen.png' => $preset_bgs . 'black-Linen.png',
											$preset_bgs . 'blackmamba.png' => $preset_bgs . 'blackmamba.png',
											$preset_bgs . 'blu_stripes.png' => $preset_bgs . 'blu_stripes.png',
											$preset_bgs . 'bright_squares.png' => $preset_bgs . 'bright_squares.png',
											$preset_bgs . 'brushed_alu_dark.png' => $preset_bgs . 'brushed_alu_dark.png',
											$preset_bgs . 'brushed_alu.png' => $preset_bgs . 'brushed_alu.png',
											$preset_bgs . 'candyhole.png' => $preset_bgs . 'candyhole.png',
											$preset_bgs . 'checkered_pattern.png' => $preset_bgs . 'checkered_pattern.png',
											$preset_bgs . 'classy_fabric.png' => $preset_bgs . 'classy_fabric.png',
											$preset_bgs . 'concrete_wall_3.png' => $preset_bgs . 'concrete_wall_3.png',
											$preset_bgs . 'connect.png' => $preset_bgs . 'connect.png',
											$preset_bgs . 'cork_1.png' => $preset_bgs . 'cork_1.png',
											$preset_bgs . 'crissXcross.png' => $preset_bgs . 'crissXcross.png',
											$preset_bgs . 'dark_brick_wall.png' => $preset_bgs . 'dark_brick_wall.png',
											$preset_bgs . 'dark_dotted.png' => $preset_bgs . 'dark_dotted.png',
											$preset_bgs . 'dark_geometric.png' => $preset_bgs . 'dark_geometric.png',
											$preset_bgs . 'dark_leather.png' => $preset_bgs . 'dark_leather.png',
											$preset_bgs . 'dark_mosaic.png' => $preset_bgs . 'dark_mosaic.png',
											$preset_bgs . 'dark_wood.png' => $preset_bgs . 'dark_wood.png',
											$preset_bgs . 'detailed.png' => $preset_bgs . 'detailed.png',
											$preset_bgs . 'diagonal-noise.png' => $preset_bgs . 'diagonal-noise.png',
											$preset_bgs . 'fabric_1.png' => $preset_bgs . 'fabric_1.png',
											$preset_bgs . 'fake_luxury.png' => $preset_bgs . 'fake_luxury.png',
											$preset_bgs . 'felt.png' => $preset_bgs . 'felt.png',
											$preset_bgs . 'flowers.png' => $preset_bgs . 'flowers.png',
											$preset_bgs . 'foggy_birds.png' => $preset_bgs . 'foggy_birds.png',
											$preset_bgs . 'graphy.png' => $preset_bgs . 'graphy.png',
											$preset_bgs . 'gray_sand.png' => $preset_bgs . 'gray_sand.png',
											$preset_bgs . 'green_gobbler.png' => $preset_bgs . 'green_gobbler.png',
											$preset_bgs . 'green-fibers.png' => $preset_bgs . 'green-fibers.png',
											$preset_bgs . 'grid_noise.png' => $preset_bgs . 'grid_noise.png',
											$preset_bgs . 'gridme.png' => $preset_bgs . 'gridme.png',
											$preset_bgs . 'grilled.png' => $preset_bgs . 'grilled.png',
											$preset_bgs . 'grunge_wall.png' => $preset_bgs . 'grunge_wall.png',
											$preset_bgs . 'handmadepaper.png' => $preset_bgs . 'handmadepaper.png',
											$preset_bgs . 'inflicted.png' => $preset_bgs . 'inflicted.png',
											$preset_bgs . 'irongrip.png' => $preset_bgs . 'irongrip.png',
											$preset_bgs . 'knitted-netting.png' => $preset_bgs . 'knitted-netting.png',
											$preset_bgs . 'leather_1.png' => $preset_bgs . 'leather_1.png',
											$preset_bgs . 'light_alu.png' => $preset_bgs . 'light_alu.png',
											$preset_bgs . 'light_checkered_tiles.png' => $preset_bgs . 'light_checkered_tiles.png',
											$preset_bgs . 'light_honeycomb.png' => $preset_bgs . 'light_honeycomb.png',
											$preset_bgs . 'lined_paper.png' => $preset_bgs . 'lined_paper.png',
											$preset_bgs . 'little_pluses.png' => $preset_bgs . 'little_pluses.png',
											$preset_bgs . 'mirrored_squares.png' => $preset_bgs . 'mirrored_squares.png',
											$preset_bgs . 'noise_pattern_with_crosslines.png' => $preset_bgs . 'noise_pattern_with_crosslines.png',
											$preset_bgs . 'noisy.png' => $preset_bgs . 'noisy.png',
											$preset_bgs . 'old_mathematics.png' => $preset_bgs . 'old_mathematics.png',
											$preset_bgs . 'padded.png' => $preset_bgs . 'padded.png',
											$preset_bgs . 'paper_1.png' => $preset_bgs . 'paper_1.png',
											$preset_bgs . 'paper_2.png' => $preset_bgs . 'paper_2.png',
											$preset_bgs . 'paper_3.png' => $preset_bgs . 'paper_3.png',
											$preset_bgs . 'pineapplecut.png' => $preset_bgs . 'pineapplecut.png',
											$preset_bgs . 'pinstriped_suit.png' => $preset_bgs . 'pinstriped_suit.png',
											$preset_bgs . 'plaid.png' => $preset_bgs . 'plaid.png',
											$preset_bgs . 'project_papper.png' => $preset_bgs . 'project_papper.png',
											$preset_bgs . 'px_by_Gre3g.png' => $preset_bgs . 'px_by_Gre3g.png',
											$preset_bgs . 'quilt.png' => $preset_bgs . 'quilt.png',
											$preset_bgs . 'random_grey_variations.png' => $preset_bgs . 'random_grey_variations.png',
											$preset_bgs . 'ravenna.png' => $preset_bgs . 'ravenna.png',
											$preset_bgs . 'real_cf.png' => $preset_bgs . 'real_cf.png',
											$preset_bgs . 'robots.png' => $preset_bgs . 'robots.png',
											$preset_bgs . 'rockywall.png' => $preset_bgs . 'rockywall.png',
											$preset_bgs . 'roughcloth.png' => $preset_bgs . 'roughcloth.png',
											$preset_bgs . 'small-crackle-bright.png' => $preset_bgs . 'small-crackle-bright.png',
											$preset_bgs . 'smooth_wall.png' => $preset_bgs . 'smooth_wall.png',
											$preset_bgs . 'snow.png' => $preset_bgs . 'snow.png',
											$preset_bgs . 'soft_kill.png' => $preset_bgs . 'soft_kill.png',
											$preset_bgs . 'square_bg.png' => $preset_bgs . 'square_bg.png',
											$preset_bgs . 'starring.png' => $preset_bgs . 'starring.png',
											$preset_bgs . 'stucco.png' => $preset_bgs . 'stucco.png',
											$preset_bgs . 'subtle_freckles.png' => $preset_bgs . 'subtle_freckles.png',
											$preset_bgs . 'subtle_orange_emboss.png' => $preset_bgs . 'subtle_orange_emboss.png',
											$preset_bgs . 'subtle_zebra_3d.png' => $preset_bgs . 'subtle_zebra_3d.png',
											$preset_bgs . 'tileable_wood_texture.png' => $preset_bgs . 'tileable_wood_texture.png',
											$preset_bgs . 'type.png' => $preset_bgs . 'type.png',
											$preset_bgs . 'vichy.png' => $preset_bgs . 'vichy.png',
											$preset_bgs . 'washi.png' => $preset_bgs . 'washi.png',
											$preset_bgs . 'white_sand.png' => $preset_bgs . 'white_sand.png',
											$preset_bgs . 'white_texture.png' => $preset_bgs . 'white_texture.png',
											$preset_bgs . 'whitediamond.png' => $preset_bgs . 'whitediamond.png',
											$preset_bgs . 'whitey.png' => $preset_bgs . 'whitey.png',
											$preset_bgs . 'woven.png' => $preset_bgs . 'woven.png',
											$preset_bgs . 'xv.png' => $preset_bgs . 'xv.png'
											),
							'default' => ''
							)
					)
				);

				$this->sections[] = array(
					'type' => 'divide',
				);

				$this->sections[] = array(
					'title' => __('Header Options', 'uplift'),
					'desc' => '',
					'icon' => 'el-icon-compass',
				    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
					'fields' => array(
						array(
							'id' => 'enable_tb',
							'type' => 'button_set',
							'title' => __('Enable Top Bar', 'uplift'),
							'subtitle' => __('Enable top bar to show above header. This is only possible with headers 1-9 (not the vertical headers).', 'uplift'),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'default' => '0'
							),
						array(
							'id' => 'tb_left_config',
							'type' => 'select',
							'required'  => array('enable_tb', '=', '1'),
							'title' => __('Top Bar Left Config', 'uplift'),
							'subtitle' => "Choose the config for the left header area if you are using Header 1.",
							'options' => array(
								'text'	=> 'Text/Shortcode',
								'account'	=> 'Account',
								'social'  => 'Social Icons',
								'menu'      => 'Top Bar Menu',
								'cart-wishlist' => 'Cart/Wishlist',
								'currency-switcher'	=> 'Currency Switcher'
								),
							'desc' => '',
							'default' => 'text'
							),
						array(
							'id' => 'tb_left_text',
							'type' => 'text',
							'required'  => array(
							                    array('enable_tb', '=', 1),
							                    array('tb_left_config', '=', "text"),
							               ),
							'title' => __('Top Bar left text config', 'uplift'),
							'subtitle' => "The text that is shown on the left of header on header type 1 when you have the left config above set to text. You can use any shortcodes here, or widgets (using the Widget Shortcode plugin).",
							'desc' => '',
							'default' => "Contact us on 0800 123 4567 or info@uplift.com"
							),
						array(
							'id' => 'tb_right_config',
							'type' => 'select',
							'required'  => array('enable_tb', '=', '1'),
							'title' => __('Top Bar Right Config', 'uplift'),
							'subtitle' => "Choose the config for the right header area if you are using Header 1 or 3.",
							'options' => array(
								'text'	=> 'Text/Shortcode',
								'account'	=> 'Account',
								'social'  => 'Social Icons',
								'menu'      => 'Top Bar Menu',
								'cart-wishlist'      => 'Cart/Wishlist',
								'currency-switcher'	=> 'Currency Switcher'
							),
							'desc' => '',
							'default' => 'text'
							),
						array(
							'id' => 'tb_right_text',
							'type' => 'text',
							'required'  => array(
							                    array('enable_tb', 'equals', 1),
							                    array('tb_right_config', 'equals', "text"),
							               ),
							'title' => __('Top Bar right text config', 'uplift'),
							'subtitle' => "The text that is shown on the left of header on header type 2 and type 3 when you have the right config above set to text. You can use any shortcodes here, or widgets (using the Widget Shortcode plugin).",
							'desc' => '',
							'default' => "Contact us on 0800 123 4567 or info@uplift.com"
							),
						array(
							'id' => 'enable_sticky_topbar',
							'type' => 'button_set',
							'required'  => array(
							                    array('enable_tb', 'equals', 1),
							               ),
							'title' => __('Sticky Top Bar', 'uplift'),
							'subtitle' => __('Keep the Top Bar sticky when scrolling down the page.', 'uplift'),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'default' => '0'
							),
						array(
						    'id'    => 'header-divide',
						    'type'  => 'divide'
						),
						array(
							'id' => 'header_layout',
							'type' => 'image_select',
							'title' => __('Header Layout', 'uplift'),
							'subtitle' => __('Select a header layout option from the examples.', 'uplift'),
							'desc' => '',
							'options' => array(
								'header-1' => array('title' => '', 'img' => $template_directory.'/images/uplift_theme-options_header_1.png'),
								'header-2' => array('title' => '', 'img' => $template_directory.'/images/uplift_theme-options_header_2.png'),
								'header-3' => array('title' => '', 'img' => $template_directory.'/images/uplift_theme-options_header_3.png'),
								'header-4' => array('title' => '', 'img' => $template_directory.'/images/uplift_theme-options_header_4.png'),
								'header-5' => array('title' => '', 'img' => $template_directory.'/images/uplift_theme-options_header_5.png'),
								'header-6' => array('title' => '', 'img' => $template_directory.'/images/uplift_theme-options_header_6.png'),
								'header-7' => array('title' => '', 'img' => $template_directory.'/images/uplift_theme-options_header_7.png'),
								'header-8' => array('title' => '', 'img' => $template_directory.'/images/uplift_theme-options_header_8.png'),
								'header-vert' => array('title' => '', 'img' => $template_directory.'/images/uplift_theme-options_header_9.png'),
								'header-vert-right' => array('title' => '', 'img' => $template_directory.'/images/uplift_theme-options_header_10.png'),
							),
							'default' => 'header-4'
							),
						array(
							'id' => 'fullwidth_header',
							'type' => 'button_set',
							'title' => __('Full width header', 'uplift'),
							'subtitle' => __('If you are using Header 1-8 then you can optionally set the header to be edge to edge rather than contained.', 'uplift'),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'default' => '0'
							),
						array(
						    'id'        => 'header_left_config',
						    'type'      => 'sorter',
						    'title' => __('Header Left Config', 'uplift'),
						    'subtitle' => "Choose the config for the left header area if you are using Header 1, 6 or 8. You can drag the items between enabled/disabled and also order them as you like.",
						    'compiler'  => 'true',
						    'options'   => array(
						        'enabled'   => array(
						        	'text'	=> 'Text/Shortcode',
						        ),
						        'disabled'  => array(
						        	'social'  => 'Social Icons',
						        	'overlay-menu'  => 'Overlay Menu',
						        	'side-slideout'  => 'Side Slideout Menu',
						        	'push-nav'  => 'Push Nav',
						        	'contact'  => 'Contact',
						        	'search'	=> 'Search',
						        	'cart-wishlist'	=> 'Cart / Wishlist',
						        	'supersearch'	=> 'Super Search',
						        	'language'	=> 'Language (icon)',
						        	'language-text'	=> 'Language (text)',
						        	'account'	=> 'Account (icon)',
						        	'account-text'	=> 'Account (text)',
						        	'currency-switcher'	=> 'Currency Switcher'
						        ),
						    ),
//						    'limits' => array(
//						        'disabled'  => 1,
//						        'backup'    => 2,
//						    ),
						),
						array(
							'id' => 'header_left_text',
							'type' => 'text',
							'title' => __('Header left text config', 'uplift'),
							'subtitle' => "The text that is shown on the left of header on header type 1 when you have the left config above set to text. You can use any shortcodes here, or widgets (using the Widget Shortcode plugin).",
							'desc' => '',
							'default' => "Header left text"
							),
						array(
							'id' => 'header_right_config',
							'type' => 'sorter',
							'title' => __('Header Right Config', 'uplift'),
							'subtitle' => "Choose the config for the right header area if you are using Header 1, 2, 3, or 4. You can drag the items between enabled/disabled and also order them as you like.",
						    'compiler'  => 'true',
						    'options'   => array(
						        'enabled'   => array(
						        	'social'  => 'Social Icons',
						        ),
						        'disabled'  => array(
						        	'text'	=> 'Text/Shortcode',
						        	'overlay-menu'  => 'Overlay Menu',
						        	'side-slideout'  => 'Side Slideout Menu',
						        	'push-nav'  => 'Push Nav',
						        	'contact'  => 'Contact',
						        	'search'	=> 'Search',
						        	'cart-wishlist'	=> 'Cart / Wishlist',
						        	'supersearch'	=> 'Super Search',
						        	'language'	=> 'Language (icon)',
						        	'language-text'	=> 'Language (text)',
						        	'account'	=> 'Account (icon)',
						        	'account-text'	=> 'Account (text)',
						        	'currency-switcher'	=> 'Currency Switcher'
						        ),
						    ),
//						    'limits' => array(
//						        'disabled'  => 1,
//						        'backup'    => 2,
//						    ),
						),
						array(
							'id' => 'header_right_text',
							'type' => 'text',
							'title' => __('Header right text config', 'uplift'),
							'subtitle' => "The text that is shown on the left of header on header type 2 and type 3 when you have the right config above set to text. You can use any shortcodes here, or widgets (using the Widget Shortcode plugin).",
							'desc' => '',
							'default' => "Header right text"
							),
						array(
							'id' => 'nav_left_config',
							'type' => 'sorter',
							'required'  => array('header_layout', '=', 'header-6'),
							'title' => __('Nav Left Config', 'uplift'),
							'subtitle' => "Choose the config for the left nav area. You can drag the items between enabled/disabled and also order them as you like.",
						    'compiler'  => 'true',
						    'options'   => array(
						        'enabled'   => array(
						        	'search'	=> 'Search',
						        ),
						        'disabled'  => array(
						        	'social'  => 'Social Icons',
						        	'text'	=> 'Text/Shortcode',
						        	'overlay-menu'  => 'Overlay Menu',
						        	'side-slideout'  => 'Side Slideout Menu',
						        	'contact'  => 'Contact',
						        	'cart-wishlist'	=> 'Cart / Wishlist',
						        	'supersearch'	=> 'Super Search',
						        	'language'	=> 'Language (icon)',
						        	'language-text'	=> 'Language (text)',
						        	'account'	=> 'Account (icon)',
						        	'account-text'	=> 'Account (text)',
						        	'currency-switcher'	=> 'Currency Switcher'
						        ),
						    ),
//						    'limits' => array(
//						        'disabled'  => 1,
//						        'backup'    => 2,
//						    ),
						),
						array(
							'id' => 'nav_left_text',
							'type' => 'text',
							'required'  => array('nav_left_config', '=', 'text'),
							'title' => __('Nav left text config', 'uplift'),
							'subtitle' => "The text that is shown on the left of nav on header type 2 and type 3 when you have the right config above set to text. You can use any shortcodes here, or widgets (using the Widget Shortcode plugin).",
							'desc' => '',
							'default' => "Nav left text"
							),
						array(
							'id' => 'nav_right_config',
							'type' => 'sorter',
							'required'  => array( 'header_layout', 'equals', array( 'header-6', 'header-7' ) ),
							'title' => __('Nav Right Config', 'uplift'),
							'subtitle' => "Choose the config for the right nav area. You can drag the items between enabled/disabled and also order them as you like.",
						    'compiler'  => 'true',
						    'options'   => array(
						        'enabled'   => array(
						        	'cart-wishlist'	=> 'Cart / Wishlist',
						        ),
						        'disabled'  => array(
						        	'social'  => 'Social Icons',
						        	'text'	=> 'Text/Shortcode',
						        	'overlay-menu'  => 'Overlay Menu',
						        	'side-slideout'  => 'Side Slideout Menu',
						        	'contact'  => 'Contact',
						        	'search'	=> 'Search',
						        	'supersearch'	=> 'Super Search',
						        	'language'	=> 'Language (icon)',
						        	'language-text'	=> 'Language (text)',
						        	'account'	=> 'Account (icon)',
						        	'account-text'	=> 'Account (text)',
						        	'currency-switcher'	=> 'Currency Switcher'
						        ),
						    ),
//						    'limits' => array(
//						        'disabled'  => 1,
//						        'backup'    => 2,
//						    ),
						),
						array(
							'id' => 'nav_right_text',
							'type' => 'text',
							'required'  => array('nav_right_config', '=', 'text'),
							'title' => __('Nav right text config', 'uplift'),
							'subtitle' => "The text that is shown on the right of nav on header type 2 and type 3 when you have the right config above set to text. You can use any shortcodes here, or widgets (using the Widget Shortcode plugin).",
							'desc' => '',
							'default' => "Nav right text"
							),
						array(
							'id' => 'contact_slideout_page',
							'type' => 'select',
							'data' => 'pages',
							'title' => __('Contact Slideout Page', 'uplift'),
							'subtitle' => __('Select the page for which you would like to show the content of in the contact slideout. You can create a page using standard text, or the page builder - allowing for any kind of content in this slideout.', 'uplift'),
							'desc' => '',
							'default' => '',
							'args' => array()
							),
						array(
							'id' => 'header_divide_0',
							'type' => 'divide'
							),
						array(
							'id' => 'pushnav_size',
							'type' => 'select',
							'title' => __('Push Nav - Size', 'uplift'),
							'subtitle' => __('Select the size for the push nav to be displayed.', 'uplift'),
							'desc' => '',
							'options' => array('fullscreen' => 'Fullscreen', 'quarter' => '1/4', 'mini' => 'Mini'),
							'default' => 'fullscreen'
							),
						array(
							'id' => 'pushnav_text',
							'type' => 'editor',
							'title' => __('Push Nav Aux Text', 'uplift'),
							'subtitle' => 'The aux text that appears on the push nav. NOTE: this can include shortcodes, and this is not shown when the Push Nav is set to Mini size.',
							'desc' => '',
							'default' => "&copy;[the-year] Uplift &middot; Built with love by <a href='http://www.swiftideas.com'>Swift Ideas</a> using [wp-link]. <br/><br/>[social]"
							),
						array(
							'id' => 'header_divide_1',
							'type' => 'divide'
							),
						array(
							'id' => 'my_account_link_type',
							'type' => 'button_set',
							'title' => __('Account Link - Type', 'uplift'),
							'subtitle' => __('Choose the account aux-item link type when not logged in.', 'uplift'),
							'desc' => '',
							'options' => array('modal' => 'Modal', 'page' => 'Page Link'),
							'default' => 'modal'
							),
						array(
							'id' => 'show_sub',
							'type' => 'button_set',
							'title' => __('Account Links - Subscribe', 'uplift'),
							'subtitle' => __('Check this to show the suscribe dropdown in the links output, allowing users to subscribe via inputting their email address. If you use this, be sure to enter a Mailchimp form action URL in the box below.', 'uplift'),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'default' => '0'
							),
						array(
							'id' => 'sub_code',
							'type' => 'textarea',
							'required'  => array('show_sub', '=', '1'),
							'title' => __('Account Links - Subscribe form code', 'uplift'),
							'subtitle' => "Enter the form code (e.g. Mailchimp) that will be used for the subscribe dropdown. You can enter HTML/Shortcodes/Text here.",
							'desc' => '',
							'default' => ""
							),
						array(
							'id' => 'show_translation',
							'type' => 'button_set',
							'title' => __('Account Links - Translation', 'uplift'),
							'subtitle' => __('Check this to show the translation dropdown in the links output.', 'uplift'),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'default' => '0'
							),
						array(
							'id' => 'header_divide_2',
							'type' => 'divide'
							),
						array(
							'id' => 'enable_header_shadow',
							'type' => 'button_set',
							'title' => __('Header Shadow', 'uplift'),
							'subtitle' => __('Enable the shadow below the header.', 'uplift'),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'default' => '0'
							),
						array(
							'id' => 'enable_mini_header',
							'type' => 'button_set',
							'title' => __('Sticky header', 'uplift'),
							'subtitle' => __('Enable the sticky header when scrolling down the page.', 'uplift'),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'default' => '1'
							),
						array(
							'id' => 'enable_mini_header_resize',
							'type' => 'button_set',
							'title' => __('Sticky header resizing', 'uplift'),
							'subtitle' => __('Enable the sticky header to resize when scrolling down the page.', 'uplift'),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'default' => '0'
							),
						array(
						    'id'       => 'enable_sticky_header_hide',
						    'type'     => 'button_set',
						    'title'    => __( 'Sticky header show/hide', 'uplift' ),
						    'subtitle' => __( 'Enable the sticky header to hide once scrolled 1000px down the page, and show on scroll up.', 'uplift' ),
						    'desc'     => '',
						    'options'  => array( '1' => 'On', '0' => 'Off' ),
						    'default'  => '0'
						),
						array(
							'id' => 'header_search_type',
							'type' => 'button_set',
							'title' => __('Header Search', 'uplift'),
							'subtitle' => __('Enable the search icon in the header menu.', 'uplift'),
							'desc' => '',
							'options' => array(
								'standard' => 'Standard Search',
								'full-header-search' => 'Full Header Search',
							),
							'default' => 'fs-search-on'
							),
						array(
							'id' => 'header_search_pt',
							'type' => 'button_set',
							'required'  => array('header_search_type', '!=', 'search-off'),
							'title' => __('Header Search Post Type', 'uplift'),
							'subtitle' => __('Set whether you would like the site search limited to products, or all content.', 'uplift'),
							'desc' => '',
							'options' => array('any' => 'All', 'product' => 'Products'),
							'default' => 'any'
							),
						array(
							'id' => 'header_divide_3',
							'type' => 'divide'
							),
						array(
							'id' => 'vertical_header_text',
							'type' => 'editor',
							'title' => __('Vertical Header Copyright Text', 'uplift'),
							'subtitle' => 'The copyright text that appears at the bottom of the vertical header. NOTE: this can include shortcodes.',
							'desc' => '',
							'default' => "&copy;[the-year] Uplift &middot; Built with love by <a href='http://www.swiftideas.com'>Swift Ideas</a> using [wp-link]."
							),
						),
					);

			$this->sections[] = array(
				'title' => __('Logo Options', 'uplift'),
				'desc' => '',
				'icon' => 'el-icon-network',
			    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
				'fields' => array(
					array(
						'id' => 'logo_upload',
						'type' => 'media',
						'url'=> false,
						'title' => __('Logo', 'uplift'),
						'subtitle' => __('Upload your logo here (any size).', 'uplift'),
						'desc' => ''
						),
					array(
						'id' => 'retina_logo_upload',
						'type' => 'media',
						'url'=> false,
						'title' => __('Retina Logo', 'uplift'),
						'subtitle' => __('Upload the retina version of your logo here.', 'uplift'),
						'desc' => ''
						),
					array(
						'id' => 'light_logo_upload',
						'type' => 'media',
						'url'=> false,
						'title' => __('Light Logo', 'uplift'),
						'subtitle' => __('Upload a light version of your logo here, which will be used wherever you use the Naked (Light) Header option. If no light logo is set, then the standard will be used.', 'uplift'),
						'desc' => ''
						),
					array(
						'id' => 'dark_logo_upload',
						'type' => 'media',
						'url'=> false,
						'title' => __('Dark Logo', 'uplift'),
						'subtitle' => __('Upload a dark version of your logo here, which will be used wherever you use the Naked (Light) Header option. If no dark logo is set, then the standard will be used.', 'uplift'),
						'desc' => ''
						),
					array(
						'id' => 'alt_logo_upload',
						'type' => 'media',
						'url'=> false,
						'title' => __('Alt Logo', 'uplift'),
						'subtitle' => __('Upload an alternative version of your logo here, which can be optionally displayed instead of the standard logo on selected pages.', 'uplift'),
						'desc' => ''
						),
					array(
                        'id'        => 'logo_maxheight',
                        'type'      => 'text',
                        'title'     => __('Logo Max Height', 'uplift'),
                        'subtitle'  => __('This must be numeric (no px).', 'uplift'),
                        'desc'      => __('You can set a max height for the logo here, and this will resize it on the front end if your logo image is bigger.', 'uplift'),
                        'validate'  => 'numeric',
                        'default'   => '100',
                    ),
                    array(
                        'id'        => 'logo_padding',
                        'type'      => 'text',
                        'title'     => __('Logo Top/Bottom Padding', 'uplift'),
                        'subtitle'  => __('This must be numeric (no px). Leave balnk for default.', 'uplift'),
                        'desc'      => __('If you would like to override the default logo top/bottom padding, then you can do so here. The default is 30 if the logo height is less than 80, else it is 20.', 'uplift'),
                        'validate'  => 'numeric',
                        'default'   => '',
                    ),
                    array(
                    	'id' => 'logo_hover_anim',
                    	'type' => 'select',
                    	'title' => __('Logo Hover Animation', 'uplift'),
                    	'subtitle' => "Choose the animation style for the logo on hover.",
                    	'options' => array(
                    		''	=> 'None',
                    		'tada'		=> 'TaDa',
                    		'bounce'	=> 'Bounce',
                    		'flash'		=> 'Flash',
                    		'pulse'		=> 'Pulse',
                    		'shake'		=> 'Shake'
                    	),
                    	'desc' => '',
                    	'default' => ''
                    	),
                    array(
                    	'id' => 'enable_logo_tagline',
                    	'type' => 'button_set',
                    	'title' => __('Enable Logo Tagline', 'uplift'),
                    	'subtitle' => __('Enable the site tagline to appear under the logo.', 'uplift'),
                    	'desc' => '',
                    	'options' => array('1' => 'Yes', '0' => 'No'),
                    	'default' => '0'
                    	),
					array(
						'id'=> 'logo_font',
						'type' => 'typography',
						'title' => __('Logo Font', 'uplift'),
						'subtitle' => __('Specify the logo font properties.', 'uplift'),
						'google'=> true,
						'font-backup'=>true,
						'line-height'=>false,
						'letter-spacing'=>true,
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('#logo h1, #logo h2, #mobile-logo h1'), // An array of CSS selectors to apply this font style to dynamically
						'compiler' => array('#logo h1, #logo h2, #mobile-logo h1'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'default' => array(
							'color'=>'#222',
							'font-size'=>'24px',
							'font-family'=>'Serif',
							'font-weight'=>'400',
							),
						),
					)
				);

			$this->sections[] = array(
				'title' => __('Mobile Header Options', 'uplift'),
				'desc' => '',
				'icon' => 'el-icon-iphone-home',
			    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
				'fields' => array(
					array(
						'id' => 'mobile_logo_upload',
						'type' => 'media',
						'url'=> false,
						'title' => __('Mobile Logo', 'uplift'),
						'subtitle' => __('If you would like to override the default logo for mobile, then upload your mobile logo here (any size).', 'uplift'),
						'desc' => ''
						),
					array(
						'id' => 'mobile_retina_logo_upload',
						'type' => 'media',
						'url'=> false,
						'title' => __('Mobile Retina Logo', 'uplift'),
						'subtitle' => __('If you would like to override the default retina logo for mobile, then upload your retina mobile logo here (any size).', 'uplift'),
						'desc' => ''
						),
					array(
						'id' => 'mobile_header_shown',
						'type' => 'select',
						'title' => __('Mobile Header Visiblity', 'uplift'),
						'subtitle' => __('Select at what screen size the main header is replaced by the mobile header.', 'uplift'),
						'options' => array(
							'tablet-land'	=> 'Tablet (Landscape)',
							'tablet-port'	=> 'Tablet (Portrait)',
							'mobile'  => 'Mobile',
							),
						'desc' => '',
						'default' => 'tablet-land'
					),
					array(
						'id' => 'mobile_header_sticky',
						'type' => 'button_set',
						'title' => __('Sticky Mobile Header', 'uplift'),
						'subtitle' => __('Check this to enable sticky functionality on the mobile header.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
					),
					array(
						'id' => 'mobile_header_layout',
						'type' => 'select',
						'title' => __('Mobile Header Layout', 'uplift'),
						'subtitle' => __('Choose the config for the layout of the mobile header.', 'uplift'),
						'options' => array(
							'left-logo'	=> 'Left Logo',
							'right-logo'	=> 'Right Logo',
							'center-logo'  => 'Center Logo (Menu Left, Cart Right)',
							'center-logo-alt'  => 'Center Logo (Cart Left, Menu Right)',
							),
						'desc' => '',
						'default' => 'left-logo'
					),
					array(
						'id' => 'mobile_menu_type',
						'type' => 'select',
						'title' => __('Mobile Menu Display Type', 'uplift'),
						'subtitle' => __('Choose the display type for the mobile menu/cart.', 'uplift'),
						'options' => array(
							'slideout'	=> 'Slideout',
							'overlay'	=> 'Overlay',
							),
						'desc' => '',
						'default' => 'overlay'
					),
					array(
						'id' => 'mobile_top_text',
						'type' => 'text',
						'title' => __('Mobile Top Bar Text', 'uplift'),
						'subtitle' => "The text that is shown above the mobile header, ideal for phone number, email, or social icons placement. You can use shortcodes or text here.",
						'desc' => 'This is optional, leave it blank to hide it on the frontend.',
						'default' => ""
						),
					array(
						'id' => 'mobile_show_search',
						'type' => 'button_set',
						'title' => __('Show search box', 'uplift'),
						'subtitle' => __('Check this to show the search box in the mobile menu panel.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
						'id' => 'mobile_show_translation',
						'type' => 'button_set',
						'title' => __('Show translation options', 'uplift'),
						'subtitle' => __('Check this to show the translation options in the mobile menu panel. NOTE: the WPML plugin is required for this.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
						'id' => 'mobile_show_cart',
						'type' => 'button_set',
						'title' => __('Show cart', 'uplift'),
						'subtitle' => __('Check this to show the cart/wishlist and cart panel in the mobile header.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
						'id' => 'mobile_show_account',
						'type' => 'button_set',
						'title' => __('Show account options', 'uplift'),
						'subtitle' => __('Check this to show the account sign in / my account in the mobile cart panel.', 'uplift'),
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '1'
						),
				)
			);

			$this->sections[] = array(
				'type' => 'divide',
			);

			$this->sections[] = array(
				'icon' => 'el-icon-website',
				'title' => __('Footer Options', 'uplift'),
				'fields' => array(
					array(
						'id' => 'enable_footer',
						'type' => 'button_set',
						'title' => __('Enable Footer', 'uplift'),
						'subtitle' => __('Enable the footer widgets section.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '1'
						),
					array(
						'id' => 'enable_footer_divider',
						'type' => 'button_set',
						'required'  => array('enable_footer', '=', '1'),
						'title' => __('Footer Divider', 'uplift'),
						'subtitle' => __('Enable the footer divider above the footer.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '1'
						),
					array(
						'id' => 'footer_layout',
						'type' => 'image_select',
						'required'  => array('enable_footer', '=', '1'),
						'title' => __('Footer Layout', 'uplift'),
						'subtitle' => __('Select the footer column layout.', 'uplift'),
						'desc' => '',
						'options' => array(
										'footer-1' => array('title' => '', 'img' => $template_directory.'/images/footer-1.png'),
										'footer-2' => array('title' => '', 'img' => $template_directory.'/images/footer-2.png'),
										'footer-3' => array('title' => '', 'img' => $template_directory.'/images/footer-3.png'),
										'footer-4' => array('title' => '', 'img' => $template_directory.'/images/footer-4.png'),
										'footer-5' => array('title' => '', 'img' => $template_directory.'/images/footer-5.png'),
										'footer-6' => array('title' => '', 'img' => $template_directory.'/images/footer-6.png'),
										'footer-7' => array('title' => '', 'img' => $template_directory.'/images/footer-7.png'),
										'footer-8' => array('title' => '', 'img' => $template_directory.'/images/footer-8.png'),
										'footer-9' => array('title' => '', 'img' => $template_directory.'/images/footer-9.png'),
									),
						'default' => 'footer-1'
						),
					array(
						'id' => 'footer_divide_0',
						'type' => 'divide'
						),
					array(
						'id' => 'enable_copyright',
						'type' => 'button_set',
						'title' => __('Enable Copyright', 'uplift'),
						'subtitle' => __('Enable the footer copyright section.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '1'
						),
					array(
						'id' => 'enable_copyright_divider',
						'type' => 'button_set',
						'required'  => array('enable_copyright', '=', '1'),
						'title' => __('Copyright Divider', 'uplift'),
						'subtitle' => __('Enable the copyright divider above the copyright.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '1'
						),
					array(
						'id' => 'footer_copyright_text',
						'type' => 'editor',
						'required'  => array('enable_copyright', '=', '1'),
						'title' => __('Footer Copyright Text', 'uplift'),
						'subtitle' => 'The copyright text that appears in the footer.',
						'desc' => '',
						'default' => "&copy;[the-year] Uplift &middot; Built with love by <a href='http://www.swiftideas.com'>Swift Ideas</a> using [wp-link]."
						),
					array(
						'id' => 'copyright_right',
						'type' => 'button_set',
						'required'  => array('enable_copyright', '=', '1'),
						'title' => __('Copyright Right Setup', 'uplift'),
						'subtitle' => __('Choose if you would like to show a menu or text on the right of the copyright area.', 'uplift'),
						'desc' => '',
						'options' => array('text' => 'Text', 'menu' => 'Menu'),
						'default' => 'menu'
						),
					array(
						'id' => 'footer_copyright_text_right',
						'type' => 'editor',
						'required'  => array(
						                    array('enable_copyright', 'equals', '1'),
						                    array('copyright_right', 'equals', 'text'),
						               ),
						'title' => __('Footer Copyright Right Text', 'uplift'),
						'subtitle' => 'The copyright text that appears in the footer.',
						'desc' => '',
						'default' => "&copy;[the-year] Uplift &middot; Built with love by <a href='http://www.swiftideas.com'>Swift Ideas</a> using [wp-link]."
						),
					array(
						'id' => 'show_backlink',
						'type' => 'button_set',
						'required'  => array('enable_copyright', '=', '1'),
						'title' => __('Show Swift Ideas Backlink', 'uplift'),
						'subtitle' => __('If checked, a backlink to our site will be shown in the footer. This is not compulsory, but always appreciated!', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '1'
						),
				),
			);

			$this->sections[] = array(
				'type' => 'divide',
			);

			$this->sections[] = array(
				'icon' => 'el-icon-search',
				'title' => __('Super Search Options', 'uplift'),
				'fields' => array(
					array(
						'id' => 'ss_enable',
						'type' => 'button_set',
						'title' => __('Enable Super Search', 'uplift'),
						'subtitle' => __('Enable the Super Search functionality.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '1'
						),
					array(
						'id' => 'ss_super_search_field',
						'type' => 'super_search',
						'title' => __('Super Search', 'uplift'),
						'subtitle' => __('If enabled, the super search option will be included on the page. You will also need to choose the options below.', 'uplift')
						),
					array(
						'id' => 'ss_button_text',
						'type' => 'text',
						'title' => __('Super Search Button Text', 'uplift'),
						'subtitle' => 'The text for the super search button.',
						'desc' => '',
						'default' => "Super Search"
						),
				),
			);

			$this->sections[] = array(
				'icon' => 'el-icon-asterisk',
				'title' => __('Global Header Banner Options', 'uplift'),
				'fields' => array(
					array(
						'id' => 'enable_global_banner',
						'type' => 'button_set',
						'title' => __('Enable Global Header Banner', 'uplift'),
						'subtitle' => __('Enable the Newsletter/Subscribe bar at the bottom of the window on the home page.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
						'id' => 'global_banner_layout',
						'type' => 'image_select',
						'required'  => array('enable_global_banner', '=', '1'),
						'title' => __('Global Banner Layout', 'uplift'),
						'subtitle' => __('Select the widget column layout for the global header banner.', 'uplift'),
						'desc' => '',
						'options' => array(
										'gb-1' => array('title' => '', 'img' => $template_directory.'/images/footer-1.png'),
										'gb-2' => array('title' => '', 'img' => $template_directory.'/images/footer-2.png'),
										'gb-3' => array('title' => '', 'img' => $template_directory.'/images/footer-3.png'),
										'gb-4' => array('title' => '', 'img' => $template_directory.'/images/footer-4.png'),
										'gb-5' => array('title' => '', 'img' => $template_directory.'/images/footer-5.png'),
										'gb-6' => array('title' => '', 'img' => $template_directory.'/images/footer-6.png'),
										'gb-7' => array('title' => '', 'img' => $template_directory.'/images/footer-7.png'),
										'gb-8' => array('title' => '', 'img' => $template_directory.'/images/footer-8.png'),
										'gb-9' => array('title' => '', 'img' => $template_directory.'/images/footer-9.png'),
									),
						'default' => 'gb-1'
						),
				),
			);

			$this->sections[] = array(
				'icon' => 'el-icon-envelope',
				'title' => __('Newsletter/Subscribe Bar Options', 'uplift'),
				'fields' => array(
					array(
						'id' => 'enable_newsletter_sub_bar',
						'type' => 'button_set',
						'title' => __('Enable Newsletter/Subscribe Bar', 'uplift'),
						'subtitle' => __('Enable the Newsletter/Subscribe bar at the bottom of the window on the home page.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
						'id' => 'enable_newsletter_sub_bar_global',
						'type' => 'button_set',
						'title' => __('Enable Newsletter/Subscribe Bar Globally', 'uplift'),
						'subtitle' => __('Enable the Newsletter/Subscribe bar on every page.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
						'id' => 'sub_bar_text',
						'type' => 'text',
						'required'  => array('enable_newsletter_sub_bar', '=', '1'),
						'title' => __('Newsletter/Subscribe Bar Text', 'uplift'),
						'subtitle' => 'The text for the left of the newsletter bar.',
						'desc' => '',
						'default' => "Stay up to date"
						),
					array(
						'id' => 'sub_bar_code',
						'type' => 'ace_editor',
						'mode' => 'html',
						'theme' => 'chrome',
						'required'  => array('enable_newsletter_sub_bar', '=', '1'),
						'title' => __('Newsletter/Subscribe Bar Form Code', 'uplift'),
						'subtitle' => __('Paste the form code from your chosen subscription service here (or a shortcode). Ensure that no other css scripts are loaded here as these will affect the theme styling.', 'uplift'),
						'desc' => '',
						'default' => ''
						)
				),
			);

			$this->sections[] = array(
				'icon' => 'el-icon-bullhorn',
				'title' => __('Promo Bar Options', 'uplift'),
				'fields' => array(
					array(
						'id' => 'enable_footer_promo_bar',
						'type' => 'button_set',
						'title' => __('Enable Promo Bar', 'uplift'),
						'subtitle' => __('Enable the sitewide promo bar at the bottom of the page.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
						'id' => 'footer_promo_bar_type',
						'type' => 'button_set',
						'required'  => array('enable_footer_promo_bar', '=', '1'),
						'title' => __('Promo Bar Type', 'uplift'),
						'subtitle' => __('Select the type for the promo bar.', 'uplift'),
						'desc' => '',
						'options' => array('button' => 'Text + Button', 'text' => 'Text Only (Full Bar Link)'),
						'default' => 'button'
						),
					array(
						'id' => 'footer_promo_bar_text',
						'type' => 'text',
						'required'  => array('enable_footer_promo_bar', '=', '1'),
						'title' => __('Promo Bar Text', 'uplift'),
						'subtitle' => 'Enter the text for the promo bar here.',
						'desc' => '',
						'default' => 'Enter your promo bar text here.'
						),
					array(
						'id' => 'footer_promo_bar_text_size',
						'type' => 'button_set',
						'required'  => array(
							array('enable_footer_promo_bar', '=', '1'),
							array('footer_promo_bar_type', '=', 'text')
						),
						'title' => __('Promo Bar Text Size', 'uplift'),
						'subtitle' => 'Select the size for the promo bar text.',
						'options' => array(
							'impact-text'	=> 'Impact',
							'impact-text-large'	=> 'Impact (Large)',
						),
						'desc' => '',
						'default' => 'impact-text'
						),
					array(
						'id' => 'footer_promo_bar_button_color',
						'type' => 'select',
						'required'  => array('enable_footer_promo_bar', '=', '1'),
						'title' => __('Promo Bar Button Color', 'uplift'),
						'subtitle' => "Choose the color for the promo bar button.",
						'options' => array(
							'accent'	=> 'Accent',
							'black'	=> 'Black',
							'white'	=> 'White',
							'grey'	=> 'Grey',
							'lightgrey'	=> 'Light Grey',
							'gold'	=> 'Gold',
							'lightblue'	=> 'Light Blue',
							'green'	=> 'Green',
							'gold'	=> 'Gold',
							'turquoise'	=> 'Turquoise',
							'pink'	=> 'Pink',
							'orange'	=> 'Orange',
							'turquoise'	=> 'Turquoise',
							'transparent-light'	=> 'Transparent - Light',
							'transparent-dark'	=> 'Transparent - Dark',
							),
						'desc' => '',
						'default' => 'accent'
						),
					array(
						'id' => 'footer_promo_bar_button_type',
						'type' => 'select',
						'required'  => array('enable_footer_promo_bar', '=', '1'),
						'title' => __('Promo Bar Button Type', 'uplift'),
						'subtitle' => "Choose the type for the promo bar button.",
						'options' => array(
							'standard'	=> 'Standard',
							'bordered'	=> 'Bordered',
							'rounded'	=> 'Rounded',
							'rounded bordered'	=> 'Rounded Bordered'
							),
						'desc' => '',
						'default' => 'standard'
						),
					array(
						'id' => 'footer_promo_bar_button_text',
						'type' => 'text',
						'required'  => array('enable_footer_promo_bar', '=', '1'),
						'title' => __('Promo Bar Button Text', 'uplift'),
						'subtitle' => 'Enter the text for the promo bar button here, if you have the Text + Button type selected.',
						'desc' => '',
						'default' => 'Button Text.'
						),
					array(
						'id' => 'footer_promo_bar_button_link',
						'type' => 'text',
						'required'  => array('enable_footer_promo_bar', '=', '1'),
						'title' => __('Promo Bar Button Link', 'uplift'),
						'subtitle' => 'Enter the link for the promo bar button here, if you have the Text + Button or Text + Arrow Button type selected.',
						'desc' => '',
						'default' => 'http://'
						),
					array(
						'id' => 'footer_promo_bar_button_target',
						'type' => 'button_set',
						'required'  => array('enable_footer_promo_bar', '=', '1'),
						'title' => __('Promo Bar Button Target', 'uplift'),
						'subtitle' => __('Select the target for the promo bar link.', 'uplift'),
						'desc' => '',
						'options' => array('_self' => 'Same Window', '_blank' => 'New Window'),
						'default' => '_self'
						),
				),
			);

			$this->sections[] = array(
				'icon' => 'el-icon-star',
				'title' => __('Review Options', 'uplift'),
				'fields' => array(
					array(
						'id' => 'review_format',
						'type' => 'select',
						'title' => __('Review Point Format', 'uplift'),
						'sub_desc' => "Choose the review point format.",
						'options' => array(
							'percentage'		=> 'Percentage (0-100%)',
							'points'			=> 'Points (0-10)'
							),
						'desc' => '',
						'std' => 'percentage'
						),
					array(
						'id' => 'review_cat_1',
						'type' => 'text',
						'title' => __('Default Review Category 1', 'uplift'),
						'sub_desc' => "Set the default name for review category 1",
						'desc' => '',
						'std' => ''
						),
					array(
						'id' => 'review_cat_2',
						'type' => 'text',
						'title' => __('Default Review Category 2', 'uplift'),
						'sub_desc' => "Set the default name for review category 2",
						'desc' => '',
						'std' => ''
						),
					array(
						'id' => 'review_cat_3',
						'type' => 'text',
						'title' => __('Default Review Category 3', 'uplift'),
						'sub_desc' => "Set the default name for review category 3",
						'desc' => '',
						'std' => ''
						),
					array(
						'id' => 'review_cat_4',
						'type' => 'text',
						'title' => __('Default Review Category 4', 'uplift'),
						'sub_desc' => "Set the default name for review category 4",
						'desc' => '',
						'std' => ''
						)
				),
			);

			$this->sections[] = array(
				'type' => 'divide',
			);

			$this->sections[] = array(
				'icon' => 'el-icon-fontsize',
				'title' => __('Font Options', 'uplift'),
				'fields' => array(
					array(
						'id' => 'custom_fonts',
						'type' => 'custom_fonts'
					),
					array(
						'id'=>'body_font',
						'type' => 'typography',
						'title' => __('Body Font', 'uplift'),
						'subtitle' => __('Specify the body font properties.', 'uplift'),
						'google'=> true,
						'font-backup'=>true,
						'text-align'=>false,
						'color'=>false,
						'letter-spacing'=>true,
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('body,p,nav.std-menu ul.sub-menu,ul.mega-sub-menu,blockquote.blockquote1, blockquote.blockquote1 p'), // An array of CSS selectors to apply this font style to dynamically
						'compiler' => array('body,p,nav.std-menu ul.sub-menu,ul.mega-sub-menu,blockquote.blockquote1, blockquote.blockquote1 p'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'default' => array(
							'font-size'=>'14px',
							'line-height'=>'28px',
							'font-family'=>'Source Sans Pro',
							'font-weight'=>'400',
							),
						),
					array(
						'id'=>'h1_font',
						'type' => 'typography',
						'title' => __('H1 Font', 'uplift'),
						'subtitle' => __('Specify the H1 font properties.', 'uplift'),
						'google'=> true,
						'font-backup'=>true,
						'text-align'=>false,
						'color'=>false,
						'letter-spacing'=>true,
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('h1,.impact-text,.impact-text > p,.impact-text-large,.impact-text-large > p,h3.countdown-subject, .swiper-slide .caption-content > h2, #jckqv h1, .spb_tweets_slider_widget .tweet-text, .modal-header h3'), // An array of CSS selectors to apply this font style to dynamically
						'compiler' => array('h1,.impact-text,.impact-text > p,.impact-text-large,.impact-text-large > p,h3.countdown-subject,.swiper-slide .caption-content > h2, #jckqv h1, .spb_tweets_slider_widget .tweet-text, .modal-header h3'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'default' => array(
							'font-size'=>'30px',
							'line-height'=>'48px',
							'font-family'=>'Open Sans',
							'font-weight'=>'300',
							),
						),
					array(
						'id'=>'h2_font',
						'type' => 'typography',
						'title' => __('H2 Font', 'uplift'),
						'subtitle' => __('Specify the H2 font properties.', 'uplift'),
						'google'=> true,
						'font-backup'=>true,
						'text-align'=>false,
						'color'=>false,
						'letter-spacing'=>true,
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('h2,.blog-item .quote-excerpt, .spb-row-expand-text'), // An array of CSS selectors to apply this font style to dynamically
						'compiler' => array('h2,.blog-item .quote-excerpt, .spb-row-expand-text'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'default' => array(
							'font-size'=>'24px',
							'line-height'=>'36px',
							'font-family'=>'Open Sans',
							'font-weight'=>'400',
							),
						),
					array(
						'id'=>'h3_font',
						'type' => 'typography',
						'title' => __('H3 Font', 'uplift'),
						'subtitle' => __('Specify the H3 font properties.', 'uplift'),
						'google'=> true,
						'font-backup'=>true,
						'text-align'=>false,
						'color'=>false,
						'letter-spacing'=>true,
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('h3, .single_variation_wrap .single_variation span.price, .sf-promo-bar p.standard,  .sf-promo-bar.text-size-standard p, .sf-icon-box-animated-alt .front .back-title'), // An array of CSS selectors to apply this font style to dynamically
						'compiler' => array('h3, .single_variation_wrap .single_variation span.price, .sf-promo-bar p.standard, .sf-promo-bar.text-size-standard p, .sf-icon-box-animated-alt .front .back-title'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'default' => array(
							'font-size'=>'18px',
							'line-height'=>'26px',
							'font-family'=>'Open Sans',
							'font-weight'=>'700',
							),
						),
					array(
						'id'=>'h4_font',
						'type' => 'typography',
						'title' => __('H4 Font', 'uplift'),
						'subtitle' => __('Specify the H4 font properties.', 'uplift'),
						'google'=> true,
						'font-backup'=>true,
						'text-align'=>false,
						'color'=>false,
						'letter-spacing'=>true,
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('h4'), // An array of CSS selectors to apply this font style to dynamically
						'compiler' => array('h4'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'default' => array(
							'font-size'=>'16px',
							'line-height'=>'24px',
							'font-family'=>'Open Sans',
							'font-weight'=>'700',
							),
						),
					array(
						'id'=>'h5_font',
						'type' => 'typography',
						'title' => __('H5 Font', 'uplift'),
						'subtitle' => __('Specify the H5 font properties.', 'uplift'),
						'google'=> true,
						'font-backup'=>true,
						'text-align'=>false,
						'color'=>false,
						'letter-spacing'=>true,
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('h5,blockquote.blockquote2,blockquote.blockquote2 p,blockquote.pullquote,blockquote.pullquote p,.faq-item .faq-text:before'), // An array of CSS selectors to apply this font style to dynamically
						'compiler' => array('h5,blockquote.blockquote2,blockquote.blockquote2 p,blockquote.pullquote,blockquote.pullquote p,.faq-item .faq-text:before'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'default' => array(
							'font-size'=>'16px',
							'line-height'=>'22px',
							'font-family'=>'Open Sans',
							'font-weight'=>'400',
							),
						),
					array(
						'id'=>'h6_font',
						'type' => 'typography',
						'title' => __('H6 Font', 'uplift'),
						'subtitle' => __('Specify the H6 font properties.', 'uplift'),
						'google'=> true,
						'font-backup'=>true,
						'text-align'=>false,
						'color'=>false,
						'text-transform'=>true,
						'letter-spacing'=>true,
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('h6'), // An array of CSS selectors to apply this font style to dynamically
						'compiler' => array('h6'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'default' => array(
							'font-size'=>'12px',
							'line-height'=>'16px',
							'font-family'=>'Open Sans',
							'font-weight'=>'700',
							'text-transform'=>'uppercase'
							),
						),
					array(
						'id'=> 'menu_font',
						'type' => 'typography',
						'title' => __('Menu Font', 'uplift'),
						'subtitle' => __('Specify the Menu font properties.', 'uplift'),
						'google' => true,
						'font-backup' =>true,
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'line-height'=>false,
						'color'=>false,
						'letter-spacing'=>true,
						'output' => array('#main-nav, #header nav, .vertical-menu nav, .header-9#header-section #main-nav, #overlay-menu nav, .sf-pushnav-menu nav, #mobile-menu, #one-page-nav li .hover-caption, .mobile-search-form input[type="text"]'), // An array of CSS selectors to apply this font style to dynamically
						'compiler' => array('#main-nav, #header nav, .vertical-menu nav, .header-9#header-section #main-nav, #overlay-menu nav, .sf-pushnav-menu nav, #mobile-menu, #one-page-nav li .hover-caption, .mobile-search-form input[type="text"]'), // An array of CSS selectors to apply this font style to dynamically
						'units'=> 'px', // Defaults to px
						'default' => array(
							'font-size'=>'18px',
							'font-family'=>'Source Sans Pro',
							'font-weight'=>'400',
							),
						),
				),
			);
			
			// $this->sections[] = array(
			// 	'icon' => 'el-icon-fontsize',
			// 	'title' => __('Icon Fonts', 'uplift'),
			// 	'fields' => array(
			// 		array(
			// 			'id' => 'custom_icon_fonts',
			// 			'type' => 'custom_icon_fonts'
			// 		)
			// 	),
			// );

			$this->sections[] = array(
				'type' => 'divide',
			);

			$this->sections[] = array(
				'icon' => 'el-icon-th-list',
				'title' => __('Default Meta Options', 'uplift'),
				'fields' => array(
					array(
						'id' => 'default_show_page_heading',
						'type' => 'button_set',
						'title' => __('Default Show Page Heading', 'uplift'),
						'subtitle' => __('Choose the default state for the page heading, shown/hidden.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '1'
						),
					array(
						'id' => 'default_sidebar_config',
						'type' => 'select',
						'title' => __('Default Page Sidebar Config', 'uplift'),
						'subtitle' => "Choose the default sidebar config for pages",
						'options' => array(
							'no-sidebars'		=> 'No Sidebars',
							'left-sidebar'		=> 'Left Sidebar',
							'right-sidebar'		=> 'Right Sidebar',
							'both-sidebars'		=> 'Both Sidebars'
						),
						'desc' => '',
						'default' => 'no-sidebars'
						),
					array(
						'id' => 'default_left_sidebar',
						'type' => 'select',
						'title' => __('Default Page Left Sidebar', 'uplift'),
						'subtitle' => "Choose the default left sidebar for pages",
						'data'      => 'sidebars',
						'desc' => '',
						'default' => 'sidebar-1'
						),
					array(
						'id' => 'default_right_sidebar',
						'type' => 'select',
						'title' => __('Default Page Right Sidebar', 'uplift'),
						'subtitle' => "Choose the default right sidebar for pages",
						'data'      => 'sidebars',
						'desc' => '',
						'default' => 'sidebar-1'
						),
					array(
						'id' => 'dm_divide_1',
						'type' => 'divide'
						),
					array(
						'id' => 'default_post_sidebar_config',
						'type' => 'select',
						'title' => __('Default Post Sidebar Config', 'uplift'),
						'subtitle' => "Choose the default sidebar config for posts",
						'options' => array(
							'no-sidebars'		=> 'No Sidebars',
							'left-sidebar'		=> 'Left Sidebar',
							'right-sidebar'		=> 'Right Sidebar',
						),
						'desc' => '',
						'default' => 'no-sidebars'
						),
					array(
						'id' => 'default_post_left_sidebar',
						'type' => 'select',
						'title' => __('Default Post Left Sidebar', 'uplift'),
						'subtitle' => "Choose the default left sidebar for posts",
						'data'      => 'sidebars',
						'desc' => '',
						'default' => 'sidebar-1'
						),
					array(
						'id' => 'default_post_right_sidebar',
						'type' => 'select',
						'title' => __('Default Post Right Sidebar', 'uplift'),
						'subtitle' => "Choose the default right sidebar for posts",
						'data'      => 'sidebars',
						'desc' => '',
						'default' => 'sidebar-1'
						),
					array(
						'id' => 'default_include_author',
						'type' => 'button_set',
						'title' => __('Default Include Author', 'uplift'),
						'subtitle' => __('Choose the default state for the post author box, shown/hidden.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '1'
						),
					array(
						'id' => 'default_include_social',
						'type' => 'button_set',
						'title' => __('Default Include Social Sharing', 'uplift'),
						'subtitle' => __('Choose the default state for the post social sharing, shown/hidden.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '1'
						),
					array(
						'id' => 'default_include_related',
						'type' => 'button_set',
						'title' => __('Default Include Related Articles', 'uplift'),
						'subtitle' => __('Choose the default state for the post related articles, shown/hidden.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '1'
						),
					array(
						'id' => 'default_thumb_media',
						'type' => 'select',
						'title' => __('Default Thumbnail Media', 'uplift'),
						'subtitle' => "Choose the default thumbnail media for posts",
						'options' => array(
							'none'		=> 'None',
							'image'		=> 'Image',
						),
						'desc' => '',
						'default' => 'image'
						),
					array(
						'id' => 'default_detail_media',
						'type' => 'select',
						'title' => __('Default Detail Media', 'uplift'),
						'subtitle' => "Choose the default detail media for posts",
						'options' => array(
							'none'		=> 'None',
							'image'		=> 'Image',
						),
						'desc' => '',
						'default' => 'image'
						),
				),
			);

			$this->sections[] = array(
				'icon' => 'el-icon-th',
				'title' => __('Archive/Category Options', 'uplift'),
				'fields' => array(
					array(
						'id' => 'archive_sidebar_config',
						'type' => 'select',
						'title' => __('Sidebar Config', 'uplift'),
						'subtitle' => "Choose the sidebar configuration for the archive/category pages.",
						'options' => array(
							'no-sidebars'		=> 'No Sidebars',
							'left-sidebar'		=> 'Left Sidebar',
							'right-sidebar'		=> 'Right Sidebar',
							'both-sidebars'		=> 'Both Sidebars'
							),
						'desc' => '',
						'default' => 'right-sidebar'
						),
					array(
						'id' => 'archive_sidebar_left',
						'type' => 'select',
						'title' => __('Left Sidebar', 'uplift'),
						'subtitle' => "Choose the left sidebar for Left/Both sidebar configs.",
						'data'      => 'sidebars',
						'desc' => '',
						'default' => 'sidebar-1'
						),
					array(
						'id' => 'archive_sidebar_right',
						'type' => 'select',
						'title' => __('Right Sidebar', 'uplift'),
						'subtitle' => "Choose the left sidebar for Right/Both sidebar configs.",
						'data'      => 'sidebars',
						'desc' => '',
						'default' => 'sidebar-1'
						),
					array(
						'id' => 'archive_display_type',
						'type' => 'select',
						'title' => __('Display Type', 'uplift'),
						'subtitle' => "Select the display type. Note: Masonry (Full Width) is only available when the sidebar config is set to no sidebars.",
						'options' => array(
							'standard'		=> 'Standard',
							'timeline'		=> 'Timeline',
							'mini'			=> 'Mini',
							'masonry'		=> 'Masonry',
							),
						'desc' => '',
						'default' => 'standard'
						),
					array(
						'id' => 'archive_display_columns',
						'type' => 'select',
						'title' => __('Masonry Archive Columns', 'uplift'),
						'subtitle' => "Select the number of columns for the archive.",
						'options' => array(
							'1'		=> '1',
							'2'		=> '2',
							'3'		=> '3',
							'4'		=> '4'
							),
						'desc' => '',
						'default' => '2',
						'required'  => array('archive_display_type', '=', 'masonry'),
						),
					array(
						'id' => 'archive_display_pagination',
						'type' => 'select',
						'title' => __('Archive Pagination', 'uplift'),
						'subtitle' => "Select the pagination type for the archive.",
						'options' => array(
							'infinite-scroll'		=> 'Infinite Scroll',
							'load-more'		=> 'Load More (AJAX)',
							'standard'		=> 'Standard',
							'none'		=> 'None'
							),
						'desc' => '',
						'default' => 'none',
						),
					array(
						'id' => 'archive_content_output',
						'type' => 'select',
						'title' => __('Archive Content Output', 'uplift'),
						'subtitle' => "Select if you'd like to output the content or excerpt on archive pages.",
						'options' => array(
							'excerpt'		=> 'Excerpt',
							'content'		=> 'Content',
							),
						'desc' => '',
						'default' => 'excerpt'
						),
					array(
						'id' => 'archive_divide_a',
						'type' => 'divide'
						),
					array(
						'id' => 'portfolio_archive_display_type',
						'type' => 'select',
						'title' => __('Portfolio Archive Display Type', 'uplift'),
						'subtitle' => "Select the display type.",
						'options' => array(
							'standard'		=> 'Standard',
							'gallery'		=> 'Gallery',
							'masonry'		=> 'Masonry',
							'masonry-gallery'	=> 'Masonry Gallery'
							),
						'desc' => '',
						'default' => 'standard'
						),
					array(
						'id' => 'portfolio_archive_columns',
						'type' => 'select',
						'title' => __('Portfolio Archive Columns', 'uplift'),
						'subtitle' => "Select the number of columns for the portfolio archive.",
						'options' => array(
							'1'		=> '1',
							'2'		=> '2',
							'3'		=> '3',
							'4'		=> '4'
							),
						'desc' => '',
						'default' => '4'
						)
				),
			);

			$this->sections[] = array(
				'icon' => 'el-icon-group',
				'title' => __('BuddyPress & bbPress Options', 'uplift'),
				'fields' => array(
					array(
						'id' => 'bp_sidebar_config',
						'type' => 'select',
						'title' => __('BuddyPress Sidebar Config', 'uplift'),
						'subtitle' => "Choose the sidebar configuration for the BuddyPress pages.",
						'options' => array(
							'no-sidebars'		=> 'No Sidebars',
							'left-sidebar'		=> 'Left Sidebar',
							'right-sidebar'		=> 'Right Sidebar',
							'both-sidebars'		=> 'Both Sidebars'
							),
						'desc' => '',
						'default' => 'right-sidebar'
						),
					array(
						'id' => 'bp_sidebar_left',
						'type' => 'select',
						'title' => __('BuddyPress Left Sidebar', 'uplift'),
						'subtitle' => "Choose the left sidebar for Left/Both sidebar configs.",
						'data'      => 'sidebars',
						'desc' => '',
						'default' => 'sidebar-1'
						),
					array(
						'id' => 'bp_sidebar_right',
						'type' => 'select',
						'title' => __('BuddyPress Right Sidebar', 'uplift'),
						'subtitle' => "Choose the left sidebar for Right/Both sidebar configs.",
						'data'      => 'sidebars',
						'desc' => '',
						'default' => 'sidebar-1'
						),
					array(
						'id' => 'bb_divide_a',
						'type' => 'divide'
						),
					array(
						'id' => 'bb_sidebar_config',
						'type' => 'select',
						'title' => __('bbPress Sidebar Config', 'uplift'),
						'subtitle' => "Choose the sidebar configuration for the bbPress pages.",
						'options' => array(
							'no-sidebars'		=> 'No Sidebars',
							'left-sidebar'		=> 'Left Sidebar',
							'right-sidebar'		=> 'Right Sidebar',
							'both-sidebars'		=> 'Both Sidebars'
							),
						'desc' => '',
						'default' => 'right-sidebar'
						),
					array(
						'id' => 'bb_sidebar_left',
						'type' => 'select',
						'title' => __('bbPress Left Sidebar', 'uplift'),
						'subtitle' => "Choose the left sidebar for Left/Both sidebar configs.",
						'data'      => 'sidebars',
						'desc' => '',
						'default' => 'sidebar-1'
						),
					array(
						'id' => 'bb_sidebar_right',
						'type' => 'select',
						'title' => __('bbPress Right Sidebar', 'uplift'),
						'subtitle' => "Choose the left sidebar for Right/Both sidebar configs.",
						'data'      => 'sidebars',
						'desc' => '',
						'default' => 'sidebar-1'
						),
				),
			);

			$this->sections[] = array(
				'icon' => 'el-icon-view-mode',
				'title' => __('Post Type Options', 'uplift'),
				'fields' => array(
					array(
						'id' => 'single_post_navigation',
						'type' => 'button_set',
						'title' => __('Single Post Navigation', 'uplift'),
						'subtitle' => __('If enabled, each post will show next/prev navigation at the bottom of the post.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
						'id' => 'blog_page',
						'type' => 'select',
						'data' => 'pages',
						'title' => __('Blog Page', 'uplift'),
						'subtitle' => __('Select the page that is your main blog index page. This is used to link to the page from the blog post detail page, and the page builder recent post asset.', 'uplift'),
						'desc' => '',
						'default' => '',
						'args' => array()
						),
					array(
						'id' => 'single_author',
						'type' => 'button_set',
						'title' => __('Single Author Blog', 'uplift'),
						'subtitle' => __('If enabled, the author name will be hidden from the blog/post details in the page builder assets and single details line.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
						'id' => 'remove_dates',
						'type' => 'button_set',
						'title' => __('Remove Post Dates', 'uplift'),
						'subtitle' => __('If enabled, the date will not be included with the post details.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
						'id'=>'cpt-divide-1',
						'type' => 'divide'
						),
					array(
						'id' => 'portfolio_page',
						'type' => 'select',
						'data' => 'pages',
						'title' => __('Portfolio Page', 'uplift'),
						'subtitle' => __('Select the page that is your portfolio index page. This is used to link to the page from the portfolio detail page.', 'uplift'),
						'desc' => '',
						'default' => '',
						'args' => array()
						),
					array(
						'id' => 'enable_category_navigation',
						'type' => 'button_set',
						'title' => __('Enable Category Navigation', 'uplift'),
						'subtitle' => __('Enable this if you would like to set it so that the single portfolio pagination only includes items within the same category.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
						'id' => 'related_projects_fullwidth',
						'type' => 'button_set',
						'title' => __('Full Width Related Projects Display', 'uplift'),
						'subtitle' => __('Enable this to make the related projects show full width on the portfolio detail page.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '1'
						),
					array(
						'id' => 'related_projects_gutters',
						'type' => 'button_set',
						'title' => __('Related Projects Gutters', 'uplift'),
						'subtitle' => __('Enable or Disable spacing between the related project items.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'Gutters','0' => 'No Gutters'),
						'default' => '1'
						),
					array(
						'id' => 'related_projects_columns',
						'type' => 'button_set',
						'title' => __('Related Projects Columns', 'uplift'),
						'subtitle' => __('Choose between 3 and 4 columns for the related projects the portfolio detail page.', 'uplift'),
						'desc' => '',
						'options' => array('3' => '3','4' => '4'),
						'default' => '3'
						),
					array(
						'id'=>'cpt-divide-2',
						'type' => 'divide'
						),
					array(
						'id' => 'testimonial_page',
						'type' => 'select',
						'data' => 'pages',
						'title' => __('Testimonial Page', 'uplift'),
						'subtitle' => __('Select the page that is your testimonial index page. This is used to link to the page from various places.', 'uplift'),
						'desc' => '',
						'default' => '',
						'args' => array()
						),
				),
			);

			$this->sections[] = array(
				'type' => 'divide',
			);

			$this->sections[] = array(
				'icon' => 'el-icon-shopping-cart',
				'title' => __('WooCommerce Options', 'uplift'),
				'fields' => array(
					array(
						'id' => 'cart_notification',
						'type' => 'select',
						'title' => __('Cart Notification Animation', 'uplift'),
						'subtitle' => "Choose the animation style for the cart/wishlist menu item when adding a product.",
						'options' => array(
							''	=> 'None',
							'tada'		=> 'TaDa',
							'bounce'	=> 'Bounce',
							'flash'		=> 'Flash',
							'pulse'		=> 'Pulse',
							'shake'		=> 'Shake'
						),
						'desc' => '',
						'default' => 'tada'
						),
					array(
						'id' => 'woo_shop_divide_a',
						'type' => 'divide'
						),
					array(
						'id' => 'enable_catalog_mode',
						'type' => 'button_set',
						'title' => __('Catalog Mode', 'uplift'),
						'subtitle' => __('Enable this setting to set the products into catalog mode, with no cart or checkout process.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
					    'id'        => 'products_per_page',
					    'type'      => 'text',
					    'title'     => __('Products Per Page', 'uplift'),
					    'subtitle'  => __('Number value.', 'uplift'),
					    'desc'      => __('The amount of products you would like to show per page on shop/category pages.', 'uplift'),
					    'validate'  => 'numeric',
					    'default'   => '24',
					),
					array(
					    'id'        => 'new_badge',
					    'type'      => 'text',
					    'title'     => __('New Badge', 'uplift'),
					    'subtitle'  => __('Number value.', 'uplift'),
					    'desc'      => __('The amount of time in days that the "New" badge will display on products. Set this to 0 to disable the badge.', 'uplift'),
					    'validate'  => 'numeric',
					    'default'   => '7',
					),
					array(
						'id' => 'woo_general_divide_1',
						'type' => 'divide'
						),
					array(
						'id' => 'order_tracking_page',
						'type' => 'select',
						'data' => 'pages',
						'title' => __('Order Tracking Page', 'uplift'),
						'subtitle' => __('Select the page that is your order tracking page. This is required to use the tracking link in the my account header aux.', 'uplift'),
						'desc' => '',
						'default' => '',
						'args' => array()
						),
					array(
						'id' => 'minimal_checkout',
						'type' => 'button_set',
						'title' => __('Minimal Checkout Mode', 'uplift'),
						'subtitle' => __('Enable this setting to display the checkout in minimal mode - with no header or footer.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
						'id' => 'checkout_new_account_text',
						'type' => 'textarea',
						'title' => __('New account text', 'swiftframework'),
						'subtitle' => __('This text appears in the sign in / sign up area of the checkout process.', 'swiftframework'),
						'desc' => '',
						'default' => 'Creating an account with Uplift is quick and easy, and will allow you to move through our checkout quicker. You can also store shipping & billing addresses, gain access to your order history, and much more.'
						),
					array(
						'id' => 'disable_help_bar',
						'type' => 'button_set',
						'title' => __('Disable Help Bar', 'uplift'),
						'subtitle' => __('Disable the help bar on checkout pages.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'Disable','0' => 'Enable'),
						'default' => '0'
						),
					array(
						'id' => 'help_bar_text',
						'type' => 'text',
						'title' => __('Help Bar Text', 'uplift'),
						'subtitle' => __('This text appears in the help bar on checkout pages.', 'uplift'),
						'desc' => '',
						'default' => 'Need help? Call customer services on 0800 123 4567.'
						),
					array(
						'id' => 'email_modal_title',
						'type' => 'text',
						'title' => __('Modal Link 1 Title', 'uplift'),
						'subtitle' => __('The first modal link title text. Leave blank to remove this.', 'uplift'),
						'desc' => '',
						'default' => 'Email Customer Care'
						),
					array(
						'id' => 'email_modal',
						'type' => 'textarea',
						'required'  => array('email_modal_title', '!=', ''),
						'title' => __('Modal 1 Content', 'uplift'),
						'subtitle' => __('The content that appears in the modal box for the email customer care help link.', 'uplift'),
						'desc' => '',
						'default' => 'Enter your contact details or email form shortcode here. (Text/HTML/Shortcodes accepted).'
						),
					array(
						'id' => 'shipping_modal_title',
						'type' => 'text',
						'title' => __('Modal Link 2 Title', 'uplift'),
						'subtitle' => __('The second modal link title text. Leave blank to remove this.', 'uplift'),
						'desc' => '',
						'default' => 'Shipping Information.'
						),
					array(
						'id' => 'shipping_modal',
						'type' => 'textarea',
						'required'  => array('shipping_modal_title', '!=', ''),
						'title' => __('Modal 2 Content', 'uplift'),
						'subtitle' => __('The content that appears in the modal box for the first modal link.', 'uplift'),
						'desc' => '',
						'default' => 'Enter your shipping information here. (Text/HTML/Shortcodes accepted).'
						),
					array(
						'id' => 'returns_modal_title',
						'type' => 'text',
						'title' => __('Modal Link 3 Title', 'uplift'),
						'subtitle' => __('The second modal link title text. Leave blank to remove this.', 'uplift'),
						'desc' => '',
						'default' => 'Returns Information.'
						),
					array(
						'id' => 'returns_modal',
						'type' => 'textarea',
						'required'  => array('returns_modal_title', '!=', ''),
						'title' => __('Modal 3 Content', 'uplift'),
						'subtitle' => __('The content that appears in the modal box for the second modal link.', 'uplift'),
						'desc' => '',
						'default' => 'Enter your returns and exchange information here. (Text/HTML/Shortcodes accepted).'
						),
					array(
						'id' => 'faqs_modal_title',
						'type' => 'text',
						'title' => __('Modal Link 4 Title', 'uplift'),
						'subtitle' => __('The second modal link title text. Leave blank to remove this.', 'uplift'),
						'desc' => '',
						'default' => 'F.A.Q'
						),
					array(
						'id' => 'faqs_modal',
						'type' => 'textarea',
						'required'  => array('faqs_modal_title', '!=', ''),
						'title' => __('Modal 4 Content', 'uplift'),
						'subtitle' => __('The content that appears in the modal box for the third modal link.', 'uplift'),
						'desc' => '',
						'default' => 'Enter your faqs here. (Text/HTML/Shortcodes accepted).'
						),
//					array(
//						'id' => 'feedback_modal_title',
//						'type' => 'text',
//						'title' => __('Feedback Modal Title', 'uplift'),
//						'subtitle' => __('The Feedback modal link title text on product pages. Leave blank to remove this.', 'uplift'),
//						'desc' => '',
//						'default' => 'Feedback'
//						),
//					array(
//						'id' => 'feedback_modal',
//						'type' => 'textarea',
//						'title' => __('Feedback Modal Content', 'uplift'),
//						'subtitle' => __('The content that appears in the modal box for the feedback modal link on product pages.', 'uplift'),
//						'desc' => '',
//						'default' => 'Enter your feedback modal content here. (Text/HTML/Shortcodes accepted).'
//						),
				),
			);

			$this->sections[] = array(
				'icon' => 'el-icon-shopping-cart',
				'title' => __('Shop Options', 'uplift'),
				'subsection' => true,
				'fields' => array(
					array(
						'id' => 'product_display_pagination',
						'type' => 'select',
						'title' => __('Shop Pagination', 'uplift'),
						'subtitle' => "Select the pagination type for the shop page.",
						'options' => array(
							'infinite-scroll' => 'Infinite Scroll',
							'load-more'		=> 'Load More (AJAX)',
							'standard'		=> 'Standard',
							'none'		=> 'None'
							),
						'desc' => '',
						'default' => 'standard',
						),
					array(
						'id' => 'product_display_type',
						'type' => 'select',
						'title' => __('Product Display Type', 'uplift'),
						'subtitle' => "Choose the product display type for WooCommerce shop/category pages.",
						'options' => array(
							'standard'		=> 'Standard',
							'preview-slider'	=> 'Preview Slider'
						),
						'desc' => '',
						'default' => 'standard'
						),
					array(
						'id' => 'product_display_layout',
							'type' => 'select',
							'title' => __('Product Display Layout', 'uplift'),
							'subtitle' => "Choose the default product display layout for WooCommerce shop/category pages (not applicable with multi-masonry display).",
							'options' => array(
								'standard'		=> 'Standard',
								'grid'		=> 'Grid',
								'list'	=> 'List',
							),
							'desc' => '',
							'default' => 'standard'
							),
					array(
						'id' => 'disable_product_transition',
						'type' => 'button_set',
						'title' => __('Product Hover', 'uplift'),
						'subtitle' => __('Choose if you would like to enable/disable the product image transition on hover.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'Disabled','0' => 'Enabled'),
						'default' => '0'
						),
					array(
						'id' => 'product_details_alignment',
						'type' => 'button_set',
						'title' => __('Product Details Alignment', 'uplift'),
						'subtitle' => __('Choose the alignment of the product details on the shop index.', 'uplift'),
						'desc' => '',
						'options' => array('left' => 'Left','center' => 'Center','right' => 'Right'),
						'default' => 'center'
						),
					array(
						'id' => 'product_display_columns',
						'type' => 'select',
						'title' => __('Product Display Columns', 'uplift'),
						'subtitle' => "Choose the number of columns to display on shop/category pages.",
						'options' => array(
							'1'		=> '1',
							'2'		=> '2',
							'3'		=> '3',
							'4'		=> '4',
							'5'		=> '5',
							'6'		=> '6',
						),
						'desc' => '',
						'default' => '4'
						),
					array(
						'id' => 'product_multi_masonry',
						'type' => 'button_set',
						'title' => __('Multi-Masonry Display', 'uplift'),
						'subtitle' => __('Choose if you would like to display products on shop/category pages in Multi-Masonry layout.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'Yes','0' => 'No'),
						'default' => '0'
						),
					array(
						'id' => 'product_display_gutters',
						'type' => 'button_set',
						'title' => __('Product Display Gutters', 'uplift'),
						'subtitle' => __('Choose if you would like spacing in between the products - Gallery modes only.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'Gutters','0' => 'No Gutters'),
						'default' => '1'
						),
					array(
						'id' => 'product_display_fullwidth',
						'type' => 'button_set',
						'title' => __('Full Width Product Display', 'uplift'),
						'subtitle' => __('Choose if you would like the shop page to show full width, with a sidebar integrated into the masonry (Only Left/Right Sidebar Option is supported). NOTE: Sidebars will not show if you have the Multi-Masonry Display enabled.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'Yes','0' => 'No'),
						'default' => '0'
						),
					array(
						'id' => 'product_qv_hover',
						'type' => 'button_set',
						'title' => __('Quickview only on hover', 'uplift'),
						'subtitle' => __('Enable this if you would like the quickview to only show on hover. Note: You will need the quickview plugin installed and activated.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'Yes','0' => 'No'),
						'default' => '1'
						),
					array(
						'id' => 'product_rating',
						'type' => 'button_set',
						'title' => __('Standard - Show rating', 'uplift'),
						'subtitle' => __('Enable this if you would like to show the product rating below the product image/details (standard display type only).', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'Yes','0' => 'No'),
						'default' => '1'
						),
					array(
						'id' => 'product_buybtn',
						'type' => 'button_set',
						'title' => __('Standard - Show buy button', 'uplift'),
						'subtitle' => __('Enable this if you would like to show the buy button below the product image/details (standard display type only).', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'Yes','0' => 'No'),
						'default' => '0'
						),
					array(
						'id' => 'product_filter',
						'type' => 'button_set',
						'title' => __('Product Filter', 'uplift'),
						'subtitle' => __('Choose if you would like to enable disable the top bar product filter options.', 'uplift'),
						'desc' => '',
						'options' => array('0' => 'Disabled','1' => 'Enabled', 'mobile-only' => 'Mobile Only'),
						'default' => '1'
						),
					array(
						'id' => 'woo_sidebar_config',
						'type' => 'select',
						'title' => __('WooCommerce Sidebar Config', 'uplift'),
						'subtitle' => "Choose the sidebar config for WooCommerce shop/category pages.",
						'options' => array(
							'no-sidebars'		=> 'No Sidebars',
							'left-sidebar'		=> 'Left Sidebar',
							'right-sidebar'		=> 'Right Sidebar',
							'both-sidebars'		=> 'Both Sidebars'
						),
						'desc' => '',
						'default' => 'no-sidebars'
						),
					array(
						'id' => 'woo_left_sidebar',
						'type' => 'select',
						'title' => __('WooCommerce Left Sidebar', 'uplift'),
						'subtitle' => "Choose the left sidebar for WooCommerce shop/category pages.",
						'data'      => 'sidebars',
						'desc' => '',
						'default' => 'woocommerce-sidebar'
						),
					array(
						'id' => 'woo_right_sidebar',
						'type' => 'select',
						'title' => __('WooCommerce Right Sidebar', 'uplift'),
						'subtitle' => "Choose the right sidebar for WooCommerce shop/category pages.",
						'data'      => 'sidebars',
						'desc' => '',
						'default' => 'woocommerce-sidebar'
						),
					array(
						'id' => 'woo_shop_divide_0',
						'type' => 'divide'
						),
					array(
						'id' => 'woo_page_header',
						'type' => 'select',
						'title' => __('Shop Category / Page Header', 'uplift'),
						'subtitle' => __('Select the page header type on shop/category WooCommerce page.', 'uplift'),
						'desc' => '',
						'options' => array(
								'standard'		=> __('Standard', 'uplift'),
								'standard-overlay'	=> __('Standard (Overlay)', 'uplift'),
								'naked-light'	=> __('Naked (Light)', 'uplift'),
								'naked-dark'	=> __('Naked (Dark)', 'uplift'),
						),
						'default' => '1'
						),
					array(
						'id' => 'woo_show_page_heading',
						'type' => 'button_set',
						'title' => __('Shop Category / Page Heading', 'uplift'),
						'subtitle' => __('Show page title on shop/category WooCommerce page.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On', '0' => 'Off'),
						'default' => '1'
						),
					array(
						'id' => 'woo_page_heading_style',
						'type' => 'select',
						'title' => __('WooCommerce Page Heading Style', 'uplift'),
						'subtitle' => "Choose the page heading style for the shop/category WooCommerce pages.",
						'options' => array(
							'standard'		=> 'Standard',
							'fancy'		=> 'Hero',
							'fancy-tabbed'		=> 'Hero Tabbed'
							),
						'desc' => '',
						'default' => 'standard'
						),
					array(
						'id' => 'woo_page_heading_image',
						'type' => 'media',
						'url'=> true,
						'title' => __('WooCommerce Hero Heading Background Image', 'uplift'),
						'subtitle' => __('Upload the hero heading background image for WooCommerce page heading (Hero Heading Only).', 'uplift'),
						'desc' => ''
						),
					array(
						'id' => 'woo_page_heading_text_style',
						'type' => 'select',
						'title' => __('WooCommerce Hero Heading Text Style', 'uplift'),
						'subtitle' => "Choose the text style for the WooCommerce page heading (Hero Heading Only).",
						'options' => array(
							'light'		=> 'Light',
							'dark'		=> 'Dark'
							),
						'desc' => '',
						'default' => 'light'
						),
					array(
						'id' => 'woo_shop_divide_1',
						'type' => 'divide'
						),
					array(
						'id' => 'woo_shop_slider',
						'type' => 'button_set',
						'title' => __('Shop Slider', 'uplift'),
						'subtitle' => __('Show slider on the shop page.', 'uplift'),
						'desc' => '',
						'options' => array('swift-slider' => 'Swift Slider', '0' => 'Off'),
						'default' => '0'
						),
					array(
						'id' => 'woo_shop_category',
						'required'  => array('woo_shop_slider', '=', 'swift-slider'),
						'type' => 'select',
						'title' => __('Shop Slider Category', 'uplift'),
						'subtitle' => __('Choose the category of slide that you would like to show, or all.', 'uplift'),
						'desc' => '',
						'data' => 'terms',
						'args' => array( 'taxonomies' => 'swift-slider-category' ),
						'default' => ''
						),	
						
					array(
						'id' => 'woo_shop_slider_slides',
						'required'  => array('woo_shop_slider', '=', 'swift-slider'),
						'type' => 'text',
						'title' => __('Shop Slider Slides', 'uplift'),
						'subtitle' => __('Set the number of slides to show. If blank then all will show.', 'uplift'),
						'desc' => '',
						'default' => '5'
						),
					array(
						'id' => 'woo_shop_slider_maxheight',
						'required'  => array('woo_shop_slider', '=', 'swift-slider'),
						'type' => 'text',
						'title' => __('Shop Slider Max Height', 'uplift'),
						'subtitle' => __('Set the maximum height that the Swift Slider should display at (optional) (no px).', 'uplift'),
						'desc' => '',
						'default' => '600'
						),
					array(
						'id' => 'woo_shop_slider_random',
						'required'  => array('woo_shop_slider', '=', 'swift-slider'),
						'type' => 'button_set',
						'title' => __('Shop Slider Random', 'uplift'),
						'subtitle' => __('Choose if you would like the slider to show slides in random order.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On', '0' => 'Off'),
						'default' => '0'
						),
					array(
						'id' => 'woo_shop_slider_auto',
						'required'  => array('woo_shop_slider', '=', 'swift-slider'),
						'type' => 'text',
						'title' => __('Shop Slider Autoplay', 'uplift'),
						'subtitle' => __('If you would like the slider to auto-rotate, then set the autoplay rotate time in ms here. I.e. you would enter "5000" for the slider to rotate every 5 seconds.', 'uplift'),
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'woo_shop_slider_loop',
						'required'  => array('woo_shop_slider', '=', 'swift-slider'),
						'type' => 'text',
						'title' => __('Shop Slider Loop', 'uplift'),
						'subtitle' => __('Choose if you would like the slider to loop.', 'uplift'),
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'woo_shop_slider_transition',
						'required'  => array('woo_shop_slider', '=', 'swift-slider'),
						'type' => 'button_set',
						'title' => __('Shop Slider Transition', 'uplift'),
						'subtitle' => __('Choose the transition type for the slider.', 'uplift'),
						'desc' => '',
						'options' => array('slide' => 'Slide', 'fade' => 'Fade'),
						'default' => 'slide'
						),
					array(
						'id' => 'woo_shop_slider_nav',
						'required'  => array('woo_shop_slider', '=', 'swift-slider'),
						'type' => 'button_set',
						'title' => __('Shop Slider Navigation', 'uplift'),
						'subtitle' => __('Choose if you would like to display the left/right arrows on the slider (only if slider type is set to "Slider")', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On', '0' => 'Off'),
						'default' => '1'
						),
					array(
						'id' => 'woo_shop_slider_pagination',
						'required'  => array('woo_shop_slider', '=', 'swift-slider'),
						'type' => 'button_set',
						'title' => __('Shop Slider Pagination', 'uplift'),
						'subtitle' => __('Choose if you would like to display the slider pagination.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On', '0' => 'Off'),
						'default' => '1'
						),
				),
			);

			$this->sections[] = array(
				'icon' => 'el-icon-shopping-cart',
				'title' => __('Product Options', 'uplift'),
				'subsection' => true,
				'fields' => array(
					array(
						'id' => 'product_addtocart_ajax',
						'type' => 'button_set',
						'title' => __('Add to cart ajax', 'uplift'),
						'subtitle' => __('Disable the add to cart AJAX for simple products on the product page. This may be required for compatibility with 3rd party plugins.', 'uplift'),
						'desc' => '',
						'options' => array('0' => 'Disabled','1' => 'Enabled'),
						'default' => '1'
						),
					array(
						'id' => 'disable_product_slider',
						'type' => 'button_set',
						'title' => __('Disable product slider', 'uplift'),
						'subtitle' => __('Disable the slider if you would like the images to show one after another on the product detail page.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'Disabled','0' => 'Enabled'),
						'default' => '0'
						),
					array(
						'id' => 'product_slider_thumbs_pos',
						'type' => 'button_set',
						'title' => __('Product slider thumbs position', 'uplift'),
						'subtitle' => __('Choose if you would like the product slider thumbs to appear below or to the side of the main image. NOTE: on mobile, they will always be on bottom as otherwise it conflicts with the scrolling.', 'uplift'),
						'desc' => '',
						'options' => array('left' => 'Left','bottom' => 'Bottom'),
						'default' => 'bottom'
						),
					array(
						'id' => 'vertical_product_slider_height',
						'type' => 'text',
						'title' => __('Vertical Product Slider Height', 'uplift'),
						'subtitle' => "Enter the desired height for the vertical product slider here. Default is 700. Numeric value (no px).",
						'desc' => '',
						'default' => '700'
						),
					array(
						'id' => 'product_imagewidth_override',
						'type' => 'button_set',
						'title' => __('Override Product Image Width', 'uplift'),
						'subtitle' => __('Enable this option to override the product image/summary width on the product detail page', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
					    'id'        => 'productdetail_imagewidth',
					    'type'      => 'slider',
					    'required'  => array('product_imagewidth_override', '=', '1'),
					    'title'     => __('Product Image Width', 'uplift'),
					    'subtitle'  => __('Set the width (in %) of the product image area, and the summary will be calculated to suit based on this. (Default is 60%).', 'uplift'),
					    "default"   => 60,
					    "min"       => 30,
					    "step"      => 1,
					    "max"       => 70,
					    'display_value' => 'label'
					),
					array(
						'id' => 'enable_product_zoom',
						'type' => 'button_set',
						'title' => __('Enable image zoom on product images', 'uplift'),
						'subtitle' => __('Choose whether you would like to enable product image zoom functionality on the product detail page images. NOTE: This only works when you have the product slider enabled.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
						'id' => 'product_zoom_type',
						'type' => 'button_set',
						'required'  => array('enable_product_zoom', '=', '1'),
						'title' => __('Image zoom type', 'uplift'),
						'subtitle' => __('Choose whether you would like to enable product image zoom functionality on the product detail page images.', 'uplift'),
						'desc' => '',
						'options' => array('inner' => 'Default (inner)','lens' => 'Lens'),
						'default' => 'inner'
						),
					array(
						'id' => 'enable_product_zoom_mobile',
						'type' => 'button_set',
						'title' => __('Enable image zoom on product images (Mobile)', 'uplift'),
						'subtitle' => __('Choose whether you would like to enable product image zoom functionality on the product detail page images on MOBILE. NOTE: This only works when you have the product slider enabled, and will disable touch swiping.', 'uplift'),
						'desc' => '',
						'options' => array('1' => 'On','0' => 'Off'),
						'default' => '0'
						),
					array(
						'id' => 'product_reviews_pos',
						'type' => 'button_set',
						'title' => __('Product reviews position', 'uplift'),
						'subtitle' => __('Choose whether you would like to show the reviews within the tabs section, or standalone (default).', 'uplift'),
						'desc' => '',
						'options' => array('default' => 'Below Tabs', 'tabs' => 'Tabs'),
						'default' => 'tabs'
						),
					array(
						'id' => 'product_pbcontent_pos',
						'type' => 'button_set',
						'title' => __('Product Page Builder content position', 'uplift'),
						'subtitle' => __('Choose whether you would like to show the page builder content above or below the tabs section.', 'uplift'),
						'desc' => '',
						'options' => array('below' => 'Below', 'above' => 'Above'),
						'default' => 'below'
						),
					array(
						'id' => 'upsell_heading_text',
						'type' => 'text',
						'title' => __('Upsell Heading Text', 'uplift'),
						'subtitle' => "Heading text for the upsell products on the product page.",
						'desc' => '',
						'default' => 'Complete the look'
						),
					array(
						'id' => 'related_heading_text',
						'type' => 'text',
						'title' => __('Related Heading Text', 'uplift'),
						'subtitle' => "Heading text for the related products on the product page.",
						'desc' => '',
						'default' => 'Related products'
						),
					array(
						'id' => 'woo_product_divide_0',
						'type' => 'divide'
						),
					array(
						'id' => 'default_product_sidebar_config',
						'type' => 'select',
						'title' => __('Default Product Sidebar Config', 'uplift'),
						'subtitle' => "Choose the sidebar config for WooCommerce shop/category pages.",
						'options' => array(
							'no-sidebars'		=> 'No Sidebars',
							'left-sidebar'		=> 'Left Sidebar',
							'right-sidebar'		=> 'Right Sidebar',
							'both-sidebars'		=> 'Both Sidebars'
						),
						'desc' => '',
						'default' => 'no-sidebars'
						),
					array(
						'id' => 'default_product_left_sidebar',
						'type' => 'select',
						'title' => __('Default Product Left Sidebar', 'uplift'),
						'subtitle' => "Choose the default left sidebar for WooCommerce product pages.",
						'data'      => 'sidebars',
						'desc' => '',
						'default' => 'woocommerce-sidebar'
						),
					array(
						'id' => 'default_product_right_sidebar',
						'type' => 'select',
						'title' => __('Default Product Right Sidebar', 'uplift'),
						'subtitle' => "Choose the default right sidebar for WooCommerce product pages.",
						'data'      => 'sidebars',
						'desc' => '',
						'default' => 'woocommerce-sidebar'
						),
				),
			);

			$this->sections[] = array(
				'type' => 'divide',
			);

			$this->sections[] = array(
				'icon' => 'el-icon-twitter',
				'title' => __('Social Profiles', 'uplift'),
				'desc' => 'These fields populate the [social] shortcode, which you can then use anywhere in your site.',
				'fields' => array(
					array(
						'id' => 'twitter_username',
						'type' => 'text',
						'title' => __('Twitter', 'uplift'),
						'subtitle' => "Your Twitter username (no @).",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'facebook_page_url',
						'type' => 'text',
						'title' => __('Facebook', 'uplift'),
						'subtitle' => "Your facebook page/profile url",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'dribbble_username',
						'type' => 'text',
						'title' => __('Dribbble', 'uplift'),
						'subtitle' => "Your Dribbble username",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'vimeo_username',
						'type' => 'text',
						'title' => __('Vimeo', 'uplift'),
						'subtitle' => "Your Vimeo username",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'tumblr_username',
						'type' => 'text',
						'title' => __('Tumblr', 'uplift'),
						'subtitle' => "Your Tumblr username",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'skype_username',
						'type' => 'text',
						'title' => __('Skype', 'uplift'),
						'subtitle' => "Your Skype username",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'linkedin_page_url',
						'type' => 'text',
						'title' => __('LinkedIn', 'uplift'),
						'subtitle' => "Your LinkedIn page/profile url",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'googleplus_page_url',
						'type' => 'text',
						'title' => __('Google+', 'uplift'),
						'subtitle' => "Your Google+ page/profile URL",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'flickr_page_url',
						'type' => 'text',
						'title' => __('Flickr', 'uplift'),
						'subtitle' => "Your Flickr page url",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'youtube_url',
						'type' => 'text',
						'title' => __('YouTube', 'uplift'),
						'subtitle' => "Your YouTube URL",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'pinterest_username',
						'type' => 'text',
						'title' => __('Pinterest', 'uplift'),
						'subtitle' => "Your Pinterest username",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'foursquare_url',
						'type' => 'text',
						'title' => __('Foursquare', 'uplift'),
						'subtitle' => "Your Foursqaure URL",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'instagram_username',
						'type' => 'text',
						'title' => __('Instagram', 'uplift'),
						'subtitle' => "Your Instagram username",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'github_url',
						'type' => 'text',
						'title' => __('GitHub', 'uplift'),
						'subtitle' => "Your GitHub URL",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'xing_url',
						'type' => 'text',
						'title' => __('Xing', 'uplift'),
						'subtitle' => "Your Xing URL",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'behance_url',
						'type' => 'text',
						'title' => __('Behance', 'uplift'),
						'subtitle' => "Your Behance URL",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'deviantart_url',
						'type' => 'text',
						'title' => __('Deviantart', 'uplift'),
						'subtitle' => "Your Deviantart URL",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'soundcloud_url',
						'type' => 'text',
						'title' => __('SoundCloud', 'uplift'),
						'subtitle' => "Your SoundCloud URL",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'yelp_url',
						'type' => 'text',
						'title' => __('Yelp', 'uplift'),
						'subtitle' => "Your Yelp URL",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'vk_url',
						'type' => 'text',
						'title' => __('VK', 'uplift'),
						'subtitle' => "Your VK URL",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'twitch_url',
						'type' => 'text',
						'title' => __('Twitch', 'uplift'),
						'subtitle' => "Your Twitch URL",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'snapchat_url',
						'type' => 'text',
						'title' => __('Snapchat', 'swiftframework'),
						'subtitle' => "Your Snapchat URL",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'whatsapp_url',
						'type' => 'text',
						'title' => __('WhatsApp', 'swiftframework'),
						'subtitle' => "Your WhatsApp URL",
						'desc' => '',
						'default' => ''
						),
					array(
						'id' => 'rss_url',
						'type' => 'text',
						'title' => __('RSS Feed', 'uplift'),
						'subtitle' => "Your RSS Feed URL",
						'desc' => '',
						'default' => ''
						)
				),
			);

			$this->sections[] = array(
				'type' => 'divide',
			);

			$this->sections[] = array(
			    'title'     => __('Import / Export', 'uplift'),
			    'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'uplift'),
			    'icon'      => 'el-icon-refresh',
			    'fields'    => array(
			        array(
			            'id'            => 'opt-import-export',
			            'type'          => 'import_export',
			            'title'         => 'Import Export',
			            'subtitle'      => 'Save and restore your Redux options',
			            'full_width'    => false,
			        ),
			    ),
			);

			$theme_info = '<div class="redux-framework-section-desc">';
			$theme_info .= '<p class="redux-framework-theme-data description theme-uri">'.__('<strong>Theme URL:</strong> ', 'uplift').'<a href="'.$this->theme->get('ThemeURI').'" target="_blank">'.$this->theme->get('ThemeURI').'</a></p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-author">'.__('<strong>Author:</strong> ', 'uplift').$this->theme->get('Author').'</p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-version">'.__('<strong>Version:</strong> ', 'uplift').$this->theme->get('Version').'</p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-description">'.$this->theme->get('Description').'</p>';
			$tabs = $this->theme->get('Tags');
			if ( !empty( $tabs ) ) {
				$theme_info .= '<p class="redux-framework-theme-data description theme-tags">'.__('<strong>Tags:</strong> ', 'uplift').implode(', ', $tabs ).'</p>';
			}
			$theme_info .= '</div>';

		}


		/**

			All the possible arguments for Redux.
			For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

		 **/
		public function setArguments() {

			$theme = wp_get_theme(); // For use with some settings. Not necessary.

			$this->args = array(

	            // TYPICAL -> Change these values as you need/desire
				'opt_name'          	=> 'sf_uplift_options', // This is where your data is stored in the database and also becomes your global variable name.
				//'display_name'			=> $theme->get('Name'), // Name that appears at the top of your panel
				'display_name'			=> __( 'Theme Options', 'uplift' ), // Name that appears at the top of your panel
				//'display_version'		=> $theme->get('Version'), // Version that appears at the top of your panel
				'menu_type'          	=> 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'     	=> true, // Show the sections below the admin menu item or not
				'menu_title'			=> __( 'Theme Options', 'uplift' ),
	            'page'		 	 		=> __( 'Theme Options', 'uplift' ),
	            'google_api_key'   	 	=> 'AIzaSyC2wsPjq6DE7aShaWCJlOhWwY3FPw5-ikc', // Must be defined to add google fonts to the typography module
	            'global_variable'    	=> '', // Set a different name for your global variable other than the opt_name
	            'dev_mode'           	=> false, // Show the time the page took to load, etc
	            'customizer'         	=> false, // Enable basic customizer support

	            // OPTIONAL -> Give you extra features
	            'page_priority'      	=> null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	            'page_parent'        	=> 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	            'page_permissions'   	=> 'manage_options', // Permissions needed to access the options panel.
	            'menu_icon'          	=> '', // Specify a custom URL to an icon
	            'last_tab'           	=> '', // Force your panel to always open to a specific tab (by id)
	            'page_icon'          	=> 'icon-themes', // Icon displayed in the admin panel next to your menu_title
	            'page_slug'          	=> '_sf_options', // Page slug used to denote the panel
	            'save_defaults'      	=> true, // On load save the defaults to DB before user clicks save or not
	            'default_show'       	=> false, // If true, shows the default value next to each field that is not the default value.
	            'default_mark'       	=> '', // What to print by the field's title if the value shown is default. Suggested: *


	            // CAREFUL -> These options are for advanced use only
	            'transient_time' 	 	=> 60 * MINUTE_IN_SECONDS,
	            'output'            	=> true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	            'output_tag'            	=> true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head

	            // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	            'database'           	=> '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!


	            'show_import_export' 	=> true, // REMOVE
	            'system_info'        	=> false, // REMOVE

	            'help_tabs'          	=> array(),
	            'help_sidebar'       	=> '', // __( '', $this->args['domain'] );
				);

		}
	}

	global $reduxConfig;
	$reduxConfig = new Redux_Framework_options_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
