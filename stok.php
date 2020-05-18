<?php 
include_once("_header.php");
require_once("core/Database.php");
session_start();
$db = new Database();
$dataStock = $db->select("SELECT * FROM daftar_barang WHERE kode_user = '".$_SESSION['kode_user']."' ORDER BY tanggal_restock desc");
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
				<th scope="col">Harga Beli</th>
				<th scope="col">Harga Jual</th>
				<th scope="col">Jumlah Terjual</th>
				<th scope="col">Tanggal Restock</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; foreach($dataStock as $data){ ?>
			<tr>
				<td scope="row"><?=$no?></td>
				<td><?= $data["nama_barang"]?></td>
				<td><?= $data["jumlah"]?></td>
				<td><?= $data["harga_beli"]?></td>
				<td><?= $data["harga_jual"]?></td>
				<td><?= $data["jumlah_terjual"]?></td>
				<td><?= $data["tanggal_restock"]?></td>
			</tr>
			<?php $no++; } ?>
		</tbody>
	</table>
</div>