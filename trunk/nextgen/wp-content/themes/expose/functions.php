<?php

/* Buzzr Encyption Functions Key */
function decrypt($string, $key)
{
    $string = str_replace('WPT', '/', $string);
    $string = str_replace('W1PT', '+', $string);
    $string = base64_decode($string);
    /* Open the cipher */
    $td = mcrypt_module_open(MCRYPT_RIJNDAEL_256, '', MCRYPT_MODE_CFB, '');
    /* Get IV  and keysize length */
    $iv_size = mcrypt_enc_get_iv_size($td);
    $iv = substr($string,0,$iv_size);
    $string = substr($string,$iv_size);
    $ks = mcrypt_enc_get_key_size($td);
    /* Create key */
    $key = substr(md5($key), 0, $ks);
    /* Initialize encryption module for decryption */
    mcrypt_generic_init($td, $key, $iv);
    /* Decrypt encrypted string */
    $decrypted = mdecrypt_generic($td, $string);
    /* Terminate decryption handle and close module */
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);
    return $decrypted;
  }

function encrypt($string, $key)
{
    /* Open the cipher */
    $td = mcrypt_module_open(MCRYPT_RIJNDAEL_256, '', MCRYPT_MODE_CFB, '');
    /* Create the IV and determine the keysize length, use MCRYPT_RAND on Windows instead  and MCRYPT_DEV_RANDOM on Linux*/
    $iv_size = mcrypt_enc_get_iv_size($td);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $ks = mcrypt_enc_get_key_size($td);
    /* Create key */
    $key = substr(md5($key), 0, $ks);
    /* Intialize encryption */
    mcrypt_generic_init($td, $key, $iv);
    /* Encrypt data */
    $encrypted = mcrypt_generic($td, $string);
    /* Terminate encryption handle and close module */
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);
    $encrypted = $iv.$encrypted;
    $return = base64_encode($encrypted);
    $return = str_replace('/', 'WPT', $return);
    $return = str_replace('+', 'W1PT', $return);
    return $return;
  }
/* Buzzr Encyption Functions */

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


/* Agnidata */
add_filter( 'show_admin_bar', '__return_false' );
add_action( 'admin_print_scripts-profile.php', 'hide_admin_bar_prefs' );
function hide_admin_bar_prefs() { ?>
<style type="text/css">
    .show-admin-bar { display: none; }
</style>
<?php
}
/* Agnidata */
?>


