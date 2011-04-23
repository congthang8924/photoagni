<?php
/*
Template Name: Blog Overview
*/

 get_header(); 

	// this outputs the headline on your mainpage within an h2 tag
	if($k_option['general']['headline'] != '')
	{
		echo '<div id="feature_info">';
		echo '<h2>'.$k_option['blog']['headline'].'</h2>';
		echo '</div>';	
	}
	

	$negative_cats = preg_replace("!(\d)+!","-${0}$0", $k_option['gallery']['gallery_cat_final']);
	$query_string = "cat=".$negative_cats."&paged=$paged";
	

	// the query string now looks like this:
	// "cat=-3,-10-12&paged=$paged";
	// you can add additional query options if you want, all of them are described here:
	// http://codex.wordpress.org/Template_Tags/query_posts#Examples
	// append this parameters with the "&" sign
	
	// example: $query_string =  $query_string."&orderby=author&order=ASC";
	
	$additional_loop = new WP_Query($query_string);
	
	
	echo '<div id="main">';
	echo '<div class="content">';
	echo '<div class="entry">';
	
	if ($additional_loop->have_posts()) :
	while ($additional_loop->have_posts()) : $additional_loop->the_post();	
 	$more = 0;
 	
 	
 	
 	//get preview image
 	$big_prev_image = kriesi_post_thumb($post->ID, array('size'=> array('L'),
													 'wh' => $k_option['custom']['imgSize']['L'],
													 'display_link' => array($k_option['blog']['overview_image']), 
													'linkurl' => array ('XL','_preview_big'),
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
	               <span class='categories'><?php _e('posted in','expose');?> <?php the_category(', '); ?></span>
	           </div>
	          
	           
	           <div class="entry-content">
	           
	           <?php the_content(__('Read more &raquo;','expose')); ?>
	 
	 			<!--end entry-content-->
	 			</div>
	 			
	 			<?php edit_post_link('Edit', '', ''); ?>
	 			<div class="hr"><a href="#top" class="scrollTop">top</a></div>
 			<?
		
		endwhile;		
		else: 
		
			echo'<h2>'.__('Nothing Found','expose').'</h2>';
			echo'<p>'.__('Sorry, no posts matched your criteria','expose').'</p>';
			
		endif;
		
		kriesi_pagination($additional_loop->max_num_pages);
		echo "</div></div>";

	$k_option['showSidebar'] = 'blog';
	get_sidebar();
	
	get_footer();
?>			

