<?php
session_start();

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
$oldEmail = $_SESSION['email'];

// Get values from $_POST, but do it IN A SECURE WAY
$newFirstname = test_input($con, $_POST['firstname']); 
$newLastname = test_input($con, $_POST['lastname']); 	
$newEmail = test_input($con, $_POST['email']); 
   
if ($newEmail != $oldEmail) {
	$checkEmail = 'SELECT * FROM users WHERE email=?';
	$stmt = mysqli_prepare($con,$checkEmail);
	mysqli_stmt_bind_param($stmt, 's', $newEmail);
	mysqli_stmt_execute($stmt);
	$res1 = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);	
}

if (isset($res1) && mysqli_num_rows($res1) > 0) {
	// "Email già esistente.";
	mysqli_free_result($res1); 
	mysqli_close($con);
	header("Location: ../html/show_profile.php?err=1");
}
else {
	$query = 'UPDATE users SET firstname=?,lastname=?,email=? WHERE email=?';
	$stmt = mysqli_prepare($con, $query);
	mysqli_stmt_bind_param($stmt, 'ssss', $newFirstname,$newLastname,$newEmail,$oldEmail);
	mysqli_stmt_execute($stmt);

	if (mysqli_stmt_affected_rows($stmt) == 1) {
		$_SESSION['email'] = $newEmail;
		mysqli_stmt_close($stmt);
		mysqli_close($con);
		header("Location: ../html/show_profile.php");
	}
	else {
		mysqli_stmt_close($stmt);
		mysqli_close($con);
		//echo "Errore fatale. Contattare l'amministratore del sito."; 
		header("Location: ../html/show_profile.php?err=2");
	}
}