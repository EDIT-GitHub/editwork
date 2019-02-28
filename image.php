<?php get_header();
// with sidebar
if ( ot_get_option( 'uni_single_post_with_sidebar' ) == 'on' ) {
?>
	<section class="uni-container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('singlePageContentV2') ?>>
			<div class="wrapper uni-clear">

				<div class="contentLeft">
					<div class="singleMeta">
						<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(); ?></time>
						<h1><?php the_title() ?></h1>
					</div>
					<div class="singlePostWrap">
						<?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?>
					</div>

				</div>

                <?php get_sidebar() ?>

			</div>
		</div>
        <?php endwhile; endif; ?>
	</section>
<?php
// without sidebar
} else {
?>
	<section class="uni-container">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('singlePageContent') ?>>

			<div class="wrapper">
				<div class="singleMeta">
					<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(); ?></time>
					<h1><?php the_title() ?></h1>
				</div>
				<div class="singlePostWrap">
					<?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?>
				</div>

			</div>

		</div>
        <?php endwhile; endif; ?>

	</section>
<?php
}
get_footer(); ?>