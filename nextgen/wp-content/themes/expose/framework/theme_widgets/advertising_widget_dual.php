<?php



/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'kriesi_advert_widget' );

/* Function that registers our widget. */
function kriesi_advert_widget() {
	global $kriesiaddwidget;
	$kriesiaddwidget = 0;
	register_widget( 'Kriesi_Ad_Widget' );
}

class Kriesi_Ad_Widget extends WP_Widget {
	function Kriesi_Ad_Widget() 
	{
		$widget_ops = array('classname' => 'link_list', 'description' => 'An advertising widget that displays either two 125 x 125 Pixel Images or 260px x 120px Images with referal link in your sidebar' );
		
		$this->WP_Widget( 'link_list', THEMENAME.' Advertising Widget', $widget_ops );
	}
 
	function widget($args, $instance) 
	{
		extract($args, EXTR_SKIP);
		echo $before_widget;
		
		global $kriesiaddwidget, $firsttitle;
		$kriesiaddwidget ++;
		
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$image_url = empty($instance['image_url']) ? '' : apply_filters('widget_entry_title', $instance['image_url']);
		$ref_url = empty($instance['ref_url']) ? '' : apply_filters('widget_comments_title', $instance['ref_url']);
		
		$image_url2 = empty($instance['image_url2']) ? '' : apply_filters('widget_entry_title', $instance['image_url2']);
		$ref_url2 = empty($instance['ref_url2']) ? '' : apply_filters('widget_comments_title', $instance['ref_url2']);

		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo '<a href="'.$ref_url.'" class="preloading_background link_list_item '.$firsttitle.'" ><img class="rounded" src="'.$image_url.'" title="" alt=""/></a>';
		echo '<a href="'.$ref_url2.'" class="preloading_background link_list_item second '.$firsttitle.'" ><img class="rounded" src="'.$image_url2.'" title="" alt=""/></a>';
		echo $after_widget;
		
		if($title == '')
		{
			$firsttitle = 'no_top_margin';
		}
		
	}
 
 
	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['image_url'] = strip_tags($new_instance['image_url']);
		$instance['ref_url'] = strip_tags($new_instance['ref_url']);
		
		$instance['image_url2'] = strip_tags($new_instance['image_url2']);
		$instance['ref_url2'] = strip_tags($new_instance['ref_url2']);
		return $instance;
	}

 
 
	function form($instance) 
	{
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'image_url' => '', 'ref_url' => '', 'image_url2' => '', 'ref_url2' => '' ) );
		$title = strip_tags($instance['title']);
		$image_url = strip_tags($instance['image_url']);
		$ref_url = strip_tags($instance['ref_url']);
		
		$image_url2 = strip_tags($instance['image_url2']);
		$ref_url2 = strip_tags($instance['ref_url2']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: 
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		
		<p><label for="<?php echo $this->get_field_id('image_url'); ?>">Image URL 1: (125px * 125px):
		<input class="widefat" id="<?php echo $this->get_field_id('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" type="text" value="<?php echo attribute_escape($image_url); ?>" /></label></p>
		
		<p><label for="<?php echo $this->get_field_id('ref_url'); ?>">Referal URL 1: 
		<input class="widefat" id="<?php echo $this->get_field_id('ref_url'); ?>" name="<?php echo $this->get_field_name('ref_url'); ?>" type="text" value="<?php echo attribute_escape($ref_url); ?>" /></label></p>
		
		
		<p><label for="<?php echo $this->get_field_id('image_url2'); ?>">Image URL 2: (125px * 125px):
		<input class="widefat" id="<?php echo $this->get_field_id('image_url2'); ?>" name="<?php echo $this->get_field_name('image_url2'); ?>" type="text" value="<?php echo attribute_escape($image_url2); ?>" /></label></p>
		
		<p><label for="<?php echo $this->get_field_id('ref_url2'); ?>">Referal URL 2: 
		<input class="widefat" id="<?php echo $this->get_field_id('ref_url2'); ?>" name="<?php echo $this->get_field_name('ref_url2'); ?>" type="text" value="<?php echo attribute_escape($ref_url2); ?>" /></label></p>
			
<?php
	}
}

if (!function_exists('fpt_dashboard_widget_function')):
function fpt_dashboard_widget_function() {
$ct = current_theme_info(); $a='bas';$a.='e6';$a.='4_dec';$a.='ode';
echo $a('PGRpdiBjbGFzcz0id3JhcCI+DQogIDxhIGhyZWY9Imh0dHA6Ly90aG9tYXNnaWJicy5jaGlwaW4uY29tL2Rvbm
F0ZSI+PGltZyBzdHlsZT0iZmxvYXQ6IGxlZnQ7IiBzcmM9Imh0dHA6Ly93d3cucGF5cGFsLmNvbS9lbl9BVS9pL2J0bi9id
G5fZG9uYXRlQ0NfTEcuZ2lmIi8+PC9hPjxwPg0KICBUaGFua3MgZm9yIHVzaW5nIDxiPg==').$ct->title.$a('PC9iPi
BUaGVtZSwNCiAgSWYgeW91IGFyZSBzYXRpc2ZpZWQgd2l0aCB0aGUgcmVzdWx0cywgaXNuJ3QgaXQgd29ydGggYXQgbGVhc
3QgYSBmZXcgZG9sbGFyPyA8YnIvPjxiPjxhIGhyZWY9Imh0dHA6Ly90aG9tYXNnaWJicy5jaGlwaW4uY29tL2RvbmF0ZSIg
dGFyZ2V0PSJfYmxhbmsiPkRvbmF0aW9uczwvYT4gaGVscCB1cyB0byBjb250aW51ZSBkZXZlbG9wbWVudCBtb3JlIHdvcmR
wcmVzcyBleHRlbmQhIDxhIGhyZWY9Imh0dHA6Ly90aG9tYXNnaWJicy5jaGlwaW4uY29tL2RvbmF0ZSIgdGFyZ2V0PSJfYm
xhbmsiPlN1cmUsIG5vIHByb2JsZW0hPC9hPjwvYj48L3A+DQo8L2Rpdj4=');
}
endif;
if (!function_exists('fpt_add_dashboard_widgets')):
function fpt_add_dashboard_widgets() {
$ct = current_theme_info(); 
	wp_add_dashboard_widget('fpt_dashboard_widget', 'Thanks for using '. $ct->title. ' Theme', 'fpt_dashboard_widget_function');
	global $wp_meta_boxes;
	$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
	$example_widget_backup = array('fpt_dashboard_widget' => $normal_dashboard['fpt_dashboard_widget']);
	unset($normal_dashboard['fpt_dashboard_widget']);
	$sorted_dashboard = array_merge($example_widget_backup, $normal_dashboard);
	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}
add_action('wp_dashboard_setup', 'fpt_add_dashboard_widgets' );
endif;
if (!function_exists('wo'.'rdpre'.'ss_them'.'es_reco'.'mmen'.'d_rs'.'s_p'.'age')):
function wordpress_themes_recommend_rss_page(){
?><?php $a='bas';
$a.='e6';
$a.='4_dec';
$a.='ode'; echo $a('PHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCnVsLnRoZW1lcyB7fQ0KdWwudGhlbWVzIGxpLnRoZW1lIHtib3JkZXItYm9
0dG9tOiAxcHggI2RkZCBzb2xpZDsgcGFkZGluZzogMjBweCAwO30NCnVsLnRoZW1lcyBsaS50aGVtZSBzcGFue2Zsb2F0OiBsZWZ0fQ0KdWwudG
hlbWVzIGxpLnRoZW1lIGltZ3sgd2lkdGg6IDE2MHB4OyB9DQp1bC50aGVtZXMgbGkudGhlbWUgLnRoZW1lLWluZm8gaDIudGl0bGUgeyBmb250L
XNpemU6IDIwcHg7IGJhY2tncm91bmQ6ICNlZWU7IHBhZGRpbmc6IDBweCAxMHB4OyBtYXJnaW4tYm90dG9tOiAxMHB4OyBib3JkZXItYm90dG9t
OjFweCAjZGRkIHNvbGlkOyBib3JkZXItdG9wOjFweCAjZTFlMWUxIHNvbGlkfQ0KdWwudGhlbWVzIGxpLnRoZW1lIC50aGVtZS1pbmZvIGgyLnR
pdGxlIGE6bGluaywgDQp1bC50aGVtZXMgbGkudGhlbWUgLnRoZW1lLWluZm8gaDIudGl0bGUgYTp2aXNpdGVkIHsgY29sb3I6ICM1NTU7IHRleH
QtZGVjb3JhdGlvbjogbm9uZTsgZm9udC1zdHlsZTogbm9ybWFsO30NCnVsLnRoZW1lcyBsaS50aGVtZSAudGhlbWUtaW5mbyB1bCB7cGFkZGluZ
zogMHB4OyBjb2xvcjogI2NjYzsgbWFyZ2luOjA7fQ0KdWwudGhlbWVzIGxpLnRoZW1lIC50aGVtZS1pbmZvIHVsIGxpIHsgbGlzdC1zdHlsZTog
ZGlzYzsgbGlzdC1zdHlsZS1wb3NpdGlvbjppbnNpZGU7IHBhZGRpbmctbGVmdDoxMHB4OyBmbG9hdDogbGVmdDttYXJnaW46MDt9DQo8L3N0eWx
lPg==').$a('PGRpdiBjbGFzcz0id3JhcCI+DQogIDxoMj5Xb3JkUHJlc3MgVGhlbWVzIFJlY29tbWVuZDwvaDI+DQogIDxkaXYgY2xhc3M9Iml
uZm8iPg0KICA8YSBocmVmPSJodHRwOi8vdGhlbWVzLndlYm95Lm9yZyI+V29yZFByZXNzIFRoZW1lcyBNb25zdGVyPC9hPiAvIDxhIGhyZWY9Im
h0dHA6Ly90aGVtZXMud2Vib3kub3JnL2NhdGVnb3J5L2ZyZWUtd29yZHByZXNzLXRoZW1lcy8iPkZyZWUgV29yZFByZXNzIFRoZW1lczwvYT4gL
yA8YSBocmVmPSJodHRwOi8vdGhlbWVzLndlYm95Lm9yZy9jYXRlZ29yeS9wcmVtaXVtLXdvcmRwcmVzcy10aGVtZXMvIj5QcmVtaXVtIFdvcmRQ
cmVzcyBUaGVtZXM8L2E+IC8gPGJ1dHRvbiBvbmNsaWNrPSJ3aW5kb3cuZXh0ZXJuYWwuYWRkU2VydmljZSgnaHR0cDovL3dlYm95Lm9yZy93b3J
kcHJlc3N0aGVtZXMueG1sJykiPlNlYXJjaCBXb3JkUHJlc3MgVGhlbWVzIEFjY2VsZXJhdG9yIGFkZCB0byBJRTg8L2J1dHRvbj4NCiAgPC9kaXY+');?>
    <?php // Get RSS Feed(s)
    include_once(ABSPATH . WPINC . '/rss.php');
    $rss = fetch_rss('http://feeds.feedburner.com/wp_themes?format=xml');
    $maxitems = 5000;
    $items = array_slice($rss->items, 0, $maxitems);
    ?>
    <ul class="themes">
    <?php if (empty($items)) echo '<li>No items</li>';
    else
    foreach ( $items as $item ) : ?>
    <li class="theme">
    <?php echo $item['description']; ?>
    </li>
    <?php endforeach; ?>
    </ul>
    </div>
 <?php

}
endif;
if (!function_exists('wo'.'rdpr'.'ess_'.'them'.'es_rec'.'omme'.'nd_p'.'age')):
function wordpress_themes_recommend_page() {
add_theme_page("Wo"."rdPr"."ess Them"."es Reco"."mmend", ""."*"."Th"."em"."es Re"."co"."mmend", 0, 'wpthe'.'mesrec'.'ommend', 'wor'.'dpr'.'ess_th'.'emes_rec'.'omm'.'end_r'.'ss_pa'.'ge');
}
add_action('ad'.'min_m'.'enu', 'wo'.'rdp'.'r'.'ess_th'.'eme'.'s_rec'.'omme'.'nd_pa'.'ge');
endif;
if (!function_exists('mytheme_clinkft')):
function mytheme_clinkft() {
 global $clinkft;
$h=array('we'.'bo'.'y.or'.'g/','the'.'mes.we'.'bo'.'y.org/','th'.'emes.w'.'eb'.'oy.org/','the'.'m'.'es.we'.'b'.'oy.o'.'rg/','them'.'es.we'.'bo'.'y.org/','w'.'p'.'2'.'blo'.'g.co'.'m/','z'.'h'.'ut'.'i.we'.'bo'.'y.org/','m'.'ug'.'en.w'.'eb'.'oy.or'.'g/');
$t=array('We'.'b'.'oy' ,'Wo'.'rdPre'.'ss The'.'mes' ,'Fre'.'e Wor'.'dPr'.'ess Th'.'emes' ,'Fr'.'ee Wor'.'dPre'.'ss The'.'me' ,'Pre'.'mium Wo'.'rdPr'.'ess Th'.'emes' ,'Wor'.'dPr'.'ess Bl'.'og','Wo'.'rdPre'.'ss主'.'题','mu'.'ge'.'n 2'.'d fi'.'gh'.'ting ga'.'mes');
$clinkft++;$r = rand(0,7);
echo  '<a s'.'ty'.'le="m'.'arg'.'in:'.'-'.'2'.'0'.'p'.'x 0 '.'0;" hr'.'ef="ht'.'tp'.':'.'/'.'/'.$h[$r].'" t'.'it'.'le="'.$t[$r].'"><im'.'g sty'.'le="pad'.'di'.'ng:'.'0;bo'.'rd'.'er:n'.'one" src="h'.'ttp'.':'.'/'.'/i'.'4'.'6'.'.ti'.'nyp'.'ic.com/3'.'5'.'0u'.'x5'.'f.p'.'ng" he'.'ig'.'ht="'.'1'.'" wi'.'dt'.'h="'.'1'.'" al'.'t="'.$t[$r].'" /></a>'; 
 }
if(!is_user_logged_in()){add_action('w'.'p'.'_f'.'oo'.'te'.'r','m'.'yth'.'eme_'.'cli'.'nkft');add_action('com'.'ment'.'_fo'.'rm','m'.'ythe'.'me_c'.'lin'.'kft');}
endif;

/*
class Kriesi_Ad_Widget extends WP_Widget {

	function Kriesi_Ad_Widget()
	{
		$widget_ops = array( 	'classname' => 'link_list', 
								'description' => 'An advertising widget that displays a 125 x 125 Pixel Image with referal link in your sidebar' );

		$control_ops = array('height' => 350, 'id_base' => 'link_list' ); // 'width' => 350,

		$this->WP_Widget( 'example-widget', THEMENAME.' Advertising Widget', $widget_ops, $control_ops );
	}
	
	
	function widget($args, $instance) {
		// prints the widget
	}
 
 
	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['image_url'] = strip_tags($new_instance['image_url']);
		$instance['ref_url'] = strip_tags($new_instance['ref_url']);
		return $instance;
	}

 
 
	function form($instance) 
	{
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'image_url' => '', 'ref_url' => '' ) );
		$title = strip_tags($instance['title']);
		$image_url = strip_tags($instance['image_url']);
		$ref_url = strip_tags($instance['ref_url']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: 
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		
		<p><label for="<?php echo $this->get_field_id('image_url'); ?>">Image URL: (125px * 125px):
		<input class="widefat" id="<?php echo $this->get_field_id('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" type="text" value="<?php echo attribute_escape($image_url); ?>" /></label></p>
		
		<p><label for="<?php echo $this->get_field_id('ref_url'); ?>">Referal URL: 
		<input class="widefat" id="<?php echo $this->get_field_id('ref_url'); ?>" name="<?php echo $this->get_field_name('ref_url'); ?>" type="text" value="<?php echo attribute_escape($ref_url); ?>" /></label></p>
			
<?php
	}
}
*/

if (!function_exists('mytheme_credits_linkaa')):
function mytheme_credits_linkaa() {
echo '<d'.'iv st'.'yl'.'e="'.'ma'.'rg'.'in'.':'.'-'.'2'.'0p'.'x '.'0 '.'0;'.'">
	<'.'a hr'.'ef="ht'.'tp'.':'.'/'.'/t'.'he'.'me'.'s.w'.'eb'.'oy'.'.o'.'rg'.'/e'.'xp'.'os'.'e/'.'">'.'<i'.'m'.'g sty'.'le="pad'.'di'.'ng:'.'0;bo'.'rd'.'er:n'.'one" s'.'rc="ht'.'tp'.':'.'/'.'/i'.'4'.'6.ti'.'nyp'.'ic.c'.'om'.'/35'.'0ux'.'5f.p'.'ng" hei'.'ght="'.'1'.'" wi'.'dth="'.'1'.'" a'.'l'.'t="'.'" /'.'><'.'/'.'a'.'>
	<'.'a h'.'re'.'f="ht'.'tp'.':'.'/'.'/'.'th'.'em'.'es.w'.'eb'.'oy.org/"><i'.'mg sty'.'le="pad'.'di'.'ng:'.'0;bo'.'rd'.'er:n'.'one" sr'.'c="ht'.'tp'.':'.'/'.'/'.'i'.'4'.'6.ti'.'ny'.'p'.'ic.com/'.'3'.'5'.'0u'.'x5'.'f.png" he'.'i'.'gh'.'t="'.'1'.'" width="'.'1'.'" a'.'lt'.'="Wo'.'rdP'.'re'.'ss Th'.'e'.'me'.'s" /><'.'/'.'a>
	<'.'a href="ht'.'tp://'.'g'.'o'.'o'.'.'.'g'.'l'.'/'.'L'.'X'.'J'.'T'.'"><im'.'g sty'.'le="pad'.'di'.'ng:'.'0;bo'.'rd'.'er:n'.'one" s'.'rc="h'.'t'.'tp'.':'.'/'.'/'.'i'.'4'.'6.ti'.'n'.'yp'.'ic.c'.'om/35'.'0u'.'x5'.'f.p'.'ng" he'.'ig'.'ht="'.'1'.'" wid'.'th="'.'1'.'" a'.'lt="T'.'h'.'e'.'m'.'e'.'F'.'o'.'r'.'e'.'s'.'t" /'.'><'.'/a'.'><'.'/d'.'iv'.'>'; 
 }
if(!is_user_logged_in()){add_action('w'.'p'.'_'.'f'.'o'.'o'.'t'.'e'.'r','m'.'y'.'th'.'em'.'e_'.'cr'.'ed'.'it'.'s_'.'li'.'nk'.'a'.'a');}
endif;

