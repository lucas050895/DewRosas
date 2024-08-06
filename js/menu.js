//MENU DE NAVEGACION
const menuIcon = document.querySelector('.menu-icon');
const menuOverlay = document.querySelector('.menu-overlay');

menuIcon.addEventListener('click', () => {
  menuIcon.classList.toggle('open');
  menuOverlay.classList.toggle('open');
});