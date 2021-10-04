
@include('layouts.admin.header')
<div id="wrapper">
    @include('layouts.admin.sidebar')

    <div id="main-content">
            
    	<h3>Add new Artist</h3>

        {{ Form::open(array('url' => URL::to('admin/artist/submit'), 'id' => 'frm_artist', 'autocomplete' => 'off')) }}
            {{ Form::hidden('id', (isset($artist->id)) ? $artist->id : '', array('id' => 'id')) }}
            <div class="line">
                <label>Name:</label>
                <input type="text" name="name" value="{{ (isset($artist->name)) ? $artist->name : '' }}" />
                <br class="clear">
            </div>

            <div class="buttons">
                <button type="submit">Save</button>
                <button type="reset">Reset</button>
            </div>

        {{ Form::close() }}
    	
    </div>

    <br class="clear">
</div>

{{ HTML::script('js/validator/jquery.form.js') }}
{{ HTML::script('js/validator/jquery.validate.js') }}

{{ HTML::script('js/artist/admin.js') }}

<script type="text/javascript">
	Artist.initForm();
</script>

@include('layouts.admin.footer')
