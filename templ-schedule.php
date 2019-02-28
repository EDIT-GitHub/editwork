<?php
/*
*  Template Name: Schedule Page
*/
get_header();
?>

    <section class="uni-container">

    <?php if (have_posts()) : while (have_posts()) : the_post();
		$aPostCustom = get_post_custom( $post->ID );
    ?>
    <?php
        // background
        if ( !empty($aPostCustom['uni_schedule_page_header_bg'][0]) ) {
            $iHeaderImageAttachId = intval($aPostCustom['uni_schedule_page_header_bg'][0]);
            $aPageHeaderImage = wp_get_attachment_image_src( $iHeaderImageAttachId, 'full' );
            $sPageHeaderImage = $aPageHeaderImage[0];
        } else {
            $sPageHeaderImage = 'http://placehold.it/1920x600';
        }
    ?>


		<div class="pageHeaderImg" style="background-image: url(<?php echo esc_url($sPageHeaderImage) ?>); ?>);">
			<h1><?php the_title() ?></h1>
		</div>
		
		<div class="scheduleWrap">
            <?php the_content(); ?>
		</div>

    <?php
        endwhile; endif;
        wp_reset_postdata();
    ?>
        
    </section>

<?php get_footer(); ?>