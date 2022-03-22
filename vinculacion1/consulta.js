fetch("http://localhost/vinculacion1/servidor/promocionEscolar.php", {
  method: "delete",
  headers: {
    Acept: "application/json",
    "Content-Type": "application/json",
  },
  body: JSON.stringify({
  ID_ESTUDIANTE: 3,
  
  }),
})
  .then((response) => response.json())
  .then((value) => console.log(value))
  .catch((error) => console.log(error));