<?php
// Helper functions
require( get_template_directory() . '/includes/helper-functions.php' );

// Option tree theme options
define( 'OT_THEME_VERSION', '2.6.3' );

// Filters the Theme Options ID - modded to work with Polylang
function uni_coworking_theme_options_id() {

    $sDefault = 'coworking_options';

    if ( function_exists('pll_home_url') ) {
        if( is_admin() || is_customize_preview() ) {
            $user_lang = get_user_meta(get_current_user_id(), 'pll_filter_content', true);
            $selected_lang = filter_input( INPUT_GET, 'lang', FILTER_SANITIZE_STRING );
            $lang = $selected_lang !== null ? $selected_lang : $user_lang;
        } else {
            $lang = pll_current_language();
        }
        if( $lang AND $lang != 'all' AND $lang !== pll_default_language() ) {
            return $sDefault . '_' . $lang;
        }
    }

    return $sDefault;
}
add_filter( 'ot_options_id', 'uni_coworking_theme_options_id' );

// Filters the Settings ID
function uni_coworking_theme_settings_id() {
  return 'coworking_settings';
}
add_filter( 'ot_settings_id', 'uni_coworking_theme_settings_id' );

// Filters the Theme Option header list.
function uni_coworking_theme_filter_demo_header_list() {
 echo '<li id="theme-version"><span>Coworking Co. WP Theme 1.1.3</span></li>';
}
add_action( 'ot_header_list', 'uni_coworking_theme_filter_demo_header_list' );

//add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
add_filter( 'ot_show_options_ui', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_show_docs', '__return_false' );
add_filter( 'ot_use_theme_options', '__return_true' );
require( get_template_directory() . '/includes/theme-options.php' );
require( get_template_directory() . '/option-tree/ot-loader.php' );
require( get_template_directory() . '/includes/uni-metabox.php' );

// Customizer additions.
require( get_template_directory() . '/includes/customizer.php' );

// $content_width
if ( ! isset( $content_width ) ) {
    $content_width = 770;
}

// after setup of the child theme
add_action( 'after_setup_theme', 'uni_coworking_theme_setup' );
function uni_coworking_theme_setup() {

    // Enable featured image
    add_theme_support( 'post-thumbnails');

    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Add html5 suppost for search form and comments list
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

    // translation files for the child theme
    load_theme_textdomain( 'coworking', get_stylesheet_directory() . '/languages' );

    add_theme_support( 'woocommerce' );

    add_theme_support( 'uni-custom-logo-a', array(
        'height'      => ( ( ot_get_option( 'uni_logo_height' ) ) ? ot_get_option( 'uni_logo_height' ) : 16 ),
        'width'       => ( ( ot_get_option( 'uni_logo_width' ) ) ? ot_get_option( 'uni_logo_width' ) : 188 ),
        'flex-height' => false,
        'flex-width'  => false,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );

    add_theme_support( 'uni-custom-logo-b', array(
        'height'      => ( ( ot_get_option( 'uni_logo_height' ) ) ? ot_get_option( 'uni_logo_height' ) : 16 ),
        'width'       => ( ( ot_get_option( 'uni_logo_width' ) ) ? ot_get_option( 'uni_logo_width' ) : 188 ),
        'flex-height' => false,
        'flex-width'  => false,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );

    add_theme_support( 'uni-custom-logo-footer', array(
        'height'      => ( ( ot_get_option( 'uni_logo_footer_height' ) ) ? ot_get_option( 'uni_logo_footer_height' ) : 80 ),
        'width'       => 80,
        'flex-height' => false,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );

    // Indicate widget sidebars can use selective refresh in the Customizer.
    add_theme_support( 'customize-selective-refresh-widgets' );

}

// Unit types for spacing option
add_filter( 'ot_recognized_spacing_unit_types', 'uni_coworking_theme_types_for_spacing_option', 10, 2 );
function uni_coworking_theme_types_for_spacing_option( $array, $field_id ) {
    if ( $field_id == 'uni_logo_padding' || $field_id == 'uni_logo_padding_sticky' ) {
        $array = array('px' => 'px');
    }
    return $array;
}
// default benefits items
function uni_coworking_theme_default_benefits_items() {

    $aArray = array(
        array(
            'title' => esc_html__( '24 Hr Access', 'coworking' ),
            'uni_home_benefits_item_desc' => esc_html__( '24 Hr Access', 'coworking' ),
            'uni_home_benefits_item_icon' => 'benefitIcon_1'
        ),
        array(
            'title' => esc_html__( 'Private Phone Booth', 'coworking' ),
            'uni_home_benefits_item_desc' => esc_html__( 'Private Phone Booth', 'coworking' ),
            'uni_home_benefits_item_icon' => 'benefitIcon_2'
        ),
        array(
            'title' => esc_html__( 'Mail Service', 'coworking' ),
            'uni_home_benefits_item_desc' => esc_html__( 'Mail Service', 'coworking' ),
            'uni_home_benefits_item_icon' => 'benefitIcon_3'
        ),
        array(
            'title' => esc_html__( 'Modern Open Design', 'coworking' ),
            'uni_home_benefits_item_desc' => esc_html__( 'Modern Open Design', 'coworking' ),
            'uni_home_benefits_item_icon' => 'benefitIcon_4'
        ),
        array(
            'title' => esc_html__( 'Insanely Fast Internet', 'coworking' ),
            'uni_home_benefits_item_desc' => esc_html__( 'Insanely Fast Internet', 'coworking' ),
            'uni_home_benefits_item_icon' => 'benefitIcon_5'
        ),
        array(
            'title' => esc_html__( 'HD Projectors', 'coworking' ),
            'uni_home_benefits_item_desc' => esc_html__( 'HD Projectors', 'coworking' ),
            'uni_home_benefits_item_icon' => 'benefitIcon_6'
        ),
        array(
            'title' => esc_html__( 'Conference Rooms', 'coworking' ),
            'uni_home_benefits_item_desc' => esc_html__( 'Conference Rooms', 'coworking' ),
            'uni_home_benefits_item_icon' => 'benefitIcon_7'
        ),
        array(
            'title' => esc_html__( 'Group Events', 'coworking' ),
            'uni_home_benefits_item_desc' => esc_html__( 'Group Events', 'coworking' ),
            'uni_home_benefits_item_icon' => 'benefitIcon_8'
        )
    );

    return $aArray;
}
// map styles
function uni_coworking_theme_map_styles() {

    $aArray = array(
        array(
            'value'       => 'coworkingShadesOfGrey',
            'label'       => 'Shades of Grey (dafault)',
            'src'         => ''
        ),
        array(
            'value'       => 'coworkingCartoon',
            'label'       => 'Cartoon',
            'src'         => ''
        ),
        array(
            'value'       => 'coworkingGrey',
            'label'       => 'Grey Scale',
            'src'         => ''
        ),
        array(
            'value'       => 'coworkingBlackWhite',
            'label'       => 'Black & White',
            'src'         => ''
        ),
        array(
            'value'       => 'coworkingRetro',
            'label'       => 'Retro',
            'src'         => ''
        ),
        array(
            'value'       => 'coworkingNight',
            'label'       => 'Night',
            'src'         => ''
        ),
        array(
            'value'       => 'coworkingNightLight',
            'label'       => 'Night Light',
            'src'         => ''
        ),
        array(
            'value'       => 'coworkingPapiro',
            'label'       => 'Papiro',
            'src'         => ''
        ),
        array(
            'value'       => 'coworkingDefaultGoogleMap',
            'label'       => 'Google Map Standrard',
            'src'         => ''
        )
    );

    return $aArray;
}

// get related svg icon for chosen benefits item
function uni_coworking_theme_get_svg_by_benefits_item_class( $sClassName ) {

    $aArray = array(
        'benefitIcon_1' => '<svg xmlns="http://www.w3.org/2000/svg" width="62" height="58" viewBox="0 0 62 58">
        <path fill="#2ebd7f" d="M31 55C16.664 55 5 43.336 5 29S16.664 3 31 3s26 11.664 26 26-11.664 26-26 26zm0-49.6C17.987 5.4 7.4 15.987 7.4 29c0 13.014 10.587 23.6 23.6 23.6 13.014 0 23.6-10.582 23.6-23.6C54.6 15.987 44.014 5.4 31 5.4zm.89 28.05c-.234.233-.542.35-.85.35s-.615-.116-.85-.35l-7.353-7.355c-.466-.466-.466-1.23 0-1.696.467-.467 1.23-.467 1.697 0l6.506 6.504 12.163-12.16c.467-.468 1.23-.468 1.697 0 .467.465.467 1.228 0 1.696L31.89 33.45z"/>
        </svg>',
        'benefitIcon_2' => '<svg xmlns="http://www.w3.org/2000/svg" width="62" height="58" viewBox="0 0 62 58">
        <path fill="#2ebd7f" d="M53.934 42.486c-.688-1.94-4.826-5.21-11.64-9.225l-.362-.138c-1.356-.434-3.135-.543-6.983 3.527-.4-.052-2-.5-6.432-4.16l-.005-.007c-3.814-4.607-4.195-6.05-4.228-6.377 4.138-3.89 4.02-5.672 3.587-7.042l-.138-.36c-4.006-6.814-7.286-10.945-9.228-11.64L18.33 7l-.19.006c-2.592.1-6.074 1.122-7.936 5.43l-.105.235-.014.146C8.872 22.2 20.828 35.73 21.543 36.526l.02.022 3.252 3.2-.006.007C25.345 40.232 37.44 51 46.765 51c.48 0 .95-.025 1.416-.086l.146-.02.235-.104c4.31-1.863 5.332-5.338 5.43-7.93l.007-.19-.066-.184zm-6.14 6.493c-8.06.898-20.04-9.272-21.523-10.564l-.058-.055-3.227-3.18-.046-.052c-1.077-1.218-11.845-13.723-10.92-21.926 1.134-2.623 3.147-4.047 5.968-4.217.61.328 2.938 2.053 7.994 10.617l.013.052c.17.544.532 1.673-3.193 5.142l-.132.144c-.702.978-.925 2.362 4.453 8.92 6.17 5.245 8.007 5.095 8.914 4.465l.156-.124c3.47-3.73 4.598-3.37 5.146-3.2l.052.02c8.566 5.05 10.29 7.385 10.625 7.986-.175 2.827-1.592 4.834-4.222 5.973z"/>
        </svg>',
        'benefitIcon_3' => '<svg xmlns="http://www.w3.org/2000/svg" width="62" height="58" viewBox="0 0 62 58">
        <path fill="#2ebd7f" d="M53.632 47H8.368C5.96 47 4 45.025 4 42.6V15.4C4 12.974 5.96 11 8.368 11h45.264C56.04 11 58 12.974 58 15.4v27.2c0 2.425-1.96 4.4-4.368 4.4zM8.368 44.6h45.264c.194 0 .377-.037.554-.088l-14.13-14.237-6.02 6.063c-.853.858-1.97 1.286-3.09 1.286-1.117 0-2.235-.428-3.087-1.286l-5.69-5.728L8.293 44.592c.028.002.05.008.076.008zM6.482 14.804c-.063.19-.104.387-.104.596v27.2c0 .162.02.315.063.467l14.05-14.152-14.008-14.11zM8.46 13.4l21.084 21.243c.774.78 2.033.78 2.808 0L53.436 13.4H8.46zm47.032 1.323L41.738 28.578l13.88 13.982V15.4c0-.24-.05-.465-.126-.677z"/>
        </svg>',
        'benefitIcon_4' => '<svg xmlns="http://www.w3.org/2000/svg" width="62" height="58" viewBox="0 0 62 58">
        <path fill="#2ebd7f" d="M47.96 31.034c-1.462 1.65-3.856 2.805-6.383 3.606l4.683 20.854c.148.662-.28 1.324-.947 1.477-.67.147-1.34-.274-1.488-.937l-1.793-7.99-10.74-2.938-11.31 3.094-1.76 7.833c-.148.662-.818 1.084-1.487.938-.67-.145-1.096-.812-.947-1.475l4.678-20.845c-2.54-.8-4.954-1.957-6.425-3.618-1.16-1.314-1.67-2.874-1.51-4.548.773-8.07 4.852-20.02 4.893-20.135.02-.06 1.998-5.314 8.23-5.335C27.975 1.002 29.422 1 30.317 1l.005-.002c.038 0 .977-.02 6.028 0 6.234.02 8.21 5.27 8.23 5.324.04.104 4.115 12.006 4.893 20.104.16 1.687-.35 3.295-1.513 4.608zm-6.34 15.19l-.83-3.712-6.375 1.742 7.206 1.97zM40.428 40.9l-1.258-5.604c-3.966.935-7.632 1.115-7.91 1.115h-.047c-.075 0-.142-.032-.213-.047-.072.015-.14.048-.214.048h-.05c-.273 0-3.914-.184-7.863-1.103l-1.225 5.455 9.64 2.635 9.14-2.497zm-20.04 5.477l7.775-2.124-6.875-1.878-.9 4.002zM42.23 7.173c-.015-.038-1.404-3.678-5.89-3.692-2.348-.007-3.793-.007-4.675-.005-.014-.002-.025.006-.04.006-.013 0-.14-.003-.497-.005-.563.002-.74.004-.758.006-.017 0-.032-.007-.048-.007-.885-.002-2.326-.002-4.665.006-4.483.02-5.877 3.65-5.89 3.688-.04.105-4.01 11.716-4.756 19.507-.093.98.202 1.845.903 2.638 2.913 3.294 11.756 4.328 14.918 4.448.09.004.168.045.252.067.028-.003.053-.02.083-.02 3.162-.12 12.004-1.184 14.916-4.48.703-.792.998-1.667.904-2.645-.677-7.105-4.24-18.096-4.754-19.51z"/>
        </svg>',
        'benefitIcon_5' => '<svg xmlns="http://www.w3.org/2000/svg" width="62" height="58" viewBox="0 0 62 58">
        <path fill="#2ebd7f" d="M24.105 39.592l-1.392-1.344c2.277-2.368 5.314-3.712 8.603-3.712 2.91 0 5.694 1.088 7.91 3.008l-1.267 1.472c-1.9-1.664-4.177-2.496-6.644-2.496-2.72 0-5.314 1.087-7.21 3.072zM31 30.184c4.05 0 7.78 1.48 10.88 4.16l1.267-1.472C39.73 29.8 35.49 28.2 31 28.2c-4.745 0-9.236 1.792-12.652 5.12l1.328 1.408c3.037-2.88 7.022-4.544 11.324-4.544zm.316-6.463c5.757 0 11.26 2.177 15.5 6.147l1.266-1.408c-4.556-4.29-10.563-6.657-16.764-6.657-6.58 0-12.778 2.624-17.46 7.3l1.33 1.342c4.362-4.293 10.055-6.724 16.128-6.724zm0-6.4c7.402 0 14.487 2.813 19.927 8l1.33-1.408C46.812 18.408 39.286 15.4 31.38 15.4c-8.224 0-16.005 3.264-21.89 9.088l1.33 1.344c5.504-5.504 12.78-8.512 20.496-8.512zm0-6.4c9.047 0 17.713 3.456 24.355 9.792L57 19.305C49.98 12.648 40.87 9 31.316 9 21.448 9 12.086 12.904 5 19.943l1.328 1.345c6.706-6.656 15.626-10.368 24.988-10.368zM9.49 36.2zM31 42.6c-1.202 0-2.214 1.024-2.214 2.24 0 1.217 1.012 2.24 2.214 2.24s2.214-1.023 2.214-2.24c0-1.216-1.012-2.24-2.214-2.24m0-1.92c2.277 0 4.11 1.856 4.11 4.16 0 2.305-1.833 4.16-4.11 4.16s-4.112-1.855-4.112-4.16c0-2.304 1.835-4.16 4.112-4.16z"/>
        </svg>',
        'benefitIcon_6' => '<svg xmlns="http://www.w3.org/2000/svg" width="62" height="58" viewBox="0 0 62 58">
        <path fill="#2ebd7f" d="M53.725 47.404H48.06v2.328c0 .697-.577 1.268-1.272 1.268-.705 0-1.28-.57-1.28-1.268v-2.328H15.65v2.328c0 .697-.573 1.268-1.276 1.268-.704 0-1.278-.57-1.278-1.268v-2.328H8.283c-3.45 0-6.273-2.795-6.273-6.21V26.87c0-3.415 2.823-6.21 6.273-6.21h45.445c3.45 0 6.272 2.795 6.272 6.21v14.323c0 3.416-2.824 6.21-6.275 6.21zM57.44 26.87c0-2.028-1.667-3.677-3.718-3.677H8.275c-2.05 0-3.717 1.646-3.717 3.678v14.323c0 2.027 1.666 3.68 3.717 3.68h45.447c2.05 0 3.717-1.65 3.717-3.68V26.87zM45.98 41.655c-4.21 0-7.624-3.377-7.624-7.545 0-4.166 3.414-7.543 7.623-7.543 4.21 0 7.622 3.377 7.622 7.542 0 4.167-3.413 7.544-7.623 7.544zm0-12.552c-2.794 0-5.064 2.248-5.064 5.01 0 2.77 2.27 5.017 5.063 5.017 2.792 0 5.062-2.248 5.062-5.02 0-2.76-2.27-5.008-5.063-5.008zM19.19 33.32h-7.78c-1.84 0-3.333-1.48-3.333-3.297 0-1.818 1.493-3.297 3.332-3.297h7.78c1.84 0 3.333 1.48 3.333 3.297 0 1.82-1.494 3.297-3.332 3.297zm0-4.06h-7.78c-.422 0-.773.35-.773.764 0 .416.354.77.772.77h7.78c.42 0 .772-.353.772-.77.004-.415-.35-.765-.77-.765zm-7.835 6.01h7.783c1.836 0 3.332 1.48 3.332 3.298 0 1.813-1.496 3.298-3.332 3.298h-7.783c-1.838 0-3.332-1.48-3.332-3.298 0-1.817 1.497-3.297 3.332-3.297zm0 4.064h7.783c.418 0 .77-.352.77-.766 0-.416-.353-.77-.77-.77h-7.783c-.42 0-.772.353-.772.77 0 .414.355.766.772.766zm42.788-22.41c-.498.494-1.313.494-1.81 0-.5-.492-.5-1.297 0-1.79l5.483-5.427c.498-.492 1.313-.492 1.81 0 .497.492.497 1.298 0 1.79l-5.483 5.427zm-7.31.282c-.705 0-1.278-.57-1.278-1.267V8.264c0-.697.573-1.27 1.278-1.27.703 0 1.278.562 1.278 1.27v7.674c0 .697-.574 1.266-1.277 1.266zm-7.705-.388l-5.483-5.426c-.498-.492-.498-1.305 0-1.79.496-.493 1.313-.493 1.813 0l5.48 5.425c.497.494.497 1.3 0 1.79-.5.494-1.312.494-1.81 0z"/>
        </svg>',
        'benefitIcon_7' => '<svg xmlns="http://www.w3.org/2000/svg" width="62" height="58" viewBox="0 0 62 58">
        <path fill="#2ebd7f" d="M52.84 33.338h-.04c-.055 0-.12 0-.176-.008l-9.328 16.732c-.353.646-.952 1.108-1.67 1.326-.258.065-.522.104-.785.104-.463 0-.928-.117-1.344-.354l-3.096-1.68c-1.354-.735-1.854-2.415-1.104-3.75l2.063-3.702H4c-1.982 0-4-1.988-4-3.945V9.65c0-1.957 2.018-3.155 4-3.155h41.602c1.983 0 3.198 1.198 3.198 3.155v6.035c.128-.065.265-.136.4-.188 1.103-.457 2.32-.718 3.6-.718 5.072 0 9.2 4.27 9.2 9.27 0 5.003-4.104 8.5-9.16 9.288zM46.4 9.658c0-.656-.135-.79-.8-.79H4c-.664 0-1.602.134-1.602.79v28.416c0 .654.938 1.578 1.602 1.578h34.68l.217-.396 5.998-10.758c-.824-1.357-1.295-2.943-1.295-4.635 0-2.56 1.07-4.86 2.8-6.514V9.657h-.002zm6.403 7.498c-1.32 0-2.56.37-3.6 1.018-.136.088-.272.174-.4.27-.83.604-1.52 1.373-2 2.273-.152.283-.286.576-.4.883-.256.71-.396 1.47-.396 2.27 0 .72.108 1.407.328 2.064l.067-.13v.324c.103.312.24.604.395.896.26.478.568.927.932 1.315L46.8 30l-.278.498-.122.213-4.758 8.55-.218.396-1.104 1.973-.217.394-2.703 4.854c-.104.188-.025.427.16.537l3.104 1.674c.11.062.23.047.304.02.063-.013.168-.06.24-.18l4.062-7.302 1.248-2.248 2.28-4.08.398-.72 1.01-1.815.095-.166 1.193-2.147c.424.088.854.127 1.305.127.496 0 .983-.058 1.448-.15 3.055-.663 5.352-3.348 5.352-6.56.004-3.706-3.046-6.714-6.797-6.714zM38.233 36.43h-16c-.66 0-1.198-.533-1.198-1.184 0-.652.54-1.186 1.198-1.186h16c.66 0 1.2.526 1.2 1.186.002.65-.54 1.184-1.2 1.184zm-21.032.066H8.4c-.66 0-1.2-.533-1.2-1.186 0-.65.54-1.188 1.2-1.188h8.8c.66 0 1.198.532 1.198 1.188 0 .653-.54 1.186-1.198 1.186zm-.8 8.682h16.8c.66 0 1.2.533 1.2 1.184 0 .652-.54 1.188-1.2 1.188H16.4c-.66 0-1.2-.526-1.2-1.188 0-.65.54-1.184 1.2-1.184z"/>
        </svg>',
        'benefitIcon_8' => '<svg xmlns="http://www.w3.org/2000/svg" width="62" height="58" viewBox="0 0 62 58">
        <path fill="#2ebd7f" d="M21.52 58l-6.53-6.532c.643-.48.8-.557 1.08-.848.208-.205.454-.495.648-.77.082-.105.15-.218.205-.318.92-1.646.664-3.763-.735-5.163-1.396-1.4-3.574-1.6-5.213-.69-.084.052-.18.103-.263.163-.274.186-.547.412-.764.63-.29.29-.382.458-.86 1.093L2 38.48 40.48 0l7.02 7.02c-.21.147-.417.32-.605.508-.29.29-.522.61-.72.955-.067.123-.13.252-.187.374-.69 1.584-.39 3.514.904 4.808s3.224 1.595 4.81.903c.122-.057.25-.12.372-.186.346-.19.664-.428.95-.718.19-.19.364-.396.512-.61L60 19.52 21.52 58zm31.933-41.682c-2.583 1.578-6 1.248-8.232-.98-2.228-2.232-2.56-5.65-.975-8.228L40.48 3.345 13.154 30.67l1.394 1.397c.464.463.464 1.21 0 1.672-.463.464-1.21.464-1.673 0l-1.395-1.394-6.135 6.133 3.657 3.665c.108-.09.224-.174.317-.24 2.603-1.828 6.194-1.54 8.524.793 2.332 2.328 2.55 5.994.73 8.604-.057.078-.117.16-.186.24l3.11 3.11 6.136-6.134-.838-.836c-.465-.463-.465-1.21 0-1.674.465-.462 1.213-.462 1.676 0l.836.838 27.326-27.328-3.18-3.2zM31.277 40.432c-1.39 1.39-3.63 1.39-5.02 0l-6.69-6.69c-1.39-1.388-1.39-3.632 0-5.02l13.94-13.942c1.392-1.39 3.634-1.39 5.02 0l6.688 6.69c1.393 1.39 1.393 3.632 0 5.02L31.277 40.432zM43.793 23.39l-6.69-6.692c-.464-.463-1.178-.987-1.64-.524L21.52 30.114c-.463.464-.496 1.735-.033 2.2l6.69 6.69c.46.457 1.244-.062 1.708-.524l13.942-13.94c.463-.465.424-.694-.034-1.15zM19.566 38.76c-.463.463-1.21.463-1.674 0l-1.115-1.115c-.463-.465-.463-1.21 0-1.674.464-.462 1.21-.462 1.675 0l1.114 1.116c.463.462.463 1.21 0 1.674zm3.905 2.23l1.117 1.115c.462.463.462 1.21 0 1.672-.463.463-1.21.463-1.674 0l-1.115-1.114c-.463-.464-.463-1.212 0-1.673.464-.463 1.21-.463 1.673 0z"/>
        </svg>',
        'benefitIcon_9' => '<svg xmlns="http://www.w3.org/2000/svg" width="62" height="58" viewBox="0 0 62 85">
        <g>
        <path d="M11.4,0C5.1,0,0,5.1,0,11.4v50.8c0,6.3,5.1,11.4,11.4,11.4h3l-0.2,7.3c0,1.3,0.8,2.4,1.8,2.8c1.1,0.4,2.4,0.2,3.3-0.5
        l4.2-3.7l4.2,3.7c0.5,0.5,1.3,0.8,2.1,0.8c0.4,0,0.9-0.1,1.2-0.2c1.2-0.5,1.8-1.6,1.8-2.9l-0.2-7.2h13.9c6.3,0,11.4-5.1,11.4-11.4
        V22.6l0,0c0-0.8-0.3-1.4-0.9-2L36.1,0.8C35.5,0.3,34.9,0,34.2,0l0,0H11.4z M23.6,62.8c-4,0-7.3-3.3-7.3-7.3s3.3-7.3,7.3-7.3
        s7.3,3.3,7.3,7.3S27.6,62.8,23.6,62.8z M25.6,74.2c-1.2-1.1-2.9-1.1-4.1,0l-1.7,1.5l0.2-8c1.1,0.3,2.3,0.5,3.5,0.5
        c1.2,0,2.4-0.2,3.5-0.5l0.2,8L25.6,74.2z M36.9,9l11.5,10.9H36.9V9z M52.6,25.3v36.9c0,3.3-2.7,6-6,6H32.5l-0.1-3.7
        c2.4-2.3,3.8-5.5,3.8-9.1c0-7-5.6-12.7-12.7-12.7s-12.6,5.9-12.6,12.8c0,3.6,1.5,6.7,3.8,9.1l-0.1,3.7h-3.1c-3.3,0-6-2.7-6-6V11.4
        c0-3.3,2.7-6,6-6h20.1v17.2c0,1.5,1.2,2.7,2.7,2.7H52.6z" stroke="#fafafa" stroke-width="1.5" />
        <path d="M14.1,27.5h8.1c1.5,0,2.7-1.2,2.7-2.7c0-1.5-1.2-2.7-2.7-2.7h-8.1c-1.5,0-2.7,1.2-2.7,2.7C11.4,26.3,12.7,27.5,14.1,27.5z"
        />
        <path d="M11.4,35.7c0,1.5,1.2,2.7,2.7,2.7h22.3c1.5,0,2.7-1.2,2.7-2.7c0-1.5-1.2-2.7-2.7-2.7H14.1C12.7,33,11.4,34.2,11.4,35.7z"/>
        </g>
        </svg>',
        'benefitIcon_10' => '<svg xmlns="http://www.w3.org/2000/svg" width="62" height="58" viewBox="0 0 62 58">
        <g>
        <path d="M31,14.1c3,0,5.5-2.4,5.5-5.5S34,3.2,31,3.2c-3,0-5.5,2.4-5.5,5.5C25.5,11.7,28,14.1,31,14.1z M31,6c1.5,0,2.7,1.2,2.7,2.7
        s-1.2,2.7-2.7,2.7c-1.5,0-2.7-1.2-2.7-2.7C28.3,7.2,29.5,6,31,6z M26.5,15.1h1.3c0.4,0,0.7,0.1,1,0.4l2.3,2.3l2.3-2.3
        c0.3-0.3,0.6-0.4,1-0.4h1.3c2.8,0,5,2.2,5,5v3.5c0,0.8-0.6,1.4-1.4,1.4c-0.8,0-1.4-0.6-1.4-1.4v-3.5c0-1.2-1-2.2-2.2-2.2h-0.7
        l-2.5,2.5c-0.8,0.7-2,0.7-2.8,0l-2.4-2.5h-0.7c-1.2,0-2.2,1-2.2,2.2v3.5c0,0.8-0.6,1.4-1.4,1.4c-0.8,0-1.4-0.6-1.4-1.4v-3.5
        C21.5,17.3,23.7,15.1,26.5,15.1C26.4,15.1,26.4,15.1,26.5,15.1z M31,43.6c3.1,0,5.5-2.5,5.5-5.5c0-3.1-2.5-5.5-5.5-5.5
        c-3.1,0-5.5,2.5-5.5,5.5C25.5,41.2,27.9,43.6,31,43.6z M31,35.3c1.5,0,2.8,1.2,2.8,2.8c0,1.5-1.2,2.8-2.8,2.8
        c-1.5,0-2.8-1.2-2.8-2.8C28.2,36.6,29.5,35.3,31,35.3C31,35.3,31,35.3,31,35.3L31,35.3z M47.8,50.3c0.2,0.7-0.3,1.5-1,1.7
        c-0.7,0.2-1.5-0.3-1.7-1L40,29.2H22l-5.1,21.7c-0.2,0.7-0.9,1.2-1.7,1c-0.7-0.2-1.2-0.9-1-1.7l0,0l5.1-21.8c0.3-1.2,1.4-2.1,2.6-2.1
        h18.2c1.2,0,2.3,0.9,2.6,2.1L47.8,50.3z M26.7,44.7h8.5c3.4,0,6.2,2.7,6.2,6.2v2.5c0,0.8-0.6,1.4-1.4,1.4c-0.8,0-1.4-0.6-1.4-1.4
        v-2.5c0-1.9-1.5-3.4-3.4-3.4h-8.4c-1.9,0-3.4,1.5-3.4,3.4v2.5c0,0.8-0.6,1.4-1.4,1.4c-0.8,0-1.4-0.6-1.4-1.4v-2.5
        C20.7,47.6,23.3,44.8,26.7,44.7L26.7,44.7z M45.9,24.2c0,2.9,2.4,5.3,5.3,5.3s5.3-2.4,5.3-5.3s-2.4-5.3-5.3-5.3
        C48.2,18.9,45.9,21.3,45.9,24.2z M53.6,24.2c0,1.4-1.1,2.5-2.5,2.5c-1.4,0-2.5-1.1-2.5-2.5c0-1.4,1.1-2.5,2.5-2.5
        C52.5,21.7,53.6,22.8,53.6,24.2C53.6,24.2,53.6,24.2,53.6,24.2L53.6,24.2z M55.7,32.8c1.3,1.3,2.1,3,2.1,4.9v3.4
        c0,1.3-1.1,2.4-2.4,2.4h-6.3c-0.8,0-1.4-0.6-1.4-1.4c0-0.8,0.6-1.4,1.4-1.4h6v-3.1c0-2.2-1.8-4-4-4c-0.1,0-0.2,0-0.3,0
        c-1,0.1-2,0.5-2.6,1.3c-0.5,0.6-1.4,0.6-2,0.1c-0.5-0.5-0.6-1.4-0.1-1.9c1.2-1.3,2.8-2.1,4.5-2.2C52.6,30.9,54.4,31.6,55.7,32.8
        L55.7,32.8z M10.9,29.5c2.9,0,5.3-2.4,5.3-5.3c0-2.9-2.4-5.3-5.3-5.3s-5.3,2.4-5.3,5.3l0,0C5.6,27.1,8,29.5,10.9,29.5z M10.9,21.7
        c1.4,0,2.5,1.1,2.5,2.5c0,1.4-1.1,2.5-2.5,2.5s-2.5-1.1-2.5-2.5l0,0C8.4,22.8,9.5,21.7,10.9,21.7C10.9,21.7,10.9,21.7,10.9,21.7
        L10.9,21.7z M4.2,41.2v-3.4c0-1.9,0.8-3.6,2.1-4.9c1.4-1.3,3.2-1.9,5-1.8c1.7,0.1,3.4,0.9,4.5,2.2c0.5,0.6,0.5,1.4-0.1,2
        c-0.6,0.5-1.4,0.5-2-0.1c-0.7-0.8-1.6-1.2-2.6-1.3c-2.2-0.1-4.1,1.5-4.2,3.7c0,0.1,0,0.2,0,0.2v3.1h6c0.8,0,1.4,0.6,1.4,1.4
        c0,0.8-0.6,1.4-1.4,1.4H6.6C5.2,43.6,4.2,42.5,4.2,41.2z"/>
        </g>
        </svg>'
    );

if ( isset($aArray[$sClassName]) ) {
    return $aArray[$sClassName];
} else {
    return '';
}
}

// Mailchimp API 3.0
include( get_template_directory() . '/includes/class-uni-mailchimp-universal.php');

// Register Custom Menu Function
if (function_exists('register_nav_menus')) {
    register_nav_menus( array(
        'primary' => esc_html__( 'Coworking Main Menu', 'coworking' ),
        'footer' => esc_html__( 'Coworking Footer Menu', 'coworking' )
    ) );
}



//
function uni_coworking_theme_menu_items_autogenerated(){
    $sOutput = '';
    if ( ot_get_option('uni_home_builtin_slider_enable') === 'on' && ot_get_option('uni_home_builtin_slider_menu_enable') === 'on' ) {
        $sHomeStaticMenuLabel = ot_get_option('uni_home_builtin_slider_menu_label');
        $sOutput .= '<li class="scroll-to-btn"><a href="'.esc_url( home_url('/') ).'#We-Are">'.( ( isset($sHomeStaticMenuLabel) && !empty($sHomeStaticMenuLabel) ) ? esc_html($sHomeStaticMenuLabel) : esc_html__( 'We Are', 'coworking' ) ).'</a></li>';
    }
    if ( ot_get_option('uni_home_static_screen_one_enable') === 'on' && ot_get_option('uni_home_static_screen_one_menu_enable') === 'on' ) {
        $sHomeStaticMenuLabel = ot_get_option('uni_home_static_screen_one_menu_label');
        $sOutput .= '<li class="scroll-to-btn"><a href="'.esc_url( home_url('/') ).'#Introduction">'.( ( isset($sHomeStaticMenuLabel) && !empty($sHomeStaticMenuLabel) ) ? esc_html($sHomeStaticMenuLabel) : esc_html__( 'Introduction', 'coworking' ) ).'</a></li>';
    }
    if ( ot_get_option('uni_home_about_one_enable') === 'on' && ot_get_option('uni_home_about_one_menu_enable') === 'on' ) {
        $sHomeAboutMenuLabel = ot_get_option('uni_home_about_one_menu_label');
        $sOutput .= '<li class="scroll-to-btn"><a href="'.esc_url( home_url('/') ).'#About">'.( ( isset($sHomeAboutMenuLabel) && !empty($sHomeAboutMenuLabel) ) ? esc_html($sHomeAboutMenuLabel) : esc_html__( 'About', 'coworking' ) ).'</a></li>';
    }
    if ( ot_get_option('uni_home_about_two_enable') === 'on' && ot_get_option('uni_home_about_two_menu_enable') === 'on' ) {
        $sHomeAboutTwoMenuLabel = ot_get_option('uni_home_about_two_menu_label');
        $sOutput .= '<li class="scroll-to-btn"><a href="'.esc_url( home_url('/') ).'#About2">'.( ( isset($sHomeAboutTwoMenuLabel) && !empty($sHomeAboutTwoMenuLabel) ) ? esc_html($sHomeAboutTwoMenuLabel) : esc_html__( 'About Us', 'coworking' ) ).'</a></li>';
    }
    if ( ot_get_option('uni_home_benefits_enable') === 'on' && ot_get_option('uni_home_benefits_menu_enable') === 'on' ) {
        $sHomeBenefitsMenuLabel = ot_get_option('uni_home_benefits_menu_label');
        $sOutput .= '<li class="scroll-to-btn"><a href="'.esc_url( home_url('/') ).'#Benefits">'.( ( isset($sHomeBenefitsMenuLabel) && !empty($sHomeBenefitsMenuLabel) ) ? esc_html($sHomeBenefitsMenuLabel) : esc_html__( 'Benefits', 'coworking' ) ).'</a></li>';
    }
    if ( ot_get_option('uni_home_parallax_one_enable') === 'on' && ot_get_option('uni_home_parallax_one_menu_enable') === 'on' ) {
        $sHomeParallaxMenuLabel = ot_get_option('uni_home_parallax_one_menu_label');
        $sOutput .= '<li class="scroll-to-btn"><a href="'.esc_url( home_url('/') ).'#Mission">'.( ( isset($sHomeParallaxMenuLabel) && !empty($sHomeParallaxMenuLabel) ) ? esc_html($sHomeParallaxMenuLabel) : esc_html__( 'Our Mission', 'coworking' ) ).'</a></li>';
    }
    if ( ot_get_option('uni_home_price_tabels_enable') === 'on' && ot_get_option('uni_home_price_tabels_menu_enable') === 'on' ) {
        $sHomePriceMenuLabel = ot_get_option('uni_home_price_tabels_menu_label');
        $sOutput .= '<li class="scroll-to-btn"><a href="'.esc_url( home_url('/') ).'#Pricing">'.( ( isset($sHomePriceMenuLabel) && !empty($sHomePriceMenuLabel) ) ? esc_html($sHomePriceMenuLabel) : esc_html__( 'Prices', 'coworking' ) ).'</a></li>';
    }
    if ( ot_get_option('uni_home_shop_menu_enable') === 'on' && ot_get_option('uni_home_shop_menu_enable') === 'on' && class_exists( 'WooCommerce' ) ) {
        $sHomeStoreMenuLabel = ot_get_option('uni_home_shop_menu_label');
        $sOutput .= '<li class="scroll-to-btn"><a href="'.esc_url( home_url('/') ).'#Store">'.( ( isset($sHomeStoreMenuLabel) && !empty($sHomeStoreMenuLabel) ) ? esc_html($sHomeStoreMenuLabel) : esc_html__( 'Store', 'coworking' ) ).'</a></li>';
    }
    if ( ot_get_option('uni_home_events_enable') === 'on' && ot_get_option('uni_home_events_menu_enable') === 'on' ) {
        $sHomeEventsMenuLabel = ot_get_option('uni_home_events_menu_label');
        $sOutput .= '<li class="scroll-to-btn"><a href="'.esc_url( home_url('/') ).'#Events">'.( ( isset($sHomeEventsMenuLabel) && !empty($sHomeEventsMenuLabel) ) ? esc_html($sHomeEventsMenuLabel) : esc_html__( 'Events', 'coworking' ) ).'</a></li>';
    }
    if ( ot_get_option('uni_home_blog_enable') === 'on' && ot_get_option('uni_home_blog_menu_enable') === 'on' ) {
        $sHomeBlogMenuLabel = ot_get_option('uni_home_blog_menu_label');
        $sOutput .= '<li class="scroll-to-btn"><a href="'.esc_url( home_url('/') ).'#Blog">'.( ( isset($sHomeBlogMenuLabel) && !empty($sHomeBlogMenuLabel) ) ? esc_html($sHomeBlogMenuLabel) : esc_html__( 'Blog', 'coworking' ) ).'</a></li>';
    }
    if ( ot_get_option('uni_home_contact_enable') === 'on' && ot_get_option('uni_home_contact_menu_enable') === 'on' ) {
        $sHomeContactMenuLabel = ot_get_option('uni_home_contact_menu_label');
        $sOutput .= '<li class="scroll-to-btn"><a href="'.esc_url( home_url('/') ).'#Contact">'.( ( isset($sHomeContactMenuLabel) && !empty($sHomeContactMenuLabel) ) ? esc_html($sHomeContactMenuLabel) : esc_html__( 'Contact', 'coworking' ) ).'</a></li>';
    }
    if ( ot_get_option('uni_polylang_switcher_enable') === 'on' && function_exists('pll_home_url') ) {
        if ( ot_get_option('uni_polylang_switcher_flags_enable') === 'on' ) {
            $sOutput .= '<ul>' . pll_the_languages( array('echo' => false, 'show_flags' => true) ) . '</ul>';
        } else {
            $sOutput .= '<ul>' . pll_the_languages( array('echo' => false, 'show_flags' => false) ) . '</ul>';
        }
    }
    return $sOutput;
}

// Menu fallback
function uni_coworking_theme_nav_fallback() {
    if ( get_option('show_on_front') == 'page' && get_page_template_slug( get_option('page_on_front') ) == 'templ-home.php' ) {
        $sOutput = '<nav class="mainMenu"><ul class="uni-clear">';
        $sOutput .= uni_coworking_theme_menu_items_autogenerated();
        $sOutput .= '</ul></nav>';
    } else {
        $sOutput = '<nav class="mainMenu"><ul class="uni-clear">';
        $sOutput .= wp_list_pages( array('title_li' => '', 'echo' => false, 'depth' => 3) );
        $sOutput .= '</ul></nav>';
    }
    echo $sOutput;
}

// Mobile menu fallback
function uni_coworking_theme_nav_mobile_fallback() {
    if ( get_option('show_on_front') == 'page' && get_page_template_slug( get_option('page_on_front') ) == 'templ-home.php' ) {
        $sOutput = '<ul>';
        $sOutput .= uni_coworking_theme_menu_items_autogenerated();
        $sOutput .= '</ul>';
    } else {
        $sOutput = '<ul>';
        $sOutput .= wp_list_pages( array('title_li' => '', 'echo' => false, 'depth' => 3) );
        $sOutput .= '</ul>';
    }
    echo $sOutput;
}

// Menu footer fallback
function uni_coworking_theme_nav_footer_fallback() {
    if ( get_option('show_on_front') == 'page' && get_page_template_slug( get_option('page_on_front') ) == 'templ-home.php' ) {
        $sOutput = '<ul>';
        $sOutput .= uni_coworking_theme_menu_items_autogenerated();
        $sOutput .= '</ul>';
    } else {
        $sOutput = '<ul>';
        $sOutput .= wp_list_pages( array('title_li' => '', 'echo' => false, 'depth' => 1) );
        $sOutput .= '</ul>';
    }
    echo $sOutput;
}

// wp-title
add_theme_support( 'title-tag' );
if ( ! function_exists( '_wp_render_title_tag' ) ) :
    function uni_coworking_theme_old_render_title() {
        ?>
        <title><?php wp_title( '-', true, 'right' ); ?></title>
        <?php
    }
    add_action( 'wp_head', 'uni_coworking_theme_old_render_title' );
endif;

// TGM class 2.5.0 - neccessary plugins
include( get_template_directory() . '/includes/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'uni_coworking_theme_register_required_plugins' );
function uni_coworking_theme_register_required_plugins() {

    $plugins = array(
        array(
            'name'      => 'Instagram Feed',
            'slug'      => 'instagram-feed',
            'required'  => true,
        ),
        array(
            'name'               => 'Envato Market',
            'slug'               => 'envato-market',
            'source'             => get_template_directory() . '/includes/plugins/envato-market.zip',
            'required'           => false,
            'version'            => '1.0.0-RC2',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => 'http://envato.github.io/wp-envato-market/'
        ),
        array(
            'name'               => 'Uni Custom Post Types and Taxonomies',
            'slug'               => 'uni-cpt-and-tax',
            'source'             => get_template_directory() . '/includes/plugins/uni-cpt-and-tax.zip',
            'required'           => true,
            'version'            => '1.3.2',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
        ),
        array(
            'name'               => 'Uni Sortable Users',
            'slug'               => 'uni-sortable-users',
            'source'             => get_template_directory() . '/includes/plugins/uni-sortable-users.zip',
            'required'           => false,
            'version'            => '1.0.0',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
        ),
        array(
            'name'               => 'Calendarius',
            'slug'               => 'uni-calendarius',
            'source'             => get_template_directory() . '/includes/plugins/uni-calendarius.zip',
            'required'           => true,
            'version'            => '1.2.4',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => 'https://codecanyon.net/item/calendarius-comprehensive-modern-calendar-plugin-for-wordpress/19107505',
        ),
        array(
            'name'               => 'Profilini - Avatar and Profile Manager',
            'slug'               => 'uni-profilini',
            'source'             => get_template_directory() . '/includes/plugins/uni-profilini.zip',
            'required'           => false,
            'version'            => '2.0.0-beta',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
        ),
        array(
            'name'      => 'WooCommerce - excelling eCommerce',
            'slug'      => 'woocommerce',
            'required'  => false,
        ),
        array(
            'name'      => 'Intuitive Custom Post Order',
            'slug'      => 'intuitive-custom-post-order',
            'required'  => false,
        ),
        array(
            'name'      => 'Shortcodes Ultimate',
            'slug'      => 'shortcodes-ultimate',
            'required'  => false,
        ),
        array(
            'name'      => 'Tickera - WordPress Event Ticketing',
            'slug'      => 'tickera-event-ticketing-system',
            'required'  => false,
        ),
        array(
            'name'               => 'Uni Woo Custom Product Options',
            'slug'               => 'uni-woo-custom-product-options',
            'source'             => '',
            'required'           => false,
            'version'            => '3.0.1',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => 'http://codecanyon.net/item/uni-cpo-price-calculation-formulas-for-woocommerce/9333768',
        ),
        array(
            'name'               => 'WooCommerce Subscriptions',
            'slug'               => 'woocommerce-subscriptions',
            'source'             => '',
            'required'           => false,
            'version'            => '2.0.11',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => 'https://www.woothemes.com/products/woocommerce-subscriptions/',
        )
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '<div id="setting-error-tgmpa" class="updated settings-error notice is-dismissible"><p>'.esc_html__('Important: "Uni Woo Custom Product Options" is NOT bundled with the theme and CANNOT be installed and activated if you have not bought and uploaded it additionally!', 'coworking').'</p></div>',
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'coworking' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'coworking' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'coworking' ), // %s = plugin name.
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'coworking' ),
            'notice_can_install_required'     => _n_noop(
                'This theme requires the following plugin: %1$s.',
                'This theme requires the following plugins: %1$s.',
                'coworking'
            ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop(
                'This theme recommends the following plugin: %1$s.',
                'This theme recommends the following plugins: %1$s.',
                'coworking'
            ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop(
                'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
                'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
                'coworking'
            ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop(
                'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                'coworking'
            ), // %1$s = plugin name(s).
            'notice_ask_to_update_maybe'      => _n_noop(
                'There is an update available for: %1$s.',
                'There are updates available for the following plugins: %1$s.',
                'coworking'
            ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop(
                'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
                'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
                'coworking'
            ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop(
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                'coworking'
            ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop(
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'coworking'
            ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop(
                'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
                'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
                'coworking'
            ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                'coworking'
            ),
            'update_link'                     => _n_noop(
                'Begin updating plugin',
                'Begin updating plugins',
                'coworking'
            ),
            'activate_link'                   => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                'coworking'
            ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'coworking' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'coworking' ),
            'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'coworking' ),
            'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'coworking' ),  // %1$s = plugin name(s).
            'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'coworking' ),  // %1$s = plugin name(s).
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'coworking' ), // %s = dashboard link.
            'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'coworking' ),

            'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        ),
);

tgmpa( $plugins, $config );

}

// Load necessary theme scripts and styles
function uni_coworking_theme_scripts() {

    $sLocale = get_locale();
    $aLocale = explode('_',$sLocale);
    $sLangCode = $aLocale[0];

    // Load the html5 shiv.
    wp_enqueue_script( 'html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
    // Scrollreveal
    wp_enqueue_script('scrollreveal-min', get_template_directory_uri() . '/js/scrollreveal.min.js', array('jquery'), '3.0.9' );
    // Bg loaded
    wp_enqueue_script('bg-loaded', get_template_directory_uri() . '/js/bg-loaded.js', array('jquery'), '1.3.2' );
    // scrollTo
    wp_enqueue_script('jquery-scrollTo-min', get_template_directory_uri() . '/js/jquery.scrollTo.min.js', array('jquery'), '2.1.3' );
    // bxSlider
    wp_enqueue_script('jquery-bxslider-min', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array('jquery'), '4.2.3' );
    // dotdotdot
    wp_enqueue_script('jquery-dotdotdot-min', get_template_directory_uri() . '/js/jquery.dotdotdot.min.js', array('jquery'), '1.7.4' );
    // jquery.remodal
    wp_enqueue_script('remodal-min', get_template_directory_uri() . '/js/remodal.min.js', array('jquery'), '1.0.5' );
    // jquery.blockUI
    wp_enqueue_script('jquery-blockUI', get_template_directory_uri() . '/js/jquery.blockUI.js', array('jquery'), '2.70.0' );
    // js cookie
    wp_enqueue_script('js-cookie', get_template_directory_uri() . '/js/js.cookie.js', array('jquery'), '2.0.3' );
    // parsley
    wp_register_script('jquery-parsley-min', get_template_directory_uri() . '/js/parsley.min.js', array('jquery'), '2.3.11' );
    wp_enqueue_script('jquery-parsley-min');
    // parsley localization
    wp_register_script('parsley-localization', get_template_directory_uri() . '/js/parsley/i18n/en.js', array('jquery-parsley-min'), '2.3.11' );
    wp_enqueue_script('parsley-localization');
    // theme's scripts
    wp_enqueue_script('uni-coworking-theme-script', get_template_directory_uri() . '/js/script.js', array('jquery', 'scrollreveal-min',
        'bg-loaded', 'jquery-scrollTo-min', 'jquery-bxslider-min', 'jquery-dotdotdot-min', 'remodal-min',
        'jquery-blockUI', 'js-cookie', 'jquery-parsley-min'), '1.1.3' );

    // vars
    if ( is_home() ) {
        $params = array(
            'site_url'      => esc_url( home_url( '/' ) ),
            'ajax_url'      => esc_url( admin_url('admin-ajax.php') ),
            'is_home'       => 'yes',
            'locale'        => esc_attr($sLangCode),
            'error_msg'     => esc_html__('Error!', 'coworking')
        );
    } else {
        $params = array(
            'site_url'      => esc_url( home_url( '/' ) ),
            'ajax_url'      => esc_url( admin_url('admin-ajax.php') ),
            'is_home'       => 'no',
            'locale'        => esc_attr($sLangCode),
            'error_msg'     => esc_html__('Error!', 'coworking')
        );
    }

    wp_localize_script( 'uni-coworking-theme-script', 'uni_coworking_theme_var', $params );

        // parsley localization
    $aParsleyStrings = apply_filters( 'uni_coworking_theme_parsley_strings_filter', array(
        'defaultMessage'    => esc_html__("This value seems to be invalid.", 'coworking'),
        'type_email'        => esc_html__("This value should be a valid email.", 'coworking'),
        'type_url'          => esc_html__("This value should be a valid url.", 'coworking'),
        'type_number'       => esc_html__("This value should be a valid number.", 'coworking'),
        'type_digits'       => esc_html__("This value should be digits.", 'coworking'),
        'type_alphanum'     => esc_html__("This value should be alphanumeric.", 'coworking'),
        'type_integer'      => esc_html__("This value should be a valid integer.", 'coworking'),
        'notblank'          => esc_html__("This value should not be blank.", 'coworking'),
        'required'          => esc_html__("This value is required.", 'coworking'),
        'pattern'           => esc_html__("This value seems to be invalid.", 'coworking'),
        'min'               => esc_html__("This value should be greater than or equal to %s.", 'coworking'),
        'max'               => esc_html__("This value should be lower than or equal to %s.", 'coworking'),
        'range'             => esc_html__("This value should be between %s and %s.", 'coworking'),
        'minlength'         => esc_html__("This value is too short. It should have %s characters or more.", 'coworking'),
        'maxlength'         => esc_html__("This value is too long. It should have %s characters or fewer.", 'coworking'),
        'length'            => esc_html__("This value length is invalid. It should be between %s and %s characters long.", 'coworking'),
        'mincheck'          => esc_html__("You must select at least %s choices.", 'coworking'),
        'maxcheck'          => esc_html__("You must select %s choices or fewer.", 'coworking'),
        'check'             => esc_html__("You must select between %s and %s choices.", 'coworking'),
        'equalto'           => esc_html__("This value should be the same.", 'coworking'),
        'dateiso'           => esc_html__("This value should be a valid date (YYYY-MM-DD).", 'coworking'),
        'minwords'          => esc_html__("This value is too short. It should have %s words or more.", 'coworking'),
        'maxwords'          => esc_html__("This value is too long. It should have %s words or fewer.", 'coworking'),
        'words'             => esc_html__("This value length is invalid. It should be between %s and %s words long.", 'coworking'),
        'gt'                => esc_html__("This value should be greater.", 'coworking'),
        'gte'               => esc_html__("This value should be greater or equal.", 'coworking'),
        'lt'                => esc_html__("This value should be less.", 'coworking'),
        'lte'               => esc_html__("This value should be less or equal.", 'coworking'),
        'notequalto'        => esc_html__("This value should be different.", 'coworking')
    )
);

    wp_localize_script( 'jquery-parsley-min', 'uni_coworking_theme_parsley_loc', $aParsleyStrings );

}
add_action('wp_enqueue_scripts', 'uni_coworking_theme_scripts');

// add google maps js api 3 script
function uni_coworking_theme_enqueue_google_maps_script(){

    $sApiKey = ot_get_option('uni_gmaps_api_key');
    if ( ot_get_option('uni_gmaps_elsewhere_enable') != 'on'
        && (
            is_page_template('templ-contact.php') || is_page_template('templ-home.php')
            || is_singular('tc_events') || is_singular('uni_event')
        ) ) {
        if ( !empty($sApiKey) ) {
            wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js?key='.esc_attr($sApiKey) );
        } else {
            wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js', array(), '' );
        }
    } else if ( ot_get_option('uni_gmaps_elsewhere_enable') == 'on' ) {
        if ( !empty($sApiKey) ) {
            wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js?key='.esc_attr($sApiKey) );
        } else {
            wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js', array(), '' );
        }
    }

}
add_action('wp_enqueue_scripts', 'uni_coworking_theme_enqueue_google_maps_script');

// Enqueue style.min.css (default WordPress stylesheet)


function uni_coworking_theme_styles() {

    $environment = ENVIRONMENT;
    $edit_work_theme_version = '1.1.8';
    if ($environment === 'production') {

       wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/dist/css/font-awesome.min.css', array(), '4.7.0' );

       $ot_set_google_fonts  = get_theme_mod( 'ot_set_google_fonts', array() );

       if ( !ot_get_option('uni_google_fonts') || empty($ot_set_google_fonts) ) {
        wp_enqueue_style( 'uni-coworking-theme-fonts', uni_coworking_theme_fonts_url(), array(), '1.1.3' );
    }

    wp_enqueue_style( 'bxslider', get_template_directory_uri() . '/dist/css/bxslider.min.css', array(), '4.2.3' );

    wp_enqueue_style( 'remodal', get_template_directory_uri() . '/dist/css/remodal.min.css', array(), '1.0.5' );

    wp_enqueue_style( 'remodal-default-theme', get_template_directory_uri() . '/dist/css/remodal-default-theme.min.css', array(), '1.0.5' );

    wp_enqueue_style( 'ball-clip-rotate', get_template_directory_uri() . '/dist/css/ball-clip-rotate.min.css', array(), '0.1.0' );

    wp_enqueue_style( 'uni-coworking-theme-styles', get_template_directory_uri() . '/dist/css/style.min.css', array('bxslider', 'remodal', 'remodal-default-theme', 'ball-clip-rotate'), $edit_work_theme_version, 'all' );

    wp_enqueue_style( 'uni-coworking-theme-adaptive', get_template_directory_uri() . '/dist/css/adaptive.min.css', array('uni-coworking-theme-styles'), $edit_work_theme_version, 'screen' );

} else {

    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0' );

    $ot_set_google_fonts  = get_theme_mod( 'ot_set_google_fonts', array() );

    if ( !ot_get_option('uni_google_fonts') || empty($ot_set_google_fonts) ) {
        wp_enqueue_style( 'uni-coworking-theme-fonts', uni_coworking_theme_fonts_url(), array(), '1.1.3' ); }

        wp_enqueue_style( 'bxslider', get_template_directory_uri() . '/css/bxslider.css', array(), '4.2.3' );

        wp_enqueue_style( 'remodal', get_template_directory_uri() . '/css/remodal.css', array(), '1.0.5' );

        wp_enqueue_style( 'remodal-default-theme', get_template_directory_uri() . '/css/remodal-default-theme.css', array(), '1.0.5' );

        wp_enqueue_style( 'ball-clip-rotate', get_template_directory_uri() . '/css/ball-clip-rotate.css', array(), '0.1.0' );

        wp_enqueue_style( 'uni-coworking-theme-styles', get_template_directory_uri() . '/css/style.css', array('bxslider', 'remodal',
            'remodal-default-theme', 'ball-clip-rotate'), $edit_work_theme_version, 'all' );

        wp_enqueue_style( 'uni-coworking-theme-adaptive', get_template_directory_uri() . '/css/adaptive.css', array('uni-coworking-theme-styles'), '1.1.3', 'screen' );
    }


}
add_action( 'wp_enqueue_scripts', 'uni_coworking_theme_styles' );


function uni_coworking_theme_fonts_url() {
    $fonts_url = '';

    $ot_set_google_fonts  = get_theme_mod( 'ot_set_google_fonts', array() );

    if ( empty($ot_set_google_fonts) ) {
        $font_families = array();
        $font_families[] = 'Lato:300,300italic,regular,italic,700,700italic';
        $font_families[] = 'Montserrat:700,regular';

        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
    return esc_url_raw( $fonts_url );
}

// outputs 'header' tag with theme's menu and logo
add_action( 'uni_coworking_theme_header', 'uni_coworking_theme_header_div_output', 10 );
function uni_coworking_theme_header_div_output(){

    do_action( 'uni_coworking_theme_header_wrapper_before' );

    $aLogoTransparentPadding = ot_get_option( 'uni_logo_padding' );
    $aLogoTransparentPadding = ( !isset($aLogoTransparentPadding['top']) || !isset($aLogoTransparentPadding['right']) || !isset($aLogoTransparentPadding['bottom']) || !isset($aLogoTransparentPadding['left']) || !isset($aLogoTransparentPadding['unit']) ) ? array('top' => 30, 'right' => 38, 'bottom' => 26, 'left' => 39, 'unit' => 'px') : ot_get_option( 'uni_logo_padding' );
    $aLogoStickyPadding = ot_get_option( 'uni_logo_padding_sticky' );
    $aLogoStickyPadding = ( !isset($aLogoStickyPadding['top']) || !isset($aLogoStickyPadding['right']) || !isset($aLogoStickyPadding['bottom']) || !isset($aLogoStickyPadding['left']) || !isset($aLogoStickyPadding['unit']) ) ? array('top' => 23, 'right' => 38, 'bottom' => 21, 'left' => 39, 'unit' => 'px') : ot_get_option( 'uni_logo_padding_sticky' );
    $iImageHeight = ( ot_get_option( 'uni_logo_height' ) ) ? intval( ot_get_option( 'uni_logo_height' ) ) : '';

        // .bookATour line-height calculation
    $iLineHeightTransparent = ( ( !empty($iImageHeight) ) ? $iImageHeight : 16 ) + intval($aLogoTransparentPadding['top']) + intval($aLogoTransparentPadding['bottom']);
    $iLineHeightSticky = ( ( !empty($iImageHeight) ) ? $iImageHeight : 16 ) + intval($aLogoStickyPadding['top']) + intval($aLogoStickyPadding['bottom']);

    ?>

    <header id="header" data-header-sticky-height="<?php echo esc_attr($iLineHeightSticky + 1) ?>" style="height:<?php echo esc_attr($iLineHeightTransparent + 1) ?>px;">
        <style scoped>
        .headerWrap.isSticky {line-height: <?php echo esc_attr($iLineHeightSticky) ?>px!important;}

        .logo {padding: <?php echo intval($aLogoTransparentPadding['top']).esc_attr($aLogoTransparentPadding['unit']); ?> <?php echo intval($aLogoTransparentPadding['right']).esc_attr($aLogoTransparentPadding['unit']); ?> <?php echo intval($aLogoTransparentPadding['bottom']).esc_attr($aLogoTransparentPadding['unit']); ?> <?php echo intval($aLogoTransparentPadding['left']).esc_attr($aLogoTransparentPadding['unit']); ?>;}
        .isSticky .logo {padding: <?php echo intval($aLogoStickyPadding['top']).esc_attr($aLogoStickyPadding['unit']); ?> <?php echo intval($aLogoStickyPadding['right']).esc_attr($aLogoStickyPadding['unit']); ?> <?php echo intval($aLogoStickyPadding['bottom']).esc_attr($aLogoStickyPadding['unit']); ?> <?php echo intval($aLogoStickyPadding['left']).esc_attr($aLogoStickyPadding['unit']); ?>;}

        <?php if ( ot_get_option('uni_header_book_tour_link_enable') != 'off' ) { ?>
            .bookATour {line-height: <?php echo esc_attr($iLineHeightTransparent) ?>px;padding: 0 41px 0 39px;}
            .isSticky .bookATour {line-height: <?php echo esc_attr($iLineHeightSticky) ?>px;}
            <?php } ?>
        </style>
        <div class="headerWrap uni-clear" style="line-height:<?php echo esc_attr($iLineHeightTransparent) ?>px;">

            <?php if ( ot_get_option('uni_logo_header_type') === 'image-text' ) {
                $logo_text = ot_get_option('uni_logo_header_text');
                ?>

                <a href="<?php echo esc_url( home_url('/') ); ?>" rel="home" itemprop="url" class="logo logo-image-text uni-clear">
                    <?php
                    uni_coworking_theme_the_custom_logo_a();
                    uni_coworking_theme_the_custom_logo_b();
                    ?>
                    <span><?php if ( ! empty($logo_text) ) { echo esc_html($logo_text); } else { bloginfo('name'); } ?></span>
                </a>

                <?php } else if ( ot_get_option('uni_logo_header_type') === 'text' ) {
                    $logo_text = ot_get_option('uni_logo_header_text');
                    ?>

                    <a href="<?php echo esc_url( home_url('/') ); ?>" rel="home" itemprop="url" class="logo logo-text">
                        <?php if ( ! empty($logo_text) ) { echo esc_html($logo_text); } else { bloginfo('name'); } ?>
                    </a>

                    <?php } else { ?>

                    <a href="<?php echo esc_url( home_url('/') ); ?>" rel="home" itemprop="url" class="logo">
                        <?php
                        uni_coworking_theme_the_custom_logo_a();
                        uni_coworking_theme_the_custom_logo_b();
                        ?>
                    </a>

                    <?php } ?>

                    <?php wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mainMenu', 'menu_class' => 'uni-clear', 'theme_location' => 'primary', 'depth' => 3, 'fallback_cb'=> 'uni_coworking_theme_nav_fallback' ) ); ?>

                    <?php if ( ot_get_option('uni_header_book_tour_link_enable') != 'off' ) { ?>
                    <?php if ( ot_get_option('uni_header_book_tour_link_custom_enable') != 'on' ) { ?>
                    <a data-remodal-target="bookingForm" href="" class="bookATour"><?php if ( ot_get_option('uni_header_book_tour_link_text') ) { $sBookTourLink = ot_get_option('uni_header_book_tour_link_text'); echo esc_html($sBookTourLink); } else { esc_html_e('book a tour', 'coworking'); } ?></a>
                    <?php } else { ?>
                    <a href="<?php echo esc_url( ot_get_option('uni_header_book_tour_link_custom_uri') ); ?>" class="bookATour" target="_blank"><?php if ( ot_get_option('uni_header_book_tour_link_text') ) { $sBookTourLink = ot_get_option('uni_header_book_tour_link_text'); echo esc_html($sBookTourLink); } else { esc_html_e('book a tour', 'coworking'); } ?></a>
                    <?php } ?>
                    <?php } ?>

                    <span class="showMobileMenu">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </div>
            </header>
            <?php

            do_action( 'uni_coworking_theme_header_wrapper_after' );
        }

//
        add_action( 'uni_coworking_theme_header_wrapper_before', 'uni_coworking_theme_loader', 10 );
        function uni_coworking_theme_loader(){
            if ( ot_get_option( 'uni_preloader_enable' ) != 'off' ) {
                ?>
                <div class="loaderWrap">
                    <div class="la-ball-clip-rotate la-dark">
                        <div></div>
                    </div>
                </div>
                <?php }
            }

//
            function uni_coworking_theme_the_custom_logo_a( $blog_id = 0 ) {
                echo uni_coworking_theme_get_custom_logo_a( $blog_id );
            }

//
            function uni_coworking_theme_get_custom_logo_a( $blog_id = 0 ) {
                $html = '';

                if ( is_multisite() && (int) $blog_id !== get_current_blog_id() ) {
                    switch_to_blog( $blog_id );
                }

                $sLogoAId = ot_get_option( 'uni_custom_logo_a' );

    // We have a logo. Logo is go.
                if ( $sLogoAId ) {
                    $html .= wp_get_attachment_image( $sLogoAId, 'full', false, array(
                        'class'    => 'logo-black uni-custom-logo-a',
                        'itemprop' => 'logo',
                    )
                );
                } else {
                    $html .= '<img class="logo-black uni-custom-logo-a" src="'.get_template_directory_uri().'/images/edit-work.svg" alt="'.esc_attr(get_bloginfo('description')).'">';
                }

                if ( is_multisite() && ms_is_switched() ) {
                    restore_current_blog();
                }

                return apply_filters( 'uni_coworking_theme_get_custom_logo_a', $html );
            }

//
            function uni_coworking_theme_the_custom_logo_b( $blog_id = 0 ) {
                echo uni_coworking_theme_get_custom_logo_b( $blog_id );
            }

//
            function uni_coworking_theme_get_custom_logo_b( $blog_id = 0 ) {
                $html = '';

                if ( is_multisite() && (int) $blog_id !== get_current_blog_id() ) {
                    switch_to_blog( $blog_id );
                }

                $sLogoBId = ot_get_option( 'uni_custom_logo_b' );

    // We have a logo. Logo is go.
                if ( $sLogoBId ) {
                    $html .= wp_get_attachment_image( $sLogoBId, 'full', false, array(
                        'class'    => 'logo-white uni-custom-logo-b',
                        'itemprop' => 'logo',
                    )
                );
                } else {
                    $html .= '<img class="logo-white uni-custom-logo-b" src="'.get_template_directory_uri().'/images/edit-work.svg" alt="'.esc_attr(get_bloginfo('description')).'">';
                }

                if ( is_multisite() && ms_is_switched() ) {
                    restore_current_blog();
                }

                return apply_filters( 'uni_coworking_theme_get_custom_logo_b', $html );
            }

// outputs social icons in the footer
            function uni_coworking_theme_footer_social_icons_output(){
                if ( ot_get_option( 'uni_social_section_enable' ) === 'on' ) {
                    ?>
                    <div class="footerSocial">
                        <?php
                        $aSocialLinks = maybe_unserialize( ot_get_option('uni_social_links_list') );
                        if ( isset($aSocialLinks) && is_array($aSocialLinks) && !empty($aSocialLinks) ) {
                            foreach( $aSocialLinks as $aLink ) {
                                ?>
                                <div class="footerSocialItem">
                                    <a href="<?php echo esc_url( $aLink['uni_s_icon_link'] ) ?>" target="_blank">
                                        <i class="<?php echo esc_attr( $aLink['uni_s_icon_type'] ) ?>"></i>
                                        <?php echo esc_html( $aLink['uni_s_icon_title'] ) ?>
                                    </a>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <?php
                }
            }

// outputs logo in the footer
            function uni_coworking_theme_footer_logo_output(){
                ?>
                <a href="<?php echo esc_url( home_url('/') ); ?>">
                    <?php
                    uni_coworking_theme_the_custom_logo_footer();
                    ?>
                </a>
                <?php
            }

//
            function uni_coworking_theme_the_custom_logo_footer( $blog_id = 0 ) {
                echo uni_coworking_theme_get_custom_logo_footer( $blog_id );
            }

//
            function uni_coworking_theme_get_custom_logo_footer( $blog_id = 0 ) {
                $html = '';

                if ( is_multisite() && (int) $blog_id !== get_current_blog_id() ) {
                    switch_to_blog( $blog_id );
                }

                $sLogoBId = ot_get_option( 'uni_custom_logo_footer' );

    // We have a logo. Logo is go.
                if ( $sLogoBId ) {
                    $html .= wp_get_attachment_image( $sLogoBId, 'full', false, array(
                        'class'    => 'uni-custom-logo-footer',
                        'itemprop' => 'logo',
                    )
                );
                } else {
                    $html .= '<img class="uni-custom-logo-footer" src="'.get_template_directory_uri().'/images/edit-work.svg" alt="'.esc_attr(get_bloginfo('description')).'">';
                }

                if ( is_multisite() && ms_is_switched() ) {
                    restore_current_blog();
                }

                return apply_filters( 'uni_coworking_theme_get_custom_logo_footer', $html );
            }

//
            add_action('wp_footer', 'uni_coworking_theme_mobile_menu_output', 10);
            function uni_coworking_theme_mobile_menu_output(){
                ?>
                <div class="mobileMenu">

                    <?php wp_nav_menu( array( 'container' => '', 'container_class' => '', 'menu_class' => '', 'theme_location' => 'primary', 'depth' => 3, 'fallback_cb'=> 'uni_coworking_theme_nav_mobile_fallback' ) ); ?>

                    <div class="mobileSocial uni-clear">
                        <?php
                        $aSocialLinks = maybe_unserialize( ot_get_option('uni_social_links_list') );
                        if ( isset($aSocialLinks) && is_array($aSocialLinks) && !empty($aSocialLinks) ) {
                            foreach( $aSocialLinks as $aLink ) {
                                echo '<a href="'.esc_url( $aLink['uni_s_icon_link'] ).'"><i class="'.esc_attr( $aLink['uni_s_icon_type'] ).'"></i></a>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php
            }

//
            add_action('wp_footer', 'uni_coworking_theme_booking_form_output', 10);
            function uni_coworking_theme_booking_form_output(){
                if ( ot_get_option('uni_header_book_tour_link_enable') !== 'off' ) {
                    ?>
                    <div class="bookingForm" data-remodal-id="bookingForm">
                        <span data-remodal-action="close" class="thmRemodalClose"><?php esc_html_e('Close', 'coworking'); ?></span>
                        <div class="remodalFormWrap uni-clear">
                            <h3><?php if ( ot_get_option('uni_header_book_tour_link_text') ) { $sBookTourLink = ot_get_option('uni_header_book_tour_link_text'); echo esc_html($sBookTourLink); } else { esc_html_e('Book a Tour', 'coworking'); } ?></h3>

                            <form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" class="bookingFormWrap uni-clear uni_form">
                                <input type="hidden" name="uni_contact_nonce" value="<?php echo wp_create_nonce('uni_nonce') ?>" />
                                <input type="hidden" name="action" value="uni_coworking_theme_book_tour_form" />

                                <p><?php esc_html_e('Gostarias de ver o nosso espaço antes de te juntares a nós? Vem visitar-nos. Preenche, por favor, o formulário e entraremos em contacto contigo.', 'coworking'); ?></p>
                                <div class="inputWrap">
                                    <input type="text" name="uni_contact_firstname" value="" placeholder="<?php esc_html_e('Nome', 'coworking'); ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit">
                                </div>
                                <div class="inputWrap">
                                    <input type="text" name="uni_contact_lastname" value="" placeholder="<?php esc_html_e('Apelido', 'coworking'); ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit">
                                </div>
                                <div class="inputWrap">
                                    <input type="email" name="uni_contact_email" value="" placeholder="<?php esc_html_e('Email', 'coworking'); ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit" data-parsley-type="email">
                                </div>
                                <div class="inputWrap">
                                    <input type="tel" name="uni_contact_phone" value="" placeholder="<?php esc_html_e('Phone', 'coworking'); ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit" data-parsley-type="integer">
                                </div>
                                <div class="uni-clear"></div>
                                <?php if ( ot_get_option('uni_form_msg_bottom_book_tour_enable') && ot_get_option('uni_form_msg_bottom_book_tour_enable') === 'on' ) { ?>
                                <p class="formMsg"><?php echo ( ot_get_option('uni_form_msg_bottom_book_tour_text') ) ? ot_get_option('uni_form_msg_bottom_book_tour_text') : ''; ?></p>
                                <?php } ?>
                                <input class="thmSubmitBtn uni_input_submit" type="button" value="<?php esc_html_e('Enviar', 'coworking'); ?>">
                            </form>
                        </div>
                    </div>
                    <?php
                }
            }

//
            add_action('wp_footer', 'uni_coworking_theme_join_form_output', 10);
            function uni_coworking_theme_join_form_output(){
                if (
                    ( ot_get_option('uni_home_about_one_enable') === 'on' && is_page_template('templ-home.php') )
                    || is_page_template('templ-about.php')
                ) {

                    if ( is_page_template('templ-about.php') ) {
                        global $post;
                        $aPostCustom    = get_post_custom( $post->ID );
                        $link_enable    = ( isset($aPostCustom['uni_about_us_link_on'][0]) ) ? $aPostCustom['uni_about_us_link_on'][0] : 'off';
                        $link_uri       = ( isset($aPostCustom['uni_about_us_link_uri'][0]) ) ? $aPostCustom['uni_about_us_link_uri'][0] : '';
                        if ( 'off' === $link_enable || ! empty($link_uri) ) {
                            return;
                        }
                    }
                    ?>
                    <div class="joinForm" data-remodal-id="joinForm">
                        <span data-remodal-action="close" class="thmRemodalClose"><?php esc_html_e('Close', 'coworking'); ?></span>
                        <div class="remodalFormWrap uni-clear">
                            <h3><?php esc_html_e('Join Now', 'coworking'); ?></h3>

                            <form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" class="joinFormWrap uni-clear uni_form">
                                <input type="hidden" name="uni_contact_nonce" value="<?php echo wp_create_nonce('uni_nonce') ?>" />
                                <input type="hidden" name="action" value="uni_coworking_theme_book_tour_form" />

                                <p><?php esc_html_e('Join our great coworking space and community. Preenche, por favor, o formulário e entraremos em contacto contigo.', 'coworking'); ?></p>
                                <div class="inputWrap">
                                    <input type="text" name="uni_contact_firstname" value="" placeholder="<?php esc_html_e('Nome', 'coworking'); ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit">
                                </div>
                                <div class="inputWrap">
                                    <input type="text" name="uni_contact_lastname" value="" placeholder="<?php esc_html_e('Apelido', 'coworking'); ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit">
                                </div>
                                <div class="inputWrap">
                                    <input type="email" name="uni_contact_email" value="" placeholder="<?php esc_html_e('Email', 'coworking'); ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit" data-parsley-type="email">
                                </div>
                                <div class="inputWrap">
                                    <input type="tel" name="uni_contact_phone" value="" placeholder="<?php esc_html_e('Phone', 'coworking'); ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit" data-parsley-type="integer">
                                </div>
                                <?php if ( ot_get_option('uni_form_msg_bottom_join_form_enable') && ot_get_option('uni_form_msg_bottom_join_form_enable') === 'on' ) { ?>
                                <p class="formMsg"><?php echo ( ot_get_option('uni_form_msg_bottom_join_form_text') ) ? ot_get_option('uni_form_msg_bottom_join_form_text') : ''; ?></p>
                                <?php } ?>
                                <input class="thmSubmitBtn uni_input_submit" type="button" value="<?php esc_html_e('Enviar', 'coworking'); ?>">
                            </form>

                        </div>
                    </div>
                    <?php
                }
            }

//
            add_action('wp_footer', 'uni_coworking_theme_price_form_output', 10);
            function uni_coworking_theme_price_form_output(){
                if ( ( ot_get_option('uni_home_price_tabels_enable') === 'on' && is_page_template( 'templ-home.php' )
                    && ot_get_option( 'uni_ordernow_btn_price_tables_enable' ) && ot_get_option( 'uni_ordernow_btn_price_tables_enable' ) !== 'off' )
                    ||  is_page_template( 'templ-plans.php' )
                ) {

                    if ( is_page_template('templ-plans.php') ) {
                        global $post;
                        $aPostCustom    = get_post_custom( $post->ID );
                        $calendarius_int_enable = ( isset($aPostCustom['uni_plans_calendarius_cobot_plans_enable'][0]) ) ? $aPostCustom['uni_plans_calendarius_cobot_plans_enable'][0] : 'off';
                        if ( 'on' === $calendarius_int_enable && isset($aPostCustom['uni_plans_cal_id'][0]) ) {
                            return;
                        }
                    }
                    ?>
                    <div class="priceForm" data-remodal-id="priceForm">
                        <span data-remodal-action="close" class="thmRemodalClose"><?php esc_html_e('Close', 'coworking'); ?></span>
                        <div class="remodalFormWrap uni-clear">
                            <h3 id="js-price-title"><?php esc_html_e('Order form', 'coworking'); ?></h3>

                            <form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" class="priceFormWrap uni-clear uni_form">
                                <input type="hidden" name="uni_contact_nonce" value="<?php echo wp_create_nonce('uni_nonce') ?>" />
                                <input type="hidden" name="action" value="uni_coworking_theme_price_form" />
                                <input type="hidden" name="uni_price_id" value="" />

                                <p><?php esc_html_e('Preenche, por favor, o formulário e entraremos em contacto contigo.', 'coworking'); ?></p>
                                <div class="inputWrap">
                                    <input type="text" name="uni_contact_firstname" value="" placeholder="<?php esc_html_e('Nome', 'coworking') ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit">
                                </div>
                                <div class="inputWrap">
                                    <input type="text" name="uni_contact_lastname" value="" placeholder="<?php esc_html_e('Apelido', 'coworking') ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit">
                                </div>
                                <div class="inputWrap">
                                    <input type="text" name="uni_contact_email" value="" placeholder="<?php esc_html_e('Email', 'coworking') ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit"  data-parsley-type="email">
                                </div>
                                <div class="inputWrap">
                                    <input type="text" name="uni_contact_phone" value="" placeholder="<?php esc_html_e('Telemóvel', 'coworking') ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit" data-parsley-type="integer">
                                </div>

                                <div class="textareaWrap">
                                    <textarea name="uni_contact_msg" cols="30" rows="10" placeholder="<?php esc_html_e('Mensagem', 'coworking') ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit"></textarea>
                                </div>
                                <?php if ( ot_get_option('uni_form_msg_bottom_order_form_enable') && ot_get_option('uni_form_msg_bottom_order_form_enable') === 'on' ) { ?>
                                <p class="formMsg"><?php echo ( ot_get_option('uni_form_msg_bottom_order_form_text') ) ? ot_get_option('uni_form_msg_bottom_order_form_text') : ''; ?></p>
                                <?php } ?>
                                <input class="thmSubmitBtn uni_input_submit" type="button" value="<?php esc_html_e('Enviar', 'coworking') ?>">
                            </form>

                        </div>
                    </div>
                    <?php
                }
            }

//
            add_filter( 'uni_ec_init_cals_ids_filter', 'uni_coworking_theme_add_calendarius_cal_id', 10, 2 );
            function uni_coworking_theme_add_calendarius_cal_id( $cal_ids, $page_id ) {
                $page_template = get_page_template_slug( $page_id );
                if ( 'templ-home.php' === $page_template ) {
                    if ( ot_get_option( 'uni_home_price_tabels_plans_enable' ) === 'on' &&
                        ( ot_get_option( 'uni_home_price_tabels_plans_cobot_enable' ) === 'on' && class_exists( 'Uni_Calendar' ) ) ) {
                        $cal_id = intval( ot_get_option( 'uni_home_price_tabels_plans_cobot_cal_id' ) );
                    add_filter( 'uni_ec_cobot_plans_shortcode_tmpl_path_filter', 'uni_coworking_theme_cobot_plans_home_tmpl', 10, 2 );
                    return $cal_ids = array( $cal_id );
                }
                return $cal_ids;
            }
            if ( 'templ-plans.php' === $page_template ) {
                $aPostCustom    = get_post_custom( $page_id );
                $calendarius_int_enable = ( isset($aPostCustom['uni_plans_calendarius_cobot_plans_enable'][0]) ) ? $aPostCustom['uni_plans_calendarius_cobot_plans_enable'][0] : 'off';
                if ( 'on' === $calendarius_int_enable && isset($aPostCustom['uni_plans_cal_id'][0]) ) {
                    $cal_id = intval( $aPostCustom['uni_plans_cal_id'][0] );
                    add_filter( 'uni_ec_cobot_plans_shortcode_tmpl_path_filter', 'uni_coworking_theme_cobot_plans_tmpl', 10, 2 );
                    return $cal_ids = array( $cal_id );
                }
                return $cal_ids;
            }
            return $cal_ids;
        }

//
        function uni_coworking_theme_cobot_plans_tmpl( $orig_tmpl_path, $cal_id ) {
            return get_template_directory() . '/includes/calendarius/uni-ec-cobot-plans.php';
        }

//
        function uni_coworking_theme_cobot_plans_home_tmpl( $orig_tmpl_path, $cal_id ) {
            return get_template_directory() . '/includes/calendarius/uni-ec-cobot-plans-home.php';
        }

//
        add_action('wp_head', 'uni_coworking_theme_comments_reply');
        function uni_coworking_theme_comments_reply(){
            if ( is_singular() ) {
                wp_enqueue_script( 'comment-reply' );
            }
        }

// custom fonts
        add_action('wp_head', 'uni_coworking_theme_custom_fonts_customisation', 10);
        function uni_coworking_theme_custom_fonts_customisation(){
    // helps customize fonts
            if ( ot_get_option('uni_google_fonts')  ) {
                $aCustomFonts           = ot_get_option('uni_google_fonts');
                $ot_google_fonts        = get_theme_mod( 'ot_google_fonts', array() );
                $ot_set_google_fonts    = get_theme_mod( 'ot_set_google_fonts', array() );
                $sFontNameOne = $sFontNameTwo = '';

                if ( isset($ot_set_google_fonts) && !empty($ot_set_google_fonts) ) {
                    if ( isset($aCustomFonts[0]) && !empty($aCustomFonts[0]) && isset($ot_google_fonts[$aCustomFonts[0]["family"]]) ) $sFontNameOne = $ot_google_fonts[$aCustomFonts[0]["family"]]['family'];
                    if ( isset($aCustomFonts[1]) && !empty($aCustomFonts[1]) && isset($ot_google_fonts[$aCustomFonts[1]["family"]]) ) $sFontNameTwo = $ot_google_fonts[$aCustomFonts[1]["family"]]['family'];

                    if ( !empty($sFontNameOne) &&  $sFontNameOne != 'Lato' ) {
                        ?>
                        <style type="text/css">
                        /* custom font for regular text */
                        select, textarea, input, body, .tickera-checkout {font-family: '<?php echo esc_attr( $sFontNameOne ); ?>';}
                    </style>
                    <?php
                }

                if ( !empty($sFontNameTwo) && $sFontNameTwo != 'Montserrat' ) {
                    ?>
                    <style type="text/css">
                    /* custom font for headings */
                    .uni-contact-form-wrap h3, .uni-our-team-item h3, .uniPricingItem  .scell h3, .uniPricingItemLink, .uniPricingItemLink:visited, .screenDesc2 h3,
                    #tickera_cart .tickera-button, .singleEventJoinBtnWrap a, .singleEventJoinBtnWrap a:visited, .woocommerce form.register p .button,
                    #wp-calendar thead th, .woocommerce .widget_shopping_cart .buttons .button, .woocommerce.widget_shopping_cart .buttons .button, .woocommerce form.lost_reset_password p .button,
                    .woocommerce table.my_account_orders .order-actions a.button.view, body.woocommerce-edit-address .woocommerce form .button, .sidebar-widget .widgettitle, a.rsswidget,
                    .woocommerce form.login .form-row .button, .woocommerce form.checkout_coupon .form-row .button, body .woocommerce form.edit-account fieldset legend, .woocommerce form.edit-account p .button,
                    .page.woocommerce-cart .return-to-shop a.button, .woocommerce #tab-reviews #reviews #comments ol.commentlist li .comment-text p.meta time, #review_form #commentform #submit,
                    #tab-additional_information h2, #review_form_wrapper .comment-reply-title, .single-product .woocommerce-tabs #tab-reviews h2, .single-product .woocommerce-tabs #tab-description h2,
                    .comment-wrapper cite, .comment-wrapper cite a, .no-comments, body.single-product .woocommerce-tabs .tabs li a, body.single-product .woocommerce-tabs .tabs li a:visited,
                    .commentsBox h2, .commentsBox h3, .commentsBox h3 a, .commentsBox h3 a:visited, #commentform #submit, .pagination ul li a, .pagination ul li a:visited, .pagination ul li .current, 
                    .woocommerce-pagination ul li span.current, .woocommerce-pagination ul li a, .woocommerce-pagination ul li a:visited,
                    .pagination ul li .dots, .comment-edit-link, .comment-edit-link:visited, .comment-reply-link, .comment-reply-link:visited,
                    .postItemMeta, .postItemCategory, .postItemCategory:visited, .singleMeta, .singlePostWrap h1, .singlePostWrap h2, .singlePostWrap h3, .singlePostWrap h4, .singlePostWrap h5, .singlePostWrap h6,
                    .comment-content h1, .comment-content h2, .comment-content h3, .comment-content h4, .comment-content h5, .comment-content h6,
                    .singlePostWrap h6 a, .singlePostWrap h6 a:visited, .singlePostWrap h5 a, .singlePostWrap h5 a:visited, .singlePostWrap h4 a, .singlePostWrap h4 a:visited, .singlePostWrap h3 a, .singlePostWrap h3 a:visited, 
                    .singlePostWrap h2 a, .singlePostWrap h2 a:visited, .singlePostWrap h1 a, .singlePostWrap h1 a:visited,
                    .comment-content h6 a, .comment-content h6 a:visited, .comment-content h5 a, .comment-content h5 a:visited, .comment-content h4 a, .comment-content h4 a:visited, .comment-content h3 a, .comment-content h3 a:visited,
                    .comment-content h2 a, .comment-content h2 a:visited, .comment-content h1 a, .comment-content h1 a:visited,
                    .woocommerce-cart .wc-proceed-to-checkout .checkout-button, .woocommerce .shipping-calculator-form p button.button, .singleProductDesc h1, .singleProductDesc p.cart .single_add_to_cart_button,
                    .singleProductDesc form.cart .single_add_to_cart_button, .mobileMenu ul li a, .mobileMenu ul li a:visited, .postItemV2 h3 a, .postItemV2 h3 a:visited,
                    .pageTitle, .woocommerce #payment #place_order, .page404Wrap a.homePage, .page404Wrap a.homePage:visited, .coupon input[name="apply_coupon"], .actions input[name="update_cart"],
                    .pageHeaderImg h1, .productFilter li a, .productFilter li a:visited, .miniCartPopupHead h3, .btnViewCart, .btnViewCart:visited, .btnCheckout, .btnCheckout:visited,
                    .screenDesc h1, .bookATourLink, .bookATourLink:visited, .blockTitle, .homeAboutUs h3, .homeAboutUs .joinNow, .homeAboutUs .joinNow:visited, .secondScreen h3, .pricingPlanItem h3, 
                    .pricingPlanItem .joinNow, .pricingPlanItem .joinNow:visited, .productDesc p, .shopLink, .shopLink:visited, .aboutLink, .aboutLink:visited, .blogLink, .blogLink:visited, .allEventsBtn, .allEventsBtn:visited, .tagsBox span,
                    .attendBtn, .attendBtn:visited, .eventTime strong, .contactInfoDesc h3, .subscribeBox h3, .subscribeBtn, .instagramHashtag h3 a, .instagramHashtag h3 a:visited, .thmSubmitBtn, .singleMeta time,
                    .footerSocialItem a, .footerSocialItem a:visited, .footerMenu ul li a, .footerMenu ul li a:visited, .mainMenu > ul > li ul.sub-menu li a, .mainMenu > ul > li ul.sub-menu li a:visited,
                    .back_to_other_events, .back_to_other_events:visited, .loadMore, .loadMore:visited, .postItem h3 a, .postItemMeta time, .wpcf7-submit,
                    .mainMenu > ul > li > a, .mainMenu > ul > li > a:visited, .bookATour, .logo-text {font-family: '<?php echo esc_attr( $sFontNameTwo ); ?>';}
                </style>
                <?php
            }
        }
    }
}

// custom theme colours
add_action('wp_head', 'uni_coworking_theme_custom_colours_customisation', 10);
function uni_coworking_theme_custom_colours_customisation(){
    // helps customize colours
    $sColourOne = ot_get_option('uni_color_primary_colour');
    $sColourTwo = ot_get_option('uni_color_secondary_colour');

    if ( ( isset($sColourOne) && isset($sColourTwo) && !empty($sColourOne) && !empty($sColourTwo) )
        && ( ( $sColourOne != '#2ebd7f' || $sColourTwo != '#2bc683' ) || ( $sColourOne != '#2ebd7f' || $sColourTwo != '#2bc683' ) ) ) {
            ?>
        <style type="text/css">
        /* primary colour */
        #tickera_cart .tickera-button:hover, #review_form #commentform #submit:hover,
        .woocommerce-pagination ul li a.next.page-numbers:active, .woocommerce-pagination ul li a.next.page-numbers:focus, .woocommerce-pagination ul li a.next.page-numbers:hover,
        .woocommerce-pagination ul li a.prev.page-numbers:active, .woocommerce-pagination ul li a.prev.page-numbers:focus, .woocommerce-pagination ul li a.prev.page-numbers:hover,
        .woocommerce .widget_shopping_cart .buttons .button:hover, .woocommerce.widget_shopping_cart .buttons .button:hover, .pagination ul li a:hover, .pagination ul li .current,
        .woocommerce-pagination ul li a:active, .woocommerce-pagination ul li a:focus, .woocommerce-pagination ul li span.current, .woocommerce-pagination ul li a:hover,
        .bookATour:hover, .actions input[name="update_cart"]:hover, .woocommerce .shipping-calculator-form p button.button:hover, .page.woocommerce-cart .return-to-shop a.button:hover,
        .coupon input[name="apply_coupon"]:hover {background-color: <?php echo esc_attr( $sColourOne ); ?>!important;}
        .bookATour:hover, .actions input[name="update_cart"], .woocommerce .shipping-calculator-form p button.button, .page.woocommerce-cart .return-to-shop a.button,
        .pagination ul li a:hover, .pagination ul li .current,
        .woocommerce-pagination ul li a:active, .woocommerce-pagination ul li a:focus, .woocommerce-pagination ul li span.current, .woocommerce-pagination ul li a:hover,
        .coupon input[name="apply_coupon"] {border-color: <?php echo esc_attr( $sColourOne ); ?>!important;}
        .woocommerce ul.cart_list li a:visited, .woocommerce ul.product_list_widget li a:visited,
        .woocommerce ul.cart_list li a, .woocommerce ul.product_list_widget li a, .thankYouWrap .order_details tbody td a,
        body.single-product .woocommerce-tabs .tabs li.active a, body.single-product .woocommerce-tabs .tabs li a:hover,
        .actions input[name="update_cart"], .woocommerce .shipping-calculator-form p button.button, .page.woocommerce-cart .return-to-shop a.button,
        .woocommerce-breadcrumb a:hover, .coupon input[name="apply_coupon"] {color: <?php echo esc_attr( $sColourOne ); ?>!important;}

        .singleProductDesc p.cart .single_add_to_cart_button:hover,
        .singleProductDesc form.cart .single_add_to_cart_button:hover,
        .eventDetailItem, .singleEventJoinBtnWrap a:hover, .woocommerce #payment #place_order,
        .woocommerce table.my_account_orders .order-actions a.button.view,
        body.woocommerce-edit-address .woocommerce form .button, .tc_the_content_pre span i,
        .woocommerce form.lost_reset_password p .button, #wp-calendar tbody td a:hover,
        .woocommerce form.edit-account p .button, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
        .woocommerce form.checkout_coupon .form-row .button, .woocommerce form.register p .button,
        .woocommerce form.login .form-row .button, .page404Wrap a.homePage, .page404Wrap a.homePage:visited,
        #commentform #submit:hover, .btnViewCart:hover, .btnCheckout, .btnCheckout:visited,
        .singlePostWrap > ul li:before, .comment-content > ul li:before,
        .singleMeta h1:before, .bypostauthor .comment-wrapper .uni-post-author,
        span.price, .contactInfo, .subscribeBtn, .remodalFormWrap h3, .thmSubmitBtn,
        .pricingPlanItem .joinNow, .pricingPlanItem .joinNow:visited,
        .homeAboutUs .joinNow, .homeAboutUs .joinNow:visited,
        .bookATourLink, .bookATourLink:visited, .bookATour:before {background: <?php echo esc_attr( $sColourOne ); ?>;}

        .singleProductDesc p.cart .single_add_to_cart_button, #review_form #commentform #submit,
        .singleProductDesc form.cart .single_add_to_cart_button, #tickera_cart .tickera-button,
        .btnViewCart, .btnViewCart:visited, .singleEventJoinBtnWrap a, .singleEventJoinBtnWrap a:visited,
        .singlePostWrap blockquote, #commentform #submit, .woocommerce .widget_shopping_cart .buttons .button, .woocommerce.widget_shopping_cart .buttons .button,
        .comment-content blockquote, .btnCheckout, .btnCheckout:visited,
        .shopLink, .shopLink:visited, .blogLink, .blogLink:visited, .aboutLink, .aboutLink:visited {border-color: <?php echo esc_attr( $sColourOne ); ?>;}
        
        .uniPricingItemLink svg path,
        .aboutLink svg path, .blogLink svg path, .shopLink svg path, .attendBtn svg path, .benefitItem i:not(.fa) svg path, .subscribeIcon svg path,
        .page-template-templ-events-php .eventItem:hover .attendBtn svg path,
        .page-template-templ-events-tickera .eventItem:hover .attendBtn svg path {fill: <?php echo esc_attr( $sColourOne ); ?>;}

        .uniPricingItemPrice,
        .woocommerce-MyAccount-navigation li a:hover, .uniPricingItemLink, .uniPricingItemLink, .uniPricingItemLink:visited,
        .post-type-archive-product.woocommerce .star-rating:before, .homeShop.woocommerce .star-rating:before,
        .woocommerce #review_form p.stars.selected a:before, .woocommerce-review-link:hover, .woocommerce .star-rating span,
        .woocommerce #review_form p.stars:hover a:before, .woocommerce #tab-reviews #reviews #comments ol.commentlist li .comment-text p.meta time,
        .uni-bridallist-link.uni-bridallist-link-added, .uni-bridallist-link.uni-bridallist-link-added i,
        .uni-wishlist-link.uni-wishlist-link-added, .uni-wishlist-link.uni-wishlist-link-added i,
        .uni-bridallist-link:hover, .uni-wishlist-link:hover, #review_form #commentform #submit, #tickera_cart .tickera-button,
        .singleEventJoinBtnWrap a, .singleEventJoinBtnWrap a:visited, .checkoutPage .scell label[for="payment_method_paypal"] a,
        .page-template-templ-events-php .eventItem:hover .attendBtn, .page-template-templ-events-php .eventItem:hover .attendBtn:visited,
        .page-template-templ-events-tickera .eventItem:hover .attendBtn, .page-template-templ-events-tickera .eventItem:hover .attendBtn:visited,
        .btnViewCart, .btnViewCart:visited, .lost_password a, .edit, .relatedPostItem h3 a:hover, .relatedPostCategory:hover,
        #commentform #submit, .productFilter li a.active, .productFilter li a:hover, .tc_the_content_pre span,
        .singlePostWrap > ul li a, .singlePostWrap > ul li a:visited, .woocommerce .widget_shopping_cart .buttons .button, .woocommerce.widget_shopping_cart .buttons .button,
        .singlePostWrap > ol li a, .singlePostWrap > ol li a:visited, #wp-calendar tbody td a,
        .comment-content > ul li a, .comment-content > ul li a:visited, .tagcloud a:hover,
        .comment-content > ol li a, .comment-content > ol li a:visited, .sidebar-widget li a:hover,
        .singlePostWrap > ol li:before, .comment-content > ol li:before, .postItemV2 h3 a:hover,
        .singlePostWrap dt a, .singlePostWrap dt a:visited, .woocommerce div.product p.stock,
        .singlePostWrap dd a, .singlePostWrap dd a:visited, .woocommerce div.product form.cart .reset_variations,
        .singlePostWrap p a, .singlePostWrap p a:visited, .product_meta > span a, .product_meta > span a:visited,
        .comment-content dt a, .comment-content dt a:visited, .singleProductDesc h1,
        .comment-content dd a, .comment-content dd a:visited, .shipping-calculator-button, .woocommerce-remove-coupon,
        .comment-content p a, .comment-content p a:visited, .cartProduct h4 a:hover,
        .singlePostWrap table td a, .singlePostWrap table td a:visited, .comment-content table td a, .comment-content table td a:visited,
        .singlePostWrap table th a, .singlePostWrap table th a:visited, .comment-content table th a, .comment-content table th a:visited,
        .singlePostWrap blockquote p a, .singlePostWrap blockquote p a:visited,
        .comment-content blockquote p a, .comment-content blockquote p a:visited,
        .singlePostWrap .wp-caption-text a, .singlePostWrap .gallery-caption a,
        .singlePostWrap .wp-caption-text a:visited, .singlePostWrap .gallery-caption a:visited,
        .singlePostWrap h6 a, .singlePostWrap h6 a:visited,
        .singlePostWrap h5 a, .singlePostWrap h5 a:visited,
        .singlePostWrap h4 a, .singlePostWrap h4 a:visited,
        .singlePostWrap h3 a, .singlePostWrap h3 a:visited,
        .singlePostWrap h2 a, .singlePostWrap h2 a:visited,
        .singlePostWrap h1 a, .singlePostWrap h1 a:visited,
        .comment-content h6 a, .comment-content h6 a:visited,
        .comment-content h5 a, .comment-content h5 a:visited,
        .comment-content h4 a, .comment-content h4 a:visited,
        .comment-content h3 a, .comment-content h3 a:visited,
        .comment-content h2 a, .comment-content h2 a:visited,
        .comment-content h1 a, .comment-content h1 a:visited,
        .singleProductDesc p.cart .single_add_to_cart_button, .tax-product_cat.woocommerce .star-rating:before,
        .singleProductDesc form.cart .single_add_to_cart_button, span.edit-link .post-edit-link,
        .attendBtn, .attendBtn:visited, .tagsBox a:hover, .miniCartItem h3 a:hover,
        .benefitItem i.fa, .pricingPlanItem h3, .shopLink, .shopLink:visited, .blogLink, .blogLink:visited, .aboutLink, .aboutLink:visited,
        .postItemCategory:hover, .postItem:hover h3 a {color: <?php echo esc_attr( $sColourOne ); ?>;}

        /* secondary colour */
        .subscribeBtn:hover, .singlePostWrap ins, .comment-content ins,
        .woocommerce table.my_account_orders .order-actions a.button.view:hover,
        body.woocommerce-edit-address .woocommerce form .button:hover,
        .woocommerce form.lost_reset_password p .button:hover,
        .woocommerce form.edit-account p .button:hover,
        .woocommerce form.checkout_coupon .form-row .button:hover,
        .woocommerce form.login .form-row .button:hover,
        .woocommerce form.register p .button:hover,
        .thmSubmitBtn:hover, .btnCheckout:hover, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
        .pricingPlanItem .joinNow:hover, .page404Wrap a.homePage:hover,
        .homeAboutUs .joinNow:hover, .woocommerce #payment #place_order:hover,
        .bookATourLink:hover {background-color: <?php echo esc_attr( $sColourTwo ); ?>;}

        .btnCheckout:hover {border-color: <?php echo esc_attr( $sColourTwo ); ?>;}
    </style>
    <?php
}

}

// custom fonts
add_action('wp_head', 'uni_coworking_theme_customisation_styles_for_pages', 10);
function uni_coworking_theme_customisation_styles_for_pages(){

    if ( ( function_exists('is_shop') && is_shop() ) || is_tax('product_tag') || is_tax('product_cat') ) {
        $sShopTitleColor    = ( ot_get_option( 'uni_shop_header_title_color' ) ) ? ot_get_option( 'uni_shop_header_title_color' ) : '#ffffff';
        echo '<style type="text/css">.pageHeaderImg h1 {color:'.esc_attr($sShopTitleColor).';}</style>';
    }

    if ( is_page_template('templ-events.php') || is_page_template('templ-events-tickera.php') ) {
        global $post;
        $aPostCustom = get_post_custom( $post->ID );
        // colour of title
        if ( !empty($aPostCustom['uni_events_page_header_title_color'][0]) ) {
            $sTitleColor = $aPostCustom['uni_events_page_header_title_color'][0];
        } else {
            $sTitleColor = '#ffffff';
        }
        echo '<style type="text/css">.pageHeaderImg h1 {color:'.esc_attr( $sTitleColor ).';}</style>';
    }

    if ( is_page_template('templ-schedule.php') ) {
        global $post;
        $aPostCustom = get_post_custom( $post->ID );
        // colour of title
        if ( !empty($aPostCustom['uni_schedule_page_header_title_color'][0]) ) {
            $sTitleColor = $aPostCustom['uni_schedule_page_header_title_color'][0];
        } else {
            $sTitleColor = '#ffffff';
        }
        echo '<style type="text/css">.pageHeaderImg h1 {color:'.esc_attr( $sTitleColor ).';}</style>';
    }

    if ( is_page_template('templ-about.php') ) {
        global $post;
        $aPostCustom = get_post_custom( $post->ID );
        // colour of title
        if ( !empty($aPostCustom['uni_about_page_header_title_color'][0]) ) {
            $sTitleColor = $aPostCustom['uni_about_page_header_title_color'][0];
        } else {
            $sTitleColor = '#ffffff';
        }
        echo '<style type="text/css">.pageHeaderImg h1 {color:'.esc_attr( $sTitleColor ).';}</style>';
    }

    if ( is_page_template('templ-plans.php') ) {
        global $post;
        $aPostCustom = get_post_custom( $post->ID );
        // colour of title
        if ( !empty($aPostCustom['uni_plans_page_header_title_color'][0]) ) {
            $sTitleColor = $aPostCustom['uni_plans_page_header_title_color'][0];
        } else {
            $sTitleColor = '#ffffff';
        }
        echo '<style type="text/css">.pageHeaderImg h1 {color:'.esc_attr( $sTitleColor ).';}</style>';
    }

}

//
add_action('admin_enqueue_scripts', 'uni_coworking_theme_admin_script', 10, 1);
function uni_coworking_theme_admin_script( $hook ) {

    wp_enqueue_script( 'uni-coworking-theme-admin', get_template_directory_uri() . '/js/uni-admin.js', array('jquery'), '1.1.3' );

}

// Add new image sizes
add_image_size( 'unithumb-coworking-relativepost', 370, 250, true );
add_image_size( 'unithumb-coworking-relativepostalt', 260, 173, true );
add_image_size( 'unithumb-coworking-blogpostv2', 420, 256, true );
add_image_size( 'unithumb-coworking-aboutusone', 1660, 1600, true );
add_image_size( 'unithumb-coworking-cartimage', 128, 128, true );
add_image_size( 'unithumb-coworking-minicartphoto', 88, 88, true );
add_image_size( 'unithumb-coworking-priceitembg', 370, 94, true );
add_image_size( 'unithumb-coworking-aboutuswide', 570, 270, true );
add_image_size( 'unithumb-coworking-aboutussquare', 270, 270, true );
add_image_size( 'unithumb-coworking-planthumb', 470, 382, true );

// Register sidebar
add_action( 'widgets_init', 'uni_coworking_theme_sidebars_init' );
function uni_coworking_theme_sidebars_init() {
    register_sidebar( array(
        'name' => esc_html__( 'Sidebar', 'coworking' ),
        'id' => 'sidebar-main',
        'description' => '',
        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name' => 'Footer Sidebar 1',
        'id' => 'footer-sidebar-1',
        'description' => 'Appears in the footer area',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ) );
}

//
add_action('after_switch_theme', 'uni_coworking_theme_activation_func', 10);
function uni_coworking_theme_activation_func() {
    add_role( 'coworking_staff', esc_html__('Coworking Staff', 'asana'), array('read' => true) );
    $coworking_staff = get_role('coworking_staff');
    $coworking_staff->add_cap('read');
    flush_rewrite_rules();
}

//
add_action('switch_theme', 'uni_coworking_theme_deactivation_func');
function uni_coworking_theme_deactivation_func() {
    remove_role( 'coworking_staff' );
}

// get fontawesome icon for advanced social status plugin
function uni_coworking_theme_get_proper_social_icon( $sNetworkSlug ){
    $aIconNames = array(
        'fblike'            => 'fa fa-facebook',
        'fbshare'           => 'fa fa-facebook',
        'twitter_followers' => 'fa fa-twitter',
        'twitter_following' => 'fa fa-twitter',
        'twitter_tweets'    => 'fa fa-twitter',
        'twitter_shares'    => 'fa fa-twitter',
        'google_shares'     => 'fa fa-google-plus',
        'google_followers'  => 'fa fa-google-plus',
        'linkedin_shares'   => 'fa fa-linkedin-square',
        'delicious_followers' => 'fa fa-delicious',
        'stumbleupon'       => 'fa fa-stumbleupon',
        'youtube_subscribers' => 'fa fa-youtube-play',
        'youtube_views'     => 'fa fa-youtube-play',
        'dribbble'          => 'fa fa-dribbble',
        'soundcloud_followers' => 'fa fa-soundcloud',
        'soundcloud_plays'  => 'fa fa-soundcloud',
        'pinterest'         => 'fa fa-pinterest',
        'mailchimp'         => 'fa fa-envelope',
        'github'            => 'fa fa-github',
        'behance'           => 'fa fa-behance',
        'envato'            => 'icon-envato'
    );
    return $aIconNames[$sNetworkSlug];
}

// Cpts similar by custom tax with thumbnails - ver 1
function uni_coworking_theme_similar_cpt_by_tax( $sTaxName, $iNumberOfPosts, $sCptName = '', $sBlockTitle = '' ) {

    global $post;
    $oOriginalPost      = $post;
    $aTerms             = wp_get_object_terms( $post->ID, $sTaxName );

    if ( isset( $aTerms ) && !empty( $aTerms ) ) {
        $aRelatedTermIdsArray = array();
        foreach( $aTerms as $oTerm ) {
            $aRelatedTermIdsArray[] = $oTerm->term_id;
        }

        $aRelatedArgs = array(
            'post_type' => ( !empty($sCptName) ) ? $sCptName : $post->post_type,
            'tax_query' => array(
                array(
                    'taxonomy' => $sTaxName,
                    'field'    => 'term_id',
                    'terms'    => $aRelatedTermIdsArray,
                ),
            ),
            'post__not_in' => array($post->ID),
            'posts_per_page' => $iNumberOfPosts,
            'orderby' => 'rand',
            'ignore_sticky_posts' => 1
        );

        $oRelatedQuery = new wp_query( $aRelatedArgs );
        if( $oRelatedQuery->have_posts() ) {

            echo '<div class="relatedPostsWrap">
            <div class="blockTitle">'. ( ( !empty($sBlockTitle) ) ? esc_html($sBlockTitle) : esc_html__('Related Posts', 'coworking') ) .'</div>';

            while( $oRelatedQuery->have_posts() ) {
                $oRelatedQuery->the_post();
                ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class('postItem') ?>>
                    <a href="<?php the_permalink() ?>" class="postItemImg" title="<?php the_title_attribute() ?>">
                        <?php if ( has_post_thumbnail() ) { ?>
                        <?php the_post_thumbnail( 'unithumb-coworking-relativepost', array( 'alt' => the_title_attribute('echo=0') ) ); ?>
                        <?php } else { ?>
                        <img src="http://placehold.it/370x250" width="370" height="250" alt="<?php the_title_attribute() ?>" />
                        <?php } ?>
                    </a>
                    <div class="postItemMeta">
                        <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(); ?></time>
                    </div>
                    <h3><a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><?php the_title() ?></a></h3>
                    <?php if ( has_excerpt( $post->ID ) ) { the_excerpt(); } else { uni_coworking_theme_excerpt(15, '', true); } ?>
                </div>
                <?php }
                echo '</div>';
            }
        }
        $post = $oOriginalPost;
        wp_reset_postdata();
    }

// Cpts similar by custom tax with thumbnails - ver 2
    function uni_coworking_theme_similar_cpt_by_tax_alt( $sTaxName, $iNumberOfPosts, $sCptName = '', $sBlockTitle = '' ) {

        global $post;
        $oOriginalPost      = $post;
        $aTerms             = wp_get_object_terms( $post->ID, $sTaxName );

        if ( isset( $aTerms ) && !empty( $aTerms ) ) {
            $aRelatedTermIdsArray = array();
            foreach( $aTerms as $oTerm ) {
                $aRelatedTermIdsArray[] = $oTerm->term_id;
            }

            $aRelatedArgs = array(
                'post_type' => ( !empty($sCptName) ) ? $sCptName : $post->post_type,
                'tax_query' => array(
                    array(
                        'taxonomy' => $sTaxName,
                        'field'    => 'term_id',
                        'terms'    => $aRelatedTermIdsArray,
                    ),
                ),
                'post__not_in' => array($post->ID),
                'posts_per_page' => $iNumberOfPosts,
                'orderby' => 'rand',
                'ignore_sticky_posts' => 1
            );

            $oRelatedQuery = new wp_query( $aRelatedArgs );
            if( $oRelatedQuery->have_posts() ) {

                echo '<div class="relatedPostsV2Wrap">
                <div class="blockTitle">'. ( ( !empty($sBlockTitle) ) ? esc_html($sBlockTitle) : esc_html__('Related Posts', 'coworking') ) .'</div>
                <div class="uni-clear">';

                while( $oRelatedQuery->have_posts() ) {
                    $oRelatedQuery->the_post();
                    ?>
                    <div id="post-<?php the_ID(); ?>" <?php post_class('relatedPostItem') ?>>
                        <a class="postItemImg" href="<?php the_permalink() ?>">
                            <?php if ( has_post_thumbnail() ) { ?>
                            <?php the_post_thumbnail( 'unithumb-coworking-relativepostalt', array( 'alt' => the_title_attribute('echo=0') ) ); ?>
                            <?php } else { ?>
                            <img src="http://placehold.it/260x173" width="260" height="173" alt="<?php the_title_attribute() ?>" />
                            <?php } ?>
                        </a>
                        <div class="postItemMeta">
                            <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(); ?></time>
                        </div>
                        <h3>
                            <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                        </h3>
                        <div class="relatedPostItemMeta">
                            <?php
                            $aCategories = wp_get_post_terms( $post->ID, 'category' );
                            if ( $aCategories && !is_wp_error( $aCategories ) ) :
                                $s = count($aCategories);
                                $i = 1;
                                foreach ( $aCategories as $oTerm ) {
                                    echo '<a href="'.esc_url( get_term_link( $oTerm->slug, 'category' ) ).'" class="relatedPostCategory">'.esc_attr( $oTerm->name ).'</a>';
                                    if ($i < $s) echo ', ';
                                    $i++;
                                }
                            endif;
                            ?>
                        </div>
                    </div>
                    <?php }
                    echo '</div></div>';
                }
            }
            $post = $oOriginalPost;
            wp_reset_postdata();
        }

// custom excerpt
        function uni_coworking_theme_excerpt( $iLength, $iPostId = '', $bEcho = false, $sMore = null ) {
            if ( !empty($iPostId) ) {
                $oPost = get_post( $iPostId );
            } else {
                global $post;
                $oPost = $post;
            }

            if ( null === $sMore )
                $sMore = esc_html__( '&hellip;', 'coworking' );

            $sContent = $oPost->post_content;
            $sContent = wp_strip_all_tags( $sContent );
            $sContent = strip_shortcodes( $sContent );
            if ( 'characters' == _x( 'words', 'word count: words or characters?', 'coworking' ) && preg_match( '/^utf\-?8$/i', get_option( 'blog_charset' ) ) ) {
                $sContent = trim( preg_replace( "/[\n\r\t ]+/", ' ', $sContent ), ' ' );
                preg_match_all( '/./u', $sContent, $aWordsArray );
                $aWordsArray = array_slice( $aWordsArray[0], 0, $iLength + 1 );
                $sep = '';
            } else {
                $aWordsArray = preg_split( "/[\n\r\t ]+/", $sContent, $iLength + 1, PREG_SPLIT_NO_EMPTY );
                $sep = ' ';
            }

            if ( count( $aWordsArray ) > $iLength ) {
                array_pop( $aWordsArray );
                $sContent = implode( $sep, $aWordsArray );
                $sContent = $sContent . $sMore;
            } else {
                $sContent = implode( $sep, $aWordsArray );
            }
            if ( $bEcho ) {
                echo '<p>'.$sContent.'</p>';
            } else {
                return $sContent;
            }
        }

//
        function uni_coworking_theme_allowed_html_wo_a() {
            $aAllowedHtml = array(
                'br' => array(),
                'em' => array(),
                'strong' => array(),
                'sup' => array(),
                'span' => array(
                    'class' => array()
                ),
            );
            return $aAllowedHtml;
        }

//
        function uni_coworking_theme_allowed_html_with_a() {
            $aAllowedHtml = array(
                'a' => array(
                    'href' => array(),
                    'title' => array(),
                    'target' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array(),
                'sup' => array(),
                'span' => array(
                    'class' => array()
                ),
            );
            return $aAllowedHtml;
        }

        function uni_coworking_theme_new_excerpt_more( $more ) {
            return '...';
        }
        add_filter('excerpt_more', 'uni_coworking_theme_new_excerpt_more');

// comments
        function uni_coworking_theme_comment($comment, $args, $depth) {
            $GLOBALS['comment'] = $comment;
            global $post;
            ?>
            <li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
                <a id="view-comment-<?php comment_ID(); ?>" class="comment-anchor"></a>
                <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
                    <footer class="comment-meta">
                        <div class="comment-author vcard">
                            <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size']); ?>
                        </div><!-- .comment-author -->

                        <div class="reply">
                            <?php comment_reply_link(array_merge($args, array(
                                'add_below' => 'div-comment',
                                'depth' => $depth,
                                'max_depth' => $args['max_depth'],
                                'before' => '<div>',
                                'after' => '</div>'
                                ))); ?>
                            </div><!-- .reply -->
                        </footer><!-- .comment-meta -->

                        <div class="comment-wrapper">
                            <?php
                            if ( $comment->user_id === $post->post_author ) {
                                printf('<cite class="fn">%s</cite><span class="uni-post-author">%s</span>', esc_url( get_comment_author_link() ), esc_html__('post author', 'coworking'));
                            } else {
                                printf('<cite class="fn">%s</cite>', esc_url( get_comment_author_link() ) );
                            }
                            ?>

                            <span class="comment-metadata">
                                <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                                    <time datetime="<?php comment_time('c'); ?>">
                                        <?php printf(_x('%1$s at %2$s', '1: date, 2: time', 'coworking'), get_comment_date(), get_comment_time()); ?>
                                    </time>
                                </a>
                                <?php edit_comment_link(esc_html__('Edit', 'coworking'), '<span class="separator">&middot;</span> <span class="edit-link">', '</span>'); ?>
                            </span><!-- .comment-metadata -->

                            <?php if ('0' == $comment->comment_approved): ?>
                                <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'coworking'); ?></p>
                            <?php endif; ?>

                            <div class="comment-content">
                                <?php comment_text(); ?>
                            </div><!-- .comment-content -->
                        </div>
                    </article><!-- .comment-body -->
                    <?php
                }

// join event form - processing
                function uni_coworking_theme_join_event_form(){

                    $aResult               = array();
                    $aResult['message']    = esc_html__('Error!', 'coworking');
                    $aResult['status']     = 'error';

                    $sCustomerFName         = ( !empty($_POST['uni_contact_firstname']) ) ? esc_sql($_POST['uni_contact_firstname']) : '';
                    $sCustomerLName         = ( !empty($_POST['uni_contact_lastname']) ) ? esc_sql($_POST['uni_contact_lastname']) : '';
                    $sCustomerEmail         = ( !empty($_POST['uni_contact_email']) ) ? esc_sql($_POST['uni_contact_email']) : '';
                    $sCustomerPhone         = ( !empty($_POST['uni_contact_phone']) ) ? esc_sql($_POST['uni_contact_phone']) : '';
                    $sCustomerMsg           = ( !empty($_POST['uni_contact_msg']) ) ? stripslashes_deep( strip_tags( $_POST['uni_contact_msg'] ) ) : '';
                    $iEventId               = absint( esc_sql($_POST['event_id']) );
                    $sNonce                 = $_POST['uni_contact_nonce'];
                    $sAntiCheat             = $_POST['cheaters_always_disable_js'];

                    if ( ( empty($sAntiCheat) || $sAntiCheat != 'true_bro' ) || !wp_verify_nonce( $_POST['uni_contact_nonce'], 'uni_nonce' ) ) {
                        wp_send_json( $aResult );
                    }

                    if ( $sCustomerFName && $sCustomerLName && $sCustomerEmail && $sCustomerPhone && $sCustomerMsg ) {

                        $nome = $sCustomerFName;
                        $sDateFormat = get_option( 'date_format' );
                        $sTimeFormat = get_option( 'time_format' );

                        $sUniEmail          = ot_get_option( 'uni_contact_email' );

                        $environment = ENVIRONMENT;
                        if ($environment === 'production') {
                            $sAdminEmail = 'info@edit.work, noemi.lomelino@edit.work, joana.tomas@edit.com.pt';
                        } else {
                            $sAdminEmail = 'joni.dores@edit.com.pt';
                        }
                        
                        $sEventTitle        = get_the_title( $iEventId );
                        $aCustomData        = get_post_custom( $iEventId );
                        $sEventLocation     = ( !empty($aCustomData['uni_event_address'][0]) ) ? esc_html( $aCustomData['uni_event_address'][0] ) : esc_html__('- not specified -', 'coworking');
                        $sEventPrice        = ( !empty($aCustomData['uni_event_price'][0]) ) ? esc_html( $aCustomData['uni_event_price'][0] ) : esc_html__('- not specified -', 'coworking');
                        $sPhone             = ( ot_get_option( 'uni_home_contact_phone' ) ) ? esc_html( ot_get_option( 'uni_home_contact_phone' ) ) : '+88 (0) 101 0000 000';
                        $sEmail             = ( ot_get_option( 'uni_contact_email' ) ) ? sanitize_email( $sUniEmail ) : sanitize_email( get_bloginfo('admin_email') );

                        if ( !empty($aCustomData['uni_event_date_start'][0]) && !empty($aCustomData['uni_event_date_end'][0]) &&
                            $aCustomData['uni_event_date_start'][0] == $aCustomData['uni_event_date_end'][0] ) {
                            $iDateStartTimestamp = strtotime($aCustomData['uni_event_date_start'][0]);
                        $sEventDate = date_i18n($sDateFormat, $iDateStartTimestamp);
                    } else if ( !empty($aCustomData['uni_event_date_start'][0]) && !empty($aCustomData['uni_event_date_end'][0]) &&
                        $aCustomData['uni_event_date_start'][0] != $aCustomData['uni_event_date_end'][0] ) {
                        $iDateStartTimestamp = strtotime($aCustomData['uni_event_date_start'][0]);
                        $iDateEndTimestamp = strtotime($aCustomData['uni_event_date_end'][0]);
                        $sEventDate = date_i18n($sDateFormat, $iDateStartTimestamp) . ' - ' . date_i18n($sDateFormat, $iDateEndTimestamp);
                    } else if ( !empty($aCustomData['uni_event_date_start'][0]) && empty($aCustomData['uni_event_date_end'][0]) ) {
                        $iDateStartTimestamp = strtotime($aCustomData['uni_event_date_start'][0]);
                        $sEventDate = date_i18n($sDateFormat, $iDateStartTimestamp);
                    } else {
                        $sEventDate = esc_html__('- not specified -', 'coworking');
                    }

                    if ( !empty($aCustomData['uni_event_time_start'][0]) && !empty($aCustomData['uni_event_time_end'][0]) &&
                        $aCustomData['uni_event_time_start'][0] == $aCustomData['uni_event_time_end'][0] ) {
                        $iTimeStartTimestamp = strtotime($aCustomData['uni_event_time_start'][0]);
                    $sEventTime = date_i18n($sTimeFormat, $iTimeStartTimestamp);
                } else if ( !empty($aCustomData['uni_event_time_start'][0]) && !empty($aCustomData['uni_event_time_end'][0]) &&
                    $aCustomData['uni_event_time_start'][0] != $aCustomData['uni_event_time_end'][0] ) {
                    $iTimeStartTimestamp = strtotime($aCustomData['uni_event_time_start'][0]);
                    $iTimeEndTimestamp = strtotime($aCustomData['uni_event_time_end'][0]);
                    $sEventTime = date_i18n($sTimeFormat, $iTimeStartTimestamp) . ' - ' . date_i18n($sTimeFormat, $iTimeEndTimestamp);
                } else if ( !empty($aCustomData['uni_event_time_start'][0]) && empty($aCustomData['uni_event_time_end'][0]) ) {
                    $iTimeStartTimestamp = strtotime($aCustomData['uni_event_time_start'][0]);
                    $sEventTime = date_i18n($sTimeFormat, $iTimeStartTimestamp);
                } else {
                    $sEventTime = esc_html__('- not specified -', 'coworking');
                }

            // send an email to the client
                $sBlogName          = get_bloginfo('name');
                if ( ot_get_option( 'uni_use_visitor_email_from' ) !== 'off' ) {
                    $aHeadersText[]         = "From: ".esc_attr($sBlogName)." <$sAdminEmail>";
                } else {
                    $sFromEmail             = sanitize_email( ot_get_option( 'uni_custom_email_from' ) );
                    $aHeadersText[]         = "From: ".esc_attr($sBlogName)." <$sFromEmail>";
                    $aHeadersText[]         = "Sender: $sFromEmail";
                    $aHeadersText[]         = "Reply-To: ".esc_attr($sBlogName)." <$sAdminEmail>";
                }

                $sSubjectText       = html_entity_decode( sprintf( esc_html__( 'Pedido de inscrição para %s', 'coworking'), $sEventTitle ), ENT_COMPAT, 'UTF-8' );
                $sClientName        = $sCustomerFName.' '.$sCustomerLName;
                $sEmailTemplateName = apply_filters( 'uni_coworking_theme_event_email_filter', '/email/event-guest.php', 'guest' );
                $aMailVars = array( '$sEventTitle' => '"'.$sEventTitle.'"', '$sEventDate' => $sEventDate, '$sClientName' => $sClientName,    
                    '$sEventLocation' =>  $sEventLocation, '$sEventPrice' => $sEventPrice, '$sPhone' => $sPhone, '$sEmail' => $sEmail );

                uni_coworking_theme_send_email_wrapper( $sCustomerEmail, $aHeadersText, $sSubjectText, $sEmailTemplateName, $aMailVars, '' );

            // send an email to the admin
                if ( ot_get_option( 'uni_use_visitor_email_from' ) !== 'off' ) {
                    $aHeadersText[]         = "From: $sCustomerFName $sCustomerLName <$sCustomerEmail>";
                } else {
                    $sFromEmail             = sanitize_email( ot_get_option( 'uni_custom_email_from' ) );
                    $aHeadersText[]         = "From: $sCustomerFName $sCustomerLName <$sFromEmail>";
                    $aHeadersText[]         = "Sender: $sFromEmail";
                    $aHeadersText[]         = "Reply-To: $sCustomerFName $sCustomerLName <$sCustomerEmail>";
                }

                $sSubjectText       = html_entity_decode( sprintf( esc_html__( 'Nova inscrição para %s', 'coworking'), $sEventTitle ), ENT_COMPAT, 'UTF-8' );
                $sClientName        = $sCustomerFName.' '.$sCustomerLName;
                $sClientTel         = $sCustomerPhone;
                $sClientEmail       = $sCustomerEmail;
                $sClientMsg         = $sCustomerMsg;
                $sEmailTemplateName = apply_filters( 'uni_coworking_theme_event_email_filter', '/email/event-admin.php', 'admin' );
                $aMailVars = array( '$sEventTitle' => '"'.$sEventTitle.'"', '$sEventDate' => $sEventDate, '$sClientName' => $sClientName,
                    '$sClientTel' => $sClientTel, '$sClientEmail' => $sClientEmail, '$sClientMsg' => $sClientMsg );

                uni_coworking_theme_send_email_wrapper( $sAdminEmail, $aHeadersText, $sSubjectText, $sEmailTemplateName, $aMailVars, '' );

                $aResult['status']     = 'success';
                $aResult['message']    = esc_html__('Obrigado! Pedido submetido com sucesso!', 'coworking');

            } else {
                $aResult['message']    = esc_html__('All fields are required!', 'coworking');
            }

            wp_send_json( $aResult );
        }
        add_action('wp_ajax_uni_coworking_theme_join_event_form', 'uni_coworking_theme_join_event_form');
        add_action('wp_ajax_nopriv_uni_coworking_theme_join_event_form', 'uni_coworking_theme_join_event_form');

// price form - processing
        function uni_coworking_theme_price_form(){

            $aResult               = array();
            $aResult['message']    = esc_html__('Error!', 'coworking');
            $aResult['status']     = 'error';

            $sCustomerFName         = ( !empty($_POST['uni_contact_firstname']) ) ? esc_sql($_POST['uni_contact_firstname']) : '';
            $sCustomerLName         = ( !empty($_POST['uni_contact_lastname']) ) ? esc_sql($_POST['uni_contact_lastname']) : '';
            $sCustomerEmail         = ( !empty($_POST['uni_contact_email']) ) ? esc_sql($_POST['uni_contact_email']) : '';
            $sCustomerPhone         = ( !empty($_POST['uni_contact_phone']) ) ? esc_sql($_POST['uni_contact_phone']) : '';
            $sCustomerMsg           = ( !empty($_POST['uni_contact_msg']) ) ? stripslashes_deep( strip_tags( $_POST['uni_contact_msg'] ) ) : '';
            $iPriceId               = intval( esc_sql($_POST['uni_price_id']) );
            $sNonce                 = $_POST['uni_contact_nonce'];
            $sAntiCheat             = $_POST['cheaters_always_disable_js'];

            if ( ( empty($sAntiCheat) || $sAntiCheat != 'true_bro' ) || !wp_verify_nonce( $_POST['uni_contact_nonce'], 'uni_nonce' ) ) {
                wp_send_json( $aResult );
            }

            if ( $sCustomerFName && $sCustomerLName && $sCustomerEmail && $sCustomerPhone && $sCustomerMsg ) {

                $sClientName        = $sCustomerFName.' '.$sCustomerLName;
                $sUniEmail          = ot_get_option( 'uni_contact_email' );
                $environment = ENVIRONMENT;
                if ($environment === 'production') {
                    $sAdminEmail = 'info@edit.work, noemi.lomelino@edit.work, joana.tomas@edit.com.pt';
                } else {
                    $sAdminEmail = 'joni.dores@edit.com.pt';
                }
                $sPriceTitle        = get_the_title( $iPriceId );
                $aCustomData        = get_post_custom( $iPriceId );
                $sPriceCurrency     = ( !empty($aCustomData['uni_price_currency'][0]) ) ? esc_html( $aCustomData['uni_price_currency'][0] ) : esc_html__('- not specified -', 'coworking');
                $sPriceVal          = ( !empty($aCustomData['uni_price_val'][0]) ) ? esc_html( $aCustomData['uni_price_val'][0] ) : esc_html__('- not specified -', 'coworking');
                $sPricePeriod       = ( !empty($aCustomData['uni_price_period'][0]) ) ? esc_html( $aCustomData['uni_price_period'][0] ) : esc_html__('- not specified -', 'coworking');
                $sPhone             = ( ot_get_option( 'uni_home_contact_phone' ) ) ? esc_html( ot_get_option( 'uni_home_contact_phone' ) ) : '+88 (0) 101 0000 000';
                $sEmail             = ( ot_get_option( 'uni_contact_email' ) ) ? sanitize_email( $sUniEmail ) : sanitize_email( get_bloginfo('admin_email') );

            // send an email to the client
                $sBlogName          = get_bloginfo('name');
                if ( ot_get_option( 'uni_use_visitor_email_from' ) !== 'off' ) {
                    $aHeadersText[]         = "From: ".esc_attr($sBlogName)." <$sAdminEmail>";
                } else {
                    $sFromEmail             = sanitize_email( ot_get_option( 'uni_custom_email_from' ) );
                    $aHeadersText[]         = "From: ".esc_attr($sBlogName)." <$sFromEmail>";
                    $aHeadersText[]         = "Sender: $sFromEmail";
                    $aHeadersText[]         = "Reply-To: ".esc_attr($sBlogName)." <$sAdminEmail>";
                }
                $sSubjectText       = html_entity_decode( sprintf( esc_html__( 'Formulário EDIT.WORK', 'coworking') ), ENT_COMPAT, 'UTF-8' );
                $sEmailTemplateName = apply_filters( 'uni_coworking_theme_price_email_filter', '/email/price-guest.php', 'guest' );
                $aMailVars = array( '$sPriceTitle' => '"'.$sPriceTitle.'"', '$sPriceCurrency' => $sPriceCurrency, '$sPriceVal' => $sPriceVal,
                    '$sPricePeriod' => $sPricePeriod, '$sPhone' => $sPhone, '$sEmail' => $sEmail, '$sClientName' => $sClientName );

                uni_coworking_theme_send_email_wrapper( $sCustomerEmail, $aHeadersText, $sSubjectText, $sEmailTemplateName, $aMailVars, '' );

            // send an email to the admin
                if ( ot_get_option( 'uni_use_visitor_email_from' ) !== 'off' ) {
                    $aHeadersText[]         = "From: $sCustomerFName $sCustomerLName <$sCustomerEmail>";
                } else {
                    $sFromEmail             = sanitize_email( ot_get_option( 'uni_custom_email_from' ) );
                    $aHeadersText[]         = "From: $sCustomerFName $sCustomerLName <$sFromEmail>";
                    $aHeadersText[]         = "Sender: $sFromEmail";
                    $aHeadersText[]         = "Reply-To: $sCustomerFName $sCustomerLName <$sCustomerEmail>";
                }
                $sSubjectText       = html_entity_decode( sprintf( esc_html__( 'Novo pedido para %s', 'coworking'), $sPriceTitle ), ENT_COMPAT, 'UTF-8' );
                $sClientName        = $sCustomerFName.' '.$sCustomerLName;
                $sClientTel         = $sCustomerPhone;
                $sClientEmail       = $sCustomerEmail;
                $sClientMsg         = $sCustomerMsg;
                $sEmailTemplateName = apply_filters( 'uni_coworking_theme_price_email_filter', '/email/price-admin.php', 'admin' );
                $aMailVars = array( '$sPriceTitle' => '"'.$sPriceTitle.'"', '$sPricePeriod' => $sPricePeriod, '$sClientName' => $sClientName,
                    '$sPriceCurrency' => $sPriceCurrency, '$sPriceVal' => $sPriceVal,
                    '$sClientTel' => $sClientTel, '$sClientEmail' => $sClientEmail, '$sClientMsg' => $sClientMsg );

                uni_coworking_theme_send_email_wrapper( $sAdminEmail, $aHeadersText, $sSubjectText, $sEmailTemplateName, $aMailVars, '' );

                $aResult['status']     = 'success';
                $aResult['message']    = esc_html__('Obrigado. O teu pedido foi submetido com sucesso.', 'coworking');

            } else {
                $aResult['message']    = esc_html__('All fields are required!', 'coworking');
            }

            wp_send_json( $aResult );
        }
        add_action('wp_ajax_uni_coworking_theme_price_form', 'uni_coworking_theme_price_form');
        add_action('wp_ajax_nopriv_uni_coworking_theme_price_form', 'uni_coworking_theme_price_form');

// book_tour form - processing
        function uni_coworking_theme_book_tour_form(){

            $aResult               = array();
            $aResult['message']    = esc_html__('Error!', 'coworking');
            $aResult['status']     = 'error';

            $sCustomerFName         = ( !empty($_POST['uni_contact_firstname']) ) ? esc_sql($_POST['uni_contact_firstname']) : '';
            $sCustomerLName         = ( !empty($_POST['uni_contact_lastname']) ) ? esc_sql($_POST['uni_contact_lastname']) : '';
            $sCustomerEmail         = ( !empty($_POST['uni_contact_email']) ) ? esc_sql($_POST['uni_contact_email']) : '';
            $sCustomerPhone         = ( !empty($_POST['uni_contact_phone']) ) ? esc_sql($_POST['uni_contact_phone']) : '';
            $sNonce                 = $_POST['uni_contact_nonce'];
            $sAntiCheat             = $_POST['cheaters_always_disable_js'];

            if ( ( empty($sAntiCheat) || $sAntiCheat != 'true_bro' ) || !wp_verify_nonce( $_POST['uni_contact_nonce'], 'uni_nonce' ) ) {
                wp_send_json( $aResult );
            }

            if ( $sCustomerFName && $sCustomerLName && $sCustomerEmail && $sCustomerPhone ) {

                $sClientName        = $sCustomerFName.' '.$sCustomerLName;
                $sUniEmail          = ot_get_option( 'uni_contact_email' );
                $environment = ENVIRONMENT;
                if ($environment === 'production') {
                    $sAdminEmail = 'info@edit.work, noemi.lomelino@edit.work, joana.tomas@edit.com.pt';
                } else {
                    $sAdminEmail = 'joni.dores@edit.com.pt';
                }
                $sPhone             = ( ot_get_option( 'uni_home_contact_phone' ) ) ? esc_html( ot_get_option( 'uni_home_contact_phone' ) ) : '+88 (0) 101 0000 000';
                $sEmail             = ( ot_get_option( 'uni_contact_email' ) ) ? sanitize_email( $sUniEmail ) : sanitize_email( get_bloginfo('admin_email') );

            // send an email to the client
                $sBlogName          = get_bloginfo('name');
                if ( ot_get_option( 'uni_use_visitor_email_from' ) !== 'off' ) {
                    $aHeadersText[]         = "From: ".esc_attr($sBlogName)." <$sAdminEmail>";
                } else {
                    $sFromEmail             = sanitize_email( ot_get_option( 'uni_custom_email_from' ) );
                    $aHeadersText[]         = "From: ".esc_attr($sBlogName)." <$sFromEmail>";
                    $aHeadersText[]         = "Sender: $sFromEmail";
                    $aHeadersText[]         = "Reply-To: ".esc_attr($sBlogName)." <$sAdminEmail>";
                }
                $sSubjectText       = html_entity_decode( esc_html__( 'Formulário EDIT.WORK', 'coworking') );
                $sEmailTemplateName = apply_filters( 'uni_coworking_theme_book_email_filter', '/email/book-guest.php', 'guest' );
                $aMailVars = array( '$sPhone' => $sPhone, '$sEmail' => $sEmail, '$sClientName' => $sClientName ); 

                uni_coworking_theme_send_email_wrapper( $sCustomerEmail, $aHeadersText, $sSubjectText, $sEmailTemplateName, $aMailVars, '' );

            // send an email to the admin
                if ( ot_get_option( 'uni_use_visitor_email_from' ) !== 'off' ) {
                    $aHeadersText[]         = "From: $sCustomerFName $sCustomerLName <$sCustomerEmail>";
                } else {
                    $sFromEmail             = sanitize_email( ot_get_option( 'uni_custom_email_from' ) );
                    $aHeadersText[]         = "From: $sCustomerFName $sCustomerLName <$sFromEmail>";
                    $aHeadersText[]         = "Sender: $sFromEmail";
                    $aHeadersText[]         = "Reply-To: $sCustomerFName $sCustomerLName <$sCustomerEmail>";
                }
                $sSubjectText       = html_entity_decode( esc_html__( 'Pedido de informação', 'coworking') );
                $sClientName        = $sCustomerFName.' '.$sCustomerLName;
                $sClientTel         = $sCustomerPhone;
                $sClientEmail       = $sCustomerEmail;
                $sEmailTemplateName = apply_filters( 'uni_coworking_theme_book_email_filter', '/email/book-admin.php', 'admin' );
                $aMailVars = array( '$sClientName' => $sClientName, '$sClientTel' => $sClientTel, '$sClientEmail' => $sClientEmail );

                uni_coworking_theme_send_email_wrapper( $sAdminEmail, $aHeadersText, $sSubjectText, $sEmailTemplateName, $aMailVars, '' );

                $aResult['status']     = 'success';
                $aResult['message']    = esc_html__('Obrigado. O teu pedido foi submetido com sucesso.', 'coworking');

            } else {
                $aResult['message']    = esc_html__('All fields are required!', 'coworking');
            }

            wp_send_json( $aResult );
        }
        add_action('wp_ajax_uni_coworking_theme_book_tour_form', 'uni_coworking_theme_book_tour_form');
        add_action('wp_ajax_nopriv_uni_coworking_theme_book_tour_form', 'uni_coworking_theme_book_tour_form');

// Ajax contact form - processing
        function uni_coworking_theme_contact_form(){

            $aResult               = array();
            $aResult['message']    = esc_html__('Error!', 'coworking');
            $aResult['status']     = 'error';

            $sCustomerFName         = ( ( isset($_POST['uni_contact_fname']) ) ? esc_sql($_POST['uni_contact_fname']) : '');
            $sCustomerLName         = ( ( isset($_POST['uni_contact_lname']) ) ? esc_sql($_POST['uni_contact_lname']) : '');
            $sCustomerEmail         = ( ( isset($_POST['uni_contact_email']) ) ? esc_sql($_POST['uni_contact_email']) : '' );
            $sCustomerPhone         = ( ( isset($_POST['uni_contact_phone']) ) ? esc_sql($_POST['uni_contact_phone']) : '');
            $sCustomerMsg           = ( ( isset($_POST['uni_contact_msg']) ) ? esc_sql($_POST['uni_contact_msg']) : '' );
            $iPageId                = ( ( isset($_POST['page_id']) ) ? esc_sql(intval($_POST['page_id'])) : '' );
            $sNonce                 = $_POST['uni_contact_nonce'];
            $sAntiCheat             = $_POST['cheaters_always_disable_js'];

            if ( ( empty($sAntiCheat) || $sAntiCheat != 'true_bro' ) || !wp_verify_nonce( $_POST['uni_contact_nonce'], 'uni_nonce' ) ) {
                wp_send_json( $aResult );
            }

            if ( $sCustomerFName && $sCustomerLName && $sCustomerEmail && $sCustomerPhone && $sCustomerMsg ) {

                $sCustomerName = $sCustomerFName . ' ' . $sCustomerLName;

                if ( ! empty($iPageId) ) {
                    $aPostCustom = get_post_custom( $iPageId );
                    if ( ! empty($aPostCustom['uni_contact_email'][0]) ) {
                        $sToEmail = sanitize_email( $aPostCustom['uni_contact_email'][0] );
                    } else {
                        $sToEmail = sanitize_email( get_bloginfo('admin_email') );
                    }
                } else {
                    $sToEmail       = ( ot_get_option( 'uni_contact_email' ) ) ? sanitize_email( ot_get_option( 'uni_contact_email' ) ) : sanitize_email( get_bloginfo('admin_email') );
                }

                if ( ot_get_option( 'uni_use_visitor_email_from' ) !== 'off' ) {
                    $aHeadersText[]         = "From: $sCustomerName <$sCustomerEmail>";
                } else {
                    $sFromEmail             = sanitize_email( ot_get_option( 'uni_custom_email_from' ) );
                    $aHeadersText[]         = "From: $sCustomerName <$sFromEmail>";
                    $aHeadersText[]         = "Sender: $sFromEmail";
                    $aHeadersText[]         = "Reply-To: $sCustomerName <$sCustomerEmail>";
                }
                $sSubjectText       = $sCustomerSubject;

                $sBlogName          = get_bloginfo('name');

                $sMessage          =
                "<h3>".sprintf( esc_html__('You have a new message sent from "%s"!', 'coworking'), $sBlogName )."</h3>
                <p></p>
                <p><strong>".esc_html__('Contact information', 'coworking').":</strong><br>
                ".sprintf( esc_html__('Name: %s', 'coworking'), $sCustomerName )."
                <br>
                ".sprintf( esc_html__('Email: %s', 'coworking'), $sCustomerEmail )."
                <br>
                ".esc_html__('Message', 'coworking').":
                <br>$sCustomerMsg
                </p>";
                $sMessage = stripslashes_deep( $sMessage );

                uni_coworking_theme_send_email_wrapper( $sToEmail, $aHeadersText, $sSubjectText, false, array(), $sMessage );

                $aResult['status']     = 'success';
                $aResult['message']    = esc_html__('Thanks! Your message has been sent!', 'coworking');

            } else {
                $aResult['message']    = esc_html__('All fields are required!', 'coworking');
            }

            wp_send_json( $aResult );
        }
        add_action('wp_ajax_uni_coworking_theme_contact_form', 'uni_coworking_theme_contact_form');
        add_action('wp_ajax_nopriv_uni_coworking_theme_contact_form', 'uni_coworking_theme_contact_form');

// mailchimp subscribe user
        function uni_coworking_theme_mailchimp_subscribe_user(){

            $aResult                = array();
            $aResult['message']     = esc_html__('Error!', 'coworking');
            $aResult['status']      = 'error';

            $sEmail                 = esc_sql( $_POST['uni_input_email'] );
            $sAntiCheat             = $_POST['cheaters_always_disable_js'];

            if ( empty($sAntiCheat) || $sAntiCheat != 'true_bro' ) {
                wp_send_json( $aResult );
            }

            $sApiKey            = ot_get_option( 'uni_mailchimp_api_key' );
            $sListId            = ot_get_option( 'uni_mailchimp_list_id' );

            if ( !empty($sApiKey) && !empty($sListId) ) {

                $oUniMailchimp = Uni_Coworking_Theme_Mailchimp_Universal( $sApiKey, $sListId );
                $aListOfMCVars = apply_filters( 'uni_coworking_theme_mailchimp_variables_filter', array('email_address' => $sEmail, 'status' => 'pending') );
                $aResponse = $oUniMailchimp->call_lists_members( 'lists/members', 'POST', $aListOfMCVars );

                if ( $aResponse['status'] == 'success' ) {
                    $aResult['message']     = esc_html__('Success!', 'coworking');
                    $aResult['status']      = 'success';
                } else {
                    $aResult['message']     = ( isset($aResponse['response']->detail) && !empty($aResponse['response']->detail) ) ? $aResponse['response']->detail : $aResponse['message'];
                }

            } else {
                $aResult['message']     = esc_html__('No API key and/or List ID is/are specified!', 'coworking');
            }

            wp_send_json( $aResult );
        }
        add_action('wp_ajax_uni_coworking_theme_mailchimp_subscribe_user', 'uni_coworking_theme_mailchimp_subscribe_user');
        add_action('wp_ajax_nopriv_uni_coworking_theme_mailchimp_subscribe_user', 'uni_coworking_theme_mailchimp_subscribe_user');

// body classes
        function uni_coworking_theme_body_classes( $classes ) {

            if ( class_exists('Woocommerce') ) {
                if ( is_cart() || is_checkout() ) {
                    foreach ( $classes as $sKey => $sClass ) {
                        if ( $sClass == 'page-template-default' ) {
                            unset($classes[$sKey]);
                        }
                    }
                }
            }

            if ( ot_get_option( 'uni_social_section_enable' ) != 'on' ) {
                $classes[] = 'uni-no-footer-social';
            }
            return $classes;
        }
        add_filter( 'body_class', 'uni_coworking_theme_body_classes' );

//*********** WooCommerce ****************************************************************

// content-product.php
        remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
        add_action( 'woocommerce_after_shop_loop_item_title', 'uni_coworking_theme_woocommerce_template_loop_product_title_container_open', 15 );
        add_action( 'woocommerce_after_shop_loop_item_title', 'uni_coworking_theme_woocommerce_template_loop_product_title', 20 );
        add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 25 );
        add_action( 'woocommerce_after_shop_loop_item_title', 'uni_coworking_theme_woocommerce_template_loop_product_title_container_close', 30 );
        function uni_coworking_theme_woocommerce_template_loop_product_title_container_open() {
            echo '<div class="productDesc">';
        }
        function uni_coworking_theme_woocommerce_template_loop_product_title() {
            echo '<h3>' . esc_html( get_the_title() ) . '</h3>';
        }
        function uni_coworking_theme_woocommerce_template_loop_category_title( $category ) {
            echo '<h3>';
            echo $category->name;

            if ( $category->count > 0 ) {
                echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
            }

            echo'</h3>';
        }
        function uni_coworking_theme_woocommerce_template_loop_product_title_container_close() {
            echo '</div>';
        }
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

// content-product_cat.php
        remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
        add_action( 'woocommerce_shop_loop_subcategory_title', 'uni_coworking_theme_woocommerce_template_loop_product_title_container_open', 10 );
        add_action( 'woocommerce_shop_loop_subcategory_title', 'uni_coworking_theme_woocommerce_template_loop_category_title', 15, 1 );
        add_action( 'woocommerce_shop_loop_subcategory_title', 'uni_coworking_theme_woocommerce_template_loop_product_title_container_close', 20 );

// archive-product.php
        remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
        remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
        add_action( 'woocommerce_before_main_content', 'uni_coworking_theme_woo_output_content_wrapper', 10);
        add_action( 'woocommerce_after_main_content', 'uni_coworking_theme_woo_output_content_wrapper_end', 10);
        function uni_coworking_theme_woo_output_content_wrapper() {
    // if this is single product page
            if ( is_singular('product') ) {
                $sOutput = '<section class="uni-container">';
                $sOutput .= '<div class="contentWrap">';
    // other pages
            } else {
                $iShopAttachId      = ( ot_get_option( 'uni_shop_header_bg' ) ) ? ot_get_option( 'uni_shop_header_bg' ) : '';
                if ( ( is_shop() || is_search() ) && !empty($iShopAttachId) ) {
                    $aPageHeaderImage = wp_get_attachment_image_src( $iShopAttachId, 'full' );
                    $sPageHeaderImage = $aPageHeaderImage[0];
                } else if ( is_product_category() ) {
                    global $wp_query;
                    $cat = $wp_query->get_queried_object();
                    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
                    $aPageHeaderImage = wp_get_attachment_image_src( $thumbnail_id, 'full' );
                    if ( $aPageHeaderImage ) {
                        $sPageHeaderImage = $aPageHeaderImage[0];
                    } else {
                        $sPageHeaderImage = 'http://placehold.it/1920x600/a3d39c/fbfc91';
                    }
                } else {
                    $sPageHeaderImage = 'http://placehold.it/1920x600/a3d39c/fbfc91';
                }

                $sOutput = '<section class="uni-container">';
                $sOutput .= '<div class="pageHeaderImg" style="background-image: url('.esc_url( $sPageHeaderImage ).');">';
                $sOutput .= '<h1>'.woocommerce_page_title( false ).'</h1>';
                $sOutput .= '</div>';
                $sOutput .= '<div class="contentWrap">';
            }

            echo $sOutput;
        }

        function uni_coworking_theme_woo_output_content_wrapper_end() {
          echo '<div class="overlay"></div>
          </div>
          </section>';
      }

// content-single-product.php
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

      add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
      add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 5);
      add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
      add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 15);
      add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
      add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
      add_action( 'woocommerce_single_product_summary', 'uni_coworking_theme_template_single_sharing', 50);

      remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
      add_action( 'woocommerce_after_single_product_summary', 'uni_coworking_theme_related_products_by_tags', 20);

      add_action( 'woocommerce_after_single_product', 'uni_coworking_theme_minicart_content', 20);


// Display 12 products per page.
//add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

//
      add_filter( 'woocommerce_currency_symbol', 'uni_coworking_theme_currency_symbol_markup', 2, 10 );
      function uni_coworking_theme_currency_symbol_markup($sCurrencySymbol, $currency) {
        return '<span>'.esc_html( $sCurrencySymbol ).'</span>';
    }

//
    function uni_coworking_theme_woo_get_formatted_price( $sPrice, $args = array() ) {

        extract( apply_filters( 'wc_price_args', wp_parse_args( $args, array(
            'ex_tax_label'       => false,
            'currency'           => '',
            'decimal_separator'  => wc_get_price_decimal_separator(),
            'thousand_separator' => wc_get_price_thousand_separator(),
            'decimals'           => wc_get_price_decimals(),
            'price_format'       => get_woocommerce_price_format()
        ) ) ) );

        $negative        = $sPrice < 0;
        $sPrice           = apply_filters( 'raw_woocommerce_price', floatval( $negative ? $sPrice * -1 : $sPrice ) );
        $sPrice           = apply_filters( 'formatted_woocommerce_price', number_format( $sPrice, $decimals, $decimal_separator, $thousand_separator ), $sPrice, $decimals, $decimal_separator, $thousand_separator );

        if ( apply_filters( 'woocommerce_price_trim_zeros', false ) && $decimals > 0 ) {
            $sPrice = wc_trim_zeros( $sPrice );
        }

        $formatted_price = ( $negative ? '-' : '' ) . sprintf( $price_format, get_woocommerce_currency_symbol( $currency ), $sPrice );

        if ( $ex_tax_label && wc_tax_enabled() ) {
            $formatted_price .= ' <small class="tax_label">' . WC()->countries->ex_tax_or_vat() . '</small>';
        }

        return $formatted_price;

    }

//
    function uni_coworking_theme_woo_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0, $iPostId ) {
       if ( has_post_thumbnail($iPostId) )
           return get_the_post_thumbnail( $iPostId, $size );
       elseif ( wc_placeholder_img_src() )
           return uni_coworking_theme_woo_placeholder_img( $placeholder_width, $placeholder_height );
   }

//
   function uni_coworking_theme_woo_placeholder_img( $sWidth = 100, $sHeight = 100 ) {
       return '<img src="' . wc_placeholder_img_src() . '" alt="' . esc_html__( 'Placeholder', 'coworking' ) . '" width="' . esc_attr( $sWidth ) . '" class="woocommerce-placeholder wp-post-image" height="' . esc_attr( $sHeight ) . '" />';
   }

   function uni_coworking_theme_minicart_content() {
    global $woocommerce;

    ?>
    <div class="miniCartPopup">
        <div class="miniCartPopupHead">
            <h3><?php esc_html_e('Your cart', 'coworking'); ?></h3>
            <span class="closeCartPopup"></span>
        </div>

        <div class="miniCartItemWrap">
            <?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>
                <?php
                $sTotal = '';
                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                    $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                    $product_id     = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                    $product_name   = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                    $thumbnail      = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                    $product_price = $cart_item['data']->get_price() * $cart_item['quantity'];
                    $sTotal += $product_price;
                    ?>
                    <div class="miniCartItem" data-product_id="<?php echo esc_attr($product_id) ?>"<?php if ( !empty($cart_item['_uni_cpo_cart_item_id']) ) { ?> data-cart_item_id="<?php echo esc_attr( $cart_item['_uni_cpo_cart_item_id'] ) ?>"<?php } ?>>
                        <a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>" class="miniCartItemImg">
                            <?php echo uni_coworking_theme_woo_get_product_thumbnail('unithumb-minicartphoto', 88, 88, $product_id) ?>
                        </a>
                        <h3>
                            <a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>"><?php echo esc_html($product_name); ?></a>
                        </h3>
                        <p class="price"><?php echo uni_coworking_theme_woo_get_formatted_price( $product_price ); ?></p>
                        <div class="quantity uni-clear">
                            <span><?php esc_html_e('Quantity:', 'coworking'); ?></span>
                            <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s', $cart_item['quantity'] ) . '</span>', $cart_item, $cart_item_key ); ?>
                        </div>
                        <?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove removeMiniCartItem" title="%s"></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'coworking' ) ), $cart_item_key ); ?>
                        <?php echo WC()->cart->get_item_data( $cart_item ); ?>
                    </div>
                    <?php } ?>
                    <div class="miniCartSubTotal">
                        <?php esc_html_e( 'Subtotal', 'coworking' ); ?>
                        <span><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                    </div>
                    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btnViewCart"><?php esc_html_e('view cart', 'coworking'); ?></a>
                    <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btnCheckout"><?php esc_html_e('checkout', 'coworking'); ?></a>

                <?php else: ?>
                    <div class="miniCartEmpty">
                        <i></i>
                        <p><?php esc_html_e( 'Your cart is empty', 'coworking' ); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

//social share buttons on single product page
    function uni_coworking_theme_template_single_sharing() {
        ?>
        <div class="shareSingleProduct">
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
        <?php
    }

// Related products by product tags with thumb
    function uni_coworking_theme_related_products_by_tags() {

        global $post;
        $oOriginalPost = $post;
        $aTags = wp_get_object_terms( $post->ID, 'product_tag' );

        if ( isset($aTags) ) {
            $aRelativeTagArray = array();
            foreach($aTags as $oTag)
                $aRelativeTagArray[] = $oTag->term_id;

            $aRelatedArgs = array(
                'post_type' => 'product',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_tag',
                        'field'    => 'id',
                        'terms'    => $aRelativeTagArray,
                    ),
                ),
                'post__not_in' => array($post->ID),
                'posts_per_page' => 5,
                'orderby' => 'rand',
                'ignore_sticky_posts' => 1
            );

            $oRelatedQuery = new wp_query( $aRelatedArgs );

            if( $oRelatedQuery->have_posts() ) {

                echo '<div class="relatedProducts">
                <div class="blockTitle">'.esc_html__('Related products', 'coworking').'</div>
                <div class="shopItems">
                <ul class="shopItemsWrap">';

                while($oRelatedQuery->have_posts()) : $oRelatedQuery->the_post();

                    wc_get_template_part( 'content', 'product' );

                endwhile;

                echo '</ul>
                </div>
                </div>';

            }

        }
        $post = $oOriginalPost;
        wp_reset_postdata();
    }

//
    function uni_coworking_theme_order_by_rating_post_clauses( $args ) {

        global $wpdb;

        $args['fields'] .= ", AVG( $wpdb->commentmeta.meta_value ) as average_rating ";
        $args['where'] .= " AND ( $wpdb->commentmeta.meta_key = 'rating' OR $wpdb->commentmeta.meta_key IS null ) ";
        $args['join'] .= "
        LEFT OUTER JOIN $wpdb->comments ON($wpdb->posts.ID = $wpdb->comments.comment_post_ID)
        LEFT JOIN $wpdb->commentmeta ON($wpdb->comments.comment_ID = $wpdb->commentmeta.comment_id)
        ";
        $args['orderby'] = "average_rating DESC, $wpdb->posts.post_date DESC";
        $args['groupby'] = "$wpdb->posts.ID";

        return $args;
    }

//*********** Calendarius ****************************************************************
    if ( class_exists('Uni_Calendar') ) :
//
        function uni_coworking_theme_ec_templates_builtin() {
            $bOutputTmpl = uni_ec_check_calendar_shortcode_added();
            if ( $bOutputTmpl ) {
                ?>
                <!-- Event Info modal template for built-in -->
                <script type="text/template" id="js-uni-calendar-info-event-tmpl">
                    <div class="uni-ec-universal-container" style="border-color:<%= calEvent.borderColor %>;">
                        <div class="uni-ec-bar uni-ec-title-bar <% if ( typeof chosenTheme !== 'undefined' && typeof UniCalendar.data.calThemes[chosenTheme] !== 'undefined' ) { print(UniCalendar.data.calThemes[chosenTheme]['class_name']); } else { print('uni-ec-theme-flat-cyan'); } %>" style="background-color:<%= calEvent.backgroundColor %>;">
                            <h3 style="color:<%= calEvent.textColor %>;"><%= calEvent.title %></h3>
                        </div>

                        <div class="uni-ec-form-content">

                            <div class="uni-ec-form-section uni-ec-form-section-modal">

                                <% if ( calEvent.meta.event_all_day_enable && calEvent.meta.event_all_day_enable === 'yes' ) { %>
                                <div class="uni-ec-info-section uni-ec-info-section-duration">
                                    <span class="uni-ec-info-section-duration-allday">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <?php esc_html_e('All day', 'uni-calendar') ?>
                                    </span>
                                </div>
                                <% } else { %>
                                <div class="uni-ec-info-section uni-ec-info-section-availability">
                                    <span class="uni-ec-info-section-duration-timed">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <%= moment.utc(calEvent.start._i).format(uniTimeFormat) %>
                                        &nbsp;&ndash;&nbsp;
                                        <%= moment.utc(calEvent.end._i).format(uniTimeFormat) %>
                                    </span>
                                </div>
                                <% } %>

                                <div class="uni-ec-info-section uni-ec-info-section-description uni-ec-form-section-nice-scroll">
                                    <%= calEvent.meta.event_desc %>
                                </div>

                                <% if ( calEvent.meta.event_user ) { %>
                                <div class="uni-ec-info-section uni-ec-info-section-users">
                                    <% _.each(calEvent.meta.event_user, function (value, key, list) {
                                    if ( allUsers[value] ) {
                                    %>
                                    <span class="uni-ec-info-section-user-url">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <%= allUsers[value].name %>
                                    </span>
                                    <%
                                }
                            }); %>
                        </div>
                        <% } %>

                        <% if ( calEvent.meta.event_click_behavior && calEvent.meta.event_click_behavior == 'modal_uri' ) { %>
                        <div class="uni-ec-info-section uni-ec-info-section-link">
                            <a class="uni-ec-info-section-link-url" href="<%= calEvent.meta.event_link_uri %>">
                                <%= calEvent.meta.event_link_text %>
                            </a>
                        </div>
                        <% } %>

                    </div>

                    <span class="js-uni-event-modal-close-btn uni-event-modal-close-btn"><?php esc_html_e('Close', 'uni-calendar') ?></span>

                </div>

            </div>
        </script>
        <?php
    }
}
remove_action('wp_footer', 'uni_ec_templates_builtin');
add_action('wp_footer', 'uni_coworking_theme_ec_templates_builtin');

//
function uni_coworking_theme_uni_ec_templates_mb() {
    $bOutputTmpl = uni_ec_check_calendar_shortcode_added();
    if ( $bOutputTmpl ) {
        ?>
        <!-- Event Info modal template for MindBodyOnine -->
        <script type="text/template" id="js-uni-calendar-info-event-mb-tmpl">
            <div class="uni-ec-universal-container" style="border-color:<%= calEvent.borderColor %>;">
                <div class="uni-ec-bar uni-ec-title-bar <% if ( typeof calEvent.meta.uni_input_cal_theme !== 'undefined' && typeof UniCalendar.data.calThemes[calEvent.meta.uni_input_cal_theme] !== 'undefined' ) { print(UniCalendar.data.calThemes[calEvent.meta.uni_input_cal_theme]['class_name']); } else { print('uni-ec-theme-flat-cyan'); } %>" style="background-color:<%= calEvent.backgroundColor %>;">
                    <h3 style="color:<%= calEvent.textColor %>;"><%= calEvent.title %></h3>
                </div>

                <div class="uni-ec-form-content">

                    <div class="uni-ec-form-section uni-ec-form-section-modal">

                        <% if ( calEvent.meta.class_available === true ) { %>
                        <div class="uni-ec-info-section uni-ec-info-section-availability">
                            <span class="uni-ec-info-section-availability-active">
                                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                <?php esc_html_e('Active', 'uni-calendar') ?>
                            </span>
                        </div>
                        <% } else { %>
                        <div class="uni-ec-info-section uni-ec-info-section-availability">
                            <span class="uni-ec-info-section-availability-cancelled">
                                <i class="fa fa-calendar-times-o" aria-hidden="true"></i>
                                <?php esc_html_e('Cancelled', 'uni-calendar') ?>
                            </span>
                        </div>
                        <% } %>

                        <div class="uni-ec-info-section uni-ec-info-section-description uni-ec-form-section-nice-scroll">
                            <%= calEvent.meta.event_desc %>
                        </div>

                        <% if ( calEvent.meta.class_instructor ) { %>
                        <div class="uni-ec-info-section uni-ec-info-section-users last">
                            <span class="uni-ec-info-section-user-url">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <%= calEvent.meta.class_instructor %>
                            </span>
                        </div>
                        <% } %>

                    </div>

                    <span class="js-uni-event-modal-close-btn uni-event-modal-close-btn"><?php esc_html_e('Close', 'uni-calendar') ?></span>

                </div>

            </div>
        </script>
        <?php
    }
}
remove_action('wp_footer', 'uni_ec_templates_mb');
add_action('wp_footer', 'uni_coworking_theme_uni_ec_templates_mb');

//
function uni_coworking_theme_uni_ec_templates_cobot() {
    $bOutputTmpl = uni_ec_check_calendar_shortcode_added();
    if ( $bOutputTmpl ) {
        ?>
        <!-- Event Info modal template for Cobot.me -->
        <script type="text/template" id="js-uni-calendar-info-event-cobot-tmpl">
            <div class="uni-ec-universal-container" style="border-color:<%= calEvent.borderColor %>;">
                <div class="uni-ec-bar uni-ec-title-bar <% if ( typeof chosenTheme !== 'undefined' && typeof UniCalendar.data.calThemes[chosenTheme] !== 'undefined' ) { print(UniCalendar.data.calThemes[chosenTheme]['class_name']); } else { print('uni-ec-theme-flat-cyan'); } %>" style="background-color:<%= calEvent.backgroundColor %>;">
                    <h3 style="color:<%= calEvent.textColor %>;"><%= calEvent.title %></h3>
                </div>

                <div class="uni-ec-form-content">

                    <div class="uni-ec-form-section uni-ec-form-section-modal">

                        <div class="uni-ec-info-section uni-ec-info-section-description uni-ec-form-section-nice-scroll">
                            <% if ( calEvent.meta.event_desc ) { %>
                            <%= calEvent.meta.event_desc %>
                            <% } else { %>
                            <?php esc_html_e('No description.', 'uni-calendar') ?>
                            <% } %>
                        </div>

                    </div>

                    <span class="js-uni-event-modal-close-btn uni-event-modal-close-btn"><?php esc_html_e('Close', 'uni-calendar') ?></span>

                </div>

            </div>
        </script>
        <?php
    }
}
remove_action('wp_footer', 'uni_ec_templates_cobot');
add_action('wp_footer', 'uni_coworking_theme_uni_ec_templates_cobot');

//
function uni_coworking_theme_uni_ec_templates_tickera() {
    $bOutputTmpl = uni_ec_check_calendar_shortcode_added();
    if ( $bOutputTmpl ) {
        ?>
        <!-- Event Info modal template for Tickera events -->
        <script type="text/template" id="js-uni-calendar-info-event-tickera-tmpl">
            <div class="uni-ec-universal-container" style="border-color:<%= calEvent.borderColor %>;">
                <div class="uni-ec-bar uni-ec-title-bar <% if ( typeof chosenTheme !== 'undefined' && typeof UniCalendar.data.calThemes[chosenTheme] !== 'undefined' ) { print(UniCalendar.data.calThemes[chosenTheme]['class_name']); } else { print('uni-ec-theme-flat-cyan'); } %>" style="background-color:<%= calEvent.backgroundColor %>;">
                    <h3 style="color:<%= calEvent.textColor %>;"><%= calEvent.title %></h3>
                </div>

                <div class="uni-ec-form-content">

                    <div class="uni-ec-form-section uni-ec-form-section-modal">

                        <% if ( calEvent.meta.event_location ) { %>
                        <div class="uni-ec-info-section uni-ec-info-section-location last">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <%= calEvent.meta.event_location  %>
                        </div>
                        <% } %>

                        <div class="uni-ec-info-section uni-ec-info-section-description uni-ec-form-section-nice-scroll">
                            <%= calEvent.meta.event_desc %>
                        </div>

                    </div>

                    <div class="uni-ec-form-section uni-ec-form-section-with-btn centered uni-ec-form-section-modal">
                        <a href="<%= calEvent.meta.event_page_uri %>" class="btn btn-inform" target="_blank"><?php esc_html_e('The event page', 'uni-calendar') ?></a>
                        <button class="js-uni-event-modal-close-btn btn" type="button"><?php esc_html_e('Close', 'uni-calendar') ?></button>
                    </div>

                </div>

            </div>
        </script>
        <?php
    }
}
remove_action('wp_footer', 'uni_ec_templates_tickera');
add_action('wp_footer', 'uni_coworking_theme_uni_ec_templates_tickera');

endif;

//
header("X-XSS-Protection: 0");
?>