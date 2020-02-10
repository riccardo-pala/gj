<?php

if(isset($_GET['search'])) {
	
	require_once('../db/mysql_credentials.php');
	include('functions.php');

	$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db); 
	if (mysqli_connect_errno($con)) {
		echo "Collegamento a MySQL non riuscito: ".mysqli_connect_error($con); 
		header("Location: ../html/searchHTML.php?err=7"); // mancata connessione al server
		exit;
	}

	$search = test_input($con, $_GET['search']);

	$query = "SELECT * FROM journeys WHERE 
				(departure LIKE CONCAT('%',?,'%')) OR 
				(destination LIKE CONCAT('%',?,'%')) OR
				(date LIKE CONCAT('%',?,'%')) OR 
				(description LIKE CONCAT('%',?,'%'))
			";

	$stmt = mysqli_prepare($con, $query);
	mysqli_stmt_bind_param($stmt, 'ssss', $search,$search,$search,$search);
	mysqli_stmt_execute($stmt);
	$results = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);

	if (mysqli_num_rows($results)==0) {
		unset($_SESSION['results']);
		mysqli_free_result($results);
		mysqli_close($con);
		//header("Location: ../html/searchHTML.php?search=".$search);
	}
	else {
		$rows = array();
		$index = 0;
		while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
			$rows[$index] = $row['departure']." ".$row['destination']." ".$row['date']." ".$row['description']."\n";
			$index++;
		}
		$_SESSION['results'] = $rows;
		mysqli_free_result($results);
		mysqli_close($con);
		//header("Location: ../html/searchHTML.php?search=".$search);
	}
}
?>



