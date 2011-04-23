<?php global $k_option; ?>
			<!--end main-->
		</div>
	<!-- end center-->
	</div>
<!--end wrapper-->
</div>

<div class="wrapper fullwidth" id='wrapper_footer'>

		<div class="center">
		
		<div id="footer">
			
			<?php 
			$columns = 1;
			$add_class = '';
			foreach ($k_option['custom']['footer'] as $footer_widget) //iterates 3 times creating 3 footer widget areas
			{
				echo '<div class="one_third '.$add_class.'">';
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer - Column '.$columns) ) : $default_widget[$footer_widget] = true; endif; 
				
				if(!isset($default_widget[$footer_widget]) && $k_option['includes']['dummy_footer'] != 2)
				{
					//calling the placeholding content defined at the bottom of this file
					display_placeholder($footer_widget);
				}
				echo '</div>';
				$columns++;
				$add_class = '';
				if($columns == 3)
				{
					$add_class = 'last';
					$columns = 1;
				}
			} 
			
			?>
	<!-- end footer-->
	</div>
<!--end center-->	
</div>	
	
	
<!--end wrapper -->
</div>

<div id="footer_bottom" class="wrapper">

	<div class="center">
		<span class="copyright">All content Copyright &copy; <a href="<?php echo get_settings('home'); ?>/"><?php echo get_bloginfo('name'); ?></a></span>
		<a href="http://crshare.com/" class="scrollTop">Worpress Themes</a>
		<a href="http://crshare.net" class="scrollTop">CRSHARE.NET&nbsp;-&nbsp;</a>
		<a href="http://www.kriesi.at" class="scrollTop">Design by Kriesi.at&nbsp;-&nbsp;</a>
	<!-- end center -->
	</div>

<!-- end footer -->
</div>
<?php wp_footer();

if($k_option['general']['analytics']) echo $k_option['general']['analytics'];
?>
</body>
</html>


<?php
################################################################################################################
// these are the placeholder that get displayed if nothing is put into a footer widget areas in your 
// wordpress backend at appearance->widgets
################################################################################################################


function display_placeholder($whichone)
{	
	if($whichone == 'left')
	{ ?>
		<div class='box_small box widget'>
        	<h3>Pages</h3>
			<ul>
            <?php wp_list_pages('title_li=&depth=-1' ); ?>
            </ul>
        </div>
	<?php
	}
	
	if($whichone == 'center')
	{ ?>
		<div class='box_small box widget'>
        	<h3>Categories</h3>
			<ul>
            <?php wp_list_cats('sort_column=name&optioncount=0&hierarchical=0'); ?>
            </ul>
        </div>
	<?php
	}

	if($whichone == 'right')
	{ ?>
		<div class="box_small box widget">
			<h3>Contribute to our Site!</h3>
			<p>Consectetur adipisicing elit tempor incididunt ut labore. Sed do eiusmod tempor incididunt ut labore. Consectetur adipisicing elit.</p>
			<p class="small_block"><img class="ie6fix noborder alignleft" src="<?php echo bloginfo('template_url'); ?>/images/skin1/injection.png" alt="" />If you want to contribute tutorials, news or other stuff please contact us. </p>
			<p class="small_block"><img class="ie6fix noborder alignleft" src="<?php echo bloginfo('template_url'); ?>/images/skin1/tag-green.png" alt="" />Consectetur adipisicing elit. Sed do eiusmod tempor incididunt ut labore.</p>
			<p class="small_block"><img class="ie6fix noborder alignleft" src="<?php echo bloginfo('template_url'); ?>/images/skin1/blueprintsticky.png" alt="" />This site uses valid HTML and CSS. All content Copyright &copy; 2010 Expose, Inc</p>
			<p class="small_block"><img class="ie6fix noborder alignleft" src="<?php echo bloginfo('template_url'); ?>/images/skin1/rssorange.png" alt="" />If you like what we do, please don't hestitate and subscribe to our <a href="<?php bloginfo('rss2_url'); ?>">RSS Feed.</a></p>
		</div>
	<?php
	}
}


?>