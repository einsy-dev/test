<header>
	<div class="logo">
		<a href="/">
		LOGO
		</a>
	</div>
	<div class="cart-container">
		<a href="/cart.php">
			<div class="cart">CART</div>
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
</script>