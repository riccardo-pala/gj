<?php
session_start();
if (isset($_GET['sl'])) {
	if($_GET['sl']==1 && isset($_SESSION['firstname'])) {
		$name = $_SESSION['firstname'];
		echo "<script>window.alert('Benvenuto/a $name!')</script>";
	}
	else if($_GET['sl']==0) {
		if(isset($_SESSION['email'])){
			$email = " come ".$_SESSION['email'];
		}
		else {
			$email = '';
		}
		echo "<script>window.alert('ERRORE! Risulti già loggato$email.')</script>";
	}
}
?>

<!doctype html>
<html>

<head>
	<meta name="author" content="J&R inc.">
	<meta name="description" content="Scopri il viaggio interstellare dei tuoi sogni">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Play'> 
	<link rel='stylesheet' type='text/css' href='css/index.css'>
	<script>
		var slideIndex = 0;
		var clock;
	</script>
	<script src="js/scripts.js" type="text/javascript"></script>
	<title>Home - Galactic Journeys</title>
</head>

<body>
	<div id="button_bar">
		<span id="homeButton"><button class="button" name="home_button" style="border-right: solid #FF3F00 2px" onclick="window.location.href='index.php'">Home</button></span>
		<span id="regButton"></span>
		<span id="logButton"></span>
		<span id="logoutButton"></span>
		<span id="profButton"></span>
	</div>
	<?php
		if (empty($_SESSION['isLogged']) || $_SESSION['isLogged']==false) {
			echo "	<script>document.getElementById(\"regButton\").innerHTML = 
						'<button class=\"button\" name=\"reg_button\" style=\"border-right: solid #FF3F00 2px\" onclick=\"window.location.href=\'html/registrationHTML.php\'\">Registrati</button>'
					</script>";
			echo "	<script>document.getElementById(\"logButton\").innerHTML = 
						'<button class=\"button\" name=\"log_button\" onclick=\"window.location.href=\'html/loginHTML.php\'\">Login</button>'
					</script>";
		}
		else if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']===true) {
			echo "	<script>document.getElementById(\"profButton\").innerHTML =
						'<button class=\"button\" name=\"prof_button\" onclick=\"window.location.href=\'html/profileHTML.php\'\">Visualizza Profilo</button>'
					</script>";
			echo "	<script>document.getElementById(\"logoutButton\").innerHTML = 
						'<button class=\"button\" name=\"logout_button\" style=\"border-right: solid #FF3F00 2px\" onclick=\"window.location.href=\'php/logout.php\'\">Logout</button>'
					</script>";
		}
	?>
	
	<!-- Slideshow container -->
	<div class="slideshow_container">
		<!-- Full-width images with number and caption text -->
		<div class="slides fade">
			<div class="numbertext">1 / 7</div>
			<img class="slideshow_pics" src="images/ss1.jpg">
		</div>
		<div class="slides fade">
			<div class="numbertext">2 / 7</div>
			<img class="slideshow_pics" src="images/ss2.jpg">
		</div>
		<div class="slides fade">
			<div class="numbertext">3 / 7</div>
			<img class="slideshow_pics" src="images/ss3.jpg">
		</div>
		<div class="slides fade">
			<div class="numbertext">4 / 7</div>
			<img class="slideshow_pics" src="images/ss4.jpg">
		</div>
		<div class="slides fade">
			<div class="numbertext">5 / 7</div>
			<img class="slideshow_pics" src="images/ss5.jpg">
		</div>
		<div class="slides fade">
			<div class="numbertext">6 / 7</div>
			<img class="slideshow_pics" src="images/ss6.jpg">
		</div>
		<div class="slides fade">
			<div class="numbertext">7 / 7</div>
			<img class="slideshow_pics" src="images/ss7.jpg">
		</div>
		<!-- Next and previous buttons -->
		<a class="prev" onclick="clearInterval(clock); plusSlides(-1);">&#10094;</a>
		<a class="next" onclick="clearInterval(clock); plusSlides(1);">&#10095;</a>
	</div>
	<!-- The dots/circles -->
	<div class="dots-container">
		<span class="dot" onclick="clearInterval(clock); currentSlide(1);"></span>
		<span class="dot" onclick="clearInterval(clock); currentSlide(2);"></span>
		<span class="dot" onclick="clearInterval(clock); currentSlide(3);"></span>
		<span class="dot" onclick="clearInterval(clock); currentSlide(4);"></span>
		<span class="dot" onclick="clearInterval(clock); currentSlide(5);"></span>
		<span class="dot" onclick="clearInterval(clock); currentSlide(6);"></span>
		<span class="dot" onclick="clearInterval(clock); currentSlide(7);"></span>
	</div>
	
	<script>
		showSlides();
		clock = setInterval(showSlides, 5000);
	</script>
	
</body>

</html>