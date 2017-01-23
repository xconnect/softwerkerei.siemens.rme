<?php
// check if the user is logged in?
if(!isset($_POST['login']) && (!isset($_SESSION["isUserLoggedIn"]) || ($_SESSION["isUserLoggedIn"] != 1))) {
	// if not, redirect to "index.php"
	require_once "logout.php";
	header("Location: ../../index.php");
	exit();
}
