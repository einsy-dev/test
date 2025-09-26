<?php
include_once "index.php";

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