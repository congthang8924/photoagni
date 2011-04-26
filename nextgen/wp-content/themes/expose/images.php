<?php
/*
Template Name: Images
*/

get_header();
include_once(WINABSPATH.'/wp-content/plugins/agni_fb/fbmain.php');

error_reporting('E_ALL');
//$config['baseurl'] = get_bloginfo('url').'/galleries';
//$config['baseurl'] = 'http://acenik.x10hosting.com/nextgen/';
?>
<script type="text/javascript" src="http://fotoflexer.com/API/ff_api_v1_01.js"></script>
<style>
.fb_button_simple{
float: left;
}

.edit_pic,.share_fb_logged{
cursor: pointer;
}
</style>
<div id="fb-root"></div>
<?php
global $ngg, $nggdb, $wp_query;

$gallery_id = $_GET['gallery_id'];
$gallery_details = $nggdb->find_gallery($gallery_id);

echo '<div id="feature_info">';
echo '<h2>'.$gallery_details->title.'</h2>';
echo '<div id="result">hello</div>';
echo '</div>';

echo '<div id="main">';
echo '	<div class="content the_gallery">';

if(isset($gallery_id) && $gallery_id != 0)
{
	if(is_user_logged_in())
	{
		get_currentuserinfo();
		$userID = $current_user->data->ID;
		
		// Get gallery details
		// $gallery_details = $nggdb->find_gallery($gallery_id);
		if(is_object($gallery_details))
		{
			if($userID == $gallery_details->author)
			{
				$loopcount = 0;
				$images_page_num = get_query_var('paged');
				$images_each_page = 9;
				
				if (!isset($images_page_num) || $images_page_num < 1 )
					$images_page_num = 1;
				
				$start = ($images_page_num - 1) * $images_each_page;
				
				$gallery_images = array();
				$gallery_images = $nggdb->get_gallery($gallery_id, '', '', TRUE, $images_each_page, $start, '');
				
				if(is_array($gallery_images) && count($gallery_images) > 0)
				{
					foreach($gallery_images as $key=>$gallery_image)
					{
						// Here starts the code generated for each gallery entry:
						$image_name = ucwords($gallery_image->alttext);
						$image_link = get_bloginfo('wpurl') . '/image/?gallery_id='.$gallery_details->gid.'&image_id=' . $gallery_image->pid;
						$image_description = $gallery_image->description;
						
						if ($loopcount === 0)
							echo  '<div class="entry">';
						
						$loopcount ++;
						$last = $loopcount === 3 ? 'last': '';
					
						// Get the images for the gallery entry, small and big size at a time
						$small_prev_image = kriesi_user_thumb($gallery_image->thumbURL, array('size'=> array('M','_preview_medium'),
																 	'wh' => $k_option['custom']['imgSize']['M'],
																 	'img_attr' => array('title'=>$image_name,
																 						'class'=>'item_small gallery_image'),
																	'display_link' => array('lightbox'), 
																	'linkurl' => array ('XL','_preview_big')
																	), $gallery_image->imageURL);
						

						$big_prev_image = kriesi_user_thumb($gallery_image->imageURL, array('size'=> array('L'),
																 	'wh' => $k_option['custom']['imgSize']['L'],
																 	'img_attr' => array('title'=>$image_name,
																 						'class'=>'item_big no_preload')
																	));
						
						// Output the entry with all the parameters gathered above
						echo "<div class='gallery_entry gallery_entry_$loopcount $last'>";
						echo "<div class='gallery_inner'>";
						echo "<a class='preloading gallery_image' href='".$image_link."'>";
						echo $small_prev_image;
						echo "</a>";
						
						?>
						<div class="post-ratings">
							<span class="edit_pic" id="<?php echo $gallery_image->filename.'*'.$gallery_id.'*'.$gallery_image->imageURL.'*'.$gallery_image->pid; ?>">
								<img title="Edit Picture" alt="Edit Picture" src="<?php echo get_bloginfo('template_url').'/images/edit_picture.png'; ?>" />
							</span>
								<?php
								if(!$fbme){ ?> 
									<span class="share_fb" id="<?php echo $gallery_image->alttext; ?>">
										<fb:login-button title="Upload to Facebook" size="icon" autologoutlink="false" perms="email,user_birthday,status_update,publish_stream"></fb:login-button>
									</span>    
    							<?php }else{
                    $enc_params_fb = encrypt($gallery_image->imagePath.'*'.$gallery_image->alttext,'1a2g3n4i5');
    							?>
    								<span class="share_fb_logged" id="<?php echo $enc_params_fb; ?>">
    									<img title="Upload to Facebook" alt="Upload to Facebook" src="<?php echo get_bloginfo('template_url').'/images/fb.gif'; ?>" />
    								</span>
    							<?php } ?>
							</span>
							<span class="share_flickr" id="<?php echo $gallery_image->filename.'*'.$gallery_id.'*'.$gallery_image->imageURL.'*'.$gallery_image->pid; ?>">
								<img title="Upload to Flickr" alt="Upload to Flickr" src="<?php echo get_bloginfo('template_url').'/images/flickr.png'; ?>" />
							</span>	
						</div>
						<?php
						// echo "<span class='comment_link'>";
						// comments_popup_link(__('0','expose'), __('1','expose'), __('%','expose'));
						// echo "</span>";
						// if(function_exists('the_ratings')) the_ratings();		
						echo "<div class='gallery_excerpt'>";
						if(isset($image_description) && $image_description != '')
						{							
							echo "<strong>Description</strong><br />";
							echo $image_description;
						}
						// echo get_the_excerpt();
						echo "</div>";
						echo "</div>";
						echo "<h3>".$image_name."</h3>";
						echo "</div>";
						
						if($loopcount == 3)
						{
							$loopcount = 0;
							echo  '</div>';
						}
					}
					if($loopcount !== 0)
					{
						echo'</div>';
					}
					kriesi_pagination(ceil($nggdb->paged['total_objects']/$nggdb->paged['objects_per_page']));
				}
				else
				{
					$add_gallery_url = get_bloginfo('wpurl') . '/wp-admin/admin.php?page=nggallery-add-gallery';
					echo "You haven't made any gallery or added images yet. <a href='".$add_gallery_url."' title='Add Gallery / Images'>Add Gallery / Images</a>.";
				}
			}
			else
			{
				$gallery_list_url = get_bloginfo('wpurl') . '/galleries/';
				echo "You do not have permission to view this gallery. <a href='".$gallery_list_url."' title='Go Back'>Go Back</a>.";
			}
		}
		else
		{
			$gallery_list_url = get_bloginfo('wpurl') . '/galleries/';
			echo "This gallery does not exists. <a href='".$gallery_list_url."' title='Go Back'>Go Back</a>.";
		}
	}
	else
	{
		$login_url = wp_login_url(get_permalink());
		echo "To view your galleries you need to <a href='".$login_url."' title='Login'>Login</a>.";
	}
}
else
{
	$gallery_list_url = get_bloginfo('wpurl') . '/galleries/';
	echo "Wrong gallery. <a href='".$gallery_list_url."' title='Go Back'>Go Back</a>.";
}

// End content div
echo '	</div>';

$k_option['showSidebar'] = 'frontpage';
?>
<script type="text/javascript">
	var ff_image_url;
	var ff_callback_url;
	var ff_cancel_url;
	var ff_lang;
	
	function ff_setup(img_src,gallery_id,img_name,img_id){
		ff_image_url = img_src;
		ff_callback_url = "<?php echo get_bloginfo('wpurl').'/wp-content/plugins/agni_fotoflexer/fotohandler.php?gal_id='; ?>"+gallery_id+"%26name="+img_name+"%26img_id="+img_id;
		ff_cancel_url = "<?php echo get_bloginfo('url').'/images?gallery_id=' ?>"+gallery_id;
		ff_lang = "en-US";
		ff_activate();
	}
</script>
<script type="text/javascript">
jQuery(document).ready(function($){

$('.edit_pic').click(function() {
	var params = $(this).attr('id');
	var myArray = params.split('*');
	ff_setup(myArray[2],myArray[1],myArray[0],myArray[3]);
});

$('.share_fb_logged').click(function() {
   var fb_params = $(this).attr('id');
   //alert(fb_params);
   $.ajax({
  	type: "POST",
  	url: "<?php echo get_bloginfo('wpurl').'/wp-content/plugins/agni_fb/fb_upload.php'; ?>",
    data: "gallery_params="+fb_params,
  	success: function(msg){
      $('#result').empty();
      $('#result').html(msg);
    }
   });
});

});
</script>
<script type="text/javascript">
            window.fbAsyncInit = function() {
                FB.init({appId: '<?php echo $fbconfig['appid' ]; ?>', status: true, cookie: true, xfbml: true});

                /* All the events registered */
                FB.Event.subscribe('auth.login', function(response) {
                    // do something with response
                    login();
                });
                FB.Event.subscribe('auth.logout', function(response) {
                    // do something with response
                    logout();
                });
            };
            (function() {
                var e = document.createElement('script');
                e.type = 'text/javascript';
                e.src = document.location.protocol +
                    '//connect.facebook.net/en_US/all.js';
                e.async = true;
                document.getElementById('fb-root').appendChild(e);
            }());

            function login(){
                document.location.href = "<?php echo get_bloginfo('url').'/'.$_SERVER['REQUEST_URI']; ?>";
            }
            function logout(){
                //document.location.href = "<?php echo get_bloginfo('url').'/'.$_SERVER['REQUEST_URI']; ?>";
            }
</script>

<?php
get_sidebar();

//get_footer();
// End main div
// echo '</div>';
?>