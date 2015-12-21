<?php 

// Car lists shortCode
add_shortcode('cars_list', 'cars_list');

function cars_list() {

	$currency = get_option('om_car_currency');
	$booking_page_url = get_permalink( get_option('om_booking_page') ) ;

	$args = array(
      'post_type' => 'om-car'
    );

    $cars = new WP_Query( $args );
    if( $cars->have_posts() ) {
      while( $cars->have_posts() ) {

        $cars->the_post();
        $car_meta = get_post_meta( get_the_ID() );

        ?>
		


        <div class="om-car-holder">

        	<div class="om-car-body">

        		<div class="om-car-thumb-wrapper">

					<?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail', 'class=om-car-img'); ?>
			  			
			  	</div>	
			  	<div class="om-car-content">

			  		<h3 class="om-car-title"><?php the_title() ?></h3>
			  		<div class="om-car-specifications">
						
			  			<ul class="om-car-specifications-list">
			  				<li><span class="icon-persons"></span> <?php echo $car_meta['number-persons'][0] ; ?>   </li>
			  				<li><span class="icon-bags"></span>  <?php echo $car_meta['number-bags'][0] ; ?> </li>
							<li><span class="icon-doors"></span> <?php echo $car_meta['number-doors'][0] ; ?> </li>
							<li><span class="icon-conditioner"></span> <?php echo $car_meta['air-conditioner'][0] ; ?> </li>
							<li><span class="icon-fuel"></span> <?php echo $car_meta['fuel-type'][0] ; ?></li>
							<li><span class="icon-transmission"></span> <?php echo $car_meta['transmission-type'][0] ; ?>  </li>
			  			</ul>

			  		</div>

					<div class='om-car-extract'>

				    	<?php the_excerpt() ?>

				    </div>

			  </div>
				<div class="om-clearfix"></div>
        	</div>

			<div class="om-car-footer">

				 <div class="om-car-prices">
				 	<ul class="car-prices-list">
				 		<li>1 Day : <b><?php echo $car_meta['car-price-1'][0] . " ". $currency ; ?> </b> </li>
				 		<li>3 Days : <b><?php echo $car_meta['car-price-3'][0] . " ". $currency ; ?> </b> </li>
				 		<li>7+ Days : <b><?php echo $car_meta['car-price-7'][0] . " ". $currency ; ?> </b> </li>
				 	</ul>
				 </div>
			  	 <div class="om-car-buttons">

				    	<a href="<?php echo $booking_page_url ; ?>?car=<?php the_ID() ; ?>" class="om-button"> Book now </a>
				    	
				   </div>
			</div>
		     

         </div>
        <?php
      }
    }

    else {

      echo 'Oh oh no cars!';

    }

}


// Booking form shortCode
add_shortcode('cars_booking_form', 'booking_form');

function booking_form() {


	// saving booking item and sending email
	if (  $_POST['book_front'] && isset( $_POST['booking_nonce_field'] ) && wp_verify_nonce( $_POST['booking_nonce_field'], 'booking_nonce' ) ) {


		$post_information = array(

	        'post_title' => wp_strip_all_tags( $_POST['booking-fullname'] ),
	        'post_type' => 'om-booking',
	        'post_status' => 'publish'
	    );
	

	    $post_id = wp_insert_post($post_information);

	    // if item is inseted correctely 
		if($post_id)
		{

			// Update Custom Meta
			update_post_meta( $post->ID, 'booking-car', sanitize_text_field( $_POST['booking-car'] ) );
			update_post_meta( $post->ID, 'booking-fullname', sanitize_text_field( $_POST['booking-fullname'] ) );
			update_post_meta( $post->ID, 'booking-email', sanitize_text_field( $_POST['booking-email'] ) );
			update_post_meta( $post->ID, 'booking-phone', sanitize_text_field( $_POST['booking-phone'] ) );
			update_post_meta( $post->ID, 'booking-date', sanitize_text_field( $_POST['booking-date'] ) );
			update_post_meta( $post->ID, 'booking-days', sanitize_text_field( $_POST['booking-days'] ) );
			update_post_meta( $post->ID, 'booking-message', sanitize_text_field( $_POST['booking-message'] ) );


			// Sending email to notify the user
			$to = $_POST['booking-email'] ;

			$subject = 'Booking | ' . get_bloginfo('name') ;

			$body = get_option('om_success_email');;

			$headers = array('Content-Type: text/html; charset=UTF-8');

			wp_mail( $to, $subject, $body, $headers );



			// Sending email to notify the admin
			$to = get_option( 'admin_email' ) ;
			$subject = 'New booked item | ' . get_bloginfo('name') ;
			$body = 'A new booked item';
			$headers = array('Content-Type: text/html; charset=UTF-8');

			wp_mail( $to, $subject, $body, $headers );


	
			// wp_redirect( home_url('/thank-you/') ); exit; 


			
		}

         

	 
	}

?>
	<form action="" method="post">

		 <div class="car-specifications-box">



		 	 <div class="form-group">

		        <label class="form-label" for=""> Car</label>

		         <select name="booking-car" id="booking-car"> 
		            <?php 

		              $args = array('post_type' => 'om-car'); 
		              $cars = new WP_Query( $args );

		              while( $cars->have_posts() ) {

		                    $cars->the_post();

		                  ?>

		                  <option value="<?php  the_ID() ; ?>" <?php if ( isset ( $car_stored_meta['booking-car'] ) ) selected( $car_stored_meta['booking-car'][0], get_the_ID() ); ?> ><?php the_title(); ?></option> 

		            <?php } ?> 

		          </select>

		    </div >


		      <div class="form-group">
		          <label class="form-label" for=""> Full Name * </label>
		          <input type="text" id="booking-fullname" name="booking-fullname"  required/>
		      </div>

		      <div class="form-group">
		          <label class="form-label" for=""> E-mail * </label>
		          <input type="email" id="booking-email" name="booking-email" required />
		      </div>

		       <div class="form-group">
		          <label class="form-label" for=""> Phone </label>
		          <input type="text" id="booking-phone" name="booking-phone"  />
		      </div>


		      <div class="form-group">
		          <label class="form-label" for=""> Date * </label>
		          <input type="date" id="booking-date" name="booking-date"  required />
		      </div>

		      <div class="form-group">
		          <label class="form-label" for=""> Number of days * </label>
		          <input type="number" id="booking-days" name="booking-days" required />
		      </div>


		      <div class="form-group">
		          <label class="form-label" for=""> Message </label>
		          <textarea  id="booking-message" name="booking-message"><?php // echo get_post_meta($post->ID, 'booking-message', true) ; ?></textarea>
		      </div>

		    	<div class="form-group">
					 <?php wp_nonce_field( 'booking_nonce', 'booking_nonce_field' ); ?>
				</div>

				<button type="submit" name="book_front" value="book"><?php _e('Book Now', 'om-car') ?></button>

		     

		  </div>
	</form>

<?php 

}