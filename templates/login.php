<?php
/**
 * Template Name: Login Page
 *
 * The login page template displays a login or logout form.
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
				<div class="page-login-form">
					<?php if ( isset( $_GET['loggedout'] ) && 'true' === $_GET['loggedout'] ) : ?>
						<div class="notice notice-info">
							<p><?php esc_html_e( 'You are now logged out.', 'torro-devhub' ); ?></p>
						</div>
					<?php endif; ?>

					<?php
					wp_login_form( array(
						'redirect' => admin_url(),
					) );
					?>

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
				?>
				<div class="page-login-form">
					<p class="login-links">
						<a href="<?php echo esc_url( wp_logout_url( add_query_arg( 'loggedout', 'true', get_permalink() ) ) ); ?>"><?php esc_html_e( 'Logout', 'torro-devhub' ); ?></a>
					</p>
				</div>
				<?php
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php

get_sidebar();
get_footer();
