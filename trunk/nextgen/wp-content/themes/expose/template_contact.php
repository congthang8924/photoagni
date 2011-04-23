<?php
/*
Template Name: Contact Form
*/

global $k_option;
$name_of_your_site = get_option('blogname');
$email_adress_reciever = $k_option['contact']['email'];

$errorC = true;
if(isset($_POST['Send']))
{
	include('send.php');	
}


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
						<a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','expose')?> <?php the_title(); ?>">
						<?php the_title(); ?>
						</a>
					</h1>
	           </div>
	          
	           
	           <div class="entry-content">
	           
	           <?php the_content(); ?>
	 			<?php edit_post_link('Edit', '', ''); ?>
	 			<form action="" method="post" class="ajax_form">
						<fieldset><?php if (!isset($errorC) || $errorC == true){ ?><h3><span><?php _e('Send us mail','expose'); ?></span></h3>
						
						<p class="<?php if (isset($the_nameclass)) echo $the_nameclass; ?>" ><input name="yourname" class="text_input is_empty" type="text" id="name" size="20" value='<?php if (isset($the_name)) echo $the_name?>'/><label for="name"><?php _e('Your Name','expose'); ?>*</label>
						</p>
						<p class="<?php if (isset($the_emailclass)) echo $the_emailclass; ?>" ><input name="email" class="text_input is_email" type="text" id="email" size="20" value='<?php if (isset($the_email)) echo $the_email ?>' /><label for="email"><?php _e('E-Mail','expose'); ?>*</label></p>
						<p><input name="website" class="text_input" type="text" id="website" size="20" value="<?php if (isset($the_website))  echo $the_website?>"/><label for="website"><?php _e('Website','expose'); ?></label></p>
						<label for="message" class="blocklabel"><?php _e('Your Message','expose'); ?>*</label>
						<p class="<?php if (isset($the_messageclass)) echo $the_messageclass; ?>"><textarea name="message" class="text_area is_empty" cols="40" rows="7" id="message" ><?php  if (isset($the_message)) echo $the_message ?></textarea></p>
						
						
						<p>
						
						<input type="hidden" id="myemail" name="myemail" value="<?php echo $email_adress_reciever; ?>" />
						<input type="hidden" id="myblogname" name="myblogname" value='<?php echo $name_of_your_site; ?>' />
						
						<input name="Send" type="submit" value="<?php _e('Send','expose'); ?>" class="button" id="send" size="16"/></p>
						<?php } else { ?> 
						<p><h3><?php _e('Your message has been sent!','expose'); ?> </h3> <?php _e('Thank you!','expose'); ?> </p>
						
						<?php } ?>
						</fieldset>
					</form>
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




					
					