<?php

// require or require_once?
require_once WEB_INCLUDE_DIR."/init.php";


// ----- SELECT ----- //
function selectAllReportingDates() {
	
	$sql_select = mysql_query("SELECT id, datum, vertragshalter_id, subsegment_id, benutzer_id, zeitstempel FROM stichtag");
	
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
function insertReportingDate($date, $contractholder_id, $subsegment_id, $user_id) {
	
	$sql_insert = "INSERT INTO stichtag (datum, vertragshalter_id, subsegment_id, benutzer_id) VALUES ($date, $contractholder_id, $subsegment_id, $user_id)";
	$db_conn -> exec($sql_insert);
	// close connection?
}


// ----- DELETE ----- //
function deleteReportingDate($id, $date, $contractholder_id, $subsegment_id, $user_id) {

	$sql_delete = "DELETE FROM stichtag WHERE id = '$id' AND datum = '$date' AND vertragshalter_id = '$contractholder_id' AND subsegment_id = '$subsegment_id' AND benutzer_id = '$user_id'";	
	$stmt = $db_conn -> prepare($sql_delete);
	$stmt->execute();
	// close connection?
}


// ----- UPDATE ----- //
function updateReportingDate($id, $date, $contractholder_id, $subsegment_id, $user_id) {

	$sql_update = "UPDATE stichtag SET datum='$date', vertragshalter_id = '$contractholder_id', subsegment_id = '$subsegment_id', benutzer_id = '$user_id' WHERE id=$id";	
	$stmt = $db_conn -> prepare($sql_update);
	$stmt->execute();
	// close connection?
}

?>
