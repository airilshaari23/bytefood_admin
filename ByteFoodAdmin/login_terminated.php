<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ByteFood Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/default.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body>
  <div style="margin-left:auto;margin-right:auto;"  class="col-xs-12">
<img src="ByteFoodAdmin.png"  class="login-img" style=""/>
  </div>
    <div class="container">

      <form class="form-signin" method="post" action="login_ctrl.php">
    
        <h2 class="form-signin-heading" style="text-align:center;">Please sign in</h2>
        
        <input type="text" id="username" name="username" class="form-control" placeholder="Session Terminated" required autofocus>
        &nbsp;
        <input type="password" id="password" name="password" class="form-control" placeholder="Session Terminated" required>        
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div>
  </body>
</html>
