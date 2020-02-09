<?php
session_start();

require_once('../db/mysql_credentials.php');
include('functions.php');

// Open DBMS Server connection
$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db); 
if (mysqli_connect_errno($con)) {
	echo "Collegamento a MySQL non riuscito: ".mysqli_connect_error($con); 
	header("Location: ../html/searchHTML.php?err=7"); // mancata connessione al server
	exit;
}
// Get search string from $_GET['search']
// but do it IN A SECURE WAY
$search = test_input($con, $_GET['search']);

$query = 'SELECT * FROM journeys WHERE departure,destination,date,description LIKE ?';

$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, 's', $search);
mysqli_stmt_execute($stmt);

$_SESSION['results'] = mysqli_stmt_get_result($stmt);

mysqli_stmt_close($stmt);
mysqli_free_result($result);
mysqli_close($con);
header("Location: ../html/searchHTML.php");

?>

//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

