<?php
/*
Plugin Name: WODHOPPER
Plugin URI: http://wodhopper.com
Description: Allows WODHOPPER embedding,configuration and management from your WordPress admin blog.
Version: 1.0.6
Author: WODHOPPER
Author URI: http://wodhopper.com
License: GPL2
Copyright 2012  WODHOPPER  (email : aking@wodhopper.com)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//include the options.php page for use in the admin section only
include (dirname(__FILE__).'/util/wodhopper_options.php');

//include the wodhopper_filters.php page to add in the filters
include (dirname(__FILE__).'/util/wodhopper_filters.php');

//include the wodhopper_shortcodes.php page to add in the shortcode functions
include (dirname(__FILE__).'/util/wodhopper_shortcodes.php');

//include the wodhopper_tinymce.php page to add in the tinyMCE editor plugins
include (dirname(__FILE__).'/util/wodhopper_tinymce.php');


/*
	Register the action of adding in the WODHOPPER Javascript files to the wp_head function.
	This allows the side widget to be properly displayed on all pages (non-admin) within
	the site. From there the JS takes care of the rest.
*/
add_action('wp_head','introduce_wodhopper');


/*
	Register the filter to insert the wodhopper scoreboard button into the appropriate
	posts. Only register these actions based on the user settings (ie. if there enabled and set)
*/
$options = get_option('wodhopper_options');
if($options['scoreboard_auto_insert'] == 1){
	add_filter( 'wp_insert_post_data' , 'save_post_add_wodhopper_scoreboard' , '99', 2 );
}

/*
	Add and register the shortcode interpreters. These will act upon any wodhopper
	shortcodes in any post.
*/
add_shortcode( 'wodhopper_scoreboard_button', 'wodhopper_scoreboard_button_shortcode_func' );

/*
	Now register the tinyMCE plugin to allow manual placement of the wodhopper scoreboard
	button into a post using the rich HTML editor
*/
add_action('init', 'wodhopper_add_tinymce_buttons');
?>