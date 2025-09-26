<?php
include 'components/head.php';
include 'db/index.php';

$queryParams = [];
parse_str($_SERVER['QUERY_STRING'], $queryParams);
$id = $queryParams['id'];
$sql = "SELECT * FROM Items WHERE id = $id LIMIT 1";
$data = $conn->query($sql)->fetch_assoc();
echo "" . $data["title"] . "";
?>
<body>
	<?php include 'components/header.php'; ?>
	<main class="main">
		
	</main>
</body>
</html>