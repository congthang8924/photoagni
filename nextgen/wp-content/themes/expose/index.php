<?php get_header(); 

	// this outputs the headline on your mainpage within an h2 tag
	if($k_option['general']['headline'] != '')
	{
		echo '<div id="feature_info">';
		echo '<h2>'.$k_option['general']['headline'].'</h2>';
		echo '</div>';	
	}
	
	
	//start the loop that generates the entries
	$loopcount = 0;
	$additional_loop = new WP_Query("paged=$paged&cat=".$k_option['gallery']['gallery_cat_final']."&posts_per_page=".$k_option['gallery']['post_count']);
	
	
	echo '<div id="main">';
	echo '<div class="content the_gallery">';
	
	if ($additional_loop->have_posts()) :
	while ($additional_loop->have_posts()) : $additional_loop->the_post();
	
	//here starts the code generated for each gallery entry:
	if ($loopcount === 0) echo  '<div class="entry">';
	$loopcount ++;
	$last = $loopcount === 3 ? 'last': '';
	
	$postlink = get_permalink(); 									//internal post link
	$external = get_post_meta($post->ID, "_external", true); 	//external link from customfield
	$featured = get_post_meta($post->ID, "_prev_featured", true); 	//check if post gets a featured badge
		
	//set link for postimage depending on the backend option settings
	$imagelink = $k_option['gallery']['image_link'] == 'permalink' ? $postlink : $external;
	
	
	//set link for posttitle depending on the backend option settings
	$titlelink = $k_option['gallery']['name_link'] == 'permalink' ? $postlink : $external;
	
	//get the images for the gallery entry, small and big size at a time
	$small_prev_image = kriesi_post_thumb($post->ID, array('size'=> array('M','_preview_medium'),
													 'wh' => $k_option['custom']['imgSize']['M'],
													 'img_attr' => array('class'=>'item_small')	
													));
													
													
	$big_prev_image = kriesi_post_thumb($post->ID, array('size'=> array('L'),
													 'wh' => $k_option['custom']['imgSize']['L'],
													 'img_attr' => array('class'=>'item_big no_preload')	
													));
	
	
	//output the entry with all the parameters gathered above
	echo "<div class='gallery_entry gallery_entry_$loopcount $last'>";
	echo "<div class='gallery_inner'>";
	echo "<a class='preloading gallery_image' href='".$imagelink."'>";
	if($featured == 'yes') echo "<span class='featured_entry'></span>";
	echo $small_prev_image;
	echo $big_prev_image;
	echo "</a>";
	echo "<span class='comment_link'>";
	comments_popup_link(__('0','expose'), __('1','expose'), __('%','expose'));
	echo "</span>";
	if(function_exists('the_ratings')) the_ratings();		
	echo "<div class='gallery_excerpt'>";
	echo get_the_excerpt();
	echo "</div>";
	echo "</div>";
	echo "<h3><a href='".$titlelink."'>".get_the_title()."</a></h3>";
	echo "</div>";
	
	
	if($loopcount == 3)
	{
		$loopcount = 0;
		echo  '</div>';
	}
	endwhile;
	if($loopcount !== 0) echo'</div>';
	endif;
	
		
	kriesi_pagination($additional_loop->max_num_pages);
	#end content
	echo '</div>';

	$k_option['showSidebar'] = 'frontpage';
	get_sidebar();
	
	get_footer();
?>			

