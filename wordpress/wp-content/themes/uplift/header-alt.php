<!DOCTYPE html>

<!--// OPEN HTML //-->
<html <?php language_attributes(); ?>>

	<!--// OPEN HEAD //-->
	<head>
		
		<?php
			// Remove Header
			remove_action('sf_before_page_container', 'sf_mobile_menu', 10);
			remove_action('sf_before_page_container', 'sf_mobile_cart', 20);
			remove_action('sf_container_start', 'sf_mobile_header', 10);
			remove_action('sf_container_start', 'sf_header_wrap', 20);
			remove_action( 'sf_container_start', 'sf_header_banner_bar', 30 );
		?>

		<?php wp_head(); ?>

	<!--// CLOSE HEAD //-->
	</head>

	<!--// OPEN BODY //-->
	<body <?php body_class(); ?>>

		<?php
			/**
			 * @hooked - sf_site_loading - 0
			 * @hooked - sf_mobile_menu - 10
			 * @hooked - sf_mobile_cart - 20
			 * @hooked - sf_pageslider - 30 (if above header)
			**/
			do_action('sf_before_page_container');
		?>

		<!--// OPEN #container //-->
		<div id="container">

			<?php
				/**
				 * @hooked - sf_mobile_header - 10
				 * @hooked - sf_header_wrap - 20
				**/
				do_action('sf_container_start');
			?>

			<!--// OPEN #main-container //-->
			<div id="main-container" class="clearfix">

				<?php
					/**
					 * @hooked - sf_pageslider - 10 (if standard)
					 * @hooked - sf_breadcrumbs - 20
					 * @hooked - sf_page_heading - 30
					**/
					do_action('sf_main_container_start');
				?>