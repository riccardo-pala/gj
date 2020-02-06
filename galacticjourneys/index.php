<?php
session_start();
if (isset($_GET['sl']) && isset($_SESSION['firstname'])) {
	$name = $_SESSION['firstname'];
	if($_GET['sl']==1)
		echo "<script>window.alert('Benvenuto $name!')</script>";
	else if($_GET['sl']==0)
		echo "<script>window.alert('ERRORE! Sei già loggato come $name!')</script>";
}
?>

<!doctype html>
<html>

<head>
	<meta name="author" content="J&R inc.">
	<meta name="description" content="Scopri il viaggio interstellare dei tuoi sogni">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="300">
	<meta charset="utf-8">
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Play'> 
	<link rel='stylesheet' type='text/css' href='css/index.css'>
	<script type='text/javascript' src='js/scripts.js'></script>
	<title>Home - Galactic Journeys</title>
</head>

<body>
	<button class="button" name="home_button" onclick="window.location.href='index.php'">Home</button>
	<button class="button" name="reg_button" onclick="window.location.href='html/registrationHTML.php'">Registrati</button>
	<button class="button" name="login_button" onclick="window.location.href='html/loginHTML.php'">Login</button>
	<button class="button" name="profile_button" onclick="window.location.href='html/show_profile.php'">Visualizza Profilo</button>
	
	<div class="slideshow-container">

	<div class="slide fade">
		<div class="numbertext">1 / 3</div>
		<img src="images/ss1.jpg" id="slidePic">
		<div class="text">Caption Text</div>
	</div>

	<div class="slide fade">
		<div class="numbertext">2 / 3</div>
		<img src="images/ss2.jpg" id="slidePic">
		<div class="text">Caption Two</div>
	</div>

	<div class="slide fade">
		<div class="numbertext">3 / 3</div>
		<img src="images/ss3.jpg" id="slidePic">
		<div class="text">Caption Three</div>
	</div>

	<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
	<a class="next" onclick="plusSlides(1)">&#10095;</a>

	</div>
	<br>

	<div style="text-align:center">
	  <span class="dot" onclick="currentSlide(1)"></span> 
	  <span class="dot" onclick="currentSlide(2)"></span> 
	  <span class="dot" onclick="currentSlide(3)"></span> 
	</div>
	<script>
		var slideIndex = 1;
		showSlides(slideIndex);
		
		function plusSlides(n) {
			showSlides(slideIndex += n);
		}

		function currentSlide(n) {
			showSlides(slideIndex = n);
		}

		function showSlides(n) {
			var i;
			var slides = document.getElementsByClassName("slides");
			var dots = document.getElementsByClassName("dot");
			if (n > slides.length) {slideIndex = 1}    
			if (n < 1) {slideIndex = slides.length}
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