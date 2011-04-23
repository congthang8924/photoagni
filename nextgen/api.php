<?php
include('wp-blog-header.php');
include('wp-content/plugins/next-gen/admin/functions.php');

//$username = $_POST['username'];
//$device_id = $_POST['device_id'];
//$image = $_FILES['image']['name'];

//nggAdmin::create_gallery('testapi345','/wp-content/gallery/');

global $nggdb;
		
// WPMU action
if (nggWPMU::check_quota())
	return;

// Images must be an array
$imageslist = array();

// get selected gallery
$galleryID = (int) $_POST['galleryselect'];

if ($galleryID == 0) {
	nggGallery::show_error(__('No gallery selected !','nggallery'));
	return;	
}

// get the path to the gallery	
$gallery = $nggdb->find_gallery($galleryID);

if ( empty($gallery->path) ){
	nggGallery::show_error(__('Failure in database, no gallery path set !','nggallery'));
	return;
} 

// read list of images
$dirlist = nggAdmin::scandir($gallery->abspath);

$imagefiles = $_FILES['imagefiles'];


if (is_array($imagefiles)) {
	foreach ($imagefiles['name'] as $key => $value) {

		// look only for uploded files
		if ($imagefiles['error'][$key] == 0) {
			
			$temp_file = $imagefiles['tmp_name'][$key];
			
			//clean filename and extract extension
			$filepart = nggGallery::fileinfo( $imagefiles['name'][$key] );
			$filename = $filepart['basename'];
				
			// check for allowed extension and if it's an image file
			$ext = array('jpg', 'png', 'gif'); 
			if ( !in_array($filepart['extension'], $ext) || !@getimagesize($temp_file) ){ 
				nggGallery::show_error('<strong>' . $imagefiles['name'][$key] . ' </strong>' . __('is no valid image file!','nggallery'));
				continue;
			}

			// check if this filename already exist in the folder
			$i = 0;
			while ( in_array( $filename, $dirlist ) ) {
				$filename = $filepart['filename'] . '_' . $i++ . '.' .$filepart['extension'];
			}
			
			$dest_file = $gallery->abspath . '/' . $filename;
			
			//check for folder permission
			if ( !is_writeable($gallery->abspath) ) {
				$message = sprintf(__('Unable to write to directory %s. Is this directory writable by the server?', 'nggallery'), $gallery->abspath);
				nggGallery::show_error($message);
				return;				
			}
			
			// save temp file to gallery
			if ( !@move_uploaded_file($temp_file, $dest_file) ){
				nggGallery::show_error(__('Error, the file could not be moved to : ','nggallery') . $dest_file);
				nggAdmin::check_safemode( $gallery->abspath );		
				continue;
			} 
			if ( !nggAdmin::chmod($dest_file) ) {
				nggGallery::show_error(__('Error, the file permissions could not be set','nggallery'));
				continue;
			}
			
			// add to imagelist & dirlist
			$imageslist[] = $filename;
			$dirlist[] = $filename;

		}
	}
}


if (count($imageslist) > 0) {	
	// add images to database		
	$image_ids = nggAdmin::add_Images($galleryID, $imageslist);

	//create thumbnails
	//nggAdmin::do_ajax_operation( 'create_thumbnail' , $image_ids, __('Create new thumbnails','nggallery') );
	nggAdmin::create_thumbnail($image_ids[0]);
	
	//add the preview image if needed
	nggAdmin::set_gallery_preview ( $galleryID );
	
	nggGallery::show_message( count($image_ids) . __(' Image(s) successfully added','nggallery'));
}
?>