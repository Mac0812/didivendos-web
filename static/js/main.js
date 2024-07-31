const btnSwitch = document.querySelector('#switch');
btnSwitch.addEventListener('click', () => {
  document.body.classList.toggle('dark-mode');
  btnSwitch.classList.toggle('active');
});
