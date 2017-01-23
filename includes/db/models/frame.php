<?php

// require or require_once?
require_once WEB_INCLUDE_DIR."/init.php";


// ----- SELECT ----- //
function selectAllFrames() {
	
	$sql_select = mysql_query("SELECT id, name FROM frame");
	
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
function insertFrame($name) {
	
	$sql_insert = "INSERT INTO frame (name) VALUES ($name)";
	$db_conn -> exec($sql_insert);
	// close connection?
}


// ----- DELETE ----- //
function deleteFrame($id, $name) {

	$sql_delete = "DELETE FROM frame WHERE id='$id' AND name='$name'";
	$stmt = $db_conn -> prepare($sql_delete);
	$stmt->execute();
	// close connection?
}


// ----- UPDATE ----- //
function updateFrame($id, $name) {

	$sql_update = "UPDATE frame SET name='$name' WHERE id=$id";	
	$stmt = $db_conn -> prepare($sql_update);
	$stmt->execute();
	// close connection?
}

?>