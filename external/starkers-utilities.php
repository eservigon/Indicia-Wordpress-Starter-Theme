<?php

/**
 * Starkers_Utilities
 *
 * Starkers Utilities Class v.1.1
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 *
 * We've included a number of helper functions that we use in every theme we produce.
 * The main one that is used in Starkers is Starkers_Utilities::add_slug_to_body_class(), this will add the page or post slug to the body class
 *
 */
 
 class Starkers_Utilities {

	/**
	 * Print a pre formatted array to the browser - very useful for debugging
	 *
	 * @param 	array
	 * @return 	void
	 * @author 	Keir Whitaker
	 **/
	public static function print_a( $a ) {
		print( '<pre>' );
		print_r( $a );
		print( '</pre>' );
	}

	/**
	 * Simple wrapper for native get_template_part()
	 * Allows you to pass in an array of parts and output them in your theme
	 * e.g. <?php get_template_parts(array('part-1', 'part-2')); ?>
	 *
	 * @param 	array 
	 * @return 	void
	 * @author 	Keir Whitaker
	 **/
	public static function get_template_parts( $parts = array() ) {
		foreach( $parts as $part ) {
			get_template_part( $part );
		};
	}

	/**
	 * Pass in a path and get back the page ID
	 * e.g. Starkers_Utilities::get_page_id_from_path('about/terms-and-conditions');
	 *
	 * @param 	string 
	 * @return 	integer
	 * @author 	Keir Whitaker
	 **/
	public static function get_page_id_from_path( $path ) {
		$page = get_page_by_path( $path );
		if( $page ) {
			return $page->ID;
		} else {
			return null;
		};
	}

	/**
	 * Append page slugs to the body class
	 * NB: Requires init via add_filter('body_class', 'add_slug_to_body_class');
	 *
	 * @param 	array 
	 * @return 	array
	 * @author 	Keir Whitaker
	 */
	public static function add_slug_to_body_class( $classes ) {
		global $post;
   
		if( is_page() ) {
			$classes[] = sanitize_html_class( $post->post_name );
		} elseif(is_singular()) {
			$classes[] = sanitize_html_class( $post->post_name );
		};

		return $classes;
	}

	/**
	 * Get the category id from a category name
	 *
	 * @param 	string 
	 * @return 	string
	 * @author 	Keir Whitaker
	 */
	public static function get_category_id( $cat_name ){
		$term = get_term_by( 'name', $cat_name, 'category' );
		return $term->term_id;
	}

} 


/* Removing Crap / Customizing Admin Dashboard
======================================================================================================================== */

// remove junk from head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

// remove all dashboard widgets
function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	unset($wp_meta_boxes['dashboard']['normal']['high']['dashboard_browser_nag']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );


// disable all feeds
function fb_disable_feed() {
	wp_die(__('<h1>Feed not available, please visit our <a href="'.get_bloginfo('url').'">Home Page</a>!</h1>'));
}
add_action('do_feed',      'fb_disable_feed', 1);
add_action('do_feed_rdf',  'fb_disable_feed', 1);
add_action('do_feed_rss',  'fb_disable_feed', 1);
add_action('do_feed_rss2', 'fb_disable_feed', 1);
add_action('do_feed_atom', 'fb_disable_feed', 1);

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );


// Clean up the admin sidebar navigation 
function remove_admin_menu_items() {
  $remove_menu_items = array(__('Comments'));
  global $menu;
  end ($menu);
  while (prev($menu)){
	$item = explode(' ',$menu[key($menu)][0]);
	if(in_array($item[0] != NULL?$item[0]:"" , $remove_menu_items)){
	  unset($menu[key($menu)]);}
	}
  }
add_action('admin_menu', 'remove_admin_menu_items');


// customize admin footer text
function custom_admin_footer() {
	echo 'Customized by <a href="http://indiciadesign.com">Indicia Design</a> | Powered by <a href="http://wordpress.org">Wordpress</a>';
} 
add_filter('admin_footer_text', 'custom_admin_footer');

// customize login screen
function custom_login() {
echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/custom-login.css" />';
}
add_action('login_head', 'custom_login');


?>
