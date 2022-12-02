<?php 
include_once('config2.php');
if(isset($_REQUEST['Name']) !="" and $_REQUEST['Phone'] !="" and $_REQUEST['app'] !="" and $_REQUEST['target']!=""){
	extract($_REQUEST);
	$db->delete('users',array('Name'=>$Name,
					//	'Phone'=> '+'. trim($Phone), (substr($string, 0, 1) == ' ')?$x = 1:$x = 2;
					'Phone'=> (substr($Phone, 0, 1) == ' ')? '+'. trim($Phone):$Phone,
				//	'chat_id'=>$row[0]['chat_id'],
					'application'=>$app,
					'target_group'=>$target,
	
	));
	header('location: browse-users.php?msg=del-success');
	exit;
}
?>