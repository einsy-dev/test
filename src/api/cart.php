<?php
header("Content-Type: application/json");
include '../db/index.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
	case 'GET':
		$queryParams = [];
		parse_str($_SERVER['QUERY_STRING'], $queryParams);
		if ($queryParams["count"]) {
			$data = $conn->query("SELECT COUNT(*) as count FROM Cart")->fetch_assoc();
			if ($data) {
				echo json_encode($count = $data["count"]);
			}
		} else {
			$result = [];
			$data = $conn->query('SELECT * FROM Cart');
			$result = [];
			while ($row = $data->fetch_assoc()) {
				$result[] = $row;
			}
			echo json_encode($result);
		}
		break;
	case "POST":
		$queryParams = [];
		parse_str($_SERVER['QUERY_STRING'], $queryParams);
		$itemId = $queryParams['itemId'];
		$quantity = $queryParams['quantity'] ?? 1;
		$sql = "INSERT INTO Cart (itemId, quantity) VALUES ($itemId, $quantity)";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		echo json_encode(value: $queryParams);
		break;
	case "PUT":
		break;
	case "DELETE":
		$queryParams = [];
		parse_str($_SERVER['QUERY_STRING'], $queryParams);
		$itemId = $queryParams['itemId'];
		$sql = "DELETE FROM Cart WHERE itemId = $itemId ";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		echo json_encode(value: $status = 200);
		break;
}