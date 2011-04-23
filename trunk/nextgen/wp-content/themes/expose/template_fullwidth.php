<?php
/*
Template Name: Full Width
*/ 

global $k_option, $blogpage, $contactpage;

get_header(); 

	
	// this outputs the headline on your mainpage within an h2 tag
	$headline = get_post_meta($post->ID, "_headline", true);
	if($headline!= '')
	{
		echo '<div id="feature_info">';
		echo '<h2>'.$headline.'</h2>';
		echo '</div>';	
	}
	
	

	echo '<div id="main" class="fullwidth">';
	echo '<div class="content">';
	echo '<div class="entry">';
	
	if (have_posts()) :
	while (have_posts()) : the_post();	
 	$more = 1;
 	
 	
 	
 	//get preview image
 	$big_prev_image = kriesi_post_thumb($post->ID, array('size'=> array('XL','_preview_medium'),
											'display_link' => array('lightbox'),
											'linkurl' => array ('XL','_preview_big'),
											'wh' => $k_option['custom']['imgSize']['XL']
											));
 	
	echo $big_prev_image;
	?>

	           
	           <div class="entry-head">
	           	   <h1 class="siteheading">
						<a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','newscast')?> <?php the_title(); ?>">
						<?php the_title(); ?>
						</a>
					</h1>
	           </div>
	          
	           
	           <div class="entry-content">
	           
	           <?php the_content(); ?>
	 			<?php edit_post_link('Edit', '', ''); ?>
	 			<!--end entry-content-->
	 			</div>
	 			
	 			
	 			</div>

 			<?
		
		endwhile;
		endif;
		
		echo "</div>";
	
	get_footer();
 
		?>			