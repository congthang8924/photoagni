<?php
 	get_header(); 
	$categoryArchive = false;

	// this outputs the headline on your mainpage within an h2 tag

		echo '<div id="feature_info">';
		?>
		<h2><?php /* If this is a category archive */ if (is_category()) { ?>				
				<?php _e('Archive for','expose'); ?>  "<?php echo single_cat_title(); ?>"
				
 			  	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<?php _e('Archive for','expose'); ?>  "<?php the_time('F jS, Y'); ?>"
				
			 	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<?php _e('Archive for','expose'); ?>  "<?php the_time('F, Y'); ?>"
			
				<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<?php _e('Archive for','expose'); ?>  "<?php the_time('Y'); ?>"
				
			  	<?php /* If this is a search */ } elseif (is_search()) { ?>
				<?php _e('Search Results','expose'); ?> 
				
			  	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<?php _e('Author Archive','expose'); ?> 
			
				<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<?php _e('Blog Archives','expose'); ?> 
				<?php } ?></h2>
		<?php
		echo '</div>';	
	
	
	//check if its a gallery category and change the template accordingly
	if(is_category())
	{
		$galleryCats = explode(',',$k_option['gallery']['gallery_cat_final']);
		
		$currentCategory = get_the_category(); 
		$currentCategory = $currentCategory[0]->cat_ID;

		
		foreach($galleryCats as $checkCategory)
		{
			if(is_category($checkCategory))
			{
				$categoryArchive = true;
			}
		}
	}
		
	if($categoryArchive == true)
	{	
	$k_option['showSidebar'] = 'gallery';
	
	//start the loop that generates the entries
	$loopcount = 0;
	
	echo '<div id="main">';
	echo '<div class="content the_gallery">';
	
	if (have_posts()) :
	while (have_posts()) : the_post();	
	
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
	
	}
	else	// default archive template
	{
	$k_option['showSidebar'] = 'blog';

	echo '<div id="main">';
	echo '<div class="content">';
	echo '<div class="entry">';
	

	if (have_posts()) :
	while (have_posts()) : the_post();
 	$more = 0;
 	
 	
 	
 	//get preview image
 	$small_prev_image = kriesi_post_thumb($post->ID, array('size'=> array('M','_preview_medium'),
													 'wh' => $k_option['custom']['imgSize']['M'],
													 'img_attr' => array('class'=>'alignleft'),
													 'display_link' => array('permalink') 
													));
	?>

	           <span class="date">
	           		<span class='date_day'><?php the_time('d') ?></span>
	           		<span class='date_month'><?php the_time('M') ?></span>
	           </span>
	           
	           <div class="entry-head bloghead">
	           	   <h1 class="siteheading">
						<a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','expose')?> <?php the_title(); ?>">
						<?php the_title(); ?>
						</a>
					</h1>
	           	   <span class="author"><?php _e('written by','expose');?> <?php the_author_posts_link(); ?></span>
	               <span class="comments"><?php comments_popup_link(__('No Comments','expose'), __('1 Comment','expose'), __('% Comments','expose')); ?></span>
	               <span class='categories'><?php _e('posted in','expose');?> <?php the_category(', '); ?></span>
	           </div>
	          
	           
	           <div class="entry-content archiveentry">
	           
	           <?php 
	           echo $small_prev_image;
	           the_excerpt(); 
	           ?>
	 			<a href="<?php echo get_permalink() ?>" class="more-link"><?php _e('Read more','expose'); ?></a>
	 			<!--end entry-content-->
	 			</div>
	 			
	 			
	 			<div class="hr"><a href="#top" class="scrollTop">top</a></div>
 			<?
		
		endwhile;
		endif;
		
		kriesi_pagination();
		echo "</div></div>";
	}
	get_sidebar();
	
	get_footer();
?>			

