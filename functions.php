<?php

require get_theme_file_path('/inc/search-route.php');

function university_custom_rest() {
	register_rest_field('post', 'authorName', array(
		'get_callback'		=> function() { return get_the_author(); }
	));
}
add_action('rest_api_init', 'university_custom_rest');

// Banner Pic
function page_banner($args = NULL) {
	if (!$args['title']) {
		$args['title'] = get_the_title();
	}
	if (!$args['subtitle']) {
		$args['subtitle']	= get_field('page_banner_subtitle');
	}
	if (!$args['photo']) {
		if (get_field('page_banner_background_image')) {
			$args['photo'] = get_field('page_banner_background_image')['sizes']['page-banner'];
		} else {
			$args['photo'] = get_theme_file_uri('/images/ocean.jpg');
		}
	}
?>
	<div class="page-banner">
	 <div class="page-banner__bg-image" style="background-image: url(<?php //echo get_theme_file_uri('images/ocean.jpg'); ?><?php //$pageBannerImage = get_field('page_banner_background_image'); echo $pageBannerImage['sizes']['page-banner']; ?><?php echo $args['photo']; ?>"></div>
	 <div class="page-banner__content container container--narrow">
	 	<pre><?php //var_dump($pageBannerImage); ?></pre>
	   <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
	   <div class="page-banner__intro">
	     <p><?php echo $args['subtitle']; ?></p>
	   </div>
	 </div>
	</div>
<?php
}


function mmundial_files() {
	wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyCgujvjnSmzwf0npSZLw4Gz698VC5kPOPg', NULL, '1.0', true);
	wp_enqueue_script('site-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);
	wp_enqueue_script('app', get_theme_file_uri('/js/app.js'), array('jquery', 'masonry'), microtime(), true);
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Rokkitt:300,400,500|Titillium+Web:300,400,600');
	wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style('main-styles', get_stylesheet_uri(), NULL, microtime());
	//ANCIENT GOOGLE MAPS SCRIPT
	// wp_enqueue_script('pleiades17-googlemaps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDjEcnBmAHgm_LfegO9o84NLPAfBLwVjSY', array(), '20161130', true);
	// locate URL for JASON
	wp_localize_script('site-js', 'universityData', array(
		'root_url'			=> get_site_url()
	));
}
add_action('wp_enqueue_scripts', 'mmundial_files');


function mmundial_features() {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	// add_image_size('professor-landscape', 400, 260, array('left', 'top'));
	add_image_size('professor-landscape', 400, 260, true);
	add_image_size('professor-portrait', 480	, 650, true);
	add_image_size('page-banner', 1500, 350, true);
	add_image_size( 'blog-thumb', 800, 540, true);
	/*register_nav_menu('header-menu', 'Header Menu');
	register_nav_menu('footer-menu-one', 'Footer Menu One');
	register_nav_menu('footer-menu-two', 'Footer Menu Two');*/
}
add_action('after_setup_theme', 'mmundial_features');

// CUSTOM POST TYPE

function mmundial_cpts() {

	// MAGAZINES POST TYPE
	$labels = array(
		'name'							=> 'Magazines',
		'add_new_item'			=> 'Add New Magazine',
		'edit_item'					=> 'Edit Magazine',
		'all_items'					=> 'All Magazines',
		'singular_name'			=> 'Magazine'
	);
	$args = array(
		'capability_type'		=> 'page',
		'has_archive'				=> false,
		'hierarchical'			=> true,
		'supports'					=> array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
		'rewrite'						=> array('slug' => 'magazines'),
		'has_archive'				=> true,
		'public'						=> true,
		'menu_icon'					=> 'dashicons-grid-view',
		'labels'						=> $labels,
	);
	register_post_type('magazine', $args);

	// BOOKS POST TYPE
	$labels = array(
		'name'							=> 'Books',
		'add_new_item'			=> 'Add New Book',
		'edit_item'					=> 'Edit Book',
		'all_items'					=> 'All Books',
		'singular_name'			=> 'Book'
	);
	$args = array(
		'capability_type'		=> 'page',
		'has_archive'				=> true,
		'hierarchical'			=> true,
		'supports'					=> array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
		'rewrite'						=> array('slug' => 'book-collection'),
		'has_archive'				=> true,
		'public'						=> true,
		'menu_icon'					=> 'dashicons-book',
		'labels'						=> $labels,
	);
	register_post_type('book', $args);


	// ARCHIVES POST TYPE
	$labels = array(
		'name'							=> 'Archives',
		'add_new_item'			=> 'Add New Archive',
		'edit_item'					=> 'Edit Archive',
		'all_items'					=> 'All Archives',
		'singular_name'			=> 'Archive'
	);
	$args = array(
		'capability_type'		=> 'page',
		'has_archive'				=> false,
		'hierarchical'			=> true,
		'supports'					=> array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
		'rewrite'						=> array('slug' => 'archives'),
		'has_archive'				=> true,
		'public'						=> true,
		'menu_icon'					=> 'dashicons-archive',
		'labels'						=> $labels,
	);
	register_post_type('archive', $args);
}
add_action('init', 'mmundial_cpts');

function university_adjust_queries($query) {
	// Manipulating the Campus query
	if (!is_admin() && is_post_type_archive('campus') && $query->is_main_query()) {
		$query->set('posts_per_page', -1);
	}

	// Manipulating the Programs query
	if (!is_admin() && is_post_type_archive('program') && $query->is_main_query()) {
		$query->set('orderby', 'title');
		$query->set('order', 'ASC');
		$query->set('posts_per_page', -1);
	}

	// Manipulating the Events query
	if (!is_admin() && is_post_type_archive('event') && $query->is_main_query()) {
		$today = date('Ymd');
		$query->set('meta_key', 'event_date');
		$query->set('orderby', 'meta_value_num');
		$query->set('order', 'ASC');
		$query->set('meta_query', array(array(
                'key'             => 'event_date',
                'compare'         => '>=',
                'value'           => $today,
                'type'            => 'numeric'
              	)
            	));
	}
}
add_action('pre_get_posts', 'university_adjust_queries');

// Enabling Google Maps API

function universityMapKey($api) {
	$api['key'] = 'AIzaSyCgujvjnSmzwf0npSZLw4Gz698VC5kPOPg';
	// $api['key'] = 'AIzaSyDjEcnBmAHgm_LfegO9o84NLPAfBLwVjSY';
	return $api;
}
add_filter('acf/fields/google_map/api', 'universityMapKey');

// Redirect subscriber accounts out of admin and onto homepage

function redirectSubsToFrontEnd() {
	$ourCurrentUser = wp_get_current_user();
	if (count($ourCurrentUser->roles) == 1 && $ourCurrentUser->roles[0] == 'subscriber') {
		wp_redirect(site_url('/'));
		exit;
	}
}
add_action('admin_init', 'redirectSubsToFrontEnd');

function noSubsAdminBar() {
	$ourCurrentUser = wp_get_current_user();
	if (count($ourCurrentUser->roles) == 1 && $ourCurrentUser->roles[0] == 'subscriber') {
		show_admin_bar(false);
	}
}
add_action('wp_loaded', 'noSubsAdminBar');

// Customize Login Screen (URL)
function ourHeaderUrl() {
	return esc_url(site_url('/'));
}
add_filter('login_headerurl', 'ourHeaderUrl');

function ourLoginCSS() {
	wp_enqueue_style('login-styles', get_stylesheet_uri(), NULL, microtime());
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}
add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginTitle() {
	return get_bloginfo('name');
}
add_filter('login_headertitle', 'ourLoginTitle');



