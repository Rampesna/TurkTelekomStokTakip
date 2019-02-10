<?php
/**
 * Created by PhpStorm.
 * User: Rampesna
 * Date: 05.06.2018
 * Time: 10:36
 */
?>
<div class="page-header">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Son Yapılan İşlemler</h2>
    </div>
</div>
<section class="no-padding-bottom">
    <div class="container-fluid">
        <?php

        $girisler = $db->query("SELECT * FROM log ORDER BY islem_id DESC")->fetchAll(PDO::FETCH_ASSOC);
        $cek_adet=0;
        foreach ($girisler as $liste) {
            $dig = $db->query("SELECT * FROM kullanicilar WHERE k_adi={$liste['islem_user_sicil']}")->fetchAll(PDO::FETCH_ASSOC);
            if($cek_adet < 10){
                foreach ($dig as $abc){

            ?>
        <div class="public-user-block block">
            <div class="row d-flex align-items-center">
                <div class="col-lg-4 d-flex align-items-center">
                    <div class="order"><?php echo $liste["islem_user_sicil"];?></div>
                    <div class="avatar"><img src="<?php echo $abc["resim"]; ?>" alt="..." class="img-fluid"></div>
                    <a href="log-detay.php?uid=<?php echo $liste["islem_id"]; ?>" class="name"><strong class="d-block"><?php echo $abc["ad"].' '.$abc["soyad"]; ?></strong><span
                                class="d-block"><?php echo $abc["birim"]; ?></span></a>
                </div>
                <div class="col-lg-4">
                    <div class="details d-flex">
                        <div class="item"><i class="icon-pencil-case"></i><?php echo $liste["islem_tipi"];?></div>
                        <div class="item"><i class="icon-website">MAC Adresi</i><?php echo $liste["islem_ip"];?></div>
                        <?php if($_SESSION["yetki"] == 1){ ?>
                            <div class="item"><i class="icon-check"></i><a style="text-decoration: none;" href="log-detay.php?uid=<?php echo $liste["islem_id"]; ?>">İşlem Detayı</a></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="contributions"><?php echo $liste["islem_tarihi"]; ?></div>
                </div>

            </div>
        </div>
        <?php
                }
            }
            $cek_adet +=1;
        }
        ?>
    </div>
</section>
