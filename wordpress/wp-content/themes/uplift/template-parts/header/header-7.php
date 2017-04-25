<?php

	/*
	*
	*	Header 7
	*	------------------------------------------------
	* 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
	*
	*	Output for header-7
	*
	*/
	
	$sf_options = sf_get_theme_opts();
	$header_right_output = sf_header_aux( 'right' );
	$fullwidth_header    = $sf_options['fullwidth_header'];
?>

<?php if ( $fullwidth_header ) { ?>
<header id="header" class="fw-header non-stick-header clearfix">
<?php } else { ?>
<header id="header" class="non-stick-header clearfix">
<?php } ?>
	<?php do_action('sf_header_start'); ?>
	<div class="container">
		<div class="row">
			
			<?php echo sf_logo( 'col-sm-4 logo-left' ); ?>
			
			<div class="header-right col-sm-8">
				<?php echo $header_right_output; ?>
			</div>
			
			<div class="header-divide"></div>		
			
		</div> <!-- CLOSE .row -->
	</div> <!-- CLOSE .container -->
	<?php do_action('sf_header_end'); ?>
</header>

<?php if ( $fullwidth_header ) { ?>
<div id="main-nav" class="sticky-header fw-main-nav">
<?php } else { ?>
<div id="main-nav" class="sticky-header">
<?php } ?>
	<?php echo sf_main_menu( 'main-navigation', 'right-nav-aux' ); ?>
</div>