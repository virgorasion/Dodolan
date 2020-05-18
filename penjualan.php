<?php 
include_once("_header.php");
require_once("core/Database.php");
session_start();
$db = new Database();
$listBarang = $db->select("SELECT a.id,a.nama_barang,a.jumlah,a.harga_jual,a.kode_satuan FROM daftar_barang a WHERE a.kode_user = '".$_SESSION['kode_user']."'");
$listSatuan = $db->select("SELECT kode_satuan, nama_satuan FROM daftar_satuan WHERE kode_user = '".$_SESSION['kode_user']."'");
?>

<button id="btnCollapse" class="btn btn-lg btn-danger pl-5 position-absolute"
    style="z-index:9999;left:-30px;margin-top:80px"><i id="icon" class="fas fa-angle-left float-right"></i></button>
<div class="container-fluid">
    <div class="clearfix">
        <h3 class="float-left"><i class="fas fa-user"></i><?=@$_SESSION['nama']?></h3>
        <h3 class="float-right">Transaksi Penjualan</h3>
    </div>
    <div class="jumbotron pl-4 pr-1 pt-4 mb-0 pb-3" style="background: rgba(0, 204, 255,0.5)">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4" id="tabInput">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <div class="float-right">
                                <div class="form-group">
                                    <select id="nama_barang" name="nama_barang" class="form-control">
                                        <option>- Pilih Barang -</option>
                                        <?php foreach($listBarang as $data){ if ($data['jumlah'] == 0){?>
                                        <option label="<?=$data['nama_barang']?> (Stock Kosong)" value="<?=$data['id']?>" jumlah="<?=$data['jumlah']?>" harga="<?=$data['harga_jual']?>" satuan="<?=$data['kode_satuan']?>" disabled="disabled">
                                        <?php } ?>
                                        <option label="<?=$data['nama_barang']?>" value="<?=$data['id']?>" jumlah="<?=$data['jumlah']?>" harga="<?=$data['harga_jual']?>" satuan="<?=$data['kode_satuan']?>">
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input id="jumlah_barang" type="number" name="jumlah_barang" class="form-control"
                                        placeholder="Jumlah Barang" value="1">
                                </div>
                                <div class="form-group">
                                    <select id="satuan" name="satuan" class="form-control">
                                        <option>- Pilih Satuan -</option>
                                        <?php foreach($listSatuan as $data){ ?>
                                        <option label="<?=$data['nama_satuan']?>" value="<?=$data['kode_satuan']?>">
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="float-left">
                                <button class="btn btn-success btn-md" type="submit" id="submitBarang"> Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tabTable" class="col-md-8 table-responsive">
                    <form class="" action="service/apiservices.php?req=transaksi_penjualan" method="post">
                        <div class="table-responsive mb-2" style="max-height:300px">
                            <input type="hidden" id="counter" value="0">
                            <table class="table table-striped overflow-auto">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div id="pembayaran" class="col-md-13 row">
                            <p id="totalData">Data: 0</p>
                            <div class="form-group row col-md-4">
                                <label class="col-md-6">Total Bayar</label>
                                <input required type="text" name="total_bayar" id="totBayar" class="form-control col-md-6">
                            </div>
                            <div class="form-group row col-md-4">
                                <label class="col-md-6">Total Kurang</label>
                                <input type="text" name="total_kurang" id="totKurang" class="form-control col-md-6">
                            </div>
                            <div class="form-group row col-md-4">
                                <label class="col-md-6">Grand Total</label>
                                <input value="0" type="text" name="grand_total" id="total" class="form-control col-md-6">
                            </div>
                        </div>
                </div>
                <button class="btn btn-block btn-success mt-3" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function deleteData(counter) {
        let count = counter;
        $(".btnDelete").click(function () {
            let id = $(this).data("id");
            $("#" + id).remove();
            count--
            $("#totalData").html("Data: " + count);
        })
    }

    $("#totBayar").keyup(function () {
        $("#totKurang").val($("#total").val() - $(this).val());
    });

    $('#btnCollapse').on('click', function () {
        if ($(this).attr('data-click-state') == 1) {
            $(this).attr('data-click-state', 0);
            $("#tabInput").fadeIn(500);
            $(this).find($("#icon")).removeClass("fa-angle-right").addClass("fa-angle-left");
            $("#tabTable").removeClass("col-md-12").addClass("col-md-8");
            $("#pembayaran").removeClass("col-md-12").addClass("col-md-13");
        } else {
            $(this).attr('data-click-state', 1);
            $("#tabInput").fadeOut(500);
            $(this).find($("#icon")).removeClass("fa-angle-left").addClass("fa-angle-right");
            $("#tabTable").removeClass("col-md-8").addClass("col-md-12");
            $("#pembayaran").removeClass("col-md-13").addClass("col-md-12");
        }
    });
    
    $("#nama_barang").change(function(){
        let satuan = $("#nama_barang option[value='" + $('#nama_barang').val() + "']").attr('satuan');
        $("#satuan").val(satuan);
    });

    $("#jumlah_barang").on("change keyup",function(e){
        let jumlah_barang = $("#nama_barang option[value='" + $('#nama_barang').val() + "']").attr('jumlah');
        let val = parseInt($(this).val());
        if (val > jumlah_barang) {
            $(this).val(jumlah_barang);
            alert("Stock Barang Tidak Mencukupi");
        }
    })

    $("#submitBarang").click(function () {
        let counter = $("#counter").val()
        counter++
        let grand_total = $("#total").val()
        let id_barang = $("#nama_barang").val();
        let nama_barang = $("#nama_barang option[value='" + $('#nama_barang').val() + "']").attr('label');
        let jumlah = $("#nama_barang option[value='" + $('#nama_barang').val() + "']").attr('jumlah');
        let harga_barang = $("#nama_barang option[value='" + $('#nama_barang').val() + "']").attr('harga');
        console.log(id_barang);
        let jumlah_barang = $("#jumlah_barang").val();
        let satuan_value = $("#satuan").val();
        let satuan = $("#satuan option[value='" + $('#satuan').val() + "']").attr('label');
        let data = `
            <tr id="data` + counter + `">
                <th>` + counter + `</th>
                <td>` + nama_barang + `</td>
                <input type="hidden" name="id_barang[]" value="` + id_barang + `">
                <input type="hidden" name="nama_barang[]" value="` + nama_barang + `">
                <td>` + jumlah_barang + ` ` + satuan + `</td>
                <input type="hidden" name="jumlah_barang[]" value="` + jumlah_barang + `">
                <input type="hidden" name="satuan[]" value="` + satuan_value + `">
                <td>` + harga_barang + `</td>
                <input type="hidden" name="harga_barang[]" value="` + harga_barang + `">
                <td>` + (jumlah_barang * harga_barang) + `</td>
                <input type="hidden" name="subtotal[]" value="` + (jumlah_barang * harga_barang) + `">
                <td><button class="btn btn-sm btn-danger btnDelete" data-id="data` + counter + `"><i class="fas fa-trash"></i></button></td>
            </tr>
        `;
        $("tbody").append(data);
        $("#totalData").html("Data: " + counter);
        deleteData(counter);
        $("#counter").val(counter);
        $("#total").val(parseInt(grand_total) + (jumlah_barang * harga_barang));
    });
</script>
</body>

</html>