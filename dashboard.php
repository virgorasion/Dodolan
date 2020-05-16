<?php 
include_once("_header.php");
require_once("core/Database.php");
session_start();
$db = new Database();
$totalTransaksi = $db->select("SELECT a.id FROM detail_transaksi_penjualan a,transaksi_penjualan b WHERE a.kode_transaksi = b.kode_transaksi AND b.tanggal = '".date('Y-m-d')."'");

?>

<div class="container">
    <div class="clearfix">
        <h3><?=@$_SESSION['nama']?></h3>
    </div>
    <div class="jumbotron" style="background: rgba(0, 204, 255,0.5)">
        <div class="container">
            <div class="col-md-12" style="margin-top:-30px">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card border-danger mb-3">
                            <div class="card-body bg-danger text-light">
                                <h5 class="card-title">Total Transaksi</h5>
                                <h3 class="card-text"><?=count($totalTransaksi)?> Trx</h3>
                            </div>
                            <div class="card-footer bg-transparent border-danger">Footer</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-primary mb-3">
                            <div class="card-body bg-primary text-light">
                                <h5 class="card-title">Total Penghasilan</h5>
                                <h3 class="card-text">210.000</h3>
                            </div>
                            <div class="card-footer bg-transparent border-primary">Footer</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-warning mb-3">
                            <div class="card-body bg-warning text-light">
                                <h5 class="card-title">Total Modal</h5>
                                <h3 class="card-text">5.000.000</h3>
                            </div>
                            <div class="card-footer bg-transparent border-warning">Footer</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-success mb-3">
                            <div class="card-body bg-success text-light warning">
                                <h5 class="card-title">Untung</h5>
                                <h3 class="card-text">3.000.000</h3>
                            </div>
                            <div class="card-footer bg-transparent border-success">Footer</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>