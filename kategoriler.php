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

    $kateg_adi = $_POST['kateg_adi'];

    $kontrol = $db->query("SELECT * FROM kategoriler where kategori_adi='$kateg_adi'");
    $kontrol = $kontrol->rowCount();
    if ($kontrol > 0) {
        ?>
        <script>
            alert("Bu Kategori Zaten Mevcut!");
        </script>
        <?php
    } else {
        $query = $db->prepare("INSERT INTO kategoriler SET kategori_adi = ?");
        $insert = $query->execute(array($kateg_adi));
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
            $diger = 'Eklenen Kategori :' . $kateg_adi;
            $inserta = $logla->execute(array('Kategori Ekleme', date('Y-m-d H-i-s'), $ip, $userx, $_SESSION['k_adi'], $diger));

            if ($inserta) {

            }

            header("refresh:3");
        }
    }


}

if ($_POST['sil']) {

    $sil_kat_adi = $_POST['sil_kat_adi'];

    $islem1 = $db->query("SELECT kategori_adi FROM kategoriler WHERE kat_id = $sil_kat_adi")->fetch();
    $silinen = $islem1['kategori_adi'];

    $query = $db->prepare("DELETE FROM kategoriler WHERE kat_id= :silinecek");
    $delete = $query->execute(array('silinecek' => $sil_kat_adi));

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
    $inserta = $logla->execute(array('Kategori Silme', date('Y-m-d H-i-s'), $ip, $userx, $_SESSION['k_adi'], $diger));

    if ($inserta) {
        header("Location:kategoriler.php");
    }

}


?>

<div class="page-header">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Kategori Ekle</h2>
    </div>
    <div class="col-lg-12">
        <div class="block">
            <br><br>
            <div class="block-body">
                <form action="kategoriler.php" method="post" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Yeni Kategori Adı</label>
                        <div class="col-sm-9 select">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="text" name="kateg_adi" class="form-control">
                                </div>
                            </div>
                            <input type="submit" name="ekle" value="Yeni Kategori Ekle"
                                   class="btn btn-primary btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Kategori Sil</h2>
    </div>
    <div class="col-lg-12">
        <div class="block">
            <br><br>
            <div class="block-body">
                <form action="#" method="post" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Kategoriler</label>
                        <div class="col-sm-9 select">
                            <select name="sil_kat_adi" class="form-control mb-3">
                                <?php
                                $query = $db->query("SELECT * FROM kategoriler ORDER BY kat_id DESC", PDO::FETCH_ASSOC);
                                if ($query->rowCount()) {
                                    foreach ($query as $row) {
                                        print "<option value='" . $row['kat_id'] . "'>" . ucwords($row['kategori_adi']) . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input onclick="kat_silindi()" name="sil" type="submit" value="Seçili Kategoriyi Sil"
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
