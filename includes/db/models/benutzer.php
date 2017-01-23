<?php

// require or require_once?
require_once WEB_INCLUDE_DIR."/init.php";


// ----- SELECT ----- //
function selectAllUsers() {
	
	$sql_select = mysql_query("SELECT id, login, passwort, vorname, nachname, email, telefon, mobil, sprache_id, rolle_id, vertragshalter_id FROM benutzer");
	
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
function insertUser($u_login, $u_password, $u_surname, $u_lastname, $u_email, $u_phone, $u_mobil, $u_language_id, $u_role_id, $u_contractholder_id) {
	
	$sql_insert = "INSERT INTO benutzer (login, passwort, vorname, nachname, email, telefon, mobil, sprache_id, rolle_id, vertragshalter_id) VALUES ($u_login, $u_password, $u_surname, $u_lastname, $u_email, $u_phone, $u_mobil, $u_language_id, $u_role_id, $u_contractholder_id)";
	$db_conn -> exec($sql_insert);
	// close connection?
}


// ----- DELETE ----- //
function deleteUser($id, $u_login) {

	$sql_update = "DELETE FROM benutzer WHERE id=$id AND login='$u_login'";
	$stmt = $db_conn -> prepare($sql_update);
	$stmt->execute();
	// close connection?
}

// ----- UPDATE ----- //
function updateUser($id, $u_login, $u_password, $u_surname, $u_lastname, $u_email, $u_phone, $u_mobil, $u_language_id, $u_role_id, $u_contractholder_id) {

	$sql_update = "UPDATE benutzer SET login='$u_login', passort = '$u_password', vorname = '$u_surname', nachname = '$u_lastname', email = '$u_email', telefon = '$u_phone', mobil = '$u_mobil', sprache_id = '$u_language_id', rolle_id = '$u_role_id', vertragshalter_id = '$u_contractholder_id' WHERE id=$id";
	$stmt = $db_conn -> prepare($sql_update);
	$stmt->execute();
	// close connection?
}

?>
