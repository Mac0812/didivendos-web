const btnSwitch = document.querySelector("#switch");
btnSwitch.addEventListener("click", () => {
  document.body.classList.toggle("dark-mode");
  btnSwitch.classList.toggle("active");
});

// Obtener elementos del DOM
const chatButton = document.getElementById("chatButton");
const chatModal = document.getElementById("chatModal");
const closeChatModal = document.getElementById("closeChatModal");

// Mostrar el modal al hacer clic en el bot贸n de chat
chatButton.onclick = function () {
  chatModal.style.display = "block";
};

function toggleMenu() {
  var menu = document.getElementById("menu");
  var user = document.getElementById("user");
  var profile = document.getElementById("profile");
  var profileInfo = document.getElementById("container-info-perfil")
  if ((menu.style.display === "flex" || user.style.display === "flex" || profile.style.display === "flex"|| profileInfo.style.display === "flex")){
    menu.style.display = "none";
    user.style.display = "none";
    profile.style.display = "none";
    profileInfo.style.display = "none";
  } else {
    menu.style.display = "flex";
    user.style.display = "flex";
    profile.style.display = "flex";
    profileInfo.style.display = "flex";
  }
}
