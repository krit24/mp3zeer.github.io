var ConfigLoader = {
	
	configContent: '',

	getConfig: function(config_name, config_idx){

		var self = this,
			config_content = '';

		$.ajax({
			url: siteURL + '/rest/get-config',
			type: 'post',
			data: {
				config_name: config_name,
				config_idx: config_idx
			},
			dataType: 'json',
			success: function(data){
				self.configContent = data;
			}
		});

	}

}