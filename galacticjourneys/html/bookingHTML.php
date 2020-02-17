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
require_once('../php/booking.php');
?>

<!doctype html>
<html>
<head>
	<meta name="author" content="J&R inc.">
	<meta name="description" content="Scopri il viaggio interstellare dei tuoi sogni">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8"> 
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Play'>
	<link rel='stylesheet' type='text/css' href='../css/bookingHTML.css'>
	<link rel='stylesheet' type='text/css' href='../css/standards.css'>
	<script src="../js/scripts.js" type="text/javascript"></script>
	<title>Prenotazioni - Galactic Journeys</title>
</head>

<body>
	
<?php
if (!isset($results) )
	echo "Non hai prenotazioni attive.";
else {
	for ($i = 1; $i <= $numrows; $i++) {
		$row = mysqli_fetch_assoc($results);
		echo "	<div class=\"journey\">
					<div class=\"pic-container\">
						<img class=\"images\" src=\"../images/card.jpg\" alt=\"image\">
					</div>
					<div class=\"info-container\">
						Partenza: 		".$row['departure']."<br>
						Arrivo:  		".$row['destination']."<br>
						Data:  			".$row['date']."
					</div>
				</div>";
	}
}
?>
</body>
</html>