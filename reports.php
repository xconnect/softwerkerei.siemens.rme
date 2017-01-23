<?php
// initalise necessary data and functions
require "includes/init.php";
// the website starts here
?>
<!doctype html>

<html>
  <head>
 		<title>report site</title>
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
		<script src="js/highcharts-custom.js"></script>
		<script src="js/reports.js"></script>
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
        <div href="service.php" class="return-btn btn-primary col-md-6 col-md-offset-1">
          <span class="glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;<span class="return-text">zurück</span>
        </div>
        <div class="col-md-12"><span class="return-text">Reports</span></div>
      </div>
      <div class="col-md-10 col-sm-9 col-xs-8" id="content">
          <?php require DB_DIR.'/userview.php'; ?>
          <ul class="nav nav-tabs" role="tablist">
            <?php $tabs = getTabsForProject($_SESSION["projectId"]);
              $tab = $tabs; ?>
              <li class="active">
                <a role="tab" tabindex="-1" href="#<?php echo $tab['akronym']; ?>" data-toggle="tab">
                  GM
                </a>
              </li>
            <li class="pull-right" id="projectName"><?php if(isset($_SESSION['projectName'])) echo $_SESSION['projectName']; ?></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade in active offset-top-10" id="<?php echo $tab['akronym']; ?>">
              <div class="input-wrap">
                <div class="text-danger inline-block">
                  Dateneingabe für Stichtag <span class="date">11.12.2014</span>
                </div>
                <div class="inline-block pull-right">
                  Geschäftsjahr:
                  <input type="text" list="fiscalYear" placeholder="Jahr" id="fiscYear" class="dropdown-toggle typeahead"/>
                  <datalist class="dropdown-menu" id="fiscalYear">
                    <option value="2014">
                    </option>
                    <option value="2015">
                    </option>
                    <option value="2016">
                    </option>
                    <option value="2017">
                    </option>
                  </datalist>
                </div>
              </div>
              <div class="" id="GM_Table">
              </div>
        <div class="row">
          <div id="chart_1" class="col-md-6 charts" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
          <div id="chart_2" class="col-md-6 charts" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
        <div class="row">
          <div id="chart_3" class="col-md-6 charts" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
          <div id="chart_4" class="col-md-6 charts" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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
