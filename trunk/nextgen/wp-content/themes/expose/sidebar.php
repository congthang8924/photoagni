<?php 
global $k_option, $custom_widget_area;

			##############################################################################
			# Display the sidebar menu
			##############################################################################

				$default_sidebar = true;
				
				echo "<div class='sidebar'>";
				
				//gallery controlls:
				echo "<div class='display_buttons'>";
				echo "<a href='#' id='item_small' class='display'><span>Compact</span></a>";
				echo "<a href='#' id='item_medium' class='display'><span>Detailed</span></a>";
				echo "<a href='#' id='item_large' class='display'><span>Large</span></a>";
				echo "</div>";
					
					
				//Frontpage sidebars:
				if ($k_option['showSidebar'] == 'frontpage' && dynamic_sidebar('Frontpage Sidebar') ) : $default_sidebar = false; endif;
				
				// general blog sidebars
				if ($k_option['showSidebar'] == 'blog' && dynamic_sidebar('Sidebar Blog') ) : $default_sidebar = false; endif;
				
				// general gallery sidebars
				if ($k_option['showSidebar'] == 'gallery' && dynamic_sidebar('Sidebar Gallery') ) : $default_sidebar = false; endif;
				
				// general pages sidebars
				if ($k_option['showSidebar'] == 'page' && dynamic_sidebar('Sidebar Pages') ) : $default_sidebar = false; endif;
				
				
				
				//unique Page sidebars:
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('Page: '.$custom_widget_area) ) : $default_sidebar = false; endif;
				
				//unique Category sidebars
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('Category: '.$custom_widget_area) ) : $default_sidebar = false; endif;
								
				//sidebar area displayed everywhere
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('Displayed Everywhere')) : $default_sidebar = false; endif;
				
				//default dummy sidebar
				if ($default_sidebar && $k_option['includes']['dummy_sidebars'] == 1)
				{
					
					if(is_page()){
					?>
					<div class="box_small box widget community_news"><h3 class="widgettitle">Features we offer</h3>		
						<div class="entry box_entry">
						<h4>Absolutley Striking Designs</h4>
						
						<img class="rounded alignleft noborder" src="<?php echo bloginfo('template_url'); ?>/files/blueprint.png" alt="" title="" /><p>Lorem ipsum dolor sit amet, usmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
					
						<div class="entry box_entry">
						<h4>Multiple color options to choose from</h4>
						
						<img class="rounded alignleft noborder" src="<?php echo bloginfo('template_url'); ?>/files/brush.png" alt="" title="" /><p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
						
						<div class="entry box_entry">
						<h4>Unique Features with every theme</h4>
						
						<img class="rounded alignleft noborder" src="<?php echo bloginfo('template_url'); ?>/files/pencil.png" alt="" title="" /><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
						</div>
					
					<!--end box-->
					</div>	
					<div class='box box_small widget_archive'>
			            <h3>Archive</h3>
						<ul>
			            <?php wp_get_archives('type=monthly'); ?>
			            </ul>
		            </div>
					
					
					<?php }else{ ?>
					<div class='box box_small widget_categories'>
		            	<h3>Categories</h3>
						<ul>
			            <?php wp_list_cats('sort_column=name&optioncount=0&hierarchical=0'); ?>
			            </ul>
		            </div>
	
					<div class='box box_small widget_archive'>
			            <h3>Archive</h3>
						<ul>
			            <?php wp_get_archives('type=monthly'); ?>
			            </ul>
		            </div>

					<div class='box box_small'>
		            	<h3>Pages</h3>
						<ul>
			            <?php wp_list_pages('title_li=&depth=-1' ); ?>
			            </ul>
		            </div>
	
					<div class='box box_small widget_archive'>
			            <h3>Bloggroll</h3>
						<ul>
			            <?php wp_list_bookmarks('title_li=&categorize=0&hierarchical=0'); ?>
			            </ul>
		            </div>
				<?php
					}
				}
				echo "</div>";

	       	?>	         