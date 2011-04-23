<?php 

add_shortcode('pullquote', 'func_pullquotes');

function func_pullquotes($atts, $content=null, $shortcodename ="")
{	
	// set alignment
	$alignment = 'left';
	if (isset($atts[0]) && trim($atts[0]) == 'right')  $alignment = 'right';

	//remove wrong nested p tags
	$content = remove_invalid_tags($content, array('p'));
	
	// add blockquotes to the content
	$return .= '<blockquote class="pullquote '.$shortcodename.'_'.$alignment.'">';
	$return .= wpautop($content);
	$return .= '</blockquote>';
	
	return $return;
}

