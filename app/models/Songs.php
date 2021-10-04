<?php

/*
 * Songs
 *
 * Manipulating dynamic data for
 * songs table
 *
 * @author Jonel Letran
 * @created September 14, 2019
 *
 */

use LaravelBook\Ardent\Ardent;

class Songs extends Ardent {

	protected $table = 'songs';


	/*
	 * songsLists
	 *
	 * This will be getting all the users
	 * only for the system users page.
	 *
	 * Example Usage:
	 *
	 * $songs = new Songs;
	 * $songs = $songs->songsLists();
	 *
	 * @return Array
	 */

	function songsLists( $offset = 0 ){

		return $this->Join('artist', function($join){
						$join->on('artist.id', '=', 'songs.artist');
					})
					->groupBy('artist.id')
					->take(Config::get('cms_config.limit'))
					->offset($offset)
					->get([
						DB::raw('artist.id'),
						DB::raw('artist.name'),
						DB::raw('count(songs.id) as number_of_songs')
					]);
	}

	/*
	 * getSongsTotal
	 *
	 * This will be getting the number of users
	 * only for the system users page.
	 *
	 * Example Usage:
	 *
	 * $songs = new Songs;
	 * $songs = $songs->getGenreTotal();
	 *
	 * @return Array
	 */

	function getSongsTotal(){

		return $this->Join('artist', function($join){
						$join->on('artist.id', '=', 'songs.artist');
					})
					->groupBy('artist.id')
					->get();


	}

	/*
	 * songsAlbumLists
	 *
	 * This will be getting all the users
	 * only for the system users page.
	 *
	 * Example Usage:
	 *
	 * $songs = new Songs;
	 * $songs = $songs->songsAlbumLists();
	 *
	 * @return Array
	 */

	function songsAlbumLists( $offset = 0, $artistId = 0 ){

		return $this->Join('albums', function($join){
						$join->on('albums.id', '=', 'songs.album');
					})
					->where('songs.artist', $artistId)
					->groupBy('albums.id')
					->take(Config::get('cms_config.limit'))
					->offset($offset)
					->get([
						DB::raw('albums.id'),
						DB::raw('albums.title'),
						DB::raw('albums.artworkPath'),
						DB::raw('count(songs.id) as number_of_songs')
					]);
	}

	/*
	 * getSongsAlbumTotal
	 *
	 * This will be getting the number of users
	 * only for the system users page.
	 *
	 * Example Usage:
	 *
	 * $songs = new Songs;
	 * $songs = $songs->getSongsAlbumTotal();
	 *
	 * @return Array
	 */

	function getSongsAlbumTotal( $artistId = 0 ){

		return $this->Join('albums', function($join){
						$join->on('albums.id', '=', 'songs.album');
					})
					->where('songs.artist', $artistId)
					->groupBy('albums.id')
					->get();


	}

	/*
	 * getAllSongs
	 *
	 * This will be getting the number of users
	 * only for the system users page.
	 *
	 * Example Usage:
	 *
	 * $songs = new Songs;
	 * $songs = $songs->getAllSongs();
	 *
	 * @return Array
	 */

	function getAllSongs( $artistId = 0, $albumId = 0 ){

		return $this->where('artist', $artistId)
					->where('album', $albumId)
					->orderBy('albumOrder')
					->get();


	}

	/*
	 * getSongsByAlbumGroup
	 *
	 * This will be getting the number of users
	 * only for the songs page.
	 *
	 * Example Usage:
	 *
	 * $songs = new Songs;
	 * $songs = $songs->getSongsByAlbumGroup();
	 *
	 * @return Array
	 */

	function getSongsByAlbumGroup(){

		return $this->Join('albums', function($join){
						$join->on('albums.id', '=', 'songs.album');
					})
					->groupBy('albums.id')
					->get([
						DB::raw('albums.id'),
						DB::raw('albums.title'),
						DB::raw('albums.artworkPath'),
						DB::raw('count(songs.id) as number_of_songs')
					]);

	}

	/*
	 * getSongsByAlbumId
	 *
	 * get all songs by album id
	 *
	 * Example Usage:
	 *
	 * $songs = new Songs;
	 * $songs = $songs->getSongsByAlbumId();
	 *
	 * @return Array
	 */

	function getSongsByAlbumId( $albumId = 0 ){

		return $this->Join('artist', function($join){
						$join->on('artist.id', '=', 'songs.artist');
					})
					->Join('albums', function($join){
						$join->on('albums.id', '=', 'songs.album');
					})
					->where('songs.album', $albumId)
					->orderBy('songs.albumOrder')
					->get([
						DB::raw('songs.title as song_title'),
						DB::raw('songs.duration as duration'),
						DB::raw('artist.name as artist_name'),
						DB::raw('songs.id')
					]);


	}

	/*
	 * getDetailsByAlbumId
	 *
	 * Get song details by album id
	 *
	 * Example Usage:
	 *
	 * $songs = new Songs;
	 * $songs = $songs->getDetailsByAlbumId();
	 *
	 * @return Array
	 */
	public function getDetailsByAlbumId( $albumId = '' ){

		return self::Join('artist', function($join){
						$join->on('artist.id', '=', 'songs.artist');
					})
					->Join('albums', function($join){
						$join->on('albums.id', '=', 'songs.album');
					})
					->where('albums.id', $albumId)
					->groupBy('albums.id')
					->first([
						DB::raw('albums.title as album_name'),
						DB::raw('albums.artworkPath as photo'),
						DB::raw('artist.name as artist_name'),
						DB::raw('count(songs.id) as number_of_songs')
					]);

	}

	/*
	 * getSongsRandom
	 *
	 * get available songs randomly
	 *
	 * Example Usage:
	 *
	 * $songs = new Songs;
	 * $songs = $songs->getSongsRandom();
	 *
	 * @return Array
	 */
	public static function getSongsRandom(){

		return self::orderByRaw('RAND()')
					->limit(10)
					->get();

	}

	/*
	 * getSongDetailsById
	 *
	 * get song details by song ID
	 *
	 * Example Usage:
	 *
	 * $songs = new Songs;
	 * $songs = $songs->getSongDetailsById();
	 *
	 * @return Array
	 */
	public static function getSongDetailsById( $songId = '' ){

		return self::Join('artist', function($join){
						$join->on('artist.id', '=', 'songs.artist');
					})
					->Join('albums', function($join){
						$join->on('albums.id', '=', 'songs.album');
					})
					->where('songs.id', $songId)
					->groupBy('albums.id')
					->first([
						DB::raw('songs.*'),
						DB::raw('albums.title as album_name'),
						DB::raw('albums.artworkPath as photo'),
						DB::raw('artist.name as artist_name')
					]);

	}


}

/* End of file Songs.php */
/* Location: ./app/models/Songs.php */