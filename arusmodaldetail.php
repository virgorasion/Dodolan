<?php 
include_once("_header.php");
require_once("core/Database.php");
session_start();
$db = new Database();
$kode = $_GET['kode'];
$tipe = substr($kode,3,4);
$dataTable = "";
if ($tipe == "BELI") {
    $dataTable = $db->select("SELECT a.kode_transaksi,a.harga_beli,a.jumlah_barang,a.subtotal,a.kode_satuan,b.nama_barang,c.nama_satuan FROM detail_transaksi_pembelian a, daftar_barang b, daftar_satuan c WHERE a.kode_transaksi = '$kode' AND a.id_barang = b.id AND a.kode_satuan = c.kode_satuan");
}else {
    $dataTable = $db->select("SELECT a.kode_transaksi,a.harga_barang as harga_beli,a.jumlah_barang,a.subtotal,a.kode_satuan,b.nama_barang,c.nama_satuan FROM detail_transaksi_penjualan a, daftar_barang b, daftar_satuan c WHERE a.kode_transaksi = '$kode' AND a.id_barang = b.id AND a.kode_satuan = c.kode_satuan");
}
?> 

<div class="container">
    <div class="arus row">
        <button id="back" class="btn btn-dark btn-lg col-md-1" style="height:40px;padding-top:3px;margin-top:7px"><i class="fas fa-angle-left"></i></button><h1>Detail Arus Modal</h1>
    </div>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Kode Transaksi</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Jumlah Barang</th>
      <th scope="col">satuan</th>
      <th scope="col">Harga Barang</th>
      <th scope="col">Total Harga</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($dataTable as $row){?>
    <tr>
      <th scope="row"><?=$row['kode_transaksi']?></th>
      <td><?=$row['nama_barang']?></td>
      <td><?=$row['jumlah_barang']?></td>
      <td><?=$row['nama_satuan']?></td>
      <td><?=$row['harga_beli']?></td>
      <td><?=$row['subtotal']?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>

<script>
    $("#back").click(function(){
        history.back();
    })
</script>