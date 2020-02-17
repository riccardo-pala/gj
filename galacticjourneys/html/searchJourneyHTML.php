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
require_once('../php/searchJourney.php');
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
	<script>
		function loadHint(value, id) {
			if (value.length>0) {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById(id + "Hints").innerHTML =
						this.responseText;
				   }
				};
				xhttp.open("GET", "../php/searchHint.php?search=" + value + "&id=" + id, true);
				xhttp.send();
			}
			else {
				document.getElementById(id + "Hints").innerHTML = '';
			}
		}
	</script>
	<title>Ricerca - Galactic Journeys</title>
</head>

<body>
	
	<div id="button_bar">
		<span id="homeButton"><button class="button" id="home_button" onclick="window.location.href='../index.php'">Home</button></span>
	</div>
	
	<div id="search">
		<form action="searchJourneyHTML.php" method="GET" autocomplete="off">
			<input type="hidden" name="search" value=1>
			<div id="departureField">
				<input type="text" name="departure" placeholder="Partenza" id="departure" onKeyUp="loadHint(this.value, this.id)"><br>
				<div id="departureHints"></div>
			</div>
			<div id="destinationField">
				<input type="text" name="destination" placeholder="Destinazione" id="destination" onKeyUp="loadHint(this.value, this.id)"><br>
				<div id="destinationHints"></div>
			</div>
			<input type="date" name="date" placeholder=""><br>
			<!--<input type="range" min="0" max="1000" name="price" placeholder="Prezzo"><br>-->
			<input type="submit" id="search_submit" value="Cerca">
			<div id="err" style="color:red"></div>
		</form>
	</div>
	
<?php
if (isset($_GET['err']) && $_GET['err']==1) {
	echo "	<script>document.getElementById(\"err\").innerHTML = 
				'Si prega di compilare almeno un campo del form.'
			</script>";
}
if (isset($_GET['search']))	{
	if (!isset($results) )
		echo "La ricerca non ha prodotto risultati.";
	else {
		for ($i = 1; $i <= $numrows; $i++) {
			$row = mysqli_fetch_assoc($results);
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
							<button class=\"button\" onclick=\"window.location.href='bookingHTML.php?id=".$row['id']."'\">Prenota</button>
						</div>
					</div>";
		}
	}
}
?>
</body>
</html>