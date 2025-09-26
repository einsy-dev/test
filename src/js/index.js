function debounce(cb, delay) {
	let timer;
	return (...args) => {
		const context = this;
		clearTimeout(timer);
		timer = setTimeout(() => {
			cb.apply(context, args)
		}, delay)
	}
};

function updateList() {
	document.querySelectorAll(".add-to-cart-btn").forEach(btn => {
		btn.addEventListener("click", (e) => {
			const params = new URLSearchParams({ itemId: btn.getAttribute("data-item-id") });
			fetch("/api/cart.php?" + params, { method: "POST" }).then(res => res.json()).then(() => {
				document.dispatchEvent(new CustomEvent("addToCart"));
				e.target.disabled = true;
				e.target.innerText = "In Cart";
			})
		})
	})
}