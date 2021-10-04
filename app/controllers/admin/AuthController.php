<?php

class AuthController extends PublicController{
    
    function showPage(){
		
        $this->layout->content = View::make('home');

    }

    function _set_rules(){

        $validator = array(
                'loginUsername' => 'required',
                'loginPassword' => 'required',
            );

        return $validator;

    }

    function postSubmit(){

        $validator = Validator::make(Input::all(), $this->_set_rules());

		$suspension = 0;

        try
        {

            if ( $validator->fails() ) throw new Exception(trans('messages.public_error_login'));

			$username = Input::get('loginUsername');
			$password = Input::get('loginPassword');

			$allowed_user = array('3');

            if( strpos($username, "@") !== FALSE ){
                $user = User::where('email', '=', $username)->first();
            }else{
                $user = User::where('username', '=', $username)->first();
            }

            if( ! $user ) throw new Exception(trans('messages.public_error_login'));
            
			if( ! is_null( $user ) && ! in_array($user->group_id, $allowed_user) ) throw new Exception(trans('messages.public_not_allowed_user'));

            // Login credentials
            $credentials = array(
                'email'    => $user->email,
                'password' => $password,
            );

            // Authenticate the user
            $user = Sentry::authenticate($credentials, false);
            
            return Redirect::to('browse');

        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            _error(trans('messages.public_user_not_found'));
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            _error(trans('messages.public_user_not_activated'));
        }
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{	
			$suspension = 1;
			_error(trans('messages.public_user_suspended'));
		}
        catch (Exception $e){
            _error($e->getMessage());
        }

        return Redirect::to('/')
					   ->with('suspension', $suspension);

    }

    function logout(){

        Sentry::logout();
        _success(trans('messages.public_logout_success'));
        return Redirect::to('/');
    }
    
    function getUnsuspend( $id = '' ){
		
		$throttle = Sentry::findThrottlerByUserId($id);

		$throttle->unsuspend();
		
		return Redirect::to('/');
		
	}

}

/* End of file AuthController.php */
/* Location: ./app/controllers/AuthController.php */
