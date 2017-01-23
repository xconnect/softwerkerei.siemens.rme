<?php

// require or require_once?
require_once WEB_INCLUDE_DIR."/init.php";


// ----- SELECT ----- //
function selectAll_M2M_projecttype_code() {
	
	$sql_select = mysql_query("SELECT projektart_id, kennzahl_id FROM projektart_kennzahl");
	
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
function insert_M2M_projecttype_code($projecttype_id, $code_id) {
	
	$sql_insert = "INSERT INTO projektart_kennzahl (projektart_id, kennzahl_id) VALUES ($projecttype_id, $code_id)";
	$db_conn -> exec($sql_insert);
	// close connection?
}


// ----- DELETE ----- //

function delete_M2M_projecttype_code($projecttype_id, $code_id) {

	$sql_delete = "DELETE FROM projektart_kennzahl WHERE projektart_id = '$projecttype_id' AND kennzahl_id = '$code_id'";	
	$stmt = $db_conn -> prepare($sql_delete);
	$stmt->execute();
	// close connection?
}

?>
