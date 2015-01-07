<?php
class UserController extends BaseController {
 
public $restful = true;
 
/**
  * Display listing of the resource
  * 
  * @return Response
  */
 
public function login()
{
	// Set todays date into a variable
        $today = date("Y-m-d H:i:s");
 
        // Set the user array to gather data from the login form
	$userdata = array(
		'username' => Input::get('username'),
		'password' => Input::get('password')
		);
 
	// Check to see if the user is already logged in
		if(Auth::check())
		{
			return Redirect::to('/');
		} //End Auth Check
 
	if(Auth::attempt($userdata))
	{
		// Grab user record 
		$user = UserModel::find(Auth::user()->id);
 
		// If the user account is disabled then send user back to login screen
		if($user->active=='0')
		{
			Auth::logout();
			Session::flush();
 
			return Redirect::to('login') ->
			with('message', FlashMessage::DisplayAlert('user not active', 'danger'));

 
		} // End User active check
 
		Session::put('current_user', Input::get('username'));
		Session::put('user_access', $user->access);
		Session::put('user_id', $user->id);
 
                 // Set the user.last_login to todays date and save the record.
                 $user->last_login = $today;
                 $user->save();
 
		return Redirect::to('/') ->
			with('message', FlashMessage::DisplayAlert('Login successful', 'success'));

 
	} // End Auth Attempt If
	else
	{
		return Redirect::to('login') ->
		with('message', FlashMessage::DisplayAlert('Incorrect user name or password', 'danger'));
	} // End Else
 
} // End function Login
 
 
public function signup() {

	$today = date("Y-m-d H:i:s");

	$userdata = array(
		'givenname' => Input::get('givenname'),
		'surname' => Input::get('surname'),
		'username' => Input::get('username'),
		'email' => Input::get('email'),
		'password' => Input::get('password'),
		'password_confirmation' => Input::get('password_confirmation')
		);

	// Set validation rules
	$rules = array(
		'givenname' => 'alpha_num|max:50',
		'surname' => 'alpha_num|max:50',
		'username' => 'required|unique:users,username|alpha_dash|min:5',
		'email' => 'required|unique:users,email|email',
		'password' => 'required|alpha_num|between:6,100|confirmed',
		'password_confirmation' => 'required|alpha_num|between:6,100'
		);

	// Run our validation check
	$validator = Validator::make($userdata, $rules);

	// If validation fails, redirect user to the signup
	if ($validator->fails()) {
		return Redirect::back()
			->withInput()
			->withErrors($validator);
	} else {
		$user = new UserModel;
		$user->givenname = Input::get('givenname');
		$user->surname = Input::get('surname');
		$user->username = Input::get('username');
		$user->email = Input::get('email');
		$user->photo = 'No photo found';
		$user->password = Hash::make(Input::get('password'));
		$user->active = "1";
		$user->isdel = "0";
		$user->last_login = $today;
		$user->access = "User";

		$user->save();
	} // end else

	// Once the record has been saved, redirect the user to Login screen
	return Redirect::to('login') ->
		with('message', FlashMessage::DisplayAlert('user account created.', 'success'));

}

public function forgotpassword() {

	// Set the user array to gather data from the password reset form
	$userdata = array("email" => Input::get('email'));

	// Set validationo Rule

	$rules = array(
		"email" => "required|email"
	);

	// Run our validation rules
	$validator = Validator::make($userdata, $rules);

	if($validator->fails()) {
		return Redirect::back()
			-> withInput()
			-> withErrors($validator);
	} else {
		$user = UserModel::where('email', '=', Input::get('email'));

		// If the user record exists, grab first result returned
		if ($user->count()) {
			$user = $user->first();

			// Generate reset Code
			$resetcode = str_random(60);
			$passwd = str_random (15);

			// Set the new values in the users DB record
			$user->password_temp = Hash::make($passwd);
			$user->resetcode = $resetcode;

			// Save resertcode and temp_passwd
			if ($user->save()) {
				// Set data array, this is the info that will be passed to the email form
				$data = array('email' => $user->email,
							'firstname' => $user->givenname,
							'lastname' => $user->surname,
							'username' => $user->username,
							'link' => URL::to('resetpassword', $resetcode),
							'password' => $passwd,
							);
				// Send email to the user. This will plug the data values into the reminder emial template
				Mail::send('emails.auth.reminder', $data, function($message) use($user, $data) {
					$message->to($user->email, $user->givenname.' '.$user->lastname)->subject('MyMovieDV Recovery Request');
				});

				// Return to the login screen
				return Redirect::to('login')
					->with('message', FlashMessage::DisplayAlert('User password reset link has been sent to your email', 'success'));
			}
		} else {
			// else display feedback to the user
			return Redirect::to('forgotpassword')
				->with('message', FlashMessage::DisplayAlert('Could not validate existing email address', 'danger'));
		}
	}
}	

public function resetpassword($resetcode) {
	$user = UserModel::where('resetcode', '=', $resetcode)
		->where('password_temp', '!=', '');

	if ($user->count())	 {
		// Set the user variable to the first returned record
		$user = $user->first();

		// Set the user password to the value stored in password_temp and clear password_reset and reset code
		$user->password = $user->password_temp;
		$user->password_temp = '';
		$user->resetcode = '';

		if ($user->save()) {
			return Redirect::to('login')
				->with('message', FlashMessage::DisplayAlert('Your account has been reset', 'success'));
		} 
	}

	// If no user record found, inform
	return Redirect::to('login')
		->with('message', FlashMessage::DisplayAlert('Could not recover account.', 'danger'));

}

} // Ends UserController Class