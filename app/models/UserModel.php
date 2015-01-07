<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class UserModel extends Eloquent implements UserInterface, RemindableInterface {

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

	// Add this to tell Laravel what can be saved in the users table
	protected $fillable = array(
		'givenname', 'surname', 'username', 
		'email', 'password', 'access', 'isdel', 
		'active', 'photo', 'last_login');

	public static $rules = array(
		'givenname' => 'alpha_num|max:50',
		'surname' => 'alpha_num|max:50',
		'username' => 'required|unique:users,username|alpha_dash|min:5',
		'email' => 'required|unique:users,email|email',
		'password' => 'required|alpha_num|between:6,100|confirmed',
		'password_confirmation' => 'required|alpha_num|between:6,100'
		);

}
