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
?>

<!doctype html>
<html>
<head>
	<meta name="author" content="J&R inc.">
	<meta name="description" content="Scopri il viaggio interstellare dei tuoi sogni">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Play'> 
	<link rel='stylesheet' type='text/css' href=''>
	<script src="../js/scripts.js" type="text/javascript"></script>
	<title>Registrati! - Galactic Journeys</title>
</head>

<body>
	<?php
	if(isset($_SESSION['isLogged']) && $_SESSION['isLogged']) {
		if(isset($_SESSION['email'])){
			$email = " come ".$_SESSION['email'];
		}
		else {
			$email = '';
		}
		echo "<div style='color:red'>ERRORE! Risulti già loggato$email. Torna alla <a class=\"link\" href=\"index.php\">HOME</a></div>";
		exit;
	}
	?>
	<div>
		<button class="button" name="home_button" onclick="window.location.href='../index.php'">Home</button>
		<form action="../php/registration.php" method="POST">
		<input type="text" name="firstname" placeholder="Nome*" required>
		<br>
		<input type="text" name="lastname" placeholder="Cognome*" required>
		<br>
		<input type="email" name="email" placeholder="Email*" required>
		<br>
		<input type="password" name="pass" placeholder="Password*" required>
		<br>
		<input type="password" name="confirm" placeholder="Conferma Password*" required>
		<div id='error'></div>
		<input type="submit" value="Submit">
		</form>
		*Campi Obbligatori.
		<?php
		if(isset($_GET['err'])) {
			switch($_GET['err']) {
				case 1:
					echo "<script>document.getElementById('error').innerHTML = 'ERRORE! Si prega di compilare tutti i dati del form.'</script>";
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
					echo "<script>document.getElementById('error').innerHTML = 'ERRORE! Le password non corrispondono.'</script>";
					break;
				case 6:
					echo "<script>document.getElementById('error').innerHTML = 'ERRORE! Email già esistente.'</script>";
					break;
				default:
					break;
			}
		}
		?>
	</div>
</body>
</html>