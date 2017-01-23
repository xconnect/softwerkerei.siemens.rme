<?php

// require or require_once?
require_once WEB_INCLUDE_DIR."/init.php";


// ----- SELECT ----- //
function selectAllYears() {
	
	$sql_select = mysql_query("SELECT id, name FROM jahr");
	
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
function insertYear($name) {
	
	$sql_insert = "INSERT INTO jahr (name) VALUES ($name)";
	$db_conn -> exec($sql_insert);
	// close connection?
}


// ----- DELETE ----- //
function deleteYear($id, $name) {

	$sql_delete = "DELETE FROM jahr WHERE id='$id' AND name='$name'";	
	$stmt = $db_conn -> prepare($sql_delete);
	$stmt->execute();
	// close connection?
}


// ----- UPDATE ----- //
function updateYear($id, $name) {

	$sql_update = "UPDATE jahr SET name='$name' WHERE id=$id";	
	$stmt = $db_conn -> prepare($sql_update);
	$stmt->execute();
	// close connection?
}

?>