<?php
global $k_option;

$options = array();
$boxinfo = array('title' => 'Post Thumbnail Options', 'id'=>'post_thumb_overwrite', 'page'=>array('post','page'), 'context'=>'side', 'priority'=>'low', 'callback'=>'');

$options[] = array(	"name" => "<strong>Thumbnail overwrite options</strong><br/>Preview pictures are generated automatically. If you dont like the output you can set it manually here.",
			"type" => "title");
		

$options[] = array(	"name" => "Preview Picture overwrite",
			"desc" => "Image",
			"id" => "_preview_medium",
			"std" => "",
			"button_label" => "Insert Image",
			"size" => 31,
			"type" => "media");
			
			
$options[] =    array(	"name" => "<strong>Image Link</strong>",
			"desc" => "Where should the Image link on single post/page view point to?",
	        "id" => "_prev_image_link",
	        "type" => "dropdown",
	        "std" => "lightbox",
	        "subtype" => array('Open larger version of image in lightbox'=>'lightbox','Open external resource'=>'external','No link at all'=>'none'));
			
			
			
$options[] = array(	"name" => "The lightbox can not only contain a bigger version of the image, it can also contain another image or a video",
			"type" => "title");
		

$options[] = array(	"name" => "<strong>Full Size Pic or Video for Lightbox</strong>",
			"desc" => "Image and Video Links allowed",
			"id" => "_preview_big",
			"std" => "",
			"button_label" => "Insert Image/Video",
			"size" => 31,
			"type" => "media");

$new_box = new kriesi_meta_box($options, $boxinfo);






$options = array();
$boxinfo = array('title' => 'Additional page/post options', 'id'=>'extra_option', 'page'=>array('post','page'), 'context'=>'normal', 'priority'=>'high', 'callback'=>'');
			
$options[] = array(	"name" => "<strong>Additional Headline</strong><br/>Enter a headline that should appear above your entry/page here.",
			"desc" => "",
			"id" => "_headline",
			"std" => "",
			"size" => 70,
			"type" => "text");

$new_box3 = new kriesi_meta_box($options, $boxinfo);





$options = array();
$boxinfo = array('title' => 'Additional Gallery Options', 'id'=>'gallery_addition', 'page'=>array('post'), 'context'=>'normal', 'priority'=>'high', 'callback'=>'');
			
$options[] =    array(	"name" => "<strong>Featured Post</strong>",
			"desc" => "Do you want to add a featured badge to the gallery entry??",
	        "id" => "_prev_featured",
	        "type" => "dropdown",
	        "std" => "no",
	        "subtype" => array('No'=>'no','Yes'=>'yes'));
		
$options[] = array(	"name" => "<strong>External Link</strong><br/>Define an external link here. You can link the posts Feature Image to this URL",
			"desc" => "",
			"id" => "_external",
			"std" => "",
			"size" => 70,
			"type" => "text");

$new_box2 = new kriesi_meta_box($options, $boxinfo);



