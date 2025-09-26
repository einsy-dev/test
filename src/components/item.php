<?php 
function item($row, $inCart) {
	ob_start();
?>
	<div class="item-card">
		<a href="/item.php?<?= "id=" . $row['id'] ?>">
			<img src="<?= $row["image"]?>" alt="Image of <?= $row['title'] ?>" class=".list-item-image">
		</a>
		<div class="item-card-content">
			<h3 class="item-title"><?= $row['title'] ?></h3>
			<p class="item-description"><?= $row['about'] ?></p>				
			<div class="price-container">
				<p class="item-price"><?= $row['price'] ?></p>
				<button class="add-to-cart-btn" data-item-id="<?= $row['id'] ?>" <?= isset($inCart[$row['id']]) ? "disabled" : '' ?>>
					<?php	echo isset($inCart[$row['id']]) ? "In Cart" : "Add to cart";?>
				</button>
			</div>
		</div>
	</div>

<?php
	$html = ob_get_clean();
		return $html;
}