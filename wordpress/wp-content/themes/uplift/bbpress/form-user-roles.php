<?php

/**
 * User Roles Profile Edit Part
 *
 * @package bbPress
 * @subpackage Uplift
 */

?>

<div>
	<label for="role"><?php _e( 'Blog Role', 'uplift' ) ?></label>

	<?php bbp_edit_user_blog_role(); ?>

</div>

<div>
	<label for="forum-role"><?php _e( 'Forum Role', 'uplift' ) ?></label>

	<?php bbp_edit_user_forums_role(); ?>

</div>
