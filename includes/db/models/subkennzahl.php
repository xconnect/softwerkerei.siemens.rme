<?php

// require or require_once?
require_once WEB_INCLUDE_DIR."/init.php";


// ----- SELECT ----- //
function selectAllSubcodes() {
	
	$sql_select = mysql_query("SELECT id, name, akronym, kennzahl_id FROM kennzahl");
	
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


// ----- INSERT ----- //
function insertSubcode($name, $akronym, $code_id) {
	
	$sql_insert = "INSERT INTO subkennzahl (name, akronym, kennzahl_id) VALUES ($name, $akronym, $code_id)";
	$db_conn -> exec($sql_insert);
	// close connection?
}


// ----- DELETE ----- //
function deleteSubcode($id, $name, $akronym, $code_id) {

	$sql_delete = "DELETE FROM subkennzahl WHERE id='$id' AND name='$name' AND akronym='$akronym' AND kennzahl_id='$code_id'";
	$stmt = $db_conn -> prepare($sql_delete);
	$stmt->execute();
	// close connection?
}


// ----- UPDATE ----- //
function updateSubcode($id, $name, $akronym, $code_id) {

	$sql_update = "UPDATE subkennzahl SET name='$name', akronym='$akronym', kennzahl_id='$code_id' WHERE id=$id";	
	$stmt = $db_conn -> prepare($sql_update);
	$stmt->execute();
	// close connection?
}

?>