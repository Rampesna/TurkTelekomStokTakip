<?php
/**
 * Created by PhpStorm.
 * User: Rampesna
 * Date: 08.06.2018
 * Time: 12:20
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


<?php

if ($_POST["guncelle"]) {

    include("sistem/baglanti.php");

    $sicil = $_POST["sicil"];
    $ad = $_POST["ad"];
    $soyad = $_POST["soyad"];
    $mail = $_POST["eposta"];
    $telefon = $_POST["telefon"];
    $birim = $_POST["birim"];


    $sorgulama = $db->prepare("UPDATE kullanicilar SET ad=?,soyad=?,mail=?,telefon=?,birim=? WHERE k_adi=?");
    $calistir = $sorgulama->execute(array($ad, $soyad, $mail, $telefon, $birim, $sicil));
    if ($calistir) {

        $logla = $db->prepare("INSERT INTO log SET islem_tipi = ?,islem_tarihi = ?,islem_ip = ?,islem_user = ?,islem_user_sicil=?, detay = ?");
        date_default_timezone_set('Europe/Istanbul');
        $ip = ip_bul();
        $userx = ucwords($_SESSION['ad']) . ' ' . ucwords($_SESSION['soyad']);
        $diger = 'Güncellenen Kullanici Sicil No :' . $sicil . '<br>Yeni Değerler :' . 'Adı :' . $ad . '<br>' . 'Soyadı :' . $soyad . '<br>' . 'E-posta Adresi :' . $mail . '<br>' . 'Telefon :' . $telefon . '<br>' . 'Birim :' . $birim;
        $inserta = $logla->execute(array('Kullanici Güncelleme', date('Y-m-d H-i-s'), $ip, $userx, $_SESSION['k_adi'], $diger));

        header("Location:kullanicilar.php");
    }



}elseif($_POST["sil"]){

    $sicil = $_POST["sicil"];

    $sil = $db->prepare("DELETE FROM kullanicilar WHERE k_adi=?");
    $delete = $sil->execute(array($sicil));

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
    $userx = ucwords($_SESSION['ad']) . ' ' . ucwords($_SESSION['soyad']);
    $diger = 'Silinen Kullanıcı Sicil No :' . $sicil;
    $inserta = $logla->execute(array('Kullanıcı Silme', date('Y-m-d H-i-s'), $ip, $userx, $_SESSION['k_adi'], $diger));

    header("Location:kullanicilar.php");
} else {
    $id = $_GET['uid'];
    $query = $db->prepare("SELECT * FROM kullanicilar WHERE k_adi = ?");
    $query->execute(array($id));
    $query2 = $query->fetch(PDO::FETCH_ASSOC);
}

?>


    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Kullanıcı Düzenle</h2>
        </div>
        <div class="col-lg-12">
            <div class="block">
                <br><br>
                <div class="block-body">
                    <form method="post" action="kullanici-duzenle.php" class="form-horizontal">
                        <div style="display: none;" class="form-group row">
                            <label class="col-sm-3 form-control-label">Sicil</label>
                            <div class="col-sm-9">
                                <input value="<?php echo $query2['k_adi']; ?>" type="text" name="sicil" class="form-control" id="isim">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Adı</label>
                            <div class="col-sm-9">
                                <input value="<?php echo $query2['ad']; ?>" type="text" name="ad" class="form-control" id="isim">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Soyadı</label>
                            <div class="col-sm-9">
                                <input value="<?php echo $query2['soyad']; ?>" type="text" name="soyad" class="form-control" id="soyisim">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">E-posta Adresi</label>
                            <div class="col-sm-9">
                                <input value="<?php echo $query2['mail']; ?>" type="email" name="eposta" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Telefon Numarası</label>
                            <div class="col-sm-9">
                                <input value="<?php echo $query2['telefon']; ?>" type="text" name="telefon" class="form-control" id="telefon" maxlength="10">
                                <div class="help-block">Lütfen başında "0" olmadan giriniz.</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Birim</label>
                            <div class="col-sm-9 select">
                                <select name="birim" class="form-control mb-3">
                                    <option value="Veri Sistemleri">Veri Sistemleri</option>
                                    <option value="İletim Sistemleri">İletim Sistemleri</option>
                                </select>
                            </div>
                        </div>
                        <input name="guncelle" type="submit" value="Güncelle" class="btn btn-primary btn-block">
                        <input name="sil" type="submit" value="Kullanıcıyı Sil" class="btn btn-primary btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
include ("modules/footer.php");
?>