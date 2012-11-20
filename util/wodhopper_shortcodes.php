<?php
/*
	WODHOPPER shortcodes.php. This is responsible for listing the functions that act or 
	modify upon the shortcodes from wodhopper.
	Author: WODHOPPER
	Date:2012
*/


/*
	Function responsible for intercepting the shortcode 'wodhopper_scoreboard_button'
	and replacing it with a formatted HTML button.
*/
function wodhopper_scoreboard_button_shortcode_func( $attrs ) {
	extract(shortcode_atts(array(
		'placement' => 'inline',
		'wod_date' => 'mm/dd/yyyy'
	), $attrs));

	//gather the correct values from the saved shortcode
	$classFromShortcode = $placement;
	$wodhopperScoreboardButtonClass = "wodhopper_scoreboard whsb_" . $classFromShortcode;

	$wodhopperScoreboardButtonHtml = '<button class="' . 
					$wodhopperScoreboardButtonClass . 
					'" onclick="WODHOPPER_PLUGIN.showLeaderboardOnDate(\'' . $wod_date . '\')"'.
					'>Scoreboard</button>';

	return $wodhopperScoreboardButtonHtml;
}
?>