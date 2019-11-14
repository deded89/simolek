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
				data: [	1.87, 5.77, 15.33, 23.86, 32.51, 46.58, 55.73, 63.13, 44.85, 62.81, 78.31, 100		]
			}, {
				label: 'Rencana',
        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
        borderColor: window.chartColors.blue,
				borderWidth: 1,
				data: [	1.87, 5.77, 15.33, 23.86, 32.51, 46.58, 55.73, 63.13, 44.85, 62.81, 78.31, 100		]
			}, {
				label: 'Realisasi',
        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
        borderColor: window.chartColors.red,
				borderWidth: 1,
				data: [ 0.80, 2.76, 5.93, 9.91, 15.71, 19.22, 26.48, 33.83, 38.73 				]
			}]

		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					legend: {
						display: false,
					},
					title: {
						display: true,
            fontSize: 24,
						text:[ 'Rencana dan Realisasi Keuangan Pemerintah Kota Banjarmasin Kondisi Per 30 September 2019' , 'APBD-P Tahun Anggaran 2019']
					},
          responsive: true,
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
