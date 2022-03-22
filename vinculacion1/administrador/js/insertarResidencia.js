const FORMULARIO_RESIDENCIAS = document.getElementById("INSERTAR_RESIDENCIA");

FORMULARIO_RESIDENCIAS.addEventListener("submit", (evento) => {
  evento.preventDefault();

  var DATA_FORMULARIO = new FormData(FORMULARIO_RESIDENCIAS);

  fetch("http://localhost/vinculacion1/servidor/residencias.php", {
    method: "POST",
    headers: {
      Acept: "application/json",
      "Content-type": "application/json",
    },

    body: JSON.stringify({
      MATRICULA: DATA_FORMULARIO.get("MATRICULA"),
      EMPRESA_ID: DATA_FORMULARIO.get("EMPRESA"),
      ASESOREXT_ID: DATA_FORMULARIO.get("ASESOR_EXTERNO"),
      ASESORINT_ID: DATA_FORMULARIO.get("ASESOR_INTERNO"),
      CALIFICACION: DATA_FORMULARIO.get("CALIFICACION"),
      FECHA_INICIO: DATA_FORMULARIO.get("INICIO_RESIDENCIA"),
      FECHA_FIN: DATA_FORMULARIO.get("FIN_RESIDENCIA"),
      NOMBRE_PROYECTO: DATA_FORMULARIO.get("PROYECTO"),
      
    }),
  })
    .then((response) => {
      return response.json();
    })
    .then((value) => {
      let { status, mensaje } = value;
      if (status == "OK") {
       FORMULARIO_RESIDENCIAS.reset();
        tarjetas("");
        M.toast({
          html: mensaje,
          displayLength: 1200,
        });
      }

      if (status == "ERROR") {
        FORMULARIO_RESIDENCIAS.reset();
        M.toast({
          html: mensaje,
          displayLength: 1200,
        });
      }
    })
    .catch((error) => console.log(error));
});
