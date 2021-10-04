<?php

/*
 * Genre
 *
 * Manipulating dynamic data for
 * genre table
 *
 * @author Jonel Letran
 * @created September 14, 2019
 *
 */

use LaravelBook\Ardent\Ardent;

class Genre extends Ardent {

	protected $table = 'genres';


	/*
	 * genreLists
	 *
	 * This will be getting all the users
	 * only for the system users page.
	 *
	 * Example Usage:
	 *
	 * $genre = new Genre;
	 * $genre = $genre->genreLists();
	 *
	 * @return Array
	 */

	function genreLists( $offset = 0 ){

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
	 * $genre = new Genre;
	 * $genre = $genre->getGenreTotal();
	 *
	 * @return Array
	 */

	function getGenreTotal(){

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
	 * $genre = new Genre;
	 * $genre = $genre->getAll();
	 *
	 * @return Array
	 */

	public static function getAll(){
		return self::get();
	}
}

/* End of file Genre.php */
/* Location: ./app/models/Genre.php */