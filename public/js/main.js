var Zeerius = {
	
	c: 'Zeerius',
	targetURL: siteURL + '/rest/',
	currentPlaylist: [],
    shufflePlaylist: [],
    tempPlaylist: [],
    audioElement: '',
    mouseDown: false,
    currentIndex: 0,
    repeat: false,
    shuffle: false,
    timer: 0,

	init: function(){

		var self = this;

		$('.sign-up').on('click', function(){
			$('#loginForm').addClass('hide');
			$('#registerForm').removeClass('hide');
		});

		$('.sign-in').on('click', function(){
			$('#registerForm').addClass('hide');
			$('#loginForm').removeClass('hide');
		});


	},

	getSongsByAlbum: function(){

		var self = this;

		self.showLoading($('#mainContent'));

		$.get( self.targetURL + 'albums', function(data){
			window.history.pushState('browse', '', '/browse');
			$('#mainContent').html(data);
		} );

	}, 

	loadAlbumSongs: function( albumId ){

		var self = this;

		self.showLoading($('#mainContent'));
		$.get( self.targetURL + 'albums/songs/' + albumId, function(data){
			$('#mainContent').html(data);
		} );

	},

	showLoading: function(element){

		element.html('');
		element.append('<span class="spinner"></span>');

	},

	hideLoading: function(){

		$('.spinner').remove();

	}

}