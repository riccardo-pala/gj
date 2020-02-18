<?php

if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] && isset($_SESSION['email'])) {
	
	require_once('../db/mysql_credentials.php');
	include('functions.php');

	$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db); 
	if (mysqli_connect_errno($con)) {
		echo "Collegamento a MySQL non riuscito: ".mysqli_connect_error($con); 
		header("Location: ../html/cartHTML.php?err=7"); // mancata connessione al server
		exit;
	}
	
	$email = $_SESSION['email'];
	
	if (isset($_GET['act'])) {
		
		if ($_GET['act']==='add' && isset($_SESSION['journeys'])) {
			$journeysid = array();
			$journeysid = $_SESSION['journeys'];
			$query1 = "INSERT INTO bookings (email, journeyid) VALUES (?, ?)";
			$query2 = "DELETE FROM carts WHERE (email=? AND journeyid=?)";
			$i=1;
			while (isset($journeysid[$i])) {
				$stmt1 = mysqli_prepare($con, $query1);
				$stmt2 = mysqli_prepare($con, $query2);
				mysqli_stmt_bind_param($stmt1, 'si', $email, $journeysid[$i]);
				mysqli_stmt_execute($stmt1);
				mysqli_stmt_close($stmt1);
				mysqli_stmt_bind_param($stmt2, 'si', $email, $journeysid[$i]);
				mysqli_stmt_execute($stmt2);
				mysqli_stmt_close($stmt2);
				$i++;
			}
		}
		header("Location: ../html/bookingHTML.php");
		exit;
	}
	else {
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
}
?>