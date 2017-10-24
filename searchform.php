
<?php
// Taxonomy Zones
$zones = get_terms('location');
?>

<form id="searchform" action="properties" method="GET">

	<div class="small-12 columns">
		<div class="small-12 medium-8 medium-push-2 columns searchform-container">
				<div class="small-12 medium-6 columns">
					<input type="text" name="keyword" id="keyword" placeholder="Enter an address, city or ID" class="nice-select wide">
				</div>
				<div class="small-6 medium-3 columns">
					<select name="location" id="location" class="wide">
						<option value="">All zones</option>
						<?php foreach ($zones as $z): ?>
                            <?php if($z->parent != '0'): ?>
							<option value="<?php echo $z->slug ?>"><?php echo $z->name ?></option>
                            <?php endif; ?>
						<?php endforeach ?>
					</select>
				</div>
				<div class="small-6 medium-3 columns">
					<input class="button" type="submit" value="Find">
				</div>
		</div>
	</div>
</form>		
