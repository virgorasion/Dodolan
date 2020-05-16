<?php 
include_once("_header.php");
require_once("core/Database.php");
session_start();
$db = new Database();
?> 

<body bgcolor="#f1f1f1">
    <div class="headpass">
        <h2>
            <b>Ganti Password</b>
        </h2>
    </div>
    <form id="passForm" method="post" action="service/ApiServices.php">
        <div class="pass">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="password" placeholder="Password lama" tabindex="2" id="password" class="form-control" name="password"
                        required data-error="Please enter your password">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="password" placeholder="Password baru" tabindex="2" id="password" class="form-control" name="password"
                        required data-error="Please enter your password">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12 row m-0">
                <div class="col-md-9 p-md-0">
                    <?php if (@$_COOKIE['alert']){ ?>
                    <span id="error" class="text-error text-danger">*<?=@$_COOKIE['alert']?>!</span>
                    <?php } ?>
                    <span class="text-register">*Lupa Password? <a href="register.php" style="text-decoration: underline !important">Contact Admin</a></span>
                </div>
                <input type="hidden" name="req" value="login">
                <button class="btn btn-common col-md-3" tabindex="3" id="submit" type="submit">Ganti</button>
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