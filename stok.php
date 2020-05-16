<?php 
include_once("_header.php");
require_once("core/Database.php");
session_start();
$db = new Database();
$sql = "SELECT * FROM `daftar_barang`";
?> 

<div class="container">
    <div class="stok">
        <h1>Stok</h1>
    </div>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Jumlah Stok</th>
      <th scope="col">Tanggal Restock</th> 
      <th scope="col">Harga Beli</th>
      <th scope="col">Harga Jual</th>
      <th scope="col">Jumlah Terjual</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Indomie Goreng</td>
      <td>Indomie Goreng</td>
      <td>Indomie Goreng</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Indomie Soto</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Sedap Goreng</td>
    </tr>
  </tbody>
</table>
</div>