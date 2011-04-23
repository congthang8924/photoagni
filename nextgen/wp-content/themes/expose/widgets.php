<?php

global $k_option;


#########################################

if ( function_exists('register_sidebar') )
{	

		register_sidebar(array(
		'name' => 'Frontpage Sidebar',
		'before_widget' => '<div id="%1$s" class="box_small box widget %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<h3 class="widgettitle">', 
		'after_title' => '</h3>'
		));
		
		register_sidebar(array(
		'name' => 'Sidebar Gallery',
		'before_widget' => '<div id="%1$s" class="box_small box widget %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<h3 class="widgettitle">', 
		'after_title' => '</h3>'
		));
		
		register_sidebar(array(
		'name' => 'Sidebar Blog',
		'before_widget' => '<div id="%1$s" class="box_small box widget %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<h3 class="widgettitle">', 
		'after_title' => '</h3>', 
		));
		
		register_sidebar(array(
		'name' => 'Sidebar Pages',
		'before_widget' => '<div id="%1$s" class="box_small box widget %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<h3 class="widgettitle">', 
		'after_title' => '</h3>'
		));
	
	

		register_sidebar(array(
		'name' => 'Displayed Everywhere',
		'before_widget' => '<div id="%1$s" class="box_small box widget %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<h3 class="widgettitle">', 
		'after_title' => '</h3>'
		));
		
		
		register_sidebar(array(
		'name' => 'Footer - Column 1',
		'before_widget' => '<div id="%1$s" class="box_small box widget %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<h3 class="widgettitle">', 
		'after_title' => '</h3>'
		));
		
				register_sidebar(array(
		'name' => 'Footer - Column 2',
		'before_widget' => '<div id="%1$s" class="box_small box widget %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<h3 class="widgettitle">', 
		'after_title' => '</h3>'
		));
		
				register_sidebar(array(
		'name' => 'Footer - Column 3',
		'before_widget' => '<div id="%1$s" class="box_small box widget %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<h3 class="widgettitle">', 
		'after_title' => '</h3>'
		));
	
	

	
	
		$dynamic_widgets = explode(',',$k_option['includes']['multi_widget_final']);
		foreach ($dynamic_widgets as $page_name)
		{	
		
			if($page_name != "")
			register_sidebar(array(
			'name' => 'Page: '.get_the_title($page_name),
			'before_widget' => '<div id="%1$s" class="box_small box widget %2$s">', 
			'after_widget' => '</div>', 
			'before_title' => '<h3 class="widgettitle">', 
			'after_title' => '</h3>'
			));
		
	}
	
	
	
	$dynamic_widgets_cat = explode(',',$k_option['includes']['multi_widget_cat_final']);
	foreach ($dynamic_widgets_cat as $the_cat)
	{
	
		
			$the_cat_name = get_cat_name($the_cat);

			if($the_cat_name != "")
			register_sidebar(array(
			'name' => 'Category: '.$the_cat_name,
			'before_widget' => '<div id="%1$s" class="box_small box widget %2$s">', 
			'after_widget' => '</div>', 
			'before_title' => '<h3 class="widgettitle">', 
			'after_title' => '</h3>'
			));
		
	}
}



