
@include('layouts.admin.header')
<div id="wrapper">
    @include('layouts.admin.sidebar')

    <div id="main-content">
            
    	<h3>System Users Management</h3>

    	<div class="lists">
            {{ get_message() }}
            <br>
    		<div class="buttons pull-right add-btn">
    			<a href="{{ URL::to('admin/system-users/add') }}">
    				<button type="button">Add New User</button>
    			</a>
	    	</div>
	    	<br class="clear">
	    	<br class="clear">
    		<table id="user_management" class="user_management"></table>
			<div id="pagination" class="scroll"></div>
    	</div>
    	
    </div>

    <br class="clear">
</div>

{{ HTML::style('packages/jqgrid/css/ui.jqgrid.css') }}
{{ HTML::script('packages/jqgrid/js/i18n/grid.locale-en.js') }}
{{ HTML::script('packages/jqgrid/js/jquery.jqGrid.min.js') }}

{{ HTML::script('js/system_users/admin.js') }}

<script type="text/javascript">
	SystemUsers.initLists();
</script>

@include('layouts.admin.footer')