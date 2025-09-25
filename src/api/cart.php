<?php
header("Content-Type: application/json");
include '../db/seed.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
	case "POST":
		$queryParams = [];
		parse_str($_SERVER['QUERY_STRING'], $queryParams);
		echo json_encode(value: $queryParams);
}