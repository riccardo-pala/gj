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
		
		if ($_GET['act']==='dlt' && isset($_GET['id'])) {
			$cartid = $_GET['id'];
			$query = "DELETE FROM carts WHERE cartid=?";
			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, 'i', $cartid);
			mysqli_stmt_execute($stmt);
			if (mysqli_stmt_affected_rows($stmt)<1)
				header("Location: ../html/adminHTML.php?err=8"); // FATAL ERROR
			mysqli_stmt_close($stmt);
			mysqli_close($con);
		}
		else if ($_GET['act']==='add' && isset($_POST['id'])) {
			$journeyid = $_POST['id'];
			$query = "INSERT INTO carts (email, journeyid) VALUES (?, ?)";
			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, 'si', $email, $journeyid);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		header("Location: ../html/cartHTML.php");
		exit;
	}
	else {
		$query = "SELECT * FROM carts
					INNER JOIN journeys
					ON carts.journeyid=journeys.id
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