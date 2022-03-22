const FORMULARIO_PROMOCION = document.getElementById("INSERTAR_PROMOCION");

FORMULARIO_PROMOCION.addEventListener("submit", (evento) => {
  evento.preventDefault();

  var DATA_FORMULARIO = new FormData(FORMULARIO_PROMOCION);

  fetch("http://localhost/vinculacion1/servidor/promocionEscolar.php", {
    method: "POST",
    headers: {
      Acept: "application/json",
      "Content-type": "application/json",
    },

    body: JSON.stringify({
      ESCUELA_ID: DATA_FORMULARIO.get("ESCUELA_BACHILLER"),
      CARRERA_ID: DATA_FORMULARIO.get("CARRERA"),
      NOMBRE: DATA_FORMULARIO.get("NOMBRE"),
      APELLIDO: DATA_FORMULARIO.get("APELLIDO"),
      LUGAR_NACIMIENTO: DATA_FORMULARIO.get("LUGAR_NACIMIENTO"),
      LUGAR_RESIDENCIA: DATA_FORMULARIO.get("LUGAR_RESIDENCIA"),
      LENGUA: DATA_FORMULARIO.get("LENGUA"),
      CICLO_ESCOLAR: DATA_FORMULARIO.get("CICLO_ESCOLAR"),
      CARRERA_PROPUESTA: DATA_FORMULARIO.get("CARRERA_PROP"),
    }),
  })
    .then((response) => {
      return response.json();
    })
    .then((value) => {
      let { status, mensaje } = value;
      if (status == "OK") {

        FORMULARIO_PROMOCION.reset();
        tarjetasProm(" ");
        
        M.toast({
          html: mensaje,
          displayLength: 1200,
        });
      }

      if (status == "ERROR") {
        FORMULARIO_PROMOCION.reset();
        M.toast({
          html: mensaje,
          displayLength: 1200,
        });
      }
    })
    .catch((error) => console.log(error));
});
