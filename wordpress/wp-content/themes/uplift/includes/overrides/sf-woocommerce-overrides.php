<?php
	/*
	*
	*	Swift Framework - WooCommerce Overrides
	*	------------------------------------------------
	*	Uplift specific functionality
	* 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
	*
	*/


	/* REMOVE SHOP LAYOUT OPTS
	================================================== */
	remove_action( 'sf_mobile_before_shop_loop_details', 'sf_shop_layout_opts_mobile', 10 );
	remove_action( 'woocommerce_before_shop_loop', 'sf_shop_layout_opts', 10 );
	
	
	/* REMOVE PRICE PRODUCT ACTIONS
	================================================== */
	remove_action( 'woocommerce_after_shop_loop_item', 'sf_product_actions_price', 0 );

	
	/* MOVE WOO AUX ACTIONS
	================================================== */
	remove_action( 'woocommerce_before_shop_loop', 'sf_mobile_filters_link', 0 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	add_action( 'sf_woo_aux', 'sf_mobile_filters_link', 0 );
	add_action( 'sf_woo_aux', 'woocommerce_result_count', 20 );
	add_action( 'sf_woo_aux', 'woocommerce_catalog_ordering', 30 );
	
	/* MOVE PRICE/RATING
	================================================== */
	remove_action( 'woocommerce_single_product_summary', 'sf_product_price_rating', 10 );
	add_action( 'sf_product_summary', 'sf_product_price_rating', 10 );
	
	
	/* EDIT CART/CHECKOUT PAGE HEADING
	================================================== */
	function uplift_page_heading_page_title( $title ) {
		
		$cart 		= __( 'Cart', 'uplift' );
		$checkout 	= __( 'Checkout', 'uplift' );
		$complete 	= __( 'Complete', 'uplift' );
		
		if ( !sf_woocommerce_activated() ) {
			return $title;
		}
		
		if ( is_cart() || is_checkout() ) {
			return sprintf( '<span class="cart">%1$s</span><span class="checkout">%2$s</span><span class="complete">%3$s</span>', $cart, $checkout, $complete );
		}
		
		return $title;
	}
	add_filter( 'sf_page_heading_page_title', 'uplift_page_heading_page_title' );
	
	
	/* WOOCOMMERCE PRODUCT IMAGE HTML
	================================================== */
	function sf_uplift_single_product_image_html( $html, $post_ID ) {
	
		if ( version_compare( WC_VERSION, '2.7', '>=' ) ) { 
			return $html;
		}
		
		$sf_options = sf_get_theme_opts();
		$video_url = get_post_meta( $post_ID, '_video_url', true );
		$image_caption = $image_alt = $image_title = $caption_html = "";
		$image_id			= get_post_thumbnail_id();
		$image_meta 		= sf_get_attachment_meta( $image_id );
		$product_zoom_mobile = false;
		
		if ( isset($image_meta) ) {
			$image_caption 		= esc_attr( $image_meta['caption'] );
			$image_title 		= esc_attr( $image_meta['title'] );
			$image_alt 			= esc_attr( $image_meta['alt'] );
		}
		$image_link  		= wp_get_attachment_url( $image_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
		$image         		= get_the_post_thumbnail( $post_ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
			'title'	=> $image_title,
			'alt'	=> $image_title,
			'class' => 'product-slider-image',
			'data-zoom-image' => $image_link
		) );							
		$thumb_image = wp_get_attachment_url( $image_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
	
		if ( $image_caption != "" ) {
			$caption_html = '<div class="img-caption">' . $image_caption . '</div>';
		}
		
		if ( isset ( $sf_options['enable_product_zoom_mobile'] ) ) {
			$product_zoom_mobile = true;
		}
		
		if ( $product_zoom_mobile ) {
			$caption_html .= '<a href="#" class="mobile-product-zoom zoom"><i class="sf-icon-add"></i></a>';
		}
	
		if ( $video_url != '' ) {
			return '<div class="video-wrap" data-thumb="' . $thumb_image . '">' . $html . '</div>';
		} else {
			return sprintf( '<li itemprop="image" data-thumb="%s">%s%s<a href="%s" itemprop="image" class="woocommerce-main-image zoom lightbox" data-rel="ilightbox[product]" data-caption="%s" title="%s" alt="%s"><i class="sf-icon-add"></i></a></li>', $thumb_image, $caption_html, $image, $image_link, $image_caption, $image_title, $image_alt );
		}
	}
	add_filter('woocommerce_single_product_image_html', 'sf_uplift_single_product_image_html', 15, 2);
	
						
	/* WOOCOMMERCE PRODUCT IMAGE THUMBS HTML
	================================================== */
	function sf_uplift_single_product_image_thumbnail_html( $html, $attachment_id, $post_ID = '', $image_class = '' ) {
	
		if ( version_compare( WC_VERSION, '2.7', '>=' ) ) { 
			return $html;
		}
		
		$sf_options = sf_get_theme_opts();
		$image_caption = $image_alt = $image_title = $caption_html = "";
		$image_id = $attachment_id;
		$image_meta = sf_get_attachment_meta( $image_id );
		
		if ( isset($image_meta) ) {
			$image_caption 		= esc_attr( $image_meta['caption'] );
			$image_title 		= esc_attr( $image_meta['title'] );
			$image_alt 			= esc_attr( $image_meta['alt'] );
		}
		
		$image_link  = wp_get_attachment_url( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
		$thumb_image = wp_get_attachment_url( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
		$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), false, array(
			'title'	=> $image_title,
			'alt'	=> $image_title,
			'class' => 'product-slider-image',
			'data-zoom-image' => $image_link
		) );
	
		if ( $image_caption != "" ) {
			$caption_html = '<div class="img-caption">' . $image_caption . '</div>';
		}
		
		if ( isset ( $sf_options['enable_product_zoom_mobile'] ) ) {
			$product_zoom_mobile = true;
		}
		
		if ( $product_zoom_mobile ) {
			$caption_html .= '<a href="#" class="mobile-product-zoom zoom"><i class="sf-icon-add"></i></a>';
		}
		
		return '<li itemprop="image" data-thumb="'.$thumb_image.'">' . $image . '' . $caption_html . '<a href="'.$image_link.'" itemprop="image" class="woocommerce-main-image zoom lightbox" data-rel="ilightbox[product]" data-caption="'.$image_caption.'" title="'.$image_title.'" alt="'.$image_alt.'"><i class="sf-icon-add"></i></a></li>';
	}
	add_filter('woocommerce_single_product_image_thumbnail_html', 'sf_uplift_single_product_image_thumbnail_html', 15, 4);
	
	
	/* REMOVE REVIEWS TAB
	================================================== */
	function sf_woo_remove_reviews_tab($tabs) {
		
		$sf_options = sf_get_theme_opts();
		$product_reviews_pos = "default";
		if ( isset( $sf_options['product_reviews_pos'] ) ) {
		$product_reviews_pos = $sf_options['product_reviews_pos'];
		}
		
		if ( $product_reviews_pos == "default" ) {
			unset($tabs['reviews']);
		}
		
		return $tabs;
	}
	add_filter( 'woocommerce_product_tabs', 'sf_woo_remove_reviews_tab', 98);


	/* MOVE RELATED PRODUCTS
	================================================== */
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
	add_action( 'sf_after_single_product_reviews', 'woocommerce_output_related_products', 20);

	
	/* MOVE UPSELL PRODUCTS
	================================================== */
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_upsell_display', 60 );

