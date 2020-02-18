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
	<link rel='stylesheet' type='text/css' href=''>
	<script src="../js/scripts.js" type="text/javascript"></script>
	<title>Modifica Profilo - Galactic Journeys</title>
</head>

<body>

	<div class="title">
		<button class="button" name="home_button" onclick="window.location.href='../index.php'">Home</button>
		LOGIN
	</div>

	<div class="form">
		<form action="../php/update_profile.php" method="POST" name="Form">
			<input type="text" name="firstname" placeholder="Nome" value="<?php echo $firstname; ?>" requi#D035D0><br>
			<input type="text" name="lastname" placeholder="Cognome" value="<?php echo $lastname; ?>" requi#D035D0><br>
			<input type="email" requi#D035D0 name="email" placeholder="Email" value="<?php echo $email; ?>" requi#D035D0><br>
			<input type="submit" value="Modifica">
		</form>
			<button class="button" name="mod_button" onclick="window.location.href='passwordHTML.php'">Modifica Password</button>
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
