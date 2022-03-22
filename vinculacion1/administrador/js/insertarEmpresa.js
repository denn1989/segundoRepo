const FORMULARIO_EMPRESA = document.getElementById("INSERTAR_EMPRESA");

FORMULARIO_EMPRESA.addEventListener("submit", (evento) => {
  evento.preventDefault();

  var DATA_FORMULARIO = new FormData(FORMULARIO_EMPRESA);

  fetch("http://localhost/vinculacion1/servidor/empresas.php", {
    method: "POST",
    headers: {
      Acept: "application/json",
      "Content-type": "application/json",
    },

    body: JSON.stringify({
      NOMBRE: DATA_FORMULARIO.get("EMPRESA"),
      ENCARGADO: DATA_FORMULARIO.get("ENCARGADO"),
      TELEFONO: DATA_FORMULARIO.get("TELEFONO"),
      CORREO: DATA_FORMULARIO.get("CORREO"),
      DIRECCION: DATA_FORMULARIO.get("CORREO"),
      SECTOR: DATA_FORMULARIO.get("SECTOR"),
      TIPO: DATA_FORMULARIO.get("TIPO"),
    }),
  })
    .then((response) => {
      return response.json();
    })
    .then((value) => {
      let { status, mensaje } = value;
      if (status == "OK") {
        FORMULARIO_EMPRESA.reset();
        M.toast({
          html: mensaje,
          displayLength: 1200,
        });

        
      }
      if (status == "ERROR") {
         FORMULARIO_EMPRESA.reset();
        M.toast({
          html: mensaje,
          displayLength: 1200,
        });
      }
    })
    .catch((error) => console.log(error));
});
