<?php 
include_once("_header.php");
require_once("core/Database.php");
session_start();
$db = new Database();
$totalPenjualan = $db->select("SELECT count(id) as jual FROM transaksi_penjualan WHERE kode_user = '".$_SESSION['kode_user']."' AND tanggal BETWEEN '".date('Y-m-01')."' AND '".date('Y-m-t')."' ");
$produkTerjual = $db->select("SELECT sum(a.jumlah_barang) as jumlah FROM detail_transaksi_penjualan a, transaksi_penjualan b WHERE a.kode_transaksi = b.kode_transaksi AND a.kode_user = '".$_SESSION['kode_user']."' AND b.tanggal BETWEEN '".date('Y-m-01')."' AND '".date('Y-m-t')."'");
$jumlahPendapatan = $db->select("SELECT sum(total_bayar) as pendapatan FROM transaksi_penjualan WHERE kode_user = '".$_SESSION['kode_user']."' AND tanggal BETWEEN '".date('Y-m-01')."' AND '".date('Y-m-t')."'");
$totalUntung = $db->select("SELECT sum(a.subtotal - b.harga_beli * a.jumlah_barang) AS untung FROM detail_transaksi_penjualan a, daftar_barang b, transaksi_penjualan c WHERE a.kode_user = '".$_SESSION['kode_user']."' AND a.id_barang = b.id AND a.kode_transaksi = c.kode_transaksi AND c.tanggal BETWEEN '".date('Y-m-01')."' AND '".date('Y-m-t')."'");
$dataGrafik = $db->select("SELECT COUNT(a.id) as jumlah_transaksi, SUM(b.jumlah_barang) AS jumlah_barang, SUM(a.total_bayar) AS pendapatan, sum(b.subtotal - c.harga_beli * b.jumlah_barang) AS untung, MONTHNAME(a.tanggal) AS tanggal ,(a.tanggal) as tgl
                            FROM transaksi_penjualan a, detail_transaksi_penjualan b, daftar_barang c 
                            WHERE a.kode_user = '".$_SESSION['kode_user']."'
                            AND a.kode_transaksi = b.kode_transaksi
                            AND b.id_barang = c.id
                            GROUP BY MONTH(tgl)");
$produkTerlaris = $db->select("SELECT nama_barang, jumlah_terjual FROM daftar_barang WHERE kode_user = '".$_SESSION['kode_user']."' ORDER BY jumlah_terjual desc limit 5 ");
?>

<div class="container">
    <div class="clearfix">
        <h3><?=@$_SESSION['nama']?></h3>
    </div>
    <div class="jumbotron" style="background: rgba(0, 204, 255,0.5)">
        <div class="container">
            <div class="col-md-12 pl-0 pr-0" style="margin-top:-30px">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card border-danger mb-3">
                            <div class="card-body bg-danger text-light">
                                <h5 class="card-title">Total Penjualan</h5>
                                <h3 class="card-text"><?=$totalPenjualan[0]['jual']?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-primary mb-3">
                            <div class="card-body bg-primary text-light">
                                <h5 class="card-title">Produk Terjual</h5>
                                <h3 class="card-text"><?=$produkTerjual[0]["jumlah"]?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-warning mb-3">
                            <div class="card-body bg-warning text-light">
                                <h5 class="card-title">Total Pendapatan</h5>
                                <h3 class="card-text"><?=number_format($jumlahPendapatan[0]["pendapatan"],0,",",".")?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-success mb-3">
                            <div class="card-body bg-success text-light warning">
                                <h5 class="card-title">Untung</h5>
                                <h3 class="card-text"><?=number_format($totalUntung[0]['untung'],0,",",".")?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-group">
                <div class="card col-md-8">
                    <div class="card-body">
                        <!-- <h4 class="card-title">Title</h4> -->
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
                <div class="card col-md-4">
                    <div class="card-body">
                        <h4 class="card-title">Produk Terlaris</h4>
                        <table class="table table-striped" style="font-size:12px">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Stok Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach($produkTerlaris as $data){ ?>
                                <tr>
                                    <td><?=$no?></td>
                                    <td><?=$data['nama_barang']?></td>
                                    <td><?=$data['jumlah_terjual']?></td>
                                </tr>
                                <?php $no++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var lineChartData = {
        labels: [<?php foreach($dataGrafik as $data){ echo "'".$data["tanggal"]."',"; }?>],
        datasets: [{
            label: 'Tutal Penjualan',
            borderColor: 'rgb(255, 99, 132)',
            backgroundColor: 'rgb(255, 99, 132)',
            fill: false,
            data: [
                <?php foreach($dataGrafik as $data){ echo "'".$data["jumlah_transaksi"]."',"; }?>
            ],
            yAxisID: 'y-axis-1',
        }, {
            label: 'Produk Terlaris',
            borderColor: 'rgb(54, 162, 235)',
            backgroundColor: 'rgb(54, 162, 235)',
            fill: false,
            data: [
                <?php foreach($dataGrafik as $data){ echo "'".$data["jumlah_barang"]."',"; }?>
            ],
            yAxisID: 'y-axis-2'
        }, {
            label: 'Pendapatan',
            borderColor: 'rgb(255, 205, 86)',
            backgroundColor: 'rgb(255, 205, 86)',
            fill: false,
            data: [
                <?php foreach($dataGrafik as $data){ echo "'".$data["pendapatan"]."',"; }?>
            ],
            yAxisID: 'y-axis-3'
        }, {
            label: 'Untung',
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgb(75, 192, 192)',
            fill: false,
            data: [
                <?php foreach($dataGrafik as $data){ echo "'".$data["untung"]."',"; }?>
            ],
            yAxisID: 'y-axis-4'
        }]
    };

    window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = Chart.Line(ctx, {
				data: lineChartData,
				options: {
					responsive: true,
					hoverMode: 'index',
					stacked: false,
					title: {
						display: true,
						text: 'Iki Jenenge Grafik'
					},
					scales: {
						yAxes: [{
							type: 'linear', 
							display: true,
							position: 'left',
							id: 'y-axis-1',
						},{
							type: 'linear', 
							display: true,
							position: 'left',
							id: 'y-axis-2',
						},{
							type: 'linear', 
							display: true,
							position: 'left',
							id: 'y-axis-3',
						}, {
							type: 'linear', 
							display: true,
							position: 'right',
							id: 'y-axis-4',

							// grid line settings
							gridLines: {
								drawOnChartArea: false, // only want the grid lines for one axis to show up
							},
						}],
					}
				}
			});
		};
</script>
</body>
</html>