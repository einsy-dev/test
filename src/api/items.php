<?php
include '../db/index.php';
include '../components/item.php';
header("Content-Type: text/html");

$method = $_SERVER['REQUEST_METHOD'];

$queryParams = [];
parse_str($_SERVER['QUERY_STRING'], $queryParams);
$page = ($queryParams['page'] ?? 0) * 9;

$cart_result = $conn->query('SELECT itemId FROM Cart');
$inCart = [];
if ($cart_result->num_rows > 0) {
	while ($cart_row = $cart_result->fetch_assoc()) {
		$inCart[$cart_row['itemId']] = true;
	}
}

switch ($method) {
	case 'GET':
		$sql = "SELECT * FROM Items LIMIT 9 OFFSET $page";
		$data = $conn->query($sql);

		while ($row = $data->fetch_assoc()) {
			echo item($row, $inCart);
		}
		break;
	case "POST":
		$search = $_POST["search"];
		$sort = explode("-", $_POST["sort"]); // contain field and asc/desc
		$dir = strtoupper(end($sort));
		$cat = $_POST["category"];
		$sqlCat = "";
		if (!empty($cat)) {
			$sqlCat = " AND category = '$cat'";
		}
		$sql = "SELECT * FROM Items WHERE (title LIKE '$search%' $sqlCat) ORDER BY $sort[0] $dir LIMIT 9 OFFSET $page";
		$data = $conn->query($sql);

		while ($row = $data->fetch_assoc()) {
			echo item($row, $inCart);
		}
		break;
}