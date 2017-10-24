<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Colonial Residencial | <?php echo get_the_title(); ?></title>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php res() ?>/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php res() ?>/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php res() ?>/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php res() ?>/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php res() ?>/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php res() ?>/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php res() ?>/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php res() ?>/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php res() ?>/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php res() ?>/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php res() ?>/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php res() ?>/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php res() ?>/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php res() ?>/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#940404">
    <meta name="msapplication-TileImage" content="<?php res() ?>/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#940404">
    <!-- File Name: <?php echo get_page_template(); ?> -->
	<?php wp_head(); ?>
	<script>
		base_url = "<?php base_url() ?>";
	</script>
</head>
<body>
<?php $menu = wp_get_nav_menu_items('primary');
					print_r($menu); ?>

<header class="section-div pad-und-sm <?php if ( is_front_page() ) echo 'abs'; ?>">
		<div class="row expanded">
		
			<div class="small-6 medium-3 columns header">
                <a href="<?php base_url() ?>"><img src="<?php res() ?>/img/logo-colonial.svg"></a>
			</div>
			
			<div class="hide-for-small-only medium-9  columns">
                <div class="small-12 columns">
	                <?php echo do_shortcode('[google-translator]'); ?>
                </div>
                <div class="small-12 columns">
                    <ul class="menu float-right">
		                <?php
		                $menu = wp_get_nav_menu_items('main');
		                foreach ($menu as $e) :
			                ?>
                            <li><a href="<?php echo $e->url ?>" class="hvr-underline-from-center"><?php echo $e->title ?></a></li>
		                <?php endforeach ?>
                    </ul>
                </div>
		    </div>
            <div class="small-6 columns show-for-small-only">
                <a href="#sidr" class="menu-mobile-trigger"><i class="fa fa-bars fa-inverse fa-2x float-right"></i></a>
            </div>

	</header>

<?php get_template_part('modal', 'syh'); ?>
