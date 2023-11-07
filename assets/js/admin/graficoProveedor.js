const ctx = document.getElementById('chartProveedor');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['S.A.C', 'S.A.C.S', 'S.A', 'S.R.L', 'E.I.R.L', 'S.A.A'],
      datasets: [{
        label: 'Proveedores',
        data: [2 ,3 , 1, 4, 5, 2],
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(201, 203, 207, 0.2)'
          ],
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)'
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

 
 