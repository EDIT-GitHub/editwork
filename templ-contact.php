<?php
/*
*  Template Name: Contact Page
*/
get_header();
$aUniAllowedHtmlWoA = uni_coworking_theme_allowed_html_wo_a();
$aUniAllowedHtmlWithA = uni_coworking_theme_allowed_html_with_a();
?>

    <?php if (have_posts()) : while (have_posts()) : the_post();
        $aPostCustom = get_post_custom( $post->ID );
    ?>

<section class="uni-container">

        <?php if ( isset($aPostCustom['uni_contact_map_enable'][0]) && $aPostCustom['uni_contact_map_enable'][0] === 'on' ) { ?>
        <div id="js-uni-templ-contact-wrap" class="homeContact uni-contact-page-map-wrap uni-clear">

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
                    <?php if ( isset($aPostCustom['uni_contact_map_styles'][0]) ) { ?>
                        Coworking = <?php echo $aPostCustom['uni_contact_map_styles'][0] ?>;
                    <?php } else { ?>
                        Coworking = coworkingShadesOfGrey;
                    <?php } ?>

                      function initialize() {

                        // Declare new style
                        var CoworkingstyledMap = new google.maps.StyledMapType(Coworking, {name: "Coworking"});

                        // Declare Map options
                        var mapOptions = {
                            center: new google.maps.LatLng(<?php $sCoord = ( isset($aPostCustom['uni_contact_map_coordinates'][0]) ) ? $aPostCustom['uni_contact_map_coordinates'][0] : '41.404182,2.199451'; echo esc_attr( $sCoord ); ?>),
                            zoom: <?php echo ( isset($aPostCustom['uni_contact_map_zoom'][0]) ) ? esc_attr($aPostCustom['uni_contact_map_zoom'][0]) : '14'; ?>,
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
                            fillColor: '<?php echo ( isset($aPostCustom['uni_contact_marker_colour'][0]) ) ? esc_attr($aPostCustom['uni_contact_marker_colour'][0]) : '#ffffff'; ?>',
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
                    <h3><?php echo ( isset($aPostCustom['uni_contact_title'][0]) ) ? esc_attr($aPostCustom['uni_contact_title'][0]) : esc_html_e('Come & visit', 'coworking'); ?></h3>
                    <p class="uni-contact-info-text"><?php echo ( isset($aPostCustom['uni_contact_subtitle'][0]) ) ? esc_attr($aPostCustom['uni_contact_subtitle'][0]) : ''; ?></p>

                    <?php if ( isset($aPostCustom['uni_contact_address'][0]) ) { ?>
                    <div class="uni-contact-info-item">
                        <i class="uni-icon-location"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="33" viewBox="0 0 25 33"><path fill="#FFF" d="M12.5 16.59c-2.8 0-5.08-2.14-5.08-4.767S9.7 7.056 12.5 7.056s5.08 2.138 5.08 4.767-2.28 4.766-5.08 4.766zm0-8.066c-1.938 0-3.516 1.48-3.516 3.3 0 1.82 1.577 3.3 3.516 3.3s3.516-1.48 3.516-3.3c0-1.82-1.578-3.3-3.516-3.3zM12.5 0C5.605 0 0 5.305 0 11.824c0 1.188.188 2.335.536 3.417 1.433 6.442 10.168 16.184 11.372 17.504.148.165.366.256.592.256.026 0 .055 0 .082-.004.212-.022.402-.12.53-.274l.048-.055c2.67-2.996 10.005-11.62 11.31-17.437.347-1.078.53-2.223.53-3.406C25 5.304 19.392 0 12.5 0m-.004 31.127c-2.473-2.78-5.33-6.42-7.458-9.827-1.527-2.45-2.685-4.783-3.042-6.59-.28-.917-.435-1.885-.435-2.886 0-.437.028-.866.087-1.287C2.322 5.43 6.93 1.465 12.5 1.465c5.576 0 10.193 3.97 10.857 9.085.056.415.082.84.082 1.272 0 .95-.138 1.87-.392 2.742-.31 1.774-1.43 4.12-3.056 6.714-1.956 3.118-4.636 6.593-7.496 9.85"/></svg></i>
                        <p><?php echo wp_kses( $aPostCustom['uni_contact_address'][0], $aUniAllowedHtmlWithA ); ?></p>
                    </div>
                    <?php } ?>

                    <?php if ( isset($aPostCustom['uni_contact_phone'][0]) ) {
                    $sContactPhone = $aPostCustom['uni_contact_phone'][0];
                    ?>
                    <div class="uni-contact-info-item">
                        <i class="uni-icon-phone"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"><path fill="#FFF" d="M.03 6.342c.036.24.07.45.14.69-.036-.24-.07-.45-.14-.69zM28.66 21c-.274-.276-1.24-1.172-1.756-1.448-1.103-.518-2.24-.828-3.273-.828-1.104 0-2.135.414-2.93 1.174l-.86.86c-.104.105-.173.173-.24.277-2.275-1.104-4.377-2.587-6.202-4.415-1.826-1.828-3.308-3.897-4.41-6.208.104-.07.207-.172.275-.242l.86-.862c.76-.758 1.173-1.793 1.173-2.93 0-1.036-.31-2.173-.828-3.277-.24-.516-1.17-1.482-1.446-1.758C7.3-.382 4.612-.45 2.992 1.17L1.168 2.998l-.172.173c-.758.863-1.103 2-.965 3.14.035.24.07.448.138.69v.034c1.137 5.482 3.79 10.69 7.958 14.863 4.203 4.21 9.37 6.863 14.883 7.968h.034c.207.034.378.07.585.104 1.136.136 2.307-.174 3.202-.968.07-.033.104-.104.174-.172l1.826-1.828c1.62-1.554 1.55-4.277-.174-6.002zm-2.618 6.896c-.585.586-1.412.828-2.204.725-.14 0-.276-.033-.414-.067-1.205-.242-2.376-.553-3.514-.932-3.962-1.345-7.683-3.552-10.783-6.69-3.1-3.138-5.374-6.828-6.684-10.793C2.064 9 1.753 7.86 1.513 6.722v-.035c-.07-.172-.104-.38-.104-.553-.07-.792.172-1.585.758-2.137L3.992 2.17c1.068-1.07 2.93-1 4.1.172.48.482 1.067 1.172 1.17 1.38.447.93.69 1.86.69 2.688 0 .725-.277 1.414-.76 1.932l-.86.863c-.172.17-.345.275-.516.414 0 0-.035 0-.035.034-.275.172-.378.552-.24.862l.31.62c1.172 2.414 2.722 4.588 4.617 6.484s4.1 3.482 6.476 4.62l.62.313c.346.137.725.033.897-.277.104-.172.24-.38.413-.518l.86-.86c.518-.518 1.173-.76 1.93-.76.827 0 1.79.242 2.688.69.208.104.897.69 1.38 1.17 1.17 1.174 1.274 3.002.17 4.105l-1.86 1.793z"/></svg></i>
                        <p><?php echo wp_kses( $sContactPhone, $aUniAllowedHtmlWithA ); ?></p>
                    </div>
                    <?php } ?>

                    <?php if ( isset($aPostCustom['uni_contact_email'][0]) ) {
                    if ( ! empty($aPostCustom['uni_contact_email'][0]) ) {
                        $sEmail = sanitize_email( $aPostCustom['uni_contact_email'][0] );
                    } else {
                        $sEmail = esc_attr( get_bloginfo('admin_email') );
                    }
                    ?>
                    <div class="uni-contact-info-item">
                        <i class="uni-icon-email"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="23" viewBox="0 0 34 23"><path fill="#FFF" d="M33.88 1.57c-.163-.458-.486-.88-.933-1.148C32.54.152 32.097 0 31.57 0H2.43c-.527 0-1.012.152-1.376.422-.406.268-.77.69-.93 1.15C.04 1.8 0 2.03 0 2.3V20.7C0 21.965 1.092 23 2.43 23h29.14c1.337 0 2.43-1.035 2.43-2.3V2.3c0-.27-.04-.498-.12-.73zm-2.55-.037L17 11.806 2.672 1.533H31.33zM32.38 20.7c0 .422-.364.767-.81.767H2.43c-.446 0-.81-.345-.81-.767V2.684l14.894 10.694c.162.115.324.153.486.153.16 0 .324-.037.486-.152L32.38 2.684V20.7z"/></svg></i>
                        <p><a href="mailto:<?php echo antispambot( $sEmail ); ?>"><?php echo antispambot( $sEmail ); ?></a></p>
                    </div>
                    <?php } ?>
                </div>
            </div>

        </div>
        <?php } ?>

        <?php if ( isset($aPostCustom['uni_contact_form_enable'][0]) && $aPostCustom['uni_contact_form_enable'][0] === 'on' ) { ?>
        <div class="uni-contact-form-wrap">
            <i class="subscribeIcon">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="26" viewBox="0 0 36 26">
                    <path fill="#2ebd7f" d="M35.918 2.52c-.205-.895-.816-1.667-1.596-2.114C33.832.162 33.3 0 32.73 0H3.272C2.7 0 2.17.162 1.678.406.86.853.288 1.626.082 2.52.042 2.76 0 3.005 0 3.25v19.5C0 24.537 1.473 26 3.272 26h29.455c1.8 0 3.272-1.463 3.272-3.25V3.25c0-.244-.042-.488-.082-.73zm-5.893.73L18 12.31 5.973 3.25h24.052zm2.704 19.5H3.272V5.322l13.746 10.36c.285.203.653.324.98.324s.695-.12.98-.324l13.75-10.36V22.75z"/>
                </svg>
            </i>
            <h3><?php echo ( isset($aPostCustom['uni_contact_form_title'][0]) ) ? esc_attr($aPostCustom['uni_contact_form_title'][0]) : esc_html_e('Drop us a note', 'coworking'); ?></h3>
            <p><?php echo ( isset($aPostCustom['uni_contact_form_subtitle'][0]) ) ? esc_attr($aPostCustom['uni_contact_form_subtitle'][0]) : ''; ?></p>
            <?php if( in_array('contact-form-7/wp-contact-form-7.php', get_option('active_plugins')) &&
                isset($aPostCustom['uni_contact_page_form_seven_id'][0]) && ! empty($aPostCustom['uni_contact_page_form_seven_id'][0]) ) { ?>
                <?php
                    if ( ! empty($aPostCustom['uni_contact_page_form_seven_id'][0]) ) {
                        $sCf7Id = intval( $aPostCustom['uni_contact_page_form_seven_id'][0] );
                    } else {
                        $sCf7Id = 0;
                    }
                ?>
                <?php echo do_shortcode('[contact-form-7 id="'.$sCf7Id.'"]'); ?>
            <?php } else { ?>
            <form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" method="post" class="uni-clear uni_form">
                <input type="hidden" name="uni_contact_nonce" value="<?php echo wp_create_nonce('uni_nonce') ?>" />
                <input type="hidden" name="page_id" value="<?php echo get_the_ID() ?>" />
                <input type="hidden" name="action" value="uni_coworking_theme_contact_form" />

                    <div class="inputWrap">
                    	<input type="text" name="uni_contact_fname" value="" placeholder="<?php esc_html_e('First Name', 'coworking') ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit">
                    </div>
                    <div class="inputWrap">
                    	<input type="text" name="uni_contact_lname" value="" placeholder="<?php esc_html_e('Last Name', 'coworking') ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit">
                    </div>
                    <div class="inputWrap">
                        <input type="text" name="uni_contact_email" value="" placeholder="<?php esc_html_e('Your Email', 'coworking') ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit" data-parsley-type="email">
                    </div>
                    <div class="inputWrap">
                        <input type="text" name="uni_contact_phone" value="" placeholder="<?php esc_html_e('Phone Number', 'coworking') ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit" data-parsley-type="integer">
                    </div>
                    <div class="uni-clear"></div>
                    <div class="textareaWrap">
                        <textarea name="uni_contact_msg" cols="30" rows="10" placeholder="<?php esc_html_e('Your message', 'coworking') ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit"></textarea>
                    </div>
                    <input id="uniSendContactForm" class="thmSubmitBtn uni_input_submit" type="button" value="<?php esc_html_e('Send', 'coworking') ?>">
                </form>
            <?php } ?>
        </div>
        <?php } ?>

</section>

    <?php
        endwhile; endif;
        wp_reset_postdata();
    ?>

<?php get_footer(); ?>