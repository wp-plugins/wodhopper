/*
	editor_plugin.js. This file represents the tinyMCE button and its functionality
	for the WODHOPPER scoreboard manual insert button.
	Author: WODHOPPER
	Date:2012
*/
(function() {
    tinymce.create('tinymce.plugins.wodhopperScoreboard', {
        init : function(ed, url) {
            ed.addCommand('mceWodhopperScoreboard', function (){
            	//built the html output based on the selection
				var output = "[wodhopper_scoreboard_button placement=\"inline\" wod_date=\""+
							 getTheScoreboardDate() +"\"]";
            	
            	ed.execCommand('mceInsertContent', false, output);
            });
            ed.addButton('wodhopperScoreboard', {
                title : 'WODHOPPER Scoreboard',
                image : url+'/scoreboard.png',
                cmd : 'mceWodhopperScoreboard'
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : "WODHOPPER's Scoreboard Shortcode",
                author : 'WODHOPPER',
                authorurl : 'http://wodhopper.com/',
                infourl : 'http://wodhopper.com/',
                version : "1.0"
            };
        }
    });
    tinymce.PluginManager.add('wodhopperScoreboard', tinymce.plugins.wodhopperScoreboard);
})();

/*
	General function to return todays date in mm/dd/yyyy format for the scoreboard
	This can be expanded in the future if needed to parse a date from the title.
*/
function getTheScoreboardDate(){
	//build the date for today
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
	if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} 
	var todayFormat = mm+'/'+dd+'/'+yyyy;
	return todayFormat;
}