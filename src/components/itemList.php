<div class="item-list" id="item-list">
	<?php
	include "item.php";
	$data = $conn->query('SELECT * FROM Items LIMIT 9');
	$cart_result = $conn->query('SELECT itemId FROM Cart');
	$inCart = [];

	if ($cart_result->num_rows > 0) {
		while ($cart_row = $cart_result->fetch_assoc()) {
			$inCart[$cart_row['itemId']] = true;
		}
	}

	if ($data->num_rows > 0) {
		while ($row = $data->fetch_assoc()) {
			echo item($row, $inCart);
		}
	}
	?>
</div>

<script>
	document.querySelectorAll(".add-to-cart-btn").forEach(btn => {
		btn.addEventListener("click", async (e) => {
			const params = new URLSearchParams({itemId: btn.getAttribute("data-item-id")});
			const res = await fetch("/api/cart.php?"+params, {method: "POST"}).then(res => res.json());
			document.dispatchEvent(new CustomEvent("addToCart"));
			e.target.disabled = true;
			e.target.innerText = "In Cart";
		})
	})

	let page = 1;
	const parent = document.getElementById("item-list");
	
	async function handleScroll() {		
		if (window.innerHeight + window.scrollY + 100 >= document.documentElement.scrollHeight ) {
			console.log(page);
				const params = new URLSearchParams({page});
				const res = await fetch("/api/items.php?"+params).then(async res => res.ok && await res.text());		
				if (!res) return;
				parent.insertAdjacentHTML("beforeend", res)
				page++;
		}
	};
		window.addEventListener("scroll", debounce(handleScroll, 100));
</script>