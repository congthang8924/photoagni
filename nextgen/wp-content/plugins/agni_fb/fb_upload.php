<?php
include('../../../wp-blog-header.php');
include_once(WINABSPATH.'/wp-content/plugins/agni_fb/fbmain.php');

echo "<pre>";
print_r($facebook);
exit();

$file = $_GET['f'];
$photos = array('0'=>$file);


foreach($photos as $key=>$value){
	$uploadstatus = $facebook->api("/me/photos", 'post',
	array('source'  =>  '@'.$photos[$key],
		  'message' => 'Test'));
}
?>