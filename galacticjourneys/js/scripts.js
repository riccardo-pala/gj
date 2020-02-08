function showPassword() {
  var x = document.getElementById("passwordField");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function plusSlides(n) {
	clearInterval(clock);
	slideIndex += (n-1);
	var clock = showSlides(showSlides, 5000);
}
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