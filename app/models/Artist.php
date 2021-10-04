<?php

/*
 * Artist
 *
 * Manipulating dynamic data for
 * artist table
 *
 * @author Jonel Letran
 * @created September 14, 2019
 *
 */

use LaravelBook\Ardent\Ardent;

class Artist extends Ardent {

	protected $table = 'artist';


	/*
	 * artistLists
	 *
	 * This will be getting all the users
	 * only for the system users page.
	 *
	 * Example Usage:
	 *
	 * $artist = new Artist;
	 * $artist = $artist->artistLists();
	 *
	 * @return Array
	 */

	function artistLists( $offset = 0 ){

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
	 * $artist = new Artist;
	 * $artist = $artist->getArtistTotal();
	 *
	 * @return Array
	 */

	function getArtistTotal(){

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
	 * $artist = new Artist;
	 * $artist = $artist->getAll();
	 *
	 * @return Array
	 */

	public static function getAll(){
		return self::get();
	}

	public static function getName( $artistId = '' ){

		$result = self::where('id', $artistId)
						->first([
							DB::raw('name')
						]);
						
		return $result->name;

	}
}

/* End of file Artist.php */
/* Location: ./app/models/Artist.php */