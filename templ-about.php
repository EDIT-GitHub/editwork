<?php
/*
*  Template Name: About Page
*/
get_header();
$aUniAllowedHtmlWoA = uni_coworking_theme_allowed_html_wo_a();
$aUniAllowedHtmlWithA = uni_coworking_theme_allowed_html_with_a();
$sDateFormat = get_option( 'date_format' );
$sTimeFormat = get_option( 'time_format' );
?>

    <section class="uni-container">

    <?php if (have_posts()) : while (have_posts()) : the_post();
		$aPostCustom = get_post_custom( $post->ID );
    ?>
    <?php
        // background
        if ( !empty($aPostCustom['uni_about_page_header_bg'][0]) ) {
            $iHeaderImageAttachId = intval($aPostCustom['uni_about_page_header_bg'][0]);
            $aPageHeaderImage = wp_get_attachment_image_src( $iHeaderImageAttachId, 'full' );
            $sPageHeaderImage = $aPageHeaderImage[0];
        } else {
            $sPageHeaderImage = 'http://placehold.it/1920x600';
        }
    ?>

	
		<div class="pageHeaderImg" style="background-image: url(<?php echo esc_url( $sPageHeaderImage ) ?>); ?>);">
			<h1><?php the_title() ?></h1>
		</div>
        <div class="uni-about-us-wrap">
            <div class="wrapper uni-clear">
                <div class="uni-fcell">
                    <?php
                    $placeholder_alt = esc_attr__('Coworking space', 'coworking');
                    $top_image_id = ( isset($aPostCustom['uni_about_us_top_img'][0]) ) ? intval($aPostCustom['uni_about_us_top_img'][0]) : 0;
                    if ( ! empty($top_image_id) ) {
                        $top_image = wp_get_attachment_image( $top_image_id, 'unithumb-coworking-aboutuswide' );
                    } else {
                        $top_image = '<img src="http://placehold.it/570x270" alt="' . $placeholder_alt . '">';
                    }

                    $lb_image_id = ( isset($aPostCustom['uni_about_us_left_bottom_img'][0]) ) ? intval($aPostCustom['uni_about_us_left_bottom_img'][0]) : 0;
                    if ( ! empty($lb_image_id) ) {
                        $lb_image = wp_get_attachment_image( $lb_image_id, 'unithumb-coworking-aboutussquare' );
                    } else {
                        $lb_image = '<img src="http://placehold.it/270x270" alt="' . $placeholder_alt . '">';
                    }

                    $rb_image_id = ( isset($aPostCustom['uni_about_us_right_bottom_img'][0]) ) ? intval($aPostCustom['uni_about_us_right_bottom_img'][0]) : 0;
                    if ( ! empty($rb_image_id) ) {
                        $rb_image = wp_get_attachment_image( $rb_image_id, 'unithumb-coworking-aboutussquare' );
                    } else {
                        $rb_image = '<img src="http://placehold.it/270x270" alt="' . $placeholder_alt . '">';
                    }
                    ?>
                    <div class="singlePostWrap uni-clear">
                        <p><?php echo $top_image; ?></p>
                        <div class="alignleft">
                           <?php echo $lb_image; ?>
                        </div>
                        <div class="alignright">
                           <?php echo $rb_image; ?>
                        </div>
                    </div>
                </div>
                <div class="uni-scell">
                    <div class="homeAboutUs js-uni-animated">
                        <?php
                            $sAboutTitle    = ( isset($aPostCustom['uni_about_us_title'][0]) ) ? $aPostCustom['uni_about_us_title'][0] : '';
                            $sAboutText     = ( isset($aPostCustom['uni_about_us_description'][0]) ) ? $aPostCustom['uni_about_us_description'][0] : '';
                        ?>
                        <?php
                            $iAboutUsOneLogoAttachId = ( ot_get_option( 'uni_home_about_one_logo' ) ) ? intval(ot_get_option( 'uni_home_about_one_logo' )) : '';
                            if ( !empty($iAboutUsOneLogoAttachId) ) {
                                $aAboutUsOneLogo = wp_get_attachment_image_src( $iAboutUsOneLogoAttachId, 'full' );
                                $sAboutUsOneLogoUrl = $aAboutUsOneLogo[0];
                                echo '<img src="'.esc_url($sAboutUsOneLogoUrl).'" alt="'.( ( !empty($sHomeAboutTitle) ) ? esc_attr( $sHomeAboutTitle ) : '' ).'">';
                            }
                        ?>
                        <h3><?php if ( !empty($sAboutTitle) ) echo wp_kses( $sAboutTitle, $aUniAllowedHtmlWoA ); ?></h3>
                        <p><?php if ( !empty($sAboutText) ) echo wp_kses( $sAboutText, $aUniAllowedHtmlWithA ); ?></p>
                        <?php
                        $link_enable    = ( isset($aPostCustom['uni_about_us_link_on'][0]) ) ? $aPostCustom['uni_about_us_link_on'][0] : 'off';
                        $link_uri       = ( isset($aPostCustom['uni_about_us_link_uri'][0]) ) ? $aPostCustom['uni_about_us_link_uri'][0] : '';
                        $link_label     = ( isset($aPostCustom['uni_about_us_link_label'][0]) ) ? $aPostCustom['uni_about_us_link_label'][0] : __('Join now', 'coworking');
                        if ( $link_enable === 'on' && empty( $link_uri ) ) { ?>
                        <a data-remodal-target="joinForm" href="" class="joinNow"><?php echo esc_html( $link_label ); ?></a>
                        <?php } else if ( $link_enable === 'on' && ! empty( $link_uri ) ) { ?>
                        <a href="<?php echo esc_url( $link_uri ) ?>" class="joinNow"><?php echo esc_html( $link_label ); ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    <?php
        endwhile; endif;
        wp_reset_postdata();
    ?>
        <?php
        $team_sec_enabled = ( isset($aPostCustom['uni_about_team_on'][0]) ) ? $aPostCustom['uni_about_team_on'][0] : 'off';
        if ( 'on' === $team_sec_enabled ) {

        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        if ( is_plugin_active( 'uni-sortable-users/uni-sortable-users.php' ) ) {
            if ( !empty( $aPostCustom['uni_about_team_members'][0] ) ) {
                $aUsersArray = maybe_unserialize($aPostCustom['uni_about_team_members'][0]);
                $oUserQuery = new WP_User_Query( array('role' => 'coworking_staff', 'include' => $aUsersArray, 'meta_key' => 'user_order', 'orderby' => 'meta_value_num', 'order' => 'asc') );
            } else {
                $oUserQuery = new WP_User_Query( array('role' => 'coworking_staff', 'meta_key' => 'user_order', 'orderby' => 'meta_value_num', 'order' => 'asc') );
            }
        } else {
            if ( !empty( $aPostCustom['uni_about_team_members'][0] ) ) {
                $aUsersArray = maybe_unserialize($aPostCustom['uni_about_team_members'][0]);
                $oUserQuery = new WP_User_Query( array('role' => 'coworking_staff', 'include' => $aUsersArray) );
            } else {
                $oUserQuery = new WP_User_Query( array('role' => 'coworking_staff') );
            }
        }
        if ( ! empty( $oUserQuery->results ) ) {
        ?>
        <div class="uni-our-team-wrap">
            <div class="wrapper">
                <div class="blockTitle"><?php esc_html_e( 'Meet our team', 'coworking' ) ?></div>
                <div class="uni-our-team-members uni-clear">
                <?php
                foreach ( $oUserQuery->results as $oUser ) {
                    $user_id            = $oUser->ID;
                    $profession         = get_user_meta( $user_id, '_uni_profilini_profession', true );
                    $social_icons       = get_user_meta( $user_id, '_uni_profilini_si', true );
                    $avatar_attach_id   = get_user_meta( $user_id, '_uni_profilini_avatar_id', true );
                    if ( ! empty($avatar_attach_id) && get_post( $avatar_attach_id ) ) {
                        $thumbnail_html = wp_get_attachment_image( $avatar_attach_id, 'unithumb-coworking-aboutussquare', false, array(
                            'alt' => esc_attr( $oUser->display_name),
                            'class' => 'uni-our-team-item-img'
                            ) );
                    } else {
                        $thumbnail_html = '<img class="uni-our-team-item-img" src="http://placehold.it/270x270" alt="' . esc_attr( $oUser->display_name ) . '">';
                    }
                ?>
                    <?php echo $is_desc = ( isset( $oUser->description ) && ! empty( $oUser->description ) ) ? true : false; ?>
                    <div class="uni-our-team-item<?php echo ( $is_desc ) ? ' uni-with-desc' : ''; ?>">
                        <?php echo $thumbnail_html; ?>
                        <h3><?php echo esc_html( $oUser->display_name ); ?></h3>
                        <p><?php echo esc_html( $profession ); ?></p>
                        <?php if ( $is_desc ) { ?>
                        <p class="uni-our-team-item-desc"><?php echo wp_kses( $oUser->description, $aUniAllowedHtmlWithA ) ?></p>
                        <?php } ?>
                        <?php
                            if ( ! empty( $social_icons ) ) {
                                echo '<div class="uni-user-social-profiles">';
                                foreach ( $social_icons as $key => $value ) {
                                    echo '<a href="' . esc_url($value['url']) . '"><i class="' . esc_attr($value['icon']) . '" aria-hidden="true"></i></a>';
                                }
                                echo '</div>';
                            }
                        ?>
                    </div>
                <?php } ?>
                </div>    
            </div>
        </div>
        <?php }
        } ?>

        <?php
        $insta_sec_enabled = ( isset($aPostCustom['uni_about_instagram_on'][0]) ) ? $aPostCustom['uni_about_instagram_on'][0] : 'off';
        if ( 'on' === $insta_sec_enabled ) {
        ?>
            <div class="instagramBox">
                <div class="instagramHashtag">
                    <h3>
                    <?php $sInstagramTitle = ot_get_option( 'uni_home_instagram_url' ); ?>
                        <a href="<?php if ( !empty($sInstagramTitle) ) { echo esc_url($sInstagramTitle); } else { echo '#'; } ?>">
                            <?php $sInstagramTitle = ot_get_option( 'uni_home_instagram_title' );
                            if ( isset($sInstagramTitle) && !empty($sInstagramTitle) ) { echo esc_html( $sInstagramTitle ); } else { esc_html_e('#coworking', 'coworking'); } ?>
                        </a>
                    </h3>
                </div>

                <?php echo do_shortcode('[instagram-feed showheader=true widthunit=273 heightunit=273 imagepadding=0 showfollow=true showbutton=false]'); ?>
            </div>
        <?php } ?>
    </section>

<?php get_footer(); ?>