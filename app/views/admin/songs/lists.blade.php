
@include('layouts.admin.header')
<div id="wrapper">
    @include('layouts.admin.sidebar')

    <div id="main-content">
            
    	<h3>Songs Management</h3>

    	<div class="lists">
            {{ get_message() }}
            <br>
    		<div class="buttons pull-right add-btn">
    			<a href="{{ URL::to('admin/songs/add') }}">
    				<button type="button">Add New Songs</button>
    			</a>
	    	</div>
	    	<br class="clear">
	    	<br class="clear">
    		<table id="song_management" class="song_management"></table>
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
	Songs.initLists();
</script>

@include('layouts.admin.footer')