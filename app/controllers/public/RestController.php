<?php

class RestController extends BackendController{
	
	/*
	 * postUnique
	 * 
	 * validate the unique
	 * value
	 * 
	 * @request POST
	 * @return Boolean JSON
	 */
	
	function postUnique(){

		$id = Input::get('id');
		$table = Input::get('table');
		$column = Input::get('column');
		$value = Input::get('value');

		$validator = Validator::make(
				array(
						$column => $value
					),
				array(
						$column => "unique:{$table},{$column},{$id},id"
					)
			);

		if( $validator->fails() ) return Response::json(false);

		return Response::json(true);

	}

	/*
	 * postUniqueRegUser
	 * 
	 * validate the unique
	 * value for registration
	 * 
	 * @request POST
	 * @return Boolean JSON
	 */

	function postUniqueRegUser(){

		$table = Input::get('table');
		$column = Input::get('column');
		$value = Input::get('value');
		$user_type = Input::get('user_type');

		$validator = Validator::make(
				array(
						$column => $value
					),
				array(
						$column => "unique:{$table},{$column},null,id,group_id,{$user_type}"
					)
			);

		if( $validator->fails() ) return Response::json(false);

		return Response::json(true);

	}

	/*
	 * postConfig
	 * 
	 * get config item values
	 * and contents.
	 * 
	 * @request POST
	 * @return JSON
	 */

	function postConfig(){

		$config_name = Input::get('config_name');
		$config_index = Input::get('config_idx');

		$config_content = Config::get($config_name);

		return Response::json($config_content[$config_index]);

	}

	/*
	 * getSongsByAlbum
	 * 
	 * get all available albums
	 * 
	 * @request GET
	 * @return JSON
	 */

	function getSongsByAlbum(){

		$songs = new Songs;
		$songs = $songs->getSongsByAlbumGroup();

		return View::make('layouts.public.load_albums')
					->with('albums', $songs);

	}

	/*
	 * getSongsByAlbumId
	 * 
	 * get all songs list by album
	 * 
	 * @request GET
	 * @return JSON
	 */
	function getSongsByAlbumId( $albumId = '' ){

		$songs = new Songs;
		$songlist = $songs->getSongsByAlbumId( $albumId );
		$details = $songs->getDetailsByAlbumId( $albumId );

		return View::make('layouts.public.load_album_songs')
					->with('songs', $songlist)
					->with('details', $details);

	}

	/*
	 * postSongDetails
	 * 
	 * get song details
	 * 
	 * @request POST
	 * @return JSON
	 */
	function postSongDetails( $songId = '' ){

		$songs = Songs::getSongDetailsById($songId);

		return Response::json($songs);

	}

	/*
	 * postUpdatePlayCount
	 * 
	 * update play count of the song
	 * 
	 * @request POST
	 * @return JSON
	 */
	function postUpdatePlayCount(){

		$song = Songs::find( Input::get('songId') );

		$detail = $song->first();
		$plays = $detail->plays;
		$plays++;

		$song->plays = $plays;
		$song->save();

		return Response::json(true);
	}

}

/* End of file RestController.php */
/* Location: ./app/controllers/RestController.php */
