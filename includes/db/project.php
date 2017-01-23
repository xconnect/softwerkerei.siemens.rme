<?php

// require or require_once?
require_once __DIR__."/../init.php";

if (isset($_POST['type'])) {
	$type = $_POST['type'];
  if($type=='getProjects') {
    echo json_encode(getProjectsForUser($_SESSION['user']['id']));
  } else if($type=='createProject') {
    echo json_encode(createNewProject($_POST['definition'],$_POST['name'],$_POST['land_id'],$_POST['art_id'],$_POST['verantwortlicher_id'],$_POST['frame_id'],$_POST['kaufmann_id'],$_POST['businesstype_id']));
  }
}

function getProjectsForUser($userId) {

$sql_select = mysql_query("SELECT DISTINCT projekt.id, projekt.name FROM projekt JOIN datensatz ON(datensatz.projekt_id = projekt.id) WHERE datensatz.benutzer_id = ".$userId." AND projekt.id NOT IN (11, 12, 13, 14);");
	
	$columns = array();
	$resultSet = array();
    
	while ($row = mysql_fetch_assoc($sql_select)) {
		if (empty($columns)) {
			$columns = array_keys($row);
		}
		$resultSet[] = $row;
	}
    return $resultSet;
}

function getSpecialProjects() {

$sql_select = mysql_query("SELECT projekt.id, projekt.name FROM projekt WHERE projekt.id IN (11, 12, 13, 14);");
	
	$columns = array();
	$resultSet = array();
    
	while ($row = mysql_fetch_assoc($sql_select)) {
		if (empty($columns)) {
			$columns = array_keys($row);
		}
		$resultSet[] = $row;
	}
    return $resultSet;
}

function selectAllCodesFromProject($project_id) {

$sql_select = mysql_query("SELECT kz.akronym as kennzahl FROM projekt p, projektart_kennzahl pkz, kennzahl kz WHERE p.id = $project_id AND p.art_id = pkz.projektart_id AND kz.id = pkz.kennzahl_id");
	
	$columns = array();
	$resultSet = array();
    
	while ($row = mysql_fetch_assoc($sql_select)) {
		if (empty($columns)) {
			$columns = array_keys($row);
		}
		$resultSet[] = $row;
	}
    return $resultSet;
}

function createNewProject($definition, $name, $land_id, $art_id, $verantwortlicher_id, $frame_id, $kaufmann_id, $businesstype_id) {
	
	$sql_insert = "INSERT INTO `cts`.`projekt` (`definition`, `name`, `land_id`, `art_id`, `verantwortlicher_id`, `frame_id`, `kaufmann_id`, `businesstype_id`) VALUES ($definition, $name, $land_id, $art_id, $verantwortlicher_id , $frame_id , $kaufmann_id , $businesstype_id)";
	$db_conn -> exec($sql_insert);
}

?>
