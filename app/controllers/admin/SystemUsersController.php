<?php

class SystemUsersController extends BackendController{
	
	public $c = 'System Users';

	function showPage(){

		$this->layout->content = View::make('system_users.lists');

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

		$user = new User;

		$page = Input::get('page');

		$limit = Config::get('cms_config.limit');
		$total = $user->getSytemUserTotal();

		$num_pages = ceil( $total / $limit);
		
		if ($page > $num_pages && $total != 0) $page = $num_pages; 
		
		$offset = $limit * $page - $limit;

		$user = $user->systemUserLists($offset);

		$select = array(
					'id',
					'first_name',
					'last_name',
					'email',
					'name',
					'id'
				);


		$rows = ListsFormatter::_run( $user, 'id', $select );

		$format = array(
					'page' => $page,
					'total' => $num_pages,
					'records' => $total,
					'rows' => $rows
				);

		return Response::json($format);

	}

	function showAddForm(){

		$this->layout->content = View::make('system_users.form');

	}

	function showEditForm( $id = '' ){

		try{

			$user = User::find($id);

			if( is_null($user) ) throw new Exception(sprintf(trans('messages.cms_no_record'), $this->c));
			
			$this->layout->content = View::make('system_users.form')
										   ->with('user', $user);

		}catch(Exception $e){
			_error($e->getMessage());
			return $this->landing();
		}
		
	}

	function _set_rules(){

		$validator = array(
				'first_name' => 'required',
				'last_name' => 'required',
				'email' => 'required|email',
				'user_types' => 'required'
			);

		return $validator;

	}

	function postSubmit(){

		try
		{

			$validator = Validator::make(Input::all(), $this->_set_rules());

			if( $validator->fails() ) throw new Exception(trans('messages.cms_error'));

			if( Input::has('id') ){
				$user = Sentry::findUserById( Input::get('id') );
				
				$user->email = Input::get('email');
    			$user->first_name = Input::get('first_name');
    			$user->last_name = Input::get('last_name');
    			$user->group_id = Input::get('user_types');

    			if( ! $user->save() ) throw new Exception(sprintf(trans('messages.cms_edit_error'), $this->c));
    			
    			_success(sprintf(trans('messages.cms_edit_success'), $this->c));

			}else{

				$temp_password = str_random(20);			

			    // Create the user
			    $user = Sentry::createUser(array(
			        'email'     => Input::get('email'),
			        'password'  => $temp_password,
			        'first_name' => Input::get('first_name'),
			        'last_name' => Input::get('last_name'),
			        'group_id' => Input::get('user_types'),
			        'activated' => true
			    ));

			    // Find the group using the group id
			    $adminGroup = Sentry::findGroupById( Input::get('user_types') );

			    // Assign the group to the user
			    $user->addGroup($adminGroup);

			 //    Mail::send('emails.auth.temporary_password', array('data' => $temp_password), function($message)
				// {
				// 	$email = Sentry::getUser()->email;
				// 	$name = Sentry::getUser()->first_name . ' ' . Sentry::getUser()->last_name;
				//     $message->to($email, $name)->subject('Welcome!');
				// });

			    _success(sprintf(trans('messages.cms_add_success'), $this->c));

			}

		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
			_error('Login field is required.');
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
			_error('Password field is required.');
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
			_error('User with this login already exists.');
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
			_error('Group was not found.');
		}
		catch(Exception $e){
			_error($e->getMessage());
		}

		return $this->landing();

	}

	function getDelete( $id = '' ){

		try{

			$user = User::find($id);

			if( ! $user->delete() ) throw new Exception(sprintf(trans('messages.cms_delete_error'), $this->c));
			
			$user->deleteUserDetails();

			_success(sprintf(trans('messages.cms_delete_success'), $this->c));

		}catch(Exception $e){
			_error($e->getMessage());
		}

		return $this->landing();

	}

}

/* End of file SystemUsersController.php */
/* Location: ./app/controllers/SystemUsersController.php */