<!doctype html>
<html>
<head>
	<meta name="author" content="J&R inc.">
	<meta name="description" content="Scopri il viaggio interstellare dei tuoi sogni">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Play'> 
	<link rel='stylesheet' type='text/css' href=''>
	<script type='text/javascript' src='../js/scripts.js'></script>
	<title>Registrati! - Galactic Journeys</title>
</head>

<body>
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