
var Login = {
	
	$form: '',

	initForm: function(){

		var self = this;

		self.$form = $('#frm_login');

		$('#btn-reset').on('click', function(e){
			e.preventDefault();
			$('input[name="email"], input[name="password"]').val('');
		});

		$('#login, #btn-login').on('click', function(e){
			e.preventDefault();
			$('#frm_login').submit();
		});

		self.rules();

	},

	rules: function(){

		var self = this;

		self.$form.validate({
			rules: {
				email:{
					required: true,
					email: true
				},
				password: 'required'
			},
			onkeyup: false,
			focusInvalid: true,
			errorElement: 'span',
			errorPlacement: function(error, element) {
				error.insertAfter(element)
					 .addClass('hide');
			},
			highlight: function(element, errorClass) {
				$(element).addClass('fld-error');
			},
			unhighlight: function(element, errorClass) {
				$(element).removeClass('fld-error');
			},
			submitHandler: function(form) {
				form.submit();
			}
		});

	}

}
