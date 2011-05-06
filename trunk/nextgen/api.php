<?php
include('wp-blog-header.php');
include('wp-content/plugins/next-gen/admin/functions.php');

$username = $_POST['username'];
if(isset($username) && $username != '')
{
	$user_ID = username_exists($username);
	if($user_ID)
	{
		global $nggdb;
		
		$gallery_name = $username;
		$device_id = $_POST['device_id'];
		
		// Images must be an array
		$imageslist = array();
		
		$user_info = get_userdata($user_ID);
		
		// WPMU action
		if (nggWPMU::check_quota())
			return;
		
		// Check if gallery exists or no. If not create a new gallery.
		$gallery = $nggdb->find_gallery_by_name($gallery_name);
		if(!is_object($gallery))
		{
			$galleryID = nggAdmin::create_gallery($gallery_name, 'wp-content/gallery/', FALSE);
			$gallery = $nggdb->find_gallery($galleryID);
		}
		else
		{
			$galleryID = $gallery->gid;
		}
		
		if ($galleryID == 0)
		{
			nggGallery::show_error(__('No gallery selected !','nggallery'));
			return;	
		}
		
		if (empty($gallery->path))
		{
			nggGallery::show_error(__('Failure in database, no gallery path set !','nggallery'));
			return;
		}
		
		$imagefiles = $_FILES['imagefiles'];
		
		if (is_array($imagefiles))
		{
			// Read list of images
			$dirlist = nggAdmin::scandir($gallery->abspath);
			
			foreach ($imagefiles['name'] as $key => $value)
			{
				// Look only for uploded files
				if ($imagefiles['error'][$key] == 0)
				{
					$temp_file = $imagefiles['tmp_name'][$key];
					
					// Clean filename and extract extension
					$filepart = nggGallery::fileinfo( $imagefiles['name'][$key] );
					$filename = $filepart['basename'];
						
					// Check for allowed extension and if it's an image file
					$ext = array('jpg', 'png', 'gif'); 
					if (!in_array($filepart['extension'], $ext) || !@getimagesize($temp_file))
					{ 
						nggGallery::show_error('<strong>' . $imagefiles['name'][$key] . ' </strong>' . __('is no valid image file!','nggallery'));
						continue;
					}
		
					// Check if this filename already exist in the folder
					$i = 0;
					while (in_array($filename, $dirlist))
					{
						$filename = $filepart['filename'] . '_' . $i++ . '.' .$filepart['extension'];
					}
					
					$dest_file = $gallery->abspath . '/' . $filename;
					
					// Check for folder permission
					if (!is_writeable($gallery->abspath))
					{
						$message = sprintf(__('Unable to write to directory %s. Is this directory writable by the server?', 'nggallery'), $gallery->abspath);
						nggGallery::show_error($message);
						return;				
					}
					
					// Save temp file to gallery
					if (!@move_uploaded_file($temp_file, $dest_file))
					{
						nggGallery::show_error(__('Error, the file could not be moved to : ','nggallery') . $dest_file);
						nggAdmin::check_safemode( $gallery->abspath );		
						continue;
					} 
					if (!nggAdmin::chmod($dest_file))
					{
						nggGallery::show_error(__('Error, the file permissions could not be set','nggallery'));
						continue;
					}
					
					// Add to imagelist & dirlist
					$imageslist[] = $filename;
					$dirlist[] = $filename;
				}
			}
		}
		if (count($imageslist) > 0)
		{	
			// Add images to database		
			$image_ids = nggAdmin::add_Images($galleryID, $imageslist);
		
			// Create thumbnails
			// nggAdmin::do_ajax_operation( 'create_thumbnail' , $image_ids, __('Create new thumbnails','nggallery') );
			nggAdmin::create_thumbnail($image_ids[0]);
			
			// Add the preview image if needed
			nggAdmin::set_gallery_preview ( $galleryID );
			
			nggGallery::show_message( count($image_ids) . __(' Image(s) successfully added','nggallery'));
		}
	}
	else
	{
		nggGallery::show_error( __('This user does not exists. Please input the right username to upload a photo.', 'nggallery') );die;
	}
}
?>