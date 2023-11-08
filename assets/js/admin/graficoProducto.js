const ctx = document.getElementById('chartProducto');
let grafico = new Chart(ctx, {
  type: 'bar',
  data: {
    datasets: [{
      label: '# Productos Stock',
      data: [datos[0], datos[1], datos[2], datos[3], datos[4], datos[5], datos[6]],
      parsing: {
        xAxisKey: 'Nombre',
        yAxisKey: 'Cantidad'
      },
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)',
        'rgba(198, 20, 203, 0.2)'
      ],
      borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)',
        'rgb(200, 202, 203)'

      ],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }

  }
});


function actualizarDatos(datos) {
  grafico.data.datasets[0].data = datos;
  grafico.update();
}

function addData(chart, label, newData) {
  chart.data.labels.push(label);
  chart.data.datasets.forEach((dataset) => {
    dataset.data.push(newData);
  });
  chart.update();
}

function removeData(chart) {
  chart.data.labels.pop();
  chart.data.datasets.forEach((dataset) => {
      dataset.data.pop();
  });
  chart.update();
}




