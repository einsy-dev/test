<div class="">
	<form id="filter-form" class="filter-form">
		<select id="filter-sort" name="sort">
			<option value="price-asc">Price: low to height</option>
			<option value="price-desc">Price: height to low</option>

			<option value="date-asc">Date: low to height</option>
			<option value="date-desc">Date: height to low</option>

			<option value="title-asc">Name: A-Z</option>
			<option value="title-desc">Name: Z-A</option>
		</select>

		<input type="search" name="search" id="form-search"/>
	</form>
</div>

<script>
	const form = document.getElementById("filter-form");
	const searchinput = document.getElementById("form-search");

	form.addEventListener("submit", (e) => {
		e.preventDefault()
	})
	
	const search = debounce(async() => {
		const formData = new FormData(form);
			const res = await fetch("/api/items.php", {method: "POST", body: formData}).then(async res => res.ok && await res.text());	
			const parent = document.getElementById("item-list");
			parent.innerHTML = res;
	}, 300);

	form.addEventListener("change", (e) => {
		if (e.target.id === "form-search") return;
		search();
	})
	searchinput.addEventListener("input", (e)=> {
		search();
	})
	
</script>