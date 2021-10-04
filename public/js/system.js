
var System = {

	$content: '',

	getConfig: function(config_name){
		
		var self = this;
		
		$.ajax({
			url: siteURL + '/rest/get-config',
			type: 'POST',
			data: {
				config_name: config_name
			},
			success: function(response){
				self.$content = response;
			}
		});
		
	},
	
	get: function( idx ){
		
		var self = this;
		
		return self.$content[idx];
		
	}

}
