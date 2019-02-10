<?php
/**
 * Created by PhpStorm.
 * User: Rampesna
 * Date: 05.06.2018
 * Time: 16:01
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
        <h2 class="h5 no-margin-bottom">Stoktaki Ürünler</h2>
    </div>
    <div class="col-lg-12">
        <div class="container">
            <div class="table-responsive">
                <table id="stokurunler" class="table table-striped table-hover table-sm">
                    <thead>
                    <tr>
                        <th>#Seri No</th>
                        <th>Kategori</th>
                        <th>Firma</th>
                        <th>Model</th>
                        <th>Tip</th>
                        <th>Geldiği Yer</th>
                        <th>Kullanılacak Yer</th>
                        <th>Açıklama</th>
                        <th>Adet</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $query = $db->query("SELECT * FROM urunler", PDO::FETCH_ASSOC);
                    if ( $query->rowCount() ){
                        foreach( $query as $row ){
                            echo '<tr>';

                                echo '<th scope="row"><a style="text-decoration: none;" href="urun-detay.php?uid='.$row["seri_no"].'">'.$row["seri_no"].'</a></th>';
                                echo '<th>'.$row["kategori"].'</th>';
                                echo '<th>'.$row["firma"].'</th>';
                                echo '<th>'.$row["model"].'</th>';
                                echo '<th>'.$row["tip"].'</th>';
                                echo '<th>'.$row["geldigi"].'</th>';
                                echo '<th>'.$row["gidecegi"].'</th>';
                                echo '<th>'.$row["aciklama"].'</th>';
                                echo '<th>'.$row["adet"].'</th>';

                            echo '</tr>';

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

