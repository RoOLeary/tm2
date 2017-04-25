<?php
/**
 * Grouped product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/grouped.php.
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

global $product, $post;
$product_id = method_exists( $product, 'get_id' ) ? $product->get_id() : $product->id;
$parent_product_post = $post;

$loading_text = __( 'Adding...', 'uplift' );
$added_text = __( 'Item added', 'uplift' );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart" method="post" enctype='multipart/form-data'>
	<table cellspacing="0" class="group_table">
		<tbody>
			<?php
				if ( version_compare( WC_VERSION, '2.7', '>=' ) ) {
					foreach ( $grouped_products as $grouped_product ) {
						$grouped_id = method_exists( $grouped_product, 'get_id' ) ? $grouped_product->get_id() : $grouped_product->id;
						$post_object = get_post( $grouped_id );
	
						setup_postdata( $GLOBALS['post'] =& $post_object );
						?>
						<tr id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
							<td>
								<?php if ( $grouped_product->is_sold_individually() || ! $grouped_product->is_purchasable() ) : ?>
									<?php woocommerce_template_loop_add_to_cart(); ?>
								<?php else : ?>
									<?php
										$quantites_required = true;
										woocommerce_quantity_input( array(
											'input_name'  => 'quantity[' . $grouped_id . ']',
											'input_value' => ( isset( $_POST['quantity'][ $grouped_id ] ) ? wc_stock_amount( $_POST['quantity'][ $grouped_id ] ) : 0 ),
											'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $grouped_product ),
											'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $grouped_product->backorders_allowed() || ! $grouped_product->get_manage_stock() ? '' : $grouped_product->get_stock_quantity(), $grouped_product ),
										) );
									?>
								<?php endif; ?>
							</td>
							<td class="label">
								<label for="product-<?php echo $grouped_id; ?>">
									<?php echo $product->is_visible() ? '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', get_permalink(), $grouped_id ) ) . '">' . get_the_title() . '</a>' : get_the_title(); ?>
								</label>
							</td>
							<?php do_action( 'woocommerce_grouped_product_list_before_price', $grouped_product ); ?>
							<td class="price">
								<?php
									echo $grouped_product->get_price_html();
									echo wc_get_stock_html( $grouped_product );
								?>
							</td>
						</tr>
						<?php
					}
					wp_reset_postdata();
				} else {
					foreach ( $grouped_products as $product_id ) :
						$product = get_product( $product_id );
						$post    = $product->post;
						setup_postdata( $post );
						?>
						<tr>
							<td>
								<?php if ( $product->is_sold_individually() || ! $product->is_purchasable() ) : ?>
									<?php woocommerce_template_loop_add_to_cart(); ?>
								<?php else : ?>
									<?php
										$quantites_required = true;
										woocommerce_quantity_input( array( 'input_name' => 'quantity[' . $product_id . ']', 'input_value' => '0' ) );
									?>
								<?php endif; ?>
							</td>
	
							<td class="label">
								<label for="product-<?php echo $product_id; ?>">
									<?php echo $product->is_visible() ? '<a href="' . get_permalink() . '">' . get_the_title() . '</a>' : get_the_title(); ?>
								</label>
							</td>
	
							<?php do_action ( 'woocommerce_grouped_product_list_before_price', $product ); ?>
	
							<td class="price">
								<?php
									echo $product->get_price_html();
	
									if ( ( $availability = $product->get_availability() ) && $availability['availability'] )
										echo apply_filters( 'woocommerce_stock_html', '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
								?>
							</td>
						</tr>
						<?php
					endforeach;
	
					// Reset to parent grouped product
					$post    = $parent_product_post;
					$product = get_product( $parent_product_post->ID );
					setup_postdata( $parent_product_post );
				}
			?>
		</tbody>
	</table>

	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product_id ); ?>" />

	<?php if ( $quantites_required ) : ?>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<button type="submit" data-product_id="<?php echo esc_attr($product_id); ?>" data-quantity="1" data-default_text="<?php echo esc_attr($product->single_add_to_cart_text()); ?>" data-default_icon="sf-icon-cart" data-loading_text="<?php echo esc_attr($loading_text); ?>" data-added_text="<?php echo esc_attr($added_text); ?>" class="add_to_cart_button button alt"><?php echo apply_filters('sf_add_to_cart_icon', '<i class="sf-icon-cart"></i>'); ?><span><?php echo esc_attr($product->single_add_to_cart_text()); ?></span></button>
		<?php echo sf_wishlist_button(); ?>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php endif; ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>