<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/*
	 * landing
	 *
	 * used for auto detect the current 
	 * controller and redirect to it.
	 *
	 * @return redirect
	 */

	function landing( $params = '' ){

		$route = Request::segment(1);

		if( $route == 'admin' ) $route = $route . '/' . Request::segment(2);

		$route = $route . '/' . $params;

		if( ! Input::ajax() ) return Redirect::to($route);

		echo 'window.location = "' . URL::to($route) . '"';

	}

	/*
	 * deleteFile
	 *
	 * Deleting all the file on the
	 * file system based on the given 
	 * file path
	 *
	 * @params String
	 * @return Boolean
	 */

	function deleteFile( $path = '' ){

		if( ! file_exists($path) ) return false;

		unlink($path);
		return true;

	}
	
	/*
	 * 
	 * getLanguage
	 * 
	 * Use to fetch all the labels 
	 * in the language
	 * 
	 * @return JSON String
	 */
	 
	function getLanguage(){
		
		$lang = trans('system_lang');
		
		return Response::json($lang);
		
	}

}
