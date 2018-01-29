<?php
/**
 * DevHub Template: Return
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

$return = torro_devhub_devhub_get_return();

if ( empty( $return ) ) {
	return;
}

?>
<div class="return">
	<h3><?php esc_html_e( 'Return', 'torro-devhub' ); ?></h3>
	<p><?php echo $return; // WPCS: XSS OK. ?></p>
</div>
