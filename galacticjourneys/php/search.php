<?php

if (isset($_GET['search']) && $_GET['search']==1) {
	require_once('../db/mysql_credentials.php');
	include('functions.php');

	$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db); 
	if (mysqli_connect_errno($con)) {
		echo "Collegamento a MySQL non riuscito: ".mysqli_connect_error($con); 
		header("Location: ../html/searchJourneyHTML.php?err=7"); // mancata connessione al server
		exit;
	}
	
	$departure = test_input($_GET['departure']);
	$destination = test_input($_GET['destination']);
	$date = test_input($_GET['date']);

	if (empty($departure) || empty($destination) || empty($date)) {
		mysqli_close($con);
		header('Location: ../html/searchJourneyHTML.php?err=1'); // i campi del form non sono correttamente compilati
		exit;
	}
	$query = "SELECT * FROM journeys WHERE 
				(departure LIKE CONCAT(?,'%')) AND
				(destination LIKE CONCAT(?,'%')) AND
				(date >= ?) ORDER BY date"; 

	$stmt = mysqli_prepare($con, $query);

	mysqli_stmt_bind_param($stmt, 'sss', $departure, $destination, $date);
	mysqli_stmt_execute($stmt);
	$results = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);

	if (mysqli_num_rows($results)==0) {
		mysqli_free_result($results);
		mysqli_close($con);
		unset($results);
	}
	else {
		mysqli_close($con);
		$numrows = mysqli_num_rows($results);
	}
}
?>
