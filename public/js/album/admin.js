
var Album = {
	
	targetURL: siteURL + '/admin/album/',
	c: 'Album',
	$lists: '',

	initLists: function(){

		var self = this;

		self.$list = $('#album_management');
		self.$pagination = $('#pagination');

		self.$list.jqGrid({
			url: self.targetURL + 'get-list',
			mtype: 'post',
			datatype: 'json',
			colNames: ['ID', 'Photo', 'Title', 'Operations'],
			colModel: [
				{name: 'id', index: 'id', hidden: true, key: true},
				{name: 'artworkPath', index: 'artworkPath', width:'80px', align: 'center', sortable: false, formatter: self.albumPhoto},
				{name: 'title', index: 'title', width:'500px', sortable: false},
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

	albumPhoto: function( cell, opts, rowObj ){

		var ret = '<img src="/' + rowObj[1] + '" style="width: 50px;" />';

		return ret;

	},

	operations: function(cell, opts, rowObj) {
		// Since this = jgrid instance, we explicitly call Album when necessary
		var targetURL = Album.targetURL;
		
		// var ret = '<a href="' + targetURL + 'view/' + cell + '" title="View" class="icon icon-view"></a>';
		var ret = '<a href="' + targetURL + 'edit/' + cell + '" title="Edit" class="icon icon-update"></a>';
		ret += '<a href="javascript:Message.confirmBox(\'Album.delete(' + cell + ')\', \'' + Album.c + ' - Delete Record\',\' Are you sure you want to delete selected?\');" title="Delete" class="icon icon-delete"></a>';
		
		return ret;
	},

	initForm: function(){

		var self = this;

		self.$form = $('#frm_album');

		self.rules();

	},

	rules: function(){

		var self = this;

		self.$form.validate({
			rules: {
				title: 'required'
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
