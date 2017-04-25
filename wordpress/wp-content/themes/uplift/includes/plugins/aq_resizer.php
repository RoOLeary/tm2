<?php
function sf_get_pixelratio() {
    if ( isset($_COOKIE["sf_pixel_ratio"]) ) {
        $pixel_ratio = $_COOKIE["sf_pixel_ratio"];
        
        $debug_mode = false;
        if ( isset($_GET['sf_debug']) ) {
        	$debug_mode = $_GET['sf_debug'];
        }
        
        if ( $debug_mode ) {
        	echo 'IMAGE DEBUG -- PIXEL RATIO (' . $pixel_ratio . ') '."\n";
        }
        
        if ( $pixel_ratio >= 2 ) {
           // echo "Is HiRes Device";

			/**
			* Include AQ Resizer
			*/
			require( get_template_directory() . '/includes/plugins/aq_resizer-2x.php' );

		}else{
            //echo "Is NormalRes Device";

			/**
			* Include AQ Resizer
			*/
			require( get_template_directory() . '/includes/plugins/aq_resizer-1x.php' );
        }
    } else {
		require( get_template_directory() . '/includes/plugins/aq_resizer-1x.php' );
?>
    <script>function sf_writeCookie(){the_cookie=document.cookie,the_cookie&&window.devicePixelRatio>=2&&(the_cookie="sf_pixel_ratio="+window.devicePixelRatio+";"+the_cookie,document.cookie=the_cookie)}sf_writeCookie();</script>
<?php
    }//isset($_COOKIE["pixel_ratio"])
}//get_pixelratio
add_action( 'wp_enqueue_scripts', 'sf_get_pixelratio' );
?>
