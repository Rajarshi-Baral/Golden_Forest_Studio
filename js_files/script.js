// Smooth scroll to top function
function scrollToTop() {
    window.scrollTo({
        top: 0, // Scroll to the top of the page
        behavior: 'smooth' // Use smooth scrolling for better user experience
    });
}

// Add event listener after the DOM content is fully loaded
document.addEventListener('DOMContentLoaded', () => {
    // Select the element with the class "top"
    const topElement = document.querySelector('.top');

    // Attach the click event listener to the element
    topElement.addEventListener('click', scrollToTop);
});

// Preloader functionality
  var loader = document.getElementById("preloader");

  window. addEventListener ("load", function () {
  loader.style.display = "none"
  
  I})