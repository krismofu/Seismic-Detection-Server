<?php

	header('Content-Type: application/json');
	$data = [];

	require_once('DB_Functions.php');

	$db = new DB_Functions();

	$result = $db->getUpdate();

	$data['data'] = $db->getUpdate();
	$data['count'] = count($data['data']);

	echo json_encode($data);
?>