<?php
	$jsonArray = json_encode($songs);
?>

<script>

$(document).ready(function() {
	var newPlaylist = <?php echo $jsonArray; ?>;

	Zeerius.audioElement = new Audio();
	setTrack(newPlaylist[0], newPlaylist, false);
	updateVolumeProgressBar(Zeerius.audioElement.audio);


	$("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e) {
		e.preventDefault();
	});


	$(".playbackBar .progressBar").mousedown(function() {
		Zeerius.mouseDown = true;
	});

	$(".playbackBar .progressBar").mousemove(function(e) {
		if(Zeerius.mouseDown == true) {
			//Set time of song, depending on position of mouse
			timeFromOffset(e, this);
		}
	});

	$(".playbackBar .progressBar").mouseup(function(e) {
		timeFromOffset(e, this);
	});


	$(".volumeBar .progressBar").mousedown(function() {
		Zeerius.mouseDown = true;
	});

	$(".volumeBar .progressBar").mousemove(function(e) {
		if(Zeerius.mouseDown == true) {

			var percentage = e.offsetX / $(this).width();

			if(percentage >= 0 && percentage <= 1) {
				Zeerius.audioElement.audio.volume = percentage;
			}
		}
	});

	$(".volumeBar .progressBar").mouseup(function(e) {
		var percentage = e.offsetX / $(this).width();

		if(percentage >= 0 && percentage <= 1) {
			Zeerius.audioElement.audio.volume = percentage;
		}
	});

	$(document).mouseup(function() {
		Zeerius.mouseDown = false;
	});




});

function timeFromOffset(mouse, progressBar) {
	var percentage = mouse.offsetX / $(progressBar).width() * 100;
	var seconds = Zeerius.audioElement.audio.duration * (percentage / 100);
	Zeerius.audioElement.setTime(seconds);
}

function prevSong() {
	if(Zeerius.audioElement.audio.currentTime >= 3 || Zeerius.currentIndex == 0) {
		Zeerius.audioElement.setTime(0);
	}
	else {
		Zeerius.currentIndex = Zeerius.currentIndex - 1;
		setTrack(Zeerius.currentPlaylist[Zeerius.currentIndex], Zeerius.currentPlaylist, true);
	}
}

function nextSong() {
	if(Zeerius.repeat == true) {
		Zeerius.audioElement.setTime(0);
		playSong();
		return;
	}

	if(Zeerius.currentIndex == Zeerius.currentPlaylist.length - 1) {
		Zeerius.currentIndex = 0;
	}
	else {
		Zeerius.currentIndex++;
	}

	var trackToPlay = Zeerius.shuffle ? Zeerius.shufflePlaylist[Zeerius.currentIndex] : Zeerius.currentPlaylist[Zeerius.currentIndex];


	setTrack(trackToPlay, Zeerius.currentPlaylist, true);
}

function setRepeat() {
	Zeerius.repeat = !Zeerius.repeat;
	var imageName = Zeerius.repeat ? "repeat-active.png" : "repeat.png";
	$(".controlButton.repeat img").attr("src", "images/icons/" + imageName);
}

function setMute() {
	Zeerius.audioElement.audio.muted = !Zeerius.audioElement.audio.muted;
	var imageName = Zeerius.audioElement.audio.muted ? "volume-mute.png" : "volume.png";
	$(".controlButton.volume img").attr("src", "images/icons/" + imageName);
}

function setShuffle() {
	Zeerius.shuffle = !Zeerius.shuffle;
	var imageName = Zeerius.shuffle ? "shuffle-active.png" : "shuffle.png";
	$(".controlButton.shuffle img").attr("src", "images/icons/" + imageName);

	if(Zeerius.shuffle == true) {
		//Randomize playlist
		shuffleArray(Zeerius.shufflePlaylist);
		Zeerius.currentIndex = Zeerius.shufflePlaylist.indexOf(Zeerius.audioElement.currentlyPlaying.id);
	}
	else {
		//shuffle has been deactivated
		//go back to regular playlist
		Zeerius.currentIndex = Zeerius.currentPlaylist.indexOf(Zeerius.audioElement.currentlyPlaying.id);
	}

}

function shuffleArray(a) {
    var j, x, i;
    for (i = a.length; i; i--) {
        j = Math.floor(Math.random() * i);
        x = a[i - 1];
        a[i - 1] = a[j];
        a[j] = x;
    }
}


function setTrack(trackId, newPlaylist, play) {

	if(newPlaylist != Zeerius.currentPlaylist) {
		Zeerius.currentPlaylist = newPlaylist;
		Zeerius.shufflePlaylist = Zeerius.currentPlaylist.slice();
		shuffleArray(Zeerius.shufflePlaylist);
	}

	if(Zeerius.shuffle == true) {
		Zeerius.currentIndex = Zeerius.shufflePlaylist.indexOf(trackId);
	}
	else {
		Zeerius.currentIndex = Zeerius.currentPlaylist.indexOf(trackId);
	}
	pauseSong();

	$.get( siteURL + "/rest/song/" + trackId, function(track) {

		$(".trackName span").text(track.title);

		$(".trackInfo .artistName span").text(track.artist_name);
		$(".trackInfo .artistName span").attr("onclick", "openPage('artist.php?id=" + track.artist + "')");

		$(".content .albumLink img").attr("src", track.photo);
		$(".content .albumLink img").attr("onclick", "openPage('album.php?id=" + track.album + "')");
		$(".trackInfo .trackName span").attr("onclick", "openPage('album.php?id=" + track.album + "')");

		Zeerius.audioElement.setTrack(track);

		if(play == true) {
			playSong();
		}
	});

}

function playSong() {

	if(Zeerius.audioElement.audio.currentTime == 0) {
		$.post("rest/song/update-count-play", { songId: Zeerius.audioElement.currentlyPlaying.id });
	}

	$(".controlButton.play").hide();
	$(".controlButton.pause").show();
	$('.tracklistContainer').find('.curr-played').removeClass('curr-played');
	$('.song-' + Zeerius.audioElement.currentlyPlaying.id).find('.trackName').addClass('curr-played');
	Zeerius.audioElement.play();
}

function pauseSong() {
	$(".controlButton.play").show();
	$(".controlButton.pause").hide();
	Zeerius.audioElement.pause();
}
</script>

<div id="nowPlayingBarContainer">

	<div id="nowPlayingBar">

		<div id="nowPlayingLeft">
			<div class="content">
				<span class="albumLink">
					<img role="link" tabindex="0" src="" class="albumArtwork">
				</span>

				<div class="trackInfo">

					<span class="trackName">
						<span role="link" tabindex="0"></span>
					</span>

					<span class="artistName">
						<span role="link" tabindex="0"></span>
					</span>

				</div>



			</div>
		</div>

		<div id="nowPlayingCenter">

			<div class="content playerControls">

				<div class="buttons">

					<button class="controlButton shuffle" title="Shuffle button" onclick="setShuffle()">
						<img src="images/icons/shuffle.png" alt="Shuffle">
					</button>

					<button class="controlButton previous" title="Previous button" onclick="prevSong()">
						<img src="images/icons/previous.png" alt="Previous">
					</button>

					<button class="controlButton play" title="Play button" onclick="playSong()">
						<img src="images/icons/play.png" alt="Play">
					</button>

					<button class="controlButton pause" title="Pause button" style="display: none;" onclick="pauseSong()">
						<img src="images/icons/pause.png" alt="Pause">
					</button>

					<button class="controlButton next" title="Next button" onclick="nextSong()">
						<img src="images/icons/next.png" alt="Next">
					</button>

					<button class="controlButton repeat" title="Repeat button" onclick="setRepeat()">
						<img src="images/icons/repeat.png" alt="Repeat">
					</button>

				</div>


				<div class="playbackBar">

					<span class="progressTime current">0.00</span>

					<div class="progressBar">
						<div class="progressBarBg">
							<div class="progress"></div>
						</div>
					</div>

					<span class="progressTime remaining">0.00</span>


				</div>


			</div>


		</div>

		<div id="nowPlayingRight">
			<div class="volumeBar">

				<button class="controlButton volume" title="Volume button" onclick="setMute()">
					<img src="images/icons/volume.png" alt="Volume">
				</button>

				<div class="progressBar">
					<div class="progressBarBg">
						<div class="progress"></div>
					</div>
				</div>

			</div>
		</div>




	</div>

</div>