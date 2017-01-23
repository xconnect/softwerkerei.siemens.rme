<?php

require_once __DIR__.'/../init.php';

if (isset($_POST['type'])) {
	$type = $_POST['type'];
  if($type=='getDataForNumber') {
    echo json_encode(getDataForNumber($_POST['number'], $_POST['projectId']));
  } else if($type=='getTabsForProject') {
    echo json_encode(getTabsForProject($_POST['projectId']));
  } else if($type=='getAllMonths') {
    echo json_encode(getAllMonths());
  } else if($type=='saveDataForTab') {
    echo json_encode(saveDataForTab($_POST['values']));
  }
}

function getDataForNumber($number, $projectId) {

  $sqlString = "SELECT 
      datensatz.id AS 'datensatz.id', 
      datensatz.vertragsbestandteil_id AS 'datensatz.vertragsbestandteil_id', 
      datensatz.projekt_id AS 'datensatz.projekt_id', 
      datensatz.subkennzahl_id AS 'datensatz.subkennzahl_id', 
      datensatz.vertragshalter_id AS 'datensatz.vertragshalter_id', 
      datensatz.stichtag_id AS 'datensatz.stichtag_id', 
      datensatz.status_id AS 'datensatz.status_id', 
      datensatz.monat_id AS 'datensatz.monat_id', 
      datensatz.jahr_id AS 'datensatz.jahr_id', 
      datensatz.wert_kein_risiko AS 'datensatz.wert_kein_risiko', 
      datensatz.wert_mittleres_risiko AS 'datensatz.wert_mittleres_risiko', 
      datensatz.wert_hohes_risiko AS 'datensatz.wert_hohes_risiko', 
      datensatz.wert_gebucht AS 'datensatz.wert_gebucht', 
      datensatz.wert_potenzial AS 'datensatz.wert_potenzial', 
      datensatz.wert_adjustment AS 'datensatz.wert_adjustment', 
      datensatz.kommentar AS 'datensatz.kommentar', 
      datensatz.benutzer_id AS 'datensatz.benutzer_id', 
      datensatz.zeitstempel AS 'datensatz.zeitstempel', 
      datensatz.quelle_id AS 'datensatz.quelle_id', 
      datensatz.serviceline_id AS 'datensatz.serviceline_id',
      subkennzahl.akronym AS 'datensatz.subkennzahl_akronym' 
    FROM datensatz JOIN subkennzahl ON(subkennzahl.id = subkennzahl_id) JOIN kennzahl ON (kennzahl.id = subkennzahl.kennzahl_id) 
    WHERE projekt_id = ".$projectId." AND kennzahl.akronym = '".$number."' ORDER BY subkennzahl.akronym ASC;";
	$sql = mysql_query($sqlString);

	$columns = array();
	$resultSet = array();
    
	while ($row = mysql_fetch_assoc($sql)) {
		if (empty($columns)) {
			$columns = array_keys($row);
		}
		$resultSet[] = $row;
  }
  $result = [];
  $data = [];
  foreach($resultSet as $set) {
    $row = [];
    foreach($set as $key => $value) {
      $keys = explode(".",$key);
      $row[$keys[0]][$keys[1]] = $value;
    }
    $data[] = $row;
  }
  //$result['months'] = getAllMonths();
  $result['data'] = $data;
  return $result;
}

function saveDataForTab($values) {
  $sqlInsertString = "INSERT INTO datensatz (
    id, 
    vertragsbestandteil_id, 
    projekt_id, 
    subkennzahl_id, 
    vertragshalter_id, 
    stichtag_id, 
    status_id, 
    monat_id, 
    jahr_id, 
    wert_kein_risiko, 
    wert_mittleres_risiko, 
    wert_hohes_risiko, 
    wert_gebucht, 
    wert_potenzial, 
    wert_adjustment, 
    kommentar, 
    benutzer_id, 
    zeitstempel, 
    quelle_id, 
    serviceline_id) VALUES";
  $insertFirst = true;
  foreach($values as $value) {
    foreach($value as $cell) {
      if($insertFirst) {
        $insertFirst = false;
        $sqlInsertString = $sqlInsertString . getSaveValuesFromCell($cell);
      } else {
        $sqlInsertString = $sqlInsertString . ", " . getSaveValuesFromCell($cell);
      }
    }
  }
  $sqlInsertString = $sqlInsertString . " ON DUPLICATE KEY UPDATE 
    id = VALUES(id), 
    vertragsbestandteil_id = VALUES(vertragsbestandteil_id), 
    projekt_id = VALUES(projekt_id), 
    subkennzahl_id = VALUES(subkennzahl_id), 
    vertragshalter_id = VALUES(vertragshalter_id), 
    stichtag_id = VALUES(stichtag_id), 
    status_id = VALUES(status_id), 
    monat_id = VALUES(monat_id), 
    jahr_id = VALUES(jahr_id), 
    wert_kein_risiko = VALUES(wert_kein_risiko), 
    wert_mittleres_risiko = VALUES(wert_mittleres_risiko), 
    wert_hohes_risiko = VALUES(wert_hohes_risiko), 
    wert_gebucht = VALUES(wert_gebucht), 
    wert_potenzial = VALUES(wert_potenzial), 
    wert_adjustment = VALUES(wert_adjustment), 
    kommentar = VALUES(kommentar), 
    benutzer_id = VALUES(benutzer_id), 
    zeitstempel = VALUES(zeitstempel), 
    quelle_id = VALUES(quelle_id), 
    serviceline_id = VALUES(serviceline_id);";
  $sql = mysql_query($sqlInsertString);
  return $sqlInsertString;
}

function getSaveValuesFromCell($cell) {
  $string = " (";
  if($cell['id'] == (null || "")) {
    $string = $string . "null, ";
  } else {
    $string = $string . $cell['id'] . ", "; 
  }
  $string = $string 
    .$cell['vertragsbestandteil_id'].", 
    ".$cell['projekt_id'].", 
    ".$cell['subkennzahl_id'].", 
    ".$cell['vertragshalter_id'].", 
    ".$cell['stichtag_id'].", 
    ".$cell['status_id'].", 
    ".$cell['monat_id'].", 
    ".$cell['jahr_id'].", 
    ".$cell['wert_kein_risiko'].", 
    ".$cell['wert_mittleres_risiko'].", 
    ".$cell['wert_hohes_risiko'].", 
    ".$cell['wert_gebucht'].", 
    ".$cell['wert_potenzial'].", 
    ".$cell['wert_adjustment'].", 
    '".$cell['kommentar']."', 
    ".$cell['benutzer_id'].", 
    null, 
    ".$cell['quelle_id'].", 
    ".$cell['serviceline_id'].")";
  return $string;
}

function getAllMonths() {

  $sqlString = "SELECT monat.id AS 'monat.id', monat.name AS 'monat.name', monat.akronym AS 'monat.akronym' FROM monat ORDER BY monat.id ASC;";

	$sql = mysql_query($sqlString);

	$columns = array();
	$resultSet = array();
    
	while ($row = mysql_fetch_assoc($sql)) {
		if (empty($columns)) {
			$columns = array_keys($row);
		}
		$resultSet[] = $row;
  }
  $result = [];
  foreach($resultSet as $set) {
    $row = [];
    foreach($set as $key => $value) {
      $keys = explode(".",$key);
      $row[$keys[0]][$keys[1]] = $value;
    }
    $result[] = $row;
  }
  $months = [['id'=>1, 'akronym'=>'Okt'],['id'=>2, 'akronym'=>'Nov'],['id'=>3, 'akronym'=>'Dez'],['id'=>4, 'akronym'=>'Jan'],['id'=>5, 'akronym'=>'Feb'],['id'=>6, 'akronym'=>'Mär'],['id'=>7, 'akronym'=>'Apr'],['id'=>8, 'akronym'=>'Mai'],['id'=>9, 'akronym'=>'Jun'],['id'=>10, 'akronym'=>'Jul'],['id'=>11, 'akronym'=>'Aug'],['id'=>12, 'akronym'=>'Sep']];
  return $months;
}

function getTabsForProject($projectId) {

  $sqlString = "SELECT kennzahl.akronym FROM kennzahl JOIN projektart_kennzahl ON (kennzahl.id = projektart_kennzahl.kennzahl_id) JOIN projektart ON (projektart_kennzahl.projektart_id = projektart.id) JOIN projekt ON (projektart.id = projekt.art_id) WHERE projekt.id = ".$projectId.";";
	$sql = mysql_query($sqlString);
	
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
