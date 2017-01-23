<?php
// initalise necessary data and functions
require "includes/init.php";
// the website starts here
?>
<!doctype html>

<html>
  <head>
 		<title>CTS Datenexport - Sales Bridge</title>
		<meta name="description" content="Index" />
		<meta name="keywords" content="HTML,CSS,JavaScript" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8" />
		
		<link rel="stylesheet" href="css/cts.css">
		<link rel="stylesheet" href="css/handsontable.full.min.css">
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/handsontable.full.min.js"></script>
		<script src="js/cts.js"></script>
	</head>
  <body>
    <div id="wrap">
      <nav class="navbar" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo-text" href="index.php">SIEMENS</a>
          </div>
          <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
              <?php if(isset($menus[$_SESSION["roleId"]])) : ?>
                <li class="dropdown navbar-form">
                    <a class="dropdown-toggle btn btn-primary" id="navmenu" data-toggle="dropdown">
                      Modus
                      <span class="caret"/>
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="navmenu">
                      <?php foreach($_SESSION["sites"] as $site) : ?>
                        <li role="presentation">
                          <a role="menuitem" tabindex="-1" href="<?php echo $site; ?>"><?php echo $site; ?></a>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                </li>
              <?php endif; ?>
              <li class="dropdown">
                <a class="dropdown-toggle" id="usermenu" data-toggle="dropdown"><img src="img/flag/<?php echo $_SESSION["selectedLanguage"]; ?>.png" alt="<?php echo $_SESSION["selectedLanguage"]; ?>"/></a>
                <ul class="dropdown-menu dropdown-flag" role="menu" aria-labelledby="usermenu">
                  <?php foreach($_SESSION["remainingLanguages"] as $language) : ?>
                    <li role="presentation">
                      <a role="menuitem" tabindex="-1" href="<?php echo basename(__file__)."?language=$language"; ?>">
                        <img src="img/flag/<?php echo $language; ?>.png" alt="<?php echo $language; ?>"/>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </li>
              <li>
                <a href="help.php" id="helpLogo"><span class="glyphicon glyphicon-question-sign"></span></a>
              </li>
              <li><p class="navbar-text"><?php echo $_SESSION["userRole"]; ?></p></li>
              <li>
                <form method="link" action="<?php echo WEB_AUTH_DIR."/logout.php"; ?>" role="form" class="navbar-form">
                  <button type="submit" class="btn btn-danger">Logout</button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="col-md-2 col-sm-3 col-xs-4" id="menu">
        <div href="controldataexport.php" class="return-btn btn-primary col-md-6 col-md-offset-1">
          <span class="glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;<span class="return-text">zurück</span>
        </div>
        <div class="col-md-12"><span class="return-text">Datenexport<br /><span style="color:#FFFFFF"><i>Sales Bridge</i></span></span></div>
      </div>
      <div class="col-md-10 col-sm-9 col-xs-8" id="content">
        <div class="offset-top-15">
            
				<div class="container-fluid offset-top-15">
				
					<div class="col-md-6">
						<div class="offset-top-15"></div>
					
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Herunterladen des Templates</h3>
							</div>
							<div class="panel-body">
								<button class="btn btn-warning">Download Template</button>
							</div>
						</div>
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Datenexport - Anleitung: <i>Sales Bridge</i></h3>
							</div>
							<div class="panel-body">
													
								<div><b><u>1. Schritt</u></b>: <i>Auswahl der <b>aktuellen</b> Quelldatei</i></div>
								<div class="offset-top-15">
									 <input type="file" class="btn-primary offset-top-15 btn" id="dexp_sb_aktuelleQD"/>
								</div>
								
								<div class="offset-top-15"></div>
								
								<div><b><u>2. Schritt</u></b>: <i>Auswahl der <b>Vergleichs</b>quelldatei</i></div>
								<div class="offset-top-15">
									 <input type="file" class="btn-primary offset-top-15 btn" id="dexp_sb_vergleichQD"/>
								</div>
								
								<div class="offset-top-15"></div>
							
								<div><b><u>3. Schritt</u></b>: <i>Erstellen der "Sales Bridge"</i></div>
								<div class="offset-top-15">
									<button class="btn btn-success">Erstellen</button>
								</div>
								
							</div>
						</div>
				
					</div>
				</div>
			
		</div>
	  </div>
    <footer class="navbar-fixed-bottom">
      <span class="text-left navbar-left">&copy; <a href="http://www.siemens.com">Siemens</a></span>
      <span class="text-right navbar-right">Developed by F. Radermacher, T. Bullmann, N. Lehmann</span>
    </footer>
	</body>
	</body>
</html>
