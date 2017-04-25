<?php

	/*
	*
	*	Header 6
	*	------------------------------------------------
	* 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
	*
	*	Output for header-6
	*
	*/
	
	$sf_options = sf_get_theme_opts();
	$fullwidth_header    = $sf_options['fullwidth_header'];
	$header_left_output  = sf_header_aux( 'left' );
	$header_right_output = sf_header_aux( 'right' );
?>

<?php if ( $fullwidth_header ) { ?>
<header id="header" class="fw-header non-stick-header clearfix">
<?php } else { ?>
<header id="header" class="non-stick-header clearfix">
<?php } ?>
	<?php do_action('sf_header_start'); ?>
	<div class="container">
		<div class="row">
	
			<div class="header-left col-sm-4">
				<?php echo $header_left_output; ?>
			</div>
	
			<?php echo sf_logo( 'col-sm-4 logo-center' ); ?>
	
			<div class="header-right col-sm-4">
				<?php echo $header_right_output; ?>
			</div>
	
		</div> <!-- CLOSE .row -->
	</div> <!-- CLOSE .container -->
	<?php do_action('sf_header_end'); ?>
</header>

<?php if ( $fullwidth_header ) { ?>
<div id="main-nav" class="sticky-header center-menu fw-main-nav">
<?php } else { ?>
<div id="main-nav" class="sticky-header center-menu">
<?php } ?>
	<?php echo sf_main_menu( 'main-navigation', 'both-nav-aux' ); ?>
</div>