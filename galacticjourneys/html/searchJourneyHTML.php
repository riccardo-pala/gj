<?php
session_start();

if (isset($_GET['err']) && $_GET['err'] == 7) {
	echo "Errore di connessione al server. Torna alla <a class=\"link\" href=\"../index.php\">HOME</a>"; 
	exit;
}
if (isset($_GET['err']) && $_GET['err'] == 8) {
	echo "Errore fatale.";
	exit;
}
require_once('../php/search.php');
?>

<!doctype html>
<html>
<head>
<head>
	<meta name="author" content="J&R inc.">
	<meta name="description" content="Scopri il viaggio interstellare dei tuoi sogni">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8"> 
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Play'>
	<link rel='stylesheet' type='text/css' href='../css/searchJourneyHTML.css'>
	<link rel='stylesheet' type='text/css' href='../css/standards.css'>
	<script src="../js/scripts.js" type="text/javascript"></script>
	<title>Ricerca - Galactic Journeys</title>
</head>

<body>
	<div id="bg">
		<div id="container"></div>
		<div id="button_bar">
			<span id="homeButton"><button class="button" id="home_button" onclick="window.location.href='../index.php'">Home</button></span>
			<span id="title">RICERCA</span>
			<span id="backButton"></span>
		</div>
		
	
		<?php
		if (isset($_GET['search']) && isset($results))	{
			echo "<script>
				document.getElementById('backButton').innerHTML = '<button class=\"button\" id=\"back_button\" onclick=\"window.location.href=\'searchJourneyHTML.php\'\">Indietro</button>'
					</script>";
			for ($i = 1; $i <= $numrows; $i++) {
				$row = mysqli_fetch_assoc($results);
				echo "	<div class=\"journey\">
							<div class=\"pic-container\">
								<img class=\"images\" src=\"../images/".$row['image']."\" alt=\"image\"\">
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
							<div class=\"booking-container\">
							<form action=\"cartHTML.php?act=add\" method=\"POST\" id=\"bform\">
								<input type=\"hidden\" name=\"id\" value=\"".$row['id']."\">
								<button id=\"booking\" class=\"button\">Prenota</button>
							</form>
							</div>
						</div>";
			}
		}
		else {
			echo "
				<div id=\"search\">
					Seleziona la località e la data di partenza, la destinazione e scegli il tuo viaggio!
					<form action=\"searchJourneyHTML.php\" method=\"GET\" autocomplete=\"off\">
						<input type=\"hidden\" name=\"search\" value=1>
						<div id=\"departureField\">
							<input type=\"text\" name=\"departure\" placeholder=\"Partenza\" required id=\"departure\" onKeyUp=\"loadHint(this.value, this.id)\"><br>
							<div id=\"departureHints\"></div>
						</div>
						<div id=\"destinationField\">
							<input type=\"text\" name=\"destination\" placeholder=\"Destinazione\" required id=\"destination\" onKeyUp=\"loadHint(this.value, this.id)\"><br>
							<div id=\"destinationHints\"></div>
						</div>
						<input type=\"date\" name=\"date\" placeholder=\"\" required><br>
						<input type=\"submit\" id=\"search_submit\" value=\"Cerca\">
						<div id=\"err\"></div>
					</form>
				</div>
			";
			if (isset($_GET['search']) && !isset($results)) {
				echo "	<script>document.getElementById(\"err\").innerHTML =
							'La ricerca non ha prodotto risultati.'
						</script>";
			}
		}

		if (isset($_GET['err']) && $_GET['err']==1) {
			echo "	<script>document.getElementById(\"err\").innerHTML = 
						'Si prega di compilare almeno un campo del form.'
					</script>";
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