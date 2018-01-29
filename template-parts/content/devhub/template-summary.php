<?php
/**
 * DevHub Template: Summary
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

$summary = torro_devhub_devhub_get_summary();

if ( empty( $summary ) ) {
	return;
}

?>

<div class="summary">
	<?php echo $summary; // WPCS: XSS OK. ?>
</div>
