buscar.oninput = function () {
  tarjetasEmpresa(buscar.value);
};

tarjetasEmpresa("");

function tarjetasEmpresa(condicion) {
  var tarjetas = ``;
  fetch(
    `http://localhost/vinculacion1/servidor/empresas.php?condicion=${condicion}`
  )
    .then(function (response) {
      return response.json();
    })
    .then(function (value) {
      let { datos, mensaje, status } = value;
      if (status == "OK") {
        for (let empresas in datos) {
          tarjetas += `<div class="col m6">
                        <div class="card horizontal" style="height: 20rem">
                            <div class="card-stacked">
                                <div class="card-content" value="1" style="padding-bottom: 0px;">
                                    <h5 class="center-align">${datos[empresas].nombre}</h5>
                                    <br>
                                <div class="row">
                                  <div class="col m6">
                                            <b>ENCARGADO:</b> ${datos[empresas].encargado}<br>
                                            <b>TELÉFONO:</b> ${datos[empresas].telefono} <br>
                                            <b>CORREO:</b> ${datos[empresas].correo}
                                   </div>

                                   <div class="col m6">
                                            <b>DIRECCIÓN: </b>${datos[empresas].direccion} <br>
                                            <b>SECTOR:</b> ${datos[empresas].sector}<br>
                                            <b>ALUMNOS ASIGNADOS:</b> 6
                                    </div>

                                </div>
                              </div>

                              <div class="card-action">
                               <button value="${empresas}"class="waves-effect waves-light btn teal darken-1" style="width: 14rem; font-size: 1rem;">Modificar</button>
                              <button value="${empresas}"class="waves-effect waves-light btn teal darken-1" onClick="modalEliminarEmpresa(${empresas})" style="width: 14rem; font-size: 1rem;">Eliminar</button>
                                 
                              </div>
                            </div>
                        </div>
                    </div>`;
        }
      }
      if (status == "ERROR") {
        tarjetas = `
        <h5>${mensaje}</h5>
        `;
      }
      document.querySelector(".targetEmpresas").innerHTML = tarjetas;
    })
    .catch(function (error) {
      console.log(error);
    });
}

function modalEliminarEmpresa(empresa) {
  var contentModal = ` <div class="row modal-content " style="margin-bottom: 0rem">
            <h6 class="center-align"> ¿Seguro que desea eliminar el residente?</h6>
        </div>

        <div class="row modal-footer center-align">
            <div class="col m4"></div>
            <div class="col m4 center-align">
                <a value=${empresa} class="modal-close btn-floating teal darken-1 waves-effect waves-light btn" onClick="btnActionEliminarEmpresa(${empresa})" style="margin-right: 5px">sí</a>

                <a class="modal-close btn-floating teal darken-1 waves-effect waves-light btn ">No</a>
            </div>
            <div class="col m4"></div>
        </div>`;

  document.getElementById("CONFIRMAR_ELIMINAR_EMPRESA").innerHTML =
    contentModal;

  const elem = document.getElementById("CONFIRMAR_ELIMINAR_EMPRESA");
  const instance = M.Modal.init(elem);
  instance.open();
}

async function btnActionEliminarEmpresa(data) {
  await fetch("http://localhost/vinculacion1/servidor/empresas.php", {
    method: "PUT",
    headers: {
      Acept: "application/json",
      "Content-Type": "application/json",
    },

    body: JSON.stringify({
      ID_EMPRESA: data,
    }),
  })
    .then((response) => {
      return response.json();
    })
    .then((value) => {
      let { status, mensaje } = value;
      if (status == "OK") {
        tarjetasEmpresa("");
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

