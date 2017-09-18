<?php
	$db = mysqli_connect('localhost', 'root', '', 'hospitalManagement');
	if($db->connect_error)
		die("not connected". $db->connect_error);
?>