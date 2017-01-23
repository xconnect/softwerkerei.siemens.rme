<!doctype html>
<html>
  <head>
 		<title>CTS Service - Index</title>
		<meta name="description" content="Index" />
		<meta name="keywords" content="HTML,CSS,JavaScript" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8" />
		
		<link rel="stylesheet" href="css/cts.css">
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
		<script src="js/bootstrap.min.js"></script>
	</head>
  <body>
    <nav class="navbar" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand logo-text" href="index.php">SIEMENS</a>
        </div>
    </nav>
    <div class="well col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-12" id="login-wrap">
      <form action="includes/auth/login.php" method="post" role="form" id="loginForm" name="login_form" value="login">
        <div class="form-group">
          <label for="username" class="sr-only">Username</label>
          <input type="text" name="username" class="form-control col-md-12" tabindex="1" placeholder="Username"/>
        </div>
        <div class="form-group">
          <label for="password" class="sr-only">Password</label>
          <input type="password" name="password" class="form-control col-md-12" tabindex="2" placeholder="Password"/>
        </div>
        <div class="form-group">
          <label for="login" class="sr-only">Login</label>
          <input type="hidden" name="login" class="form-control" value="login"/>
          <label for="submit" class="sr-only">Anmelden</label>
          <button type="submit" name="submit" class="btn btn-success col-md-12" tabindex="3">anmelden</button>
        </div>
		  </form>
    </div>
    <footer class="navbar-fixed-bottom">
      <span class="text-left navbar-left">&copy; <a href="http://www.siemens.com">Siemens</a></span>
      <span class="text-right navbar-right">Developed by F. Radermacher, T. Bullmann, N. Lehmann</span>
    </footer>
	</body>
</html>
