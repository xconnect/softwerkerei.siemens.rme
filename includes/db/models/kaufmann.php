<?php

// require or require_once?
require_once WEB_INCLUDE_DIR."/init.php";


// ----- SELECT ----- //
function selectAllBusinessmen() {
	
	$sql_select = mysql_query("SELECT id, name FROM kaufmann");
	
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
function insertBusinessman($name) {
	
	$sql_insert = "INSERT INTO kaufmann (name) VALUES ($name)";
	$db_conn -> exec($sql_insert);
	// close connection?
}


// ----- DELETE ----- //
function deleteBusinessman($id, $name) {

	$sql_delete = "DELETE FROM kaufmann WHERE id='$id' AND name='$name'";	
	$stmt = $db_conn -> prepare($sql_delete);
	$stmt->execute();
	// close connection?
}


// ----- UPDATE ----- //
function updateBusinessman($id, $name) {

	$sql_update = "UPDATE kaufmann SET name='$name' WHERE id=$id";	
	$stmt = $db_conn -> prepare($sql_update);
	$stmt->execute();
	// close connection?
}

?>