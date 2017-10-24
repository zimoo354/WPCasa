<?php get_header() ?>

<?php get_template_part('title', 'colonial') ?>

<section id="content">
	<div class="row pad-und-md">
		<div class="small-12 columns">

			<?php the_post();the_content(); ?>
		</div>
	</div>
</section>

<?php get_footer() ?>