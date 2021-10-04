<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/*
	 * UserDetails
	 *
	 * This is only a Relational function
	 * showing that this table/model have
	 * one user details
	 *
	 * @return Array
	 *
	 */

	function UserDetails(){
		return $this->hasOne('UserDetails');
	}


	/*
	 * deleteUserDetails
	 *
	 * This will be the function of 
	 * deleting users information ( user_details )
	 * base on the user_id provided
	 *
	 * Example usage:
	 *
	 * $user = User::find(1);
	 * $user->deleteUserDetails();
	 *
	 * @return Boolean
	 *
	 */

	function deleteUserDetails(){

		return $this->UserDetails()
					->delete();

	}

	/*
	 * systemUserLists
	 *
	 * This will be getting all the users
	 * only for the system users page.
	 *
	 * Example Usage:
	 *
	 * $user = new User;
	 * $user = $user->systemUserLists();
	 *
	 * @return Array
	 */

	function systemUserLists( $offset = 0 ){

		return $this->leftJoin('groups', function($join){
						$join->on('groups.id', '=', 'users.group_id');
					})
					->whereIn('users.group_id', array(2))
					->take(Config::get('cms_config.limit'))
					->offset($offset)
					->get([
							'users.id',
							'users.first_name',
							'users.last_name',
							'users.email',
							'groups.name',
							'users.id'
						]);
	}

	/*
	 * getSytemUserTotal
	 *
	 * This will be getting the number of users
	 * only for the system users page.
	 *
	 * Example Usage:
	 *
	 * $user = new User;
	 * $user = $user->getSytemUserTotal();
	 *
	 * @return Array
	 */

	function getSytemUserTotal(){

		return $this->leftJoin('groups', function($join){
						$join->on('groups.id', '=', 'users.group_id');
					})
					->whereIn('users.group_id', array(2, 3))
					->count();

	}

	/*
	 * getLoggedUserInfo
	 *
	 * Get user logged in info in client side
	 *
	 * Example usage:
	 *
	 * $user = new User;
	 * $user = $user->getLoggedUserInfo();
	 *
	 * @return
	 * Array
	 */

	function getLoggedUserInfo(){

		$user_id = Sentry::getUser()->id;

		return $this->find($user_id)
			 		->UserDetails()
			 		->first();

	}

	/*
	 * getUserEmailByGroupId
	 *
	 * get the email base on the requested
	 * group/user type
	 * 
	 * @params Integer
	 * @return String
	 */

	function getUserEmailByGroupId( $group_id = '' ){

		$user = $this->where('group_id', '=', $group_id)
					 ->first();

		return $user->email;

	}
	
	/*
	 * 
	 * getUserDetails
	 * 
	 * Getting all the details of the
	 * user on the user_details table
	 * 
	 * @return Array
	 */
	
	function getUserDetails(){
		
		return $this->UserDetails()
					->first();
		
	}


}

/* End of file User.php */
/* Location: ./app/models/User.php */
