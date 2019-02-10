<?php


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
        <h2 class="h5 no-margin-bottom">Kayıtlı Kullanıcılar</h2>
    </div>
    <div class="col-lg-12">
        <div class="block">
            <br><br>
            <div class="block-body">
                <form method="post" action="#" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Sicil Numarası</label>
                        <div class="col-sm-9">
                            <input type="text" name="sicilno" class="form-control" id="sicil">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Adı</label>
                        <div class="col-sm-9">
                            <input type="text" name="ad" class="form-control" id="isim">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Soyadı</label>
                        <div class="col-sm-9">
                            <input type="text" name="soyad" class="form-control" id="soyisim">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">E-posta Adresi</label>
                        <div class="col-sm-9">
                            <input type="email" name="eposta" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Telefon Numarası</label>
                        <div class="col-sm-9">
                            <input type="text" name="telefon" class="form-control" id="telefon" maxlength="10">
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
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Yönetici</label>
                        <div class="col-sm-9">
                            <div class="i-checks">
                                <input id="radioCustom1" type="radio" value="1" name="yonetici" class="radio-template">
                                <label for="radioCustom1">Evet</label>
                            </div>
                            <div class="i-checks">
                                <input id="radioCustom2" type="radio" checked="" value="0" name="yonetici"
                                       class="radio-template">
                                <label for="radioCustom2">Hayır</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">Fotoğraf Seçin (En Fazla 2MByte)</label>
                        <input name="foto" type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <input name="kaydet" type="submit" value="Kullanıcı Ekle" class="btn btn-primary btn-block">
                </form>
                <?php
                if (isset($_POST['kaydet'])) {
                    if ($_POST['sicilno'] == "") {
                        echo '<div><span id="bilgi1" style="color: #e95f71; font-size: small;  ">Sicil Numarası Boş Olamaz*</span></div>';
                    } else {
                        if ($_POST['ad'] == "") {
                            echo '<div><span id="bilgi2" style="color: #e95f71;  font-size: small; ">İsim Boş Olamaz*</span></div>';
                        } else {
                            if ($_POST['soyad'] == "") {
                                echo '<div><span id="bilgi3" style="color: #e95f71; font-size: small;  ">Soyisim Boş Olamaz*</span></div>';
                            } else {
                                if ($_POST['eposta'] == "") {
                                    echo '<div><span id="bilgi4" style="color: #e95f71;  font-size: small; ">E-posta Adresi Boş Olamaz*</span></div>';
                                } else {
                                    if (strlen($_POST['telefon']) < 10) {
                                        echo '<div><span id="bilgi5" style="color: #e95f71;  font-size: small; ">Telefon Numarası 10 Karakterden Kısa Olamaz*</span></div>';
                                    } else {

                                        $sic = $_POST["sicilno"];
                                        $email = $_POST["eposta"];
                                        $tel = $_POST["telefon"];

                                        $kontrol1 = $db->query("SELECT * FROM kullanicilar where k_adi='$sic'");
                                        $sic_kontrol = $kontrol1->rowCount();

                                        $kontrol2 = $db->query("SELECT * FROM kullanicilar where mail='$email'");
                                        $email_kontrol = $kontrol2->rowCount();

                                        $kontrol3 = $db->query("SELECT * FROM kullanicilar where telefon='$tel'");
                                        $tel_kontrol = $kontrol3->rowCount();

                                        if ($sic_kontrol > 0) {
                                            echo '<script>alert("Bu Sicil Numarası Zaten Kayıtlı!");</script>';
                                        } elseif ($email_kontrol > 0) {
                                            echo '<script>alert("Bu E-posta Adresi Zaten Kayıtlı!");</script>';
                                        } elseif ($tel_kontrol > 0) {
                                            echo '<script> alert("Bu Telefon Numarası Zaten Kayıtlı!");</script>';
                                        } else {
                                            $maks_boyut = 2097152;
                                            $foto_dosya_uzantisi = substr($_FILES["foto"]["name"], -4, 4);
                                            $foto_dosya_adi = $_POST["sicilno"] . $foto_dosya_uzantisi;
                                            $foto_dosya_yolu = "img/users/" . $foto_dosya_adi;
                                            $foto_dosya_type = $_FILES["foto"]["type"];


                                            if ($_FILES["foto"]["size"] > $maks_boyut) {
                                                echo '<div><span id="bilgi5" style="color: #e95f71;  font-size: small; ">Dosya Boyutu En Fazla 2MByte Olabilir*</span></div>';
                                            } else {
                                                if ($foto_dosya_type == "image/png" || "image/jpeg") {
                                                    if (is_uploaded_file($_FILES["foto"]["tmp_name"])) {
                                                        $tasima = move_uploaded_file($_FILES["foto"]["tmp_name"], $foto_dosya_yolu);
                                                        if ($tasima) {


                                                            $sicilno = $_POST["sicilno"];
                                                            $ad = $_POST["ad"];
                                                            $soyad = $_POST["soyad"];
                                                            $eposta = $_POST["eposta"];
                                                            $telefon = $_POST["telefon"];
                                                            $birim = $_POST["birim"];
                                                            $yonetici = $_POST["yonetici"];

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

                                                            $query = $db->prepare("INSERT INTO kullanicilar SET ad=?,soyad=?,mail=?,telefon=?,resim=?,yetki=?,birim=?,k_adi=?,sifre=?");
                                                            $insert = $query->execute(array($ad, $soyad, $eposta, $telefon, $foto_dosya_yolu, $yonetici, $birim, $sicilno, md5($sifre)));
                                                            if ($insert) {
                                                                $last_id = $db->lastInsertId();

                                                                require("mail/src/class.phpmailer.php");
                                                                require 'mail/src/Exception.php';
                                                                require 'mail/src/PHPMailer.php';
                                                                require 'mail/src/SMTP.php';

                                                                $mail = new PHPMailer();
                                                                $mail->IsSMTP();
                                                                $mail->SMTPAuth = true;
                                                                $mail->Host = 'smtp.yandex.com';
                                                                $mail->Port = 587;
                                                                $mail->SMTPSecure = 'tls';
                                                                $mail->Username = 'turktelekommalatya@yandex.com.tr';
                                                                $mail->Password = 'C91a44n4dab23';
                                                                $mail->SetFrom($mail->Username, 'Türk Telekom - Stok Takip Sistemi');
                                                                $mail->AddAddress($eposta, $ad);
                                                                $mail->CharSet = 'UTF-8';
                                                                $mail->Subject = 'Türk Telekom - Stok Takip Sistemi';
                                                                $mail->MsgHTML('
Türk Telekom - Stok Takip Sistemine Kaydınız Yapılmıştır ve Sistem Tarafından Adınıza Oluşturulmuş Şifreniz Size Gönderilmiştir.
<br><br>
Sisteme Giriş İçin;
<br>Kullanıcı Adınız (Sicil No) :' . $sicilno . '
<br>Şifreniz :' . $sifre . '
<br><br>Lütfen Şifrenizi Kimseyle Paylaşmayın!
<br>Şifrenizi Sisteme Girdikten Sonra Değiştirebilirsiniz.

Türk Telekom
');
                                                                if ($mail->Send()) {
                                                                    echo 'Mail gönderildi!';
                                                                } else {
                                                                    echo 'Mail gönderilirken bir hata oluştu: ' . $mail->ErrorInfo;
                                                                }

                                                                $logla = $db->prepare("INSERT INTO log SET islem_tipi = ?,islem_tarihi = ?,islem_ip = ?,islem_user = ?,islem_user_sicil=?, detay = ?");
                                                                date_default_timezone_set('Europe/Istanbul');
                                                                $ip = ip_bul();
                                                                $userx = ucwords($_SESSION['ad']) . ' ' . ucwords($_SESSION['soyad']);
                                                                $diger = 'Eklenen Kullanıcı :' . $ad . ' ' . $soyad . '<br>Sicil Numarası :' . $sicilno;
                                                                $inserta = $logla->execute(array('Kullanıcı Ekleme', date('Y-m-d H-i-s'), $ip, $userx, $_SESSION['k_adi'], $diger));


                                                                header("Location:kullanicilar.php");
                                                            }

                                                        }
                                                    }
                                                } else {
                                                    echo '<div><span id="bilgi5" style="color: #e95f71;  font-size: small; ">Fotoğraf "Jpeg" Yada "Png" Formatında Olmalıdır*</span></div>';
                                                }
                                            }
                                        }


                                    }
                                }

                            }

                        }

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

