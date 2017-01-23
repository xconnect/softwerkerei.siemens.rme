<?php
// initalise necessary data and functions
require "includes/init.php";
// the website starts here
?>
<!doctype html>
<html>
	<head>
 		<title>CTS Administration - Projektverwaltung</title>
		<meta name="description" content="Index" />
		<meta name="keywords" content="HTML,CSS,JavaScript" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8" />
		
		<link rel="stylesheet" href="css/cts.css">
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/typeahead.bundle.min.js"></script>
		<script src="js/cts.js"></script>
		<script src="js/admin.js"></script>
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
        <div href="admin.php" class="return-btn btn-primary col-md-6 col-md-offset-1">
          <span class="glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;<span class="return-text">zurück</span>
        </div>
        <div class="col-md-12"><span class="return-text">Projektverwaltung</span></div>
		<!-- Liste mit zu editierenden Benutzern hier -->
      </div>
      <div class="col-md-10 col-sm-9 col-xs-8" id="content">
        <div class="well col-md-8 col-md-offset-2 col-sm-9 col-xs-8 offset-top-50">
          <ul class="nav nav-tabs" role="tablist">
            <li class="active">
              <a href="#user" role="tab" data-toggle="tab">user</a>
            </li>
            <li>
              <a href="#structure" role="tab" data-toggle="tab">struktur</a>
            </li>
            <li>
              <a href="#project" role="tab" data-toggle="tab">projekt</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade in active tab-wrap offset-top-10 table-responsive" id="user">
              <?php require DB_DIR."/user.php";
                $count =0;
              ?>
                <nav class="form-group">
                  <input type="text" list="users" placeholder="Suche" id="userSearch" class="form-control typeahead"/>
                  <ul class="hidden" id="users">
                    <?php foreach(getAllUser() as $user) : ?>
                    <li><span class="name"><?php echo $user['vorname'].' '.$user['nachname']; ?></span><span class="pull-right username"><?php echo $user['login'];?></span></li>
                    <?php endforeach; ?>
                  </ul>
                </nav>
              <div class="container-fluid">
              <form class="form-horizontal col-md-8 col-md-offset-2" action="<?php echo WEB_DB_DIR."/user.php"; ?>" method="post" role="form">
                  <div class="form-group">
                    <input class="form-control" type="text" placeholder="login" id="user_login"/>
                  </div>
                  <div class="form-group">
                    <input class="form-control" type="text" placeholder="passwort" id="user_passwort"/>
                  </div>
                  <div class="form-group">
                    <input class="form-control" type="text" placeholder="vorname" id="user_vorname"/>
                  </div>
                  <div class="form-group">
                    <input class="form-control" type="text" placeholder="nachname" id="user_nachname"/>
                  </div>
                  <div class="form-group">
                    <input class="form-control" type="text" placeholder="email" id="user_email"/>
                  </div>
                  <div class="form-group">
                    <input class="form-control" type="text" placeholder="telefon" id="user_telefon"/>
                  </div>
                  <div class="form-group">
                    <input class="form-control" list="langs" type="text" placeholder="sprache" id="user_sprache"/>
                    <datalist id="langs">
                      <?php foreach($languages as $language) : ?>
                      <option value="<?php echo $language; ?>"></option>
                      <?php endforeach; ?>
                    </datalist>
                  </div>
                  <div class="form-group">
                    <input class="form-control" type="text" list="roles" placeholder="rolle" id="user_rolle"/>
                    <datalist id="roles">
                      <?php require MODEL_DIR."/rolle.php";
                        foreach(getAllRoles() as $role) : ?>
                      <option value="<?php echo $role["name"]; ?>"></option>
                      <?php endforeach; ?>
                    </datalist>
                  </div>
                  <footer>
                    <button class="btn btn-danger" type="button" id="userDel">Löschen</button><button class="btn btn-success navbar-right" type="button" id="userSav">Speichern</button>
                  </footer>
                </form>
              </div>
            </div>
            <div class="tab-pane fade" id="structure">
              structure content
            </div>
            <div class="tab-pane fade" id="project">
              project content
              <div class="table-responsive">
                <table class="table" id="projecttable">
                  <?php foreach(getAllUser() as $user) : ?>
                    <?php if($count++ === 0) : ?>
                    <tr>
                      <?php foreach($user as $field => $val) :?>
                        <th>
                          <span><?php echo $field; ?></span>
                        </th>
                      <?php endforeach; ?>
                      <th></th>
                    </tr>
                    <?php endif; ?>
                    <tr>
                      <?php foreach($user as $field => $val) :?>
                        <td>
                          <div class="input-group">
                            <input type="text" class="form-control" id="<?php echo $field.'_'.$count; ?>" value="<?php echo htmlentities($val); ?>"/>
                          </div>
                        </td>
                      <?php endforeach; ?>
                      <td>
                        <button type="button" class="btn btn-danger" value="Löschen" id="<?php echo 'delete_'.$count; ?>" />
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </table>
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
