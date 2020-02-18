<?php
session_start();

if (!isset($_SESSION['isLogged']) || !$_SESSION['isLogged'] || !isset($_SESSION['email'])) {
	header ('Location: loginHTML.php');
	exit;
}
if (isset($_GET['err']) && $_GET['err'] == 7) {
	echo "Errore di connessione al server. Torna alla <a class=\"link\" href=\"../index.php\">HOME</a>"; 
	exit;
}
if (isset($_GET['err']) && $_GET['err'] == 8) {
	echo "Errore fatale.";
	exit;
}
require_once('../php/cart.php');
?>

<!doctype html>
<html>
<head>
	<meta name="author" content="J&R inc.">
	<meta name="description" content="Scopri il viaggio interstellare dei tuoi sogni">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8"> 
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Play'>
	<link rel='stylesheet' type='text/css' href='../css/cartHTML.css'>
	<link rel='stylesheet' type='text/css' href='../css/standards.css'>
	<script src="../js/scripts.js" type="text/javascript"></script>
	<title>Prenotazioni - Galactic Journeys</title>
</head>

<body>
<div id="bg">
	<div id="container"></div>
	
	<div id="button_bar">
		<span id="homeButton"><button class="button" id="home_button" onclick="window.location.href='../index.php'">Home</button></span>
	</div>
	
<?php
if (!isset($results) )
	echo "Non hai prenotazioni attive.";
else {
	$total = 0;
	for ($i = 1; $i <= $numrows; $i++) {
		$row = mysqli_fetch_assoc($results);
		echo "	<div class=\"journey\">
					<div class=\"pic-container\">
						<img class=\"images\" src=\"../images/".$row['image']."\" alt=\"image\">
					</div>
					<div class=\"info-container\">
						<b>Partenza:</b>  	<span class=\"infos\">".$row['departure']."</span><br>
						<b>Arrivo:</b>   	<span class=\"infos\">".$row['destination']."</span><br>
						<b>Data:</b>   		<span class=\"infos\">".$row['date']."</span><br>
						<b>Prezzo:</b>  	<span class=\"infos\">".$row['price']."€</span>
					</div>
					<div class=\"delete-container\">
						<button id=\"delete\" onclick=\"window.location.href='cartHTML.php?act=dlt&id=".$row['cartid']."'\">Rimuovi dal Carrello</button>
					</div>
				</div>";
		$total += $row['price'];
	}
	
	echo 	"<div id=\"total\"><b>TOTALE:</b> $total €<br>
			<button id=\"checkout\" onclick=\"window.location.href='cartHTML.php'\">Procedi con il Checkout</button></div>";
}
?>
	<footer>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		<br><br>
		© 2020-2020 GalacticJourneys. Tutti i diritti sono riservati.
	</footer>
</div>
</body>
</html>