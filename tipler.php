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

    $tip_adi = $_POST['tip_adi'];


    $kontrol = $db->query("SELECT * FROM tip where tip_adi='$tip_adi'");
    $kontrol = $kontrol->rowCount();
    if ($kontrol > 0) {
        ?>
        <script>
            alert("Bu Tip Zaten Mevcut!");
        </script>
        <?php
    } else {
        $query = $db->prepare("INSERT INTO tip SET tip_adi = ?");
        $insert = $query->execute(array($tip_adi));
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
            $diger = 'Eklenen Tip :' . $kateg_adi;
            $inserta = $logla->execute(array('Tip Ekleme', date('Y-m-d H-i-s'), $ip, $userx, $_SESSION['k_adi'], $diger));
            if ($inserta) {
                header("Location:tipler.php");
            }

        }
    }
}

if ($_POST['sil']) {

    $sil_tip_adi = $_POST['sil_tip_adi'];

    $islem1 = $db->query("SELECT tip_adi FROM tip WHERE tip_id = $sil_tip_adi")->fetch();
    $silinen = $islem1['tip_adi'];

    $query = $db->prepare("DELETE FROM tip WHERE tip_id= :silinecek");
    $delete = $query->execute(array('silinecek' => $sil_tip_adi));

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
    $diger = 'Silinen Kategori :' . $silinen;
    $inserta = $logla->execute(array('Tip Silme', date('Y-m-d H-i-s'), $ip, $userx, $_SESSION['k_adi'], $diger));

    if ($inserta) {
        header("Location:tipler.php");
    }
}


?>


<div class="page-header">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Tip Ekle</h2>
    </div>
    <div class="col-lg-12">
        <div class="block">
            <br><br>
            <div class="block-body">
                <form action="tipler.php" method="post" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Yeni Tip Adı</label>
                        <div class="col-sm-9 select">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="text" name="tip_adi" class="form-control">
                                </div>
                            </div>
                            <input name="ekle" type="submit" value="Yeni Tip Ekle" class="btn btn-primary btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Tip Sil</h2>
    </div>
    <div class="col-lg-12">
        <div class="block">
            <br><br>
            <div class="block-body">
                <form action="tipler.php" method="post" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Tipler</label>
                        <div class="col-sm-9 select">
                            <select name="sil_tip_adi" class="form-control mb-3">
                                <?php
                                $query = $db->query("SELECT * FROM tip ORDER BY tip_id ASC", PDO::FETCH_ASSOC);
                                if ($query->rowCount()) {
                                    foreach ($query as $row) {
                                        print "<option value='" . $row['tip_id'] . "'>" . ucwords($row['tip_adi']) . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input onclick="tip_silindi()" name="sil" type="submit" value="Seçili Tip'i Sil"
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
