<?php

// require or require_once?
require_once WEB_INCLUDE_DIR."/init.php";


// ----- SELECT ----- //
function selectAllServicelines() {
	
	$sql_select = mysql_query("SELECT id, name, subsegment_id FROM serviceline");
	
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
function insertServiceline($name, $subsegment_id) {
	
	$sql_insert = "INSERT INTO serviceline (name, subsegment_id) VALUES ($name, $subsegment_id)";
	$db_conn -> exec($sql_insert);
	// close connection?
}


// ----- DELETE ----- //
function deleteServiceline($id, $name, $subsegment_id) {

	$sql_delete = "DELETE FROM serviceline WHERE id = '$id' AND name='$name' AND subsegment_id = '$subsegment_id'";	
	$stmt = $db_conn -> prepare($sql_delete);
	$stmt->execute();
	// close connection?
}


// ----- UPDATE ----- //
function updateServiceline($id, $name, $subsegment_id) {

	$sql_update = "UPDATE serviceline SET name='$name', subsegment_id = '$subsegment_id' WHERE id=$id";	
	$stmt = $db_conn -> prepare($sql_update);
	$stmt->execute();
	// close connection?
}

?>
