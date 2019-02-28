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
                <div class="pricingPlanItem pricingPlanItemForTeams">
                    <h3><?php echo esc_html( $oPlan->name ); ?></h3>
                    <div class="planPrice">
    						<small><?php echo esc_html( $oPlan->currency ); ?></small>
                            <strong>
                                <?php echo $sPrice; ?>
                            </strong>
                            <?php if ( !empty($oPlan->price_per_cycle_in_cents) ) { ?>
                                /<?php printf( esc_html( _n( '%d month', '%d monthes', $oPlan->cycle_duration, 'coworking'  ) ), $oPlan->cycle_duration ); ?>
                            <?php } else {
                                if( !empty($oPlan->time_passes) ) {
                            ?>
                                /<?php echo esc_html($oPlan->time_passes[0]->name) ?>
                            <?php }
                            } ?>
    				</div>
                    <div class="pricingPlanItemDescWrap" style="min-height: 312px; max-height: 312px;">
                        <?php echo $Parsedown->text($oPlan->description); ?>
                    </div>
                    <a class="joinNow" href="<?php echo esc_url( $plan_url ); ?>"><?php esc_html_e('See Plan Details & Sign Up', 'coworking') ?></a>
                </div>
    <?php } ?>
</div>

<?php do_action('uni_ec_after_cobot_plans_shortcode_action', $aAttr['id']); ?>