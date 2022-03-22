var lugar_nacimiento = {
  labels: [],
  data: [],
};

var lugar_residencia = {
  labels: [],
  data: [],
};

var lengua = {
  labels: [],
  data: [],
};

var carrera_propuesta={
  labels: [],
  data: [],
}

var carrera_vigente={
  labels: [],
  data: [],
}

//GRAFICANDO LUGAR DE NACIMIENTO
fetch("http://localhost/vinculacion1/servidor/modulos/estadisticas.php")
  .then((response) => {
    return response.json();
  })
  .then((value) => {
    for (let lugar in value.data.LUGAR_NACIMIENTO) {
      lugar_nacimiento.labels.push(lugar);
      lugar_nacimiento.data.push(value.data.LUGAR_NACIMIENTO[lugar]);
    }

    pintar_lugar_nacimiento();
  })
  .catch((error) => {
    console.log(error);
  });

function pintar_lugar_nacimiento() {
  var ctx = document.getElementById("LUGAR_NACIMIENTO").getContext("2d");

  var myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: lugar_nacimiento.labels,
      datasets: [
        {
          label: "ocultar todo",
          data: lugar_nacimiento.data,
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
            "rgba(255, 159, 64, 1)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
      plugins: {
        title: {
          display: true,
          text: "Lugar de nacimiento",
          font: {
            size: 20,
          },
        },
      },
    },
  });
}

//GRAFICANDO LUGAR DE RESIDENCIA

fetch("http://localhost/vinculacion1/servidor/modulos/estadisticas.php")
  .then((response) => {
    return response.json();
  })
  .then((value) => {
    for (let lugar in value.data.LUGAR_RESIDENCIA) {
      lugar_residencia.labels.push(lugar);
      lugar_residencia.data.push(value.data.LUGAR_RESIDENCIA[lugar]);
    }

    pintar_lugar_residencia();
  })
  .catch((error) => {
    console.log(error);
  });

function pintar_lugar_residencia() {
  var ctx = document.getElementById("LUGAR_RESIDENCIA").getContext("2d");

  var myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: lugar_residencia.labels,
      datasets: [
        {
          label: "ocultar todo",
          data: lugar_residencia.data,
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
            "rgba(255, 159, 64, 1)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
      plugins: {
        title: {
          display: true,
          text: "Lugar de residencia",
          font: {
            size: 20,
          },
        },
      },
    },
  });
}

//GRAFICANDO LENGUA

fetch("http://localhost/vinculacion1/servidor/modulos/estadisticas.php")
  .then((response) => {
    return response.json();
  })
  .then((value) => {
    for (let lugar in value.data.LENGUA) {
      lengua.labels.push(lugar);
      lengua.data.push(value.data.LENGUA[lugar]);
    }

    pintar_lengua();
  })
  .catch((error) => {
    console.log(error);
  });

  function pintar_lengua() {
    var ctx = document.getElementById("LENGUA").getContext("2d");

    var myChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: lengua.labels,
        datasets: [
          {
            label: "ocultar todo",
            data: lengua.data,
            backgroundColor: [
              "rgba(255, 99, 132, 0.2)",
              "rgba(54, 162, 235, 0.2)",
              "rgba(255, 206, 86, 0.2)",
              "rgba(75, 192, 192, 0.2)",
              "rgba(153, 102, 255, 0.2)",
              "rgba(255, 159, 64, 0.2)",
            ],
            borderColor: [
              "rgba(255, 99, 132, 1)",
              "rgba(54, 162, 235, 1)",
              "rgba(255, 206, 86, 1)",
              "rgba(75, 192, 192, 1)",
              "rgba(153, 102, 255, 1)",
              "rgba(255, 159, 64, 1)",
            ],
            borderWidth: 1,
          },
        ],
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
          },
        },
        plugins: {
          title: {
            display: true,
            text: "Lengua",
            font: {
              size: 20,
            },
          },
        },
      },
    });
  }

  //GRAFICANDO carrera propuesta
fetch("http://localhost/vinculacion1/servidor/modulos/estadisticas.php")
  .then((response) => {
    return response.json();
  })
  .then((value) => {
    for (let val in value.data.CARRERA_PROPUESTA) {
      carrera_propuesta.labels.push(val);
      carrera_propuesta.data.push(value.data.CARRERA_PROPUESTA[val]);
    }

    pintar_carreraP();
  })
  .catch((error) => {
    console.log(error);
  });

function pintar_carreraP() {
  var ctx = document.getElementById("CARRERA_PROPUESTA").getContext("2d");

  var myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: carrera_propuesta.labels,
      datasets: [
        {
          label: "ocultar todo",
          data: carrera_propuesta.data,
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
            "rgba(255, 159, 64, 1)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
      plugins: {
        title: {
          display: true,
          text: "Carrera Propuesta",
          font: {
            size: 20,
          },
        },
      },
    },
  });
}


  //GRAFICANDO carrera vigente
fetch("http://localhost/vinculacion1/servidor/modulos/estadisticas.php")
  .then((response) => {
    return response.json();
  })
  .then((value) => {
    for (let carrera in value.data.CARRERA_VIGENTE) {
      carrera_vigente.labels.push(carrera);
      carrera_vigente.data.push(value.data.CARRERA_VIGENTE[carrera]);
    }

    pintar_carreraV();
  })
  .catch((error) => {
    console.log(error);
  });

function pintar_carreraV() {
  var ctx = document.getElementById("CARRERA_VIGENTE").getContext("2d");

  var myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: carrera_vigente.labels,
      datasets: [
        {
          label: "ocultar todo",
          data: carrera_vigente.data,
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
            "rgba(255, 159, 64, 1)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
      plugins: {
        
        title: {
          display: true,
          text: "Carrera Vigente",

            font:{
              size: 20,
            }
        
        },
      },
    },
  });
}


