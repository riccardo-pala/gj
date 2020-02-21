<?php

require_once('../db/mysql_credentials.php');
include('functions.php');
// Open DBMS Server connection
$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
if (mysqli_connect_errno($con)) {
	echo "Collegamento a MySQL non riuscito: ".mysqli_connect_error($con);
	header("Location: ../html/registrationHTML.php?err=7"); // mancata connessione al server
	exit;
}

// Get values from $_POST, but do it IN A SECURE WAY
if (isset($_POST['firstname'])&&isset($_POST['lastname'])
		&&isset($_POST['email'])&&isset($_POST['pass'])&&isset($_POST['confirm'])){

	$firstname = test_input($con, $_POST['firstname']);
	$lastname = test_input($con, $_POST['lastname']);
	$email = test_input($con, $_POST['email']);
	$pass = crypt_password($_POST['pass']);
	$confirm = crypt_password($_POST['confirm']);
	if (empty($firstname) || empty($lastname) || empty($email) || empty($pass) || empty($confirm)) {
		mysqli_close($con);
		header('Location: ../html/registrationHTML.php?err=1'); // i campi del form non sono correttamente compilati
		exit;
	}
}
else {
	mysqli_close($con);
	header('Location: ../html/registrationHTML.php?err=1'); // i campi del form non sono correttamente compilati
	exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	mysqli_close($con);
	header('Location: ../html/registrationHTML.php?err=2'); // l'email è in un formato non valido
	exit;
}
else if (!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
	mysqli_close($con);
	header('Location: ../html/registrationHTML.php?err=3'); // il nome non è puramente alfabetico
	exit;
}
else if (!preg_match("/^[a-zA-Z ]*$/", $lastname)) {
	mysqli_close($con);
	header('Location: ../html/registrationHTML.php?err=4'); // il cognome non è puramente alfabetico
	exit;
}
else if ($pass != $confirm) {
	mysqli_close($con);
	header('Location: ../html/registrationHTML.php?err=5'); // le password non coincidono
	exit;
}

/*
$stmt = mysqli_prepare($con, "SELECT email FROM users WHERE email=?");
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) > 0) {
	//email già esistente
	mysqli_free_result($result);
	mysqli_stmt_close($stmt);
	mysqli_close($con);
	header('Location: ../html/registrationHTML.php?err=6'); // email già esistente
	exit;
}
mysqli_free_result($result);
*/

//preparo la query
$stmt = mysqli_prepare($con, "INSERT INTO users (firstname, lastname, email, password, isAdmin) VALUES (?, ?, ?, ?, 0)");
mysqli_stmt_bind_param($stmt, 'ssss', $firstname, $lastname, $email, $pass);
//
if(!mysqli_stmt_execute($stmt)) {
	echo "".mysqli_stmt_error($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($con);
	header('Location: ../html/registrationHTML.php?err=6'); // email già esistente
}
else if (mysqli_stmt_affected_rows($stmt) == 1) {
	mysqli_stmt_close($stmt);
	mysqli_close($con);
	header('Location: ../html/loginHTML.php?sr=1'); // registrato con successo
}
else {
	mysqli_stmt_close($stmt);
	mysqli_close($con);
	header("Location: ../html/registrationHTML.php?err=8"); // FATAL ERROR
}

?>