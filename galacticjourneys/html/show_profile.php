<?php
session_start();

if (isset($_GET['err']) && $_GET['err'] == 7) {
	echo "Errore di connessione al server. Torna alla <a class=\"link\" href=\"index.php\">HOME</a>"; 
	exit;
}
if (isset($_GET['err']) && $_GET['err'] == 8) {
	echo "Errore fatale. Contattare l'amministratore del sito.";
	exit;
}

require_once('../db/mysql_credentials.php');

$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db); 
if (mysqli_connect_errno($con)) {
	echo "Errore di connessione al server. Torna alla <a class=\"link\" href=\"index.php\">HOME</a>"; 
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
	header('Location: loginHTML.php');
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Play'> 
	<link rel='stylesheet' type='text/css' href=''>
	<script type='text/javascript' src='../js/scripts.js'></script>
	<title>Modifica Profilo - Galactic Journeys</title>
</head>

<body>

	<div class="title">
		<button class="button" name="home_button" onclick="window.location.href='../index.php'">Home</button>
		LOGIN
	</div>

	<div class="form">
		<form action="../php/update_profile.php" method="POST" name="Form">
			<input type="text" name="firstname" placeholder="Nome" value="<?php echo $firstname; ?>" required><br>
			<input type="text" name="lastname" placeholder="Cognome" value="<?php echo $lastname; ?>" required><br>
			<input type="email" required name="email" placeholder="Email" value="<?php echo $email; ?>" required><br>
			<input type="submit" value="Modifica">
		</form>
			<button class="button" name="mod_button" onclick="window.location.href='show_password.php'">Modifica Password</button>
		<div id='error'></div>
	</div>

	<?php
	if(isset($_GET['err'])) {
		switch($_GET['err']) {
			case 1:
				echo "<script>document.getElementById('error').innerHTML = 'ERRORE! Email già esistente.'</script>";
				break;
			case 2:
				echo "<script>document.getElementById('error').innerHTML = 'ERRORE! Email non valida.'</script>";
				break;
			case 3:
				echo "<script>document.getElementById('error').innerHTML = 'ERRORE! Nome non valido.'</script>";
				break;
			case 4:
				echo "<script>document.getElementById('error').innerHTML = 'ERRORE! Cognome non valido.'</script>";
				break;
			case 5:
				echo "<script>document.getElementById('error').innerHTML = 'Si prega di inserire almeno un dato diverso da quelli attuali.'</script>";
				break;
			default:
				break;
		}
	}
	if (isset($_GET['succ']) && $_GET['succ'] == 1)
		echo "<script>window.alert('Modifiche effettuate con successo!');</script>";
	?>
</body>
</html>
