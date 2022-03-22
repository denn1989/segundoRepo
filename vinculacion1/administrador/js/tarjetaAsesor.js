buscar.oninput = function () {
  tarjetasAsesor(buscar.value);
  tarjetasAsesorInterno(buscar.value);
};

tarjetasAsesor("");
tarjetasAsesorInterno("");



function tarjetasAsesor(condicion) {
  var tarjetas = ``;
  fetch(
    `http://localhost/vinculacion1/servidor/asesoresExternos.php?condicion=${condicion}`
  )
    .then(function (response) {
      return response.json();
    })
    .then(function (value) {
      let { datos, mensaje, status } = value;
      if (status == "OK") {
        for (let asesores in datos) {
          tarjetas += `<div class="col m6">
                        <div class="card horizontal" style="height: 17rem">
                            <div class="card-stacked">
                                <div class="card-content" value="1">
                                    <h5>${datos[asesores].nombre}</h5>
                                    <br>
                                   RESIDENTES ASIGNADOS: 
                                </div>

                                <div class="card-action center-align">
          
                                    
                                    <button class="waves-effect waves-light btn teal darken-1" value=${asesores} onClick="btnActionEliminarAsesorExt(${asesores})" style="width: 29rem;">Eliminar</button>

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
      document.querySelector(".targetAsesores").innerHTML = tarjetas;
    })
    .catch(function (error) {
      console.log(error);
    });
}


function tarjetasAsesorInterno(condicion) {
  var tarjetas = ``;
  fetch(
    `http://localhost/vinculacion1/servidor/asesoresInternos.php?condicion=${condicion}`
  )
    .then(function (response) {
      return response.json();
    })
    .then(function (value) {
      let { datos, mensaje, status } = value;
      if (status == "OK") {
        for (let asesoresInt in datos) {
          tarjetas += `<div class="col m6">
                        <div class="card horizontal">
                            <div class="card-stacked">
                                <div class="card-content" value="1">
                                    <h5>asesor Interno: ${datos[asesoresInt].nombre}</h5>
                                    <br>
                                   RESIDENTES ASIGNADOS: 
                                </div>

                                <div class="card-action center-align">

                                    
                                    <a class="waves-effect waves-light btn" value=${asesoresInt} style="width: 29rem;">Eliminar</a>

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
      document.querySelector(".").innerHTML = tarjetas;
    })
    .catch(function (error) {
      console.log(error);
    });
}
