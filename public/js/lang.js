
var Lang = {

	systemLang: '',

    getLanguage: function(){

        var self = this;

		$.ajax({
			url: siteURL + '/json_lang',
			dataType: 'json',
			success: function(response) {
				self.systemLang = response;
			},
			async: false
		});

    },
    
    sprintF: function( lang, string ){
		
		var self = this;
		
		return lang.replace('%s', string);
		
	}

}
