<div id="sidr">
    <a href="<?php base_url() ?>">
	    <img src="<?php res() ?>/img/logo-colonial.svg">
    </a>
	<ul>
		<li><a href="#sidr" class="menu-mobile-trigger"><i class="fa fa-close fa-inverse fa-2x"></i></a></li>
		<?php
		$menu = wp_get_nav_menu_items('main');
		foreach ($menu as $e) :
			?>
			<li><a href="<?php echo $e->url ?>"><?php echo $e->title ?></a></li>
		<?php endforeach ?>

	</ul>
</div>