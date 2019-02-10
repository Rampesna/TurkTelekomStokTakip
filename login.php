<?php
session_start();
if ($_SESSION['giris'] == TRUE) {
    header("Location:index.php");
}

include("modules/header.php");
?>
<div class="login-page">
    <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
            <div class="row">
                <!-- Logo & Information Panel-->
                <div class="col-lg-6">
                    <div class="info d-flex align-items-center">
                        <div class="content">
                            <div class="logo">
                                <a href="login.php"><img src="img/tlk.png" width="300"/></a>
                                <h5>STOK TAKİP SİSTEMİ</h5>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Form Panel    -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">
                            <form method="post" action="login.php" class="form-validate">
                                <div class="form-group">
                                    <input id="login-username" type="text" name="username" required
                                           data-msg="Lütfen Kullanıcı adınızı Giriniz" class="input-material">
                                    <label for="login-username" class="label-material">Sicil Numarası</label>
                                </div>
                                <div class="form-group">
                                    <input id="login-password" type="password" name="password" required
                                           data-msg="Lütfen Şifrenizi Giriniz" class="input-material">
                                    <label for="login-password" class="label-material">Şifre</label>
                                </div>
                                <input name="gir" type="submit" id="login" class="btn btn-primary" value="Giriş Yap">
                                <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                            </form>
                            <?php
                            include("sistem/login-kontrol.php");
                            ?>
                            <a style="" href="sifre-hatirlat.php" class="forgot-pass">Şifrenizi mi Unuttunuz?</a><br>

                            <!--

                            <small>Do not have an account? </small>
                            <a href="register.html" class="signup">Signup</a>

                            -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("modules/footer.php");
?>
