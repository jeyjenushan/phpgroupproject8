document.querySelector('.select-btn').addEventListener('click', function (e) {
   
    e.stopPropagation(); // Prevent the click event from bubbling up

    const dropdown = document.querySelector('.select-dropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block'; // Toggle visibility
});

// Hide dropdown when clicking outside of it
document.addEventListener('click', function (e) {
    const dropdown = document.querySelector('.select-dropdown');
    const selectBtn = document.querySelector('.select-btn');
    if (!selectBtn.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.style.display = 'none'; // Hide dropdown if clicked outside
    }
});
document.querySelector('#select-btn').addEventListener('click', function (e) {
   
    e.stopPropagation(); // Prevent the click event from bubbling up

    const dropdown = document.querySelector('#select-dropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block'; // Toggle visibility
});