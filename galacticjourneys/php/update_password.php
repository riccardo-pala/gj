<?php
session_start();

require_once('../db/mysql_credentials.php');
include('functions.php');

$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db); 
if (mysqli_connect_errno($con)) {
	echo "Collegamento a MySQL non riuscito: ".mysqli_connect_error($con); 
	header("Location: ../html/show_password.php?err=7"); // mancata connessione al server
	exit;
}

$email = $_SESSION['email'];

$oldPassword = crypt_password(test_input($con, $_POST['oldPassword'])); 
$newPassword = crypt_password(test_input($con, $_POST['newPassword'])); 	
$newPassword2 = crypt_password(test_input($con, $_POST['newPassword2']));

$stmt = mysqli_prepare($con, 'SELECT password FROM users WHERE email=?');
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

if (mysqli_num_rows($result) == 1)
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
else {
	mysqli_free_result($result); 
	mysqli_close($con);
	header("Location: ../html/show_password.php?err=8"); // FATAL ERROR
	exit;
}
mysqli_free_result($result);

if($row['password'] != $oldPassword) {
	mysqli_close($con); 
	header("Location: ../html/show_password.php?err=2"); // PASSWORD ATTUALE ERRATA
}
else if($newPassword != $newPassword2) {
	mysqli_close($con);
	header("Location: ../html/show_password.php?err=3"); // PASSWORD NON CORRISPONDONO
}
else {
	$stmt = mysqli_prepare($con, 'UPDATE users SET password=? WHERE email=?');
	mysqli_stmt_bind_param($stmt, 'ss', $newPassword, $email);
	mysqli_stmt_execute($stmt);
	
	if (mysqli_stmt_affected_rows($stmt) == 1) {
		mysqli_close($con);
		header("Location: ../html/show_password.php?succ=1");
	}
	else {
		mysqli_close($con);
		header("Location: ../html/show_password.php?err=8"); // FATAL ERROR
	}
}
	