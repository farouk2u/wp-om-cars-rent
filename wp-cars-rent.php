<?php

/**
 * Plugin Name: Cars rental system
 * Plugin URI: http://www.farouk.pw/plugins/wordpress/cars-rent
 * Description: Easy to use and custom Cars rental system.
 * Version:  0.9
 * Author: f@rouk
 * Author URI: http://www.farouk.pw/
 */

// Plugin folder
define( 'WPCARSRENT_PLUGIN', __FILE__ );
define( 'WPCARSRENT_PLUGIN_DIR', dirname( __FILE__ ));
define( 'WPCARSRENT_PLUGIN_URL', plugin_dir_url( __FILE__ ));

// Post types
require_once( WPCARSRENT_PLUGIN_DIR . '/includes/car-post-type.php' );
require_once( WPCARSRENT_PLUGIN_DIR . '/includes/booking-post-type.php' );

// ShortCodes
require_once( WPCARSRENT_PLUGIN_DIR . '/includes/shortcodes.php' );


// Register css & js files 
function om_register_script() {

    // wp_register_script( 'custom_jquery', plugins_url('/js/custom-jquery.js', __FILE__), array('jquery'), '2.5.1' );
    wp_register_style( 'om_cars_main', WPCARSRENT_PLUGIN_URL . 'assets/css/style.css', false, '1.0.0', 'all');
    wp_enqueue_style('om_cars_main');

    
}


add_action('init', 'om_register_script');


/**
 * Adds the meta box stylesheet when appropriate
 */
function om_admin_styles(){
	
	wp_enqueue_style( 'om_cars_admin', WPCARSRENT_PLUGIN_URL . 'assets/css/admin.css' );
	
}

add_action( 'admin_print_styles', 'om_admin_styles' );

if ( is_admin() ) {
  // require_once( WPCARSRENT__PLUGIN_DIR . 'class.akismet-admin.php' );
  // add_action( 'init', array( 'Akismet_Admin', 'init' ) );
}
  

