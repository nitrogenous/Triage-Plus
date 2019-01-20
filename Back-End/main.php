<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


function connectDB(){
	$servername = 'localhost';
	$username = 'backend';
	$password = 'Toprak123123';

	$con = mysqli_connect($servername,$username,$password);
	if(!$con){
		die('400 '.mysqli_connect_error());
	}
	die(200);
}

function saveData($con,$sql){
	if(mysqli_query($con,$sql)){
		die(200);
	}
	else{
		die(400);
	}
}

function getData($con,$sql){
	$result = mysqli_query($con,$sql);
	if (mysqli_num_rows($result) > 0){
		while ($row = mysqli_fetch_assoc($result)){
			echo $row;
		}
	}
	else{
		echo '0 result';
	}
}

function predictPatient($predictionFile,$inputData){
	// $command = escapeshellcmd('/var/www/html/hackathon/AI/physical_prediction.py');
	$output = shell_exec("python /var/www/html/hackathon/AI/".$predictionFile.".py '".$inputData."'");
	// var_dump($output);
	return $output;
}

function injection($str) {
	$bad = array(
		'<!--', '-->',
		"'", '"',
		'<', '>',
		'&', '$',
		'=',
		';',
		'?',
		'/',
		'!',
		'#',
		'%20',		//space
		'%22',		// "
		'%3c',		// <
		'%253c',	// <
		'%3e',		// >
		'%0e',		// >
		'%28',		// (
		'%29',		// )
		'%2528',	// (
		'%26',		// &
		'%24',		// $
		'%3f',		// ?
		'%3b',		// ;
		'%3d',		// =
		'%2F',		// /
		'%2E',		// .
		// '46', 	// .
		// '47'		// /
	);
	do
	{
		$old = $str;
		$str = str_replace($bad, ' ', $str);
	}
	while ($old !== $str);
	return $str;	
}
