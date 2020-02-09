<?php
session_start();
require_once('../php/search.php');
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
	<title>Ricerca - Galactic Journeys</title>
</head>

<body>
	<div class="form">
		<form action="searchHTML.php" method="GET">
			<input type="text" name="search" placeholder="Cerca..."><br>
			<input type="submit" value="Cerca">
		</form>
	</form>	
</body> 
</html>

<?php
	
if (isset($_GET['search']))	{
	if (!isset($_SESSION['results']))
		echo "La ricerca non ha prodotto risultati.";
	else {
		$results = $_SESSION['results'];
		foreach ($results as $result)
			echo $result."<br>";
	}
}
?>