
var Loading = {

    show: function(){

        var self = this;

		$.blockUI({ 
			message: 'Processing...',
			overlayCSS: { backgroundColor: '#fff' }
		});

    }

}
