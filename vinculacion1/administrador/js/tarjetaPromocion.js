buscar.oninput = function () {
	tarjetasProm(buscar.value);
	tarjetasProm(buscar.value);
};

tarjetasProm("");

function tarjetasProm(condicion) {
	var tarjetas = ``;
	fetch(
		`http://localhost/vinculacion1/servidor/promocionEscolar.php?condicion=${condicion}`
	)
		.then(function (response) {
			return response.json();
		})
		.then(function (value) {
			let { datos, mensaje, status } = value;
			if (status == "OK") {
				// console.log(value);
				for (let promocion in datos) {
					tarjetas += `<div class="col s12 m6">
                        <div class="card horizontal" style="height: 20rem">
                            <div class="card-stacked">
                                <div class="card-content ">
																<h5 class="center-align"> ${datos[promocion].nombre}</h5>
                            
                                    ESCUELA: ${datos[promocion].escuela} <br>
																		LUGAR RESIDENCIA: ${datos[promocion].lugar_residencia} <br> 
																		CARRERA DE INTERES: ${datos[promocion].carrera} <br>
																		LENGUA: ${datos[promocion].lengua}
                            
                            </div>
                            <div class="card-action center-align">
                                <button value="${promocion}" class="waves-effect waves-light btn teal darken-1" onCLick="modalEliminarPromocion(${promocion})" style="width: 28rem; margin-top: 0">Eliminar</button>
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
			document.querySelector(".TargetsPromocion").innerHTML = tarjetas;
		})
		.catch(function (error) {
			console.log(error);
		});
}

function modalEliminarPromocion(promocion) {
	var contentModal = ` <div class="row modal-content " style="margin-bottom: 0rem">
            <h6 class="center-align"> ¿Seguro que desea eliminar promocion?</h6>
        </div>

        <div class="row modal-footer center-align">
            <div class="col m4"></div>
            <div class="col m4 center-align">
                <a value=${promocion} class="modal-close btn-floating teal darken-1 waves-effect waves-light btn" onClick="btnActionEliminarConvenio(${promocion})" style="margin-right: 5px">sí</a>

                <a class="modal-close btn-floating teal darken-1 waves-effect waves-light btn ">No</a>
            </div>
            <div class="col m4"></div>
        </div>`;

	document.getElementById("CONFIRMAR_ELIMINAR_PROMOCION").innerHTML =
		contentModal;

	const elem = document.getElementById("CONFIRMAR_ELIMINAR_PROMOCION");
	const instance = M.Modal.init(elem);
	instance.open();
}

async function btnActionEliminarConvenio(data) {
	await fetch("http://localhost/vinculacion1/servidor/promocionEscolar.php", {
		method: "DELETE",
		headers: {
			Acept: "application/json",
			"Content-Type": "application/json",
		},

		body: JSON.stringify({
			ID_ESTUDIANTE: data,
		}),
	})
		.then((response) => {
			return response.json();
		})
		.then((value) => {
			let { status, mensaje } = value;
			if (status == "OK") {
				tarjetasProm("");
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
