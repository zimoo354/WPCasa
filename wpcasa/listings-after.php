
	</div>
	<div class="small-12 columns">
<?php
/**
* Template: After Listings Archive
*/
global $wpsight_query; ?>


<?php if( isset( $show_paging ) && $show_paging ) wpsight_pagination( $wpsight_query->max_num_pages ); ?>

<?php do_action( 'wpsight_listings_after', $wpsight_query ); ?>

	    </div>
    </div>
</div><!-- .wpsight-listings -->

