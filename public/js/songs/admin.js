
var Songs = {
	
	targetURL: siteURL + '/admin/songs/',
	c: 'Songs',
	$lists: '',
	artistId: 0,

	initLists: function(){

		var self = this;

		self.$list = $('#song_management');
		self.$pagination = $('#pagination');

		self.$list.jqGrid({
			url: self.targetURL + 'get-list',
			mtype: 'post',
			datatype: 'json',
			colNames: ['ID', 'Artist Name', 'Number of Songs', 'Operations'],
			colModel: [
				{name: 'id', index: 'id', hidden: true, key: true},
				{name: 'name', index: 'name', width:'500px', sortable: false},
				{name: 'number_of_songs', index: 'number_of_songs', width:'150px', align: 'right', sortable: false},
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

	initAlbumLists: function(){

		var self = this;

		self.$list = $('#artist_albums_management');
		self.$pagination = $('#pagination');

		self.$list.jqGrid({
			url: self.targetURL + 'get-album-list/' + self.artistId,
			mtype: 'post',
			datatype: 'json',
			colNames: ['ID', 'Photo', 'Album Name', 'Number of Songs', 'Operations'],
			colModel: [
				{name: 'id', index: 'id', hidden: true, key: true},
				{name: 'artworkPath', index: 'artworkPath', width:'80px', align: 'center', sortable: false, formatter: self.albumPhoto},
				{name: 'name', index: 'name', width:'500px', sortable: false},
				{name: 'number_of_songs', index: 'number_of_songs', width:'150px', align: 'center', sortable: false},
				{name: 'ops', index: 'ops', align: 'center', sortable: false, formatter: self.operationsAlbums}
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

	operationsAlbums: function(cell, opts, rowObj) {
		// Since this = jgrid instance, we explicitly call Genre when necessary
		var targetURL = Songs.targetURL;
		console.log(rowObj);
		var ret = '<a href="' + targetURL + 'album-songs/' + Songs.artistId + '/' + cell + '" title="View" class="icon icon-view"></a>';

		return ret;
	},

	operations: function(cell, opts, rowObj) {
		// Since this = jgrid instance, we explicitly call Genre when necessary
		var targetURL = Songs.targetURL;
		
		var ret = '<a href="' + targetURL + 'detail/' + cell + '" title="View" class="icon icon-view"></a>';

		return ret;
	},

	initForm: function(){

		var self = this;

		self.$form = $('#frm_songs');

		$('.album-existings').on('click', function(e){
			e.preventDefault();
			$('.fld-existing').removeClass('hide');
			$('.fld-add-new').addClass('hide');
		});

		$('.album-new').on('click', function(e){
			e.preventDefault();
			$('.fld-add-new').removeClass('hide');
			$('.fld-existing').addClass('hide');
		});

		self.rules();

	},

	rules: function(){

		var self = this;

		self.$form.validate({
			rules: {
				// artists: 'required',
				// genres: 'required'
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

	},

	sortSongs: function( ids ){

		var self = this;

		$.ajax({
			url: self.targetURL + 'sort-songs',
			type: 'POST',
			data: {
				ids: ids
			}, 
			success: function(res){
				console.log(res);
			}
		});

	}

}
