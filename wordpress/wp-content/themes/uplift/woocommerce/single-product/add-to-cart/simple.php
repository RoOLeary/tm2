<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product;
$sf_options = sf_get_theme_opts();

$product_id = method_exists( $product, 'get_id' ) ? $product->get_id() : $product->id;
$loading_text = __( 'Adding...', 'uplift' );
$added_text = __( 'Item added', 'uplift' );
$button_class = "add_to_cart_button";
$ajax_enabled = true;

if ( isset($sf_options['product_addtocart_ajax']) ) {
	$ajax_enabled = $sf_options['product_addtocart_ajax'];
}

if ( !$ajax_enabled || ( defined('DOING_AJAX') && DOING_AJAX ) ) {
	$button_class = "single_add_to_cart_button";
}

if ( ! $product->is_purchasable() ) return;
?>

<?php
	// Availability
	if ( version_compare( WC_VERSION, '2.7', '>=' ) ) {
		echo wc_get_stock_html( $product );
	} else {
		$availability = $product->get_availability();
		$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';
		
		echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
	}
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" method="post" enctype='multipart/form-data'>
	 	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	 	<?php
	 		if ( version_compare( WC_VERSION, '2.7', '>=' ) ) {
	 			/**
				 * @since 2.7.0.
				 */
				do_action( 'woocommerce_before_add_to_cart_quantity' );
	
				woocommerce_quantity_input( array(
					'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
					'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
					'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : $product->get_min_purchase_quantity(),
				) );
	
				/**
				 * @since 2.7.0.
				 */
				do_action( 'woocommerce_after_add_to_cart_quantity' );
	 		} else {
 				if ( ! $product->is_sold_individually() )
 					woocommerce_quantity_input( array(
 						'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
 						'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
 					) );
	 		}
	 	?>

	 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product_id ); ?>" />

	 	<button type="submit" data-product_id="<?php echo esc_attr($product_id); ?>" data-quantity="1" data-default_text="<?php echo esc_attr($product->single_add_to_cart_text()); ?>" data-default_icon="sf-icon-cart" data-loading_text="<?php echo esc_attr($loading_text); ?>" data-added_text="<?php echo esc_attr($added_text); ?>" class="<?php echo esc_attr($button_class); ?> product_type_simple ajax_add_to_cart button alt"><?php echo apply_filters('sf_add_to_cart_icon', '<i class="sf-icon-cart"></i>'); ?><span><?php echo esc_attr($product->single_add_to_cart_text()); ?></span></button>
		<?php echo sf_wishlist_button(); ?>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php else : ?>

<?php echo sf_wishlist_button('oos'); ?>

<?php endif; ?>