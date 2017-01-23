<?php

function createNewProject($definition, $name, $land_id, $art_id, $verantwortlicher_id, $frame_id, $kaufmann_id, $businesstype_id) {
	
	$sql_insert = "INSERT INTO `cts`.`projekt` (`definition`, `name`, `land_id`, `art_id`, `verantwortlicher_id`, `frame_id`, `kaufmann_id`, `businesstype_id`) VALUES ($definition, $name, $land_id, $art_id, $verantwortlicher_id , $frame_id , $kaufmann_id , $businesstype_id)";
	$db_conn -> exec($sql_insert);
	// close connection?
}

?>