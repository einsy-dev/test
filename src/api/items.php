<?php
header("Content-Type: application/json");
include '../db/index.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
	case 'GET':
		$data = $conn->query('SELECT * FROM Items');
		$result = [];
		while ($row = $data->fetch_assoc()) {
			$result[] = $row;
		}
		echo json_encode($result);
}