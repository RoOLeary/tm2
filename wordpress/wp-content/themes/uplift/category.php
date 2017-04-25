<?php get_header(); ?>
	
<?php 
	$sf_options = sf_get_theme_opts();
	$blog_type = $sf_options['archive_display_type'];
?>

<?php if ($blog_type != "masonry-fw") { ?>
<div class="container">
<?php } ?>

	<?php sf_base_layout('archive'); ?>
	
<?php if ($blog_type != "masonry-fw") { ?>
</div>
<?php } ?>

<?php get_footer(); ?>