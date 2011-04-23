<?php

 	get_header(); 
	$categoryArchive = false;

	// this outputs the headline on your mainpage within an h2 tag

		echo '<div id="feature_info">';
		echo "<h2>";		
		_e('Search Results for','expose');
		echo " '".$_GET['s']."'";
		echo '</h2></div>';	
	
		
	echo '<div id="main">';
	echo '<div class="content">';
	echo '<div class="entry archive">';
	

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
		else: 
		
			echo'<h2>'.__('No search results','expose').'</h2>';
			echo'<p>'.__('Sorry, no posts matched your search criteria','expose').'</p>';
			
		endif;
		
		kriesi_pagination();
		echo "</div></div>";
	
	$k_option['showSidebar'] = 'blog';
	get_sidebar();
	
	get_footer();
?>			

