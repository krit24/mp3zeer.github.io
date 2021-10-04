
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
            
    	<h3>Artist - {{ $artistName }} | Album - {{ $albumName }}</h3>

        <div class="songs">
            
            <ul id="sortable">
                @foreach ($songs as $song)
                <li class="song-item" data-id="{{ $song->id }}">
                    {{ substr($song->title, 0, 12) }}...
                    <span class="duration">{{ $song->duration }}</span>
                </li>
                @endforeach
            </ul>

        </div>
    </div>

    <br class="clear">
</div>

{{ HTML::style('packages/jqgrid/css/ui.jqgrid.css') }}
{{ HTML::script('packages/jqgrid/js/i18n/grid.locale-en.js') }}
{{ HTML::script('packages/jqgrid/js/jquery.jqGrid.min.js') }}

{{ HTML::script('js/songs/admin.js') }}

<script type="text/javascript">
	Songs.initAlbumLists();
    $( function() {
        $( "#sortable" ).sortable({
            update: function(){
                var id = '';
                $('#sortable').find('li').each(function(){

                    if( id == '' ){
                        id += $(this).data('id');
                    }else{
                        id += ',' + $(this).data('id');
                    }
                });
                Songs.sortSongs(id);
            }
        });
        $( "#sortable" ).disableSelection();
      } );
</script>

@include('layouts.admin.footer')
