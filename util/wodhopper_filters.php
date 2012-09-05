<?php
/*
	WODHOPPER filters.php. This is responsible for listing the functions that act or 
	modify upon the actions/hooks/filters available in word press. These functions
	tie into the normal word press loop and alter or filter the wodhopper specific
	components.
	Author: WODHOPPER
	Date:2012
*/


/*
	Function responsible for using the built in wordpress function to append the 
	wodhopper javascript into the head element of each page on the website.
*/
function introduce_wodhopper(){
	wp_enqueue_script('wodhopper', 'http://app.wodhopper.com/js/wodhopper.js');
}


/*
	Function responsible for intercepting the blog post in transition from the DB
	to the users display. This function checks the users settings and takes appropriate
	action to either pass through the content, or insert a wodhopper scoreboard properly
	configured based on user options.
//TODO: Coming soon - 
function filter_post_add_wodhopper_scoreboard($content) {
	//at this point we need to find and analyze the users settings and add in the 
	//scoreboard button into the appropriate location.
	$options = get_option('wodhopper_options');
	$buttonPlacement = $options['scoreboard_button_placement'];
	$postType = $options['scoreboard_post_type'];
	
	if($postType == $GLOBALS['post']->post_category){
		//TODO: Come back to here!
	}
	
	$content = 'WODHOPPER Insert' . $content;
    return $content;
}
*/

?>