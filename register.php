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

<body bgcolor="#f1f1f1">
    <div class="headregis">
        <img src="Assets/logo.png" alt="Iki Logo" width="150" height="40" />
        <h2>
            <b>Register</b>
        </h2>
    </div>
    <form id="regisForm" method="post" action="service/ApiServices.php">
        <div class="regis">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" id="name" name="name" tabindex="1"
                        placeholder="Nama Lengkap" required data-error="Please enter your name">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" tabindex="1"
                        placeholder="Username" required data-error="Please enter your username">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" id="email" name="email" tabindex="1"
                        placeholder="Email" required data-error="Please enter your email">
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
                    <input type="password" placeholder="Konfirmasi Password" tabindex="2" id="password" class="form-control" name="password"
                        required data-error="Please enter your password">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12 row m-0">
                <div class="col-md-9 p-md-0">
                    <?php if (@$_COOKIE['alert']){ ?>
                    <span id="error" class="text-error text-danger">*<?=@$_COOKIE['alert']?>!</span>
                    <?php } ?>
                    <span class="text-register">*Sudah Memiliki Akun? <a href="index.php" style="text-decoration: underline !important">Masuk</a></span>
                </div>
                <input type="hidden" name="req" value="login">
                <button class="btn btn-common col-md-3" tabindex="3" id="submit" type="submit">Register</button>
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