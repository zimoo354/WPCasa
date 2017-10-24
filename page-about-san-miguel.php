<?php get_header() ?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaLm3C2eHmLhQ3LBGQ5Zg5xK1EMXEv-uE"></script>

<section id="principal" style=" height: 80vh;background-image:url(<?php res() ?>/img/fondo-san-miguel.png)";> 
		<div class="row expanded collapse">
			<div class="small-12 columns">
				<div class="small-12 columns title centerhome">
					<h1>Visit San Miguel de Allende</h1>
					<h3>ONE OF THE MOST BEAUTIFUL CITIES IN MEXICO</h3>

				</div>
			</div>
		</div>
        <?php get_search_form() ?>
</section>

<!--<section id="uno"> 
		<div class="row expanded collapse">
			<div class="small-6 small-push-3  columns centerhome pad-und-ssm">
				<h1>An Amazing place to be</h1>
				<p>Colonial Real Estate offers all the tools you need to search for your ideal home in San Miguel de Allende. We can find your dream house in San Miguel. Our advice to you is to acquire an investment property, and make you yet another pround and valued customer.</p>
			</div>
		</div>
</section>-->
	
	

<section id="section-uno-about">
	<div class="row extra">
			<div class="small-12 columns">
				<div class="medium-6 columns pad-und-md">

					
					<div class="gallery-cont small-12 columns small-up-1 medium-up-3">
                    <h1>Gallery</h1>
						<?php  $galeria= get_field("gallery");?>
						<?php  foreach ($galeria as $foto): ?>
							<div class="column pad-und-xs">
								<div class="img embedbg" style="background-image: url(<?php echo ($foto['sizes']['large']); ?>)" data-img="<?php echo ($foto['sizes']['large']); ?>"></div>
							</div>
						<?php  endforeach; ?>
                        <div class="img viewer"></div>
					</div>

					
				</div>
				<div class="medium-6 columns pad-und-md">
					
					<div class="small-12 medium-10 medium-push-1 columns">
					<h1>About</h1>
                        <p>It is considered one of the most beautiful cities in Mexico and in 2008 it was recognized, along with the Sanctuary of Jesus of Atotonilco, as a World Heritage Site by UNESCO. Its attractive and cosmopolitan appearance makes it one of the favorite destinations for art enthusiasts. There is plenty of sites to visit, and they all stand out the city’s historical and architectural heritage.

					One of the sites that you must see is the San Miguel Arcangel Parish. It has become the hallmark of the city. It is a beautiful temple of the end of the century. Other must places in San Miguel de Allende are the handicraft market of the city or the archeological zone of Cañada la Virgen.

					In the market there is a sample of the local craftsmanship made of metals, papier mache, blown glass and more. Its cobbled streets, wooded courtyards, fine architectural details and sumptuous interiors will enchant you; perhaps that is the reason why CN Travel declared it one of the twenty-five best cities chosen by the travelers. </p>
					</div>
					
				</div>
			</div>
	</div>
</section>

<section id="section-dos-about">
	<div class="row extra collapse">
		<div class="small-12 columns centerhome pad-und-md">
			<h1 id="title-what-to-do">What to do in San Miguel</h1>
			<p id="subtitle-what-to-do">Feel free to explore the map. You can click a location to know more about the neighborhood.</p>
		</div>


		<div class="small-12 columns small-up-1 medium-up-4">
		<?php  if( have_rows('what-to-do') ): ?>

 	
    <?php  while ( have_rows('what-to-do') ) : the_row();?>
			<div class="column centerhome">
				<div class="img embedbg" style="background-image: url(<?php the_sub_field('imagen') ?>); height: 320px;"></div>
				<h1> <?php   the_sub_field('titulo'); ?> </h1>
				<p><?php the_sub_field('contenido') ?></p>
			</div>
       <?php  endwhile;?>
   <?php endif ?>

		</div>

	</div>
</section>

<!-- Section Divider -->

<?php
$locs = get_terms(array( 'taxonomy' => 'location' ));
?>

<script>
    // Ubicaciones de las colonias
    locations = [
		<?php
		foreach($locs as $l):
		$g = get_field('map', $l);
		if ($g):
		?>

        ['<?php echo $l->name ?>', <?php echo $g['lat'] ?>, <?php echo $g['lng'] ?>, <?php echo $l->term_id ?>, '<?php echo get_term_link($l) ?>'],
		<?php
		endif;
		endforeach;
		?>
    ];
</script>


<section class="pad-und-md">
    <div id="zonas-sma" class="row expanded collapse">
        <div class="small-12 columns">
            <h1>Area guide</h1>
            <p>Feel free to explore the map. You can click a location to know more about the neighborhood.</p>
        </div>
        <div class="small-12 columns">
            <input type="hidden" id="mapa-sma" value="true">
            <div id="map-sma"></div>
        </div>
    </div>
    <div id="thumbs-zonas-sma" class="row pad-und-md">
        <div class="small-12 columns small-up-1 medium-up-4">
	        <?php
	        foreach($locs as $l):
		        $g = get_field('map', $l);
		        if ($g):
			        ?>

                    <div class="column">
                        <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo $g['lat'] ?>,<?php echo $g['lng'] ?>&markers=color:red%7C<?php echo $g['lat'] ?>,<?php echo $g['lng'] ?>&zoom=15&size=250x250&maptype=roadmap&key=AIzaSyDwDp3j6ro5JWa24vYO1ZcbfJJOq8Li82o" alt="">
                        <h5><?php echo $l->name ?></h5>
                        <div class="description">
	                        <?php echo term_description( $l->term_id, 'location' ) ?>
                        </div>
                        <a href="<?php echo get_term_link($l) ?>" class="button">See all properties</a>
                    </div>

			        <?php
			        $c++;
		        endif;
	        endforeach;
	        ?>
        </div>
    </div>
</section>


<?php get_footer(); ?>
