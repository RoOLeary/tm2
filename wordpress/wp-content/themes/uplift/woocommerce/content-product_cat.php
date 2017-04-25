<?php
    /**
     * The template for displaying product category thumbnails within loops.
     * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
     *
     * @author        WooThemes
     * @package       WooCommerce/Templates
     * @version       2.6.1
     */

    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    } // Exit if accessed directly

    global $woocommerce_loop;
    $sf_options = sf_get_theme_opts();

    // Store loop count we're currently on
    if ( empty( $woocommerce_loop['loop'] ) ) {
        $woocommerce_loop['loop'] = 0;
    }

    // Store column count for displaying the grid
	if ( empty( $woocommerce_loop['columns'] ) ) {
		$product_display_columns = $sf_options['product_display_columns'];

		// COLUMNS GET VARIABLE
		if (isset($_GET['product_columns'])) {
			$product_display_columns = $_GET['product_columns'];
		}

		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $product_display_columns );
	}

    $width = "";

    if ( $woocommerce_loop['columns'] == 4 ) {
        $width     = 'col-sm-3';
    } else if ( $woocommerce_loop['columns'] == 5 ) {
        $width     = 'col-sm-sf-5';
    } else if ( $woocommerce_loop['columns'] == 3 ) {
        $width     = 'col-sm-4';
    } else if ( $woocommerce_loop['columns'] == 2 ) {
        $width     = 'col-sm-6';
    } else if ( $woocommerce_loop['columns'] == 1 ) {
       $width     = 'col-sm-12';
    } else if ( $woocommerce_loop['columns'] == 6 ) {
        $width     = 'col-sm-2';
    }

    // Increase loop count
    $woocommerce_loop['loop'] ++;

    $category_link = get_term_link( $category->slug, 'product_cat' );
    
    // Classes
    $classes[] = 'product-category product';
    $classes[] = esc_attr($width);
    if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 || $woocommerce_loop['columns'] == 1 ) {
        $classes[] = 'first';
    }
    if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 ) {
        $classes[] =  'last';
    }
    
?>
<li <?php wc_product_cat_class( $classes, $category ); ?> data-width="<?php echo esc_attr($width); ?>">

	<div class="product-category-wrap">

	    <?php do_action( 'woocommerce_before_subcategory', $category ); ?>
	
		<figure class="animated-overlay">
			<a href="<?php echo esc_url($category_link); ?>"></a>
		    <?php
		        /**
		         * woocommerce_before_subcategory_title hook
		         *
		         * @hooked woocommerce_subcategory_thumbnail - 10
		         */
		        do_action( 'woocommerce_before_subcategory_title', $category );
		    ?>
		    <figcaption>
		    	<div class="thumb-info thumb-info-alt">
		    		<i><svg version="1.1" class="sf-hover-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		    			 width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
		    		<path fill="none" stroke="#444444" stroke-width="2" stroke-miterlimit="10" d="M2,12h20 M15,19l7-7l-7-7"/>
		    		</svg></i>
		    	</div>
		    </figcaption>
		</figure>
	
	    <div class="product-cat-info">
	
	        <h3>
	        	<a href="<?php echo esc_url($category_link); ?>">
	        	<span><?php echo esc_attr($category->name); ?></span>
	            <?php if ( $category->count > 0 ) {
	                echo apply_filters( 'woocommerce_subcategory_count_html', ' <sup class="count">' . $category->count . '</sup>', $category );
	            	}
	        	?>
	        	</a>
	       	</h3>
	
	       	<a class="shop-now-link" href="<?php echo esc_url($category_link); ?>"><?php _e( 'Shop now', 'uplift' ); ?></a>
	
	    </div>
	
	    <?php
	        /**
	         * woocommerce_after_subcategory_title hook
	         */
	        do_action( 'woocommerce_after_subcategory_title', $category );
	    ?>
	
	    <?php do_action( 'woocommerce_after_subcategory', $category ); ?>
	    
    </div>

</li>