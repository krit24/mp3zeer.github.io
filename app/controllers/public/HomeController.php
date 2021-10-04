<?php

class HomeController extends PublicController {

	function showBrowse(){

		$this->layout->content = View::make('browse');
	}

	function showRegisterConfirmation(){
		$this->layout->content = View::make('register_confirmation');
	}

	function _set_rules(){

		$validator = array(
				'username' => 'required',
				'firstName' => 'required',
				'lastName' => 'required',
				'email' => 'required|email',
				'email2' => 'required|email',
				'password' => 'required',
				'password2' => 'required'
			);

		return $validator;

	}

	function  postSubmit(){

		try
		{

			$rules = $this->_set_rules();

			$validate = Validator::make(Input::all(), $rules);

			if( $validate->fails() ) throw new Exception(trans('message.public_request_error'));
			
			$group_id = 3;
		    // Create the user
		    $user = Sentry::createUser(array(
		        'username'     => Input::get('username'),
		        'email'     => Input::get('email'),
		        'password'  => Input::get('password'),
		        'first_name'  => Input::get('firstName'),
		        'last_name'  => Input::get('lastName'),
		        'group_id' => $group_id
		    ));

		    $activationCode = $user->getActivationCode();

		    // Find the group using the group id
		    $adminGroup = Sentry::findGroupById($group_id);

		    // Assign the group to the user
		    $user->addGroup($adminGroup);

		    $datas = array(
		    		'name' => $user->first_name . ' ' . $user->last_name,
		    		'password' => $temp_password,
		    		'email' => $user->email,
		    		'code' => $activationCode
		    	);

		 //    Mail::send('emails.auth.account_activation', array('data' => $datas), function($message) use ($datas)
			// {
			//     $message->to($datas['email'], $datas['name'])->subject('Account activation');
			// });

		    return Redirect::to('registration-confirmation');

		}catch(Exception $e){
			_error($e->getMessage());
			return Redirect::to('/');
		}

	}
	
	// function showForgotPass(){
		
	// 	$this->layout->content = View::make('forgot');
		
	// }
	
	// function postForgotPass(){
		
	// 	try
	// 	{
			
	// 		$user = Sentry::findUserByLogin( Input::get('email') );

	// 		$user_info = User::find($user->id);
	// 		$user_info = $user_info->getUserDetails();
	
	// 		$temp_password = str_random(20);
	
	// 		$_data = array(
	// 			'name' => $user_info->first_name . ' ' . $user_info->last_name,
	// 			'temp_pass' => $temp_password,
	// 			'email' => Input::get('email')
	// 		);
			
	// 		$user = Sentry::getUserProvider()->findById($user->id); 
	// 		$user->password = $temp_password; 
	// 		$user->save();

	// 		Mail::send('emails.auth.forgot_password', array('data' => $_data), function($message) use ($_data)
	// 		{
	// 		    $message->to($_data['email'], $_data['name'])->subject('Forgot password');
	// 		});
			
	// 		_success(trans('messages.public_forgot_success'));

	// 	}
	// 	catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	// 	{
	// 		_error(trans('messages.public_acct_not_found'));
	// 	}
	// 	catch(Exception $e){
	// 		_error($e->getMessage());
	// 	}
		
	// 	return Redirect::to('forgot');
		
	// }

}

/* End of file HomeController.php */
/* Location: ./app/controllers/HomeController.php */
