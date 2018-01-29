<?php
/**
 * The template for displaying the header
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'torro-devhub' ); ?></a>

<div id="page" class="site">
	<header id="header" class="site-header">
		<div id="navbar" class="site-navbar">
			<div class="site-navbar-inner">
				<?php get_template_part( 'template-parts/header/site-branding' ); ?>

				<?php get_template_part( 'template-parts/header/site-navigation' ); ?>
			</div>
		</div>
	</header><!-- #header -->

	<div id="content" class="site-content">
