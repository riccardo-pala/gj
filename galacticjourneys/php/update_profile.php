<?php
session_start();

// TODO: change credentials in the db/mysql_credentials.php file
require_once('../db/mysql_credentials.php');
include('functions.php');
// Open DBMS Server connection
$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db); 
if (mysqli_connect_errno($con)) {
	echo "Collegamento a MySQL non riuscito: ".mysqli_connect_error($con); 
	header('Location:../index.php');
	exit;
}

// Get value from $_SESSION
$oldUsername = $_SESSION['username'];
$oldEmail = $_SESSION['email'];

// Get values from $_POST, but do it IN A SECURE WAY
$newFirstname = test_input($con, $_POST['firstname']); 
$newLastname = test_input($con, $_POST['lastname']); 
$newUsername = test_input($con, $_POST['username']);
if (filter_var($newUsername, FILTER_VALIDATE_EMAIL)) {
	mysqli_close($con);
	header("Location: ../html/show_profile.php?err=3");
	exit;
}	
$newEmail = test_input($con, $_POST['email']); 
   
if ($newEmail != $oldEmail) {
	$checkEmail = 'SELECT * FROM users WHERE email=?';
	$stmt = mysqli_prepare($con,$checkEmail);
	mysqli_stmt_bind_param($stmt, 's', $newEmail);
	mysqli_stmt_execute($stmt);
	$res1 = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);	
}
if ($newUsername != $oldUsername) {
	$checkUsername = 'SELECT * FROM users WHERE username=?';
	$stmt = mysqli_prepare($con, $checkUsername);
	mysqli_stmt_bind_param($stmt, 's', $newUsername);
	mysqli_stmt_execute($stmt);
	$res2 = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);
}

if (isset($res1) && mysqli_num_rows($res1) > 0) {
	//$_SESSION["msg_err"] = "Email già esistente.";
	mysqli_free_result($res1); 
	mysqli_free_result($res2);
	mysqli_close($con);
	header("Location: ../html/show_profile.php?err=1");
	exit;
}
else if (isset($res2) && mysqli_num_rows($res2) > 0) {
	//$_SESSION["msg_err"] = "Username già esistente.";
	mysqli_free_result($res1);
	mysqli_free_result($res2);
	mysqli_close($con);
	header("Location:../html/show_profile.php?err=2");
	exit;
}
else {
	mysqli_free_result($res1); 
	mysqli_free_result($res2);

	$query = 'UPDATE users SET firstname=?,lastname=?,username=?,email=? WHERE email=?';
	$stmt = mysqli_prepare($con, $query);
	mysqli_stmt_bind_param($stmt, 'sssss', $newFirstname,$newLastname,$newUsername,$newEmail,$oldEmail);
	mysqli_stmt_execute($stmt);

	if (mysqli_stmt_affected_rows($stmt) == 1) {
		$_SESSION['email'] = $newEmail;
		mysqli_stmt_close($stmt);
		mysqli_close($con);
		header("Location: ../html/show_profile.php");
		exit;
	}
	mysqli_stmt_close($stmt);
	mysqli_close($con);
	echo "Errore fatale. Contattare l'amministratore del sito."; 
	exit;
}