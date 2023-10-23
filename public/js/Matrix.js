// Matrix.js

import React from "react";
import ReactDOM from "react-dom";

("use strict");
Object.defineProperty(exports, "__esModule", { value: true });
var jsx_runtime_1 = require("react/jsx-runtime");
var react_1 = require("react");

var isDrawing = false;

function toggleMatrixCodeRain() {
  const matrixCodeRainContainer = document.getElementById(
    "matrix-code-rain-container"
  );

  // Si le composant n'est pas déjà présent, ajoutez-le
  if (!matrixCodeRainContainer.querySelector("canvas")) {
    const matrixCodeRain = document.createElement("div");
    matrixCodeRain.classList.add("matrix-code-rain");
    matrixCodeRainContainer.appendChild(matrixCodeRain);

    // Créez l'instance de MatrixCodeRainComponent dans cette div
    ReactDOM.render(
      <MatrixCodeRainComponent
        width="100vw"
        height="100vh"
        timeout={70}
        textStrip={[
          "a",
          "b",
          "c",
          "d",
          "e",
          "f",
          "g",
          "h",
          "i",
          "j",
          "k",
          "l",
          "m",
          "n",
          "o",
          "p",
          "q",
          "r",
          "s",
          "t",
          "u",
          "v",
          "w",
          "x",
          "y",
          "z",
          "A",
          "B",
          "C",
          "D",
          "E",
          "F",
          "G",
          "H",
          "I",
          "J",
          "K",
          "L",
          "M",
          "N",
          "O",
          "P",
          "Q",
          "R",
          "S",
          "T",
          "U",
          "V",
          "W",
          "X",
          "Y",
          "Z",
        ]}
        theColors={[
          "#cefbe4",
          "#81ec72",
          "#5cd646",
          "#54d13c",
          "#4ccc32",
          "#43c728",
        ]}
        stripCount={60}
      />,
      matrixCodeRain
    );
  } else {
    // Si le composant est déjà présent, retirez-le
    const matrixCodeRain =
      matrixCodeRainContainer.querySelector(".matrix-code-rain");
    ReactDOM.unmountComponentAtNode(matrixCodeRain);
    matrixCodeRainContainer.removeChild(matrixCodeRain);
  }
}

// Exportez la fonction pour qu'elle soit accessible depuis d'autres fichiers
exports.toggleMatrixCodeRain = toggleMatrixCodeRain;
