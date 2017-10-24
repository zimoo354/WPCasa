<?php
global $listing;
$imagen = get_the_post_thumbnail_url($listing->ID, 'original');
$currency = (get_field('currency', $listing->ID) != '') ? get_field('currency', $p->ID) : 'USD';

?>


<div id="listing-<?php the_ID(); ?>" <?php wpsight_listing_class( 'entry-content listing-archive column ' ); ?> itemscope itemtype="http://schema.org/Product">

	<meta itemprop="name" content="<?php echo esc_attr( $post->post_title ); ?>" />

	<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="clearfix">

		<?php do_action( 'wpsight_listing_archive_before', $post ); ?>

		<div class="small-12 columns">
            <a href="<?php the_permalink() ?>">
			    <div class="img" style="background-image: url(<?php echo $imagen ?>)"></div>
            </a>

		</div>

		<div class="small-12 columns">

			<?php wpsight_get_template( 'listing-archive-title.php' ); ?>

		</div>
        <div class="small-12 columns">
            <?php echo wpsight_get_listing_price($post->ID, '', $currency, array()) ?>
        </div>
        <div class="small-8 columns">
	        <?php wpsight_listing_summary(); ?>
        </div>
        <div class="small-4 columns">
            <div class="wpsight-listing-status">
		        <?php $listing_offer = wpsight_get_listing_offer( get_the_id(), false ); ?>
                <span class="badge badge-<?php echo esc_attr( $listing_offer ); ?>" style="background-color:<?php echo esc_attr( wpsight_get_offer_color( $listing_offer ) ); ?>"><?php wpsight_listing_offer(); ?></span>
            </div>
        </div>
        <div class="small-12 columns">
	        <?php echo do_shortcode('[ssba title="'.get_the_title().'" url="'.get_permalink().'"]'); ?>
        </div>

		<?php do_action( 'wpsight_listing_archive_after', $post ); ?>

	</div>

</div><!-- #listing-<?php the_ID(); ?> -->