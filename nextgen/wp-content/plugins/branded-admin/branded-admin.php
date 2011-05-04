<?php
/*
Plugin Name: Branded Admin
Plugin URI: http://kerrywebster.com/my-current-plugins/branded-admin/
Description: Display custom header &amp; footer in the WordPress Admin area. Now 2.7.x compatible.
Author: Kerry Webster
Version: 1.2
Author URI: http://kerrywebster.com/
*/

$branded_header_logo = get_option('siteurl') . '/wp-content/plugins/branded-admin/images/branded-header.png';

$branded_header_logo_width = 289;//500;
$branded_header_logo_height = 74;//55;
$branded_header_wphead_height = $branded_header_logo_height + 16;

$branded_footer_div_height = 45;
$branded_footer_logo = get_option('siteurl') . '/wp-content/plugins/branded-admin/images/branded-footer.png';

$branded_footer_logo_width = 26;//40;
$branded_footer_logo_height = 30;//40;

$branded_header_logo_title = 'Click to View ' . get_option("blogname");

/*---------------------------------------------------------------------------*/

add_action('admin_head', 'branded_admin_css', 11, 0);

function branded_admin_css() {

	echo '<link rel="stylesheet" type="text/css" href="' . get_settings('siteurl') . '/wp-content/plugins/branded-admin/branded-admin.css" />';

}



add_action('update_right_now_message', 'branded_admin_update_right_now_message');


function branded_admin_update_right_now_message () {

	echo 'Current version ' . get_bloginfo('version');

}

/*---------------------------------------------------------------------------*/

add_filter('admin_footer', 'branded_header',11,0);

function branded_header() {

global $branded_header_wphead_height, $branded_header_logo, $branded_header_logo_width, $branded_header_logo_height, $branded_header_logo_title;

	$sbh  = '<script type="text/javascript">';
	$sbh .= '  jQuery("img#header-logo").attr("src", "' . $branded_header_logo . '");';
	$sbh .= '  jQuery("img#header-logo").attr("alt", "' . $branded_header_logo_title . '");';
	$sbh .= '  jQuery("img#header-logo").attr("title", "' . $branded_header_logo_title . '");';
	$sbh .= '  jQuery("img#header-logo").width('. $branded_header_logo_width . ');';
	$sbh .= '  jQuery("img#header-logo").height(' . $branded_header_logo_height . ');';
	$sbh .= '  jQuery("div#wphead").css("height", ' . $branded_header_wphead_height . ');';
	$sbh .= '  jQuery("#header-logo").css("background-image", "none");';
	$sbh .= '  jQuery("#header-logo").mouseover(function(e) { jQuery(this).css("cursor", "pointer"); jQuery(this).css("cursor", "hand"); });';
	$sbh .= '  jQuery("img#header-logo").wrap("<a href=\"/\"></a>");';
	$sbh .= '</script>';

	echo $sbh;

}

/*---------------------------------------------------------------------------*/

add_filter('admin_footer', 'branded_footer',1,0);

function branded_footer() {

global $branded_footer_div_height, $branded_footer_logo, $branded_footer_logo_width, $branded_footer_logo_height;

	$sbf  = '<script type="text/javascript">';
	$sbf .= '  jQuery("#footer").addClass("branded_footer");';
	$sbf .= '  jQuery("#footer").html("<img src=\"' . $branded_footer_logo . '\" style=\"float:left;margin:3px 15px 0px;\"><p id=\"footer-left\" class=\"alignleft\"> <span id=\"footer-thankyou\">Welcome to <b><a href=\"' . get_settings('siteurl') . '\" title=\"Click to Return to Main Site\">' . get_bloginfo('name') . '</a></b> - Site Administration' . '</span></p>");';
	$sbf .= '  jQuery("#footer").append("<p id=\"footer-upgrade\" class=\"alignright\">Version ' . get_bloginfo('version') . '</a></p>");';
	$sbf .= '  jQuery("#footer").css("height", ' . $branded_footer_div_height . ');';
	$sbf .= '</script>';

	echo $sbf;

}

?>