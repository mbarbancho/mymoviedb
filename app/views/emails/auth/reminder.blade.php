<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset Notification</h2>
		{{ $firstname }} {{$lastname}},
		<br /><br />
		You have requested to reset the login password for our {{ $username}} MovieDB account.<br />
		You'll need to click the following URL to activagte your new password before attempting to log in using it 
		for the first time.
		<br /><br />
		Your new temp is:<br />
		<b>{{ $password }}</b>
		<br /><br />
		Acivate it by clicking this URL: <br />
		{{ $link }}

		<br /><br />
		Thanks.

	</body>
</html>
