<?php
/**
 * Created by PhpStorm.
 * User: Rampesna
 * Date: 26.06.2018
 * Time: 11:47
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
<div class="page-header">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Fiş Oluşturma</h2>
    </div>
    <div class="col-lg-12">
        <div class="block">
            <br><br>
            <div class="block-body">
                <form method="post" target="_blank" action="fis.php" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Gönderilecek Firma</label>
                        <div class="col-sm-9 select">
                            <select name="firma" class="form-control mb-3">
                                <?php
                                $query = $db->query("SELECT * FROM firmalar ORDER BY firma_id ASC", PDO::FETCH_ASSOC);
                                if ($query->rowCount()) {
                                    foreach ($query as $row) {
                                        print "<option value='" . $row['firma_id'] . "'>" . ucwords($row['firma_adi']) . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Firmanın Bulunduğu Şehir</label>
                        <div class="col-sm-9">
                            <input name="sehir" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Firmanın Bulunduğu Semt</label>
                        <div class="col-sm-9">
                            <input name="semt" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Firmanın Adresi</label>
                        <div class="col-sm-9">
                            <input name="adres" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Firmanın Telefon Numarası</label>
                        <div class="col-sm-9">
                            <input type="text" name="teleno" class="form-control" id="telefon" maxlength="10">
                            <div class="help-block">Lütfen başında "0" olmadan giriniz.</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Firmanın E-posta Adresi</label>
                        <div class="col-sm-9">
                            <input name="mail" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Gönderilen Kargo Firması</label>
                        <div class="col-sm-9 select">
                            <select name="kargo" class="form-control mb-3">
                                <option value="Yurtiçi Kargo">Yurtiçi Kargo</option>
                                <option value="UPS Kargo">UPS Kargo</option>
                                <option value="MNG Kargo">MNG Kargo</option>
                                <option value="Aras Kargo">Aras Kargo</option>
                                <option value="Sürat Kargo">Sürat Kargo</option>
                                <option value="PTT Kargo">PTT Kargo</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Anlaşmalı Kargo Kodu</label>
                        <div class="col-sm-9">
                            <input type="text" name="kod" class="form-control" id="kargo-kod">
                        </div>
                    </div>
                    <input name="fis" type="submit" value="Fiş Oluştur" class="btn btn-primary btn-block">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include ("modules/footer.php");
?>