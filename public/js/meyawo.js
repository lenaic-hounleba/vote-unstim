$(document).ready(function () {
  // Ajoutez un gestionnaire d'événements aux liens avec la classe scroll-link
  $(".scroll-link").on("click", function (event) {
    // Empêche le comportement par défaut du lien
    event.preventDefault();

    // Récupère l'ID de la cible à partir de l'attribut href du lien
    var targetId = $(this).attr("href");

    // Animation de défilement vers le conteneur correspondant
    $("html, body").animate(
      {
        scrollTop: $(targetId).offset().top,
      },
      700
    );
  });
});

$(document).ready(function () {
  // Gestion du clic sur le lien dans le menu pour le smooth scroll
  $("#nav-link-partenaires").on("click", function (event) {
    event.preventDefault();

    // Récupérer l'identifiant du conteneur en fonction de la taille de l'écran
    var containerId =
      window.innerWidth >= 768 ? "#partenaires-desktop" : "#partenaires-mobile";

    // Animation de défilement vers le conteneur correspondant
    $("html, body").animate(
      {
        scrollTop: $(containerId).offset().top,
      },
      700
    );
  });

  // Gestion du clic sur le lien dans le menu pour la navigation classique
  $(".navbar .nav-link").on("click", function (event) {
    if (this.hash !== "") {
      event.preventDefault();

      var hash = this.hash;

      $("html, body").animate(
        {
          scrollTop: $(hash).offset().top,
        },
        700,
        function () {
          window.location.hash = hash;
        }
      );
    }
  });

  // Gestion du clic sur le bouton de navigation (navbar toggle)
  $("#nav-toggle").click(function () {
    $(this).toggleClass("is-active");
    $("ul.nav").toggleClass("show");
  });
});

// ------------------------------------------------------------------------------------------------------

// Variables pour stocker les anciens nombres du timer
let oldDays = -1;
let oldHours = -1;
let oldMinutes = -1;
let oldSeconds = -1;

// Fonction pour mettre à jour le timer avec effet d'entrée par le haut en fondu
function updateCountdown() {
  // Date cible : 11 Avril 2024 à 23h59min59sec
  const targetDate = new Date("2024-04-11T23:59:59").getTime();

  // Date actuelle
  const currentDate = new Date().getTime();

  // Calcul de la différence entre la date cible et la date actuelle
  const difference = targetDate - currentDate;

  // Calcul des jours, heures, minutes et secondes restantes
  const days = Math.floor(difference / (1000 * 60 * 60 * 24));
  const hours = Math.floor(
    (difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
  );
  const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((difference % (1000 * 60)) / 1000);

  // Mettre à jour le timer seulement si les nombres ont changé
  if (days !== oldDays) {
    document.getElementById("jours").innerHTML = days;
    oldDays = days;
    animateNumberChange("jours");
  }
  if (hours !== oldHours) {
    document.getElementById("heures").innerHTML = hours;
    oldHours = hours;
    animateNumberChange("heures");
  }
  if (minutes !== oldMinutes) {
    document.getElementById("minutes").innerHTML = minutes;
    oldMinutes = minutes;
    animateNumberChange("minutes");
  }
  if (seconds !== oldSeconds) {
    document.getElementById("secondes").innerHTML = seconds;
    oldSeconds = seconds;
    animateNumberChange("secondes");
  }
}

// Fonction pour appliquer l'animation d'entrée par le haut en fondu uniquement sur le nombre qui change
function animateNumberChange(elementId) {
  const element = document.getElementById(elementId);
  element.classList.add("fade-in");
  setTimeout(function () {
    element.classList.remove("fade-in");
  }, 500); // La durée de l'animation est de 0.5s, donc attendez au moins 0.5s avant de supprimer la classe
}

// Appel de la fonction pour mettre à jour le timer chaque seconde
setInterval(updateCountdown, 1000);

// --------------------------------------------------------------------------------------------------------------------------

// Fonction pour démarrer et arrêter les compteurs lorsque le centre vertical de la section est visible
function handleCountersVisibility() {
  // Récupérer la section .grid-divs
  const gridDivs = document.querySelector(".grid-divs");
  const sectionTop = gridDivs.getBoundingClientRect().top;
  const sectionHeight = gridDivs.clientHeight;
  const windowHeight =
    window.innerHeight || document.documentElement.clientHeight;
  const scrollPosition = window.scrollY || window.pageYOffset;

  // Calculer le centre vertical de la section
  const sectionCenter = sectionTop + sectionHeight / 2;

  // Vérifier si le centre vertical de la section est visible à l'écran
  if (
    sectionCenter > scrollPosition &&
    sectionCenter < scrollPosition + windowHeight
  ) {
    // Démarrer les compteurs
    startCounters();
  } else {
    // Arrêter les compteurs
    stopCounters();
  }
}

// Fonction pour démarrer les compteurs
// Fonction pour démarrer les compteurs avec les nombres finaux spécifiés
function startCounters() {
  // Tableau des nombres finaux pour chaque compteur
  const finalNumbers = [7, 7, 7, 1];

  // Démarrer le décompte pour chaque élément .timer-number1
  const timerNumbers = document.querySelectorAll(
    ".timer-number11, .timer-number12, .timer-number13, .timer-number14"
  );
  let index = 0;

  function startNextCounter() {
    const currentTimerNumber = timerNumbers[index];
    const targetNumber = finalNumbers[index]; // Récupérer le nombre final pour ce compteur
    let counter = 0;

    function updateCounter() {
      if (counter <= targetNumber) {
        currentTimerNumber.textContent = counter;
        counter++;
        setTimeout(updateCounter, 100); // ajustez le délai selon vos besoins
      } else {
        index++;
        if (index < timerNumbers.length) {
          startNextCounter();
        }
      }
    }

    updateCounter();
  }

  startNextCounter();
}

// Fonction pour arrêter les compteurs
function stopCounters() {
  // Ne rien faire
}

// Écouter l'événement de défilement de la fenêtre
window.addEventListener("scroll", handleCountersVisibility);

// Démarrer les compteurs lorsque la page est chargée au cas où la section serait déjà visible
window.addEventListener("load", handleCountersVisibility);

//---------------------------------------------------------------------------------------------------------------------

document.addEventListener("DOMContentLoaded", function () {
  var container1 = document.querySelector(".slider-container");
  var slider = container1.querySelector(".slider");

  container1.addEventListener("mouseenter", function () {
    slider.style.animationPlayState = "paused";
  });

  container1.addEventListener("mouseleave", function () {
    slider.style.animationPlayState = "running";
  });
});

//--------------------------------------------------------------------------------------------------------------------------

