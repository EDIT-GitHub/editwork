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
						<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>,
                <?php
                $aTags = wp_get_post_terms( $post->ID, 'category' );
                if ( $aTags && !is_wp_error( $aTags ) ) :
                $s = count($aTags);
                $i = 1;
                foreach ( $aTags as $oTerm ) {
                    echo '<a href="'.esc_url( get_term_link( $oTerm->slug, 'category' ) ).'" class="postItemCategory">'.esc_html( $oTerm->name ).'</a>';
                    if ($i < $s) echo ', ';
                    $i++;
                }
                endif;
                ?>
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
					<div class="tagsBox">
                        <?php the_tags( '<span>'.esc_html__('Tags', 'coworking').':</span>', ', ', '' ); ?>
					</div>

                    <?php include( locate_template('includes/social-links.php') ); ?>

                    <?php
        			if ( comments_open() || get_comments_number() ) {
        				comments_template();
        			}
                    ?>

                    <?php if ( !ot_get_option( 'uni_display_similar_posts' ) || ot_get_option( 'uni_display_similar_posts' ) != 'off' ) { ?>
                    <?php uni_coworking_theme_similar_cpt_by_tax_alt( 'post_tag', 3, 'post' ); ?>
                    <?php } ?>

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
					<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
					<?php the_title( '<h1>', '</h1>' ); ?>
				</div>
				<div class="singlePostWrap">
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
				<div class="tagsBox">
			        <span><?php esc_html_e('Categories', 'coworking') ?>:</span>
        <?php
        $aTags = wp_get_post_terms( $post->ID, 'category' );
        if ( $aTags && !is_wp_error( $aTags ) ) :
        $s = count($aTags);
        $i = 1;
	    foreach ( $aTags as $oTerm ) {
	        echo '<a href="'.esc_url( get_term_link( $oTerm->slug, 'category' ) ).'">'.esc_html( $oTerm->name ).'</a>';
            if ($i < $s) echo ', ';
            $i++;
	    }
        endif;
        ?>
                    
					<?php the_tags( '<br><br><span>'.esc_html__('Tags', 'coworking').':</span>', ', ', '' ); ?><br><br>
                    
				</div>

                <?php include( locate_template('includes/social-links.php') ); ?>

                <?php
    			if ( comments_open() || get_comments_number() ) {
    				comments_template();
    			}
                ?>

			</div>

            <?php if ( !ot_get_option( 'uni_display_similar_posts' ) || ot_get_option( 'uni_display_similar_posts' ) != 'off' ) { ?>
            <?php uni_coworking_theme_similar_cpt_by_tax( 'post_tag', 3, 'post' ); ?>
            <?php } ?>

		</div>
        <?php endwhile; endif; ?>

	</section>
<?php
}
get_footer(); ?>