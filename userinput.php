<?php
// initalise necessary data and functions
require "includes/init.php";
// the website starts here
  //setting projectId to sent parameter or default
  if(isset($_GET["projectId"])) {
    $_SESSION["projectId"] = $_GET["projectId"];
    $file = explode("?", $_SERVER["HTTP_REFERER"]);
    header("Location: $file[0]");
  } else if(!isset($_SESSION["projectId"])) {
    $_SESSION["projectId"] = 0;
  }
?>
<!doctype html>

<html>
  <head>
 		<title>user input site</title>
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
		<script src="js/cts.js"></script>
		<script src="js/userinput.js"></script>
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
        <div class="col-md-12"><span class="return-text">Dateneingabe</span></div>
        <!-- Button trigger modal -->
          <button type="button" class="btn btn-sm btn-success newProjectButton offset-top-15 col-md-12" data-toggle="modal" data-target="#newProject">
            Neues Projekt <span class="glyphicon glyphicon-plus"></span>
          </button>
        <!-- Modal -->
        <div class="modal fade" id="newProject" tabindex="-1" role="dialog" aria-labelledby="newProjectLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Neues Projekt anlegen</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Name" id="user_login"/>
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Definition" id="user_login"/>
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Land" id="user_login"/>
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Art" id="user_login"/>
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Verantwortlicher" id="user_login"/>
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Frame" id="user_login"/>
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Kaufmann" id="user_login"/>
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Businesstype" id="user_login"/>
                </div>
              </div>
              <div class="modal-footer offset-right-10">
                <button class="btn btn-danger" type="button" id="projectDel" data-dismiss="modal">Löschen</button>
                <button class="btn btn-success navbar-right" type="button" id="projectSav">Speichern</button>
              </div>
            </div>
          </div>
        </div>
        <div class="offset-top-15 projectSelect">
          <select size="10" class="projectSelect">
            <?php require DB_DIR.'/project.php'; ?>
              <?php $projects = getProjectsForUser($_SESSION['user']['id']);
                foreach($projects as $project) : ?>
                <?php if(isset($_SESSION['projectId']) && $project['id'] == $_SESSION['projectId']) : ?>
                  <option value="<?php echo $project['id']; ?>" <?php echo 'selected'; ?>><?php echo $project['name']; $_SESSION['projectName'] = $project['name']; ?></option>
                <?php else: ?>
                  <option value="<?php echo $project['id']; ?>"><?php echo $project['name']; ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
              <?php $projects = getSpecialProjects();
                foreach($projects as $project) : ?>
                <?php if(isset($_SESSION['projectId']) && $project['id'] == $_SESSION['projectId']) : ?>
                  <option <?php if($project == reset($projects)) { echo 'style="border-top:1px solid #1E90FF;"';} ?> value="<?php echo $project['id']; ?>" <?php echo 'selected'; ?>><?php echo $project['name']; $_SESSION['projectName'] = $project['name']; ?></option>
                <?php else: ?>
                  <option <?php if($project == reset($projects)) { echo 'style="border-top:1px solid #1E90FF;"';} ?> value="<?php echo $project['id']; ?>"><?php echo $project['name']; ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-md-10 col-sm-9 col-xs-8" id="content">
        <div class="offset-top-15">
          <?php require DB_DIR.'/userview.php'; ?>
          <ul class="nav nav-tabs" role="tablist">
            <?php $tabs = getTabsForProject($_SESSION["projectId"]);
              foreach($tabs as $tab) : ?>
              <li <?php if($tab === reset($tabs)) echo 'class="active"'; ?>>
                <a role="tab" tabindex="-1" href="#<?php echo $tab['akronym']; ?>" data-toggle="tab">
                  <?php echo $tab['akronym']; ?>
                </a>
              </li>
            <?php endforeach; ?>
            <li class="pull-right" id="projectName"><?php if(isset($_SESSION['projectName'])) echo $_SESSION['projectName']; ?></li>
          </ul>
          <?php if(count($tabs) != 0) : ?>
          <div class="tab-content">
            <?php foreach($tabs as $tab) : ?>
            <div class="tab-pane fade in <?php if($tab === reset($tabs)) echo 'active'; ?> offset-top-10" id="<?php echo $tab['akronym']; ?>">
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
              <div class="" id="<?php echo $tab['akronym']; ?>_Table">
              </div>
              <div class="additional-table">
                <div class="col-md-5 offset-top-15">
                  <fieldset class="bar-wrap">
                    <legend>Zusammensetzung</legend>
                    <div class="">
                      <span class="bar-label">Hohes Risiko</span><input type="text" id="<?php echo $tab['akronym']; ?>_hr" class="bar high-risk"/>
                    </div>
                    <div class="">
                      <span class="bar-label">Mittleres Risiko</span><input type="text" id="<?php echo $tab['akronym']; ?>_mr" class="bar mid-risk"/>
                    </div>
                    <div class="">
                      <span class="bar-label">gebucht / erhalten</span><input type="text" id="<?php echo $tab['akronym']; ?>_booked" class="bar booked"/>
                    </div>
                  </fieldset>
                  <fieldset class="bar-wrap offset-top-15">
                    <legend>Potential</legend>
                    <span class="hidden" id="<?php echo $tab['akronym']; ?>_cell" data-row="" data-cell=""></span>
                    <span class="bar-label">Potential</span><input type="text" id="<?php echo $tab['akronym']; ?>_potential" class="bar potential"/>
                  </fieldset>
                </div>
                <fieldset class="col-md-7 offset-top-15 comment-wrap">
                  <legend>Kommentar</legend>
                  <textarea id="<?php echo $tab['akronym']; ?>_comment"></textarea>
                </fieldset>
                <?php if(isset($menus[$_SESSION["roleId"]]) && $menus[$_SESSION["roleId"]] == (2 || 3)) : ?>
                <div class="col-md-5 offset-top-15">
                  <fieldset class="bar-wrap">
                    <legend>Adjustment</legend>
                    <span class="bar-label">Mgmt. Adjustment</span><input type="text" id="<?php echo $tab['akronym']; ?>_adjustment" class="bar adjustment"/>
                  </fieldset>
                </div>
                <div class="button-wrap offset-top-15">
                  <button type="button" id="<?php echo $tab['akronym']; ?>_submit" class="col-md-offset-10 saveButton btn btn-success offset-top-40">Speichern</button>
                </div>
                <?php else: ?>
                <div class="button-wrap col-md-offset-5 offset-top-15">
                  <button type="button" id="<?php echo $tab['akronym']; ?>_submit" class="col-md-offset-10 saveButton btn btn-success offset-top-40">Speichern</button>
                </div>
                <?php endif; ?>
              </div>
            </div>
            <?php endforeach; ?>
          </div><?php else: ?>
            No data for this project entered yet.
          <?php endif; ?>
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
