<?php
session_start();

require_once('../db/mysql_credentials.php');
include('functions.php');

$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db); 
if (mysqli_connect_errno($con)) {
	echo "Collegamento a MySQL non riuscito: ".mysqli_connect_error($con); 
	header("Location: ../html/profileHTML.php?err=7"); // mancata connessione al server
	exit;
}

$oldEmail = $_SESSION['email'];

$stmt = mysqli_prepare($con, 'SELECT * FROM users WHERE email=?');
mysqli_stmt_bind_param($stmt, 's', $oldEmail);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) == 1)
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
else {
	mysqli_free_result($result); 
	mysqli_close($con);
	header("Location: ../html/profileHTML.php?err=8"); // FATAL ERROR
	exit;
}

$oldFirstname = $row['firstname'];
$oldLastname = $row['lastname'];

$newFirstname = test_input($con, $_POST['firstname']); 
$newLastname = test_input($con, $_POST['lastname']); 	
$newEmail = test_input($con, $_POST['email']); 

if ($newEmail != $oldEmail) {
	$stmt = mysqli_prepare($con, 'SELECT * FROM users WHERE email=?');
	mysqli_stmt_bind_param($stmt, 's', $newEmail);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	if (isset($result) && mysqli_num_rows($result) > 0) {
		mysqli_free_result($result); 
		mysqli_close($con);
		header("Location: ../html/profileHTML.php?err=1"); // email già esistente
		exit;
	}
}
else if ($newFirstname==$oldFirstname && $newLastname==$oldLastname) {
	mysqli_close($con);
	header("Location: ../html/profileHTML.php?err=5"); // dati nuovi uguali ai vecchi
	exit;
}

if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
	mysqli_close($con);
	header('Location: ../html/profileHTML.php?err=2'); // la nuova email è in un formato non valido
	exit;
}
else if (!preg_match("/^[a-zA-Z ]*$/", $newFirstname)) {
	mysqli_close($con);
	header('Location: ../html/profileHTML.php?err=3'); // il nome non è puramente alfabetico
	exit;
}
else if (!preg_match("/^[a-zA-Z ]*$/", $newLastname)) {
	mysqli_close($con);
	header('Location: ../html/profileHTML.php?err=4'); // il cognome non è puramente alfabetico
	exit;
}

$stmt = mysqli_prepare($con, 'UPDATE users SET firstname=?,lastname=?,email=? WHERE email=?');
mysqli_stmt_bind_param($stmt, 'ssss', $newFirstname, $newLastname, $newEmail, $oldEmail);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) == 1) {
	$_SESSION['email'] = $newEmail;
	mysqli_stmt_close($stmt);
	mysqli_close($con);
	$_SESSION['isLogged'] = true;
	$_SESSION['firstname'] = $newFirstname;
	$_SESSION['lastname'] = $newLastname;
	$_SESSION['email'] = $newEmail;
	header("Location: ../html/profileHTML.php?succ=1");
}
else {
	mysqli_stmt_close($stmt);
	mysqli_close($con);
	header("Location: ../html/profileHTML.php?err=8"); // FATAL ERROR
}
