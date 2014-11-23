<?php
	require_once('DB_Functions.php');
	$db = new DB_Functions();
	$result = $db->getUpdate();

	$data = array();

	foreach ($result as $key => $value) {
		$data[] = [
			'device' => $key,
			'scale' => $value
		];
	}

	$json = array(
		'n' => count($result),
		'data' => $data,
		'alert' => $db->isGempa()
	);
	echo json_encode($json);

?>