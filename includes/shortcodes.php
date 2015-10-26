<?php 

// Car lists shortCode
add_shortcode('cars_list', 'cars_list');

function cars_list() {


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
				 		<li>1 Day : <b><?php echo $car_meta['car-price-1'][0] ; ?> €</b> </li>
				 		<li>3 Days : <b><?php echo $car_meta['car-price-3'][0] ; ?> €</b> </li>
				 		<li>7+ Days : <b><?php echo $car_meta['car-price-7'][0] ; ?> €</b> </li>
				 	</ul>
				 </div>
			  	 <div class="om-car-buttons">

				    	<a href="#?car=<?php the_ID() ; ?>" class="om-button"> Book now </a>
				    	
				   </div>
			</div>
		     

         </div>
        <?php
      }
    }

    else {
      echo 'Oh ohm no cars!';
    }

}


// Booking form shortCode
add_shortcode('cars_booking_form', 'booking_form');

function booking_form() {


	// 

	if ( isset( $_POST['book'] ) ) {
 
	  
	 
	}
?>
	<form action="" method="post">

		 <div class="car-specifications-box">


		      <div class="form-group">
		          <label class="form-label" for=""> Full Name </label>
		          <input type="text" id="booking-fullname" name="booking-fullname"  value="<?php // echo get_post_meta($post->ID, 'booking-fullname', true) ; ?>" />
		      </div>

		      <div class="form-group">
		          <label class="form-label" for=""> E-mail </label>
		          <input type="email" id="booking-email" name="booking-email" value="<?php // echo get_post_meta($post->ID, 'booking-email', true) ; ?>" />
		      </div>

		       <div class="form-group">
		          <label class="form-label" for=""> Phone </label>
		          <input type="text" id="booking-phone" name="booking-phone" value="<?php // echo get_post_meta($post->ID, 'booking-phone', true) ; ?>" />
		      </div>


		      <div class="form-group">
		          <label class="form-label" for=""> Date Start </label>
		          <input type="date" id="booking-date" name="booking-date" value="<?php // echo get_post_meta($post->ID, 'booking-date', true) ; ?>" />
		      </div>

		      <div class="form-group">
		          <label class="form-label" for=""> Number of days </label>
		          <input type="number" id="booking-days" name="booking-days" value="<?php // echo get_post_meta($post->ID, 'booking-days', true) ; ?>" />
		      </div>


		      <div class="form-group">
		          <label class="form-label" for=""> Message </label>
		          <textarea  id="booking-message" name="booking-message"><?php // echo get_post_meta($post->ID, 'booking-message', true) ; ?></textarea>
		      </div>

		    	<div class="form-group">
					 <?php wp_nonce_field( 'new-post' ); ?>
				</div>

				<button type="submit" name="book" value="book"><?php _e('Book Now', 'om-car') ?></button>

		     

		  </div>
	</form>

<?php 

}