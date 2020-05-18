<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="Assets/bootstrap-4.4.1/css/bootstrap.min.css">
    <script src="Assets/jquery/dist/jquery.js"></script>
    <script src="Assets/bootstrap-4.4.1/js/bootstrap.min.js"></script>

</head>

<body style="background: #A0A6AB !important;">
    <div class="headlogin mt-5">
        <img src="Assets/logo.png" alt="Iki Logo" width="200" height="50" />
    </div>
    <form id="loginForm" method="post" action="service/apiservices.php">
        <div class="login">
            <h4 class="col-md-12 text-center">Daftar Baru</h4>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" id="nama" name="nama" tabindex="1"
                        placeholder="Nama Lengkap" required data-error="Please enter your email/username">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" placeholder="Username" tabindex="2" id="username" class="form-control" name="username"
                        required data-error="Please enter your password">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="email" placeholder="Email" tabindex="2" id="email" class="form-control" name="email"
                        data-error="Please enter your password">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="password" placeholder="Password" tabindex="2" id="password" class="form-control" name="password"
                        required data-error="Please enter your password">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="password" placeholder="Konsirmasi Password" tabindex="2" id="konfirmasi_password" class="form-control" name="konfirmasi_password"
                        required data-error="Please enter your password">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12 row m-0">
                <div class="col-md-9 p-md-0">
                </div>
                <input type="hidden" name="req" value="register">
                <button class="btn btn-primary col-md-3" tabindex="3" id="submit" type="submit">Daftar</button>
            </div>
        </div>
    </form>
    
    <script>
        $("#submit").click(function(){
            if ($("#password").val() != $("#konfirmasi_password").val()) {
                alert("Password Tidak Sama");
                $("#konfirmasi_password").focus();
                return false;
            }
            $("#loginForm").submit();
        })
    </script>
</body>
</html>