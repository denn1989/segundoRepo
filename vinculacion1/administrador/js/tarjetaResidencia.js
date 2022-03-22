var residData = " ";
buscar.oninput = function () {
  tarjetas(buscar.value);
};
var pagina = 1;

tarjetas("");

function tarjetas(condicion) {
  var tarjetas = ``;
  var paginar=``;
  fetch(
    `http://localhost/vinculacion1/servidor/residencias.php?condicion=${condicion}`
  )
    .then(function (response) {
      return response.json();
    })
    .then(function (value) {
      let { datos, paginas, mensaje, status } = value;


      for(let pagina in paginas){
        paginar = `<li class="waves-effect"><a href="#!">${pagina}</a></li>`;
        
      }

      document.querySelector(".PAGINAR").innerHTML= paginar;

      //console.log(value);
      if (status == "OK") {
        residData = datos;
        for (let residentes in datos[pagina]) {
          //console.log(residData[pagina][residentes]);
          tarjetas += `
    <div class="col m6">
      <div class="card horizontal">
                      <div class="card-stacked">
                          <div class="card-content" >
                              <h5>${datos[pagina][residentes].nombre}</h5>
                              <br>
                              Carrera:${datos[pagina][residentes].carrera}   <br>
                              Periodo: ${datos[pagina][residentes].periodo} <br>
                              Proyecto: ${datos[pagina][residentes].nombre_proyecto}
                          </div>
                          <div class="card-action center-align">
                              <button  value=${residentes} name="VER_MAS" class="teal darken-1 waves-effect waves-light btn " style="width: 9rem;" onClick="modalVerMas(${residentes})"  >Ver más...</button>
                              <button  value=${residentes} name="MODIFICAR" class="teal darken-1 waves-effect waves-light btn " onClick="modalModificar(${residentes})" style="width: 9rem;"   >Modificar</button>
                              <button value=${residentes} id="BORRAR_ID" name="BORRAR_ID" class="teal darken-1 waves-effect waves-light btn" style="width: 9rem;" onClick="modalEliminar(${residentes})" >Eliminar</button>
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

      document.querySelector(".TargetsResidentes").innerHTML = tarjetas;
    })
    .catch(function (error) {
      console.log(error);
    });
}

function modalVerMas(matricula) {
  let genero = residData[pagina][matricula].genero;
  genero = genero.toUpperCase();
  var contentModal = `
   <div class="row modal-content">
   <h6 class= "center-align"> <b> ${residData[pagina][matricula].nombre} </b> </h6>

   <div class="col m6">

   <br> <b>MATRÍCULA: </b> ${matricula} &nbsp;&nbsp;&nbsp;&nbsp;<b>GÉNERO:</b> ${genero} <br><br>
   <b>PROYECTO:</b>
    ${residData[pagina][matricula].nombre_proyecto} <br><br>
  <b>DURACIÓN:</b> ${residData[pagina][matricula].fecha_inicio} / ${residData[pagina][matricula].fecha_fin} <br><br>
  <b>ASESOR INTERNO:</b>
   ${residData[pagina][matricula].asesor_interno} <br>

   </div>

   <div class="col m6">
   <br>
   <b>EMPRESA:</b> ${residData[pagina][matricula].empresa} <br><br>
   <b>SECTOR:</b> ${residData[pagina][matricula].sector} &nbsp;&nbsp;&nbsp;&nbsp; <b>CALIFICACIÓN:</b> ${residData[pagina][matricula].calificacion} <br><br>
   <b>ASESOR EXTERNO: </b>
    ${residData[pagina][matricula].asesor_externo} <br>
    
   </div>
       

        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat" style="font-size: 1rem">Listo</a>
        </div>
  `;
  document.getElementById("RESIDENTES_VER").innerHTML = contentModal;

  const elem = document.getElementById("RESIDENTES_VER");
  const instance = M.Modal.init(elem);
  instance.open();
}

function modalModificar(matricula) {
  var contentModal = `
             <div class="row">
            <form class="col m12" id="INSERTAR_RESIDENCIA">
                <div class="row modal-content">
                    <h4>Residente</h4>
                    <div class="input-field col m2">
                        <input name="MATRICULA" type="text" class="validate">
                        <label for="MATRICULA">Matrícula</label>
                    </div>

                    <div class="input-field col m6">
                        <input name="NOMBRE" disabled value="Residente Seleccionado" id="nombre" type="text" class="validate">

                    </div>

                    <div class="input-field col m4">
                        <select name="ASESOR_EXTERNO">
                            <option value="0" disabled selected>Asesor externo</option>
                            <?php
                            require_once "../servidor/modulos/asesoresExternos.php";
                            $aE = new AsesorExterno();
                            $aE->selectAsesoresExt();
                            ?>

                        </select>
                        <label for="ASESOR_EXTERNO">Seleccione el asesor externo</label>
                    </div>


                    <div class="input-field col m4">
                        <select name="ASESOR_INTERNO" ID="ASESOR_INTERNO">
                            <option value="0" disabled selected>Asesor Interno</option>
                            <?php
                            require_once "../servidor/modulos/asesoresInternos.php";
                            $aI = new AsesorInterno();
                            $aI->selectAsesoresInt();
                            ?>
                        </select>
                        <label for="ASESOR_INTERNO">Seleccione el asesor interno</label>
                    </div>


                    <div class="input-field col m4">
                        <select name="EMPRESA">
                            <option value="0" disabled selected>Empresa</option>

                            <?php
                            require_once "../servidor/modulos/empresas.php";
                            $empresa = new Empresa();
                            $empresa->selectEmpresa();
                            ?>

                        </select>
                        <label for="EMPRESA ">Seleccione la empresa</label>
                    </div>

                    <div class="input-field col m4">
                        <input name="CALIFICACION" type="number" class="validate" step="0.1">
                        <label for="CALIFICACION">Calificación</label>
                    </div>

                    <div class="input-field col m6 ">
                        <input name="PROYECTO" type="text" class="validate">
                        <label for="PROYECTO"> Nombre de proyecto</label>
                    </div>

                    <div class="col m2">
                        <input type="text" name="INICIO_RESIDENCIA_JS" class=" INICIO_RESIDENCIA_JS datepicker">
                        <label for="fINICIO_RESIDENCIA" class="">Fecha de Inicio </label>
                    </div>

                    <div class="col m2">
                        <input name="FIN_RESIDENCIA" type="text" class="datepicker">
                        <label for="FIN_RESIDENCIA" class="">Fecha de Fin</label>
                    </div>

                    <div class="input-field col m2">
                        <select name="ESTADO">
                            <option value="0" disabled selected>Estado</option>
                            <option value="ACTIVO">Activo</option>
                            <option value="BAJA">Baja</option>
                        </select>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" href="" class="modal-close waves-effect waves-green btn-flat">Añadir</button>
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
                </div>
        </div>
        </form>
    </div>`;

  document.getElementById("RESIDENTES_MOD").innerHTML = contentModal;

  const elem = document.getElementById("RESIDENTES_MOD");
  const instance = M.Modal.init(elem);
  instance.open();

  const date = document.getElementsByClassName("INICIO_RESIDENCIA_JS");
  const instanciar = M.Datepicker.getInstance(date);
  instanciar.open();
}




function modalEliminar(matricula) {
  var contentModal = ` <div class="row modal-content " style="margin-bottom: 0rem">
            <h6 class="center-align"> ¿Seguro que desea eliminar el residente?</h6>
        </div>

        <div class="row modal-footer center-align">
            <div class="col m4"></div>
            <div class="col m4 center-align">
                <a value=${matricula} class="modal-close btn-floating teal darken-1 waves-effect waves-light btn" onClick="btnActionEliminarResidentes(${matricula})" style="margin-right: 5px">sí</a>

                <a class="modal-close btn-floating teal darken-1 waves-effect waves-light btn ">No</a>
            </div>
            <div class="col m4"></div>
        </div>`;

  document.getElementById("CONFIRMAR_MOD_RES").innerHTML = contentModal;

  const elem = document.getElementById("CONFIRMAR_MOD_RES");
  const instance = M.Modal.init(elem);
  instance.open();
}

async function btnActionEliminarResidentes(data) {
  await fetch("http://localhost/vinculacion1/servidor/residencias.php", {
    method: "DELETE",
    headers: {
      Acept: "application/json",
      "Content-Type": "application/json",
    },

    body: JSON.stringify({
      ID_RESIDENCIA: data,
    }),
  })
    .then((response) => {
      return response.json();
    })
    .then((value) => {
      let { status, mensaje } = value;
      if (status == "OK") {
        tarjetas("");
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
