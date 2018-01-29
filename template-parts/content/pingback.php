<?php
/**
 * Template part for displaying a pingback
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

global $comment, $comment_depth, $comment_args;

?>
<div class="comment-body">
	<?php _e( 'Pingback:', 'torro-devhub' ); ?> <?php comment_author_link( $comment ); ?> <?php edit_comment_link( __( 'Edit', 'torro-devhub' ), '<span class="edit-link">', '</span>' ); ?>
</div>
