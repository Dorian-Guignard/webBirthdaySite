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
  const dateFin = new Date('2024-06-29T08:00:00').getTime();

  // Calculer la différence entre les deux dates en millisecondes
  const difference = dateFin - dateDebut;

  // Convertir la différence en années, mois, jours, heures, minutes et secondes
  const years = new Date(difference).getUTCFullYear() - 1970;
  const months = new Date(difference).getUTCMonth();
  const days = new Date(difference).getUTCDate() - 1;
  const hours = new Date(difference).getUTCHours();
  const minutes = new Date(difference).getUTCMinutes();
  const seconds = new Date(difference).getUTCSeconds();

  console.log('Years:', years);
  console.log('Months:', months);
  console.log('Days:', days);
  console.log('Hours:', hours);
  console.log('Minutes:', minutes);
  console.log('Seconds:', seconds);

  // Afficher le compte à rebours
  document.getElementById('years').innerHTML = `Années : ${years}`;
  document.getElementById('months').innerHTML = `Mois : ${months}`;
  document.getElementById('days').innerHTML = `Jours : ${days}`;
  document.getElementById('hours').innerHTML = `H : ${hours}`;
  document.getElementById('minutes').innerHTML = `M : ${minutes}`;
  document.getElementById('seconds').innerHTML = `S : ${seconds}`;

  // Répéter le compte à rebours toutes les secondes
  setTimeout(countdown, 1000);
}

