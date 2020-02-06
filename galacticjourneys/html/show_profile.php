<?php
session_start();

require_once('../db/mysql_credentials.php');

// Open DBMS Server connection
$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db); 
if (mysqli_connect_errno($con)) {
	echo "<div id=serror>Errore di connessione al server.</div>"; 
	exit;
}
// Get profile data from database (check current session)
if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] && isset($_SESSION['email'])) {
	$email = $_SESSION['email'];
	$stmt = mysqli_prepare($con, 'SELECT firstname,lastname,username,email FROM users WHERE email=?');
	mysqli_stmt_bind_param($stmt, 's', $email);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	
	if (mysqli_num_rows($result) == 1) {
		
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$username = $row['username'];
		$email = $row['email'];
		
		mysqli_stmt_close($stmt);
		mysqli_close($con);		
	}
	else {
		mysqli_stmt_close($stmt);
		mysqli_close($con);
		echo "Errore fatale. Contattare l'amministratore del sito."; 
		exit;
	}
}
else {
	mysqli_stmt_close($stmt);
	mysqli_close($con);
	header('Location: loginHTML.php');
	exit;
}
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Play'> 
	<link rel='stylesheet' type='text/css' href=''>
	<script type='text/javascript' src='../js/scripts.js'></script>
	<title>Modifica Profilo - Galactic Journeys</title>
</head>

<body>
<?php	
	echo "
		<div class=\"title\">
		<button class=\"button\" name=\"home_button\" onclick=\"window.location.href='../index.php'\">Home</button>
		LOGIN
		<button class=\"button\" name=\"mod_button\" onclick=\"window.location.href=''\">Modifica Password</button>
		</div>

		<div class=\"form\">
		<form action=\"../php/update_profile.php\" method=\"POST\" name=\"Form\">
			<input type=\"text\" name=\"firstname\" placeholder=\"Nome\" value=\"$firstname\"><br>
			<input type=\"text\" name=\"lastname\" placeholder=\"Cognome\" value=\"$lastname\"><br>
			<input type=\"text\" name=\"username\" placeholder=\"Username\" value=\"$username\"><br>
			<input type=\"email\" required name=\"email\" placeholder=\"Email\" value=\"$email\"><br>
			<div id='error'></div>
			<input type=\"submit\" value=\"Modifica\"><br>
		</form>
		</div>	
	";
	
	if(isset($_GET['err'])) {
		switch($_GET['err']) {
			case 1:
				echo "<script>document.getElementById('error').innerHTML = 'Email già esistente.'</script>";
				break;
			case 2:
				echo "<script>document.getElementById('error').innerHTML = 'Username già esistente.'</script>";
				break;
			case 3:
				echo "<script>document.getElementById('error').innerHTML = 'Username non valido.'</script>";
				break;
			default:
				break;
		}
	}
?>
</body>
</html>
