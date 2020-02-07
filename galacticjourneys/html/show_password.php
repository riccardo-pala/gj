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
	<meta charset="utf-8">
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Play'> 
	<link rel='stylesheet' type='text/css' href=''>
	<script type='text/javascript' src='../js/scripts.js'></script>
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
			<input type="password" required name="oldPassword" placeholder="Password Attuale" required><br>
			<input type="password" required name="newPassword" placeholder="Nuova Password" required><br>
			<input type="password" required name="newPassword2" placeholder="Conferma Nuova Password" required><br>
			<input type="submit" name="Modifica" value="MODIFICA"><br>
		</form>
		<div id='error'></div>
	</div>
	
	<?php
	if(isset($_GET['err']) && $_GET['err'] == 2)
		echo "<script>document.getElementById('error').innerHTML = 'Password attuale errata.'</script>";

	if(isset($_GET['err']) && $_GET['err'] == 3)
		echo "<script>document.getElementById('error').innerHTML = 'Le nuove password NON corrispondono.'</script>";

	if (isset($_GET['succ']) && $_GET['succ'] == 1)
		echo "<script>window.alert('Modifiche effettuate con successo!');</script>";
	?>
	
</body>
</html>