<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
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
?>

<?php

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

if ( $order ) :

$order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
?>

<div class="row">

	<div class="col-sm-12">
	<?php if ( $order->has_status( 'failed' ) ) { ?>
		<p class="order-status order-failed"><i class="sf-icon-fail"></i><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'uplift' ); ?></p>
	<?php } else { ?>
		<p class="order-status order-success"><i class="sf-icon-success"></i><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'uplift' ), $order ); ?></p>
	<?php } ?>
	</div>
				
	<div class="col-sm-9 woo-thankyou-main">

		<?php if ( $order->has_status( 'failed' ) ) : ?>
	
			<p><?php
				if ( is_user_logged_in() )
					_e( 'Please attempt your purchase again or go to your account page.', 'uplift' );
				else
					_e( 'Please attempt your purchase again.', 'uplift' );
			?></p>
	
			<p>
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'uplift' ) ?></a>
				<?php if ( is_user_logged_in() ) : ?>
				<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My Account', 'uplift' ); ?></a>
				<?php endif; ?>
			</p>
	
		<?php else : ?>
			
			<ul class="order_details">
				<li class="order">
					<?php _e( 'Order Number:', 'uplift' ); ?>
					<strong><?php echo $order->get_order_number(); ?></strong>
				</li>
				<li class="date">
					<?php _e( 'Date:', 'uplift' ); ?>
					<strong><?php 
						if ( version_compare( WC_VERSION, '2.7', '>=' ) ) {
							echo date_i18n( get_option( 'date_format' ), $order->get_date_created() );
						} else {
							echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) );
						}
					?></strong>
				</li>
				<li class="total">
					<?php _e( 'Total:', 'uplift' ); ?>
					<strong><?php echo $order->get_formatted_order_total(); ?></strong>
				</li>
				<?php							
				$payment_title = method_exists( $order, 'get_payment_method_title' ) ? $order->get_payment_method_title() : $order->payment_method_title;
				
				if ( $payment_title ) : ?>
	
				<li class="woocommerce-order-overview__payment-method method">
					<?php _e( 'Payment method:', 'swiftframework' ); ?>
					<strong><?php echo wp_kses_post( $payment_title ); ?></strong>
				</li>
	
				<?php endif; ?>
			</ul>
	
			<div class="clear"></div>
	
		<?php endif; ?>
	
		<?php do_action( 'woocommerce_thankyou', $order_id ); ?>
	</div>
	<div class="col-sm-3 woo-thankyou-details">
		<div class="payment-wrap"><?php 
			if ( version_compare( WC_VERSION, '2.7', '>=' ) ) {
				do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order_id );
			} else {
				do_action( 'woocommerce_thankyou_' . $order->payment_method, $order_id );
			}
		?></div>
		<a href="<?php echo esc_url($my_account_link); ?>" class="sf-button accent"><?php _e( 'Back to my account', 'uplift' ); ?></a>
		<a class="continue-shopping accent" href="<?php echo apply_filters( 'woocommerce_continue_shopping_redirect', get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php _e('Continue shopping', 'uplift'); ?></a>
	</div>
</div>

<?php else : ?>

	<p class="order-status order-success"><i class="sf-icon-success"></i><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'uplift' ), null ); ?></p>

<?php endif; ?>