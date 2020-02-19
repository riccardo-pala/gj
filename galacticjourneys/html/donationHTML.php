<?php
session_start();

if (isset($_GET['err']) && $_GET['err'] == 7) {
echo "Errore di connessione al server. Torna alla <a class=\"link\" href=\"../index.php\">HOME</a>"; 
exit;
}
if ((isset($_GET['err']) && $_GET['err'] == 8)) {
	echo "Errore fatale.";
	exit;
}

if (isset($_GET['sd']) && $_GET['sd'] == 1) {
	echo "<script>window.alert('La transazione è avvenuta con successo.\\nGrazie per la tua donazione!')</script>";
}

require_once('../php/donation.php');

$progr_percent = ($progress*100)/10000000;

if ($progr_percent>100)
	$progr_percent = 100;

?>


<!doctype html>
<html>
	
<head>
<meta name="author" content="J&R inc.">
	<meta name="description" content="Scopri il viaggio interstellare dei tuoi sogni">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8"> 
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Play'> 
	<link rel='stylesheet' type='text/css' href='../css/donationHTML.css'>
	<link rel='stylesheet' type='text/css' href='../css/standards.css'>
	<script src="../js/scripts.js" type="text/javascript"></script>
	<title>Donazioni - Galactic Journeys</title>
</head>

<body>
	
	<div id="bg">
		
		<div id="container"></div>

		<div id="button_bar">
			<button id="home_button" onclick="window.location.href='../index.php'">Home</button>	
			<span id="title">DONAZIONI</span>
		</div>
		
		<div class="progress-bar-wrapper">
  		<div class="progress-bar-label">
			<span class="sr-only">Progresso <?php echo $progr_percent ?>%</span>
			<span class="max">Obiettivo 10M€</span>
		</div>
  		<div class="progress">
    	<div class="progress-bar" role="progressbar" style="width: <?php echo $progr_percent ?>%" aria-valuenow="<?php echo $progress ?>" aria-valuemin="0" aria-valuemax="10000000"></div>
  		</div>
		</div>
		
		<div class="form">
			<div id="text">Contribuisci al nostro miglioramento</div>
			<form action="donationHTML.php?act=dnt" method="POST" name="Form">
				<input type="number" value="100" step="100" min="100" max="1000000" name="amount"><span id="euro">(€)</span><br>
				<input type="submit" value="Dona"><br>
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