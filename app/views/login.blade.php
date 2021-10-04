
<div id="login">
	{{ Form::open(array('url' => URL::to('auth/submit'), 'class' => 'pull-right', 'id' => 'frm_login', 'autocomplete' => 'off')) }}
        <div class="line">
            Login Information
        </div>
        <div class="line">
            <input type="text" name="email" placeholder="Username" />
            <br class="clear">
        </div>
        <div class="line">
            <input type="password" name="password" placeholder="Password" />
            <br class="clear">
        </div>
        <br>
        {{ get_message() }}
        <div class="line buttons">
            <button type="reset" id="btn-reset" class="pull-right">RESET</button>
            <button type="submit" id="btn-login" class="pull-right mright-1">LOGIN</button>
        </div>
        
        
    {{ Form::close() }}
    <br class="clear">
</div>

{{ HTML::script('js/validator/jquery.form.js') }}
{{ HTML::script('js/validator/jquery.validate.js') }}
{{ HTML::script('js/login.js') }}

<script type="text/javascript">
    $(function(){
        
        Login.initForm();

    });
</script>
