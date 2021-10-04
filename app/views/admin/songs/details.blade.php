
@include('layouts.admin.header')
<style type="text/css">
    a{
        color: #333;
        text-decoration: underline;
    }
</style>
<div id="wrapper">
    @include('layouts.admin.sidebar')

    <div id="main-content">
            
    	<h3>Artist - {{ $artistName }}</h3>

        <div class="lists">
            <input type="hidden" name="artistId" id="artistId" value="{{ $artistId }}">
            <input type="hidden" name="albumId" id="albumId" value="{{ $albumId }}">
            <table id="artist_albums_management" class="artist_albums_management"></table>
            <div id="pagination" class="scroll"></div>
        </div>
    </div>

    <br class="clear">
</div>

{{ HTML::style('packages/jqgrid/css/ui.jqgrid.css') }}
{{ HTML::script('packages/jqgrid/js/i18n/grid.locale-en.js') }}
{{ HTML::script('packages/jqgrid/js/jquery.jqGrid.min.js') }}

{{ HTML::script('js/songs/admin.js') }}

<script type="text/javascript">
    Songs.artistId = "{{ $artistId }}";
	Songs.initAlbumLists();
</script>

@include('layouts.admin.footer')
