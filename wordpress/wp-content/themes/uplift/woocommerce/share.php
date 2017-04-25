<?php
/**
 * Share template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.13
 */
 
 $atts = array(
 	'share_url' => $share_link_url
 );
?>

<div class="yith-wcwl-share">
    <?php if ( function_exists( 'sf_social_share' ) ) { 
    	echo sf_social_share($atts);
    } ?>
</div>