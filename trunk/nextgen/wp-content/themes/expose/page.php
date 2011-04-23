<?php 
###############################################################################################
# Check if the page displayed has a different template applied within the custom admin page
# if thats the case display the template file, otherwise display the basic page template
###############################################################################################

global $k_option, $blogpage, $contactpage;
######################################################################
# Check for blog and contact pages
######################################################################
if ($post->ID == $k_option['contact']['contact_page']) $contactpage = true;
else if ($post->ID == $k_option['blog']['blog_page']) $blogpage = true;
else if ($post->ID == $k_option['contact']['submit_page']) $submittpage = true;


######################################################################
# Include page templates if other template is applied to the page
######################################################################
if($contactpage)
{
	include(TEMPLATEPATH."/template_contact.php");
}
else if($blogpage)
{
	include(TEMPLATEPATH."/template_blog.php");
}
else if($submittpage)
{
	include(TEMPLATEPATH."/template_submit_site.php");
}
else
{


######################################################################
# Display Basic Page
######################################################################

get_header(); 


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
 	
 	
 	
 	//get preview image
 	$big_prev_image = kriesi_post_thumb($post->ID, array('size'=> array('L'),
													 'wh' => $k_option['custom']['imgSize']['L'],
													 'display_link' => array('lightbox'), 
													'linkurl' => array ('XL','_preview_big'),
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

	$k_option['showSidebar'] = 'page';
	get_sidebar();
	
	get_footer();
 }
		?>			