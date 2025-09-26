<?php
include 'components/head.php';
include 'db/index.php';

$cart_result = $conn->query('SELECT itemId FROM Cart');
$inCart = [];

if ($cart_result->num_rows > 0) {
	while ($cart_row = $cart_result->fetch_assoc()) {
		$inCart[$cart_row['itemId']] = true;
	}
}

$queryParams = [];
parse_str($_SERVER['QUERY_STRING'], $queryParams);
$id = $queryParams['id'];
$sql = "SELECT * FROM Items WHERE id = $id LIMIT 1";
$data = $conn->query($sql)->fetch_assoc();
?>
<body>
	<?php include 'components/header.php'; ?>
	<main class="main">
		<div class="item-page">
			<div class="">
				<img src="<?= $data['image'] ?>"  alt="Image of <?= $data['title'] ?>" class="item-image">
			</div>
			<div class="item-content">
				<strong><?= $data['title'] ?></strong>
				<p><?= $data['about'] ?></p>
				<span>Category: <?= $data['category'] ?></span>
				<span>Price: <?= $data['price'] ?></span>
				<span>Created_at: <?= $data['created_at'] ?></span>
				<button class="add-to-cart-btn" data-item-id="<?= $data['id'] ?>" <?= isset($inCart[$data['id']]) ? "disabled" : '' ?>>
					<?php echo isset($inCart[$data['id']]) ? "In Cart" : "Add to cart"; ?>
				</button>
			</div>
		</div>
	<?php include 'components/popup.php'; ?>

	</main>
</body>
</html>

<script>
	updateList();
	</script>