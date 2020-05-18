<?php 
include_once("_header.php");
require_once("core/Database.php");
session_start();
$db = new Database();
$dataTable = $db->query("SELECT id,kode_user,kode_transaksi,tanggal,total_harga,total_bayar,total_kurang,catatan,log_time FROM transaksi_penjualan
WHERE kode_user = '".$_SESSION['kode_user']."'
UNION
SELECT id,kode_user,kode_transaksi,tanggal,total_pembelian as total_harga,total_bayar,total_kurang,catatan,log_time FROM transaksi_pembelian
WHERE kode_user = '".$_SESSION['kode_user']."'
ORDER BY log_time");
?> 

<div class="container">
    <div class="arus">
        <h1>Arus Modal</h1>
    </div>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Kode Transaksi</th>
      <th scope="col">Tanggal</th>
      <th scope="col">Total Harga</th>
      <th scope="col">Total Bayar</th>
      <th scope="col">Total Kurang</th>
      <th scope="col">Catatan</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($dataTable as $row){?>
    <tr>
      <th scope="row"><a href="arusmodaldetail.php?kode=<?=$row['kode_transaksi']?>"><?=$row['kode_transaksi']?></a></th>
      <td><?=$row['tanggal']?></td>
      <td><?=$row['total_harga']?></td>
      <td><?=$row['total_bayar']?></td>
      <td><?=$row['total_kurang']?></td>
      <td><?=$row['catatan']?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>