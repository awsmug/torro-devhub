<?php
/**
 * Template part for displaying a DevHub post header
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

?>
<header class="entry-header">

	<?php echo torro_devhub_devhub_get_deprecated(); // WPCS: XSS OK. ?>
	<?php echo torro_devhub_devhub_get_private_access_message(); // WPCS: XSS OK. ?>

	<?php if ( 'wp-parser-hook' !== get_post_type() ) : ?>
		<?php echo torro_devhub_devhub_get_namespace( null, true, true ); // WPCS: XSS OK. ?>
	<?php endif; ?>

	<?php if ( is_singular() ) : ?>
		<h1 class="signature"><?php echo torro_devhub_devhub_get_signature(); // WPCS: XSS OK. ?></h1>
	<?php else : ?>
		<h2><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); // WPCS: XSS OK. ?></a></h2>
	<?php endif; ?>

</header><!-- .entry-header -->
