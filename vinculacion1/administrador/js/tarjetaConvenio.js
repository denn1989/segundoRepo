buscar.oninput = function () {
  tarjetasConvenio(buscar.value);
};

tarjetasConvenio("");

function tarjetasConvenio(condicion) {
  var tarjetas = ``;
  fetch(
    `http://localhost/vinculacion1/servidor/convenios.php?condicion=${condicion}`
  )
    .then(function (response) {
      return response.json();
    })
    .then(function (value) {
      let { datos, mensaje, status } = value;
      if (status == "OK") {
        for (let convenios in datos) {
          tarjetas += `<div class="col m6">
                        <div class="card horizontal">
                            <div class="card-stacked">
                                <div class="card-content" value="1">
                                    <h5>${datos[convenios].empresa}</h5>
                                    <br>
                                   DURACIÓN: ${datos[convenios].duracion}<br>
                                    SECTOR: ${datos[convenios].sector}
                                </div>

                                <div class="card-action center-align">                 
                                <button value= ${convenios} class="waves-effect waves-light btn teal darken-1" style="width: 14rem;">Modificar</button>                   
                                    <button value= ${convenios} class="waves-effect waves-light btn teal darken-1" onClick=" modalEliminarConvenio(${convenios})" style="width: 14rem;">Eliminar</button>
                                </div>
                            </div>
                        </div>

                    </div>
          
          `;
        }
      }
      if (status == "ERROR") {
        tarjetas = `
        <h5>${mensaje}</h5>
        `;
      }
      document.querySelector(".targetsConvenios").innerHTML = tarjetas;
    })
    .catch(function (error) {
      console.log(error);
    });
}
function modalEliminarConvenio(convenio) {
  var contentModal = ` <div class="row modal-content " style="margin-bottom: 0rem">
            <h6 class="center-align"> ¿Seguro que desea eliminar el residente?</h6>
        </div>

        <div class="row modal-footer center-align">
            <div class="col m4"></div>
            <div class="col m4 center-align">
                <a value=${convenio} class="modal-close btn-floating teal darken-1 waves-effect waves-light btn" onClick="btnActionEliminarConvenio(${convenio})" style="margin-right: 5px">sí</a>

                <a class="modal-close btn-floating teal darken-1 waves-effect waves-light btn ">No</a>
            </div>
            <div class="col m4"></div>
        </div>`;

  document.getElementById("CONFIRMAR_ELIMINAR_CONVENIO").innerHTML =
    contentModal;

  const elem = document.getElementById("CONFIRMAR_ELIMINAR_CONVENIO");
  const instance = M.Modal.init(elem);
  instance.open();
}

async function btnActionEliminarConvenio(data) {
  await fetch("http://localhost/vinculacion1/servidor/convenios.php", {
    method: "DELETE",
    headers: {
      Acept: "application/json",
      "Content-Type": "application/json",
    },

    body: JSON.stringify({
      ID_CONVENIO: data,
    }),
  })
    .then((response) => {
      return response.json();
    })
    .then((value) => {
      let { status, mensaje } = value;
      if (status == "OK") {
        tarjetasConvenio("");
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
