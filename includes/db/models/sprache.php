<?php

// require or require_once?
require_once WEB_INCLUDE_DIR."/init.php";


// ----- SELECT ----- //
function selectAllLanguages() {
	
	$sql_select = mysql_query("SELECT id, name, iso639_1 FROM sprache");
	
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
function insertLanguage($name, $iso) {
	
	$sql_insert = "INSERT INTO sprache (name, iso639_1) VALUES ($name, $iso)";
	$db_conn -> exec($sql_insert);
	// close connection?
}


// ----- DELETE ----- //
function deleteLanguage($id, $name, $iso) {

	$sql_delete = "DELETE FROM sprache WHERE id = '$id' AND name='$name' AND iso639_1 = '$iso'";	
	$stmt = $db_conn -> prepare($sql_delete);
	$stmt->execute();
	// close connection?
}


// ----- UPDATE ----- //
function updateLanguage($id, $name, $iso) {

	$sql_update = "UPDATE sprache SET name='$name', iso639_1 = '$iso' WHERE id=$id";	
	$stmt = $db_conn -> prepare($sql_update);
	$stmt->execute();
	// close connection?
}

?>