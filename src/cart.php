<?php 
include 'components/head.php';
include 'db/index.php' 
?>
<body>
<?php include 'components/header.php'; ?>
	<main class="main">
		<button id="cart-clear-btn">Clear cart</button>
		<div class="cart-item-list">
			<?php $data = $conn->query('SELECT * FROM Cart INNER JOIN Items ON Cart.itemId = Items.id');
			if ($data->num_rows > 0) {
				while ($row = $data->fetch_assoc()) { ?>
					<div class="cart-item">
						<img src="/images/image.jpg" alt="Image of <?= $row['title'] ?>" class="cart-item-image">
						<div class="">
							<?php echo $row['id'] . $row['title'] ?>
						</div>
						<div class="">
							price: <?=  $row['price'] ?>
						</div>
						<button class="cart-item-remove-btn" data-item-id="<?php echo $row['id'] ?>">Remove</button>
					</div>
					<?php
				}
			}
			?>
			</div>
			<div class="cart-total">
				<?php 
					$sql = "SELECT SUM(price) AS total FROM Cart INNER JOIN Items ON Cart.itemId = Items.id";
					$result = $conn->query($sql)->fetch_assoc();
					echo $result['total'];
				?>
			</div>
		</main>
</body>
</html>

<script>
	document.getElementById("cart-clear-btn").addEventListener("click", () => {
		document.querySelectorAll(".cart-item-remove-btn").forEach(btn => btn.click())
	})

	document.querySelectorAll(".cart-item-remove-btn").forEach(btn => {
		btn.addEventListener("click", async () => {
			const params = new URLSearchParams({ itemId: btn.getAttribute("data-item-id") });
			const res = await fetch("/api/cart.php?" + params, { method: "DELETE" }).then(res => res.json());
			window.location.reload();
		})
	})
</script>
