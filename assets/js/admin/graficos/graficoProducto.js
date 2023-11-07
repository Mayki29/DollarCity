const ctx = document.getElementById('chartProducto');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Cocina', 'Hogar', 'Cuidado Personal', 'Limpieza', 'Alimentos', 'Mascota','otros'],
      datasets: [{
        label: '# Productos Stock',
        data: [40,24, 13, 25, 12, 9,10],
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

 
 