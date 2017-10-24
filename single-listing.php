<?php get_header() ?>

<?php 
global $post;
$POSTID = $post->ID;
// setup_postdata( $post );
$img = get_the_post_thumbnail_url($post->ID, 'large');

$location_list = get_the_terms($post, 'location');
$location_list_size = count($location_list);
$location_counter = 0;

$listing_type = wp_get_post_terms($post->ID, 'listing-type');
?>


<section id="propiedad-principal">
	<div class="row extra pad-und-xs">
        <!-- Seccion Titulo START -->
        <div class="medium-9 hide-for-small-only columns">
            <h1 class="title-propiedad"><?php the_title() ?> <?php if($location_list): ?><span class="subtitle-propiedad"><?php foreach ($location_list as $l) {echo $l->name . ($location_counter < ($location_list_size - 1) ? ', ' : '');$location_counter++;} ?></span> <?php endif; ?></h1>
        </div>
        <div class="medium-3 hide-for-small-only columns">
            <button type="button" onclick="virtualTour(<?php echo $POSTID; ?>)" class="button float-right">Virtual Tour</button>
            <a href="?print=<?php the_ID() ?>" class="button float-right"><i class="fa fa-print"></i> <span>Print</span></a>
        </div>
        <div class="small-12 show-for-small-only columns">
			<?php $location_counter = 0; ?>
            <h1 class="title-propiedad"><?php the_title() ?> <?php if($location_list): ?></h1>
            <span class="subtitle-propiedad"><?php foreach ($location_list as $l) {echo $l->name . ($location_counter < ($location_list_size - 1) ? ', ' : '');$location_counter++;} ?></span> <?php endif; ?>
        </div>
        <!-- Seccion Titulo END -->
		<div class="small-12 medium-7 columns">
			<div class="swiper-container gallerytop">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
                        <img src="<?php echo $img; ?>">
                    </div>
					<?php if (!empty(get_field('gallery'))): $pics = get_field('gallery'); ?>
						<?php foreach($pics as $pic): ?>
                            <div class="swiper-slide">
                                <img src="<?php echo $pic['sizes']['large']; ?>">
                            </div>
						<?php endforeach ?>
					<?php endif ?>
				</div>
			</div>
			<div class="swiper-container gallery-thumbs">
				<div class="swiper-wrapper">
					<div class="swiper-slide" style="background-image: url(<?php echo $img; ?>);"> </div>
					<?php if (!empty(get_field('gallery'))): $pics = get_field('gallery'); ?>
						<?php foreach($pics as $pic): ?>
							<div class="swiper-slide" style="background-image: url(<?php echo $pic['url']; ?>);"> </div>
						<?php endforeach ?>
					<?php endif ?>
				</div>
			</div>
			<div class="small-12 columns pad-und-ssm parrafoprincipal">
				<?php echo apply_filters( 'wpsight_listing_description', wpsight_format_content( $post->post_content ) ); ?>
			</div>
		</div>

		<div class="small-12 medium-5 columns">
            <div class="small-6 columns">
                <?php if($listing_type[0] != null): ?>
                <h6 class="listing-type">Listing Type: <a href="<?php echo get_term_link($listing_type[0]) ?>"><span class="badge"><?php echo $listing_type[0]->name; ?></span></a></h6>
                <?php else: ?>
                    <h6 class="listing-type">Listing Type not available</h6>
                <?php endif ?>
            </div>
			<div class="small-6 columns">
				<?php echo do_shortcode('[ssba]') ?>
			</div>
			<div class="small-12 columns pad-und-xs">
				<?php wpsight_get_template( 'listing-single-info.php' ); ?>
			</div>
			
			
			<div class="small-12 columns ">
				<?php wpsight_get_template( 'listing-single-details.php' ); ?>
			</div>

			<?php if (get_field('agent')->ID != 196): ?>
				<?php $agent = get_field('agent') ?>
                <div class="small-12 columns cuadro-contact-our pad-und-ssm">
                    <div class="small-12 columns">
                        <h1 class="subtitle-propiedad centerhome">Contact our Agent</h1>
                    </div>
                    <div class="small-12 columns">
                        <div class="small-5 columns">
                            <div class="img" style="background-image: url(<?php echo get_the_post_thumbnail_url($agent->ID, 'large') ?>);"></div>
                        </div>
                        <div class="small-7 columns pad-und-xs">
                            <h6><?php echo get_the_title($agent->ID) ?></h6>
                            <span class="role"><?php the_field('role', $agent->ID) ?></span>
                            <ul class="menu left">
								<?php if (($phone_call = get_field('phone_call', $agent->ID)) != ''): ?>
                                    <li><a href="tel:<?php the_field('phone_call', $agent->ID) ?>"><i class="fa fa-lg fa-phone"></i></a></li>
								<?php endif ?>
								<?php if (($phone_wa = get_field('phone_wa', $agent->ID)) != ''): ?>
                                    <li><a href="whatsapp://send?phone=52<?php the_field('phone_wa', $agent->ID) ?>"><i class="fa fa-lg fa-whatsapp"></i></a></li>
								<?php endif ?>
                            </ul>
                        </div>
                    </div>
                </div>
			<?php endif ?>
			<?php if ($agent = get_field('agent') && get_field('agent')->ID == 196): ?>
                <div class="small-12 columns cuadro-contact-our pad-und-ssm">
                    <div class="small-12 columns">
                        <h1 class="subtitle-propiedad centerhome">Listed by Cooperative Broker</h1>
                    </div>
                </div>
			<?php endif ?>

			<div class="small-12 columns">
				<h1 class=" subtitle-propiedad centerhome pad-und-xs">Inquire about this property</h1>
			</div>
			<form id="info-propiedad" class="centerhome">
				<div class="small-12 medium-10 medium-push-1 columns  ">
					<div class="input-group">
						<input type="text" id="name" name="name" class="formulario" placeholder="Your Name" />
					</div>
					<div class="input-group">
						<input type="email" id="mail" name="mail" class="formulario" placeholder="Your Email Address" required/>
					</div>
					<div class="input-group">
						<input type="tel" id="phone" name="phone" class="formulario"  placeholder="Phone" />
					</div>
					<div class="input-group">
						<textarea class="formulario" id="message" name="message" cols="30" rows="3" placeholder="Message" ></textarea>
					</div>
				</div>
                <div class="small-12 columns centerhome" >
                    <input type="hidden" name="pk" value="<?php echo $POSTID ?>">
                    <input type="submit" class="hide">
                    <button type='button' onclick="sendInfoPropiedad()" class="button botones">Request info </button>
                </div>
			</form>


			
		</div>
	</div>
</section>

<!-- Location Section -->
<?php wpsight_get_template( 'listing-single-location.php' ); ?>

<?php
$features = wp_get_post_terms(get_the_ID(), 'feature');
if ($features):
?>
<section id="features">
	<div class="row extra pad-und-sssm">
		<div class="small-12 columns centerhome">
			<h1 class="title-propiedad">Other Features</h1>
		</div>

        <div class="small-12 columns small-up-2 medium-up-5 large-up-6 pad">
            <?php foreach ($features as $feature): ?>
            <div class="column"><h6><?php echo $feature->name; ?></h6></div>
            <?php endforeach; ?>
        </div>
	</div>
</section>
<?php endif; ?>

<?php
$current_locations = array();
$current_location = wp_get_post_terms(get_the_ID(), 'location');
if ($current_location): ?>
<section class="pad-und-ssm featured">
	<div class="row expanded">
		<div class="small-12 columns centerhome">
			<h1 class="title-propiedad">Related Properties</h1>
            <?php


            $args = array(
	            'post_type' => 'listing',
	            'post__not_in' => [$POSTID],
	            'tax_query' => array(
		            array(
			            'taxonomy' => 'location',
			            'field' => 'id',
			            'terms' => $current_locations
		            )
	            )
            );
            $query = new WP_Query( $args );
            if($query->have_posts()): while ($query->have_posts()):
	            $query->the_post();
                global $post;
                $p = $post;
				?>
                <div class="small-12 medium-4 columns <?php if ($query->current_post + 1 == $query->post_count) echo 'end'; // If last post in query, echo 'end' class ?>">
                    <a href="<?php echo get_permalink($p) ?>" class="full"></a>
                    <div class="img embedbg" style="background-image: url(<?php echo get_the_post_thumbnail_url($p) ?>)"></div>
                    <h1 class="properties"><?php echo get_the_title($p) ?></h1>
                    <h2 class="propertiesnegro">$ <?php echo number_format(wpsight_get_listing_price_raw($p->ID), 0, '.', ','); ?></h2>
                </div>
			<?php endwhile;endif; ?>

		</div>
	</div>
</section>
<?php endif ?>


<?php get_footer() ?>