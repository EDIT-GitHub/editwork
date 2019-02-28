<?php do_action('uni_ec_before_cobot_plans_shortcode_action', $aAttr['id']);

$sChosenThemeSlug = get_post_meta($aAttr['id'], '_uni_ec_cal_theme', true);
$aThemes = UniCalendar()->get_calendars_themes();
if ( $aAttr['theme'] !== null ) {
    $sChosenThemeSlug = $aAttr['theme'];
    $sThemeClass = $aThemes[$sChosenThemeSlug]['class_name'];
} else if ( $aAttr['theme'] === null && isset($sChosenThemeSlug) && !empty($sChosenThemeSlug) && isset($aThemes[$sChosenThemeSlug]) ) {
    $sThemeClass = $aThemes[$sChosenThemeSlug]['class_name'];
} else {
    $sThemeClass = $aThemes['flat_cyan']['class_name'];
}

$Parsedown = new Parsedown();
?>

<div class="uni-ec-cobot-plans-shortcode-wrapper <?php echo $sThemeClass; ?>">
    <?php foreach ( $aData as $oPlan ) {
        if ( !empty($oPlan->price_per_cycle_in_cents) ) {
            $fRawPrice = floatval($oPlan->price_per_cycle_in_cents/100);
            if ( $sPriceDisplayType == 'net' ) {
                $sPrice = $fRawPrice;
            } else if ( $sPriceDisplayType == 'gross' ) {
                $sPrice = $fRawPrice + $fRawPrice * $oPlan->tax_rate/100;
            }
            $sPrice = number_format( $sPrice, 0 );
        } else {
            if( !empty($oPlan->time_passes) ) {
                $fRawPrice = floatval($oPlan->time_passes[0]->price_in_cents/100);
                if ( $sPriceDisplayType == 'net' ) {
                    $sPrice = $fRawPrice;
                } else if ( $sPriceDisplayType == 'gross' ) {
                    $sPrice = $fRawPrice + $fRawPrice * $oPlan->time_passes[0]->tax_rate/100;
                }
                $sPrice = number_format( $sPrice, 2, ',', '.' );
            }
        }
        $plan_url = 'https://' . $aSpaceData['subdomain'] . '.cobot.me/membership_signup/new?plan_id=' . $oPlan->id;
    ?>
                <div class="uniPricingItem uni-clear">
                    <div class="scell">
                        <h3><?php echo esc_html( $oPlan->name ); ?></h3>
                        
                        <div class="uniPricingItemPrice">
                            <span><?php echo esc_html( $oPlan->currency ); ?></span>
                            <strong><?php echo $sPrice; ?></strong>
                            <?php if ( !empty($oPlan->price_per_cycle_in_cents) ) { ?>
                                /<?php printf( esc_html( _n( '%d month', '%d monthes', $oPlan->cycle_duration, 'coworking'  ) ), $oPlan->cycle_duration ); ?>
                            <?php } else {
                                if( !empty($oPlan->time_passes) ) {
                            ?>
                                /<?php echo esc_html($oPlan->time_passes[0]->name) ?>
                            <?php }
                            } ?>
                        </div>

                        <?php echo $Parsedown->text($oPlan->description); ?>
                        <div class="uni-clear"></div>
                        <a class="uniPricingItemLink" href="<?php echo esc_url( $plan_url ); ?>">
                            <?php esc_html_e('See Plan Details & Sign Up', 'coworking') ?>
                            <svg version="1.1" id="Layer_4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                width="19px" height="9px" viewBox="0 0 19 9" enable-background="new 0 0 19 9" xml:space="preserve">
                            <path fill="#2ebd7f" d="M18.744,4.242L18.997,4.5l-0.253,0.258V5.03h-0.27L14.578,9l-0.736-0.749l3.16-3.221H-0.003V3.97h17.007
                                l-3.162-3.22L14.578,0l3.682,3.75l0,0l0.217,0.22h0.268V4.242z"/>
                            </svg>
                        </a>
                    </div>
                </div>
    <?php } ?>
</div>

<?php do_action('uni_ec_after_cobot_plans_shortcode_action', $aAttr['id']); ?>