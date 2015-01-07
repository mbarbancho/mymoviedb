<!DOCTYPE html>
<html lang="en">
  <head>
      <title>{{ $title }}</title>
 
      {{ HTML::style('/css/bootstrap.min.css') }}
      {{ HTML::style('/css/bootstrap-theme.css') }}
 
  </head>
 
  <body>
 
    <div id="nav">
      <div class="navbar navbar-inverse">
        <a class="navbar-brand">MyMovieDB</a>
      </div> <!-- End "navbar" Div-->
    </div> <!-- End "Nav" Div-->
 
    <h2 style="text-align:center">Login</h2>
    <br><br>

    @if(Session::has('message')) 
      <div class="alert alert-danger" style="text-align: center">{{ Session::get('message') }}</div>
      <br />
    @endif
 
    <center>
      <div class="well col-md-4 col-md-offset-4" >
        <form method="post" action="<?=URL::to('login'); ?>">
          <label>Username</label><br>
          <input type="text" id="username" name="username" placeholder="Username">
          <br><br>
 
          <label>Password</label><br>
          <input type="text" id="password" name="password" placeholder="Password">
          <br><br>
 
          <button class="btn btn-success" type="submit" value="Login">Login</button>

          <br /><br />
          <div>
            <p>Need an account? {{ HTML::link('signup', 'Sign up here!') }}</p>
            <p>Forgot the password? {{ HTML::link('forgotpassword', 'Reset password here!') }}</p>
            <p>&copy;MyMovieDB {{date('Y') }}<br /></p>
          </div>

        </form>
      </div>
    </center>
 
    <!-- Javascript Files required for page-->
    <script src="/js/bootstrap.min.js"></script>
 
  </body>
 
</html>