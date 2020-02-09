<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Ricerca - Galactic Journeys</title>
</head>

<body>
	<div class="form">
		<form action="../php/search.php" method="GET">
			<input type="text" name="search" placeholder="Cerca..."><br>
			<input type="submit" value="Cerca">
		</form>
	</form>	
</body>
</html>

<?php
if(isset($_SESSION['results'])) {
	$results = $_SESSION['results'];
	if(mysqli_num_rows($results)==0)
		echo "La ricerca non ha prodotto risultati.";
	else {
		foreach ($results as $result)
			echo $result."\n";
	}
}
?>