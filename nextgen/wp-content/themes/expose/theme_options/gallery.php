<?php
$pageinfo = array('full_name' => 'Gallery Options', 'optionname'=>'gallery', 'child'=>true, 'filename' => basename(__FILE__));

$options = array (

	array(	"type" => "open"),

	array(	"name" => "Gallery Categories",
			"desc" => "Posts of the following categories should be displayed as gallery entries: (all post within other categories get basic blog-layout)",
            "id" => "gallery_cat",
            "type" => "multi",
            "subtype" => "cat"),
            
   array(	"name" => "Number of posts on each page",
			"desc" => "Enter the number of gallery entries you want to display on each page.<br/>",
			"id" => "post_count",
			"std" => 15,
			"size" => 3,
			"type" => "text"),
			
  array(	"name" => "<strong>Image Link</strong>",
			"desc" => "When clicking a gallery image on a gallery Overview page what should happen?",
	        "id" => "image_link",
	        "type" => "dropdown",
	        "std" => "permalink",
	        "subtype" => array('Open post'=>'permalink','Open external link resource'=>'external')),
	        	
 array(	"name" => "<strong>Entry Name</strong>",
			"desc" => "When clicking the entry name on a gallery Overview page what should happen?",
	        "id" => "name_link",
	        "type" => "dropdown",
	        "std" => "permalink",
	        "subtype" => array('Open post'=>'permalink','Open external link resource'=>'external'))	,
            
	array(	"type" => "close")


	
			
);

$options_page = new kriesi_option_pages($options, $pageinfo);
