<?php
/**
 * Created by PhpStorm.
 * User: Rampesna
 * Date: 06.06.2018
 * Time: 17:00
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


if ($_POST['ekle']) {

    $firma_adi = $_POST['firma_adi'];

    if ($firma_adi == ""){
        echo "Lütfen Firma Adını Giriniz!";
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
            $query = $db->prepare("INSERT INTO firmalar SET firma_adi = ?");
            $insert = $query->execute(array($firma_adi));
            if ($insert) {
                $last_id = $db->lastInsertId();

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

                if ($inserta) {
                    header("Location:firmalar.php");
                }

                header("refresh:1");
            }
        }
    }

}

if ($_POST['sil']) {
    $sil_firma_adi = $_POST['sil_firma_adi'];

    $islem1 = $db->query("SELECT firma_adi FROM firmalar WHERE firma_id = $sil_firma_adi")->fetch();
    $silinen = $islem1['firma_adi'];

    $query = $db->prepare("DELETE FROM firmalar WHERE firma_id= :silinecek");
    $delete = $query->execute(array('silinecek' => $sil_firma_adi));

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
    $diger = 'Silinen Firma :' . $silinen;
    $inserta = $logla->execute(array('Firma Silme', date('Y-m-d H-i-s'), $ip, $userx, $_SESSION['k_adi'], $diger));

    if ($inserta) {
        header("Location:firmalar.php");
    }
}
?>

<div class="page-header">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Firma Ekle</h2>
    </div>
    <div class="col-lg-12">
        <div class="block">
            <br><br>
            <div class="block-body">
                <form action="firmalar.php" method="post" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Yeni Firma Adı</label>
                        <div class="col-sm-9 select">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="text" name="firma_adi" class="form-control">
                                </div>
                            </div>
                            <input type="submit" name="ekle" value="Yeni Firma Ekle"
                                   class="btn btn-primary btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Firma Sil</h2>
    </div>
    <div class="col-lg-12">
        <div class="block">
            <br><br>
            <div class="block-body">
                <form action="firmalar.php" method="post" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Firmalar</label>
                        <div class="col-sm-9 select">
                            <select name="sil_firma_adi" class="form-control mb-3">
                                <?php
                                $query = $db->query("SELECT * FROM firmalar ORDER BY firma_id ASC", PDO::FETCH_ASSOC);
                                if ($query->rowCount()) {
                                    foreach ($query as $row) {
                                        print "<option value='" . $row['firma_id'] . "'>" . ucwords($row['firma_adi']) . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input onclick="firma_silindi()" name="sil" type="submit" value="Seçili Firmayı Sil"
                                   class="btn btn-primary btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include("modules/footer.php");
?>
