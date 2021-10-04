
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
            
    	<h3>Add new Songs</h3>

        {{ Form::open(array('url' => URL::to('admin/songs/submit'), 'id' => 'frm_songs', 'autocomplete' => 'off','enctype' => 'multipart/form-data')) }}
            <div class="line">
                <label>Artists:</label>
                <input type="text" name="new_artist" value="" placeholder="Enter New Artists" />
                &nbsp; OR &nbsp;
                {{ Form::select('artist', $artist, '', array('style' => 'float:none !important;')) }}
                <br class="clear">
            </div>

            <div class="line">
                <label>Genre:</label>
                <input type="text" name="new_genre" value="" placeholder="Enter New Genre" />
                &nbsp; OR &nbsp;
                {{ Form::select('genre', $genre, '', array('style' => 'float:none !important;')) }}
                <br class="clear">
            </div>

            <div class="line">
                <label>Album:</label>
                <span class="fld-control">
                    <a href="javascript::void(0)" class="album-existings">Select Existing</a>
                    &nbsp; OR &nbsp;
                    <a href="javascript::void(0)" class="album-new">Add new</a> 
                </span>
                
                <div style="margin-top: 10px;">
                
                    <span class="fld-existing hide">
                        {{ Form::select('album', $album, '', array('style' => 'float:none !important;')) }}
                    </span> 

                    <span class="fld-add-new hide">
                        <input type="text" name="new_album" value="" placeholder="Enter New Album" style="margin-bottom: 10px;" />
                        &nbsp;&nbsp;&nbsp;
                        <input type="file" name="file_album_photo">
                    </span>

                </div>
                
            </div>

            <div class="line">
                <label>Songs:</label>
                <input type="file" name="file_songs">
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

{{ HTML::script('js/songs/admin.js') }}

<script type="text/javascript">
	Songs.initForm();
</script>

@include('layouts.admin.footer')
