<?php
/**
*
* @package Simple Portal : constants.php
* @version $Id$
* @copyright (c) 2011 MySimplePortal Team
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* @note: Do not remove this copyright. Just append yours if you have modified it,
*/

/**
* @ignore
*/
if (!defined('IN_SP'))
{
	exit;
}

// MySimplePortal Version
define('SP_VERSION', '0.0.1');

//define('START', '<div id="p_header_"></div><div id="p_container_"><div id="p_row_"><div style="width:170px; min-width:170px; padding-right:15px;" id="left">');
//define('MID', '</div><div id="center">');
//define('END', '</div><div style="width:0px; padding-left:0px;" id="right"></div></div></div>');


define('FORM', '
<div class="form wrapper">
<form name="myform_" id="myform" class="form" action="portal?save" method="get" >
<input type="hidden" name="a" value="1"/>
	<table class="table" cellspacing="0" cellpadding="0">
		<thead><tr><th>Editing</th></tr></thead>
		<tbody>
			<tr class="r1">
				<td>
					<div><textarea name="word" id="word" class="textarea mce_word"  rows="18" cols="100%" value="'. get_file_contents($page_path . $page. '.html') .'"></textarea></div>
				</td>
			</tr>
			<tr class="r1"><td align="right"><div class="button_div"><button class="button">Submit</button></div></td></tr>
		</tbody>
	</table>
</form></div>');
?>