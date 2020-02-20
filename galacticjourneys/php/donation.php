<?php

require_once('../db/mysql_credentials.php');
include('functions.php');

$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db); 
if (mysqli_connect_errno($con)) {
	echo "Collegamento a MySQL non riuscito: ".mysqli_connect_error($con); 
	header("Location: ../html/donationHTML.php?err=7"); // mancata connessione al server
	exit;
}

if (isset($_GET['act']) && $_GET['act']=="dnt" && isset($_POST['amount'])) {
	
	if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged']!=true) {
		mysqli_close($con);
		header("Location: ../html/loginHTML.php");
		exit;
	}
	
	$userid = $_SESSION['userid'];
	$amount = $_POST['amount'];

	$query = "INSERT INTO donations (donorid,amount) VALUES (?,?)"; 
	$stmt = mysqli_prepare($con, $query);
	mysqli_stmt_bind_param($stmt, 'ii', $userid,$amount);
	mysqli_stmt_execute($stmt);

	if (mysqli_stmt_affected_rows($stmt) == 1) {
		mysqli_stmt_close($stmt);
		mysqli_close($con);
		header('Location: ../html/donationHTML.php?sd=1'); // donazione effettuata
	}
	else {
		mysqli_stmt_close($stmt);
		mysqli_close($con);
		header("Location: ../html/registrationHTML.php?err=8"); // FATAL ERROR
		exit;
	}
}

$query = "SELECT SUM(amount) AS sum FROM donations";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($result);
$progress = $row['sum'];
mysqli_free_result($result);

$query = "
			SELECT users.email AS email,donations.amount AS amount 
			FROM donations INNER JOIN users ON users.id=donations.donorid
			ORDER BY amount DESC
		";
$result = mysqli_query($con,$query);
$numrows = mysqli_num_rows($result);

?>