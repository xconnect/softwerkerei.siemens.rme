<?php

// require or require_once?
require_once WEB_INCLUDE_DIR."/init.php";


// ----- SELECT ----- //
function selectAllBusinesstypes() {
	
	$sql_select = mysql_query("SELECT id, name FROM businesstype");
	
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
function insertBusinesstype($name) {
	
	$sql_insert = "INSERT INTO businesstype (name) VALUES ($name)";
	$db_conn -> exec($sql_insert);
	// close connection?
}


// ----- DELETE ----- //
function deleteBusinesstype($id, $name) {

	$sql_delete = "DELETE FROM businesstype WHERE id='$id' AND name='$name'";	
	$stmt = $db_conn -> prepare($sql_delete);
	$stmt->execute();
	// close connection?
}


// ----- UPDATE ----- //
function updateBusinesstype($id, $name) {

	$sql_update = "UPDATE businesstype SET name='$name' WHERE id=$id";	
	$stmt = $db_conn -> prepare($sql_update);
	$stmt->execute();
	// close connection?
}

?>