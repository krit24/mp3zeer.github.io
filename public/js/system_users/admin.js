
var SystemUsers = {
	
	targetURL: siteURL + '/admin/system-users/',
	c: 'System Users',
	$lists: '',

	initLists: function(){

		var self = this;

		self.$list = $('#user_management');
		self.$pagination = $('#pagination');

		self.$list.jqGrid({
			url: self.targetURL + 'get-list',
			mtype: 'post',
			datatype: 'json',
			colNames: ['ID', 'First Name', 'Last Name', 'Email Address', 'User Type', 'Operations'],
			colModel: [
				{name: 'id', index: 'id', hidden: true, key: true},
				{name: 'first_name', index: 'first_name'},
				{name: 'last_name', index: 'last_name'},
				{name: 'email', index: 'email'},
				{name: 'user_type', index: 'user_type'},
				{name: 'ops', index: 'ops', align: 'center', sortable: false, formatter: self.operations}
			],
			autowidth: true,
			height: 'auto',
			rowNum: 20,
			pager: self.$pagination,
			sortorder: 'asc',
			viewrecords: true, 
			rownumbers: true
		});

	},

	operations: function(cell, opts, rowObj) {
		// Since this = jgrid instance, we explicitly call ArticleAdmin when necessary
		var targetURL = SystemUsers.targetURL;
		
		var ret = '<a href="' + targetURL + 'view/' + cell + '" title="View" class="icon icon-view"></a>';
		ret += '<a href="' + targetURL + 'edit/' + cell + '" title="Edit" class="icon icon-update"></a>';
		ret += '<a href="javascript:Message.confirmBox(\'SystemUsers.delete(' + cell + ')\', \'' + SystemUsers.c + ' - Delete Record\',\' Are you sure you want to delete selected?\');" title="Delete" class="icon icon-delete"></a>';
		
		return ret;
	},

	initForm: function(){

		var self = this;

		self.$form = $('#frm_system_users');

		self.rules();

	},

	rules: function(){

		var self = this;

		self.$form.validate({
			rules: {
				first_name: 'required',
				last_name: 'required',
				email: {
					required: true,
					email: true,
					remote: {
						url: siteURL + '/rest/unique',
						type: 'post',
						data:{
							id: $('#id').val(),
							table: 'users',
							column: 'email',
							value: function(){
								return $('#email').val()
							}
						}
					}
				},
				user_types: 'required'
			},
			messages: {
				email: {
					remote: 'Email Address already in used.'
				}
			},
			onkeyup: false,
			focusInvalid: true,
			errorElement: 'span',
			errorPlacement: function(error, element) {
				error.insertAfter(element);
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

	delete: function( id ){

		var self = this;

		window.location = self.targetURL + 'delete/' + id;

	}

}
