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
<div id="bg">
	<div id="container"></div>
	
	<div id="button_bar">
		<span id="homeButton"><button class="button" id="home_button" onclick="window.location.href='../index.php'">Home</button></span>
		<span id="title">AMMINISTRA</span>
		<span id="addButton"></span>
		<span id="adminButton"></span>
	</div>
	<?php
	if (!isset($_GET['act'])) {
		echo "<script>document.getElementById(\"addButton\").innerHTML = '<button class=\"button\" id=\"add_button\" onclick=\"window.location.href=\'adminHTML.php?act=add\'\">Aggiungi Viaggio</button>'</script>";
		for ($i = 1; $i <= $numrows; $i++) {
			$row = mysqli_fetch_assoc($result);
			echo "	<div class=\"journey\">
						<div class=\"pic-container\">
							<img class=\"images\" src=\"../images/journeys/".$row['image']."\" alt=\"image\"\">
						</div>
						<div class=\"info-container1\">
							<b>Partenza:</b>  		<span class=\"infos\">".$row['departure']."</span><br>
							<b>Arrivo:</b>   		<span class=\"infos\">".$row['destination']."</span><br>
							<b>Data:</b>   			<span class=\"infos\">".$row['date']."</span><br>
							<b>Prezzo:</b>  		<span class=\"infos\">".$row['price']."€</span>
						</div>
						<div class=\"info-container2\">
							<b>Descrizione:</b>  	<span class=\"infos\">".$row['description']."</span><br>
							<b>Posti Tot:</b> 		<span class=\"infos\">".$row['totalseat']."</span><br>
							<b>Posti Disp:</b>		<span class=\"infos\">".$row['availableseat']."</span>
						</div>
						<div class=\"buttons-container\">
							<button id=\"edit\" onclick=\"window.location.href='adminHTML.php?act=edit&id=".$row['id']."'\">Modifica</button>
							<button id=\"delete\" class=\"button\" onclick=\"window.location.href='adminHTML.php?act=dlt&id=".$row['id']."'\">Elimina</button>
						</div>
					</div>";
		}
	}
	else if (isset($_GET['act'])) {
		echo "<script>document.getElementById(\"adminButton\").innerHTML = '<button class=\"button\" id=\"add_button\" onclick=\"window.location.href=\'adminHTML.php\'\">Torna Indietro</button>'</script>";
		if ($_GET['act']==='edit') {
			$row = mysqli_fetch_assoc($result);
			$datestring = substr($row['date'], 0, 10)."T".substr($row['date'], 11, 8);
			echo	"
				<div id=\"divform\">
					<form action=\"../php/admin.php?act=updt&id=".$row['id']."\" method=\"POST\">
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
					<input type=\"file\" name=\"image\" placeholder=\"Immagine\" value=\"".$row['image']."\">
					<br>
					*NON selezionare nessun file per non modificarlo.
					<br>
					<input type=\"submit\" value=\"Modifica\">
					</form>
				</div>";
		}
		if ($_GET['act']==='add') {
			echo	"
				<div id=\"divform\">
					<form action=\"../php/admin.php?act=addnew\" method=\"POST\">
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
					<input type=\"file\" name=\"image\" placeholder=\"Immagine\" required>
					<br>
					<input type=\"submit\" value=\"Aggiungi Viaggio\">
					</form>
				</div>";
		}
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