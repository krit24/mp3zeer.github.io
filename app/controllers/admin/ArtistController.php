<?php

class ArtistController extends BackendController{
	
	public $c = 'Artist';

	function showPage(){

		$this->layout->content = View::make('admin.artist.lists');

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

		$artist = new Artist;

		$page = Input::get('page');

		$limit = Config::get('cms_config.limit');
		$total = $artist->getArtistTotal();

		$num_pages = ceil( $total / $limit);
		
		if ($page > $num_pages && $total != 0) $page = $num_pages; 
		
		$offset = $limit * $page - $limit;

		$artist = $artist->artistLists($offset);

		$select = array(
					'id',
					'name',
					'id'
				);


		$rows = ListsFormatter::_run( $artist, 'id', $select );

		$format = array(
					'page' => $page,
					'total' => $num_pages,
					'records' => $total,
					'rows' => $rows
				);

		return Response::json($format);

	}

	function showAddForm(){

		$this->layout->content = View::make('admin.artist.form');

	}

	function showEditForm( $id = '' ){

		try{

			$artist = Artist::find($id);

			if( is_null($artist) ) throw new Exception(sprintf(trans('messages.cms_no_record'), $this->c));
			
			$this->layout->content = View::make('admin.artist.form')
										   ->with('artist', $artist);

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
				$artist = Artist::find( Input::get('id') );
				
				$artist->name = Input::get('name');

    			if( ! $artist->save() ) throw new Exception(sprintf(trans('messages.cms_edit_error'), $this->c));
    			
    			_success(sprintf(trans('messages.cms_edit_success'), $this->c));

			}else{

				$artist = new Artist;
				
				$artist->name = Input::get('name');

				if( ! $artist->save() ) throw new Exception(sprintf(trans('messages.cms_add_error'), $this->c));

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

			$artist = Artist::find($id);

			if( ! $artist->delete() ) throw new Exception(sprintf(trans('messages.cms_delete_error'), $this->c));

			_success(sprintf(trans('messages.cms_delete_success'), $this->c));

		}catch(Exception $e){
			_error($e->getMessage());
		}

		return $this->landing();

	}

}

/* End of file ArtistController.php */
/* Location: ./app/controllers/ArtistController.php */