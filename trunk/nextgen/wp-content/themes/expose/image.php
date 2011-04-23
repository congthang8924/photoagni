<?php
/*
Template Name: Image
*/

get_header();

// include_once ( dirname (__FILE__) . '/../../plugins/next-gen/admin/functions.php' );	// admin functions
// include_once ( dirname (__FILE__) . '/../../plugins/next-gen/admin/manage.php' );	// nggallery_admin_manage_gallery

// This outputs the headline on your mainpage within an h2 tag
$image_id = $_GET['image_id'];
$gallery_id = $_GET['gallery_id'];
$image_details = $nggdb->find_image($image_id);
/*
if($k_option['general']['headline'] != '')
{
	echo '<div id="feature_info">';
	echo '<h2>'.$k_option['general']['headline'].'</h2>';
	echo '</div>';	
}
*/
echo '<div id="feature_info">';
echo '<h2>'.$image_details->alttext.'</h2>';
echo '</div>';

echo '<div id="main">';
echo '	<div class="content the_gallery">';

// $image_id = $_GET['image_id'];
// $gallery_id = $_GET['gallery_id'];
if(isset($image_id) && $image_id != 0)
{
	if(isset($gallery_id) && $gallery_id != 0)
	{
		global $ngg, $nggdb, $wp_query;
		
		if(is_user_logged_in())
		{
			get_currentuserinfo();
			$userID = $current_user->data->ID;
			
			// Get gallery details
			$gallery_details = $nggdb->find_gallery($gallery_id);
			if(is_object($gallery_details))
			{
				if($userID == $gallery_details->author)
				{
					// $image_details = $nggdb->find_image($image_id);
					if($image_details->exclude == 0)
					{
						
						if(is_object($image_details))
						{
							if($gallery_id == $image_details->galleryid)
							{
								$image_name = $image_details->alttext;
								$image_description = $image_details->description;
							 	$big_prev_image = kriesi_user_thumb($image_details->imageURL, array('size'=> array('L'),
																				'wh' => $k_option['custom']['imgSize']['L'],
							 													'img_attr' => array('title'=>$image_name),
																				'link_attr' => array('title'=>$image_name),
																				'display_link' => array('lightbox'), 
																				'linkurl' => array ('XL','_preview_big')
																				));
							 	
								echo $big_prev_image;
								if(isset($image_description) && $image_description != '')
								{
									echo '<strong>Description</strong><br />';
									echo $image_description;
								}
							}
							else
							{
								$image_list_url = get_bloginfo('wpurl') . '/images/?gallery_id=' . $gallery_id;
								echo "You do not have permission to view this image. <a href='".$image_list_url."' title='Go Back'>Go Back</a>.";
							}
						}
						else
						{
							$image_list_url = get_bloginfo('wpurl') . '/images/?gallery_id=' . $gallery_id;
							echo "This image does not exists. <a href='".$image_list_url."' title='Go Back'>Go Back</a>.";
						}
					}
					else
					{
						$image_list_url = get_bloginfo('wpurl') . '/images/?gallery_id=' . $gallery_id;
						echo "You do not have permission to view this image. <a href='".$image_list_url."' title='Go Back'>Go Back</a>.";
					}
				}
				else
				{
					$gallery_list_url = get_bloginfo('wpurl') . '/galleries/';
					echo "You do not have permission to view this gallery. <a href='".$gallery_list_url."' title='Go Back'>Go Back</a>.";
				}
			}
			else
			{
				$gallery_list_url = get_bloginfo('wpurl') . '/galleries/';
				echo "This gallery does not exists. <a href='".$gallery_list_url."' title='Go Back'>Go Back</a>.";
			}
		}
		else
		{
			$login_url = wp_login_url(get_permalink());
			echo "To view your galleries you need to <a href='".$login_url."' title='Login'>Login</a>.";
		}
	}
	else
	{
		$gallery_list_url = get_bloginfo('wpurl') . '/galleries/';
		echo "Wrong gallery. <a href='".$gallery_list_url."' title='Go Back'>Go Back</a>.";
	}
}
else
{
	$image_list_url = get_bloginfo('wpurl') . '/images/?gallery_id=' . $gallery_id;
	echo "Wrong image. <a href='".$image_list_url."' title='Go Back'>Go Back</a>.";
}

// End content div
echo '	</div>';

$k_option['showSidebar'] = 'frontpage';

get_sidebar();

get_footer();
// End main div
// echo '</div>';
?>