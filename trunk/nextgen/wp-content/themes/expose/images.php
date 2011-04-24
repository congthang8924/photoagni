<?php
/*
Template Name: Images
*/

get_header();

// include_once ( dirname (__FILE__) . '/../../plugins/next-gen/admin/functions.php' );	// admin functions
// include_once ( dirname (__FILE__) . '/../../plugins/next-gen/admin/manage.php' );	// nggallery_admin_manage_gallery

// This outputs the headline on your mainpage within an h2 tag
/*
if($k_option['general']['headline'] != '')
{
	echo '<div id="feature_info">';
	echo '<h2>'.$k_option['general']['headline'].'</h2>';
	echo '</div>';	
}
*/
$gallery_id = $_GET['gallery_id'];
$gallery_details = $nggdb->find_gallery($gallery_id);

echo '<div id="feature_info">';
echo '<h2>'.$gallery_details->title.'</h2>';
echo '</div>';

echo '<div id="main">';
echo '	<div class="content the_gallery">';

if(isset($gallery_id) && $gallery_id != 0)
{
	global $ngg, $nggdb, $wp_query;
	
	if(is_user_logged_in())
	{
		get_currentuserinfo();
		$userID = $current_user->data->ID;
		
		// Get gallery details
		// $gallery_details = $nggdb->find_gallery($gallery_id);
		if(is_object($gallery_details))
		{
			if($userID == $gallery_details->author)
			{
				$loopcount = 0;
				$images_page_num = get_query_var('paged');
				$images_each_page = 9;
				
				if (!isset($images_page_num) || $images_page_num < 1 )
					$images_page_num = 1;
				
				$start = ($images_page_num - 1) * $images_each_page;
				
				$gallery_images = array();
				$gallery_images = $nggdb->get_gallery($gallery_id, '', '', TRUE, $images_each_page, $start, '');
				
				if(is_array($gallery_images) && count($gallery_images) > 0)
				{
					foreach($gallery_images as $key=>$gallery_image)
					{
						// Here starts the code generated for each gallery entry:
						$image_name = $gallery_image->alttext;
						$image_link = get_bloginfo('wpurl') . '/image/?gallery_id='.$gallery_details->gid.'&image_id=' . $gallery_image->pid;
						$image_description = $gallery_image->description;
						
						if ($loopcount === 0)
							echo  '<div class="entry">';
						
						$loopcount ++;
						$last = $loopcount === 3 ? 'last': '';
					
						// Get the images for the gallery entry, small and big size at a time
						$small_prev_image = kriesi_user_thumb($gallery_image->thumbURL, array('size'=> array('M','_preview_medium'),
																 	'wh' => $k_option['custom']['imgSize']['M'],
																 	'img_attr' => array('title'=>$image_name,
																 						'class'=>'item_small')	
																	));
						
						
						$big_prev_image = kriesi_user_thumb($gallery_image->imageURL, array('size'=> array('L'),
																 	'wh' => $k_option['custom']['imgSize']['L'],
																 	'img_attr' => array('title'=>$image_name,
																 						'class'=>'item_big no_preload')	
																	));
						
						// Output the entry with all the parameters gathered above
						echo "<div class='gallery_entry gallery_entry_$loopcount $last'>";
						echo "<div class='gallery_inner'>";
						echo "<a class='preloading gallery_image' href='".$image_link."'>";
						echo $small_prev_image;
						echo $big_prev_image;
						echo "</a>";
						// echo "<span class='comment_link'>";
						// comments_popup_link(__('0','expose'), __('1','expose'), __('%','expose'));
						// echo "</span>";
						// if(function_exists('the_ratings')) the_ratings();		
						echo "<div class='gallery_excerpt'>";
						if(isset($image_description) && $image_description != '')
						{							
							echo "<strong>Description</strong><br />";
							echo $image_description;
						}
						// echo get_the_excerpt();
						echo "</div>";
						echo "</div>";
						echo "<h3><a href='".$image_link."'>".$image_name."</a></h3>";
						echo "</div>";
						
						if($loopcount == 3)
						{
							$loopcount = 0;
							echo  '</div>';
						}
					}
					if($loopcount !== 0)
					{
						echo'</div>';
					}
					kriesi_pagination(ceil($nggdb->paged['total_objects']/$nggdb->paged['objects_per_page']));
				}
				else
				{
					$add_gallery_url = get_bloginfo('wpurl') . '/wp-admin/admin.php?page=nggallery-add-gallery';
					echo "You haven't made any gallery or added images yet. <a href='".$add_gallery_url."' title='Add Gallery / Images'>Add Gallery / Images</a>.";
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

// End content div
echo '	</div>';

$k_option['showSidebar'] = 'frontpage';

get_sidebar();

get_footer();
// End main div
// echo '</div>';
?>