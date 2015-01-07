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
 
    <h2 style="text-align:center">New user sign</h2>
    <br><br>
 
    <center>
      <div class="well col-md-4 col-md-offset-4" >
        <form method="post" action="<?=URL::to('signup'); ?>">
          <label>First Name:</label><br> 
          <input type="text" id="givenname" name="givenname" placeholder="First Name" required />
          <br><br>

          <label>Last Name:</label><br> 
          <input type="text" id="surname" name="surname" placeholder="Last Name" required />
          <br><br>

          <label>Username:</label><br> 
          <input type="text" id="username" name="username" placeholder="Username" required />
          <br><br>
 
          <label>E-mail:</label><br>
          <input type="email" id="email" name="email" placeholder="Email address" required>
          <br><br>
 
          <label>Password</label><br>
          <input type="text" id="password" name="password" placeholder="Password">
          <br><br>

          <label>Confirm Password</label><br>
          <input type="text" id="password_confirmation" name="password_confirmation" placeholder="Retype Password">
          <br><br>

          <button class="btn btn-success" type="submit" value="Signup">Sign Up</button>
        </form>
      </div>
    </center>
 
    <!-- Javascript Files required for page-->
    <script src="/js/bootstrap.min.js"></script>
 
  </body>
 
</html>























