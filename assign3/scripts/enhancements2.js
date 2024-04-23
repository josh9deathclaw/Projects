//position of the slide
let slideIndex = 1;
//calls the function showSlides and gets its current position being 1
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
//increments the slideIndex by +1 or -1 each time it is pressed
  showSlides(slideIndex += n);
}

// navigating the slides
function currentSlide(n) {
//set the slideIndex to n to display the specified slide
  showSlides(slideIndex = n);
}
//controls the display of slides and the dots
function showSlides(n) {
  let i;
 //sets the slides and dots equal to the class in the html, this stores them
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
 //this loop makes sure when n is greater than the slides total (3 in this case, it goes back to 1)
  if (n > slides.length) {
	  slideIndex = 1
	}
 //checks if back button is pressed when on the first slide (n would be negative)
  if (n < 1) {
	  slideIndex = slides.length //sets slideIndex to be the last side
	}
 //hides all slides
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
 //iterates through all the dots in the dots array, 
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", ""); //when it goes to next slide, it resets the active state of all the dots before the one needed is set to be active again
  }
  slides[slideIndex-1].style.display = "block"; //displays the current slide
  dots[slideIndex-1].className += " active"; //this is where the dot is set to be active
  //giving me a Uncaught Type Error which I have not been able to fix yet
}