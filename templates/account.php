<?php
/**
 * Template Name: Account Page
 *
 * The account page template requires the user to be logged-in to view the page content.
 *
 * @package Torro_DevHub
 * @license GPL-2.0-or-later
 * @link    http://developer.torro-forms.com
 */

get_header();

?>

	<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			if ( ! is_user_logged_in() ) :
				?>
				<header class="page-header">
					<?php the_title( '<h1>', '</h1>' ); ?>
				</header><!-- .page-header -->

				<div class="page-login-form">
					<p><?php esc_html_e( 'You must be logged in to view the content of this page.', 'torro-devhub' ); ?></p>

					<?php wp_login_form(); ?>

					<p class="login-links">
						<?php if ( get_option( 'users_can_register' ) ) : ?>
							<a href="<?php echo esc_url( wp_registration_url() ); ?>"><?php esc_html_e( 'Register', 'torro-devhub' ); ?></a>
							<span class="sep">|</span>
						<?php endif; ?>
						<a href="<?php echo esc_url( wp_lostpassword_url( get_permalink() ) ); ?>"><?php esc_html_e( 'Lost your password?', 'torro-devhub' ); ?></a>
					</p>
				</div>
				<?php
			else :
				if ( torro_devhub_use_post_format_templates() ) :
					get_template_part( 'template-parts/content/content-' . get_post_type(), get_post_format() );
				else :
					get_template_part( 'template-parts/content/content', get_post_type() );
				endif;

				if ( torro_devhub_display_post_navigation() ) :
					the_post_navigation();
				endif;

				if ( torro_devhub_display_post_comments() ) :
					comments_template();
				endif;
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php

get_sidebar();
get_footer();
