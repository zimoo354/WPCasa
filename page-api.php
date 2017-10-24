<?php

function cv() {
	$a = get_post($_GET['a']);
	?>
	<div class="single-agent agent-cv small-12 medium-10 medium-push-1 columns pad-und-md">
		<div class="small-4 columns">
			<div class="img" style="background-image: url(<?php echo get_the_post_thumbnail_url($a, 'large') ?>);"></div>
		</div>
		<div class="small-8 columns">
			<h6 id="name-cv"><?php echo get_the_title($a) ?></h6>
			<span id="role-cv" class="role"><?php the_field('role', $a) ?></span>
		</div>
		<div class="small-12 columns">
            <hr>
			<?php echo apply_filters('the_content', $a->post_content); ?>
		</div>
	</div>
	<?php
}

function register_person() {
    // http://colonial.hostiw.net/api?operation=rp&key=6&nombre=Carlos Ruiz&correo=zimoo354@gmail.com&telefono=4421234567
    $post_id = $_GET['key'];
	$row = array(
		'name'	=> $_GET['nombre'],
		'email'	=> $_GET['correo'],
		'phone'	=> $_GET['telefono']
	);

	if ($i = add_row('persons', $row, $post_id)) {
	    echo "success";
    } else {
	    echo "error";
    }
}

switch ($_GET['operation']) {
	case 'cv':
		cv();
		break;
	case 'rp':
		register_person();
		break;

	default:
		echo '<h1 style="text-align: center;margin-top: 25%;font-family: sans-serif;">Operación no reconocida. Contacte al equipo de soporte.</h1>';
		break;
}
