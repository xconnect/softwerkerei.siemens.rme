<?php

// require or require_once?
require_once WEB_INCLUDE_DIR."/init.php";


// ----- SELECT ----- //
function selectAllProjects() {
	
	$sql_select = mysql_query("SELECT id, definition, name, land_id, art_id, verantwortlicher_id, frame_id, kaufmann_id, businesstype_id FROM projekt");
	
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
function insertProject($definition, $name, $country_id, $kind_id, $executive_id, $frame_id, $businessman_id, $businesstype_id) {
	
	$sql_insert = "INSERT INTO projekt (definition, name, land_id, art_id, verantwortlicher_id, frame_id, kaufmann_id, businesstype_id) VALUES ($definition, $name, $country_id, $kind_id, $executive_id, $frame_id, $businessman_id, $businesstype_id)";
	$db_conn -> exec($sql_insert);
	// close connection?
}


// ----- DELETE ----- //
function deleteProject($id, $definition, $name, $country_id, $kind_id, $executive_id, $frame_id, $businessman_id, $businesstype_id) {

	$sql_delete = "DELETE FROM projekt WHERE id = '$id' AND definition = '$definition' AND name = '$name' AND land_id = '$country_id' AND art_id = '$kind_id' AND verantwortlicher_id = '$executive_id' AND frame_id = '$frame_id' AND kaufmann_id = '$businessman_id' AND businesstype_id = '$businesstype_id'";
	$stmt = $db_conn -> prepare($sql_delete);
	$stmt->execute();
	// close connection?
}


// ----- UPDATE ----- //
function updateProject($id, $definition, $name, $country_id, $kind_id, $executive_id, $frame_id, $businessman_id, $businesstype_id) {

	 
	$sql_update = "UPDATE projekt SET definition = '$definition', name = '$name', land_id = '$country_id', art_id = '$kind_id', verantwortlicher_id = '$executive_id', frame_id = '$frame_id', kaufmann_id = '$businessman_id', businesstype_id = '$businesstype_id' WHERE id=$id";
	$stmt = $db_conn -> prepare($sql_update);
	$stmt->execute();
	// close connection?
}

?>