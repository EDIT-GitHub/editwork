<?php if ( ! defined( 'OT_VERSION' ) ) exit( 'No direct script access allowed' );
/**
 * OptionTree documentation page functions.
 *
 * @package   OptionTree
 * @author    Derek Herman <derek@valendesigns.com>
 * @copyright Copyright (c) 2013, Derek Herman
 * @since     2.0
 */

/**
 * Creating Options option type.
 *
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_creating_options' ) ) {
  
  function ot_type_creating_options() {
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-textblock wide-desc">';
      
      /* description */
      echo '<div class="description">';
        
        echo '<h4>'. esc_html__( 'Label', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Label field should be a short but descriptive block of text 100 characters or less with no HTML.', 'coworking' ) . '</p>';

        echo '<h4>'. esc_html__( 'ID', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The ID field is a unique alphanumeric key used to differentiate each theme option (underscores are acceptable). Also, the plugin will change all text you write in this field to lowercase and replace spaces and special characters with an underscore automatically.', 'coworking' ) . '</p>';

        echo '<h4>'. esc_html__( 'Type', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'You are required to choose one of the supported option types when creating a new option. Here is a list of the available option types. For more information about each type click the <code>Option Types</code> tab to the left.', 'coworking' ) . '</p>';
        
        echo '<ul class="docs-ul">';
        foreach( ot_option_types_array() as $key => $value )
          echo '<li>' . $value . '</li>';
        echo '</ul>';
        
        echo '<h4>'. esc_html__( 'Description', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'Enter a detailed description for the users to read on the Theme Options page, HTML is allowed. This is also where you enter content for both the Textblock & Textblock Titled option types.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Choices', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'Click the "Add Choice" button to add an item to the choices array. This will only affect the following option types: Checkbox, Radio, Select & Select Image.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Settings', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'Click the "Add Setting" button found inside a newly created setting to add an item to the settings array. This will only affect the List Item type.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Standard', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'Setting the standard value for your option only works for some option types. Those types are one that have a single string value saved to them and not an array of values.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Rows', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'Enter a numeric value for the number of rows in your textarea. This will only affect the following option types: CSS, Textarea, & Textarea Simple.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Post Type', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'Add a comma separated list of post type like <code>post,page</code>. This will only affect the following option types: Custom Post Type Checkbox, & Custom Post Type Select. Below are the default post types available with WordPress and that are also compatible with OptionTree. You can also add your own custom <code>post_type</code>. At this time <code>any</code> does not seem to return results properly and is something I plan on looking into.', 'coworking' ) . '</p>';

        echo '<ul class="docs-ul">';
          echo '<li><code>post</code></li>';
          echo '<li><code>page</code></li>';
          echo '<li><code>attachment</code></li>';
        echo '</ul>';

        echo '<h4>'. esc_html__( 'Taxonomy', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'Add a comma separated list of any registered taxonomy like <code>category,post_tag</code>. This will only affect the following option types: Taxonomy Checkbox, & Taxonomy Select.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Min, Max, & Step', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'Add a comma separated list of options in the following format <code>0,100,1</code> (slide from <code>0-100</code> in intervals of <code>1</code>). The three values represent the minimum, maximum, and step options and will only affect the Numeric Slider option type.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'CSS Class', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'Add and optional class to any option type.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Condition', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'Add a comma separated list (no spaces) of conditions in which the field will be visible, leave this setting empty to always show the field. In these examples, %s is a placeholder for your condition, which can be in the form of %s.', 'coworking' ), '<code>value</code>', '<code>field_id:is(value)</code>, <code>field_id:not(value)</code>, <code>field_id:contains(value)</code>, <code>field_id:less_than(value)</code>, <code>field_id:less_than_or_equal_to(value)</code>, <code>field_id:greater_than(value)</code>, or <code>field_id:greater_than_or_equal_to(value)</code>' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Operator', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'Choose the logical operator to compute the result of the conditions. Your options are %s and %s.', 'coworking' ), '<code>and</code>', '<code>or</code>' ) . '</p>';
        
      echo '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * ot_get_option() option type.
 *
 * This is a callback function to display text about ot_get_option().
 *
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_option_types' ) ) {
  
  function ot_type_option_types() {
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-textblock wide-desc">';
      
      /* description */
      echo '<div class="description">';

        echo '<h4>'. esc_html__( 'Background', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'The Background option type is for adding background styles to your theme either dynamically via the CSS option type below or manually with %s. The Background option type has filters that allow you to remove fields or change the defaults. For example, you can filter %s to remove unwanted fields from all Background options or an individual one. You can also filter %s. These filters allow you to fine tune the select lists for your specific needs.', 'coworking' ), '<code>ot_get_option()</code>', '<code>ot_recognized_background_fields</code>', '<code>ot_recognized_background_repeat</code>, <code>ot_recognized_background_attachment</code>, <code>ot_recognized_background_position</code>, ' . esc_html__( 'and', 'coworking' ) . ' <code>ot_type_background_size_choices</code>' ) . '</p>';

        echo '<h4>'. esc_html__( 'Border', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'The Border option type is used to set width, unit, style, and color values. The text input excepts a numerical value and the unit select lets you choose the unit of measurement to add to that value. Currently the default units are %s, %s, %s, and %s. However, you can change them with the %s filter. The style select lets you choose the border style. The default styles are %s, %s, %s, %s, %s, %s, %s, and %s. However, you can change them with the %s filter. The colorpicker saves a hexadecimal color code.', 'coworking' ), '<code>px</code>', '<code>%</code>', '<code>em</code>', '<code>pt</code>', '<code>ot_recognized_border_unit_types</code>', '<code>hidden</code>', '<code>dashed</code>', '<code>solid</code>', '<code>double</code>', '<code>groove</code>', '<code>ridge</code>', '<code>inset</code>', '<code>outset</code>', '<code>ot_recognized_border_style_types</code>' ) . '</p>';

        echo '<h4>'. esc_html__( 'Box Shadow', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'The Box Shadow option type is used to set %s, %s, %s, %s, %s, and %s values.', 'coworking' ), '<code>inset</code>', '<code>offset-x</code>', '<code>offset-y</code>', '<code>blur-radius</code>', '<code>spread-radius</code>', '<code>color</code>' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Category Checkbox', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Category Checkbox option type displays a list of category IDs. It allows the user to check multiple category IDs and will return that value as an array for use in a custom function or loop.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Category Select', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Category Select option type displays a list of category IDs. It allows the user to select only one category ID and will return that value for use in a custom function or loop.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Checkbox', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Checkbox option type displays a group of choices. It allows the user to check multiple choices and will return that value as an array for use in a custom function or loop.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Colorpicker', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Colorpicker option type saves a hexadecimal color code for use in CSS. Use it to modify the color of something in your theme.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Colorpicker Opacity', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'The Colorpicker Opacity option type saves a hexadecimal color code with an opacity value from %s to %s in increments of %s. Though the value is saved as hexadecimal, if used within the CSS option type the color and opacity values will be converted into a valid RGBA CSS value.', 'coworking' ), '<code>0</code>', '<code>1</code>', '<code>0.01</code>' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'CSS', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'The CSS option type is a textarea that when used properly can add dynamic CSS to your theme from within OptionTree. Unfortunately, due server limitations you will need to create a file named %s at the root level of your theme and change permissions using %s so the server can write to the file. I have had the most success setting this single file to %s but feel free to play around with permissions until everything is working. A good starting point is %s. When the server can save to the file, CSS will automatically be updated when you save your Theme Options.', 'coworking' ), '<code>dynamic.css</code>', '<code>chmod</code>', '<code>0777</code>', '<code>0666</code>' ) . '</p>';
        
        echo '<p class="aside">' . sprintf( esc_html__( 'This example assumes you have an option with the ID of %1$s. Which means this option will automatically insert the value of %1$s into the %2$s when the Theme Options are saved.', 'coworking' ), '<code>demo_background</code>', '<code>dynamic.css</code>' ) . '</p>';
        
        echo '<p>'. esc_html__( 'Input', 'coworking' ) . ':</p>';
        echo '<pre><code>body {
  {{demo_background}}
  background-color: {{demo_background|background-color}};
}</code></pre>';

        echo '<p>'. esc_html__( 'Output', 'coworking' ) . ':</p>';
        echo '<pre><code>/* BEGIN demo_background */
body {
  background: color image repeat attachment position;
  background-color: color;
}
/* END demo_background */</code></pre>';

        echo '<h4>'. esc_html__( 'Custom Post Type Checkbox', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'The Custom Post Type Select option type displays a list of IDs from any available WordPress post type or custom post type. It allows the user to check multiple post IDs for use in a custom function or loop. Requires at least one valid %1$s in the %1$s field.', 'coworking' ), '<code>post_type</code>' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Custom Post Type Select', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'The Custom Post Type Select option type displays a list of IDs from any available WordPress post type or custom post type. It will return a single post ID for use in a custom function or loop. Requires at least one valid %1$s in the %1$s field.', 'coworking' ), '<code>post_type</code>' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Date Picker', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Date Picker option type is tied to a standard form input field which displays a calendar pop-up that allow the user to pick any date when focus is given to the input field. The returned value is a date formatted string.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Date Time Picker', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Date Time Picker option type is tied to a standard form input field which displays a calendar pop-up that allow the user to pick any date and time when focus is given to the input field. The returned value is a date and time formatted string.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Dimension', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'The Dimension option type is used to set width and height values. The text inputs except numerical values and the select lets you choose the unit of measurement to add to that value. Currently the default units are %s, %s, %s, and %s. However, you can change them with the %s filter.', 'coworking' ), '<code>px</code>', '<code>%</code>', '<code>em</code>', '<code>pt</code>', '<code>ot_recognized_dimension_unit_types</code>' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Gallery', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Gallery option type saves a comma separated list of image attachment IDs. You will need to create a front-end function to display the images in your theme.', 'coworking' ) . '</p>';

        echo '<h4>'. esc_html__( 'Google Fonts', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'The Google Fonts option type will dynamically enqueue any number of Google Web Fonts into the document %1$s. As well, once the option has been saved each font family will automatically be inserted into the %2$s array for the Typography option type. You can further modify the font stack by using the %3$s filter, which is passed the %4$s, %5$s, and %6$s parameters. The %6$s parameter is being passed from %7$s, so it will be the ID of a Typography option type. This will allow you to add additional web safe fonts to individual font families on an as-need basis.', 'coworking' ), '<code>HEAD</code>', '<code>font-family</code>', '<code>ot_google_font_stack</code>', '<code>$font_stack</code>', '<code>$family</code>', '<code>$field_id</code>', '<code>ot_recognized_font_families</code>' ) . '</p>';

        echo '<h4>'. esc_html__( 'JavaScript', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'The JavaScript option type is a textarea that uses the %s code editor to highlight your JavaScript and display errors as you type.', 'coworking' ), '<code>ace.js</code>' ) . '</p>';

        echo '<h4>'. esc_html__( 'Link Color', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Link Color option type is used to set all link color states.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'List Item', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The List Item option type replaced the Slider option type and allows for a great deal of customization. You can add settings to the List Item and those settings will be displayed to the user when they add a new List Item. Typical use is for creating sliding content or blocks of code for custom layouts.', 'coworking' ) . '</p>';

        echo '<h4>'. esc_html__( 'Measurement', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'The Measurement option type is a mix of input and select fields. The text input excepts a value and the select lets you choose the unit of measurement to add to that value. Currently the default units are %s, %s, %s, and %s. However, you can change them with the %s filter.', 'coworking' ), '<code>px</code>', '<code>%</code>', '<code>em</code>', '<code>pt</code>', '<code>ot_measurement_unit_types</code>' ) . '</p>';
        
        echo '<p>' . sprintf( esc_html__( 'Example filter to add new units to the Measurement option type. Added to %s.', 'coworking' ), '<code>functions.php</code>' ) . '</p>';
        echo '<pre><code>function filter_measurement_unit_types( $array, $field_id ) {
  
  /* only run the filter on measurement with a field ID of my_measurement */
  if ( $field_id == \'my_measurement\' ) {
    $array[\'in\'] = \'inches\';
    $array[\'ft\'] = \'feet\';
  }
  
  return $array;
}
add_filter( \'ot_measurement_unit_types\', \'filter_measurement_unit_types\', 10, 2 );</code></pre>';

        echo '<p>' . esc_html__( 'Example filter to completely change the units in the Measurement option type. Added to <code>functions.php</code>.', 'coworking' ) . '</p>';
        echo '<pre><code>function filter_measurement_unit_types( $array, $field_id ) {
  
  /* only run the filter on measurement with a field ID of my_measurement */
  if ( $field_id == \'my_measurement\' ) {
    $array = array(
      \'in\' => \'inches\',
      \'ft\' => \'feet\'
    );
  }
  
  return $array;
}
add_filter( \'ot_measurement_unit_types\', \'filter_measurement_unit_types\', 10, 2 );</code></pre>';
        
        echo '<h4>'. esc_html__( 'Numeric Slider', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Numeric Slider option type displays a jQuery UI slider. It will return a single numerical value for use in a custom function or loop.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'On/Off', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'The On/Off option type displays a simple switch that can be used to turn things on or off. The saved return value is either %s or %s.', 'coworking' ), '<code>on</code>', '<code>off</code>' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Page Checkbox', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Page Checkbox option type displays a list of page IDs. It allows the user to check multiple page IDs for use in a custom function or loop.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Page Select', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Page Select option type displays a list of page IDs. It will return a single page ID for use in a custom function or loop.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Post Checkbox', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Post Checkbox option type displays a list of post IDs. It allows the user to check multiple post IDs for use in a custom function or loop.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Post Select', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Post Select option type displays a list of post IDs. It will return a single post ID for use in a custom function or loop.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Radio', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Radio option type displays a group of choices. It allows the user to choose one and will return that value as a string for use in a custom function or loop.', 'coworking' ) . '</p>';

        echo '<h4>'. esc_html__( 'Radio Image', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'the Radio Images option type is primarily used for layouts. However, you can filter the image list using %s. As well, you can add your own custom images using the choices array.', 'coworking' ), '<code>ot_radio_images</code>' ) . '</p>';

        echo '<p>' . esc_html__( 'This example executes the <code>ot_radio_images</code> filter on layout images attached to the <code>my_radio_images</code> field. Added to <code>functions.php</code>.', 'coworking' ) . '</p>';
        echo '<pre><code>function filter_radio_images( $array, $field_id ) {

  /* only run the filter where the field ID is my_radio_images */
  if ( $field_id == \'my_radio_images\' ) {
    $array = array(
      array(
        \'value\'   => \'left-sidebar\',
        \'label\'   => esc_html__( \'Left Sidebar\', \'coworking\' ),
        \'src\'     => OT_URL . \'/assets/images/layout/left-sidebar.png\'
      ),
      array(
        \'value\'   => \'right-sidebar\',
        \'label\'   => esc_html__( \'Right Sidebar\', \'coworking\' ),
        \'src\'     => OT_URL . \'/assets/images/layout/right-sidebar.png\'
      )
    );
  }
  
  return $array;

}
add_filter( \'ot_radio_images\', \'filter_radio_images\', 10, 2 );</code></pre>';

        echo '<h4>'. esc_html__( 'Select', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Select option type is used to list anything you want that would be chosen from a select list.', 'coworking' ) . '</p>';

        echo '<h4>'. esc_html__( 'Sidebar Select', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf(  esc_html__( 'This option type makes it possible for users to select a WordPress registered sidebar to use on a specific area. By using the two provided filters, %s, and %s we can be selective about which sidebars are available on a specific content area.', 'coworking' ), '<code>ot_recognized_sidebars</code>', '<code>ot_recognized_sidebars_{$field_id}</code>' ) . '</p>';
        echo '<p>' . sprintf( esc_html__( 'For example, if we create a WordPress theme that provides the ability to change the Blog Sidebar and we don\'t want to have the footer sidebars available on this area, we can unset those sidebars either manually or by using a regular expression if we have a common name like %s.', 'coworking' ), '<code>footer-sidebar-$i</code>' ) . '</p>';

        echo '<h4>'. esc_html__( 'Slider', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Slider option type is technically deprecated. Use the List Item option type instead, as it\'s infinitely more customizable. Typical use is for creating sliding image content.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Social Links', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'The Social Links option type utilizes a drag & drop interface to create a list of social links. There are a few filters that make extending this option type easy. You can set the %s filter to %s and turn off loading default values. Use the %s filter to change the default values that are loaded. To filter the settings array use the %s filter.', 'coworking' ), '<code>ot_type_social_links_load_defaults</code>', '<code>false</code>', '<code>ot_type_social_links_defaults</code>', '<code>ot_social_links_settings</code>' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Spacing', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'The Spacing option type is used to set spacing values such as padding or margin in the form of top, right, bottom, and left. The text inputs except numerical values and the select lets you choose the unit of measurement to add to that value. Currently the default units are %s, %s, %s, and %s. However, you can change them with the %s filter.', 'coworking' ), '<code>px</code>', '<code>%</code>', '<code>em</code>', '<code>pt</code>', '<code>ot_recognized_spacing_unit_types</code>' ) . '</p>';

        echo '<h4>'. esc_html__( 'Tab', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Tab option type will break a section or metabox into tabbed content.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Tag Checkbox', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Tag Checkbox option type displays a list of tag IDs. It allows the user to check multiple tag IDs and will return that value as an array for use in a custom function or loop.', 'coworking' ) . '</p>';

        echo '<h4>'. esc_html__( 'Tag Select', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Tag Select option type displays a list of tag IDs. It allows the user to select only one tag ID and will return that value for use in a custom function or loop.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Taxonomy Checkbox', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Taxonomy Checkbox option type displays a list of taxonomy IDs. It allows the user to check multiple taxonomy IDs and will return that value as an array for use in a custom function or loop.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Taxonomy Select', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Taxonomy Select option type displays a list of taxonomy IDs. It allows the user to select only one taxonomy ID and will return that value for use in a custom function or loop.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Text', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Text option type is used to save string values. For example, any optional or required text that is of reasonably short character length.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Textarea', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'The Textarea option type is a large string value used for custom code or text in the theme and has a WYSIWYG editor that can be filtered to change the how it is displayed. For example, you can filter %s, %s, %s, and %s.', 'coworking' ), '<code>wpautop</code>', '<code>media_buttons</code>', '<code>tinymce</code>', '<code>quicktags</code>' ) . '</p>';
        
        echo '<p class="aside">' . esc_html__( 'Example filters to alter the Textarea option type. Added to <code>functions.php</code>.', 'coworking' ) . '</p>';
        
        echo '<p>' . esc_html__( 'This example keeps WordPress from executing the <code>wpautop</code> filter on the line breaks. The default is <code>true</code> which means it wraps line breaks with an HTML <code>p</code> tag.', 'coworking' ) . '</p>';
        echo '<pre><code>function filter_textarea_wpautop( $content, $field_id ) {
  
  /* only run the filter on the textarea with a field ID of my_textarea */
  if ( $field_id == \'my_textarea\' ) {
    return false;
  }

  return $content;
  
}
add_filter( \'ot_wpautop\', \'filter_textarea_wpautop\', 10, 2 );</code></pre>';

        echo '<p>' . esc_html__( 'This example keeps WordPress from executing the <code>media_buttons</code> filter on the textarea WYSIWYG. The default is <code>true</code> which means show the buttons.', 'coworking' ) . '</p>';
        echo '<pre><code>function filter_textarea_media_buttons( $content, $field_id ) {

  /* only run the filter on the textarea with a field ID of my_textarea */
  if ( $field_id == \'my_textarea\' ) {
    return false;
  }
  
  return $content;
  
}
add_filter( \'ot_media_buttons\', \'filter_textarea_media_buttons\', 10, 2 );</code></pre>';
        
        echo '<p>' . esc_html__( 'This example keeps WordPress from executing the <code>tinymce</code> filter on the textarea WYSIWYG. The default is <code>true</code> which means show the tinymce.', 'coworking' ) . '</p>';
        echo '<pre><code>function filter_textarea_tinymce( $content, $field_id ) {
  
  /* only run the filter on the textarea with a field ID of my_textarea */
  if ( $field_id == \'my_textarea\' ) {
    return false;
  }
  
  return $content;
  
}
add_filter( \'ot_tinymce\', \'filter_textarea_tinymce\', 10, 2 );</code></pre>';

        echo '<p>' . esc_html__( 'This example alters the <code>quicktags</code> filter on the textarea WYSIWYG. The default is <code>array( \'buttons\' => \'strong,em,link,block,del,ins,img,ul,ol,li,code,spell,close\' )</code> which means show those quicktags. It also means you can filter in your own custom quicktags.', 'coworking' ) . '</p>';
        echo '<pre><code>function filter_textarea_quicktags( $content, $field_id ) {

  /* only run the filter on the textarea with a field ID of my_textarea */
  if ( $field_id == \'my_textarea\' ) {
    return array( \'buttons\' => \'strong,em,link,block,del,ins,img,ul,ol,li,code,more,spell,close,fullscreen\' );
  } else if ( $field_id == \'my_other_textarea\' ) {
    return false; /* show no quicktags */
  }
  
  return $content;
  
}
add_filter( \'ot_quicktags\', \'filter_textarea_quicktags\', 10, 1 );</code></pre>';

        echo '<h4>'. esc_html__( 'Textarea Simple', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Textarea Simple option type is a large string value used for custom code or text in the theme. The Textarea Simple does not have a WYSIWYG editor.', 'coworking' ) . '</p>';
        
        echo '<p class="aside">' . sprintf( esc_html__( 'This example tells WordPress to execute the %s filter on the line breaks. The default is %s which means it does not wraps line breaks with an HTML %s tag. Added to %s.', 'coworking' ), '<code>wpautop</code>', '<code>false</code>', '<code>p</code>', '<code>functions.php</code>' ) . '</p>';
        echo '<pre><code>function filter_textarea_simple_wpautop( $content, $field_id ) {
  
  /* only run the filter on the textarea with a field ID of my_textarea */
  if ( $field_id == \'my_textarea\' ) {
    return true;
  }
  
  return $content;
  
}
add_filter( \'ot_wpautop\', \'filter_textarea_simple_wpautop\', 10, 2 );</code></pre>';
        
        echo '<h4>'. esc_html__( 'Textblock', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Textblock option type is used only on the Theme Option page. It will allow you to create & display HTML, but has no title above the text block. You can then use the Textblock to add a more detailed set of instruction on how the options are used in your theme. You would never use this in your themes template files as it does not save a value.', 'coworking' ) . '</p>';

        echo '<h4>'. esc_html__( 'Textblock Titled', 'coworking' ) . ':</h4>';
        echo '<p>' . esc_html__( 'The Textblock Titled option type is used only on the Theme Option page. It will allow you to create & display HTML, and has a title above the text block. You can then use the Textblock Titled to add a more detailed set of instruction on how the options are used in your theme. You would never use this in your themes template files as it does not save a value.', 'coworking' ) . '</p>';
        
        echo '<h4>'. esc_html__( 'Typography', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'The Typography option type is for adding typography styles to your theme either dynamically via the CSS option type above or manually with %s. The Typography option type has filters that allow you to remove fields or change the defaults. For example, you can filter %s to remove unwanted fields from all Background options or an individual one. You can also filter %s. These filters allow you to fine tune the select lists for your specific needs.', 'coworking' ), '<code>ot_get_option()</code>', '<code>ot_recognized_typography_fields</code>', '<code>ot_recognized_font_families</code>, <code>ot_recognized_font_sizes</code>, <code>ot_recognized_font_styles</code>, <code>ot_recognized_font_variants</code>, <code>ot_recognized_font_weights</code>, <code>ot_recognized_letter_spacing</code>, <code>ot_recognized_line_heights</code>, <code>ot_recognized_text_decorations</code> ' . esc_html__( 'and', 'coworking' ) . ' <code>ot_recognized_text_transformations</code>' ) . '</p>';

        echo '<p class="aside">' . esc_html__( 'This example would filter <code>ot_recognized_font_families</code> to build your own font stack. Added to <code>functions.php</code>.', 'coworking' ) . '</p>';
        echo '<pre><code>function filter_ot_recognized_font_families( $array, $field_id ) {
  
  /* only run the filter when the field ID is my_google_fonts_headings */
  if ( $field_id == \'my_google_fonts_headings\' ) {
    $array = array(
      \'sans-serif\'    => \'sans-serif\',
      \'open-sans\'     => \'"Open Sans", sans-serif\',
      \'droid-sans\'    => \'"Droid Sans", sans-serif\'
    );
  }
  
  return $array;
  
}
add_filter( \'ot_recognized_font_families\', \'filter_ot_recognized_font_families\', 10, 2 );</code></pre>';

        echo '<h4>'. esc_html__( 'Upload', 'coworking' ) . ':</h4>';
        echo '<p>' . sprintf( esc_html__( 'The Upload option type is used to upload any WordPress supported media. After uploading, users are required to press the "%s" button in order to populate the input with the URI of that media. There is one caveat of this feature. If you import the theme options and have uploaded media on one site the old URI will not reflect the URI of your new site. You will have to re-upload or %s any media to your new server and change the URIs if necessary.', 'coworking' ), apply_filters( 'ot_upload_text', esc_html__( 'Send to OptionTree', 'coworking' ) ), 'FTP' ) . '</p>';
        
      echo '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * ot_get_option() option type.
 *
 * This is a callback function to display text about ot_get_option().
 *
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_ot_get_option' ) ) {
  
  function ot_type_ot_get_option() {
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-textblock wide-desc">';
      
      /* description */
      echo '<div class="description">';
        
        echo '<h4>'. esc_html__( 'Description', 'coworking' ) . ':</h4>';

        echo '<p>' . esc_html__( 'This function returns a value from the "option_tree" array of saved values or the default value supplied. The returned value would be mixed. Meaning it could be a string, integer, boolean, or array.', 'coworking' ) . '</p>';
        
        echo '<h4>' . esc_html__( 'Usage', 'coworking' ) . ':</h4>';
        
        echo '<p><code>&lt;?php ot_get_option( $option_id, $default ); ?&gt;</code></p>';
        
        echo '<h4>' . esc_html__( 'Parameters', 'coworking' ) . ':</h4>';
        
        echo '<code>$option_id</code>';
        
        echo '<p>(<em>' . esc_html__( 'string', 'coworking' ) . '</em>) (<em>' . esc_html__( 'required', 'coworking' ) . '</em>) ' . esc_html__( 'Enter the options unique identifier.', 'coworking' ) . '<br />' . esc_html__( 'Default:', 'coworking' ) . ' <em>' . esc_html__( 'None', 'coworking' ) . '</em></p>';
        
        echo '<code>$default</code>';
        
        echo '<p>(<em>' . esc_html__( 'string', 'coworking' ) . '</em>) (<em>' . esc_html__( 'optional', 'coworking' ) . '</em>) ' . esc_html__( 'Enter a default return value. This is just incase the request returns null.', 'coworking' ) . '<br />' . esc_html__( 'Default', 'coworking' ) . ': <em>' . esc_html__( 'None', 'coworking' ) . '</em></p>';
        
      echo '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * get_option_tree() option type.
 *
 * This is a callback function to display text about get_option_tree().
 *
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_get_option_tree' ) ) {
  
  function ot_type_get_option_tree() {
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-textblock wide-desc">';
      
      /* description */
      echo '<div class="description">';
        
        echo '<p class="deprecated">' . esc_html__( 'This function has been deprecated. That means it has been replaced by a new function or is no longer supported, and may be removed from future versions. All code that uses this function should be converted to use its replacement.', 'coworking' ) . '</p>';
        
        echo '<p>' . esc_html__( 'Use', 'coworking' ) . '<code>ot_get_option()</code>' . esc_html__( 'instead', 'coworking' ) . '.</p>';

        echo '<h4>'. esc_html__( 'Description', 'coworking' ) . ':</h4>';
        
        echo '<p>' . esc_html__( 'This function returns, or echos if asked, a value from the "option_tree" array of saved values.', 'coworking' ) . '</p>';

        echo '<h4>' . esc_html__( 'Usage', 'coworking' ) . ':</h4>';

        echo '<p><code>&lt;?php get_option_tree( $item_id, $options, $echo, $is_array, $offset ); ?&gt;</code></p>';
        
        echo '<h4>' . esc_html__( 'Parameters', 'coworking' ) . ':</h4>';
        
        echo '<code>$item_id</code>';
        
        echo '<p>(<em>' . esc_html__( 'string', 'coworking' ) . '</em>) (<em>' . esc_html__( 'required', 'coworking' ) . '</em>) ' . esc_html__( 'Enter a unique Option Key to get a returned value or array.', 'coworking' ) . '<br />' . esc_html__( 'Default:', 'coworking' ) . ' <em>' . esc_html__( 'None', 'coworking' ) . '</em></p>';
        
        echo '<code>$options</code>';
        
        echo '<p>(<em>' . esc_html__( 'array', 'coworking' ) . '</em>) (<em>' . esc_html__( 'optional', 'coworking' ) . '</em>) ' . esc_html__( 'Used to cut down on database queries in template files.', 'coworking' ) . '<br />' . esc_html__( 'Default', 'coworking' ) . ': <em>' . esc_html__( 'None', 'coworking' ) . '</em></p>';

        echo '<code>$echo</code>';
        
        echo '<p>(<em>' . esc_html__( 'boolean', 'coworking' ) . '</em>) (<em>' . esc_html__( 'optional', 'coworking' ) . '</em>) ' . esc_html__( 'Echo the output.', 'coworking' ) . '<br />' . esc_html__( 'Default', 'coworking' ) . ': FALSE</p>';

        echo '<code>$is_array</code>';
        
        echo '<p>(<em>' . esc_html__( 'boolean', 'coworking' ) . '</em>) (<em>' . esc_html__( 'optional', 'coworking' ) . '</em>) ' . esc_html__( 'Used to indicate the $item_id is an array of values.', 'coworking' ) . '<br />' . esc_html__( 'Default', 'coworking' ) . ': FALSE</p>';

        echo '<code>$offset</code>';
        
        echo '<p>(<em>' . esc_html__( 'integer', 'coworking' ) . '</em>) (<em>' . esc_html__( 'optional', 'coworking' ) . '</em>) ' . esc_html__( 'Numeric offset key for the $item_id array, -1 will return all values (an array starts at 0).', 'coworking' ) . '<br />' . esc_html__( 'Default', 'coworking' ) . ': -1</p>';
        
      echo '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * Examples option type.
 *
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_examples' ) ) {
  
  function ot_type_examples() {
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-textblock wide-desc">';
      
      /* description */
      echo '<div class="description">';
        
        echo '<p class="aside">' . esc_html__( 'If you\'re using the plugin version of OptionTree it is highly recommended to include a <code>function_exists</code> check in your code, as described in the examples below. If you\'ve integrated OptionTree directly into your themes root directory, you will <strong>not</strong> need to wrap your code with <code>function_exists</code>, as you\'re guaranteed to have the <code>ot_get_option()</code> function available.', 'coworking' ) . '</p>';
        
        echo '<h4>' . esc_html__( 'String Examples', 'coworking' ) . ':</h4>';

        echo '<p>' . esc_html__( 'Returns the value of <code>test_input</code>.', 'coworking' ) . '</p>';
        
        echo '<pre><code>if ( function_exists( \'ot_get_option\' ) ) {
  $test_input = ot_get_option( \'test_input\' );
}</code></pre>';

        echo '<p>' . esc_html__( 'Returns the value of <code>test_input</code>, but also has a default value if it returns empty.', 'coworking' ) . '</p>';
        
        echo '<pre><code>if ( function_exists( \'ot_get_option\' ) ) {
  $test_input = ot_get_option( \'test_input\', \'default input value goes here.\' );
}</code></pre>';
        
        echo '<h4>' . esc_html__( 'Array Examples', 'coworking' ) . ':</h4>';
        
        echo '<p>' . esc_html__( 'Assigns the value of <code>navigation_ids</code> to the variable <code>$ids</code>. It then echos an unordered list of links (navigation) using <code>wp_list_pages()</code>.', 'coworking' ) . '</p>';

        echo '<pre><code>if ( function_exists( \'ot_get_option\' ) ) {
  /* get an array of page id\'s */
  $ids = ot_get_option( \'navigation_ids\', array() );

  /* echo custom navigation using wp_list_pages() */
  if ( ! empty( $ids ) )
    echo \'&lt;ul&gt;\';
    wp_list_pages(
      array(
        \'include\'   => $ids,
        \'title_li\'  => \'\'
      )
    );
    echo \'&lt;/ul&gt;\';
  }
  
}</code></pre>';   
        
        echo '<p>' . esc_html__( 'The next two examples demonstrate how to use the <strong>Measurement</strong> option type. The Measurement option type is an array with two key/value pairs. The first is the value of measurement and the second is the unit of measurement.', 'coworking' ) . '</p>';

        echo '<pre><code>if ( function_exists( \'ot_get_option\' ) ) {
  /* get the array */
  $measurement = ot_get_option( \'measurement_option_type_id\' );
  
  /* only echo values if they actually exist, else echo some default value */
  if ( isset( measurement[0] ) && $measurement[1] ) {
    echo $measurement[0].$measurement[1];
  } else {
    echo \'10px\';
  }
  
}</code></pre>';

        echo '<pre><code>if ( function_exists( \'ot_get_option\' ) ) {
  /* get the array, and have a default just incase */
  $measurement = ot_get_option( \'measurement_option_type_id\', array( \'10\', \'px\' ) );
  
  /* implode array into a string value */
  if ( ! empty( measurement ) ) {
    echo implode( \'\', $measurement );
  }
  
}</code></pre>';    
          
        echo '<p>' . esc_html__( 'This example displays a very basic slider loop.', 'coworking' ) . '</p>';

        echo '<pre><code>if ( function_exists( \'ot_get_option\' ) ) {
  
  /* get the slider array */
  $slides = ot_get_option( \'my_slider\', array() );
  
  if ( ! empty( $slides ) ) {
    foreach( $slides as $slide ) {
      echo \'
      &lt;li&gt;
        &lt;a href="\' . $slide[\'link\'] . \'"&gt;&lt;img src="\' . $slide[\'image\'] . \'" alt="\' . $slide[\'title\'] . \'" /&gt;&lt;/a&gt;
        &lt;div class="description">\' . $slide[\'description\'] . \'&lt;/div&gt;
      &lt;/li&gt;\';
    }
  }
  
}</code></pre>';
        
      echo '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * Layouts Overview option type.
 *
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_layouts_overview' ) ) {
  
  function ot_type_layouts_overview() {
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-textblock wide-desc">';
      
      /* description */
      echo '<div class="description">';
        
        echo '<h4>'. esc_html__( 'It\'s Super Simple', 'coworking' ) . '</h4>';
        
        echo '<p>' . esc_html__( 'Layouts make your theme awesome! With theme options data that you can save/import/export you can package themes with different color variations, or make it easy to do A/B testing on text and so much more. Basically, you save a snapshot of your data as a layout.', 'coworking' ) . '</p>';
        
        echo '<p>' . esc_html__( 'Once you have created all your different layouts, or theme variations, you can save them to a separate text file for repackaging with your theme. Alternatively, you could just make different variations for yourself and change your theme with the click of a button, all without deleting your previous options data.', 'coworking' ) . '</p>';

        echo '<p class="aside">' . esc_html__( ' Adding a layout is ridiculously easy, follow these steps and you\'ll be on your way to having a WordPress super theme.', 'coworking' ) . '</p>';
        
        echo '<h4>' . esc_html__( 'For Developers', 'coworking' ) . ':</h4>';
        
        echo '<h5>' . esc_html__( 'Creating a Layout', 'coworking' ) . ':</h5>';
        echo '<ul class="docs-ul">';
          echo '<li>'. esc_html__( 'Go to the <code>OptionTre->Settings->Layouts</code> tab.', 'coworking' ) . '</li>';
          echo '<li>' . esc_html__( 'Enter a name for your layout in the text field and hit "Save Layouts", you\'ve created your first layout.', 'coworking' ) . '</li>';
          echo '<li>' . esc_html__( 'Adding a new layout is as easy as repeating the steps above.', 'coworking' ) . '</li>';
        echo '</ul>';
        
        echo '<h5>' . esc_html__( 'Activating a Layout', 'coworking' ) . ':</h5>';
        echo '<ul class="docs-ul">';
          echo '<li>'. esc_html__( 'Go to the <code>OptionTre->Settings->Layouts</code> tab.', 'coworking' ) . '</li>';
          echo '<li>' . esc_html__( 'Click on the activate layout button in the actions list.', 'coworking' ) . '</li>';
        echo '</ul>';
        
        echo '<h5>' . esc_html__( 'Deleting a Layout', 'coworking' ) . ':</h5>';
        echo '<ul class="docs-ul">';
          echo '<li>'. esc_html__( 'Go to the <code>OptionTre->Settings->Layouts</code> tab.', 'coworking' ) . '</li>';
          echo '<li>' . esc_html__( 'Click on the delete layout button in the actions list.', 'coworking' ) . '</li>';
        echo '</ul>';

        echo '<h5>' . esc_html__( 'Edit Layout Data', 'coworking' ) . ':</h5>';
        echo '<ul class="docs-ul">';
          echo '<li>'. esc_html__( 'Go to the <code>Appearance->Theme Options</code> page.', 'coworking' ) . '</li>';
          echo '<li>' . esc_html__( 'Modify and save your theme options and the layout will be updated automatically.', 'coworking' ) . '</li>';
          echo '<li>' . esc_html__( 'Saving theme options data will update the currently active layout, so before you start saving make sure you want to modify the current layout.', 'coworking' ) . '</li>';
          echo '<li>' . esc_html__( 'If you want to edit a new layout, first create it then save your theme options.', 'coworking' ) . '</li>';
        echo '</ul>';

        echo '<h4>' . esc_html__( 'End-Users Mode', 'coworking' ) . ':</h4>';

        echo '<h5>' . esc_html__( 'Creating a Layout', 'coworking' ) . ':</h5>';
        echo '<ul class="docs-ul">';
          echo '<li>'. esc_html__( 'Go to the <code>Appearance->Theme Options</code> page.', 'coworking' ) . '</li>';
          echo '<li>' . esc_html__( 'Enter a name for your layout in the text field and hit "New Layout", you\'ve created your first layout.', 'coworking' ) . '</li>';
          echo '<li>' . esc_html__( 'Adding a new layout is as easy as repeating the steps above.', 'coworking' ) . '</li>';
        echo '</ul>';
        
        echo '<h5>' . esc_html__( 'Activating a Layout', 'coworking' ) . ':</h5>';
        echo '<ul class="docs-ul">';
          echo '<li>'. esc_html__( 'Go to the <code>Appearance->Theme Options</code> page.', 'coworking' ) . '</li>';
          echo '<li>' . esc_html__( 'Choose a layout from the select list and click the "Activate Layout" button.', 'coworking' ) . '</li>';
        echo '</ul>';
        
        echo '<h5>' . esc_html__( 'Deleting a Layout', 'coworking' ) . ':</h5>';
        echo '<ul class="docs-ul">';
          echo '<li>'. esc_html__( 'End-Users mode does not allow deleting layouts.', 'coworking' ) . '</li>';
        echo '</ul>';
        
        echo '<h5>' . esc_html__( 'Edit Layout Data', 'coworking' ) . ':</h5>';
        echo '<ul class="docs-ul">';
          echo '<li>'. esc_html__( 'Go to the <code>Appearance->Theme Options</code> tab.', 'coworking' ) . '</li>';
          echo '<li>' . esc_html__( 'Modify and save your theme options and the layout will be updated automatically.', 'coworking' ) . '</li>';
          echo '<li>' . esc_html__( 'Saving theme options data will update the currently active layout, so before you start saving make sure you want to modify the current layout.', 'coworking' ) . '</li>';
        echo '</ul>';
        
      echo '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * Meta Boxes option type.
 *
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_meta_boxes' ) ) {
  
  function ot_type_meta_boxes() {
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-textblock wide-desc">';
      
      /* description */
      echo '<div class="description">';
        
        echo '<h4>'. esc_html__( 'How-to-guide', 'coworking' ) . '</h4>';
        
        echo '<p>' . esc_html__( 'There are a few simple steps you need to take in order to use OptionTree\'s built in Meta Box API. In the code below I\'ll show you a basic demo of how to create your very own custom meta box using any number of the option types you have at your disposal. If you would like to see some demo code, there is a directory named <code>theme-mode</code> inside the <code>assets</code> directory that contains a file named <code>demo-meta-boxes.php</code> you can reference.', 'coworking' ) . '</p>';

        echo '<p>' . esc_html__( 'It\'s important to note that Meta Boxes do not support WYSIWYG editors at this time and if you set one of your options to Textarea it will automatically revert to a Textarea Simple until a valid solution is found. WordPress released this statement regarding the wp_editor() function:', 'coworking' ) . '</p>';

        echo '<blockquote>' . esc_html__( 'Once instantiated, the WYSIWYG editor cannot be moved around in the DOM. What this means in practical terms, is that you cannot put it in meta-boxes that can be dragged and placed elsewhere on the page.', 'coworking' ) . '</blockquote>';
        
        echo '<h5>' . esc_html__( 'Create and include your custom meta boxes file.', 'coworking' ) . '</h5>';
        echo '<ul class="docs-ul">';
          echo '<li>'. esc_html__( 'Create a file and name it anything you want, maybe <code>meta-boxes.php</code>.', 'coworking' ) . '</li>';
          echo '<li>'. esc_html__( 'As well, you\'ll probably want to create a directory named <code>includes</code> to put your <code>meta-boxes.php</code> into which will help keep you file structure nice and tidy.', 'coworking' ) . '</li>';
          echo '<li>' . esc_html__( 'Add the following code to your <code>functions.php</code>.', 'coworking' ) . '</li>';
        echo '</ul>';
        
        echo '<pre><code>/**
 * Meta Boxes
 */
require( trailingslashit( get_template_directory() ) . \'includes/meta-boxes.php\' );
</code></pre>';
        
        echo '<ul class="docs-ul">';
          echo '<li>' . esc_html__( 'Add a variation of the following code to your <code>meta-boxes.php</code>. You\'ll obviously need to fill it in with all your custom array values. It\'s important to note here that we use the <code>admin_init</code> filter because if you were to call the <code>ot_register_meta_box</code> function before OptionTree was loaded the sky would fall on your head.', 'coworking' ) . '</li>';
        echo '</ul>';
        
        echo "<pre><code>/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', 'custom_meta_boxes' );

function custom_meta_boxes() {

  &#36;my_meta_box = array(
    'id'        => 'my_meta_box',
    'title'     => 'My Meta Box',
    'desc'      => '',
    'pages'     => array( 'post' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
      array(
        'id'          => 'background',
        'label'       => 'Background',
        'desc'        => '',
        'std'         => '',
        'type'        => 'background',
        'class'       => '',
        'choices'     => array()
      )
    )
  );
  
  ot_register_meta_box( &#36;my_meta_box );

}</code></pre>";  
        
      echo '</div>';
      
    echo '</div>';
    
  }
  
}

/**
 * Theme Mode option type.
 *
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_theme_mode' ) ) {
  
  function ot_type_theme_mode() {
  
    /* format setting outer wrapper */
    echo '<div class="format-setting type-textblock wide-desc">';
      
      /* description */
      echo '<div class="description">';
        
        echo '<h4>'. esc_html__( 'How-to-guide', 'coworking' ) . '</h4>';
        
        echo '<p>' . esc_html__( 'There are a few simple steps you need to take in order to use OptionTree as a theme included module. In the code below I\'ll show you a basic demo of how to include the entire plugin as a module, which will allow you to have the most up-to-date version of OptionTree without ever needing to hack the core of the plugin. If you would like to see some demo code, there is a directory named <code>theme-mode</code> inside the <code>assets</code> directory that contains a file named <code>demo-theme-options.php</code> you can reference.', 'coworking' ) . '</p>';

        echo '<h5>' . esc_html__( 'Step 1: Include the plugin & turn on theme mode.', 'coworking' ) . '</h5>';
        echo '<ul class="docs-ul">';
          echo '<li>' . sprintf( esc_html__( 'Download the latest version of %s and unarchive the %s directory.', 'coworking' ), '<a href="http://wordpress.org/extend/plugins/option-tree/" rel="nofollow" target="_blank">' . esc_html__( 'OptionTree', 'coworking' ) . '</a>', '<code>.zip</code>' ) . '</li>';
          echo '<li>' . sprintf( esc_html__( 'Put the %s directory in the root of your theme. For example, the server path would be %s.', 'coworking' ), '<code>option-tree</code>', '<code>/wp-content/themes/theme-name/option-tree/</code>' ) . '</li>';
          echo '<li>' . sprintf( esc_html__( 'Add the following code to the beginning of your %s.', 'coworking' ), '<code>functions.php</code>' ) . '</li>';
        echo '</ul>';
        
        echo '<pre><code>/**
 * Required: set \'ot_theme_mode\' filter to true.
 */
add_filter( \'ot_theme_mode\', \'__return_true\' );

/**
 * Required: include OptionTree.
 */
require( trailingslashit( get_template_directory() ) . \'option-tree/ot-loader.php\' );
</code></pre>';

        echo '<p>' . sprintf( esc_html__( 'For a list of all the OptionTree UI display filters refer to the %s file found in the %s directory of this plugin. This file is the starting point for developing themes with Theme Mode.', 'coworking' ), '<code>demo-functions.php</code>', '<code>/assets/theme-mode/</code>' ) . '</p>';
        
        echo '<p class="aside">' . esc_html__( 'You now have OptionTree built into your theme and anytime an update is available replace the old version with the new one.', 'coworking' ) . '</p>';

        echo '<h5>' . esc_html__( 'Step 2: Create Theme Options without using the UI Builder.', 'coworking' ) . '</h5>';
        echo '<ul class="docs-ul">';
          echo '<li>'. esc_html__( 'Create a file and name it anything you want, maybe <code>theme-options.php</code>, or use the built in file export to create it for you. Remember, you should always check the file for errors before including it in your theme.', 'coworking' ) . '</li>';
          echo '<li>'. esc_html__( 'As well, you\'ll probably want to create a directory named <code>includes</code> to put your <code>theme-options.php</code> into which will help keep you file structure nice and tidy.', 'coworking' ) . '</li>';
          echo '<li>' . esc_html__( 'Add the following code to your <code>functions.php</code>.', 'coworking' ) . '</li>';
        echo '</ul>';
        
        echo '<pre><code>/**
 * Theme Options
 */
require( trailingslashit( get_template_directory() ) . \'includes/theme-options.php\' );
</code></pre>';
        
        echo '<ul class="docs-ul">';
          echo '<li>' . esc_html__( 'Add a variation of the following code to your <code>theme-options.php</code>. You\'ll obviously need to fill it in with all your custom array values for contextual help (optional), sections (required), and settings (required).', 'coworking' ) . '</li>';
        echo '</ul>';

        echo '<p>' . esc_html__( 'The code below is a boilerplate to get your started. For a full list of the available option types click the "Option Types" tab above. Also a quick note, you don\'t need to put OptionTree in theme mode to manually create options but you will want to hide the docs and settings as each time you load the admin area the settings be written over with the code below if they\'ve changed in any way. However, this ensures your settings do not get tampered with by the end-user.', 'coworking' ) . '</p>';
        
        echo "<pre><code>/**
 * Initialize the options before anything else. 
 */
add_action( 'init', 'custom_theme_options', 1 );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {

  /* OptionTree is not loaded yet, or this is not an admin request */
  if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() )
    return false;

  /**
   * Get a copy of the saved settings array. 
   */
  &#36;saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  &#36;custom_settings = array(
    'contextual_help' => array(
      'content'       => array( 
        array(
          'id'        => 'general_help',
          'title'     => 'General',
          'content'   => '&lt;p&gt;Help content goes here!&lt;/p&gt;'
        )
      ),
      'sidebar'       => '&lt;p&gt;Sidebar content goes here!&lt;/p&gt;',
    ),
    'sections'        => array(
      array(
        'id'          => 'general',
        'title'       => 'General'
      )
    ),
    'settings'        => array(
      array(
        'id'          => 'my_checkbox',
        'label'       => 'Checkbox',
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'general',
        'class'       => '',
        'choices'     => array(
          array( 
            'value' => 'yes',
            'label' => 'Yes' 
          )
        )
      ),
      array(
        'id'          => 'my_layout',
        'label'       => 'Layout',
        'desc'        => 'Choose a layout for your theme',
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'general',
        'class'       => '',
        'choices'     => array(
          array(
            'value'   => 'left-sidebar',
            'label'   => 'Left Sidebar',
            'src'     => OT_URL . '/assets/images/layout/left-sidebar.png'
          ),
          array(
            'value'   => 'right-sidebar',
            'label'   => 'Right Sidebar',
            'src'     => OT_URL . '/assets/images/layout/right-sidebar.png'
          ),
          array(
            'value'   => 'full-width',
            'label'   => 'Full Width (no sidebar)',
            'src'     => OT_URL . '/assets/images/layout/full-width.png'
          ),
          array(
            'value'   => 'dual-sidebar',
            'label'   => esc_html__( 'Dual Sidebar', 'coworking' ),
            'src'     => OT_URL . '/assets/images/layout/dual-sidebar.png'
          ),
          array(
            'value'   => 'left-dual-sidebar',
            'label'   => esc_html__( 'Left Dual Sidebar', 'coworking' ),
            'src'     => OT_URL . '/assets/images/layout/left-dual-sidebar.png'
          ),
          array(
            'value'   => 'right-dual-sidebar',
            'label'   => esc_html__( 'Right Dual Sidebar', 'coworking' ),
            'src'     => OT_URL . '/assets/images/layout/right-dual-sidebar.png'
          )
        )
      ),
      array(
        'id'          => 'my_slider',
        'label'       => 'Images',
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'general',
        'class'       => '',
        'choices'     => array(),
        'settings'    => array(
          array(
            'id'      => 'slider_image',
            'label'   => 'Image',
            'desc'    => '',
            'std'     => '',
            'type'    => 'upload',
            'class'   => '',
            'choices' => array()
          ),
          array(
            'id'      => 'slider_link',
            'label'   => 'Link to Post',
            'desc'    => 'Enter the posts url.',
            'std'     => '',
            'type'    => 'text',
            'class'   => '',
            'choices' => array()
          ),
          array(
            'id'      => 'slider_description',
            'label'   => 'Description',
            'desc'    => 'This text is used to add fancy captions in the slider.',
            'std'     => '',
            'type'    => 'textarea',
            'class'   => '',
            'choices' => array()
          )
        )
      )
    )
  );
  
  /* settings are not the same update the DB */
  if ( &#36;saved_settings !== &#36;custom_settings ) {
    update_option( 'option_tree_settings', &#36;custom_settings ); 
  }
  
  /* Lets OptionTree know the UI Builder is being overridden */
  global &#36;ot_has_custom_theme_options;
  &#36;ot_has_custom_theme_options = true;
  
}
</code></pre>";
        
      echo '</div>';
      
    echo '</div>';
  
  }
  
}

/* End of file ot-functions-docs-page.php */
/* Location: ./includes/ot-functions-docs-page.php */