<?php
// menyertakan file koneksi.php
include('koneksi.php');
//mengambil data pada tabel tb_barang
$produk = mysqli_query($koneksi,"select * from tb_barang");
while($row = mysqli_fetch_array($produk)){
	// array untuk menyimpan nama barang hasil query baris 5
	$nama_produk[] = $row['barang'];
	
	//query untuk  menjumlahkan nilai pada kolom jumlah di tabel tb_penjualan
	$query = mysqli_query($koneksi,"select sum(jumlah) as jumlah from tb_penjualan where id_barang='".$row['id_barang']."'");
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
				// membuat label pada chart/grafik yang berisi nama barang
				labels: <?php echo json_encode($nama_produk); ?>,
				datasets: [{
					label: 'Grafik Penjualan',
					// bagian data dari chart
					data: <?php echo json_encode($jumlah_produk); ?>,
					// memberi warna pada chart
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					//memodifikasi border pada chart
					borderColor: 'rgba(255,99,132,1)',
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