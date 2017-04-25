<?php

/**
 * Password Protected
 *
 * @package bbPress
 * @subpackage Uplift
 */

?>

<div id="bbpress-forums">
	<fieldset class="bbp-form" id="bbp-protected">
		<Legend><?php _e( 'Protected', 'uplift' ); ?></legend>

		<?php echo get_the_password_form(); ?>

	</fieldset>
</div>