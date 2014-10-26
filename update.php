<?php

	header('Content-Type: application/json');
	$data = [];

	if(isset($_GET['offset'])) {
		require_once('DB_Functions.php');

		$db = new DB_Functions();

		$data['data'] = $db->queryAll();
		$data['count'] = count($data['data']);
	} 
	else {		
		array_push($data, array('error' => 'no offset')); 
	}

	echo json_encode($data);
?>