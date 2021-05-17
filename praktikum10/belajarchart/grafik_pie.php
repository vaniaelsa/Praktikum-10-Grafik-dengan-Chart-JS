<?php
// menyertakan file koneksi.php
include('koneksi.php');
// query untuk mengambil data di tabel tb_barang,
$produk = mysqli_query($koneksi,"select * from tb_barang");
while($row = mysqli_fetch_array($produk)){
	// array untuk label chart berisi nama barang
	$nama_produk[] = $row['barang'];
	
	// query untuk menghitung jumlah di kolom jumlah pada tabel tb_penjualan untuk setiap barangnya,
	$query = mysqli_query($koneksi,"select sum(jumlah) as jumlah from tb_penjualan where id_barang='".$row['id_barang']."'");
	$row = $query->fetch_array();
	// array untuk menyimpan data jumlah penjualan disetiap barangnya
	$jumlah_produk[] = $row['jumlah'];
}
?>
<!doctype html>
<html>

<head>
	<title>Pie Chart</title>
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
					data:<?php echo json_encode($jumlah_produk); ?>,
					// warna pada chart pie
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)'
					],
					//memodifikasi border pada chart
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)'
					],
					label: 'Presentase Penjualan Barang'
				}],
				// label pada chart untuk setiap nama barang
				labels: <?php echo json_encode($nama_produk); ?>},
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
