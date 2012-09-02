<?php
/**
*
* @package mysimpleportal functions.php
* @version $Id$
* @copyright (c) 2011 MySimplePortal Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_SP'))
{
	exit;
}


/*
*  global functions
*
*  put_page_header
*  put_page_breadcrumbs
*  put_page_blocks
*  put_page_body
*  put_page_footer
*
*  put_menu
*  put_breadcrumbs
*  put_footer
*
*  get_components
*  get_file_contents
*  process_for_vars
*
*/

if (!function_exists('put_page_header'))
{
	function put_page_header($title = 'Home', $page = 'portal')
	{
		global $pool_data, $page_path, $default_style, $home, $user, $pass;

		print(get_file_contents($page_path . 'header.html'));

		echo '<title>MySimplePortal &bull; '. $page . '</title>';
		echo '<link rel="stylesheet" type="text/css" href="' . $default_style . '" />';
		echo '</head>';
		echo '<body><div class="page">';
		echo '<div class="header_wrapper wrapper">';
		echo '<div style="float:left;"><a style="float:left; margin-top:5px;" href="' . $home . '"><img src="./images/logo2.png" width="180" height="40" border="0" alt=""> </a>';
		echo '<div style="float:left; margin:20px; margin-top: 9px;"><b>' . $pool_data['site_name']. '</b></div><img src="./images/smilies/wizard.gif" width="42" height="31" border="0" alt=""></div>';
		echo '</div>';
	}
}

if (!function_exists('put_page_breadcrumbs'))
{
	function put_page_breadcrumbs()
	{
		echo '<div class="menu wrapper">';
		put_breadcrumbs();
		echo '</div>';
	}
}

if (!function_exists('put_page_blocks'))
{
	function put_page_blocks()
	{
		global $components, $menus;
		$widgets = array();

		echo '<div id="p_header_"></div><div id="p_container_"><div id="p_row_"><div style="width:170px; min-width:170px; padding-right:15px;" id="left">';

		$widgets = get_components();

		foreach($widgets as $widget)
		{
			if($widget == 'index.htm')
			{
				continue;
			}
			$data = process_for_vars(get_file_contents($widget));

			echo '<div class = "ablock wrapper">';
				print($data);
			echo '</div>';
		}
	}
}

if (!function_exists('put_page_body'))
{
	function put_page_body($page = 'portal', $option = '')
	{
		global $page_path;

		echo '</div><div id="center" style="width:100%; padding:0px; margin:0px;">';

		if($option)
		{
			switch($option)
			{
				case 'body':
				{
					writefile($page_path . 'body.html');
					//redirect($page_path . 'body.html')
					//data = get_file_contents_to_edit($page_path . 'body.html');
					//echo $data;
				}
				break;
				default:
				{
					echo '<div class="contents wrapper">';
					if($page == 'portal')
					{
						$data = process_for_vars(get_file_contents($page_path . 'body.html'));
						//print(get_file_contents($page_path . 'body.html'));
						print($data);
					}
					else
					{
						$data = process_for_vars(get_file_contents($page_path . $page. '.html'));
						//print(get_file_contents($page_path . $page. '.html'));
						print($data);
					}
					echo '</div>';
				}
			}
		}




		echo '</div><div style="width:0px; padding-left:0px;" id="right"></div></div></div>';
	}
}

if (!function_exists('put_page_footer'))
{
	function put_page_footer()
	{
		global $page_path;
		put_footer();
		print(get_file_contents($page_path . 'footer.html'));
	}
}

if (!function_exists('put_vars'))
{
	function put_vars()
	{
		global $pool_data, $menus;

		echo '<div style = "padding-left: 14px;" >';
		foreach ($menus as $key => $value)
		{
			echo '<li><span style=" font-weight: bold;">' . $key . ' = </span> <a href="#">' . $value . '</a><br /></li>';
		}
		echo '</div>';
	}
}


if (!function_exists('put_breadcrumbs'))
{
	function put_breadcrumbs()
	{
		global $pool_breadcrumbs;
		$j = 0;

		$count = count($pool_breadcrumbs);

		foreach ($pool_breadcrumbs as $key => $value)
		{
			$j++;
			echo '<a href="' . $value . '" title="' . $key . ' page" >' . ucwords($key) . '</a>&nbsp; ';

			if($j < $count)
			{
				echo ' &bull; ';
			}

		}
	}
}


if (!function_exists('put_menu'))
{
	function put_menu()
	{
		global $pool_menu;

		foreach ($pool_menus as $key => $value)
		{
			echo '<a href="' . $value . '">' . ucwords($key) . '</a>&nbsp; ';
		}
	}
}

if (!function_exists('put_footer'))
{
	function put_footer()
	{
		global $pool_footer;
		$i = 1;


/* to do
   move or change this os that all info is in html and we just parse it but will need loos BEGIN END
*/

		echo '<div class="footer_wrapper wrapper">';

		$count = count($pool_footer);

		foreach ($pool_footer as $key => $value)
		{
			$i++;

			if(stripos($value, "&copy;"))
			{
				echo '<span style="float:right;">' . $value . '</span>';
			}
			else
			{
				echo '<a href="' . $value . '" title="Link to '. $key . '" >' . ucwords($key) . '</a>&nbsp; ';
				if($i < $count)
				{
					echo ' &bull; ';
				}
			}
		}
	}
}


/*
	read the contents of a file
*/

if (!function_exists('get_file_contents'))
{
	function get_file_contents($file = '')
	{
		$contents = '';
		if(file_exists($file) && filesize($file) > 0)
		{
			$handle = fopen($file, "rb");
			$contents = fread($handle, filesize($file));
			fclose($handle);
		}
		return($contents);
	}
}


if (!function_exists('get_file_contents_to_edit'))
{
	function get_file_contents_to_edit($file = '')
	{
		$contents = '';
		if(file_exists($file) && filesize($file) > 0)
		{
			$handle = fopen($file, "rb");
			$contents = fread($handle, filesize($file));
			fclose($handle);
		}

		return($contents);
	}
}

/*
	grab all block html files
*/

if (!function_exists('get_components'))
{
	function get_components()
	{
		global $components;

		$dirslist = array();
		$filelist = array();

		if ($handle = opendir($components))
		{
			while (false !== ($file = readdir($handle)))
			{
				if(is_dir($components."/".$file))
				{
					if($file != '.' && $file != '..')
					{
						$dirslist[] = $file;
					}
					continue;
				}
				else
				{
					$filelist[] = $file;
				}
			}
		}

		foreach($dirslist as $dir)
		{
			$dirs = dir($components.'/'.$dir);

			while ($file = $dirs->read())
			{
				if ($file != '.' && $file != '..' && stripos($file, ".html") && !stripos($file, ".bak") && $file[0] !== 'x')
				{
					$filelist[] = $components . $dir . '/' . $file;
				}
			}
			closedir($dirs->handle);
		}
		return($filelist);
	}
}

if (!function_exists('process_for_vars'))
{
	function process_for_vars($data)
	{
		global $components, $template_vars;

		$a = array('{', '}');
		$b = array('','');

		$replace = array();

		foreach ($template_vars as $key => $search)
		{
			$find = $key;
			//$search = strtolower($key);
			$replace = $search;

			$data = str_replace($find, $replace, $data);
		}
		return($data);
	}
}

if (!function_exists('writefile'))
{
	function writefile($filename)
	{
		global $secret, $pass, $user;
		global $page_path;

		$newdata = $_POST['info'];

		if ($newdata != '')
		{
			if(file_exists($filename))
			{
				$handle = fopen($filename, 'w') or die('Could not open file!');
				$newdata = str_replace('   ', "\t", $newdata);
				$newdata .= 'Last updated: ' . date("F j, Y, g:i a") . ' (' . $user . ')';
				$data = trim($data);
				fwrite($handle,stripslashes($newdata)) or die('Could not write to file');
				fclose($handle);
			}
		}

		if(file_exists($filename) && $secret == $pass)
		{
			$handle = fopen($filename, "r") or die("Could not open file!");
			$data = fread($handle, filesize($filename)) or die("Could not read file!");

			$data = str_replace("\t", '   ', $data);
			$data = trim($data);
			fclose($handle);

			// print file contents
			echo "<h3 class='editing wrapper' >Editing file: " . $filename . "</h3><br />";
			echo "<div class='wrapper'>
			<form action='$_SERVER[php_self]' method= 'post'>
			<textarea name='info'  wrap='off' cols='80%' rows='30'> $data </textarea>";
			echo"<input type='submit' value='Save'>";
			echo "</form></div>";
		}
		else
		{
			echo "
			<form action='$_SERVER[php_self]' method= 'post'>
			Please enter your password: <input type='password' name='secret' /></form>";
		}
	}
	//header("Location: " . $page_path . $filename);
}

?>