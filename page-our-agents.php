<?php get_header() ?>

<?php get_template_part('title', 'colonial') ?>

<section id="content" class="our-agents about-us">
	<div class="row pad-und-md">
		<h2>Extremely experienced professionals</h2>
		<p>Our business is highly professional. We specialize in giving a personalized service to even the most demanding buyer, and in offering a wide range of properties and prices. Whatever your personal taste, we are likely to have that colonial downtown house, a valuable fixer upper, a practical condo, an elegant mansion or small or large plot of land.</p>
		<p>We provide our clients with all the necessary information to buy or sell properties in San Miguel de Allende and its surrounding areas.</p>
		<p>Word-of-Mouth recommendations and satisfied clients are our most valuable sources for new clients as our business relationship with people is always fruitful. We work with other San Miguel Realtors to provide the widest accessibility to all properties in town.</p>
		<p>Colonial Real Estate is the best source for great homes in San Miguel de Allende. Do not hesitate to call us today as we are extremely experienced professionals in the Real Estate sector in our lovely World Heritage town!</p>
		<h5>"Colonial Real Estate, with more than 20 years experience in San Miguel de Allende"</h5>
	</div>
	<div class="row pad-und-md">
		
			<?php
			$args = array(
				'post_type' => 'agent',
				'posts_per_page' => -1,
                'post__not_in' => array(196),
            );

			query_posts( $args );


			?>
			<?php if (have_posts()): while (have_posts()): the_post() ?>
			<div class="small-12 medium-6 columns">
				<div class="single-agent small-12 columns">
					<div class="small-5 columns">
						<div class="img" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large') ?>);" onclick="agent('<?php echo get_the_title(get_the_ID()) ?>',<?php echo get_the_ID() ?>)"></div>
					</div>
					<div class="small-7 columns pad-und-xs">
						<h6><?php echo get_the_title(get_the_ID()) ?></h6>
						<span class="role"><?php the_field('role') ?></span>
						<ul class="menu left">
							<?php if (($test = get_field('email')) != ''): ?>
							<li><button type=button onclick="modalCorreo('<?php echo get_the_title(get_the_ID()) ?>','<?php the_field('email') ?>')"><i class="fa fa-lg fa-envelope"></i></button></li>
							<?php endif ?>
							<?php if (($phone_call = get_field('phone_call')) != ''): ?>
							<li><a href="tel:<?php the_field('phone_call') ?>"><i class="fa fa-lg fa-phone"></i></a></li>
							<?php endif ?>
							<?php if (($phone_wa = get_field('phone_wa')) != ''): ?>
							<li><a href="whatsapp://send?phone=52<?php the_field('phone_wa') ?>"><i class="fa fa-lg fa-whatsapp"></i></a></li>
							<?php endif ?>
						</ul>
					</div>
				</div>
			</div>
			<?php endwhile;endif; ?>
	</div>
</section>

<?php get_template_part('modal', 'agente'); ?>
<?php get_template_part('modal', 'cv'); ?>

<?php get_footer() ?>