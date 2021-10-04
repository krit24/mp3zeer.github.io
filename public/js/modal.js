
var ModalWindow = {

	show: function(callback, title, content) {
		
		$('#ddialog').html(content).attr('title', title);
		this.modal(callback);
	},
	
	modal: function(callback) {
		$('#ddialog').dialog({
			resizable: false,
			minheight: 500,		
			width: 300,	
			modal: true,
			buttons: {
				'Yes': function() {
					eval(callback);
					$(this).dialog('close');
				},
				'No': function() {
					$(this).dialog('close');
				}
			},
			close: function() {
				$(this).dialog('destroy');
			}
		});
	}
	
}
