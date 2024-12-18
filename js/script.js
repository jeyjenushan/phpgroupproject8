let userBox=document.querySelector(".header .header-2 .user-box");
let navbar=document.querySelector(".header .header-2 .navbar")

document.querySelector("#user-btn").onclick=()=>{
userBox.classList.toggle('active')
navbar.classList.remove('active')

}
document.querySelector("#menu-btn").onclick=()=>{
navbar.classList.toggle('active')
userBox.classList.remove('active')
}
window.onscroll=()=>{
    userBox.classList.remove('active')
    navbar.classList.remove('active')
    if(window.scrollY>60){
        document.querySelector('.header .header-2').classList.add('active');
    }else{
        document.querySelector('.header .header-2').classList.remove('active');
    }
}
const aboutImages = [
    "../images/about-img1.jpg",
    "../images/about-img2.jpg",
    
]; // Add image paths
let aboutCurrentIndex = 0;




//photo change animation
function changeAboutPhoto() {
    const imgElement = document.getElementById("about-photo");

    // Apply the fade-out effect
    imgElement.classList.add("fade-out");

    // After the fade-out is complete change the image source and fade it back in
    setTimeout(() => {
        aboutCurrentIndex = (aboutCurrentIndex + 1) % aboutImages.length; // Move to the next image
        imgElement.src = aboutImages[aboutCurrentIndex]; // Update the image source

        // Remove the fade-out class to fade the image back in
        imgElement.classList.remove("fade-out");
    }, 1000);
}

// Change the image every 10 seconds
setInterval(changeAboutPhoto, 10000);




// Function to open image in full screen
document.querySelectorAll('.shop-image').forEach(img => {
    img.addEventListener('click', function() {
        const fullscreenOverlay = document.getElementById('fullscreenOverlay');
        const fullscreenImage = document.getElementById('fullscreenImage');
        fullscreenImage.src = this.src;
        fullscreenOverlay.style.display = 'flex';
    });
});

// Function to close full screen
function closeFullscreen() {
    document.getElementById('fullscreenOverlay').style.display = 'none';
}




