<?php
/*
Plugin Name: Branded Login Screen
Plugin URI: http://kerrywebster.com/my-current-plugins/branded-login-screen/
Description: Update the WordPress Login Screen to use a hi-res, full screen, resizing image. Great for branding.
Author: Kerry Webster
Version: 2.0
Author URI: http://kerrywebster.com/
*/

function branded_login_screen() {
	echo '<link rel="stylesheet" href="' . get_settings('siteurl') . '/wp-content/plugins/branded-login-screen/assets/c/branded-login-screen.css" type="text/css" media="all" />' . '
';
/*	echo '<script type="text/javascript" src="' . get_settings('siteurl') . '/wp-content/plugins/branded-login-screen/assets/j/jquery.min.js"></script>' .'
'; */
	echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>' . '
';
	echo '<script type="text/javascript" src="' . get_settings('siteurl') . '/wp-content/plugins/branded-login-screen/assets/j/branded-login-screen.js"></script>' . '
';
	echo '<script> var siteURL="' . get_settings('siteurl') . '"</script>' , '
';
	echo '<script> var siteNAME="' . get_settings('blogname') . '"</script>' , '
';


}

add_action('login_head', 'branded_login_screen');

?>
