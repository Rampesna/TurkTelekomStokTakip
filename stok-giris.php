<?php
/**
 * Created by PhpStorm.
 * User: Rampesna
 * Date: 05.06.2018
 * Time: 16:01
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


if ($_POST) {

    $seri = $_POST['serino'];
    $kontrol1 = $db->query("SELECT * FROM urunler where seri_no='$seri'");
    $seri_kontrol = $kontrol1->rowCount();

    if ($seri_kontrol > 0) {
        echo '<script>alert("Bu Seri Numarası Zaten Mevcut!");</script>';
    }else{
        $serino = $_POST['serino'];
        $irsaliye_no = $_POST['irsaliye_no'];
        $kategori = $_POST['kategori'];
        $firma = $_POST['firma'];
        $model = $_POST['model'];
        $tip = $_POST['tip'];
        $gelenyer = $_POST['gelenyer'];
        $gidenyer = $_POST['gidenyer'];
        $aciklama = $_POST['aciklama'];
        $adet = $_POST['adet'];

        $query = $db->prepare("INSERT INTO urunler SET
          seri_no = :seri_no,
          irsaliye_no = :irsaliye_no,
          kategori = :kategori,
          firma = :firma,
          model = :model,
          tip = :tip,
          geldigi = :geldigi,
          gidecegi = :gidecegi,
          aciklama = :aciklama,
          adet = :adet
          ");

        $insert = $query->execute(array(
            "seri_no" => $serino,
            "irsaliye_no" => $irsaliye_no,
            "kategori" => $kategori,
            "firma" => $firma,
            "model" => $model,
            "tip" => $tip,
            "geldigi" => $gelenyer,
            "gidecegi" => $gidenyer,
            "aciklama" => $aciklama,
            "adet" => $adet,
        ));
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
            $diger = 'Seri No:' . $serino .'İrsaliye No:' . $irsaliye_no . '<br>' . 'Kategori:' . $kategori . '<br>' . 'Firma:' . $firma . '<br>' . 'Model:' . $model . '<br>' . 'Tip:' . $tip . '<br>' . 'Adet:' . $adet . '<br>' . 'Geldiği Yer:' . $gelenyer . '<br>' . 'Gideceği Yer:' . $gidenyer . '<br>' . 'Açıklama:' . $aciklama;
            $inserta = $logla->execute(array('Stok Ekleme', date('Y-m-d H-i-s'), $ip, $userx, $_SESSION['k_adi'], $diger));

            if ($inserta) {
                header("Location:stok-urunler.php");
            }

        }
    }



}

?>

    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Stok Girişi</h2>
        </div>
        <div class="col-lg-12">
            <div class="block">
                <br><br>
                <div class="block-body">
                    <form method="post" action="stok-giris.php" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Seri Numarası</label>
                            <div class="col-sm-9">
                                <input type="text" name="serino" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">İrsaliye Numarası</label>
                            <div class="col-sm-9">
                                <input type="text" name="irsaliye_no" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Kategori</label>
                            <div class="col-sm-9 select">
                                <select name="kategori" class="form-control mb-3">
                                    <?php
                                    $query = $db->query("SELECT * FROM kategoriler ORDER BY kat_id DESC", PDO::FETCH_ASSOC);
                                    if ($query->rowCount()) {
                                        foreach ($query as $row) {
                                            print "<option value='" . ucwords($row['kategori_adi']) . "'>" . ucwords($row['kategori_adi']) . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Firma</label>
                            <div class="col-sm-9 select">
                                <select name="firma" class="form-control mb-3">
                                    <?php
                                    $query = $db->query("SELECT * FROM firmalar ORDER BY firma_id ASC", PDO::FETCH_ASSOC);
                                    if ($query->rowCount()) {
                                        foreach ($query as $row) {
                                            print "<option value='" . ucwords($row['firma_adi']) . "'>" . ucwords($row['firma_adi']) . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Model</label>
                            <div class="col-sm-9">
                                <input name="model" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Tip</label>
                            <div class="col-sm-9 select">
                                <select name="tip" class="form-control mb-3">
                                    <?php
                                    $query = $db->query("SELECT * FROM tip ORDER BY tip_id ASC", PDO::FETCH_ASSOC);
                                    if ($query->rowCount()) {
                                        foreach ($query as $row) {
                                            print "<option value='" . ucwords($row['tip_adi']) . "'>" . ucwords($row['tip_adi']) . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Geldiği Yer</label>
                            <div class="col-sm-9">
                                <input name="gelenyer" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Kullanılacak Yer</label>
                            <div class="col-sm-9">
                                <input name="gidenyer" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Adet</label>
                            <div class="col-sm-9">
                                <input name="adet" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment">Açıklama:</label>
                            <textarea name="aciklama" class="form-control" rows="5" id="comment"></textarea>
                        </div>
                        <input type="submit" value="Stoğa Ekle" class="btn btn-primary btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
include("modules/footer.php");
?>