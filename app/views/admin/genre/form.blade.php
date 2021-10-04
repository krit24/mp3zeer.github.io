
@include('layouts.admin.header')
<div id="wrapper">
    @include('layouts.admin.sidebar')

    <div id="main-content">
            
    	<h3>Add new Genre</h3>

        {{ Form::open(array('url' => URL::to('admin/genre/submit'), 'id' => 'frm_genre', 'autocomplete' => 'off')) }}
            {{ Form::hidden('id', (isset($genre->id)) ? $genre->id : '', array('id' => 'id')) }}
            <div class="line">
                <label>Title:</label>
                <input type="text" name="name" value="{{ (isset($genre->name)) ? $genre->name : '' }}" />
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

{{ HTML::script('js/genre/admin.js') }}

<script type="text/javascript">
	Genre.initForm();
</script>

@include('layouts.admin.footer')
