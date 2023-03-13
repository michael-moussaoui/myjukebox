console.log("test");

const slideCategories = document.querySelector(".mySwiper");
slideCategories.addEventListener("click", (e) => {
	let categoryClicked = e.target.dataset.category;
	console.log(categoryClicked);
});
