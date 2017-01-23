<?php

//$type = $_POST['type'];
//if($type=='getAll') {
//return getAllRoles();
//}

function getAllRoles() {
	
	$sql = mysql_query("SELECT id, name FROM rolle");
	
	$columns = array();
	$resultSet = array();
    
	while ($row = mysql_fetch_assoc($sql)) {
		if (empty($columns)) {
			$columns = array_keys($row);
		}
		$resultSet[] = $row;
	}
    return $resultSet;
}

?>
