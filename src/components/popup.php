<div class="cookie-popup" id="popup">
	<span>
		Site using files cookie. Are you agree?
	</span>
	<button class="cookie-btn" id="cookie-btn">
		Agree
	</button>
</div>
<script>
	const btn = document.getElementById("cookie-btn");
	const popup = document.getElementById("popup");
	const isActive = localStorage.getItem("cookie_active");
	
	if (isActive === "false") {
		popup.remove()
	}
	btn.addEventListener("click", () => {
		localStorage.setItem("cookie_active", "false")
		popup.remove()
	})
</script>