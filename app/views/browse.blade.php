{{ HTML::style('css/global.css') }}
<div id="mainContainer">

	<div id="topContainer">


		@include('layouts.public.account_sidebar')

		<div id="mainViewContainer">

			<div id="mainContent">

				

			</div>
			
		</div>

	</div>

	@include('layouts.public.now_playing_bar')
</div>

<script type="text/javascript">
	Zeerius.getSongsByAlbum();
</script>
