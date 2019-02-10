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

    $maks_boyut=2097152;
    $foto_dosya_uzantisi=substr($_FILES["foto"]["name"],-4,4);
    $foto_dosya_adi =$_POST["sicilno"].$foto_dosya_uzantisi;
    $foto_dosya_yolu ="img/users/".$foto_dosya_adi;
    $foto_dosya_type=$_FILES["foto"]["type"];


    if ($_FILES["foto"]["size"]>$maks_boyut){
        echo '<div><span id="bilgi5" style="color: #e95f71;  font-size: small; ">Dosya Boyutu En Fazla 2MByte Olabilir*</span></div>';
    }else {
        if ($foto_dosya_type == "image/png" || "image/jpeg") {
            if (is_uploaded_file($_FILES["foto"]["tmp_name"])) {
                $tasima = move_uploaded_file($_FILES["foto"]["tmp_name"], $foto_dosya_yolu);
                if ($tasima) {

                    $sorgulama = $db->prepare("UPDATE kullanicilar SET ad=?,soyad=?,mail=?,telefon=?,resim=? WHERE k_adi=?");
                    $calistir = $sorgulama->execute(array($ad, $soyad, $mail, $telefon,$foto_dosya_yolu,$sicil));
                    if ($calistir) {

                        $logla = $db->prepare("INSERT INTO log SET islem_tipi = ?,islem_tarihi = ?,islem_ip = ?,islem_user = ?,islem_user_sicil=?, detay = ?");
                        date_default_timezone_set('Europe/Istanbul');
                        $ip = ip_bul();
                        $userx = ucwords($_SESSION['ad']) . ' ' . ucwords($_SESSION['soyad']);
                        $diger = 'Güncellenen Profil Sicil No :' . $sicil . '<br>Yeni Değerler :' . 'Adı :' . $ad . '<br>' . 'Soyadı :' . $soyad . '<br>' . 'E-posta Adresi :' . $mail . '<br>' . 'Telefon :' . $telefon;
                        $inserta = $logla->execute(array('Profil Güncelleme', date('Y-m-d H-i-s'), $ip, $userx, $_SESSION['k_adi'], $diger));

                        header("Location:index.php");
                    }

                }
            }
        }
    }





}else {
    $id = $_GET['uid'];
    $query = $db->prepare("SELECT * FROM kullanicilar WHERE k_adi = ?");
    $query->execute(array($id));
    $query2 = $query->fetch(PDO::FETCH_ASSOC);
}

?>


    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Profili Düzenle</h2>
        </div>
        <div class="col-lg-12">
            <div class="block">
                <br><br>
                <div class="block-body">
                    <form method="post" action="profil.php" enctype="multipart/form-data" class="form-horizontal">
                        <div class="col-lg-12">
                            <div class="user-block block text-center">
                                <div class="avatar"><img src="<?php echo $query2['resim']; ?>" alt="..." class="img-fluid">
                                </div>
                                <a class="user-title">
                                    <h3 class="h5"><?php echo $query2['ad'].' '.$query2['soyad']; ?></h3>
                                    <span><?php echo $query2['birim']; ?></span>
                                </a>
                            </div>
                        </div>
                        <div style="display: none;" class="form-group row">
                            <label class="col-sm-3 form-control-label">Sicil</label>
                            <div class="col-sm-9">
                                <input value="<?php echo $query2['k_adi']; ?>" type="text" name="sicil" class="form-control" id="isim">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Ad</label>
                            <div class="col-sm-9">
                                <input value="<?php echo $query2['ad']; ?>" type="text" name="ad" class="form-control" id="isim">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Soyad</label>
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
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Yeni Fotoğraf Seçin (En Fazla 2MByte)</label>
                            <input name="foto" type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                        <input name="guncelle" type="submit" value="Güncelle" class="btn btn-primary btn-block">
                    </form>
                    <br>
                    <form action="sifre-degis.php">
                        <input name="sifredegis" type="submit" value="Şifre Değiştirme" class="btn btn-primary btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
include ("modules/footer.php");
?>