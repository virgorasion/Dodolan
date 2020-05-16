<?php
require_once("../core/Database.php");
session_start();
$db = new Database();
$Request = @$_REQUEST['req'];

// function daftarSatuan($db)
// {
//     $kodeUser = "#USER3108001";
//     $dataSatuan = ['sachet','kg','g','mg','liter','bungkus','biji','renceng','lusin','gros','kodi','rim'];
//     foreach ($dataSatuan as $satuan) {
//         $data = [
//             "kode_user" => $kodeUser,
//             "nama_satuan" => ucfirst($satuan),
//             "status" => 1
//         ];
//         $db->insert("daftar_satuan",$data);
//     }
// }

// function dummyBarang($db)
// {
//     $kodeUser = "#USER3108001";
//     $listBarang = [
//         'Autan',
//         'Rokok Samsu',
//         'Beras',
//         'Gula',
//         'telur',
//         'gula merah',
//         'kerupuk',
//         'heirs',
//         'kopi kapal api kecil',
//         'goodday freast',
//         'indomie goreng',
//         'indomie soto',
//         'sedap goreng',
//         'sedap soto',
//         'sedap kari sepsial'
//     ];
//     foreach ($listBarang as $val ) {
//         $data = [
//             "kode_user" => $kodeUser,
//             "nama_barang" => $val,
//             "jumlah" => rand(1,20),
//             "kode_satuan" => rand(1,12),
//             "tanggal_restock" => date("Y-m-d"),
//             "harga_beli" => rand(1000,10000),
//             "harga_jual" => rand(10000,20000),
//             "jumlah_terjual" => rand(10,100)
//         ];
//         $db->insert("daftar_barang",$data);
//     }
// }

function createKodeUser(){
    $kode = "#USR".date("dHis");
    return $kode;
}

function createKodeTransaksi($tipe){
    $kode = "#TRX";
}

if ($Request == "daftar_barang") {
    $getData = $db->select("SELECT * FROM daftar_barang");
    var_dump($getData);
}
elseif ($Request == "login") {
    $username = $_POST['username'];
    $auth = $db->select("SELECT * FROM user_login WHERE username = '". mysqli_real_escape_string($db->koneksi,$username)."'");
    if (count($auth) > 0) {
        $password = password_verify($_POST['password'],$auth[0]['password']);
        if ($password) {
            $tokenID = md5($username.random_int(1,999));
            // $db->update("user_login",["token"=>$tokenID],$auth[0]['id']);
            $_SESSION["token"] = $tokenID;
            $_SESSION["username"] = $username;
            $_SESSION["nama"] = $auth[0]['nama'];
            $_SESSION["kode_user"] = $auth[0]['kode_user'];
            header("location: ../dashboard.php");
        }else {
            setcookie("alert","Password Salah !", time() + (15),"/");
            header("location: ../index.php");
        }
    }else {
        setcookie("alert","Username Tidak Ditemukan", time() + (15),"/");
        header("location: ../index.php");
    }
}
elseif ($Request == "register") {
    $nama = $_POST['nama'];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST['email'];
    $data = [
        "kode_user" => createKodeUser(),
        "nama" => $nama,
        "username" => $username,
        "password" => password_hash($password,PASSWORD_BCRYPT),
        "email" => $email
    ];
    $result = $db->insert("user_login",$data);
    return $result;
}
elseif ($Request == "tambah_barang") {
    $data = [
        "kode_user" => $_SESSION['kode_user'],
        "nama_barang" => $_POST['nama_barang'],
        "jumlah" => $_POST['jumlah'],
        "kode_satuan" => $_POST['kode_satuan'],
        "tanggal_restock" => date("Y-m-d"),
        "harga_beli" => $_POST['harga_beli'],
        "harga_jual" => $_POST['harga_jual']
    ];
    return $db->insert("daftar_barang",$data);
}
elseif ($Request == "tambah_satuan") {
    $data = [
        "kode_user" => $_SESSION['kode_user'],
        "nama_satuan" => $_POST['nama_satuan']
    ];
    return $db->insert("daftar_satuan",$data);
}
elseif ($Request == "transaksi_pembelian") {
    $kode_transaksi = createKodeTransaksi("Beli");
    $dataTransaksi = [
        "kode_user" => $_SESSION['kode_user'],
        "kode_transaksi" => $kode_transaksi,
        "tanggal" => date("Y-m-d"),
        "total_pembelian" => $_POST['total_pembelian'],
        "total_bayar" => $_POST['total_bayar'],
        "total_kurang" => $_POST['total_kurang'],
        "catatan" => $_POST['catatan']
    ];

    foreach ($_POST['nama'] as $key => $val) {
        $dataDetailTransaksi = [
            "kode_user" => $_SESSION["kode_user"],
            "kode_transaksi" => $kode_transaksi,
            "id_barang" => $_POST["id_barang[$key]"],
            "harga_beli" => $_POST["harga_beli[$key]"],
            "jumlah_barang" => $_POST["jumlah_barang[$key]"],
            "subtotal" => $_POST["subtotal[$key]"],
            "kode_satuan" => $_POST["kode_satuan[$key]"]
        ];
        $insertDetail = $db->insert("detail_transaksi_pembelian", $dataDetailTransaksi);
    }
    return $db->insert("transaksi_pembelian", $dataTransaksi);
}
elseif ($Request == "transaksi_penjualan") {
    $kode_transaksi = createKodeTransaksi("Jual");
    $dataTransaksi = [
        "kode_user" => $_SESSION['kode_user'],
        "kode_transaksi" => $kode_transaksi,
        "tanggal" => date("Y-m-d"),
        "total_harga" => $_POST['total_harga'],
        "total_bayar" => $_POST['total_bayar'],
        "total_kurang" => $_POST['total_kurang'],
        "catatan" => $_POST['catatan']
    ];

    foreach ($_POST['nama'] as $key => $val) {
        $dataDetailTransaksi = [
            "kode_user" => $_SESSION["kode_user"],
            "kode_transaksi" => $kode_transaksi,
            "id_barang" => $_POST["id_barang[$key]"],
            "harga_barang" => $_POST["harga_beli[$key]"],
            "jumlah_barang" => $_POST["jumlah_barang[$key]"],
            "subtotal" => $_POST["subtotal[$key]"],
            "kode_satuan" => $_POST["kode_satuan[$key]"]
        ];
        $insertDetail = $db->insert("detail_transaksi_penjualan", $dataDetailTransaksi);
    }
    return $db->insert("transaksi_penjualan",$data);
}
