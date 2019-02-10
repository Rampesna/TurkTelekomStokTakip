<?php
/**
 * Created by PhpStorm.
 * User: Rampesna
 * Date: 05.06.2018
 * Time: 12:06
 */
session_start();

include("baglanti.php");

if ($_POST) {

    $kul_adi = $_POST['username'];
    $kul_sifre = $_POST['password'];

    $sorgu = $db->prepare("SELECT * FROM kullanicilar where k_adi= :kullanici and sifre= :sifre");
    $sorgu->execute(array(

        "kullanici" => $kul_adi,
        "sifre" => md5($kul_sifre)

    ));
    $sonuc = $sorgu->fetch();


    if ($sonuc) {
        session_start();

        $_SESSION['giris'] = TRUE;
        $_SESSION['ad'] = $sonuc['ad'];
        $_SESSION['id'] = $sonuc['id'];
        $_SESSION['soyad'] = $sonuc['soyad'];
        $_SESSION['mail'] = $sonuc['mail'];
        $_SESSION['telefon'] = $sonuc['telefon'];
        $_SESSION['yetki'] = $sonuc['yetki'];
        $_SESSION['birim'] = $sonuc['birim'];
        $_SESSION['k_adi'] = $sonuc['k_adi'];
        $_SESSION['resim'] = $sonuc['resim'];

        date_default_timezone_set('Europe/Istanbul');
        $tarih = date('Y-m-d H-i-s');
        $son_giris = $db->prepare("UPDATE kullanicilar SET son_giris_tarihi= :tarih WHERE id= :kim");
        $son_giris->execute(array(
            "kim" => $_SESSION['id'],
            "tarih" => $tarih
        ));

        header("Location:index.php");

    } else {
        echo "<i style='color: #e95f71; font-size: small;'> Sicil Numarası veya Şifre Hatalı!</i><br>";
    }
}
?>