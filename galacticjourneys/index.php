<?php
session_start();
if (isset($_GET['sl'])) {
	if($_GET['sl']==1 && isset($_SESSION['firstname'])) {
		$name = $_SESSION['firstname'];
		echo "<script>window.alert('Benvenuto $name!')</script>";
	}
	else if($_GET['sl']==0 && isset($_SESSION['email'])) {
		$email = $_SESSION['email'];
		echo "<script>window.alert('ERRORE! Sei già loggato come $email!')</script>";
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
	<script type='text/javascript' src='js/scripts.js'></script>
	<title>Home - Galactic Journeys</title>
</head>

<body>
	<div id="button_bar">
		<span id='homeButton'><button class="button" name="home_button" onclick="window.location.href='index.php'">Home</button></span>
		<span id='regButton'></span>
		<span id='logButton'></span>
		<span id='profButton'></span>
	</div>
	<?php
		if (empty($_SESSION['isLogged']) || $_SESSION['isLogged']==false) {
			echo "	<script>document.getElementById(\"regButton\").innerHTML = 
						'<button class=\"button\" name=\"reg_button\" onclick=\"window.location.href=\'html/registrationHTML.php\'\">Registrati</button>'
					</script>";
			echo "	<script>document.getElementById(\"logButton\").innerHTML = 
						'<button class=\"button\" name=\"log_button\" onclick=\"window.location.href=\'html/loginHTML.php\'\">Login</button>'
					</script>";
		}
		else if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']===true) {
			echo "	<script>document.getElementById(\"profButton\").innerHTML =
						'<button class=\"button\" name=\"prof_button\" onclick=\"window.location.href=\'html/show_profile.php\'\">Visualizza Profilo</button>'
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
		<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
		<a class="next" onclick="plusSlides(1)">&#10095;</a>
	</div>
	<!-- The dots/circles -->
	<div class="dots-container">
		<span class="dot" onclick="currentSlide(1)"></span>
		<span class="dot" onclick="currentSlide(2)"></span>
		<span class="dot" onclick="currentSlide(3)"></span>
		<span class="dot" onclick="currentSlide(4)"></span>
		<span class="dot" onclick="currentSlide(5)"></span>
		<span class="dot" onclick="currentSlide(6)"></span>
		<span class="dot" onclick="currentSlide(7)"></span>
	</div>
	
	<script>
		var slideIndex = 0;
		showSlides();
		var clock = setInterval(showSlides, 5000);

		// Next/previous controls
		function plusSlides(n) {
			clearInterval(clock);
			slideIndex += (n-1);
			var clock = showSlides(showSlides, 5000);
		}
		// Thumbnail image controls
		function currentSlide(n) {
			clearInterval(clock);
			slideIndex = (n-1);
			var clock = showSlides(showSlides, 5000);
		}
		function showSlides() {
			slideIndex += 1;
			var i;
			var slides = document.getElementsByClassName("slides");
			var dots = document.getElementsByClassName("dot");
			if (slideIndex > slides.length) {slideIndex = 1}
			if (slideIndex < 1) {slideIndex = slides.length}
			for (i = 0; i < slides.length; i++) {
				slides[i].style.display = "none";
			}
			for (i = 0; i < dots.length; i++) {
				dots[i].className = dots[i].className.replace(" active", "");
			}
			slides[slideIndex-1].style.display = "block";
			dots[slideIndex-1].className += " active";
		}
	</script>
	
</body>

</html>