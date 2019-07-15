<?php

$API_BASE_URL = "";

function getPatients() {

	$response = file_get_contents($GLOBALS["API_BASE_URL"] . "/resources/v1/getInfo/patients");

	return json_decode($response, true)["ResultSet Output"];
}

function getDiseases() {
	$diseases = file_get_contents($GLOBALS["API_BASE_URL"] . "/resources/v1/listDiseases");

	return json_decode($diseases, true);
}

function getPrescriptions() {
	$prescriptions = file_get_contents($GLOBALS["API_BASE_URL"] . "/resources/v1/getInfo/prescription");

	$prescriptions = json_decode($prescriptions, true);

	usort($prescriptions, 'sortByTotal');
	
	return $prescriptions;
}

function getAge($dob) 
{ 
   	$dob=explode("-",$dob); 
   	$curMonth = date("m");
	$curDay = date("j");
 	$curYear = date("Y");
   	$age = $curYear - (int)$dob[0]; 
  	if($curMonth<$dob[1] || ($curMonth==$dob[1] && $curDay<$dob[2])) 
 		$age--; 
 	return $age; 
}

function sortByTotal($a, $b) {
 	$dA = (int)$a['TOTAL_PATIENTS'];
 	$dB = (int)$b['TOTAL_PATIENTS'];
	return $dA < $dB;
 }
