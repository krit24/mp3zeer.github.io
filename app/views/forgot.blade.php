
@include('layouts.public.public_header')

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Forgot Password</h3>
				</div>
				<div class="panel-body">
						{{ Form::open(array('url' => route('forgot.submit'), 'id' => 'frm_retrive', 'autocomplete' => 'off')) }}
							<div class="login_box">
								<div><input type="text" placeholder="Email*" name="email" id="email" class="form-control"/></div>
								{{ get_message() }}
								
								<div id="login_button">
									
									<button type="submit" id="retrieve" class="pull-right btn btn-success" style="margin-left:5px; margin-bottom:5px;">SUBMIT</button>
									
									<a href="{{ URL::to('/') }}">
										<button type="button" id="cancel" class="pull-right btn btn-info" style="margin-left:5px; margin-bottom:5px;">CANCEL</button>
									</a>
									<br style="clear:both;">
								</div>
							</div>
						{{ Form::close() }}
					 <br>
				</div>
			</div>
		</div>
	</div>
</div>
{{ HTML::script('js/validator/jquery.form.js') }}
{{ HTML::script('js/validator/jquery.validate.js') }}

<script>
	$(function(){
	
		$('#frm_retrive').validate({
			rules: {
				email: {
					required: true,
					email: true
				}
			},
			messages: {
				email: {
					required: 'Please enter email address.',
					email: 'Invalid Email address.'
				}
			},
			onkeyup: false,
			focusInvalid: true,
			errorElement: 'p',
			errorPlacement: function(error, element) {
				error.insertAfter(element)
					 .addClass('validation_message');
			},
			highlight: function(element, errorClass) {
				$(element).addClass('fld-error');
			},
			unhighlight: function(element, errorClass) {
				$(element).removeClass('fld-error');
			},
			submitHandler: function(form) {
				Loading.show();
				form.submit();
			}
		});
		
	});
</script>

@include('layouts.public.footer')
