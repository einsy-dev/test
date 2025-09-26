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