<?php

// require or require_once?
require_once WEB_INCLUDE_DIR."/init.php";


// ----- SELECT ----- //
function selectAll_M2M_serviceline_project() {
	
	$sql_select = mysql_query("SELECT serviceline_id, projekt_id FROM serviceline_projekt");
	
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
function insert_M2M_serviceline_project($serviceline_id, $project_id) {
	
	$sql_insert = "INSERT INTO serviceline_projekt (serviceline_id, projekt_id) VALUES ($serviceline_id, $project_id)";
	$db_conn -> exec($sql_insert);
	// close connection?
}


// ----- DELETE ----- //

function delete_M2M_serviceline_project($serviceline_id, $project_id) {

	$sql_delete = "DELETE FROM serviceline_projekt WHERE serviceline_id = '$serviceline_id' AND projekt_id = '$project_id'";	
	$stmt = $db_conn -> prepare($sql_delete);
	$stmt->execute();
	// close connection?
}

?>
