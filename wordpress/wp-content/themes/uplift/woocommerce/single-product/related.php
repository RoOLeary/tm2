<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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
}

// Enqueue
wp_enqueue_script( 'owlcarousel' );

if ( version_compare( WC_VERSION, '2.7', '>=' ) ) {
	
	if ( $related_products ) :
	
	global $sf_options, $sf_carouselID;
	
	if ($sf_carouselID == "") {
	$sf_carouselID = 1;
	} else {
	$sf_carouselID++;
	}
	
	//$woocommerce_loop['columns'] = $columns;
	$woocommerce_loop['columns'] = 4;
	
	$sf_carouselID = sf_get_carousel_id();
	
	$product_display_type = $sf_options['product_display_type'];
	$product_display_gutters = $sf_options['product_display_gutters'];
	
	$gutter_class = "";
	
	if (!$product_display_gutters && $product_display_type == "gallery") {
		$gutter_class = 'no-gutters';
	} else {
		$gutter_class = 'gutters';
	}
	
	$related_heading = $sf_options['related_heading_text'];
	
	?>
	
		<div class="product-carousel related-products spb_content_element">
		
			<div class="title-wrap clearfix">
				<h3 class="spb-heading"><span><?php echo esc_attr($related_heading); ?></span></h3>
				<div class="carousel-arrows"><a href="#" class="carousel-prev"><i class="sf-icon-left-chevron"></i></a><a href="#" class="carousel-next"><i class="sf-icon-right-chevron"></i></a></div>
			</div>
	
			<ul class="related products carousel-items <?php echo esc_attr($gutter_class); ?> product-type-<?php echo esc_attr($product_display_type); ?>" id="carousel-<?php echo esc_attr($sf_carouselID); ?>" data-columns="<?php echo esc_attr($woocommerce_loop['columns']); ?>">
							
				<?php foreach ( $related_products as $related_product ) : ?>
	
					<?php
					 	$post_object = get_post( $related_product->get_id() );
	
						setup_postdata( $GLOBALS['post'] =& $post_object );
	
						wc_get_template_part( 'content', 'product' ); ?>
	
				<?php endforeach; ?>
	
			</ul>
	
		</div>
	
	<?php endif;
	
	global $sf_include_carousel, $sf_include_isotope;
	$sf_include_carousel = true;
	$sf_include_isotope = true;
	
	wp_reset_postdata();
	
} else {
	
	global $product, $woocommerce_loop;
	$product_id = method_exists( $product, 'get_id' ) ? $product->get_id() : $product->id;
	
	$sf_options = sf_get_theme_opts();
	
	$related = $product->get_related(12);
	
	if ( sizeof( $related ) == 0 ) return;
	
	$args = apply_filters('woocommerce_related_products_args', array(
		'post_type'				=> 'product',
		'ignore_sticky_posts'	=> 1,
		'no_found_rows' 		=> 1,
		'posts_per_page' 		=> 12,
		'orderby' 				=> $orderby,
		'post__in' 				=> $related,
		'post__not_in'			=> array($product_id)
	) );
	
	$products = new WP_Query( $args );
	
	//$woocommerce_loop['columns'] = $columns;
	$woocommerce_loop['columns'] = 4;
	
	$sf_carouselID = sf_get_carousel_id();
	
	$product_display_type = $sf_options['product_display_type'];
	$product_display_gutters = $sf_options['product_display_gutters'];
	
	$gutter_class = "";
	
	if (!$product_display_gutters && $product_display_type == "gallery") {
		$gutter_class = 'no-gutters';
	} else {
		$gutter_class = 'gutters';
	}
	
	$related_heading = $sf_options['related_heading_text'];
	
	if ( $products->have_posts() ) : ?>
	
		<div class="product-carousel related-products spb_content_element">
	
			<div class="title-wrap clearfix">
				<h3 class="spb-heading"><span><?php echo esc_attr($related_heading); ?></span></h3>
				<div class="carousel-arrows"><a href="#" class="carousel-prev"><i class="sf-icon-left-chevron"></i></a><a href="#" class="carousel-next"><i class="sf-icon-right-chevron"></i></a></div>
			</div>
	
			<ul class="related products carousel-items <?php echo esc_attr($gutter_class); ?> product-type-<?php echo esc_attr($product_display_type); ?>" id="carousel-<?php echo esc_attr($sf_carouselID); ?>" data-columns="<?php echo esc_attr($woocommerce_loop['columns']); ?>">
	
				<?php while ( $products->have_posts() ) : $products->the_post(); ?>
	
					<?php woocommerce_get_template_part( 'content', 'product' ); ?>
	
				<?php endwhile; // end of the loop. ?>
	
			</ul>
	
		</div>
	
	<?php endif;
	
	wp_reset_postdata();		
	
}
