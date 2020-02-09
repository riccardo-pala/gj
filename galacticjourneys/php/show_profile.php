<?php
session_start();

require_once('../db/mysql_credentials.php');

$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db); 
if (mysqli_connect_errno($con)) {
	echo "Errore di connessione al server. Torna alla <a class=\"link\" href=\"../index.php\">HOME</a>"; 
	exit;
}

if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] && isset($_SESSION['email'])) {
	$email = $_SESSION['email'];
	$stmt = mysqli_prepare($con, 'SELECT firstname,lastname,email FROM users WHERE email=?');
	mysqli_stmt_bind_param($stmt, 's', $email);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	
	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$email = $row['email'];
		mysqli_free_result($result);
		mysqli_stmt_close($stmt);
		mysqli_close($con);
		//echo $firstname;
		//echo $lastname;
		//echo $email;	
	}
	else {
		mysqli_free_result($result);
		mysqli_stmt_close($stmt);
		mysqli_close($con);
		echo "Errore fatale. Contattare l'amministratore del sito."; 
		exit;
	}
}
else {
	mysqli_close($con);
	header('Location: ../html/loginHTML.php');
	exit;
}
?>