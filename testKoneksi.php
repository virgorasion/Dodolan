<?php

require_once("core/Database.php");

$koneksi = new Database();

$test = $koneksi->select("SELECT * FROM daftar_satuan");

foreach($test as $data){
    echo $data["nama_satuan"]."<br>";
}

// $test = $koneksi->insert("daftar_satuan",["nama_satuan"=>"renceng","status"=>1]);
// $test = $koneksi->update("daftar_satuan",["status"=>1],["kode_satuan"=>6]);
// $test = $koneksi->delete("daftar_satuan",["kode_satuan"=>6]);
var_dump($test);