<?php

  //setting language to sent parameter or default
  if(isset($_GET["language"])) {
    $_SESSION["selectedLanguage"] = $_GET["language"];
    $file = explode("?", $_SERVER["HTTP_REFERER"]);
    header("Location: $file[0]");
  } else {
    if(!isset($_SESSION["selectedLanguage"])) {
      $_SESSION["selectedLanguage"] = "de";
    }
  }

  //selecting all available languages from the database
  $sql = mysql_query("SELECT iso639_1, name FROM sprache");
  $languages = array();
  while (($row = mysql_fetch_assoc($sql, MYSQL_ASSOC)) != false) {
    $languages[] = $row;
  }
  $_SESSION["languages"] = $languages;
  $remLangs = array();
  foreach($languages as $language) {
    if($language["iso639_1"] !== $_SESSION["selectedLanguage"]) {
      $remLangs[] = $language["iso639_1"];
    }
  }
  $_SESSION["remainingLanguages"] = $remLangs;
