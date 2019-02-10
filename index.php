<?php
/**
 * Created by PhpStorm.
 * User: Rampesna
 * Date: 05.06.2018
 * Time: 09:21
 */
session_start();

if(!$_SESSION['giris']==TRUE){
    header("Location:login.php");
}


include ("sistem/baglanti.php");
include ("sistem/fonksiyonlar.php");

include ("modules/header.php");
include ("modules/page-header.php");
include ("modules/sidebar.php");
?>

    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Anasayfa</h2>
        </div>
    </div>

<?php
include ("modules/az-kalan-urunler.php");
include("modules/toplam-urun-giris-cikis.php");
include("modules/son-islemler.php");
include ("modules/footer.php");
?>