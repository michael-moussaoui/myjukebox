import React, { useState, useEffect } from "react";
import axios from "axios";
import "../../styles/reactcss.module.css";

export default function ({ category }) {
	const [categories, setCategories] = useState([]);
	const [songs, setSongs] = useState([]);
	const [selectedCategory, setSelectedCategory] = useState(null);
	const [musics, setMusics] = useState([]);

	useEffect(() => {
		fetch("/category")
			.then((response) => response.json())
			.then((categories) => {
				setCategories(categories);
			});
		console.log(response);
	}, []);
	// useEffect(() => {
	// 	fetch(`/music/category/{categoryId}`)
	// 		.then((response) => response.json())
	// 		.then((songs) => {
	// 			setSongs(songs);
	// 			console.log(songs);
	// 		});
	// }, []);

	// const handleImageClick = async () => {
	// 	const response = await fetch(`/music/category/${category}`);
	// 	const data = await response.json();
	// 	setMusics(data);
	// 	// console.log(data);
	// };

	const handleCategoryClick = (categoryId) => {
		fetch(`/music/category/${categoryId}`)
			.then((response) => response.json())
			.then((songs) => {
				setSelectedCategory(categories);
				setSongs(songs);
			});
		// 	axios
		// 		.get(`/music/category/{categoryId}`)
		// 		.then((response) => {
		// 			setSongs(response.data.songs);
		// 		})
		// 		.catch((error) => {
		// 			console.log(error);
		// 		});
	};
	return (
		<div>
			<h1>Liste des categories</h1>
			{/* <ul>
				{categories.map((category, index) => (
					<li key={index}>
						<h2 className="test">{category.category}</h2>
						<p>{category.id}</p>
						<img
							src={`/uploads/${category.picture}`}
							onClick={() => handleCategoryClick(category.id)}
						></img>
					</li>
				))}
			</ul>
			{selectedCategory && (
				<div>
					<h2>Chansons par catégorie {selectedCategory}</h2>
					<ul>
						{songs.map((song, index) => (
							<li key={index}>
								<img src={`/uploads/${song.cover}`}></img>
							</li>
						))}
					</ul>
				</div>
			)} */}
		</div>
	);
}

// <div>
// 	<h1>Liste des categories</h1>
// 	<ul>
// 		{categories.map((category, index) => (
// 			<li key={index}>
// 				<h2 className="test">{category.category}</h2>
// 				<p>{category.id}</p>
// 				<img
// 					src={`/uploads/${category.picture}`}
// 					onClick={() => handleCategoryClick(category.id)}
// 				></img>
// 			</li>
// 		))}
// 	</ul>

// 	{songs.length > 0 && (
// 		<div>
// 			<h2>Chansons de la catégorie sélectionnée :</h2>
// 			<ul>
// 				{songs.map((song, index) => (
// 					<li key={index}>{song.title}</li>
// 				))}
// 			</ul>
// 		</div>
// 	)}
// </div>
