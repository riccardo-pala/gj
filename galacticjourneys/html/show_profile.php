<?php
if (isset($_GET['err']) && $_GET['err'] == 7) {
	echo "Errore di connessione al server. Torna alla <a class=\"link\" href=\"index.php\">HOME</a>"; 
	exit;
}
if (isset($_GET['err']) && $_GET['err'] == 8) {
	echo "Errore fatale. Contattare l'amministratore del sito.";
	exit;
}

require_once('../php/show_profile.php');

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="author" content="J&R inc.">
	<meta name="description" content="Scopri il viaggio interstellare dei tuoi sogni">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8"> 
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Play'> 
	<link rel='stylesheet' type='text/css' href='../css/profileHTML.css'>
	<link rel='stylesheet' type='text/css' href='../css/standards.css'>
	<script src="../js/scripts.js" type="text/javascript"></script>
	<title>Modifica Profilo - Galactic Journeys</title>
</head>

<body>
	<div id="bg">
		<div id="container"></div>
	
	<div id="button_bar">
		<button id="home_button" onclick="window.location.href='../index.php'">Home</button>
		<span id="title">MODIFICA PROFILO</span>
		<button id="mod_button" onclick="window.location.href='passwordHTML.php'">Modifica Password</button>
	</div>

	<div class="form">
		<form action="../php/update_profile.php" method="POST" name="Form">
			<input type="text" name="firstname" placeholder="Nome" value="<?php echo $firstname; ?>" required><br>
			<input type="text" name="lastname" placeholder="Cognome" value="<?php echo $lastname; ?>" required><br>
			<input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required><br>
			<input type="submit" value="Modifica">
		</form>
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
		<footer>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			<br><br>
			© 2020-2020 GalacticJourneys. Tutti i diritti sono riservati.
		</footer>
	</div>
	
</body>
</html>
