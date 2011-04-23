<?php 
global $k_option, $blogpage, $contactpage;


get_header(); 


	// this outputs the headline on your mainpage within an h2 tag

		echo '<div id="feature_info">';
		echo '<h2>'.__('We are very sorry, unfortunatley we couldn\'t find the page you are requesting','expose').'</h2>';
		echo '</div>';	
	
	
	

	echo '<div id="main">';
	echo '<div class="content">';
	echo '<div class="entry">';
	?>
	 <h2> <?php _e('ERROR 404','expose'); ?></h2>
	<h4> <?php _e('We are sorry, the page you are looking for does not exist','expose'); ?></h4>
	<p><?php _e('You might try to use our Site search or try to browse the site with the help of the main navigation menu','expose'); ?></p> 
		

	<?php	
	echo "</div></div>";
	
	$k_option['showSidebar'] = 'page';
	get_sidebar();
	
	get_footer();

		?>			
	