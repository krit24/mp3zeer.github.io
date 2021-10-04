<h1 class="pageHeadingBig">You Might Also Like</h1>

<div class="gridViewContainer">

	@foreach( $albums as $album )

		<div class='gridViewItem'>

			<span role="" tabindex="0" onclick="javascript:Zeerius.loadAlbumSongs({{ $album['id'] }})">

			<img src="{{ $album['artworkPath'] }}">

			<div class='gridViewInfo'>
				{{ $album['title'] }}
			</div>

			</span>

		</div>

	@endforeach

</div>



