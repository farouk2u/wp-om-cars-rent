<?php

// Create Bookings post type
add_action( 'init', 'create_booking_type' );
function create_booking_type() {

	register_post_type( 'om-booking',
		array(
		'labels' => array(
		'name'               => _x( 'Bookings', 'post type general name' ),
		'singular_name'      => _x( 'Booking', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Booking' ),
		'add_new_item'       => __( 'Add New Booking' ),
		'edit_item'          => __( 'Edit Booking' ),
		'new_item'           => __( 'New Booking' ),
		'all_items'          => __( 'All Bookings' ),
		'view_item'          => __( 'View Booking' ),
		'search_items'       => __( 'Search Bookings' ),
		'not_found'          => __( 'No Bookings found' ),
		'not_found_in_trash' => __( 'No Bookings found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Bookings',
		),

		'public' => true,
		'menu_icon'   => 'dashicons-calendar',
		'has_archive' => true,
		'hierarchical' => false,
		'supports'      => array( '' ),
		'rewrite' => array( 'slug' => 'Bookings' ),
		)
	);
}


/**
 * Car custom metaBoxes
 */
function om_add_booking_meta_boxes() {

	add_meta_box(
		'booking_details',
		__( 'Booking Details', 'om' ),
		'om_booking_box_content',
		'om-booking',
		'advanced',
		'high'
	);

}


// Car Price
add_action( 'add_meta_boxes', 'om_add_booking_meta_boxes' );

function om_booking_box_content( $post ) {

	wp_nonce_field( plugin_basename( __FILE__ ), 'om_booking_box_content_nonce' );
	$car_stored_meta = get_post_meta( $post->ID );

	?>

  <div class="car-specifications-box">


    <div class="form-group">

        <label class="form-label" for=""> Car</label>

         <select name="booking-car" id="booking-car"> 
            <?php

			  $args = array( 'post_type' => 'om-car' );
			  $cars = new WP_Query( $args );

			while ( $cars->have_posts() ) {

				  $cars->the_post();

				?>

				<option value="<?php  the_ID(); ?>" <?php if ( isset( $car_stored_meta['booking-car'] ) ) { selected( $car_stored_meta['booking-car'][0], get_the_ID() ); } ?> ><?php the_title(); ?></option> 

            <?php } ?> 

          </select>

    </div >


    <div class="form-group">
        <label class="form-label" for=""> Full Name </label>
        <input type="text" id="booking-fullname" name="booking-fullname"  value="<?php echo get_post_meta( $post->ID, 'booking-fullname', true ); ?>" />
    </div>

    <div class="form-group">
        <label class="form-label" for=""> E-mail </label>
        <input type="email" id="booking-email" name="booking-email" value="<?php echo get_post_meta( $post->ID, 'booking-email', true ); ?>" />
    </div>

     <div class="form-group">
        <label class="form-label" for=""> Phone </label>
        <input type="text" id="booking-phone" name="booking-phone" value="<?php echo get_post_meta( $post->ID, 'booking-phone', true ); ?>" />
    </div>


    <div class="form-group">
        <label class="form-label" for=""> Date </label>
        <input type="date" id="booking-date" name="booking-date" value="<?php echo get_post_meta( $post->ID, 'booking-date', true ); ?>" />
    </div>

    <div class="form-group">
        <label class="form-label" for=""> Number of days </label>
        <input type="number" id="booking-days" name="booking-days" value="<?php echo get_post_meta( $post->ID, 'booking-days', true ); ?>" />
    </div>


    <div class="form-group">
        <label class="form-label" for=""> Message </label>
        <textarea  id="booking-message" name="booking-message"><?php echo get_post_meta( $post->ID, 'booking-message', true ); ?></textarea>
    </div>

  </div>

<?php
}
function om_booking_meta_box_save( $post_id ) {

	// Checks save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST['booking_nonce'] ) && wp_verify_nonce( $_POST['booking_nonce'], basename( __FILE__ ) ) ) ? 'true' : 'false';

	// Exits script depending on save status
	if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {

		return;
	}

	// Checks for input and sanitizes/saves if needed
	if ( isset( $_POST['booking-fullname'] ) ) {

		update_post_meta( $post_id, 'booking-fullname', sanitize_text_field( $_POST['booking-fullname'] ) );
	}

	if ( isset( $_POST['booking-email'] ) ) {

		update_post_meta( $post_id, 'booking-email', sanitize_text_field( $_POST['booking-email'] ) );
	}

	if ( isset( $_POST['booking-phone'] ) ) {

		update_post_meta( $post_id, 'booking-phone', sanitize_text_field( $_POST['booking-phone'] ) );
	}

	if ( isset( $_POST['booking-date'] ) ) {

		update_post_meta( $post_id, 'booking-date', sanitize_text_field( $_POST['booking-date'] ) );
	}

	if ( isset( $_POST['booking-days'] ) ) {

		update_post_meta( $post_id, 'booking-days', sanitize_text_field( $_POST['booking-days'] ) );
	}

	if ( isset( $_POST['booking-message'] ) ) {

		update_post_meta( $post_id, 'booking-message', sanitize_text_field( $_POST['booking-message'] ) );

	}

	if ( isset( $_POST['booking-car'] ) ) {

		update_post_meta( $post_id, 'booking-car', sanitize_text_field( $_POST['booking-car'] ) );

	}

}



	add_action( 'save_post', 'om_booking_meta_box_save' );

