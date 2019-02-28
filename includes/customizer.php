<?php
/**
 * coworking Theme Customizer
 *
 */

//
function uni_coworking_theme_customize_register( $wp_customize ) {

    $sOptionId = ot_options_id();
    $option_tree = get_option( $sOptionId );
    $aThemeSettings = get_option( 'coworking_settings', array() );

    // home pae settings
    $wp_customize->add_panel( 'homepage_settings_panel', array(
        'title' => esc_html__( 'Home page settings', 'coworking' ),
        'description' => '',
        'priority' => 160,
        'active_callback' => 'is_front_page'
    ) );

    foreach ( $aThemeSettings['settings'] as $aSetting ) {

        $sSettingId = esc_attr( $aSetting['id'] );
        $sSettingSection = esc_attr( $aSetting['section'] );

        // home page settings
        if ( in_array($sSettingSection,
                array('logo', 'home-static-one', 'home-about-one', 'home-benefits', 'home-parallax-one', 'home-price-tables', 'home-shop', 'home-events',
                    'home-blog', 'home-contact', 'home-subscribe', 'home-instagram')
                ) ) {

            switch ( $aSetting['type'] ) :

                case 'textblock':
                    $wp_customize->add_section( "homepage_settings_section_$sSettingSection", array(
                        'title' => esc_html( $aSetting['desc'] ),
                        'panel' => 'homepage_settings_panel',
                        'active_callback' => 'is_front_page'
                    ) );
                break;

                case 'on-off':
                    $wp_customize->add_setting( $sOptionId.'['.$sSettingId.']', array(
                        'type' => 'option',
                        'capability' => 'edit_theme_options',
                        'default' => ( isset($option_tree[$sSettingId]) && !empty($option_tree[$sSettingId]) ) ? esc_attr( $option_tree[$sSettingId] ) : '',
                        'transport' => ( isset($aSetting['transport']) && !empty($aSetting['transport']) ) ? esc_attr( $aSetting['transport'] ) : 'refresh',
                        'sanitize_callback' => 'uni_coworking_theme_customizer_sanitize_text'
                    ) );
                    $wp_customize->add_control( $sOptionId.'['.$sSettingId.']', array(
                        'type' => 'select',
                        'priority' => 10,
                        'section' => "homepage_settings_section_$sSettingSection",
                        'label' => esc_html( $aSetting['label'] ),
                        'description' => ( !empty($aSetting['desc']) ) ? esc_html( $aSetting['desc'] ) : '',
                        'choices' => array(
                            'on' => esc_html__('Enable', 'coworking'),
                            'off' => esc_html__('Disable', 'coworking'),
                        )
                    ) );
                break;

                case 'text':
                    $wp_customize->add_setting( $sOptionId.'['.$sSettingId.']', array(
                        'type' => 'option',
                        'capability' => 'edit_theme_options',
                        'default' => ( isset($option_tree[$sSettingId]) && !empty($option_tree[$sSettingId]) ) ? esc_attr( $option_tree[$sSettingId] ) : '',
                        'transport' => ( isset($aSetting['transport']) && !empty($aSetting['transport']) ) ? esc_attr( $aSetting['transport'] ) : 'refresh',
                        'sanitize_callback' => 'uni_coworking_theme_customizer_sanitize_text'
                    ) );
                    $wp_customize->add_control( $sOptionId.'['.$sSettingId.']', array(
                        'type' => 'text',
                        'priority' => 10,
                        'section' => "homepage_settings_section_$sSettingSection",
                        'label' => esc_html( $aSetting['label'] ),
                        'description' => ( !empty($aSetting['desc']) ) ? esc_html( $aSetting['desc'] ) : '',
                    ) );
                break;

                case 'upload':
                    $wp_customize->add_setting( $sOptionId.'['.$sSettingId.']', array(
                        'type' => 'option',
                        'capability' => 'edit_theme_options',
                        'default' => ( isset($option_tree[$sSettingId]) && !empty($option_tree[$sSettingId]) ) ? esc_attr( $option_tree[$sSettingId] ) : '',
                        'transport' => ( isset($aSetting['transport']) && !empty($aSetting['transport']) ) ? esc_attr( $aSetting['transport'] ) : 'refresh',
                        'sanitize_callback' => 'uni_coworking_theme_customizer_sanitize_text'
                    ) );
                    $wp_customize->add_control(
                        new WP_Customize_Media_Control(
                            $wp_customize,
                            $sOptionId.'['.$sSettingId.']',
                            array(
                                'label' => esc_html( $aSetting['label'] ),
                                'description' => ( !empty($aSetting['desc']) ) ? esc_html( $aSetting['desc'] ) : '',
                                'section' => "homepage_settings_section_$sSettingSection",
                                'settings'    => $sOptionId.'['.$sSettingId.']'
                            )
                        )
                    );
                break;

                case 'select':

                    $aControlChoices = array();
                    foreach ( $aSetting['choices'] as $aChoice ) {
                        $sValue = esc_attr( $aChoice['value'] );
                        $aControlChoices[$sValue] = esc_html( $aChoice['label'] );
                    }

                    $wp_customize->add_setting( $sOptionId.'['.$sSettingId.']', array(
                        'type' => 'option',
                        'capability' => 'edit_theme_options',
                        'default' => ( isset($option_tree[$sSettingId]) && !empty($option_tree[$sSettingId]) ) ? esc_attr( $option_tree[$sSettingId] ) : '',
                        'transport' => ( isset($aSetting['transport']) && !empty($aSetting['transport']) ) ? esc_attr( $aSetting['transport'] ) : 'refresh',
                        'sanitize_callback' => 'uni_coworking_theme_customizer_sanitize_text'
                    ) );
                    $wp_customize->add_control( $sOptionId.'['.$sSettingId.']', array(
                        'type' => 'select',
                        'priority' => 10,
                        'section' => "homepage_settings_section_$sSettingSection",
                        'label' => esc_html( $aSetting['label'] ),
                        'description' => ( !empty($aSetting['desc']) ) ? esc_html( $aSetting['desc'] ) : '',
                        'choices' => $aControlChoices
                    ) );
                break;

                case 'colorpicker-opacity':  // TODO
                    $wp_customize->add_setting( $sOptionId.'['.$sSettingId.']', array(
                        'type' => 'option',
                        'capability' => 'edit_theme_options',
                        'default' => ( isset($option_tree[$sSettingId]) && !empty($option_tree[$sSettingId]) ) ? esc_attr( $option_tree[$sSettingId] ) : '',
                        'transport' => ( isset($aSetting['transport']) && !empty($aSetting['transport']) ) ? esc_attr( $aSetting['transport'] ) : 'refresh',
                        'sanitize_callback' => 'uni_coworking_theme_customizer_sanitize_text'
                    ) );

                    $wp_customize->add_control( new Uni_Coworking_Theme_Nonexisted_Control( $wp_customize, $sOptionId.'['.$sSettingId.']', array(
                        'label' => esc_html( $aSetting['label'] ),
                        'description' => ( !empty($aSetting['desc']) ) ? esc_html( $aSetting['desc'] ) : '',
                        'section' => "homepage_settings_section_$sSettingSection",
                        'settings'    => $sOptionId.'['.$sSettingId.']',
                        'theme_option_section' => $sSettingSection
                    ) ) );
                break;

                case 'gallery':  // TODO
                    $wp_customize->add_setting( $sOptionId.'['.$sSettingId.']', array(
                        'type' => 'option',
                        'capability' => 'edit_theme_options',
                        'default' => ( isset($option_tree[$sSettingId]) && !empty($option_tree[$sSettingId]) ) ? esc_attr( $option_tree[$sSettingId] ) : '',
                        'transport' => ( isset($aSetting['transport']) && !empty($aSetting['transport']) ) ? esc_attr( $aSetting['transport'] ) : 'refresh',
                        'sanitize_callback' => 'uni_coworking_theme_customizer_sanitize_text'
                    ) );

                    $wp_customize->add_control( new Uni_Coworking_Theme_Nonexisted_Control( $wp_customize, $sOptionId.'['.$sSettingId.']', array(
                        'label' => esc_html( $aSetting['label'] ),
                        'description' => ( !empty($aSetting['desc']) ) ? esc_html( $aSetting['desc'] ) : '',
                        'section' => "homepage_settings_section_$sSettingSection",
                        'settings'    => $sOptionId.'['.$sSettingId.']',
                        'theme_option_section' => $sSettingSection
                    ) ) );
                break;

                case 'list-item':  // TODO
                    $wp_customize->add_setting( $sOptionId.'['.$sSettingId.']', array(
                        'type' => 'option',
                        'capability' => 'edit_theme_options',
                        // TODO
                        //'default' => ( isset($option_tree[$sSettingId]) && !empty($option_tree[$sSettingId]) ) ? array_map('esc_attr', $option_tree[$sSettingId]) : '',
                        'default' => '',
                        'transport' => ( isset($aSetting['transport']) && !empty($aSetting['transport']) ) ? esc_attr( $aSetting['transport'] ) : 'refresh',
                        'sanitize_callback' => 'uni_coworking_theme_customizer_sanitize_text'
                    ) );

                    $wp_customize->add_control( new Uni_Coworking_Theme_Nonexisted_Control( $wp_customize, $sOptionId.'['.$sSettingId.']', array(
                        'label' => esc_html( $aSetting['label'] ),
                        'description' => ( !empty($aSetting['desc']) ) ? esc_html( $aSetting['desc'] ) : '',
                        'section' => "homepage_settings_section_$sSettingSection",
                        'settings'    => $sOptionId.'['.$sSettingId.']',
                        'theme_option_section' => $sSettingSection
                    ) ) );
                break;

                case 'custom-post-type-select': // TODO
                    $wp_customize->add_setting( $sOptionId.'['.$sSettingId.']', array(
                        'type' => 'option',
                        'capability' => 'edit_theme_options',
                        'default' => ( isset($option_tree[$sSettingId]) && !empty($option_tree[$sSettingId]) ) ? esc_attr( $option_tree[$sSettingId] ) : '',
                        'transport' => ( isset($aSetting['transport']) && !empty($aSetting['transport']) ) ? esc_attr( $aSetting['transport'] ) : 'refresh',
                        'sanitize_callback' => 'uni_coworking_theme_customizer_sanitize_text'
                    ) );

                    $wp_customize->add_control( new Uni_Coworking_Theme_Nonexisted_Control( $wp_customize, $sOptionId.'['.$sSettingId.']', array(
                        'label' => esc_html( $aSetting['label'] ),
                        'description' => ( !empty($aSetting['desc']) ) ? esc_html( $aSetting['desc'] ) : '',
                        'section' => "homepage_settings_section_$sSettingSection",
                        'settings'    => $sOptionId.'['.$sSettingId.']',
                        'theme_option_section' => $sSettingSection
                    ) ) );
                break;

                case 'custom-post-type-checkbox':  // TODO
                    $wp_customize->add_setting( $sOptionId.'['.$sSettingId.']', array(
                        'type' => 'option',
                        'capability' => 'edit_theme_options',
                        // TODO
                        //'default' => ( isset($option_tree[$sSettingId]) && !empty($option_tree[$sSettingId]) ) ? esc_attr( $option_tree[$sSettingId] ) : '',
                        'transport' => ( isset($aSetting['transport']) && !empty($aSetting['transport']) ) ? esc_attr( $aSetting['transport'] ) : 'refresh',
                        'sanitize_callback' => 'uni_coworking_theme_customizer_sanitize_text'
                    ) );

                    $wp_customize->add_control( new Uni_Coworking_Theme_Nonexisted_Control( $wp_customize, $sOptionId.'['.$sSettingId.']', array(
                        'label' => esc_html( $aSetting['label'] ),
                        'description' => ( !empty($aSetting['desc']) ) ? esc_html( $aSetting['desc'] ) : '',
                        'section' => "homepage_settings_section_$sSettingSection",
                        'settings'    => $sOptionId.'['.$sSettingId.']',
                        'theme_option_section' => $sSettingSection
                    ) ) );
                break;

                case 'colorpicker':
                    $wp_customize->add_setting( $sOptionId.'['.$sSettingId.']', array(
                        'type' => 'option',
                        'capability' => 'edit_theme_options',
                        'default' => ( isset($option_tree[$sSettingId]) && !empty($option_tree[$sSettingId]) ) ? esc_attr( $option_tree[$sSettingId] ) : '',
                        'transport' => ( isset($aSetting['transport']) && !empty($aSetting['transport']) ) ? esc_attr( $aSetting['transport'] ) : 'refresh',
                        'sanitize_callback' => 'sanitize_hex_color'
                    ) );
                    $wp_customize->add_control(
                    	new WP_Customize_Color_Control(
                    	$wp_customize,
                    	$sOptionId.'['.$sSettingId.']',
                    	array(
                    		'label'      => esc_html__( 'Colour', 'coworking' ),
                    		'section'    => "homepage_settings_section_$sSettingSection",
                    		'settings'   => $sOptionId.'['.$sSettingId.']',
                    	) )
                    );
                break;

                case 'numeric-slider':

                    $aMinMaxStep = explode(',', $aSetting['min_max_step']);

                    $wp_customize->add_setting( $sOptionId.'['.$sSettingId.']', array(
                        'type' => 'option',
                        'capability' => 'edit_theme_options',
                        'default' => ( isset($option_tree[$sSettingId]) && !empty($option_tree[$sSettingId]) ) ? esc_attr( $option_tree[$sSettingId] ) : '',
                        'transport' => ( isset($aSetting['transport']) && !empty($aSetting['transport']) ) ? esc_attr( $aSetting['transport'] ) : 'refresh',
                        'sanitize_callback' => 'uni_coworking_theme_customizer_sanitize_text'
                    ) );
                    $wp_customize->add_control( $sOptionId.'['.$sSettingId.']', array(
                      'type' => 'range',
                      'section' => "homepage_settings_section_$sSettingSection",
                      'label' => esc_html( $aSetting['label'] ),
                      'description' => ( !empty($aSetting['desc']) ) ? esc_html( $aSetting['desc'] ) : '',
                      'input_attrs' => array(
                        'min' => $aMinMaxStep[0],
                        'max' => $aMinMaxStep[1],
                        'step' => $aMinMaxStep[2],
                      ),
                    ) );
                break;

                case 'textarea-simple':
                    $wp_customize->add_setting( $sOptionId.'['.$sSettingId.']', array(
                        'type' => 'option',
                        'capability' => 'edit_theme_options',
                        'default' => ( isset($option_tree[$sSettingId]) && !empty($option_tree[$sSettingId]) ) ? esc_attr( $option_tree[$sSettingId] ) : '',
                        'transport' => ( isset($aSetting['transport']) && !empty($aSetting['transport']) ) ? esc_attr( $aSetting['transport'] ) : 'refresh',
                        'sanitize_callback' => 'uni_coworking_theme_customizer_sanitize_text'
                    ) );
                    $wp_customize->add_control( $sOptionId.'['.$sSettingId.']', array(
                        'type' => 'textarea',
                        'priority' => 10,
                        'section' => "homepage_settings_section_$sSettingSection",
                        'label' => esc_html( $aSetting['label'] ),
                        'description' => ( !empty($aSetting['desc']) ) ? esc_html( $aSetting['desc'] ) : '',
                    ) );
                break;

                case 'uni-upload-logo':
            		$wp_customize->add_setting( $sOptionId.'['.$sSettingId.']', array(
            			'theme_supports' => array( $aSetting['post_type'] ),
                        'capability' => 'edit_theme_options',
                        'type' => 'option',
                        'default' => ( isset($option_tree[$sSettingId]) && !empty($option_tree[$sSettingId]) ) ? esc_attr( $option_tree[$sSettingId] ) : '',
            			'transport' => 'postMessage',
            		) );

            		$custom_logo_args = get_theme_support( $aSetting['post_type'] );
            		$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, $sOptionId.'['.$sSettingId.']', array(
            			'label'         => esc_html( $aSetting['label'] ),
                        'description'   => ( !empty($aSetting['desc']) ) ? esc_html( $aSetting['desc'] ) : '',
            			'section'       => "homepage_settings_section_$sSettingSection",
            			'priority'      => 10,
            			'height'        => $custom_logo_args[0]['height'],
            			'width'         => $custom_logo_args[0]['width'],
            			'flex_height'   => $custom_logo_args[0]['flex-height'],
            			'flex_width'    => $custom_logo_args[0]['flex-width'],
            			'button_labels' => array(
            				'select'       => esc_html__( 'Select logo', 'coworking' ),
            				'change'       => esc_html__( 'Change logo', 'coworking' ),
            				'remove'       => esc_html__( 'Remove', 'coworking' ),
            				'default'      => esc_html__( 'Default', 'coworking' ),
            				'placeholder'  => esc_html__( 'No logo selected', 'coworking' ),
            				'frame_title'  => esc_html__( 'Select logo', 'coworking' ),
            				'frame_button' => esc_html__( 'Choose logo', 'coworking' ),
            			),
            		) ) );

            		$wp_customize->selective_refresh->add_partial( $sOptionId.'['.$sSettingId.']', array(
            			'settings'            => array( $sOptionId.'['.$sSettingId.']' ),
            			'selector'            => '.'.$aSetting['post_type'],
            			'render_callback'     => "uni_coworking_theme_render_custom_logo_partial_$sSettingId",
            			'container_inclusive' => true,
            		) );
                break;

            endswitch;

        }
    }

}
add_action( 'customize_register', 'uni_coworking_theme_customize_register' );

require_once( ABSPATH . WPINC . '/class-wp-customize-setting.php' );
require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );
require_once( ABSPATH . WPINC . '/class-wp-customize-manager.php' );

if ( class_exists( 'WP_Customize_Control' ) ) {

class Uni_Coworking_Theme_Nonexisted_Control extends WP_Customize_Control {
    public $type = 'nonexisted';

    public $theme_option_section = '';

    public function render_content() {
        ?>
        <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <p><?php echo sprintf( esc_html__('Unfortunately, a customizer control for this option is not quite ready yet. Please, proceed to %s.', 'coworking'), '<a href="' . esc_url( home_url('/') ).'wp-admin/themes.php?page=ot-theme-options#section_' . esc_attr( $this->theme_option_section ) . '" target="_blank">'.esc_html__('theme options page in order to change this option', 'coworking').'</a>'); ?></p>
        </label>
        <?php
    }
}

}

function uni_coworking_theme_render_custom_logo_partial_uni_custom_logo_a() {
    return uni_coworking_theme_get_custom_logo_a();
}
function uni_coworking_theme_render_custom_logo_partial_uni_custom_logo_b() {
    return uni_coworking_theme_get_custom_logo_b();
}
function uni_coworking_theme_render_custom_logo_partial_uni_custom_logo_footer() {
    return uni_coworking_theme_get_custom_logo_footer();
}

//
function uni_coworking_theme_customize_preview_js() {
    wp_enqueue_script( 'uni-coworking-theme-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '1.0.10', true );
}
add_action( 'customize_preview_init', 'uni_coworking_theme_customize_preview_js' );

?>