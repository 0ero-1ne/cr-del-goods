function showInputs() {
	const productType = document.getElementById('productType').value.toLowerCase() + '_input';
	const dynamicBlocks = document.querySelectorAll('.dynamic_block');

	dynamicBlocks.forEach(elem => {
		if (elem.classList.contains(productType)) {
			elem.style.display = "block";
			elem.querySelectorAll('input').forEach(elem => elem.setAttribute('required', 'required'));
		} else {
			elem.querySelectorAll('input').forEach(elem => elem.removeAttribute('required'));
			elem.style.display = "none";
		}
	});
}

document.addEventListener('DOMContentLoaded', () => {
	showInputs();
	document.getElementById('productType').addEventListener('change', showInputs);
});