<?php get_header();
// this template not only handles a markup for a regular WP page, but also for WC cart and WC checkout pages
if ( function_exists('is_cart') && is_cart() ) {
?>

	<section class="uni-container">
		<div class="contentWrap">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="pagePanel uni-clear">
				<div class="pageTitle"><?php the_title() ?></div>
			</div>
			<div class="cartPage uni-clear">

                <?php the_content() ?>

			</div>

			<div class="overlay"></div>
		</div>

        <?php endwhile; endif; ?>

	</section>

<?php
} else if ( function_exists('is_checkout') && is_checkout() ) {
?>

	<section class="uni-container">
		<div class="contentWrap">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="pagePanel uni-clear">
				<div class="pageTitle"><?php the_title() ?></div>
			</div>
			<div class="checkoutPage uni-clear">

                <?php the_content() ?>

			</div>

			<div class="overlay"></div>
		</div>

        <?php endwhile; endif; ?>

	</section>

<?php
} else {
?>

	<section class="uni-container">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('singlePageContent') ?>>

			<div class="wrapper">
				<div class="singleMeta">
					<?php the_title( '<h1>', '</h1>' ); ?>
				</div>
				<div class="singlePostWrap uni-clear">
					<?php

                        the_content();

            			wp_link_pages( array(
            				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'coworking' ) . '</span>',
            				'after'       => '</div>',
            				'link_before' => '<span>',
            				'link_after'  => '</span>',
            				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'coworking' ) . ' </span>%',
            				'separator'   => '<span class="screen-reader-text">, </span>',
            			) );

                    ?>
				</div>

                <?php comments_template(); ?>

			</div>

		</div>
        <?php endwhile; endif; ?>

	</section>

<?php
}
get_footer(); ?>