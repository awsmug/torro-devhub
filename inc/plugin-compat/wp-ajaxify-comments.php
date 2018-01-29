<?php
/**
 * WP Ajaxify Comments compatibility functions
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

/**
 * Shows a warning about incompatibility with WP Ajaxify Comments to users that can deactivate plugins.
 *
 * @since 1.0.0
 */
function torro_devhub_ajaxify_comments_warning() {
	// 'deactivate_plugins' is not available in WordPress < 4.9.
	if ( version_compare( $GLOBALS['wp_version'], '4.9', '<' ) ) {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
	} else {
		if ( ! current_user_can( 'deactivate_plugins' ) ) {
			return;
		}
	}

	?>
	<div class="notice notice-warning">
		<p><?php _e( 'Torro DevHub already handles comment form submissions via AJAX out-of-the-box, so the plugin WP Ajaxify Comments conflicts with it and is not necessary. Please deactivate it.', 'torro-devhub' ); ?></p>
	</div>
	<?php
}
add_action( 'admin_notices', 'torro_devhub_ajaxify_comments_warning' );
