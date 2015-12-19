<?php 

// Create cars post type 
add_action( 'init', 'create_cartype' );
function create_cartype() {

  register_post_type( 'om-car',
    array(
      'labels' => array(
      'name'               => _x( 'Cars', 'post type general name' ),
	    'singular_name'      => _x( 'Car', 'post type singular name' ),
	    'add_new'            => _x( 'Add New', 'car' ),
	    'add_new_item'       => __( 'Add New Car' ),
	    'edit_item'          => __( 'Edit Car' ),
	    'new_item'           => __( 'New Car' ),
	    'all_items'          => __( 'All Cars' ),
	    'view_item'          => __( 'View Car' ),
	    'search_items'       => __( 'Search Cars' ),
	    'not_found'          => __( 'No Cars found' ),
	    'not_found_in_trash' => __( 'No Cars found in the Trash' ), 
	    'parent_item_colon'  => '',
	    'menu_name'          => 'Cars'
      ),

      'public' => true,
      'menu_icon'   => WPCARSRENT_PLUGIN_URL . 'assets/images/car-small-icon.png',
      'has_archive' => true,
      'hierarchical' => true,
      'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt'),
      'rewrite' => array('slug' => 'cars'),
    )
  );
}

// Add cars categories taxonomy
function om_cars_categories() {
  $labels = array(
    'name'              => _x( 'Cars Categories', 'taxonomy general name' ),
    'singular_name'     => _x( 'Cars Category', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Cars Categories' ),
    'all_items'         => __( 'All Cars Categories' ),
    'parent_item'       => __( 'Parent Cars Category' ),
    'parent_item_colon' => __( 'Parent Cars Category:' ),
    'edit_item'         => __( 'Edit Cars Category' ), 
    'update_item'       => __( 'Update Cars Category' ),
    'add_new_item'      => __( 'Add New Cars Category' ),
    'new_item_name'     => __( 'New Cars Category' ),
    'menu_name'         => __( 'Cars Categories' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'cars_category', 'om-car', $args );
}
add_action( 'init', 'om_cars_categories', 0 );


// Add cars features taxonomy
function om_cars_features() {
  $labels = array(
    'name'              => _x( 'Cars Features', 'taxonomy general name' ),
    'singular_name'     => _x( 'Cars Feature', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Cars Features' ),
    'all_items'         => __( 'All Cars Features' ),
    'parent_item'       => __( 'Parent Cars Feature' ),
    'parent_item_colon' => __( 'Parent Cars Feature:' ),
    'edit_item'         => __( 'Edit Cars Feature' ), 
    'update_item'       => __( 'Update Cars Feature' ),
    'add_new_item'      => __( 'Add New Cars Feature' ),
    'new_item_name'     => __( 'New Cars Feature' ),
    'menu_name'         => __( 'Cars Features' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'cars_feature', 'om-car', $args );
}

add_action( 'init', 'om_cars_features', 0 );



// Car custom metaBoxes 

function om_add_car_meta_boxes() {


    add_meta_box( 

        'car_price',
        __( 'Car Price', 'om' ),
        'car_price_box_content',
        'om-car',
        'advanced',
        'high'

    );


    add_meta_box( 

        'car_specifications',
        __( 'Car Specifications', 'om' ),
        'car_specifications_box_content',
        'om-car',
        'advanced',
        'high'

    );
    
    

}


// Car Price
add_action( 'add_meta_boxes', 'om_add_car_meta_boxes' );




function car_price_box_content( $post ) {

  wp_nonce_field( plugin_basename( __FILE__ ), 'car_price_box_content_nonce' );
  ?>

  <div class="car-specifications-box">

    <div class="form-group">
        <label class="form-label" for=""> Price for 1 Day </label>
        <input type="text" id="car-price-1" name="car-price-1" placeholder="Enter a price" value="<?php echo get_post_meta($post->ID, 'car-price-1', true) ; ?>" /> Per Day
    </div>

    <div class="form-group">
        <label class="form-label" for=""> Price for 3 Days </label>
        <input type="text" id="car-price-3" name="car-price-3" placeholder="Enter a price" value="<?php echo get_post_meta($post->ID, 'car-price-3', true) ; ?>" /> Per Day
    </div>

     <div class="form-group">
        <label class="form-label" for=""> Price for 7+ Days </label>
        <input type="text" id="car-price-7" name="car-price-7" placeholder="Enter a price" value="<?php echo get_post_meta($post->ID, 'car-price-7', true) ; ?>" /> Per Day
    </div>

  </div>

  
<?php 
}

function car_specifications_box_content( $post ) {

  wp_nonce_field( plugin_basename( __FILE__ ), 'car_specifications_box_content_nonce' );
  $car_stored_meta = get_post_meta( $post->ID );

?>

<div class="car-specifications-box">

    <div class="form-group">
        <label class="form-label" for=""> Number of persons </label>
        <input class="form-controll" type="number" id="number-persons" name="number-persons" placeholder="Enter a number" value="<?php echo get_post_meta($post->ID, 'number-persons', true)  ?>" />
    </div>


    <div class="form-group">
        <label class="form-label" for=""> Number of Bags </label>
        <input class="form-controll" type="number" id="number-bags" name="number-bags" placeholder="Enter a number" value="<?php echo get_post_meta($post->ID, 'number-bags', true);  ?>" />
    </div>

    <div class="form-group">
        <label class="form-label" for=""> Number of Doors </label>
        <input class="form-controll" type="number" id="number-doors" name="number-doors" placeholder="Enter a number" value="<?php echo get_post_meta($post->ID, 'number-doors', true)  ?>" />
    </div>

    <div class="form-group">
        <label class="form-label" for=""> Air conditioner </label>
        <!-- <input class="form-controll" type="text" id="air-conditioner" name="air-conditioner" placeholder="Enter a number" value="" /> -->
        <div class="prfx-row-content">
          <label for="air-conditioner-one">
            <input type="radio" name="air-conditioner" id="air-conditioner-one" value="Yes" <?php if ( isset ( $car_stored_meta['air-conditioner'] ) ) checked( $car_stored_meta['air-conditioner'][0], 'Yes' ); ?>>
            <?php _e( 'Yes', 'om-car' )?>
          </label>
          <label for="air-conditioner-two">
            <input type="radio" name="air-conditioner" id="air-conditioner-two" value="No" <?php if ( isset ( $car_stored_meta['air-conditioner'] ) ) checked( $car_stored_meta['air-conditioner'][0], 'No' ); ?>>
            <?php _e( 'No', 'om-car' )?>
          </label>
      </div>
    </div>


    <div class="form-group">
        <label class="form-label" for=""> Fuel Type </label>
        <select name="fuel-type" id="fuel-type">

          <option value="<?php _e( 'Petrol', 'om-car' )?>" <?php if ( isset ( $car_stored_meta['fuel-type'] ) ) selected( $car_stored_meta['fuel-type'][0], 'Petrol' ); ?>><?php _e( 'Petrol', 'om-car' )?></option>';
          <option value="<?php _e( 'Diesel', 'om-car' )?>" <?php if ( isset ( $car_stored_meta['fuel-type'] ) ) selected( $car_stored_meta['fuel-type'][0], 'Diesel' ); ?>><?php _e( 'Diesel', 'om-car' )?></option>';
      </select>
    </div>


    <div class="form-group">
        <label class="form-label" for=""> Transmission  Type </label>
        <select name="transmission-type" id="transmission-type">
          <option value="<?php _e( 'Manual', 'om-car' )?>" <?php if ( isset ( $car_stored_meta['transmission-type'] ) ) selected( $car_stored_meta['transmission-type'][0], 'Manual' ); ?>><?php _e( 'Manual', 'om-car' )?></option>';
          <option value="<?php _e( 'Automatic', 'om-car' )?>" <?php if ( isset ( $car_stored_meta['transmission-type'] ) ) selected( $car_stored_meta['transmission-type'][0], 'Automatic' ); ?>><?php _e( 'Automatic', 'om-car' )?></option>';
      </select>
    </div>

</div> <!-- /.car-specifications-box -->

<?php 

}

// Save car Metas 

function car_meta_box_save( $post_id ) {

    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'car_nonce' ] ) && wp_verify_nonce( $_POST[ 'car_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';



 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {

        return;
    }
 
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'car-price-1' ] ) ) {

        update_post_meta( $post_id, 'car-price-1', sanitize_text_field( $_POST[ 'car-price-1' ] ) );
    }

    if( isset( $_POST[ 'car-price-3' ] ) ) {

        update_post_meta( $post_id, 'car-price-3', sanitize_text_field( $_POST[ 'car-price-3' ] ) );
    }

    if( isset( $_POST[ 'car-price-7' ] ) ) {

        update_post_meta( $post_id, 'car-price-7', sanitize_text_field( $_POST[ 'car-price-7' ] ) );
    }


    if( isset( $_POST[ 'number-persons' ] ) ) {

        update_post_meta( $post_id, 'number-persons', sanitize_text_field( $_POST[ 'number-persons' ] ) );
    }


    if( isset( $_POST[ 'number-bags' ] ) ) {

        update_post_meta( $post_id, 'number-bags', sanitize_text_field( $_POST[ 'number-bags' ] ) );
    }


    if( isset( $_POST[ 'number-doors' ] ) ) {

        update_post_meta( $post_id, 'number-doors', sanitize_text_field( $_POST[ 'number-doors' ] ) );
    }


    if( isset( $_POST[ 'air-conditioner' ] ) ) {
        update_post_meta( $post_id, 'air-conditioner', sanitize_text_field($_POST[ 'air-conditioner' ]) );
    }


    if( isset( $_POST[ 'fuel-type' ] ) ) {

        update_post_meta( $post_id, 'fuel-type', sanitize_text_field( $_POST[ 'fuel-type' ] ) );
    }


    if( isset( $_POST[ 'transmission-type' ] ) ) {

        update_post_meta( $post_id, 'transmission-type', sanitize_text_field( $_POST[ 'transmission-type' ] ) );
    }



}

add_action( 'save_post', 'car_meta_box_save' );