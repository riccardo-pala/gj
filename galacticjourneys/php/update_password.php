<?php
session_start();

require_once('../db/mysql_credentials.php');
include('functions.php');
// Open DBMS Server connection
$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db); 
if (mysqli_connect_errno($con)) {
	echo "Collegamento a MySQL non riuscito: ".mysqli_connect_error($con); 
	header('Location:../index.php'); // TODO: inserire alert di mancata connessione al server
	exit;
}

// Get value from $_SESSION
$email = $_SESSION['email'];

