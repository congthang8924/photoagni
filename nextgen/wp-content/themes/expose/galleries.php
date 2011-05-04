<?php
/*
Template Name: Galleries
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
echo '<div id="feature_info">';
echo '<h2>Galleries</h2>';
echo '</div>';

echo '<div id="main">';
echo '	<div class="content the_gallery">';

if(is_user_logged_in())
{
	global $ngg, $nggdb, $wp_query;
	
	get_currentuserinfo();
	$userID = $current_user->data->ID;
	
	$loopcount = 0;
	$gallery_page_num = get_query_var('paged');
	$gallery_each_page = 9;
	// $ngg->manage_page = new nggManageGallery();
	
	if (!isset($gallery_page_num) || $gallery_page_num < 1 )
		$gallery_page_num = 1;
	
	$start = ($gallery_page_num - 1) * $gallery_each_page;
	
	$galleries = array();
	$gallerylist = $nggdb->find_all_user_galleries('gid', 'DESC', TRUE, $gallery_each_page, $start, TRUE, $userID);
	
	if(is_array($gallerylist) && count($gallerylist) > 0)
	{
		foreach($gallerylist as $key=>$gallery)
		{
			if($gallery->counter > 0)
			{
				$random_image = $nggdb->get_random_images(1, $gallery->gid);
				$rand_keys = array_rand($random_image, 1);
				$random_image = $random_image[$rand_keys];
				$gallery->imageURL = $random_image->imageURL;
				$gallery->thumbURL = $random_image->thumbURL;
				$galleries[$key] = $gallery;
			}
		}
		foreach($galleries as $key=>$gallery)
		{
			if($gallery->counter > 0)
			{
				// Here starts the code generated for each gallery entry:
				$gallery_name = $gallery->title;
				$gallery_link = get_bloginfo('wpurl') . '/images/?gallery_id=' . $gallery->gid;
				$gallery_desc = $gallery->galdesc;
				$no_of_photos = $gallery->counter;
				
				if ($loopcount === 0)
					echo  '<div class="entry">';
				
				$loopcount ++;
				$last = $loopcount === 3 ? 'last': '';
			
				// Get the images for the gallery entry, small and big size at a time
				$small_prev_image = kriesi_user_thumb($gallery->thumbURL, array('size'=> array('M','_preview_medium'),
														 	'wh' => $k_option['custom']['imgSize']['M'],
														 	'img_attr' => array('title'=>$gallery_name,
														 						'class'=>'item_small')
															));
				
				
				$big_prev_image = kriesi_user_thumb($gallery->imageURL, array('size'=> array('L'),
														 	'wh' => $k_option['custom']['imgSize']['L'],
														 	'img_attr' => array('title'=>$gallery_name,
														 						'class'=>'item_big no_preload'),
															));
				
				// Output the entry with all the parameters gathered above
				echo "<div class='gallery_entry gallery_entry_$loopcount $last'>";
				echo "<div class='gallery_inner'>";
				echo "<a class='preloading gallery_image' href='".$gallery_link."'>";
				echo $small_prev_image;
				echo "</a>";
				// echo "<span class='comment_link'>";
				// comments_popup_link(__('0','expose'), __('1','expose'), __('%','expose'));
				// echo "</span>";
				// if(function_exists('the_ratings')) the_ratings();		
				echo "<div class='gallery_excerpt'>";
				echo "<strong>Description</strong><br />";
				echo $no_of_photos . " Photos<br />";
				echo $gallery_desc;
				echo "</div>";
				echo "</div>";
				echo "<h3><a href='".$gallery_link."'>".$gallery_name."</a></h3>";
				echo "</div>";
				
				if($loopcount == 3)
				{
					$loopcount = 0;
					echo  '</div>';
				}
			}
		}
		if($loopcount !== 0)
		{
			echo'</div>';
		}
		// $ngg->manage_page->pagination( 'bottom', $start, $nggdb->paged['total_objects'], $nggdb->paged['objects_per_page']  );
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
	$login_url = wp_login_url(get_permalink());
	echo "To view your galleries you need to <a href='".$login_url."' title='Login'>Login</a>.";
}

// End content div
echo '	</div>';

$k_option['showSidebar'] = 'frontpage';

//get_sidebar();

//get_footer();
// End main div
// echo '</div>';
?>