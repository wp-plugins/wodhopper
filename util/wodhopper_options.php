<?php
/*
	WODHOPPER options page responsible for adding a sub-menu item in the Admin panel of 
	Wordpress Settings menu header. This page allows for the modification of the settings 
	required for WODHOPPER to properly identify some of the gym specific options such as
	the email addresses, and gym identifiers
	Author: WODHOPPER
	Date:2012
*/

if ( is_admin() ){ // admin actions
  //include the wodhopper_settings_fields.php and validation.php pages
  include (dirname(__FILE__).'/wodhopper_settings_fields.php');
  include (dirname(__FILE__).'/wodhopper_settings_validation.php');
  // create custom plugin settings menu
  add_action('admin_menu', 'wodhopper_create_menu');
  add_action('admin_init', 'wodhopper_admin_init');
}

/*
	Function used to add the actual sub-menu item of 'WODHOPPER' into the settings menu
*/
function wodhopper_create_menu() {
	add_options_page('WODHOPPER Plugin Settings', 'WODHOPPER', 'administrator', 
	'wodhopper', 'wodhopper_settings_page');
}

/*
	Function used to init the settings fields and sections for the wodhopper options page
*/
function wodhopper_admin_init() {
	register_setting( 'wodhopper_options', 'wodhopper_options', 'wodhopper_options_validate' );
	add_settings_section('wodhopper_settings_scoreboard', 'Scoreboard Settings', 
							'wodhopper_scoreboard_section_text', 'wodhopper');
	
	add_settings_field('wodhopper_scoreboard_auto_insert', 'Scoreboard Button Auto Insert', 
						'wodhopper_setting_scoreboard_auto_insert', 'wodhopper', 
						'wodhopper_settings_scoreboard');
	add_settings_field('wodhopper_scoreboard_location', 'Scoreboard Button Placement', 
						'wodhopper_setting_scoreboard_placement', 'wodhopper', 
						'wodhopper_settings_scoreboard');
	add_settings_field('wodhopper_scoreboard_date_location', 'Scoreboard Date Location', 
						'wodhopper_setting_scoreboard_date_location', 'wodhopper', 
						'wodhopper_settings_scoreboard');
	
	/* De-scoping the parse date from post title right now 
	*
	*$options = get_option('wodhopper_options');
	*$dateLocation = $options['scoreboard_date_location'];
	*if($dateLocation == "" || $dateLocation == "date_from_title"){
	*	add_settings_field('wodhopper_scoreboard_date_format', 'Post Title Date Format', 
	*						'wodhopper_setting_scoreboard_date_format', 'wodhopper', 
	*						'wodhopper_settings_scoreboard');
	*}
	*/
	add_settings_field('wodhopper_scoreboard_post_type', 'Scoreboard Post Type', 
						'wodhopper_setting_scoreboard_post_type', 'wodhopper', 
						'wodhopper_settings_scoreboard');
}

/*
	Function to generate the actual custom WODHOPPER html page that displays the settings
*/
function wodhopper_settings_page() {
?>
<div id="theme-options-wrap">
<div><img src="https://s3.amazonaws.com/app.wodhopper.com/images/wodhopper_wordpressBanner.png" style="width:650px;"></img></div>
<br/>
<div class="icon32" id="icon-options-general"></div>
<h2>WODHOPPER</h2>
<p>Take control of WOD<b>HOPPER</b>, override the default settings to customize WOD<b>HOPPER</b> for your site.</p>
<form method="post" action="options.php">
    <?php settings_fields( 'wodhopper_options' ); ?>
    <?php do_settings_sections( 'wodhopper' ); ?>
   <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
</form>
</div>
<?php } ?>