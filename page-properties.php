<?php get_header() ?>

<!-- SECTION DIVIDER -->

<section id="search-terms">
    <div class="row">
        <div class="small-12 columns">
			<?php echo do_shortcode('[wpsight_listings_search]') ?>
        </div>
    </div>
</section>
<section id="search">
	<div class="row">
		<div class="small-12 columns">
			<?php echo do_shortcode('[wpsight_listings]') ?>
		</div>
	</div>
</section>

<!-- SECTION DIVIDER -->

<?php get_footer() ?>