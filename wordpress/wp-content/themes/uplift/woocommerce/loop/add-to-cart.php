<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

$tooltip_text = "";
$product_id = method_exists( $product, 'get_id' ) ? $product->get_id() : $product->id;
$product_type = method_exists( $product, 'get_product_type' ) ? $product->get_product_type() : $product->product_type;
?>

<?php if ( ! $product->is_in_stock() ) : ?>
	<div class="add-to-cart-wrap" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Sold out', 'uplift' ); ?>">
		<a href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product_id ) ); ?>" class="product_type_soldout"><i class="sf-icon-read-more"></i><span><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Out of stock', 'uplift' ) ); ?></span></a>
	</div>
	<?php echo sf_wishlist_button(); ?>

<?php else : ?>

	<?php
		$link = array(
			'url'   => '',
			'label' => '',
			'class' => '',
			'icon' => '',
			'icon_class' => '',
		);

		$handler = apply_filters( 'woocommerce_add_to_cart_handler', $product_type, $product );

		switch ( $handler ) {
			case "variable" :
				$link['url'] 	= apply_filters( 'variable_add_to_cart_url', get_permalink( $product_id ) );
				$link['icon_class'] = 'sf-icon-variable';
				$link['label'] 	= '<i class="sf-icon-variable"></i><span>' . apply_filters( 'variable_add_to_cart_text', __( 'Select options', 'uplift' ) ) . '</span>';
				$tooltip_text = __( 'Select Options', 'uplift' );
			break;
			case "grouped" :
				$link['url'] 	= apply_filters( 'grouped_add_to_cart_url', get_permalink( $product_id ) );
				$link['icon_class'] = 'sf-icon-variable';
				$link['label'] 	= '<i class="sf-icon-variable"></i><span>' . apply_filters( 'grouped_add_to_cart_text', __( 'View options', 'uplift' ) ) . '</span>';
				$tooltip_text = __( 'View Options', 'uplift' );
			break;
			case "external" :
				$link['url'] 	= apply_filters( 'external_add_to_cart_url', get_permalink( $product_id ) );
				$link['icon_class'] = 'sf-icon-read-more';
				$link['label'] 	= '<i class="sf-icon-read-more"></i><span>' . apply_filters( 'external_add_to_cart_text', __( 'Read More', 'uplift' ) ) . '</span>';
				$tooltip_text = __( 'Read More', 'uplift' );
			break;
			default :
				if ( $product->is_purchasable() && $product_type != "booking" ) {
					$link['url'] 	= apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
					$link['icon_class'] = 'sf-icon-add-to-cart';
					$link['label'] 	= apply_filters( 'add_to_cart_icon', '<i class="sf-icon-add-to-cart"></i>' ) . '<span>' . apply_filters( 'add_to_cart_text', __( 'Add to cart', 'uplift' ) ) . '</span>';
					$link['class']  = apply_filters( 'add_to_cart_class', 'add_to_cart_button ajax_add_to_cart' );
					$tooltip_text = __( 'Add to cart' , 'uplift' );
				} else {
					$link['url'] 	= apply_filters( 'not_purchasable_url', get_permalink( $product_id ) );
					$link['icon_class'] = 'sf-icon-noview';
					$link['label'] 	= '<i class="sf-icon-noview"></i><span>' . apply_filters( 'not_purchasable_text', __( 'Read More', 'uplift' ) ) . '</span>';
					$tooltip_text = __( 'Read More', 'uplift' );
				}
			break;
		}

		$loading_text = __( 'Adding...', 'uplift' );
		$added_text = __( 'Item added', 'uplift' );
		$added_text_short = __( 'Added', 'uplift' );
		$added_tooltip_text = __( 'Added to cart', 'uplift' );

		// Add to Cart
		echo '<div class="add-to-cart-wrap" data-toggle="tooltip" data-placement="top" title="'.$tooltip_text.'" data-tooltip-added-text="'.$added_tooltip_text.'">';
		echo apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s product_type_%s" data-default_icon="%s" data-loading_text="%s" data-added_text="%s" data-added_short="%s">%s</a>', esc_url( $link['url'] ), esc_attr( $product_id ), esc_attr( $product->get_sku() ), esc_attr( $link['class'] ), esc_attr( $product_type ), $link['icon_class'], $loading_text, $added_text, $added_text_short, $link['label'] ), $product, $link);
		echo '</div>';


		// Wishlist Button
		echo sf_wishlist_button();

	?>

<?php endif; ?>
