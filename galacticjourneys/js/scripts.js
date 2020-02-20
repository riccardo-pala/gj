function showPassword() {
  var x = document.getElementById("passwordField");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function plusSlides(n) {
	slideIndex += (n-1);
	showSlides();
	clock = setInterval(showSlides, 5000);
}
function currentSlide(n) {
	slideIndex = (n-1);
	showSlides();
	clock = setInterval(showSlides, 5000);
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

function loadHint(value, id, click) {
	if (value.length>0 && click==0) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById(id + "Hints").style.borderBottom = "solid #D035D0 1px";
				var response = this.responseText;
				document.getElementById(id + "Hints").innerHTML = response;
				if (response === "") {
					document.getElementById(id + "Hints").style.borderBottom = "0px";
				}
		   }
		};
		xhttp.open("GET", "../php/searchHint.php?search=" + value + "&id=" + id, true);
		xhttp.send();
	}
	else {
		document.getElementById(id + "Hints").innerHTML = '';
		document.getElementById(id + "Hints").style.borderBottom = "0px";
	}
}

function changeValue(id, value) {
	document.getElementById(id).value = value;
	loadHint(value, id, 1);
}