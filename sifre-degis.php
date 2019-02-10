<?php
/**
 * Created by PhpStorm.
 * User: Rampesna
 * Date: 26.06.2018
 * Time: 15:17
 */
session_start();

if (!$_SESSION['giris'] == TRUE) {
    header("Location:login.php");
}


include("sistem/baglanti.php");
include("sistem/fonksiyonlar.php");

include("modules/header.php");
include("modules/page-header.php");
include("modules/sidebar.php");
?>

<div class="page-header">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Şifre Değiştirme</h2>
    </div>
    <div class="col-lg-12">
        <div class="block">
            <br><br>
            <div class="block-body">
                <form method="post" action="#" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Eski Şifrenizi Giriniz</label>
                        <div class="col-sm-9">
                            <input type="password" name="eskisifre" class="form-control" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Yeni Şifrenizi Giriniz</label>
                        <div class="col-sm-9">
                            <input type="password" name="yenisifre" class="form-control" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Yeni Şifrenizi Tekrar Giriniz</label>
                        <div class="col-sm-9">
                            <input type="password" name="yenisifretekrar" class="form-control" id="">
                        </div>
                    </div>
                    <input name="degistir" type="submit" value="Şifremi Değiştir" class="btn btn-primary btn-block">
                </form>
                <?php

                if($_POST["degistir"]){

                    $kullanici = $_SESSION["k_adi"];

                    $gelen_eski_sifre = $_POST["eskisifre"];
                    $gelen_yeni_sifre = $_POST["yenisifre"];
                    $gelen_yeni_sifre_tekrar = $_POST["yenisifretekrar"];

                    $sorgu = $db->prepare("SELECT * FROM kullanicilar where k_adi= :kullanici");
                    $sorgu->execute(array(
                        "kullanici" => $kullanici,
                    ));
                    $sonuc = $sorgu->fetch();



                    if (md5($gelen_eski_sifre) == $sonuc["sifre"]){
                        if ($gelen_yeni_sifre == $gelen_yeni_sifre_tekrar){
                            $yeni = md5($gelen_yeni_sifre);
                            $sorgulama = $db->prepare("UPDATE kullanicilar SET sifre=? WHERE k_adi=?");
                            $calistir = $sorgulama->execute(array($yeni,$kullanici));
                            if ($calistir) {

                                $logla = $db->prepare("INSERT INTO log SET islem_tipi = ?,islem_tarihi = ?,islem_ip = ?,islem_user = ?,islem_user_sicil=?, detay = ?");
                                date_default_timezone_set('Europe/Istanbul');
                                $ip = ip_bul();
                                $userx = ucwords($_SESSION['ad']) . ' ' . ucwords($_SESSION['soyad']);
                                $diger = ' ';
                                $inserta = $logla->execute(array('Şifre Değiştirme', date('Y-m-d H-i-s'), $ip, $userx, $_SESSION['k_adi'], $diger));

                                header("Location:logout.php");
                            }
                        }else{
                            echo '<div><span id="bilgi1" style="color: #e95f71; font-size: small;  ">Şifreler Birbiriyle Uyuşmuyor!</span></div>';
                        }
                    }else{
                        echo '<div><span id="bilgi1" style="color: #e95f71; font-size: small;  ">Eski Şifrenizi Hatalı Girdiniz!</span></div>';
                    }

                }


                ?>
            </div>
        </div>
    </div>
</div>

<?php
include("modules/footer.php");
?>
