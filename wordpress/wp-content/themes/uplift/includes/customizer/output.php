<?php

    /*
    *
    *   Customizer Output
    *   ------------------------------------------------
    *   Swift Framework
    *   Copyright Swift Ideas 2015 - http://www.swiftideas.com
    *   @since v1.0.0
    *   
    *
    *   sf_custom_css_debug_mode()
    *	sf_get_css_output_method()
    *	sf_get_custom_css_filename()
    *	sf_custom_css_enqueue()
    *	sf_custom_css_enqueue_fs()
    *	sf_custom_css_enqueue_ajax()
    *	sf_custom_css_ajax_output()
    *	sf_custom_css_head_output()
    *	sf_get_custom_css()
    *	sf_get_custom_css_transient_key()
    *	sf_get_cached_css()
    *	sf_set_cached_css()
    *	sf_delete_cached_css()
    *	sf_generate_custom_css()
    *	sf_save_custom_css_to_fs()
    *
    */    
    
    
    /**
    * Clear custom css cache on theme options, customizer save, and theme update/change
    *
    */
    add_action( 'redux/options/sf_uplift_options/saved', 'sf_delete_cached_css' );
    add_action( 'customize_save_after', 'sf_delete_cached_css' );
    add_action( 'after_switch_theme', 'sf_delete_cached_css' );
    add_action( 'delete_site_transient_update_themes', 'sf_delete_cached_css' );
    
    /**
    * Debug mode for custom css output
    *
    * return @bool
    */
    function sf_custom_css_debug_mode() {
        return ( defined( 'SF_CUSTOM_CSS_DEBUG' ) && SF_CUSTOM_CSS_DEBUG === true ) || isset( $_GET['sf_custom_css_nocache'] );
    }
    
    
    /**
    * Get the css output method from theme options
    *
    * return @string
    */
    function sf_get_css_output_method() {
    	$sf_options = sf_get_theme_opts();
    	$styles_output = $sf_options['dynamic_styles_output'];
    	
        return isset( $styles_output ) ? $styles_output : 'fs';
    }
    
    
    /**
    * Get the filename for the custom css file
    *
    * return @string
    *
    */
    function sf_get_custom_css_filename() {
        return apply_filters( "sf_custom_css_filename", 'uplift-custom' ) . '.css';
    }
    
    
    /**
    * Enqueue the custom css file if set to fs or ajax output
    */
    function sf_custom_css_enqueue() {
    	if ( sf_get_css_output_method() == 'fs' ) {
            sf_custom_css_enqueue_fs();
        }

        if ( sf_get_css_output_method() == 'ajax' ) {
            sf_custom_css_enqueue_ajax();
        }
    }
    add_action( 'wp_enqueue_scripts', 'sf_custom_css_enqueue' );

	
	/**
	* Enqueue the custom css from the filesystem
	*/
    function sf_custom_css_enqueue_fs() {
        
        $upload_dir = wp_upload_dir();

        $filename = sf_get_custom_css_filename();

        $filepath = trailingslashit( $upload_dir['basedir'] ) . 'swiftframework/' . $filename;

        if ( ! is_file( $filepath ) ) {

            // regenerate the CSS and save to filesystem
            sf_generate_custom_css();

        }

        // file should now exist
        if ( is_file( $filepath ) ) {

            $css_url = trailingslashit( $upload_dir['baseurl'] ) . 'swiftframework/' . $filename;

            $protocol = is_ssl() ? 'https://' : 'http://';

            // ensure we're using the correct protocol
            $css_url = str_replace( array( "http://", "https://" ), $protocol, $css_url );

            wp_enqueue_style( 'uplift-custom', $css_url, false, substr( md5( filemtime( $filepath ) ), 0, 6 ) );

        } else {

            // enqueue via AJAX for this request
            sf_custom_css_enqueue_ajax();

        }
    }
    
    
    /**
    * Enqueue the custom css via AJAX
    */
    function sf_custom_css_enqueue_ajax() {
        wp_enqueue_style( 'uplift-custom', admin_url('admin-ajax.php') . '?action=uplift_custom_css', false, NULL );    
    }

    
    /**
    * Generate the custom css for ajax output
    */
    function sf_custom_css_ajax_output() {

        header("Content-type: text/css; charset: UTF-8");

        echo sf_get_custom_css();

        wp_die();
    }    
    add_action( 'wp_ajax_uplift_custom_css', 'sf_custom_css_ajax_output' );
    add_action( 'wp_ajax_nopriv_uplift_custom_css', 'sf_custom_css_ajax_output' );
	
	
	/**
	* Output the custom css to the head tag
	*/
	function sf_custom_css_head_output() {

        if ( sf_get_css_output_method() == 'head' ) {

            $css = sf_get_custom_css();

            echo '<style type="text/css">' . str_replace( array( "  ", "\n" ), '', $css ) . "</style>\n";

        }

    }
	add_action( 'wp_head', 'sf_custom_css_head_output', 9998 );
	
	
	/**
	* Get the custom css if cached, or generate it
	*/
	function sf_get_custom_css() {

        if ( ( $css = sf_get_cached_css() ) && ! sf_custom_css_debug_mode() ) {
			
            return $css;

        } else {

            return sf_generate_custom_css();

        }

    }
    
    
    /**
    * Get the custom css transient key
    */
    function sf_get_custom_css_transient_key() {
        return apply_filters( 'sf_custom_css_transient_key', 'uplift-custom-css' );
    }
    
    
    /**
    * Get the cached css
    */
    function sf_get_cached_css() {
    	return get_transient( sf_get_custom_css_transient_key() );    	
    }
    
    
    /**
    * Set the cached css
    */
    function sf_set_cached_css( $css ) {
        set_transient( sf_get_custom_css_transient_key(), $css, 0 );
    }
    
    
    /**
    * Delete the cached css
    */
    function sf_delete_cached_css() {
        global $wp_filesystem;

        if ( ! $wp_filesystem ) {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
        }

        $upload_dir = wp_upload_dir();
        $filename = sf_get_custom_css_filename();
        $dir = trailingslashit( $upload_dir['basedir'] ) . 'swiftframework/';

        WP_Filesystem( false, $upload_dir['basedir'], true );
        $wp_filesystem->rmdir( $dir, true );

        delete_transient( sf_get_custom_css_transient_key() );
        
        do_action( 'sf_after_delete_cached_css' );

        return true;
    }
    
    
    /**
    * Generate the custom css
    */
    function sf_generate_custom_css() {
		$css = sf_custom_styles_output();
		
		if ( strlen( $css ) ) {
		
		    $css .= "/** " . date('l jS \of F Y h:i:s A') . " **/";
		
		    sf_set_cached_css( $css );
		
		    if ( sf_get_css_output_method() == 'fs' ) {
		        sf_save_custom_css_to_fs( $css );
		    }
		
		}
		
		return $css;
    }
    
    
    /**
    * Save custom css to file system
    */
    function sf_save_custom_css_to_fs( $css ) {
	    global $wp_filesystem;
	
	    if ( ! $wp_filesystem ) {
	        require_once( ABSPATH . 'wp-admin/includes/file.php' );
	    }
	
	    $upload_dir = wp_upload_dir();
	    $filename = sf_get_custom_css_filename();
	    $dir = trailingslashit( $upload_dir['basedir'] ) . 'swiftframework/';
	
	    WP_Filesystem( false, $upload_dir['basedir'], true );
	    $wp_filesystem->mkdir( $dir );
	
	    if ( ! $wp_filesystem->put_contents( $dir . $filename, $css ) ) {
	
	        // If the file write fails, update the theme option to ajax to prevent repeat fails
	        $settings = get_option( 'sf_uplift_options' );
	        $settings['dynamic_styles_output'] = 'ajax';
	        update_option( 'sf_uplift_options', $settings );
	
	    }
    }
	