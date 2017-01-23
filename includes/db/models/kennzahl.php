<?php

// require or require_once?
require_once WEB_INCLUDE_DIR."/init.php";


// ----- SELECT ----- //
function selectAllCodes() {
	
	$sql_select = mysql_query("SELECT id, name, akronym FROM kennzahl");
	
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
function insertCode($name, $akronym) {
	
	$sql_insert = "INSERT INTO kennzahl (name, akronym) VALUES ($name, $akronym)";
	$db_conn -> exec($sql_insert);
	// close connection?
}


// ----- DELETE ----- //
function deleteCode($id, $name, $akronym) {

	$sql_delete = "DELETE FROM kennzahl WHERE id='$id' AND name='$name' AND akronym='$akronym'";
	$stmt = $db_conn -> prepare($sql_delete);
	$stmt->execute();
	// close connection?
}


// ----- UPDATE ----- //
function updateCode($id, $name, $akronym) {

	$sql_update = "UPDATE kennzahl SET name='$name', akronym='$akronym' WHERE id=$id";
	$stmt = $db_conn -> prepare($sql_update);
	$stmt->execute();
	// close connection?
}

?>