<div id="sidebar">
	        
	<ul>
		<li>
			<a href="#">Dashboard</a>
		</li>
		<li {{ ( hasAccess('admin.artist.lists') ) ? '' : 'class="hide"' }}>
			<a href="{{ route('admin.artist.index') }}">Artist</a>
		</li>
		<li {{ ( hasAccess('admin.album.lists') ) ? '' : 'class="hide"' }}>
			<a href="{{ route('admin.album.index') }}">Album</a>
		</li>
		<li {{ ( hasAccess('admin.genre.lists') ) ? '' : 'class="hide"' }}>
			<a href="{{ route('admin.genre.index') }}">Genre</a>
		</li>
		<li {{ ( hasAccess('admin.songs.lists') ) ? '' : 'class="hide"' }}>
			<a href="{{ route('admin.songs.index') }}">Songs</a>
		</li>
		<li {{ ( hasAccess('admin.system_user.index') ) ? '' : 'class="hide"' }}>
			<a href="{{ route('admin.system_user.index') }}">System Users</a>
		</li>
	</ul>

</div>
