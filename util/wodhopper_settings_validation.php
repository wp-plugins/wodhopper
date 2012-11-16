<?php
/*
	WODHOPPER settings validation. This is a utility page used for readability and 
	code file organization. This file contains all of the functions responsible for
	validating the settings fields for the WODHOPPER settings options page. This occurs
	when an admin user attempts to save/alter the settings.
	Author: WODHOPPER
	Date:2012
*/

/*
	Function callback from the settings 'GET' to validate the results. This validation 
	is getting called directly before a submission. Whatever array object is returned 
	from this function is what gets saved in the WODHOPPER wordpress options DB
*/
function wodhopper_options_validate($input){
	$options = get_option('wodhopper_options');
	
	//gather and validate the scoreboard_placement option
	$options['scoreboard_placement'] = 
				validateWodhopperScoreboardButtonPlacementSetting(
					trim($input['scoreboard_placement'])
				);
	
	//gather and validate the scoreboard_date_location option
	$options['scoreboard_date_location'] = 
				validateWodhopperScoreboardDateLocationSetting(
					trim($input['scoreboard_date_location'])
				);
	
	
	/* De-scoping the parse date from post title right now 
	//gather and validate the scoreboard_date_format option
	*$dateFormat = trim($input['scoreboard_date_format']);
	*if($dateFormat != ""){
	*	$options['scoreboard_date_format'] = 
	*		validateWodhopperScoreboardDateFormatSetting($dateFormat);
	*}
	*/
	
	//gather and validate the scoreboard_post_type option
	$options['scoreboard_post_type'] = 
				validateWodhopperScoreboardPostTypeSetting(
					trim($input['scoreboard_post_type'])
				);
				
	//gather and validate the scoreboard_auto_insert option
	$options['scoreboard_auto_insert'] = 
				validateWodhopperScoreboardAutoInsertSetting(
					trim($input['scoreboard_auto_insert'])
				);
	
	return $options;
}


/* 
	Function to validate the option setting of scoreboard button placement. Since its
	a select box, validation means assuring its only one of the available options.
*/
function validateWodhopperScoreboardButtonPlacementSetting( $scoreboardPlacement ){
	if(!$scoreboardPlacement == "begin_left" &&
		!$scoreboardPlacement == "begin_right" &&
		!$scoreboardPlacement == "end_left" &&
		!$scoreboardPlacement == "end_right"){
			$scoreboardPlacement = "begin_right";
	}
	return $scoreboardPlacement;
}


/*
	Function to validate the option setting of scoreboard date location. Since its
	a select box, validation means assuring its only one of the available options.
*/
function validateWodhopperScoreboardDateLocationSetting( $scoreboardDateLocation){
	if(!$scoreboardDateLocation == "date_from_posted_on" &&
		!$scoreboardDateLocation == "date_from_before_posted_on" &&
		!$scoreboardDateLocation == "date_from_after_posted_on"){
			$scoreboardDateLocation = "date_from_posted_on";
	}
	return $scoreboardDateLocation;
}

/*
	Function to validate the option setting of scoreboard date format. There is a decent
	amount of validation required here to allow for free form input, yet provide a 
	level of standardization. Should allow values ideally resembling:
		* MM.DD.YY	(shoreside,Dubuque)
		* M/DD/YYYY	(visone,Sonora)
		* MM/DD/YY (delta)
		* Lots of plain text dates, validation TBD.
*/
/*De scoping this function for right now
*function validateWodhopperScoreboardDateFormatSetting($dateFormat){
*	//TODO: Must validate using regex the date format, also check to see if its visible
*	return $dateFormat;
*}
*/

/*
	Function to validate the option setting of scoreboard date location. Since its
	a select box, validation means assuring its only one of the available options.
	In this case that means either 'all' or one of the categories from WP.
*/
function validateWodhopperScoreboardPostTypeSetting($scoreboardPostType){
	$isValid = false;
	if($scoreboardPostType == 'all'){$isValid = true;}
	else{
		$args=array(
			'orderby' => 'name',
			'order' => 'ASC',
			'hide_empty' => 0
		);
		$categories=get_categories($args);
		foreach($categories as $category){ 
			if($scoreboardPostType == $category->name){$isValid = true;break;}
		}
	}
	
	if($isValid != true){
		$scoreboardPostType = 'all';
	}
	
	return $scoreboardPostType;
}

/*
	Function to validate the checkbox value for the auto insert option. 
	Basically this must be a 1 or a 0.
*/
function validateWodhopperScoreboardAutoInsertSetting( $scoreboardAutoInsert ){
	if($scoreboardAutoInsert != 0 &&
		$scoreboardAutoInsert != 1){
			$scoreboardAutoInsert = 0;	
		}
	return $scoreboardAutoInsert;
}	
?>