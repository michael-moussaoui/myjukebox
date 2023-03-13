import React, { useEffect, useState } from "react";
// import axios from "axios";
// import { Swiper, SwiperSlide } from "swiper/react";
// import "swiper/css";

function Swiper({ category }) {
	const [musics, setMusics] = useState([]);

	const handleImageClick = async () => {
		const response = await fetch(`/music/category/${category}`);
		const data = await response.json();
		setMusics(data);
	};

	return (
		<div>
			<img
				src={`uploads/foo/${category.picture}.jpg`}
				alt={category}
				onClick={handleImageClick}
			/>
			{musics.map((music) => (
				<div key={music.id}>
					<img src={music.cover} alt={music.title} />
					<h2>{music.title}</h2>
					<p>{music.artist}</p>
					<audio src={music.song} controls />
				</div>
			))}
		</div>
	);
}

export default Swiper;
