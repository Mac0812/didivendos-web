const btnSwitch = document.querySelector('#switch');
btnSwitch.addEventListener('click', () => {
  document.body.classList.toggle('dark-mode');
  btnSwitch.classList.toggle('active');
});


  // Obtener elementos del DOM
  const chatButton = document.getElementById('chatButton');
  const chatModal = document.getElementById('chatModal');

  // Mostrar el modal al hacer clic en el bot贸n de chat
  chatButton.onclick = function() {
    chatModal.style.display = 'block';
  };

 


