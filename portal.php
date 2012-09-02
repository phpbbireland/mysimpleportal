<?php
/**
*
* @package SimplePortal : portal
* @version $Id$
* @copyright (c) 2011 SimplePortal Team
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* @note: Do not remove this copyright. Just append yours if you have modified it,
*/

/**
* @ignore
*/
define('IN_SP', true);

$sp_root_path = (defined('SP_ROOT_PATH')) ? SP_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);

include($sp_root_path . 'common.' . $phpEx);
include($sp_root_path . 'includes/functions.' . $phpEx);
include($sp_root_path . 'includes/phpbb/functions.' . $phpEx);

$page    = request_var('page', 'portal');
$option  = request_var('edit', 'default');
$secret  = request_var('secret', '');
$a_user  = request_var('a_user', '', true);

put_page_header('Home','portal');
put_page_breadcrumbs('menu1');
put_page_blocks();
put_page_body($page, $option);
put_page_footer();

?>