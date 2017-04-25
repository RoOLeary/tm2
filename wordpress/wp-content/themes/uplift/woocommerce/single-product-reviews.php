<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $product;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

if ( ! comments_open() )
	return;
	
$product_id = method_exists( $product, 'get_id' ) ? $product->get_id() : $product->id;
?>
<div id="reviews" class="row">
	<div id="comments" class="col-sm-7">
		<div class="title-wrap">
			<h3 class="spb-heading"><span><?php
//			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_rating_count() ) )
//				printf( _n( '%s review for %s', '%s reviews for %s', $count, 'uplift' ), $count, get_the_title() );
//			else
				_e( 'Reviews', 'uplift' );
				echo comments_number( '<span class="count">(0)</span>', '<span class="count">(1)</span>', '<span class="count">(%)</span>' );
			?></span></h3>
		</div>

		<?php if ( have_comments() ) : ?>

			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'uplift' ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product_id ) ) : ?>

		<div id="review_form_wrapper" class="col-sm-5">
			<div class="title-wrap">
				<h3 class="spb-heading"><span><?php _e( 'Add a Review', 'uplift' ); ?></span></h3>
			</div>
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? __( 'Add a Review', 'uplift' ) : __( 'Be the first to review', 'uplift' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
						'title_reply_to'       => __( 'Leave a Reply to %s', 'uplift' ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'uplift' ) . ' <span class="required">*</span></label> ' .
							            '<input id="author" name="author" type="text" placeholder="' . __( 'Name', 'uplift' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
							'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'uplift' ) . ' <span class="required">*</span></label> ' .
							            '<input id="email" name="email" type="text" placeholder="' . __( 'Email', 'uplift' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
						),
						'label_submit'  => __( 'Add your review', 'uplift' ),
						'logged_in_as'  => '',
						'comment_field' => ''
					);

					$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'uplift' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . __( 'Your Review', 'uplift' ) . '"></textarea></p>';

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] .= '<p class="comment-form-rating"><label for="rating">' . __( 'Your Rating', 'uplift' ) .'</label><select name="rating" id="rating">
							<option value="">' . __( 'Rate&hellip;', 'uplift' ) . '</option>
							<option value="5">' . __( 'Perfect', 'uplift' ) . '</option>
							<option value="4">' . __( 'Good', 'uplift' ) . '</option>
							<option value="3">' . __( 'Average', 'uplift' ) . '</option>
							<option value="2">' . __( 'Not that bad', 'uplift' ) . '</option>
							<option value="1">' . __( 'Very Poor', 'uplift' ) . '</option>
						</select></p>';
					}

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'uplift' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>