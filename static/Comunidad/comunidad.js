// Add event listeners for the notification button and profile dropdown
const notificationButton = document.querySelector('.notification-button');
const profileDropdown = document.querySelector('.profile');

notificationButton.addEventListener('click', () => {
    // Handle notification button click
    // You can open a modal or display a notification here
    console.log('Notification button clicked');
});

profileDropdown.addEventListener('click', () => {
    // Handle profile dropdown click
    // You can open a dropdown menu or display profile options here
    console.log('Profile dropdown clicked');
});

function toggleMenu() {
    var menu = document.getElementById("menu");
    if (menu.style.display === "flex") {
        menu.style.display = "none";
    } else {
        menu.style.display = "flex";
    }
}