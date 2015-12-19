<?php

// Create Locations post type
add_action( 'init', 'create_location_type' );

/**
 * Create Location type function
 */
function create_location_type() {

	register_post_type( 'om-location',
		array(
		'labels' => array(
		'name'               => _x( 'Locations', 'post type general name' ),
	    'singular_name'      => _x( 'Location', 'post type singular name' ),
	    'add_new'            => _x( 'Add New', 'Location' ),
	    'add_new_item'       => __( 'Add New Location' ),
	    'edit_item'          => __( 'Edit Location' ),
	    'new_item'           => __( 'New Location' ),
	    'all_items'          => __( 'All Locations' ),
	    'view_item'          => __( 'View Location' ),
	    'search_items'       => __( 'Search Locations' ),
	    'not_found'          => __( 'No Locations found' ),
	    'not_found_in_trash' => __( 'No Locations found in the Trash' ),
	    'parent_item_colon'  => '',
	    'menu_name'          => 'Locations',
		),
		'public' => true,
		'menu_icon'   => 'dashicons-location-alt',
		'has_archive' => true,
		'hierarchical' => true,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'rewrite' => array( 'slug' => 'Locations' ),
		)
	);
}

