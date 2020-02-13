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

	$query = "SELECT * FROM journeys WHERE true "; 
	
	$count = 0;
	$search = array();
	
	if (isset($_GET['departure'])) {
		$query = $query." AND (departure LIKE CONCAT('%',?,'%'))";
		$search[$count] = test_input($con, $_GET['departure']);
		$count++;
	}
	if (isset($_GET['destination'])) {
		$query = $query." AND (destination LIKE CONCAT('%',?,'%'))";
		$search[$count] = test_input($con, $_GET['destination']);
		$count++;
	}
	if (isset($_GET['date'])) {
		$query = $query." AND (date LIKE CONCAT('%',?,'%'))";
		$search[$count] = test_input($con, $_GET['date']);
		$count++;
	}

	
	$stmt = mysqli_prepare($con, $query);
	
	switch ($count) {
		case 1:
			mysqli_stmt_bind_param($stmt, 's', $search[0]);
			break;
		case 2:
			mysqli_stmt_bind_param($stmt, 'ss', $search[0], $search[1]);
			break;
		case 3:
			mysqli_stmt_bind_param($stmt, 'sss', $search[0], $search[1], $search[2]);
			break;
	}
	
	mysqli_stmt_execute($stmt);
	$results = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);

	//SONO ARRIVATO QUA-----------------------------
	
	if (mysqli_num_rows($results)==0) {
		//unset($_SESSION['results']);
		mysqli_free_result($results);
		mysqli_close($con);
		unset($results);
		//header("Location: ../html/searchHTML.php?search=".$search);
	}
	else {
		/*$rows = array();
		$index = 0;
		while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
			$rows[$index] = $row['departure']." ".$row['destination']." ".$row['date']." ".$row['description']."\n";
			$index++;
		}
		$_SESSION['results'] = $rows;
		mysqli_free_result($results);
		mysqli_close($con);
		header("Location: ../html/searchHTML.php?search=".$search);*/
		mysqli_close($con);
		$numrows = mysqli_num_rows($results);
	}
}
?>
