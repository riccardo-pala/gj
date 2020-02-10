<?php

require_once('../db/mysql_credentials.php');
include('functions.php');

$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db); 
if (mysqli_connect_errno($con)) {
	echo "Collegamento a MySQL non riuscito: ".mysqli_connect_error($con); 
	header("Location: ../html/adminHTML.php?err=7"); // mancata connessione al server
	exit;
}

if (isset($_GET['act'])) {
	if (isset($_GET['id'])){
		$id = $_GET['id'];
		if ($_GET['act']==='edit') {
			$query = "SELECT * FROM journeys WHERE id=?";
			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, 'i', $id);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($con);
		}
		else if ($_GET['act']==='dlt') {
			$query = "DELETE FROM journeys WHERE id=?";
			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, 'i', $id);
			mysqli_stmt_execute($stmt);
			if (mysqli_stmt_affected_rows($stmt)<1) {
				header("Location: ../html/adminHTML.php?err=8"); // FATAL ERROR
			}
			mysqli_stmt_close($stmt);
			mysqli_close($con);
			header("Location: ../html/adminHTML.php");
		}
		else if ($_GET['act']==='updt') {
			if (isset($_POST['departure']) && isset($_POST['destination']) && isset($_POST['price'])
				&& isset($_POST['date']) && isset($_POST['description']) && isset($_POST['totalseat'])
				&& isset($_POST['availableseat'])) {
				$departure = $_POST['departure'];
				$destination = $_POST['destination'];
				$price = $_POST['price'];
				$date = $_POST['date'];
				$description = $_POST['description'];
				$totalseat = $_POST['totalseat'];
				$availableseat = $_POST['availableseat'];
				$query = "	UPDATE journeys 
							SET departure=?, destination=?, price=?, date=?, description=?, totalseat=?, availableseat=?
							WHERE id=?
						";
				$stmt = mysqli_prepare($con, $query);
				mysqli_stmt_bind_param($stmt, 'ssdssiii', $departure, $destination, $price, $date, $description, $totalseat, $availableseat, $id);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
				mysqli_close($con);
				header("Location: ../html/adminHTML.php");
			}
			else {
				header("Location: ../html/adminHTML.php?err=8"); // FATAL ERROR
			}
		}
	}
	else if ($_GET['act']==='addnew') {
		if (isset($_POST['departure']) && isset($_POST['destination']) && isset($_POST['price'])
			&& isset($_POST['date']) && isset($_POST['description']) && isset($_POST['totalseat'])
			&& isset($_POST['availableseat'])) {
			$departure = $_POST['departure'];
			$destination = $_POST['destination'];
			$price = $_POST['price'];
			$date = $_POST['date'];
			$description = $_POST['description'];
			$totalseat = $_POST['totalseat'];
			$availableseat = $_POST['availableseat'];
			$query = "	INSERT INTO journeys 
						(departure, destination, price, date, description, totalseat, availableseat)
						VALUES (?, ?, ?, ?, ?, ?, ?)
					";
			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, 'ssdssii', $departure, $destination, $price, $date, $description, $totalseat, $availableseat);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($con);
			header("Location: ../html/adminHTML.php");
		}
		else {
			header("Location: ../html/adminHTML.php?err=8"); // FATAL ERROR
		}
	}
}
else {
	$query = "SELECT * FROM journeys";
	$result = mysqli_query($con, $query) or DIE('Query non riuscita!'.mysqli_error($con));
	mysqli_close($con);
	$numrows = mysqli_num_rows($result);
}
?>