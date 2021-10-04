
var Register = {
	
	$form: siteURL + '/register',

	init: function(){

		var self = this;

		$('#user_type').on('change', function(){
			
			if( $(this).val() == '4' ) {
				$('#in-service').removeClass('hide');
				$('#pre-service').addClass('hide');
				$('#prc-license').removeAttr('disabled');
				$('#sch-uni').attr('disabled', true);
				$('#mem-address').attr('disabled', true);
				return false;
			}

			$('#pre-service').removeClass('hide');
			$('#in-service').addClass('hide');
			
			$('#prc-license').attr('disabled', true);
			$('#sch-uni').removeAttr('disabled');
			$('#mem-address').removeAttr('disabled');
		});

		self.initForm();

	},

	initForm: function(){

		var self = this;

		self.$form = $('#reg-form-page-one');

		$('#btnSubmit').on('click', function(e){
			e.preventDefault();
			self.$form.submit();
		});

		self.rules();

	},

	rules: function(){

		var self = this;		

		self.$form.validate({
			rules: {
				user_type: 'required',
				first_name: 'required',
				last_name: 'required',
				middle_name: 'required',
				email: {
					required: true,
					email: true,
					remote: {
						url: siteURL + '/rest/register/unique',
						type: 'post',
						data: {
							user_type: function(){
								return $('#user_type').val();
							},
							table: 'users',
							column: 'email',
							value: function(){
								return $('#email-add').val();
							}
						}
					}
				},
				school_university: 'required',
				school_address: 'required',
				prc_licence: {
					required: true,
					remote: {
						url: siteURL + '/rest/check-prc',
						type: 'post',
						complete: function(response){
							
							if( response.responseText == "true" ) return self.getUserInfo($('#prc-license').val());
						}
					}
				}
			},
			messages: {
				user_type: 'Please select In-Service or Pre-Service Teacher.',
				first_name: 'Please enter First Name.',
				last_name: 'Please enter Last Name.',
				middle_name: 'Please enter Middle Name.',
				email: {
					required: 'Please enter Email Address.',
					email: 'Email Address is invalid.'
				},
				school_university: 'Please enter school/university.',
				school_address: 'Please enter school address.',
				prc_licence: {
					required: 'Please enter PRC Number',
					remote: 'PRC number is invalid'
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

	},
	
	getUserInfo: function(prc){
		
		var self = this;
		
		$.ajax({
			url: siteURL + '/rest/get-prc-info',
			type: 'POST',
			data: {
				prc_licence: prc
			},
			async: false,
			success: function(response){
				$('input[name="first_name"]').val(response.first_name);
				$('input[name="last_name"]').val(response.last_name);
				$('input[name="middle_name"]').val(response.middle_name);
			}
		});
		
	},
	
	initRegions: function(){
		
		var self = this;
		
		$('#regions').on('change', function(){
			
			var value = $(this).val();
			
			$.ajax({
				url: siteURL + '/rest/get-divisions',
				type: 'POST',
				data: {
					region_id: value
				}, 
				success: function(data){
					$('.divisions').html(data);
					self.initDivisions();
				}
			});
			
		});
		
	},
	
	initDivisions: function(){
		
		var self = this;
		
		$('#divisions').on('change', function(){
			
			var value = $(this).val();
			
			$.ajax({
				url: siteURL + '/rest/get-districts',
				type: 'POST',
				data: {
					division_id: value
				}, 
				success: function(data){
					$('.districts').html(data);
					self.initDistricts();
				}
			});
		});
		
	},
	
	initDistricts: function(){
		
		var self = this;
		
		$('#district').on('change', function(){
			
			var value = $(this).val();
			
			$.ajax({
				url: siteURL + '/rest/get-schools',
				type: 'POST',
				data: {
					district_id: value
				}, 
				success: function(data){
					$('.schools').html(data);
				}
			});
			
		});
		
	}

}
