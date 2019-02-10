<?php

include ("sistem/baglanti.php");

if ($_POST["kaydet"]) {

    echo "POSTA GİRİŞ YAPILDI<br>";

    $firma_adi = $_POST['firma_adi'];
    $adres_semt = $_POST['semt'];
    $adres_sehir = $_POST['sehir'];
    $firma_telefon = $_POST['telno'];
    $firma_mail = $_POST['mail'];
    $firma_adres = $_POST['adres'];

    echo "POST VERİLERİ DEĞİŞKENLERE ATANDI<br>";

    echo $firma_adi.'<br>';
    echo $adres_semt.'<br>';
    echo $adres_sehir.'<br>';
    echo $firma_telefon.'<br>';
    echo $firma_mail.'<br>';
    echo $firma_adres.'<br>';

    echo "<br><br>DEĞİŞKENLER EKRANA YAZDIRILDI";

    if ($firma_adi == "" || $firma_adres = "" || $adres_semt = "" || $adres_sehir = "" || $firma_telefon = "" || $firma_mail = ""){
        echo '<div><span id="bilgi1" style="color: #e95f71; font-size: small;  ">Boş Alanları Lütfen Doldurun*</span></div>';
    }else{
        $kontrol = $db->query("SELECT * FROM firmalar where firma_adi='$firma_adi'");
        $kontrol = $kontrol->rowCount();
        if ($kontrol > 0) {
            ?>
            <script>
                alert("Bu Firma Zaten Mevcut!");
            </script>
            <?php
        } else {
            $query = $db->prepare("INSERT INTO firmalar SET 
firma_adi = ?,
adres_semt = ?,
adres_sehir = ?,
firma_telefon = ?,
firma_mail = ?");

            echo "<br><br>INSERT INTO PREPARE ÇALIŞTIRILDI";

            $insert = $query->execute(array($firma_adi,$adres_semt,$adres_sehir,$firma_telefon,$firma_mail));

            echo "<br><br>KAYIT İŞLEMİ TAMAMLANDI";


                echo "<br><br>KAYIT DOĞRULANDI";


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
                $diger = 'Eklenen Firma :' . $firma_adi;
                $inserta = $logla->execute(array('Firma Ekleme', date('Y-m-d H-i-s'), $ip, $userx, $_SESSION['k_adi'], $diger));

                echo "<br><br>LOG KAYDI YAPILDI";

                if ($inserta) {

                    echo "<br><br>BİTİRİLDİ";


                }



        }
    }


}

?>