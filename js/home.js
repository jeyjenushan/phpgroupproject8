const homeSection = document.querySelector('.home');
const backgrounds = [
    "url('../images/home1.jpg')",
    "url('../images/home2.jpg')",
    "url('../images/home3.jpg')"
];
let currentIndex = 0;

function changeBackground() {
    currentIndex = (currentIndex + 1) % backgrounds.length; // Loop through backgrounds
    homeSection.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.2)), ${backgrounds[currentIndex]}`;
}

// Change the background every 10 seconds
setInterval(changeBackground, 10000);
