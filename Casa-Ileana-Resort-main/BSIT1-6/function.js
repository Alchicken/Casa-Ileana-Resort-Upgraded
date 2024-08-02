const spinnerWrapperEl = document.querySelector(".spinner-wrapper");
const contentEl = document.getElementById("content");

window.addEventListener('load', () => {
    spinnerWrapperEl.style.opacity = '0';

    setTimeout(() => {
        spinnerWrapperEl.classList.add('hidden');
        contentEl.style.display = 'block';
        spinnerWrapperEl.style.display = 'none';
    }, 200);

    window.scrollTo(0, 0);
    window.location.hash = "#home";
    
});

var prevScrollPos = window.scrollY;
var navbar = document.getElementById('navbar');

window.addEventListener('scroll', function() {
  var currentScrollPos = window.scrollY;

  if (prevScrollPos > currentScrollPos) {
    // Scrolling up
    navbar.style.display = 'block'; // Show the navbar
  } else {
    // Scrolling down
    navbar.style.display = 'none'; // Hide the navbar
  }

  prevScrollPos = currentScrollPos;
});