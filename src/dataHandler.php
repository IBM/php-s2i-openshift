<?php

$API_BASE_URL = getenv("apiBaseUrl");

function getPatients() {

	if ($GLOBALS["API_BASE_URL"]) {
		$patients = file_get_contents($GLOBALS["API_BASE_URL"] . "/resources/v1/getInfo/patients");
	} else {
		$patients = file_get_contents("sample/patients.json");
	}

	return json_decode($patients, true)["ResultSet Output"];
}

function getDiseases() {
	if ($GLOBALS["API_BASE_URL"]) {
		$diseases = file_get_contents($GLOBALS["API_BASE_URL"] . "/resources/v1/listDiseases");
	} else {
		$diseases = file_get_contents("sample/diseases.json");
	}

	return json_decode($diseases, true);
}

function getPrescriptions() {
	if ($GLOBALS["API_BASE_URL"]) {
		$prescriptions = file_get_contents($GLOBALS["API_BASE_URL"] . "/resources/v1/getInfo/prescription");
	} else {
		$prescriptions = file_get_contents("sample/prescriptions.json");
	}

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
