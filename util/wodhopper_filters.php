<?php
/*
	WODHOPPER filters.php. This is responsible for listing the functions that act or 
	modify upon the actions/hooks/filters available in word press. These functions
	tie into the normal word press loop and alter or filter the wodhopper specific
	components.
	Author: WODHOPPER
	Date:2012
*/


//include the extras.php file for helper function access
include (dirname(__FILE__).'/wodhopper_extras.php');

/*
	Function responsible for using the built in wordpress function to append the 
	wodhopper javascript into the head element of each page on the website.
*/
function introduce_wodhopper(){
	wp_enqueue_script('wodhopper', 'http://app.wodhopper.com/js/wodhopper.js');
	wp_register_style( 'wodhopper-style', plugins_url( 'assets/css/wodhopper_scoreboard_styles.css', dirname(__FILE__) ), array(), '20120905', 'all' );
	wp_enqueue_style( 'wodhopper-style' );  
}


/*
	Function responsible for intercepting the blog post in transition to the DB
	This function checks the users settings and takes appropriate
	action to either pass through the content, or insert a wodhopper scoreboard properly
	configured based on user options.
*/
function save_post_add_wodhopper_scoreboard($data, $postarr) {
	$shouldAppend = false;
	$options = get_option('wodhopper_options');
	$buttonPlacement = $options['scoreboard_placement'];
	$placementValue = substr($buttonPlacement,strpos($buttonPlacement,"_")+1);
	$wodDateSelection = $options['scoreboard_date_location'];
	$postType = $options['scoreboard_post_type'];
	$autoPost = $options['scoreboard_auto_insert'];
	$categoryArray = get_the_category($postarr['ID']);
	
	if($autoPost == 1 && $data['post_type'] === 'post' ){
		if($postType == 'all'){
			$shouldAppend = true;
		}
		else{
			//check all the categories this post is tagged with for a match to the setting
			foreach ($categoryArray as $category){
				if($category->cat_name == $postType){
					$shouldAppend = true;
				}
			}
			unset($category);
		}
	}

	if($shouldAppend){
		//now we want to add a shortcode into the post only if there isnt one already
		if(strpos($data["post_content"],"wodhopper_scoreboard_button") === false){
			
			if($wodDateSelection === "date_from_posted_on"){
				$wodDate = mysql2date('m/d/Y', $data['post_date']);
			}
			else if($wodDateSelection === "date_from_before_posted_on"){
				$wodDate = date("m/d/Y",strtotime ('-1 day' , strtotime($data['post_date'])));
			}
			else if($wodDateSelection === "date_from_after_posted_on"){
				$wodDate = date("m/d/Y",strtotime ('+1 day' , strtotime($data['post_date'])));
			}
			else{
				$wodDate = mysql2date('m/d/Y', $data['post_date']);
	}
	
			$wodhopperButtonHtml = '[wodhopper_scoreboard_button '.
					'placement="'. $placementValue .
					'" wod_date="'. $wodDate .
					'"]';

			if(strpos($buttonPlacement,"begin") === false){
				$data["post_content"] .= '<br/><br/>' . $wodhopperButtonHtml;
			}
			else{
				$data["post_content"] = $wodhopperButtonHtml . '<br/>' . $data["post_content"];
			}
		}
}

	return $data;
}
?>