<?php
/**
 * Initialize the custom Meta Boxes.
 */
add_action( 'admin_init', 'uni_coworking_theme_meta_boxes' );

/**
 * Meta Boxes.
 *
 */
function uni_coworking_theme_meta_boxes() {

  $price_meta_box = array(
    'id'          => 'price_meta_box',
    'title'       => esc_html__( 'Additional settings for Price', 'coworking' ),
    'desc'        => '',
    'pages'       => array( 'uni_price' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => esc_html__( 'Price settings', 'coworking' ),
        'id'          => 'tab_add_info',
        'type'        => 'tab'
      ),
      array(
        'label'       => esc_html__( 'Price value', 'coworking' ),
        'id'          => 'uni_price_val',
        'type'        => 'text',
        'desc'        => ''
      ),
      array(
        'label'       => esc_html__( 'Enable/Disable displayin info about taxes', 'coworking' ),
        'id'          => 'uni_price_tax_info_enable',
        'type'        => 'on-off',
        'desc'        => esc_html__( 'Adds "*" sign and enables a possibility to define custom text-description', 'coworking' ),
        'std'         => 'off'
      ),
      array(
        'label'       => esc_html__( 'Information about taxes', 'coworking' ),
        'id'          => 'uni_price_tax_info_text',
        'type'        => 'text',
        'desc'        => '',
        'condition'   => 'uni_price_tax_info_enable:is(on)'
      ),
      array(
        'label'       => esc_html__( 'Currency sign', 'coworking' ),
        'id'          => 'uni_price_currency',
        'type'        => 'text',
        'desc'        => ''
      ),
      array(
        'label'       => esc_html__( 'for... ?', 'coworking' ),
        'id'          => 'uni_price_period',
        'type'        => 'text',
        'desc'        => esc_html__('for example: "mo", "month", "week" etc.', 'coworking')
      ),
      array(
        'label'       => esc_html__( '"Join Now" button settings', 'coworking' ),
        'id'          => 'orderbtn_info',
        'type'        => 'tab'
      ),
      array(
        'label'       => esc_html__( 'Custom text for "Join Now" button', 'coworking' ),
        'id'          => 'uni_price_order_button_text',
        'type'        => 'text',
        'desc'        => ''
      ),
      array(
        'label'       => esc_html__( 'Enable/Disable external URI for Join Now" button', 'coworking' ),
        'id'          => 'uni_price_order_button_ext_url_enable',
        'type'        => 'on-off',
        'desc'        => esc_html__( 'By default "Join Now" button opens a modal window with a simple ordering form. It sends information only, no payments. However, you can enable external URI for this button if you want, for instance, redirect your clients to PayPal or similar. Please, don\'t forget to add the URI, otherwise you won\'t see this button at all!', 'coworking' ),
        'std'         => 'off'
      ),
      array(
        'label'       => esc_html__( 'Custom URI for "Join Now" button', 'coworking' ),
        'id'          => 'uni_price_order_button_uri',
        'type'        => 'text',
        'desc'        => '',
        'condition'   => 'uni_price_order_button_ext_url_enable:is(on)'
      ),
      array(
        'label'       => esc_html__( 'List of features', 'coworking' ),
        'id'          => 'list_info',
        'type'        => 'tab'
      ),
      array(
        'id'          => 'uni_price_table_item_bg',
        'label'       => esc_html__( 'Background image for item header of this item', 'coworking' ),
        'desc'        => esc_html__( 'Please, add an image that will be visible in this item header. This image will be resized to 370x94 px.', 'coworking' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'list_info',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => 'ot-upload-attachment-id',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_price_features_list',
        'label'       => esc_html__( 'List of features', 'coworking' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'list_info',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array(
          array(
            'id'          => 'uni_price_feature_item',
            'label'       => esc_html__( 'Text of the feature. Example: "High Speed Internet". This text must be added and will be visible on a website.', 'coworking' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      )
    )
  );

  $product_meta_box = array(
    'id'          => 'product_meta_box',
    'title'       => esc_html__( 'Additional settings for Product type Subscription', 'coworking' ),
    'desc'        => '',
    'pages'       => array( 'product' ),
    'context'     => 'normal',
    'priority'    => 'low',
    'fields'      => array(
      array(
        'label'       => esc_html__( 'List of features', 'coworking' ),
        'desc'        => esc_html__( 'These list of features will be shown for this item on homepage in Price tables section', 'coworking' ),
        'id'          => 'list_info',
        'type'        => 'tab'
      ),
      array(
        'id'          => 'uni_product_table_item_bg',
        'label'       => esc_html__( 'Background image for item header of this item', 'coworking' ),
        'desc'        => esc_html__( 'Please, add an image that will be visible in this item header. This image will be resized to 370x94 px.', 'coworking' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'list_info',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => 'ot-upload-attachment-id',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_product_features_list',
        'label'       => esc_html__( 'List of features', 'coworking' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'list_info',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array(
          array(
            'id'          => 'uni_product_feature_item',
            'label'       => esc_html__( 'Text of the feature. Example: "High Speed Internet". This text must be added and will be visible on a website.', 'coworking' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      )
    )
  );

  $event_meta_box = array(
    'id'          => 'event_meta_box',
    'title'       => esc_html__( 'Additional settings for the event', 'coworking' ),
    'desc'        => '',
    'pages'       => array( 'uni_event' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => esc_html__( 'Additional info', 'coworking' ),
        'id'          => 'tab_add_info',
        'type'        => 'tab'
      ),
      array(
        'id'          => 'uni_event_events_page_bg',
        'label'       => esc_html__( 'Background image on Events archive page', 'coworking' ),
        'desc'        => esc_html__( 'Add custom image that will be used as background for this event on Events archive page as well as a background that will be shown on hover on the item of this event on home pae in Events section.', 'coworking' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'tab_add_info',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => 'ot-upload-attachment-id',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_event_date_start',
        'label'       => esc_html__( 'Start date of the event', 'coworking' ),
        'desc'        => esc_html__( 'Add the start date of the event. The start date of the event will be shown in a nice looking block on event single page. Also, a value of this field will be used for sorting of events.', 'coworking' ),
        'std'         => '',
        'type'        => 'date-picker',
        'section'     => 'tab_add_info',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_event_time_start',
        'label'       => esc_html__( 'Start time of the event', 'coworking' ),
        'desc'        => esc_html__( 'Add the start time of the event. The start time of the event will be shown in a nice looking block on event single page. Also, a value of this field will be used for sorting of events.', 'coworking' ),
        'std'         => '',
        'type'        => 'time-picker',
        'section'     => 'tab_add_info',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_event_date_end',
        'label'       => esc_html__( 'End date of the event', 'coworking' ),
        'desc'        => esc_html__( 'Add the end date of the event. The end date of the event will be shown in a nice looking block on event single page. Also, a value of this field will be used for sorting of events.', 'coworking' ),
        'std'         => '',
        'type'        => 'date-picker',
        'section'     => 'tab_add_info',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_event_time_end',
        'label'       => esc_html__( 'End time of the event', 'coworking' ),
        'desc'        => esc_html__( 'Add the end time of the event. The end time of the event will be shown in a nice looking block on event single page.', 'coworking' ),
        'std'         => '',
        'type'        => 'time-picker',
        'section'     => 'tab_add_info',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'label'       => esc_html__( 'Address of the event', 'coworking' ),
        'id'          => 'uni_event_address',
        'type'        => 'text',
        'desc'        => esc_html__( 'Add the address of the event. The address of the event will be shown in a nice looking block on event single page.', 'coworking' )
      ),
      array(
        'label'       => esc_html__( 'Price of a ticket', 'coworking' ),
        'id'          => 'uni_event_price',
        'type'        => 'text',
        'desc'        => esc_html__( 'Add price for ticket for the event. Examples: "$10" or "Free of charge". The price for ticket for the event will be shown in a nice looking block on event single page.', 'coworking' )
      ),
      array(
        'label'       => esc_html__( 'Map settings', 'coworking' ),
        'id'          => 'tab_map_info',
        'type'        => 'tab'
      ),
      array(
        'label'       => esc_html__( 'Coordinates for the map', 'coworking' ),
        'id'          => 'uni_event_coord',
        'type'        => 'text',
        'desc'        => esc_html__( 'Add the coordinates of the event. Example: "41.404182,2.199451"', 'coworking' )
      ),
      array(
        'label'       => esc_html__( 'Zoom', 'coworking' ),
        'id'          => 'uni_event_zoom',
        'type'        => 'text',
        'desc'        => esc_html__( 'Define zoom level. Example: "12"', 'coworking' )
      ),
      array(
        'id'          => 'uni_event_marker_color',
        'label'       => esc_html__( 'Colour of map marker', 'coworking' ),
        'desc'        => '',
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'tab_map_info',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'label'       => esc_html__( '"join event" functionality', 'coworking' ),
        'id'          => 'tab_joint_info',
        'type'        => 'tab'
      ),
      array(
        'label'       => esc_html__( 'Enable/disable "join event" functionality for this event only!', 'coworking' ),
        'id'          => 'uni_local_events_join_on',
        'type'        => 'on-off',
        'desc'        => esc_html__( 'Enabling this option will be resulted in adding "Join event" button on this single event page. This button opens modal window with form that can be used as registration form. After form submit a site owner and a user receive emails with entered information. <strong>Important: no data from this form will be stored in DB. It just sends emails! This option allows you to override "join event" global option, so even if this option is globally off, it will be on for this event only.', 'coworking' ),
        'std'         => 'off'
      ),
      array(
        'label'       => esc_html__( 'Custom text for the "join event" button and title for modal window connected with this button', 'coworking' ),
        'id'          => 'uni_local_events_button_text',
        'type'        => 'text',
        'desc'        => esc_html__( 'Default is "Join event"', 'coworking' ),
        'std'         => esc_html__( 'Join event', 'coworking' )
      )
    )
  );

  $tickera_meta_box = array(
    'id'          => 'event_meta_box',
    'title'       => esc_html__( 'Additional settings for the event', 'coworking' ),
    'desc'        => '',
    'pages'       => array( 'tc_events' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => esc_html__( 'Additional info', 'coworking' ),
        'id'          => 'tab_add_info',
        'type'        => 'tab'
      ),
      array(
        'id'          => 'uni_event_events_page_bg',
        'label'       => esc_html__( 'Background image on Events archive page', 'coworking' ),
        'desc'        => esc_html__( 'Add custom image that will be used as background for this event on Events archive page as well as a background that will be shown on hover on the item of this event on home pae in Events section.', 'coworking' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'tab_add_info',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => 'ot-upload-attachment-id',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'label'       => esc_html__( 'Map settings', 'coworking' ),
        'id'          => 'tab_map_info',
        'type'        => 'tab'
      ),
      array(
        'label'       => esc_html__( 'Coordinates for the map', 'coworking' ),
        'id'          => 'uni_event_coord',
        'type'        => 'text',
        'desc'        => esc_html__( 'Add the coordinates of the event. Example: "41.404182,2.199451"', 'coworking' )
      ),
      array(
        'label'       => esc_html__( 'Zoom', 'coworking' ),
        'id'          => 'uni_event_zoom',
        'type'        => 'text',
        'desc'        => esc_html__( 'Define zoom level. Example: "12"', 'coworking' )
      ),
      array(
        'id'          => 'uni_event_marker_color',
        'label'       => esc_html__( 'Colour of map marker', 'coworking' ),
        'desc'        => '',
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'tab_map_info',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
    )
  );

  $events_meta_box = array(
    'id'          => 'events_meta_box',
    'title'       => esc_html__( 'Additional settings for "Events" page', 'coworking' ),
    'desc'        => '',
    'pages'       => array( 'page' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => '',
        'id'          => 'events_textblock',
        'type'        => 'textblock',
        'desc'        => esc_html__( 'This page is designed to display your events. Events are just like blog posts, but themed).', 'coworking' ),
        'operator'    => 'and',
        'condition'   => ''
      ),
      array(
        'id'          => 'uni_events_page_header_bg',
        'label'       => esc_html__( 'Page header image', 'coworking' ),
        'desc'        => esc_html__( 'Add custom image in the header of this page.', 'coworking' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => 'ot-upload-attachment-id',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_events_page_header_title_color',
        'label'       => esc_html__( 'Colour of page header title', 'coworking' ),
        'desc'        => esc_html__( 'Default is "white". You can choose another colour for this text.', 'coworking' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_events_page_filter',
        'label'       => esc_html__( 'Sorting for events-posts', 'coworking' ),
        'desc'        => esc_html__( 'Choose sorting for events-posts. You can decide to display only upcoming events, only past events or all the evens added.', 'coworking' ),
        'std'         => 'default',
        'type'        => 'select',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => 'default',
            'label'       => esc_html__( 'All events', 'coworking' ),
            'src'         => ''
          ),
          array(
            'value'       => 'newer',
            'label'       => esc_html__( 'Newer', 'coworking' ),
            'src'         => ''
          ),
          array(
            'value'       => 'older',
            'label'       => esc_html__( 'Older', 'coworking' ),
            'src'         => ''
          ),
          array(
            'value'       => 'new_only_newer',
            'label'       => esc_html__( 'Upcoming only DESC ', 'coworking' ),
            'src'         => ''
          ),
          array(
            'value'       => 'new_only_older',
            'label'       => esc_html__( 'Upcoming only ASC', 'coworking' ),
            'src'         => ''
          ),
          array(
            'value'       => 'past_only_newer',
            'label'       => esc_html__( 'Past only DESC ', 'coworking' ),
            'src'         => ''
          ),
          array(
            'value'       => 'past_only_older',
            'label'       => esc_html__( 'Past only ASC', 'coworking' ),
            'src'         => ''
          )
        )
      )
    )
  );

  $schedule_meta_box = array(
    'id'          => 'schedule_meta_box',
    'title'       => esc_html__( 'Additional settings for "Schedule" page', 'coworking' ),
    'desc'        => '',
    'pages'       => array( 'page' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => '',
        'id'          => 'schedule_textblock',
        'type'        => 'textblock',
        'desc'        => esc_html__( 'This page is designed to display your schedule.', 'coworking' ),
        'operator'    => 'and',
        'condition'   => ''
      ),
      array(
        'id'          => 'uni_schedule_page_header_bg',
        'label'       => esc_html__( 'Page header image', 'coworking' ),
        'desc'        => esc_html__( 'Add custom image in the header of this page.', 'coworking' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => 'ot-upload-attachment-id',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_schedule_page_header_title_color',
        'label'       => esc_html__( 'Colour of page header title', 'coworking' ),
        'desc'        => esc_html__( 'Default is "white". You can choose another colour for this text.', 'coworking' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
    )
  );

  $about_meta_box = array(
    'id'          => 'about_meta_box',
    'title'       => esc_html__( 'Additional settings for "About" page', 'coworking' ),
    'desc'        => '',
    'pages'       => array( 'page' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => esc_html__( 'Main settings', 'coworking' ),
        'id'          => 'tab_about_main',
        'type'        => 'tab'
      ),
      array(
        'id'          => 'uni_about_page_header_bg',
        'label'       => esc_html__( 'Page header image', 'coworking' ),
        'desc'        => esc_html__( 'Add custom image in the header of this page.', 'coworking' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => 'ot-upload-attachment-id',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_about_page_header_title_color',
        'label'       => esc_html__( 'Colour of page header title', 'coworking' ),
        'desc'        => esc_html__( 'Default is "white". You can choose another colour for this text.', 'coworking' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'label'       => esc_html__( 'About us info', 'coworking' ),
        'id'          => 'tab_about_us',
        'type'        => 'tab'
      ),
      array(
        'id'          => 'uni_about_us_top_img',
        'label'       => esc_html__( 'Top wide image', 'coworking' ),
        'desc'        => esc_html__( 'One of the three images which can be showcased in this section.', 'coworking' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => 'ot-upload-attachment-id',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_about_us_left_bottom_img',
        'label'       => esc_html__( 'Left bottom square image', 'coworking' ),
        'desc'        => esc_html__( 'One of the three images which can be showcased in this section.', 'coworking' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => 'ot-upload-attachment-id',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_about_us_right_bottom_img',
        'label'       => esc_html__( 'Right bottom square image', 'coworking' ),
        'desc'        => esc_html__( 'One of the three images which can be showcased in this section.', 'coworking' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => 'ot-upload-attachment-id',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'label'       => '',
        'id'          => 'uni_about_us_logo_textblock',
        'type'        => 'textblock',
        'desc'        => esc_html__( 'The logo image in this section is the same as in "About Us" section on the homepage. Go to WP Customizer, navigate to Settings for "About Us" section and use settings for logo image shown there.', 'coworking' ),
        'operator'    => 'and',
        'condition'   => ''
      ),
      array(
        'label'       => esc_html__( 'Block title', 'coworking' ),
        'id'          => 'uni_about_us_title',
        'type'        => 'text',
        'desc'        => ''
      ),
      array(
        'label'       => esc_html__( 'Block main text', 'coworking' ),
        'id'          => 'uni_about_us_description',
        'type'        => 'textarea',
        'desc'        => ''
      ),
      array(
        'label'       => esc_html__( 'Show/hide the "Join now" link', 'coworking' ),
        'id'          => 'uni_about_us_link_on',
        'type'        => 'on-off',
        'desc'        => '',
        'std'         => 'on'
      ),
      array(
        'label'       => esc_html__( 'Custom URI for "Join now" link', 'coworking' ),
        'id'          => 'uni_about_us_link_uri',
        'type'        => 'text',
        'desc'        => ''
      ),
      array(
        'label'       => esc_html__( 'Custom label for "Join now" link', 'coworking' ),
        'id'          => 'uni_about_us_link_label',
        'type'        => 'text',
        'desc'        => ''
      ),
      array(
        'label'       => esc_html__( '"Meet our team"', 'coworking' ),
        'id'          => 'tab_team',
        'type'        => 'tab'
      ),
      array(
        'label'       => esc_html__( 'Enable/disable "meet our team" section', 'coworking' ),
        'id'          => 'uni_about_team_on',
        'type'        => 'on-off',
        'desc'        => '',
        'std'         => 'off'
      ),
      array(
        'id'          => 'uni_about_team_members',
        'label'       => esc_html__( 'Choose users to be displayed on this page', 'coworking' ),
        'desc'        => esc_html__( 'This block displays all users with "coworking_staff" role by default. You can choose to display only certain users.', 'coworking' ),
        'std'         => '',
        'type'        => 'uni-users-type-checkbox',
        'section'     => 'option_types',
        'post_type'   => 'coworking_staff',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'label'       => esc_html__( 'Instagram', 'coworking' ),
        'id'          => 'tab_instagram',
        'type'        => 'tab'
      ),
      array(
        'label'       => esc_html__( 'Enable/disable Instagram section', 'coworking' ),
        'id'          => 'uni_about_instagram_on',
        'type'        => 'on-off',
        'desc'        => '',
        'std'         => 'off'
      ),
      array(
        'label'       => '',
        'id'          => 'about_instagram_textblock',
        'type'        => 'textblock',
        'desc'        => esc_html__( 'This section shares the same settings for Instagram integration as similar section on the homepage. Go to WP Customizer, navigate to "Home" page: Instagram section and use settings shown there.', 'coworking' ),
        'operator'    => 'and',
        'condition'   => ''
      )
    )
  );

  $plans_meta_box = array(
    'id'          => 'plans_meta_box',
    'title'       => esc_html__( 'Additional settings for "Membership Plans" page', 'coworking' ),
    'desc'        => '',
    'pages'       => array( 'page' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => esc_html__( 'Main settings', 'coworking' ),
        'id'          => 'tab_plans_main',
        'type'        => 'tab'
      ),
      array(
        'id'          => 'uni_plans_page_header_bg',
        'label'       => esc_html__( 'Page header image', 'coworking' ),
        'desc'        => esc_html__( 'Add custom image in the header of this page.', 'coworking' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => 'ot-upload-attachment-id',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_plans_page_header_title_color',
        'label'       => esc_html__( 'Colour of page header title', 'coworking' ),
        'desc'        => esc_html__( 'Default is "white". You can choose another colour for this text.', 'coworking' ),
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_plans_posts',
        'label'       => esc_html__( 'Choose plans-posts to be displayed on this page', 'coworking' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'custom-post-type-checkbox',
        'section'     => 'tab_plans_main',
        'rows'        => '',
        'post_type'   => 'uni_price_plan',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
    )
  );

  if ( class_exists( 'Uni_Calendar' ) ) {
    $plans_meta_box['fields'][] = array(
        'label'       => esc_html__( 'Calendarius integration', 'coworking' ),
        'id'          => 'tab_plans_calendarius',
        'type'        => 'tab'
      );
    $plans_meta_box['fields'][] = array(
        'label'       => esc_html__( 'Calendarius calendar ID', 'coworking' ),
        'id'          => 'uni_plans_cal_id',
        'type'        => 'text',
        'desc'        => esc_html__( 'You have to define ID of a calendar created within Calendarius plugin.', 'coworking' ),
        'condition'   => ''
      );
    $plans_meta_box['fields'][] = array(
        'label'       => esc_html__( 'Enable/Disable displaying Cobot.me membership plans', 'coworking' ),
        'id'          => 'uni_plans_calendarius_cobot_plans_enable',
        'type'        => 'on-off',
        'desc'        => esc_html__( 'Enable this option and define calendar ID of Calendarius plugin in order to display the information about membership plans fetched by Cobot.me API (Please, refer to Calendarius plugin documentation for more information about such integration) instead of theme\'s built-in CPTs.', 'coworking' ),
        'std'         => 'off'
      );
  }

  $plan_meta_box = array(
    'id'          => 'plan_meta_box',
    'title'       => esc_html__( 'Additional settings for Membership Plan', 'coworking' ),
    'desc'        => '',
    'pages'       => array( 'uni_price_plan' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => esc_html__( 'Price settings', 'coworking' ),
        'id'          => 'tab_add_info',
        'type'        => 'tab'
      ),
      array(
        'label'       => esc_html__( 'Price value', 'coworking' ),
        'id'          => 'uni_plan_val',
        'type'        => 'text',
        'desc'        => ''
      ),
      array(
        'label'       => esc_html__( 'Enable/Disable displaying info about taxes', 'coworking' ),
        'id'          => 'uni_plan_tax_info_enable',
        'type'        => 'on-off',
        'desc'        => esc_html__( 'Adds "*" sign and enables a possibility to define custom text-description', 'coworking' ),
        'std'         => 'off'
      ),
      array(
        'label'       => esc_html__( 'Information about taxes', 'coworking' ),
        'id'          => 'uni_plan_tax_info_text',
        'type'        => 'text',
        'desc'        => '',
        'condition'   => 'uni_plan_tax_info_enable:is(on)'
      ),
      array(
        'label'       => esc_html__( 'Currency sign', 'coworking' ),
        'id'          => 'uni_plan_currency',
        'type'        => 'text',
        'desc'        => ''
      ),
      array(
        'label'       => esc_html__( 'for... ?', 'coworking' ),
        'id'          => 'uni_plan_period',
        'type'        => 'text',
        'desc'        => esc_html__('for example: "mo", "month", "week" etc.', 'coworking')
      ),
      array(
        'label'       => esc_html__( '"Join Now" button settings', 'coworking' ),
        'id'          => 'orderbtn_info',
        'type'        => 'tab'
      ),
      array(
        'label'       => esc_html__( 'Custom text for "Join Now" button', 'coworking' ),
        'id'          => 'uni_plan_order_button_label',
        'type'        => 'text',
        'desc'        => ''
      ),
      array(
        'label'       => esc_html__( 'Enable/Disable external URI for Join Now" button', 'coworking' ),
        'id'          => 'uni_plan_order_button_ext_url_enable',
        'type'        => 'on-off',
        'desc'        => esc_html__( 'By default "Join Now" button opens a modal window with a simple ordering form. It sends information only, no payments. However, you can enable external URI for this button if you want, for instance, redirect your clients to PayPal or similar. Please, don\'t forget to add the URI, otherwise you won\'t see this button at all!', 'coworking' ),
        'std'         => 'off'
      ),
      array(
        'label'       => esc_html__( 'Custom URI for "Join Now" button', 'coworking' ),
        'id'          => 'uni_plan_order_button_uri',
        'type'        => 'text',
        'desc'        => '',
        'condition'   => 'uni_plan_order_button_ext_url_enable:is(on)'
      )
    )
  );

  $contact_meta_box = array(
    'id'          => 'contact_meta_box',
    'title'       => esc_html__( 'Parameters for "Contact" page', 'coworking' ),
    'desc'        => '',
    'pages'       => array( 'page' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
array(
        'label'       => esc_html__( 'Map settings', 'coworking' ),
        'id'          => 'tab_map_settings',
        'type'        => 'tab'
      ),
      array(
        'label'       => esc_html__( 'Enable map?', 'coworking' ),
        'id'          => 'uni_contact_map_enable',
        'type'        => 'on-off',
        'desc'        => esc_html__( 'Show or hide map and contact information. Please, remember to add Google Maps API key on the theme options page! The map will not work without the API key!!', 'coworking' ),
        'std'         => 'on'
      ),
      array(
        'id'          => 'uni_contact_map_coordinates',
        'label'       => esc_html__( 'Google map coordinates for this page', 'coworking' ),
        'desc'        => esc_html__( 'For example: "41.404182,2.199451".', 'coworking' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'contact',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_contact_map_zoom',
        'label'       => esc_html__( 'Google map zoom for this page', 'coworking' ),
        'desc'        => '',
        'std'         => '14',
        'type'        => 'select',
        'section'     => 'contact',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => '6',
            'label'       => '6',
            'src'         => ''
          ),
          array(
            'value'       => '7',
            'label'       => '7',
            'src'         => ''
          ),
          array(
            'value'       => '8',
            'label'       => '8',
            'src'         => ''
          ),
          array(
            'value'       => '9',
            'label'       => '9',
            'src'         => ''
          ),
          array(
            'value'       => '10',
            'label'       => '10',
            'src'         => ''
          ),
          array(
            'value'       => '11',
            'label'       => '11',
            'src'         => ''
          ),
          array(
            'value'       => '12',
            'label'       => '12',
            'src'         => ''
          ),
          array(
            'value'       => '13',
            'label'       => '13',
            'src'         => ''
          ),
          array(
            'value'       => '14',
            'label'       => '14',
            'src'         => ''
          ),
          array(
            'value'       => '15',
            'label'       => '15',
            'src'         => ''
          ),
          array(
            'value'       => '16',
            'label'       => '16',
            'src'         => ''
          ),
          array(
            'value'       => '17',
            'label'       => '17',
            'src'         => ''
          ),
        )
      ),
      array(
        'id'          => 'uni_contact_marker_colour',
        'label'       => esc_html__( 'A colour for marker on this page', 'coworking' ),
        'desc'        => esc_html__( 'Choose a colour for the map marker on this page. Default is "#000000" (black)', 'coworking' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'option_types',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_contact_map_styles',
        'label'       => esc_html__( 'Style of the map', 'coworking' ),
        'desc'        => '',
        'std'         => 'asanaGrey',
        'type'        => 'select',
        'section'     => 'contact',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => uni_coworking_theme_map_styles()
      ),
      array(
        'id'          => 'uni_contact_title',
        'label'       => esc_html__( 'Title to be displayed next to the map', 'coworking' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'contact',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_contact_subtitle',
        'label'       => esc_html__( 'Subtitle to be displayed below the title', 'coworking' ),
        'desc'        => '',
        'std'         => esc_html__('We really love meeting new people. Step by to say hello!', 'coworking'),
        'type'        => 'text',
        'section'     => 'contact',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_contact_address',
        'label'       => esc_html__( 'Address to be displayed on this page', 'coworking' ),
        'desc'        => esc_html__( 'You may use html tags: <code>br, em, strong, a</code>.', 'coworking' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'contact',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_contact_phone',
        'label'       => esc_html__( 'Phone number to be displayed on this page', 'coworking' ),
        'desc'        => esc_html__( 'You may use html tags: <code>br, em, strong, a</code>.', 'coworking' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'contact',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'uni_contact_email',
        'label'       => esc_html__( 'Email to be displayed on the "Contact Us" page', 'coworking' ),
        'desc'        => esc_html__( 'Also an information submitted via contact form will be sent to this email address. Or leave this field empty in order to display and use admin email defined on your website settings page.', 'coworking' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'contact',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'label'       => esc_html__( 'Contact form settings', 'coworking' ),
        'id'          => 'tab_form_settings',
        'type'        => 'tab'
      ),
      array(
        'label'       => esc_html__( 'Enable contact form?', 'coworking' ),
        'id'          => 'uni_contact_form_enable',
        'type'        => 'on-off',
        'desc'        => esc_html__( 'Show or hide contact form', 'coworking' ),
        'std'         => 'on'
      ),
      array(
        'label'       => esc_html__( 'Title (H3) before contact form', 'coworking' ),
        'id'          => 'uni_contact_form_title',
        'type'        => 'text',
        'desc'        => '',
        'std'         => esc_html__('Say Hello', 'coworking')
      ),
      array(
        'label'       => esc_html__( 'Subtitle before contact form', 'coworking' ),
        'id'          => 'uni_contact_form_subtitle',
        'type'        => 'text',
        'desc'        => '',
        'std'         => esc_html__('Join our great coworking space and community. Please fill out the form and our manager will get back asap.', 'coworking')
      ),
      array(
        'id'          => 'uni_contact_page_form_seven_id',
        'label'       => esc_html__( 'CF7 form ID for the contact form', 'coworking' ),
        'desc'        => esc_html__( 'Also you can utilise Contact Form 7 form instead of built-in form. Just activate your Contact Form 7 plugin and define here the ID of the form.', 'coworking' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'contact',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
    )
  );

  $slider_meta_box = array(
    'id'          => 'slider_meta_box',
    'title'       => esc_html__( 'Parameters for Home Page Slide', 'coworking' ),
    'desc'        => '',
    'pages'       => array( 'uni_home_slides' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => esc_html__( 'Additional info', 'coworking' ),
        'id'          => 'tab_add_info',
        'type'        => 'tab'
      ),
      array(
        'label'       => esc_html__( 'Subheading', 'coworking' ),
        'id'          => 'uni_slide_subheading',
        'type'        => 'text',
        'std'         => '',
        'desc'        => ''
      ),
      array(
        'label'       => esc_html__( 'Enable button?', 'coworking' ),
        'id'          => 'uni_slide_button_enable',
        'type'        => 'on-off',
        'desc'        => esc_html__( 'Display/hide the button for this slide', 'coworking' ),
        'std'         => 'on'
      ),
      array(
        'label'       => esc_html__( 'Turn the button to custom link?', 'coworking' ),
        'id'          => 'uni_slide_button_custom_link_enable',
        'type'        => 'on-off',
        'desc'        => esc_html__( 'Make it possible to define a custom URI for the button. The button calls "book a tour" modal window by default.', 'coworking' ),
        'std'         => 'off'
      ),
      array(
        'label'       => esc_html__( 'Label for the button', 'coworking' ),
        'id'          => 'uni_slide_button_label',
        'type'        => 'text',
        'std'         => esc_html__( 'book a tour', 'coworking' ),
        'desc'        => ''
      ),
      array(
        'label'       => esc_html__( 'Custom URI for the button', 'coworking' ),
        'id'          => 'uni_slide_button_custom_link_uri',
        'type'        => 'text',
        'std'         => '',
        'desc'        => '',
        'condition'   => 'uni_slide_button_custom_link_enable:is(on)'
      )
    )
  );

  /**
   * Register our meta boxes using the
   * ot_register_meta_box() function.
   */
  if ( function_exists( 'ot_register_meta_box' ) )

    ot_register_meta_box( $price_meta_box );
    ot_register_meta_box( $product_meta_box );
    ot_register_meta_box( $event_meta_box );
    ot_register_meta_box( $tickera_meta_box );
    ot_register_meta_box( $events_meta_box );
    ot_register_meta_box( $schedule_meta_box );
    ot_register_meta_box( $about_meta_box );
    ot_register_meta_box( $plans_meta_box );
    ot_register_meta_box( $plan_meta_box );
    ot_register_meta_box( $contact_meta_box );
    ot_register_meta_box( $slider_meta_box );

}