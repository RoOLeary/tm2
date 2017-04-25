<!DOCTYPE html>

<!--// OPEN HTML //-->
<html <?php language_attributes(); ?>>

	<!--// OPEN HEAD //-->
	<head>
	
		<?php wp_head(); ?>

	<!--// CLOSE HEAD //-->
	</head>

	<!--// OPEN BODY //-->
	<body <?php body_class(); ?>>
	
		<?php
			/**
			 * @hooked - sf_site_loading - 5
			 * @hooked - sf_fullscreen_search - 6
			 * @hooked - sf_mobile_menu - 10
			 * @hooked - sf_mobile_cart - 20
			 * @hooked - sf_sideslideout - 40
			**/
			do_action('sf_before_page_container');
		?>

		<!--// OPEN #container //-->
		<div id="container">

			<?php
				/**
				 * @hooked - sf_pageslider - 5 (if above header)
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
				
				<div class="inner-container-wrap">