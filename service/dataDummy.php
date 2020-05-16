<?php
require_once("../core/Database.php");
$db = new Database();

function daftarSatuan($db)
{
    $kodeUser = "#USER3108001";
    $dataSatuan = ['sachet','kg','g','mg','liter','bungkus','biji','renceng','lusin','gros','kodi','rim'];
    foreach ($dataSatuan as $satuan) {
        $data = [
            "kode_user" => $kodeUser,
            "nama_satuan" => ucfirst($satuan),
            "status" => 1
        ];
        $db->insert("daftar_satuan",$data);
    }
}

function dummyBarang($db)
{
    $kodeUser = "#USER3108001";
    $listBarang = [
        'Autan',
        'Rokok Samsu',
        'Beras',
        'Gula',
        'telur',
        'gula merah',
        'kerupuk',
        'heirs',
        'kopi kapal api kecil',
        'goodday freast',
        'indomie goreng',
        'indomie soto',
        'sedap goreng',
        'sedap soto',
        'sedap kari sepsial'
    ];
    foreach ($listBarang as $val ) {
        $data = [
            "kode_user" => $kodeUser,
            "nama_barang" => $val,
            "jumlah" => rand(1,20),
            "kode_satuan" => rand(1,12),
            "tanggal_restock" => date("Y-m-d"),
            "harga_beli" => rand(1000,10000),
            "harga_jual" => rand(10000,20000),
            "jumlah_terjual" => rand(10,100)
        ];
        $db->insert("daftar_barang",$data);
    }
}

function createDataPembelian($db)
{
    $dataBarang = $db->select("SELECT * FROM daftar_barang");
}
