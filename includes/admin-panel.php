<?php 

	add_action('admin_menu', 'om_car_setup_menu');

	function om_car_setup_menu(){

		add_menu_page( 'Cars rental Settings', 'Cars rental Settings', 'manage_options', 'om-car-settings', 'om_car_page_render' );
	}

	function om_car_page_render(){

       


		?>

		<div class="wrap om-car-options-page">

			<h1>Cars rental Settings</h1>

			<form method="post" action="options.php">
		        <?php
		            settings_fields("section");
		            do_settings_sections("om-car-options");      
		            submit_button(); 
		        ?>          
		    </form>
			



		</div>	



		<?php
	}


	function display_currency_element()
	{
		?>
	    	<input type="text" name="om_car_currency" id="om_car_currency" value="<?php echo get_option('om_car_currency'); ?>" />
	    <?php
	}



    function display_booking_page_element()
	{
		?>

		 <select name="om_booking_page" id="om_booking_page"> 
            <?php 

               // Pages list
				$args = array('post_type' => 'page'); 
		        $pages = new WP_Query( $args );

            
              while( $pages->have_posts() ) {

                    $pages->the_post();

                  ?>

                  <option value="<?php  the_ID() ; ?>" <?php if ( isset ( $page_stored_meta['booking-car'] ) ) selected( $page_stored_meta['booking-car'][0], get_the_ID() ); ?> ><?php the_title(); ?></option> 

            <?php } ?> 

          </select>

	    <?php
	}

	
	function display_success_page_element()
	{
		?>

		<select name="om_success_page" id="om_success_page"> 
            <?php 

              // Pages list
				$args = array('post_type' => 'page'); 
		        $pages = new WP_Query( $args );

            
              while( $pages->have_posts() ) {

                    $pages->the_post();

                  ?>

                  <option value="<?php  the_ID() ; ?>" <?php if ( isset ( $page_stored_meta['booking-car'] ) ) selected( $page_stored_meta['booking-car'][0], get_the_ID() ); ?> ><?php the_title(); ?></option> 

            <?php } ?> 

          </select>

	    <?php
	}


	function display_success_email_element()
	{
		?>
			<textarea name="om_success_email" id="om_success_email" ><?php echo get_option('om_success_email'); ?></textarea>
	    	
	    <?php
	}



	function om_car_panel_fields()
	{
		add_settings_section("section", "All Settings", null, "om-car-options");
		
		add_settings_field("om_car_currency", "Currency symbol", "display_currency_element", "om-car-options", "section");
		add_settings_field("booking_page", "Boooking Page", "display_booking_page_element", "om-car-options", "section");
		add_settings_field("sucess_page", "Success Page", "display_success_page_element", "om-car-options", "section");
		add_settings_field("sucess_email", "Success Email", "display_success_email_element", "om-car-options", "section");


	    register_setting("section", "om_car_currency");
	    register_setting("section", "om_car_email");
	    register_setting("section", "om_booking_page");
	    register_setting("section", "om_success_page");
	    register_setting("section", "om_success_email");
	}

	add_action("admin_init", "om_car_panel_fields");

?> 
