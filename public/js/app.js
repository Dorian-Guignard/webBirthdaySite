var iconPath = "../icons/wired-lineal-1103-confetti.gif"; // ou icon.gif selon le format de l'icône
var iconContainer = document.getElementById("confetti-icon");

var iconImage = document.createElement("img");
iconImage.src = iconPath;
iconContainer.appendChild(iconImage);



import MatrixCodeRainComponent from "/js/MatrixCodeRainComponent.js";
import React, { useState } from "react";
import { AuthContext } from "./AuthContext";
import MatrixCodeRainWrapper from "./MatrixCodeRainWrapper";
import HomePage from "./user";

function App() {
  const [showSurprise, setShowSurprise] = useState(false); // État local pour afficher la pluie de code

  return (
    <AuthContext.Provider value={{ isAuthenticated: true }}>
      {/* Contenu de la page */}
      <nav
        class="navbar custom-navbar"
        role="navigation"
        aria-label="main navigation"
      >
        {/* Autres balises de la barre de navigation */}
        <button
          class="navbar-item navbar-item-transparent"
          onClick={() => setShowSurprise(!showSurprise)}
        >
          Surprise
        </button>
        {/* Autres balises de la barre de navigation */}
      </nav>
      {/* Afficher la pluie de code si showSurprise est true */}
      {showSurprise && <MatrixCodeRainWrapper />}
      {/* Reste du contenu de la page */}
      <HomePage />
    </AuthContext.Provider>
  );
}

export default App;