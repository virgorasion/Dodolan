<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Pakai</title>
    <link rel="stylesheet" href="Assets/bootstrap-4.4.1/css/bootstrap.min.css">
</head>
<body>
    
<div class="awal">Belajar Jquery</div>

<div class="row">
    <button class="col-3 bg-success m-2 text-center text-white" id="Test1">Ganti 1</button>
    <button class="col-3 bg-success m-2 text-center text-white" id="Test2">Ganti 2</button>
    <button class="col-3 bg-success m-2 text-center text-white" id="Test3">Ganti 3</button>
</div>
<div class="row">
    <div class="col-12 bg-primary" style="height:100px;display:none" id="buka1">&nbsp;</div>
    <div class="col-12 bg-warning" style="height:100px;display:none" id="buka2">&nbsp;</div>
    <div class="col-12 bg-danger" style="height:100px;display:none" id="buka3">&nbsp;</div>
</div>

<!-- Jquery harus diatas bootstrap -->
<script src="Assets/jquery/dist/jquery.js"></script>
<script src="Assets/bootstrap-4.4.1/js/bootstrap.min.js"></script>
<script>
// Tulis Script JS disini
$(document).ready(function(){
    $("#Test1").click(function(){
        $("#buka1").slideToggle()
    });
    $("#Test2").click(function(){
        $("#buka2").fadeToggle()
    });
    $("#Test3").click(function(){
        $("#buka3").show()
    });
});
</script>
</body>
</html>
