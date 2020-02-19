<?php
session_start();

require_once('../db/mysql_credentials.php');
include('functions.php');
/*
if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']) {
	header('Location: ../index.php');
	exit;
}
*/
$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db); 
if (mysqli_connect_errno($con)) {
	echo "Collegamento a MySQL non riuscito: ".mysqli_connect_error($con); 
	header('Location: ../html/loginHTML.php?err=7'); // mancata connessione al server
	exit;
}

if(isset($_POST['email']) && isset($_POST['pass'])) {
	$email =  test_input($con, $_POST['email']);
	$pass =  crypt_password($_POST['pass']);
}
else{
	header('Location: ../html/loginHTML.php?err=1'); // i campi del form non sono correttamente compilati
	exit;
}

// Get user from login
$stmt = mysqli_prepare($con, "SELECT firstname, lastname, email, isAdmin FROM users WHERE email=? AND password=?");
mysqli_stmt_bind_param($stmt, 'ss', $email, $pass);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 1) {
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$_SESSION['isLogged'] = true;
	$_SESSION['firstname'] = $row['firstname'];
	$_SESSION['lastname'] = $row['lastname'];
	$_SESSION['email'] = $row['email'];
	$_SESSION['isAdmin'] = $row['isAdmin'];
	
	mysqli_stmt_close($stmt);
	mysqli_close($con);
	header('Location: ../index.php?sl=1');
	exit;
}
else if (mysqli_num_rows($result) == 0) {
	mysqli_stmt_close($stmt);
	mysqli_close($con);
	header('Location: ../html/loginHTML.php?err=2'); // email o password errati
	exit;
}
else {
	mysqli_stmt_close($stmt);
	mysqli_close($con);
	header('Location: ../html/loginHTML.php?err=8'); // FATAL ERROR
	exit;
}
?>