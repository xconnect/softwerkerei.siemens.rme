<?php

// require or require_once?
require_once WEB_INCLUDE_DIR."/init.php";


// ----- SELECT ----- //
function selectAllCountries() {
	
	$sql_select = mysql_query("SELECT id, name, code FROM land");
	
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
function insertCountry($name, $code) {
	
	$sql_insert = "INSERT INTO land (name, code) VALUES ($name, $code)";
	$db_conn -> exec($sql_insert);
	// close connection?
}


// ----- DELETE ----- //
function deleteCountry($id, $name, $code) {

	$sql_delete = "DELETE FROM land WHERE id = '$id' AND name='$name' AND code = '$code'";	
	$stmt = $db_conn -> prepare($sql_delete);
	$stmt->execute();
	// close connection?
}


// ----- UPDATE ----- //
function updateCountry($id, $name, $code) {

	$sql_update = "UPDATE land SET name='$name', code = '$code' WHERE id=$id";	
	$stmt = $db_conn -> prepare($sql_update);
	$stmt->execute();
	// close connection?
}

?>
