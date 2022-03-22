const FORMULARIO_CONVENIO = document.getElementById("INSERTAR_CONVENIO");

FORMULARIO_CONVENIO.addEventListener("submit", (evento) => {
  evento.preventDefault();

  var DATA_FORMULARIO = new FormData(FORMULARIO_CONVENIO);

  fetch("http://localhost/vinculacion1/servidor/convenios.php", {
    method: "POST",
    headers: {
      Acept: "application/json",
      "Content-type": "application/json",
    },

    body: JSON.stringify({
      EMPRESA_ID: DATA_FORMULARIO.get("ID_EMPRESA"),
      TIPOCONVENIO_ID: DATA_FORMULARIO.get("TIPO_CONVENIO"),
      INICIO_CONVENIO: DATA_FORMULARIO.get("FECHA_INICIO"),
      FIN_CONVENIO: DATA_FORMULARIO.get("FECHA_FIN"),
    }),
  })
    .then((response) => {
      return response.json();
    })
    .then((value) => {
      let { status, mensaje } = value;
      if (status == "OK") {
        tarjetasConvenio("");
        FORMULARIO_CONVENIO.reset();
        M.toast({
          html: mensaje,
          displayLength: 1200,
        });
      }
      if (status == "ERROR") {
         FORMULARIO_CONVENIO.reset();
        M.toast({
          html: mensaje,
          displayLength: 1200,
        });
      }
    })
    .catch((error) => console.log(error));
});
