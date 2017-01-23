<?php

session_start();

require "../init.php";

$user = $_POST["username"];
$pswd = $_POST["password"];

// database query: get the password for the entered user
$sql_login_query = mysql_query("SELECT passwort, rolle_id FROM benutzer WHERE login = '$user'");
$sql_login_query_numrows = mysql_num_rows($sql_login_query);

// check if user is to be logged in
if (isset($_POST["login"])) {
  if (isset($user) && isset($pswd) && $sql_login_query_numrows != 0) {
    while ($row = mysql_fetch_assoc($sql_login_query)) {
			$p = $row['passwort'];
			$r = $row['rolle_id'];
    }
		// if user is admin do
		if ($pswd == $p && $r == 1) {
      auth_save_user_information_in_session($r, $menus, $user);
			header("Location: ../../admin.php");
		// if user is controller do
		} elseif ($pswd == $p && $r == 2) {
			auth_save_user_information_in_session($r, $menus, $user);
			header("Location: ../../controlling.php");
		// if user is collaborator do
		} elseif ($pswd == $p && $r == 3) {
			auth_save_user_information_in_session($r, $menus, $user);
			header("Location: ../../service.php");
		// otherwise redirect to "index.php"
		} else {
			$_SESSION["isUserLoggedIn"] = 0;
			header("Location: ../../index.php");
		}
	// otherwise redirect to "index.php"	
  } else {
    $_SESSION["isUserLoggedIn"] = 0;
		header("Location: ../../index.php");
	}
}

// if user logs out redirect to "index.php"
if (isset($_GET["logout"])) {
	session_destroy();
	header("Location: ../../index.php");
}

function auth_save_user_information_in_session ($r, $menus, $user) {
  $_SESSION["isUserLoggedIn"] = 1;
  $sql_role_name = mysql_query("SELECT name FROM rolle WHERE id = $r");
  $row = mysql_fetch_assoc($sql_role_name);
  $_SESSION["userRole"] = $row['name'];
  $_SESSION["roleId"] = $r;
  $_SESSION["sites"] = $menus[$r];
  $sql_user = mysql_query("SELECT * FROM benutzer WHERE login = '$user'");
  $row = mysql_fetch_assoc($sql_user);
  $_SESSION["user"] = $row;
}
