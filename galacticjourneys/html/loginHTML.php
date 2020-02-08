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
	<link rel='stylesheet' type='text/css' href=''>
	<script type='text/javascript' src='../js/scripts.js'></script>
	<title>Login - Galactic Journeys</title>
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
	<div class="title">
		<button class="button" name="home_button" onclick="window.location.href='../index.php'">Home</button>
		LOGIN
	</div>
	<div class="form">
		<form action="../php/login.php" method="POST">
			<input type="email" name="email" placeholder="Email" required>
			<br>
			<input type="password" name="pass" placeholder="Password" required>
			<div id='error' style='color:red'></div>
			<input type="submit" value="Conferma">
			<br>
		</form>
		Non possiedi un account? <a class="link" href="registrationHTML.php">REGISTRATI</a>
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
	</div>
</body>
</html>


