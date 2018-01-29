<?php
/**
 * DevHub Template: Changelog
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

$changelog = torro_devhub_devhub_get_changelog();

if ( empty( $changelog ) ) {
	return;
}

?>

<div class="changelog">
	<h3><?php esc_html_e( 'Changelog', 'torro-devhub' ); ?></h3>

	<table>
		<caption class="screen-reader-text"><?php esc_html_e( 'Changelog', 'torro-devhub' ); ?></caption>
		<thead>
			<tr>
				<th class="changelog-version"><?php esc_html_e( 'Version', 'torro-devhub' ); ?></th>
				<th class="changelog-desc"><?php esc_html_e( 'Description', 'torro-devhub' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $changelog as $version => $data ) : ?>
				<tr>
					<td><a href="<?php echo esc_url( $data['since_url'] ); ?>"><?php echo esc_html( $version ); ?></a></td>
					<td><?php echo $data['description']; // WPCS: XSS OK. ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
