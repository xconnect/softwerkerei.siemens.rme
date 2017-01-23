<?php

require_once INCLUDE_DIR.'/init.php';

if (isset($_POST['type'])) {
	$type = $_POST['type'];
}
if(isset($type) && $type=='getAll') {
	echo json_encode(getAllUser());
} elseif (isset($type) && $type=='saveNew') {
	return saveNew();
}

function getAllUserWithShit() {
	
	$sql = mysql_query("SELECT b.id as BenutzerID, b.login as Login, b.passwort as Passwort, b.vorname as Vorname, b.nachname as Nachname, b.email as EMail, b.telefon as Festnetz, b.mobil as Mobiltelefon, s.name as Sprache, r.rolle as Rolle, v.vertragshalter as Arbeitgeber FROM benutzer b, rolle r, sprache s, vertragshalter v where b.sprache_id = s.id and rolle_id = r.id and b.vertragshalter_id = v.id");
	
	$columns = array();
	$resultSet = array();
    
	while ($row = mysql_fetch_assoc($sql)) {
		if (empty($columns)) {
			$columns = array_keys($row);
		}
		$resultSet[] = $row;
	}
    return $resultSet;
}

function getAllUser() {
    return getUserFor();
}
  
function getUserFor($fields=[]) {

  $searchParam = '';

  foreach($fields as $field => $value) {
    $searchParam += empty($searchParam) ? " WHERE '$field' = '$value'" : " AND '$field' = '$value'";
  }
$query="SELECT login, passwort, vorname, nachname, email, telefon, sprache_id, rolle_id FROM benutzer".$searchParam;
  $sql = mysql_query($query);
  
  $columns = array();
  $resultSet = array();

  while ($row = mysql_fetch_assoc($sql, MYSQL_ASSOC)) {
    if (empty($columns)) {
      $columns = array_keys($row);
    }
    $resultSet[] = $row;
  }

  return $resultSet;
}

function saveNew() {
	$sql = mysql_query("SELECT id FROM sprache WHERE iso639_1 = '".$_POST["sprache"]."'");
    $langId = mysql_fetch_assoc($sql);
    $sql = mysql_query("SELECT id FROM rolle WHERE name = '".$_POST["rolle"]."'");
    $roleId = mysql_fetch_assoc($sql);
    $sql = mysql_query("INSERT INTO benutzer (benutzername, passwort, vorname, nachname, email, telefon, sprache, rolle) VALUES ('".$_POST["benutzername"]."', '".$_POST["passwort"]."', '".$_POST["vorname"]."', '".$_POST["nachname"]."', '".$_POST["email"]."', '".$_POST["telefon"]."', '".$langId["id"]."', '".$roleId["id"]."')");
    if(!$sql && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']  == 'XMLHttpRequest') {
		header('HTTP/1.1 500 Internal Server Booboo');
    }
}

?>
