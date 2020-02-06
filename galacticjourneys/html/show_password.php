<?php
session_start();
if (!isset($_SESSION['isLogged']) || !$_SESSION['isLogged'] && !isset($_SESSION['email'])) {
	header('Location: loginHTML.php');
	exit;
}	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Play'> 
	<link rel='stylesheet' type='text/css' href=''>
	<script type='text/javascript' src='../js/scripts.js'></script>
	<title>Modifica Password - Galactic Journeys</title>
</head>

<body>
	<div class="title">
		<button class="button" name="profile_button" onclick="window.location.href='show_profile.php'">Modifica Profilo</button>
		MODIFICA PASSWORD
		<button class="button" name="home_button" onclick="window.location.href='../index.php'">Home</button>			
	</div>
	<div class="form">
		<form action="update_password.php" method="POST" name="Form">
			<input type="password" required name="oldPass" placeholder="Password Attuale"><br>
			<input type="password" required name="newPass" placeholder="Nuova Password"><br>
			<input type="password" required name="newPassAgain" placeholder="Conferma Nuova Password"><br>
			<input type="submit" name="Modifica" value="MODIFICA"><br>
		</form>
		
		<?php //TODO: controllare
			if(isset($_GET["err"])) {				
				if($_GET["err"] == "ol") {
						echo "
								<div class=\"messaggio\" >
									Password attuale errata.
								</div>
							";
				}
				else if($_GET["err"] == "ne") {
					echo "
							<div class=\"messaggio\" >
								Le Password non coincidono.
							</div>
						";
				}

				unset($_GET["err"]);
			}
		?>
	</div>
	
</body>
</html>