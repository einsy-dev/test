<?php
$servername = "mysql";
$username = "root";
$password = "example";
$dbname = "db";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";

if ($conn->query($sql) === TRUE) {
	$conn->select_db($dbname);
}

$createItemsTable = "CREATE TABLE IF NOT EXISTS Items (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(255) NOT NULL,
	about VARCHAR(255) NOT NULL,
	category VARCHAR(255) NOT NULL,
	image VARCHAR(255) NOT NULL,
	price INT(64) UNSIGNED DEFAULT(0),
	created_at DATE NOT NULL
)";

$conn->query($createItemsTable);

$createCartTable = "CREATE TABLE IF NOT EXISTS Cart (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	itemId INT(6) UNSIGNED NOT NULL,
	quantity INT(6) UNSIGNED NOT NULL
)";

$prep = $conn->prepare($createCartTable);
$prep->execute();

if (!file_exists("db/seed.json")) {
	return;
}

$seedData = json_decode(file_get_contents("db/seed.json"), true)["data"];
if ($conn->query("SELECT * FROM Items")->num_rows === 0) {
	for ($i = 0; $i < count($seedData); $i++) {
		$title = $seedData[$i]["title"];
		$about = $seedData[$i]["description"];
		$category = $seedData[$i]["category"];
		$image = $seedData[$i]["image"];
		$price = $seedData[$i]["price"];
		$date = $seedData[$i]["date"];
		$query = "INSERT INTO Items (title, about, category, image, price, created_at) VALUES ('$title', '$about', '$category', '$image', '$price', '$date');";
		$conn->query($query);
	}
}