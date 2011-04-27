<?php
$gallery_params = $_POST['gallery_params'];

if(!empty($gallery_params)){

include('../../../wp-blog-header.php');
header("HTTP/1.1 200 OK");
include_once(WINABSPATH.'/wp-content/plugins/agni_fb/fbmain.php');

  if($fbme){
    $decrypted = decrypt($gallery_params,'1a2g3n4i5');
    $decrypted = explode('*',$decrypted);
    
    $filecaption = $decrypted[1];
    $filepath = $decrypted[0];
    
    $photos = array('0'=>$filepath);
    
    foreach($photos as $key=>$value){
    	$uploadstatus = $facebook->api("/me/photos", 'post',
    	array('source'  =>  '@'.$photos[$key],
    		  'message' => $filecaption));
    	if(!empty($uploadstatus['id'])){
        echo '<pre>Success: Image Uploaded to Facebook!</pre>';
      }
      else{
        echo '<pre>Error: Something Went Wrong!</pre>';
      }
    }  
  }
  else{
    echo '<pre>Error: You Seemed to have Logged out From Facebook, Please Refresh Page & Login to Facebook Again</pre>';
  }
}
else{
  echo '<pre>Error: Stop Hacking Around!</pre>';
}
?>