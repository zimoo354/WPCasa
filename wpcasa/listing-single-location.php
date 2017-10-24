<?php
/**
 * Template: Single Listing Location
 */
global $listing;

$post = get_post_object_by_slug($listing, 'listing');

$lat  = get_field('location_map', $post->ID)['lat'];
$long = get_field('location_map', $post->ID)['lng'];

$hide = get_post_meta( $post->ID, '_map_hide', true );

if( $lat && $long && ! $hide ) { ?>
<section id="single-location">
	<div class="row expanded collapse">
		<div class="small-12 columns">
			<h1 class="centerhome title-propiedad" >Location</h1>

			<div class="wpsight-listing-section wpsight-listing-section-location">

				<style>
					#map-canvas {
						width: 100%;
						height: 400px;
					}
					#map-canvas img {
						max-width: none;
					}
				</style>
				<?php

					    // Set map default options

				$map_defaults = array(
					'map_type' 	   	    => 'ROADMAP',
					'control_type' 	    => 'true',
					'control_nav'  	    => 'true',
					'scrollwheel'  	    => 'false',
					'streetview'   	    => 'true',
					'map_zoom'			=> '14'
					);

					    // Get map listing options

				$map_options = array(
					'_map_type' 			=> get_post_meta( $post->ID, '_map_type', true ),
					'_map_zoom' 			=> get_post_meta( $post->ID, '_map_zoom', true ),
					'_map_no_streetview' 	=> get_post_meta( $post->ID, '_map_no_streetview', true )
					);

				$map_args = array(
					'map_type' 		=> ! empty( $map_options['_map_type'] ) ? $map_options['_map_type'] : $map_defaults['map_type'],
					'map_zoom' 		=> ! empty( $map_options['_map_zoom'] ) ? $map_options['_map_zoom'] : $map_defaults['map_zoom'],
					'streetview' 	=> ! empty( $map_options['_map_no_streetview'] ) ? 'false' : 'true'
					);

						// Parse map args and apply filter		    
				$map_args = apply_filters( 'wpsight_listing_map_args', wp_parse_args( $map_args, $map_defaults ) );

				?>
				<script>
					function initialize() {
						var myLatlng = new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $long; ?>);
						var mapOptions = {
							zoom: 				<?php echo $map_args['map_zoom']; ?>,
							mapTypeId: 			google.maps.MapTypeId.<?php echo $map_args['map_type']; ?>,
							mapTypeControl: 	<?php echo $map_args['control_type']; ?>,
							navigationControl: 	<?php echo $map_args['control_nav']; ?>,
							scrollwheel: 		<?php echo $map_args['scrollwheel']; ?>,
							streetViewControl: 	<?php echo $map_args['streetview']; ?>,
							center: myLatlng
						}
						var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

						var marker = new google.maps.Marker({
							position: myLatlng,
							map: map,
							title: '<?php echo esc_attr( $post->post_title ); ?>'
						});

						var popup = new google.maps.InfoWindow({
							content: '<?php echo esc_attr( $post->post_title ); ?>'
						});

						google.maps.event.addListener(marker, 'click', function(){
							popup.open(map, marker);
						});						
					}

					google.maps.event.addDomListener(window, 'load', initialize);
				</script>

				<div itemprop="availableAtOrFrom" itemscope itemtype="http://schema.org/Place">

					<?php do_action( 'wpsight_listing_single_location_before', $post->ID ); ?>

					<div class="wpsight-listing-location" itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">

						<div id="map-canvas"></div>

						<meta itemprop="latitude" content="<?php echo $lat; ?>" />
						<meta itemprop="longitude" content="<?php echo $long; ?>" />

						<?php if( ! empty( $post->_map_note ) ) : ?>
							<div class="wpsight-listing-location-note">
								<?php echo wp_kses_post( $post->_map_note ); ?>
							</div>
						<?php endif; ?>

					</div>

					<?php do_action( 'wpsight_listing_single_location_after', $post->ID ); ?>

				</div>

			</div><!-- .wpsight-listing-section -->

		</div>
	</div>
</section>

<?php } // endif $location ?>