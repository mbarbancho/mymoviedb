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
 
    <h2 style="text-align:center">Reset User Password</h2>
    <br><br>

    @if(Session::has('message')) 
      <div class="alert alert-danger" style="text-align: center">{{ Session::get('message') }}</div>
      <br />
    @endif
 
    <center>
      <div class="well col-md-4 col-md-offset-4" >
        <form method="post" action="<?=URL::to('forgotpassword'); ?>">
          <label>Please insert your registered email address</label><br>
          <input type="email" id="email" name="email" placeholder="E-mail">
          <br><br>
 
          <button class="btn btn-success" type="submit" value="forgotpassword">Submit</button>

          <br /><br />
          <div>
            <p>&copy;MyMovieDB {{date('Y') }}<br /></p>
          </div>

        </form>
      </div>
    </center>
 
    <!-- Javascript Files required for page-->
    <script src="/js/bootstrap.min.js"></script>
 
  </body>
 
</html>