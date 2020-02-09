<?php
session_start();

if (!isset($_SESSION['isLogged']) || !$_SESSION['isLogged'] && !isset($_SESSION['email'])) {
	header('Location: loginHTML.php');
	exit;
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
	<script src="../js/scripts.js" type="text/javascript"></script>
	<title>Modifica Password - Galactic Journeys</title>
</head>

<body>
	<div class="title">
		<button class="button" name="profile_button" onclick="window.location.href='show_profile.php'">Modifica Profilo</button>
		MODIFICA PASSWORD
		<button class="button" name="home_button" onclick="window.location.href='../index.php'">Home</button>			
	</div>
	<div class="form">
		<form action="../php/update_password.php" method="POST" name="Form">
			<input type="password" name="oldPassword" placeholder="Password Attuale" id="passwordField"  required>
			<input type="checkbox" onclick="showPassword()">Mostra Password<br>
			<input type="password" name="newPassword" placeholder="Nuova Password" required><br>
			<input type="password" name="newPassword2" placeholder="Conferma Nuova Password" required><br>
			<input type="submit" name="Modifica" value="MODIFICA"><br>
		</form>
		<div id='error'></div>
	</div>
	
	<?php
	if(isset($_GET['err']) && $_GET['err'] == 2)
		echo "<script>document.getElementById('error').innerHTML = 'Password attuale errata.'</script>";
	if(isset($_GET['err']) && $_GET['err'] == 3)
		echo "<script>document.getElementById('error').innerHTML = 'Si prega di inserire una password diversa da quella attuale.'</script>";
	if(isset($_GET['err']) && $_GET['err'] == 4)
		echo "<script>document.getElementById('error').innerHTML = 'Le nuove password NON corrispondono.'</script>";

	if (isset($_GET['succ']) && $_GET['succ'] == 1)
		echo "<script>window.alert('Modifiche effettuate con successo!');</script>";
	?>
	
</body>
</html>