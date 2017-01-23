<?php

// require or require_once?
require_once WEB_INCLUDE_DIR."/init.php";


// ----- SELECT ----- //
function selectAllRecords() {
	
	$sql_select = mysql_query("SELECT id, projekt_id, subkennzahl_id, vertragshalter_id, vertragsbestandteil_id, stichtag_id, status_id, monat_id, jahr_id, wert_kein_risiko, wert_mittleres_risiko, wert_hohes_risiko, wert_gebucht, wert_potenzial, kommentar, benutzer_id, zeitstempel, quelle_id, serviceline_id FROM datensatz");
	
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
function insertRecord($project_id, $subcode_id, $contractholder_id, $contractcomponent_id, $reportdate_id, $status_id, $month_id, $year_id, $value_no_risk, $value_medium_risk, $value_high_risk, $value_booked, $value_potential, $comment, $user_id, $source_id, $serviceline_id) {
	
	$sql_insert = "INSERT INTO datensatz (projekt_id, subkennzahl_id, vertragshalter_id, vertragsbestandteil_id, stichtag_id, status_id, monat_id, jahr_id, wert_kein_risiko, wert_mittleres_risiko, wert_hohes_risiko, wert_gebucht, wert_potenzial, kommentar, benutzer_id, quelle_id, serviceline_id) VALUES ($project_id, $subcode_id, $contractholder_id, $contractcomponent_id, $reportdate_id, $status_id, $month_id, $year_id, $value_no_risk, $value_medium_risk, $value_high_risk, $value_booked, $value_potential, $comment, $user_id, $source_id, $serviceline_id)";
	$db_conn -> exec($sql_insert);
	// close connection?
}


// ----- DELETE ----- //
function deleteRecord($id, $project_id, $subcode_id, $contractholder_id, $contractcomponent_id, $reportdate_id, $status_id, $month_id, $year_id, $user_id, $source_id, $serviceline_id) {

	$sql_delete = "DELETE FROM datensatz WHERE id = '$id' AND projekt_id = '$project_id' AND subkennzahl_id = '$subcode_id' AND vertragshalter_id = '$contractholder_id' AND vertragsbestandteil_id = '$contractcomponent_id' AND stichtag_id = '$reportdate_id' AND status_id = '$status_id' AND monat_id = '$month_id' AND jahr_id = '$year_id' benutzer_id = '$user_id' AND quelle_id='$source_id' AND serviceline_id='$serviceline_id'";
	$stmt = $db_conn -> prepare($sql_delete);
	$stmt->execute();
	// close connection?
}


// ----- UPDATE ----- //
function updateRecord($id, $project_id, $subcode_id, $contractholder_id, $contractcomponent_id, $reportdate_id, $status_id, $month_id, $year_id, $value_no_risk, $value_medium_risk, $value_high_risk, $value_booked, $value_potential, $comment, $user_id, $source_id, $serviceline_id) {

	$sql_update = "UPDATE datensatz SET projekt_id='$project_id', subkennzahl_id = '$subcode_id', vertragshalter_id = '$contractholder_id', vertragsbestandteil_id = '$contractcomponent_id', stichtag_id = '$reportdate_id', status_id = '$status_id', monat_id = '$month_id', jahr_id = '$year_id', wert_kein_risiko = '$value_no_risk', wert_mittleres_risiko = '$value_medium_risk', wert_hohes_risiko = '$value_high_risk', wert_gebucht = '$value_booked', wert_potenzial = '$value_potential', kommentar = '$comment', benutzer_id = '$user_id', quelle_id='$source_id', serviceline_id='$serviceline_id' WHERE id=$id";
	$stmt = $db_conn -> prepare($sql_update);
	$stmt->execute();
	// close connection?
}

?>