<?php
// share buttons
if ( !function_exists('uni_coworking_theme_share_facebook') ) {
    function uni_coworking_theme_share_facebook() {
        $sFbAppId = ot_get_option('uni_fb_app_id');
    	return 'https://www.facebook.com/dialog/share?app_id='.esc_attr( $sFbAppId ).'&href='.esc_url( get_permalink() ).'&redirect_uri='.esc_url( get_permalink() );
    }
}

if ( !function_exists('uni_coworking_theme_share_twitter') ) {
    function uni_coworking_theme_share_twitter() {
    	return 'http://twitter.com/share?text='.urlencode( esc_attr( get_the_title() ) ).'&url='.esc_url( get_permalink() );
    }
}

if ( !function_exists('uni_coworking_theme_share_gplus') ) {
    function uni_coworking_theme_share_gplus() {
    	return 'https://plus.google.com/share?url='.esc_url( get_permalink() );
    }
}

if ( !function_exists('uni_coworking_theme_share_pinterest') ) {
    function uni_coworking_theme_share_pinterest() {
        $aImage = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
        $sImageUrl = '';
    	if ( isset($aImage[0]) ) $sImageUrl = $aImage[0];
    	if ( $sImageUrl == false ) {
    		$sImageUrl = get_template_directory_uri() . '/images/placeholders/unithumb-portfolioone.png';
    	}
    	return 'http://pinterest.com/pin/create/button/?url='.esc_url( get_permalink() )
                .'&media='.esc_url( $sImageUrl ).'&description='.urlencode( esc_attr( get_the_title() ) );
    }
}

// popup messages
if ( !function_exists('uni_coworking_theme_add_js_message_div') ) {
    function uni_coworking_theme_add_js_message_div() {
        echo '<div id="uni_popup"></div>';
    }
    add_action('wp_footer', 'uni_coworking_theme_add_js_message_div');
}

//
if ( !function_exists('uni_coworking_theme_send_email_wrapper') ) {
    function uni_coworking_theme_send_email_wrapper( $sEmailTo, $aHeadersText, $sSubjectText, $sEmailTemplateName, $aMailVars = array(), $sEmailText = '' ) {

    	    $sCharset = 'UTF-8';
    	    mb_internal_encoding($sCharset);

    	    $sSubject           = mb_convert_encoding($sSubjectText, $sCharset, 'auto');
    	    $sSubject           = mb_encode_mimeheader($sSubjectText, $sCharset, 'B');
            $aHeadersText		= array('Content-Type: text/html; charset=UTF-8');

            if ( $sEmailTemplateName != false ) {
                $sMailContent   = uni_coworking_theme_get_email_content_html( $sEmailTemplateName, $aMailVars );
            } else {
                $sMailContent   = $sEmailText;
            }

            wp_mail($sEmailTo, $sSubject, $sMailContent, $aHeadersText);

    }
}

//
if ( !function_exists('uni_coworking_theme_get_email_content_html') ) {
    function uni_coworking_theme_get_email_content_html( $sEmailTemplateName, $aMailVars = array() ) {
    		ob_start();
    		uni_coworking_theme_get_template( $sEmailTemplateName );
    		$sMailContent = ob_get_clean();
            if ( !empty($aMailVars) ) {
                foreach ( $aMailVars as $sVarName => $sVarValue ) {
                    $sMailContent = str_replace($sVarName, $sVarValue, $sMailContent);
                }
            }
            return $sMailContent;
    }
}

//
if ( !function_exists('uni_coworking_theme_get_template') ) {
    function uni_coworking_theme_get_template( $sEmailTemplateName, $args = array() ) {
    	if ( $args && is_array( $args ) ) {
    		extract( $args );
    	}

        if ( file_exists( get_stylesheet_directory() . $sEmailTemplateName ) ) {
            $sTemplatePath = get_stylesheet_directory() . $sEmailTemplateName;
        } else if ( file_exists( get_template_directory() . $sEmailTemplateName ) ) {
            $sTemplatePath = get_template_directory() . $sEmailTemplateName;
        } else {
    		return;
    	}

    	include( $sTemplatePath );
    }
}

//
if ( !function_exists('uni_coworking_theme_customizer_sanitize_text') ) {
    function uni_coworking_theme_customizer_sanitize_text( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }
}

// this function extends option tree plugin by adding
// a new type of field 'time picker'
// notice for the theme reviewer: I cannot prefix this
// function with my custom prefix; I have to keep this name
// because ot_display_by_type() function loads
// new field type only if its function has name in this pattern
if ( ! function_exists( 'ot_type_time_picker' ) ) {
function ot_type_time_picker( $args = array() ) {

    /* turns arguments array into variables */
    extract( $args );

    /* verify a description */
    $has_desc = $field_desc ? true : false;

    /**
     * Filter the addition of the readonly attribute.
     *
     * @since 2.5.0
     *
     * @param bool $is_readonly Whether to add the 'readonly' attribute. Default 'false'.
     * @param string $field_id The field ID.
     */
    $is_readonly = apply_filters( 'ot_type_time_picker_readonly', false, $field_id );

    /* format setting outer wrapper */
    echo '<div class="format-setting type-date-time-picker ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

    /* date time picker JS */
    echo '<script>jQuery(document).ready(function($) { OT_UI.bind_time_picker("' . esc_attr( $field_id ) . '"); });</script>';

      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';

      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';

        /* build date time picker */
        echo '<input type="text" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" value="' . esc_attr( $field_value ) . '" class="widefat option-tree-ui-input ' . esc_attr( $field_class ) . '"' . ( $is_readonly == true ? ' readonly' : '' ) . ' />';

      echo '</div>';

    echo '</div>';

}
}

//
if ( ! function_exists( 'ot_type_uni_users_type_checkbox' ) ) {
function ot_type_uni_users_type_checkbox( $args = array() ) {

    /* turns arguments array into variables */
    extract( $args );

    /* verify a description */
    $has_desc = $field_desc ? true : false;

    /* format setting outer wrapper */
    echo '<div class="format-setting type-custom-post-type-checkbox type-checkbox ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';

      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';

        /* setup the role */
        $sRoleSlug = isset( $field_post_type ) ? $field_post_type : 'subscriber';

        /* query userss array */
        $oUserQuery = new WP_User_Query( array('role' => $sRoleSlug) );

        /* has posts */
        if ( ! empty( $oUserQuery->results ) ) {
          foreach ( $oUserQuery->results as $oUser ) {
            echo '<p>';
            echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $oUser->ID ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $oUser->ID ) . '" value="' . esc_attr( $oUser->ID ) . '" ' . ( isset( $field_value[$oUser->ID] ) ? checked( $field_value[$oUser->ID], $oUser->ID, false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
            echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $oUser->ID ) . '">' . esc_attr($oUser->display_name) . '</label>';
            echo '</p>';
          }
        } else {
          echo '<p>' . sprintf( esc_html__( 'No users found with "%s" role', 'coworking' ), $field_post_type) . '</p>';
        }

      echo '</div>';

    echo '</div>';

}
}

if ( ! function_exists( 'ot_type_uni_upload_logo' ) ) {
function ot_type_uni_upload_logo( $args = array() ) {

    /* turns arguments array into variables */
    extract( $args );

    /* verify a description */
    $has_desc = $field_desc ? true : false;

    /* format setting outer wrapper */
    echo '<div class="format-setting type-text ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

      /* description */
      echo '<div class="description">' . esc_html__( 'Sorry, you cannot control this setting here. Please, proceed to WP Customizer.', 'coworking' ) . '</div>';

      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';

        /* build text input */
        echo '<input type="hidden" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" value="' . esc_attr( $field_value ) . '" class="widefat option-tree-ui-input ' . esc_attr( $field_class ) . '" />';

      echo '</div>';

    echo '</div>';

}
}

if ( class_exists( 'Uni_Calendar' ) ) {
    add_filter('uni_ec_calendars_themes_filter', 'uni_coworking_theme_additional_ec_calendars_themes', 10, 1);
    function uni_coworking_theme_additional_ec_calendars_themes( $aThemes ){

        $aThemes['coworking_default'] = array(
                    'stylesheet_uri' => get_template_directory_uri() . '/css/ec-themes/uni-coworking-ec-default.css',
                    'class_name' => 'uni-coworking-ec-default',
                    'display_name' => esc_html__( 'Coworking default', 'coworking' )
                    );

        return $aThemes;
    }
}

?>