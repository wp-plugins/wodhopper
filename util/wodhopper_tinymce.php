<?php
/*
	WODHOPPER tinymce.php. This is responsible for listing the functions that act or 
	modify the tinyMCE rich text HTML editor to allow wodhopper features to be manually inserted
	into a post or page.
	Author: WODHOPPER
	Date:2012
*/


/*
	Function responsible for registering the custom wodhopper buttons when the tinyMCE
	editor is initialized
*/
function wodhopper_add_tinymce_buttons() {
	// Don't bother doing this stuff if the current user lacks permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ){
		return;
	}
	
	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_wodhopper_tinymce_scoreboard_plugin");
		add_filter('mce_buttons', 'register_wodhopper_tinymce_scoreboard_button');
	}
}

/*
	Function to add the name of the button for the wodhopper manual scoreboard into 
	the array of potential tinyMCE editor buttons. This should already contain a large
	list of other standard and custom tinyMCE buttons (bold, italic, save, etc)
*/
function register_wodhopper_tinymce_scoreboard_button( $buttons ){
	array_push($buttons, "|", "wodhopperScoreboard");
	return $buttons;
}

/*
	Function to add the wodhopper_scoreboard_tinymce javascript file into the array
	for the correct functionality to be picked up by the tinyMCE editor
*/
function add_wodhopper_tinymce_scoreboard_plugin( $plugin_array ){
	$plugin_array['wodhopperScoreboard'] = WP_PLUGIN_URL.'/wodhopper/mce/wodhopper_scoreboard/editor_plugin.js';
	return $plugin_array;
}
?>