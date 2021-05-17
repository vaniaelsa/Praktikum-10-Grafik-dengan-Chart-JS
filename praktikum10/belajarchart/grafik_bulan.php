<?php
// menyertakan file koneksi.php
include('koneksi.php');
//array label berisi nama bulan yang akan dijadikan label dari chart/grafik
$label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

//perulangan untuk menghitung penjualan setiap bulannya
for($bulan = 1;$bulan < 13;$bulan++)
{
	//query untuk  menjumlahkan nilai pada kolom jumlah di tabel tb_penjualan pada setiap bulan pada variabel bulan
	$query = mysqli_query($koneksi,"select sum(jumlah) as jumlah from tb_penjualan where MONTH(tgl_penjualan)='$bulan'");
	//variabel row untuk menyimpan hasil query di baris 11
	$row = $query->fetch_array();
	//menyimpan data jumlah disetiap barang yang terjual di tabel tb_penjualan
	$jumlah_produk[] = $row['jumlah'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Membuat Grafik Menggunakan Chart JS</title>
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
				// membuat label pada chart/grafik yang berisi nama bulan
				labels: <?php echo json_encode($label); ?>,
				datasets: [{
					label: 'Grafik Penjualan',
					// bagian data dari chart
					data: <?php echo json_encode($jumlah_produk); ?>,
					borderWidth: 1
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