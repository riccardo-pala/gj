<?php


if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] && isset($_SESSION['email'])) {
	
	require_once('../db/mysql_credentials.php');
	include('functions.php');

	$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db); 
	if (mysqli_connect_errno($con)) {
		echo "Collegamento a MySQL non riuscito: ".mysqli_connect_error($con); 
		header("Location: ../html/bookingHTML.php?err=7"); // mancata connessione al server
		exit;
	}
	
	$email = $_SESSION['email'];
	
	if (isset($_POST['id'])) {
		
		$journeyid = $_POST['id'];

		$query = "INSERT INTO bookings (email, journeyid) VALUES (?, ?)";
		$stmt = mysqli_prepare($con, $query);
		mysqli_stmt_bind_param($stmt, 'si', $email, $journeyid);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	
	$query = "SELECT * FROM bookings
				INNER JOIN journeys
				ON bookings.journeyid=journeys.id
				WHERE email=?";
	
	$stmt = mysqli_prepare($con, $query);
	mysqli_stmt_bind_param($stmt, 's', $email);
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