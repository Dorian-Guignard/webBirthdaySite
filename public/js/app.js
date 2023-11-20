var iconPath = "../icons/wired-lineal-1103-confetti.gif"; // ou icon.gif selon le format de l'icône
var iconContainer = document.getElementById("confetti-icon");


  function closeModal() {
    document.querySelector('.modal').style.display = 'none';
  } 

document.addEventListener('DOMContentLoaded', function (event) {
  event.preventDefault();
  
  // Initialiser le compte à rebours
  countdown();
});

function countdown() {
 
  // Définir les dates de début et de fin
const dateDebut = new Date('1974-06-29T08:00:00').getTime();

// Obtenir la date actuelle
const now = new Date().getTime();

// Calculer la différence entre la date actuelle et la date de début
const difference = now - dateDebut;

// Convertir la différence en années, mois, jours, heures, minutes et secondes
const years = new Date(difference).getUTCFullYear() - 1970;
const months = new Date(difference).getUTCMonth();
const days = new Date(difference).getUTCDate() - 1;
const hours = new Date(difference).getUTCHours();
const minutes = new Date(difference).getUTCMinutes();
const seconds = new Date(difference).getUTCSeconds();


  // Afficher le compte à rebours
  document.getElementById('years').innerHTML = ` ${years} ans,`;
  document.getElementById('months').innerHTML = `${months} mois,`;
  document.getElementById('days').innerHTML = ` ${days} jours,`;
  document.getElementById('hours').innerHTML = `${hours} heures,`;
  document.getElementById('minutes').innerHTML = `${minutes} minutes`;
  document.getElementById('seconds').innerHTML = `et ${seconds} secondes :`;

  // Répéter le compte à rebours toutes les secondes
  setTimeout(countdown, 1000);
}

