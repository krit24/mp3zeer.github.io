<div class="entityInfo">

	<div class="leftSection">
		<img src="{{ $details->photo }}">
	</div>

	<div class="rightSection">
		<h2>{{ $details->album_name }}</h2>
		<p role="link" tabindex="0" onclick="openPage('artist.php?id=$artistId')">By {{ $details->artist_name }}</p>
		<p>{{ $details->number_of_songs }} songs</p>

	</div>

</div>


<div class="tracklistContainer">
	<ul class="tracklist">

		{{--*/ $ctr = 1 /*--}} 

		@foreach( $songs as $song )

			<li class='tracklistRow song-{{ $song->id }}'>
				<div class='trackCount'>
					<img class='play' src='images/icons/play-white.png' onclick='setTrack({{ $song->id }}, Zeerius.tempPlaylist, true)'>
					<span class='trackNumber'>{{ $ctr }}</span>
				</div>


				<div class='trackInfo'>
					<span class='trackName'>{{ $song->song_title }}</span>
					<span class='artistName'>{{ $song->artist_name }}</span>
				</div>

				<div class='trackOptions'>
					<input type='hidden' class='songId' value='" . $albumSong->getId() . "'>
					<img class='optionsButton' src='images/icons/more.png' onclick='showOptionsMenu(this)'>
				</div>

				<div class='trackDuration'>
					<span class='duration'>{{ $song->duration }}</span>
				</div>


			</li>

			{{--*/ $ctr++ /*--}} 

		@endforeach
		
		

	</ul>
</div>

<script type="text/javascript">
	// var album_permalink = "<?=strtolower(str_replace(" ", "-", $details->album_name))?>";
	// window.history.pushState('album', '', '/album/' + album_permalink);

	<?php
		$arr_song = array();
		foreach( $songs as $song ){
			array_push($arr_song, $song->id);
		}
	?>

	var tempSongIds = '<?php echo json_encode($arr_song); ?>';
	Zeerius.tempPlaylist = JSON.parse(tempSongIds);
</script>