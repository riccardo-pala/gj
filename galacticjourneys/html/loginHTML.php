<?php
session_start();

if(isset($_GET['sr']) && $_GET['sr']==1) {
	echo "<script>window.alert('Registrazione avvenuta con successo.')</script>";
}
if (isset($_GET['err']) && $_GET['err'] == 7) {
	echo "Errore di connessione al server. Torna alla <a class=\"link\" href=\"index.php\">HOME</a>"; 
	exit;
}
if (isset($_GET['err']) && $_GET['err'] == 8) {
	echo "Errore fatale. Contattare l'amministratore del sito.";
	exit;
}
?>

<!DOCTYPE html>

<html> 
<head>
	<meta name="author" content="J&R inc.">
	<meta name="description" content="Scopri il viaggio interstellare dei tuoi sogni">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8"> 
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Play'> 
	<link rel='stylesheet' type='text/css' href='../css/loginHTML.css'>
		<link rel='stylesheet' type='text/css' href='../css/standards.css'>
	<script src="../js/scripts.js" type="text/javascript"></script>
	<title>Login - Galactic Journeys</title>
</head>

<body>
	<div id="bg">
		<div id="container"></div>
			<?php
			if(isset($_SESSION['isLogged']) && $_SESSION['isLogged']) {
				if(isset($_SESSION['email'])){
					$email = " come ".$_SESSION['email'];
				}
				else {
					$email = '';
				}
				echo "<div style='color:#D035D0'>ERRORE! Risulti già loggato$email. Torna alla <a class=\"link\" href=\"index.php\">HOME</a></div>";
				exit;
			}
			?>
			<div id="button_bar">
				<span id="homeButton"><button class="button" id="home_button" onclick="window.location.href='../index.php'">Home</button></span>
				<!-- <span id="title">LOGIN</span> -->
			</div>
			<div class="form">
				<form action="../php/login.php" method="POST">
					<input type="email" name="email" placeholder="Email" required>
					<br>
					<input type="password" name="pass" placeholder="Password" id="passwordField" required>
					<br>
					<input type="checkbox" onclick="showPassword()">Mostra Password
					<br>
					<input id="submitButton" type="submit" value="Conferma">
					<div id='error'></div>
					<br>
					Non possiedi un account? <a class="link" href="registrationHTML.php"><u>REGISTRATI</u></a>
				</form>
			</div>
			<footer>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			<br><br>
			© 2020-2020 GalacticJourneys. Tutti i diritti sono riservati.
			</footer>
	</div>
</body>
</html>

<?php
	if(isset($_GET['err'])){
		switch ($_GET['err']) {
			case 1: {
				echo "<script>document.getElementById('error').innerHTML = 'Si prega di compilare tutti i campi del form.'</script>";
				break;
			}
			case 2: {
				echo "<script>document.getElementById('error').innerHTML = 'Email o Password errati.'</script>";
				break;
			}
			case 7: {
				echo "<script>document.getElementById('error').innerHTML = 'Errore di connessione al server. Riprova.'</script>";
				break;
			}
			case 8: {
				echo "<script>document.getElementById('error').innerHTML = 'Errore fatale. Contattare l\'amministratore del sito.'</script>";
				break;
			}
			default:
				break;
		}
	}
?>


