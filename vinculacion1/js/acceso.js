const FORMULARIO_LOGIN = document.getElementById("LOG_USUARIO");

FORMULARIO_LOGIN.addEventListener("submit", (evento) => {
  evento.preventDefault();

  var DATA_FORMULARIO = new FormData(FORMULARIO_LOGIN);

  fetch("http://localhost/vinculacion1/servidor/login.php", {
    method: "POST",
    headers: {
      Acept: "application/json",
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      username: DATA_FORMULARIO.get("USERNAME"),
      password: DATA_FORMULARIO.get("PASSWORD"),
    }),
  })
    .then((response) => {
      return response.json();
    })
    .then((value) => {
      let { status, mensaje } = value;
      if (status == "OK") {
        location.href = "http://localhost/vinculacion1/administrador/";
      }
      if (status == "ERROR") {
        M.toast({ html: mensaje, displayLength: 1200 });
      }
    })
    .catch((error) => console.log(error));
});
