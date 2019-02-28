<?php
/*
*  Template Name: Membership Plans
*/
get_header();
?>

    <section class="uni-container">

    <?php if (have_posts()) : while (have_posts()) : the_post();
		$aPostCustom = get_post_custom( $post->ID );
    ?>
    <?php
        // background
        if ( !empty($aPostCustom['uni_plans_page_header_bg'][0]) ) {
            $iHeaderImageAttachId = intval($aPostCustom['uni_plans_page_header_bg'][0]);
            $aPageHeaderImage = wp_get_attachment_image_src( $iHeaderImageAttachId, 'full' );
            $sPageHeaderImage = $aPageHeaderImage[0];
        } else {
            $sPageHeaderImage = 'http://placehold.it/1920x600';
        }
    ?>


		<div class="pageHeaderImg" style="background-image: url(<?php echo esc_url($sPageHeaderImage) ?>); ?>);">
			<h1><?php the_title() ?></h1>
		</div>
		
		<div class="uniPricing <?php if ( 'on' !== $calendarius_int_enable || ! isset($aPostCustom['uni_plans_cal_id'][0]) ) { echo "uniPricingCobot"; } ?>">
            <div class="wrapper">
            <?php
            $calendarius_int_enable = ( isset($aPostCustom['uni_plans_calendarius_cobot_plans_enable'][0]) ) ? $aPostCustom['uni_plans_calendarius_cobot_plans_enable'][0] : 'off';

            if ( 'on' !== $calendarius_int_enable || ! isset($aPostCustom['uni_plans_cal_id'][0]) ) {

            $chosen_plans = ( isset($aPostCustom['uni_plans_posts'][0]) ) ? maybe_unserialize( $aPostCustom['uni_plans_posts'][0] ) : array();
            if ( ! empty($chosen_plans) ) {
                $plans_posts_args = array(
                    'post_type'	=> 'uni_price_plan',
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => 1,
                    'post__in' => $chosen_plans,
                    'posts_per_page' => -1
                );
            } else {
                $plans_posts_args = array(
                    'post_type'	=> 'uni_price_plan',
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => 1,
                    'posts_per_page' => -1
                );
            }

            $plans_query = new WP_Query( $plans_posts_args );
            if ( $plans_query->have_posts() ) :
            while ( $plans_query->have_posts() ) : $plans_query->the_post();
                $aPostCustom = get_post_custom( get_the_ID() );

                if ( has_post_thumbnail( get_the_ID() ) ) {
                    $plan_thumb = get_the_post_thumbnail( get_the_ID(), 'unithumb-coworking-planthumb' );
                } else {
                    $plan_thumb = '<img src="http://placehold.it/470x382" alt="' . esc_attr( get_the_title( get_the_ID() ) ) . '">';
                }
            ?>
                <div class="uniPricingItem uni-clear">
                    <div class="fcell">
                        <?php echo $plan_thumb; ?>
                    </div>
                    <div class="scell">
                        <h3><?php the_title() ?></h3>
                        <div class="uniPricingItemPrice">
                            <span><?php if ( !empty($aPostCustom['uni_plan_currency'][0]) ) { echo esc_html($aPostCustom['uni_plan_currency'][0]); } ?></span>
                            <strong><?php if ( isset($aPostCustom['uni_plan_val'][0]) ) { echo esc_html($aPostCustom['uni_plan_val'][0]); } ?></strong>
                            /<?php if ( !empty($aPostCustom['uni_plan_period'][0]) ) { echo esc_html($aPostCustom['uni_plan_period'][0]); } ?>
                            <?php if ( isset($aPostCustom['uni_plan_tax_info_enable'][0]) && $aPostCustom['uni_plan_tax_info_enable'][0] === 'on'
                                && isset($aPostCustom['uni_plan_tax_info_text'][0]) ) { ?>
                            *
                            <?php } ?>
                        </div>
                        <?php if ( has_excerpt( get_the_ID() ) ) { the_excerpt(); } else { uni_coworking_theme_excerpt(45, '', true); } ?>
                        <?php if ( isset($aPostCustom['uni_plan_tax_info_enable'][0]) && $aPostCustom['uni_plan_tax_info_enable'][0] === 'on'
                                && isset($aPostCustom['uni_plan_tax_info_text'][0]) ) { ?>
                        <small>*<?php echo esc_html($aPostCustom['uni_plan_tax_info_text'][0]) ?></small>
                        <?php } ?>

                        <?php
                        $link_enable    = ( isset($aPostCustom['uni_plan_order_button_ext_url_enable'][0]) ) ? $aPostCustom['uni_plan_order_button_ext_url_enable'][0] : 'off';
                        $link_uri       = ( isset($aPostCustom['uni_plan_order_button_uri'][0]) ) ? $aPostCustom['uni_plan_order_button_uri'][0] : '';
                        $link_label     = ( isset($aPostCustom['uni_plan_order_button_label'][0]) ) ? $aPostCustom['uni_plan_order_button_label'][0] : __('Join now', 'coworking');
                        if ( $link_enable === 'on' && ! empty( $link_uri ) ) { ?>
                        <a class="uniPricingItemLink" href="<?php echo esc_url( $link_uri ) ?>">
                        <?php } else { ?>
                        <a class="uniPricingItemLink" data-remodal-target="priceForm" href="#" data-priceid="<?php echo esc_attr( get_the_ID() ); ?>" data-pricetitle="<?php echo esc_attr( get_the_title( get_the_ID() ) ) ?>">
                        <?php } ?>
                            <?php echo esc_html( $link_label ); ?>
                            <svg version="1.1" id="Layer_4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                width="19px" height="9px" viewBox="0 0 19 9" enable-background="new 0 0 19 9" xml:space="preserve">
                            <path fill="#2ebd7f" d="M18.744,4.242L18.997,4.5l-0.253,0.258V5.03h-0.27L14.578,9l-0.736-0.749l3.16-3.221H-0.003V3.97h17.007
                                l-3.162-3.22L14.578,0l3.682,3.75l0,0l0.217,0.22h0.268V4.242z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php
            endwhile; endif;
            wp_reset_postdata();
            ?>

            <?php } else {
                $cal_id = intval( $aPostCustom['uni_plans_cal_id'][0] );
                echo do_shortcode('[uni-ec-cobot-plans id="' . $cal_id . '"]');
            } ?>
            </div>
		</div>

    <?php
        endwhile; endif;
        wp_reset_postdata();
    ?>
        
    </section>

<?php get_footer(); ?>