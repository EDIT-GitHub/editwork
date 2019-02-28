<?php if ( is_search() ) : ?>
			<div class="page404Wrap">
        		<p><?php esc_html_e('Nothing Found', 'coworking') ?><br><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'coworking' ); ?></p>
				<a href="<?php if ( function_exists('icl_get_languages') ) { echo esc_url( icl_get_home_url() ); } else { echo esc_url( home_url('/') ); } ?>" class="homePage"><?php esc_html_e('Homepage', 'coworking') ?></a>
			</div>
<?php else : ?>
			<div class="page404Wrap">
        		<h1 class="blockTitle"><?php esc_html_e( 'Nothing Found', 'coworking' ); ?></h1>
        		<p><?php esc_html_e( 'It seems we cannot find what you are looking for.', 'coworking' ); ?></p>
				<a href="<?php if ( function_exists('icl_get_languages') ) { echo esc_url( icl_get_home_url() ); } else { echo esc_url( home_url('/') ); } ?>" class="homePage"><?php esc_html_e('Homepage', 'coworking') ?></a>
			</div>
<?php endif; ?>