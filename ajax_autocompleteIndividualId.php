<?php

require_once 'local_utils.php';

//prevent direct access
$isAjax = isset($_SERVER['HTTP_X_REQUESED_WITH']) AND
strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
if(!$isAjax) {
	$user_error = 'Access denied - not an AJAX request...';
	trigger_error($user_error, E_USER_ERROR);
}

// get what user typed in autocomplete input
$term = trim($_GET['term']);

$a_json = array();
$a_json_row = array();

$a_json_invalid = array(array("id" => "#", "value" => $term, "label" => "Only letters and digits are permitted..."));
$json_invalid = json_encode($a_json_invalid);

//replace multiple spaces with one
$term = preg_replace('/\s+/', ' ', $term);

// SECURITY HOLE ******************************
// allow space, any unicode letter and digit, underscore and dash
if(preg_match("/[^\040\pL\pN_-]/u", $term)) {
	print $json_invalid;
	exit;
}
// ****************************************

requice_once("./mysql_connect.php");

$sql = 'SELECT individual_id FROM mutli_var_fil WHERE individual_id LIKE "%'.mysql_real_escape_string($term).'%"';

$rs = mysql_query($sql);
if($rs == false) {
	$user_error = 'Wrong SQL: ' . $sql;
	trigger_error($user_error, E_USER_ERROR);
}

while($row = $rs->fetch_assoc()) {
	$a_json_row["id"] = $row["individual_id"];
	$a_json_row["value"] = $row["individual_id"];
	$a_json_row["label"] = $row["individual_id"];
	array_push($a_json, $a_json_row);
}

// highlight search results
$a_json = apply_highlight($a_json, $parts);

$json = json_encode($a_json);
print $json;
?>