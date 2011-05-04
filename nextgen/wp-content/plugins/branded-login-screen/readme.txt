=== Branded Login Screen ===
Contributors: kwebster
Donate link: http://kerrywebster.com/donate
Tags: branding, login, login screen
Requires at least: 2.5
Tested up to: 2.9.1
Stable tag: 2.0

Update the WordPress Login Screen to use a hi-res, full screen, resizing background image.   

== Description ==

The Branded Login Screen has been updated to version 2.0 and along with that come many changes. 

New features of the Branded Login Screen plugin:

*   FULL SCREEN BACKGROUND IMAGE
*   POSITION LOGIN FORM: LEFT, CENTER OR RIGHT
*   INFORMATIONAL LINKS IN THE NEWLY DEFINED LOGIN FOOTER
*   BACKGROUND IMAGE SIZES WITH WINDOW RESIZE
*   REMOVES ALL WORDPRESS BRANDING
*   REPEATING BACKGROUND IMAGES SUPPORTED
*   STILL UPGRADE PROOF

== Installation ==

###Upgrading From A Previous Version###

To upgrade from a previous version of this plugin, follow the installation instructions below. Allow your FTP client to copy the entire contents of the ZIP file over the top of the plugin in its current location replacing existing files.

###Installing The Plugin###

Extract all files from the ZIP file, making sure to keep the file structure intact, and then upload the plugin's folder to <code>/wp-content/plugins/</code>.

This should result in the following file structure:

- wp-content
    - plugins
        - branded-login-screen
        | branded-login-screen.php, readme.txt, screenshot1.png, screenshot2.png, screenshot3.png
            - assets
                - c
                | branded-login-screen.css
                - i
                | bg-1280.jpg, bg-damask.jpg, button-gray.png, button-red.png, button-red.psd, header.png, header.psd, 
                  logos-footer.png, logos-footer.psd, shim.png, transp-black.png, transp-blue.png, transp-red.png
                - j
                | branded-login-screen.js

Then just visit the <b>Administration Section >> Plugins page</b> - and activate the plugin.

See Also: "Installing Plugins" article on the WordPress Codex

###Installing The Plugin For WordPress MU###

Plugin works and was tested on WordPress MU 2.9.1.1.

== Frequently Asked Questions ==

Q) What is required to use a repeating background image?
A) It is a two step process. 1) Edit the css to use a repeating background image. The .css is documented.
   2) Edit the branded-login-screen.js to use the same image as the css background element. The .js is also commented.

Q) What is required to change the location of the login form from the right side to the left or center?
A) Just check the branded-login-screen.css file for the sections to uncomment to accomplish the required 
   location change of the login form. Remember to recomment the sections if you wish to reposition the form. 

== Screenshots ==

- screenshot1.png - Login form on right side
- screenshot2.png - Login form in center
- screenshot3.png - Login form on left side


== Upgrade Notice ==

NONE AVAILABLE

== Changelog ==

= 2.0 =
* Complete rewrite of the Branded Login Screen version 1.2 (which will be know as Branded Login Screen Classic going forward)
