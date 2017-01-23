<?php

// require or require_once?
require_once WEB_INCLUDE_DIR."/init.php";


// ----- SELECT ----- //
function selectAll_M2M_user_subsegment() {
	
	$sql_select = mysql_query("SELECT benutzer_id, subsegment_id FROM benutzer_subsegment");
	
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
function insert_M2M_user_subsegment($user_id, $subsegment_id) {
	
	$sql_insert = "INSERT INTO benutzer_subsegment (benutzer_id, subsegment_id) VALUES ($user_id, $subsegment_id)";
	$db_conn -> exec($sql_insert);
	// close connection?
}


// ----- DELETE ----- //

function delete_M2M_user_subsegment($user_id, $subsegment_id) {

	$sql_delete = "DELETE FROM benutzer_subsegment WHERE benutzer_id = '$user_id' AND subsegment_id = '$subsegment_id'";	
	$stmt = $db_conn -> prepare($sql_delete);
	$stmt->execute();
	// close connection?
}

?>
