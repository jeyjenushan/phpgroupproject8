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
    
]; // Add your image paths
let aboutCurrentIndex = 0;




//photo change animation
function changeAboutPhoto() {
    const imgElement = document.getElementById("about-photo");

    // Apply the fade-out effect
    imgElement.classList.add("fade-out");

    // After the fade-out is complete (1 second), change the image source and fade it back in
    setTimeout(() => {
        aboutCurrentIndex = (aboutCurrentIndex + 1) % aboutImages.length; // Move to the next image
        imgElement.src = aboutImages[aboutCurrentIndex]; // Update the image source

        // Remove the fade-out class to fade the image back in
        imgElement.classList.remove("fade-out");
    }, 2000); // 1000 ms is equal to 1 second
}

// Change the image every 30 seconds
setInterval(changeAboutPhoto, 10000);
