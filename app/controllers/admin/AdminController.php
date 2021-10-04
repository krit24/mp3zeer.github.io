<?php

class AdminController extends BackendController{
    
    function showPage(){

        $this->layout->content = View::make('main_admin');

    }

    function showLoginPage(){

        $this->layout->content = View::make('login');

    }

    function _set_rules(){

        $validator = array(
                'email' => 'required|email',
                'password' => 'required',
            );

        return $validator;

    }

    function postSubmit(){

        $validator = Validator::make(Input::all(), $this->_set_rules());

        try
        {

            if ( $validator->fails() ) throw new Exception(trans('messages.cms_error'));

			$email = Input::get('email');
			$password = Input::get('password');

			$allowed_user = array('1', '2', '3');

			$user = User::where('email', '=', $email)->first();
			
			if( ! is_null( $user ) && ! in_array($user->group_id, $allowed_user) ) throw new Exception(trans('messages.cms_not_allowed_user'));

            // Login credentials
            $credentials = array(
                'email'    => $email,
                'password' => $password,
            );

            // Authenticate the user
            $user = Sentry::authenticate($credentials, false);

            if( Input::has('remember') ) Sentry::loginAndRemember($user);

            return Redirect::to('admin');

        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            _error(trans('validation.custom.field_required'));
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            _error(trans('validation.custom.password_required'));
        }
        catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            _error(trans('validation.custom.wrong_password'));
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            _error(trans('validation.custom.user_not_found'));
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            _error(trans('validation.custom.user_not_activated'));
        }
        catch (Exception $e){
            _error($e->getMessage());
        }

        return Redirect::to('auth');

    }

    function logout(){

        Sentry::logout();
        _success(trans('validation.custom.logout_success'));
        return Redirect::to('auth');
    }

}

/* End of file AdminController.php */
/* Location: ./app/controllers/AdminController.php */
