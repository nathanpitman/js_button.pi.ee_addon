<?php

$plugin_info = array(
	'pi_name'			=> 'JavaScript Button',
	'pi_version'		=> '1.0',
	'pi_author'			=> 'Nathan Pitman',
	'pi_author_url'		=> 'http://www.nathanpitman.com/',
	'pi_description'	=> 'Assists with the creation of input buttons with a JavaScript onclick',
	'pi_usage'			=> np_jsbutton::usage()
);

class np_jsbutton {

	var $value = "";
	var $onClick = "";
	var $class = "";
	
	function np_jsbutton()
	{
		global $TMPL;
		
		// Get target from template
		
		$value =  $TMPL->fetch_param('value');
		$onclick = $TMPL->fetch_param('onclick');
		$class = $TMPL->fetch_param('class');
        
		if ($value != "") {
			
			if ($class != "") {
				$class = " class=\'".$class."\'";
			}
			
			if ($onclick != "") {
				$javascript = "<input type='button'" . $class . " value='" . $value . "' onClick='" . $onclick . "' />";
				
				$string = "<script type=\"text/javascript\">\n";
				$string .= "<!-- // Here's our JavaScript embedded link \n";
				$string .= "document.write(\"" . $javascript . "\");\n";
				$string .= "//-->\n";
				$string .= "</script>";				
				
				$this->return_data = $string;
			} else {
				$this->return_data = "Error: The 'onclick' parameter is required!";
				return;
			}
		} else {
			$this->return_data = "Error: The 'value' parameter is required!";
			return;
		}	
	}
	

// ----------------------------------------
//  Plugin Usage
// ----------------------------------------

// This function describes how the plugin is used.
//  Make sure and use output buffering

function usage()
{
ob_start(); 
?>
This plug-in is designed to help you create input buttons which perform an action 'onClick'. The plug-in also can also optionally add a 'class' to the input button.

BASIC USAGE:

{exp:np_jsbutton value="Cancel" onclick='history.go(-1);'}

PARAMETERS:

value = 'Cancel' (no default - must be specified)
 - The input button text.
	
onclick = 'some javascript' (no default - must be specified)
 - The javascript that you want to execute on click.
	
RELEASE NOTES:

1.0 - Initial Release.

For updates and support check the developers website: http://nathanpitman.com/


<?php
$buffer = ob_get_contents();
	
ob_end_clean(); 

return $buffer;
}


}
?>