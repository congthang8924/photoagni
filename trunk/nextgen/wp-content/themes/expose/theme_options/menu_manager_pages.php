<?php

$pageinfo = array('full_name' => 'Menu Manager', 'optionname'=>'menu', 'child'=>true, 'filename' => basename(__FILE__));

$options = array (

"Menu Manager Pages" =>	array(	"name" => "Menu Manager",
							"desc" => "This tool controlls your site menu.",
							"database_table" => "main_menu_pages",
							"type" => "menu",
							"initial" => '',
							"attr" => 'id="nav"',
							"heading" => array("Controlls"=>"174px",'Name'=>'196px', "Description"=>"196px","Link"=>'196px'),
							"controlls" => array('delete','right','left','down','up'),
							"tables" => array(	"id"=>"hidden", 
												"lft"=>"hidden", 
												"rgt"=>"hidden", 
												"Name" => "input",
												"Description" => "input", 
												"Link" =>"multi_link"
												)
							)
					);


	$options_page = new kriesi_menu_manager($options, $pageinfo);
	$k_option['custom']['kriesi_menu_pages'] = new kriesi_menu_display($options);
