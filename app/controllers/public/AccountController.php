<?php

class AccountController extends PublicController{
    
    function showPage(){

		$options = new Options;
		
        $this->layout->content = View::make('public.accounts.profile')
									 ->with('subjects', _compile_array($options->getOptions('subject_area'), '-- Select subject area ---'))
									 ->with('curriculum_standards', _compile_array($options->getOptions('curriculum_standards'), '-- Select curriculum standards ---'));

    }

    function showForm(){

    	$user = new User;
    	$user = $user->getLoggedUserInfo();
    	
    	$regions = new Region;
		$regions = _compile_array($regions->getAll(), '-- Select Regions --');
		
		$division = new Division;
		$division = _compile_array($division->getAll(), '-- Select Division --');
		
		$district = new District;
		$district = _compile_array($district->getAll(), '-- Select District --');
		
		$school = new School;
		$school = _compile_array($school->getAll(), '-- Select School --');

    	$this->layout->content = View::make('public.accounts.form')
    								   ->with('user', $user)
    								   ->with('regions', $regions)
    								   ->with('division', $division)
    								   ->with('district', $district)
    								   ->with('school', $school);

    }
    
    function showSettings(){
		
		$user = new User;
    	$user = $user->getLoggedUserInfo();
    	
		$this->layout->content = View::make('public.accounts.settings')
									 ->with('user', $user);
		
	}
	
	function postSaveEmail(){
		
		$email = Input::get('email');
		
		$user_email = new UserEmail;
		
		$user_email->user_id = Sentry::getUser()->id;
		$user_email->email = $email;
		
		$user_email->save();
		
		return View::make('public.accounts.settings_email');
		
	}
	
	function postSetEmailPrimary(){
		
		$id = Input::get('id');
		
		//get the value of the email
		$email = UserEmail::find($id);
		$email = $email->email;
		
		//update first the user table
		$user = User::find(Sentry::getUser()->id);
		$user->email = $email;
		
		$user->save();
		
		return View::make('public.accounts.settings_email');
		
	}
	
	function postDeleteEmail(){
		
		$id = Input::get('id');
		
		$email = UserEmail::find($id);
		$email->delete();
		
		return View::make('public.accounts.settings_email');
		
	}
	
	function postChangePassword(){
		
		$user = Sentry::getUserProvider()->findById(Sentry::getUser()->id); 
		$user->password = Input::get('password'); 
		$user->save();
		
		return Response::json(true);
		
	}
	
	function postUploadSubmit(){
		
		/*
		 * to be finished uploading and
		 * clean the codes.
		 */
		 
		$response = '';
	
		try{
			
			if( ! Input::hasFile('profile_pixx') ) throw new Exception(false);
		
			$destination = Config::get('public_config');
			$destination = $destination['upload_path']['profile'];
			
			$extension = Input::file('profile_pixx')->getClientOriginalExtension();
			
			$fileName = uniqid() . '.' . $extension;
			
			//get the current image or profile picture and replace the new one.
			
			$user = new User;
			$user = $user->getLoggedUserInfo();
			
			if( ! empty( $user->profile_pixx ) ) unlink( $destination . $user->profile_pixx );
			
			Input::file('profile_pixx')->move($destination, $fileName);
			
			$data = array(
				'profile_pixx' => $fileName
			);
			
			$user_details = UserDetails::updateInfo( $data );
			
			$response = true;
			
		}
		catch(Exception $e){
			$response = $e->getMessage();
		}
		
		return Response::json($response);
		
	}

}

/* End of file AccountController.php */
/* Location: ./app/controllers/AccountController.php */
