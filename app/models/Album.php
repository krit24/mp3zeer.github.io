<?php

/*
 * Album
 *
 * Manipulating dynamic data for
 * album table
 *
 * @author Jonel Letran
 * @created September 14, 2019
 *
 */

use LaravelBook\Ardent\Ardent;

class Album extends Ardent {

	protected $table = 'albums';


	/*
	 * albumLists
	 *
	 * This will be getting all the users
	 * only for the system users page.
	 *
	 * Example Usage:
	 *
	 * $album = new Album;
	 * $album = $album->albumLists();
	 *
	 * @return Array
	 */

	function albumLists( $offset = 0 ){

		return $this->take(Config::get('cms_config.limit'))
					->offset($offset)
					->get();
	}

	/*
	 * getArtistTotal
	 *
	 * This will be getting the number of users
	 * only for the system users page.
	 *
	 * Example Usage:
	 *
	 * $album = new Album;
	 * $album = $album->getAlbumTotal();
	 *
	 * @return Array
	 */

	function getAlbumTotal(){

		return $this->count();

	}

	/*
	 * getAll
	 *
	 * This will be getting the number of users
	 * only for the system users page.
	 *
	 * Example Usage:
	 *
	 * $album = new Album;
	 * $album = $album->getAll();
	 *
	 * @return Array
	 */

	public static function getAll(){
		return self::get();
	}

	public static function getName( $albumId = '' ){

		$result = self::where('id', $albumId)
						->first([
							DB::raw('title')
						]);
						
		return $result->title;

	}

	
}

/* End of file Album.php */
/* Location: ./app/models/Album.php */