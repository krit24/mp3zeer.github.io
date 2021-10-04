<?php

/*
 * Options
 *
 * Manipulating dynamic data for
 * options table
 *
 * @author Jonel Letran
 * @created September 14, 2019
 *
 */

use LaravelBook\Ardent\Ardent;

class Options extends Ardent {

	protected $table = 'options';

	/*
	 * getText
	 *
	 * Get the text of the options
	 * based from the given parameters
	 *
	 * Example usage:
	 *
	 * $options = Options::getText(String, String);
	 *
	 * @params String, String
	 * @return String
	 */

	public static function getText( $type = '', $value = '' ){

		$text = self::where('type', '=', $type)
				    ->where('value', '=', $value)
				    ->first(['text']);

		return $text->text;

	}

	/*
	 * getOptions
	 *
	 * Get the respective options
	 * base on requested options
	 *
	 * Example usage:
	 * $options = Options::getOptions(name);
	 *
	 * @params String
	 * @return Array
	 */

	function getOptions($type = ''){

		return $this->where('type', '=', $type)
					->get(['value', 'text']);

	}

}

/* End of file Options.php */
/* Location: ./app/models/Options.php */