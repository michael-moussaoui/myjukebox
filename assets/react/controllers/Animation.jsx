import React, { useState, useEffect } from "react";
import axios from "axios";
import { useKeenSlider } from "keen-slider/react";

import "keen-slider/keen-slider.min.css";
import "../../styles/reactcss.module.css";

export default function App() {
	const [categories, setCategories] = useState([]);
	const [selectedCategory, setSelectedCategory] = useState(null);

	useEffect(() => {
		axios
			.get("/category")
			.then((response) => {
				setCategories(response.data);
				// console.log(response.data);
			})
			.catch((error) => {
				console.log(error);
			});
	}, []);

	const handleCategoryClick = (category) => {
		fetch("/music/category/{categoryId}")
			.then((response) => response.json())
			.then((songs) => {
				setSelectedCategory(category);
				setSongs(songs);
			});
	};

	const carousel = (slider) => {
		const z = 300;
		function rotate() {
			const deg = 360 * slider.track.details.progress;
			slider.container.style.transform = `translateZ(-${z}px) rotateY(${-deg}deg)`;
		}
		slider.on("created", () => {
			const deg = 360 / slider.slides.length;
			slider.slides.forEach((element, idx) => {
				element.style.transform = `rotateY(${
					deg * idx
				}deg) translateZ(${z}px)`;
			});
			rotate();
		});
		slider.on("detailsChanged", rotate);
	};
	const [sliderRef] = useKeenSlider(
		{
			loop: true,
			selector: ".carousel__cell",
			renderMode: "custom",
			mode: "free-snap",
		},
		[carousel]
	);
	return (
		<div className="wrapper">
			<div className="scene">
				<div className="carousel keen-slider" ref={sliderRef}>
					{/* {categories.map((category, index) => (
						<div key={index} className="carousel__cell">
							<img
								className="img360"
								src={`/uploads/${category.picture}`}
							></img>
						</div>
					))} */}
					<div className="carousel__cell ">
						<img className="img360" src="/img/jukebox.png"></img>
					</div>
					<div className="carousel__cell number-slide2">Zouk</div>
					<div className="carousel__cell number-slide3">Disco</div>
					<div className="carousel__cell number-slide4">Pop</div>
					<div className="carousel__cell number-slide5">Reggae</div>
					<div className="carousel__cell number-slide6">Hip-hop</div>
					<div className="carousel__cell number-slide2">Rock</div>
					<div className="carousel__cell number-slide1">Funk</div>
				</div>
			</div>
		</div>
	);
}
