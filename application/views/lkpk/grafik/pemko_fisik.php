<style media="screen">
  #container{
    background-color: white;
  }
</style>
	<div id="container">
		<canvas id="canvas" style="width: 90%; height: 70vh"></canvas>
	</div>
  <script src="<?php echo base_url();?>assets/dist/js/Chart.min.js"></script>
	<script src="<?php echo base_url();?>assets/dist/js/utils.js"></script>
	<script src="<?php echo base_url();?>assets/dist/js/chartjs-plugin-datalabels.min.js"></script>
	<script>
		var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		var color = Chart.helpers.color;
		var barChartData = {
			labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [{
        datalabels: {
            display: false
        },
        legend:{
          display: false,
        },
        pointRadius: 0,
        type:'line',
        fill: false,
				label: 'Rencana',
        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
        borderColor: window.chartColors.blue,
				borderWidth: 1,
				data: [	1.98, 5.85, 13.83, 23.53, 31.98, 46.28, 54.8, 61.51, 45.29 ]
			}, {
				label: 'Rencana',
        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
        borderColor: window.chartColors.blue,
				borderWidth: 1,
				data: [	1.98, 5.85, 13.83, 23.53, 31.98, 46.28, 54.8, 61.51, 45.29 ]
			}, {
				label: 'Realisasi',
        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
        borderColor: window.chartColors.red,
				borderWidth: 1,
				data: [ 1.18, 3.69, 6.92, 11.70, 16.53, 21.06, 28.52, 45.5, 43.04	]
			}]

		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					legend: {
						display: false,
					},
					title: {
						display: true,
            fontSize: 24,
						text:[ 'Rencana dan Realisasi Fisik Pemerintah Kota Banjarmasin Kondisi Per 30 September 2019' , 'APBD-P Tahun Anggaran 2019']
					},
          responsive: true,
          // maintainAspectRatio : true,
          plugins: {
            datalabels: {
              anchor: "end",
              align: "top",
              formatter: function(value) {
              	return value + ' %';
              }
            }
          }
				}
			});

		};
	</script>
