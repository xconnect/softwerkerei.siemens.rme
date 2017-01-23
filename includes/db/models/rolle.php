<?php

require_once INCLUDE_DIR."/init.php";

// ----- SELECT ----- //
function getAllRoles() {
	
	$sql_select = mysql_query("SELECT id, name FROM rolle");
	
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
function insertRole($name) {
	
	$sql_insert = "INSERT INTO rolle (name) VALUES ($name)";
	$db_conn -> exec($sql_insert);
	// close connection?
}

// ----- DELETE ----- //
function deleteRole($id, $name) {

	$sql_delete = "DELETE FROM rolle WHERE id = '$id' AND name='$name'";	
	$stmt = $db_conn -> prepare($sql_delete);
	$stmt->execute();
	// close connection?
}

// ----- UPDATE ----- //
function updateRole($id, $name) {

	$sql_update = "UPDATE rolle SET name='$name' WHERE id=$id";	
	$stmt = $db_conn -> prepare($sql_update);
	$stmt->execute();
	// close connection?
}

?>
