<?php get_header() ?>

<section id="principal">

    <div id="main-slider" class="swiper-container">
        <div class="swiper-wrapper">
            <?php if(have_rows('destacadas')): while (have_rows('destacadas')):
                the_row();
                $p = get_sub_field('propiedad');
	            $currency = (get_field('currency', $p->ID) != '') ? get_field('currency', $p->ID) : 'USD';

	            ?>
            <div class="swiper-slide embedbg" style="background-image: url(<?php echo get_the_post_thumbnail_url($p, 'original') ?>)">
                <div class="overlay"></div>
                <div class="row">
                    <div class="small-12 columns title centerhome">
                        <h1><?php echo get_the_title($p) ?></h1>
                        <h3><?php the_sub_field('claim', $p->ID) ?></h3>
                        <h2>$ <?php echo number_format(wpsight_get_listing_price_raw($p->ID), 0, '.', ',') . ' ' . $currency; ?></h2>
                        <a href="<?php echo get_permalink($p) ?>" class="button">View Listing</a>
                    </div>
                </div>
            </div>
            <?php endwhile;endif; ?>
        </div>
    </div>
	<?php get_search_form() ?>
</section>

<section id="uno">
		<div class="row expanded pad-und-ssm">
			<div class="small-12 medium-8 medium-push-2 large-6 large-push-3  columns centerhome">
				<h1>An Amazing place to be</h1>
				<p>Colonial Real Estate offers all the tools you need to search for your ideal home in San Miguel de Allende. We can find your dream house in San Miguel. Our advice to you is to acquire an investment property, and make you yet another pround and valued customer.</p>
				<div class="small-12 columns pad-und-sm">
				<a href="<?php base_url() ?>/about-san-miguel" class="button">Read More</a>
				</div>
			</div>
		</div>
</section>

<section id="dos" class="pad-und-ssm featured">
		<div class="row expanded collapse">
			<div class=" medium-12  columns centerhome ">
				<h1 class="pad-und-sssm">Featured Properties</h1>
			</div>
			<div class="small-12 columns centerhome ">
				<?php if(have_rows('featured')): while (have_rows('featured')):
				the_row();
				$p = get_sub_field('propiedad');
                $currency = (get_field('currency', $p->ID) != '') ? get_field('currency', $p->ID) : 'USD';
				?>
				<div class="small-12 medium-4 columns">
                    <a href="<?php echo get_permalink($p) ?>" class="full"></a>
					<div class="img embedbg" style="background-image: url(<?php echo get_the_post_thumbnail_url($p) ?>)"></div>
					<h1 class="properties"><?php echo get_the_title($p) ?></h1>
					<h2 class="propertiesnegro">$ <?php echo number_format(wpsight_get_listing_price_raw($p->ID), 0, '.', ',') . ' ' . $currency; ?></h2>
				</div>
				<?php endwhile;endif; ?>
			</div>
		</div>
</section>

<section id="tres" class="pad-und-ssm">
	<div class="row">
		<div class="small-12 columns centerhome">
			<h1>Subscribe to our newsletter</h1>
			<h3>Receive our latest properties in your mail. We wont send you spam. </h3>
			<div class="small-12 columns">
			     <div class="small-12 medium-8 medium-push-2  columns pad-und-sssm">
                     <!-- Begin MailChimp Signup Form -->
                     <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
                     <style type="text/css">
                         #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
                         /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
							We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                     </style>
                     <div id="mc_embed_signup">
                         <form action="//i-w.us3.list-manage.com/subscribe/post?u=b5f909e6e2bf780ce63eba15a&amp;id=e21e4da6e8" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                             <div id="mc_embed_signup_scroll">
                                 <div class="mc-field-group">
                                     <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="E-mail address">
                                 </div>
                                 <div id="mce-responses" class="clear">
                                     <div class="response" id="mce-error-response" style="display:none"></div>
                                     <div class="response" id="mce-success-response" style="display:none"></div>
                                 </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                 <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_b5f909e6e2bf780ce63eba15a_e21e4da6e8" tabindex="-1" value=""></div>
                                 <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                             </div>
                         </form>
                     </div>

                     <!--End mc_embed_signup-->

                 </div>
            </div>
		</div>
	</div>
</section>


<?php get_footer() ?>
