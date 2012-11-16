<?php
/*
	WODHOPPER settings fields page. This is a utility page used for readability and 
	code file organization. This file contains all of the functions responsible for
	generating the settings fields for the WODHOPPER settings options page.
	Author: WODHOPPER
	Date:2012
*/

/*Function to place the header text for the scoreboard section of WODHOPPER settings*/
function wodhopper_scoreboard_section_text(){
	echo '<p>Modify these settings to adjust how the daily scoreboard button gathers ';
	echo 'information from your post and how it is displayed.</p><p>If you are unsure of these ';
	echo 'what to choose or what these options do, feel free to <a href="http://wodhopper.com/?page_id=24" ';
	echo 'target="_blank">contact our tech support</a>.</p>';
}

/*
	Function to render the scoreboard_button_auto_insert option. This is a radio button
	that determines whether or not to display automatically or not a scoreboard button
	into the post.
*/
function wodhopper_setting_scoreboard_auto_insert(){
	$options = get_option('wodhopper_options');
	$optionValue = $options['scoreboard_auto_insert'];
	echo '<input type="checkbox" id="wodhopper_scoreboard_auto_insert"'.
					'name="wodhopper_options[scoreboard_auto_insert]"  value="1"'.
					checked(1,$optionValue,false) .
					'/>';
	echo '<label for="wodhopper_scoreboard_auto_insert">'.
					' Enable auto insert of the scoreboard button</label>';
	echo "<br/><p><b>NOTE: If this is disabled, the options below have no effect.</b></p>";
}

/*
	Function to generate the actual HTML text for the scoreboard button. This will
	get the placement of the scoreboard button according to the gym setting.
	By Default this is placed at the beginning of the post, float-ing to the right.
	Choices are:
		- At the beginning of the post, float right (begin_right) (Default)
		- At the beginning of the post, float left (begin_left)
		- At the end of the post, float right (end_right)
		- At the end of the post, float left (end_left)
*/
function wodhopper_setting_scoreboard_placement(){
	$options = get_option('wodhopper_options');
	$optionValue = $options['scoreboard_placement'];
    echo "<select id='wodhopper_scoreboard_placement' name='wodhopper_options[scoreboard_placement]'>";
    
    echo '<option value="begin_right"' .selected($optionValue, "begin_right"). 
    	 '>At the beginning of the post, float right (Default)</option>';
    
    echo '<option value="begin_left"' .selected($optionValue, "begin_left"). 
    	 '>At the beginning of the post, float left</option>';
    
    echo '<option value="end_right"' .selected($optionValue, "end_right"). 
    	 '>At the end of the post, float right</option>';
    
    echo '<option value="end_left"' .selected($optionValue, "end_left"). 
    	 '>At the end of the post, float left</option>';
    
    echo "</select>";
}

/*
	Function to generate the select HTML options for the scoreboard date location. 
	This will allow the admin to select the location and format of the date to use.
	Options are:
		- Select Date From Title (date_from_title)... this should activate the format field
		- Use the 'Posted On' Date (date_from_posted_on)
		- Use One Day Before The 'Posted On' Date (date_from_before_posted_on)
		- Use One Day After The 'Posted On' Date (date_from_after_posted_on)
*/
function wodhopper_setting_scoreboard_date_location(){
	$options = get_option('wodhopper_options');
	$optionValue = $options['scoreboard_date_location'];
    echo "<select id='wodhopper_scoreboard_date_location' name='wodhopper_options[scoreboard_date_location]'>";
    
    /* De-scoping the parse date from post title right now 
    *echo '<option value="date_from_title"' . selected($optionValue,"date_from_title") .
    *	 '>Select Date From The Title (Default)</option>';
    */
    
    echo '<option value="date_from_posted_on"' . 
    	 selected($optionValue,"date_from_posted_on") .
    	 '>Use the \'Posted On\' Date (Default)</option>';
    	 
	 echo '<option value="date_from_before_posted_on"' . 
	 	 selected($optionValue,"date_from_before_posted_on") .
    	 '>Use One Day Before The \'Posted On\' Date</option>';
    
    echo '<option value="date_from_after_posted_on"' . 
	 	 selected($optionValue,"date_from_after_posted_on") .
    	 '>Use One Day After The \'Posted On\' Date</option>';
    	 
	echo "</select>";
}

/*
	Function to generate the HTML needed to display the date format input field.
	This should only appear or be focusable if the date_location setting is 'in the title'
	The date format input is a free text input field. A decent level of validation is
	necessary for this input. Image all the various field separators....
*/
/* De-scoping the parse date from post title right now 
*function wodhopper_setting_scoreboard_date_format(){
*	$options = get_option('wodhopper_options');
*	$currentFormat = $options['scoreboard_date_format'];
*	
*	if($currentFormat == ""){
*		$currentFormat = "mm.dd.yy";
*	}
*   
*    echo "<input id='wodhopper_scoreboard_date_format' ";
*    echo "name='wodhopper_options[scoreboard_date_format]' size='15' type='text' ";
*    echo "value='{$currentFormat}'></input>";
*}
*/


/*
	Function to echo the HTML needed to display the drop down of the available 
	Post types (categories) from the blog. By Default the scoreboard will post to all
	post types.
*/
function wodhopper_setting_scoreboard_post_type(){
	$options = get_option('wodhopper_options');
	$optionValue = $options['scoreboard_post_type'];
    echo "<select id='wodhopper_scoreboard_post_type' name='wodhopper_options[scoreboard_post_type]'>";
    
    //default to All category types
    echo '<option value="all"'.selected($optionValue,"all").'>All Categories (Default)</option>';
    
    //now query the DB and pull all Categories in Alpha-order
    $args=array(
  		'orderby' => 'name',
  		'order' => 'ASC',
		'hide_empty' => 0
  	);
	$categories=get_categories($args);
  	foreach($categories as $category){ 
  		echo '<option value="' . $category->name . '"'.selected($optionValue,$category->name).
  		'>' . $category->name . '</option>' ;
  	}
  	
	echo "</select>";
}

?>