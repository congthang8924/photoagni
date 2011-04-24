<?php
include('../../../wp-blog-header.php');
include('../next-gen/admin/functions.php');

// Parse paramters to get Image and thumbnail urls
$image = $_GET['image'];
// Verify that the URL begins with "http://fotos.fotoflexer.com"
// This step is used to ensure that the image is in authentic

if (strpos($image, "http://fotos.fotoflexer.com") != 0){
  //Handle the error:
  echo "Invalid Origin";
  exit;
}

$gal_id = $_GET['gal_id'];
$name = $_GET['name'];
$img_id = $_GET['img_id'];
$gallery_details = $nggdb->find_gallery($gal_id);

// Set the local file path for the image and thumbnail
$image_path = $gallery_details->abspath."/".$name;



// Image source and content have been verified, and a location has been set.
// Now copy the images to the local server.

copy($image,$image_path);
nggAdmin::create_thumbnail($img_id);

$link = get_bloginfo('url').'/images?gallery_id='.$gal_id.'&edit=1';
wp_redirect($link);
?>
