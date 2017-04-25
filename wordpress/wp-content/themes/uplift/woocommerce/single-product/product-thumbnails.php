<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( version_compare( WC_VERSION, '2.7', '>=' ) ) { 
	
	global $post, $product;
	
	$attachment_ids = $product->get_gallery_image_ids();
	
	if ( $attachment_ids ) {
		foreach ( $attachment_ids as $attachment_id ) {
			$full_size_image  = wp_get_attachment_image_src( $attachment_id, 'full' );
			$thumbnail        = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
			$thumbnail_post   = get_post( $attachment_id );
			$image_title      = $thumbnail_post->post_content;
	
			$attributes = array(
				'title'                   => $image_title,
				'data-large-image'        => $full_size_image[0],
				'data-large-image-width'  => $full_size_image[1],
				'data-large-image-height' => $full_size_image[2],
			);
	
			$html  = '<figure data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
			$html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
	 		$html .= '</a></figure>';
	
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
		}
	}
	
} else {

    global $post, $product, $woocommerce;

    $attachment_ids = $product->get_gallery_attachment_ids();

    if ( $attachment_ids ) {
        ?>
        <?php

        $loop    = 0;
        $columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

        foreach ( $attachment_ids as $attachment_id ) {

            $classes = array( 'zoom' );

            if ( $loop == 0 || $loop % $columns == 0 ) {
                $classes[] = 'first';
            }

            if ( ( $loop + 1 ) % $columns == 0 ) {
                $classes[] = 'last';
            }

            $image_link = wp_get_attachment_url( $attachment_id );

            if ( ! $image_link ) {
                continue;
            }

            $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
            $image_class = esc_attr( implode( ' ', $classes ) );
            $image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
            $image_title = esc_attr( get_the_title( $attachment_id ) );
		
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a>', $image_link, $image_class, $image_caption, $image ), $attachment_id, $post->ID, $image_class );
			
            $loop ++;
        }

        ?>
    <?php
    }
} ?>
