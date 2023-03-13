// const test1 = imageMusic.attributes.dataset.song;
// console.log(test1);
// const songInfo = getAttribute("data-amplitude-song-info");
// const myMusic = element.getAttribute("data-song");
const content = document.querySelector(".content");

console.log("hello from play.js");
const containerFavorite = document.querySelector(
	".containerFavorite"
);

const tilt = $(".tilt").tilt({
	maxTilt: 20,
	perspective: 1000,
	easing: "cubic-bezier(.03,.98,.52,.99)",
	speed: 1200,
});

// Playimage = content.querySelector(".music-image img");
// musicName = content.querySelector(".music-titles .name");
// musicArtist = content.querySelector(".music-titles .artist");
// const Audio = document.querySelector(".main-song");
playBtn = content.querySelector("#play-pause");
playBtnIcon = document.querySelector("#play-pause span");
animPlay = document.querySelector(".containerPlay");
// progressBar = content.querySelector(".progress-bar");
// progressDetails = content.querySelector(".progress-details");
// const muteVolume = document.getElementById("volume");

var playPauseButton = document.getElementById("play-pause");

playPauseButton.addEventListener("click", function () {
	if (Amplitude.getPlayerState() == "playing") {
		playBtnIcon.innerHTML = "Pause";
		animPlay.classList.add("active");
	} else {
		playBtnIcon.innerHTML = "Play_arrow";
		animPlay.classList.remove("active");
	}
});
