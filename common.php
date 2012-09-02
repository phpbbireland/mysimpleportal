<?php
/**
*
* @package Simple Portal : common.php
* @version $Id$
* @copyright (c) 2011 MySimplePortal Team
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* @note: Do not remove this copyright. Just append yours if you have modified it,
*/

if (!defined('IN_SP'))
{
	exit;
}

// error handler function
function ErrorHandler($errno, $errstr, $errfile, $errline)
{
    if (!(error_reporting() & $errno))
	{
        return;
    }

    switch ($errno)
	{
		case E_USER_ERROR:
			echo "<b>ERROR</b> [$errno] $errstr<br />\n";
			echo "  Fatal error on line $errline in file $errfile";
			echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
			echo "Aborting...<br />\n";
			exit(1);
			break;

		case E_USER_WARNING:
			echo "<b>WARNING</b> [$errno] $errstr<br />\n";
			break;

		case E_USER_NOTICE:
			echo "<b>NOTICE</b> [$errno] $errstr<br />\n";
			break;

		default:
	        echo "Unknown error type: [$errno] $errstr<br />\n";
        break;
    }

    // Don't execute PHP internal error handler
    return true;
}

// set to the user defined error handler
$old_error_handler = set_error_handler("ErrorHandler");

if (file_exists($sp_root_path . 'config.' . $phpEx))
{
	require($sp_root_path . 'config.' . $phpEx);
}
require($sp_root_path . 'includes/phpbb/startup.' . $phpEx);

/*
*
* Set up some global vars
*
*/


$home          = $sp_root_path . 'portal.' . $phpEx;
$page_path     = $sp_root_path . 'pages/';
$components    = $sp_root_path . 'components/';
$page_body     = $sp_root_path . 'styles/portal/body.html';
$default_style = $sp_root_path . 'styles/sp.css';

$template_vars = array(
	'{VERSION}'               => '0.0.1',
	'{COMPONENTS_IMAGE_PATH}' => $components,
	'{JQUERY}'                => $sp_root_path . 'js/jquery.js',
	'{STYLES}'                => $sp_root_path . 'styles/',
);

$pool_data = array(
	'root_path'  => $sp_root_path,
	'style_path' => 'styles/portal/',
	'style'      => 'portal.css',
	'home_page'  => 'portal',
	'site_name'  => 'My Simple Portal (project demonstration site)... <br /><i> Create your own site without programming...</i>',
);

$pool_breadcrumbs = array(
	'home'          => $sp_root_path . 'portal.php',
	'blog'          => $sp_root_path . 'portal.php?page=blog',
	'welcome'       => $sp_root_path . 'portal.php?page=welcome',
	'news'          => $sp_root_path . 'portal.php?page=news',
);

$pool_links = array(
	'home'          => $sp_root_path . 'portal.php',
	'blog'          => $sp_root_path . 'portal.php?page=blog',
	'welcome'       => $sp_root_path . 'portal.php?page=welcome',
	'dev site'      => 'http://www.integramod.info/info/',
	'google'        => 'http://google.com',
);

$pool_footer = array(
	'home'           => $sp_root_path . 'portal.php',
	'dev site'       => 'http://www.phpbbireland.com/',
	'search'         => 'http://google.com',
	'copyright'      => 'Powered by: My Simple Portal &copy; Michael O’Toole 2011',
);

require($sp_root_path . 'includes/functions.' . $phpEx);
require($sp_root_path . 'includes/constants.' . $phpEx);

?>