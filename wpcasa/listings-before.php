<?php
/**
 * Template: Before Listings Archive
 */
global $wpsight_query; ?>

<?php do_action( 'wpsight_listings_before', $wpsight_query ); ?>

<?php if( isset( $show_panel ) && $show_panel ) wpsight_panel( $wpsight_query ); ?>

<div class="wpsight-listings">

	<div class="row">
		<div class="small-12 columns small-up-1 medium-up-3">
