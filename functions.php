<?php
include('mandrill/Mandrill.php');
global $MANDRILL_API_KEY;
$MANDRILL_API_KEY = 'lFwDXkU9JM-pHtBjKKUV9g';

// add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

function PREFIX_remove_scripts() {
	wp_dequeue_style( 'parent-style' );
	wp_deregister_style( 'parent-style' );

    // wp_dequeue_script( 'site' );
    // wp_deregister_script( 'site' );

    // Now register your styles and scripts here
}
add_action( 'wp_enqueue_scripts', 'PREFIX_remove_scripts', 20 );

if (!is_admin()) :

/* Style Zone */
	wp_enqueue_style('swiper',get_stylesheet_directory_uri() . "/css/swiper.min.css", array(), '', 'all');
	wp_enqueue_style('normalize',get_stylesheet_directory_uri() . "/css/normalize.css", array(), '', 'all');
	wp_enqueue_style('foundation',get_stylesheet_directory_uri() . "/css/foundation.min.css", array(), '', 'all');
	wp_enqueue_style('font-awesome',get_stylesheet_directory_uri() . "/css/font-awesome.min.css", array(), '', 'all');
	wp_enqueue_style('hover',get_stylesheet_directory_uri() . "/css/hover.css", array(), '', 'all');
	wp_enqueue_style('swal',get_stylesheet_directory_uri() . "/css/swal.css", array(), '', 'all');
	wp_enqueue_style('sidr',"https://cdn.jsdelivr.net/npm/sidr@2.2.1/dist/stylesheets/jquery.sidr.dark.min.css", array(), '', 'all');
	wp_enqueue_style('izimodal',get_stylesheet_directory_uri() . "/css/iziModal.min.css", array(), '', 'all');
	wp_enqueue_style('nice-select',get_stylesheet_directory_uri() . "/css/nice-select.css", array(), '', 'all');

/* Style Zone */

/* Script Zone */

	wp_deregister_script( 'jquery' );
	wp_enqueue_script('jquery', get_stylesheet_directory_uri() . '/js/jquery.min.js', array(), '', 'all' );
	wp_enqueue_script('swiper.jquery', get_stylesheet_directory_uri() . '/js/swiper.jquery.min.js', array(), '', 'all' );
	wp_enqueue_script('swiper', get_stylesheet_directory_uri() . '/js/swiper.min.js', array(), '', 'all' );
	wp_enqueue_script('foundation', get_stylesheet_directory_uri() . '/js/foundation.min.js', array(), '', 'all' );
	wp_enqueue_script('nice-select', get_stylesheet_directory_uri() . '/js/nice-select.min.js', array(), '', 'all' );
	wp_enqueue_script('skrollr', get_stylesheet_directory_uri() . '/js/skrollr.min.js', array(), '', 'all' );
	wp_enqueue_script('mandrill', get_stylesheet_directory_uri() . '/js/mandrill.js', array(), '', 'all' );
	wp_enqueue_script('swal', get_stylesheet_directory_uri() . '/js/swal.js', array(), '', 'all' );
	wp_enqueue_script('izimodal', get_stylesheet_directory_uri() . '/js/iziModal.min.js', array(), '', 'all' );
	wp_enqueue_script('SmoothScroll', get_stylesheet_directory_uri() . '/js/SmoothScroll.js', array(), '', 'all' );
	wp_enqueue_script('slideshowify', get_stylesheet_directory_uri() . '/js/slideshowify.min.js', array(), '', 'all' );
	wp_enqueue_script('transit', get_stylesheet_directory_uri() . '/js/transit.js', array(), '', 'all' );
	wp_enqueue_script('sidr',"https://cdn.jsdelivr.net/npm/sidr@2.2.1/dist/jquery.sidr.min.js", array(), '', 'all');
	wp_enqueue_script('script',get_stylesheet_directory_uri() . "/script.js", array(), '', 'all');

/* Script Zone */


endif; // !is_admin()


show_admin_bar(false);

function res() {
	echo get_stylesheet_directory_uri();
}

function base_url() {
	bloginfo('url');
}

function get_post_object_by_slug($slug, $post_type) {
	if ( $post = get_page_by_path( $slug, OBJECT, $post_type ) )
	    return $post;
	else
	    return 0;
}


/**
 * This function will be triggered every time a property is updated
 */


function subscribersNotification($post_ID, $post_after, $post_before){

	if ($post_before->post_type == "listing") {
		if (!empty($persons = get_field('persons', $post_before->ID))) {
			/*
			$persons[] = array(
				'name'	=> "Carlos Ruiz",
				'email'	=> 'carlos@iw.digital',
			);
			*/
			foreach ($persons as $p) {
				$mail_list = array(
					array(
						'email' => $p['email'],
						'name' => $p['name'],
						'type' => 'bcc'
					)
				);
				$template_content = array(
					array(
						'name' => 'name',
						'content' => $p['name']
					),
					array(
						'name' => 'button',
						'content' => '<a href="' . get_the_permalink($post_before) . '" class="button" style="font-size: 100%; font-family: "Avenir Next", "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; line-height: 1.65; color: white; text-decoration: none; display: inline-block; font-weight: bold; border-radius: 4px; background: #940404; margin: 0; padding: 0; border-color: #940404; border-style: solid; border-width: 10px 20px 8px;">See listing</a>'
					),
				);
				sendMsg("Listing updated", "no-reply@colonial-realestate.com", "Colonial Real Estate", "", $mail_list, "colonial_property_updated", $template_content);
			}
		}
	}
}

add_action( 'post_updated', 'subscribersNotification', 10, 3 ); //don't forget the last argument to allow all three arguments of the function


function notificationsent() {
	?>
	<div class="updated is-dismissible">
		<p>Notification sent to <?php echo $_GET['notificationsent'] ?> subscribers</p>
	</div>
	<?php
}

if (isset($_GET['notificationsent'])) add_action( 'admin_notices', 'notificationsent' );


function sendMsg($subject, $from_email, $from_name, $text, $mail_list, $template_name, $template_content) {
	global $MANDRILL_API_KEY;
	try {
		$mandrill = new Mandrill( $MANDRILL_API_KEY );
		$message  = array(
			'subject'    => $subject,
			'from_email' => $from_email,
			'from_name'  => $from_name,
			'to'         => $mail_list,
		);
		$async    = false;
		$ip_pool  = 'Main Pool';
		$send_at  = date( 'Y-m-d' );
		$result   = $mandrill->messages->sendTemplate( $template_name, $template_content, $message, $async, $ip_pool, $send_at );
		//print_r($result);

	} catch ( Mandrill_Error $e ) {
		// Mandrill errors are thrown as exceptions
		echo 'A mandrill error occurred: ' . get_class( $e ) . ' - ' . $e->getMessage();
		// A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
		throw $e;
	}
}

/**
 * Function that adds "Home Page" button to admin bar
 */

// add a link to the WP Toolbar
function custom_toolbar_link($wp_admin_bar) {
	$args = array(
		'id' => 'home',
		'title' => 'Featured properties',
		'href' => get_admin_url() . 'post.php?post=55&action=edit#postbox-container-2',
		'meta' => array(
			'class' => 'home',
			'title' => 'Edit Featured properties'
		)
	);
	$wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'custom_toolbar_link', 999);