<?php get_header(); ?>

	<section class="uni-container">

		<div class="page404Wrap">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/404.png" alt="<?php esc_html_e('Error 404', 'coworking') ?>">
			<p><?php esc_html_e('The requested page has not been found', 'coworking') ?></p>
			<a class="homePage" href="<?php if ( function_exists('icl_get_languages') ) { echo esc_url( icl_get_home_url() ); } else { echo esc_url( home_url('/') ); } ?>"><?php esc_html_e('Homepage', 'coworking') ?></a>
		</div>

	</section>

<?php get_footer(); ?>