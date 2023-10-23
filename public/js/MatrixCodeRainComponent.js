
// MatrixCodeRainComponent.js
import React, { useEffect, useState } from "react";
import MatrixCodeRain from "react-matrix-code-rain";

const MatrixCodeRainComponent = () => {
  const [isActivated, setIsActivated] = useState(false);

  useEffect(() => {
    if (isActivated) {
      // Activer la pluie de code ici si besoin
    }
  }, [isActivated]);

  return (
    <div>
      <button onClick={() => setIsActivated(!isActivated)}>Surprise</button>
      {isActivated && (
        <MatrixCodeRain
          width="100vw"
          height="100vh"
          timeout={500}
          textStrip={["Hello", "World"]}
          theColors={["#00FF00", "#00FF00", "#00FF00", "#00FF00", "#00FF00"]}
          stripCount={100}
        />
      )}
    </div>
  );
};

export default MatrixCodeRainComponent;
