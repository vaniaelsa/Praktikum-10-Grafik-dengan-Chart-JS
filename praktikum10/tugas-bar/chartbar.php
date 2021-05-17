<?php
// menyertakan file koneksi.php untuk koneksi ke database
include('koneksi.php');
//mengambil data pada tabel tb_covid
$covid = mysqli_query($koneksi,"SELECT * FROM tb_covid");
while($row = mysqli_fetch_array($covid)){
	// array untuk menyimpan hasil query baris 5
	$negara[] = $row['negara'];
	$total_kasus[] = $row['total_kasus'];
    $kasus_baru[] = $row['kasus_baru'];
    $total_kematian[] = $row['total_kematian'];
    $kematian_baru[] = $row['kematian_baru'];
    $total_sembuh[] = $row['total_sembuh'];
    $kasus_aktif[] = $row['kasus_aktif'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Grafik Bar Penderita Covid-19 di 10 Negara </title>
	<!-- memanggil file Chart.js -->
	<script type="text/javascript" src="Chart.js"></script>
    <!-- pengaturan style untuk body dan h1-->
	<style>
        body {background-color: #E6E6FA; 
			  width: 100%;
			  margin: auto;
			  
             }
        h1 {
            text-align: center;
            font-family: tahoma;
            color:black;
            background-color: lightcoral;
        } 
	</style>
</head>
<h1> GRAFIK BAR PENDERITA COVID-19 </h1>
<body>
	<div style="width: 100%;height: 100%">
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
				datasets: [
                    {
					label: 'Total Kasus ',
					// bagian data dari chart berisi total kasus
					data: <?php echo json_encode($total_kasus); ?>,
					// memberi warna pada chart
					backgroundColor: 'rgba(147, 112, 219)',
					//memodifikasi border pada chart
					borderColor:  'rgba(186, 85, 211)',
					borderWidth: 3
				    },

                    {
					label: 'Kasus Baru ',
					// bagian data dari chart berisi kasus baru
					data: <?php echo json_encode($kasus_baru); ?>,
					// memberi warna pada chart
					backgroundColor: 'rgba(248, 248, 255)',
					//memodifikasi border pada chart
					borderColor: 'rgba(220, 220, 220)',
					borderWidth: 3
				    },

                    {
					label: 'Total Kematian ',
					// bagian data dari chart berisi total kematian
					data: <?php echo json_encode($total_kematian); ?>,
					// memberi warna pada chart
					backgroundColor: 'rgba(176, 196, 222)',
					//memodifikasi border pada chart
					borderColor:  'rgba(119, 136, 153)',
					borderWidth: 3
				    },

                    {
					label: 'Kematian Baru ',
					// bagian data dari chart berisi kematian baru
					data: <?php echo json_encode($kematian_baru); ?>,
					// memberi warna pada chart
					backgroundColor: 'rgba(173, 255, 48)',
					//memodifikasi border pada chart
					borderColor: 'rgba(27, 128, 1)',
					borderWidth: 3
				    },

                    {
					label: 'Total Sembuh ',
					// bagian data dari chart berisi total kesembuhan
					data: <?php echo json_encode($total_sembuh); ?>,
					// memberi warna pada chart
					backgroundColor: 'rgba(251, 127, 80)',
					//memodifikasi border pada chart
					borderColor:  'rgba(210, 105, 30)',
					borderWidth: 3
				    },

                    {
					label: 'Kasus Aktif ',
					// bagian data dari chart berisi kasus aktif
					data: <?php echo json_encode($kasus_aktif); ?>,
					// memberi warna pada chart
					backgroundColor: 'rgba(75, 192, 192, 0.2)',
					//memodifikasi border pada chart
					borderColor: 'rgba(75, 192, 192, 1)',
					borderWidth: 3
				    },
                ]
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