<?php

 get_header(); 
 
 	//check if this is a gallery entry or a normal blog post
 	$gallery_cats = explode(", ",$k_option['gallery']['gallery_cat_final']);
 	$showStars = false;
 	$k_option['showSidebar'] = 'blog';
 	
 	if(isset($gallery_cats) && $k_option['gallery']['gallery_cat_final'] != '')
 	{
		foreach($gallery_cats as $value)
		{
			if (in_category($value)) 
			{
				$gallerypage = true;
				$k_option['showSidebar'] = 'gallery';
			}
		}
	}
 	
 	if($gallerypage && function_exists('the_ratings'))
 	{
 		$showStars = 'showStars';
 	}

	// this outputs the headline on your mainpage within an h2 tag
	$headline = get_post_meta($post->ID, "_headline", true);
	if($headline!= '')
	{
		echo '<div id="feature_info">';
		echo '<h2>'.$headline.'</h2>';
		echo '</div>';	
	}
	
	

	echo '<div id="main">';
	echo '<div class="content">';
	echo '<div class="entry">';
	
	if (have_posts()) :
	while (have_posts()) : the_post();	
 	$more = 1;
 	
 	
 	 $prev_image_link = get_post_meta($post->ID, "_prev_image_link", true);
 	
 	if($prev_image_link == 'none' || $prev_image_link == 'lightbox')
 	{
 		$prev_image_link = array($prev_image_link);
 	}
 	else
 	{
 		$prev_image_link = '_external';
 	}
 	
 	if(!$gallerypage) $prev_image_link = array('lightbox');
 	
 	
 	//get preview image
 	$big_prev_image = kriesi_post_thumb($post->ID, array('size'=> array('L'),
													 'wh' => $k_option['custom']['imgSize']['L'],
													 'display_link' => $prev_image_link, 
													'linkurl' => array ('XL','_preview_big')
													));
 	
	echo $big_prev_image;
	?>

	           <span class="date">
	           		<span class='date_day'><?php the_time('d') ?></span>
	           		<span class='date_month'><?php the_time('M') ?></span>
	           </span>
	           
	           <div class="entry-head bloghead">
	           	   <h1 class="siteheading">
						<a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','newscast')?> <?php the_title(); ?>">
						<?php the_title(); ?>
						</a>
					</h1>
	           	   <span class="author"><?php _e('written by','expose');?> <?php the_author_posts_link(); ?></span>
	               <span class="comments"><?php comments_popup_link(__('No Comments','expose'), __('1 Comment','expose'), __('% Comments','expose')); ?></span>
	               
	               <span class='categories <?php echo $showStars; ?>'><?php _e('posted in','expose');?> <?php the_category(', '); ?></span>	
	               <?php
	               if($showStars)
	               {
	               		echo '<span class="rating_label">'.__('Rating','expose').':</span>';
	               		the_ratings();
	               }
	               ?>
	               
	           </div>
	          
	           
	           <div class="entry-content">
	           
	           <?php the_content(); ?>
	 			<?php edit_post_link('Edit', '', ''); ?>
	 			<!--end entry-content-->
	 			</div>
	 			
	 			
	 			</div>
	 			<div class='entry commententries'>
           		<?php comments_template(); ?>
           		</div>
 			<?php
		
		endwhile;
		endif;
		
		echo "</div>";

	get_sidebar();
	
	get_footer();
?>