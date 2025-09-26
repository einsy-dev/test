<div class="item-list" id="item-list">
	<?php
	include "components/item.php";
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
	updateList();

	async	function getData(page = 0) {
			const form = document.getElementById("filter-form");
			const params = new URLSearchParams({page});
			const formData = new FormData(form);
			const res = await fetch("/api/items.php?"+params, {method: "POST", body: formData }).then(async res => res.ok && await res.text());
			return res;
	};

	let page = 1;
	function resetPage() {  
		page = 0
	};
	const parent = document.getElementById("item-list");
	
	async function handleScroll() {		
		if (window.innerHeight + window.scrollY + 100 >= document.documentElement.scrollHeight ) {
				const res = await getData(page);		
				if (!res) return;
				parent.insertAdjacentHTML("beforeend", res);
				page++;
		}
	};
		window.addEventListener("scroll", debounce(handleScroll, 100));
</script>