var iconPath = "../icons/wired-lineal-1103-confetti.gif"; // ou icon.gif selon le format de l'icône
var iconContainer = document.getElementById("confetti-icon");

var iconImage = document.createElement("img");
iconImage.src = iconPath;
iconContainer.appendChild(iconImage);

document.addEventListener('DOMContentLoaded', function () {
  const burger = document.querySelector('.navbar-burger');
  const menu = document.querySelector('#navbarBasicExample');

  burger.addEventListener('click', function () {
    burger.classList.toggle('is-active');
    menu.classList.toggle('is-active');
  });
});