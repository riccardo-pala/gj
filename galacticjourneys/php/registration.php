<?php
	
// TODO: change credentials in the db/mysql_credentials.php file
require_once('../db/mysql_credentials.php');
include('functions.php');
// Open DBMS Server connection
$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
if (mysqli_connect_errno($con)) {
	echo "Collegamento a MySQL non riuscito: ".mysqli_connect_error($con);
	mysqli_close($con);
	header('Location: ../index.php');
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
}
else {
	header('Location: ../html/registrationHTML.php?err=1');
	exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	header('Location: ../html/registrationHTML.php?err=2');
	exit;
}
else if (!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
	header('Location: ../html/registrationHTML.php?err=3');
	exit;
}
else if (!preg_match("/^[a-zA-Z ]*$/", $lastname)) {
	header('Location: ../html/registrationHTML.php?err=4');
	exit;
}
else if ($pass != $confirm) {
	header('Location: ../html/registrationHTML.php?err=5');
	exit;
}

$stmt = mysqli_prepare($con, "SELECT email FROM users WHERE email=?");
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) > 0) {
	//email già esistente
	mysqli_free_result($result);
	mysqli_stmt_close($stmt);
	mysqli_close($con);
	header('Location: ../html/registrationHTML.php?err=7');
	exit;
}
mysqli_free_result($result);

//preparo la query
$stmt = mysqli_prepare($con, "INSERT INTO users (firstname, lastname, email, password, isAdmin) VALUES (?, ?, ?, ?, 0)");
mysqli_stmt_bind_param($stmt, 'ssss', $firstname, $lastname, $email, $pass);

//eseguo la query
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($con);

header('Location: ../html/loginHTML.php?sr=1');

?>