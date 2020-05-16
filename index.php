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
    <div class="headlogin">
        <img src="Assets/logo.png" alt="Iki Logo" width="200" height="50" />
    </div>
    <form id="loginForm" method="post" action="service/ApiServices.php">
        <div class="login">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" tabindex="1"
                        placeholder="Masukkan Email/Username" required data-error="Please enter your email/username">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="password" placeholder="Masukkan Password" tabindex="2" id="password" class="form-control" name="password"
                        required data-error="Please enter your password">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12 row m-0">
                <div class="col-md-9 p-md-0">
                    <?php if (@$_COOKIE['alert']){ ?>
                    <span id="error" class="text-error text-danger"><b>*<?=@$_COOKIE['alert']?></b></span>
                    <?php } ?>
                    <span class="text-register">*Belum punya akun ? <a href="register.php" style="text-decoration: underline !important">Register</a></span>
                </div>
                <input type="hidden" name="req" value="login">
                <button class="btn btn-primary col-md-3" tabindex="3" id="submit" type="submit">Masuk</button>
            </div>
        </div>
    </form>
    
    <script>
        if ($("#error").length) {
            $(".text-register").css("display","none");
            $(".text-error").fadeTo(2000, 500).slideUp(500, function () {
                $(".text-register").slideToggle(500);
            });
        }
    </script>
</body>
</html>