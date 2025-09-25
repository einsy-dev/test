<div class="item-list">
	<?php $data = $conn->query('SELECT * FROM Items');
	if ($data->num_rows > 0) {
		while ($row = $data->fetch_assoc()) { ?>
			<div class="item-card">
				<img src="/images/image.jpg" alt="Image of <?= $row['title'] ?>" class="item-image">
				<div class="item-card-content">
					<h3 class="item-title"><?= $row['title'] ?></h3>
					<p class="item-description"><?= $row['about'] ?></p>				
						<div class="price-container">
							<p class="item-price"><?= $row['price'] ?></p>
							<button class="add-to-cart-btn" data-item-id="<?= $row['id'] ?>" >Add to Cart</button>
						</div>
				</div>
			</div>
	<?php
		}
	}
	?>
</div>
<script>
	document.querySelectorAll(".add-to-cart-btn").forEach(btn => {
		btn.addEventListener("click", async (e) => {
			const params = new URLSearchParams({itemId: btn.getAttribute("data-item-id")})
			const res = await fetch("/api/cart.php?"+params, {method: "POST"}).then(res => res.json());
		})
	})
</script>