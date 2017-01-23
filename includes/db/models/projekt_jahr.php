<?php

// require or require_once?
require_once WEB_INCLUDE_DIR."/init.php";


// ----- SELECT ----- //
function selectAll_M2M_project_year() {
	
	$sql_select = mysql_query("SELECT projekt_id, jahr_id FROM projekt_jahr");
	
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
function insert_M2M_project_year($project_id, $year_id) {
	
	$sql_insert = "INSERT INTO projekt_jahr (projekt_id, jahr_id) VALUES ($project_id, $year_id)";
	$db_conn -> exec($sql_insert);
	// close connection?
}


// ----- DELETE ----- //

function delete_M2M_project_year($project_id, $year_id) {

	$sql_delete = "DELETE FROM projekt_jahr WHERE projekt_id = '$project_id' AND jahr_id = '$year_id'";	
	$stmt = $db_conn -> prepare($sql_delete);
	$stmt->execute();
	// close connection?
}

?>
