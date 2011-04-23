<?php

add_shortcode('hr', 'kriesi_delimiter');


function kriesi_delimiter($atts, $content=null, $shortcodename ="")
{	
	$top = '';
	if (isset($atts[0]) && trim($atts[0]) == 'top')  $top = 'top';

	//remove wrong nested p tags
	$content = remove_invalid_tags($content, array('p'));
	
	// add delimiter to the content
	$return .= '<span class="hr">';
	
	if($top == 'top')
	{
		$return .= '<a href="#top" class="scrollTop">top</a>';
	}
	
	$return .= '</span>';	
	

	return $return;
}