<?php
	session_start();
	if(isset($_GET['sr']) && $_GET['sr']==1) {
		echo "<script>window.alert('Registrazione avvenuta con successo.')</script>";
	}
	if(isset($_SESSION['isLogged']) && $_SESSION['isLogged']) {
		$email = $_SESSION['email'];
		echo "<div id='alreadyLogged'>ERRORE! Sei già loggato come $email.</div>";
	}
?>

<!DOCTYPE html>

<html> 
<head>
	<meta name="author" content="J&R inc.">
	<meta name="description" content="Scopri il viaggio interstellare dei tuoi sogni">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="30">
	<meta charset="utf-8"> 
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Play'> 
	<link rel='stylesheet' type='text/css' href=''>
	<script type='text/javascript' src='../js/scripts.js'></script>
	<title>Login - Galactic Journeys</title>
</head>

<body>
	<div class="title">
		<button class="button" name="home_button" onclick="window.location.href='../index.php'">Home</button>
		LOGIN
	</div>
	<div class="form">
		<form action="../php/login.php" method="POST">
			<input type="text" name="email" placeholder="Email" required>
			<br>
			<input type="password" name="pass" placeholder="Password" required>
			<div id='error'></div>
			<input type="submit" value="Conferma">
			<br>
		</form>
		Non possiedi un account? <a class="link" href="registrationHTML.php">REGISTRATI</a>
		<?php
			if(isset($_GET['fl'])){
				switch ($_GET['fl']) {
					case 1: {
						echo "<script>document.getElementById('error').innerHTML = 'Si prega di compilare tutti i campi del form.'</script>";
						break;
					}
					case 2: {
						echo "<script>document.getElementById('error').innerHTML = 'Email o Password errati.'</script>";
						break;
					}
					case 3: {
						echo "<script>document.getElementById('error').innerHTML = 'Errore di connessione al server. Riprova.'</script>";
						break;
					}
					case 4: {
						echo "<script>document.getElementById('error').innerHTML = 'Errore fatale. Contattare l\'amministratore del sito.'</script>";
						break;
					}
					default:
						break;
				}
			}
		?>
	</div>
</body>
</html>


