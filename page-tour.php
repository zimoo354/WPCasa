<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tour virtual</title>
	<?php wp_head() ?>
</head>
<body>
<?php if(!isset($_GET['prop'])): ?>
<script>
	window.close();
</script>
<?php endif ?>
<input type="hidden" id="tour-virtual" value="true">
<style>
    body, html {
        height:100vh !important;
    }
	.tour-virtual-slideshow {
		position: absolute;
		height:100%;
		width: 100%;
		top: 0;
		left: 0;
	}
	.loading-overlay {
		position: absolute;
		height:100%;
		width: 100%;
		top: 0;
		left: 0;
		z-index: 1000;
		background-color: white;
	}
	.loading-overlay .logo {
		display: block;
		margin: 100px auto 20px auto;
		height: 120px;
	}
	.loading-overlay .loader {
		display: block;
		margin: 0 auto;
		height: 80px;
	}
	.expand {
		height: 50px;
		width: 50px;
		background-color: black;
		border-radius: 50px;
		position: absolute;
		bottom: 10px;
		left: 10px;
	}
</style>
<div class="loading-overlay">
	<img src="<?php res() ?>/img/logo-colonial-wine.png" alt="Logo" class="logo">
	<img src="<?php res() ?>/img/loading.gif" alt="Logo" class="loader">
</div>
<?php
	$postid = $_GET['prop'];
	$img = get_the_post_thumbnail_url($postid, 'large');

?>
<div class="tour-virtual-slideshow">

	<img src="<?php echo $img; ?>" alt="Propiedad">
	<?php if (!empty(get_field('gallery', $postid))): $pics = get_field('gallery', $postid); ?>
	<?php foreach($pics as $pic): ?>
	<img src="<?php echo $pic['url']; ?>" alt="Propiedad">
	<?php endforeach ?>
	<?php endif ?>
	<button type=""button" onclick="toggleFullscreen()" class="expand"><i class="fa fa-expand fa-inverse"></i></button>
</div>
<audio id="song-1" src="<?php res() ?>/songs/song1.mp3"></audio>
<audio id="song-2" src="<?php res() ?>/songs/song2.mp3"></audio>
<audio id="song-3" src="<?php res() ?>/songs/song3.mp3"></audio>


</body>
<?php wp_footer() ?>
</html>