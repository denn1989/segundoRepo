const FORMULARIO_ASESOR = document.getElementById("INSERTAR_ASESOR_EXT");

FORMULARIO_ASESOR.addEventListener("submit", (evento) => {
  evento.preventDefault();

  var DATA_FORMULARIO = new FormData(FORMULARIO_ASESOR);

  fetch("http://localhost/vinculacion1/servidor/asesoresExternos.php", {
    method: "POST",
    headers: {
      Acept: "application/json",
      "Content-Type": "application/json",
    },

    body: JSON.stringify({
      NOMBRE: DATA_FORMULARIO.get("NOMBRE"),
      AP_PAT: DATA_FORMULARIO.get("APELLIDO_PATERNO"),
      AP_MAT: DATA_FORMULARIO.get("APELLIDO_MATERNO"),
      ESPECIALIDAD: DATA_FORMULARIO.get("ESPECIALIDAD"),
    }),
  })
    .then((response) => {
      return response.json();
    })
    .then((value) => {
      let { status, mensaje } = value;
      if (status == "OK") {
        FORMULARIO_ASESOR.reset();
        M.toast({
          html: mensaje,
          displayLength: 1200,
        });
      }

      if (status == "ERROR") {
        FORMULARIO_ASESOR.reset();
        M.toast({
          html: mensaje,
          displayLength: 1200,
        });
      }
    })
    .catch((error) => console.log(error));
});
