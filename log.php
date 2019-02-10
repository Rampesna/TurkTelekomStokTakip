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
                        <th>#İşlem ID</th>
                        <th>İşlem Türü</th>
                        <th>İşlem Tarihi</th>
                        <th>İşlem MAC Adresi</th>
                        <th>Kullanıcı</th>
                        <th>Sicil</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $query = $db->query("SELECT * FROM log", PDO::FETCH_ASSOC);
                    if ( $query->rowCount() ){
                        foreach( $query as $row ){
                            print '<tr>';

                            print '<th scope="row"><a style="text-decoration: none;" href="log-detay.php?uid='.$row["islem_id"].'">'.$row["islem_id"].'</a></th>';
                            print '<th>'.$row["islem_tipi"].'</th>';
                            print '<th>'.$row["islem_tarihi"].'</th>';
                            print '<th>'.$row["islem_ip"].'</th>';
                            print '<th>'.ucwords($row["islem_user"]).'</th>';
                            print '<th>'.$row["islem_user_sicil"].'</th>';

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
