async function btnActionEliminarAsesorExt(data) {
  await fetch("http://localhost/vinculacion1/servidor/asesoresExternos.php", {
    method: "PUT",
    headers: {
      Acept: "application/json",
      "Content-Type": "application/json",
    },

    body: JSON.stringify({
      ID_ASESOREXT: data,
    }),
  })
    .then((response) => {
      return response.json();
    })
    .then((value) => {
      let { status, mensaje } = value;
      if (status == "OK") {
        tarjetasAsesor("");
        M.toast({
          html: mensaje,
        });
      }

      if (status == "ERROR") {
        M.toast({
          html: mensaje,
        });
      }
    })
    .catch((error) => console.log(error));
}

function confirmarEliminar(data) {
  var modalConfirm = `

`;
}
