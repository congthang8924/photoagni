<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php global $k_option, $query_string; $k_option['custom']['real_query'] = $query_string; ?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head profile="http://gmpg.org/xfn/11">


<!-- basic meta tags -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php

   if (function_exists('khelper_follow_nofollow')) khelper_follow_nofollow();
// outputs a rel=follow or nofollow tag to circumvent google duplicate content for archives
// located in framework/helper_functions/lots_of_small_helpers.php

?>



<!-- title -->
<title><?php if (is_home()) { bloginfo('name'); ?><?php } elseif (is_category() || is_page() ||is_single()) { ?> <?php } ?><?php wp_title(''); ?></title>


<!-- feeds and pingback -->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />


<!-- stylesheets -->
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<?php $skin = $k_option['general']['skin'] != '' ?  $k_option['general']['skin'] : 1; ?>
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/style<?php echo $skin; ?>.css" type="text/css" media="screen"/>


<!-- scripts -->


<?php 
######################################################################
# PHP scripts
######################################################################
// single post comment reply script by wordpress
if ( is_singular() ) wp_enqueue_script( 'comment-reply' );


//wp-head hook, needed for plugins, do not delte
wp_head();

?>

<!-- meta tags, needed for javascript -->
<meta name="temp_url" content="<?php echo get_bloginfo('template_url'); ?>" />


</head>

<?php 
######################################################################
# check for custom logo
######################################################################
if (isset($k_option['general']['logo']) && $k_option['general']['logo'] != '')
{
	$logo = '<img class="ie6fix" src="'.$k_option['general']['logo'] .'" alt="'.get_settings('home').'" />';
	$logoclass = 'logoimg';
}
else // default logo
{
	$logo = get_bloginfo('name');
	$logoclass = 'logobg';
}

######################################################################
# check which page and apply classes to body
######################################################################
$k_body_class ='';

if (isset($k_option['custom']['bodyclass'])) $k_body_class = $k_option['custom']['bodyclass'];

?>

<body id='top' <?php body_class($k_body_class);?> >

<div class="wrapper" id='wrapper_head'>

	<div class="center">
	
		<div id="head">
		
			<h2 class="logo <?php echo $logoclass; ?>"><a href="<?php echo get_settings('home'); ?>/"><?php echo $logo; ?></a></h2>
			
			<!-- Navigation for Pages starts here -->
			<?php 
				$use_wp_menu = false;
			
				//use the fallback menu for sites that run wordpress version 2.9 or lower, or sites that have already used the fallback menu
				
				if(is_object($k_option['custom']['kriesi_menu_pages']))
				{
					$menuactive = $k_option['custom']['kriesi_menu_pages']->display('Menu Manager Pages','show_basic', true);
					
					if(isset($menuactive[0]))
					{
						$k_option['custom']['kriesi_menu_pages']->display('Menu Manager Pages','show_basic');
					}
					else if(function_exists('wp_nav_menu'))
					{
						$use_wp_menu = true;
					}
				}
				
				
				//use the wordpres page menu for themes with wordpress 3.0 or higher:
				if($use_wp_menu)
				{
					wp_nav_menu( array( 'menu' => 'Main', 'menu_class' => 'nav', 'echo' => true,
	'fallback_cb' => '', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '',
	'depth' => 0, 'context' => 'frontend'));
				}
				
				
			?>
			
			
			<div id="headextras" class='rounded'>
			
				<?php get_search_form(); ?>
				
				<ul class="social_bookmarks">
					<?php if(isset($k_option['general']['contact_link']) && $k_option['general']['contact_link'] != '')
						{
							$contact_link = get_page_link($k_option['general']['contact_link']);
					  		echo "<li class='email'><a class='ie6fix' href='".$contact_link."'>E-mail</a></li>	";
						}
					?>
					<li class='rss'><a class='ie6fix' href="<?php bloginfo('rss2_url'); ?>">RSS</a></li>
					
					<?php if(isset($k_option['general']['acc_tw']) && $k_option['general']['acc_tw'] != '')
						  echo "<li class='twitter'><a class='ie6fix' href='http://twitter.com/".$k_option['general']['acc_tw']."'>Twitter</a></li>";
					?>
					
				</ul><!-- end social_bookmarks-->
			
			<!-- end headextras: --> 
			</div>
			
			
		<!--end head-->
		</div>
		
	<!-- end center-->
	</div>
<!--end wrapper-->
</div>

<div class="wrapper" id='wrapper_main'>

	<div class="center">

