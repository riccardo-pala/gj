<?php
session_start();

// TODO: change credentials in the db/mysql_credentials.php file
require_once('../db/mysql_credentials.php');
include('functions.php');
// Add session control, header, ...
if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']) {
	header('Location: ../index.php');
	exit;
}

// Open DBMS Server connection
$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db); 
if (mysqli_connect_errno($con)) {
	echo "Collegamento a MySQL non riuscito: ".mysqli_connect_error($con); 
	header('Location: ../html/loginHTML.php?fl=3');
	exit;
}
// Get credentials from $_POST['email'] and $_POST['pass']
// but do it IN A SECURE WAY
if(isset($_POST['email']) && isset($_POST['pass'])) {
	$email =  test_input($con, $_POST['email']);
	$pass =  crypt_password($_POST['pass']);
}
else{
	header('Location: ../html/loginHTML.php?fl=1');
	exit;
}

// Get user from login
$stmt = mysqli_prepare($con, "SELECT firstname, lastname, username, email, isAdmin FROM users WHERE (email=? OR username=?) AND password=?");
mysqli_stmt_bind_param($stmt, 'sss', $email, $email, $pass);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 1) {
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$_SESSION['isLogged'] = true;
	$_SESSION['firstname'] = $row['firstname'];
	$_SESSION['lastname'] = $row['lastname'];
	$_SESSION['username'] = $row['username'];
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
	header('Location: ../html/loginHTML.php?fl=2');
	exit;
}
else {
	mysqli_stmt_close($stmt);
	mysqli_close($con);
	header('Location: ../html/loginHTML.php?fl=4');
	exit;
}
?>