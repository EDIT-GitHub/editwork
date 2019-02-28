			<div class="shareSocialLinks">
            <?php if ( ot_get_option('uni_fb_share_link_enable') != 'off' ) { ?>
				<a href="<?php echo uni_coworking_theme_share_facebook(); ?>"><i class="fa fa-facebook"></i></a>
            <?php } ?>
            <?php if ( ot_get_option('uni_twi_share_link_enable') != 'off' ) { ?>
				<a href="<?php echo uni_coworking_theme_share_twitter(); ?>"><i class="fa fa-twitter"></i></a>
            <?php } ?>
            <?php if ( ot_get_option('uni_gplus_share_link_enable') != 'off' ) { ?>
				<a href="<?php echo uni_coworking_theme_share_gplus(); ?>"><i class="fa fa-google-plus"></i></a>
            <?php } ?>
            <?php if ( ot_get_option('uni_pi_share_link_enable') != 'off' ) { ?>
				<a href="<?php echo uni_coworking_theme_share_pinterest(); ?>"><i class="fa fa-pinterest"></i></a>
            <?php } ?>
			</div>