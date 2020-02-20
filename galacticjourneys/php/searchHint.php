<?php

if (isset($_GET['search']) && isset($_GET['id'])) {
	require_once('../db/mysql_credentials.php');
	include('functions.php');

	$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db); 
	if (mysqli_connect_errno($con)) {
		echo "Collegamento a MySQL non riuscito: ".mysqli_connect_error($con); 
		header("Location: ../html/searchJourneyHTML.php?err=7"); // mancata connessione al server
		exit;
	}

	$id = $_GET['id'];
	$search = test_input($con, $_GET['search'])."%";
		
	$query = "SELECT DISTINCT $id FROM journeys WHERE $id LIKE ?";

	$stmt = mysqli_prepare($con, $query);
	mysqli_stmt_bind_param($stmt, 's', $search);
	mysqli_stmt_execute($stmt);
	
	$results = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);

	if (mysqli_num_rows($results)==0) {
		mysqli_free_result($results);
		mysqli_close($con);
	}
	else {
		mysqli_close($con);
		$numrows = mysqli_num_rows($results);
		for ($i=1; $i<=$numrows; $i++) {
			$row = mysqli_fetch_assoc($results);
			$value = $row[$id];
			echo "<div id=\"hint\" onclick=\"changeValue('$id','$value');\">$value</div>";
		}
	}
}
?>
