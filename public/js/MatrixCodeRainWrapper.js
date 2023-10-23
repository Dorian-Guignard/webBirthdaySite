import MatrixCodeRainComponent from "react-matrix-code-rain";

const MatrixCodeRainWrapper = () => {
  return (
    <div>
      <MatrixCodeRainComponent
        width="100vw"
        height="100vh"
        timeout={500}
        textStrip={["Hello", "World"]}
        theColors={["#00FF00", "#00FF00", "#00FF00", "#00FF00", "#00FF00"]}
        stripCount={100}
      />
    </div>
  );
};

export default MatrixCodeRainWrapper;

