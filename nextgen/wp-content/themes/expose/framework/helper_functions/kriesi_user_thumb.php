<?php
######################################################################
# displays an image, resized with wordpress, several fallback options
# included
######################################################################


function kriesi_user_thumb($image_URL, $option, $lightbox_image_url = '')
{	
	global $k_option;
	
	$defaults = array(	'link'=>false,
						'size'=>false,
						'wh'=>array('width'=>100,'height'=>100),	// array: width/height
						'domain'=>false,							// bol: add or remove domain from timthumb output
						'script'=> KFWINC_URI.'timthumb.php?src=',	// string: timthumb uri
						'display_link' => array('none'),
						'link_url' => '',
						'img_attr' => '',
						'link_attr' => ''
						);
	
	$option = array_merge((array)$defaults,(array)$option);

	//first we get the link attributes:
	$img_attr_string = '';
	
	if(is_array($option['img_attr']))
	{
		foreach ($option['img_attr'] as $attr=>$value)
		{
			$img_attr_string .= $attr."='".$value."' ";
		}
	}
		
		
		// if we got no image yet then abort script
		if($image_URL == "") return false;
		
		
	######################################################################
	# Here we get the Link
	######################################################################	
		// if the display_link option is not set directly use the custom field value. set the option directly by puttin 
		// 'none','permalink' or 'lightbox' in an otherwise empty array
		
		//first we get the link attributes:
		$link_attr_string = '';

		if(is_array($option['link_attr']))
		{	
			foreach ($option['link_attr'] as $attr=>$value)
			{
				$link_attr_string .= $attr."='".$value."' ";
			}
		}
		
		
		// now we check if the link option is set and which option has been choosen
		if(!is_array($option['display_link']))
		{
			$display_link = $image_customfield = get_post_meta($this_post, $option['display_link'], true);
		}
		else
		{
			$display_link = $option['display_link'][0];
		}
		
		$linkwrap[1] = '</a>';
		// no link;
		if($display_link == 'none') { $linkwrap[0] = $linkwrap[1] = ''; }
		
		// permalink
		else if($display_link == 'permalink') { $linkwrap[0] = '<a '.$link_attr_string.' href="'.get_permalink().'" title="'.get_the_title().'" >'; }
		
		//lightbox link
		else if($display_link == 'lightbox')
		{	
			//check if we got a set customfield to overwrite the default generated image
			if(isset($lightbox_image_url) && $lightbox_image_url != '')
			{
				$preview_url = $lightbox_image_url;
			}
			else
			{
				$preview_url = $image_URL;
			}
			if (isset($option['linkurl'][1]))
			{
				// $link_src = get_post_meta($this_post, $option['linkurl'][1], true);
				$link_src = $preview_url;
			}
			
			if($link_src == '')
			{	
				
				// $link_src = wp_get_attachment_image_src($thumbnail_id, $option['linkurl'][0]);
				// $link_src = $link_src[0];
				$link_src = $preview_url;
			}
			
			// $linkwrap[0] = '<a '.$link_attr_string.' rel="lightbox[grouped]" href="'.$link_src.'" title="'.get_the_title().'" >';
			$linkwrap[0] = '<a '.$link_attr_string.' rel="lightbox[grouped]" href="'.$link_src.'" >';
		}
		else
		{	
			$link_src = $display_link;
			// $linkwrap[0] = '<a '.$link_attr_string.' href="'.$link_src.'" title="'.get_the_title().'" >';
			$linkwrap[0] = '<a '.$link_attr_string.' href="'.$link_src.'" >';
		}
		
		
		
		// $defaultimage = $linkwrap[0]."<img ".$img_attr_string." src='".$image_URL."' alt='' title='".get_the_title()."' height='".$option['wh']['height'] ." ' width='".$option['wh']['width'] ."' />".$linkwrap[1];
		$defaultimage = $linkwrap[0]."<img ".$img_attr_string." src='".$image_URL."' alt='' height='".$option['wh']['height'] ." ' width='".$option['wh']['width'] ."' />".$linkwrap[1];

	
	return $defaultimage;
}