var Account = {
	
	settings: function(){
		
		var self = this;
		
		$('a[id^="settings_"]').on('click', function(){
			
			var settingType = $(this).data('type');
			
			$('#' + settingType + '_field').removeClass('hide');
			
			$(this).addClass('hide');
			
		});
		
		$('button[class="cancel"]').on('click', function(){
			
			var setting_type = $(this).data('type');
			
			$('div[id="' + setting_type + '_field"]').addClass('hide');
			$('#settings_' + setting_type).removeClass('hide');
			
			$('#' + setting_type + '_error').html('');
			$('input[type="' + setting_type + '"]').val('');
			
		});
		
		$('button[id^="save_"]').on('click', function(){
			
			var setting_type = $(this).data('type');
			
			switch( setting_type ){
				
				case 'email':
					self.saveEmailAddress();
				break;
				case 'password':
					self.changePassword();
				break;
				
			}
			
		});
		
	},
	
	saveEmailAddress: function(){
		
		var self = this,
			setting_type = 'email';
		
		if( $('input[id="email"]').val() == '' ) return false;
		
		$.ajax({
			url: siteURL + '/account/email/submit',
			type: 'POST',
			data: {
				email: function(){
					return $('input[id="email"]').val();
				}
			},
			async: false,
			success: function(response){
				$('#email_content').html(response);
				$('input[id="email"]').val('');
				$('div[id="' + setting_type + '_field"]').addClass('hide');
				$('#settings_' + setting_type).removeClass('hide');
			}
		});
		
	},
	
	makePrimary: function(id){
		
		var self = this;
		
		$.ajax({
			url: siteURL + '/account/email/set-primary',
			type: 'POST',
			data: {
				id: id
			},
			async: false,
			success: function(response){
				$('#email_content').html(response);
			}
		});
		
	},
	
	deleteEmail: function(id){
		
		var self = this;
		
		$.ajax({
			url: siteURL + '/account/email/delete',
			type: 'POST',
			data: {
				id: id
			},
			async: false,
			success: function(response){
				$('#email_content').html(response);
			}
		});
		
	},
	
	changePassword: function(){
		
		var self = this,
			setting_type = 'password';
		
		$('#password_error').html('');
		if( $('#old_password').val() != $('#new_password').val() ){
			return $('#password_error').html('Password mismatch.');
		}
		
		$.ajax({
			url: siteURL + '/account/change-password',
			type: 'POST',
			data: {
				password: function(){
					return $('#new_password').val();
				}
			},
			async: false,
			success: function(response){
				$('.caption').html('Password has been changed.');
				$('div[id="' + setting_type + '_field"]').addClass('hide');
				$('#settings_' + setting_type).removeClass('hide');
				$('#' + setting_type + '_error').html('');
				$('input[type="' + setting_type + '"]').val('');
			}
		});
		
	},
	
	updateForm: function(){
		
		var self = this;
		
		$('#upload').click(function (e) {
			$('#upload-dialog').modal();
			return false;
		});
		
		$('#upload-submit').on('click', function(){
			if( $('input[name="profile_pixx"]').val() == '' ) return false;
			$('#frm-upload').ajaxSubmit({
				success: function(){
					$('.simplemodal-close').trigger('click');
					location.reload(1);
				}
			});
		});
		
	},
	
	previewImage: function(fileInput){
		
		var self = this,
			files = fileInput.files;
		
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
                continue;
            }           
            var img=document.getElementById("thumbnil");            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }  
		
	}
	
}
