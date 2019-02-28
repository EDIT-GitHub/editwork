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
						<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
						<?php the_title( '<h1>', '</h1>' ); ?>
					</div>
					<div class="singlePostWrap uni-clear">

						<div class="singleEventDetails uni-clear">
							<div class="fcell">
								<div class="eventDetailItem">
									<i class="fa fa-calendar"></i>
									<?php if ( !empty($aCustomData['uni_event_date_start'][0]) && !empty($aCustomData['uni_event_date_end'][0])
									&& $aCustomData['uni_event_date_start'][0] == $aCustomData['uni_event_date_end'][0] ) { ?>
									<p>
										<?php
										$iDateStartTimestamp = strtotime($aCustomData['uni_event_date_start'][0]);
										echo date_i18n($sDateFormat, $iDateStartTimestamp);
										?>
									</p>
									<?php } else if ( !empty($aCustomData['uni_event_date_start'][0]) && !empty($aCustomData['uni_event_date_end'][0])
									&& $aCustomData['uni_event_date_start'][0] != $aCustomData['uni_event_date_end'][0] ) { ?>
									<p>
										<?php
										$iDateStartTimestamp = strtotime($aCustomData['uni_event_date_start'][0]);
										$iDateEndTimestamp = strtotime($aCustomData['uni_event_date_end'][0]);
										echo sprintf( esc_html__('De %s', 'coworking'), date_i18n($sDateFormat, $iDateStartTimestamp));
										echo '<br>';
										echo sprintf( esc_html__('a %s', 'coworking'), date_i18n($sDateFormat, $iDateEndTimestamp));
										?>
									</p>
									<?php } else if ( !empty($aCustomData['uni_event_date_start'][0]) && empty($aCustomData['uni_event_date_end'][0]) )  { ?>
									<p>
										<?php
										$iDateStartTimestamp = strtotime($aCustomData['uni_event_date_start'][0]);
										echo date_i18n($sDateFormat, $iDateStartTimestamp);
										?>
									</p>
									<?php } else { echo '<p>'.esc_html__('data a anunciar', 'coworking').'</p>'; } ?>
								</div>
								<div class="eventDetailItem">
									<i class="fa fa-clock-o"></i>
									<p><?php if ( !empty($aCustomData['uni_event_time_start'][0]) ) { echo date_i18n($sTimeFormat, strtotime($aCustomData['uni_event_time_start'][0])) . ( (!empty($aCustomData['uni_event_time_end'][0])) ? ' - '.date_i18n($sTimeFormat, strtotime($aCustomData['uni_event_time_end'][0])) : '' ); } else { esc_html_e('data a anunciar', 'coworking'); } ?></p>
								</div>
								<div class="eventDetailItem">
									<i class="fa fa-map-marker"></i>
									<p><?php if ( !empty($aCustomData['uni_event_address'][0]) ) { echo esc_html( $aCustomData['uni_event_address'][0] ); } else { esc_html_e('data a anunciar', 'coworking'); } ?></p>
								</div>
								<div class="eventDetailItem">
									<i class="fa fa-credit-card"></i>
									<p><?php if ( !empty($aCustomData['uni_event_price'][0]) ) { echo esc_html( $aCustomData['uni_event_price'][0] ); } else { esc_html_e('data a anunciar', 'coworking'); } ?></p>
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

						<div class="uni-clear"></div>
						<?php
						if ( !empty($aCustomData['uni_local_events_join_on'][0]) && $aCustomData['uni_local_events_join_on'][0] == 'on' ) {
							?>
							<div class="singleEventJoinBtnWrap">
								<a id="joinEventBtn" data-remodal-target="eventRegistrationPopup">
									<?php echo ( !empty($aCustomData['uni_local_events_button_text'][0]) ) ? esc_html( $aCustomData['uni_local_events_button_text'][0] ) : esc_html__('Join event', 'coworking'); ?>
								</a>
							</div>
							<?php
						}
						?>
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
				<?php uni_coworking_theme_similar_cpt_by_tax_alt( 'uni_event_cat', 3, 'uni_event', esc_html__('Related Events', 'coworking') ); ?>
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
					<?php the_title( '<h1>', '</h1>' ); ?>
				</div>
				<div class="singlePostWrap">

					<div class="singleEventDetails uni-clear">
						<div class="fcell">
							<div class="eventDetailItem">
								<i class="fa fa-calendar"></i>
								<?php if ( !empty($aCustomData['uni_event_date_start'][0]) && !empty($aCustomData['uni_event_date_end'][0])
								&& $aCustomData['uni_event_date_start'][0] == $aCustomData['uni_event_date_end'][0] ) { ?>
								<p>
									<?php
									$iDateStartTimestamp = strtotime($aCustomData['uni_event_date_start'][0]);
									echo date_i18n($sDateFormat, $iDateStartTimestamp);
									?>
								</p>
								<?php } else if ( !empty($aCustomData['uni_event_date_start'][0]) && !empty($aCustomData['uni_event_date_end'][0])
								&& $aCustomData['uni_event_date_start'][0] != $aCustomData['uni_event_date_end'][0] ) { ?>
								<p>
									<?php
									$iDateStartTimestamp = strtotime($aCustomData['uni_event_date_start'][0]);
									$iDateEndTimestamp = strtotime($aCustomData['uni_event_date_end'][0]);
									echo sprintf( esc_html__('De %s', 'coworking'), date_i18n($sDateFormat, $iDateStartTimestamp));
									echo '<br>';
									echo sprintf( esc_html__('a %s', 'coworking'), date_i18n($sDateFormat, $iDateEndTimestamp));
									?>
								</p>
								<?php } else if ( !empty($aCustomData['uni_event_date_start'][0]) && empty($aCustomData['uni_event_date_end'][0]) )  { ?>
								<p>
									<?php
									$iDateStartTimestamp = strtotime($aCustomData['uni_event_date_start'][0]);
									echo date_i18n($sDateFormat, $iDateStartTimestamp);
									?>
								</p>
								<?php } else { echo '<p>'.esc_html__('data a anunciar', 'coworking').'</p>'; } ?>
							</div>
							<div class="eventDetailItem">
								<i class="fa fa-clock-o"></i>
								<p><?php if ( !empty($aCustomData['uni_event_time_start'][0]) ) { echo date_i18n($sTimeFormat, strtotime($aCustomData['uni_event_time_start'][0])) . ( (!empty($aCustomData['uni_event_time_end'][0])) ? ' - '.date_i18n($sTimeFormat, strtotime($aCustomData['uni_event_time_end'][0])) : '' ); } else { esc_html_e('data a anunciar', 'coworking'); } ?></p>
							</div>
							<div class="eventDetailItem">
								<i class="fa fa-map-marker"></i>
								<p><?php if ( !empty($aCustomData['uni_event_address'][0]) ) { echo esc_html( $aCustomData['uni_event_address'][0] ); } else { esc_html_e('data a anunciar', 'coworking'); } ?></p>
							</div>
							<div class="eventDetailItem">
								<i class="fa fa-credit-card"></i>
								<p><?php if ( !empty($aCustomData['uni_event_price'][0]) ) { echo esc_html( $aCustomData['uni_event_price'][0] ); } else { esc_html_e('Gratuito', 'coworking'); } ?></p>
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

						<div class="uni-clear"></div>
						<?php
						if ( !empty($aCustomData['uni_local_events_join_on'][0]) && $aCustomData['uni_local_events_join_on'][0] == 'on' ) {
							?>
							<div class="singleEventJoinBtnWrap">
								<a id="joinEventBtn" data-remodal-target="eventRegistrationPopup">
									<?php echo ( !empty($aCustomData['uni_local_events_button_text'][0]) ) ? esc_html( $aCustomData['uni_local_events_button_text'][0] ) : esc_html__('Join event', 'coworking'); ?>
								</a>
							</div>
							<?php
						}
						?>
					</div>

					<?php

					if ( !empty( get_the_content() ) ) {
						the_content();
					}	elseif ( get_field('conteudo') ) { ?>

					<?php the_field('conteudo'); ?>

					<?php }

					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'coworking' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'coworking' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					) );

					?>


					<div class="team">
						<div class="singleMeta">
							<?php if( get_field('titulo') ): ?>
								<h3 class="titulo"><?php the_field('titulo'); ?></h3>
							<?php endif; ?>
						</div>


						<?php

						// check if the repeater field has rows of data
						if( have_rows('blocos') ):

					 		// loop through the rows of data
							while ( have_rows('blocos') ) : the_row();

								?>
								<div class="dual">
									<div class="dual__inner">
										<div class="dual__half"  style="background-image: url(<?php the_sub_field('foto'); ?>);"></div>
									</div>
									<div class="dual__content">

										<h2 class="nome"><?php the_sub_field('nome'); ?></h2>
										<p class="texto"><?php the_sub_field('cargo'); ?></p>
										<a class="btx-media-wrapper-inner" href="<?php the_sub_field('logo_url'); ?>" target="_blank">
											<?php 
											$logo = get_sub_field('logo');
											?>
											<img class="logo-company" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>"  >
										</a>
										<p class="descricao">
											<?php the_sub_field('descricao'); ?>
										</p>
										<?php if( get_sub_field('linkedin_url') ): ?>
											<a class="linkedin" href="<?php the_sub_field('linkedin_url'); ?>" class="flex flex-column" target="_blank">
												<i style="font-size: 20px;" class="fa fa-linkedin"></i>
											</a>

										<?php endif; ?>

									</div>
								</div>

								<?php 

					        // display a sub field value


							endwhile;

						else :

					    // no rows found

						endif;

						?>


					</div>
				</div>

				<?php include( locate_template('includes/social-links.php') ); ?>

				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>

			</div>

			<?php if ( !ot_get_option( 'uni_display_similar_events' ) || ot_get_option( 'uni_display_similar_events' ) != 'off' ) { ?>
			<?php uni_coworking_theme_similar_cpt_by_tax( 'uni_event_cat', 3, 'uni_event', esc_html__('Related Events', 'coworking') ); ?>
			<?php } ?>

		</div>
	<?php endwhile; endif; ?>



</section>
<?php
}
?>

<?php
if ( ( isset($aCustomData['uni_local_events_join_on'][0]) && !empty($aCustomData['uni_local_events_join_on'][0]) && $aCustomData['uni_local_events_join_on'][0] == 'on' ) ) {
	?>
	<div data-remodal-id="eventRegistrationPopup" class="eventRegistrationWrap">
		<span data-remodal-action="close" class="thmRemodalClose"><?php esc_html_e('Close', 'coworking'); ?></span>
		<div class="remodalFormWrap uni-clear">
			<h3><?php echo ( !empty($aCustomData['uni_local_events_button_text'][0]) ) ? esc_html( $aCustomData['uni_local_events_button_text'][0] ) : esc_html__('Join event', 'coworking'); ?></h3>

			<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" class="eventRegistrationForm uni-clear uni_form">
				<input type="hidden" name="uni_contact_nonce" value="<?php echo wp_create_nonce('uni_nonce') ?>" />
				<input type="hidden" name="action" value="uni_coworking_theme_join_event_form" />
				<input type="hidden" name="event_id" value="<?php echo get_the_ID() ?>" />

				<p><?php esc_html_e('Junta-te ao nosso evento. Preenche, por favor, o seguinte formulário.', 'coworking'); ?></p>
				<div class="inputWrap">
					<input type="text" name="uni_contact_firstname" value="" placeholder="<?php esc_html_e('Nome', 'coworking') ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit">
				</div>
				<div class="inputWrap">
					<input type="text" name="uni_contact_lastname" value="" placeholder="<?php esc_html_e('Apelido', 'coworking') ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit">
				</div>
				<div class="inputWrap">
					<input type="text" name="uni_contact_email" value="" placeholder="<?php esc_html_e('EMAIL', 'coworking') ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit"  data-parsley-type="email">
				</div>
				<div class="inputWrap">
					<input type="text" name="uni_contact_phone" value="" placeholder="<?php esc_html_e('TELEMÓVEL', 'coworking') ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit" data-parsley-type="integer">
				</div>
				<div class="uni-clear"></div>
				<div class="textareaWrap">
					<textarea name="uni_contact_msg" cols="30" rows="10" placeholder="<?php esc_html_e('MENSAGEM', 'coworking') ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit"></textarea>
				</div>
				<?php if ( ot_get_option('uni_form_msg_bottom_join_event_enable') && ot_get_option('uni_form_msg_bottom_join_event_enable') === 'on' ) { ?>
				<p class="formMsg"><?php echo ( ot_get_option('uni_form_msg_bottom_join_event_text') ) ? ot_get_option('uni_form_msg_bottom_join_event_text') : ''; ?></p>
				<?php } ?>
				<input class="thmSubmitBtn uni_input_submit" type="button" value="<?php esc_html_e('ENVIAR', 'coworking') ?>">
			</form>
		</div>
	</div>
	<?php } ?>



	<?php get_footer(); ?>