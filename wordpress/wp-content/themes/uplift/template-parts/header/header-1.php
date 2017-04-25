<?php

	/*
	*
	*	Header 1
	*	------------------------------------------------
	* 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
	*
	*	Output for header-1
	*
	*/
	
	$header_left_output = sf_header_aux( 'left' );
	$header_right_output = sf_header_aux( 'right' );
?>

<header id="header" class="sticky-header clearfix">
	<?php do_action('sf_header_start'); ?>
	<div class="header-left">
		<?php echo $header_left_output; ?>
	</div>
	<div class="container">
		<div class="row">
			<div class="split-menu menu-left col-sm-5">
				<?php echo sf_split_header_menu( 'left' ); ?>
			</div>
			
			<?php echo sf_logo( 'col-sm-2 logo-center' ); ?>
			
			<div class="split-menu menu-right col-sm-5">
				<?php echo sf_split_header_menu( 'right' ); ?>
			</div>
		</div> <!-- CLOSE .row -->
	</div> <!-- CLOSE .container -->
	<div class="header-right">
		<?php echo $header_right_output; ?>
	</div>
	<?php do_action('sf_header_end'); ?>
</header>