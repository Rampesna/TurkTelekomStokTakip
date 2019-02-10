<?php
session_start();
if ($_SESSION['giris'] == TRUE) {
    header("Location:index.php");
}

include("sistem/baglanti.php");
include("sistem/fonksiyonlar.php");
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
                            <form method="post" action="#" class="form-validate">
                                <div class="form-group">
                                    <input id="login-username" type="text" name="sicil" required
                                           data-msg="Sicil Numaranızı Giriniz" class="input-material">
                                    <label for="login-username" class="label-material">Sicil Numaranızı Giriniz</label>
                                </div>
                                <div class="form-group">
                                    <input id="login-username" type="text" name="xxx" required
                                           data-msg="Mail Adresinizi Giriniz" class="input-material">
                                    <label for="login-username" class="label-material">Mail Adresinizi Giriniz</label>
                                </div>
                                <input name="git" type="submit" id="login" class="btn btn-primary" value="Gönder">
                            </form>
                            <?php

                            if ($_POST["git"]) {

                                $form_sicil = $_POST["sicil"];
                                $form_mail = $_POST["xxx"];

                                $sorgula = $db->query("SELECT * FROM kullanicilar WHERE k_adi='$form_sicil'")->fetch(PDO::FETCH_ASSOC);


                                if ($form_mail == $sorgula["mail"]) {
                                    function sifreureteci()
                                    {
                                        $karakterler = "1234567890abcdefghijKLMNOPQRSTuvwxyzABCDEFGHIJklmnopqrstUVWXYZ0987654321";
                                        $sifre = '';
                                        for ($i = 0; $i < 8; $i++) {
                                            $sifre .= $karakterler{rand() % 72};
                                        }
                                        return $sifre;
                                    }

                                    $sifre = sifreureteci();
                                    $sifre_md5 = md5($sifre);

                                    $guncelleme = $db->query("UPDATE kullanicilar SET sifre='$sifre_md5' WHERE k_adi='$form_sicil'");

                                    $logla = $db->prepare("INSERT INTO log SET
          islem_tipi = ?,
          islem_tarihi = ?,
          islem_ip = ?,
          islem_user = ?,
          islem_user_sicil = ?,
          detay = ?
          ");
                                    date_default_timezone_set('Europe/Istanbul');
                                    $ip = ip_bul();
                                    $userx = ucwords($sorgula['ad']) . ' ' . ucwords($sorgula['soyad']);
                                    $diger = 'Şifre Talebinde Bulunan Sicil No :' . $form_sicil;
                                    $inserta = $logla->execute(array('Yeni Şifre Talebi', date('Y-m-d H-i-s'), $ip, $userx, $sorgula['k_adi'], $diger));

                                    echo "Yeni Şifreniz : " . $sifre . "<br>";
                                    echo "Lütfen Sisteme Giriş Yaptıktan Sonra Şifrenizi Değiştiriniz!";

                                } else {
                                    echo "<i style='font-size: small;'>Sicil Numarası ve Mail Adresi Eşleşmiyor. Lütfen Kontrol Ediniz!</i><br>";
                                }
                            }
                            ?>
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
