
@include('layouts.admin.header')
<div id="wrapper">
    @include('layouts.admin.sidebar')

    <div id="main-content">
            
    	<h3>Add new Album</h3>

        {{ Form::open(array('url' => URL::to('admin/album/submit'), 'id' => 'frm_album', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data')) }}
            {{ Form::hidden('id', (isset($album->id)) ? $album->id : '', array('id' => 'id')) }}
            <div class="line">
                <label>Title:</label>
                <input type="text" name="title" value="{{ (isset($album->title)) ? $album->title : '' }}" />
                <br class="clear">
            </div>

            <div class="line">
                <label>Photo:</label>
                <input type="file" name="photo">
                <br class="clear">
            </div>

            @if( isset($album->id) )

                <div class="line">
                    <label>&nbsp;</label>
                    {{ HTML::image($album->artworkPath, '', array('style' => 'width: 200px;')) }}
                    <br class="clear">
                </div>

            @endif
           
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

{{ HTML::script('js/album/admin.js') }}

<script type="text/javascript">
	Album.initForm();
</script>

@include('layouts.admin.footer')
