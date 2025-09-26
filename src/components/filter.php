<div class="">
	<form id="filter-form" class="filter-form">
		<select id="filter-sort" name="sort">
			<option value="price-asc">Price: low to height</option>
			<option value="price-desc">Price: height to low</option>

			<option value="created_at-asc">Date: low to height</option>
			<option value="created_at-desc">Date: height to low</option>

			<option value="title-asc">Name: A-Z</option>
			<option value="title-desc">Name: Z-A</option>
		</select>

		<input type="search" name="search" id="form-search"/>
		<?php include "components/category.php" ?>
	</form>
</div>

<script>
	const form = document.getElementById("filter-form");
	const searchinput = document.getElementById("form-search");

	form.addEventListener("submit", (e) => {
		e.preventDefault()
	})
	
	const search = debounce(async() => {
			resetPage()
			const res = await getData();
			const parent = document.getElementById("item-list");
			parent.innerHTML = res;
			updateList();
	}, 300);

	form.addEventListener("change", (e) => {
		if (e.target.id === "form-search") return;
		search();
	})
	searchinput.addEventListener("input", (e)=> {
		search();
	})
	
</script>