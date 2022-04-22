<?php
if(isset($_GET['id'],$_GET['node'],$_GET['status'],$_GET['user'],$_GET['count'],$_GET['ip'],$_GET['resolve'],$_GET['date1'],$_GET['date2'])){
	$id = $_GET['id'];
	$node = $_GET['node'];
	$status = $_GET['status'];
	$user = $_GET['user'];
	$count = $_GET['count'];
	$ip = $_GET['ip'];
	$resolve = $_GET['resolve'];
	$date1 = $_GET['date1'];
	$date2 = $_GET['date2'];
	$uniq = str_pad(rand(0,999), 5, "0", STR_PAD_LEFT);
	
	$data = $id.'|'.$node.'|'.$count.'|'.$status.'|'.$user.'|'.$ip.'|'.$resolve.'|'.$date1.'|'.$date2;
	file_put_contents('log/log_ssh_'.date("j.n.Y").'.log', $data."\n", FILE_APPEND);
}
?>
