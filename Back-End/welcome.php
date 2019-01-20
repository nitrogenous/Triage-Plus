<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include 'main.php';

if(isset($_POST)){
	if('save' == $_POST['save']){
		
		$info = array(name => $_POST['name'],surname => $_POST['surname']);

		$physical = array(gender => $_POST['gender'], age => $_POST['age'], weight => $_POST['weight']);

		$physicalAvg = json_decode(predictPatient('physical_prediction',json_encode($physical)))[0];

		$factors = array(sport => $_POST['sport'],tobacco => $_POST['tobacco'],alcohol => $_POST['alcohol'],familyHistory => $_POST['familyHistory'],physicalAvg => $physicalAvg);

		$factorsAvg = json_decode(predictPatient('factors_prediction',json_encode($factors)))[0];

		$con = connectDB();
		$sql = 'INSERT INTO `usersDatabase`(`patientAvg`, `name`, `surname`, `gender`, `age`, `weight`, `sport`, `tobacco`, `alcohol`, `familyHistory`, `physicalAvg`) VALUES ('.$factorsAvg.',"'.$_POST['name'].'","'.$_POST['surname'].'",'.$_POST['gender'].','.$_POST['age'].','.$_POST['weight'].','.$_POST['sport'].','.$_POST['tobacco'].','.$_POST['alcohol'].','.$_POST['familyHistory'].','.$physicalAvg.')';
		echo saveData($con,$sql);
		die('savee');
	}
	else if('getUsers' == $_POST['getUsers']){

	}
}
else{
	die('Error!');
}