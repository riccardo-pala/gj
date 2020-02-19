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
	<link rel='stylesheet' type='text/css' href='../css/passwordHTML.css'>
	<link rel='stylesheet' type='text/css' href='../css/standards.css'>
	<script src="../js/scripts.js" type="text/javascript"></script>
	<title>Modifica Password - Galactic Journeys</title>
</head>

<body>
	<div id="bg">
		
		<div id="container"></div>

		<div id="button_bar">
			<button  id="home_button" onclick="window.location.href='../index.php'">Home</button>	
			<span id="title">LOGIN</span>
			<button  id="profile_button" onclick="window.location.href='profileHTML.php'">Modifica Profilo</button>
		</div>
		<div class="form">
			<form action="../php/update_password.php" method="POST" name="Form">
				<input type="password" name="oldPassword" placeholder="Password Attuale" id="passwordField" required><br>
				<input type="checkbox" onclick="showPassword()">Mostra Password<br>
				<input type="password" name="newPassword" placeholder="Nuova Password" required><br>
				<input type="password" name="newPassword2" placeholder="Conferma Nuova Password" required><br>
				<input type="submit" name="Modifica" value="Modifica"><br>
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

		?>
		<footer>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			<br><br>
			© 2020-2020 GalacticJourneys. Tutti i diritti sono riservati.
		</footer>
	</div>
</body>
</html>