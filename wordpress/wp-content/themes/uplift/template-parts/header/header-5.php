<?php

	/*
	*
	*	Header 5
	*	------------------------------------------------
	* 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
	*
	*	Output for header-5
	*
	*/
	
	$sf_options = sf_get_theme_opts();
	$header_right_output = sf_header_aux( 'right' );
	$fullwidth_header    = $sf_options['fullwidth_header'];
?>

<?php if ( $fullwidth_header ) { ?>
<header id="header" class="sticky-header fw-header clearfix">
<?php } else { ?>
<header id="header" class="sticky-header clearfix">
<?php } ?>
	<?php do_action('sf_header_start'); ?>
	<div class="container"> 
		<div class="row"> 
			
			<?php echo sf_logo( 'col-sm-4 logo-left' ); ?>

			<?php echo sf_main_menu( 'main-navigation', 'float-2' ); ?>
			
			<div class="header-right">
				<?php echo $header_right_output; ?>
			</div>	
			
		</div> <!-- CLOSE .row --> 
	</div> <!-- CLOSE .container --> 
	<?php do_action('sf_header_end'); ?>
</header> 