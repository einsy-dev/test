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
