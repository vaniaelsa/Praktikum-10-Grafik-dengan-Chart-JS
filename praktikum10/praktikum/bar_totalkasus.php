<?php
// menyertakan file koneksi.php untuk koneksi ke database
include('koneksi.php');
//mengambil data pada tabel tb_covid
$covid = mysqli_query($koneksi,"SELECT * FROM tb_covid");
while($row = mysqli_fetch_array($covid)){
	// array untuk menyimpan hasil query baris 5
	$negara[] = $row['negara'];
	$total_kasus[] = $row['total_kasus'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Grafik Bar Total Kasus </title>
	<!-- memanggil file Chart.js -->
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<div style="width: 800px;height: 800px">
		<!-- membuat grafik dengan id myChart -->
		<canvas id="myChart"></canvas>
	</div>
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			// tipe chart adalah bar
			type: 'bar',
			data: {
				// membuat label pada chart/grafik yang berisi nama negara
				labels: <?php echo json_encode($negara); ?>,
				datasets: [{
					label: 'Grafik Total Kasus Covid-19 10 Negara',
					// bagian data dari chart berisi total kasus
					data: <?php echo json_encode($total_kasus); ?>,
					// memberi warna pada chart
					backgroundColor: 'rgba(240, 248, 254)',
					//memodifikasi border pada chart
					borderColor: 'rgba(0, 255, 254)',
					borderWidth: 3
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>