<?php
/**
 * Created by PhpStorm.
 * User: Rampesna
 * Date: 12.06.2018
 * Time: 15:32
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
?>

<?php

if ($_POST["guncelle"]) {

    include("sistem/baglanti.php");

    $seri_no = $_POST["seri"];
    $kategori = $_POST["kategori"];
    $firma = $_POST["firma"];
    $model = $_POST["model"];
    $tip = $_POST["tip"];
    $geldigi = $_POST["geldigi"];
    $gidecegi = $_POST["gidecegi"];
    $adet = $_POST["adet"];
    $aciklama = $_POST["aciklama"];


    $sorgulama = $db->prepare("UPDATE urunler SET kategori=?,firma=?,model=?,tip=?,geldigi=?,gidecegi=?,aciklama=?,adet=? WHERE seri_no=?");
    $calistir = $sorgulama->execute(array($kategori, $firma, $model, $tip, $geldigi, $gidecegi, $aciklama, $adet, $seri_no));
    if ($calistir) {
        header("Location:stok-urunler.php");
    }

    $logla = $db->prepare("INSERT INTO log SET islem_tipi = ?,islem_tarihi = ?,islem_ip = ?,islem_user = ?,islem_user_sicil=?, detay = ?");
    date_default_timezone_set('Europe/Istanbul');
    $ip = ip_bul();
    $userx = ucwords($_SESSION['ad']) . ' ' . ucwords($_SESSION['soyad']);
    $diger = 'Güncellenen Ürün Seri No :' . $seri_no . '<br>Yeni Değerler :' . 'Kategori :' . $kategori . '<br>' . 'Firma :' . $firma . '<br>' . 'Model :' . $model . '<br>' . 'Tip :' . $tip . '<br>' . 'Geldiği Yer :' . $geldigi . '<br>' . 'Kullanılacak Yer :' . $gidecegi . '<br>' . 'Açıklama :' . $aciklama . '<br>';
    $inserta = $logla->execute(array('Stok Güncelleme', date('Y-m-d H-i-s'), $ip, $userx, $_SESSION['k_adi'], $diger));

}elseif($_POST["sil"]){

    $seri_no = $_POST["seri"];

    $sil = $db->prepare("DELETE FROM urunler WHERE seri_no=?");
    $delete = $sil->execute(array($seri_no));

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
    $diger = 'Silinen Ürün Seri No :' . $seri_no;
    $inserta = $logla->execute(array('Ürün Silme', date('Y-m-d H-i-s'), $ip, $userx, $_SESSION['k_adi'], $diger));

    header("Location:stok-urunler.php");
} else {
    $id = $_GET['uid'];
    $query = $db->prepare("SELECT * FROM urunler WHERE seri_no = ?");
    $query->execute(array($id));
    $query2 = $query->fetch(PDO::FETCH_ASSOC);
}

?>


<div class="page-header">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom"></h2>
    </div>
    <div class="col-lg-12">
        <div class="block">
            <br><br>
            <div class="block-body">
                <form method="post" action="urun-detay.php" class="form-horizontal">

                    <div style="display: none;" class="form-group row">
                        <label class="col-sm-3 form-control-label">Seri Numarası</label>
                        <div class="col-sm-9">
                            <input type="text" name="seri" class="form-control"
                                   value="<?php echo $query2['seri_no']; ?>">
                        </div>

                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Kategori</label>
                        <div class="col-sm-9 select">
                            <select name="kategori" class="form-control mb-3">
                                <?php
                                $kat = $db->query("SELECT * FROM kategoriler ORDER BY kat_id DESC", PDO::FETCH_ASSOC);
                                if ($kat->rowCount()) {
                                    foreach ($kat as $row1) {
                                        ?>
                                        <option value="<?php echo ucwords($row1["kategori_adi"]); ?>" <?php
                                        if ($row1["kategori_adi"] == $query2["kategori"]) {
                                            echo " selected";
                                        }
                                        ?>><?php echo ucwords($row1["kategori_adi"]); ?></option>
                                        <?php
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
                                $fir = $db->query("SELECT * FROM firmalar ORDER BY firma_id DESC", PDO::FETCH_ASSOC);
                                if ($fir->rowCount()) {
                                    foreach ($fir as $row2) {
                                        ?>
                                        <option value="<?php echo ucwords($row2["firma_adi"]); ?>" <?php
                                        if ($row2["firma_adi"] == $query2["firma"]) {
                                            echo " selected";
                                        }
                                        ?>><?php echo ucwords($row2["firma_adi"]); ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Tip</label>
                        <div class="col-sm-9 select">
                            <select name="tip" class="form-control mb-3">
                                <?php
                                $tp = $db->query("SELECT * FROM tip ORDER BY tip_id DESC", PDO::FETCH_ASSOC);
                                if ($tp->rowCount()) {
                                    foreach ($tp as $row3) {
                                        ?>
                                        <option value="<?php echo ucwords($row3["tip_adi"]); ?>" <?php
                                        if ($row3["tip_adi"] == $query2["tip"]) {
                                            echo " selected";
                                        }
                                        ?>><?php echo ucwords($row3["tip_adi"]); ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Model</label>
                        <div class="col-sm-9">
                            <input type="text" name="model" class="form-control"
                                   value="<?php echo $query2['model']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Geldiği Yer</label>
                        <div class="col-sm-9">
                            <input type="text" name="geldigi" class="form-control"
                                   value="<?php echo $query2['geldigi']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Kullanılacağı Yer</label>
                        <div class="col-sm-9">
                            <input type="text" name="gidecegi" class="form-control"
                                   value="<?php echo $query2['gidecegi']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Adet</label>
                        <div class="col-sm-9">
                            <input type="text" name="adet" class="form-control" value="<?php echo $query2['adet']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Stok Giriş Tarihi</label>
                        <div class="col-sm-9">
                            <input disabled="disabled" type="text" name="tarih" class="form-control"
                                   value="<?php echo $query2['eklenme_tarihi']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comment">Açıklama:</label>
                        <textarea name="aciklama" class="form-control" rows="5"
                                  id="comment"><?php echo $query2['aciklama']; ?></textarea>
                    </div>
                    <input name="guncelle" type="submit" value="Güncelle" class="btn btn-primary btn-block">
                    <input name="sil" <?php
                    if ($_SESSION['yetki'] == "0") {
                        echo "disabled='disabled'";
                    }
                    ?> type="submit" value="Ürünü Sil" class="btn btn-primary btn-block">

                </form>
            </div>
        </div>
    </div>
</div>

<?php
include("modules/footer.php");
?>
