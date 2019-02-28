<?php get_header();
$sDateFormat = get_option( 'date_format' );
$sTimeFormat = get_option( 'time_format' );
// with sidebar
if ( ot_get_option( 'uni_single_event_with_sidebar' ) == 'on' ) {
?>
	<section class="uni-container">
        <?php if (have_posts()) : while (have_posts()) : the_post();
        $aCustomData = get_post_custom( $post->ID );
        ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('singlePageContentV2') ?>>
			<div class="wrapper uni-clear">

				<div class="contentLeft">
					<div class="singleMeta">
						<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>,
                        <?php
                        $aTags = wp_get_post_terms( $post->ID, 'event_category' );
                        if ( $aTags && !is_wp_error( $aTags ) ) :
                        $s = count($aTags);
                        $i = 1;
                        foreach ( $aTags as $oTerm ) {
                            echo '<a href="'.esc_url( get_term_link( $oTerm->slug, 'event_category' ) ).'" class="postItemCategory">'.esc_html( $oTerm->name ).'</a>';
                            if ($i < $s) echo ', ';
                            $i++;
                        }
                        endif;
                        ?>
						<?php the_title( '<h1>', '</h1>' ); ?>
					</div>
					<div class="singlePostWrap uni-clear">

					<div class="singleEventDetails clear">
						<div class="fcell">
							<div class="eventDetailItem">
								<i class="fa fa-calendar"></i>
                                <?php if ( !empty($aCustomData['event_date_time'][0]) && !empty($aCustomData['event_end_date_time'][0]) ) { ?>
								<p>
                                    <?php
                                        $iDateStartTimestamp = strtotime($aCustomData['event_date_time'][0]);
                                        $iDateEndTimestamp = strtotime($aCustomData['event_end_date_time'][0]);
                                        echo sprintf( esc_html__('Starts %s', 'coworking'), date_i18n($sDateFormat, $iDateStartTimestamp));
                                        echo '<br>';
                                        echo sprintf( esc_html__('Ends %s', 'coworking'), date_i18n($sDateFormat, $iDateEndTimestamp));
                                    ?>
                                </p>
                                <?php } else if ( !empty($aCustomData['event_date_time'][0]) && empty($aCustomData['event_end_date_time'][0]) )  { ?>
								<p>
                                    <?php
                                        $iDateStartTimestamp = strtotime($aCustomData['event_date_time'][0]);
                                        echo date_i18n($sDateFormat, $iDateStartTimestamp);
                                    ?>
                                </p>
                                <?php } else { esc_html_e('- not specified -', 'coworking'); } ?>
							</div>
							<div class="eventDetailItem">
								<i class="fa fa-clock-o"></i>
								<p><?php if ( !empty($aCustomData['event_date_time'][0]) ) { echo date($sTimeFormat, strtotime($aCustomData['event_date_time'][0])) . ( (!empty($aCustomData['event_end_date_time'][0])) ? ' - '.date($sTimeFormat, strtotime($aCustomData['event_end_date_time'][0])) : '' ); } else { esc_html_e('- not specified -', 'coworking'); } ?></p>
							</div>
							<div class="eventDetailItem">
								<i class="fa fa-map-marker"></i>
								<p><?php if ( !empty($aCustomData['event_location'][0]) ) { echo esc_html( $aCustomData['event_location'][0] ); } else { esc_html_e('- not specified -', 'coworking'); } ?></p>
							</div>
						</div>
						<div class="scell">
							<!-- Map -->
							<script type="text/javascript">
							      var Coworking = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}];
							      function initialize() {

							        // Declare new style
							        var CoworkingstyledMap = new google.maps.StyledMapType(Coworking, {name: "Coworking"});

							        // Declare Map options
							        var mapOptions = {
							        	center: new google.maps.LatLng(<?php if ( !empty($aCustomData['uni_event_coord'][0]) ) { echo esc_attr( $aCustomData['uni_event_coord'][0] ); } else { echo '40.777504,-73.9549428'; } ?>),
							        	zoom: <?php if ( !empty($aCustomData['uni_event_zoom'][0]) ) { echo esc_attr( $aCustomData['uni_event_zoom'][0] ); } else { echo '12'; } ?>,
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

                                    var marker_icon = {
									    path: 'M22,13c-7.17,0-13,5.786-13,12.898c0,1.297,0.196,2.548,0.556,3.728 c1.491,7.028,10.575,17.654,11.826,19.095C21.538,48.9,21.765,49,22,49c0.029,0,0.057,0,0.085-0.004 c0.22-0.023,0.418-0.132,0.552-0.3l0.05-0.061c2.78-3.269,10.404-12.674,11.76-19.023C34.81,28.438,35,27.19,35,25.898 C35,18.786,29.165,13,22,13 M22,31.098c-2.912,0-5.282-2.332-5.282-5.201c0-0.967,0.272-1.878,0.748-2.659 c0.472-0.784,1.15-1.436,1.963-1.88c0.76-0.419,1.641-0.659,2.571-0.659c0.939,0,1.823,0.244,2.589,0.672 c0.807,0.444,1.481,1.095,1.953,1.879c0.472,0.776,0.74,1.684,0.74,2.647C27.282,28.767,24.913,31.098,22,31.098',
									    fillColor: '<?php if ( !empty($aCustomData['uni_event_marker_color'][0]) ) { echo esc_attr( $aCustomData['uni_event_marker_color'][0] ); } else { echo '#ffffff'; } ?>',
									    fillOpacity: 1,
									    scale: 1,
									    anchor: new google.maps.Point(22,49),
									    strokeWeight: 0
									};

						            var myLatLng = new google.maps.LatLng(<?php if ( !empty($aCustomData['uni_event_coord'][0]) ) { echo esc_attr( $aCustomData['uni_event_coord'][0] ); } else { echo '40.777504,-73.9549428'; } ?>);
						            var beachMarker = new google.maps.Marker({
						                position: myLatLng,
						                map: map,
						                icon: marker_icon
						            });

							      }
							      google.maps.event.addDomListener(window, 'load', initialize);
							</script>

							<div class="uni-location-map">
								<div class="uni-map-canvas" id="map-canvas"></div>
							</div>
						</div>
					</div>

					<?php

                        the_content();

            			wp_link_pages( array(
            				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'coworking' ) . '</span>',
            				'after'       => '</div>',
            				'link_before' => '<span>',
            				'link_after'  => '</span>',
            				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'coworking' ) . ' </span>%',
            				'separator'   => '<span class="screen-reader-text">, </span>',
            			) );

                    ?>
					</div>

                    <?php include( locate_template('includes/social-links.php') ); ?>

                    <?php
        			if ( comments_open() || get_comments_number() ) {
        				comments_template();
        			}
                    ?>

                    <?php if ( !ot_get_option( 'uni_display_similar_events' ) || ot_get_option( 'uni_display_similar_events' ) != 'off' ) { ?>
                    <?php uni_coworking_theme_similar_cpt_by_tax_alt( 'event_category', 3, 'tc_events', esc_html__('Related Events', 'coworking') ); ?>
                    <?php } ?>

				</div>

                <?php get_sidebar() ?>

			</div>
		</div>
        <?php endwhile; endif; ?>
	</section>
<?php
// without sidebar
} else {
?>
	<section class="uni-container">

        <?php if (have_posts()) : while (have_posts()) : the_post();
        $aCustomData = get_post_custom( $post->ID );
        ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('singlePageContent') ?>>

			<div class="wrapper">
				<div class="singleMeta">
					<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
					<?php the_title( '<h1>', '</h1>' ); ?>
				</div>
				<div class="singlePostWrap">

					<div class="singleEventDetails clear">
						<div class="fcell">
							<div class="eventDetailItem">
								<i class="fa fa-calendar"></i>
                                <?php if ( !empty($aCustomData['event_date_time'][0]) && !empty($aCustomData['event_end_date_time'][0]) ) { ?>
								<p>
                                    <?php
                                        $iDateStartTimestamp = strtotime($aCustomData['event_date_time'][0]);
                                        $iDateEndTimestamp = strtotime($aCustomData['event_end_date_time'][0]);
                                        echo sprintf( esc_html__('Starts %s', 'coworking'), date_i18n($sDateFormat, $iDateStartTimestamp));
                                        echo '<br>';
                                        echo sprintf( esc_html__('Ends %s', 'coworking'), date_i18n($sDateFormat, $iDateEndTimestamp));
                                    ?>
                                </p>
                                <?php } else if ( !empty($aCustomData['event_date_time'][0]) && empty($aCustomData['event_end_date_time'][0]) )  { ?>
								<p>
                                    <?php
                                        $iDateStartTimestamp = strtotime($aCustomData['event_date_time'][0]);
                                        echo date_i18n($sDateFormat, $iDateStartTimestamp);
                                    ?>
                                </p>
                                <?php } else { esc_html_e('- not specified -', 'coworking'); } ?>
							</div>
							<div class="eventDetailItem">
								<i class="fa fa-clock-o"></i>
								<p><?php if ( !empty($aCustomData['event_date_time'][0]) ) { echo date($sTimeFormat, strtotime($aCustomData['event_date_time'][0])) . ( (!empty($aCustomData['event_end_date_time'][0])) ? ' - '.date($sTimeFormat, strtotime($aCustomData['event_end_date_time'][0])) : '' ); } else { esc_html_e('- not specified -', 'coworking'); } ?></p>
							</div>
							<div class="eventDetailItem">
								<i class="fa fa-map-marker"></i>
								<p><?php if ( !empty($aCustomData['event_location'][0]) ) { echo esc_html( $aCustomData['event_location'][0] ); } else { esc_html_e('- not specified -', 'coworking'); } ?></p>
							</div>
						</div>
						<div class="scell">
							<!-- Map -->
							<script type="text/javascript">
							    //
							      var Coworking = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}];
							      function initialize() {

							        // Declare new style
							        var CoworkingstyledMap = new google.maps.StyledMapType(Coworking, {name: "Coworking"});

							        // Declare Map options
							        var mapOptions = {
							        	center: new google.maps.LatLng(<?php if ( !empty($aCustomData['uni_event_coord'][0]) ) { echo esc_attr( $aCustomData['uni_event_coord'][0] ); } else { echo '40.777504,-73.9549428'; } ?>),
							        	zoom: <?php if ( !empty($aCustomData['uni_event_zoom'][0]) ) { echo esc_attr( $aCustomData['uni_event_zoom'][0] ); } else { echo '12'; } ?>,
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

                                    var marker_icon = {
									    path: 'M22,13c-7.17,0-13,5.786-13,12.898c0,1.297,0.196,2.548,0.556,3.728 c1.491,7.028,10.575,17.654,11.826,19.095C21.538,48.9,21.765,49,22,49c0.029,0,0.057,0,0.085-0.004 c0.22-0.023,0.418-0.132,0.552-0.3l0.05-0.061c2.78-3.269,10.404-12.674,11.76-19.023C34.81,28.438,35,27.19,35,25.898 C35,18.786,29.165,13,22,13 M22,31.098c-2.912,0-5.282-2.332-5.282-5.201c0-0.967,0.272-1.878,0.748-2.659 c0.472-0.784,1.15-1.436,1.963-1.88c0.76-0.419,1.641-0.659,2.571-0.659c0.939,0,1.823,0.244,2.589,0.672 c0.807,0.444,1.481,1.095,1.953,1.879c0.472,0.776,0.74,1.684,0.74,2.647C27.282,28.767,24.913,31.098,22,31.098',
									    fillColor: '<?php if ( !empty($aCustomData['uni_event_marker_color'][0]) ) { echo esc_attr( $aCustomData['uni_event_marker_color'][0] ); } else { echo '#ffffff'; } ?>',
									    fillOpacity: 1,
									    scale: 1,
									    anchor: new google.maps.Point(22,49),
									    strokeWeight: 0
									};

						            var myLatLng = new google.maps.LatLng(<?php if ( !empty($aCustomData['uni_event_coord'][0]) ) { echo esc_attr( $aCustomData['uni_event_coord'][0] ); } else { echo '40.777504,-73.9549428'; } ?>);
						            var beachMarker = new google.maps.Marker({
						                position: myLatLng,
						                map: map,
						                icon: marker_icon
						            });

							      }
							      google.maps.event.addDomListener(window, 'load', initialize);
							</script>

							<div class="uni-location-map">
								<div class="uni-map-canvas" id="map-canvas"></div>
							</div>
						</div>
					</div>

					<?php

                        the_content();

            			wp_link_pages( array(
            				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'coworking' ) . '</span>',
            				'after'       => '</div>',
            				'link_before' => '<span>',
            				'link_after'  => '</span>',
            				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'coworking' ) . ' </span>%',
            				'separator'   => '<span class="screen-reader-text">, </span>',
            			) );

                    ?>

				</div>

				<div class="tagsBox">
			        <span><?php esc_html_e('Categories', 'coworking') ?>:</span>
                    <?php
                    $aTags = wp_get_post_terms( $post->ID, 'event_category' );
                    if ( $aTags && !is_wp_error( $aTags ) ) :
                    $s = count($aTags);
                    $i = 1;
            	    foreach ( $aTags as $oTerm ) {
            	        echo '<a href="'.esc_url( get_term_link( $oTerm->slug, 'event_category' ) ).'">'.esc_html( $oTerm->name ).'</a>';
                        if ($i < $s) echo ', ';
                        $i++;
            	    }
                    endif;
                    ?>
				</div>

                <?php include( locate_template('includes/social-links.php') ); ?>

                <?php
    			if ( comments_open() || get_comments_number() ) {
    				comments_template();
    			}
                ?>

			</div>

            <?php if ( !ot_get_option( 'uni_display_similar_events' ) || ot_get_option( 'uni_display_similar_events' ) != 'off' ) { ?>
            <?php uni_coworking_theme_similar_cpt_by_tax( 'event_category', 3, 'tc_events', esc_html__('Related Events', 'coworking') ); ?>
            <?php } ?>

		</div>
        <?php endwhile; endif; ?>

	</section>
<?php
}
?>

<?php get_footer(); ?>