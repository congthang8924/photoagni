<?php

$pageinfo = array('full_name' => '"'.THEMENAME.'" General Options', 'optionname'=>'general', 'child'=>false, 'filename' => basename(__FILE__));

$options = array();
			
$options[] = array(	"type" => "open");
	
$options[] = array(	"name" => "'".THEMENAME."' - Skin",
			"desc" => "Please choose one of the ".THEMENAME." skins here",
            "id" => "skin",
            "type" => "dropdown",
            "std" => "1",
            "subtype" => array(THEMENAME.' - Default'=>'1',THEMENAME.' - Dark'=>'2',THEMENAME.' - Modern'=>'3'));
			
$options[] = array(	"name" => "Logo",
			"desc" => "Add the full URI path to your logo. the themes default logo gets applied if the input field is left blank<br/>Logo Dimension: 180px * 60px (if your logo is larger you might need to modify style.css to align it perfectly)<br/> URI Exampe: http://www.yourdomain.com/path/to/image.jpg<br/>",
			"id" => "logo",
			"std" => "",
			"size" => 30,
			"type" => "upload");
			
$options[] = array(	"name" => "Mainpage Headline",
			"desc" => "Enter a Mainpage headline that should appear above your gallery entries here.<br/>",
			"id" => "headline",
			"std" => "Get some inspiration! The best flash and html sites available on the net.",
			"size" => 70,
			"type" => "text");

$options[] = array(	"type" => "group");
$options[] = array(	"name" => "Header Options",
			"desc" => "",
			"type" => "title_inside",
			);
			
$options[] = array(	"name" => "Contact Page Link",
			"desc" => "Select the Page the button should link to",
            "id" => "contact_link",
            "type" => "dropdown",
            "subtype" => "page");
			
$options[] = array(	"name" => "Twitter Account",
			"desc" => "Enter the name of your twitter account to create a small icon link besides your search bar",
			"id" => "acc_tw",
			"std" => "Kriesi",
			"size" => 20,
			"type" => "text");
			
$options[] = array(	"type" => "group");
							
$options[] = array(	"name" => "Google Analytics Code",
		"desc" => "Paste your analytics code here, it will get applied to each page",
        "id" => "analytics",
        "type" => "textarea");
	
	
$options[] = array(	"type" => "close");
	
          

$options_page = new kriesi_option_pages($options, $pageinfo);
