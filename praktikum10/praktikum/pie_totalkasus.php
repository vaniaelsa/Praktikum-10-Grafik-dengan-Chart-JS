<?php
// menyertakan file koneksi.php
include('koneksi.php');
// query untuk mengambil data di tabel tb_covid,
$covid = mysqli_query($koneksi,"SELECT * FROM tb_covid");
while($row = mysqli_fetch_array($covid)){
	// array untuk hasil query pada baris 5
	$negara[] = $row['negara'];
	$total_kasus[] = $row['total_kasus'];
}
?>
<!doctype html>
<html>

<head>
	<title>Grafik Pie Total Kasus</title>
	<!-- memanggil file chart.js untuk membuat chart -->
	<script type="text/javascript" src="Chart.js"></script>
</head>

<body>
	<div id="canvas-holder" style="width:50%">
		<!-- membuat grafik dengan id chart-area -->
		<canvas id="chart-area"></canvas>
	</div>
	<script>
		var config = {
			// chart/grafik tipe pie
			type: 'pie',
			data: {
				datasets: [{
					// bagian data dari chart
					data:<?php echo json_encode($total_kasus); ?>,
					// warna pada chart pie
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
                    'rgba(240, 248, 254)',
                    'rgba(248, 248, 255)',
                    'rgba(176, 196, 222)',
                    'rgba(173, 255, 48)',
                    'rgba(251, 127, 80)',
                    'rgba(100, 149, 237)'
					],
					//memodifikasi border pada chart
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
                    'rgba(0, 255, 254)',
                    'rgba(220, 220, 220)',
                    'rgba(119, 136, 153)',
                    'rgba(27, 128, 1)',
                    'rgba(210, 105, 30)',
                    'rgba(0, 0, 255)'
					],
					label: 'Grafik Total Kasus Covid-19 10 Negara'
				}],
				// label pada chart untuk setiap nama negara
				labels: <?php echo json_encode($negara); ?>},
			options: {
				responsive: true
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
		};

		document.getElementById('randomizeData').addEventListener('click', function() {
			config.data.datasets.forEach(function(dataset) {
				dataset.data = dataset.data.map(function() {
					return randomScalingFactor();
				});
			});

			window.myPie.update();
		});

		var colorNames = Object.keys(window.chartColors);
		document.getElementById('addDataset').addEventListener('click', function() {
			var newDataset = {
				backgroundColor: [],
				data: [],
				label: 'New dataset ' + config.data.datasets.length,
			};

			for (var index = 0; index < config.data.labels.length; ++index) {
				newDataset.data.push(randomScalingFactor());

				var colorName = colorNames[index % colorNames.length];
				var newColor = window.chartColors[colorName];
				newDataset.backgroundColor.push(newColor);
			}

			config.data.datasets.push(newDataset);
			window.myPie.update();
		});

		document.getElementById('removeDataset').addEventListener('click', function() {
			config.data.datasets.splice(0, 1);
			window.myPie.update();
		});
	</script>
</body>
</html>
