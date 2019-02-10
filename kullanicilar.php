<?php
/**
 * Created by PhpStorm.
 * User: Rampesna
 * Date: 08.06.2018
 * Time: 12:04
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
        <h2 class="h5 no-margin-bottom">Kayıtlı Kullanıcılar</h2>
    </div>
    <div class="col-lg-12">
        <div class="container">
            <div class="table-responsive">
                <table id="stokurunler" class="table table-striped table-hover table-sm">
                    <thead>
                    <tr>
                        <th>#Sicil No</th>
                        <th>Adı Soyadı</th>
                        <th>E-posta Adresi</th>
                        <th>Telefon No</th>
                        <th>Birim</th>
                        <th>Son Giriş Tarihi</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $query = $db->query("SELECT * FROM kullanicilar", PDO::FETCH_ASSOC);
                    if ( $query->rowCount() ){
                        foreach( $query as $row ){
                            print '<tr>';

                            print '<th scope="row"><a style="text-decoration: none;" href="kullanici-duzenle.php?uid='.$row["k_adi"].'">'.$row["k_adi"].'</a></th>';
                            print '<th>'.ucwords($row["ad"])." ".ucwords($row["soyad"]).'</th>';
                            print '<th>'.$row["mail"].'</th>';
                            print '<th>'.$row["telefon"].'</th>';
                            print '<th>'.ucwords($row["birim"]).'</th>';
                            print '<th>'.$row["son_giris_tarihi"].'</th>';

                            print '</tr>';

                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include ("modules/footer.php");
?>
