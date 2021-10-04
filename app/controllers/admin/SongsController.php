<?php

class SongsController extends BackendController{
	
	public $c = 'Songs';

	function showPage(){

		$this->layout->content = View::make('admin.songs.lists');

	}

	/*
	 * getLists
	 *
	 * a post Request function that
	 * get all the records from the 
	 * database and listed to page.
	 *
	 * @return JSON
	 *
	 */

	function getLists(){

		$songs = new Songs;

		$page = Input::get('page');

		$limit = Config::get('cms_config.limit');
		$total = count($songs->getSongsTotal());

		$num_pages = ceil( $total / $limit);
		
		if ($page > $num_pages && $total != 0) $page = $num_pages; 
		
		$offset = $limit * $page - $limit;

		$songs = $songs->songsLists($offset);

		$select = array(
					'id',
					'name',
					'number_of_songs',
					'id'
				);


		$rows = ListsFormatter::_run( $songs, 'id', $select );

		$format = array(
					'page' => $page,
					'total' => $num_pages,
					'records' => $total,
					'rows' => $rows
				);

		return Response::json($format);

	}

	function showAddForm(){

		$artist = Artist::getAll();
		$artists = array('' => 'Select Artists');
		foreach ($artist as $artist) {
			$artists[$artist->id] = $artist->name;
		}

		$genre = Genre::getAll();
		$genres = array('' => 'Select Genres');
		foreach ($genre as $genre) {
			$genres[$genre->id] = $genre->name;
		}

		$album = Album::getAll();
		$albums = array('' => 'Select Albums');
		foreach ($album as $album) {
			$albums[$album->id] = $album->title;
		}

		$this->layout->content = View::make('admin.songs.form')
										->with('artist', $artists)
										->with('genre', $genres)
										->with('album', $albums);

	}

	function _set_rules(){

		$validator = array(
				// 'name' => 'required'
			);

		return $validator;

	}

	function postSubmit(){
		try
		{

			$validator = Validator::make(Input::all(), $this->_set_rules());

			if( $validator->fails() ) throw new Exception(trans('messages.cms_error'));

			// process artist
			$artist = $this->getArtistId( Input::get('new_artist'), Input::get('artist') );
			if( empty($artist) ) throw new Exception(trans('messages.cms_artist_error'));

			// process genre
			$genre = $this->getGenreId( Input::get('new_genre'), Input::get('genre') );
			if( empty($genre) ) throw new Exception(trans('messages.cms_genre_error'));

			// process album
			$album = $this->getAlbumId( Input::get('new_album'), Input::get('album'), Input::file('file_album_photo'), $artist, $genre );
			if( empty($album) ) throw new Exception(trans('messages.cms_album_error'));

			$destination = Config::get('public_config');
            $destination = $destination['upload_path']['music'];

            if( ! Input::hasFile('file_songs') ) throw new Exception(trans('messages.cms_file_error'));

			$file = Input::file('file_songs');
			$extension = $file->getClientOriginalExtension();
            $music_folder = $file->getClientOriginalName();

            $file_type = $file->getMimeType();

            $file = rand(0000,9999) . $music_folder;
            $file = sha1($file) . '.' . $extension;

            Input::file('file_songs')->move($destination, $file);

            // extract file
            $zip = new ZipArchive;
            $open_zip_songs = $zip->open($destination . $file);

            if( $open_zip_songs != TRUE ) throw new Exception(trans('messages.cms_unzip_error'));
            
            $zip->extractTo($destination);
			$zip->close();

			// unlink zip file
			unlink($destination . $file);

			// loops songs to store in the database
			$music_folder = substr($music_folder, 0, (strlen ($music_folder)) - (strlen (strrchr($music_folder,'.'))));

			$songs = scandir($destination . $music_folder);
			$songs = array_diff($songs, array('.', '..'));

			foreach ($songs as $song) {
				
				$song_title = substr($song, 0, (strlen ($song)) - (strlen (strrchr($song,'.'))));

				// get file extension
				$song_ext = pathinfo($song, PATHINFO_EXTENSION);

				$title = $song_title;

				// rename the file
				$newfilename = $title . '.' . $song_ext;
				rename($destination . $music_folder . '/' . $song, $destination . $music_folder . '/' . $newfilename);

				$path = $destination . $music_folder . '/' . $newfilename;

				$getID3 = new getID3;
				$ThisFileInfo = $getID3->analyze($path);
				getid3_lib::CopyTagsToComments($ThisFileInfo);
				$duration = $ThisFileInfo['playtime_string'];

				$song = new Songs;
				$song->title = $title;
				$song->artist = $artist;
				$song->album = $album;
				$song->genre = $genre;
				$song->duration = $duration;
				$song->path = $path;

				$song->save();

			}

			_success(sprintf(trans('messages.cms_add_success'), $this->c));

		}
		catch(Exception $e){
			_error($e->getMessage());
		}

		return $this->landing();

	}

	function getArtistId( $newArtist = '', $selectedArtist = '' ){

		$artistId = $selectedArtist;

		if( ! empty($newArtist) ){

			$artist = new Artist;
			$artist->name = $newArtist;
			$artist->save();

			$artistId = $artist->id;

		}

		return $artistId;

	}

	function getGenreId( $newGenre = '', $selectedGenre = '' ){

		$genreId = $selectedGenre;

		if( ! empty($newGenre) ){

			$genre = new Genre;	
			$genre->name = $newGenre;
			$genre->save();

			$genreId = $genre->id;

		}

		return $genreId;

	}

	function getAlbumId( $newAlbum = '', $selectedAlbum = '', $photo = '', $artist = '', $genre = '' ){

		$albumId = $selectedAlbum;

		if( ! empty($newAlbum) ){

			$destination = Config::get('public_config');
            $destination = $destination['upload_path']['album_photo'];

			$extension = $photo->getClientOriginalExtension();
            $fileName = $photo->getClientOriginalName();

            $photo->move($destination, $fileName);

			$album = new Album;				
			$album->title = $newAlbum;
			$album->artist = $artist;
			$album->genre = $genre;
			$album->artworkPath = $destination . $fileName;
			$album->save();

			$albumId = $album->id;

		}

		return $albumId;

	}

	function showDetails( $artistId = '', $albumId = '' ){

		$artistName = Artist::getName($artistId);

		$this->layout->content = View::make('admin.songs.details')
										->with('artistName', $artistName)
										->with('artistId', $artistId)
										->with('albumId', $albumId);

	}

	function getAlbumLists( $artistId ){

		$songs = new Songs;

		$page = Input::get('page');

		$limit = Config::get('cms_config.limit');
		$total = count($songs->getSongsAlbumTotal($artistId));

		$num_pages = ceil( $total / $limit);
		
		if ($page > $num_pages && $total != 0) $page = $num_pages; 
		
		$offset = $limit * $page - $limit;

		$songs = $songs->songsAlbumLists($offset, $artistId);

		$select = array(
					'id',
					'artworkPath',
					'title',
					'number_of_songs',
					'id'
				);


		$rows = ListsFormatter::_run( $songs, 'id', $select );

		$format = array(
					'page' => $page,
					'total' => $num_pages,
					'records' => $total,
					'rows' => $rows
				);

		return Response::json($format);

	}

	function showAlbumSongs( $artistId = '', $albumId = '' ){

		$artistName = Artist::getName($artistId);
		$albumName = Album::getName($albumId);

		// get all songs

		$songs = new Songs;
		$songs = $songs->getAllSongs( $artistId, $albumId );

		$this->layout->content = View::make('admin.songs.album_songs')
										->with('songs', $songs)
										->with('artistName', $artistName)
										->with('albumName', $albumName)
										->with('artistId', $artistId)
										->with('albumId', $albumId);

	}

	function sortSongs(){

		$songIds = explode(",", Input::get('ids'));

		$ctr = 1;
		foreach ($songIds as $id) {

			$song = Songs::find($id);
			$song->albumOrder = $ctr;
			$song->save();

			$ctr++;

		}

		return Response::json(true);

	}

}

/* End of file SongsController.php */
/* Location: ./app/controllers/SongsController.php */