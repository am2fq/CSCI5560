<?php 
include_once('config2.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$db->delete('api',array('target_group'=>$_REQUEST['delId']));
	header('location: browse-groups.php?msg=deleted&editId='.$_REQUEST['delId']);
	exit;
}
?>