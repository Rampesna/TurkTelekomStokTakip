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

    $id = $_GET['uid'];
    $query = $db->prepare("SELECT * FROM log WHERE islem_id = ?");
    $query->execute(array($id));
    $query2 = $query->fetch(PDO::FETCH_ASSOC);

?>


    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">İşlem Detayı</h2>
        </div>
        <div class="col-lg-12">
            <div class="block">
                <br><br>
                <div class="block-body">
                    <form method="post" action="kullanici-duzenle.php" class="form-horizontal">
                        <div style="display: none;" class="form-group row">
                            <label class="col-sm-3 form-control-label">İşlem ID</label>
                            <div class="col-sm-9">
                                <input disabled value="<?php echo $query2['islem_id']; ?>" type="text" name="sicil" class="form-control" id="isim">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">İşlem Tipi</label>
                            <div class="col-sm-9">
                                <input disabled value="<?php echo $query2['islem_tipi']; ?>" type="text" name="ad" class="form-control" id="isim">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">İşlem Tarihi</label>
                            <div class="col-sm-9">
                                <input disabled value="<?php echo $query2['islem_tarihi']; ?>" type="text" name="soyad" class="form-control" id="soyisim">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">İşlem Yapılan MAC Adresi</label>
                            <div class="col-sm-9">
                                <input disabled value="<?php echo $query2['islem_ip']; ?>" type="email" name="eposta" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">İşlemi Yapan Kullanıcı Sicil No</label>
                            <div class="col-sm-9">
                                <input disabled value="<?php echo $query2['islem_user_sicil']; ?>" type="text" name="telefon" class="form-control" id="telefon" maxlength="10">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">İşlemi Yapan Kullanıcı</label>
                            <div class="col-sm-9">
                                <input disabled value="<?php echo $query2['islem_user']; ?>" type="text" name="telefon" class="form-control" id="telefon" maxlength="10">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment"><u>Detay:</u><br><?php echo $query2['detay']; ?></label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
include ("modules/footer.php");
?>