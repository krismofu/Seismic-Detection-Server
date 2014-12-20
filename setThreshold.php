<?php
	require_once('DB_Functions.php');
	$db = new DB_Functions();

	if(isset($_POST['value'])) {
		$value = $_POST['value'];
		echo $db->setThreshold($value);
	}
?>