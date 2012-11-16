<?php
/*
	WODHOPPER extras.php. This is responsible for listing the functions that act or 
	modify upon the filters or hooks of the wodhopper plugin. These functions
	are wodhopper specific functions that assist in the plugins functionality.
	Author: WODHOPPER
	Date:2012
*/


/*
	Function to construct the appropriate HTML for the scoreboard button to be embedded
*/
function buildScoreboardButton( $location ){
	//parse the location string to get the placement and alignment
	$explodedLocation = explode("_",$location);
	$leftOrRight = $explodedLocation[1];
	
	//now get the date for the ability to open the scoreboard to a certain date
	$dateToOpenScoreboard = getScoreboardBornOnDate();
	
	//now build the HTML
	$scoreboardHtml = '<span class="wodhopper_scoreboard_one scoreboard_button_' . $leftOrRight
					 . '" onclick="WODHOPPER_PLUGIN.showLeaderboardOnDate(\'' . $dateToOpenScoreboard 
					 . '\');"></span>';
	
	return $scoreboardHtml;
	
}

/*
	Function to gather the correct date to open the scoreboard to. This is based on the 
	users settings in the wodhopper settings page. This should be either the post date,
	the day before, or the day after. 
	This is cleverly named to resemble a beers born on date ;)
*/
function getScoreboardBornOnDate(){
	$options = get_option('wodhopper_options');
	$dateLocation = $options['scoreboard_date_location'];
	$scoreboardBornOnDate = "MM/DD/YYYY";

	if($dateLocation === "date_from_posted_on"){
		$scoreboardBornOnDate = the_date('m/d/Y');
	}
	else if($dateLocation === "date_from_before_posted_on"){
		$theCurDate = the_date('m/d/Y','','',false);
		$theNewDate = strtotime ('-1 day' , strtotime($theCurDate));
		$scoreboardBornOnDate = $theNewDate;
	}
	else if($dateLocation === "date_from_after_posted_on"){
		$theCurDate = the_date('m/d/Y','','',false);
		$theNewDate = strtotime ('+1 day' , strtotime($theCurDate));
		$scoreboardBornOnDate = $theNewDate;
	}

	return $scoreboardBornOnDate;
}
?>