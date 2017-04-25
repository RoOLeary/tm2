<?php

    /*
    *
    *   Customizer Setting Sanitization
    *   ------------------------------------------------
    *   Swift Framework
    *   Copyright Swift Ideas 2015 - http://www.swiftideas.com
    *   @since v1.0.0
    *   
    *
    *   sf_sanitize_page_layout()
    *	sf_sanitize_text()
    *	sf_sanitize_font()
    *	sf_sanitize_numeric()
    *
    */
	
	
	/**
	 * Sanitize transparent select
	 */
	function sf_sanitize_transparent_select( $value ) {
		$valid = array(
	        'color' => 'Color',
	        'transparent' => 'Transparent',
		);

		if ( array_key_exists( $value, $valid ) ) {
		    return $value;
		} else {
		    return '';
		}
	}
	
	/**
	 * Sanitize divider style
	 */
	function sf_sanitize_divider_style( $value ) {
		$valid = array(
	        'divider' => 'Divider',
			'shadow'	 => 'Shadow',
			'none'	 => 'None'
		);

		if ( array_key_exists( $value, $valid ) ) {
		    return $value;
		} else {
		    return '';
		}
	}
	
	/**
	 * Sanitize nav hover style
	 */
	function sf_sanitize_nav_hover_style( $value ) {
		$valid = array(
	        'standard' => 'Standard',
			'bold'	 => 'Bold',
		);

		if ( array_key_exists( $value, $valid ) ) {
		    return $value;
		} else {
		    return '';
		}
	}
	
	/**
	 * Sanitize nav divider style
	 */
	function sf_sanitize_nav_divider_style( $value ) {
		$valid = array(
	        'dotted' => 'Dotted',
			'solid'	 => 'Solid',
			'none'   => 'none'
		);

		if ( array_key_exists( $value, $valid ) ) {
		    return $value;
		} else {
		    return '';
		}
	}

	/**
	 * Sanitize text
	 */
	function sf_sanitize_text( $value ) {
		return wp_kses_post( force_balance_tags( $value ) );
	}
	
	/**
	 * Sanitize numeric input
	 */
	function sf_sanitize_numeric( $value ) {
		if ( is_numeric( $value ) ) {
			return intval( $value );
	    }
	}


	/**
	 * Sanitize checkbox
	 */
	function sf_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}
	