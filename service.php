<?php
// initalise necessary data and functions
require "includes/init.php";
// the website starts here
?>
<!doctype html>

<html>
  <head>
 		<title>service site</title>
		<meta name="description" content="Index" />
		<meta name="keywords" content="HTML,CSS,JavaScript" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8" />
		
		<link rel="stylesheet" href="css/cts.css">
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
		<script src="js/bootstrap.min.js"></script>
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
        <ul class="btn-group btn-group-lg btn-group-vertical">
          <li class="dropdown navbar-form">
            <a class="dropdown-toggle btn-lg btn-block" href="userinput.php">
              Dateneingabe
            </a>
          </li>
          <li class="dropdown navbar-form">
            <a class="dropdown-toggle btn-lg btn-block" href="reports.php">
              Reports
            </a>
          </li>
		  <li class="dropdown navbar-form">
            <a class="dropdown-toggle btn-lg btn-block" href="dataimport.php">
              Datenimport
            </a>
          </li>
		  <!--
          <?php if(isset($menus[$_SESSION["roleId"]]) && $menus[$_SESSION["roleId"]] == (2 || 3)) : ?>
            <li class="dropdown navbar-form">
              <a class="dropdown-toggle btn-lg btn-block" href="dataexport.php">
                Datenexport
              </a>
            </li>
          <?php endif; ?>
		  -->
        </ul>
      </div>
      <div class="col-md-10 col-sm-9 col-xs-8" id="content">
        <div class="col-md-8 col-md-offset-2 offset-top-50">
          Willkommen <?php echo $_SESSION["user"]["vorname"]; ?>, <?php echo $_SESSION["user"]["nachname"]; ?> (<?php echo $_SESSION["userRole"]; ?>).<br><br>
          Ihr letzter Login war am: 04.12.2014, 18:00 Uhr<br><br>
          <strong>Nächster Forecast-Stichtag: 11.12.2014, 18:00 Uhr</strong><br>
          Es verbleiben noch 6 Tage, 4 Stunden bis zum Stichtag.<br><br>
          <span class="text-danger">Sie haben noch keine Daten für diesen Stichtag eingegeben.</span><br><br>
          Zuletzt bearbeitete Projekte:<br><br>

          <input type="text" list="projects" placeholder="Projektname(Projektid)" id="projectSearch" class="form-control dropdown-toggle typeahead"/>
          <datalist class="dropdown-menu" id="projects">
            <option value="Projekt A">
              <span class="name">(ID001)</span>
            </option>
            <option value="Projekt B">
              <span class="name">(ID002)</span>
            </option>
            <option value="Projekt C">
              <span class="name">(ID003)</span>
            </option>
            <option value="Projekt D">
              <span class="name">(ID004)</span>
            </option>
          </datalist>
        </div>
      </div>
    </div>
    <footer class="navbar-fixed-bottom">
      <span class="text-left navbar-left">&copy; <a href="http://www.siemens.com">Siemens</a></span>
      <span class="text-right navbar-right">Developed by F. Radermacher, T. Bullmann, N. Lehmann</span>
    </footer>
	</body>
</html>
