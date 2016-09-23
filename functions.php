<?php
/**
* Theme functions and definitions
*
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
*/

/* THEME PATHS */
if ( !defined( 'ID_THEME_DIR' ) ){
    define('ID_THEME_DIR', ABSPATH . 'wp-content/themes/' . get_template());
}


/* Required external files
======================================================================================================================== */

	require_once( 'external/starkers-utilities.php' );


/*  Theme specific settings
======================================================================================================================== */

/* Set the content width based on the theme's design and stylesheet. */
	if ( ! isset( $content_width ) ) {
		$content_width = 1000; /* pixels */
	}

/* Enable support for Post Thumbnails on posts and pages. */
	add_theme_support('post-thumbnails');

/* This theme uses wp_nav_menu() in one location. */
	register_nav_menus(array('primary' => 'Primary Navigation'));

/* remove unnecessary classes from menu items. */
	function cleanname($v) {
		$v = preg_replace('/[^a-zA-Z0-9s]/', '', $v);
		$v = str_replace(' ', '-', $v);
		$v = strtolower($v);
		return $v;
	}

/* Reduce nav classes, leaving only 'current-menu-item' */
	function nav_class_filter( $var ) {
		return is_array($var) ? array_intersect($var, array('current-menu-item')) : '';
	}
	
	add_filter('nav_menu_css_class', 'nav_class_filter', 100, 1);

/* Add page slug as nav IDs */
	function nav_id_filter( $id, $item ) {
		return 'nav-'.cleanname($item->title);
	}
	add_filter( 'nav_menu_item_id', 'nav_id_filter', 10, 2 );

/* ACF Sitewide Fields section */
	if( function_exists('acf_add_options_page') ) {
	
		acf_add_options_page(array(
			'page_title' 	=> 'Sitewide Fields',
			'menu_title'	=> 'Sitewide Fields',
			'menu_slug' 	=> 'sitewide-fields',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));
	}

/* Actions and Filters
======================================================================================================================== */

add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );

add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );



/* Custom Post Types - include custom post types and taxonomies here
======================================================================================================================== */

	// require_once( 'custom-post-types/your-custom-post-type.php' );


/* Scripts
======================================================================================================================== */

/**
 * Add scripts via wp_head()
 *
 * @return void
 * @author Keir Whitaker
 */

function starkers_script_enqueuer() {
	
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"), false);
	wp_enqueue_script('jquery');
	
	wp_register_script( 'vendorsjs', get_template_directory_uri().'/assets/js/vendors.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'vendorsjs' );
	
	wp_register_script( 'customjs', get_template_directory_uri().'/assets/js/custom.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'customjs' );

}	

// Register Style
function custom_styles() {

	/* wp_register_style( 'normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css', false, false );
	wp_enqueue_style( 'normalize' );

	wp_register_style( 'skeleton', get_template_directory_uri().'/css/skeleton.css', array( 'normalize' ), false );
	wp_enqueue_style( 'skeleton' );
	
	wp_register_style( 'resnav', get_template_directory_uri().'/css/responsive-nav.css', array( 'screen' ), false );
	wp_enqueue_style( 'resnav' );
	
	*/
	wp_register_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', false, false );
	wp_enqueue_style( 'fontawesome' ); 

	wp_register_style( 'screen', get_template_directory_uri().'/style.min.css', array(), '1.0', 'all');
	wp_enqueue_style( 'screen' );

}
add_action( 'wp_enqueue_scripts', 'custom_styles' );


