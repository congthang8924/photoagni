<?php
global $k_option;

load_theme_textdomain('expose');

#####################################################################
# Define Thumbnail sizes
#####################################################################
$k_option['custom']['imgSize']['base'] = array('width'=>267, 'height'=>180); 	// backend preview size, if changed does not affect the frontend
$k_option['custom']['imgSize']['S'] = array('width'=>60, 'height'=>60);			// small preview pics, eg for sidebar news
$k_option['custom']['imgSize']['M'] = array('width'=>180, 'height'=>135);		// small preview pic for posts
//$k_option['custom']['imgSize']['L'] = array('width'=>610, 'height'=>260);		// big preview pic for posts
$k_option['custom']['imgSize']['L'] = array('width'=>300, 'height'=>240);		// big preview pic for posts
$k_option['custom']['imgSize']['XL'] = array('width'=>884, 'height'=>390);		// big images for fullsize pages


##################################################################
# Get Theme informations and save them to PHP Constants
##################################################################
$the_theme = get_theme_data(TEMPLATEPATH . '/style.css');
$the_version = trim($the_theme['Version']);
if(!$the_version) $the_version = "1";

//set theme constants
define('THEMENAME', $the_theme['Title']);
define('THEMEVERSION', $the_version);

// set Path constants
define('KFW', TEMPLATEPATH . '/framework/'); // 'K'riesi 'F'rame 'W'ork;
define('KFWOPTIONS', 	TEMPLATEPATH . '/theme_options/'); 
define('KFWHELPER', 	KFW . 'helper_functions/'); 
define('KFWCLASSES', 	KFW . 'classes/'); 
define('KFWPLUGINS', 	KFW . 'theme_plugins/');
define('KFWWIDGETS', 	KFW . 'theme_widgets/'); 
define('KFWINC', 		KFW . 'includes/'); 
define('KFWSC', 		KFW . 'shortcodes/'); 

// set URI constants
define('KFW_URI', get_bloginfo('template_url') . '/framework/'); // 'K'riesi 'F'rame 'W'ork;
define('KFWOPTIONS_URI', 	get_bloginfo('template_url') . '/theme_options/'); 
define('KFWHELPER_URI', 	KFW_URI . 'helper_functions/'); 
define('KFWCLASSES_URI', 	KFW_URI . 'classes/'); 
define('KFWPLUGINS_URI', 	KFW_URI . 'theme_plugins/'); 
define('KFWWIDGET_URI', 	KFW_URI . 'theme_widgets/'); 
define('KFWINC_URI', 		KFW_URI . 'includes/'); 
define('KFWINC_SC', 		KFW_URI . 'shortcodes/'); 


##################################################################
# this include calls a file that automatically includes all 
# the files within the folder framework and therefore makes 
# all functions and classes available for later use
##################################################################



$autoload['helper'] = array('breadcrumb', 				# breadcrumb navigation
							'header_includes',			# javascript and css includes for header.php
							'lots_of_small_helpers', 	# helper functions that make my developer-life easier =)
							'pagination',				# pagination function
							'kriesi_post_thumb',			# display a resized image
							'kriesi_user_thumb'			# display a resized image
							);

$autoload['classes'] = array('kclass_display_box');


$autoload['plugins'] = array('kriesi_option_pages/kriesi_option_pages',		
							'kriesi_menu_manager/kriesi_menu_manager',
							'kriesi_menu_manager/kriesi_menu_display',
							'kriesi_meta_box/kriesi_meta_box'
							);

#postratings plugin						
//if(!function_exists('the_ratings')) { $autoload['plugins'][] = 'wp-postratings/wp-postratings'; }				
							

$autoload['widgets'] = array('advertising_widget_dual','sidebar_news','special_category');

$autoload['option_pages'] = array('options',
								'gallery',
								'blog',
								'contact',
								'sidebar_footer',
								'menu_manager_pages',
								'meta_box'
								 );
								 
$autoload['templatefiles'] = array('wp_list_comments','widgets');	
$autoload['shortcodes'] = array('pullquotes','columns','dropcaps','delimiter');							

include_once(KFW.'/include_framework.php');




