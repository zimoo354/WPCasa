<?php
/**
 * This template shows a print-friendly
 * version of a single listing page
 *
 * @package WPSight
 * @since 1.0.0
 */

$listing_id = absint( $_GET['print'] );
$listing = get_post( $listing_id );

$listing_offer = wpsight_get_listing_offer( $listing->ID, false ); ?>
<!DOCTYPE html>
<html>

<head>
	<title><?php echo strip_tags( $listing->_listing_title ); ?></title>
	<?php do_action( 'wpsight_head_print' ); ?>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Hind|Open+Sans');

        img {
            display: block;
            margin: 0 auto;
        }

        p,span,h1,h2,h3,h4,h5,h6,li,dt,dd,th,td,div {
            font-family: Hind;
        }

        .listing-print-title h1 {
            color: #940404;
        }
        .listing-print-agent h3 {
            color: #046494;
        }


        .listing-print-agent .alignleft img {
            float: left;
            margin: 0 10px 10px 0;
            max-height: 150px;
            max-width: 150px;
        }

        .gallery .img {
            width: 46%;
            float: left;
            height: 250px;
            margin: 1cm 2%;
            display: block;
            background-size: cover;
            background-position: 50% 50%;
        }

    </style>

</head>

<body class="print<?php if( is_rtl() ) echo ' rtl'; ?>">

<div class="actions clearfix">

	<div class="alignleft">
		<a href="<?php echo esc_url_raw( get_permalink( $listing->ID ) ); ?>" class="button back">&laquo; <?php _ex( 'Back to Listing', 'listing print', 'wpcasa' ); ?></a>
	</div>

	<div class="alignright">
		<a href="#" onclick="window.print();return false" class="button printnow"><?php _ex( 'Print Now', 'listing print', 'wpcasa' ); ?></a>
	</div>

</div><!-- .actions -->

<page size="A4">

	<div class="wrap">

		<div class="listing-print-title logo-container">
			<img src="<?php res() ?>/img/logo-colonial-wine.png" alt="Logo" class="logo" style="height: 80px; margin: -30px auto 0 auto; display: block;">
		</div><!-- .listing-print-logo -->
		
		<div class="listing-print-title">
			<h1><?php echo get_the_title( $listing ); ?></h1>
		</div><!-- .listing-print-title -->

		<div class="listing-print-info clearfix">
			<div class="alignleft">
				<?php wpsight_listing_price( $listing->ID ); ?>
			</div>
			<div class="alignright">
				<?php wpsight_listing_id( $listing->ID ); ?> - <?php wpsight_listing_offer( $listing->ID ); ?>
			</div>
		</div><!-- .listing-print-info -->

		<div class="listing-print-image">
			<?php wpsight_listing_thumbnail( $listing->ID, 'full' ); ?>
		</div><!-- .listing-print-image -->

		<div class="listing-print-details">
			<?php wpsight_listing_details( $listing->ID ); ?>
		</div><!-- .listing-print-details -->

		<div class="listing-print-description">
			<?php if( wpsight_is_listing_not_available() ) : ?>
				<div class="wpsight-alert wpsight-alert-small wpsight-alert-not-available">
					<?php _e( 'This property is currently not available.', 'wpcasa' ); ?>
				</div>
			<?php endif; ?>
			<div class="wpsight-listing-description" itemprop="description">
				<?php echo apply_filters( 'wpsight_listing_description', wpsight_format_content( $listing->post_content ) ); ?>
			</div>
		</div><!-- .listing-print-description -->

		<div class="listing-print-features">
			<?php wpsight_listing_terms( 'feature', $listing->ID, ', ' ); ?>
		</div><!-- .listing-print-features -->
		<?php if ($agent = get_field('agent')): ?>
		<div class="listing-print-agent clearfix">
			<div class="alignleft">
                <img src="<?php echo get_the_post_thumbnail_url( $agent->ID, 'large' ) ?>" alt="<?php echo $agent->post_title ?>">
                <h3><?php echo $agent->post_title ?></h3>

				<?php if (($mail = get_field('email', $agent->ID)) != ''): ?>
                    <h5><?php echo $mail ?></h5>
				<?php endif ?>
				<?php if (($phone_call = get_field('phone_call', $agent->ID)) != ''): ?>
                    <h5><?php echo $phone_call; ?></h5>
				<?php endif ?>
			</div>
			<div class="alignright">
				<img src="<?php echo esc_url_raw( 'http://chart.apis.google.com/chart?cht=qr&chs=100x100&chld=H|0&chl=' . urlencode( get_permalink( $listing->ID ) ) ); ?>" width="100" height="100" alt="" />
			</div>
		</div><!-- .listing-print-agent -->
		<?php endif ?>

	</div><!-- .wrap -->

</page>

<page size="A4">

    <div class="wrap gallery">

	    <?php if (!empty(get_field('gallery'))): $pics = get_field('gallery'); ?>
		    <?php for($i = 0; $i < 6; $i++): ?>
                <div class="img" style="background-image: url(<?php echo $pics[$i]['url'] ?>)"></div>
		    <?php endfor ?>
	    <?php endif ?>

    </div><!-- .wrap -->

</page>
</body>
</html>