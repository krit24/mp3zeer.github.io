<?php

class GenreController extends BackendController{
	
	public $c = 'Genre';

	function showPage(){

		$this->layout->content = View::make('admin.genre.lists');

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

		$genre = new Genre;

		$page = Input::get('page');

		$limit = Config::get('cms_config.limit');
		$total = $genre->getGenreTotal();

		$num_pages = ceil( $total / $limit);
		
		if ($page > $num_pages && $total != 0) $page = $num_pages; 
		
		$offset = $limit * $page - $limit;

		$genre = $genre->genreLists($offset);

		$select = array(
					'id',
					'name',
					'id'
				);


		$rows = ListsFormatter::_run( $genre, 'id', $select );

		$format = array(
					'page' => $page,
					'total' => $num_pages,
					'records' => $total,
					'rows' => $rows
				);

		return Response::json($format);

	}

	function showAddForm(){

		$this->layout->content = View::make('admin.genre.form');

	}

	function showEditForm( $id = '' ){

		try{

			$genre = Genre::find($id);

			if( is_null($genre) ) throw new Exception(sprintf(trans('messages.cms_no_record'), $this->c));
			
			$this->layout->content = View::make('admin.genre.form')
										   ->with('genre', $genre);

		}catch(Exception $e){
			_error($e->getMessage());
			return $this->landing();
		}
		
	}

	function _set_rules(){

		$validator = array(
				'name' => 'required'
			);

		return $validator;

	}

	function postSubmit(){

		try
		{

			$validator = Validator::make(Input::all(), $this->_set_rules());

			if( $validator->fails() ) throw new Exception(trans('messages.cms_error'));

			if( Input::has('id') ){
				$genre = Genre::find( Input::get('id') );
				
				$genre->name = Input::get('name');

    			if( ! $genre->save() ) throw new Exception(sprintf(trans('messages.cms_edit_error'), $this->c));
    			
    			_success(sprintf(trans('messages.cms_edit_success'), $this->c));

			}else{

				$genre = new Genre;
				
				$genre->name = Input::get('name');

				if( ! $genre->save() ) throw new Exception(sprintf(trans('messages.cms_add_error'), $this->c));

			    _success(sprintf(trans('messages.cms_add_success'), $this->c));

			}

		}
		catch(Exception $e){
			_error($e->getMessage());
		}

		return $this->landing();

	}

	function getDelete( $id = '' ){

		try{

			$genre = Genre::find($id);

			if( ! $genre->delete() ) throw new Exception(sprintf(trans('messages.cms_delete_error'), $this->c));

			_success(sprintf(trans('messages.cms_delete_success'), $this->c));

		}catch(Exception $e){
			_error($e->getMessage());
		}

		return $this->landing();

	}

}

/* End of file GenreController.php */
/* Location: ./app/controllers/GenreController.php */