<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Check authentication prior to allowing the user access to the content
Route::group(array('before' => 'auth'), function()
{
	Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));
 
});


// Route to the login page
Route::get('login', function()
{
     return View::make('login.loginform')
          ->with('title', 'Login');
});

Route::post('login', 'UserController@login');

// Route to logout
Route::get('logout', function()
{
	Auth::logout();
	Session::flush();
	return Redirect::to('login') ->
		with('message', FlashMessage::DisplayAlert('Logged out successfully', 'info'));

});

// Route to the sign up form
Route::get('signup', function() {
	return View::make('user.signup')
		-> with('title', 'Sign up');
});

// Route for the signup page por post
Route::post('signup', 'UserController@signup');

// Route to the forgotten password form
Route::get('forgotpassword', function() {
	return View::Make('user.forgotpassword')->with('title', 'Password recovery');
});

// Rouyte submit of forgotten password form to the UserCOntroller
Route::post('forgotpassword', 'UserController@forgotpassword');

// Route that uses the reset script to reset password
Route::get('resetpassword/{resetcode}', 'UserController@resetpassword');