
@include('layouts.admin.header')
<div id="wrapper">
    @include('layouts.admin.sidebar')

    <div id="main-content">
		{{ get_message() }}
		<br>
    	content

    </div>

    <br class="clear">
</div>
@include('layouts.admin.footer')
