<?php
/*
*  Template Name: Home page
*/
get_header();
$aUniAllowedHtmlWoA = uni_coworking_theme_allowed_html_wo_a();
$aUniAllowedHtmlWithA = uni_coworking_theme_allowed_html_with_a();
$sDateAndTimeFormat = get_option( 'date_format' ).' '.get_option( 'time_format' );
$sDateFormat = get_option( 'date_format' );
$sTimeFormat = get_option( 'time_format' );
?>

<section class="uni-container">

    <?php if ( ot_get_option('uni_home_builtin_slider_enable') === 'on' ) { ?>
    <?php
    $aHomeSlidesArgs = array(
     'post_type' => 'uni_home_slides',
     'post_status' => 'publish',
     'posts_per_page' => -1,
     'orderby' => 'menu_order',
     'order' => 'asc'
 );
    $oHomeSlides = new WP_Query( $aHomeSlidesArgs );
    if ( $oHomeSlides->have_posts() ) :
        $i = 0
        ?>
        <div id="We-Are" class="mainHomeSlider">
            <ul>
                <?php
                while ( $oHomeSlides->have_posts() ) : $oHomeSlides->the_post();
                    $aPostCustom = get_post_custom( $post->ID );
                    $sThumbId = get_post_thumbnail_id( $post->ID );
                    $aImage = wp_get_attachment_image_src( $sThumbId, 'full' );
                    ?>
                    <li data-slide="<?php echo esc_attr( $i ); ?>" style="background-image: url(<?php if ( isset($aImage[0]) ) { echo esc_url( $aImage[0] ); } ?>);">
                        <div class="screenDesc2">
                            <?php if ( $aPostCustom['uni_slide_subheading'][0] && ! empty( $aPostCustom['uni_slide_subheading'][0] ) ) { ?>
                            <p><?php echo wp_kses( $aPostCustom['uni_slide_subheading'][0], $aUniAllowedHtmlWoA ); ?></p>
                            <?php } ?>
                            <h3><?php the_title() ?></h3>
                            <?php if ( $aPostCustom['uni_slide_button_enable'][0] && $aPostCustom['uni_slide_button_enable'][0] === 'on' ) { ?>
                            <?php if ( $aPostCustom['uni_slide_button_custom_link_enable'][0] && $aPostCustom['uni_slide_button_custom_link_enable'][0] === 'on' ) { ?>
                            <a href="<?php if ( $aPostCustom['uni_slide_button_custom_link_uri'][0] ) { echo esc_url( $aPostCustom['uni_slide_button_custom_link_uri'][0] ); } ?>" class="bookATourLink"><?php if ( $aPostCustom['uni_slide_button_label'][0] ) { echo esc_html( $aPostCustom['uni_slide_button_label'][0] ); } ?></a>
                            <?php } else { ?>
                            <a data-remodal-target="bookingForm" href="" class="bookATourLink"><?php if ( $aPostCustom['uni_slide_button_label'][0] ) { echo esc_html( $aPostCustom['uni_slide_button_label'][0] ); } ?></a>
                            <?php } ?>
                            <?php } ?>
                        </div>
                    </li>
                    <?php
                    $i++;
                endwhile;
                ?>
            </ul>
        </div>
        <?php
    endif;
    wp_reset_postdata();
    ?>
    <?php } ?>

    <?php if ( ot_get_option('uni_home_static_screen_one_enable') == 'on' ) { ?>
    <?php
            // background
    $iStaticImageBgAttachId = ( ot_get_option( 'uni_home_static_screen_one_bg' ) ) ? intval( ot_get_option( 'uni_home_static_screen_one_bg' ) ) : '';
    if ( !empty($iStaticImageBgAttachId) ) {
        $aStaticImageBg = wp_get_attachment_image_src( $iStaticImageBgAttachId, 'full' );
        $sStaticImageBgUrl = $aStaticImageBg[0];
    } else {
        $sStaticImageBgUrl = 'http://placehold.it/1920x1600/5FC7AE/FFFFFF';
    }
    ?>
    <div id="Introduction" class="homeFirstScreen js-static-screen-bg" style="background-image: url(<?php echo esc_url($sStaticImageBgUrl) ?>);">

       <div class="overlayBox" style="background: <?php echo esc_attr( ot_get_option('uni_home_static_screen_one_overlay') ); ?>"></div>
       <?php
       $sStaticTitle = ot_get_option('uni_home_static_screen_title');
       $sStaticText = ot_get_option('uni_home_static_screen_text');
       ?>
       <div class="screenDesc">
           <p class="js-uni-animated-first js-static-screen-text"><?php if ( isset($sStaticText) && !empty($sStaticText) ) { echo wp_kses( $sStaticText, $aUniAllowedHtmlWoA ); } else { esc_html_e('probably the best coworking in the city', 'coworking'); } ?></p>
           <h1 class="js-uni-animated-second js-static-screen-title"><?php if ( isset($sStaticTitle) && !empty($sStaticTitle) ) { echo wp_kses( $sStaticTitle, $aUniAllowedHtmlWoA ); } else { esc_html_e('coworking space', 'coworking'); } ?></h1>
           <?php if ( ot_get_option('uni_home_static_screen_more_link_enable') == 'on' ) { ?>
           <?php if ( ot_get_option('uni_home_static_screen_more_link_url') ) { ?>
           <a href="<?php echo esc_url( ot_get_option('uni_home_static_screen_more_link_url') ); ?>" class="bookATourLink js-uni-animated-third js-static-screen-link"><?php if ( ot_get_option('uni_home_static_screen_more_link_text') ) { echo esc_html( ot_get_option('uni_home_static_screen_more_link_text') ); } else { esc_html_e('book a tour', 'coworking'); } ?></a>
           <?php } else { ?>
           <a data-remodal-target="bookingForm" href="" class="bookATourLink js-uni-animated-third js-static-screen-link"><?php if ( ot_get_option('uni_home_static_screen_more_link_text') ) { echo esc_html( ot_get_option('uni_home_static_screen_more_link_text') ); } else { esc_html_e('book a tour', 'coworking'); } ?></a>
           <?php } ?>
           <?php } ?>
       </div>
   </div>
   <?php } ?>

   <?php if ( ot_get_option('uni_home_about_one_enable') == 'on' ) { ?>
   <div id="About" class="homeSlider uni-clear">
    <?php
    $sHomeAboutTitle = ot_get_option('uni_home_about_one_title');
    $sHomeAboutText = ot_get_option('uni_home_about_one_text');
    ?>
    <div class="fcell">
        <ul>
            <?php
            $aAboutUsOneImages = ( ot_get_option('uni_home_about_one_images') ) ? ot_get_option('uni_home_about_one_images') : array();
            if ( !empty($aAboutUsOneImages) ) {
                $aAboutUsOneImagesIds = explode(',', $aAboutUsOneImages);
                foreach ( $aAboutUsOneImagesIds as $iAttachId ) { ?>
                <li style="background-image: url(<?php $aImage = wp_get_attachment_image_src( $iAttachId, 'unithumb-coworking-aboutusone' ); echo esc_url($aImage[0]); ?>);"></li>
                <?php }
            } else {
                ?>
                <li style="background-image: url(http://placehold.it/1660x1600);"></li>
                <li style="background-image: url(http://placehold.it/1660x1600);"></li>
                <?php } ?>
            </ul>
        </div>
        <div class="scell">
            <div class="homeAboutUs js-uni-animated">
                <?php
                $iAboutUsOneLogoAttachId = ( ot_get_option( 'uni_home_about_one_logo' ) ) ? intval(ot_get_option( 'uni_home_about_one_logo' )) : '';
                if ( !empty($iAboutUsOneLogoAttachId) ) {
                    $aAboutUsOneLogo = wp_get_attachment_image_src( $iAboutUsOneLogoAttachId, 'full' );
                    $sAboutUsOneLogoUrl = $aAboutUsOneLogo[0];
                    echo '<img src="'.esc_url($sAboutUsOneLogoUrl).'" alt="'.( ( !empty($sHomeAboutTitle) ) ? esc_attr( $sHomeAboutTitle ) : '' ).'">';
                }
                ?>
                <h3 class="js-about-one-title"><?php if ( !empty($sHomeAboutTitle) ) echo wp_kses( $sHomeAboutTitle, $aUniAllowedHtmlWoA ); ?></h3>
                <p class="js-about-one-text"><?php if ( !empty($sHomeAboutText) ) echo wp_kses( $sHomeAboutText, $aUniAllowedHtmlWithA ); ?></p>
                <?php if ( !ot_get_option('uni_home_about_one_more_link_url') && ot_get_option('uni_home_about_one_more_link_enable') == 'on' ) { ?>
                <a data-remodal-target="joinForm" href="" class="joinNow js-about-one-link"><?php echo ( ot_get_option('uni_home_about_one_more_link_text') ) ? esc_html( ot_get_option('uni_home_about_one_more_link_text') ) : esc_html_e('Join now', 'coworking') ?></a>
                <?php } else if ( ot_get_option('uni_home_about_one_more_link_url') && ot_get_option('uni_home_about_one_more_link_enable') == 'on' ) { ?>
                <a href="<?php echo esc_url( ot_get_option('uni_home_about_one_more_link_url') ) ?>" class="joinNow js-about-one-link"><?php echo ( ot_get_option('uni_home_about_one_more_link_text') ) ? esc_html( ot_get_option('uni_home_about_one_more_link_text') ) : esc_html_e('Join now', 'coworking') ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php if ( ot_get_option('uni_home_about_two_enable') == 'on' ) { ?>
    <div id="About2" class="uniHomeAbout2 uni-clear">
        <?php
        $sHomeAboutTwoTitle = ot_get_option('uni_home_about_two_title');
        $sHomeAboutTwoText = ot_get_option('uni_home_about_two_text');
        ?>
        <div class="uniHomeAboutWrap">
            <div class="homeAboutUs js-uni-animated">
                <?php
                $iAboutUsTwoLogoAttachId = ( ot_get_option( 'uni_home_about_two_logo' ) ) ? intval(ot_get_option( 'uni_home_about_two_logo' )) : '';
                if ( !empty($iAboutUsTwoLogoAttachId) ) {
                    $aAboutUsTwoLogo = wp_get_attachment_image_src( $iAboutUsTwoLogoAttachId, 'full' );
                    $sAboutUsTwoLogoUrl = $aAboutUsTwoLogo[0];
                    echo '<img src="'.esc_url($sAboutUsTwoLogoUrl).'" alt="'.( ( !empty($sHomeAboutTwoTitle) ) ? esc_attr( $sHomeAboutTwoTitle ) : '' ).'">';
                }
                ?>
                <h3 class="js-about-two-title"><?php if ( !empty($sHomeAboutTwoTitle) ) echo wp_kses( $sHomeAboutTwoTitle, $aUniAllowedHtmlWoA ); ?></h3>
                <p class="js-about-two-text"><?php if ( !empty($sHomeAboutTwoText) ) echo wp_kses( $sHomeAboutTwoText, $aUniAllowedHtmlWithA ); ?></p>

                <a href="<?php echo esc_url( ot_get_option('uni_home_about_two_more_link_url') ) ?>" class="aboutLink">
                    <?php echo ( ot_get_option('uni_home_about_two_more_link_text') ) ? esc_html( ot_get_option('uni_home_about_two_more_link_text') ) : esc_html_e('Learn More', 'coworking') ?>
                    <svg version="1.1" id="Layer_4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    width="19px" height="9px" viewBox="0 0 19 9" enable-background="new 0 0 19 9" xml:space="preserve">
                    <path fill="#FFDD06" d="M18.744,4.242L18.997,4.5l-0.253,0.258V5.03h-0.27L14.578,9l-0.736-0.749l3.16-3.221H-0.003V3.97h17.007
                    l-3.162-3.22L14.578,0l3.682,3.75l0,0l0.217,0.22h0.268V4.242z"/>
                </svg>
            </a>
        </div>
    </div>
</div>
<?php } ?>

<?php if ( ot_get_option('uni_home_benefits_enable') == 'on' ) { ?>
<div id="Benefits">
   <div class="blockTitle"><?php echo ( ot_get_option( 'uni_home_benefits_title' ) ) ? esc_html( ot_get_option( 'uni_home_benefits_title' ) ) : esc_html_e('Benefits', 'coworking'); ?></div>
   <div class="benefitsWrap js-uni-animated">
    <?php
    $aBenefitsList = ( ot_get_option('uni_home_benefits_list') ) ? maybe_unserialize( ot_get_option('uni_home_benefits_list') ) : uni_default_benefits_items();
    if ( isset($aBenefitsList) && is_array($aBenefitsList) && !empty($aBenefitsList) ) {
        foreach( $aBenefitsList as $aItem ) {
            ?>
            <div class="benefitItem">
             <i class="<?php echo esc_attr( $aItem['uni_home_benefits_item_icon'] ) ?>">
                <?php
                $sSvgCode = uni_coworking_theme_get_svg_by_benefits_item_class( $aItem['uni_home_benefits_item_icon'] );
                if ( !empty($sSvgCode) ) {
                            // it echoes a svg code from theme's function
                            // it is not an option and this value is not a user's input
                            // so, I consider it as trust enough to be just echoed
                    echo $sSvgCode;
                }
                ?>
            </i>
            <p><?php echo wp_kses( $aItem['uni_home_benefits_item_desc'], $aUniAllowedHtmlWoA ) ?></p>
        </div>
        <?php
    }
}
?>
</div>
</div>
<?php } ?>

<?php if ( ot_get_option('uni_home_parallax_one_enable') == 'on' ) { ?>
<?php
            // background
$iParallaxOneBgAttachId = ( ot_get_option( 'uni_home_parallax_one_bg' ) ) ? intval(ot_get_option( 'uni_home_parallax_one_bg' )) : '';
if ( !empty($iParallaxOneBgAttachId) ) {
    $aParallaxOneBg = wp_get_attachment_image_src( $iParallaxOneBgAttachId, 'full' );
    $sParallaxOneBgUrl = $aParallaxOneBg[0];
} else {
    $sParallaxOneBgUrl = 'http://placehold.it/1920x1600/5FC7AE/FFFFFF';
}
?>

<div id="events" class="secondScreen" data-speed="6" data-type="parallax" style="background-image: url(<?php echo esc_url($sParallaxOneBgUrl) ?>);">
    <div class="overlayBox" style="z-index: 0; background: <?php echo esc_attr( ot_get_option('uni_home_parallax_one_overlay') ); ?>"></div>

    <?php
    $sParallaxOneText = ot_get_option('uni_home_parallax_one_text');
    ?>

    <div class="blockSlider">
        <h3 class="blockTitle"><?php if ( !empty($sParallaxOneText) ) { echo wp_kses( $sParallaxOneText, $aUniAllowedHtmlWoA ); } else { esc_html_e('Coworking will help you find the right people', 'coworking'); } ?></h3>
        <h3 class="subTitle">O EDIT. WORK abriu as suas portas no dia 29 de novembro.</h3>
    </div>
    <style>.embed-container { position: relative; padding-bottom: 30%; height: 0; overflow: hidden; max-width: 730px; margin: 0 auto; min-height: 40px; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'>

        <iframe src='https://player.vimeo.com/video/246822727?title=0&byline=0&portrait=0' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>

        <?php } ?>
    </div>
    <?php if ( ot_get_option('uni_home_price_tabels_enable') == 'on' ) { ?>
    <div id="Pricing" class="pricingPlans">
        <?php if ( ot_get_option( 'uni_home_price_tabels_items_enable' ) === 'on' && ot_get_option( 'uni_home_price_tabels_title' ) ) { ?>
        <div class="blockTitle"><?php echo ( ot_get_option( 'uni_home_price_tabels_title' ) ) ? esc_html( ot_get_option( 'uni_home_price_tabels_title' ) ) : esc_html_e('Pricing plans', 'coworking'); ?></div>
        <?php } ?>
        <?php if ( ot_get_option( 'uni_home_price_tabels_items_enable' ) === 'on' ) { ?>
        <div  class="pricingPlansWrap js-uni-animated <?php echo ( ot_get_option( 'uni_ordernow_btn_price_tables_enable' ) && ot_get_option( 'uni_ordernow_btn_price_tables_enable' ) == 'off' && ot_get_option( 'uni_home_price_tables_subscriptions_enable' ) == 'off' ) ? ' without-order-now-btn' : ''; ?>">
            <?php } ?>
            <?php if ( ot_get_option('uni_home_price_tabels_items_enable') !== 'off' ) { ?>
            <?php
            $iNumberOfPrices    = ( ot_get_option( 'uni_home_price_tabels_number' ) ) ? intval( ot_get_option( 'uni_home_price_tabels_number' ) ) : 3;

            if ( ot_get_option( 'uni_home_price_tables_subscriptions_enable' ) == 'on' && class_exists('WC_Subscriptions_Product') ) {

                $aChosenSubscriptions = array();
                if ( ot_get_option( 'uni_home_pt_subscription_prod_left' ) ) { $aChosenSubscriptions[] = ot_get_option( 'uni_home_pt_subscription_prod_left' ); }
                if ( ot_get_option( 'uni_home_pt_subscription_prod_center' ) ) { $aChosenSubscriptions[] = ot_get_option( 'uni_home_pt_subscription_prod_center' ); }
                if ( ot_get_option( 'uni_home_pt_subscription_prod_right' ) ) { $aChosenSubscriptions[] = ot_get_option( 'uni_home_pt_subscription_prod_right' ); }
                if ( ot_get_option( 'uni_home_pt_subscription_prod_left_bottom' ) ) { $aChosenSubscriptions[] = ot_get_option( 'uni_home_pt_subscription_prod_left_bottom' ); }
                if ( ot_get_option( 'uni_home_pt_subscription_prod_center_bottom' ) ) { $aChosenSubscriptions[] = ot_get_option( 'uni_home_pt_subscription_prod_center_bottom' ); }
                if ( ot_get_option( 'uni_home_pt_subscription_prod_right_bottom' ) ) { $aChosenSubscriptions[] = ot_get_option( 'uni_home_pt_subscription_prod_right_bottom' ); }

                if ( !empty($aChosenSubscriptions) ) {
                    $aPricesArgs = array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'ignore_sticky_posts' => 1,
                        'post__in' => $aChosenSubscriptions,
                        'orderby' => 'post__in',
                        'posts_per_page' => 6,
                        'meta_query' => array(
                            array(
                                'key' => '_subscription_price',
                                'compare' => 'EXISTS',
                            )
                        )
                    );
                } else {
                    $aPricesArgs = array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'ignore_sticky_posts' => 1,
                        'posts_per_page' => 3,
                        'meta_query' => array(
                            array(
                                'key' => '_subscription_price',
                                'compare' => 'EXISTS',
                            )
                        )
                    );
                }

                $oPricesQuery = new WP_Query( $aPricesArgs );
                if ( $oPricesQuery->have_posts() ) :
                    while ( $oPricesQuery->have_posts() ) : $oPricesQuery->the_post();
                        global $product;
                        $aPostCustom = get_post_custom( $post->ID );
                        $aArrayOfVariations = maybe_unserialize($aPostCustom['_product_attributes'][0]);
                // background
                        $iPriceItemBgAttachId = ( isset($aPostCustom['uni_product_table_item_bg'][0]) && !empty($aPostCustom['uni_product_table_item_bg'][0]) ) ? intval($aPostCustom['uni_price_table_item_bg'][0]) : '';
                        if ( !empty($iPriceItemBgAttachId) ) {
                            $aPriceItemBg = wp_get_attachment_image_src( $iPriceItemBgAttachId, 'unithumb-coworking-priceitembg' );
                            $sPriceItemBgUrl = $aPriceItemBg[0];
                        } else {
                            $sPriceItemBgUrl = 'http://placehold.it/370x94/000000/FFFFFF';
                        }
                //if ( !empty($aArrayOfVariations) ) {
                    // it is a variable product
                //}
                        ?>
                        <div class="pricingPlanItem">
                         <h3 style="background-image: url(<?php echo esc_url($sPriceItemBgUrl) ?>);"><?php the_title() ?></h3>
                         <div class="planPrice">
                          <small><?php echo get_woocommerce_currency_symbol( '' ) ?></small>
                          <strong><?php echo WC_Subscriptions_Product::get_price( $product ) ?></strong>/<?php if ( !empty($aPostCustom['_subscription_period_interval'][0]) ) echo esc_html($aPostCustom['_subscription_period_interval'][0]); ?> <?php echo WC_Subscriptions_Product::get_period( $product ) ?>
                      </div>
                      <div class="pricingPlanItemDescWrap">
                        <?php
                        $aFeaturesList = ( isset($aPostCustom['uni_product_features_list'][0]) ) ? maybe_unserialize( $aPostCustom['uni_product_features_list'][0] ) : array();
                        if ( isset($aFeaturesList) && is_array($aFeaturesList) && !empty($aFeaturesList) ) {
                            foreach( $aFeaturesList as $aItem ) {
                                echo '<p>'.esc_html( $aItem['uni_product_feature_item'] ).'</p>';
                            }
                        } else {
                            echo '<p>-</p>';
                        }
                        ?>
                    </div>
                    <a href="<?php the_permalink() ?>" class="joinNow"><?php echo ( !empty($aPostCustom['uni_order_button_text'][0]) ) ? esc_html( $aPostCustom['uni_order_button_text'][0] ) : esc_html_e('Join now', 'coworking') ?></a>
                </div>
            <?php endwhile; endif;
            wp_reset_postdata();

        } else {

            $aPricesArgs = array(
                'post_type' => 'uni_price',
                'post_status' => 'publish',
                'ignore_sticky_posts' => 1,
                'posts_per_page' => $iNumberOfPrices,
            );

            $oPricesQuery = new WP_Query( $aPricesArgs );
            if ( $oPricesQuery->have_posts() ) :
                while ( $oPricesQuery->have_posts() ) : $oPricesQuery->the_post();
                    $aPostCustom = get_post_custom( $post->ID );
                // background
                    $iPriceItemBgAttachId = ( isset($aPostCustom['uni_price_table_item_bg'][0]) && !empty($aPostCustom['uni_price_table_item_bg'][0]) ) ? intval($aPostCustom['uni_price_table_item_bg'][0]) : '';
                    if ( !empty($iPriceItemBgAttachId) ) {
                        $aPriceItemBg = wp_get_attachment_image_src( $iPriceItemBgAttachId, 'unithumb-coworking-priceitembg' );
                        $sPriceItemBgUrl = $aPriceItemBg[0];
                    } else {
                        $sPriceItemBgUrl = 'http://placehold.it/370x94/';
                    }
                    ?>
                    <div class="pricingPlanItem">
                     <h3 style="background-image: url(<?php echo esc_url($sPriceItemBgUrl) ?>);"><?php the_title() ?></h3>
                     <div class="planPrice">
                        <strong>
                            <?php if ( isset($aPostCustom['uni_price_val'][0]) ) { echo esc_html($aPostCustom['uni_price_val'][0]); } ?>
                        </strong>
                        <small><?php if ( !empty($aPostCustom['uni_price_currency'][0]) ) { echo esc_html($aPostCustom['uni_price_currency'][0]); } ?></small>
                        <?php if ( !empty($aPostCustom['uni_price_period'][0]) ) { echo esc_html('/' . $aPostCustom['uni_price_period'][0]); } ?>
                        <?php if ( isset($aPostCustom['uni_price_tax_info_enable'][0]) && $aPostCustom['uni_price_tax_info_enable'][0] === 'on'
                        && isset($aPostCustom['uni_price_tax_info_text'][0]) ) { ?>

                        <?php echo esc_html( $aPostCustom['uni_price_tax_info_text'][0] ); ?>
                           <!-- 
                             <?php // if ( isset($aPostCustom['uni_price_tax_info_enable'][0]) && $aPostCustom['uni_price_tax_info_enable'][0] === 'on' ) { echo '<small class="uniTaxLabel">*</small>'; } ?>    
                             <small class="uniTaxInfo"><?php // echo esc_html( $aPostCustom['uni_price_tax_info_text'][0] ); ?></small> -->
                             <?php } ?>
                         </div>
                         <div class="pricingPlanItemDescWrap">
                            <?php
                            $aFeaturesList = ( isset($aPostCustom['uni_price_features_list'][0]) ) ? maybe_unserialize( $aPostCustom['uni_price_features_list'][0] ) : array();
                            if ( isset($aFeaturesList) && is_array($aFeaturesList) && !empty($aFeaturesList) ) {
                                foreach( $aFeaturesList as $aItem ) {
                                    echo '<p>'.esc_html( $aItem['uni_price_feature_item'] ).'</p>';
                                }
                            } else {
                                echo '<p>-</p>';
                            }
                            ?>
                        </div>
                        <?php if ( ot_get_option( 'uni_ordernow_btn_price_tables_enable' ) && ot_get_option( 'uni_ordernow_btn_price_tables_enable' ) == 'off' ) {
                                // empty
                        } else {
                            if ( isset($aPostCustom['uni_price_order_button_ext_url_enable'][0]) && $aPostCustom['uni_price_order_button_ext_url_enable'][0] == 'on' && !empty($aPostCustom['uni_price_order_button_uri'][0]) ) { ?>
                            <a href="<?php echo esc_url($aPostCustom['uni_price_order_button_uri'][0]); ?>" class="joinNow"><?php echo ( !empty($aPostCustom['uni_price_order_button_text'][0]) ) ? esc_html( $aPostCustom['uni_price_order_button_text'][0] ) : esc_html_e('Join now', 'coworking') ?></a>
                            <?php } else { ?>
                            <a data-remodal-target="priceForm" href="#" class="joinNow js-price-form-link" data-priceid="<?php echo esc_attr($post->ID); ?>" data-pricetitle="<?php echo esc_attr( get_the_title($post->ID) ) ?>"><?php echo ( !empty($aPostCustom['uni_price_order_button_text'][0]) ) ? esc_html( $aPostCustom['uni_price_order_button_text'][0] ) : esc_html_e('Join now', 'coworking') ?></a>
                            <?php }
                        } ?>
                    </div>
                <?php endwhile; endif;
                wp_reset_postdata();

            } ?>
            <?php } ?>
            <?php if ( ot_get_option( 'uni_home_price_tabels_items_enable' ) === 'on' ) { ?>
        </div>
        <?php } ?>

        <?php if ( ot_get_option( 'uni_home_price_tabels_plans_enable' ) === 'on' && ot_get_option( 'uni_home_price_tabels_plans_title' ) ) { ?>
        <div class="blockTitle"><?php echo ( ot_get_option( 'uni_home_price_tabels_plans_title' ) ) ? esc_html( ot_get_option( 'uni_home_price_tabels_plans_title' ) ) : ''; ?></div>
        <?php } ?>

        <?php if ( ot_get_option( 'uni_home_price_tabels_plans_enable' ) === 'on' ) { ?>
        <div  class="pricingPlansWrap js-uni-animated <?php echo ( ot_get_option( 'uni_ordernow_btn_price_tables_enable' ) && ot_get_option( 'uni_ordernow_btn_price_tables_enable' ) == 'off' && ot_get_option( 'uni_home_price_tables_subscriptions_enable' ) == 'off' ) ? ' without-order-now-btn' : ''; ?>">
            <?php } ?>
            
            <?php if ( ot_get_option( 'uni_home_price_tabels_plans_enable' ) === 'on' &&
            ( ot_get_option( 'uni_home_price_tabels_plans_cobot_enable' ) === 'off' || ! class_exists( 'Uni_Calendar' ) ) ) { ?>
            <?php
            $plans_posts_args = array(
                'post_type' => 'uni_price_plan',
                'post_status' => 'publish',
                'ignore_sticky_posts' => 1,
                'posts_per_page' => -1
            );

            $plans_query = new WP_Query( $plans_posts_args );
            if ( $plans_query->have_posts() ) :
                while ( $plans_query->have_posts() ) : $plans_query->the_post();
                    $aPostCustom = get_post_custom( get_the_ID() );

                    if ( has_post_thumbnail( get_the_ID() ) ) {
                        $aPriceItemBg = wp_get_attachment_image_src( $iPriceItemBgAttachId, 'unithumb-coworking-priceitembg' );
                        $sPriceItemBgUrl = $aPriceItemBg[0];
                    } else {
                        $sPriceItemBgUrl = '<img src="http://placehold.it/370x94" alt="' . esc_attr( get_the_title( get_the_ID() ) ) . '">';
                    }
                    ?>

                    <div class="pricingPlanItem pricingPlanItemForTeams">
                        <h3 style="background-image: url(<?php echo esc_url($sPriceItemBgUrl) ?>);"><?php the_title() ?></h3>
                        <div class="planPrice">
                          <small><?php if ( !empty($aPostCustom['uni_plan_currency'][0]) ) { echo esc_html($aPostCustom['uni_plan_currency'][0]); } ?></small>
                          <strong>
                            <?php if ( isset($aPostCustom['uni_plan_val'][0]) ) { echo esc_html($aPostCustom['uni_plan_val'][0]); } ?>
                        </strong>/<?php if ( !empty($aPostCustom['uni_plan_period'][0]) ) { echo esc_html($aPostCustom['uni_plan_period'][0]); } ?>
                        <?php if ( isset($aPostCustom['uni_plan_tax_info_enable'][0]) && $aPostCustom['uni_plan_tax_info_enable'][0] === 'on'
                        && isset($aPostCustom['uni_plan_tax_info_text'][0]) ) { ?>
                        <?php if ( isset($aPostCustom['uni_plan_tax_info_enable'][0]) && $aPostCustom['uni_plan_tax_info_enable'][0] === 'on' ) { echo '<small class="uniTaxLabel">*</small>'; } ?>
                        <small class="uniTaxInfo"><?php echo esc_html( $aPostCustom['uni_plan_tax_info_text'][0] ); ?></small>
                        <?php } ?>
                    </div>
                    <div class="pricingPlanItemDescWrap" style="min-height: 312px; max-height: 312px;">
                        <?php if ( has_excerpt( get_the_ID() ) ) { the_excerpt(); } else { uni_coworking_theme_excerpt(45, '', true); } ?>
                    </div>
                    <?php
                    $link_enable    = ( isset($aPostCustom['uni_plan_order_button_ext_url_enable'][0]) ) ? $aPostCustom['uni_plan_order_button_ext_url_enable'][0] : 'off';
                    $link_uri       = ( isset($aPostCustom['uni_plan_order_button_uri'][0]) ) ? $aPostCustom['uni_plan_order_button_uri'][0] : '';
                    $link_label     = ( isset($aPostCustom['uni_plan_order_button_label'][0]) ) ? $aPostCustom['uni_plan_order_button_label'][0] : __('Join now', 'coworking');
                    if ( $link_enable === 'on' && ! empty( $link_uri ) ) { ?>
                    <a class="joinNow" href="<?php echo esc_url( $link_uri ) ?>"><?php echo esc_html( $link_label ); ?></a>
                    <?php } else { ?>
                    <a class="joinNow js-price-form-link" data-pricetitle="<?php echo esc_attr( get_the_title( get_the_ID() ) ) ?>" data-priceid="<?php echo esc_attr( get_the_ID() ); ?>" href="#" data-remodal-target="priceForm"><?php echo esc_html( $link_label ); ?></a>
                    <?php } ?>
                </div>

            <?php endwhile; endif;
            wp_reset_postdata();

        } elseif ( ot_get_option( 'uni_home_price_tabels_plans_enable' ) === 'on' &&
            ( ot_get_option( 'uni_home_price_tabels_plans_cobot_enable' ) === 'on' && class_exists( 'Uni_Calendar' ) ) ) {

            $cal_id = intval( ot_get_option( 'uni_home_price_tabels_plans_cobot_cal_id' ) );
            echo do_shortcode('[uni-ec-cobot-plans id="' . $cal_id . '"]');

        } ?>
        
        <?php if ( ot_get_option( 'uni_home_price_tabels_plans_enable' ) === 'on' ) { ?>
    </div>
    <?php } ?>
    
</div>
<?php } ?>



<?php if ( ot_get_option('uni_home_shop_enable') == 'on' && class_exists( 'WooCommerce' ) ) { ?>
<div id="Store" class="homeShop woocommerce">
   <div class="blockTitle"><?php echo ( ot_get_option( 'uni_home_shop_title' ) ) ? esc_html( ot_get_option( 'uni_home_shop_title' ) ) : esc_html_e('Shop', 'coworking'); ?></div>
   <ul class="shopItemsWrap">
    <?php
    $sSortType = esc_attr( ot_get_option( 'uni_home_products_type' ) );
    $iNumberOfProducts =  ( ot_get_option( 'uni_home_products_number' ) ) ? intval(ot_get_option( 'uni_home_products_number' )) : 8;
    switch ( $sSortType ) {
        case 'bestsellers' :
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts'   => 1,
            'orderby' => 'meta_value_num',
            'posts_per_page' => $iNumberOfProducts,
            'meta_query' => array(
                array(
                    'key' => 'total_sales',
                    'compare' => 'EXISTS',
                )
            )
        );
        $oProducts = new WP_Query( $args );
        break;

        case 'random' :
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts'   => 1,
            'orderby' => 'rand',
            'posts_per_page' => $iNumberOfProducts,
            'meta_query' => array(
                array(
                    'key' => '_visibility',
                    'value' => array('catalog', 'visible'),
                    'compare' => 'IN'
                )
            )
        );
        $oProducts = new WP_Query( $args );
        break;

        case 'featured-desc' :
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts'   => 1,
            'orderby' =>'date',
            'order' => 'DESC',
            'posts_per_page' => $iNumberOfProducts,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => '_featured',
                    'value' => 'yes',
                    'compare' => 'EXISTS'
                ),
                array(
                    'key' => '_visibility',
                    'value' => array('catalog', 'visible'),
                    'compare' => 'IN'
                )
            )
        );
        $oProducts = new WP_Query( $args );
        break;

        case 'featured-random' :
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts'   => 1,
            'orderby' =>'rand',
            'posts_per_page' => $iNumberOfProducts,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => '_featured',
                    'value' => 'yes',
                    'compare' => 'EXISTS'
                ),
                array(
                    'key' => '_visibility',
                    'value' => array('catalog', 'visible'),
                    'compare' => 'IN'
                )
            )
        );
        $oProducts = new WP_Query( $args );
        break;

        case 'most-rated' :
        add_filter( 'posts_clauses',  'uni_coworking_theme_order_by_rating_post_clauses' );
        $args = array( 'posts_per_page' => $iNumberOfProducts, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );
        $args['meta_query'] = WC()->query->get_meta_query();
        $oProducts = new WP_Query( $args );
        break;
    }

    if ( $oProducts->have_posts() ) :
        while ( $oProducts->have_posts() ) : $oProducts->the_post();

            wc_get_template_part( 'content', 'product' );

        endwhile; endif;
        if ( $sSortType == 'most-rated' ) { remove_filter( 'posts_clauses', 'uni_coworking_theme_order_by_rating_post_clauses' ); }
        wp_reset_postdata(); ?>

    </ul>

    <a href="<?php echo wc_get_page_permalink( 'shop' ); ?>" class="shopLink">
        <?php echo ( ot_get_option( 'uni_home_shop_goto_link' ) ) ? esc_html( ot_get_option( 'uni_home_shop_goto_link' ) ) : esc_html_e('Go to store', 'coworking'); ?>
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        width="19px" height="9px" viewBox="0 0 19 9" enable-background="new 0 0 19 9" xml:space="preserve">
        <path fill="#FFDD06" d="M18.744,4.242L18.997,4.5l-0.253,0.258V5.03h-0.27L14.578,9l-0.736-0.749l3.16-3.221H-0.003V3.97h17.007
        l-3.162-3.22L14.578,0l3.682,3.75l0,0l0.217,0.22h0.268V4.242z"/>
    </svg>
</a>
</div>
<?php } ?>

<?php if ( ot_get_option('uni_home_events_enable') == 'on' ) { ?>

<div id="Events" class="events">
    <?php
    $iNumberOfEvents    = ( ot_get_option( 'uni_home_events_posts_count' ) ) ? intval( ot_get_option( 'uni_home_events_posts_count' ) ) : 3;
    ?>

    <?php if ( ot_get_option('uni_home_events_tickera_enable') != 'on' ) { ?>

    <?php
    $aChosenEvents      = ( ot_get_option( 'uni_home_events_posts' ) ) ? ot_get_option( 'uni_home_events_posts' ) : array();

      if ( !empty($aChosenEvents) ) {
                        if ( ot_get_option( 'uni_home_events_posts_sorting' ) == 'newer' ) {
                            $aEventsArgs = array(
                                'post_type' => 'uni_event',
                                'post__in' => $aChosenEvents,
                                'order' => 'DESC',
                                'orderby' => 'meta_value',
                                'meta_key' => 'uni_event_date_start',
                                'meta_type' => 'DATE',
                                'posts_per_page' => $iNumberOfEvents
                            );
                        } else if ( ot_get_option( 'uni_home_events_posts_sorting' ) == 'older' ) {
                            $aEventsArgs = array(
                                'post_type' => 'uni_event',
                                'post__in' => $aChosenEvents,
                                'order' => 'ASC',
                                'orderby' => 'meta_value',
                                'meta_key' => 'uni_event_date_start',
                                'meta_type' => 'DATE',
                                'posts_per_page' => $iNumberOfEvents
                            );
                        } else if ( ot_get_option( 'uni_home_events_posts_sorting' ) == 'new_only_newer' ) {
                            $aEventsArgs = array(
                                'post_type' => 'uni_event',
                                'post__in' => $aChosenEvents,
                                'order' => 'DESC',
                                'orderby' => 'meta_value',
                                'meta_query' => array(
                                    array(
                                        'key'     => 'uni_event_date_start',
                                        'value'   => date('Y-m-d', time()),
                                        'compare' => '>=',
                                        'type' => 'DATE',
                                    ),
                                ),
                                'meta_key' => 'uni_event_date_start',
                                'meta_type' => 'DATE',
                                'posts_per_page' => $iNumberOfEvents
                            );
                        } else if ( ot_get_option( 'uni_home_events_posts_sorting' ) == 'new_only_older' ) {
                            $aEventsArgs = array(
                                'post_type' => 'uni_event',
                                'post__in' => $aChosenEvents,
                                'order' => 'ASC',
                                'orderby' => 'meta_value',
                                'meta_query' => array(
                                    array(
                                        'key'     => 'uni_event_date_start',
                                        'value'   => date('Y-m-d', time()),
                                        'compare' => '>=',
                                        'type' => 'DATE',
                                    ),
                                ),
                                'meta_key' => 'uni_event_date_start',
                                'meta_type' => 'DATE',
                                'posts_per_page' => $iNumberOfEvents
                            );
                        } else {
                            $aEventsArgs = array(
                                'post_type' => 'uni_event',
                                'post__in' => $aChosenEvents,
                                'posts_per_page' => $iNumberOfEvents
                            );
                        }
                    } else {
                        if ( ot_get_option( 'uni_home_events_posts_sorting' ) == 'newer' ) {
                            $aEventsArgs = array(
                                'post_type' => 'uni_event',
                                'order' => 'DESC',
                                'orderby' => 'meta_value',
                                'meta_key' => 'uni_event_date_start',
                                'meta_type' => 'DATE',
                                'posts_per_page' => $iNumberOfEvents
                            );
                        } else if ( ot_get_option( 'uni_home_events_posts_sorting' ) == 'older' ) {
                            $aEventsArgs = array(
                                'post_type' => 'uni_event',
                                'order' => 'ASC',
                                'orderby' => 'meta_value',
                                'meta_key' => 'uni_event_date_start',
                                'meta_type' => 'DATE',
                                'posts_per_page' => $iNumberOfEvents
                            );
                        } else if ( ot_get_option( 'uni_home_events_posts_sorting' ) == 'new_only_newer' ) {
                            $aEventsArgs = array(
                                'post_type' => 'uni_event',
                                'order' => 'DESC',
                                'orderby' => 'meta_value',
                                'meta_query' => array(
                                    array(
                                        'key'     => 'uni_event_date_start',
                                        'value'   => date('Y-m-d', time()),
                                        'compare' => '>=',
                                        'type' => 'DATE',
                                    ),
                                ),
                                'meta_key' => 'uni_event_date_start',
                                'meta_type' => 'DATE',
                                'posts_per_page' => $iNumberOfEvents
                            );
                        } else if ( ot_get_option( 'uni_home_events_posts_sorting' ) == 'new_only_older' ) {
                            $aEventsArgs = array(
                                'post_type' => 'uni_event',
                                'order' => 'ASC',
                                'orderby' => 'meta_value',
                                'meta_query' => array(
                                    array(
                                        'key'     => 'uni_event_date_start',
                                        'value'   => date('Y-m-d', time()),
                                        'compare' => '>=',
                                        'type' => 'DATE',
                                    ),
                                ),
                                'meta_key' => 'uni_event_date_start',
                                'meta_type' => 'DATE',
                                'posts_per_page' => $iNumberOfEvents
                            );
                        } else {
                            $aEventsArgs = array(
                                'post_type' => 'uni_event',
                                'posts_per_page' => $iNumberOfEvents
                            );
                        }
                    }
                    ?>


<?php } else if ( ot_get_option('uni_home_events_tickera_enable') == 'on' && class_exists( 'TC' ) ) { // Tickera events ?>

<?php
$aChosenEvents      = ( ot_get_option( 'uni_home_events_posts_tickera' ) ) ? ot_get_option( 'uni_home_events_posts_tickera' ) : array();

if ( !empty($aChosenEvents) ) {
    if ( ot_get_option( 'uni_home_events_posts_sorting' ) == 'newer' ) {
        $aEventsArgs = array(
            'post_type' => 'tc_events',
            'post_status' => 'publish',
            'post__in' => $aChosenEvents,
            'order' => 'DESC',
            'orderby' => 'meta_value',
            'meta_key' => 'event_date_time',
            'meta_type' => 'DATETIME',
            'posts_per_page' => $iNumberOfEvents
        );
    } else if ( ot_get_option( 'uni_home_events_posts_sorting' ) == 'older' ) {
        $aEventsArgs = array(
            'post_type' => 'tc_events',
            'post_status' => 'publish',
            'post__in' => $aChosenEvents,
            'order' => 'ASC',
            'orderby' => 'meta_value',
            'meta_key' => 'event_date_time',
            'meta_type' => 'DATETIME',
            'posts_per_page' => $iNumberOfEvents
        );
    } else if ( ot_get_option( 'uni_home_events_posts_sorting' ) == 'new_only_newer' ) {
        $aEventsArgs = array(
            'post_type' => 'tc_events',
            'post_status' => 'publish',
            'post__in' => $aChosenEvents,
            'order' => 'DESC',
            'orderby' => 'meta_value',
            'meta_query' => array(
              array(
               'key'     => 'event_date_time',
               'value'   => date('Y-m-d H:i', time()),
               'compare' => '>=',
               'type' => 'DATETIME',
           ),
          ),
            'meta_key' => 'event_date_time',
            'meta_type' => 'DATETIME',
            'posts_per_page' => $iNumberOfEvents
        );
    } else if ( ot_get_option( 'uni_home_events_posts_sorting' ) == 'new_only_older' ) {
        $aEventsArgs = array(
            'post_type' => 'tc_events',
            'post_status' => 'publish',
            'post__in' => $aChosenEvents,
            'order' => 'ASC',
            'orderby' => 'meta_value',
            'meta_query' => array(
              array(
               'key'     => 'event_date_time',
               'value'   => date('Y-m-d H:i', time()),
               'compare' => '>=',
               'type' => 'DATETIME',
           ),
          ),
            'meta_key' => 'event_date_time',
            'meta_type' => 'DATETIME',
            'posts_per_page' => $iNumberOfEvents
        );
    } else {
        $aEventsArgs = array(
            'post_type' => 'tc_events',
            'post_status' => 'publish',
            'post__in' => $aChosenEvents,
            'posts_per_page' => $iNumberOfEvents
        );
    }
} else {
    if ( ot_get_option( 'uni_home_events_posts_sorting' ) == 'newer' ) {
        $aEventsArgs = array(
            'post_type' => 'tc_events',
            'post_status' => 'publish',
            'order' => 'DESC',
            'orderby' => 'meta_value',
            'meta_key' => 'event_date_time',
            'meta_type' => 'DATETIME',
            'posts_per_page' => $iNumberOfEvents
        );
    } else if ( ot_get_option( 'uni_home_events_posts_sorting' ) == 'older' ) {
        $aEventsArgs = array(
            'post_type' => 'tc_events',
            'post_status' => 'publish',
            'order' => 'ASC',
            'orderby' => 'meta_value',
            'meta_key' => 'event_date_time',
            'meta_type' => 'DATETIME',
            'posts_per_page' => $iNumberOfEvents
        );
    } else if ( ot_get_option( 'uni_home_events_posts_sorting' ) == 'new_only_newer' ) {
        $aEventsArgs = array(
            'post_type' => 'tc_events',
            'post_status' => 'publish',
            'order' => 'DESC',
            'orderby' => 'meta_value',
            'meta_query' => array(
              array(
               'key'     => 'event_date_time',
               'value'   => date('Y-m-d H:i', time()),
               'compare' => '>=',
               'type' => 'DATETIME',
           ),
          ),
            'meta_key' => 'event_date_time',
            'meta_type' => 'DATETIME',
            'posts_per_page' => $iNumberOfEvents
        );
    } else if ( ot_get_option( 'uni_home_events_posts_sorting' ) == 'new_only_older' ) {
        $aEventsArgs = array(
            'post_type' => 'tc_events',
            'post_status' => 'publish',
            'order' => 'ASC',
            'orderby' => 'meta_value',
            'meta_query' => array(
              array(
               'key'     => 'event_date_time',
               'value'   => date('Y-m-d H:i', time()),
               'compare' => '>=',
               'type' => 'DATETIME',
           ),
          ),
            'meta_key' => 'event_date_time',
            'meta_type' => 'DATETIME',
            'posts_per_page' => $iNumberOfEvents
        );
    } else {
        $aEventsArgs = array(
            'post_type' => 'tc_events',
            'post_status' => 'publish',
            'posts_per_page' => $iNumberOfEvents
        );
    }
}
?>
<?php } ?>

<ul class="eventsBgSlider">
    <?php
    $oEventsQuery = new wp_query( $aEventsArgs );
    if ( $oEventsQuery->have_posts() ) :
        while ( $oEventsQuery->have_posts() ) : $oEventsQuery->the_post();
            if ( get_post_meta($post->ID, 'uni_event_events_page_bg', true) ) {
                $aEventBg = wp_get_attachment_image_src( get_post_meta($post->ID, 'uni_event_events_page_bg', true), 'full' );
                $sEventBgUrl = $aEventBg[0];
                ?>
                <li style="background-image: url('<?php echo get_bloginfo('template_directory'); ?>/images/edit-eventos.jpg');"><div class="eventSlideOverlay"></div></li>
                <?php
            } else {
                ?>
                <li style="background-image: url('<?php echo get_bloginfo('template_directory'); ?>/images/edit-eventos.jpg');"><div class="eventSlideOverlay"></div></li>
                <?php
            }
        endwhile;
    endif;
    ?>
</ul>
<div class="eventsContentWrap">
    <div class="blockTitle"><?php echo ( ot_get_option( 'uni_home_events_title' ) ) ? esc_html( ot_get_option( 'uni_home_events_title' ) ) : esc_html_e('upcoming events', 'coworking'); ?></div>
    <div class="eventsWrap">

        <?php if ( ot_get_option('uni_home_events_tickera_enable') != 'on' ) { ?>
        <?php
        if ( $oEventsQuery->have_posts() ) :
            $iEventCount = 0;
            while ( $oEventsQuery->have_posts() ) : $oEventsQuery->the_post();
                $aCustomData = get_post_custom( $post->ID );
                ?>

                <a class="eventItem" style="text-decoration: none; display: block;" href="<?php echo the_permalink() ?>" data-slide-id="<?php echo esc_attr($iEventCount); ?>" class="eventItem eventItemSimply">
                    <div class="eventTime">
                        <strong><?php

                        if ( !empty($aCustomData['uni_event_time_start'][0]) && !empty($aCustomData['uni_event_time_start'][0])
                            && $aCustomData['uni_event_date_start'][0] == $aCustomData['uni_event_date_end'][0] ) {

                           $iEventDatestamp = strtotime($aCustomData['uni_event_date_start'][0]);
                       echo date_i18n($sDateFormat, $iEventDatestamp);

                   } else if ( !empty($aCustomData['uni_event_date_start'][0]) && !empty($aCustomData['uni_event_date_end'][0])
                    && $aCustomData['uni_event_date_start'][0] != $aCustomData['uni_event_date_end'][0] ) {
                    $iDateStartTimestamp = strtotime($aCustomData['uni_event_date_start'][0]);
                    $iDateEndTimestamp = strtotime($aCustomData['uni_event_date_end'][0]);
                    echo sprintf( esc_html__('%1$s%2$s', 'coworking'), date_i18n($sDateFormat, $iDateStartTimestamp), ',<br>');
                    echo sprintf( esc_html__('%1$s%2$s', 'coworking'), date_i18n($sDateFormat, $iDateEndTimestamp), '');
                } else if ( !empty($aCustomData['uni_event_date_start'][0]) && empty($aCustomData['uni_event_date_end'][0]) )  {

                    $iDateStartTimestamp = strtotime($aCustomData['uni_event_date_start'][0]);
                    echo date_i18n($sDateFormat, $iDateStartTimestamp);
                } else {
                    esc_html_e('- not specified -', 'coworking');
                } ?>
            </strong>
            <p>
                <?php if ( !empty($aCustomData['uni_event_time_start'][0]) ) { $iEventTimeStartstamp = strtotime($aCustomData['uni_event_time_start'][0]); echo date_i18n($sTimeFormat, $iEventTimeStartstamp); 
            } ?>
            <?php if ( !empty($aCustomData['uni_event_time_end'][0]) ) { $iEventTimeEndstamp = strtotime($aCustomData['uni_event_time_end'][0]); echo ' &ndash; ' . date_i18n($sTimeFormat, $iEventTimeEndstamp); } ?>
        </p>
    </div>

    <h3><?php echo the_title() ?></h3>
    <div href="<?php echo the_permalink() ?>" class="attendBtn">
        <?php echo ( ot_get_option( 'uni_home_events_event_link_text' ) ) ? esc_html( ot_get_option( 'uni_home_events_event_link_text' ) ) : esc_html_e('attend', 'coworking'); ?>
        <svg version="1.1" id="attendBtn_<?php echo esc_attr($iEventCount); ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            width="19px" height="9px" viewBox="0 0 19 9" enable-background="new 0 0 19 9" xml:space="preserve">
            <path fill="#FFDD06" d="M18.744,4.242L18.997,4.5l-0.253,0.258V5.03h-0.27L14.578,9l-0.736-0.749l3.16-3.221H-0.003V3.97h17.007
            l-3.162-3.22L14.578,0l3.682,3.75l0,0l0.217,0.22h0.268V4.242z"/>
        </svg>
    </div>
</a>
<?php
$iEventCount++;
endwhile;
endif;
?>

<?php } else if ( ot_get_option('uni_home_events_tickera_enable') == 'on' && class_exists( 'TC' ) ) { // Tickera events ?>

<?php
if ( $oEventsQuery->have_posts() ) :
    $iEventCount = 0;
    while ( $oEventsQuery->have_posts() ) : $oEventsQuery->the_post();
        $aCustomData = get_post_custom( $post->ID );
        ?>
        <div data-slide-id="<?php echo esc_attr($iEventCount); ?>" class="eventItem">
            <div class="eventTime">
                <strong><?php if ( !empty($aCustomData['event_date_time'][0]) ) { $iEventDatestamp = strtotime($aCustomData['event_date_time'][0]); echo date_i18n($sDateAndTimeFormat, $iEventDatestamp); } else { esc_html_e('- not specified -', 'coworking'); } ?></strong>
                <strong><?php if ( !empty($aCustomData['event_end_date_time'][0]) ) { $iEventEndDatestamp = strtotime($aCustomData['event_end_date_time'][0]); echo date_i18n($sDateAndTimeFormat, $iEventEndDatestamp); } ?></strong>
            </div>
            <h3><?php echo the_title() ?></h3>
            <a href="<?php echo the_permalink() ?>" class="attendBtn">
                <?php echo ( ot_get_option( 'uni_home_events_event_link_text' ) ) ? esc_html( ot_get_option( 'uni_home_events_event_link_text' ) ) : esc_html_e('attend', 'coworking'); ?>
                <svg version="1.1" id="Layer_3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                width="19px" height="9px" viewBox="0 0 19 9" enable-background="new 0 0 19 9" xml:space="preserve">
                <path fill="#FFDD06" d="M18.744,4.242L18.997,4.5l-0.253,0.258V5.03h-0.27L14.578,9l-0.736-0.749l3.16-3.221H-0.003V3.97h17.007
                l-3.162-3.22L14.578,0l3.682,3.75l0,0l0.217,0.22h0.268V4.242z"/>
            </svg>
        </a>
    </div>
    <?php
    $iEventCount++;
endwhile;
endif;
?>

<?php } ?>

</div>
<?php  if ( $oEventsQuery->have_posts() ) : ?>

    <a href="<?php if ( ot_get_option( 'uni_home_events_archive_page' ) ) echo esc_url( get_permalink( ot_get_option( 'uni_home_events_archive_page' ) ) ); ?>" class="allEventsBtn">
        <?php echo ( ot_get_option( 'uni_home_events_archive_page_link_text' ) ) ? esc_html( ot_get_option( 'uni_home_events_archive_page_link_text' ) ) : esc_html_e('See all events', 'coworking'); ?></a>
    <?php else: ?>
        <style type="text/css">
        .eventsContentWrap .blockTitle:first-child {
            display: none;
        }
    </style>
    <div class="blockTitle" style="color:#333333; line-height: 80px;"><?php echo ( ot_get_option( 'uni_home_events_title' ) ) ? esc_html( ot_get_option( 'uni_home_events_title' ) ) : esc_html_e('upcoming events', 'coworking'); ?></div>
    <a href="" style="color: #333333; pointer-events: none;"  class="allEventsBtn">
    De momento não há eventos agendados</a>
<?php endif; ?>
</div>
</div>
<?php } ?>

<?php if ( ot_get_option('uni_home_blog_enable') == 'on' ) { ?>
<div id="Blog" class="blogWrap">
    <div class="blockTitle"><?php echo ( ot_get_option( 'uni_home_blog_title' ) ) ? esc_html( ot_get_option( 'uni_home_blog_title' ) ) : esc_html_e('Blog', 'coworking'); ?></div>
    <div class="uni-clear js-uni-animated">
        <?php
        $iBlogPostsPerPage = ( ot_get_option( 'uni_home_blog_posts_count' ) ) ? ot_get_option( 'uni_home_blog_posts_count' ) : 3;
        $aBlogArgs = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page' => $iBlogPostsPerPage,
        );

        $oBlogQuery = new WP_Query( $aBlogArgs );
        if ( $oBlogQuery->have_posts() ) :
            while ( $oBlogQuery->have_posts() ) : $oBlogQuery->the_post();
                $sAdditionalPostClasses = 'postItem uni-no-featured-image';
                if ( has_post_thumbnail() ) {
                    $sAdditionalPostClasses = 'postItem';
                }
                ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class( $sAdditionalPostClasses ); ?>>
                    <?php if ( has_post_thumbnail() ) { ?>
                    <a href="<?php the_permalink() ?>" class="postItemImg">
                        <?php the_post_thumbnail( 'unithumb-coworking-relativepost', array( 'alt' => the_title_attribute('echo=0') ) ); ?>
                    </a>
                    <?php } ?>
                    <div class="postItemMeta">
                        <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
                    </div>
                    <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                    <?php if ( has_excerpt( $post->ID ) ) { the_excerpt(); } else { uni_coworking_theme_excerpt(12, '', true); } ?>
                </div>
            <?php endwhile; endif;
            wp_reset_postdata(); ?>

            <?php if ( ot_get_option( 'uni_home_blog_page_link_enable' ) != 'off' ) { ?>

        </div>
        <a href="<?php if ( ot_get_option( 'uni_home_blog_goto_link' ) ) echo esc_url( get_permalink( ot_get_option( 'uni_home_blog_goto_link' ) ) ); ?>" class="blogLink">
         <?php echo ( ot_get_option( 'uni_home_blog_goto_link_text' ) ) ? esc_html( ot_get_option( 'uni_home_blog_goto_link_text' ) ) : esc_html_e('Go to blog', 'coworking'); ?>
         <svg fill version="1.1" id="Layer_4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         width="19px" height="9px" viewBox="0 0 19 9" enable-background="new 0 0 19 9" xml:space="preserve">
         <path fill="#FFDD06" d="M18.744,4.242L18.997,4.5l-0.253,0.258V5.03h-0.27L14.578,9l-0.736-0.749l3.16-3.221H-0.003V3.97h17.007
         l-3.162-3.22L14.578,0l3.682,3.75l0,0l0.217,0.22h0.268V4.242z"/>
     </svg>
 </a>
 <?php } ?>
</div>
<?php } ?>

<?php if ( ot_get_option('uni_home_contact_enable') == 'on' ) { ?>
<div id="Contact" class="homeContact uni-clear">
    <div class="uni-location-map">
        <!-- Map -->
        <script type="text/javascript">
                    // Coworking style
                        //Standard
                        var coworkingDefaultGoogleMap = [];
                        
                        //Shades of Grey
                        var coworkingShadesOfGrey = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}];

                        // Cartoon
                        var coworkingCartoon = [{ "featureType": "landscape", "stylers": [ { "visibility": "off" } ]},{ "featureType": "transit", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "elementType": "labels", "stylers": [ { "visibility": "off" }]},{ "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [ { "color": "#d3d3d3" }, { "visibility": "on" } ]},{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ]},{ "featureType": "landscape", "stylers": [ { "visibility": "on" }, { "color": "#b1bc39" } ]},{ "featureType": "landscape.man_made", "stylers": [ { "visibility": "on" }, { "color": "#ebad02" } ]},{ "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#416d9f" } ]},{ "featureType": "road", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#000000" } ]},{ "featureType": "road", "elementType": "labels.text.stroke", "stylers": [ { "visibility": "off" }, { "color": "#ffffff" } ]},{ "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#000000" } ]},{ "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#ffffff" } ]},{ "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ]},{ "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi", "elementType": "geometry.fill", "stylers": [ { "color": "#ebad02" } ]},{ "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [ { "color": "#8ca83c" } ]}];

                        // Grey Scale
                        var coworkingGrey = [{ "featureType": "road.highway", "stylers": [ { "visibility": "off" } ]},{ "featureType": "landscape", "stylers": [ { "visibility": "off" } ]},{ "featureType": "transit", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "stylers": [ { "visibility": "on" } ]},{ "featureType": "poi.park", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [ { "color": "#d3d3d3" }, { "visibility": "on" } ]},{ "featureType": "poi.medical", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.medical", "stylers": [ { "visibility": "off" } ]},{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "color": "#cccccc" } ]},{ "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#cecece" } ]},{ "featureType": "road.local", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#808080" } ]},{ "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#808080" } ]},{ "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#fdfdfd" } ]},{ "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ]},{ "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi", "elementType": "geometry.fill", "stylers": [ { "color": "#d2d2d2" } ]}];

                        // Black & White
                        var coworkingBlackWhite = [{ "featureType": "road.highway", "stylers": [ { "visibility": "off" } ]},{ "featureType": "landscape", "stylers": [ { "visibility": "off" } ]},{ "featureType": "transit", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "elementType": "geometry.fill",  "stylers": [ { "color": "#d3d3d3" }, { "visibility": "on" } ]},{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ]},{ "featureType": "landscape", "stylers": [ { "visibility": "on" }, { "color": "#ffffff" } ]},{ "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#cecece" } ]},{ "featureType": "road", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#000000" } ]},{ "featureType": "road", "elementType": "labels.text.stroke", "stylers": [ { "visibility": "on" }, { "color": "#ffffff" } ]},{ "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#000000" } ]},{ "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#000000" } ]},{ "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ]},{ "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi", "elementType": "geometry.fill", "stylers": [ { "visibility": "off" } ]}];

                        // Retro
                        var coworkingRetro = [{ "featureType": "transit", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [ { "color": "#d3d3d3" }, { "visibility": "on" } ]},{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ]},{ "featureType": "landscape", "stylers": [ { "visibility": "on" }, { "color": "#eee8ce" } ]},{ "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#b8cec9" } ]},{ "featureType": "road", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#000000" } ]},{ "featureType": "road", "elementType": "labels.text.stroke", "stylers": [ { "visibility": "off" }, { "color": "#ffffff" } ]},{ "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#000000" } ]},{ "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#ffffff" } ]},{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ]},{ "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ]},{ "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi", "elementType": "geometry.fill", "stylers": [ { "color": "#d3cdab" } ]},{ "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [ { "color": "#ced09d" } ]},{ "featureType": "poi", "elementType": "labels", "stylers": [ { "visibility": "off" } ]}];

                        // Night
                        var coworkingNight = [{ "featureType": "landscape", "stylers": [ { "visibility": "off" } ]},{ "featureType": "transit", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [ { "color": "#d3d3d3" }, { "visibility": "on" } ]},{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ]},{ "featureType": "landscape", "stylers": [ { "visibility": "on" }, {  "hue": "#0008ff" }, { "lightness": -75 }, { "saturation": 10 } ]},{ "elementType": "geometry.stroke", "stylers": [ { "color": "#1f1d45" } ]},{ "featureType": "landscape.natural", "stylers": [ { "color": "#1f1d45" } ]},{ "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#01001f" } ]},{ "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#e7e8ec" } ]},{ "elementType": "labels.text.stroke", "stylers": [ { "visibility": "on" }, { "color": "#151348" } ]},{ "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#f7fdd9" } ]},{ "featureType": "administrative", "elementType": "labels.text.stroke", "stylers": [ { "visibility": "on" }, { "color": "#01001f" } ]},{ "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#316694" } ]},{ "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ]},{ "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi", "elementType": "geometry.fill", "stylers": [ { "color": "#1a153d" } ]}];

                        // Night Light
                        var coworkingNightLight = [{"elementType": "geometry", "stylers": [ { "visibility": "on" }, { "hue": "#232a57" } ]},{ "featureType": "road.highway", "stylers": [ { "visibility": "off" } ]},{ "featureType": "landscape", "elementType": "geometry.fill", "stylers": [ { "hue": "#0033ff" }, { "saturation": 13 }, { "lightness":-77 } ]},{ "featureType": "landscape", "elementType": "geometry.stroke", "stylers": [ { "color": "#4657ab" } ]},{ "featureType": "transit", "stylers": [ { "visibility": "off" } ]},{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ]},{ "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#0d0a1f" } ]},{ "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#d2cfe3" } ]},{ "elementType": "labels.text.stroke", "stylers": [ { "visibility": "on" }, { "color": "#0d0a1f" } ]},{ "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#ffffff" } ]},{ "featureType": "administrative", "elementType": "labels.text.stroke", "stylers": [ { "visibility": "on" }, { "color": "#0d0a1f" } ]},{ "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#ff9910" } ]},{ "featureType": "road.local", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#4657ab" } ]},{ "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ]},{ "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi", "elementType": "geometry.fill", "stylers": [ { "color": "#232a57" } ]},{ "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [ { "color": "#232a57" } ]},{ "featureType": "poi", "elementType": "labels", "stylers": [ { "visibility": "off" } ]}];

                        // Papiro
                        var coworkingPapiro = [{"elementType": "geometry", "stylers": [ { "visibility": "on" }, { "color": "#f2e48c" } ]},{ "featureType": "road.highway", "stylers": [ { "visibility": "off" } ]},{ "featureType": "transit", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "elementType": "geometry.fill",  "stylers": [ { "color": "#d3d3d3" }, { "visibility": "on" } ]},{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ]},{ "featureType": "landscape", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#f2e48c" } ]},{ "featureType": "landscape", "elementType": "geometry.stroke", "stylers": [ { "visibility": "on" }, { "color": "#592c00" } ]},{ "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#a77637" } ]},{ "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#592c00" } ]},{ "elementType": "labels.text.stroke", "stylers": [ { "visibility": "on" }, { "color": "#f2e48c" } ]},{ "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#592c00" } ]},{ "featureType": "administrative", "elementType": "labels.text.stroke", "stylers": [ { "visibility": "on" }, { "color": "#f2e48c" } ]},{ "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#a5630f" } ]},{ "featureType": "road.highway", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#592c00" } ]},{ "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ]},{ "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi", "elementType": "geometry.fill", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi", "elementType": "labels", "stylers": [ { "visibility": "off" } ]}];

                        var Coworking;
                        <?php if ( ot_get_option('uni_home_contact_map_styles') ) { ?>
                            Coworking = <?php echo ot_get_option('uni_home_contact_map_styles') ?>;
                            <?php } else { ?>
                                Coworking = coworkingShadesOfGrey;
                                <?php } ?>

                                function initialize() {

                        // Declare new style
                        var CoworkingstyledMap = new google.maps.StyledMapType(Coworking, {name: "Coworking"});

                        // Declare Map options
                        var mapOptions = {
                         center: new google.maps.LatLng(<?php $sCoord = ( ot_get_option( 'uni_home_contact_coordinates' ) ) ? ot_get_option( 'uni_home_contact_coordinates' ) : '41.404182,2.199451'; echo esc_attr( $sCoord ); ?>),
                         zoom: <?php echo ( ot_get_option( 'uni_home_contact_zoom' ) ) ? esc_attr(ot_get_option( 'uni_home_contact_zoom' )) : '14'; ?>,
                         scrollwheel: false,
                         mapTypeControl:false,
                         streetViewControl: false,
                         panControl:false,
                         rotateControl:false,
                         zoomControl:true
                     };

                        // Create map
                        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

                        // Setup skin for the map
                        map.mapTypes.set('Coworking_style', CoworkingstyledMap);
                        map.setMapTypeId('Coworking_style');

                        //add marker
                        var marker_icon = {
                            path: 'M19-5C6.866-5-3,4.966-3,17.214c0,2.233,0.332,4.388,0.941,6.419 c2.523,12.103,17.896,30.404,20.013,32.887C18.217,56.827,18.602,57,19,57c0.049,0,0.096,0,0.145-0.007 c0.372-0.04,0.708-0.227,0.935-0.517l0.083-0.104c4.704-5.628,17.608-21.826,19.901-32.761C40.677,21.588,41,19.439,41,17.214 C41,4.966,31.126-5,19-5 M19,26.169c-4.928,0-8.938-4.016-8.938-8.956c0-1.666,0.461-3.236,1.264-4.58 c0.799-1.351,1.947-2.473,3.322-3.237C15.934,8.673,17.425,8.261,19,8.261c1.589,0,3.087,0.419,4.381,1.156 c1.365,0.764,2.508,1.887,3.304,3.237c0.799,1.336,1.255,2.9,1.255,4.559C27.939,22.154,23.929,26.169,19,26.169',
                            fillColor: '<?php echo ( ot_get_option( 'uni_home_contact_marker_colour' ) ) ? esc_attr(ot_get_option( 'uni_home_contact_marker_colour' )) : '#ffffff'; ?>',
                            fillOpacity: 1,
                            scale: 1,
                            anchor: new google.maps.Point(19,57),
                            strokeWeight: 0
                        };

                        var myLatLng = new google.maps.LatLng(<?php echo esc_attr( $sCoord ) ?>);
                        var beachMarker = new google.maps.Marker({
                           position: myLatLng,
                           map: map,
                           icon: marker_icon
                       });

                    }
                    google.maps.event.addDomListener(window, 'load', initialize);
                </script>

                <div class="uni-map-canvas" id="map-canvas"></div>
            </div>
            <div class="contactInfo">
               <div class="contactInfoDesc js-uni-animated">
                   <h3><?php echo ( ot_get_option( 'uni_home_contact_title' ) ) ? esc_html( ot_get_option( 'uni_home_contact_title' ) ) : esc_html_e('Come & visit', 'coworking'); ?></h3>

                   <?php echo ot_get_option('uni_home_contact_address'); ?>

                   <?php if ( ot_get_option( 'uni_home_contact_phone' ) ) {
                    $sHomeContactPhone = ot_get_option( 'uni_home_contact_phone' );
                    ?>
                    <p><?php esc_html_e('Telefone', 'coworking'); ?>: <br> <?php echo wp_kses( $sHomeContactPhone, $aUniAllowedHtmlWoA ); ?></p>
                    <?php } ?>

                    <?php if ( ot_get_option( 'uni_home_contact_email_display' ) && ot_get_option( 'uni_home_contact_email_display' ) == 'on' ) {
                        if ( ot_get_option( 'uni_contact_email' ) ) {
                            $sEmail = sanitize_email( ot_get_option( 'uni_contact_email' ) );
                        } else {
                            $sEmail = esc_attr( get_bloginfo('admin_email') );
                        }
                        ?>
                        <p><?php esc_html_e('Email', 'coworking'); ?>: <br> <a href="mailto:<?php echo antispambot( $sEmail ); ?>"><?php echo antispambot( $sEmail ); ?></a></p>
                        <?php } ?>
                        <p>Para mais informações ou marcações:<br>
                            Noémi Lomelino<br>
                            Community &amp; Operations Manager<br>
                            <a href="mailto: noemi.lomelino@edit.work">noemi.lomelino@edit.work </a></p>
                            <?php ?>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if ( ot_get_option('uni_home_subscribe_enable') == 'on' ) { ?>
                <div class="subscribeBox">
                    <i class="subscribeIcon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="26" viewBox="0 0 36 26">
                            <path fill="#FFDD06" d="M35.918 2.52c-.205-.895-.816-1.667-1.596-2.114C33.832.162 33.3 0 32.73 0H3.272C2.7 0 2.17.162 1.678.406.86.853.288 1.626.082 2.52.042 2.76 0 3.005 0 3.25v19.5C0 24.537 1.473 26 3.272 26h29.455c1.8 0 3.272-1.463 3.272-3.25V3.25c0-.244-.042-.488-.082-.73zm-5.893.73L18 12.31 5.973 3.25h24.052zm2.704 19.5H3.272V5.322l13.746 10.36c.285.203.653.324.98.324s.695-.12.98-.324l13.75-10.36V22.75z"/>
                        </svg>         
                    </i>
                    <h3><?php echo ( ot_get_option( 'uni_home_subscribe_title' ) ) ? esc_html( ot_get_option( 'uni_home_subscribe_title' ) ) : esc_html_e('Subscribe to our newsletter', 'coworking'); ?></h3>
                    <div id="footer-sidebar" class="secondary">
                        <div id="footer-sidebar1">
                            <?php
                            if(is_active_sidebar('footer-sidebar-1')){
                                dynamic_sidebar('footer-sidebar-1');
                            }
                            ?>
                        </div>
                    </div>

                </div>
                <?php } ?>

                <?php if ( ot_get_option('uni_home_instagram_enable') == 'on' ) { ?>
                <div class="instagramBox">
                    <div class="instagramHashtag">
                        <h3>
                            <?php $sInstagramTitle = ot_get_option( 'uni_home_instagram_url' ); ?>
                            <a href="<?php if ( !empty($sInstagramTitle) ) { echo esc_url($sInstagramTitle); } else { echo '#'; } ?>" target="_blank">
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