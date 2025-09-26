<?php include "db/index.php"; ?>
<header>
	<div class="logo">
		<a href="/">
		LOGO
		</a>
	</div>
	<div class="cart-container">
		<a href="/cart.php">
			<div class="cart">CART</div>
			<div id="cart-count" class="">
				<?php
				$sql = "SELECT COUNT(*) as cart_total FROM Cart";
				$result = $conn->query($sql)->fetch_assoc();
				if ($result) {
					echo $result["cart_total"] || "";
				}
				?>
			</div>
		</a>
	</div>
</header>

<script>
	const header = document.querySelector("header")
	document.addEventListener("scroll", (e) => {
		if (document.body.getBoundingClientRect().top) {
			header.style.backgroundColor  = "white"
		} else {
			header.style.backgroundColor = ""
		}
	})

	document.addEventListener("addToCart", async () => {
		const params = new URLSearchParams({count: true});
		const res = await fetch("/api/cart.php?"+params).then(res => res.json());
		document.getElementById("cart-count").innerText = res
	})
</script>