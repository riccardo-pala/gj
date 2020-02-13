<?php
session_start();

if (empty($_SESSION['isLogged']) || !($_SESSION['isLogged']) || !($_SESSION['isAdmin'])) {
	echo "Non hai i permessi necessari per visualizzare questa pagina. Torna alla <a class=\"link\" href=\"../index.php\">HOME</a>";
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

require_once('../php/admin.php');
?>

<!doctype html>
<html>
<head>
	<meta name="author" content="J&R inc.">
	<meta name="description" content="Scopri il viaggio interstellare dei tuoi sogni">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Play'>
	<link rel='stylesheet' type='text/css' href='../css/adminHTML.css'>
	<link rel='stylesheet' type='text/css' href='../css/standards.css'>
	<script src="../js/scripts.js" type="text/javascript"></script>
	<title>Amministra - Galactic Journeys</title>
</head>

<body>
	<div id="button_bar">
		<span id="homeButton"><button class="button" id="home_button" onclick="window.location.href='../index.php'">Home</button></span>
		<span id="addButton"></span>
		<span id="adminButton"></span>
	</div>
	<?php
	if (!isset($_GET['act'])) {
		echo "<script>document.getElementById(\"addButton\").innerHTML = '<button class=\"button\" id=\"add_button\" onclick=\"window.location.href=\'adminHTML.php?act=add\'\">Aggiungi Viaggio</button>'</script>";
		for ($i = 1; $i <= $numrows; $i++) {
			$row = mysqli_fetch_assoc($result);
			echo "	<div class=\"journey\">
						<img class=\"images\" src=\"../images/card.jpg\" alt=\"image\" style=\"width:100px\">
						<div class=\"info-container\">
							<h4><b>
								Partenza: 		".$row['departure']."<br>
								Arrivo:  		".$row['destination']."<br>
							</b></h4>
							<p>
								Prezzo:  		".$row['price']."€<br>
								Data:  			".$row['date']."<br>
								Descrizione:  	".$row['description']."<br>
								Posti Tot:  	".$row['totalseat']."<br>
								Posti Disp:  	".$row['availableseat']."
							</p>
							<button class=\"button\" onclick=\"window.location.href='adminHTML.php?act=edit&id=".$row['id']."'\">Modifica</button>
							<button class=\"button\" onclick=\"window.location.href='adminHTML.php?act=dlt&id=".$row['id']."'\">Elimina</button>
						</div>
					</div>";
		}
	}
	else if (isset($_GET['act'])) {
		echo "<script>document.getElementById(\"adminButton\").innerHTML = '<button class=\"button\" id=\"add_button\" onclick=\"window.location.href=\'adminHTML.php\'\">Torna Indietro</button>'</script>";
		if ($_GET['act']==='edit') {
			$row = mysqli_fetch_assoc($result);
			$datestring = substr($row['date'], 0, 10)."T".substr($row['date'], 11, 8);
			echo	"<form action=\"../php/admin.php?act=updt&id=".$row['id']."\" method=\"POST\">
			
					<input type=\"text\" name=\"departure\" placeholder=\"Partenza\" value=\"".$row['departure']."\" required>
					<br>
					<input type=\"text\" name=\"destination\" placeholder=\"Arrivo\" value=\"".$row['destination']."\" required>
					<br>
					<input type=\"text\" name=\"price\" placeholder=\"Prezzo\" value=\"".$row['price']."\" required>
					<br>
					<input type=\"datetime-local\" name=\"date\" placeholder=\"Data\" value=\"".$datestring."\" required>
					<br>
					<textarea name=\"description\" id=\"description\" placeholder=\"Aggiungi una descrizione...\"required>".$row['description']."</textarea>
					<br>
					<input type=\"text\" name=\"totalseat\" placeholder=\"Posti Totali\" value=\"".$row['totalseat']."\" required>
					<br>
					<input type=\"text\" name=\"availableseat\" placeholder=\"Posti Disponibili\" value=\"".$row['availableseat']."\" required>
					<br>
					<input type=\"submit\" value=\"Modifica\">
					</form>";
		}
		if ($_GET['act']==='add') {
			echo	"<form action=\"../php/admin.php?act=addnew\" method=\"POST\">
			
					<input type=\"text\" name=\"departure\" placeholder=\"Partenza\" required>
					<br>
					<input type=\"text\" name=\"destination\" placeholder=\"Arrivo\" required>
					<br>
					<input type=\"text\" name=\"price\" placeholder=\"Prezzo\" required>
					<br>
					<input type=\"datetime-local\" name=\"date\" placeholder=\"Data\" required>
					<br>
					<textarea name=\"description\" id=\"description\" placeholder=\"Aggiungi una descrizione...\"required></textarea>
					<br>
					<input type=\"text\" name=\"totalseat\" placeholder=\"Posti Totali\" required>
					<br>
					<input type=\"text\" name=\"availableseat\" placeholder=\"Posti Disponibili\" required>
					<br>
					<input type=\"submit\" value=\"Aggiungi Viaggio\">
					</form>";
		}
	}
	?>
</body>
</html>