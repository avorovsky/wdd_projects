<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    <div class="text-center" style="width: 100%;">
        <canvas class="my-4 w-100" id="sales" width="900" height="380"></canvas>
        <!-- img class="rounded" style="width: 100%;" src="/public/images/admin/logo.png"-->
    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script>
  var ctx = document.getElementById("sales");
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
      datasets: [{
        data: [7500, 17500, 25000, 15000, 30000, 27500, 13000],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false,
      }
    }
  });
</script>
