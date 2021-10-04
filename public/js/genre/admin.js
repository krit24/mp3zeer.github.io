
var Genre = {
	
	targetURL: siteURL + '/admin/genre/',
	c: 'Genre',
	$lists: '',

	initLists: function(){

		var self = this;

		self.$list = $('#genre_management');
		self.$pagination = $('#pagination');

		self.$list.jqGrid({
			url: self.targetURL + 'get-list',
			mtype: 'post',
			datatype: 'json',
			colNames: ['ID', 'Name', 'Operations'],
			colModel: [
				{name: 'id', index: 'id', hidden: true, key: true},
				{name: 'name', index: 'name', width:'500px', sortable: false},
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
		// Since this = jgrid instance, we explicitly call Genre when necessary
		var targetURL = Genre.targetURL;
		
		var ret = '<a href="' + targetURL + 'view/' + cell + '" title="View" class="icon icon-view"></a>';
		ret += '<a href="' + targetURL + 'edit/' + cell + '" title="Edit" class="icon icon-update"></a>';
		ret += '<a href="javascript:Message.confirmBox(\'Genre.delete(' + cell + ')\', \'' + Genre.c + ' - Delete Record\',\' Are you sure you want to delete selected?\');" title="Delete" class="icon icon-delete"></a>';
		
		return ret;
	},

	initForm: function(){

		var self = this;

		self.$form = $('#frm_genre');

		self.rules();

	},

	rules: function(){

		var self = this;

		self.$form.validate({
			rules: {
				name: 'required'
			},
			messages: {},
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
