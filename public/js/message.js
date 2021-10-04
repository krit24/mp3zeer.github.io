var Message = {
	
	confirmBox: function(callback, title, content) {
		var code = '<span class="icon icon-info"></span>';
		code += '<span>' + content + '</span>';
		
		$('#ddialog').html(code).attr('title', title);
		this.confirm(callback);
	},
	
	confirm: function(callback) {
		$('#ddialog').dialog({
			resizable: false,
			minheight: 300,			
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
