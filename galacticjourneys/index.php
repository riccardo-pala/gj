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
	
	<!-- Slideshow container -->
	<div class="slideshow_container">
		<!-- Full-width images with number and caption text -->
		<div class="slides fade">
			<img class="slideshow_pics" src="images/ss2.jpg">
		</div>
		<div class="slides fade">
			<img class="slideshow_pics" src="images/ss1.jpg">
		</div>
		<div class="slides fade">
			<img class="slideshow_pics" src="images/ss3.jpg">
		</div>
		<div class="slides fade">
			<img class="slideshow_pics" src="images/ss4.jpg">
		</div>
		<div class="slides fade">
			<img class="slideshow_pics" src="images/ss5.jpg">
		</div>
		<div class="slides fade">
			<img class="slideshow_pics" src="images/ss6.jpg">
		</div>
		<div class="slides fade">
			<img class="slideshow_pics" src="images/ss7.jpg">
		</div>
		<!-- Next and previous buttons -->
		<a class="prev" onclick="clearInterval(clock); plusSlides(-1);">&#10094;</a>
		<a class="next" onclick="clearInterval(clock); plusSlides(1);">&#10095;</a>
		
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
	</div>
	
	<div id="button_bar">
		<span id="homeButton"><button class="button" name="home_button" style="border-right: solid #FF3F00 1px" onclick="window.location.href='index.php'">Home</button></span>
		<span id="regButton"></span>
		<span id="logButton"></span>
		<span id="logoutButton"></span>
		<span id="profButton"></span>
		<span id="adminButton"></span>
		
		<?php
		if(isset( $_GET['logf']) && $_GET['logf']) {
			echo "	<form action=\"php/login.php\" method=\"POST\" id=\"loginForm\">
						<span><button type=\"button\" class=\"button\" id=\"back\" onclick=\"location.href='index.php?logf=0'\">
						<</button></span>
						<span><input type=\"email\" id=\"emailField\" placeholder=\"Email\" name=\"email\" value=\"\" required></span>
						<span><input type=\"password\" id=\"passField\" placeholder=\"Password\" name=\"pass\" value=\"\" required></span>
						<span><input type=\"submit\" id=\"loginField\" value=\">\"></span>
					</form>";
		}
		?>
	</div>
	
	<?php
		if ((empty($_SESSION['isLogged']) || $_SESSION['isLogged']==false) && (empty($_GET['logf']) || !$_GET['logf'])) {
			echo "	<script>document.getElementById(\"regButton\").innerHTML = 
						'<button class=\"button\" name=\"reg_button\" style=\"border-right: solid #FF3F00 1px\" onclick=\"window.location.href=\'html/registrationHTML.php\'\">Registrati</button>'
					</script>";
			echo "	<script>document.getElementById(\"logButton\").innerHTML = 
						'<button class=\"button\" name=\"log_button\" onclick=\"window.location.href=\'index.php?logf=true\'\">Login</button>'
					</script>";
		}
		else if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']===true) {
			echo "	<script>document.getElementById(\"profButton\").innerHTML = 
			'<button class=\"profileButton\" name=\"prof_button\" onclick=\"window.location.href=\'#\'\">Profilo</button><ul><li><button class=\"button\" name=\"modProfile_button\" onclick=\"window.location.href=\'index.php\'\">Modifica Profilo</button></li><li><button class=\"button\" name=\"_button\" onclick=\"window.location.href=\'index.php\'\">LoremIpsum</button></li><div id=\"adminButton\"></div><li><button class=\"button\" name=\"logout_button\" onclick=\"window.location.href=\'index.php\'\">Logout</button></li></ul>';
					</script>";
			/*echo "	<script>document.getElementById(\"logoutButton\").innerHTML = 
						'<button class=\"button\" name=\"logout_button\" style=\"border-right: solid #FF3F00 1px\" onclick=\"window.location.href=\'php/logout.php\'\">Logout</button>'
					</script>"; */
			if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
				echo "	<script>document.getElementById(\"adminButton\").innerHTML = 
						'<button class=\"button\" name=\"admin_button\" style=\"border-right: solid #FF3F00 1px\" onclick=\"window.location.href=\'html/adminHTML.php\'\">Amministra</button>'
					</script>";
			}
		}
	?>
	
	<div id="welcome">
		Scopri il viaggio interstellare dei tuoi sogni
	</div>
	
	<div id="search">
		<form action="html/searchHTML.php" method="GET">
			<input type="search" name="search" placeholder="Cerca nel sito..."><br>
			<input type="submit" id="search_submit" value="Cerca">
		</form>
	</div>
	
	<div id="option">
		<button class="button" id="op_button" onclick="window.location.href='index.php'">Lorem ipsum</button><br>
		<button class="button" id="op_button" onclick="window.location.href='index.php'">Lorem ipsum</button><br>
		<button class="button" id="op_button" onclick="window.location.href='index.php'">Lorem ipsum</button>
	</div>
	
	<script>
		showSlides();
		clock = setInterval(showSlides, 5000);
	</script>
	
</body>

</html>