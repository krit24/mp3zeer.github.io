
@include('layouts.admin.header')
<div id="wrapper">
    @include('layouts.admin.sidebar')

    <div id="main-content">
            
    	<h3>Add new system user</h3>

        {{ Form::open(array('url' => URL::to('admin/system-users/submit'), 'id' => 'frm_system_users')) }}
            {{ Form::hidden('id', (isset($user->id)) ? $user->id : '', array('id' => 'id')) }}
            <div class="line">
                <label>First Name:</label>
                <input type="text" name="first_name" value="{{ (isset($user->first_name)) ? $user->first_name : '' }}" />
                <br class="clear">
            </div>

            <div class="line">
                <label>Last Name:</label>
                <input type="text" name="last_name" value="{{ (isset($user->last_name)) ? $user->last_name : '' }}" />
                <br class="clear">
            </div>

            <div class="line">
                <label>Email Address:</label>
                <input type="text" name="email" id="email" value="{{ (isset($user->email)) ? $user->email : '' }}" />
                <br class="clear">
            </div>

            <div class="line">
                <label>User Type:</label>
                {{ Form::select('user_types', array('' => '-- Select User Types --', '2' => 'System Editor'), (isset($user->group_id)) ? $user->group_id : '') }}
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

{{ HTML::script('js/system_users/admin.js') }}

<script type="text/javascript">
	SystemUsers.initForm();
</script>

@include('layouts.admin.footer')