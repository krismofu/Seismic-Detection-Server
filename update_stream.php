<?php
	require_once('DB_Functions.php');
	$db = new DB_Functions();
	$result = $db->getUpdate();

	$data = array();

	foreach ($result as $key => $value) {
		$data[] = $value;
	}

	$json = array(
		'n' => count($result),
		'data' => $data
	);
	echo json_encode($json);

?>