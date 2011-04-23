<?php
$pageinfo = array('full_name' => 'Contact Form &amp; Submit Site', 'optionname'=>'contact', 'child'=>true, 'filename' => basename(__FILE__));

$options = array (

	array(	"type" => "open"),
	
	array(	"type" => "group"),
	
		array(	"name" => "Contact Page",
			"desc" => "",
			"type" => "title_inside",
			"id" => "hidden"
			),
	array(	"name" => "Contact Page",
			"desc" => "The Page you choose here will display the Contact Form in addition to the normal page content:",
	        "id" => "contact_page",
	        "type" => "dropdown",
	        "subtype" => "page"),

	array(	"name" => "E-Mail adress",
			"desc" => "Enter the Email adress where mails should be delivered to. (default is '".get_option('admin_email')."')",
            "id" => "email",
            "type" => "text",
            "std" => get_option('admin_email')
            ),
    array(	"type" => "group"),
    
    array(	"type" => "group"),
    
    array(	"name" => "Submit gallery entry",
			"desc" => "",
			"type" => "title_inside",
			"id" => "hidden2"
			),
	array(	"name" => "Submit gallery entry Page",
		"desc" => "The Page you choose here will display the submit gallery entry Form in addition to the normal page content:",
        "id" => "submit_page",
        "type" => "dropdown",
        "subtype" => "page"),		
            
    array(	"name" => "E-Mail adress",
			"desc" => "Enter the Email adress where mails should be delivered to. (default is '".get_option('admin_email')."')",
            "id" => "email_news",
            "type" => "text",
            "std" => get_option('admin_email')),     


    array(	"type" => "group"),
	array(	"type" => "close")

	
);

$options_page = new kriesi_option_pages($options, $pageinfo);
