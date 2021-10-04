<?php

class AlbumController extends BackendController{
	
	public $c = 'Album';

	function showPage(){

		$this->layout->content = View::make('admin.album.lists');

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

		$album = new Album;

		$page = Input::get('page');

		$limit = Config::get('cms_config.limit');
		$total = $album->getAlbumTotal();

		$num_pages = ceil( $total / $limit);
		
		if ($page > $num_pages && $total != 0) $page = $num_pages; 
		
		$offset = $limit * $page - $limit;

		$album = $album->albumLists($offset);

		$select = array(
					'id',
					'artworkPath',
					'title',
					'id'
				);


		$rows = ListsFormatter::_run( $album, 'id', $select );

		$format = array(
					'page' => $page,
					'total' => $num_pages,
					'records' => $total,
					'rows' => $rows
				);

		return Response::json($format);

	}

	function showAddForm(){

		$this->layout->content = View::make('admin.album.form');

	}

	function showEditForm( $id = '' ){

		try{

			$album = Album::find($id);

			if( is_null($album) ) throw new Exception(sprintf(trans('messages.cms_no_record'), $this->c));
			
			$this->layout->content = View::make('admin.album.form')
										   ->with('album', $album);

		}catch(Exception $e){
			_error($e->getMessage());
			return $this->landing();
		}
		
	}

	function _set_rules(){

		$validator = array(
				'title' => 'required'
			);

		return $validator;

	}

	function postSubmit(){

		try
		{

			$validator = Validator::make(Input::all(), $this->_set_rules());

			if( $validator->fails() ) throw new Exception(trans('messages.cms_error'));

			$destination = Config::get('public_config');
	        $destination = $destination['upload_path']['album_photo'];

	        $fileName = '';
	        if( Input::hasFile('photo') ){

				$photo = Input::file('photo');
				$extension = $photo->getClientOriginalExtension();
	            $fileName = $photo->getClientOriginalName();

	            $photo->move($destination, $fileName);
				
			}

			if( Input::has('id') ){

				$album = Album::find( Input::get('id') );
				
				$album->title = Input::get('title');

				if( ! empty($fileName) ){
					unlink($album->artworkPath);
					$album->artworkPath = $destination . $fileName;
				}

    			if( ! $album->save() ) throw new Exception(sprintf(trans('messages.cms_edit_error'), $this->c));
    			
    			_success(sprintf(trans('messages.cms_edit_success'), $this->c));

			}else{

				$album = new Album;
				
				$album->title = Input::get('title');
				$album->artworkPath = $destination . $fileName;

				if( ! $album->save() ) throw new Exception(sprintf(trans('messages.cms_add_error'), $this->c));

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

			$album = Album::find($id);

			if( ! $album->delete() ) throw new Exception(sprintf(trans('messages.cms_delete_error'), $this->c));

			_success(sprintf(trans('messages.cms_delete_success'), $this->c));

		}catch(Exception $e){
			_error($e->getMessage());
		}

		return $this->landing();

	}

}

/* End of file AlbumController.php */
/* Location: ./app/controllers/AlbumController.php */